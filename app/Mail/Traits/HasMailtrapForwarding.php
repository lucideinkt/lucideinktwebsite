<?php

namespace App\Mail\Traits;

use App\Services\SiteSettingService;

trait HasMailtrapForwarding
{
    /**
     * Add Mailtrap forwarding email to CC if configured AND Mailtrap is the active driver.
     */
    protected function addMailtrapForwarding($mail)
    {
        $forwardEmail = $this->getForwardingEmail();

        if ($forwardEmail && filter_var($forwardEmail, FILTER_VALIDATE_EMAIL)) {
            $mail->cc($forwardEmail);
        }

        return $mail;
    }

    /**
     * Get forwarding email — only when Mailtrap is the active mail driver.
     * Returns null when Eigen SMTP is active (no forwarding needed).
     * PUBLIC for testing purposes.
     */
    public function getForwardingEmail(): ?string
    {
        // Never forward when using Eigen SMTP
        if (!SiteSettingService::isMailtrap()) {
            return null;
        }

        // Method 1: Try config (set dynamically by AppServiceProvider)
        $email = config('mail.mailtrap_forward_email');
        if ($email && $email !== '') {
            return $email;
        }

        // Method 2: Try services config
        $email = config('services.lucideinkt.mailtrap_forward');
        if ($email && $email !== '') {
            return $email;
        }

        // Method 3: Hardcoded fallback for staging/local when Mailtrap is active
        if (app()->environment('staging', 'local', 'development')) {
            return 'lucideinkt@gmail.com';
        }

        return null;
    }

    /**
     * Test method to verify forwarding email detection.
     */
    public function testForwardingEmail(): array
    {
        $result = [
            'final_email'        => null,
            'method_used'        => null,
            'app_env'            => app()->environment(),
            'mailtrap_active'    => SiteSettingService::isMailtrap(),
            'config_value'       => config('mail.mailtrap_forward_email'),
            'env_value'          => config('services.lucideinkt.mailtrap_forward'),
            'hardcoded_fallback' => app()->environment('staging', 'local', 'development') ? 'lucideinkt@gmail.com' : null,
        ];

        if (!$result['mailtrap_active']) {
            $result['method_used'] = 'disabled (Eigen SMTP active)';
            return $result;
        }

        if ($result['config_value'] && $result['config_value'] !== '') {
            $result['final_email'] = $result['config_value'];
            $result['method_used'] = 'config';
            return $result;
        }

        if ($result['env_value'] && $result['env_value'] !== '') {
            $result['final_email'] = $result['env_value'];
            $result['method_used'] = 'env';
            return $result;
        }

        if ($result['hardcoded_fallback']) {
            $result['final_email'] = $result['hardcoded_fallback'];
            $result['method_used'] = 'hardcoded';
            return $result;
        }

        $result['method_used'] = 'none';
        return $result;
    }
}


