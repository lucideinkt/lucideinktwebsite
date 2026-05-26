<x-layout>
    <div class="page-normal-background">
    <main class="container page cart-page">

        <div class="cart-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                  ['label' => 'Home', 'url' => route('home')],
                  ['label' => $confirmed ? 'Inschrijving bevestigd' : 'Al bevestigd'],
                ]" />
            </div>
        </div>

        <div class="gradient-border cart-hero-border"></div>

        <div class="cart-content-section">
            <div class="cart-empty-state-wrapper">
                <div class="cart-empty-state">
                    <div class="empty-state-icon">
                        @if($confirmed)
                            <i class="fa-solid fa-circle-check" style="color: #2c582f;"></i>
                        @else
                            <i class="fa-solid fa-envelope-open-text"></i>
                        @endif
                    </div>

                    <h3>
                        @if($confirmed)
                            Inschrijving bevestigd!
                        @else
                            Al bevestigd
                        @endif
                    </h3>

                    <p>
                        @if($confirmed)
                            Je inschrijving voor de nieuwsbrief van Lucide Inkt is succesvol bevestigd.
                            Je ontvangt inshaa'ALLAH onze nieuwsbrief en updates.
                        @else
                            Je inschrijving was al eerder bevestigd. Je staat al op onze nieuwsbrief.
                        @endif
                    </p>

                    <div class="empty-state-actions">
                        <a href="{{ route('home') }}" class="btn-shop">
                            <i class="fa-solid fa-home"></i>
                            Terug naar homepagina
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
