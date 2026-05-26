<?php

namespace App\Http\Middleware;

use App\Services\SiteSettingService;
use Closure;
use Illuminate\Http\Request;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        if (!SiteSettingService::isMaintenanceMode()) {
            return $next($request);
        }

        // Always allow: webhooks
        if ($request->is('webhooks/*')) {
            return $next($request);
        }

        // Always allow static assets (images, fonts, css, js)
        if ($request->is('images/*', 'fonts/*', 'build/*', 'css/*', 'js/*', 'storage/*', '*.webp', '*.png', '*.jpg', '*.svg', '*.woff2', '*.ico')) {
            return $next($request);
        }

        // Always allow auth routes (by path — global middleware runs before routing)
        if ($request->is('login', 'logout', 'forgot-password', 'reset-password', 'reset-password/*')) {
            return $next($request);
        }

        // Always allow admins through
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        return response()->view('maintenance', [
            'loginUrl' => url('/login'),
        ], 503);
    }
}

