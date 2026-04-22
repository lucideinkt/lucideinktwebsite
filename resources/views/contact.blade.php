<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page contact-page">
        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Contact', 'url' => route('contact')],
        ]" />

        <h1 class="sr-only">Contact — Lucide Inkt</h1>
        @livewire('contact-form')
    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
