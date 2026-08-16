<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureMobileApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $configuredKey = (string) config('services.mobile.api_key', '');

        if ($configuredKey === '') {
            abort(503, 'Mobile API key is not configured.');
        }

        $providedKey = (string) $request->header('X-Mobile-Api-Key', '');
        if ($providedKey === '' || !hash_equals($configuredKey, $providedKey)) {
            abort(401, 'Invalid mobile API key.');
        }

        return $next($request);
    }
}
