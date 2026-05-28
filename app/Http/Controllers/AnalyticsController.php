<?php

namespace App\Http\Controllers;

use App\Models\PageVisit;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $period   = $request->input('period', '30');   // days
        $type     = $request->input('type', 'all');
        $from     = now()->subDays((int) $period)->startOfDay();

        $baseQuery = PageVisit::where('created_at', '>=', $from);

        // ── Summary cards ──────────────────────────────────────────────
        $totalVisits     = (clone $baseQuery)->count();
        $uniqueSessions  = (clone $baseQuery)->distinct('session_hash')->count('session_hash');
        $uniqueIPs       = (clone $baseQuery)->distinct('ip_hash')->count('ip_hash');
        $mobileVisits    = (clone $baseQuery)->where('device_type', 'mobile')->count();
        $desktopVisits   = (clone $baseQuery)->where('device_type', 'desktop')->count();
        $tabletVisits    = (clone $baseQuery)->where('device_type', 'tablet')->count();

        // ── Unique sessions per day (best metric for "bezoeken per dag") ─
        $sessionsPerDay = (clone $baseQuery)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(DISTINCT session_hash) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // ── Page views per day (secondary dataset) ─────────────────────
        $visitsPerDay = (clone $baseQuery)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // ── Top pages by type ──────────────────────────────────────────
        $topProducts = (clone $baseQuery)
            ->where('page_type', 'product')
            ->whereNotNull('page_title')
            ->select('page_title', 'product_id', DB::raw('COUNT(*) as visits'))
            ->groupBy('page_title', 'product_id')
            ->orderByDesc('visits')
            ->limit(20)
            ->get();

        $topOnlineLezen = (clone $baseQuery)
            ->where('page_type', 'online_lezen')
            ->whereNotNull('page_title')
            ->select('page_title', 'product_id', DB::raw('COUNT(*) as visits'))
            ->groupBy('page_title', 'product_id')
            ->orderByDesc('visits')
            ->limit(20)
            ->get();

        $topAudiobooks = (clone $baseQuery)
            ->where('page_type', 'audiobook')
            ->whereNotNull('page_title')
            ->select('page_title', 'product_id', DB::raw('COUNT(*) as visits'))
            ->groupBy('page_title', 'product_id')
            ->orderByDesc('visits')
            ->limit(20)
            ->get();

        $topPages = (clone $baseQuery)
            ->whereIn('page_type', ['home', 'shop', 'page'])
            ->select('route_name', 'page_type', DB::raw('COUNT(*) as visits'))
            ->groupBy('route_name', 'page_type')
            ->orderByDesc('visits')
            ->limit(20)
            ->get();

        // ── Visits by page_type ────────────────────────────────────────
        $visitsByType = (clone $baseQuery)
            ->select('page_type', DB::raw('COUNT(*) as total'))
            ->groupBy('page_type')
            ->orderByDesc('total')
            ->get();

        // ── Top countries ──────────────────────────────────────────────
        $topCountries = (clone $baseQuery)
            ->whereNotNull('country')
            ->select('country_code', 'country', DB::raw('COUNT(DISTINCT session_hash) as sessions'), DB::raw('COUNT(*) as visits'))
            ->groupBy('country_code', 'country')
            ->orderByDesc('sessions')
            ->limit(15)
            ->get();

        // ── Top cities ─────────────────────────────────────────────────
        $topCities = (clone $baseQuery)
            ->whereNotNull('city')
            ->select('city', 'country_code', DB::raw('COUNT(DISTINCT session_hash) as sessions'))
            ->groupBy('city', 'country_code')
            ->orderByDesc('sessions')
            ->limit(10)
            ->get();

        // ── Recent visits (live log) ───────────────────────────────────
        $recentVisits = PageVisit::latest()
            ->limit(50)
            ->get();

        // ── Top referers ───────────────────────────────────────────────
        $topReferers = (clone $baseQuery)
            ->whereNotNull('referer')
            ->select('referer', DB::raw('COUNT(*) as visits'))
            ->groupBy('referer')
            ->orderByDesc('visits')
            ->limit(15)
            ->get();

        // ── Visits per hour of day (all-time in period) ────────────────
        $visitsPerHour = (clone $baseQuery)
            ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('COUNT(*) as total'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->keyBy('hour');

        $hourlyData = collect(range(0, 23))->map(fn($h) => [
            'hour'  => $h,
            'total' => $visitsPerHour->get($h)?->total ?? 0,
        ]);

        return view('admin.analytics', compact(
            'totalVisits',
            'uniqueSessions',
            'uniqueIPs',
            'mobileVisits',
            'desktopVisits',
            'tabletVisits',
            'sessionsPerDay',
            'visitsPerDay',
            'topProducts',
            'topOnlineLezen',
            'topAudiobooks',
            'topPages',
            'visitsByType',
            'topCountries',
            'topCities',
            'recentVisits',
            'topReferers',
            'hourlyData',
            'period',
            'type',
        ));
    }
}
