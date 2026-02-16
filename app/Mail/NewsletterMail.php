<?php

namespace App\Mail;

use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

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
        $envelope = new Envelope(
            subject: 'Nieuwsbrief Lucide Inkt - ' . $this->newsletter->subject,
        );

        // Add Mailtrap forwarding email to CC if configured
        $forwardEmail = env('MAILTRAP_FORWARD_EMAIL');
        if ($forwardEmail && filter_var($forwardEmail, FILTER_VALIDATE_EMAIL)) {
            $envelope->cc($forwardEmail);
        }

        return $envelope;
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
