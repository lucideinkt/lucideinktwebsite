<x-layout>
    <main class="container page checkout success">
        @if(isset($error) && $error)
            <div class="checkout-message error">
                <div class="checkout-message-icon">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="checkout-message-content">
                    <h2>Er is iets misgegaan</h2>
                    <p>{{ $error }}</p>
                    <a class="link-back btn" href="{{ route('shop') }}">Terug naar de shop</a>
                </div>
            </div>
        @elseif(isset($info) && $info)
            <div class="checkout-message info">
                <div class="checkout-message-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="checkout-message-content">
                    <h2>Betaling in behandeling</h2>
                    <p>{{ $info }}</p>
                    <a class="link-back btn" href="{{ route('shop') }}">Terug naar de shop</a>
                </div>
            </div>
        @elseif(isset($success) && $success && isset($order) && $order)
            <div class="checkout-success-container">
                <div class="checkout-success-header">
                    <div class="success-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h1 class="success-title font-herina">Bestelling geplaatst!</h1>
                </div>

                <div class="order-summary-card">
                    <h2 class="order-summary-title">Jouw bestelling</h2>

                    <div class="order-items">
                        <div class="order-items-header">
                            <span class="order-item-col product">Product</span>
                            <span class="order-item-col subtotal">Subtotaal</span>
                        </div>

                        @foreach($order->items as $item)
                            <div class="order-item-row">
                                <span class="order-item-product">
                                    {{ $item->quantity }} × {{ $item->product_name }}
                                </span>
                                <span class="order-item-subtotal">€ {{ number_format($item->subtotal, 2, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-totals">
                        <div class="order-total-divider"></div>

                        <div class="order-total-row">
                            <span class="order-total-label">Totaal</span>
                            <span class="order-total-value">€ {{ number_format($order->total_before, 2, ',', '.') }}</span>
                        </div>

                        @if($order->discount_value > 0)
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
                            $shippingAmount = is_object($order->shipping_cost_amount) ? ($order->shipping_cost_amount->amount ?? 0) : ($order->shipping_cost_amount ?? (is_object($order->shipping_cost) ? ($order->shipping_cost->amount ?? 0) : ($order->shipping_cost ?? 0)));
                            $totalInclShipping = ($order->total_with_shipping ?? ($order->total_after_discount + $shippingAmount));
                        @endphp

                        <div class="order-total-row shipping">
                            <span class="order-total-label">Verzendkosten</span>
                            <span class="order-total-value">€ {{ number_format($shippingAmount, 2, ',', '.') }}</span>
                        </div>

                        <div class="order-total-divider"></div>

                        <div class="order-total-row final-total">
                            <span class="order-total-label">Totaal (incl. verzendkosten)</span>
                            <span class="order-total-value">€ {{ number_format($totalInclShipping, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="order-addresses-grid">
                    @if(isset($delivery) && !empty($delivery['deliveryType']) && strtolower($delivery['deliveryType']) === 'pickup')
                        <div class="order-address-card">
                            <h3 class="address-card-title">
                                <i class="fa-solid fa-map-marker-alt"></i>
                                Bezorging
                            </h3>
                            <div class="address-card-content">
                                <p class="delivery-type"><strong>Afhalen bij afhaalpunt</strong></p>
                                @if($pickupLocation)
                                    <div class="pickup-location">
                                        <p class="location-name">{{ $pickupLocation['locationName'] ?? '-' }}</p>
                                        <p class="location-address">
                                            {{ $pickupLocation['street'] ?? '' }} {{ $pickupLocation['number'] ?? '' }}<br>
                                            {{ $pickupLocation['postalCode'] ?? '' }} {{ $pickupLocation['city'] ?? '' }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="order-address-card">
                            <h3 class="address-card-title">
                                <i class="fa-solid fa-truck"></i>
                                Bezorging
                            </h3>
                            <div class="address-card-content">
                                <p class="delivery-type"><strong>Thuisbezorging</strong></p>
                            </div>
                        </div>
                    @endif

                    <div class="order-address-card">
                        <h3 class="address-card-title">
                            <i class="fa-solid fa-file-invoice"></i>
                            Factuuradres
                        </h3>
                        <div class="address-card-content">
                            <p class="address-name">
                                {{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}
                            </p>
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
                            @if($order->customer->billing_phone)
                                <p class="address-phone">
                                    <i class="fa-solid fa-phone"></i>
                                    {{ $order->customer->billing_phone }}
                                </p>
                            @endif
                            <p class="address-email">
                                <i class="fa-solid fa-envelope"></i>
                                {{ $order->customer->billing_email }}
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
                                <p class="address-name">
                                    {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}
                                </p>
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
                                @if($order->shipping_phone)
                                    <p class="address-phone">
                                        <i class="fa-solid fa-phone"></i>
                                        {{ $order->shipping_phone }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="order-address-card">
                            <h3 class="address-card-title">
                                <i class="fa-solid fa-shipping-fast"></i>
                                Verzendadres
                            </h3>
                            <div class="address-card-content">
                                <p class="address-name">
                                    {{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}
                                </p>
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
                                @if($order->customer->billing_phone)
                                    <p class="address-phone">
                                        <i class="fa-solid fa-phone"></i>
                                        {{ $order->customer->billing_phone }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <div class="order-confirmation-note">
                    <i class="fa-solid fa-info-circle"></i>
                    <p>Je ontvangt een bevestiging en factuur per e-mail. Bewaar deze e-mail voor je administratie.</p>
                </div>
            </div>
        @endif
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
