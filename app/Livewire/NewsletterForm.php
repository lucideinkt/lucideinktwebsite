<?php

namespace App\Livewire;

use App\Mail\NewsletterConfirmationMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class NewsletterForm extends Component
{
    public $email = '';
    public $consent = false;
    public $statusMessage = '';
    public $statusType = ''; // 'success', 'info', 'error'

    protected $rules = [
        'email'   => 'required|email|max:255',
        'consent' => 'accepted',
    ];

    protected $messages = [
        'email.required'   => 'E-mailadres is verplicht.',
        'email.email'      => 'Voer een geldig e-mailadres in.',
        'email.max'        => 'E-mailadres mag maximaal 255 tekens zijn.',
        'consent.accepted' => 'Je moet akkoord gaan om je in te schrijven.',
    ];

    public function submit()
    {
        $this->validate();

        $existing = NewsletterSubscriber::where('email', $this->email)->first();

        if ($existing) {
            if ($existing->isSubscribed()) {
                $this->statusMessage = 'Dit e-mailadres is al ingeschreven voor onze nieuwsbrief.';
                $this->statusType = 'info';
                return;
            } elseif ($existing->isPending()) {
                // Already sent – don't resend to prevent spam
                $this->statusMessage = 'Er is al een bevestigingsmail verstuurd. Controleer je inbox (en spammap).';
                $this->statusType = 'info';
                return;
            } else {
                // Was unsubscribed – re-initiate with confirmation (one mail only)
                $confirmationToken = NewsletterSubscriber::generateConfirmationToken();
                $existing->update([
                    'status' => 'pending',
                    'confirmation_token' => $confirmationToken,
                ]);
                Mail::to($existing->email)->send(new NewsletterConfirmationMail($existing->fresh()));
                $this->statusMessage = 'Welkom terug! Controleer je inbox om je inschrijving te bevestigen.';
                $this->statusType = 'success';
                $this->reset('email');
                return;
            }
        }

        // New subscriber – pending confirmation
        $confirmationToken = NewsletterSubscriber::generateConfirmationToken();

        $subscriber = NewsletterSubscriber::create([
            'email' => $this->email,
            'status' => 'pending',
            'confirmation_token' => $confirmationToken,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        Mail::to($subscriber->email)->send(new NewsletterConfirmationMail($subscriber));

        $this->statusMessage = 'Bedankt! Controleer je inbox en bevestig je inschrijving via de link in de e-mail.';
        $this->statusType = 'success';
        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
