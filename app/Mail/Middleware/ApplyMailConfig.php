<?php

namespace App\Mail\Middleware;

/**
 * Queue-job middleware — re-applies the correct SMTP config before each
 * queued mailable so the queue worker always uses the right driver,
 * even when the config is cached.
 *
 * Production  → Mailtrap Sending (live.smtp.mailtrap.io) — real delivery
 * Other envs  → Mailtrap Sandbox (sandbox.smtp.mailtrap.io) — catches all, nothing delivered
 */
class ApplyMailConfig
{
    /**
     * Apply the correct SMTP configuration based on environment.
     * Call this directly from build() methods so it also works for synchronous (non-queued) sends.
     */
    public static function apply(): void
    {
        if (app()->environment('production')) {
            config([
                'mail.mailers.smtp.host'     => env('SMTP_HOST', 'live.smtp.mailtrap.io'),
                'mail.mailers.smtp.port'     => (int) env('SMTP_PORT', 587),
                'mail.mailers.smtp.username' => env('SMTP_USERNAME', 'api'),
                'mail.mailers.smtp.password' => env('SMTP_PASSWORD'),
                'mail.mailers.smtp.scheme'   => env('SMTP_SCHEME', 'smtp'),
            ]);
        } else {
            config([
                'mail.mailers.smtp.host'     => env('MAILTRAP_HOST', 'sandbox.smtp.mailtrap.io'),
                'mail.mailers.smtp.port'     => (int) env('MAILTRAP_PORT', 2525),
                'mail.mailers.smtp.username' => env('MAILTRAP_USERNAME', env('MAIL_USERNAME')),
                'mail.mailers.smtp.password' => env('MAILTRAP_PASSWORD', env('MAIL_PASSWORD')),
                'mail.mailers.smtp.scheme'   => null,
            ]);
        }
    }

    /** Queue job middleware — kept for backwards compatibility with any queued jobs. */
    public function handle($job, $next): void
    {
        static::apply();
        $next($job);
    }
}
