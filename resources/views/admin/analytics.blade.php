<x-dashboard-layout>
@section('title', 'Analytics')

{{-- Header --}}
<div class="mb-6 flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Bezoekersstatistieken</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Overzicht van alle bezoekers op de website</p>
    </div>
    <form method="GET" action="{{ route('admin.analytics') }}" class="flex items-center gap-2">
        <label class="text-sm text-gray-600 dark:text-gray-300">Periode:</label>
        <select name="period" onchange="this.form.submit()"
            class="text-sm border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-1.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
            @foreach(['7' => 'Afgelopen 7 dagen', '14' => 'Afgelopen 14 dagen', '30' => 'Afgelopen 30 dagen', '90' => 'Afgelopen 90 dagen', '365' => 'Afgelopen jaar'] as $val => $label)
                <option value="{{ $val }}" {{ $period == $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </form>
</div>

{{-- Summary cards --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
    @php
        $cards = [
            ['label' => 'Paginaweergaven', 'value' => number_format($totalVisits),    'icon' => 'fa-eye',                  'color' => 'blue'],
            ['label' => 'Unieke sessies',   'value' => number_format($uniqueSessions), 'icon' => 'fa-user-check',           'color' => 'indigo'],
            ['label' => 'Unieke IPs',       'value' => number_format($uniqueIPs),      'icon' => 'fa-network-wired',        'color' => 'purple'],
            ['label' => 'Desktop',          'value' => number_format($desktopVisits),  'icon' => 'fa-desktop',              'color' => 'green'],
            ['label' => 'Mobiel',           'value' => number_format($mobileVisits),   'icon' => 'fa-mobile-screen',        'color' => 'orange'],
            ['label' => 'Tablet',           'value' => number_format($tabletVisits),   'icon' => 'fa-tablet-screen-button', 'color' => 'pink'],
        ];
        $colorMap = [
            'blue'   => 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400',
            'indigo' => 'bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-400',
            'purple' => 'bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-400',
            'green'  => 'bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400',
            'orange' => 'bg-orange-100 dark:bg-orange-900 text-orange-600 dark:text-orange-400',
            'pink'   => 'bg-pink-100 dark:bg-pink-900 text-pink-600 dark:text-pink-400',
        ];
    @endphp
    @foreach($cards as $card)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ $card['label'] }}</span>
            <div class="w-8 h-8 rounded-lg {{ $colorMap[$card['color']] }} flex items-center justify-center">
                <i class="fa-solid {{ $card['icon'] }} text-sm"></i>
            </div>
        </div>
        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $card['value'] }}</p>
    </div>
    @endforeach
</div>

{{-- Bezoeken per dag + per categorie --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Bezoeken per dag</h2>
            <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                <span class="flex items-center gap-1.5">
                    <span class="inline-block w-3 h-3 rounded-sm" style="background:rgba(59,130,246,0.85)"></span> Unieke sessies
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="inline-block w-3 h-3 rounded-sm" style="background:rgba(59,130,246,0.25)"></span> Paginaweergaven
                </span>
            </div>
        </div>
        <div class="relative h-48"><canvas id="visitsChart"></canvas></div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Per categorie</h2>
        @php
            $typeLabels = [
                'product'      => 'Producten',
                'online_lezen' => 'Online lezen',
                'audiobook'    => 'Audioboeken',
                'shop'         => 'Winkel',
                'home'         => 'Homepage',
                'page'         => "Pagina's",
            ];
            $typeTotal = $visitsByType->sum('total') ?: 1;
        @endphp
        <div class="space-y-3">
            @forelse($visitsByType as $vt)
            @php
                $pct   = round(($vt->total / $typeTotal) * 100);
                $label = $typeLabels[$vt->page_type] ?? ucfirst($vt->page_type ?? 'Onbekend');
            @endphp
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-gray-700 dark:text-gray-300">{{ $label }}</span>
                    <span class="font-semibold text-gray-900 dark:text-white">{{ number_format($vt->total) }} <span class="text-gray-400 font-normal">({{ $pct }}%)</span></span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                    <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen data</p>
            @endforelse
        </div>
    </div>
</div>

{{-- Hourly heatmap --}}
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5 mb-6">
    <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Populairste uren op de dag</h2>
    @php $maxHour = $hourlyData->max('total') ?: 1; @endphp
    <div class="grid grid-cols-12 gap-1">
        @foreach($hourlyData as $h)
        @php $pct = round(($h['total'] / $maxHour) * 100); @endphp
        <div class="flex flex-col items-center">
            <div class="w-full flex items-end justify-center" style="height:48px">
                <div class="w-full rounded-sm bg-blue-{{ $pct > 75 ? '600' : ($pct > 40 ? '400' : ($pct > 10 ? '200' : '50')) }} dark:bg-blue-{{ $pct > 75 ? '500' : ($pct > 40 ? '700' : ($pct > 10 ? '800' : '900')) }}"
                    style="height:{{ max(4,$pct) }}%" title="{{ $h['hour'] }}:00 - {{ $h['total'] }} bezoeken"></div>
            </div>
            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ str_pad($h['hour'],2,'0',STR_PAD_LEFT) }}</span>
        </div>
        @endforeach
    </div>
</div>

{{-- Countries and Cities --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-earth-europe text-blue-500 mr-2"></i>Top landen
        </h2>
        @if($topCountries->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen locatiedata - nieuwe bezoeken worden automatisch opgeslagen.</p>
        @else
        @php $maxCS = $topCountries->max('sessions') ?: 1; @endphp
        <div class="space-y-2">
            @foreach($topCountries as $i => $row)
            @php $pct = round(($row->sessions / $maxCS) * 100); @endphp
            <div>
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="text-xs font-bold text-gray-400 w-4 text-right shrink-0">{{ $i+1 }}</span>
                    @if($row->country_code)
                        <img src="https://flagcdn.com/16x12/{{ strtolower($row->country_code) }}.png"
                             width="16" height="12" alt="{{ $row->country_code }}"
                             class="rounded-sm shrink-0" onerror="this.style.display='none'">
                    @endif
                    <span class="flex-1 text-sm text-gray-900 dark:text-white truncate">{{ $row->country ?? 'Onbekend' }}</span>
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 shrink-0">
                        {{ number_format($row->sessions) }}
                        <span class="text-xs font-normal text-gray-400">sessies</span>
                        <span class="text-xs font-normal text-gray-400">({{ number_format($row->visits) }} pv)</span>
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

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-city text-indigo-500 mr-2"></i>Top steden
        </h2>
        @if($topCities->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen locatiedata - nieuwe bezoeken worden automatisch opgeslagen.</p>
        @else
        @php $maxCityS = $topCities->max('sessions') ?: 1; @endphp
        <div class="space-y-2">
            @foreach($topCities as $i => $row)
            @php $pct = round(($row->sessions / $maxCityS) * 100); @endphp
            <div>
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="text-xs font-bold text-gray-400 w-4 text-right shrink-0">{{ $i+1 }}</span>
                    @if($row->country_code)
                        <img src="https://flagcdn.com/16x12/{{ strtolower($row->country_code) }}.png"
                             width="16" height="12" alt="{{ $row->country_code }}"
                             class="rounded-sm shrink-0" onerror="this.style.display='none'">
                    @endif
                    <span class="flex-1 text-sm text-gray-900 dark:text-white truncate">{{ $row->city }}</span>
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 shrink-0">
                        {{ number_format($row->sessions) }}
                        <span class="text-xs font-normal text-gray-400">sessies</span>
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
</div>

{{-- Top content tables --}}
<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-box-open text-orange-500 mr-2"></i>Meest bekeken producten
        </h2>
        @if($topProducts->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen data</p>
        @else
        <div class="space-y-2">
            @foreach($topProducts as $i => $row)
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-gray-400 w-4 text-right">{{ $i+1 }}</span>
                <p class="flex-1 text-sm font-medium text-gray-900 dark:text-white truncate">{{ $row->page_title }}</p>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 shrink-0">{{ number_format($row->visits) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-book-open text-blue-500 mr-2"></i>Meest gelezen boeken (online)
        </h2>
        @if($topOnlineLezen->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen data</p>
        @else
        <div class="space-y-2">
            @foreach($topOnlineLezen as $i => $row)
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-gray-400 w-4 text-right">{{ $i+1 }}</span>
                <p class="flex-1 text-sm font-medium text-gray-900 dark:text-white truncate">{{ $row->page_title }}</p>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 shrink-0">{{ number_format($row->visits) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-headphones text-purple-500 mr-2"></i>Meest beluisterde audioboeken
        </h2>
        @if($topAudiobooks->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen data</p>
        @else
        <div class="space-y-2">
            @foreach($topAudiobooks as $i => $row)
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-gray-400 w-4 text-right">{{ $i+1 }}</span>
                <p class="flex-1 text-sm font-medium text-gray-900 dark:text-white truncate">{{ $row->page_title }}</p>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 shrink-0">{{ number_format($row->visits) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- Top pages + referers --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-file-lines text-green-500 mr-2"></i>Meest bezochte pagina's
        </h2>
        @php
            $routeLabels = [
                'home'        => 'Homepage',
                'shop'        => 'Winkel',
                'onlineLezen' => 'Bibliotheek overzicht',
                'audiobooks'  => 'Audioboeken overzicht',
                'risale'      => 'Risale-i Nur',
                'herzameling' => 'Herzameling',
                'saidnursi'   => 'Said Nursi',
                'contact'     => 'Contact',
            ];
        @endphp
        @if($topPages->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen data</p>
        @else
        <div class="space-y-2">
            @foreach($topPages as $i => $row)
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-gray-400 w-4 text-right">{{ $i+1 }}</span>
                <p class="flex-1 text-sm font-medium text-gray-900 dark:text-white truncate">
                    {{ $routeLabels[$row->route_name] ?? ucfirst(str_replace('_',' ',$row->route_name ?? '')) }}
                </p>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 shrink-0">{{ number_format($row->visits) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fa-solid fa-arrow-pointer text-pink-500 mr-2"></i>Top verwijzers
        </h2>
        @if($topReferers->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Nog geen data</p>
        @else
        <div class="space-y-2">
            @foreach($topReferers as $i => $row)
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-gray-400 w-4 text-right">{{ $i+1 }}</span>
                <p class="flex-1 text-sm font-medium text-gray-900 dark:text-white truncate" title="{{ $row->referer }}">
                    {{ parse_url($row->referer, PHP_URL_HOST) ?: $row->referer }}
                </p>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 shrink-0">{{ number_format($row->visits) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- Recent visits --}}
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5 mb-6">
    <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
        <i class="fa-solid fa-clock-rotate-left text-gray-500 mr-2"></i>Recente bezoeken (laatste 50)
    </h2>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-3 py-2">Tijdstip</th>
                    <th class="px-3 py-2">Categorie</th>
                    <th class="px-3 py-2">Pagina / Titel</th>
                    <th class="px-3 py-2">Locatie</th>
                    <th class="px-3 py-2">Apparaat</th>
                    <th class="px-3 py-2">Verwijzer</th>
                    <th class="px-3 py-2">Ingelogd</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @php
                    $typeBadge = [
                        'product'      => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300',
                        'online_lezen' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                        'audiobook'    => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                        'shop'         => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                        'home'         => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                        'page'         => 'bg-teal-100 text-teal-800 dark:bg-teal-900 dark:text-teal-300',
                    ];
                    $deviceIcon = [
                        'desktop' => 'fa-desktop',
                        'mobile'  => 'fa-mobile-screen',
                        'tablet'  => 'fa-tablet-screen-button',
                    ];
                    $typeLabels2 = [
                        'product'      => 'Product',
                        'online_lezen' => 'Online lezen',
                        'audiobook'    => 'Audioboek',
                        'shop'         => 'Winkel',
                        'home'         => 'Homepage',
                        'page'         => 'Pagina',
                    ];
                @endphp
                @forelse($recentVisits as $visit)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <td class="px-3 py-2 whitespace-nowrap text-gray-900 dark:text-white">
                        {{ $visit->created_at->format('d-m H:i') }}
                    </td>
                    <td class="px-3 py-2">
                        <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $typeBadge[$visit->page_type] ?? 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300' }}">
                            {{ $typeLabels2[$visit->page_type] ?? ucfirst($visit->page_type ?? '-') }}
                        </span>
                    </td>
                    <td class="px-3 py-2 max-w-xs">
                        @if($visit->page_title)
                            <span class="font-medium text-gray-900 dark:text-white truncate block max-w-xs" title="{{ $visit->url }}">{{ $visit->page_title }}</span>
                        @else
                            <span class="text-gray-500 dark:text-gray-400 truncate block max-w-xs" title="{{ $visit->url }}">{{ $visit->url }}</span>
                        @endif
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap">
                        @if($visit->country || $visit->city)
                            <span class="flex items-center gap-1.5">
                                @if($visit->country_code)
                                    <img src="https://flagcdn.com/16x12/{{ strtolower($visit->country_code) }}.png"
                                         width="16" height="12" alt="{{ $visit->country_code }}"
                                         class="rounded-sm shrink-0" onerror="this.style.display='none'">
                                @endif
                                <span class="text-xs text-gray-700 dark:text-gray-300">
                                    {{ $visit->city ? $visit->city . ($visit->country ? ', ' . $visit->country : '') : $visit->country }}
                                </span>
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap">
                        <i class="fa-solid {{ $deviceIcon[$visit->device_type] ?? 'fa-question' }} text-gray-400"></i>
                        <span class="ml-1 capitalize">{{ $visit->device_type ?? '-' }}</span>
                    </td>
                    <td class="px-3 py-2 max-w-xs">
                        @if($visit->referer)
                            <span class="text-xs truncate block max-w-[160px]" title="{{ $visit->referer }}">
                                {{ parse_url($visit->referer, PHP_URL_HOST) ?: $visit->referer }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap">
                        @if($visit->user_id)
                            <span class="text-xs px-2 py-0.5 rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 font-medium">Ja</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-3 py-6 text-center text-gray-500 dark:text-gray-400">
                        Nog geen bezoekers geregistreerd.
                    </td>
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

    const sessionDates  = @json($sessionsPerDay->pluck('date'));
    const pageViewDates = @json($visitsPerDay->pluck('date'));
    const allDates = [...new Set([...sessionDates, ...pageViewDates])].sort();

    const sessionMap = Object.fromEntries(@json($sessionsPerDay->map(fn($r) => [$r->date, $r->total])));
    const pvMap      = Object.fromEntries(@json($visitsPerDay->map(fn($r) => [$r->date, $r->total])));

    const sessionData = allDates.map(d => sessionMap[d] ?? 0);
    const pvData      = allDates.map(d => pvMap[d]      ?? 0);

    const ctx = document.getElementById('visitsChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: allDates,
            datasets: [
                {
                    label: 'Paginaweergaven',
                    data: pvData,
                    backgroundColor: 'rgba(59,130,246,0.2)',
                    borderColor: 'rgba(59,130,246,0.35)',
                    borderWidth: 1,
                    borderRadius: 2,
                    order: 2,
                },
                {
                    label: 'Unieke sessies',
                    data: sessionData,
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
                        title: (items) => items[0]?.label ?? '',
                        label: () => null,
                        afterBody: (items) => {
                            const i = items[0]?.dataIndex ?? 0;
                            return [
                                'Unieke sessies:   ' + sessionData[i],
                                'Paginaweergaven: ' + pvData[i],
                            ];
                        },
                    }
                },
            },
            scales: {
                x: {
                    ticks: { color: labelColor, maxRotation: 45, font: { size: 10 } },
                    grid:  { color: gridColor },
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: labelColor, font: { size: 11 } },
                    grid:  { color: gridColor },
                }
            }
        }
    });
})();
</script>
@endpush

</x-dashboard-layout>
