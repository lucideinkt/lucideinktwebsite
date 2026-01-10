<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $country;
    public $subject;
    public $messageText;

    public function __construct($name, $email, $country, $subject, $messageText)
    {
        $this->name = $name;
        $this->email = $email;
        $this->country = $country;
        $this->subject = $subject;
        $this->messageText = $messageText;
    }

    public function build()
    {
        $mail = $this->subject('Contactformulier: ' . $this->subject)
            ->view('emails.contact-form', [
                'name' => $this->name,
                'email' => $this->email,
                'country' => $this->country,
                'subject' => $this->subject,
                'messageText' => $this->messageText,
            ]);

        // Only set replyTo if email is valid
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $mail->replyTo($this->email, $this->name);
        }

        return $mail;
    }
}
