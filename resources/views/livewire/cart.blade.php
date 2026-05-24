<div class="cart-content">
    @if (session('success'))
        <div class="alert alert-success">
            <span class="alert-icon"><i class="fa-solid fa-circle-check"></i></span>
            <span class="alert-text">{{ session('success') }}</span>
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
            <span class="alert-text">{{ session('error') }}</span>
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
        </div>
    @endif

    @if (count($cart) > 0)
        <div class="cart-items-card">
            <h1 class="cart-hero__title">Winkelmand</h1>
            <div class="cart-items-list">
                @foreach ($cart as $item)
                    @php
                        $productId = $item['product_id'];
                        $img = $item['image_1'] ?? '';
                        if (!$img) {
                            $prodModel = \App\Models\Product::find($productId);
                            $img = $prodModel?->image_1 ?? '';
                        }
                        $src = asset('images/placeholder.png');
                        if ($img) {
                            $clean = ltrim($img, '/');
                            if (str_starts_with($clean, 'http://') || str_starts_with($clean, 'https://')) {
                                $src = $clean;
                            } elseif (str_starts_with($clean, 'images/') || str_starts_with($clean, 'image/')) {
                                $src = asset($clean);
                            } elseif (str_starts_with($clean, 'storage/')) {
                                $src = asset($clean);
                            } else {
                                $src = asset('storage/' . $clean);
                            }
                        }
                        $slug = $item['slug'] ?? null;
                        if (!$slug) {
                            $prod = \App\Models\Product::find($productId);
                            $slug = $prod?->slug ?? null;
                        }
                        $productUrl = $slug ? url('/winkel/product/' . $slug) : url('/product/' . $productId);
                        $quantity = $quantities[$productId] ?? ($item['quantity'] ?? 1);
                    @endphp

                    <div class="cart-item-row">
                        <div class="cart-item-image">
                            <a href="{{ $productUrl }}">
                                <img src="{{ $src }}" alt="{{ $item['name'] }}" loading="lazy" decoding="async">
                            </a>
                        </div>

                        <div class="cart-item-details">
                            <h3 class="cart-item-title">
                                <a href="{{ $productUrl }}">{{ $item['name'] }}</a>
                            </h3>
                            <div class="cart-item-price">€ {{ number_format($item['price'], 2, ',', '.') }} per stuk
                            </div>
                        </div>

                        <div class="cart-item-row-2-wrapper">
                            <div class="cart-item-quantity">
                                <div class="qty-control">
                                    <button type="button" class="qty-btn qty-decrease"
                                        wire:click="decrement({{ $productId }})" aria-label="Decrease quantity">
                                        &minus;
                                    </button>
                                    <input type="number" class="qty-input" value="{{ $quantity }}" min="1"
                                        max="1000"
                                        wire:change="updateQuantity({{ $productId }}, $event.target.value)"
                                        wire:loading.attr="disabled">
                                    <button type="button" class="qty-btn qty-increase"
                                        wire:click="increment({{ $productId }})" aria-label="Increase quantity">
                                        +
                                    </button>
                                </div>
                            </div>

                            <div class="cart-item-subtotal">
                                € {{ number_format($item['price'] * $quantity, 2, ',', '.') }}
                            </div>

                            <div class="cart-item-action">
                                <button type="button" class="btn-remove" wire:click="removeItem({{ $productId }})"
                                    wire:confirm="Weet je zeker dat je dit product uit je winkelmand wilt verwijderen?">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="cart-totals">
                <div class="cart-total-divider"></div>
                <div class="cart-total-row final-total">
                    <span class="cart-total-label">Totaal</span>
                    <span class="cart-total-value">€ {{ number_format($total, 2, ',', '.') }}</span>
                </div>
            </div>

            <div class="cart-actions">
                <a href="{{ route('checkoutPage') }}" class="btn-checkout btn">
                    <i class="fa-solid fa-credit-card"></i>
                    Afrekenen
                </a>
                <button type="button" class="btn-clear" wire:click="clearCart"
                    wire:confirm="Weet je zeker dat je de hele winkelmand wilt legen?">
                    <i class="fa-solid fa-trash-can"></i>
                    Winkelmand legen
                </button>
            </div>
        </div>
    @else
        <div class="cart-empty-state-wrapper">
            <div class="cart-empty-state">
                <div class="empty-state-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <h3>Winkelmand is leeg</h3>
                <p>Je hebt nog geen producten toegevoegd aan je winkelmand.</p>
                <div class="empty-state-actions">
                    <a href="{{ route('shop') }}" class="btn-shop">
                        <i class="fa-solid fa-arrow-left"></i>
                        Ga naar de winkel
                    </a>
                </div>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('cart-updated', (event) => {
                const totalQuantity = event?.totalQuantity ?? event?.[0]?.totalQuantity ?? 0;

                // Only update the two known navbar badge elements
                ['cart-quantity-mobile', 'cart-quantity-desktop'].forEach(id => {
                    const badge = document.getElementById(id);
                    if (!badge) return;
                    if (totalQuantity > 0) {
                        badge.textContent = totalQuantity;
                        badge.style.display = 'inline-block';
                    } else {
                        badge.textContent = '0';
                        badge.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <style>
        /* Base styles are now in cart-page.css. */
    </style>
</div>
