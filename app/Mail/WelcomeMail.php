<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\Traits\HasMailtrapForwarding;
use App\Mail\Middleware\ApplyMailConfig;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels, HasMailtrapForwarding;

    public $user;

    public function middleware(): array
    {
        return [new ApplyMailConfig()];
    }

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        ApplyMailConfig::apply();

        $mail = $this->subject('Welkom bij Lucide Inkt')
            ->view('emails.welcome', ['user' => $this->user]);

        return $this->addMailtrapForwarding($mail);
    }

}
