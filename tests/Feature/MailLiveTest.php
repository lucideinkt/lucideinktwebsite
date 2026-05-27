<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

/**
 * Live SMTP + Mailtrap Inbox API tests.
 *
 * These tests actually send real emails via Mailtrap Sandbox SMTP and then
 * verify receipt via the Mailtrap Inbox REST API.
 *
 * ─── HOW TO RUN ───────────────────────────────────────────────────────────────
 *
 * 1. Get your credentials from https://mailtrap.io:
 *    - API Token    → Profile → API Tokens → create one
 *    - Account ID   → shown in the URL when you open your account
 *                     e.g. https://mailtrap.io/inboxes → account_id in sidebar
 *    - Inbox ID     → click your sandbox inbox → Settings → Inbox ID
 *
 * 2. Add to your .env (NOT .env_test — these are for local runs only):
 *
 *      MAILTRAP_API_TOKEN=your_api_token_here
 *      MAILTRAP_ACCOUNT_ID=123456
 *      MAILTRAP_INBOX_ID=789012
 *
 * 3. Run ONLY this suite:
 *
 *      php artisan test tests/Feature/MailLiveTest.php
 *
 * All tests are automatically SKIPPED if the env vars above are missing.
 * ──────────────────────────────────────────────────────────────────────────────
 */
class MailLiveTest extends TestCase
{
    use RefreshDatabase;

    // ──────────────────────────────────────────────────────────────────────────
    //  Configuration
    // ──────────────────────────────────────────────────────────────────────────

    private string $apiToken;
    private string $accountId;
    private string $inboxId;
    private string $apiBase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiToken  = env('MAILTRAP_API_TOKEN', '');
        $this->accountId = env('MAILTRAP_ACCOUNT_ID', '');
        $this->inboxId   = env('MAILTRAP_INBOX_ID', '');

        if (! $this->apiToken || ! $this->accountId || ! $this->inboxId) {
            $this->markTestSkipped(
                'Live mail tests skipped — add MAILTRAP_API_TOKEN, MAILTRAP_ACCOUNT_ID ' .
                'and MAILTRAP_INBOX_ID to your .env to enable them.'
            );
        }

        $this->apiBase = "https://mailtrap.io/api/accounts/{$this->accountId}/inboxes/{$this->inboxId}";

        // Force the real SMTP mailer (override phpunit.xml MAIL_MAILER=array)
        config([
            'mail.default'                    => 'smtp',
            'mail.mailers.smtp.host'          => env('MAILTRAP_HOST', 'sandbox.smtp.mailtrap.io'),
            'mail.mailers.smtp.port'          => (int) env('MAILTRAP_PORT', 2525),
            'mail.mailers.smtp.username'      => env('MAILTRAP_USERNAME', env('MAIL_USERNAME')),
            'mail.mailers.smtp.password'      => env('MAILTRAP_PASSWORD', env('MAIL_PASSWORD')),
            'mail.mailers.smtp.scheme'        => null,
            'mail.from.address'               => 'info@lucideinkt.nl',
            'mail.from.name'                  => 'Lucide Inkt',
        ]);

        // Clean the inbox before each test so old messages don't interfere
        $this->cleanInbox();
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  Mailtrap API helpers
    // ──────────────────────────────────────────────────────────────────────────

    /** Delete all messages in the sandbox inbox */
    private function cleanInbox(): void
    {
        Http::withHeaders(['Api-Token' => $this->apiToken])
            ->patch("{$this->apiBase}/clean");
    }

    /**
     * Poll Mailtrap inbox until a message matching $predicate arrives,
     * or until the timeout (default 15 s) elapses.
     *
     * @param  callable $predicate  function(array $message): bool
     * @return array The matching message data
     */
    private function waitForMessage(callable $predicate, int $timeoutSeconds = 15): array
    {
        $start = time();

        while (time() - $start < $timeoutSeconds) {
            $response = Http::withHeaders(['Api-Token' => $this->apiToken])
                ->get("{$this->apiBase}/messages");

            $this->assertTrue($response->ok(), 'Mailtrap API request failed: ' . $response->body());

            $messages = $response->json();

            foreach ($messages as $message) {
                if ($predicate($message)) {
                    return $message;
                }
            }

            sleep(1); // wait 1 s and retry
        }

        $this->fail("No matching message arrived in Mailtrap inbox within {$timeoutSeconds} seconds.");
    }

    /** Fetch the full HTML body of a message */
    private function getMessageBody(string $messageId): string
    {
        $response = Http::withHeaders(['Api-Token' => $this->apiToken])
            ->get("{$this->apiBase}/messages/{$messageId}/body.html");

        return $response->body();
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  Model helpers (same as MailTest, but without RefreshDatabase isolation)
    // ──────────────────────────────────────────────────────────────────────────

    private function makeUser(): User
    {
        return User::factory()->create([
            'first_name' => 'Live',
            'last_name'  => 'Testgebruiker',
            'email'      => 'live-test@lucideinkt.test',
        ]);
    }

    private function makeCustomerAndOrder(): array
    {
        Storage::fake('public');

        $customer = Customer::create([
            'billing_first_name'   => 'Live',
            'billing_last_name'    => 'Klant',
            'billing_email'        => 'live-klant@lucideinkt.test',
            'billing_street'       => 'Teststraat',
            'billing_house_number' => '1',
            'billing_postal_code'  => '1234AB',
            'billing_city'         => 'Amsterdam',
            'billing_country'      => 'NL',
            'billing_phone'        => '+31611111111',
        ]);

        $order = Order::create([
            'customer_id'            => $customer->id,
            'total'                  => 2995,
            'status'                 => 'pending',
            'payment_status'         => 'paid',
            'invoice_pdf_path'       => 'invoices/factuur_live_test.pdf',
            'myparcel_delivery_json' => json_encode(['deliveryType' => 'standard']),
        ]);

        Storage::disk('public')->put($order->invoice_pdf_path, '%PDF-1.4 fake invoice');

        return [$customer, $order->fresh()];
    }

    private function makeSubscriber(): NewsletterSubscriber
    {
        return NewsletterSubscriber::create([
            'email'              => 'live-abonnee@lucideinkt.test',
            'token'              => Str::random(32),
            'confirmation_token' => Str::random(64),
            'status'             => 'subscribed',
        ]);
    }

    private function makeNewsletter(): Newsletter
    {
        return Newsletter::create([
            'subject' => 'Live Test Nieuwsbrief',
            'content' => '<p>Dit is een live test.</p>',
            'status'  => 'draft',
        ]);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  Live tests
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Test 1: WelcomeMail
     * Send → receive in Mailtrap → verify subject & recipient
     */
    public function test_welcome_mail_actually_arrives_in_inbox(): void
    {
        $user = $this->makeUser();

        Mail::to($user->email)->send(new WelcomeMail($user));

        $msg = $this->waitForMessage(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Welkom bij Lucide Inkt')
        );

        $this->assertStringContainsString('Welkom bij Lucide Inkt', $msg['subject']);
        $this->assertEquals($user->email, $msg['to_email'] ?? $msg['recipient'] ?? '');
        $this->assertEquals('info@lucideinkt.nl', $msg['from_email'] ?? '');
    }

    /**
     * Test 2: NewUserMail
     * Sent when admin creates a user account manually
     */
    public function test_new_user_mail_actually_arrives_in_inbox(): void
    {
        $user = $this->makeUser();
        $url  = 'https://lucideinkt.nl/reset?token=live-test-token';

        Mail::to($user->email)->send(new NewUserMail($user, $url));

        $msg = $this->waitForMessage(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Welkom bij Lucide Inkt')
        );

        // Verify the reset URL is in the body
        $body = $this->getMessageBody($msg['id']);
        $this->assertStringContainsString('live-test-token', $body);
    }

    /**
     * Test 3: OrderPaidMail
     * Customer confirmation with PDF attachment
     */
    public function test_order_paid_mail_actually_arrives_with_attachment(): void
    {
        [$customer, $order] = $this->makeCustomerAndOrder();

        Mail::to($customer->billing_email)->send(new OrderPaidMail($order));

        $msg = $this->waitForMessage(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Jouw bestelling bij Lucide Inkt')
        );

        $this->assertStringContainsString('Jouw bestelling bij Lucide Inkt', $msg['subject']);
        $this->assertEquals($customer->billing_email, $msg['to_email'] ?? $msg['recipient'] ?? '');

        // Verify PDF attachment
        $attachments = $msg['attachments'] ?? [];
        $this->assertNotEmpty($attachments, 'Expected invoice PDF attachment');

        $pdf = collect($attachments)->first(fn ($a) => str_contains($a['filename'] ?? '', 'factuur'));
        $this->assertNotNull($pdf, 'Invoice attachment "factuur.pdf" not found');
    }

    /**
     * Test 4: NewOrderMail
     * Admin notification for new order
     */
    public function test_new_order_mail_actually_arrives_in_inbox(): void
    {
        $adminEmail = env('LUCIDE_INKT_MAIL', 'lucideinkt@gmail.com');
        [$customer, $order] = $this->makeCustomerAndOrder();

        Mail::to($adminEmail)->send(new NewOrderMail($order));

        $msg = $this->waitForMessage(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Nieuwe bestelling')
        );

        $this->assertStringContainsString('Nieuwe bestelling', $msg['subject']);
        $this->assertStringContainsString((string) $order->id, $msg['subject']);
    }

    /**
     * Test 5: ContactFormMail
     * Message from the contact page, reply-to is the visitor
     */
    public function test_contact_form_mail_actually_arrives_in_inbox(): void
    {
        $adminEmail = env('LUCIDE_INKT_MAIL', 'lucideinkt@gmail.com');

        Mail::to($adminEmail)->send(
            new ContactFormMail('Layla Test', 'layla@example.com', 'NL', 'Live Test Vraag', 'Hallo, dit is een live test bericht.')
        );

        $msg = $this->waitForMessage(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Live Test Vraag')
        );

        $this->assertStringContainsString('Contactformulier', $msg['subject']);

        // reply-to should be the visitor's email
        $replyTo = $msg['reply_to_email'] ?? $msg['reply_to'] ?? '';
        $this->assertStringContainsString('layla@example.com', $replyTo);

        // Body should contain the message
        $body = $this->getMessageBody($msg['id']);
        $this->assertStringContainsString('live test bericht', $body);
    }

    /**
     * Test 6: NewsletterConfirmationMail
     * Must contain a working confirm URL
     */
    public function test_newsletter_confirmation_mail_actually_arrives_in_inbox(): void
    {
        $subscriber = $this->makeSubscriber();

        Mail::to($subscriber->email)->send(new NewsletterConfirmationMail($subscriber));

        $msg = $this->waitForMessage(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Bevestig je nieuwsbrief')
        );

        $this->assertStringContainsString('Bevestig je nieuwsbrief', $msg['subject']);

        $body = $this->getMessageBody($msg['id']);
        $this->assertStringContainsString('newsletter/confirm/', $body);
    }

    /**
     * Test 7: NewsletterMail
     * The campaign email — this is the one that previously crashed with getForwardingEmail()
     */
    public function test_newsletter_mail_actually_arrives_in_inbox(): void
    {
        $newsletter = $this->makeNewsletter();
        $subscriber = $this->makeSubscriber();

        Mail::to($subscriber->email)->send(new NewsletterMail($newsletter, $subscriber));

        $msg = $this->waitForMessage(fn ($m) =>
            str_contains($m['subject'] ?? '', 'Live Test Nieuwsbrief')
        );

        $this->assertStringContainsString('Nieuwsbrief Lucide Inkt', $msg['subject']);
        $this->assertStringContainsString('Live Test Nieuwsbrief', $msg['subject']);

        // Unsubscribe link must be in the body
        $body = $this->getMessageBody($msg['id']);
        $this->assertStringContainsString('newsletter/unsubscribe/', $body);
    }

    /**
     * Test 8: SMTP connection check
     * Verifies the raw SMTP handshake works without sending a full mail
     */
    public function test_smtp_connection_to_mailtrap_sandbox_succeeds(): void
    {
        $host     = env('MAILTRAP_HOST', 'sandbox.smtp.mailtrap.io');
        $port     = (int) env('MAILTRAP_PORT', 2525);
        $username = env('MAILTRAP_USERNAME', env('MAIL_USERNAME'));
        $password = env('MAILTRAP_PASSWORD', env('MAIL_PASSWORD'));

        $socket = @fsockopen($host, $port, $errno, $errstr, 10);

        $this->assertNotFalse(
            $socket,
            "Cannot connect to SMTP {$host}:{$port} — {$errstr} ({$errno})"
        );

        fclose($socket);
    }

    /**
     * Test 9: Mailtrap API is reachable and credentials are valid
     */
    public function test_mailtrap_api_credentials_are_valid(): void
    {
        $response = Http::withHeaders(['Api-Token' => $this->apiToken])
            ->get("{$this->apiBase}/messages");

        $this->assertTrue(
            $response->ok(),
            "Mailtrap API returned HTTP {$response->status()} — check MAILTRAP_API_TOKEN, " .
            "MAILTRAP_ACCOUNT_ID and MAILTRAP_INBOX_ID in your .env"
        );
    }
}

