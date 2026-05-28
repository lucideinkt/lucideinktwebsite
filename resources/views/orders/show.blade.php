<x-dashboard-layout>
@push('head')
  <script src="https://cdn.jsdelivr.net/npm/vue@3.4/dist/vue.global.prod.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@myparcel/delivery-options@6/dist/myparcel.lib.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@myparcel/delivery-options@6/dist/style.css" />
@endpush

    {{-- Page header --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('orderIndex') }}"
               class="p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Bestelling #{{ $order->id }}</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $order->created_at->format('d-m-Y H:i') }}</p>
            </div>
        </div>
        @php
            $statusColor = match($order->status) {
                'completed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                'shipped'   => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                default     => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            };
            $payColor = match($order->payment_status) {
                'paid'      => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                'failed'    => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                'refunded'  => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                default     => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            };
        @endphp
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColor }}">{{ $order->status_label }}</span>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $payColor }}">{{ $order->payment_status_label }}</span>
        </div>
    </div>

    @if(session('success'))
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- LEFT: order items + totals --}}
        <div class="lg:col-span-2 space-y-4">

            {{-- Order note --}}
            @if($order->order_note)
            <div class="flex items-start gap-3 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg">
                <i class="fa-solid fa-note-sticky text-amber-500 mt-0.5"></i>
                <div>
                    <p class="text-xs font-semibold text-amber-800 dark:text-amber-400 uppercase tracking-wide mb-0.5">Bestelnotitie</p>
                    <p class="text-sm text-amber-900 dark:text-amber-300">{{ $order->order_note }}</p>
                </div>
            </div>
            @endif

            {{-- Items table --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white">Bestelde producten</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 uppercase">
                            <tr>
                                <th class="px-4 py-2.5 text-left">Product</th>
                                <th class="px-4 py-2.5 text-center">Aantal</th>
                                <th class="px-4 py-2.5 text-right">Stukprijs</th>
                                <th class="px-4 py-2.5 text-right">Subtotaal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($order->items as $item)
                            <tr>
                                <td class="px-4 py-3 text-gray-900 dark:text-white font-medium">{{ $item->product_name }}</td>
                                <td class="px-4 py-3 text-center text-gray-600 dark:text-gray-400">{{ $item->quantity }}</td>
                                <td class="px-4 py-3 text-right text-gray-600 dark:text-gray-400">€{{ number_format($item->unit_price, 2, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-gray-900 dark:text-white font-medium">€{{ number_format($item->subtotal, 2, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-4 py-8 text-center text-gray-400">Geen items gevonden.</td></tr>
                            @endforelse
                        </tbody>
                        <tfoot class="border-t-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <td colspan="3" class="px-4 py-2.5 text-right text-sm text-gray-600 dark:text-gray-400">Subtotaal</td>
                                <td class="px-4 py-2.5 text-right text-sm font-medium text-gray-900 dark:text-white">€{{ number_format($order->total_before, 2, ',', '.') }}</td>
                            </tr>
                            @if($order->discount_value > 0)
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-right text-sm text-gray-600 dark:text-gray-400">
                                    Korting ({{ $order->discount_type == 'percent' ? (int)$order->discount_value . '%' : '€' . number_format($order->discount_value, 2, ',', '.') }})
                                    @if($order->discount_code_checkout)
                                        <span class="ml-1 text-xs bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-1.5 py-0.5 rounded font-mono">{{ $order->discount_code_checkout }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-right text-sm font-medium text-red-600 dark:text-red-400">-€{{ number_format($order->discount_price_total, 2, ',', '.') }}</td>
                            </tr>
                            @endif
                            @if(!empty($order->shipping_cost_amount) && $order->shipping_cost_amount > 0)
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-right text-sm text-gray-600 dark:text-gray-400">Verzendkosten</td>
                                <td class="px-4 py-2 text-right text-sm font-medium text-gray-900 dark:text-white">€{{ number_format((float)$order->shipping_cost_amount, 2, ',', '.') }}</td>
                            </tr>
                            @endif
                            <tr class="border-t border-gray-200 dark:border-gray-600">
                                <td colspan="3" class="px-4 py-3 text-right text-sm font-bold text-gray-900 dark:text-white">Totaal</td>
                                <td class="px-4 py-3 text-right text-base font-bold text-gray-900 dark:text-white">€{{ number_format($order->total, 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Addresses --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-file-invoice text-gray-400 w-4 text-center"></i>
                        Factuuradres
                        @if($order->customer->billing_company)
                            <span class="ml-auto text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 px-2 py-0.5 rounded-full flex items-center gap-1">
                                <i class="fa-solid fa-building text-xs"></i> Bedrijfsklant
                            </span>
                        @endif
                    </h3>
                    <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                        @if($order->customer->billing_company)
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $order->customer->billing_company }}</p>
                            <p class="text-gray-500 dark:text-gray-400 text-xs">t.a.v. {{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</p>
                        @else
                            <p class="font-medium text-gray-900 dark:text-white">{{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</p>
                        @endif
                        <p>{{ $order->customer->billing_street }} {{ $order->customer->billing_house_number }}{{ $order->customer->billing_house_number_addition ? ' '.$order->customer->billing_house_number_addition : '' }}</p>
                        <p>{{ $order->customer->billing_postal_code }}, {{ $order->customer->billing_city }}</p>
                        <p>{{ $order->customer->billing_country }}</p>
                        @if($order->customer->btw_nummer || $order->customer->kvk_nummer || $order->customer->rsin_nummer)
                            <div class="mt-2 pt-2 border-t border-gray-100 dark:border-gray-700 text-xs space-y-0.5 text-gray-500 dark:text-gray-400">
                                @if($order->customer->btw_nummer)
                                    <p><span class="font-medium text-gray-600 dark:text-gray-300">BTW-nr:</span> {{ $order->customer->btw_nummer }}</p>
                                @endif
                                @if($order->customer->kvk_nummer)
                                    <p><span class="font-medium text-gray-600 dark:text-gray-300">KVK:</span> {{ $order->customer->kvk_nummer }}</p>
                                @endif
                                @if($order->customer->rsin_nummer)
                                    <p><span class="font-medium text-gray-600 dark:text-gray-300">RSIN:</span> {{ $order->customer->rsin_nummer }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-truck text-gray-400 w-4 text-center"></i>
                        Verzendadres
                    </h3>
                    @php
                        $sStreet  = $order->shipping_street ?: $order->customer->billing_street;
                        $sNumber  = $order->shipping_house_number ?: $order->customer->billing_house_number;
                        $sAdd     = $order->shipping_house_number_addition ?: $order->customer->billing_house_number_addition;
                        $sZip     = $order->shipping_postal_code ?: $order->customer->billing_postal_code;
                        $sCity    = $order->shipping_city ?: $order->customer->billing_city;
                        $sCountry = $order->shipping_country ?: $order->customer->billing_country;
                    @endphp
                    <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                        <p class="font-medium text-gray-900 dark:text-white">{{ $order->shipping_first_name ?: $order->customer->billing_first_name }} {{ $order->shipping_last_name ?: $order->customer->billing_last_name }}</p>
                        <p>{{ $sStreet }} {{ $sNumber }}{{ $sAdd ? ' '.$sAdd : '' }}</p>
                        <p>{{ $sZip }}, {{ $sCity }}</p>
                        <p>{{ $sCountry }}</p>
                    </div>
                </div>
            </div>

            {{-- Edit Order Details --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <button type="button" onclick="document.getElementById('edit-details-panel').classList.toggle('hidden');this.querySelector('i.fa-chevron-down').classList.toggle('rotate-180')"
                    class="w-full flex items-center justify-between p-4 text-left">
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-pen-to-square text-gray-400"></i>
                        Bestelgegevens bewerken
                    </h2>
                    <i class="fa-solid fa-chevron-down text-gray-400 text-xs transition-transform duration-200"></i>
                </button>
                @php
                    $detailsFields = ['billing_first_name','billing_last_name','billing_email','billing_company',
                        'billing_street','billing_house_number','billing_house_number_add','billing_postal_code',
                        'billing_city','billing_country','billing_phone','shipping_first_name','shipping_last_name',
                        'shipping_street','shipping_house_number','shipping_postal_code','shipping_city',
                        'shipping_country','order_note','kvk_nummer','rsin_nummer','btw_nummer'];
                    $hasDetailsErrors = $errors->hasAny($detailsFields);
                @endphp
                <div id="edit-details-panel" class="{{ $hasDetailsErrors ? '' : 'hidden' }} border-t border-gray-200 dark:border-gray-700">
                    <form action="{{ route('orderUpdateDetails', $order->id) }}" method="POST" class="p-4 space-y-5">
                        @csrf
                        @method('PUT')

                        @if($errors->hasAny($detailsFields))
                        <div class="p-3 rounded-lg bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-800">
                            <p class="text-xs font-semibold text-red-700 dark:text-red-400 mb-1"><i class="fa-solid fa-triangle-exclamation mr-1"></i>Controleer de onderstaande velden:</p>
                            <ul class="list-disc list-inside text-xs text-red-600 dark:text-red-400 space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        {{-- Factuuradres --}}
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-file-invoice text-gray-400 w-4"></i> Factuuradres
                            </h3>
                            <div class="space-y-3">
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Voornaam</label>
                                        <input type="text" name="billing_first_name" value="{{ old('billing_first_name', $order->customer->billing_first_name) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_first_name') border-red-500 @enderror">
                                        @error('billing_first_name')<p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Achternaam</label>
                                        <input type="text" name="billing_last_name" value="{{ old('billing_last_name', $order->customer->billing_last_name) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_last_name') border-red-500 @enderror">
                                        @error('billing_last_name')<p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">E-mailadres</label>
                                    <input type="email" name="billing_email" value="{{ old('billing_email', $order->customer->billing_email) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_email') border-red-500 @enderror">
                                    @error('billing_email')<p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Telefoonnummer</label>
                                    <input type="text" name="billing_phone" value="{{ old('billing_phone', $order->customer->billing_phone) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                <div class="grid grid-cols-3 gap-2">
                                    <div class="col-span-2">
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Straatnaam</label>
                                        <input type="text" name="billing_street" value="{{ old('billing_street', $order->customer->billing_street) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_street') border-red-500 @enderror">
                                        @error('billing_street')<p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Nr.</label>
                                        <input type="text" name="billing_house_number" value="{{ old('billing_house_number', $order->customer->billing_house_number) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_house_number') border-red-500 @enderror">
                                        @error('billing_house_number')<p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Toevoeging</label>
                                        <input type="text" name="billing_house_number_add" value="{{ old('billing_house_number_add', $order->customer->billing_house_number_addition) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Postcode</label>
                                        <input type="text" name="billing_postal_code" value="{{ old('billing_postal_code', $order->customer->billing_postal_code) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_postal_code') border-red-500 @enderror">
                                        @error('billing_postal_code')<p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Plaats</label>
                                        <input type="text" name="billing_city" value="{{ old('billing_city', $order->customer->billing_city) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_city') border-red-500 @enderror">
                                        @error('billing_city')<p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Land</label>
                                        <select name="billing_country"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <option value="NL" @selected(old('billing_country', $order->customer->billing_country) === 'NL')>Nederland</option>
                                            <option value="BE" @selected(old('billing_country', $order->customer->billing_country) === 'BE')>België</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bedrijfsgegevens --}}
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-4">
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-building text-gray-400 w-4"></i> Bedrijfsgegevens
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Bedrijfsnaam <span class="text-gray-400">(optioneel)</span></label>
                                    <input type="text" name="billing_company" value="{{ old('billing_company', $order->customer->billing_company) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">KVK-nummer <span class="text-gray-400">(optioneel)</span></label>
                                    <input type="text" name="kvk_nummer" value="{{ old('kvk_nummer', $order->customer->kvk_nummer) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">RSIN-nummer <span class="text-gray-400">(optioneel)</span></label>
                                    <input type="text" name="rsin_nummer" value="{{ old('rsin_nummer', $order->customer->rsin_nummer) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">BTW-nummer <span class="text-gray-400">(optioneel)</span></label>
                                    <input type="text" name="btw_nummer" value="{{ old('btw_nummer', $order->customer->btw_nummer) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                            </div>
                        </div>

                        {{-- Verzendadres --}}
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-4">
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-truck text-gray-400 w-4"></i> Verzendadres
                            </h3>
                            <div class="space-y-3">
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Voornaam</label>
                                        <input type="text" name="shipping_first_name" value="{{ old('shipping_first_name', $order->shipping_first_name) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Achternaam</label>
                                        <input type="text" name="shipping_last_name" value="{{ old('shipping_last_name', $order->shipping_last_name) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                </div>
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Bedrijfsnaam <span class="text-gray-400">(optioneel)</span></label>
                                    <input type="text" name="shipping_company" value="{{ old('shipping_company', $order->shipping_company) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                <div class="grid grid-cols-3 gap-2">
                                    <div class="col-span-2">
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Straatnaam</label>
                                        <input type="text" name="shipping_street" value="{{ old('shipping_street', $order->shipping_street) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Nr.</label>
                                        <input type="text" name="shipping_house_number" value="{{ old('shipping_house_number', $order->shipping_house_number) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Toevoeging</label>
                                        <input type="text" name="shipping_house_number_addition" value="{{ old('shipping_house_number_addition', $order->shipping_house_number_addition) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Postcode</label>
                                        <input type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code', $order->shipping_postal_code) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Plaats</label>
                                        <input type="text" name="shipping_city" value="{{ old('shipping_city', $order->shipping_city) }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Land</label>
                                        <select name="shipping_country"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <option value="">— Zelfde als factuuradres —</option>
                                            <option value="NL" @selected(old('shipping_country', $order->shipping_country) === 'NL')>Nederland</option>
                                            <option value="BE" @selected(old('shipping_country', $order->shipping_country) === 'BE')>België</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400">Telefoonnummer</label>
                                    <input type="text" name="shipping_phone" value="{{ old('shipping_phone', $order->shipping_phone) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                            </div>
                        </div>

                        {{-- Bestelnotitie --}}
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-4">
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-note-sticky text-gray-400 w-4"></i> Bestelnotitie
                            </h3>
                            <textarea name="order_note" rows="3"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Optionele notitie over de bestelling…">{{ old('order_note', $order->order_note) }}</textarea>
                        </div>

                        <p class="text-xs text-gray-400 dark:text-gray-500 italic">
                            <i class="fa-solid fa-rotate text-gray-400 mr-1"></i>
                            Als er al een factuur is aangemaakt, wordt deze automatisch bijgewerkt na opslaan.
                        </p>

                        <button type="submit"
                            class="w-full text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Gegevens opslaan
                        </button>
                    </form>
                </div>
            </div>

        </div>

        {{-- RIGHT sidebar --}}
        <div class="space-y-4">

            {{-- Update order form --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white">Bestelling bijwerken</h2>
                </div>
                <form action="{{ route('orderUpdate', $order->id) }}" method="POST" class="p-4 space-y-3">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block mb-1.5 text-xs font-medium text-gray-700 dark:text-gray-300">Bestelstatus</label>
                        <select name="order-status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach(['pending' => 'In afwachting', 'shipped' => 'Verzonden', 'cancelled' => 'Geannuleerd', 'completed' => 'Afgerond'] as $key => $label)
                                <option value="{{ $key }}" @selected($order->status === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1.5 text-xs font-medium text-gray-700 dark:text-gray-300">Betaalstatus</label>
                        <select name="payment-status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach(['pending' => 'In afwachting', 'paid' => 'Betaald', 'failed' => 'Mislukt', 'refunded' => 'Terugbetaald'] as $key => $label)
                                <option value="{{ $key }}" @selected($order->payment_status === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700">
                        Opslaan
                    </button>
                </form>
            </div>

            {{-- Customer info --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-3">Klantgegevens</h2>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <i class="fa-solid fa-user w-4 text-center text-gray-400"></i>
                        <span>{{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <i class="fa-solid fa-envelope w-4 text-center text-gray-400"></i>
                        <a href="mailto:{{ $order->customer->billing_email }}" class="hover:text-primary-600 dark:hover:text-primary-400">{{ $order->customer->billing_email }}</a>
                    </div>
                    @if($order->customer->billing_phone)
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <i class="fa-solid fa-phone w-4 text-center text-gray-400"></i>
                        <span>{{ $order->customer->billing_phone }}</span>
                    </div>
                    @endif
                    @if($order->customer->billing_company)
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <i class="fa-solid fa-building w-4 text-center text-gray-400"></i>
                        <span>{{ $order->customer->billing_company }}</span>
                    </div>
                    @endif
                    @if($order->customer->kvk_nummer)
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <i class="fa-solid fa-hashtag w-4 text-center text-gray-400"></i>
                        <span>KVK: {{ $order->customer->kvk_nummer }}</span>
                    </div>
                    @endif
                    @if($order->customer->rsin_nummer)
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <i class="fa-solid fa-hashtag w-4 text-center text-gray-400"></i>
                        <span>RSIN: {{ $order->customer->rsin_nummer }}</span>
                    </div>
                    @endif
                    @if($order->customer->btw_nummer)
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <i class="fa-solid fa-hashtag w-4 text-center text-gray-400"></i>
                        <span>BTW: {{ $order->customer->btw_nummer }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Invoice / actions --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-3">Factuur &amp; acties</h2>
                <div class="space-y-2">
                    @if(empty($order->invoice_pdf_path))
                        <form action="{{ route('generateInvoice', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 text-white bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700">
                                <i class="fa-solid fa-file-pdf"></i> Genereer factuur
                            </button>
                        </form>
                    @else
                        <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                            class="w-full flex items-center justify-center gap-2 text-gray-700 bg-gray-100 hover:bg-gray-200 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 font-medium rounded-lg text-sm px-4 py-2.5">
                            <i class="fa-solid fa-download"></i> Download factuur
                        </a>
                        <form action="{{ route('sendOrderEmailWithInvoice', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 text-white bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700">
                                <i class="fa-solid fa-envelope"></i> Verstuur e-mail met factuur
                            </button>
                        </form>
                    @endif

                    @if($order->payment_status !== 'paid' && $order->payment_link)
                    <div class="mt-2 pt-3 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Betaallink</p>
                        <div class="flex gap-2">
                            <a href="{{ $order->payment_link }}" target="_blank"
                                class="flex-1 text-center text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-xs px-3 py-2">
                                Openen
                            </a>
                            <button type="button" data-payment-link="{{ $order->payment_link }}" onclick="navigator.clipboard.writeText(this.dataset.paymentLink);this.textContent='Gekopieerd!';setTimeout(()=>this.textContent='Kopieer',2000)"
                                class="flex-1 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 font-medium rounded-lg text-xs px-3 py-2">
                                Kopieer
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Nieuwe betaallink genereren --}}
                    <div class="pt-2 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2 flex items-center gap-1">
                            <i class="fa-solid fa-rotate text-gray-400"></i>
                            Nieuwe betaallink
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mb-2">
                            Gebruik dit als de klant de betaling per ongeluk heeft geannuleerd of als de link is verlopen.
                            De betaalstatus wordt teruggezet naar <em>In afwachting</em>.
                        </p>
                        <form action="{{ route('orderRegeneratePaymentLink', $order->id) }}" method="POST"
                              onsubmit="return confirm('Weet je zeker dat je een nieuwe betaallink wilt genereren? De betaalstatus wordt teruggezet naar In afwachting.')">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 text-white bg-amber-600 hover:bg-amber-700 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-amber-500 dark:hover:bg-amber-600">
                                <i class="fa-solid fa-link"></i> Nieuwe betaallink genereren
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- MyParcel --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-truck-fast text-gray-400"></i>
                    MyParcel
                </h2>
                @if($order->myparcel_consignment_id)
                    @php
                        $packageTypes = [1 => 'Pakket', 2 => 'Brievenbuspakje', 3 => 'Brief', 4 => 'Digitale postzegel'];
                        $deliveryTypes = ['standard' => 'Thuisbezorging', 'pickup' => 'Afhaalpunt'];
                    @endphp
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Carrier</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ ucfirst($order->myparcel_carrier ?? 'PostNL') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Pakket type</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $packageTypes[$order->myparcel_package_type_id] ?? '-' }}</span>
                        </div>
                        @if($order->myparcel_delivery_type)
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Bezorgtype</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $deliveryTypes[$order->myparcel_delivery_type] ?? $order->myparcel_delivery_type }}</span>
                        </div>
                        @endif
                        @if($order->myparcel_delivery_type === 'pickup' && isset($pickupLocation))
                        <div class="mt-2 pt-2 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-600 dark:text-gray-400">
                            <p class="font-medium text-gray-900 dark:text-white mb-0.5">Afhaalpunt</p>
                            <p>{{ $pickupLocation['locationName'] ?? '-' }}</p>
                            <p>{{ ($pickupLocation['street'] ?? '') . ' ' . ($pickupLocation['number'] ?? '') }}</p>
                            <p>{{ ($pickupLocation['postalCode'] ?? '') . ' ' . ($pickupLocation['city'] ?? '') }}</p>
                        </div>
                        @endif
                        @if($order->myparcel_track_trace_url)
                        <a href="{{ $order->myparcel_track_trace_url }}" target="_blank"
                            class="flex items-center justify-center gap-2 mt-1 text-primary-700 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 hover:bg-primary-100 dark:hover:bg-primary-900/40 rounded-lg px-3 py-2 text-xs font-medium">
                            <i class="fa-solid fa-location-dot"></i>
                            Track &amp; Trace: {{ $order->myparcel_barcode }}
                        </a>
                        @endif
                        @if($order->myparcel_label_link)
                            <a href="{{ $order->myparcel_label_link }}" target="_blank"
                                class="w-full flex items-center justify-center gap-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 font-medium rounded-lg text-xs px-3 py-2 mt-1">
                                <i class="fa-solid fa-tag"></i> Download label (PDF)
                            </a>
                        @else
                            <form action="{{ route('orderUpdatePackageType', $order->id) }}" method="POST" class="mt-1">
                                @csrf
                                <select name="package_type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg block w-full p-2 mb-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    @foreach($packageTypes as $key => $label)
                                        <option value="{{ $key }}" @selected($order->myparcel_package_type_id == $key)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                    class="w-full text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 font-medium rounded-lg text-xs px-3 py-2">
                                    Update pakket type
                                </button>
                            </form>
                            <form action="{{ route('orderGenerateLabel', $order->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 text-white bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-xs px-3 py-2 dark:bg-primary-600 dark:hover:bg-primary-700">
                                    <i class="fa-solid fa-tag"></i> Label aanmaken bij MyParcel
                                </button>
                            </form>
                        @endif
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">Geen MyParcel zending gekoppeld.</p>
                @endif
            </div>

        </div>
    </div>

</x-dashboard-layout>
