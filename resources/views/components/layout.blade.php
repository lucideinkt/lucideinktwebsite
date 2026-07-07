<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google" content="notranslate">

    {{-- Favicons --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.4/dist/vue.global.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@myparcel/delivery-options@6/dist/myparcel.lib.js"></script>
    <link rel="stylesheet" href="{{ asset('css/myparcel.css') }}" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    {{-- Adobe stylesheet fonts --}}
    <link rel="stylesheet" href="https://use.typekit.net/ixm0jkz.css">
    <link rel="stylesheet" href="https://use.typekit.net/pwj1cgt.css">
    <link rel="stylesheet" href="https://use.typekit.net/pwj1cgt.css">
    {{-- OmarNaskh font is only used in the book reader — preloaded there, not here --}}

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

    {{-- Google Analytics — alleen laden in productie --}}
    @if(app()->environment('production') && config('services.google.analytics_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('set', 'linker', {'domains': ['lucideinkt.nl']});
            gtag('config', '{{ config('services.google.analytics_id') }}');
        </script>
    @endif

    {{-- Google Tag Manager — alleen laden in productie --}}
    @if(app()->environment('production') && config('services.google.tag_manager_id'))
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ config('services.google.tag_manager_id') }}');</script>
    @endif
</head>

<body style="position: relative;" class="{{ request()->routeIs('home') ? 'page-home' : 'page-other' }}">

{{-- Google Tag Manager (noscript) --}}
@if(app()->environment('production') && config('services.google.tag_manager_id'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('services.google.tag_manager_id') }}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@endif

@if(auth()->check() && auth()->user()->role === 'admin' && \App\Services\SiteSettingService::isMaintenanceMode())
<div style="
    position: fixed;
    bottom: 0; left: 0; right: 0;
    z-index: 99999;
    background: linear-gradient(90deg, #92400e, #b45309);
    color: #fef3c7;
    font-family: system-ui, sans-serif;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 7px 20px;
    box-shadow: 0 -2px 8px rgba(0,0,0,0.25);
">
    <span>🔧</span>
    <span>ONDERHOUDSMODUS ACTIEF — bezoekers zien de "Binnenkort online" pagina</span>
    <a href="{{ route('admin.settings') }}" style="
        color: #fef3c7;
        text-decoration: underline;
        opacity: 0.8;
        font-weight: 400;
    ">Instellingen</a>
</div>
@endif
    <header class="header">
        <div class="header-box">

            {{-- Left: logo (scrolled only) + cart (not-scrolled only) --}}
            <div class="navbar-cart-sidebar-toggle">
                <a href="{{ route('home') }}" class="mobile-header-logo" aria-label="Naar de homepage">
                    <img src="{{ url('/images/logo_newest.webp') }}" alt="Lucide Inkt — Risale-i Nur in het Nederlands en Engels">
                </a>
                <li class="nav-item mobile-cart-not-scrolled">
                    <button type="button" class="mini-cart-trigger" aria-label="Winkelwagen openen">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span class="cart-quantity cart-quantity-mobile {{ session('cart') && count(session('cart')) ? 'is-visible' : '' }}">
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
                        <a href="{{ route('home') }}"><img src="{{ url('/images/logo_newest.webp') }}" alt="Lucide Inkt — Risale-i Nur in het Nederlands en Engels"></a>
                    </div>
                @endif

                <nav class="navbar">
                    <x-navbar></x-navbar>
                </nav>
                <div class="navbar-shine-dot" aria-hidden="true"></div>
                <div class="navbar-glow" aria-hidden="true">
                    <img src="{{ url('/images/glow-5.png') }}" alt="" aria-hidden="true">
                </div>
            </div>

            {{-- Center: logo (not-scrolled only) --}}
            <div class="logo-container mobile">
                <a href="{{ route('home') }}"><img src="{{ url('/images/logo_newest.webp') }}" alt="Lucide Inkt — Risale-i Nur in het Nederlands en Engels"></a>
            </div>

            {{-- Right: cart (scrolled only) + hamburger (always) --}}
            <div class="navbar-cart-sidebar-toggle">
                <li class="nav-item mobile-cart-scrolled">
                    <button type="button" class="mini-cart-trigger" aria-label="Winkelwagen openen">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span class="cart-quantity cart-quantity-mobile {{ session('cart') && count(session('cart')) ? 'is-visible' : '' }}" id="cart-quantity-mobile">
                            {{ session('cart') && count(session('cart')) ? collect(session('cart'))->sum('quantity') : '0' }}
                        </span>
                    </button>
                </li>
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
                const totalQuantity = event?.totalQuantity ?? event?.[0]?.totalQuantity ?? 0;

                // Update mobile cart counters (both left and right instances)
                document.querySelectorAll('.cart-quantity-mobile').forEach(el => {
                    el.textContent = totalQuantity;
                    el.classList.toggle('is-visible', totalQuantity > 0);
                });

                // Update desktop cart counter
                const desktopCounter = document.getElementById('cart-quantity-desktop');
                if (desktopCounter) {
                    desktopCounter.textContent = totalQuantity;
                    desktopCounter.classList.toggle('is-visible', totalQuantity > 0);
                }
            });

            // Listen for cart success message
            Livewire.on('cart-success', (event) => {
                if (window.showMiniCart) window.showMiniCart();
            });


            // Listen for cart error message
            Livewire.on('cart-error', (event) => {
                const message = event?.message ?? event?.[0]?.message ?? 'Er is een fout opgetreden.';
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
