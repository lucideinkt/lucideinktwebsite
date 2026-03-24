<x-layout>
    <div class="page-normal-background">
    <main class="container page cart-page">
        <x-breadcrumbs :items="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Winkelmand', 'url' => route('cartPage')]
        ]" />

        <div class="cart-header">
            <h1 class="cart-title font-herina">Winkelmand</h1>
        </div>

        <livewire:cart />
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
