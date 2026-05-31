<x-dashboard-layout>
@push('head')
  <script src="https://cdn.jsdelivr.net/npm/vue@3.4/dist/vue.global.prod.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@myparcel/delivery-options@6/dist/myparcel.lib.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@myparcel/delivery-options@6/dist/style.css" />
@endpush

    {{-- Page header --}}
    <div class="flex flex-wrap items-start justify-between gap-3 mb-6">
        <div class="flex items-center gap-3 min-w-0">
            <a href="{{ route('orderIndex') }}"
               class="shrink-0 p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="min-w-0">
                <h1 class="text-xl font-bold text-gray-900 dark:text-white truncate">Bestelling #{{ $order->id }}</h1>
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
        <div class="flex items-center gap-2 shrink-0">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">{{ $order->status_label }}</span>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $payColor }}">{{ $order->payment_status_label }}</span>
        </div>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 p-4 mb-5 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
            <i class="fa-solid fa-circle-check shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 p-4 mb-5 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
            <i class="fa-solid fa-circle-exclamation shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- LEFT: main content --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Order note --}}
            @if($order->order_note)
            <div class="flex items-start gap-3 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 rounded-xl">
                <i class="fa-solid fa-note-sticky text-amber-500 mt-0.5 shrink-0"></i>
                <div>
                    <p class="text-xs font-semibold text-amber-800 dark:text-amber-400 uppercase tracking-wide mb-1">Bestelnotitie</p>
                    <p class="text-sm text-amber-900 dark:text-amber-300">{{ $order->order_note }}</p>
                </div>
            </div>
            @endif

            {{-- Items summary table --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-receipt text-gray-400"></i>
                    <h2 class="text-sm font-semibold text-gray-900 dark:text-white">Bestelde producten</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700/60 uppercase tracking-wide">
                                <th class="px-5 py-3 text-left font-medium">Product</th>
                                <th class="px-4 py-3 text-center font-medium w-16">Aantal</th>
                                <th class="px-4 py-3 text-right font-medium hidden sm:table-cell">Stukprijs</th>
                                <th class="px-5 py-3 text-right font-medium">Subtotaal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                            @forelse($order->items as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-5 py-3.5 text-gray-900 dark:text-white font-medium">
                                    {{ $item->product_name }}
                                    <span class="sm:hidden block text-xs text-gray-400 font-normal mt-0.5">€{{ number_format($item->unit_price, 2, ',', '.') }} p.s.</span>
                                </td>
                                <td class="px-4 py-3.5 text-center text-gray-500 dark:text-gray-400">{{ $item->quantity }}</td>
                                <td class="px-4 py-3.5 text-right text-gray-500 dark:text-gray-400 hidden sm:table-cell">€{{ number_format($item->unit_price, 2, ',', '.') }}</td>
                                <td class="px-5 py-3.5 text-right font-semibold text-gray-900 dark:text-white">€{{ number_format($item->subtotal, 2, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-5 py-10 text-center text-gray-400 text-sm">Geen items gevonden.</td></tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-gray-50 dark:bg-gray-700/40 border-t-2 border-gray-100 dark:border-gray-600">
                            <tr>
                                <td colspan="3" class="px-5 py-2.5 text-right text-xs text-gray-500 dark:text-gray-400">Subtotaal</td>
                                <td id="main-subtotal" class="px-5 py-2.5 text-right text-sm font-semibold text-gray-900 dark:text-white">€{{ number_format($order->total_before, 2, ',', '.') }}</td>
                            </tr>
                            <tr id="main-discount-row" class="{{ $order->discount_value > 0 ? '' : 'hidden' }}">
                                <td colspan="3" class="px-5 py-2 text-right text-xs text-gray-500 dark:text-gray-400">
                                    <span id="main-discount-label">Korting{{ $order->discount_value > 0 ? ' (' . ($order->discount_type == 'percent' ? (int)$order->discount_value . '%' : '€' . number_format($order->discount_value, 2, ',', '.')) . ')' : '' }}</span>
                                    @if($order->discount_code_checkout)
                                        <span class="ml-1 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-1.5 py-0.5 rounded font-mono text-xs">{{ $order->discount_code_checkout }}</span>
                                    @endif
                                </td>
                                <td id="main-discount-amount" class="px-5 py-2 text-right text-sm font-semibold text-red-600 dark:text-red-400">{{ $order->discount_value > 0 ? '-€' . number_format($order->discount_price_total, 2, ',', '.') : '' }}</td>
                            </tr>
                            @if(!empty($order->shipping_cost_amount) && $order->shipping_cost_amount > 0)
                            <tr id="main-shipping-row">
                                <td colspan="3" class="px-5 py-2 text-right text-xs text-gray-500 dark:text-gray-400">Verzendkosten</td>
                                <td class="px-5 py-2 text-right text-sm font-semibold text-gray-900 dark:text-white">€{{ number_format((float)$order->shipping_cost_amount, 2, ',', '.') }}</td>
                            </tr>
                            @else
                            <tr id="main-shipping-row" class="hidden">
                                <td colspan="3" class="px-5 py-2 text-right text-xs text-gray-500 dark:text-gray-400">Verzendkosten</td>
                                <td class="px-5 py-2 text-right text-sm font-semibold text-gray-900 dark:text-white">€0,00</td>
                            </tr>
                            @endif
                            <tr class="border-t border-gray-200 dark:border-gray-600">
                                <td colspan="3" class="px-5 py-3.5 text-right text-sm font-bold text-gray-900 dark:text-white">Totaal</td>
                                <td id="main-total" class="px-5 py-3.5 text-right text-base font-bold text-gray-900 dark:text-white">€{{ number_format($order->total, 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Edit Order Items + Discount --}}
            @php
                $itemsFields = ['items','discount_type','discount_value','discount_code_input'];
                $hasItemsErrors = $errors->hasAny($itemsFields);
            @endphp
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <button type="button"
                    onclick="togglePanel('edit-items-panel', this)"
                    class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-cart-shopping text-primary-500"></i> Producten &amp; kortingen bewerken
                    </span>
                    <i class="fa-solid fa-chevron-down text-gray-400 text-xs transition-transform duration-200 {{ $hasItemsErrors ? 'rotate-180' : '' }}"></i>
                </button>
                <div id="edit-items-panel" class="{{ $hasItemsErrors ? '' : 'hidden' }} border-t border-gray-100 dark:border-gray-700">
                    <form id="items-form" action="{{ route('orderUpdateAll', $order->id) }}" method="POST" class="p-5 space-y-6">
                        @csrf
                        @method('PUT')

                        @if($hasItemsErrors)
                        <div class="p-3 rounded-lg bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-800">
                            <ul class="list-disc list-inside text-xs text-red-600 dark:text-red-400 space-y-0.5">
                                @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                            </ul>
                        </div>
                        @endif

                        {{-- Current items --}}
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">Huidige producten</p>
                            <div id="items-list" class="space-y-2">
                                @foreach($order->items as $item)
                                <div class="item-row flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/60 rounded-xl border border-gray-100 dark:border-gray-600"
                                     data-unit-price="{{ $item->unit_price }}" data-row-id="{{ $loop->index }}">
                                    <input type="hidden" name="items[{{ $loop->index }}][item_id]" value="{{ $item->id }}">
                                    <input type="hidden" name="items[{{ $loop->index }}][product_id]" value="{{ $item->product_id }}">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item->product_name }}</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500">€{{ number_format($item->unit_price, 2, ',', '.') }} p.s.</p>
                                    </div>
                                    <div class="flex items-center gap-2 shrink-0">
                                        <input type="number" name="items[{{ $loop->index }}][qty]"
                                            value="{{ $item->quantity }}" min="1"
                                            class="item-qty w-16 text-center bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg p-1.5 focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                            oninput="recalcTotals()">
                                        <span class="item-subtotal text-sm font-bold text-gray-900 dark:text-white w-16 text-right">€{{ number_format($item->subtotal, 2, ',', '.') }}</span>
                                        <button type="button" onclick="removeItemRow(this)" title="Verwijder"
                                            class="p-1.5 text-red-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Add new product --}}
                        <div class="p-4 bg-gray-50 dark:bg-gray-700/40 rounded-xl border border-dashed border-gray-200 dark:border-gray-600">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">
                                <i class="fa-solid fa-plus mr-1"></i>Product toevoegen
                            </p>
                            <div class="space-y-2">
                                <select id="new-product-select"
                                    class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent block w-full p-2.5">
                                    <option value="">— Kies een product —</option>
                                    @foreach($products as $p)
                                    <option value="{{ $p->id }}"
                                        data-price="{{ $p->price }}"
                                        data-stock="{{ $p->stock }}"
                                        data-name="{{ $p->title }}">
                                        {{ $p->title }} — €{{ number_format($p->price, 2, ',', '.') }}
                                        @if($p->stock > 0)(voorraad: {{ $p->stock }})@else(uitverkocht)@endif
                                    </option>
                                    @endforeach
                                </select>
                                <p id="new-product-stock-hint" class="text-xs hidden"></p>
                                <div class="flex items-center gap-2">
                                    <label class="text-xs text-gray-500 dark:text-gray-400 shrink-0">Aantal:</label>
                                    <input type="number" id="new-product-qty" value="1" min="1"
                                        class="w-20 text-center bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg p-2 focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                    <button type="button" onclick="addProductRow()"
                                        class="flex-1 px-4 py-2 text-white bg-primary-600 hover:bg-primary-700 rounded-lg text-sm font-semibold flex items-center justify-center gap-2 transition-colors">
                                        <i class="fa-solid fa-plus"></i> Toevoegen
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Discount --}}
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">
                                <i class="fa-solid fa-tag mr-1"></i>Korting
                            </p>
                            <div class="space-y-3">
                                <div>
                                    <label class="block mb-1.5 text-xs font-medium text-gray-600 dark:text-gray-400">Kortingscode <span class="text-gray-400 font-normal">(overschrijft handmatige korting)</span></label>

                                    {{-- Dropdown with all active discount codes --}}
                                    @if($discountCodes->isEmpty())
                                        <p class="text-xs text-amber-600 dark:text-amber-400 flex items-center gap-1">
                                            <i class="fa-solid fa-circle-info"></i> Geen actieve kortingscodes beschikbaar.
                                        </p>
                                    @else
                                        <select id="discount-code-select"
                                            name="discount_code_input"
                                            class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent block w-full p-2.5"
                                            onchange="applyDiscountFromDropdown(this)">
                                            <option value="">— Geen kortingscode —</option>
                                            @foreach($discountCodes as $dc)
                                                <option value="{{ $dc->code }}"
                                                    data-discount="{{ $dc->discount }}"
                                                    data-discount-type="{{ $dc->discount_type }}"
                                                    data-description="{{ $dc->description }}"
                                                    {{ old('discount_code_input', $order->discount_code_checkout) === $dc->code ? 'selected' : '' }}>
                                                    {{ $dc->code }}
                                                    @if($dc->discount_type === 'percent')
                                                        — {{ $dc->discount }}% korting
                                                    @else
                                                        — €{{ number_format($dc->discount, 2, ',', '.') }} korting
                                                    @endif
                                                    @if($dc->description) ({{ $dc->description }}) @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <p id="discount-code-msg" class="mt-1 text-xs hidden"></p>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <div>
                                        <label class="block mb-1.5 text-xs font-medium text-gray-600 dark:text-gray-400">Handmatig type</label>
                                        <select name="discount_type" id="discount-type"
                                            class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent block w-full p-2.5"
                                            onchange="recalcTotals()">
                                            <option value="">Geen korting</option>
                                            <option value="amount" @selected(old('discount_type', $order->discount_type) === 'amount')>Bedrag (€)</option>
                                            <option value="percent" @selected(old('discount_type', $order->discount_type) === 'percent')>Percentage (%)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block mb-1.5 text-xs font-medium text-gray-600 dark:text-gray-400">Waarde</label>
                                        <input type="number" name="discount_value" id="discount-value" min="0" step="0.01"
                                            value="{{ old('discount_value', $order->discount_value > 0 && !$order->discount_code_checkout ? $order->discount_value : '') }}"
                                            placeholder="0"
                                            class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent block w-full p-2.5"
                                            oninput="recalcTotals()">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Shipping cost selector --}}
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-5">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">
                                <i class="fa-solid fa-truck mr-1"></i>Verzendkosten
                            </p>
                            <select id="shipping-cost-select" name="shipping_cost_id"
                                class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent block w-full p-2.5"
                                onchange="recalcTotals()">
                                <option value="" data-amount="0" @selected(!$order->shipping_cost_id)>— Geen verzendkosten —</option>
                                @foreach($shippingCosts as $sc)
                                <option value="{{ $sc->id }}"
                                    data-amount="{{ $sc->amount }}"
                                    @selected($order->shipping_cost_id == $sc->id)>
                                    {{ $sc->country }} — €{{ number_format($sc->amount, 2, ',', '.') }}
                                </option>
                                @endforeach
                            </select>
                            <p id="shipping-hint" class="mt-1.5 text-xs text-gray-400 dark:text-gray-500"></p>
                        </div>

                        {{-- Live totals --}}
                        <div class="rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700/60 dark:to-gray-700/30 border border-gray-200 dark:border-gray-600 p-4 space-y-2 text-sm">
                            <div class="flex justify-between items-center text-gray-600 dark:text-gray-400">
                                <span>Subtotaal</span>
                                <span id="calc-subtotal" class="font-semibold text-gray-900 dark:text-white">€0,00</span>
                            </div>
                            <div id="calc-discount-row" class="flex justify-between items-center text-red-600 dark:text-red-400 hidden">
                                <span id="calc-discount-label">Korting</span>
                                <span id="calc-discount-amount" class="font-semibold">-€0,00</span>
                            </div>
                            <div id="calc-shipping-row" class="flex justify-between items-center text-gray-600 dark:text-gray-400 {{ $order->shipping_cost_amount > 0 ? '' : 'hidden' }}">
                                <span>Verzendkosten</span>
                                <span id="calc-shipping-amount" class="font-semibold text-gray-900 dark:text-white">€{{ number_format((float)$order->shipping_cost_amount, 2, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center font-bold text-gray-900 dark:text-white border-t border-gray-200 dark:border-gray-600 pt-2 mt-1">
                                <span>Totaal</span>
                                <span id="calc-total" class="text-base">€0,00</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 rounded-lg">
                            <i class="fa-solid fa-rotate text-blue-400 mt-0.5 shrink-0 text-xs"></i>
                            <p class="text-xs text-blue-700 dark:text-blue-400">De factuur wordt automatisch bijgewerkt na opslaan.</p>
                        </div>

                        <button type="button" onclick="saveAll()"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 font-semibold rounded-xl text-sm px-4 py-3 flex items-center justify-center gap-2 transition-colors shadow-sm">
                            <i class="fa-solid fa-floppy-disk"></i> Opslaan
                        </button>
                    </form>
                </div>
            </div>

            {{-- Address cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Billing --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide flex items-center gap-1.5">
                            <i class="fa-solid fa-file-invoice text-gray-400"></i> Factuuradres
                        </h3>
                        @if($order->customer->billing_company)
                            <span class="text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 px-2 py-0.5 rounded-full flex items-center gap-1">
                                <i class="fa-solid fa-building text-xs"></i> Bedrijf
                            </span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                        @if($order->customer->billing_company)
                            <p class="font-bold text-gray-900 dark:text-white">{{ $order->customer->billing_company }}</p>
                            <p class="text-gray-500 dark:text-gray-400 text-xs">t.a.v. {{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</p>
                        @else
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</p>
                        @endif
                        <p>{{ $order->customer->billing_street }} {{ $order->customer->billing_house_number }}{{ $order->customer->billing_house_number_addition ? ' '.$order->customer->billing_house_number_addition : '' }}</p>
                        <p>{{ $order->customer->billing_postal_code }}, {{ $order->customer->billing_city }}</p>
                        <p class="text-gray-400 dark:text-gray-500">{{ $order->customer->billing_country }}</p>
                        @if($order->customer->btw_nummer || $order->customer->kvk_nummer || $order->customer->rsin_nummer)
                            <div class="mt-3 pt-3 border-t border-gray-100 dark:border-gray-700 text-xs space-y-1">
                                @if($order->customer->kvk_nummer)
                                    <p><span class="text-gray-400 dark:text-gray-500">KVK</span> <span class="font-medium text-gray-700 dark:text-gray-300 ml-1">{{ $order->customer->kvk_nummer }}</span></p>
                                @endif
                                @if($order->customer->rsin_nummer)
                                    <p><span class="text-gray-400 dark:text-gray-500">RSIN</span> <span class="font-medium text-gray-700 dark:text-gray-300 ml-1">{{ $order->customer->rsin_nummer }}</span></p>
                                @endif
                                @if($order->customer->btw_nummer)
                                    <p><span class="text-gray-400 dark:text-gray-500">BTW</span> <span class="font-medium text-gray-700 dark:text-gray-300 ml-1">{{ $order->customer->btw_nummer }}</span></p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                {{-- Shipping --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                    <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3 flex items-center gap-1.5">
                        <i class="fa-solid fa-truck text-gray-400"></i> Verzendadres
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
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $order->shipping_first_name ?: $order->customer->billing_first_name }} {{ $order->shipping_last_name ?: $order->customer->billing_last_name }}</p>
                        <p>{{ $sStreet }} {{ $sNumber }}{{ $sAdd ? ' '.$sAdd : '' }}</p>
                        <p>{{ $sZip }}, {{ $sCity }}</p>
                        <p class="text-gray-400 dark:text-gray-500">{{ $sCountry }}</p>
                    </div>
                </div>
            </div>

            {{-- Edit Order Details --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <button type="button" onclick="togglePanel('edit-details-panel', this)"
                    class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-pen-to-square text-primary-500"></i> Bestelgegevens bewerken
                    </span>
                    @php
                        $detailsFields = ['billing_first_name','billing_last_name','billing_email','billing_company',
                            'billing_street','billing_house_number','billing_house_number_add','billing_postal_code',
                            'billing_city','billing_country','billing_phone','shipping_first_name','shipping_last_name',
                            'shipping_street','shipping_house_number','shipping_postal_code','shipping_city',
                            'shipping_country','order_note','kvk_nummer','rsin_nummer','btw_nummer'];
                        $hasDetailsErrors = $errors->hasAny($detailsFields);
                    @endphp
                    <i class="fa-solid fa-chevron-down text-gray-400 text-xs transition-transform duration-200 {{ $hasDetailsErrors ? 'rotate-180' : '' }}"></i>
                </button>
                <div id="edit-details-panel" class="{{ $hasDetailsErrors ? '' : 'hidden' }} border-t border-gray-100 dark:border-gray-700">
                    <form id="form-details" action="{{ route('orderUpdateAll', $order->id) }}" method="POST" class="p-5 space-y-6">
                        @csrf
                        @method('PUT')

                        @if($hasDetailsErrors)
                        <div class="p-3 rounded-lg bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-800">
                            <p class="text-xs font-semibold text-red-700 dark:text-red-400 mb-1"><i class="fa-solid fa-triangle-exclamation mr-1"></i>Controleer de onderstaande velden:</p>
                            <ul class="list-disc list-inside text-xs text-red-600 dark:text-red-400 space-y-0.5">
                                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                        @endif

                        @php
                            $inputClass = 'bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent block w-full p-2.5';
                            $labelClass = 'block mb-1.5 text-xs font-medium text-gray-600 dark:text-gray-400';
                        @endphp

                        {{-- Factuuradres --}}
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4 flex items-center gap-1.5">
                                <i class="fa-solid fa-file-invoice text-gray-400"></i> Factuuradres
                            </p>
                            <div class="space-y-3">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="{{ $labelClass }}">Voornaam</label>
                                        <input type="text" name="billing_first_name" value="{{ old('billing_first_name', $order->customer->billing_first_name) }}"
                                            class="{{ $inputClass }} @error('billing_first_name') border-red-400 @enderror">
                                        @error('billing_first_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Achternaam</label>
                                        <input type="text" name="billing_last_name" value="{{ old('billing_last_name', $order->customer->billing_last_name) }}"
                                            class="{{ $inputClass }} @error('billing_last_name') border-red-400 @enderror">
                                        @error('billing_last_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="{{ $labelClass }}">E-mailadres</label>
                                        <input type="email" name="billing_email" value="{{ old('billing_email', $order->customer->billing_email) }}"
                                            class="{{ $inputClass }} @error('billing_email') border-red-400 @enderror">
                                        @error('billing_email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Telefoonnummer</label>
                                        <input type="text" name="billing_phone" value="{{ old('billing_phone', $order->customer->billing_phone) }}"
                                            class="{{ $inputClass }}">
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="col-span-2">
                                        <label class="{{ $labelClass }}">Straatnaam</label>
                                        <input type="text" name="billing_street" value="{{ old('billing_street', $order->customer->billing_street) }}"
                                            class="{{ $inputClass }} @error('billing_street') border-red-400 @enderror">
                                        @error('billing_street')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Nr.</label>
                                        <input type="text" name="billing_house_number" value="{{ old('billing_house_number', $order->customer->billing_house_number) }}"
                                            class="{{ $inputClass }} @error('billing_house_number') border-red-400 @enderror">
                                        @error('billing_house_number')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div>
                                        <label class="{{ $labelClass }}">Toevoeging</label>
                                        <input type="text" name="billing_house_number_add" value="{{ old('billing_house_number_add', $order->customer->billing_house_number_addition) }}"
                                            class="{{ $inputClass }}">
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Postcode</label>
                                        <input type="text" name="billing_postal_code" value="{{ old('billing_postal_code', $order->customer->billing_postal_code) }}"
                                            class="{{ $inputClass }} @error('billing_postal_code') border-red-400 @enderror">
                                        @error('billing_postal_code')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Plaats</label>
                                        <input type="text" name="billing_city" value="{{ old('billing_city', $order->customer->billing_city) }}"
                                            class="{{ $inputClass }} @error('billing_city') border-red-400 @enderror">
                                        @error('billing_city')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="{{ $labelClass }}">Land</label>
                                    <select name="billing_country" class="{{ $inputClass }}">
                                        <option value="NL" @selected(old('billing_country', $order->customer->billing_country) === 'NL')>Nederland</option>
                                        <option value="BE" @selected(old('billing_country', $order->customer->billing_country) === 'BE')>België</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Bedrijfsgegevens --}}
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-5">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4 flex items-center gap-1.5">
                                <i class="fa-solid fa-building text-gray-400"></i> Bedrijfsgegevens <span class="font-normal text-gray-400 normal-case">(optioneel)</span>
                            </p>
                            <div class="space-y-3">
                                <div>
                                    <label class="{{ $labelClass }}">Bedrijfsnaam</label>
                                    <input type="text" name="billing_company" value="{{ old('billing_company', $order->customer->billing_company) }}" class="{{ $inputClass }}">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div>
                                        <label class="{{ $labelClass }}">KVK-nummer</label>
                                        <input type="text" name="kvk_nummer" value="{{ old('kvk_nummer', $order->customer->kvk_nummer) }}" class="{{ $inputClass }}">
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">RSIN-nummer</label>
                                        <input type="text" name="rsin_nummer" value="{{ old('rsin_nummer', $order->customer->rsin_nummer) }}" class="{{ $inputClass }}">
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">BTW-nummer</label>
                                        <input type="text" name="btw_nummer" value="{{ old('btw_nummer', $order->customer->btw_nummer) }}" class="{{ $inputClass }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Verzendadres --}}
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-5">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4 flex items-center gap-1.5">
                                <i class="fa-solid fa-truck text-gray-400"></i> Verzendadres
                            </p>
                            <div class="space-y-3">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="{{ $labelClass }}">Voornaam</label>
                                        <input type="text" name="shipping_first_name" value="{{ old('shipping_first_name', $order->shipping_first_name) }}" class="{{ $inputClass }}">
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Achternaam</label>
                                        <input type="text" name="shipping_last_name" value="{{ old('shipping_last_name', $order->shipping_last_name) }}" class="{{ $inputClass }}">
                                    </div>
                                </div>
                                <div>
                                    <label class="{{ $labelClass }}">Bedrijfsnaam <span class="font-normal text-gray-400">(optioneel)</span></label>
                                    <input type="text" name="shipping_company" value="{{ old('shipping_company', $order->shipping_company) }}" class="{{ $inputClass }}">
                                </div>
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="col-span-2">
                                        <label class="{{ $labelClass }}">Straatnaam</label>
                                        <input type="text" name="shipping_street" value="{{ old('shipping_street', $order->shipping_street) }}" class="{{ $inputClass }}">
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Nr.</label>
                                        <input type="text" name="shipping_house_number" value="{{ old('shipping_house_number', $order->shipping_house_number) }}" class="{{ $inputClass }}">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div>
                                        <label class="{{ $labelClass }}">Toevoeging</label>
                                        <input type="text" name="shipping_house_number_addition" value="{{ old('shipping_house_number_addition', $order->shipping_house_number_addition) }}" class="{{ $inputClass }}">
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Postcode</label>
                                        <input type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code', $order->shipping_postal_code) }}" class="{{ $inputClass }}">
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Plaats</label>
                                        <input type="text" name="shipping_city" value="{{ old('shipping_city', $order->shipping_city) }}" class="{{ $inputClass }}">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="{{ $labelClass }}">Land</label>
                                        <select name="shipping_country" class="{{ $inputClass }}">
                                            <option value="">— Zelfde als factuuradres —</option>
                                            <option value="NL" @selected(old('shipping_country', $order->shipping_country) === 'NL')>Nederland</option>
                                            <option value="BE" @selected(old('shipping_country', $order->shipping_country) === 'BE')>België</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Telefoonnummer</label>
                                        <input type="text" name="shipping_phone" value="{{ old('shipping_phone', $order->shipping_phone) }}" class="{{ $inputClass }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bestelnotitie --}}
                        <div class="border-t border-gray-100 dark:border-gray-700 pt-5">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3 flex items-center gap-1.5">
                                <i class="fa-solid fa-note-sticky text-gray-400"></i> Bestelnotitie
                            </p>
                            <textarea name="order_note" rows="3"
                                class="{{ $inputClass }} resize-none"
                                placeholder="Optionele notitie over de bestelling…">{{ old('order_note', $order->order_note) }}</textarea>
                        </div>

                        <button type="button" onclick="saveAll()"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 font-semibold rounded-xl text-sm px-4 py-3 flex items-center justify-center gap-2 transition-colors shadow-sm">
                            <i class="fa-solid fa-floppy-disk"></i> Gegevens opslaan
                        </button>
                    </form>
                </div>
            </div>

        </div>

        {{-- RIGHT sidebar --}}
        <div class="space-y-4">

            {{-- Status form --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h2 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-sliders text-gray-400"></i> Bestelling bijwerken
                    </h2>
                </div>
                <form id="form-status" action="{{ route('orderUpdateAll', $order->id) }}" method="POST" class="p-5 space-y-3">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block mb-1.5 text-xs font-medium text-gray-600 dark:text-gray-400">Bestelstatus</label>
                        <select name="order-status" id="order-status-select"
                            class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent block w-full p-2.5"
                            onchange="updateStockHints()">
                            @foreach(['pending' => 'In afwachting', 'shipped' => 'Verzonden', 'cancelled' => 'Geannuleerd', 'completed' => 'Afgerond'] as $key => $label)
                                <option value="{{ $key }}" @selected($order->status === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1.5 text-xs font-medium text-gray-600 dark:text-gray-400">Betaalstatus</label>
                        <select name="payment-status" id="payment-status-select"
                            class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent block w-full p-2.5"
                            onchange="updateStockHints()">
                            @foreach(['pending' => 'In afwachting', 'paid' => 'Betaald', 'failed' => 'Mislukt', 'refunded' => 'Terugbetaald'] as $key => $label)
                                <option value="{{ $key }}" @selected($order->payment_status === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Stock impact hint --}}
                    <div id="stock-hint-box" class="hidden rounded-lg p-3 text-xs leading-relaxed border"></div>

                    {{-- Stock reference legend --}}
                    <details class="group">
                        <summary class="text-xs text-gray-400 dark:text-gray-500 cursor-pointer hover:text-gray-600 dark:hover:text-gray-300 flex items-center gap-1 select-none list-none">
                            <i class="fa-solid fa-circle-info"></i>
                            Voorraad & status uitleg
                            <i class="fa-solid fa-chevron-down text-xs ml-auto group-open:rotate-180 transition-transform"></i>
                        </summary>
                        <div class="mt-2 space-y-1.5 text-xs text-gray-500 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700 pt-2">
                            <p class="font-semibold text-gray-600 dark:text-gray-300 mb-1">Bestelstatus</p>
                            <p><span class="inline-block w-2 h-2 rounded-full bg-yellow-400 mr-1"></span><strong>In afwachting</strong> — Voorraad is al gereserveerd.</p>
                            <p><span class="inline-block w-2 h-2 rounded-full bg-blue-400 mr-1"></span><strong>Verzonden</strong> — Voorraad blijft gereserveerd.</p>
                            <p><span class="inline-block w-2 h-2 rounded-full bg-green-400 mr-1"></span><strong>Afgerond</strong> — Voorraad blijft gereserveerd.</p>
                            <p><span class="inline-block w-2 h-2 rounded-full bg-red-400 mr-1"></span><strong>Geannuleerd</strong> — Voorraad wordt <em>teruggegeven</em>.</p>
                            <p class="font-semibold text-gray-600 dark:text-gray-300 mt-2 mb-1">Betaalstatus</p>
                            <p><span class="inline-block w-2 h-2 rounded-full bg-yellow-400 mr-1"></span><strong>In afwachting / Mislukt</strong> — Geen voorraadwijziging.</p>
                            <p><span class="inline-block w-2 h-2 rounded-full bg-green-400 mr-1"></span><strong>Betaald</strong> — Geen voorraadwijziging.</p>
                            <p><span class="inline-block w-2 h-2 rounded-full bg-gray-400 mr-1"></span><strong>Terugbetaald</strong> — Zet automatisch bestelstatus op <em>Geannuleerd</em> en geeft voorraad terug.</p>
                        </div>
                    </details>

                    <button type="button" onclick="saveAll()"
                        class="w-full text-white bg-primary-600 hover:bg-primary-700 font-semibold rounded-lg text-sm px-4 py-2.5 flex items-center justify-center gap-2 transition-colors">
                        <i class="fa-solid fa-floppy-disk"></i> Opslaan
                    </button>
                </form>
            </div>

            {{-- Customer info --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-user text-gray-400"></i> Klantgegevens
                    </h2>
                    @if($order->customer->billing_company)
                    <span class="text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 px-2 py-0.5 rounded-full">
                        <i class="fa-solid fa-building mr-1"></i>Bedrijf
                    </span>
                    @endif
                </div>
                <div class="p-5">
                    @if($order->customer->billing_company)
                    <div class="mb-3 pb-3 border-b border-gray-100 dark:border-gray-700">
                        <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $order->customer->billing_company }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">t.a.v. {{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</p>
                    </div>
                    @endif
                    <div class="space-y-2.5 text-sm">
                        @if(!$order->customer->billing_company)
                        <div class="flex items-center gap-2.5 text-gray-600 dark:text-gray-400">
                            <i class="fa-solid fa-user w-4 text-center text-gray-400 shrink-0"></i>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</span>
                        </div>
                        @endif
                        <div class="flex items-center gap-2.5 text-gray-600 dark:text-gray-400 min-w-0">
                            <i class="fa-solid fa-envelope w-4 text-center text-gray-400 shrink-0"></i>
                            <a href="mailto:{{ $order->customer->billing_email }}" class="hover:text-primary-600 dark:hover:text-primary-400 truncate text-xs">{{ $order->customer->billing_email }}</a>
                        </div>
                        @if($order->customer->billing_phone)
                        <div class="flex items-center gap-2.5 text-gray-600 dark:text-gray-400">
                            <i class="fa-solid fa-phone w-4 text-center text-gray-400 shrink-0"></i>
                            <span class="text-xs">{{ $order->customer->billing_phone }}</span>
                        </div>
                        @endif
                        @if($order->customer->kvk_nummer || $order->customer->rsin_nummer || $order->customer->btw_nummer)
                        <div class="pt-2 mt-1 border-t border-gray-100 dark:border-gray-700 space-y-1.5 text-xs text-gray-500 dark:text-gray-400">
                            @if($order->customer->kvk_nummer)
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-hashtag w-4 text-center text-gray-400 shrink-0"></i>
                                <span>KVK: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $order->customer->kvk_nummer }}</span></span>
                            </div>
                            @endif
                            @if($order->customer->rsin_nummer)
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-hashtag w-4 text-center text-gray-400 shrink-0"></i>
                                <span>RSIN: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $order->customer->rsin_nummer }}</span></span>
                            </div>
                            @endif
                            @if($order->customer->btw_nummer)
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-hashtag w-4 text-center text-gray-400 shrink-0"></i>
                                <span>BTW: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $order->customer->btw_nummer }}</span></span>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Invoice & actions --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h2 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-file-invoice text-gray-400"></i> Factuur &amp; acties
                    </h2>
                </div>
                <div class="p-5 space-y-2.5">
                    @if(empty($order->invoice_pdf_path))
                        <form action="{{ route('generateInvoice', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 text-white bg-primary-600 hover:bg-primary-700 font-semibold rounded-lg text-sm px-4 py-2.5 transition-colors">
                                <i class="fa-solid fa-file-pdf"></i> Genereer factuur
                            </button>
                        </form>
                    @else
                        <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                            class="w-full flex items-center justify-center gap-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 font-semibold rounded-lg text-sm px-4 py-2.5 transition-colors">
                            <i class="fa-solid fa-download"></i> Download factuur
                        </a>
                        <form action="{{ route('sendOrderEmailWithInvoice', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 text-white bg-primary-600 hover:bg-primary-700 font-semibold rounded-lg text-sm px-4 py-2.5 transition-colors">
                                <i class="fa-solid fa-envelope"></i> Verstuur e-mail met factuur
                            </button>
                        </form>
                    @endif

                    @if($order->payment_status !== 'paid' && $order->payment_link)
                    <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2 flex items-center gap-1">
                            <i class="fa-solid fa-link text-gray-400"></i> Betaallink
                        </p>
                        <div class="flex gap-2">
                            <a href="{{ $order->payment_link }}" target="_blank"
                                class="flex-1 text-center text-white bg-green-600 hover:bg-green-700 font-semibold rounded-lg text-xs px-3 py-2 transition-colors">
                                <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i>Openen
                            </a>
                            <button type="button" data-payment-link="{{ $order->payment_link }}"
                                onclick="navigator.clipboard.writeText(this.dataset.paymentLink);this.innerHTML='<i class=\'fa-solid fa-check mr-1\'></i>Gekopieerd!';setTimeout(()=>this.innerHTML='<i class=\'fa-regular fa-copy mr-1\'></i>Kopieer',2000)"
                                class="flex-1 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 font-semibold rounded-lg text-xs px-3 py-2 transition-colors">
                                <i class="fa-regular fa-copy mr-1"></i>Kopieer
                            </button>
                        </div>
                    </div>
                    @endif

                    <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1 font-medium flex items-center gap-1">
                            <i class="fa-solid fa-rotate text-gray-400"></i> Nieuwe betaallink genereren
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mb-3 leading-relaxed">
                            Gebruik dit als de klant de betaling heeft geannuleerd of de link is verlopen. Betaalstatus wordt teruggezet naar <em>In afwachting</em>.
                        </p>
                        <form id="betaallink-form" action="{{ route('orderRegeneratePaymentLink', $order->id) }}" method="POST">
                            @csrf
                            <button type="button" onclick="confirmBetaallink()"
                                class="w-full flex items-center justify-center gap-2 text-white bg-amber-500 hover:bg-amber-600 font-semibold rounded-lg text-sm px-4 py-2.5 transition-colors">
                                <i class="fa-solid fa-link"></i> Nieuwe betaallink
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- MyParcel --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h2 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-truck-fast text-gray-400"></i> MyParcel
                    </h2>
                </div>
                <div class="p-5">
                @if($order->myparcel_consignment_id)
                    @php
                        $packageTypes = [1 => 'Pakket', 2 => 'Brievenbuspakje', 3 => 'Brief', 4 => 'Digitale postzegel'];
                        $deliveryTypes = ['standard' => 'Thuisbezorging', 'pickup' => 'Afhaalpunt'];
                    @endphp
                    <div class="space-y-2.5 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Carrier</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ ucfirst($order->myparcel_carrier ?? 'PostNL') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Pakket type</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $packageTypes[$order->myparcel_package_type_id] ?? '-' }}</span>
                        </div>
                        @if($order->myparcel_delivery_type)
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Bezorgtype</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $deliveryTypes[$order->myparcel_delivery_type] ?? $order->myparcel_delivery_type }}</span>
                        </div>
                        @endif
                        @if($order->myparcel_delivery_type === 'pickup' && isset($pickupLocation))
                        <div class="mt-2 pt-2 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-600 dark:text-gray-400">
                            <p class="font-semibold text-gray-900 dark:text-white mb-1">Afhaalpunt</p>
                            <p>{{ $pickupLocation['locationName'] ?? '-' }}</p>
                            <p>{{ ($pickupLocation['street'] ?? '') . ' ' . ($pickupLocation['number'] ?? '') }}</p>
                            <p>{{ ($pickupLocation['postalCode'] ?? '') . ' ' . ($pickupLocation['city'] ?? '') }}</p>
                        </div>
                        @endif
                        @if($order->myparcel_track_trace_url)
                        <a href="{{ $order->myparcel_track_trace_url }}" target="_blank"
                            class="flex items-center justify-center gap-2 mt-1 text-primary-700 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 hover:bg-primary-100 dark:hover:bg-primary-900/40 rounded-lg px-3 py-2 text-xs font-semibold transition-colors">
                            <i class="fa-solid fa-location-dot"></i>
                            Track &amp; Trace: {{ $order->myparcel_barcode }}
                        </a>
                        @endif
                        @if($order->myparcel_label_link)
                            <a href="{{ $order->myparcel_label_link }}" target="_blank"
                                class="w-full flex items-center justify-center gap-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 font-semibold rounded-lg text-xs px-3 py-2 mt-1 transition-colors">
                                <i class="fa-solid fa-tag"></i> Download label (PDF)
                            </a>
                        @else
                            <form action="{{ route('orderUpdatePackageType', $order->id) }}" method="POST" class="space-y-2 mt-1">
                                @csrf
                                <select name="package_type"
                                    class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-lg block w-full p-2 focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                    @foreach($packageTypes as $key => $label)
                                        <option value="{{ $key }}" @selected($order->myparcel_package_type_id == $key)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                    class="w-full text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 font-semibold rounded-lg text-xs px-3 py-2 transition-colors">
                                    Update pakket type
                                </button>
                            </form>
                            <form action="{{ route('orderGenerateLabel', $order->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 text-white bg-primary-600 hover:bg-primary-700 font-semibold rounded-lg text-xs px-3 py-2 transition-colors">
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
    </div>

{{-- Custom confirm modal --}}
<div id="confirm-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    {{-- Backdrop --}}
    <div id="confirm-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    {{-- Dialog --}}
    <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-sm border border-gray-200 dark:border-gray-700 overflow-hidden animate-scale-in">
        {{-- Header stripe --}}
        <div id="confirm-stripe" class="h-1 w-full bg-gradient-to-r from-red-500 to-rose-500"></div>
        <div class="p-6">
            {{-- Icon + title --}}
            <div class="flex items-start gap-4 mb-4">
                <div id="confirm-icon-wrap" class="shrink-0 w-10 h-10 rounded-full flex items-center justify-center bg-red-100 dark:bg-red-900/40">
                    <i id="confirm-icon" class="fa-solid fa-triangle-exclamation text-red-500 dark:text-red-400"></i>
                </div>
                <div>
                    <h3 id="confirm-title" class="text-sm font-bold text-gray-900 dark:text-white mb-1">Bevestig actie</h3>
                    <p id="confirm-message" class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed"></p>
                </div>
            </div>
            {{-- Buttons --}}
            <div class="flex gap-2 mt-5">
                <button id="confirm-cancel"
                    class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition-colors">
                    Annuleren
                </button>
                <button id="confirm-ok"
                    class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl transition-colors flex items-center justify-center gap-2">
                    <i id="confirm-ok-icon" class="fa-solid fa-trash-can"></i>
                    <span id="confirm-ok-label">Verwijder</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes scale-in {
    from { opacity: 0; transform: scale(0.92) translateY(8px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}
.animate-scale-in { animation: scale-in 0.18s cubic-bezier(0.34,1.56,0.64,1) forwards; }
</style>

<script>
(function () {
    var rowCounter = {{ $order->items->count() }};
    var discountApiUrl = @json(route('dashboard.api.discountCode'));
    var saveAllUrl     = @json(route('orderUpdateAll', $order->id));
    var csrfToken      = '';
    var m = document.querySelector('meta[name="csrf-token"]');
    if (m) csrfToken = m.getAttribute('content');

    // ── toggle collapsible panels ─────────────────────────────────────────────
    window.togglePanel = function(panelId, btn) {
        var panel = document.getElementById(panelId);
        if (!panel) return;
        panel.classList.toggle('hidden');
        var icon = btn.querySelector('i.fa-chevron-down');
        if (icon) icon.classList.toggle('rotate-180');
    };

    // ── stock impact hints ────────────────────────────────────────────────────
    var ORIGINAL_STATUS         = @json($order->status);
    var ORIGINAL_PAYMENT_STATUS = @json($order->payment_status);

    window.updateStockHints = function() {
        var box        = document.getElementById('stock-hint-box');
        var orderSel   = document.getElementById('order-status-select');
        var paymentSel = document.getElementById('payment-status-select');
        if (!box || !orderSel || !paymentSel) return;

        var newStatus  = orderSel.value;
        var newPayment = paymentSel.value;

        // Simulate server-side logic: refunded forces cancelled
        var effectiveStatus = (newPayment === 'refunded' && ORIGINAL_PAYMENT_STATUS !== 'refunded')
            ? 'cancelled' : newStatus;

        var wasCancelled = ORIGINAL_STATUS === 'cancelled';
        var isCancelled  = effectiveStatus === 'cancelled';

        var msg = null; var cls = '';

        if (newPayment === 'refunded' && ORIGINAL_PAYMENT_STATUS !== 'refunded') {
            msg = '<i class="fa-solid fa-rotate-left mr-1"></i><strong>Terugbetaald:</strong> Bestelstatus wordt automatisch op <em>Geannuleerd</em> gezet en de voorraad van alle producten wordt teruggegeven.';
            cls = 'bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300';
        } else if (!wasCancelled && isCancelled) {
            msg = '<i class="fa-solid fa-arrow-up mr-1 text-green-500"></i><strong>Geannuleerd:</strong> De voorraad van alle producten in deze bestelling wordt automatisch teruggegeven.';
            cls = 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800 text-green-800 dark:text-green-300';
        } else if (wasCancelled && !isCancelled) {
            msg = '<i class="fa-solid fa-arrow-down mr-1 text-red-500"></i><strong>Heractiveren:</strong> De bestelling was geannuleerd. Voorraad wordt opnieuw gereserveerd (als beschikbaar).';
            cls = 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800 text-red-800 dark:text-red-300';
        }

        if (msg) {
            box.innerHTML = msg;
            box.className = 'rounded-lg p-3 text-xs leading-relaxed border ' + cls;
            box.classList.remove('hidden');
        } else {
            box.classList.add('hidden');
        }
    };

    // Run on load in case of validation errors
    window.updateStockHints();

    // ── helpers ──────────────────────────────────────────────────────────────
    function fmt(n) {
        return '€' + parseFloat(n).toFixed(2).replace('.', ',');
    }

    // ── SAVE ALL ─────────────────────────────────────────────────────────────
    window.saveAll = function () {
        var tmp = document.createElement('form');
        tmp.method = 'POST';
        tmp.action = saveAllUrl;
        tmp.style.display = 'none';
        document.body.appendChild(tmp);

        function addH(name, value) {
            var i = document.createElement('input');
            i.type = 'hidden';
            i.name = name;
            i.value = (value === null || value === undefined) ? '' : value;
            tmp.appendChild(i);
        }

        addH('_token', csrfToken);
        addH('_method', 'PUT');

        ['form-status', 'items-form', 'form-details'].forEach(function(fId) {
            var f = document.getElementById(fId);
            if (!f) return;
            var els = f.querySelectorAll('input[name], select[name], textarea[name]');
            els.forEach(function(el) {
                var key = el.name;
                if (!key || key === '_token' || key === '_method') return;
                if ((el.type === 'checkbox' || el.type === 'radio') && !el.checked) return;
                addH(key, el.value);
            });
        });

        tmp.submit();
    };

    // ── recalculate live totals ───────────────────────────────────────────────
    window.recalcTotals = function () {
        var subtotal = 0;

        document.querySelectorAll('#items-list .item-row').forEach(function(row) {
            var unitPrice = parseFloat(row.getAttribute('data-unit-price')) || 0;
            var qtyEl     = row.querySelector('.item-qty');
            var qty       = qtyEl ? (Math.max(1, parseInt(qtyEl.value) || 1)) : 1;
            var sub       = Math.round(unitPrice * qty * 100) / 100;
            subtotal     += sub;
            var subEl = row.querySelector('.item-subtotal');
            if (subEl) subEl.textContent = fmt(sub);
        });

        var dtEl    = document.getElementById('discount-type');
        var dvEl    = document.getElementById('discount-value');
        var dType   = dtEl ? dtEl.value : '';
        var dValue  = dvEl ? (parseFloat(dvEl.value) || 0) : 0;
        var discount = 0;
        if (dType && dValue > 0) {
            discount = dType === 'percent'
                ? Math.round(subtotal * (dValue / 100) * 100) / 100
                : Math.round(dValue * 100) / 100;
            discount = Math.min(discount, subtotal);
        }

        // Read shipping from the select
        var shippingSel  = document.getElementById('shipping-cost-select');
        var shippingOpt  = shippingSel ? shippingSel.options[shippingSel.selectedIndex] : null;
        var SHIPPING     = shippingOpt ? (parseFloat(shippingOpt.getAttribute('data-amount')) || 0) : 0;

        // Update shipping hint
        var hint = document.getElementById('shipping-hint');
        if (hint) {
            hint.textContent = SHIPPING > 0 ? ('Verzendkosten: ' + fmt(SHIPPING)) : 'Geen verzendkosten';
        }

        var afterDis = Math.round((subtotal - discount) * 100) / 100;
        var total    = Math.round((afterDis + SHIPPING) * 100) / 100;

        // ── update edit-panel preview ──
        var subEl = document.getElementById('calc-subtotal');
        var totEl = document.getElementById('calc-total');
        if (subEl) subEl.textContent = fmt(subtotal);
        if (totEl) totEl.textContent = fmt(total);

        var discRow = document.getElementById('calc-discount-row');
        if (discRow) {
            if (discount > 0) {
                discRow.classList.remove('hidden');
                var lbl = document.getElementById('calc-discount-label');
                var amt = document.getElementById('calc-discount-amount');
                if (lbl) lbl.textContent = dType === 'percent' ? ('Korting (' + dValue + '%)') : 'Korting';
                if (amt) amt.textContent = '-' + fmt(discount);
            } else {
                discRow.classList.add('hidden');
            }
        }

        var shipRow = document.getElementById('calc-shipping-row');
        var shipAmt = document.getElementById('calc-shipping-amount');
        if (shipRow) {
            if (SHIPPING > 0) {
                shipRow.classList.remove('hidden');
                if (shipAmt) shipAmt.textContent = fmt(SHIPPING);
            } else {
                shipRow.classList.add('hidden');
            }
        }

        // ── mirror into main summary table at the top ──
        var mainSub    = document.getElementById('main-subtotal');
        var mainTot    = document.getElementById('main-total');
        var mainDisc   = document.getElementById('main-discount-row');
        var mainDiscL  = document.getElementById('main-discount-label');
        var mainDiscA  = document.getElementById('main-discount-amount');
        var mainShipR  = document.querySelector('#main-shipping-row td:last-child');
        var mainShipRw = document.getElementById('main-shipping-row');
        if (mainSub) mainSub.textContent = fmt(subtotal);
        if (mainTot) mainTot.textContent = fmt(total);
        if (mainDisc) {
            if (discount > 0) {
                mainDisc.classList.remove('hidden');
                if (mainDiscL) mainDiscL.textContent = dType === 'percent' ? ('Korting (' + dValue + '%)') : 'Korting';
                if (mainDiscA) mainDiscA.textContent = '-' + fmt(discount);
            } else {
                mainDisc.classList.add('hidden');
            }
        }
        if (mainShipRw) {
            if (SHIPPING > 0) {
                mainShipRw.classList.remove('hidden');
                if (mainShipR) mainShipR.textContent = fmt(SHIPPING);
            } else {
                mainShipRw.classList.add('hidden');
            }
        }
    };

    // ── custom confirm dialog ─────────────────────────────────────────────────
    function customConfirm(opts) {
        return new Promise(function(resolve) {
            var modal   = document.getElementById('confirm-modal');
            var stripe  = document.getElementById('confirm-stripe');
            var iconW   = document.getElementById('confirm-icon-wrap');
            var icon    = document.getElementById('confirm-icon');
            var title   = document.getElementById('confirm-title');
            var msg     = document.getElementById('confirm-message');
            var okBtn   = document.getElementById('confirm-ok');
            var okIcon  = document.getElementById('confirm-ok-icon');
            var okLabel = document.getElementById('confirm-ok-label');
            var canBtn  = document.getElementById('confirm-cancel');
            var bk      = document.getElementById('confirm-backdrop');

            // Configure appearance
            var type = opts.type || 'danger'; // danger | warning | info
            var colors = {
                danger:  { stripe: 'from-red-500 to-rose-500',   iconBg: 'bg-red-100 dark:bg-red-900/40',    iconColor: 'text-red-500 dark:text-red-400',    btn: 'bg-red-500 hover:bg-red-600',    faIcon: opts.icon || 'fa-triangle-exclamation' },
                warning: { stripe: 'from-amber-400 to-orange-500', iconBg: 'bg-amber-100 dark:bg-amber-900/40', iconColor: 'text-amber-500 dark:text-amber-400', btn: 'bg-amber-500 hover:bg-amber-600', faIcon: opts.icon || 'fa-rotate' },
                info:    { stripe: 'from-blue-500 to-primary-500', iconBg: 'bg-blue-100 dark:bg-blue-900/40',  iconColor: 'text-blue-500 dark:text-blue-400',  btn: 'bg-blue-500 hover:bg-blue-600',  faIcon: opts.icon || 'fa-circle-info' },
            };
            var c = colors[type];

            stripe.className  = 'h-1 w-full bg-gradient-to-r ' + c.stripe;
            iconW.className   = 'shrink-0 w-10 h-10 rounded-full flex items-center justify-center ' + c.iconBg;
            icon.className    = 'fa-solid ' + c.faIcon + ' ' + c.iconColor;
            title.textContent = opts.title   || 'Bevestig actie';
            msg.textContent   = opts.message || '';
            okLabel.textContent = opts.okLabel || 'Bevestigen';
            okIcon.className  = 'fa-solid ' + (opts.okIcon || c.faIcon);
            okBtn.className   = okBtn.className.replace(/bg-\S+ hover:bg-\S+/g, '').trim() + ' ' + c.btn;

            // Show
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            function close(result) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                okBtn.removeEventListener('click', onOk);
                canBtn.removeEventListener('click', onCancel);
                bk.removeEventListener('click', onCancel);
                resolve(result);
            }
            function onOk()     { close(true);  }
            function onCancel() { close(false); }

            okBtn.addEventListener('click',  onOk);
            canBtn.addEventListener('click', onCancel);
            bk.addEventListener('click',    onCancel);
        });
    }

    // ── remove item row ──────────────────────────────────────────────────────
    window.removeItemRow = function (btn) {
        customConfirm({
            type: 'danger',
            title: 'Product verwijderen',
            message: 'Wil je dit product verwijderen uit de bestelling?',
            okLabel: 'Verwijderen',
            okIcon: 'fa-trash-can',
        }).then(function(ok) {
            if (!ok) return;
            btn.closest('.item-row').remove();
            recalcTotals();
        });
    };

    // ── betaallink confirm ───────────────────────────────────────────────────
    window.confirmBetaallink = function() {
        customConfirm({
            type: 'warning',
            title: 'Nieuwe betaallink genereren',
            message: 'Weet je zeker dat je een nieuwe betaallink wilt genereren? De betaalstatus wordt teruggezet naar In afwachting.',
            okLabel: 'Genereren',
            okIcon: 'fa-link',
        }).then(function(ok) {
            if (!ok) return;
            document.getElementById('betaallink-form').submit();
        });
    };

    // ── add new product row ──────────────────────────────────────────────────
    window.addProductRow = function () {
        var sel   = document.getElementById('new-product-select');
        var opt   = sel ? sel.options[sel.selectedIndex] : null;
        if (!opt || !opt.value) { alert('Kies eerst een product.'); return; }

        var productId = opt.value;
        var price     = parseFloat(opt.getAttribute('data-price')) || 0;
        var stock     = parseInt(opt.getAttribute('data-stock')) || 0;
        var name      = opt.getAttribute('data-name') || opt.text;
        var qtyInput  = document.getElementById('new-product-qty');
        var qty       = Math.max(1, parseInt(qtyInput ? qtyInput.value : 1) || 1);

        if (stock < 1) { alert('Dit product is uitverkocht.'); return; }
        if (qty > stock) { alert('Niet genoeg voorraad voor "' + name + '" (beschikbaar: ' + stock + ')'); return; }

        var idx = rowCounter++;
        var sub = Math.round(price * qty * 100) / 100;
        var row = document.createElement('div');
        row.className = 'item-row flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/60 rounded-xl border border-gray-100 dark:border-gray-600';
        row.setAttribute('data-unit-price', price);
        row.setAttribute('data-row-id', idx);
        row.innerHTML = '<input type="hidden" name="items[' + idx + '][product_id]" value="' + productId + '">'
            + '<div class="flex-1 min-w-0">'
            + '<p class="text-sm font-medium text-gray-900 dark:text-white truncate">' + name + '</p>'
            + '<p class="text-xs text-gray-400 dark:text-gray-500">' + fmt(price) + ' p.s.</p>'
            + '</div>'
            + '<div class="flex items-center gap-2 shrink-0">'
            + '<input type="number" name="items[' + idx + '][qty]" value="' + qty + '" min="1"'
            + ' class="item-qty w-16 text-center bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg p-1.5 focus:ring-2 focus:ring-primary-500 focus:border-transparent"'
            + ' oninput="recalcTotals()">'
            + '<span class="item-subtotal text-sm font-bold text-gray-900 dark:text-white w-16 text-right">' + fmt(sub) + '</span>'
            + '<button type="button" onclick="removeItemRow(this)" title="Verwijder"'
            + ' class="p-1.5 text-red-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors">'
            + '<i class="fa-solid fa-trash-can text-sm"></i></button>'
            + '</div>';

        var list = document.getElementById('items-list');
        if (list) list.appendChild(row);
        var newQtyEl = row.querySelector('.item-qty');
        if (newQtyEl) newQtyEl.addEventListener('input', function() { recalcTotals(); });
        sel.value = '';
        if (qtyInput) qtyInput.value = 1;
        var hint = document.getElementById('new-product-stock-hint');
        if (hint) hint.classList.add('hidden');
        recalcTotals();
    };

    // ── product select → stock hint ───────────────────────────────────────────
    var prodSel = document.getElementById('new-product-select');
    if (prodSel) {
        prodSel.addEventListener('change', function() {
            var opt  = this.options[this.selectedIndex];
            var hint = document.getElementById('new-product-stock-hint');
            if (!hint) return;
            if (!opt || !opt.value) { hint.classList.add('hidden'); return; }
            var stock = parseInt(opt.getAttribute('data-stock')) || 0;
            hint.className   = 'text-xs ' + (stock > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-500');
            hint.textContent = stock > 0 ? ('✓ Beschikbare voorraad: ' + stock) : '✗ Uitverkocht';
            hint.classList.remove('hidden');
            var qtyEl = document.getElementById('new-product-qty');
            if (qtyEl) qtyEl.max = stock > 0 ? stock : 0;
        });
    }

    // ── discount code dropdown ────────────────────────────────────────────────
    window.applyDiscountFromDropdown = function (select) {
        var codeInput = document.getElementById('discount-code-input');
        var msgEl     = document.getElementById('discount-code-msg');
        var selected  = select.options[select.selectedIndex];

        if (!selected || !selected.value) {
            // Cleared — reset input and message
            if (codeInput) codeInput.value = '';
            if (msgEl) { msgEl.className = 'mt-1 text-xs hidden'; msgEl.textContent = ''; }
            var dt = document.getElementById('discount-type');
            var dv = document.getElementById('discount-value');
            if (dt) { dt.value = ''; }
            if (dv) { dv.value = ''; }
            recalcTotals();
            return;
        }

        var code         = selected.value;
        var discount     = parseFloat(selected.dataset.discount)     || 0;
        var discountType = selected.dataset.discountType || 'amount';
        var description  = selected.dataset.description  || '';

        if (codeInput) codeInput.value = code;

        var dt = document.getElementById('discount-type');
        var dv = document.getElementById('discount-value');
        if (dt) dt.value = discountType;
        if (dv) dv.value = discount;

        var typeLabel = discountType === 'percent'
            ? (discount + '% korting')
            : ('€' + discount.toFixed(2).replace('.', ',') + ' korting');

        if (msgEl) {
            msgEl.className = 'mt-1 text-xs text-green-600 dark:text-green-400';
            msgEl.innerHTML = '✓ <strong>' + code + '</strong> — ' + typeLabel
                + (description ? ' (' + description + ')' : '');
            msgEl.classList.remove('hidden');
        }

        recalcTotals();
    };

    // ── discount code lookup ──────────────────────────────────────────────────
    // ── attach programmatic listeners ────────────────────────────────────────
    document.querySelectorAll('.item-qty').forEach(function(el) {
        el.addEventListener('input', function() { recalcTotals(); });
    });
    var discTypeEl = document.getElementById('discount-type');
    if (discTypeEl) discTypeEl.addEventListener('change', function() { recalcTotals(); });
    var discValEl = document.getElementById('discount-value');
    if (discValEl) discValEl.addEventListener('input', function() { recalcTotals(); });

    // ── initial calculation ───────────────────────────────────────────────────
    recalcTotals();

}());
</script>


</x-dashboard-layout>
