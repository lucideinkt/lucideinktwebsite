<?php

/**
 * SMTP credentials — loaded via config() so they survive config:cache.
 *
 * Production  : Mailtrap Sending (live.smtp.mailtrap.io) — reliable delivery, SPF/DKIM handled
 * Local/staging: Mailtrap Sandbox (sandbox.smtp.mailtrap.io) — catches all mail, nothing delivered
 */
return [

    // Production SMTP (Mailtrap Sending relay)
    'scheme'   => env('SMTP_SCHEME', 'smtp'),
    'host'     => env('SMTP_HOST', 'live.smtp.mailtrap.io'),
    'port'     => (int) env('SMTP_PORT', 587),
    'username' => env('SMTP_USERNAME', 'api'),
    'password' => env('SMTP_PASSWORD'),

    // Mailtrap Sandbox — local/staging only
    'mailtrap_host'     => env('MAILTRAP_HOST', 'sandbox.smtp.mailtrap.io'),
    'mailtrap_port'     => (int) env('MAILTRAP_PORT', 2525),
    'mailtrap_username' => env('MAILTRAP_USERNAME'),
    'mailtrap_password' => env('MAILTRAP_PASSWORD'),

];
