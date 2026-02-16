<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;

class NewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $delivery = json_decode( $this->order->myparcel_delivery_json, true);
        $pickupLocation = '';

        if (!empty($delivery['deliveryType']) && strtolower($delivery['deliveryType']) === 'pickup')
        {
            $pickupLocation = $delivery['pickup'] ?? $delivery['pickupLocation'] ?? null;
        }

        $mail = $this->subject('Nieuwe bestelling - ordernummer: ' . $this->order->id)
            ->view('emails.neworder',
                [
                    'order' => $this->order,
                    'delivery' =>  $delivery,
                    'pickupLocation' => $pickupLocation
                ]);

        // Add Mailtrap forwarding email to CC if configured
        $forwardEmail = config('mail.mailtrap_forward_email');
        if ($forwardEmail && filter_var($forwardEmail, FILTER_VALIDATE_EMAIL)) {
            $mail->cc($forwardEmail);
        }

        return $mail;
    }
}
