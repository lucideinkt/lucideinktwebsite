<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use App\Models\Product;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisit
{
    // Internal query params that should never be stored in the URL
    protected array $stripParams = ['_kw', '_', 'fbclid', 'gclid', 'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];

    // Routes to track
    protected array $trackedRoutes = [
        'home'               => 'home',
        'shop'               => 'shop',
        'productShow'        => 'product',
        'onlineLezen'        => 'online_lezen',
        'onlineLezenRead'    => 'online_lezen',
        'onlineLezenReadHtml'=> 'online_lezen',
        'audiobooks'         => 'audiobook',
        'audiobooksListen'   => 'audiobook',
        'risale'             => 'page',
        'herzameling'        => 'page',
        'saidnursi'          => 'page',
        'contact'            => 'page',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track GET requests that returned a successful HTML response.
        // Skip internal tool requests (SEO checker, dashboard fetches, etc.).
        if (
            $request->isMethod('GET') &&
            $response->getStatusCode() === 200 &&
            ! $request->ajax() &&
            ! $request->wantsJson() &&
            ! $request->hasHeader('X-SEO-Checker')
        ) {
            $routeName = $request->route()?->getName();

            if ($routeName && isset($this->trackedRoutes[$routeName])) {
                try {
                    $pageType  = $this->trackedRoutes[$routeName];
                    $productId = null;
                    $pageTitle = null;

                    // Resolve product details for product/book routes
                    if (in_array($pageType, ['product', 'online_lezen', 'audiobook'])) {
                        $slug = $request->route('slug');
                        if ($slug) {
                            $product = Product::where('slug', $slug)
                                ->select('id', 'title')
                                ->first();
                            if ($product) {
                                $productId = $product->id;
                                $pageTitle = $product->title;
                            }
                        }
                    }

                    // Detect device from User-Agent
                    $ua         = $request->userAgent() ?? '';
                    $deviceType = $this->detectDevice($ua);

                    // Clean URL: strip internal/tracking params before storing
                    $cleanUrl = $this->cleanUrl($request);

                    // GeoIP lookup — cached per IP for 24 hours to avoid rate limits
                    [$countryCode, $country, $city, $region] = $this->resolveLocation($request->ip());

                    PageVisit::create([
                        'url'          => $cleanUrl,
                        'route_name'   => $routeName,
                        'page_type'    => $pageType,
                        'page_title'   => $pageTitle,
                        'product_id'   => $productId,
                        'ip_hash'      => hash('sha256', $request->ip() . config('app.key')),
                        'session_hash' => hash('sha256', $request->session()->getId() . config('app.key')),
                        'user_id'      => auth()->id(),
                        'user_agent'   => substr($ua, 0, 500),
                        'referer'      => $request->header('referer') ? substr($request->header('referer'), 0, 500) : null,
                        'device_type'  => $deviceType,
                        'country_code' => $countryCode,
                        'country'      => $country,
                        'city'         => $city,
                        'region'       => $region,
                    ]);
                } catch (\Throwable $e) {
                    // Never break the request because of analytics
                    \Log::warning('PageVisit tracking error: ' . $e->getMessage());
                }
            }
        }

        return $response;
    }

    /**
     * Remove internal/bot query parameters from the URL before storing.
     */
    protected function cleanUrl(Request $request): string
    {
        $params = $request->query();
        foreach ($this->stripParams as $p) {
            unset($params[$p]);
        }

        $base = $request->url(); // URL without query string
        return empty($params)
            ? $base
            : $base . '?' . http_build_query($params);
    }

    /**
     * Look up country/region/city for the given IP.
     * Results are cached per IP for 24 hours to stay within free-tier rate limits.
     * Returns [countryCode, country, city, region] — all nullable.
     */
    protected function resolveLocation(string $ip): array
    {
        // In local/dev environments, private IPs are expected.
        // Use a well-known public IP for testing so location data is visible.
        if ($this->isPrivateIp($ip)) {
            if (app()->isProduction()) {
                // On production a private IP means the proxy trust is misconfigured — skip silently
                return [null, null, null, null];
            }
            // Dev/staging: substitute with a Dutch test IP so location works locally
            $ip = '213.127.0.1'; // KPN Netherlands
        }

        $cacheKey = 'geoip_' . md5($ip . config('app.key'));

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($ip) {
            try {
                $position = Location::get($ip);
                if ($position) {
                    return [
                        $position->countryCode  ?: null,
                        $position->countryName  ?: null,
                        $position->cityName     ?: null,
                        $position->regionName   ?: null,
                    ];
                }
            } catch (\Throwable) {
                // GeoIP failure is non-fatal
            }
            return [null, null, null, null];
        });
    }

    /**
     * Returns true for loopback, private, and link-local IP addresses.
     */
    protected function isPrivateIp(string $ip): bool
    {
        return ! filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );
    }

    protected function detectDevice(string $ua): string
    {
        $ua = strtolower($ua);
        if (str_contains($ua, 'tablet') || str_contains($ua, 'ipad')) {
            return 'tablet';
        }
        if (
            str_contains($ua, 'mobile') ||
            str_contains($ua, 'android') ||
            str_contains($ua, 'iphone') ||
            str_contains($ua, 'phone')
        ) {
            return 'mobile';
        }
        return 'desktop';
    }
}
