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
     * PUBLIC for testing purposes
     */
    public function getForwardingEmail(): ?string
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

    /**
     * Test method to verify forwarding email detection
     * Returns debug info about which method worked
     */
    public function testForwardingEmail(): array
    {
        $result = [
            'final_email' => null,
            'method_used' => null,
            'app_env' => app()->environment(),
            'config_value' => config('mail.mailtrap_forward_email'),
            'env_value' => env('MAILTRAP_FORWARD_EMAIL'),
            'hardcoded_fallback' => app()->environment('staging', 'local', 'development') ? 'lucideinkt@gmail.com' : null,
        ];

        // Try config
        if ($result['config_value'] && $result['config_value'] !== '') {
            $result['final_email'] = $result['config_value'];
            $result['method_used'] = 'config';
            return $result;
        }

        // Try env
        if ($result['env_value'] && $result['env_value'] !== '') {
            $result['final_email'] = $result['env_value'];
            $result['method_used'] = 'env';
            return $result;
        }

        // Try hardcoded
        if ($result['hardcoded_fallback']) {
            $result['final_email'] = $result['hardcoded_fallback'];
            $result['method_used'] = 'hardcoded';
            return $result;
        }

        $result['method_used'] = 'none';
        return $result;
    }
}


