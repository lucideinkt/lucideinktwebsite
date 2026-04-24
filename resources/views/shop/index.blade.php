<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page shop">
        {{-- <h2>Winkel</h2> --}}
        @if (session('success'))
            <div class="alert alert-success">
                <span class="alert-icon"><i class="fa-solid fa-circle-check"></i></span>
                <span class="alert-text">{{ session('success') }}</span>
                <button type="button" class="alert-close" aria-label="Sluiten">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                <span class="alert-text">{{ session('error') }}</span>
                <button type="button" class="alert-close" aria-label="Sluiten">&times;</button>
            </div>
        @endif

        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Winkel', 'url' => route('shop')],
        ]" />

        <div class="shop-header">
{{--            <img class="shop-header-image" src="{{ asset('images/our-store-second.webp') }}" alt="Onze Winkel">--}}



            <h1 class="shop-title">W<span class="shop-title-in"></span><span class="shop-title-ke"></span>l</h1>
{{--            <p class="shop-subtitle">Ontdek onze collectie boeken en bestel direct online</p>--}}
        </div>


        <div class="gradient-border"></div>
        <div class="background-of-the-shop-grid">
            <div class="book-box product-cards-grid">
                @foreach ($products as $product)
                    @livewire('product-card', ['product' => $product], key('product-' . $product->id))
                @endforeach
            </div>
        </div>

    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
