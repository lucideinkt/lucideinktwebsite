<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page info-page">
        <div class="info-page-hero">
            <div class="container">
            <x-breadcrumbs :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Retourbeleid', 'url' => route('retourbeleid')],
            ]" />
            </div>
            <h1 class="title">Retourbeleid</h1>
        </div>

        <div class="gradient-border"></div>
        <div class="text-box-background">
        <div class="info-page__text-box">

<p><em>Laatst bijgewerkt: februari 2026</em></p>

<p>Je hebt het recht je bestelling binnen 14 dagen na ontvangst te herroepen zonder opgave van reden. De bedenktijd gaat in op de dag na ontvangst van het product.</p>

<h3>Herroeping melden</h3>

<p>Om gebruik te maken van het herroepingsrecht stuur je binnen 14 dagen een e-mail naar <a href="mailto:info@lucideinkt.nl">info@lucideinkt.nl</a> met:</p>

<ul>
<li>je naam</li>

<li>je bestelnummer</li>

<li style="margin-bottom: 15px">de mededeling dat je de overeenkomst wilt herroepen</li>
</ul>

<h3>Gratis retour (NL en BE)</h3>

<p>Na je melding ontvang je van ons kosteloos een retourlabel (voor Nederland en België).</p>

<h3>Voorwaarden voor retour</h3>

<p>Het product dient:</p>

<ul>
<li>onbeschadigd en ongebruikt te zijn;</li>

<li style="margin-bottom: 15px">bij voorkeur in de originele verpakking te worden geretourneerd.</li>
</ul>

<p>Indien een product beschadigd is of duidelijke gebruikssporen heeft, kan een waardevermindering worden toegepast.</p>

<h3>Terugbetaling</h3>

<p>Na ontvangst en controle van het geretourneerde product storten wij het aankoopbedrag binnen 14 dagen terug via dezelfde betaalmethode.</p>

<h3>Uitzonderingen</h3>

<p>Het herroepingsrecht geldt niet voor gepersonaliseerde producten of digitale downloads (indien van toepassing).</p>

        </div>
        </div><!-- /.text-box-background -->
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
