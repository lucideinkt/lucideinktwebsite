<?php

namespace App\Mail\Middleware;

/**
 * Queue job middleware — re-applies the correct mail config before each
 * queued mailable so the queue worker always uses the right driver,
 * even without restarting.
 *
 * Production  → own SMTP (shared39.cloud86-host.nl)
 * Other envs  → Mailtrap
 */
class ApplyMailConfig
{
    public function handle($job, $next): void
    {
        if (app()->environment('production')) {
            config([
                'mail.mailers.smtp.host'      => config('smtp.host'),
                'mail.mailers.smtp.port'      => config('smtp.port'),
                'mail.mailers.smtp.username'  => config('smtp.username'),
                'mail.mailers.smtp.password'  => config('smtp.password'),
                'mail.mailers.smtp.scheme'    => config('smtp.scheme'),
                'mail.mailtrap_forward_email' => null,
            ]);
        } else {
            config([
                'mail.mailers.smtp.host'      => config('smtp.mailtrap_host'),
                'mail.mailers.smtp.port'      => config('smtp.mailtrap_port'),
                'mail.mailers.smtp.username'  => config('smtp.mailtrap_username'),
                'mail.mailers.smtp.password'  => config('smtp.mailtrap_password'),
                'mail.mailers.smtp.scheme'    => null,
                'mail.mailtrap_forward_email' => null,
            ]);
        }

        $next($job);
    }
}
