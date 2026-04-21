<div>
    @if($errorMessage)
        <div class="co-cart-error">
            <i class="fa-solid fa-circle-exclamation"></i> {{ $errorMessage }}
        </div>
    @endif

    @if(count($items) > 0)
        <table class="co-cart-table">
            <thead>
                <tr>
                    <th class="co-cart-th-product">Product</th>
                    <th class="co-cart-th-qty">Aantal</th>
                    <th class="co-cart-th-sub">Subtotaal</th>
                    <th class="co-cart-th-del"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="co-cart-row">
                        <td class="co-cart-td-name">
                            @if(!empty($item['slug']))
                                <a href="{{ url('/winkel/product/' . $item['slug']) }}" class="co-cart-product-link">{{ $item['name'] }}</a>
                            @else
                                <span class="co-cart-product-link">{{ $item['name'] }}</span>
                            @endif
                            <span class="co-cart-unit-price">&euro; {{ number_format($item['price'], 2, ',', '.') }} / stuk</span>
                        </td>
                        <td class="co-cart-td-qty">
                            <div class="checkout-qty-controls">
                                <button type="button" class="checkout-qty-btn" wire:click="decrement({{ $item['product_id'] }})" aria-label="Minder">−</button>
                                <span class="checkout-qty-value">{{ $item['quantity'] }}</span>
                                <button type="button" class="checkout-qty-btn" wire:click="increment({{ $item['product_id'] }})" aria-label="Meer">+</button>
                            </div>
                        </td>
                        <td class="co-cart-td-sub">&euro; {{ number_format($item['subtotal'], 2, ',', '.') }}</td>
                        <td class="co-cart-td-del">
                            <button type="button"
                                class="checkout-remove-btn"
                                wire:click="removeItem({{ $item['product_id'] }})"
                                wire:confirm="Wil je dit product verwijderen?"
                                aria-label="Verwijderen"
                                title="Verwijderen">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="co-cart-shipping-row">
                    <td colspan="4"><span id="shipping-cost"></span></td>
                </tr>
                <tr class="co-cart-total-row" id="total-row">
                    <td colspan="2">Totaal</td>
                    <td colspan="2" class="co-cart-total-amount">
                        <strong id="order-total" data-subtotal="{{ $subtotal }}">&euro; {{ number_format($subtotal, 2, ',', '.') }}</strong>
                    </td>
                </tr>
                <tr id="discount-row" style="display:none" class="co-cart-discount-row">
                    <td colspan="2">Korting <span id="discount-code-label" class="co-cart-discount-label"></span></td>
                    <td colspan="2" class="co-cart-total-amount" style="color:#b30000;">−&euro;<span id="discount-amount">0,00</span></td>
                </tr>
                <tr id="new-total-row" style="display:none" class="co-cart-grand-row">
                    <td colspan="2"><strong>Totaal na korting</strong></td>
                    <td colspan="2" class="co-cart-total-amount"><strong id="order-new-total">&euro; 0,00</strong></td>
                </tr>
            </tfoot>
        </table>
    @else
        <div class="co-cart-empty">
            <div class="co-cart-empty-inner">
                <p class="co-cart-empty-title">Je winkelwagen is leeg</p>
                <p class="co-cart-empty-text">Voeg producten toe vanuit de winkel om verder te gaan.</p>
                <a href="{{ route('shop') }}" class="co-cart-empty-btn">← Terug naar de winkel</a>
            </div>
        </div>
    @endif
</div>

