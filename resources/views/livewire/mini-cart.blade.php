<div class="mini-cart-livewire-wrapper">
    @if(count($items) > 0)
        {{-- Items list --}}
        <div class="mini-cart-items">
            @foreach($items as $item)
                <div class="mini-cart-item">
                    <div class="mini-cart-item-img-wrap">
                        @if(!empty($item['image']))
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="mini-cart-item-img" loading="lazy">
                        @else
                            <div class="mini-cart-item-img-placeholder">
                                <i class="fa-solid fa-book"></i>
                            </div>
                        @endif
                    </div>
                    <div class="mini-cart-item-info">
                        <p class="mini-cart-item-name">
                            @if(!empty($item['slug']))
                                <a href="{{ url('/winkel/product/' . $item['slug']) }}">{{ $item['name'] }}</a>
                            @else
                                {{ $item['name'] }}
                            @endif
                        </p>
                        <div class="mini-cart-item-meta">
                            <div class="mini-cart-qty-controls">
                                <button type="button" class="mini-cart-qty-btn" wire:click="updateQuantity({{ $item['product_id'] }}, {{ $item['quantity'] - 1 }})" aria-label="Minder">−</button>
                                <span class="mini-cart-item-qty">{{ $item['quantity'] }}</span>
                                <button type="button" class="mini-cart-qty-btn" wire:click="updateQuantity({{ $item['product_id'] }}, {{ $item['quantity'] + 1 }})" aria-label="Meer">+</button>
                            </div>
                            <span class="mini-cart-item-price">€ {{ number_format($item['price'], 2, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="mini-cart-item-right">
                        <div class="mini-cart-item-subtotal">
                            € {{ number_format($item['subtotal'], 2, ',', '.') }}
                        </div>
                        <button type="button" class="mini-cart-remove-btn" wire:click="removeItem({{ $item['product_id'] }})" aria-label="Verwijderen">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Totals --}}
        <div class="mini-cart-totals">
            <div class="mini-cart-totals-row">
                <span class="mini-cart-totals-label">
                    <i class="fa-solid fa-bag-shopping"></i>
                    {{ $totalQuantity }} {{ $totalQuantity === 1 ? 'artikel' : 'artikelen' }}
                </span>
                <span class="mini-cart-totals-sub">Subtotaal</span>
                <span class="mini-cart-totals-amount">€ {{ number_format($subtotal, 2, ',', '.') }}</span>
            </div>
            <p class="mini-cart-totals-note">
                <i class="fa-solid fa-circle-info"></i>
                Verzendkosten worden berekend bij het afrekenen
            </p>
            <button type="button" class="mini-cart-clear-btn" wire:click="clearCart" wire:confirm="Weet je zeker dat je de winkelwagen wilt leegmaken?">
                <i class="fa-solid fa-trash"></i> Winkelwagen leegmaken
            </button>
        </div>

    @else
        <div class="mini-cart-empty">
            <i class="fa-solid fa-bag-shopping mini-cart-empty-icon"></i>
            <p class="mini-cart-empty-text">Je winkelwagen is leeg</p>
        </div>
    @endif
</div>
