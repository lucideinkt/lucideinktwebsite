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

<p><em>Laatst bijgewerkt: 10 oktober 2026</em></p>

<p>De Risale Lezer app is een gratis app van Stichting Lucide Inkt om de Risale-i Nur te lezen. De app werkt zonder account en vraagt niet om je naam, e-mailadres of andere persoonsgegevens.</p>

<p><strong>Gegevens in de app</strong></p>

<p>De volgende gegevens bewaart de app lokaal en verstuurt de app niet naar Lucide Inkt:</p>

<ul>
<li>je leesposities per boek</li>

<li>je bladwijzers en markeringen</li>

<li>je opgeslagen tekstfragmenten, met boektitel en paginaverwijzingen</li>

<li>je leesinstellingen, zoals lettergrootte en thema</li>

<li>gedownloade boeken en afbeeldingen voor offline lezen</li>

<li style="margin-bottom: 15px">de lokaal bewaarde boekenlijst en informatie over cataloguscontroles, nieuwe boeken en boekupdates</li>
</ul>

<p>Deze gegevens blijven lokaal bewaard totdat je ze verwijdert of de appgegevens wist. Leesposities, bladwijzers, markeringen en tekstfragmenten kun je wissen via het tabblad Overige. Gedownloade boeken kun je verwijderen via Overige &gt; Boeken downloaden. Door de app te verwijderen wordt de lokale appopslag verwijderd. Eventuele apparaatback-ups worden beheerd door je besturingssysteem en je back-upinstellingen; het verwijderen van de app wist niet noodzakelijk bestaande back-ups.</p>

<p><strong>Verbinding met de boekenservice</strong></p>

<p>Om de boekenlijst, boekteksten, afbeeldingen en boekupdates op te halen, maakt de app via HTTPS verbinding met de boekenservice van Lucide Inkt. Bij de eerste start kun je met de knop Alle boeken downloaden de volledige bibliotheek op je apparaat opslaan. Als je een boek opent dat nog niet is gedownload, kun je het rechtstreeks vanuit dat scherm downloaden.</p>

<p>De boekenlijst en boekversies worden gecontroleerd bij het openen van de app, terugkeer naar de app of bibliotheek en het openen van een boek. Deze automatische controles gebeuren op de achtergrond en worden binnen een appsessie begrensd tot eenmaal per vijf minuten. Een handmatige controle kan direct worden uitgevoerd. De controle verstuurt geen leespositie, bladwijzer of markering; de app haalt de catalogus op en vergelijkt de boekversies lokaal. Zonder internet blijven eerder gedownloade boeken leesbaar.</p>

<p>Nieuwe en gewijzigde boeken worden pas gedownload wanneer je daarvoor kiest. Bij een beschikbare update kun je in de lezer op Bijwerken drukken. Je bestaande kopie blijft beschikbaar totdat de nieuwe download volledig is opgeslagen. De tekst die je op dat moment leest wordt niet automatisch vervangen; je kiest zelf wanneer je de nieuwe versie opent. De app voert geen cataloguscontroles uit wanneer hij gesloten is.</p>

<p>Daarbij ontvangt de server je IP-adres en technische verzoekgegevens, zoals het tijdstip en de opgevraagde URL. Die URL kan een boek of paginanummer bevatten. In de huidige Android- en iOS-app lees en doorzoek je de gedownloade boeken lokaal op je apparaat; zoektermen worden daarbij niet naar de server gestuurd. Oudere appversies en de online webpreview kunnen zoekopdrachten wel via de boekenservice uitvoeren, waardoor een zoekterm in de opgevraagde URL kan staan. Leesposities en opgeslagen fragmenten worden niet als gebruikersprofiel naar de server verstuurd.</p>

<p>Wij gebruiken deze verzoekgegevens om de boekenservice te leveren, misbruik te beperken en storingen te onderzoeken. Onze hostingprovider Cloudways verwerkt deze gegevens voor de hosting van de dienst. Server- en toegangslogs met IP-adressen en opgevraagde URL's worden doorgaans maximaal 7 dagen bewaard. Vermijd het invoeren van persoonlijke of vertrouwelijke gegevens in zoekvelden.</p>

<p><strong>Kopiëren en externe websites</strong></p>

<p>Alleen wanneer je op Kopiëren drukt, zet de app de gekozen tekst op het klembord van je apparaat. Bij een opgeslagen tekstfragment wordt ook de opgemaakte boektitel gekopieerd. De app leest je klembord niet uit. Als je de tekst daarna in bijvoorbeeld WhatsApp plakt, bepaal je zelf met wie je deze deelt en gelden de privacyregels van die andere app.</p>

<p>De app bevat geen advertenties en gebruikt geen analyse- of trackingdiensten. Wij verkopen geen appgegevens en gebruiken de verzoekgegevens niet voor advertentieprofielen.</p>

<p>Wanneer je vanuit de app een link opent, wordt de betreffende website in je browser geopend. Voor de website en webshop van Lucide Inkt geldt ons algemene <a href="{{ route('privacybeleid') }}">privacybeleid</a>, waaronder de informatie over cookies en eventuele bestellingen. Voor andere websites geldt het beleid van hun beheerder.</p>

<p><strong>Contact en privacyrechten</strong></p>

<p>Stichting Lucide Inkt is verantwoordelijk voor de verwerking van gegevens voor deze app en boekenservice. Heb je vragen of wil je een privacyverzoek doen, bijvoorbeeld om inzage of verwijdering van persoonsgegevens, neem dan contact op via <a href="mailto:info@lucideinkt.nl">info@lucideinkt.nl</a>. Er is geen appaccount om te verwijderen. Je kunt ook een klacht indienen bij de Autoriteit Persoonsgegevens. Bij veranderingen in de app of gegevensverwerking werken wij dit beleid bij.</p>

<p><strong>Stichting Lucide Inkt</strong><br>
Kerspellaan 12<br>
7824 JG EMMEN<br>
E-mail: <a href="mailto:info@lucideinkt.nl">info@lucideinkt.nl</a></p>

        </div>
        </div><!-- /.text-box-background -->
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
