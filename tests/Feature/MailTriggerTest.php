<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Livewire\Livewire;

use App\Livewire\ContactForm;
use App\Mail\ContactFormMail;
use App\Mail\NewsletterConfirmationMail;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use App\Notifications\CustomResetPasswordNotification;

/**
 * Trigger tests — goes through the real HTTP request / Livewire action path
 * and asserts the right email is queued to the right address.
 *
 * Nothing actually leaves the server; Mail is intercepted by Mail::fake().
 */
class MailTriggerTest extends TestCase
{
    use RefreshDatabase;

    // ──────────────────────────────────────────────────────────────────────────
    //  1. Newsletter subscribe endpoint → NewsletterConfirmationMail
    // ──────────────────────────────────────────────────────────────────────────

    public function test_new_subscriber_receives_confirmation_mail(): void
    {
        Mail::fake();

        $response = $this->post(route('newsletter.subscribe'), [
            'email' => 'nieuw@example.com',
        ]);

        $response->assertSessionHas('success');

        Mail::assertSent(NewsletterConfirmationMail::class, function ($mail) {
            return $mail->hasTo('nieuw@example.com');
        });
    }

    public function test_pending_subscriber_gets_confirmation_mail_resent(): void
    {
        Mail::fake();

        // Create an existing pending subscriber
        NewsletterSubscriber::create([
            'email'              => 'pending@example.com',
            'token'              => str_repeat('a', 32),
            'confirmation_token' => str_repeat('b', 64),
            'status'             => 'pending',
        ]);

        $response = $this->post(route('newsletter.subscribe'), [
            'email' => 'pending@example.com',
        ]);

        $response->assertSessionHas('info');

        Mail::assertSent(NewsletterConfirmationMail::class, function ($mail) {
            return $mail->hasTo('pending@example.com');
        });
    }

    public function test_unsubscribed_user_gets_confirmation_mail_on_resubscribe(): void
    {
        Mail::fake();

        NewsletterSubscriber::create([
            'email'  => 'terug@example.com',
            'token'  => str_repeat('c', 32),
            'status' => 'unsubscribed',
        ]);

        $response = $this->post(route('newsletter.subscribe'), [
            'email' => 'terug@example.com',
        ]);

        $response->assertSessionHas('success');

        Mail::assertSent(NewsletterConfirmationMail::class, function ($mail) {
            return $mail->hasTo('terug@example.com');
        });
    }

    public function test_already_subscribed_user_receives_no_mail(): void
    {
        Mail::fake();

        NewsletterSubscriber::create([
            'email'  => 'al@example.com',
            'token'  => str_repeat('d', 32),
            'status' => 'subscribed',
        ]);

        $response = $this->post(route('newsletter.subscribe'), [
            'email' => 'al@example.com',
        ]);

        $response->assertSessionHas('info'); // "already subscribed" message
        Mail::assertNothingSent();
    }

    public function test_subscribe_with_invalid_email_sends_no_mail(): void
    {
        Mail::fake();

        $this->post(route('newsletter.subscribe'), ['email' => 'not-an-email']);

        Mail::assertNothingSent();
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  2. Contact form (Livewire) → ContactFormMail
    // ──────────────────────────────────────────────────────────────────────────

    public function test_contact_form_submission_queues_mail_to_admin(): void
    {
        Mail::fake();

        config(['services.lucideinkt.admin_email' => 'lucideinkt@gmail.com']);

        Livewire::test(ContactForm::class)
            ->set('name', 'Karima Benali')
            ->set('email', 'karima@example.com')
            ->set('subject', 'Levering buitenland')
            ->set('message', 'Leveren jullie ook buiten Nederland?')
            ->call('submit')
            ->assertDispatched('contact-success');

        Mail::assertSent(ContactFormMail::class, function ($mail) {
            // hasTo() is safe here — set before sending via PendingMail::fill().
            // hasReplyTo() is NOT safe here — set only inside build(), which runs later.
            // replyTo correctness is already proven in MailTest::test_contact_form_mail_sets_reply_to_when_valid_email.
            return $mail->hasTo('lucideinkt@gmail.com');
        });
    }

    public function test_contact_form_with_missing_fields_sends_no_mail(): void
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', '')
            ->set('email', 'karima@example.com')
            ->set('subject', '')
            ->set('message', '')
            ->call('submit')
            ->assertHasErrors(['name', 'subject', 'message']);

        Mail::assertNothingSent();
    }

    public function test_contact_form_with_invalid_email_sends_no_mail(): void
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Test')
            ->set('email', 'not-valid')
            ->set('subject', 'Test')
            ->set('message', 'Some message here')
            ->call('submit')
            ->assertHasErrors(['email']);

        Mail::assertNothingSent();
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  3. Password reset request → CustomResetPasswordNotification
    // ──────────────────────────────────────────────────────────────────────────

    public function test_password_reset_link_queues_notification_for_existing_user(): void
    {
        Notification::fake();

        $user = User::factory()->create(['email' => 'reset@example.com']);

        $response = $this->post(route('password.email'), [
            'email' => 'reset@example.com',
        ]);

        $response->assertSessionHas('success');

        Notification::assertSentTo($user, CustomResetPasswordNotification::class);
    }

    public function test_password_reset_for_nonexistent_email_sends_no_notification(): void
    {
        Notification::fake();

        // Laravel silently succeeds to prevent email enumeration
        $response = $this->post(route('password.email'), [
            'email' => 'bestaat.niet@example.com',
        ]);

        $response->assertSessionHas('success'); // same message regardless
        Notification::assertNothingSent();
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  4. Newsletter confirmation link marks subscriber as subscribed
    // ──────────────────────────────────────────────────────────────────────────

    public function test_confirm_link_activates_subscriber(): void
    {
        $token = str_repeat('e', 64);

        $subscriber = NewsletterSubscriber::create([
            'email'              => 'bevestig@example.com',
            'token'              => str_repeat('f', 32),
            'confirmation_token' => $token,
            'status'             => 'pending',
        ]);

        $response = $this->get(route('newsletter.confirm', $token));

        $response->assertSuccessful();

        $this->assertTrue($subscriber->fresh()->isSubscribed());
        // Token is intentionally kept so the link remains valid for Outlook Safe Links
        // (Outlook pre-fetches confirmation URLs; nulling the token would cause a 404
        // when the user actually clicks the button).
        $this->assertNotNull($subscriber->fresh()->confirmation_token);
    }

    public function test_confirm_link_works_twice_for_outlook_safe_links(): void
    {
        // Outlook/Hotmail Safe Links pre-fetches the URL before the user clicks.
        // The first visit confirms the subscriber. The second visit (real user click)
        // must NOT return a 404 — it should show "already confirmed" with HTTP 200.
        $token = str_repeat('h', 64);

        NewsletterSubscriber::create([
            'email'              => 'outlook@example.com',
            'token'              => str_repeat('i', 32),
            'confirmation_token' => $token,
            'status'             => 'pending',
        ]);

        // First visit (Outlook scanner)
        $this->get(route('newsletter.confirm', $token))->assertSuccessful();

        // Second visit (real user click) — must not 404
        $this->get(route('newsletter.confirm', $token))->assertSuccessful();
    }

    // ──────────────────────────────────────────────────────────────────────────
    //  5. Unsubscribe link marks subscriber as unsubscribed
    // ──────────────────────────────────────────────────────────────────────────

    public function test_unsubscribe_link_deactivates_subscriber(): void
    {
        $token = str_repeat('g', 32);

        $subscriber = NewsletterSubscriber::create([
            'email'  => 'uitschrijf@example.com',
            'token'  => $token,
            'status' => 'subscribed',
        ]);

        $response = $this->get(route('newsletter.unsubscribe', $token));

        $response->assertSuccessful();
        $this->assertFalse($subscriber->fresh()->isSubscribed());
    }
}


