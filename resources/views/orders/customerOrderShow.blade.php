@if(auth()->user()->role === 'user')
    <x-layout>
        @push('head')<meta name="robots" content="noindex, nofollow">@endpush
        <div class="page-normal-background">
        <main class="container page user-dashboard">
            <x-breadcrumbs :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Mijn Bestellingen', 'url' => route('showMyOrders')],
                ['label' => 'Bestelling #' . $order->id, 'url' => route('showMyOrder', $order->id)]
            ]" />

            <div class="dashboard-header">
                <h1 class="dashboard-title font-herina">Bestelling #{{ $order->id }}</h1>
                <p class="dashboard-subtitle">Gedetailleerd overzicht van je bestelling</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <button type="button" class="alert-close"
                        onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            @endif

            <x-user-dashboard-layout>
                <div class="order-detail-container">
                    <div class="order-info-cards">
                        <div class="order-address-card">
                            <h3 class="address-card-title">
                                <i class="fa-solid fa-receipt"></i>
                                Bestelinformatie
                            </h3>
                            <div class="address-card-content">
                                <div class="info-row">
                                    <span class="info-label">Status:</span>
                                    <span class="info-value order-status-badge status-{{ $order->status }}">{{ $order->status_label }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Datum:</span>
                                    <span class="info-value">{{ $order->created_at->format('d-m-Y H:i') }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Betaalstatus:</span>
                                    <span class="info-value">{{ $order->payment_status_label ?? 'Onbekend' }}</span>
                                </div>
                                @if($order->order_note)
                                    <div class="info-row">
                                        <span class="info-label">Bestelnotitie:</span>
                                        <span class="info-value">{{ $order->order_note }}</span>
                                    </div>
                                @endif
                                @if ($order->myparcel_delivery_type)
                                    @php
                                        $deliveryTypesShort = [
                                            'standard' => 'Thuisbezorging',
                                            'pickup' => 'Afhaalpunt',
                                        ];
                                    @endphp
                                    <div class="info-row">
                                        <span class="info-label">Bezorgtype:</span>
                                        <span class="info-value">{{ $deliveryTypesShort[$order->myparcel_delivery_type] ?? ucfirst($order->myparcel_delivery_type ?? '-') }}</span>
                                    </div>
                                @endif
                                @if ($order->myparcel_track_trace_url)
                                    <div class="info-row">
                                        <span class="info-label">Track & Trace:</span>
                                        <span class="info-value">
                                            <a href="{{ $order->myparcel_track_trace_url }}" class="order-link" target="_blank">
                                                {{ $order->myparcel_barcode ?? 'Bekijk zending' }}
                                            </a>
                                        </span>
                                    </div>
                                @endif
                                @if (!empty($order->invoice_pdf_path))
                                    <div class="info-row">
                                        <span class="info-label">Factuur:</span>
                                        <span class="info-value">
                                            <a href="{{ route('orders.invoice', $order->id) }}" class="order-link" target="_blank">
                                                <i class="fa-solid fa-file-pdf"></i> Download PDF
                                            </a>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="order-address-card">
                            <h3 class="address-card-title">
                                <i class="fa-solid fa-file-invoice"></i>
                                Factuuradres
                            </h3>
                            <div class="address-card-content">
                                <p class="address-name">{{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</p>
                                @if($order->customer->billing_company)
                                    <p class="address-company">{{ $order->customer->billing_company }}</p>
                                @endif
                                <p class="address-street">
                                    {{ $order->customer->billing_street }} {{ $order->customer->billing_house_number }}{{ $order->customer->billing_house_number_addition ? ' '.$order->customer->billing_house_number_addition : '' }}
                                </p>
                                <p class="address-city">
                                    {{ $order->customer->billing_postal_code }} {{ $order->customer->billing_city }}
                                </p>
                                <p class="address-country">
                                    {{ config('countries.' . $order->customer->billing_country) ?? $order->customer->billing_country }}
                                </p>
                                <p class="address-email">
                                    <i class="fa-solid fa-envelope"></i>
                                    {{ $order->customer->billing_email }}
                                </p>
                            </div>
                        </div>

                        @if($order->myparcel_delivery_type == 'pickup' && isset($pickupLocation))
                            <div class="order-address-card">
                                <h3 class="address-card-title">
                                    <i class="fa-solid fa-map-marker-alt"></i>
                                    Afhaalpunt
                                </h3>
                                <div class="address-card-content">
                                    <p class="location-name"><strong>{{ $pickupLocation['locationName'] ?? '-' }}</strong></p>
                                    <p class="location-address">
                                        {{ $pickupLocation['street'] ?? '' }} {{ $pickupLocation['number'] ?? '' }}<br>
                                        {{ $pickupLocation['postalCode'] ?? '' }} {{ $pickupLocation['city'] ?? '' }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="order-address-card">
                                <h3 class="address-card-title">
                                    <i class="fa-solid fa-shipping-fast"></i>
                                    Verzendadres
                                </h3>
                                <div class="address-card-content">
                                    @if($order->shipping_street)
                                        <p class="address-name">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
                                        @if($order->shipping_company)
                                            <p class="address-company">{{ $order->shipping_company }}</p>
                                        @endif
                                        <p class="address-street">
                                            {{ $order->shipping_street }} {{ $order->shipping_house_number }}{{ $order->shipping_house_number_addition ? ' '.$order->shipping_house_number_addition : '' }}
                                        </p>
                                        <p class="address-city">
                                            {{ $order->shipping_postal_code }} {{ $order->shipping_city }}
                                        </p>
                                        <p class="address-country">
                                            {{ config('countries.' . $order->shipping_country) ?? $order->shipping_country }}
                                        </p>
                                    @else
                                        <p class="address-name">{{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</p>
                                        @if($order->customer->billing_company)
                                            <p class="address-company">{{ $order->customer->billing_company }}</p>
                                        @endif
                                        <p class="address-street">
                                            {{ $order->customer->billing_street }} {{ $order->customer->billing_house_number }}{{ $order->customer->billing_house_number_addition ? ' '.$order->customer->billing_house_number_addition : '' }}
                                        </p>
                                        <p class="address-city">
                                            {{ $order->customer->billing_postal_code }} {{ $order->customer->billing_city }}
                                        </p>
                                        <p class="address-country">
                                            {{ config('countries.' . $order->customer->billing_country) ?? $order->customer->billing_country }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    @php
                        $shippingAmount = is_numeric($order->shipping_cost_amount) ? $order->shipping_cost_amount : (is_object($order->shipping_cost_amount) ? ($order->shipping_cost_amount->amount ?? 0) : 0);
                    @endphp

                    <div class="order-summary-card">
                        <div class="order-summary-inner">

                            {{-- Products side --}}
                            <div class="order-products-section">
                                <h3 class="order-summary-title">
                                    <i class="fa-solid fa-box-open"></i> Producten
                                </h3>

                                <div class="order-items-list">
                                    <div class="order-items-header">
                                        <span class="order-item-col product">Product</span>
                                        <span class="order-item-col quantity">Aantal</span>
                                        <span class="order-item-col price">Stukprijs</span>
                                        <span class="order-item-col subtotal">Subtotaal</span>
                                    </div>
                                    @forelse ($order->items as $item)
                                        <div class="order-item-row">
                                            <div class="order-item-product">
                                                <i class="fa-solid fa-book order-item-icon"></i>
                                                <span class="product-name">{{ $item->product_name }}</span>
                                            </div>
                                            <div class="order-item-quantity">
                                                <span class="mobile-label">Aantal:</span>
                                                <span class="qty-badge">{{ $item->quantity }}</span>
                                            </div>
                                            <div class="order-item-price">
                                                <span class="mobile-label">Stukprijs:</span>
                                                <span>€ {{ number_format($item->unit_price, 2, ',', '.') }}</span>
                                            </div>
                                            <div class="order-item-subtotal">
                                                <span class="mobile-label">Subtotaal:</span>
                                                <span>€ {{ number_format($item->subtotal, 2, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="order-item-row empty-state">
                                            <span>Geen items gevonden in deze bestelling.</span>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            {{-- Totals sidebar --}}
                            <div class="order-totals-sidebar">
                                <h3 class="order-summary-title">
                                    <i class="fa-solid fa-receipt"></i> Overzicht
                                </h3>

                                <div class="order-totals">
                                    <div class="order-total-row">
                                        <span class="order-total-label">Subtotaal</span>
                                        <span class="order-total-value">€ {{ number_format($order->total_before ?? ($order->total - $shippingAmount), 2, ',', '.') }}</span>
                                    </div>

                                    @if ($order->discount_value > 0)
                                        <div class="order-total-row discount">
                                            <span class="order-total-label">
                                                Korting
                                                @if($order->discount_code)
                                                    <span class="discount-code-tag">{{ $order->discount_code }}</span>
                                                @endif
                                            </span>
                                            <span class="order-total-value">
                                                @if($order->discount_type == 'percent')
                                                    -{{ (int)$order->discount_value }}%
                                                @elseif($order->discount_type == 'amount')
                                                    -€ {{ number_format($order->discount_value, 2, ',', '.') }}
                                                @endif
                                            </span>
                                        </div>

                                        @if($order->discount_type == 'percent')
                                            <div class="order-total-row discount-amount">
                                                <span class="order-total-label">Kortingsbedrag</span>
                                                <span class="order-total-value">-€ {{ number_format($order->discount_price_total, 2, ',', '.') }}</span>
                                            </div>
                                        @endif

                                        <div class="order-total-row after-discount">
                                            <span class="order-total-label">Na korting</span>
                                            <span class="order-total-value">€ {{ number_format($order->total_after_discount, 2, ',', '.') }}</span>
                                        </div>
                                    @endif

                                    @if($shippingAmount > 0)
                                        <div class="order-total-row shipping">
                                            <span class="order-total-label">Verzendkosten</span>
                                            <span class="order-total-value">€ {{ number_format($shippingAmount, 2, ',', '.') }}</span>
                                        </div>
                                    @endif

                                    <div class="order-total-row final-total">
                                        <span class="order-total-label">Totaal (incl. BTW)</span>
                                        <span class="order-total-value">€ {{ number_format($order->total, 2, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </x-user-dashboard-layout>
        </main>
        <div class="gradient-border"></div>
        <x-footer></x-footer>
        </div>
    </x-layout>
@else
    <x-dashboard-layout>
        <main class="container page dashboard">
            <h2>Bestelling #{{ $order->id }}</h2>

            <div class="order-info">
                <div class="order-info-grid">
                    <div class="order-info-item">
                        <h3>Klantgegevens</h3>
                        <p><strong>Naam:</strong> {{ $order->customer->billing_first_name }}
                            {{ $order->customer->billing_last_name }}</p>
                        <p><strong>Email:</strong> {{ $order->customer->billing_email }}</p>
                        <p><strong>Telefoonnummer:</strong> {{ $order->customer->billing_phone ?? '-' }}</p>
                        <p><strong>Datum:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
                    </div>
                    <div class="order-info-item">
                        <h3>Bestelling</h3>
                        <p><strong>Status:</strong> {{ $order->status_label }}</p>
                        <p><strong>Totaal:</strong> € {{ number_format($order->total, 2) }}</p>
                        <p><strong>Betaalstatus:</strong> {{ $order->payment_status_label ?? 'Onbekend' }}</p>
                        @if($order->order_note)
                            <p><strong>Bestelnotitie:</strong><br>
                            <span style="background: #ffdfbf; padding: 10px; border-radius: 4px; display: block; margin-top: 5px;">{{ $order->order_note }}</span></p>
                        @endif
                        @if (!empty($order->invoice_pdf_path))
                            <p><strong>Factuur:</strong>
                                <a style="text-decoration: underline" href="{{ route('orders.invoice', $order->id) }}"
                                    target="_blank">Download factuur</a>
                            </p>
                        @endif
                        <p><strong>Track & Trace:</strong>
                            @if ($order->myparcel_track_trace_url)
                                <a style="text-decoration: underline" href="{{ $order->myparcel_track_trace_url }}" target="_blank">
                                    {{ $order->myparcel_barcode ?? 'Bekijk zending' }}
                                </a>
                            @else
                                -
                            @endif
                        </p>

                        @if ($order->myparcel_delivery_type)
                            @php
                                $deliveryTypesShort = [
                                    'standard' => 'Thuisbezorging',
                                    'standard' => 'Thuisbezorging',
                                    'standard' => 'Thuisbezorging',
                                    'pickup' => 'Afhaalpunt',
                                    'pickup' => 'Afhaalpunt',
                                ];
                            @endphp
                            <p>
                                <strong>Gekozen bezorgtype:</strong>
                                {{ $deliveryTypesShort[$order->myparcel_delivery_type] ?? ucfirst($order->myparcel_delivery_type ?? '-') }}
                            </p>
                            @if ($order->myparcel_delivery_type == 'pickup')
                                <p><strong>Adres afhaalpunt:</strong></p>
                                <span>{{ $pickupLocation['locationName'] ?? '-' }}</span>,
                                <span>{{ $pickupLocation['street'] ?? '' }} {{ $pickupLocation['number'] ?? '' }}</span>,
                                <span>{{ $pickupLocation['postalCode'] ?? '' }}</span>,
                                <span>{{ $pickupLocation['city'] ?? '' }}</span>
                            @endif
                        @endif
                    </div>
                    <div class="order-info-item">
                        <h3>Factuuradres</h3>
                        <p><strong>Straatnaam:</strong> {{ $order->customer->billing_street }}</p>
                        <p><strong>Huisnummer:</strong> {{ $order->customer->billing_house_number }}</p>
                        <p><strong>Huisnummer toevoeging:</strong>
                            {{ $order->customer->billing_house_number_addition ?? '-' }}</p>
                        <p><strong>Postcode:</strong> {{ $order->customer->billing_postal_code }}</p>
                        <p><strong>Plaats:</strong> {{ $order->customer->billing_city }}</p>
                        <p><strong>Land:</strong> {{ $order->customer->billing_country }}</p>

                    </div>
                    <div class="order-info-item">
                        <h3>Verzendadres</h3>
                        @if (!empty($order->shipping_street))
                            <p><strong>Straatnaam:</strong> {{ $order->shipping_street }}</p>
                            <p><strong>Huisnummer:</strong> {{ $order->shipping_house_number }}</p>
                            <p><strong>Huisnummer toevoeging:</strong> {{ $order->shipping_house_number_addition ?? '-' }}
                            </p>
                            <p><strong>Postcode:</strong> {{ $order->shipping_postal_code }}</p>
                            <p><strong>Plaats:</strong> {{ $order->shipping_city }}</p>
                            <p><strong>Land:</strong> {{ $order->shipping_country }}</p>
                        @else
                            <p><strong>Straatnaam:</strong> {{ $order->customer->billing_street }}</p>
                            <p><strong>Huisnummer:</strong> {{ $order->customer->billing_house_number }}</p>
                            <p><strong>Huisnummer toevoeging:</strong>
                                {{ $order->customer->billing_house_number_addition ?? '-' }}</p>
                            <p><strong>Postcode:</strong> {{ $order->customer->billing_postal_code }}</p>
                            <p><strong>Plaats:</strong> {{ $order->customer->billing_city }}</p>
                            <p><strong>Land:</strong> {{ $order->customer->billing_country }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <button type="button" class="alert-close"
                        onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            @endif

            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Aantal</th>
                            <th>Stukprijs</th>
                            <th>Subtotaal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>€ {{ number_format($item->unit_price, 2) }}</td>
                                <td>€ {{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="table-empty-state">
                                    Geen items gevonden in deze bestelling.
                                </td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="3" style="text-align: right; font-weight: bold;">Totaal</td>
                            <td style="font-weight: bold;">€ {{ number_format($order->total_before, 2) }}</td>
                        </tr>
                        @if ($order->discount_value > 0)
                            <tr>
                                <td colspan="3" style="text-align: right; font-weight: bold;">Korting
                                    ({{ $order->discount_type == 'percent' ? (int) $order->discount_value . '%' : '€ ' . number_format($order->discount_value, 2) }})
                                </td>
                                <td style="font-weight: bold;">-€ {{ number_format($order->discount_price_total, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right; font-weight: bold;">Totaal na korting</td>
                                <td style="font-weight: bold;">€ {{ number_format($order->total_after_discount, 2) }}</td>
                            </tr>
                        @endif
                        @if (!empty($order->shipping_cost_amount) && $order->shipping_cost_amount > 0)
                            <tr>
                                <td colspan="3" style="text-align: right; font-weight: bold;">Verzendkosten</td>
                                <td style="font-weight: bold;">€ {{ is_numeric($order->shipping_cost_amount) ? number_format($order->shipping_cost_amount, 2) : number_format((float)($order->shipping_cost_amount->amount ?? 0), 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right; font-weight: bold;">Totaal incl. verzendkosten</td>
                                <td style="font-weight: bold;">€ {{ number_format($order->total, 2) }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                @if ($order->items instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $order->items->links('vendor.pagination.custom') }}
                @endif
            </div>

        </main>
    </x-dashboard-layout>
@endif
