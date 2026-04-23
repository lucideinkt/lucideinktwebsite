<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicons --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    {{-- Additional meta tags for better social sharing --}}
    <meta property="og:locale" content="nl_NL">
    <meta property="og:site_name" content="Lucide Inkt">
    <meta name="twitter:card" content="summary_large_image">

    {{-- Non-production environments: always block indexing --}}
    @if(!app()->isProduction())
        <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex, nofollow">
    @endif

    @stack('head')

    @if(!request()->routeIs('productShow'))
        @if(isset($seoData))
            @if(config('app.debug'))
                <!-- SEOData Debug: Title={{ $seoData->title ?? 'NULL' }}, Description={{ $seoData->description ?? 'NULL' }} -->
            @endif
            {!! seo($seoData) !!}
        @else
            @if(config('app.debug'))
                <!-- SEOData Debug: Using default SEO data -->
            @endif
            {!! seo() !!}
        @endif
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/@myparcel/delivery-options@6/dist/myparcel.lib.js"></script>
    <link rel="stylesheet" href="{{ asset('css/myparcel.css') }}" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    {{-- Adobe stylesheet fonts --}}
    <link rel="stylesheet" href="https://use.typekit.net/ixm0jkz.css">
    <link rel="stylesheet" href="https://use.typekit.net/pwj1cgt.css">
    <link rel="stylesheet" href="https://use.typekit.net/pwj1cgt.css">
    <link rel="preload" href="/fonts/OmarNaskh-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">

    {{-- Polyfill for crypto.randomUUID --}}
    <script>
        if (!window.crypto || !window.crypto.randomUUID) {
            if (!window.crypto) window.crypto = {};
            window.crypto.randomUUID = function () {
                return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
                    (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
                );
            };
        }
    </script>

    @vite(['resources/js/main.js', 'resources/css/front-end-style.css'])
    @livewireStyles
</head>

<body style="position: relative;">
    <header class="header">
        <div class="header-box">
                <div class="navbar-cart-sidebar-toggle">
                    <li class="nav-item">
                        <button type="button" class="mini-cart-trigger" aria-label="Winkelwagen openen">
                            <i class="fa-solid fa-bag-shopping"></i>
                            <span class="cart-quantity" style="display: {{ session('cart') && count(session('cart')) ? 'flex' : 'none' }};" id="cart-quantity-mobile">
                                {{ session('cart') && count(session('cart')) ? collect(session('cart'))->sum('quantity') : '0' }}
                            </span>
                        </button>
                    </li>
                </div>

            <!-- Desktop Hamburger Toggle (visible when scrolled) -->
            <div class="desktop-hamburger-toggle">
                <i class="fa-solid fa-bars"></i>
            </div>

            <div class="desktop-navbar-container">

                @if(request()->routeIs('home'))
                    <div class="logo-container desktop">
                        <a href="{{ route('home') }}"><img src="{{ url('/images/logo_newest.webp') }}" alt=""></a>
                    </div>
                @endif


                <nav class="navbar">
                    <x-navbar></x-navbar>
                </nav>
                <div class="navbar-glow">
                    <img src="{{ url('/images/glow-5.png') }}" alt="">
                </div>
            </div>

            <div class="logo-container mobile">
                <a href="{{ route('home') }}"><img src="{{ url('/images/logo_newest.webp') }}" alt=""></a>
            </div>

            <div class="navbar-cart-sidebar-toggle">
                <div class="sidebar-toggle">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>

        </div>

        </div>
    </header>

    <div class="sidebar">
        <div class="close-toggle">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <nav class="navbar">
            <x-navbar></x-navbar>
        </nav>
    </div>

    {{ $slot }}

    @livewireScripts

    <script>
        // Listen for Livewire cart-updated event
        document.addEventListener('livewire:init', () => {
            Livewire.on('cart-updated', (event) => {
                const totalQuantity = event.totalQuantity || event[0]?.totalQuantity || 0;

                // Update mobile cart counter
                const mobileCounter = document.getElementById('cart-quantity-mobile');
                if (mobileCounter) {
                    mobileCounter.textContent = totalQuantity;
                    mobileCounter.style.display = totalQuantity > 0 ? 'inline-block' : 'none';
                }

                // Update desktop cart counter
                const desktopCounter = document.getElementById('cart-quantity-desktop');
                if (desktopCounter) {
                    desktopCounter.textContent = totalQuantity;
                    desktopCounter.style.display = totalQuantity > 0 ? 'inline-block' : 'none';
                }
            });

            // Listen for cart success message
            Livewire.on('cart-success', (event) => {
                if (window.showMiniCart) window.showMiniCart();
            });

            // Refresh mini cart when cart is updated
            Livewire.on('cart-updated', (event) => {
                // Dispatch refresh to the MiniCart Livewire component
                Livewire.dispatch('cart-updated');
            });

            // Listen for cart error message
            Livewire.on('cart-error', (event) => {
                const message = event.message || event[0]?.message || 'Er is een fout opgetreden.';
                if (window.showToast) {
                    window.showToast(message, true);
                }
            });

            // Listen for newsletter success message
            Livewire.on('newsletter-success', (event) => {
                const message = event.message || event[0]?.message || 'Bedankt voor uw inschrijving!';
                if (window.showToast) {
                    window.showToast(message, false);
                }
            });

            // Listen for newsletter info message
            Livewire.on('newsletter-info', (event) => {
                const message = event.message || event[0]?.message || 'U bent al ingeschreven.';
                if (window.showToast) {
                    window.showToast(message, false);
                }
            });

            // Listen for contact form success
            Livewire.on('contact-success', (event) => {
                const message = event.message || event[0]?.message || 'Bericht verzonden!';
                if (window.showToast) {
                    window.showToast(message, false);
                }
            });

            // Listen for contact form error
            Livewire.on('contact-error', (event) => {
                const message = event.message || event[0]?.message || 'Er is een fout opgetreden.';
                if (window.showToast) {
                    window.showToast(message, true);
                }
            });
        });
    </script>

    <script>
        // Mini Cart Slide-in Panel
        (function () {
            function showMiniCart() {
                const panel    = document.getElementById('mini-cart-panel');
                const backdrop = document.getElementById('mini-cart-backdrop');
                if (panel)    panel.classList.add('show');
                if (backdrop) backdrop.classList.add('show');
            }

            function hideMiniCart() {
                const panel    = document.getElementById('mini-cart-panel');
                const backdrop = document.getElementById('mini-cart-backdrop');
                if (panel)    panel.classList.remove('show');
                if (backdrop) backdrop.classList.remove('show');
            }

            window.showMiniCart = showMiniCart;
            window.hideMiniCart = hideMiniCart;

            document.addEventListener('DOMContentLoaded', function () {
                const closeBtn = document.getElementById('miniCartClose');
                const backdrop = document.getElementById('mini-cart-backdrop');
                if (closeBtn) closeBtn.addEventListener('click', hideMiniCart);
                if (backdrop) backdrop.addEventListener('click', hideMiniCart);

                // Open mini cart when cart icon is clicked
                document.querySelectorAll('.mini-cart-trigger').forEach(btn => {
                    btn.addEventListener('click', showMiniCart);
                });

                // Close on Escape
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') hideMiniCart();
                });
            });
        })();
    </script>

    <!-- Mini Cart Slide-in Panel -->
    <div id="mini-cart-panel" class="mini-cart-panel" role="dialog" aria-label="Winkelwagen">
        <div class="mini-cart-header">
            <span class="mini-cart-title">
                <i class="fa-solid fa-bag-shopping mini-cart-header-icon"></i>
                Winkelwagen
            </span>
            <button class="mini-cart-close" id="miniCartClose" aria-label="Sluiten">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="mini-cart-body">
            <livewire:mini-cart />
        </div>

        <div class="mini-cart-footer">
            <a href="{{ route('cartPage') }}" class="mini-cart-btn-cart">
                <i class="fa-solid fa-bag-shopping"></i>
                Bekijk winkelwagen
            </a>
            <a href="{{ route('checkoutPage') }}" class="mini-cart-btn-checkout">
                <i class="fa-solid fa-credit-card"></i>
                Afrekenen
            </a>
        </div>
    </div>
    <div id="mini-cart-backdrop" class="mini-cart-backdrop"></div>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Terug naar boven">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <style>
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #620505 0%, #8b0707 100%);
            color: #ffffff;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(98, 5, 5, 0.3);
            z-index: 999;
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            pointer-events: none;
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
            user-select: none;
            -webkit-user-select: none;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: auto;
        }

        .back-to-top:hover {
            background: linear-gradient(135deg, #8b0707 0%, #620505 100%);
            box-shadow: 0 6px 16px rgba(98, 5, 5, 0.4);
            transform: translateY(-3px);
        }

        .back-to-top:active {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(98, 5, 5, 0.3);
        }

        .back-to-top i {
            pointer-events: none;
            color: #f5dfac;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .back-to-top {
                width: 45px;
                height: 45px;
                bottom: 20px;
                right: 20px;
                font-size: 18px;
            }

            .back-to-top:hover {
                /* Disable hover effect on mobile */
                transform: translateY(0);
            }

            .back-to-top:active {
                transform: scale(0.95);
            }
        }
    </style>

    {{-- Cookie Consent Banner (GDPR/AVG) --}}
    <x-cookie-consent />

    <script>
        // Back to Top functionality
        const backToTopBtn = document.getElementById('backToTop');

        // Show/hide button based on scroll position
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });

        // Function to scroll to top
        const scrollToTop = (e) => {
            e.preventDefault();
            e.stopPropagation();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };

        // Handle both click and touch events for better mobile support
        backToTopBtn.addEventListener('click', scrollToTop);
        backToTopBtn.addEventListener('touchstart', scrollToTop, { passive: false });
    </script>

</body>

</html>
