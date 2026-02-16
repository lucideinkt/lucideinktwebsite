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
            <h2 class="cart-items-title">Producten</h2>

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
                                <img src="{{ $src }}" alt="{{ $item['name'] }}">
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
                const totalQuantity = event.totalQuantity || 0;

                // Find all cart icon links by looking for links with cart icons inside
                const allLinks = document.querySelectorAll('a');
                const cartLinks = Array.from(allLinks).filter(link => {
                    const icon = link.querySelector('.fa-cart-shopping');
                    return icon !== null || link.href.includes('cart');
                });

                cartLinks.forEach(link => {
                    let cartQuantityElement = link.querySelector('.cart-quantity');

                    if (totalQuantity > 0) {
                        // Cart has items - show or create the badge
                        if (cartQuantityElement) {
                            cartQuantityElement.textContent = totalQuantity;
                        } else {
                            // Create the badge if it doesn't exist
                            cartQuantityElement = document.createElement('span');
                            cartQuantityElement.className = 'cart-quantity';
                            cartQuantityElement.textContent = totalQuantity;
                            link.appendChild(cartQuantityElement);
                        }
                    } else {
                        // Cart is empty - remove the badge if it exists
                        if (cartQuantityElement) {
                            cartQuantityElement.remove();
                        }
                    }
                });
            });
        });
    </script>

    <style>
        /* Base styles are now in cart-page.css. */
    </style>
</div>
