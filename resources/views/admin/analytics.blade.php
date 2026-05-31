<x-dashboard-layout>
@section('title', 'Analytics')

@php
    $typeBadge = [
        'product'      => 'bg-orange-100 text-orange-700 dark:bg-orange-900/50 dark:text-orange-300',
        'online_lezen' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300',
        'audiobook'    => 'bg-purple-100 text-purple-700 dark:bg-purple-900/50 dark:text-purple-300',
        'shop'         => 'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300',
        'home'         => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
        'page'         => 'bg-teal-100 text-teal-700 dark:bg-teal-900/50 dark:text-teal-300',
    ];
    $typeShort = [
        'product'      => 'Product',
        'online_lezen' => 'Lezen',
        'audiobook'    => 'Audio',
        'shop'         => 'Shop',
        'home'         => 'Home',
        'page'         => 'Pagina',
    ];
    $typeLabels = [
        'product'      => 'Producten',
        'online_lezen' => 'Online lezen',
        'audiobook'    => 'Audioboeken',
        'shop'         => 'Winkel',
        'home'         => 'Homepage',
        'page'         => "Pagina's",
    ];
    $deviceIcons  = ['desktop' => 'fa-desktop', 'mobile' => 'fa-mobile-screen', 'tablet' => 'fa-tablet-screen-button'];
    $deviceColors = ['desktop' => 'bg-blue-500', 'mobile' => 'bg-orange-500', 'tablet' => 'bg-purple-500'];
    $deviceLabels = ['desktop' => 'Desktop', 'mobile' => 'Mobiel', 'tablet' => 'Tablet'];
    $routeLabels  = [
        'home'                => 'Homepage',
        'shop'                => 'Winkel',
        'onlineLezen'         => 'Bibliotheek overzicht',
        'onlineLezenRead'     => 'Bibliotheek',
        'onlineLezenReadHtml' => 'Bibliotheek',
        'audiobooks'          => 'Audioboeken',
        'audiobooksListen'    => 'Audioboeken',
        'risale'              => 'Risale-i Nur',
        'herzameling'         => 'Herzameling',
        'saidnursi'           => 'Said Nursi',
        'contact'             => 'Contact',
    ];
@endphp

{{-- ════ HEADER ════════════════════════════════════════════════════════ --}}
<div class="mb-6 flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Bezoekersstatistieken</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Overzicht van alle bezoekers op de website</p>
    </div>
    <form method="GET" action="{{ route('admin.analytics') }}" class="flex items-center gap-2">
        <label class="text-sm text-gray-600 dark:text-gray-300">Periode:</label>
        <select name="period" onchange="this.form.submit()"
            class="text-sm border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-1.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
            @foreach(['7' => 'Afgelopen 7 dagen', '14' => 'Afgelopen 14 dagen', '30' => 'Afgelopen 30 dagen', '90' => 'Afgelopen 90 dagen', '365' => 'Afgelopen jaar'] as $val => $lbl)
                <option value="{{ $val }}" {{ $period == $val ? 'selected' : '' }}>{{ $lbl }}</option>
            @endforeach
        </select>
    </form>
</div>

{{-- ════ KPI CARDS ═════════════════════════════════════════════════════ --}}
@php
    $kpis = [
        ['label' => 'Paginaweergaven', 'value' => number_format($totalVisits),    'icon' => 'fa-eye',               'color' => 'blue',   'sub' => 'totaal in periode',  'trend' => $trends['visits']],
        ['label' => 'Unieke sessies',  'value' => number_format($uniqueSessions),  'icon' => 'fa-user-check',        'color' => 'indigo', 'sub' => 'bezoekers',          'trend' => $trends['sessions']],
        ['label' => 'Unieke bezoekers','value' => number_format($uniqueUsers),     'icon' => 'fa-users',             'color' => 'violet', 'sub' => 'unieke IPs',         'trend' => $trends['users']],
        ['label' => 'Pag. per sessie', 'value' => $avgPagesPerSession,            'icon' => 'fa-layer-group',       'color' => 'cyan',   'sub' => 'gemiddeld',          'trend' => null],
        ['label' => 'Bounce rate',     'value' => $bounceRate . '%',              'icon' => 'fa-right-from-bracket','color' => 'orange', 'sub' => '1 pagina / sessie',  'trend' => $trends['bounce'] !== null ? -$trends['bounce'] : null],
    ];
    $colorMap = [
        'blue'   => 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400',
        'indigo' => 'bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-400',
        'violet' => 'bg-violet-100 dark:bg-violet-900 text-violet-600 dark:text-violet-400',
        'cyan'   => 'bg-cyan-100 dark:bg-cyan-900 text-cyan-600 dark:text-cyan-400',
        'orange' => 'bg-orange-100 dark:bg-orange-900 text-orange-600 dark:text-orange-400',
    ];
@endphp
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
    @foreach($kpis as $kpi)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide leading-tight">{{ $kpi['label'] }}</span>
            <div class="w-8 h-8 rounded-lg {{ $colorMap[$kpi['color']] }} flex items-center justify-center shrink-0">
                <i class="fa-solid {{ $kpi['icon'] }} text-sm"></i>
            </div>
        </div>
        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $kpi['value'] }}</p>
        <div class="flex items-center gap-1.5 mt-0.5">
            <p class="text-xs text-gray-400">{{ $kpi['sub'] }}</p>
            @if($kpi['trend'] !== null)
                @php $up = $kpi['trend'] >= 0; @endphp
                <span class="text-xs font-semibold {{ $up ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }} flex items-center gap-0.5">
                    <i class="fa-solid {{ $up ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }} text-[10px]"></i>
                    {{ abs($kpi['trend']) }}%
                </span>
            @endif
        </div>
    </div>
    @endforeach
</div>

{{-- ════ CHART ROW ══════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- Sessions per day --}}
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Sessies &amp; paginaweergaven per dag</h2>
            <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                <span class="flex items-center gap-1.5"><span class="inline-block w-3 h-3 rounded-sm" style="background:rgba(59,130,246,0.85)"></span>Sessies</span>
                <span class="flex items-center gap-1.5"><span class="inline-block w-3 h-3 rounded-sm" style="background:rgba(99,102,241,0.35)"></span>Paginaweergaven</span>
            </div>
        </div>
        <div class="relative h-56"><canvas id="visitsChart"></canvas></div>
    </div>

    {{-- Devices --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-3">Apparaten</h2>
        @php $devTotal = $devices->sum('sessions') ?: 1; @endphp
        <div class="flex justify-center mb-4"><canvas id="deviceChart" width="130" height="130"></canvas></div>
        <div class="space-y-2.5">
            @foreach($devices as $dev)
            @php $key = strtolower($dev['device']); $pct = round(($dev['sessions'] / $devTotal) * 100); @endphp
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                        <i class="fa-solid {{ $deviceIcons[$key] ?? 'fa-question' }} w-4 text-center text-gray-400"></i>
                        {{ $deviceLabels[$key] ?? ucfirst($key) }}
                    </span>
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ number_format($dev['sessions']) }} <span class="text-gray-400 font-normal text-xs">({{ $pct }}%)</span>
                    </span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                    <div class="{{ $deviceColors[$key] ?? 'bg-gray-400' }} h-1.5 rounded-full" style="width:{{ $pct }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ════ TRAFFIC SOURCES + CATEGORIES ══════════════════════════════════ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

    {{-- Traffic source breakdown --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-share-nodes text-sky-500 mr-2"></i>Verkeerskanalen
        </h2>
        @php
            $srcTotal = array_sum($trafficSources) ?: 1;
            $srcDefs  = [
                'direct'   => ['label' => 'Direct',            'icon' => 'fa-link-slash',     'color' => 'bg-gray-400',   'text' => 'text-gray-500 dark:text-gray-400'],
                'organic'  => ['label' => 'Organisch zoeken',  'icon' => 'fa-magnifying-glass','color' => 'bg-blue-500',   'text' => 'text-blue-600 dark:text-blue-400'],
                'social'   => ['label' => 'Social media',      'icon' => 'fa-thumbs-up',      'color' => 'bg-pink-500',   'text' => 'text-pink-600 dark:text-pink-400'],
                'referral' => ['label' => 'Verwijzende sites', 'icon' => 'fa-arrow-pointer',  'color' => 'bg-violet-500', 'text' => 'text-violet-600 dark:text-violet-400'],
            ];
        @endphp
        <div class="space-y-3">
            @foreach($srcDefs as $key => $def)
            @php $count = $trafficSources[$key] ?? 0; $pct = round(($count / $srcTotal) * 100); @endphp
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                        <i class="fa-solid {{ $def['icon'] }} w-4 text-center {{ $def['text'] }}"></i>
                        {{ $def['label'] }}
                    </span>
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ number_format($count) }} <span class="text-gray-400 font-normal text-xs">({{ $pct }}%)</span>
                    </span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                    <div class="{{ $def['color'] }} h-1.5 rounded-full" style="width:{{ $pct }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Category distribution --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-table-cells text-teal-500 mr-2"></i>Per categorie
        </h2>
        @php
            $typeTotal = $visitsByType->sum('total') ?: 1;
            $catColors = ['product' => 'bg-orange-400', 'online_lezen' => 'bg-blue-500', 'audiobook' => 'bg-purple-500', 'shop' => 'bg-green-500', 'home' => 'bg-gray-400', 'page' => 'bg-teal-500'];
        @endphp
        <div class="space-y-3">
            @foreach($visitsByType as $vt)
            @php $pct = round(($vt->total / $typeTotal) * 100); @endphp
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                        <span class="inline-block w-2.5 h-2.5 rounded-full {{ $catColors[$vt->page_type] ?? 'bg-gray-400' }}"></span>
                        {{ $typeLabels[$vt->page_type] ?? ucfirst($vt->page_type ?? '?') }}
                    </span>
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ number_format($vt->total) }} <span class="text-gray-400 font-normal text-xs">({{ $pct }}%)</span>
                    </span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                    <div class="{{ $catColors[$vt->page_type] ?? 'bg-gray-400' }} h-1.5 rounded-full" style="width:{{ $pct }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ════ HOURLY HEATMAP ═════════════════════════════════════════════════ --}}
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5 mb-6">
    <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
        <i class="fa-solid fa-clock text-amber-500 mr-2"></i>Populairste uren op de dag
    </h2>
    @php $maxHour = $hourlyData->max('sessions') ?: 1; @endphp
    <div class="grid grid-cols-12 gap-1">
        @foreach($hourlyData as $h)
        @php $pct = round(($h['sessions'] / $maxHour) * 100); @endphp
        <div class="flex flex-col items-center" title="{{ str_pad($h['hour'],2,'0',STR_PAD_LEFT) }}:00 — {{ $h['sessions'] }} bezoeken">
            <div class="w-full flex items-end justify-center" style="height:48px">
                <div class="w-full rounded-sm {{ $pct > 75 ? 'bg-blue-600 dark:bg-blue-500' : ($pct > 40 ? 'bg-blue-400 dark:bg-blue-700' : ($pct > 10 ? 'bg-blue-200 dark:bg-blue-800' : 'bg-blue-50 dark:bg-blue-950')) }}"
                    style="height:{{ max(4,$pct) }}%"></div>
            </div>
            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ str_pad($h['hour'],2,'0',STR_PAD_LEFT) }}</span>
        </div>
        @endforeach
    </div>
    <p class="text-xs text-gray-400 mt-3">Hoogte = relatief aantal bezoeken per uur (totaal in geselecteerde periode)</p>
</div>

{{-- ════ GEO: Countries / Regions / Cities ════════════════════════════ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- Countries --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-earth-europe text-blue-500 mr-2"></i>Landen
        </h2>
        @if($topCountries->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen locatiedata.</p>
        @else
        @php $maxC = $topCountries->max('sessions') ?: 1; @endphp
        <div class="space-y-2">
            @foreach($topCountries as $row)
            @php $pct = round(($row['sessions'] / $maxC) * 100); @endphp
            <div>
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="text-xs font-bold text-gray-400 w-4 text-right shrink-0">{{ $loop->iteration }}</span>
                    @if($row['countryCode'])
                        <img src="https://flagcdn.com/16x12/{{ $row['countryCode'] }}.png" width="16" height="12" class="rounded-sm shrink-0" onerror="this.style.display='none'">
                    @endif
                    <span class="flex-1 text-sm text-gray-900 dark:text-white truncate">{{ $row['country'] }}</span>
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 shrink-0">
                        {{ number_format($row['sessions']) }} <span class="text-xs font-normal text-gray-400">sess.</span>
                    </span>
                </div>
                <div class="ml-6 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1">
                    <div class="bg-blue-500 h-1 rounded-full" style="width:{{ $pct }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Regions --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-map text-indigo-500 mr-2"></i>Regio's / Provincies
        </h2>
        @if($topRegions->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen regiodata.</p>
        @else
        @php $maxR = $topRegions->max('sessions') ?: 1; @endphp
        <div class="space-y-2">
            @foreach($topRegions as $row)
            @php $pct = round(($row['sessions'] / $maxR) * 100); @endphp
            <div>
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="text-xs font-bold text-gray-400 w-4 text-right shrink-0">{{ $loop->iteration }}</span>
                    @if($row['countryCode'])
                        <img src="https://flagcdn.com/16x12/{{ $row['countryCode'] }}.png" width="16" height="12" class="rounded-sm shrink-0" onerror="this.style.display='none'">
                    @endif
                    <span class="flex-1 text-sm text-gray-900 dark:text-white truncate">{{ $row['region'] }}</span>
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 shrink-0">
                        {{ number_format($row['sessions']) }} <span class="text-xs font-normal text-gray-400">sess.</span>
                    </span>
                </div>
                <div class="ml-6 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1">
                    <div class="bg-indigo-500 h-1 rounded-full" style="width:{{ $pct }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Cities --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-city text-violet-500 mr-2"></i>Steden
        </h2>
        @if($topCities->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen stedendata.</p>
        @else
        @php $maxCity = $topCities->max('sessions') ?: 1; @endphp
        <div class="space-y-2">
            @foreach($topCities as $row)
            @php $pct = round(($row['sessions'] / $maxCity) * 100); @endphp
            <div>
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="text-xs font-bold text-gray-400 w-4 text-right shrink-0">{{ $loop->iteration }}</span>
                    @if($row['countryCode'])
                        <img src="https://flagcdn.com/16x12/{{ $row['countryCode'] }}.png" width="16" height="12" class="rounded-sm shrink-0" onerror="this.style.display='none'">
                    @endif
                    <div class="flex-1 min-w-0">
                        <span class="text-sm text-gray-900 dark:text-white block truncate">{{ $row['city'] }}</span>
                        @if($row['region'])
                            <span class="text-xs text-gray-400 block truncate">{{ $row['region'] }}</span>
                        @endif
                    </div>
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 shrink-0">
                        {{ number_format($row['sessions']) }} <span class="text-xs font-normal text-gray-400">sess.</span>
                    </span>
                </div>
                <div class="ml-6 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1">
                    <div class="bg-violet-500 h-1 rounded-full" style="width:{{ $pct }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- ════ TOP PAGES + TOP PRODUCTS ══════════════════════════════════════ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

    {{-- Top pages --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-file-lines text-green-500 mr-2"></i>Meest bezochte pagina's
        </h2>
        @if($topPages->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen data</p>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-xs text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th class="pb-2 text-left font-medium w-6">#</th>
                        <th class="pb-2 text-left font-medium">Pagina</th>
                        <th class="pb-2 text-right font-medium w-12">PV</th>
                        <th class="pb-2 text-right font-medium w-14">Sess.</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                    @foreach($topPages as $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                        <td class="py-1.5 text-xs text-gray-400 font-bold">{{ $loop->iteration }}</td>
                        <td class="py-1.5 pr-2">
                            <div class="flex items-start gap-2">
                                <span class="text-xs px-1.5 py-0.5 rounded font-medium {{ $typeBadge[$row->page_type] ?? 'bg-gray-100 text-gray-600' }} shrink-0 mt-0.5">
                                    {{ $typeShort[$row->page_type] ?? ucfirst($row->page_type ?? '?') }}
                                </span>
                                <span class="text-gray-900 dark:text-white break-words min-w-0">{{ $row->display_title }}</span>
                            </div>
                        </td>
                        <td class="py-1.5 text-right font-semibold text-gray-900 dark:text-white whitespace-nowrap">{{ number_format($row->pageViews) }}</td>
                        <td class="py-1.5 text-right text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ number_format($row->sessions) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{-- Top products --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-box-open text-orange-500 mr-2"></i>Meest bekeken producten
        </h2>
        @if($topProducts->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen data</p>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-xs text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th class="pb-2 text-left font-medium w-6">#</th>
                        <th class="pb-2 text-left font-medium">Product</th>
                        <th class="pb-2 text-right font-medium w-16">Bezoeken</th>
                        <th class="pb-2 text-right font-medium w-14">Sess.</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                    @foreach($topProducts as $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                        <td class="py-1.5 text-xs text-gray-400 font-bold">{{ $loop->iteration }}</td>
                        <td class="py-1.5 pr-2 text-gray-900 dark:text-white">{{ $row->page_title }}</td>
                        <td class="py-1.5 text-right font-semibold text-gray-900 dark:text-white">{{ number_format($row->visits) }}</td>
                        <td class="py-1.5 text-right text-gray-500 dark:text-gray-400">{{ number_format($row->sessions) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

{{-- ════ ONLINE LEZEN + AUDIOBOEKEN ════════════════════════════════════ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

    {{-- Top online reading books --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-book-open text-blue-500 mr-2"></i>Meest gelezen boeken (online)
        </h2>
        @if($topOnlineLezen->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen data</p>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-xs text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th class="pb-2 text-left font-medium w-6">#</th>
                        <th class="pb-2 text-left font-medium">Boek</th>
                        <th class="pb-2 text-right font-medium w-16">Bezoeken</th>
                        <th class="pb-2 text-right font-medium w-14">Sess.</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                    @foreach($topOnlineLezen as $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                        <td class="py-1.5 text-xs text-gray-400 font-bold">{{ $loop->iteration }}</td>
                        <td class="py-1.5 pr-2 text-gray-900 dark:text-white">{{ $row->page_title }}</td>
                        <td class="py-1.5 text-right font-semibold text-gray-900 dark:text-white">{{ number_format($row->visits) }}</td>
                        <td class="py-1.5 text-right text-gray-500 dark:text-gray-400">{{ number_format($row->sessions) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{-- Top audiobooks --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-headphones text-purple-500 mr-2"></i>Meest beluisterde audioboeken
        </h2>
        @if($topAudiobooks->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen data</p>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-xs text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th class="pb-2 text-left font-medium w-6">#</th>
                        <th class="pb-2 text-left font-medium">Audioboek</th>
                        <th class="pb-2 text-right font-medium w-16">Bezoeken</th>
                        <th class="pb-2 text-right font-medium w-14">Sess.</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                    @foreach($topAudiobooks as $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                        <td class="py-1.5 text-xs text-gray-400 font-bold">{{ $loop->iteration }}</td>
                        <td class="py-1.5 pr-2 text-gray-900 dark:text-white">{{ $row->page_title }}</td>
                        <td class="py-1.5 text-right font-semibold text-gray-900 dark:text-white">{{ number_format($row->visits) }}</td>
                        <td class="py-1.5 text-right text-gray-500 dark:text-gray-400">{{ number_format($row->sessions) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

{{-- ════ TOP REFERRERS ══════════════════════════════════════════════════ --}}
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5 mb-6">
    <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
        <i class="fa-solid fa-arrow-pointer text-pink-500 mr-2"></i>Top verwijzers
    </h2>
    @if($topReferers->isEmpty())
        <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen externe verwijzers geregistreerd.</p>
    @else
    @php $maxRef = $topReferers->max('visits') ?: 1; @endphp
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-xs text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                <tr>
                    <th class="pb-2 text-left font-medium w-6">#</th>
                    <th class="pb-2 text-left font-medium">Verwijzer</th>
                    <th class="pb-2 text-right font-medium w-20">Bezoeken</th>
                    <th class="pb-2 text-left font-medium pl-4 hidden sm:table-cell">Aandeel</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                @foreach($topReferers as $row)
                @php $pct = round(($row->visits / $maxRef) * 100); @endphp
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                    <td class="py-1.5 text-xs text-gray-400 font-bold">{{ $loop->iteration }}</td>
                    <td class="py-1.5 pr-2">
                        <span class="text-sm text-gray-900 dark:text-white truncate block max-w-xs" title="{{ $row->referer }}">
                            {{ $row->host }}
                        </span>
                    </td>
                    <td class="py-1.5 text-right font-semibold text-gray-900 dark:text-white whitespace-nowrap">{{ number_format($row->visits) }}</td>
                    <td class="py-1.5 pl-4 hidden sm:table-cell w-48">
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                            <div class="bg-pink-400 h-1.5 rounded-full" style="width:{{ $pct }}%"></div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

{{-- ════ RECENT VISITS ══════════════════════════════════════════════════ --}}
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5 mb-6">
    <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
        <i class="fa-solid fa-clock-rotate-left text-gray-500 mr-2"></i>Recente bezoeken (laatste 50)
    </h2>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-3 py-2 whitespace-nowrap">Tijdstip</th>
                    <th class="px-3 py-2">Categorie</th>
                    <th class="px-3 py-2">Pagina</th>
                    <th class="px-3 py-2 whitespace-nowrap">Land</th>
                    <th class="px-3 py-2 hidden md:table-cell">Regio</th>
                    <th class="px-3 py-2 hidden md:table-cell">Stad</th>
                    <th class="px-3 py-2">Apparaat</th>
                    <th class="px-3 py-2 hidden lg:table-cell">Verwijzer</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($recentVisits as $visit)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <td class="px-3 py-2 whitespace-nowrap text-gray-900 dark:text-white text-xs">{{ $visit->created_at->format('d-m H:i') }}</td>
                    <td class="px-3 py-2">
                        <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $typeBadge[$visit->page_type] ?? 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300' }}">
                            {{ $typeShort[$visit->page_type] ?? ucfirst($visit->page_type ?? '-') }}
                        </span>
                    </td>
                    <td class="px-3 py-2 max-w-[200px]">
                        @php
                            $cleanTitle = $visit->page_title
                                ?: ($routeLabels[$visit->route_name] ?? null)
                                ?: parse_url($visit->url, PHP_URL_PATH);
                        @endphp
                        <span class="font-medium text-gray-900 dark:text-white block leading-snug text-xs truncate" title="{{ $visit->url }}">
                            {{ $cleanTitle }}
                        </span>
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap">
                        @if($visit->country)
                            <span class="flex items-center gap-1.5">
                                @if($visit->country_code)
                                    <img src="https://flagcdn.com/16x12/{{ strtolower($visit->country_code) }}.png"
                                         width="16" height="12" class="rounded-sm shrink-0" onerror="this.style.display='none'">
                                @endif
                                <span class="text-xs">{{ $visit->country }}</span>
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap text-xs hidden md:table-cell">{{ $visit->region ?? '-' }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-xs hidden md:table-cell">{{ $visit->city ?? '-' }}</td>
                    <td class="px-3 py-2 whitespace-nowrap">
                        <i class="fa-solid {{ $deviceIcons[$visit->device_type] ?? 'fa-question' }} text-gray-400"></i>
                        <span class="ml-1 capitalize text-xs">{{ $visit->device_type ?? '-' }}</span>
                    </td>
                    <td class="px-3 py-2 max-w-[140px] hidden lg:table-cell">
                        @if($visit->referer)
                            <span class="text-xs truncate block" title="{{ $visit->referer }}">
                                {{ parse_url($visit->referer, PHP_URL_HOST) ?: $visit->referer }}
                            </span>
                        @else
                            <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-3 py-6 text-center text-gray-500 dark:text-gray-400">Nog geen bezoekers geregistreerd.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
<script>
(function () {
    const isDark     = document.documentElement.classList.contains('dark');
    const gridColor  = isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.06)';
    const labelColor = isDark ? '#9ca3af' : '#6b7280';

    // ── Sessies per dag ──────────────────────────────────────────────────
    const rows     = @json($perDay->values());
    const labels   = rows.map(r => r.date);
    const sessions = rows.map(r => r.sessions  ?? 0);
    const pvData   = rows.map(r => r.pageViews ?? 0);

    const visitsCtx = document.getElementById('visitsChart');
    if (visitsCtx) {
        new Chart(visitsCtx, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Paginaweergaven',
                        data: pvData,
                        backgroundColor: 'rgba(99,102,241,0.3)',
                        borderColor: 'rgba(99,102,241,0.5)',
                        borderWidth: 1,
                        borderRadius: 2,
                        order: 2,
                    },
                    {
                        label: 'Sessies',
                        data: sessions,
                        backgroundColor: 'rgba(59,130,246,0.85)',
                        borderColor: 'rgba(59,130,246,1)',
                        borderWidth: 1,
                        borderRadius: 3,
                        order: 1,
                    },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            title:     (items) => items[0]?.label ?? '',
                            label:     () => null,
                            afterBody: (items) => {
                                const i = items[0]?.dataIndex ?? 0;
                                return ['Sessies:          ' + sessions[i], 'Paginaweergaven: ' + pvData[i]];
                            },
                        }
                    },
                },
                scales: {
                    x: { ticks: { color: labelColor, maxRotation: 45, font: { size: 10 } }, grid: { color: gridColor } },
                    y: { beginAtZero: true, ticks: { color: labelColor, font: { size: 11 } }, grid: { color: gridColor } }
                }
            }
        });
    }

    // ── Apparaten donut ──────────────────────────────────────────────────
    const deviceCtx = document.getElementById('deviceChart');
    if (deviceCtx) {
        const deviceData  = @json($devices->values());
        const devLabels   = { desktop: 'Desktop', mobile: 'Mobiel', tablet: 'Tablet' };
        const devPalette  = {
            desktop: 'rgba(59,130,246,0.85)',
            mobile:  'rgba(249,115,22,0.85)',
            tablet:  'rgba(168,85,247,0.85)',
        };
        new Chart(deviceCtx, {
            type: 'doughnut',
            data: {
                labels:   deviceData.map(d => devLabels[d.device] ?? d.device),
                datasets: [{
                    data:            deviceData.map(d => d.sessions),
                    backgroundColor: deviceData.map(d => devPalette[d.device] ?? 'rgba(156,163,175,0.85)'),
                    borderWidth: 2,
                    borderColor: isDark ? '#1f2937' : '#ffffff',
                    hoverOffset: 4,
                }]
            },
            options: {
                responsive: false,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: { label: (c) => ' ' + c.label + ': ' + c.parsed }
                    }
                }
            }
        });
    }
})();
</script>
@endpush

</x-dashboard-layout>
