<?php

/**
 * Custom SMTP / Mailtrap credentials.
 * Referenced via config() so they survive config:cache on production.
 */
return [

    // Real SMTP (lucideinkt.nl via shared39.cloud86-host.nl)
    'scheme'   => env('SMTP_SCHEME', 'smtps'),
    'host'     => env('SMTP_HOST', env('MAIL_HOST')),
    'port'     => (int) env('SMTP_PORT', env('MAIL_PORT', 465)),
    'username' => env('SMTP_USERNAME', env('MAIL_USERNAME')),
    'password' => env('SMTP_PASSWORD', env('MAIL_PASSWORD')),

    // Mailtrap sandbox
    'mailtrap_host'     => env('MAILTRAP_HOST', 'sandbox.smtp.mailtrap.io'),
    'mailtrap_port'     => (int) env('MAILTRAP_PORT', 2525),
    'mailtrap_username' => env('MAILTRAP_USERNAME'),
    'mailtrap_password' => env('MAILTRAP_PASSWORD'),
    'mailtrap_forward'  => env('MAILTRAP_FORWARD_EMAIL'),

];

