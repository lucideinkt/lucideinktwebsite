@if(auth()->user()->role === 'user')
    <x-layout>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif
        <x-user-dashboard-layout>
            <div class="order-detail-page">
                <h2>Bestelling #{{ $order->id }}</h2>

                <div class="order-addresses-grid">
                    <div class="order-address-card">
                        <h3 class="address-card-title">
                            <i class="fa-solid fa-user"></i>
                            Klantgegevens
                        </h3>
                        <div class="address-card-content">
                            <p class="address-name">{{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</p>
                            <p class="address-email">
                                <i class="fa-solid fa-envelope"></i>
                                {{ $order->customer->billing_email }}
                            </p>
                            @if($order->customer->billing_phone)
                                <p class="address-phone">
                                    <i class="fa-solid fa-phone"></i>
                                    {{ $order->customer->billing_phone }}
                                </p>
                            @endif
                            <p class="address-date">
                                <i class="fa-solid fa-calendar"></i>
                                {{ $order->created_at->format('d-m-Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <div class="order-address-card">
                        <h3 class="address-card-title">
                            <i class="fa-solid fa-receipt"></i>
                            Bestelling
                        </h3>
                        <div class="address-card-content">
                            <p><strong>Status:</strong> {{ $order->status_label }}</p>
                            <p><strong>Totaal:</strong> € {{ number_format($order->total, 2, ',', '.') }}</p>
                            <p><strong>Betaalstatus:</strong> {{ $order->payment_status_label ?? 'Onbekend' }}</p>
                            @if (!empty($order->invoice_pdf_path))
                                <p>
                                    <strong>Factuur:</strong>
                                    <a href="{{ route('orders.invoice', $order->id) }}" class="invoice-link" target="_blank">Download factuur</a>
                                </p>
                            @endif
                            @if ($order->myparcel_track_trace_url)
                                <p>
                                    <strong>Track & Trace:</strong>
                                    <a href="{{ $order->myparcel_track_trace_url }}" class="invoice-link" target="_blank">
                                        {{ $order->myparcel_barcode ?? 'Bekijk zending' }}
                                    </a>
                                </p>
                            @endif
                            @if ($order->myparcel_delivery_type)
                                @php
                                    $deliveryTypesShort = [
                                        'standard' => 'Thuisbezorging',
                                        'pickup' => 'Afhaalpunt',
                                    ];
                                @endphp
                                <p><strong>Bezorgtype:</strong> {{ $deliveryTypesShort[$order->myparcel_delivery_type] ?? ucfirst($order->myparcel_delivery_type ?? '-') }}</p>
                            @endif
                        </div>
                    </div>

                    @if($order->myparcel_delivery_type == 'pickup' && isset($pickupLocation))
                        <div class="order-address-card">
                            <h3 class="address-card-title">
                                <i class="fa-solid fa-map-marker-alt"></i>
                                Afhaalpunt
                            </h3>
                            <div class="address-card-content">
                                <p class="location-name">{{ $pickupLocation['locationName'] ?? '-' }}</p>
                                <p class="location-address">
                                    {{ $pickupLocation['street'] ?? '' }} {{ $pickupLocation['number'] ?? '' }}<br>
                                    {{ $pickupLocation['postalCode'] ?? '' }} {{ $pickupLocation['city'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    @endif

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
                        </div>
                    </div>

                    @if($order->shipping_street)
                        <div class="order-address-card">
                            <h3 class="address-card-title">
                                <i class="fa-solid fa-shipping-fast"></i>
                                Verzendadres
                            </h3>
                            <div class="address-card-content">
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
                            </div>
                        </div>
                    @else
                        <div class="order-address-card">
                            <h3 class="address-card-title">
                                <i class="fa-solid fa-shipping-fast"></i>
                                Verzendadres
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
                            </div>
                        </div>
                    @endif
                </div>

                <div class="order-summary-card">
                    <h2 class="order-summary-title">Producten</h2>
                    <div class="order-items-table">
                        <div class="order-items-header">
                            <span class="order-item-col product">Product</span>
                            <span class="order-item-col quantity">Aantal</span>
                            <span class="order-item-col price">Stukprijs</span>
                            <span class="order-item-col subtotal">Subtotaal</span>
                        </div>
                        @forelse ($order->items as $item)
                            <div class="order-item-row">
                                <span class="order-item-product">{{ $item->product_name }}</span>
                                <span class="order-item-quantity">{{ $item->quantity }}</span>
                                <span class="order-item-price">€ {{ number_format($item->unit_price, 2, ',', '.') }}</span>
                                <span class="order-item-subtotal">€ {{ number_format($item->subtotal, 2, ',', '.') }}</span>
                            </div>
                        @empty
                            <div class="order-item-row empty-state">
                                <span>Geen items gevonden in deze bestelling.</span>
                            </div>
                        @endforelse
                    </div>

                    <div class="order-totals">
                        <div class="order-total-divider"></div>
                        
                        <div class="order-total-row">
                            <span class="order-total-label">Totaal</span>
                            <span class="order-total-value">€ {{ number_format($order->total_before ?? $order->total, 2, ',', '.') }}</span>
                        </div>

                        @if ($order->discount_value > 0)
                            <div class="order-total-row discount">
                                <span class="order-total-label">Korting
                                    @if($order->discount_code)
                                        <span class="discount-code-label">({{ $order->discount_code }})</span>
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
                                <span class="order-total-label">Totaal na korting</span>
                                <span class="order-total-value">€ {{ number_format($order->total_after_discount, 2, ',', '.') }}</span>
                            </div>
                        @endif

                        @php
                            $shippingAmount = is_numeric($order->shipping_cost_amount) ? $order->shipping_cost_amount : (is_object($order->shipping_cost_amount) ? ($order->shipping_cost_amount->amount ?? 0) : 0);
                            $totalInclShipping = $order->total;
                        @endphp

                        @if($shippingAmount > 0)
                            <div class="order-total-row shipping">
                                <span class="order-total-label">Verzendkosten</span>
                                <span class="order-total-value">€ {{ number_format($shippingAmount, 2, ',', '.') }}</span>
                            </div>
                        @endif

                        <div class="order-total-divider"></div>
                        
                        <div class="order-total-row final-total">
                            <span class="order-total-label">Totaal (incl. verzendkosten)</span>
                            <span class="order-total-value">€ {{ number_format($totalInclShipping, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .order-detail-page {
                    width: 100%;
                }

                .order-detail-page h2 {
                    font-size: 1.75rem;
                    font-weight: 600;
                    color: var(--main-font-color, #620505);
                    margin-bottom: 2rem;
                }

                .order-addresses-grid {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 25px;
                    margin-bottom: 30px;
                }

                .invoice-link {
                    color: var(--blue-1, #0d6efd);
                    text-decoration: underline;
                    transition: color 0.2s ease;
                }

                .invoice-link:hover {
                    color: #0b5ed7;
                }

                .order-items-table {
                    margin-bottom: 16px;
                }

                .order-items-header {
                    display: grid;
                    grid-template-columns: 2fr 0.8fr 1fr 1fr;
                    gap: 15px;
                    padding: 8px 0;
                    border-bottom: 2px solid var(--main-font-color);
                    margin-bottom: 10px;
                }

                .order-item-col.product {
                    font-weight: 600;
                    color: var(--main-font-color);
                    font-size: 16px;
                }

                .order-item-col.quantity,
                .order-item-col.price,
                .order-item-col.subtotal {
                    font-weight: 600;
                    color: var(--main-font-color);
                    font-size: 16px;
                    text-align: right;
                }

                .order-item-row {
                    display: grid;
                    grid-template-columns: 2fr 0.8fr 1fr 1fr;
                    gap: 15px;
                    padding: 8px 0;
                    border-bottom: 1px solid var(--border-2);
                    align-items: center;
                }

                .order-item-row:last-of-type {
                    border-bottom: none;
                }

                .order-item-row.empty-state {
                    grid-template-columns: 1fr;
                    text-align: center;
                    padding: 2rem;
                    color: var(--ink-muted);
                    font-style: italic;
                    border-bottom: none;
                }

                .order-item-product {
                    font-size: 16px;
                    color: var(--main-font-color);
                    line-height: 1.5;
                }

                .order-item-quantity,
                .order-item-price,
                .order-item-subtotal {
                    font-size: 16px;
                    color: var(--main-font-color);
                    font-weight: 500;
                    text-align: right;
                }

                .address-date {
                    margin-top: 8px;
                    color: var(--ink-muted);
                    display: flex;
                    align-items: center;
                    gap: 8px;
                }

                .address-date i {
                    font-size: 14px;
                    color: var(--main-color);
                }

                @media (max-width: 768px) {
                    .order-addresses-grid {
                        grid-template-columns: 1fr;
                        gap: 20px;
                    }

                    .order-items-header,
                    .order-item-row {
                        grid-template-columns: 1fr;
                        gap: 8px;
                    }

                    .order-item-col.quantity,
                    .order-item-col.price,
                    .order-item-col.subtotal,
                    .order-item-quantity,
                    .order-item-price,
                    .order-item-subtotal {
                        text-align: left;
                    }
                }
            </style>
        </x-user-dashboard-layout>
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
