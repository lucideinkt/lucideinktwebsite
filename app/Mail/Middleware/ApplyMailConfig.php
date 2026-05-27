<?php

namespace App\Mail\Middleware;

use App\Services\SiteSettingService;

/**
 * Queue job middleware — re-applies the dynamic mail config before each
 * queued mailable so the queue worker always respects the current
 * "Eigen SMTP vs Mailtrap" setting without needing a worker restart.
 */
class ApplyMailConfig
{
    public function handle($job, $next): void
    {
        if (SiteSettingService::isMailtrap()) {
            config([
                'mail.mailers.smtp.host'      => config('smtp.mailtrap_host'),
                'mail.mailers.smtp.port'      => config('smtp.mailtrap_port'),
                'mail.mailers.smtp.username'  => config('smtp.mailtrap_username'),
                'mail.mailers.smtp.password'  => config('smtp.mailtrap_password'),
                'mail.mailers.smtp.scheme'    => null,
                'mail.mailtrap_forward_email' => config('smtp.mailtrap_forward'),
            ]);
        } else {
            config([
                'mail.mailers.smtp.host'      => config('smtp.host'),
                'mail.mailers.smtp.port'      => config('smtp.port'),
                'mail.mailers.smtp.username'  => config('smtp.username'),
                'mail.mailers.smtp.password'  => config('smtp.password'),
                'mail.mailers.smtp.scheme'    => config('smtp.scheme'),
                'mail.mailtrap_forward_email' => null,
            ]);
        }

        $next($job);
    }
}
