<x-layout>
    <main class="container page">
        <div class="newsletter-unsubscribe-page__text-box">
            <div class="unsubscribe-icon-wrapper">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>

            <h1 class="title">{{ $message }}</h1>

            <p class="unsubscribe-message">
                Je ontvangt geen e-mails meer van onze nieuwsbrief. Mocht u van gedachten veranderen, dan bent u altijd welkom
                om zich opnieuw in te schrijven.
            </p>

            <div class="unsubscribe-actions">
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fa-solid fa-home"></i> Terug naar homepage
                </a>
            </div>

        </div>
    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
