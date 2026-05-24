<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return $next($request);
        }

        if (!$user->google2fa_secret) {
            return $next($request);
        }

        if ($request->session()->get('2fa_verified')) {
            return $next($request);
        }

        return redirect()->route('2fa.verify');
    }
}
