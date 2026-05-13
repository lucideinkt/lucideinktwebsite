<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page cart-page">

        <div class="cart-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                    ['label' => 'Home', 'url' => route('home')],
                    ['label' => 'Winkelmand', 'url' => route('cartPage')]
                ]" />
            </div>
            <h1 class="cart-hero__title">Winkelmand</h1>
        </div>

        <div class="gradient-border cart-hero-border"></div>

        <div class="cart-content-section">
            <livewire:cart />
        </div>

    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
