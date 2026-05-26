<x-layout>
    @push('head')
        <title>Uitschrijven nieuwsbrief | Lucide Inkt</title>
        <meta name="robots" content="noindex, nofollow">
    @endpush
    <div class="page-normal-background">
    <main class="container page cart-page">

        <div class="cart-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                  ['label' => 'Home', 'url' => route('home')],
                  ['label' => 'Uitschrijven nieuwsbrief'],
                ]" />
            </div>
        </div>

        <div class="gradient-border cart-hero-border"></div>

        <div class="cart-content-section">
            <div class="cart-empty-state-wrapper">
                <div class="cart-empty-state">
                    <div class="empty-state-icon">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                    </div>

                    <h3>{{ $message }}</h3>

                    <p>
                        Je ontvangt geen e-mails meer van onze nieuwsbrief. Mocht je van gedachten veranderen, dan ben je altijd welkom
                        om je opnieuw in te schrijven.
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
