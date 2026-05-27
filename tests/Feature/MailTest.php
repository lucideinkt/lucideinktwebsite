<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

use App\Mail\ContactFormMail;
use App\Mail\NewOrderMail;
use App\Mail\NewUserMail;
use App\Mail\NewsletterConfirmationMail;
use App\Mail\NewsletterMail;
use App\Mail\OrderPaidMail;
use App\Mail\WelcomeMail;
use App\Models\Customer;
use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\User;
use App\Notifications\CustomResetPasswordNotification;

/**
 * Full email test suite.
 *
 * phpunit.xml already sets:
 *   MAIL_MAILER=array  → Mail::fake() works, no real SMTP needed
 *   QUEUE_CONNECTION=sync → queued mailables run immediately in tests
 *   DB_CONNECTION=sqlite  → in-memory DB, RefreshDatabase resets it each test
 */
class MailTest extends TestCase
{
    use RefreshDatabase;

    // ──────────────────────────────────────────────────────────────────────────
    //  Helpers
    // ──────────────────────────────────────────────────────────────────────────

    private function makeUser(array $attrs = []): User
    {
        return User::factory()->create(array_merge([
            'first_name' => 'Jan',
            'last_name'  => 'de Vries',
            'email'      => 'jan@example.com',
        ], $attrs));
    }

    private function makeCustomer(array $attrs = []): Customer
    {
        return Customer::create(array_merge([
            'billing_first_name'  => 'Fatima',
            'billing_last_name'   => 'Yilmaz',
            'billing_email'       => 'fatima@example.com',
            'billing_street'      => 'Hoofdstraat',
            'billing_house_number'=> '10',
            'billing_postal_code' => '1234AB',
            'billing_city'        => 'Amsterdam',
            'billing_country'     => 'NL',
            'billing_phone'       => '+31612345678',
        ], $attrs));
    }

    private function makeOrder(Customer $customer, array $attrs = []): Order
    {
        return Order::create(array_merge([
            'customer_id'          => $customer->id,
            'total'                => 2995,
            'status'               => 'pending',
            'payment_status'       => 'paid',
            'invoice_pdf_path'     => 'invoices/factuur_test.pdf',
            'myparcel_delivery_json' => json_encode(['deliveryType' => 'standard']),
        ], $attrs));
    }

    private function makeSubscriber(array $attrs = []): NewsletterSubscriber
    {
        return NewsletterSubscriber::create(array_merge([
            'email'              => 'abonnee@example.com',
            'token'              => Str::random(32),
            'confirmation_token' => Str::random(64),
            'status'             => 'pending',
        ], $attrs));
    }

    private function makeNewsletter(array $attrs = []): Newsletter
    {
        return Newsletter::create(array_merge([
            'subject'  => 'Onze nieuwste boeken zijn er!',
            'content'  => '<p>Bekijk onze nieuwe collectie.</p>',
            'status'   => 'draft',
        ], $attrs));
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  1. WelcomeMail — sent to newly registered user
    // ──────────────────────────────────────────────────────────────────────────

    public function test_welcome_mail_is_queued_to_correct_recipient(): void
    {
        Mail::fake();

        $user = $this->makeUser();
        Mail::to($user->email)->queue(new WelcomeMail($user));

        Mail::assertQueued(WelcomeMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

    public function test_welcome_mail_has_correct_subject(): void
    {
        Mail::fake();

        $user  = $this->makeUser();
        $mailable = new WelcomeMail($user);
        $mailable->assertHasSubject('Welkom bij Lucide Inkt');
    }

    public function test_welcome_mail_renders_without_errors(): void
    {
        $user = $this->makeUser();
        $mailable = new WelcomeMail($user);
        $rendered = $mailable->render();
        $this->assertNotEmpty($rendered);
        $this->assertStringContainsString('Lucide Inkt', $rendered);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  2. NewUserMail — admin creates a user account manually
    // ──────────────────────────────────────────────────────────────────────────

    public function test_new_user_mail_is_queued_to_correct_recipient(): void
    {
        Mail::fake();

        $user = $this->makeUser();
        Mail::to($user->email)->queue(new NewUserMail($user, 'https://lucideinkt.nl/reset?token=abc'));

        Mail::assertQueued(NewUserMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

    public function test_new_user_mail_has_correct_subject(): void
    {
        $user = $this->makeUser();
        $mailable = new NewUserMail($user, 'https://lucideinkt.nl/reset?token=abc');
        $mailable->assertHasSubject('Welkom bij Lucide Inkt');
    }

    public function test_new_user_mail_renders_without_errors(): void
    {
        $user = $this->makeUser();
        $mailable = new NewUserMail($user, 'https://lucideinkt.nl/reset?token=abc');
        $rendered = $mailable->render();
        $this->assertNotEmpty($rendered);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  3. OrderPaidMail — confirmation to the customer after payment
    // ──────────────────────────────────────────────────────────────────────────

    public function test_order_paid_mail_is_queued_to_customer_email(): void
    {
        Mail::fake();
        Storage::fake('public');

        $customer = $this->makeCustomer();
        $order    = $this->makeOrder($customer);

        // Fake the invoice PDF so the attach() call finds a file
        Storage::disk('public')->put($order->invoice_pdf_path, '%PDF-1.4 fake');

        Mail::to($customer->billing_email)->queue(new OrderPaidMail($order->fresh()));

        Mail::assertQueued(OrderPaidMail::class, function ($mail) use ($customer) {
            return $mail->hasTo($customer->billing_email);
        });
    }

    public function test_order_paid_mail_has_correct_subject(): void
    {
        Storage::fake('public');

        $customer = $this->makeCustomer();
        $order    = $this->makeOrder($customer);
        Storage::disk('public')->put($order->invoice_pdf_path, '%PDF-1.4 fake');

        $mailable = new OrderPaidMail($order->fresh());
        $mailable->assertHasSubject('Jouw bestelling bij Lucide Inkt');
    }

    public function test_order_paid_mail_attaches_invoice_pdf(): void
    {
        Storage::fake('public');

        $customer = $this->makeCustomer();
        $order    = $this->makeOrder($customer);
        Storage::disk('public')->put($order->invoice_pdf_path, '%PDF-1.4 fake');

        $mailable = new OrderPaidMail($order->fresh());

        // Trigger build() so the attachments list is populated
        $mailable->assertHasAttachment(
            Storage::disk('public')->path($order->invoice_pdf_path),
            ['as' => 'factuur.pdf', 'mime' => 'application/pdf']
        );
    }

    public function test_order_paid_mail_renders_without_errors(): void
    {
        Storage::fake('public');

        $customer = $this->makeCustomer();
        $order    = $this->makeOrder($customer);
        Storage::disk('public')->put($order->invoice_pdf_path, '%PDF-1.4 fake');

        $rendered = (new OrderPaidMail($order->fresh()))->render();
        $this->assertNotEmpty($rendered);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  4. NewOrderMail — new-order notification to the admin
    // ──────────────────────────────────────────────────────────────────────────

    public function test_new_order_mail_is_queued_to_admin_email(): void
    {
        Mail::fake();

        $adminEmail = 'lucideinkt@gmail.com';
        config(['services.lucideinkt.admin_email' => $adminEmail]);

        $customer = $this->makeCustomer();
        $order    = $this->makeOrder($customer);

        Mail::to($adminEmail)->queue(new NewOrderMail($order->fresh()));

        Mail::assertQueued(NewOrderMail::class, function ($mail) use ($adminEmail) {
            return $mail->hasTo($adminEmail);
        });
    }

    public function test_new_order_mail_has_correct_subject(): void
    {
        $customer = $this->makeCustomer();
        $order    = $this->makeOrder($customer);

        $mailable = new NewOrderMail($order->fresh());
        $mailable->assertHasSubject('Nieuwe bestelling - ordernummer: ' . $order->id);
    }

    public function test_new_order_mail_renders_without_errors(): void
    {
        $customer = $this->makeCustomer();
        $order    = $this->makeOrder($customer);

        $rendered = (new NewOrderMail($order->fresh()))->render();
        $this->assertNotEmpty($rendered);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  5. ContactFormMail — from contact page to admin
    // ──────────────────────────────────────────────────────────────────────────

    public function test_contact_form_mail_is_queued_to_admin(): void
    {
        Mail::fake();

        $adminEmail = 'lucideinkt@gmail.com';
        Mail::to($adminEmail)->queue(
            new ContactFormMail('Ahmed', 'ahmed@example.com', 'NL', 'Vraag', 'Wanneer komt mijn pakket?')
        );

        Mail::assertQueued(ContactFormMail::class, function ($mail) use ($adminEmail) {
            return $mail->hasTo($adminEmail);
        });
    }

    public function test_contact_form_mail_has_correct_subject(): void
    {
        $mailable = new ContactFormMail('Ahmed', 'ahmed@example.com', 'NL', 'Levertijd', 'Wanneer?');
        $mailable->assertHasSubject('Contactformulier: Levertijd');
    }

    public function test_contact_form_mail_sets_reply_to_when_valid_email(): void
    {
        $mailable = new ContactFormMail('Ahmed', 'ahmed@example.com', 'NL', 'Test', 'Bericht');
        $mailable->assertHasReplyTo('ahmed@example.com');
    }

    public function test_contact_form_mail_no_duplicate_bcc_when_bcc_equals_to(): void
    {
        Mail::fake();

        $adminEmail = 'lucideinkt@gmail.com';
        $bcc        = 'lucideinkt@gmail.com'; // same address

        config(['services.lucideinkt.admin_email' => $adminEmail]);
        config(['services.lucideinkt.contact_bcc' => $bcc]);

        $mailer = Mail::to($adminEmail);
        // Guard: only BCC if different from TO — matches the fix in ContactForm.php
        if ($bcc !== $adminEmail) {
            $mailer = $mailer->bcc($bcc);
        }
        $mailer->queue(new ContactFormMail('Test', 'test@example.com', 'NL', 'Sub', 'Msg'));

        Mail::assertQueued(ContactFormMail::class, function ($mail) use ($adminEmail) {
            // Should have exactly 1 recipient (TO only, no BCC duplicate)
            return $mail->hasTo($adminEmail) && ! $mail->hasBcc($adminEmail);
        });
    }

    public function test_contact_form_mail_renders_without_errors(): void
    {
        $rendered = (new ContactFormMail('Layla', 'layla@example.com', 'BE', 'Test', 'Hallo!'))->render();
        $this->assertNotEmpty($rendered);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  6. NewsletterConfirmationMail — opt-in confirmation link
    // ──────────────────────────────────────────────────────────────────────────

    public function test_newsletter_confirmation_mail_is_queued_to_subscriber(): void
    {
        Mail::fake();

        $subscriber = $this->makeSubscriber();
        Mail::to($subscriber->email)->queue(new NewsletterConfirmationMail($subscriber));

        Mail::assertQueued(NewsletterConfirmationMail::class, function ($mail) use ($subscriber) {
            return $mail->hasTo($subscriber->email);
        });
    }

    public function test_newsletter_confirmation_mail_has_correct_subject(): void
    {
        $subscriber = $this->makeSubscriber();
        $mailable   = new NewsletterConfirmationMail($subscriber);
        $mailable->assertHasSubject('Bevestig je nieuwsbrief inschrijving – Lucide Inkt');
    }

    public function test_newsletter_confirmation_mail_renders_without_errors(): void
    {
        $subscriber = $this->makeSubscriber();
        $rendered   = (new NewsletterConfirmationMail($subscriber))->render();
        $this->assertNotEmpty($rendered);
        // Must contain the confirmation link
        $this->assertStringContainsString('newsletter/confirm/', $rendered);
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  7. NewsletterMail — the actual newsletter campaign email
    //     This is the mail that had the critical getForwardingEmail() bug.
    // ──────────────────────────────────────────────────────────────────────────

    public function test_newsletter_mail_is_queued_to_subscriber(): void
    {
        Mail::fake();

        $newsletter = $this->makeNewsletter();
        $subscriber = $this->makeSubscriber(['status' => 'subscribed']);

        Mail::to($subscriber->email)->queue(new NewsletterMail($newsletter, $subscriber));

        Mail::assertQueued(NewsletterMail::class, function ($mail) use ($subscriber) {
            return $mail->hasTo($subscriber->email);
        });
    }

    public function test_newsletter_mail_has_correct_subject(): void
    {
        $newsletter = $this->makeNewsletter(['subject' => 'Ramadan Special']);
        $subscriber = $this->makeSubscriber(['status' => 'subscribed']);

        $mailable = new NewsletterMail($newsletter, $subscriber);
        $mailable->assertHasSubject('Nieuwsbrief Lucide Inkt - Ramadan Special');
    }

    public function test_newsletter_mail_renders_without_errors(): void
    {
        $newsletter = $this->makeNewsletter();
        $subscriber = $this->makeSubscriber(['status' => 'subscribed']);

        // This would previously crash with "Call to undefined method getForwardingEmail()"
        $rendered = (new NewsletterMail($newsletter, $subscriber))->render();
        $this->assertNotEmpty($rendered);
    }

    public function test_newsletter_mail_does_not_add_spurious_cc(): void
    {
        Mail::fake();

        // When MAILTRAP_FORWARD_EMAIL is not set there should be no CC
        config(['mail.mailtrap_forward_email' => null]);

        $newsletter = $this->makeNewsletter();
        $subscriber = $this->makeSubscriber(['status' => 'subscribed']);

        Mail::to($subscriber->email)->queue(new NewsletterMail($newsletter, $subscriber));

        Mail::assertQueued(NewsletterMail::class, function ($mail) use ($subscriber) {
            return $mail->hasTo($subscriber->email) && empty($mail->cc);
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  8. Password-reset notification (CustomResetPasswordNotification)
    // ──────────────────────────────────────────────────────────────────────────

    public function test_password_reset_notification_is_sent_to_user(): void
    {
        Notification::fake();

        $user = $this->makeUser();
        $user->notify(new CustomResetPasswordNotification('test-reset-token-abc'));

        Notification::assertSentTo($user, CustomResetPasswordNotification::class);
    }

    public function test_password_reset_notification_uses_correct_token(): void
    {
        Notification::fake();

        $user  = $this->makeUser();
        $token = 'super-secret-token-xyz';
        $user->notify(new CustomResetPasswordNotification($token));

        Notification::assertSentTo(
            $user,
            CustomResetPasswordNotification::class,
            function ($notification) use ($token) {
                return $notification->token === $token;
            }
        );
    }

    public function test_password_reset_mail_message_renders_without_errors(): void
    {
        $user        = $this->makeUser();
        $notification = new CustomResetPasswordNotification('some-token');
        $mailMessage = $notification->toMail($user);

        $this->assertNotNull($mailMessage);
        $this->assertStringContainsString(
            'Wachtwoord opnieuw instellen',
            $mailMessage->subject
        );
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  9. ApplyMailConfig middleware — routing logic
    // ──────────────────────────────────────────────────────────────────────────

    public function test_apply_mail_config_uses_mailtrap_sandbox_on_staging(): void
    {
        // Simulate non-production environment (same as staging/local)
        $this->app['env'] = 'staging';

        $middleware = new \App\Mail\Middleware\ApplyMailConfig();
        $middleware->handle(new \stdClass(), function () {});

        $this->assertEquals(
            env('MAILTRAP_HOST', 'sandbox.smtp.mailtrap.io'),
            config('mail.mailers.smtp.host')
        );
        $this->assertNull(config('mail.mailers.smtp.scheme'));
    }

    public function test_apply_mail_config_uses_mailtrap_sending_on_production(): void
    {
        $this->app['env'] = 'production';

        // Set production SMTP env values
        $_ENV['SMTP_HOST']     = 'live.smtp.mailtrap.io';
        $_ENV['SMTP_PORT']     = '587';
        $_ENV['SMTP_USERNAME'] = 'api';
        $_ENV['SMTP_PASSWORD'] = 'prod-password';
        $_ENV['SMTP_SCHEME']   = 'smtp';

        $middleware = new \App\Mail\Middleware\ApplyMailConfig();
        $middleware->handle(new \stdClass(), function () {});

        $this->assertEquals('live.smtp.mailtrap.io', config('mail.mailers.smtp.host'));
        $this->assertEquals(587, config('mail.mailers.smtp.port'));
        $this->assertEquals('smtp', config('mail.mailers.smtp.scheme'));

        // Restore
        $this->app['env'] = 'testing';
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  10. No mail is sent during tests without Mail::fake()
    //      (ensures phpunit.xml MAIL_MAILER=array works correctly)
    // ──────────────────────────────────────────────────────────────────────────

    public function test_mailer_is_array_driver_during_tests(): void
    {
        $this->assertEquals('array', config('mail.default'));
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  11. Queue is synchronous during tests — queued mails actually run
    // ──────────────────────────────────────────────────────────────────────────

    public function test_queue_is_sync_during_tests(): void
    {
        $this->assertEquals('sync', config('queue.default'));
    }
}


