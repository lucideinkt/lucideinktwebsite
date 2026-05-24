<x-dashboard-layout>
@push('head')
  <script src="https://cdn.jsdelivr.net/npm/vue@3.4"></script>
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
                    </h3>
                    <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                        <p class="font-medium text-gray-900 dark:text-white">{{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</p>
                        <p>{{ $order->customer->billing_street }} {{ $order->customer->billing_house_number }}{{ $order->customer->billing_house_number_addition ? ' '.$order->customer->billing_house_number_addition : '' }}</p>
                        <p>{{ $order->customer->billing_postal_code }}, {{ $order->customer->billing_city }}</p>
                        <p>{{ $order->customer->billing_country }}</p>
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
