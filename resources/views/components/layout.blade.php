<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('head')

    @if(!request()->routeIs('productShow'))
        @if(isset($SEOData))
            {!! seo($SEOData) !!}
        @else
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@myparcel/delivery-options@6/dist/style.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/css/lightbox.min.css"
        integrity="sha512-xtV3HfYNbQXS/1R1jP53KbFcU9WXiSA1RFKzl5hRlJgdOJm4OxHCWYpskm6lN0xp0XtKGpAfVShpbvlFH3MDAA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/js/lightbox.min.js"
        integrity="sha512-KbRFbjA5bwNan6DvPl1ODUolvTTZ/vckssnFhka5cG80JVa5zSlRPCr055xSgU/q6oMIGhZWLhcbgIC0fyw3RQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Adobe stylesheet fonts --}}
    <link rel="stylesheet" href="https://use.typekit.net/pwj1cgt.css">

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
                <li class="nav-item cart">
                    <a href="{{ route('cartPage') }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                        @if(session('cart') && count(session('cart')))
                            <span class="cart-quantity">
                                {{ collect(session('cart'))->sum('quantity') }}
                            </span>
                        @endif
                    </a>
                </li>
            </div>

            <div class="desktop-navbar-container">

                @if(request()->routeIs('home'))
                    <div class="logo-container desktop">
                        <a href="{{ route('home') }}"><img src="{{ url('/images/logo_new_2.webp') }}" alt=""></a>
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
                <a href="{{ route('home') }}"><img src="{{ url('/images/logo_new_2.webp') }}" alt=""></a>
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

        if (typeof lightbox !== 'undefined') {
            lightbox.option({
                'albumLabel': "%1 / %2",
                'alwaysShowNavOnTouchDevices': true
            })
        }
    </script>

</body>

</html>
