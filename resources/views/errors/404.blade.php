<x-layout>
    <div class="page-normal-background">
        <main class="container page cart-page">

            <div class="cart-hero">
                <div class="container">
                    <x-breadcrumbs :items="[
                        ['label' => 'Home', 'url' => route('home')],
                        ['label' => 'Pagina niet gevonden', 'url' => '#']
                    ]" />
                </div>
            </div>

            <div class="gradient-border cart-hero-border"></div>

            <div class="cart-content-section">
                <div class="cart-empty-state-wrapper">
                    <div class="cart-empty-state">
                        <div class="empty-state-icon error-404-icon">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <h3>404 — Pagina niet gevonden</h3>
                        <p>De pagina die je zoekt bestaat niet of is verplaatst.<br>Misschien helpt een van de links hieronder je verder.</p>
                        <div class="empty-state-actions error-404-actions">
                            <a href="{{ route('home') }}" class="btn-shop">
                                <i class="fa-solid fa-house"></i>
                                Terug naar home
                            </a>
                            <a href="{{ route('shop') }}" class="btn-shop btn-shop-secondary">
                                <i class="fa-solid fa-bag-shopping"></i>
                                Naar de winkel
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <div class="gradient-border"></div>
        <x-footer></x-footer>
    </div>
</x-layout>

<style>
    .error-404-actions .btn-shop-secondary .fa-bag-shopping {
        font-size: 1em;
    }
</style>

