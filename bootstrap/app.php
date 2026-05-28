<?php

use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckMaintenanceMode;
use App\Http\Middleware\SecurityHeadersMiddleware;
use App\Http\Middleware\TrackPageVisit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust all proxies — required for Cloudways (and similar hosts) so that
        // $request->ip() returns the real visitor IP, not the load-balancer IP.
        $middleware->trustProxies(at: '*');

        $middleware->append(SecurityHeadersMiddleware::class);
        $middleware->web(append: [CheckMaintenanceMode::class, TrackPageVisit::class]);

        $middleware->alias([
            'role' => CheckRole::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'webhooks/mollie',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
