<x-layout>
    <main class="container page cart-page">
        <x-breadcrumbs :items="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Winkelmand', 'url' => route('cartPage')]
        ]" />

        <div class="cart-header">
            <h1 class="cart-title font-herina">Winkelmand</h1>
            <p class="cart-subtitle">Bekijk en beheer je geselecteerde producten</p>
        </div>

        <livewire:cart />
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
