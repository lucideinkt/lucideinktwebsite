<x-layout>
    <main class="container page">
        <div class="newsletter-unsubscribe-page__text-box">
            <div class="unsubscribe-icon-wrapper">
                @if($confirmed)
                    <div class="confirm-icon-circle confirm-icon-circle--success">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                @else
                    <div class="confirm-icon-circle confirm-icon-circle--info">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                @endif
            </div>

            <h1 class="title">
                @if($confirmed)
                    Inschrijving bevestigd!
                @else
                    Al bevestigd
                @endif
            </h1>

            <p class="unsubscribe-message">
                @if($confirmed)
                    Je inschrijving voor de nieuwsbrief van Lucide Inkt is succesvol bevestigd.
                    Je ontvangt inshaa'ALLAH onze nieuwsbrief en updates.
                @else
                    Je inschrijving was al eerder bevestigd. Je staat al op onze nieuwsbrief.
                @endif
            </p>

            <div class="unsubscribe-actions">
                <a href="{{ route('home') }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-home"></i> Terug naar homepagina
                </a>
            </div>
        </div>
    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
