<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PageVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->input('period', '30');
        $from   = now()->subDays((int) $period)->startOfDay();

        $base = PageVisit::where('created_at', '>=', $from);

        // ── Own host (used for referer classification) ────────────────────
        $ownHost = parse_url(config('app.url'), PHP_URL_HOST);

        // ── Summary cards ────────────────────────────────────────────────
        $totalVisits    = (clone $base)->count();
        $uniqueSessions = (clone $base)->distinct('session_hash')->count('session_hash');
        $uniqueUsers    = (clone $base)->distinct('ip_hash')->count('ip_hash');

        $avgPagesPerSession = $uniqueSessions > 0 ? round($totalVisits / $uniqueSessions, 1) : 0;

        // Bounce rate approximation: sessions with only 1 page view
        $singlePageSessions = (clone $base)
            ->select('session_hash', DB::raw('COUNT(*) as pages'))
            ->groupBy('session_hash')
            ->havingRaw('COUNT(*) = 1')
            ->get()->count();
        $bounceRate = $uniqueSessions > 0
            ? round(($singlePageSessions / $uniqueSessions) * 100, 1)
            : 0;

        // ── Previous period (for trend comparison) ────────────────────────
        $prevFrom = now()->subDays((int) $period * 2)->startOfDay();
        $prevTo   = now()->subDays((int) $period)->startOfDay();
        $prevBase = PageVisit::where('created_at', '>=', $prevFrom)->where('created_at', '<', $prevTo);

        $prevTotalVisits    = (clone $prevBase)->count();
        $prevUniqueSessions = (clone $prevBase)->distinct('session_hash')->count('session_hash');
        $prevUniqueUsers    = (clone $prevBase)->distinct('ip_hash')->count('ip_hash');

        $prevSinglePage = (clone $prevBase)
            ->select('session_hash', DB::raw('COUNT(*) as pages'))
            ->groupBy('session_hash')
            ->havingRaw('COUNT(*) = 1')
            ->get()->count();
        $prevBounceRate = $prevUniqueSessions > 0
            ? round(($prevSinglePage / $prevUniqueSessions) * 100, 1)
            : 0;

        $trend = fn($now, $prev) => $prev > 0 ? round((($now - $prev) / $prev) * 100, 1) : null;
        $trends = [
            'visits'   => $trend($totalVisits, $prevTotalVisits),
            'sessions' => $trend($uniqueSessions, $prevUniqueSessions),
            'users'    => $trend($uniqueUsers, $prevUniqueUsers),
            'bounce'   => $trend($bounceRate, $prevBounceRate),
        ];

        // ── Sessions & page views per day ─────────────────────────────────
        $perDay = (clone $base)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(DISTINCT session_hash) as sessions'),
                DB::raw('COUNT(*) as pageViews')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(fn($r) => ['date' => $r->date, 'sessions' => (int)$r->sessions, 'pageViews' => (int)$r->pageViews]);

        // ── Devices ───────────────────────────────────────────────────────
        $devices = (clone $base)
            ->select('device_type', DB::raw('COUNT(DISTINCT session_hash) as sessions'))
            ->groupBy('device_type')
            ->orderByDesc('sessions')
            ->get()
            ->map(fn($r) => ['device' => $r->device_type ?? 'unknown', 'sessions' => (int)$r->sessions]);

        // ── Hourly distribution ───────────────────────────────────────────
        $visitsPerHour = (clone $base)
            ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('COUNT(*) as total'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->keyBy('hour');

        $hourlyData = collect(range(0, 23))->map(fn($h) => [
            'hour'     => $h,
            'sessions' => $visitsPerHour->get($h)?->total ?? 0,
        ]);

        // ── Top countries ─────────────────────────────────────────────────
        $topCountries = (clone $base)
            ->whereNotNull('country')
            ->select(
                'country_code',
                'country',
                DB::raw('COUNT(DISTINCT session_hash) as sessions'),
                DB::raw('COUNT(*) as pageViews')
            )
            ->groupBy('country_code', 'country')
            ->orderByDesc('sessions')
            ->limit(15)
            ->get()
            ->map(fn($r) => [
                'country'     => $r->country,
                'countryCode' => strtolower($r->country_code ?? ''),
                'sessions'    => (int)$r->sessions,
                'pageViews'   => (int)$r->pageViews,
            ]);

        // ── Top regions ───────────────────────────────────────────────────
        $topRegions = (clone $base)
            ->whereNotNull('region')
            ->select(
                'region',
                'country_code',
                'country',
                DB::raw('COUNT(DISTINCT session_hash) as sessions')
            )
            ->groupBy('region', 'country_code', 'country')
            ->orderByDesc('sessions')
            ->limit(15)
            ->get()
            ->map(fn($r) => [
                'region'      => $r->region,
                'country'     => $r->country,
                'countryCode' => strtolower($r->country_code ?? ''),
                'sessions'    => (int)$r->sessions,
            ]);

        // ── Top cities ────────────────────────────────────────────────────
        $topCities = (clone $base)
            ->whereNotNull('city')
            ->select(
                'city',
                'region',
                'country_code',
                DB::raw('COUNT(DISTINCT session_hash) as sessions')
            )
            ->groupBy('city', 'region', 'country_code')
            ->orderByDesc('sessions')
            ->limit(15)
            ->get()
            ->map(fn($r) => [
                'city'        => $r->city,
                'region'      => $r->region,
                'countryCode' => strtolower($r->country_code ?? ''),
                'sessions'    => (int)$r->sessions,
            ]);

        // ── Top pages ─────────────────────────────────────────────────────
        $routeFallbackTitles = [
            'home'                => 'Homepage',
            'shop'                => 'Winkel',
            'onlineLezen'         => 'Bibliotheek overzicht',
            'onlineLezenRead'     => 'Bibliotheek (lezen)',
            'onlineLezenReadHtml' => 'Bibliotheek (lezen)',
            'audiobooks'          => 'Audioboeken overzicht',
            'audiobooksListen'    => 'Audioboeken (luisteren)',
            'risale'              => 'Risale-i Nur',
            'herzameling'         => 'Herzameling',
            'saidnursi'           => 'Said Nursi',
            'contact'             => 'Contact',
        ];

        $topPages = (clone $base)
            ->select(
                'route_name',
                'page_type',
                'page_title',
                DB::raw('COUNT(*) as pageViews'),
                DB::raw('COUNT(DISTINCT session_hash) as sessions')
            )
            ->groupBy('route_name', 'page_type', 'page_title')
            ->orderByDesc('pageViews')
            ->limit(25)
            ->get()
            ->map(function ($row) use ($routeFallbackTitles) {
                $row->display_title = $row->page_title
                    ?: ($routeFallbackTitles[$row->route_name] ?? ucfirst(str_replace(['_', '.'], ' ', $row->route_name ?? '?')));
                return $row;
            });

        // ── Top products ──────────────────────────────────────────────────
        $topProducts = (clone $base)
            ->where('page_type', 'product')
            ->whereNotNull('page_title')
            ->select('page_title', 'product_id', DB::raw('COUNT(*) as visits'), DB::raw('COUNT(DISTINCT session_hash) as sessions'))
            ->groupBy('page_title', 'product_id')
            ->orderByDesc('visits')
            ->limit(15)
            ->get();

        // ── Top online reading books ───────────────────────────────────────
        $topOnlineLezen = (clone $base)
            ->where('page_type', 'online_lezen')
            ->whereNotNull('page_title')
            ->select('page_title', 'product_id', DB::raw('COUNT(*) as visits'), DB::raw('COUNT(DISTINCT session_hash) as sessions'))
            ->groupBy('page_title', 'product_id')
            ->orderByDesc('visits')
            ->limit(15)
            ->get();

        // ── Top audiobooks ────────────────────────────────────────────────
        $topAudiobooks = (clone $base)
            ->where('page_type', 'audiobook')
            ->whereNotNull('page_title')
            ->select('page_title', 'product_id', DB::raw('COUNT(*) as visits'), DB::raw('COUNT(DISTINCT session_hash) as sessions'))
            ->groupBy('page_title', 'product_id')
            ->orderByDesc('visits')
            ->limit(15)
            ->get();

        // ── Traffic sources (referers) ────────────────────────────────────
        $topReferers = (clone $base)
            ->whereNotNull('referer')
            ->where('referer', 'not like', '%' . $ownHost . '%')
            ->select('referer', DB::raw('COUNT(*) as visits'))
            ->groupBy('referer')
            ->orderByDesc('visits')
            ->limit(50)
            ->get()
            ->groupBy(fn($r) => parse_url($r->referer, PHP_URL_HOST) ?: $r->referer)
            ->map(fn($group) => (object)[
                'referer' => $group->first()->referer,
                'host'    => parse_url($group->first()->referer, PHP_URL_HOST) ?: $group->first()->referer,
                'visits'  => $group->sum('visits'),
            ])
            ->sortByDesc('visits')
            ->take(15)
            ->values();

        // ── Traffic source classification ─────────────────────────────────
        $searchEngineHosts = ['google.', 'bing.', 'yahoo.', 'duckduckgo.', 'yandex.', 'baidu.', 'ecosia.', 'ask.', 'aol.'];
        $socialHosts       = ['facebook.', 'instagram.', 'twitter.', 'x.com', 'linkedin.', 'pinterest.', 'tiktok.', 'youtube.', 'whatsapp.', 'telegram.', 'reddit.', 'snapchat.'];

        $allRefererGroups = (clone $base)
            ->select('referer', DB::raw('COUNT(*) as visits'))
            ->groupBy('referer')
            ->get();

        $trafficSources = ['direct' => 0, 'organic' => 0, 'social' => 0, 'referral' => 0];
        foreach ($allRefererGroups as $r) {
            $ref = $r->referer ?? '';
            if (!$ref) {
                $trafficSources['direct'] += $r->visits;
            } else {
                $host = strtolower(parse_url($ref, PHP_URL_HOST) ?: $ref);
                if (str_contains($host, $ownHost)) {
                    // internal navigation — ignore
                } elseif (collect($searchEngineHosts)->first(fn($s) => str_contains($host, $s))) {
                    $trafficSources['organic'] += $r->visits;
                } elseif (collect($socialHosts)->first(fn($s) => str_contains($host, $s))) {
                    $trafficSources['social'] += $r->visits;
                } else {
                    $trafficSources['referral'] += $r->visits;
                }
            }
        }

        // ── Page type distribution ────────────────────────────────────────
        $visitsByType = (clone $base)
            ->select('page_type', DB::raw('COUNT(*) as total'))
            ->groupBy('page_type')
            ->orderByDesc('total')
            ->get();

        // ── Recent visits ─────────────────────────────────────────────────
        $recentVisits = PageVisit::latest()->limit(50)->get();

        return view('admin.analytics', compact(
            'period',
            'totalVisits',
            'uniqueSessions',
            'uniqueUsers',
            'avgPagesPerSession',
            'bounceRate',
            'trends',
            'perDay',
            'devices',
            'hourlyData',
            'topCountries',
            'topRegions',
            'topCities',
            'topPages',
            'topProducts',
            'topOnlineLezen',
            'topAudiobooks',
            'topReferers',
            'trafficSources',
            'visitsByType',
            'recentVisits',
        ));
    }
}
