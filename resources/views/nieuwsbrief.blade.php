<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page contact-page nieuwsbrief-page">

        <div class="contact-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                  ['label' => 'Home', 'url' => route('home')],
                  ['label' => 'Nieuwsbrief', 'url' => route('nieuwsbrief')],
                ]" />
            </div>
        </div>

        <div class="gradient-border contact-hero-border"></div>

        <div class="contact-content-section">
            <div class="contact-form-wrapper">
                <div class="contact-form-box nieuwsbrief-form-box">
                    <h1 class="contact-hero__title">Nieuwsbrief</h1>
                    <p class="contact-form-subtitle" style="max-width: 350px">
                        Schrijf je in en ontvang updates over nieuwe vertalingen en belangrijke aankondigingen van Lucide Inkt.
                    </p>
                    @livewire('newsletter-form')
                </div>
            </div>
        </div>

    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>

