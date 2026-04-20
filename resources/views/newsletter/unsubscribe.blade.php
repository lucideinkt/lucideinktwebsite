<x-layout>
    <main class="container page">
        <div class="newsletter-unsubscribe-page__text-box">
            <div class="unsubscribe-icon-wrapper">
                <div class="confirm-icon-circle confirm-icon-circle--unsubscribe">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
            </div>

            <h1 class="title">{{ $message }}</h1>

            <p class="unsubscribe-message">
                Je ontvangt geen e-mails meer van onze nieuwsbrief. Mocht je van gedachten veranderen, dan ben je altijd welkom
                om je opnieuw in te schrijven.
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
