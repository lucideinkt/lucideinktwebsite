<div class="cart-page">
    <h2>Winkelmand</h2>

    @if (session('success'))
        <div class="alert alert-success" style="position: relative; margin-bottom: 2rem;">
            {{ session('success') }}
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error" style="position: relative; margin-bottom: 2rem;">
            {{ session('error') }}
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
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
            <a href="{{ route('checkoutPage') }}" class="btn-checkout">
                Afrekenen
            </a>
            <button type="button" class="btn-clear" wire:click="clearCart"
                wire:confirm="Weet je zeker dat je de hele winkelmand wilt legen?">
                Winkelmand legen
            </button>
        </div>
    @else
        <div class="cart-empty-state">
            <div class="empty-state-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <h3>Winkelmand is leeg</h3>
            <p>Je hebt nog geen producten toegevoegd aan je winkelmand.</p>
            <a href="{{ route('shop') }}" class="btn-shop">Ga naar de winkel</a>
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
        .cart-page {
            width: 100%;
        }

        .cart-page h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--main-font-color, #620505);
            margin-bottom: 2rem;
        }

        .cart-items-card {
            background: var(--surface-3);
            border-radius: 12px;
            padding: 16px;
            box-shadow: var(--shadow-1);
            margin-bottom: 2rem;
        }

        .cart-items-title {
            font-size: 28px;
            color: var(--main-font-color);
            margin: 0 0 16px;
            font-family: var(--font-bold);
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border-1);
        }

        .cart-items-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .cart-item-row {
            display: grid;
            grid-template-columns: 100px 2fr 180px 120px 50px;
            gap: 20px;
            align-items: center;
            padding: 20px;
            background: var(--surface-2);
            border-radius: 8px;
            border: 1px solid var(--border-1);
        }

        .cart-item-row-2-wrapper {
            display: contents;
        }

        .cart-item-row-2-wrapper>.cart-item-quantity {
            grid-column: 3;
        }

        .cart-item-row-2-wrapper>.cart-item-subtotal {
            grid-column: 4;
        }

        .cart-item-row-2-wrapper>.cart-item-action {
            grid-column: 5;
        }

        .cart-item-image {
            width: 100px;
            height: 100px;
            overflow: hidden;
            border-radius: 6px;
            background: var(--surface-1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 0;
        }

        .cart-item-title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: var(--main-font-color);
            line-height: 1.4;
        }

        .cart-item-title a {
            color: var(--main-font-color);
            text-decoration: none;
            transition: color 0.2s;
            display: block;
            word-break: break-word;
            hyphens: auto;
        }

        .cart-item-title a:hover {
            color: var(--main-color);
        }

        .cart-item-price {
            font-size: 14px;
            color: var(--ink-muted);
        }

        .cart-item-quantity {
            display: flex;
            justify-content: center;
        }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border-1);
            background: var(--surface-3);
            color: var(--main-font-color);
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .qty-btn:hover {
            background: var(--main-color);
            color: var(--surface-2);
            border-color: var(--main-color);
        }

        .qty-input {
            width: 60px;
            height: 32px;
            text-align: center;
            border: 1px solid var(--border-1);
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            color: var(--main-font-color);
        }

        .cart-item-subtotal {
            text-align: right;
            font-size: 18px;
            font-weight: 600;
            color: var(--main-font-color);
        }

        .cart-item-action {
            display: flex;
            justify-content: center;
        }

        .btn-remove {
            width: 36px;
            height: 36px;
            border: none;
            background: #dc3545 !important;
            color: white !important;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .btn-remove i {
            color: white !important;
        }

        .btn-remove:hover {
            background: #c82333 !important;
        }

        .btn-remove:hover i {
            color: white !important;
        }

        .cart-totals {
            margin-top: 20px;
            padding-top: 20px;
        }

        .cart-total-divider {
            height: 1px;
            background: var(--border-2);
            margin-bottom: 15px;
        }

        .cart-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .cart-total-label {
            font-size: 18px;
            font-weight: 600;
            color: var(--main-font-color);
        }

        .cart-total-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--main-font-color);
        }

        .cart-total-row.final-total {
            border-top: 2px solid var(--main-font-color);
            padding-top: 15px;
            margin-top: 10px;
        }

        .cart-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .btn-checkout,
        .btn-clear {
            padding: 10px 20px;
            border-radius: 6px;
            text-align: center;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: background 0.2s, color 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            box-sizing: border-box;
            min-width: auto;
            height: auto;
            vertical-align: middle;
            line-height: 1;
            white-space: nowrap;
            margin: 0;
        }

        .btn-checkout,
        .btn-clear {
            text-align: center;
        }

        .btn-checkout {
            background: var(--main-color);
            color: var(--surface-2);
        }

        .btn-checkout:hover {
            background: var(--main-font-color);
            color: var(--surface-2);
        }

        .btn-clear {
            background: #dc3545;
            color: white;
        }

        .btn-clear:hover {
            background: #c82333;
            color: white;
        }

        .cart-empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--surface-3);
            border-radius: 12px;
            border: 1px solid var(--border-1);
        }

        .empty-state-icon {
            font-size: 64px;
            color: var(--ink-muted);
            margin-bottom: 1.5rem;
        }

        .cart-empty-state h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--main-font-color);
            margin-bottom: 0.5rem;
        }

        .cart-empty-state p {
            color: var(--ink-muted);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .btn-shop {
            display: inline-block;
            padding: 12px 30px;
            background: var(--main-color);
            color: var(--surface-2);
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-shop:hover {
            background: var(--main-font-color);
            color: var(--surface-2);
        }

        @media (max-width: 768px) {
            .cart-item-row {
                display: grid;
                grid-template-columns: 80px 1fr;
                grid-template-rows: auto auto;
                gap: 12px;
                padding: 16px;
                align-items: start;
            }

            .cart-item-image {
                width: 80px;
                height: 80px;
                grid-row: 1;
                align-self: start;
            }

            .cart-item-details {
                grid-column: 2;
                grid-row: 1;
            }

            .cart-item-title {
                font-size: 16px;
            }

            .cart-item-price {
                font-size: 13px;
                margin-top: 4px;
            }

            /* Row 2: Use wrapper as flex container, span both columns */
            .cart-item-row-2-wrapper {
                display: flex;
                justify-content: space-between;
                align-items: center;
                grid-column: 1 / -1;
                grid-row: 2;
                gap: 12px;
                margin-top: 8px;
            }

            .cart-item-row-2-wrapper>.cart-item-quantity {
                grid-column: unset;
                flex-shrink: 0;
            }

            .cart-item-row-2-wrapper>.cart-item-subtotal {
                grid-column: unset;
                flex: 1;
                text-align: center;
                font-size: 16px;
                font-weight: 600;
            }

            .cart-item-row-2-wrapper>.cart-item-action {
                grid-column: unset;
                flex-shrink: 0;
            }

            .cart-actions {
                flex-direction: row;
                justify-content: flex-start;
            }

            .btn-checkout,
            .btn-clear {
                width: auto;
                flex: 0 0 auto;
            }

            .cart-items-card {
                padding: 12px;
            }

            .cart-items-title {
                font-size: 24px;
            }
        }
    </style>
</div>
