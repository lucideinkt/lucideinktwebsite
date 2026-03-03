<x-layout :seo-data="$SEOData">
    <main class="container page contact-page">
        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Contact', 'url' => route('contact')],
        ]" />

        @livewire('contact-form')
    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
