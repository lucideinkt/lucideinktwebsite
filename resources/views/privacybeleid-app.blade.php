<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page info-page">
        <div class="info-page-hero">
            <div class="container">
            <x-breadcrumbs :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Privacybeleid Risale Lezer app', 'url' => route('privacybeleidApp')],
            ]" />
            </div>
        </div>

        <div class="gradient-border"></div>
        <div class="text-box-background">
        <div class="info-page__text-box">

<h1 class="title">Privacybeleid Risale Lezer app</h1>

<p><em>Laatst bijgewerkt: oktober 2026</em></p>

<p>De Risale Lezer app is een gratis app van Stichting Lucide Inkt om de Risale-i Nur te lezen. De app werkt zonder account en vraagt niet om je naam, e-mailadres of andere persoonsgegevens.</p>

<p>De volgende gegevens worden uitsluitend op je eigen apparaat bewaard en niet naar ons verzonden:</p>

<ul>
<li>je leesposities per boek</li>

<li>je bladwijzers en markeringen</li>

<li style="margin-bottom: 15px">je leesinstellingen, zoals lettergrootte en thema</li>
</ul>

<p>Leesposities, bladwijzers en markeringen kun je op elk moment wissen via het tabblad Overige in de app. Door de app te verwijderen worden al deze gegevens van je apparaat verwijderd.</p>

<p>Om boeken te tonen en te doorzoeken haalt de app teksten op van de server van Lucide Inkt. Daarbij ontvangt de server technische gegevens zoals je IP-adres en de opgevraagde pagina. Deze gegevens worden alleen gebruikt voor de werking en beveiliging van de dienst, worden niet gekoppeld aan jouw persoon en worden niet langer bewaard dan nodig.</p>

<p>De app bevat geen advertenties, gebruikt geen analyse- of trackingdiensten en deelt geen gegevens met derden.</p>

<p>Wanneer je vanuit de app de website of webshop opent, geldt ons algemene <a href="{{ route('privacybeleid') }}">privacybeleid</a>.</p>

<p>Heb je vragen over dit privacybeleid? Neem dan contact op via <a href="mailto:info@lucideinkt.nl">info@lucideinkt.nl</a>.</p>

        </div>
        </div><!-- /.text-box-background -->
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
