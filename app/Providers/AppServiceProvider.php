<?php

namespace App\Providers;

use App\Services\SiteSettingService; // still used for Mollie and indexing
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Book API: downloads and search use separate counters, so searching
        // in the app can never block downloading or updating books.
        RateLimiter::for('book-downloads', fn (Request $request) => Limit::perMinute(300)->by($request->ip()));
        RateLimiter::for('book-search', fn (Request $request) => Limit::perMinute(60)->by($request->ip()));

        // Blade directive: @role('admin') ... @endrole
        Blade::if('role', function (string $role): bool {
            $user = auth()->user();
            return $user && $user->role === $role;
        });

        // Blade directive: @anyrole('admin','user') ... @endanyrole
        Blade::if('anyrole', function (string ...$roles): bool {
            $user = auth()->user();
            return $user && in_array($user->role, $roles, true);
        });

        // ── Apply dynamic site settings ──────────────────────────────────
        try {
            // Mollie: switch between live and test key
            $mollieKey = SiteSettingService::isMollieLive()
                ? env('MOLLIE_LIVE_KEY')
                : env('MOLLIE_TEST_KEY');

            if ($mollieKey) {
                config(['mollie.key' => $mollieKey]);
            }

            // Mail: production = own SMTP, all other envs = Mailtrap
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

            // Search engine indexing — override robots meta
            if (SiteSettingService::isIndexingAllowed()) {
                config(['seo.robots.default' => 'max-snippet:-1,max-image-preview:large,max-video-preview:-1']);
            } else {
                config(['seo.robots.default' => 'noindex, nofollow']);
            }

        } catch (\Throwable) {
            // DB not yet available (first deploy / migration runs)
        }
    }
}
