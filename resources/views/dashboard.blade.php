@if(auth()->user()->role === 'user')
    <x-layout>
        @push('head')<meta name="robots" content="noindex, nofollow">@endpush
        <div class="page-normal-background">
        <main class="container page user-dashboard">
            <x-breadcrumbs :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Dashboard', 'url' => route('dashboard')]
            ]" />

            <div class="dashboard-header">
                <h1 class="dashboard-title font-herina">Mijn Dashboard</h1>
                <p class="dashboard-subtitle">Welkom terug, {{ auth()->user()->first_name }}!</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <span class="alert-icon"><i class="fa-solid fa-circle-check"></i></span>
                    <span class="alert-text">{{ session('success') }}</span>
                    <button type="button" class="alert-close"
                        onclick="this.parentElement.style.display='none';">×</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                    <span class="alert-text">{{ session('error') }}</span>
                    <button type="button" class="alert-close"
                        onclick="this.parentElement.style.display='none';">×</button>
                </div>
            @endif

            <x-user-dashboard-layout>
                @livewire('user-dashboard')
            </x-user-dashboard-layout>
        </main>
        <div class="gradient-border"></div>
        <x-footer></x-footer>
        </div>
    </x-layout>
@else
    <x-dashboard-layout>

        @if(session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Welkom terug, {{ $user->first_name }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ now()->isoFormat('dddd D MMMM YYYY') }}</p>
        </div>

        {{-- Stat cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Omzet deze maand</span>
                    <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900 flex items-center justify-center">
                        <i class="fa-solid fa-euro-sign text-green-600 dark:text-green-400 text-sm"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">€{{ number_format($stats['revenue_month'], 2, ',', '.') }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Totaal: €{{ number_format($stats['revenue_total'], 2, ',', '.') }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Bestellingen</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                        <i class="fa-solid fa-bag-shopping text-blue-600 dark:text-blue-400 text-sm"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['orders_total'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    @if($stats['orders_pending'] > 0)
                        <span class="text-yellow-600 dark:text-yellow-400 font-medium">{{ $stats['orders_pending'] }} wachtend</span>
                    @else
                        Vandaag: {{ $stats['orders_today'] }}
                    @endif
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Klanten</span>
                    <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                        <i class="fa-solid fa-users text-purple-600 dark:text-purple-400 text-sm"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['customers_total'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">+{{ $stats['customers_month'] }} deze maand</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Producten</span>
                    <div class="w-8 h-8 rounded-lg bg-orange-100 dark:bg-orange-900 flex items-center justify-center">
                        <i class="fa-solid fa-box-open text-orange-600 dark:text-orange-400 text-sm"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['products_total'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $stats['subscribers_total'] }} nieuwsbriefabonnees</p>
            </div>

        </div>

        {{-- Recent orders + quick links --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            {{-- Recent orders table --}}
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white">Recente bestellingen</h2>
                    <a href="{{ route('orderIndex') }}" class="text-xs text-primary-600 hover:underline dark:text-primary-400">Alle bestellingen →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 uppercase">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Klant</th>
                                <th class="px-4 py-2">Bedrag</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Datum</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($recent_orders as $order)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-4 py-2.5 font-medium text-gray-900 dark:text-white">#{{ $order->id }}</td>
                                <td class="px-4 py-2.5 text-gray-600 dark:text-gray-400">
                                    {{ $order->customer?->first_name }} {{ $order->customer?->last_name }}
                                </td>
                                <td class="px-4 py-2.5 text-gray-900 dark:text-white font-medium">
                                    €{{ number_format($order->total_after_discount ?? $order->total, 2, ',', '.') }}
                                </td>
                                <td class="px-4 py-2.5">
                                    @php
                                        $statusColor = match($order->status) {
                                            'completed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                            'shipped'   => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                            default     => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                        {{ $order->status_label }}
                                    </span>
                                </td>
                                <td class="px-4 py-2.5 text-gray-500 dark:text-gray-400 text-xs">
                                    {{ $order->created_at->format('d-m-Y') }}
                                </td>
                                <td class="px-4 py-2.5 text-right">
                                    <a href="{{ route('orderShow', $order->id) }}"
                                       class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400">
                                        Bekijken
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-400 dark:text-gray-500">Nog geen bestellingen</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Quick links --}}
            <div class="space-y-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-3">Snelle acties</h2>
                    <div class="space-y-2">
                        <a href="{{ route('orderCreatePage') }}"
                            class="flex items-center gap-3 p-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-7 h-7 rounded-md bg-blue-100 dark:bg-blue-900 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-plus text-blue-600 dark:text-blue-400 text-xs"></i>
                            </div>
                            Nieuwe bestelling
                        </a>
                        <a href="{{ route('productCreatePage') }}"
                            class="flex items-center gap-3 p-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-7 h-7 rounded-md bg-green-100 dark:bg-green-900 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-box-open text-green-600 dark:text-green-400 text-xs"></i>
                            </div>
                            Nieuw product
                        </a>
                        <a href="{{ route('discountCreate') }}"
                            class="flex items-center gap-3 p-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-7 h-7 rounded-md bg-orange-100 dark:bg-orange-900 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-percent text-orange-600 dark:text-orange-400 text-xs"></i>
                            </div>
                            Kortingscode aanmaken
                        </a>
                        <a href="{{ route('newsletter.campaigns.create') }}"
                            class="flex items-center gap-3 p-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-7 h-7 rounded-md bg-purple-100 dark:bg-purple-900 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-newspaper text-purple-600 dark:text-purple-400 text-xs"></i>
                            </div>
                            Nieuwsbrief versturen
                        </a>
                        <a href="{{ route('exportOrders') }}"
                            class="flex items-center gap-3 p-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-7 h-7 rounded-md bg-gray-100 dark:bg-gray-700 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-download text-gray-600 dark:text-gray-400 text-xs"></i>
                            </div>
                            Bestellingen exporteren
                        </a>
                    </div>
                </div>

                {{-- Pending orders alert --}}
                @if($stats['orders_pending'] > 0)
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-yellow-500 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-yellow-800 dark:text-yellow-400">{{ $stats['orders_pending'] }} wachtende bestelling{{ $stats['orders_pending'] > 1 ? 'en' : '' }}</p>
                            <a href="{{ route('orderIndex') }}" class="text-xs text-yellow-700 dark:text-yellow-500 hover:underline">Bekijk bestellingen →</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>

    </x-dashboard-layout>
@endif
