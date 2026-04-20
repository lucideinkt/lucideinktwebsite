<?php

namespace App\Mail;

use App\Mail\Traits\HasMailtrapForwarding;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterConfirmationMail extends Mailable
{
    use Queueable, SerializesModels, HasMailtrapForwarding;

    public NewsletterSubscriber $subscriber;
    public string $confirmUrl;

    public function __construct(NewsletterSubscriber $subscriber)
    {
        $this->subscriber = $subscriber;
        $this->confirmUrl = route('newsletter.confirm', $subscriber->confirmation_token);
    }

    public function build()
    {
        $mail = $this->subject('Bevestig je nieuwsbrief inschrijving – Lucide Inkt')
            ->view('emails.newsletter-confirmation');

        return $this->addMailtrapForwarding($mail);
    }
}

