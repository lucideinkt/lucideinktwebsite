<?php

namespace App\Livewire;

use App\Models\NewsletterSubscriber;
use Livewire\Component;

class NewsletterForm extends Component
{
    public $email = '';

    protected $rules = [
        'email' => 'required|email|max:255',
    ];

    protected $messages = [
        'email.required' => 'E-mailadres is verplicht.',
        'email.email' => 'Voer een geldig e-mailadres in.',
        'email.max' => 'E-mailadres mag maximaal 255 tekens zijn.',
    ];

    public function submit()
    {
        $this->validate();

        // Check if already subscribed
        $existing = NewsletterSubscriber::where('email', $this->email)->first();

        if ($existing) {
            if ($existing->isSubscribed()) {
                $this->dispatch('newsletter-info', message: 'Dit e-mailadres is al ingeschreven voor onze nieuwsbrief.');
                return;
            } else {
                // Resubscribe
                $existing->subscribe();
                $this->dispatch('newsletter-success', message: 'Welkom terug! U bent opnieuw ingeschreven voor onze nieuwsbrief.');
                $this->reset('email');
                return;
            }
        }

        // Create new subscriber
        NewsletterSubscriber::create([
            'email' => $this->email,
            'status' => 'subscribed',
            'subscribed_at' => now(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $this->dispatch('newsletter-success', message: 'Bedankt voor uw inschrijving! U ontvangt binnenkort updates van ons.');

        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
