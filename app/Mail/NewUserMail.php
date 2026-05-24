<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\Traits\HasMailtrapForwarding;

class NewUserMail extends Mailable
{
  use Queueable, SerializesModels, HasMailtrapForwarding;

  public $user;
  public $resetUrl;

  public function __construct($user, $resetUrl)
  {
    $this->user = $user;
    $this->resetUrl = $resetUrl;
  }

  public function build()
  {
    $mail = $this->subject('Welkom bij Lucide Inkt')
      ->view('emails.new-user', ['user' => $this->user, 'resetUrl' => $this->resetUrl]);

    // Add Mailtrap forwarding using trait (tries config, env, and fallback)
    return $this->addMailtrapForwarding($mail);
  }

}
