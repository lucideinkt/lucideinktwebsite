<?php

namespace App\Mail;

use App\Mail\Middleware\ApplyMailConfig;
use App\Mail\Traits\HasMailtrapForwarding;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterAdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels, HasMailtrapForwarding;

    public NewsletterSubscriber $subscriber;

    public function __construct(NewsletterSubscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function middleware(): array
    {
        return [new ApplyMailConfig()];
    }

    public function build()
    {
        ApplyMailConfig::apply();

        $mail = $this->subject('Nieuwe nieuwsbrief inschrijving – ' . $this->subscriber->email)
            ->view('emails.newsletter-admin-notification');

        return $this->addMailtrapForwarding($mail);
    }
}

