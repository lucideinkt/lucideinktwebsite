<?php

namespace App\Mail;

use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Mail\Traits\HasMailtrapForwarding;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels, HasMailtrapForwarding;

    public $newsletter;
    public $subscriber;
    public $unsubscribeUrl;


    public function __construct(Newsletter $newsletter, NewsletterSubscriber $subscriber)
    {
        $this->newsletter = $newsletter;
        $this->subscriber = $subscriber;
        $this->unsubscribeUrl = route('newsletter.unsubscribe', $subscriber->token);
    }

    public function envelope(): Envelope
    {
        // Get forwarding email using the trait's helper method
        $forwardEmail = $this->getForwardingEmail();

        if ($forwardEmail && filter_var($forwardEmail, FILTER_VALIDATE_EMAIL)) {
            return new Envelope(
                subject: 'Nieuwsbrief Lucide Inkt - ' . $this->newsletter->subject,
                cc: [$forwardEmail]
            );
        }

        return new Envelope(
            subject: 'Nieuwsbrief Lucide Inkt - ' . $this->newsletter->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
