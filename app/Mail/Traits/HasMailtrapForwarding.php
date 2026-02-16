<?php

namespace App\Mail\Traits;

trait HasMailtrapForwarding
{
    /**
     * Add Mailtrap forwarding email to CC if configured
     *
     * This method tries multiple ways to get the forwarding email:
     * 1. From config (best practice)
     * 2. From env (fallback for Cloudways cache issues)
     * 3. Hardcoded for staging (last resort)
     */
    protected function addMailtrapForwarding($mail)
    {
        // Try to get forwarding email from multiple sources
        $forwardEmail = $this->getForwardingEmail();

        if ($forwardEmail && filter_var($forwardEmail, FILTER_VALIDATE_EMAIL)) {
            $mail->cc($forwardEmail);
        }

        return $mail;
    }

    /**
     * Get forwarding email from config, env, or hardcoded fallback
     */
    protected function getForwardingEmail(): ?string
    {
        // Method 1: Try config (best practice)
        $email = config('mail.mailtrap_forward_email');
        if ($email && $email !== '') {
            return $email;
        }

        // Method 2: Try env directly (fallback for cache issues)
        $email = env('MAILTRAP_FORWARD_EMAIL');
        if ($email && $email !== '') {
            return $email;
        }

        // Method 3: Hardcoded for staging environment only (last resort)
        if (app()->environment('staging', 'local', 'development')) {
            return 'lucideinkt@gmail.com';
        }

        return null;
    }
}


