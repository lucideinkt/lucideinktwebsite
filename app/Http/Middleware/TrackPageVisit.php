<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use App\Models\Product;
use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisit
{
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

        // Only track GET requests that returned a successful HTML response
        if (
            $request->isMethod('GET') &&
            $response->getStatusCode() === 200 &&
            ! $request->ajax() &&
            ! $request->wantsJson()
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

                    // GeoIP lookup — silently skipped if it fails
                    $countryCode = null;
                    $country     = null;
                    $city        = null;
                    try {
                        $position = Location::get($request->ip());
                        if ($position) {
                            $countryCode = $position->countryCode ?: null;
                            $country     = $position->countryName ?: null;
                            $city        = $position->cityName ?: null;
                        }
                    } catch (\Throwable) {
                        // GeoIP failure is non-fatal
                    }

                    PageVisit::create([
                        'url'          => $request->fullUrl(),
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
                    ]);
                } catch (\Throwable $e) {
                    // Never break the request because of analytics
                    \Log::warning('PageVisit tracking error: ' . $e->getMessage());
                }
            }
        }

        return $response;
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
