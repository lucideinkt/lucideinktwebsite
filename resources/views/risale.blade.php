<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page">
        <x-breadcrumbs :items="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Risale-i Nur', 'url' => route('risale')],
        ]" />
        <div class="risale-i-nur-page__text-box">
            <h1 class="title"><span class="risale-w"></span>at is de R<span class="risale-is"></span>ale-i <span class="risale-nu">r</span>?</h1>
            <p class="let-desk">
                Tafsirs zijn Qur’anexegeses die in <strong>twee categorieën</strong> worden onderscheiden: <strong>de letterlijke en
                    <br>de spirituele</strong>
            </p>

            <p class="let-mobile">
                Tafsirs zijn Qur’anexegeses die in <strong>twee categorieën</strong> worden onderscheiden: <strong>de letterlijke en de spirituele</strong>
            </p>

                <p>
                <strong>Bij de bekende</strong>, letterlijke Tafsirs worden Qur’anische verzen aangehaald, waarna de betekenissen van de woorden en zinnen met bewijzen worden toegelicht.
                </p>

                <p>
                <strong>Bij de tweede</strong>, spirituele Tafsirs worden Qur’anische geloofswaarheden met krachtige redeneringen aan het licht gebracht, beargumenteerd en ontvouwd. Hoewel deze tweede soort van eminent belang is, wordt ze in de letterlijke Tafsirs soms slechts ter aanvulling beknopt opgenomen.
                </p>

            <img class="stapel-one" src="{{ asset('images/boeken-stapel.webp') }}" alt="Risale-i Nur" loading="lazy" decoding="async">

                <p>
                <strong>In de Risale-i Nur daarentegen</strong> wordt deze tweede benadering niet ter aanvulling, maar direct als grondslag gehanteerd. De verankering van fundamentele geloofswaarheden is het primaire doel van deze spirituele Tafsir. Immers, tegenover de hedendaagse spirituele ziektes en antireligieuze indoctrinaties kan een geloofsovertuiging die op navolging berust moeilijk standhouden.

                    Alleen een gegronde overtuiging die op onderzoek is gebaseerd, zou zich effectief kunnen weren tegen de onophoudelijke aanvallen van atheïstische propaganda.

                    Om een onwrikbare overtuiging en een bewust geloof te verschaffen,

                    <img class="stapel-two" src="{{ asset('images/boeken-stapel.webp') }}" alt="Risale-i Nur" loading="lazy" decoding="async">

                    heeft de Risale-i Nur derhalve elke vorm van subjectiviteit vermeden; met uiterst objectieve, rationele en doorslaggevende argumenten worden in deze gezegende boekenreeks zelfs de lastigste geloofswaarheden volwaardig uiteengezet.


                    <strong>Als een ware spirituele tafsir van de Qur’an voldoet de Risale-i Nur aan alle behoeften van deze tijd. Het enige wat van de lezer gevraagd wordt, is lezen met een aandachtige blik en een onbevooroordeeld hart</strong>.
                </p>

            <img src="{{ asset('images/oval_ornament.webp') }}" alt="" loading="lazy" decoding="async">

        </div>
    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
