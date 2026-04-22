<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\Traits\HasMailtrapForwarding;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels, HasMailtrapForwarding;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $mail = $this->subject('Welkom bij Lucide Inkt')
            ->view('emails.welcome', ['user' => $this->user]);

        // Add Mailtrap forwarding using trait (tries config, env, and fallback)
        return $this->addMailtrapForwarding($mail);
    }

}
