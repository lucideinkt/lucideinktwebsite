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

        <div class="shop-hero">
            <div class="container">
            <x-breadcrumbs :items="[
              ['label' => 'Home', 'url' => route('home')],
              ['label' => 'Winkel', 'url' => route('shop')],
            ]" />
            </div>
            <div class="shop-header">
                <div class="shop-frame-wrapper">
                    <img src="{{ asset('images/kader-frame-winkel-af.png') }}" alt="Risale-i Nur boeken kopen bij Lucide Inkt" class="shop-frame-img">
                    <h1 class="shop-title" aria-label="Risale-i Nur Boeken Kopen — Winkel">
                        <span class="sr-only">Risale-i Nur Boeken Kopen — Winkel</span>
                        <span aria-hidden="true">W<span class="shop-title-in"></span><span class="shop-title-ke"></span>l</span>
                    </h1>
                </div>
            </div>
        </div>

        <div class="gradient-border"></div>
        <div class="background-of-the-shop-grid">
            <h2 class="sr-only">Risale-i Nur boeken kopen — collectie Nederlandse en Engelse vertalingen van Said Nursi</h2>

            <p class="shop-intro">Hier kun je de <strong>Risale-i Nur boeken kopen</strong> in het <strong>Nederlands</strong> en <strong>Engels</strong> — vertalingen van de werken van Bediüzzaman Said Nursi.</p>

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
