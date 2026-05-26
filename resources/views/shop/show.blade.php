<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page product">
        <div class="product-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                    ['label' => 'Home', 'url' => route('home')],
                    ['label' => 'Winkel', 'url' => route('shop')],
                ]" />
            </div>
        </div>
    </main>

    <div class="gradient-border"></div>
    <div class="background-of-the-shop-grid">
        <div class="product-detail-page-inner">
            <div class="product-detail">
                @if ($product)
                    <livewire:product-detail :product="$product" />
                @else
                    <p>Geen product gevonden</p>
                @endif
            </div>
        </div>
    </div>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>

