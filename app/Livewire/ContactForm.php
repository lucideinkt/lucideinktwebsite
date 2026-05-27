<?php

namespace App\Livewire;

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $country = '';
    public $subject = '';
    public $message = '';
    public $success = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'De naam is verplicht.',
            'name.string' => 'De naam moet tekst zijn.',
            'name.max' => 'De naam mag maximaal 255 tekens bevatten.',
            'email.required' => 'Het e-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'email.max' => 'Het e-mailadres mag maximaal 255 tekens bevatten.',
            'subject.required' => 'Het onderwerp is verplicht.',
            'subject.string' => 'Het onderwerp moet tekst zijn.',
            'subject.max' => 'Het onderwerp mag maximaal 255 tekens bevatten.',
            'message.required' => 'Het bericht is verplicht.',
            'message.string' => 'Het bericht moet tekst zijn.',
            'message.max' => 'Het bericht mag maximaal 5000 tekens bevatten.',
        ];
    }

    public function submit()
    {
        $this->validate();


        try {
            // Use LUCIDE_INKT_MAIL for contact form (same as admin email for orders)
            // Fallback to MAIL_FROM_ADDRESS, then to info@lucideinkt.nl
            $recipientEmail = config('services.lucideinkt.admin_email')
                ?: config('mail.from.address')
                ?: 'info@lucideinkt.nl';

            if (empty($recipientEmail)) {
                throw new \Exception('E-mail adres is niet geconfigureerd. Controleer LUCIDE_INKT_MAIL of MAIL_FROM_ADDRESS in .env');
            }

            Mail::to($recipientEmail)
                ->when(
                    config('services.lucideinkt.contact_bcc'),
                    fn ($mail) => $mail->bcc(config('services.lucideinkt.contact_bcc'))
                )
                ->queue(
                    new ContactFormMail(
                        $this->name,
                        $this->email,
                        $this->country,
                        $this->subject,
                        $this->message
                    )
                );

            $this->success = true;
            $this->reset(['name', 'email', 'country', 'subject', 'message']);

            $this->dispatch('contact-success', message: 'Bedankt! Jouw bericht is verzonden. We nemen zo spoedig mogelijk contact met je op.');
        } catch (\Throwable $e) {
            Log::error('Contact form error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'name' => $this->name,
                'email' => $this->email,
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
                'mail_encryption' => config('mail.mailers.smtp.encryption'),
            ]);
            $this->dispatch('contact-error', message: 'Verzenden mislukt: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
