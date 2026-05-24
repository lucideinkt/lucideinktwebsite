<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page contact-page">

        <div class="contact-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                  ['label' => 'Home', 'url' => route('home')],
                  ['label' => 'Contact', 'url' => route('contact')],
                ]" />
            </div>
        </div>

        <div class="gradient-border contact-hero-border"></div>

        <div class="contact-content-section">
            @livewire('contact-form')
        </div>

    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
