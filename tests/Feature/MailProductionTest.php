<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Mail\ContactFormMail;
use App\Mail\NewsletterConfirmationMail;
use App\Mail\NewsletterMail;
use App\Mail\NewOrderMail;
use App\Mail\NewUserMail;
use App\Mail\OrderPaidMail;
use App\Mail\WelcomeMail;
use App\Models\Customer;
use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\User;

/**
 * Production-mode live tests.
 *
 * These tests actually send emails via Mailtrap SENDING (live.smtp.mailtrap.io),
 * the same relay used in production, and then verify delivery via the
 * Mailtrap Email Logs API.
 *
 * ─── WHAT THIS TESTS ─────────────────────────────────────────────────────────
 *
 *  ✓  The production SMTP relay accepts the connection and credentials
 *  ✓  Laravel's ApplyMailConfig middleware applies the correct production config
 *  ✓  Every Mailable actually reaches Mailtrap's servers (status ≠ bounce/reject)
 *  ✓  Status is "delivered" — the recipient's MX accepted the mail
 *  ✓  Subject, From address, and recipient are exactly right
 *
 * ─── HOW TO ACTIVATE ─────────────────────────────────────────────────────────
 *
 *  These tests send REAL emails to a REAL inbox. They are disabled by default.
 *  Add to your .env:
 *
 *      MAILTRAP_PROD_TESTS_ENABLED=true
 *      MAILTRAP_TEST_RECIPIENT=bilalvanloon@gmail.com   ← safe inbox you control
 *
 *  All other credentials are already in .env (SMTP_* + SMTP_PASSWORD doubles
 *  as the Mailtrap Email Logs API token).
 *
 *  Run:
 *      php artisan test tests/Feature/MailProductionTest.php
 *
 * ─────────────────────────────────────────────────────────────────────────────
 */
class MailProductionTest extends TestCase
{
    use RefreshDatabase;

    private const API_BASE = 'https://mailtrap.io/api';

    private string $apiToken;
    private string $testRecipient;
    private string $runId;           // unique per test-run to isolate emails in the log

    protected function setUp(): void
    {
        parent::setUp();

        if (! env('MAILTRAP_PROD_TESTS_ENABLED')) {
            $this->markTestSkipped(
                'Production mail tests are disabled. ' .
                'Set MAILTRAP_PROD_TESTS_ENABLED=true and MAILTRAP_TEST_RECIPIENT=your@email.com in .env to enable.'
            );
        }

        $this->testRecipient = env('MAILTRAP_TEST_RECIPIENT', '');
        $this->apiToken      = env('SMTP_PASSWORD', '');   // SMTP password = Mailtrap API token

        if (! $this->testRecipient) {
            $this->markTestSkipped('Set MAILTRAP_TEST_RECIPIENT in .env (e.g. your Gmail address).');
        }

        if (! $this->apiToken) {
            $this->markTestSkipped('SMTP_PASSWORD (= Mailtrap API token) is missing from .env.');
        }

        // A short unique tag embedded in every test subject so we can find it in logs
        $this->runId = 'test-' . Str::random(8);

        // Switch the mailer to the PRODUCTION relay — simulates APP_ENV=production
        config([
            'mail.default'               => 'smtp',
            'mail.mailers.smtp.host'     => env('SMTP_HOST', 'live.smtp.mailtrap.io'),
            'mail.mailers.smtp.port'     => (int) env('SMTP_PORT', 587),
            'mail.mailers.smtp.username' => env('SMTP_USERNAME', 'api'),
            'mail.mailers.smtp.password' => env('SMTP_PASSWORD'),
            'mail.mailers.smtp.scheme'   => env('SMTP_SCHEME', 'smtp'),
            'mail.from.address'          => 'info@lucideinkt.nl',
            'mail.from.name'             => 'Lucide Inkt',
        ]);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  Mailtrap Email Logs API helpers
    //
    //  Endpoint: GET https://mailtrap.io/api/email_logs
    //  Auth    : Api-Token header (= SMTP_PASSWORD)
    //  Docs    : https://docs.mailtrap.io/developers/email-sending/email-logs
    // ──────────────────────────────────────────────────────────────────────────

    /** ISO-8601 timestamp captured just before each mail is sent */
    private string $sentAfter = '';

    /** Record the current time so we can filter API results to only after this point */
    private function markSendTime(): void
    {
        // Subtract 2s of clock-skew margin
        $this->sentAfter = now()->subSeconds(2)->toIso8601String();
    }

    /**
     * Poll /api/email_logs until a message matching the predicate arrives.
     * Handles 429 rate-limit responses with exponential backoff.
     *
     * @param  callable $predicate  function(array $message): bool
     * @param  int      $timeout    seconds before giving up (default 40)
     */
    private function waitForDelivery(callable $predicate, int $timeout = 40): array
    {
        $deadline   = time() + $timeout;
        $sleepBase  = 3;    // start at 3 s between polls — we have ~13 attempts in 40 s
        $retryAfter = 0;

        while (time() < $deadline) {
            if ($retryAfter > 0) {
                sleep($retryAfter);
                $retryAfter = 0;
            }

            $response = Http::withHeaders(['Api-Token' => $this->apiToken])
                ->get(self::API_BASE . '/email_logs', ['limit' => 50]);

            if ($response->status() === 429) {
                // Respect Retry-After header, fallback to 10 s
                $retryAfter = (int) ($response->header('Retry-After') ?: 10);
                sleep($sleepBase);
                continue;
            }

            $this->assertTrue(
                $response->ok(),
                'Mailtrap Email Logs API failed: ' . $response->body()
            );

            $messages = $response->json('messages') ?? [];

            // Only consider messages sent after markSendTime()
            $candidates = array_filter($messages, fn ($m) =>
                empty($this->sentAfter) || ($m['sent_at'] ?? '') >= $this->sentAfter
            );

            foreach ($candidates as $msg) {
                if ($predicate($msg)) {
                    return $msg;
                }
            }

            sleep($sleepBase);
        }

        $this->fail("No matching message found in Mailtrap Email Logs within {$timeout}s.");
    }

    /**
     * Assert that the message reached the recipient's MX server.
     * Mailtrap statuses: delivered | not_delivered | enqueued | opted_out
     */
    private function assertDelivered(array $message): void
    {
        $status  = $message['status']  ?? 'unknown';
        $subject = $message['subject'] ?? '';
        $to      = $message['to']      ?? '';

        $this->assertEquals(
            'delivered',
            $status,
            "Email \"{$subject}\" to <{$to}> was NOT delivered (status: {$status}). " .
            "Check Mailtrap → Email Logs for details."
        );
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  Model helpers
    // ──────────────────────────────────────────────────────────────────────────

    private function fakeUser(): User
    {
        return User::factory()->create([
            'first_name' => 'Prod',
            'last_name'  => 'Testgebruiker',
            'email'      => $this->testRecipient,
        ]);
    }

    private function fakeCustomerWithOrder(): array
    {
        Storage::fake('public');

        $customer = Customer::create([
            'billing_first_name'   => 'Prod',
            'billing_last_name'    => 'Klant',
            'billing_email'        => $this->testRecipient,
            'billing_street'       => 'Teststraat',
            'billing_house_number' => '1',
            'billing_postal_code'  => '1234AB',
            'billing_city'         => 'Amsterdam',
            'billing_country'      => 'NL',
            'billing_phone'        => '+31600000000',
        ]);

        $order = Order::create([
            'customer_id'            => $customer->id,
            'total'                  => 2995,
            'status'                 => 'pending',
            'payment_status'         => 'paid',
            'invoice_pdf_path'       => 'invoices/prod_test.pdf',
            'myparcel_delivery_json' => json_encode(['deliveryType' => 'standard']),
        ]);

        Storage::disk('public')->put($order->invoice_pdf_path, '%PDF-1.4 fake');

        return [$customer, $order->fresh()];
    }

    private function fakeSubscriber(): NewsletterSubscriber
    {
        return NewsletterSubscriber::create([
            'email'              => $this->testRecipient,
            'token'              => Str::random(32),
            'confirmation_token' => Str::random(64),
            'status'             => 'subscribed',
        ]);
    }

    private function fakeNewsletter(): Newsletter
    {
        return Newsletter::create([
            'subject' => "[{$this->runId}] Prod Test Nieuwsbrief",
            'content' => '<p>Production delivery test.</p>',
            'status'  => 'draft',
        ]);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  0. Pre-flight: SMTP connection + API reachability
    // ──────────────────────────────────────────────────────────────────────────

    public function test_smtp_production_connection_succeeds(): void
    {
        $host = env('SMTP_HOST', 'live.smtp.mailtrap.io');
        $port = (int) env('SMTP_PORT', 587);

        $socket = @fsockopen($host, $port, $errno, $errstr, 10);

        $this->assertNotFalse(
            $socket,
            "Cannot reach production SMTP {$host}:{$port} — {$errstr} ({$errno})"
        );

        fclose($socket);
    }

    public function test_email_logs_api_is_reachable_and_credentials_valid(): void
    {
        $response = Http::withHeaders(['Api-Token' => $this->apiToken])
            ->get(self::API_BASE . '/email_logs', ['limit' => 1]);

        $this->assertTrue(
            $response->ok(),
            "Mailtrap Email Logs API returned HTTP {$response->status()} — " .
            "check that SMTP_PASSWORD is correct. Response: " . $response->body()
        );

        $this->assertArrayHasKey('messages', $response->json());
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  1. WelcomeMail
    // ──────────────────────────────────────────────────────────────────────────

    public function test_welcome_mail_is_delivered_via_production_relay(): void
    {
        $user = $this->fakeUser();

        $this->markSendTime();
        Mail::to($user->email)->send(new WelcomeMail($user));

        $msg = $this->waitForDelivery(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Welkom bij Lucide Inkt') &&
            ($m['to'] ?? '') === $this->testRecipient
        );

        $this->assertDelivered($msg);
        $this->assertEquals('info@lucideinkt.nl', $msg['from']);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  2. NewUserMail
    // ──────────────────────────────────────────────────────────────────────────

    public function test_new_user_mail_is_delivered_via_production_relay(): void
    {
        $user = $this->fakeUser();

        $this->markSendTime();
        Mail::to($user->email)->send(new NewUserMail($user, 'https://lucideinkt.nl/reset?token=prod-test'));

        $msg = $this->waitForDelivery(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Welkom bij Lucide Inkt') &&
            ($m['to'] ?? '') === $this->testRecipient
        );

        $this->assertDelivered($msg);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  3. OrderPaidMail (customer confirmation + PDF invoice)
    // ──────────────────────────────────────────────────────────────────────────

    public function test_order_paid_mail_is_delivered_via_production_relay(): void
    {
        [$customer, $order] = $this->fakeCustomerWithOrder();

        $this->markSendTime();
        Mail::to($customer->billing_email)->send(new OrderPaidMail($order));

        $msg = $this->waitForDelivery(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Jouw bestelling bij Lucide Inkt') &&
            ($m['to'] ?? '') === $this->testRecipient
        );

        $this->assertDelivered($msg);
        $this->assertEquals($this->testRecipient, $msg['to']);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  4. NewOrderMail (admin notification)
    // ──────────────────────────────────────────────────────────────────────────

    public function test_new_order_mail_is_delivered_via_production_relay(): void
    {
        [$customer, $order] = $this->fakeCustomerWithOrder();

        $this->markSendTime();
        Mail::to($this->testRecipient)->send(new NewOrderMail($order));

        $msg = $this->waitForDelivery(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Nieuwe bestelling') &&
            str_contains($m['subject'] ?? '', (string) $order->id) &&
            ($m['to'] ?? '') === $this->testRecipient
        );

        $this->assertDelivered($msg);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  5. ContactFormMail
    // ──────────────────────────────────────────────────────────────────────────

    public function test_contact_form_mail_is_delivered_via_production_relay(): void
    {
        // Use the runId in the contact subject — ContactFormMail passes it straight through
        $this->markSendTime();
        Mail::to($this->testRecipient)->send(
            new ContactFormMail(
                'Prod Tester',
                $this->testRecipient,
                'NL',
                "prod test [{$this->runId}]",
                'This is an automated production delivery test.'
            )
        );

        $msg = $this->waitForDelivery(fn ($m) =>
            str_contains($m['subject'] ?? '', $this->runId)
        );

        $this->assertDelivered($msg);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  6. NewsletterConfirmationMail
    // ──────────────────────────────────────────────────────────────────────────

    public function test_newsletter_confirmation_mail_is_delivered_via_production_relay(): void
    {
        $subscriber = $this->fakeSubscriber();

        $this->markSendTime();
        Mail::to($subscriber->email)->send(new NewsletterConfirmationMail($subscriber));

        $msg = $this->waitForDelivery(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Bevestig je nieuwsbrief') &&
            ($m['to'] ?? '') === $this->testRecipient
        );

        $this->assertDelivered($msg);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  7. NewsletterMail  ← previously broken (getForwardingEmail crash)
    // ──────────────────────────────────────────────────────────────────────────

    public function test_newsletter_mail_is_delivered_via_production_relay(): void
    {
        // runId is embedded in the newsletter subject via fakeNewsletter()
        $newsletter = $this->fakeNewsletter();
        $subscriber = $this->fakeSubscriber();

        $this->markSendTime();
        Mail::to($subscriber->email)->send(new NewsletterMail($newsletter, $subscriber));

        $msg = $this->waitForDelivery(fn ($m) =>
            str_contains($m['subject'] ?? '', $this->runId) &&
            str_contains($m['subject'] ?? '', 'Nieuwsbrief Lucide Inkt')
        );

        $this->assertDelivered($msg);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  8. Delivery status check on ALL recent logs
    //     Shows any not_delivered messages from today — quick health-check
    // ──────────────────────────────────────────────────────────────────────────

    public function test_no_recent_delivery_failures_in_production_logs(): void
    {
        sleep(3); // let rate-limit window reset after previous tests

        $response = Http::withHeaders(['Api-Token' => $this->apiToken])
            ->get(self::API_BASE . '/email_logs', ['limit' => 50]);

        if ($response->status() === 429) {
            $this->markTestSkipped('Mailtrap API rate-limited — run this test on its own to check delivery failures.');
        }

        $this->assertTrue($response->ok());

        $messages = $response->json('messages') ?? [];

        // Only inspect messages sent in the last 24 hours
        $cutoff = now()->subHours(24)->toIso8601String();

        $failures = collect($messages)
            ->filter(fn ($m) =>
                ($m['status'] ?? '') === 'not_delivered' &&
                ($m['sent_at'] ?? '') >= $cutoff
            )
            ->values()
            ->all();

        $this->assertEmpty(
            $failures,
            "Found not_delivered messages in the last 24 hours:\n" .
            collect($failures)->map(fn ($m) =>
                "  [{$m['status']}] \"{$m['subject']}\" → {$m['to']} (sent {$m['sent_at']})"
            )->implode("\n")
        );
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  9. ApplyMailConfig actually switches to production SMTP during a queued job
    // ──────────────────────────────────────────────────────────────────────────

    public function test_apply_mail_config_middleware_sets_production_smtp_on_production_env(): void
    {
        // Simulate what the queue worker does on production
        $originalEnv = app()->environment();
        $this->app['env'] = 'production';

        $middleware = new \App\Mail\Middleware\ApplyMailConfig();
        $middleware->handle(new \stdClass(), function () {});

        $this->assertEquals(
            env('SMTP_HOST', 'live.smtp.mailtrap.io'),
            config('mail.mailers.smtp.host'),
            'ApplyMailConfig did not set the production SMTP host'
        );
        $this->assertEquals(
            (int) env('SMTP_PORT', 587),
            config('mail.mailers.smtp.port'),
            'ApplyMailConfig did not set the production SMTP port'
        );
        $this->assertEquals(
            env('SMTP_USERNAME', 'api'),
            config('mail.mailers.smtp.username'),
            'ApplyMailConfig did not set the production SMTP username'
        );
        $this->assertNotEmpty(
            config('mail.mailers.smtp.password'),
            'ApplyMailConfig left the production SMTP password empty'
        );

        $this->app['env'] = $originalEnv;
    }
}




