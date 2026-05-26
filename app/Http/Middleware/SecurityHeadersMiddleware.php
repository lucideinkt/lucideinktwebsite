<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeadersMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Content Security Policy — alleen in productie (Vite dev server werkt anders lokaal)
        if (app()->environment('production')) {
            $csp = implode('; ', [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://unpkg.com https://cdnjs.cloudflare.com https://use.typekit.net https://www.googletagmanager.com https://maps.googleapis.com",
                "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net https://unpkg.com https://cdnjs.cloudflare.com https://use.typekit.net https://p.typekit.net https://maps.googleapis.com",
                "font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com https://use.typekit.net https://p.typekit.net",
                "img-src 'self' data: blob: https: https://www.google-analytics.com https://www.googletagmanager.com https://maps.googleapis.com https://maps.gstatic.com",
                "media-src 'self' blob:",
                "frame-src 'self' https://www.mollie.com https://www.google.com",
                "connect-src 'self' https://p.typekit.net https://www.google-analytics.com https://region1.google-analytics.com https://maps.googleapis.com wss: ws:",
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'",
                "frame-ancestors 'self'",
            ]);
            $response->headers->set('Content-Security-Policy', $csp);
        }

        return $response;
    }
}
