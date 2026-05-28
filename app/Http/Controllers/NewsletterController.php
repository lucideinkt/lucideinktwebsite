<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterAdminNotificationMail;
use App\Mail\NewsletterConfirmationMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Voer alstublieft een geldig e-mailadres in.');
        }

        $email = $request->email;

        // Check if already subscribed
        $existing = NewsletterSubscriber::where('email', $email)->first();

        if ($existing) {
            if ($existing->isSubscribed()) {
                return back()->with('info', 'Dit e-mailadres is al ingeschreven voor onze nieuwsbrief.');
            } elseif ($existing->isPending()) {
                // Resend confirmation email
                Mail::to($existing->email)->send(new NewsletterConfirmationMail($existing));
                return back()->with('info', 'We hebben opnieuw een bevestigingsmail gestuurd. Controleer je inbox.');
            } else {
                // Resubscribe (was unsubscribed) - send confirmation again
                $confirmationToken = NewsletterSubscriber::generateConfirmationToken();
                $existing->update([
                    'status' => 'pending',
                    'confirmation_token' => $confirmationToken,
                ]);
                Mail::to($existing->email)->send(new NewsletterConfirmationMail($existing->fresh()));
                return back()->with('success', 'Welkom terug! Controleer je inbox om je inschrijving te bevestigen.');
            }
        }

        // Create new subscriber (pending confirmation)
        $confirmationToken = NewsletterSubscriber::generateConfirmationToken();

        $subscriber = NewsletterSubscriber::create([
            'email' => $email,
            'status' => 'pending',
            'confirmation_token' => $confirmationToken,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Send confirmation email
        Mail::to($subscriber->email)->send(new NewsletterConfirmationMail($subscriber));

        return back()->with('success', 'Bedankt! Controleer je inbox en bevestig je inschrijving via de link in de e-mail.
Geen e-mail ontvangen? Kijk ook in je spamfolder en markeer onze e-mail als ‘Geen spam’ of verplaats deze naar je inbox.');
    }

    public function confirm($token)
    {
        $subscriber = NewsletterSubscriber::where('confirmation_token', $token)->firstOrFail();

        $confirmed = false;

        if ($subscriber->isPending()) {
            $subscriber->confirm();
            $confirmed = true;

            // Notify Lucide Inkt admin of the new confirmed subscription
            $this->sendAdminNotification($subscriber->fresh());
        } elseif ($subscriber->isSubscribed()) {
            // Already confirmed (e.g. Outlook Safe Links pre-visited the link).
            // Show the success page so the user isn't confused.
            $confirmed = true;
        }

        return view('newsletter.confirm', compact('confirmed'));
    }

    private function sendAdminNotification(NewsletterSubscriber $subscriber): void
    {
        $adminEmail = config('services.lucideinkt.admin_email');

        if (!$adminEmail) {
            Log::warning('Admin email not configured (LUCIDE_INKT_MAIL missing) – newsletter admin notification not sent', [
                'subscriber_email' => $subscriber->email,
            ]);
            return;
        }

        try {
            $mailer = Mail::to($adminEmail);

            // BCC to Gmail so the notification also arrives in lucideinkt@gmail.com
            $bcc = config('services.lucideinkt.contact_bcc');
            if ($bcc && $bcc !== $adminEmail) {
                $mailer = $mailer->bcc($bcc);
            }

            $mailer->send(new NewsletterAdminNotificationMail($subscriber));
        } catch (\Throwable $e) {
            Log::error('Failed to send NewsletterAdminNotificationMail', [
                'subscriber_email' => $subscriber->email,
                'admin_email'      => $adminEmail,
                'error'            => $e->getMessage(),
            ]);
        }
    }

    public function unsubscribe($token)
    {
        $subscriber = NewsletterSubscriber::where('token', $token)->firstOrFail();

        if ($subscriber->isSubscribed()) {
            $subscriber->unsubscribe();
            $message = 'Je bent succesvol uitgeschreven van onze nieuwsbrief.';
        } else {
            $message = 'Je bent al uitgeschreven van onze nieuwsbrief.';
        }

        return view('newsletter.unsubscribe', compact('message'));
    }
}
