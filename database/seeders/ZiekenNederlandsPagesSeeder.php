<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ZiekenNederlandsPagesSeeder extends BookPagesSeeder
{
    protected function productSlug(): string
    {
        // return the exact slug used when creating the product in DatabaseSeeder
        return 'het-traktaat-voor-de-zieken-nederlands';
    }

    protected function bookTitle(): string
    {
        return 'Het Traktaat Voor de Zieken';
    }

    protected function pages(): array
    {
        // Add page definitions here. Keep it empty for now or add a few sample pages.
        // You can paste the HTML of each page into the 'content' field.
        return [
            [
                'page_number' => 5,
                'content' => '<div class="page" id="5">

<p class="text-end page-number">#5</p>

<div class="text-center page-title-chapter delima-font">
    <h2>De Vijfentwintigste Flits</h2>
</div>

<p class="text-center text-italic">
Bestaande Uit
</p>

<p class="text-red small-title text-center" style="margin-top: -20px"><strong>Vijfentwintig Genezingen</strong></p>

<p class="text-bold">
Dit traktaat is als een zalf, een troost en een spiritueel recept voor de zieken geschreven, waarbij wij ze in gedachte een bezoek brengen en beterschap toewensen.
</p>

<p class="text-red small-title text-center text-bold">
Een Opmerking en een Verontschuldiging
</p>

<p>
Dit spirituele recept is vlotter dan al onze andere geschriften samengesteld<sup>1</sup>. Daarnaast hebben wij bij dit traktaat in tegenstelling tot al onze andere publicaties geen tijd kunnen vinden om revisies te verrichten en aandachtig te werk te gaan. Evenals de samenstelling is ook de controle ervan eenmalig haastig uitgevoerd, waardoor het als kladversie een beetje slordig is uitgekomen. Herinneringen die spontaan in het hart opwelden, wilden wij niet met woordkunst en mooimakerij vertroebelen. Aldus hebben wij verdere revisies onnodig geacht. Ik verzoek de lezers en vooral de zieken om bepaalde onprettige uitspraken of botte bewoordingen en formuleringen door de vingers te zien, en beden voor mij te verrichten.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> Dit traktaat is in vierenhalf uur samengesteld.
</p>

<p class="footnote-p text-italic">
<strong>Ondertekend door</strong>: Rüştü, Re’fet, Husrev en Said.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 6,
                'content' => '<div class="page" id="6">

<p class="text-end page-number">#6</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: 18px auto 0 auto; max-width: 500px;">
بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ
</p>

<div class="text-center text-red">✦</div>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: 18px auto 0 auto; max-width: 500px;">
اَلَّذٖينَ اِذَٓا اَصَابَتْهُمْ مُصٖيبَةٌ قَالُٓوا اِنَّا لِلّٰهِ وَاِنَّٓا اِلَيْهِ رَاجِعُونَ ۞ وَالَّذٖى هُوَ يُطْعِمُنٖى وَيَسْقٖينِ ۞ وَاِذَا مَرِضْتُ فَهُوَ يَشْفٖينِ
</p>

<p class="text-bold text-center">
In deze Flits zullen wij bondig “Vijfentwintig Genezingen” uiteenzetten waarin slachtoffers van calamiteiten en zieken – die eentiende van de mensheid uitmaken – een ware troost en een heilzame zalf kunnen vinden.
</p>

<p class="text-red small-title text-center">
<strong>De Eerste Genezing</strong>
</p>

<p class="text-center">
O hulpeloze zieke!
</p>

<p>
Maak je geen zorgen; wees geduldig. Jouw ziekte is geen kwaal voor jou, maar enigszins een heling. Je leven is tenslotte een kapitaal dat uiteindelijk opraakt.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> In de Naam van ALLAH, de Barmhartige, de Genadige.
</p>

<p class="footnote-p">
<sup>2</sup> “Wanneer rampspoed hen treft, zeggen zij: ‘Voorzeker... wij komen van ALLAH, en voorzeker... tot Hem zullen wij wederkeren’.” - <em>de Heilige Qur’an, 2:156</em>
</p>

<p class="footnote-p">
<sup>3</sup> “En Hij is Degene Die mij in voedsel en drank voorziet. En wanneer ik ziek ben, is Hij Degene Die mijn ziekte geneest.” - <em>de Heilige Qur’an, 26:79-80</em>
</p>

</div>

</div>'
            ],
            [
                'page_number' => 6,
                'content' => '<div class="page" id="6">

<p class="text-end page-number">#6</p>

<p class="text-center text-arabic-bismillah" dir="rtl" lang="ar">
<img src="/images/bismillah .svg" alt="Bismillah" class="bismillah-svg bismillah-svg-light">
<img src="/images/bismillah-dark.svg" alt="Bismillah" class="bismillah-svg bismillah-svg-dark">
<span class="fn-ref-wrap"><span class="fn-ref-word"></span><button class="fn-ref" type="button" aria-label="Voetnoot 1" data-fn="1" data-html="&lt;p class=&quot;footnote-p fn-popover__para&quot;&gt;
 “In de Naam van ALLAH, de Barmhartige, de Genadige.”
&lt;/p&gt;"><sup>1</sup></button></span>
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: 0px auto 0 auto; max-width: 500px;">
اَلَّذٖينَ اِذَٓا اَصَابَتْهُمْ مُصٖيبَةٌ قَالُٓوا اِنَّا لِلّٰهِ وَاِنَّٓا اِلَيْهِ رَاجِعُونَ<sup>2</sup>
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: 0px auto 0 auto; max-width: 500px;">
وَالَّذٖى هُوَ يُطْعِمُنٖى وَيَسْقٖينِ ۞ وَاِذَا مَرِضْتُ فَهُوَ يَشْفٖينِ<sup>3</sup>
</p>

<p class="text-bold text-center" style="margin-top: 18px">
In deze Flits zullen wij bondig “Vijfentwintig Genezingen” uiteenzetten waarin slachtoffers van calamiteiten en zieken – die eentiende van de mensheid uitmaken – een ware troost en een heilzame zalf kunnen vinden.
</p>

<p class="text-red small-title text-center">
<strong>De Eerste Genezing</strong>
</p>

<p class="text-center text-bold">
O hulpeloze zieke!
</p>

<p>
Maak je geen zorgen; wees geduldig. Jouw ziekte is geen kwaal voor jou, maar enigszins een heling. Je leven is tenslotte een kapitaal dat uiteindelijk opraakt.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> In de Naam van ALLAH, de Barmhartige, de Genadige.
</p>

<p class="footnote-p">
<sup>2</sup> “Wanneer rampspoed hen treft, zeggen zij: ‘Voorzeker... wij komen van ALLAH, en voorzeker... tot Hem zullen wij wederkeren’.” - <em>de Heilige Qur’an, 2:156</em>
</p>

<p class="footnote-p">
<sup>3</sup> “En Hij is Degene Die mij in voedsel en drank voorziet. En wanneer ik ziek ben, is Hij Degene Die mijn ziekte geneest.” - <em>de Heilige Qur’an, 26:79-80</em>
</p>

</div>

</div>'
            ],
            [
                'page_number' => 7,
                'content' => '<div class="page" id="7">

<p class="text-end page-number">#7</p>

<p>
Als het geen vruchten afwerpt, zal het vergeefs verloren gaan. Tevens vliegt het in gerieflijkheid en onachtzaamheid zo voorbij. Jouw ziekte baart grote winsten en maakt jouw levenskapitaal vruchtdragend. Tevens staat ze niet toe dat je leven snel voorbijgaat; ze grijpt hem vast en verlengt zijn duur, totdat ze haar vruchten heeft afgeworpen, waarna ze vertrekt...
</p>

<p>
Voorwaar, om aan te geven dat de levensduur dankzij ziekten wordt verlengd, is de volgende uitdrukking vrijwel spreekwoordelijk geworden:
</p>

<p class="text-italic">
“Ellendige tijden lijken niet te verstrijken, terwijl plezierige tijden zo voorbijvliegen.”
</p>

<p class="text-red small-title text-center">
<strong>De Tweede Genezing</strong>
</p>

<p class="text-center text-bold">
O ongeduldige zieke!
</p>

<p>
Heb geduld en wees dankbaar. Deze ziekte van jou kan je levensminuten als gebedsuren laten gelden. Godsdienstigheid kent immers twee varianten.
</p>

<p>
<span class="text-bold">De ene</span> is de actieve Godsdienstigheid die uit de salât, smeekbeden en dergelijke bekende gebedsdiensten bestaat.
</p>

<p>
<span class="text-bold">De andere</span> is de passieve Godsdienstigheid waarbij ziekten en calamiteiten ertoe leiden dat het slachtoffer zijn onmacht en zijn zwakte verneemt. Bijgevolg neemt hij toevlucht tot zijn Genadige Schepper en smeekt. Zodoende vervult hij een gebedsdienst die zuiver en ongekunsteld is.
</p>

</div>'
            ],
            [
                'page_number' => 8,
                'content' => '<div class="page" id="8">

<p class="text-end page-number">#8</p>

<p>
Waarlijk, op voorwaarde dat er niet over ALLAH wordt geklaagd, zal het leven van een gelovige gedurende zijn ziekteperiodes volgens authentieke overleveringen als een gebedsdienst gelden. Het is zelfs zo dat voor bepaalde geduldige en dankbare zieken elke minuut die ze in ziekte doorbrengen als een uur lange gebedsdienst kan gelden; voor bepaalde hoogontwikkelde gelovigen kan zo’n minuut zelfs als een dag lange gebedsdienst gelden. Volgens authentieke overleveringen en waarachtige waarnemingen staat dit vast.
</p>

<p class="text-bold">
Ten aanzien van een ziekte die jouw ene levensminuut als duizend minuten laat gelden en jou een duurzaam leven laat aanwinnen, behoor jij niet te klagen maar dank te betuigen.
</p>

<p class="text-red small-title text-center">
<strong>De Derde Genezing</strong>
</p>

<p class="text-center text-bold">
O onverdraagzame zieke!
</p>

<p>
Getuige het feit dat degenen die op aarde komen allemaal weer vertrekken, de jongeren ouderdom ondervinden, en de aarde in vergankelijkheid en scheiding blijft voortwentelen, is de mens niet naar deze wereld gekomen om gelukkig te worden en te genieten.
</p>

<p>
En ondanks dat de mens de voortreffelijkste, de hoogwaardigste en wat uitrustingen betreft de rijkste onder de levensvormen is, en zelfs als de sultan der levensvormen kan worden beschouwd, zal hij door de gedachten aan vergane genietingen en toekomstige kwalen zijn leven ten opzichte van dieren op de laagwaardigste wijze ongelukkig en ellendig doorbrengen.
</p>

</div>'
            ],
            [
                'page_number' => 9,
                'content' => '<div class="page" id="9">

<p class="text-end page-number">#9</p>

<p>
Aldus is de mens niet naar deze wereld gekomen om slechts een leuk leven te leiden en zijn tijd op aarde aan het najagen van comfort en weelde te verdoen. De mens – <span class="text-italic">die een opzienbarend kapitaal in handen heeft</span> – is hier veeleer gekomen om middels handel voor de gelukzaligheid van een eeuwig en aanhoudend leven te ijveren. Het kapitaal dat hem is gegeven, is zijn levensduur.
</p>

<p>
Als ziektes niet zouden bestaan, dan zouden gezondheid en welzijn onachtzaamheid veroorzaken, de aarde fascinerend doen overkomen en het hiernamaals doen vergeten. Zij brengen het graf en de dood immers niet in herinnering, maar sporen jou eerder aan om je levenskapitaal aan vluchtige amusementen nutteloos te verkwisten. Een ziekte daarentegen opent opeens je ogen, en spreekt je bestaan en je lichaam als volgt aan:
</p>

<p class="text-italic">
“Jij bent niet onsterfelijk, noch onbandig; jij hebt een taak. Zie af van hoogmoed, gedenk jouw Schepper, besef dat jij het graf zult intreden en bereid je voor!”
</p>

<p>
Voorwaar, vanuit deze optiek dient een ziekte als een onbedrieglijke adviseur en een vermanende gids. In dit opzicht behoort ze niet beklaagd maar bedankt te worden. Mocht ze te zwaar uitvallen, dan behoort geduld gewenst te worden.
</p>

</div>'
            ],
            [
                'page_number' => 10,
                'content' => '<div class="page" id="10">

<p class="text-end page-number">#10</p>

<p class="text-red small-title text-center">
<strong>De Vierde Genezing</strong>
</p>

<p class="text-center text-bold">
O klagende zieke!
</p>

<p>
Jij hebt geen recht om te klagen, maar om dank te betuigen en geduldig te blijven. Immers, je lichaam, je ledematen en je zintuigen behoren niet tot jouw eigendom. Jij hebt ze niet vervaardigd, noch heb jij ze elders ingekocht. Aldus behoren ze tot het eigendom van een Ander. Hun Eigenaar doet met Zijn eigendom wat Hij wil.
</p>

<p>
Bijvoorbeeld, stel – <span class="text-italic">zoals in <strong>“Het Zesentwintigste Woord”</strong> is verteld</span> – dat er een zeer rijke en uiterst getalenteerde kunstenaar is die zijn beeldige kunstwerken en kostbare bezittingen tentoon wil stellen. Dientengevolge betaalt hij een arme man om hem voor een uur als model te laten werken. Hij laat die arme man één van zijn uiterst kunstig geweven en met juwelen getooide kostuums dragen, waarna hij aanpassingen op het kostuum begint aan te brengen en de man in verscheidene houdingen laat poseren. Om variëteiten van zijn buitengewone kunstvaardigheid te demonstreren, knipt, verandert, verlengt en verkort hij het kostuum.
</p>

<p>
De vraag is nu of de arme man die zijn loon reeds ontvangen heeft het recht heeft om zich als volgt uit te laten: <span class="text-italic">“U bezorgt mij moeite. Door mij telkens te laten zitten en te laten staan, maakt u het mij moeilijk. Dit kostuum dat mij zo goed staat, past u aan, waardoor ik er minder goed uit kom te zien. U hebt genadeloos en meedogenloos gehandeld.”</span>
</p>

</div>'
            ],
            [
                'page_number' => 11,
                'content' => '<div class="page" id="11">

<p class="text-end page-number">#11</p>

<p>
Voorwaar, o zieke! Evenals dit voorbeeld heeft de Ontzaglijke Kunstenaar een lichamelijk kostuum geweven, met juwelen in de vorm van ogen, oren, een verstand, een hart en dergelijke lumineuze zintuigen getooid, en jou ermee bekleed. Om de weefkunsten van Zijn Schone Namen te demonstreren, laat Hij jou in vele omstandigheden verkeren en via verscheidene toestanden verandering ondergaan. Zoals jij Zijn Naam <strong>“Onderhouder”</strong> dankzij honger ondervindt, kun jij Zijn Naam <strong>“Genezer”</strong> dankzij jouw ziekte ontwaren.
</p>

<p>
Omdat kwellingen en calamiteiten de hoedanigheden van bepaalde Namen demonstreren, bevatten zij flitsen van Wijsheid en stralen van Genade waarin vele schoonheden schitteren. Als alle sluiers zouden worden opgeheven, dan zou je onder de sluier van de ziekte waar je zo van terugdeinst en walgt, bevallige en beeldige betekenissen ontdekken.
</p>

<p class="text-red small-title text-center">
<strong>De Vijfde Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke die niet aan zijn kwaal kan ontsnappen!
</p>

<p>
Uit ervaring ben ik ervan overtuigd geraakt dat in deze tijden een ziekte voor sommigen een Godsgeschenk... een Genadegift is. Ondanks dat ik onwaardig ben, hebben enkele jongeren mij de afgelopen acht à negen jaar voor beden in verband met hun ziekte bezocht.
</p>

</div>'
            ],
            [
                'page_number' => 12,
                'content' => '<div class="page" id="12">

<p class="text-end page-number">#12</p>

<p>
Ik merkte op dat elke zieke jeugdeling in tegenstelling tot zijn leeftijdsgenoten aan zijn hiernamaals begon te denken; hij had geen last van de dronkenschap der jeugdigheid. De dierlijke aandriften die tot onachtzaamheid leiden, kon hij enigszins onderdrukken. Toen ik mij dit realiseerde, herinnerde ik de jongeren eraan dat de verdraagzame ziekten waaraan ze leden Goddelijke gunsten waren. Ik zei:
</p>

<p class="text-italic">
“Broeder, ik ben niet tegen deze ziekte van jou. Hoe kan ik beden voor jou verrichten als je ziekte geen medelijden bij mij opwekt? Probeer geduldig te blijven tot het moment waarop je ziekte jou volledig heeft ontwaakt. En nadat je ziekte haar taak heeft volbracht, zal de Genadige Schepper jou inshâ’ALLAH genezing schenken.”
</p>

<p>
Bovendien zei ik:
</p>

<p class="text-italic">
“De vloek van gezondheid heeft ertoe geleid dat bepaalde leeftijdsgenoten van jou in dwaling zijn beland, de salât hebben verwaarloosd, het graf zijn gaan negeren, ALLAH zijn vergeten, en voor een ogenschijnlijk genot van een uur in dit tijdelijke leven op aarde hun eeuwige leven in gevaar hebben gebracht en hebben aangetast, en misschien zelfs hebben verwoest. Jij kunt door het oog van je ziekte naar je gegarandeerde verblijf in het graf evenals de daarachter schuilende verblijfplaatsen in het hiernamaals kijken en je daaraan aanpassen. Aldus is ziekte voor jou gezond, terwijl gezondheid voor bepaalde leeftijdsgenoten van jou een ziekte is.”
</p>

</div>'
            ],
            [
                'page_number' => 13,
                'content' => '<div class="page" id="13">

<p class="text-end page-number">#13</p>

<p class="text-red small-title text-center">
<strong>De Zesde Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke die om zijn leed klaagt!
</p>

<p>
Ik verzoek jou om terug aan je verleden te denken, en alle gelukkige dagen evenals alle pijnlijke momenten in je leven te herinneren. Je zult dan instinctief ofwel een zucht van opluchting ofwel een zucht van weemoed slaken. Oftewel, je hart of je tong zal ofwel: “<sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span>, <em>Godzijdank</em>.” ofwel <em>“Waar zijn die goede oude tijden gebleven?”</em> zeggen.
</p>

<p>
Let op, wat jou: “<sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span>, <em>Godzijdank</em>” doet laten uiten, zijn de gedachten aan de kwellingen en calamiteiten die jij hebt doorstaan; wanneer jij ze opspit, halen ze een spiritueel genot naar boven waardoor jouw hart dank betuigt. Want de teloorgang van leed baart genot. Kwellingen en calamiteiten laten voor de ziel een genot na; wanneer ze via herdenkingen worden opgespit, dan begint er in de ziel een genot te vloeien vanwaaruit dankbetuiging druppelt.
</p>

<p>
Hetgeen jou: <em>“Wee mij!”</em> doet laten uiten, zijn jouw plezierige en gelukkige momenten van vroeger die na hun vertrek een aanhoudende kwelling in jouw ziel hebben nagelaten; wanneer jij ze herdenkt, dan zal die kwelling opkomen, en smart en verdriet laten stromen.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> De lof zij ALLAH.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 14,
                'content' => '<div class="page" id="14">

<p class="text-end page-number">#14</p>

<p>
Aangezien een ongeoorloofde genieting van een dag soms een jaar lang geestelijk leed teweegbrengt, terwijl een dag durende pijn van een tijdelijke ziekte het geestelijke genot van haar zegen nalaat, waarnaast haar teloorgang het geestelijke genot van verlossing en bevrijding verschaft, behoor jij het resultaat en de achterblijvende zegen van de ziekte waar je nu aan lijdt te gedenken. Zeg: <span class="text-italic">“Ook dit zal voorbijgaan...”</span> en wees niet klagerig maar dankbaar.
</p>

<p class="text-red small-title text-center">
<strong>De Zesde Genezing</strong><sup>1</sup>
</p>

<p class="text-center text-bold" style="max-width: 500px; margin: 0px auto 18px auto;">
O mijn broeder die met aardse geneugten in gedachten onder zijn ziekte lijdt!
</p>

<p>
Als deze wereld aanhoudend was, en de dood niet op ons pad stond, en de winden van scheiding en teloorgang niet waaiden, en de calamiteuze en stormachtige toekomst geen winterse seizoenen onderging, dan zou ik samen met jou om jouw toestand treuren.
</p>

<p>
Echter, aangezien de aarde op een dag: <span class="text-italic">“Inpakken en wegwezen!”</span> zal zeggen, en haar oren voor onze hulpkreten zal sluiten, dienen wij – <span class="text-italic">voordat zij ons de deur wijst</span> – met de aanmaningen van deze ziekten onze liefde voor haar los te laten. Voordat zij ons verlaat, moeten wij in ons hart proberen om haar te verlaten. Waarlijk, een ziekte wijst ons op deze betekenis en zegt:
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> Omdat deze Flits op een spontane wijze bij mij is opgekomen, zijn er op het zesde niveau twee genezingen geschreven. Om deze spontaniteit niet aan te tasten, hebben wij het zo gelaten; hierachter kan een geheim schuilen, aldus hebben wij het niet aangepast.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 15,
                'content' => '<div class="page" id="15">

<p class="text-end page-number">#15</p>

<p class="text-italic">
“Jouw lichaam is niet gemaakt van steen of staal, maar samengesteld uit verscheidene substanties die elk moment in staat zijn om uiteen te vallen. Zie af van hoogmoed, doorzie je onmacht, erken je Eigenaar, wees bewust van je taak en zoek uit waarom jij op aarde bent gekomen.”
</p>

<p>
Zo fluistert zij in het oor van het hart...
</p>

<p>
En aangezien de geneugten en genietingen op aarde niet aanhoudend zijn, en de ongeoorloofde soorten ook nog eens kortstondig, kwellend en zondig zijn, behoor je niet te huilen om zulke geneugten waaraan jij dankzij jouw ziekte bent ontsnapt. Je hoort bij jouw ziekte juist de impliciete Godsdienstigheid en de zegen voor het hiernamaals voor ogen te houden en daaruit genot te halen.
</p>

<p class="text-red small-title text-center">
<strong>De Zevende Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke die het genot van zijn gezondheid heeft verloren!
</p>

<p>
Jouw ziekte doet het genot binnen de Goddelijke gunst van gezondheid niet verliezen, maar juist proeven en toenemen. Immers, als iets blijft aanhouden, zal het zijn effect verliezen. Waarheidsdeskundigen op dit gebied hebben zelfs unaniem het volgende geconcludeerd:
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: -10px auto 5px auto; max-width: 500px;">
اِنَّمَا الْاَشْيَاءُ تُعْرَفُ بِاَضْدَادِهَا
</p>

<p>
Oftewel, <span class="text-italic">“Alles kan dankzij zijn tegenstelling worden onderkend.”</span> <span class="text-bold">Bijvoorbeeld:</span>
</p>

</div>'
            ],
            [
                'page_number' => 16,
                'content' => '<div class="page" id="16">

<p class="text-end page-number">#16</p>

<p class="text-italic">
Zonder donkerte zou lichternis ongekend blijven en geen geneugte verschaffen.
</p>

<p class="text-italic">
Zonder kou zou warmte onbegrepen blijven en geen waardering opwekken.
</p>

<p class="text-italic">
Zonder honger zou voedsel geen voldoening geven.
</p>

<p class="text-italic">
Zonder een brandende maag zou het drinken van water geen genot schenken.
</p>

<p class="text-italic">
Zonder kwalen zou welzijn geen plezier leveren.
</p>

<p class="text-italic">
Zonder ziekten zou gezondheid geen vreugde bezorgen.
</p>

<p>
Aangezien de Alwijze Voortbrenger alle varianten van Zijn weldadigheden wil laten vernemen, alle variëteiten van Zijn gunsten wil laten proeven en de mens te allen tijde tot dankbetuiging wil stimuleren, en aangezien Hij de mens heeft uitgerust met velerlei instrumenten waarmee de eindeloze variaties van gunsten in het universum geproefd en ondervonden kunnen worden, zal Hij uiteraard naast gezondheid en welzijn ook ziekten, kwalen en calamiteiten schenken.
</p>

<p>
Nu vraag ik jou: <em>“Als jij deze ziekte aan je hoofd, aan je hand of aan je maag niet zou hebben, zou jij dan het genot van een gezond hoofd, een gezonde hand of een gezonde maag, en de plezierige Goddelijke Begunstiging daarachter wel kunnen vernemen en daarvoor dank betuigen?”</em>
</p>

<p>
Uiteraard zou jij daar geen dank voor betuigen, je zou er niet eens aan denken; je zou die gezondheid onbewust aan onachtzaamheid en misschien zelfs aan zedeloosheid verdoen.
</p>

</div>'
            ],
            [
                'page_number' => 17,
                'content' => '<div class="page" id="17">

<p class="text-end page-number">#17</p>

<p class="text-red small-title text-center">
<strong>De Achtste Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke die aan zijn hiernamaals denkt!
</p>

<p>
Ziektes wassen als zeep alle vlekken van zonden uit. Volgens authentieke Ehâdîth staat het vast dat dankzij ziektes zonden worden kwijtgescholden. Ook wordt het volgende in een Hadith vermeld:
</p>

<p class="text-italic text-bold">
“Zoals een volwaardige fruitboom zijn gerijpte vruchten laat vallen wanneer hij geschud wordt, laten de rillingen van een gelovige zieke evenzo zijn zonden vallen.”
</p>

<p>
In het eeuwige leven zullen zonden als blijvende ziektes terugkeren, terwijl ze ook in dit aardse leven het hart, het geweten en de ziel met geestelijke ziektes besmetten. Als jij geduldig blijft en niet klaagt, dan zul jij dankzij deze tijdelijke ziekte van vele blijvende ziektes worden gered.
</p>

<p>
Indien jij je niet druk om zonden maakt, niet op de hoogte van het hiernamaals bent of geen kennis over ALLAH beschikt, dan lijd jij aan een dusdanig ernstige ziekte, dat ze deze simpele ziekte van jou een miljoenmaal in de schaduw stelt... huiver voor haar! Immers, je hart, je ziel en je ego hebben een band met alle wezens in de wereld. Door scheiding en teloorgang worden die banden telkens weer verbroken, waardoor jou talloze wonden worden toegebracht. Vooral omdat jij niet op de hoogte van het hiernamaals bent en de dood als een permanente executie waant, beschik jij impliciet over een wereldgroot lichaam dat van top tot teen met diepe wonden is overladen.
</p>

</div>'
            ],
            [
                'page_number' => 18,
                'content' => '<div class="page" id="18">

<p class="text-end page-number">#18</p>

<p>
Voorwaar, allereerst dien jij voor de talloze ziekten van dit grote en met wonden overladen geestelijke lichaam de algenezende triakel des geloofs te zoeken en je geloofsvisie bij te stellen. De kortste weg naar dit medicijn loopt langs deze fysieke ziekte waaraan jij lijdt; ze verscheurt de sluier van onachtzaamheid en toont daaronder het venster van onmacht en zwakte vanwaaruit de Macht en Genade van de Ontzaglijke Almacht kan worden ontwaard.
</p>

<p>
Waarlijk, hij die ALLAH niet kent, heeft een wereld aan onheil boven zijn hoofd hangen. De wereld van degene die ALLAH kent, is met lichternis en geestelijke gelukzaligheid vervuld; afhankelijk van zijn niveau kan hij dit met zijn geloofskracht waarnemen. Onder deze geestelijke gelukzaligheid, genezing en genieting die aan het geloof ontspruiten, smelten en bezwijken de kwellingen van fysieke ziekten.
</p>

<p class="text-red small-title text-center">
<strong>De Negende Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke die zijn Schepper erkent!
</p>

<p>
Het leed, de verschrikking en de angst bij ziektes zijn gebaseerd op het feit dat ze soms in de dood uitmonden. Omdat de dood door een onachtzame blik en haar voorkomen vreselijk overkomt, jagen de ziektes die haar uitnodigen angst en paniek aan.
</p>

</div>'
            ],
            [
                'page_number' => 19,
                'content' => '<div class="page" id="19">

<p class="text-end page-number">#19</p>

<p>
<span class="text-bold">Ten eerste</span> hoor je te weten en er absoluut in te geloven dat het doodsuur is voorbeschikt; het zal niet veranderen. Vaak komen gezonde mensen die aan het ziekbed van ernstige zieken wenen zelf te overlijden, terwijl die ernstige zieken genezing ondervinden en voort blijven leven.
</p>

<p>
<span class="text-bold">Ten tweede</span> is de dood niet zo vreselijk als dat ze overkomt. Dankzij het licht dat de Qur’an heeft geschonken, hebben wij in vele traktaten op een onmiskenbare, ontwijfelbare en onbetwistbare wijze het volgende bewezen... <span class="text-bold">voor gelovigen is de dood:</span>
</p>

<ul style="color: #900004;padding: 0px; margin-left: 16px;">
<li>een ontheffing van de bezwarende levenstaken;</li>

<li>een rust van de scholing en training – <span class="text-italic">oftewel het dienaarschap</span> – gedurende de beproeving op het aardse testterrein;</li>

<li>een middel tot vereniging met geliefden en verwanten waarvan negenennegentig procent naar de andere wereld zijn geëmigreerd;</li>

<li>een middel tot het bereiken van het ware vaderland en de eeuwige gelukzaligheid;</li>

<li>een uitnodiging om van de wereldse gevangenschap naar de paradijselijke tuinen over te stappen;</li>

<li>een overgangsfase waarbij er gewacht wordt op de beloning die de Genadige Schepper bij Zijn Gratie voor de aan Hem gewijde diensten zal schenken.</li>
</ul>

</div>'
            ],
            [
                'page_number' => 20,
                'content' => '<div class="page" id="20">

<p class="text-end page-number">#20</p>

<p>
Aangezien de hoedanigheid van de dood uit een waarachtig oogpunt zodanig is, hoort ze niet met een angstige blik te worden aangekeken; ze hoort veeleer als het beginpunt van Genade en gelukzaligheid te worden beschouwd. En de reden waarom bepaalde wijdelingen van ALLAH de dood vrezen, is niet omdat ze de dood beangstigend vinden. Hun vrees is veeleer gebaseerd op hun wens naar meer weldaden die ze dankzij de voortgang van hun levenstaak kunnen verrichten.
</p>

<p>
Waarlijk, voor gelovigen is de dood een poort tot Genade; voor het dwaalvolk is zij een bodemloze put van eeuwige duisternissen.
</p>

<p class="text-red small-title text-center">
<strong>De Tiende Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke die zich onnodig zorgen maakt!
</p>

<p>
Jij maakt je zorgen over de ernst van jouw ziekte. Je bezorgdheid zal jouw ziekte verzwaren. Als jij jouw ziekte wilt verzachten, probeer je dan geen zorgen te maken. Met andere woorden, denk aan de voordelen, de zegeningen en de kortstondigheid van jouw ziekte, wees niet bezorgd en pak zodoende je ziekte bij de wortel aan.
</p>

<p>
Waarlijk, zorgen maken jouw ziekte dubbel zo erg. Je bezorgdheid over jouw fysieke ziekte besmet jouw hart met een geestelijke ziekte waaraan je fysieke ziekte zich vastklampt en voortwoekert. Als jij je met overgave en tevredenheid bezint op de wijsheid achter jouw ziekte, en zodoende die bezorgdheid wegwerkt, dan leg jij een bijl aan een essentiële wortel van je fysieke ziekte.
</p>

</div>'
            ],
            [
                'page_number' => 21,
                'content' => '<div class="page" id="21">

<p class="text-end page-number">#21</p>

<p>
Hierdoor zal je ziekte verzachten en gedeeltelijk verdwijnen. Als er sprake is van waanideeën, kan bezorgdheid een simpele ziekte soms tienmaal erger maken. Wanneer je stopt met zorgen maken, zal je ziekte voor negentig procent verdwijnen.
</p>

<p>
Naast het feit dat bezorgdheid een ziekte verergert, impliceert ze een kritiek op de Goddelijke Wijsheid, een bezwaar tegen de Goddelijke Genade en een beklag over de Genadige Schepper. Daardoor zal ze een tegenwerkende klap veroorzaken en de ziekte verergeren.
</p>

<p>
Waarlijk, zoals dankbetuiging een gunst doet toenemen, doet beklag ziekten en calamiteiten intensiveren. Daarnaast is bezorgdheid zelf ook een ziekte. Haar genezing schuilt in de bewustwording van de wijsheid achter een ziekte. Aangezien jij de wijsheid en het nut ervan hebt ingezien, wrijf dan die zalf over je zorgen en verlos jezelf. Slaak geen zucht van weemoed, maar een zucht van opluchting; zeg niet: “Wee mij!” maar:
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: -20px auto 15px auto; max-width: 500px;">
اَلْحَمْدُ لِلّٰهِ عَلٰى كُلِّ حَالٍ<sup>1</sup>
</p>

<p class="text-red small-title text-center">
<strong>De Elfde Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke broeder zonder geduld!
</p>

<p>
Jouw ziekte bezorgt jou een momentele kwelling, waarnaast ze jou vanaf haar beginperiode tot nu een geestelijke genieting met haar verstrijking en een zielenvreugde met haar zegening verschaft.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> De lof zij ALLAH voor elke omstandigheid.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 22,
                'content' => '<div class="page" id="22">

<p class="text-end page-number">#22</p>

<p>
Momenteel is jouw ziekte na vandaag, of zelfs na dit moment onbestaand; uiteraard kan er uit iets dat niet bestaat geen kwelling ontstaan. Zonder kwelling kan er evenmin verdriet ontstaan. Omdat jij je verbeelding verkeerd hanteert, verlies jij je geduld.
</p>

<p>
Immers, momenteel is jouw verstreken ziekteperiode met al haar leed fysiek verdwenen; haar zegeningen en het genot achter haar verstrijking zijn achtergebleven. Hoewel dit jou zou moeten bevorderen en verblijden, is het belachelijk om terug aan die periode te denken, jezelf te kwellen en je geduld te verliezen.
</p>

<p>
De aankomende dagen zijn nog niet aangebroken. Vandaag de dag aan die dagen denken en vervolgens om een afwezige dag, een afwezige ziekte en een afwezige kwelling waanideeën krijgen, gekweld worden en ongeduld tonen door aan een drievoudige afwezigheid een kleur van bestaan te geven, is toch wederom niets anders dan belachelijk?
</p>

<p>
Aangezien alle ziekteperiodes vóór dit moment vreugde verschaffen, en aangezien alle periodes ná dit moment afwezig, de daaraan gerelateerde ziekte afwezig en de daaruit ontstaande kwelling afwezig zijn, behoor jij alle geduld dat de Hoogste Gerechtigde jou gegeven heeft niet over zulke afwezigheden uit te strooien; hanteer het voor dit moment, zeg: <span class="text-italic text-bold">“Yâ Saboer! (O Geduldige!)”</span> en blijf volharden.
</p>

</div>'
            ],
            [
                'page_number' => 23,
                'content' => '<div class="page" id="23">

<p class="text-end page-number">#23</p>

<p class="text-red small-title text-center">
<strong>De Twaalfde Genezing</strong>
</p>

<p class="text-center text-bold" style="max-width: 400px;margin: 0 auto 1.1em auto;">
O zieke die treurt omdat zijn ziekte hem van zijn Godsdienstoefeningen en zijn rituele aanroepingen weerhoudt!
</p>

<p>
Weet dat volgens de Ehâdîth het volgende vaststaat:
</p>

<p class="text-italic">
“Een Godvrezende gelovige die door zijn ziekte zijn rituele aanroepingen niet kan verrichten, zal tijdens zijn ziekteperiode de zegeningen daarvan alsnog ontvangen.”
</p>

<p>
Wanneer een ernstige zieke de geboden zoveel mogelijk met geduld en gelatenheid nakomt, dan zal zijn ziekte de overige Soenna-gebeden in een zuivere vorm vervangen.
</p>

<p>
Bovendien doet een ziekte de mens zijn onmacht en zwakheid vernemen. Ze laat hem in de taal van onmacht en het dialect van zwakheid verbaal en non-verbaal een bede verrichten. De Hoogste Gerechtigde heeft de mens een grenzeloze onmacht en een eindeloze zwakheid geschonken, opdat de mens elk moment toevlucht tot het Goddelijke Hof kan nemen, om bijstand kan smeken en beden kan verrichten.
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: -5px auto 15px auto; max-width: 500px;">
قُلْ مَا يَعْبَؤُا بِكُمْ رَبّٖى لَوْلَا دُعَٓاؤُكُمْ
</p>

<p>
Oftewel, <span class="text-bold">“Wat voor waarde hebben jullie zonder jullie beden?”</span> Volgens het geheim in deze Aya zijn innige beden en invocaties de reden waarom de mens geschapen is en waarde bezit.
</p>

</div>'
            ],
            [
                'page_number' => 24,
                'content' => '<div class="page" id="24">

<p class="text-end page-number">#24</p>

<p>
Omdat ziektes daartoe aanleiden, hoort er vanuit dit oogpunt niet geklaagd maar dank aan ALLAH betuigd te worden. En de kraan van beden die de ziekte heeft geopend, hoort niet middels het streven naar gezondheid dichtgedraaid te worden.
</p>

<p class="text-red small-title text-center">
<strong>De Dertiende Genezing</strong>
</p>

<p class="text-center text-bold">
O arme man die zich over zijn ziekte beklaagt!
</p>

<p>
Voor sommigen is een ziekte een waardevolle schat; een uiterst kostbaar Godsgeschenk. Elke zieke behoort zijn ziekte als zodanig te beschouwen.
</p>

<p>
Het doodsuur is onbekend. Om de mens van absolute wanhoop en totale onachtzaamheid te redden, en tussen vrees en hoop te laten zweven, en bij zowel de aarde als het hiernamaals te betrekken, heeft de Hoogste Gerechtigde het doodsuur verborgen gehouden.
</p>

<p>
Aangezien het doodsuur ieder moment kan aanbreken, kan het de mens in onachtzaamheid overvallen en zijn eeuwige leven rampzalig benadelen. Ziektes brengen onachtzaamheid ten einde, het hiernamaals onder ogen en de dood in herinnering, waardoor mensen tot inkeer kunnen komen. Sommigen verwerven dankzij een ziekte zelfs een dusdanige verdienste, dat ze een rang die ze in geen twintig jaar kunnen behalen binnen twintig dagen bekleden.
</p>

<p>
Bijvoorbeeld, eens waren er onder onze vrienden twee jongeren genaamd Sabri uit İlamal en Vezirzâde Mustafa uit İslâmköy – <span class="text-italic">moge ALLAH hen Genadig zijn.</span>
</p>

</div>'
            ],
            [
                'page_number' => 25,
                'content' => '<div class="page" id="25">

<p class="text-end page-number">#25</p>

<p>
Deze twee individuen waren analfabeten. Desondanks zag ik tot mijn grote verbazing dat zij wat betreft loyaliteit en het dienen van het geloof met de aanzienlijkste studenten zij aan zij stonden. Ik had de wijsheid hierachter niet begrepen. Na hun overlijden kwam ik erachter dat beiden aan een ernstige ziekte leden. In tegenstelling tot andere onachtzame jongeren die de Goddelijke geboden verwaarloosden, hadden zij zich dankzij de fatsoenering van hun ziekte met een voorbeeldige Godvrezendheid aan een uiterst waardevolle dienst ten bate van hun hiernamaals gewijd. Inshâ’ALLAH heeft hun tweejarige ziektelast hen een miljoenen jarige gelukzaligheid in het eeuwige leven opgeleverd. Ik realiseer mij nu dat de beden die ik zo nu en dan voor hun welzijn verrichtte ten opzichte van hun aardse leven heilloos waren. Inshâ’ALLAH zullen die beden voor hun welzijn in het hiernamaals worden aanvaard.
</p>

<p>
Voorwaar, naar mijn overtuiging hebben deze twee individuen een winst gelijkwaardig aan de verdiensten van een tienjarig leven in Godvrezendheid opgestreken. Als zij zich – <span class="text-italic">zoals de vele jongeren die zich op hun gezondheid en jeugdigheid berusten</span> – in onachtzaamheid en onzede zouden storten, en als de dood ze zou besluipen en ze precies middenin de vuiligheden van hun zonden zou overrompelen, dan zouden zij van hun graf geen schatkamer van lichternis, maar een nest van slangen en schorpioenen hebben gemaakt.
</p>

</div>'
            ],
            [
                'page_number' => 26,
                'content' => '<div class="page" id="26">

<p class="text-end page-number">#26</p>

<p>
Aangezien er zulke verdiensten in ziekten schuilen, behoren ze niet beklaagd te worden; met gelatenheid, geduld en dankbetuiging behoort alle vertrouwen in de Goddelijke Genade gesteld te worden.
</p>

<p class="text-red small-title text-center">
<strong>De Veertiende Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke die aan blindheid lijdt!
</p>

<p>
Als jij eens wist wat voor een licht en een spiritueel oog er schuilen onder de sluier die over de ogen van een gelovige is gevallen, dan zou jij: <span class="text-italic">“Mijn Genadige Heer zij honderdduizendmaal dank...”</span> zeggen.
</p>

<p>
Ik zal een gebeurtenis aanhalen om deze zalf nader toe te lichten.
</p>

<p>
Süleyman uit Barla – <span class="text-italic">die mij zonder ook maar één maal te krenken acht jaar lang uiterst loyaal ten dienste heeft gestaan</span> – had een tante die op een dag haar gezichtsvermogen had verloren. Deze vrome vrouw die veel te optimistische gedachten over mij koesterde, verraste mij een keer voor de deur van de moskee en zei:
</p>

<p class="text-italic">
“Bid voor het herstel van mijn gezichtsvermogen.”
</p>

<p>
Daarop hanteerde ik de vroomheid van die gezegende en begeesterde vrouw als bemiddeling voor mijn bede en smeekte:
</p>

<p class="text-italic">
“O Heer, uit waardering voor haar vroomheid verzoek ik U om haar ogen te openen!”
</p>

</div>'
            ],
            [
                'page_number' => 27,
                'content' => '<div class="page" id="27">

<p class="text-end page-number">#27</p>

<p>
Twee dagen later kwam er een oogarts uit Burdur en opende haar ogen, waarna haar ogen veertig dagen later weer sloten... Dit had mij enorm bedroefd. Ik had veel voor haar gebeden. Inshâ’ALLAH zullen mijn beden ten gunste van haar hiernamaals worden aanvaard. Anders zouden die beden van mij zeer misplaatst zijn. Want haar doodsuur zou veertig dagen later aanbreken; veertig dagen later is zij gestorven – <span class="text-italic">moge ALLAH haar Genadig zijn.</span>
</p>

<p>
Voorwaar, in plaats van veertig dagen met haar gevoelige en bejaarde ogen naar de bedroevende tuinen van Barla te kijken, mag die overleden vrouw in haar graf veertigduizend dagen de tuinen van het paradijs bezichtigen. Immers, haar geloof was sterk; haar vroomheid was intens.
</p>

<p>
Waarlijk, als er een sluier over de ogen van een gelovige neerkomt en hij met gesloten ogen het graf ingaat, dan kan hij conform zijn niveau de wereld van lichternis veel scherper dan de overige grafbewoners zien. Zoals wij op deze wereld veel kunnen zien wat voor blinde gelovigen onzichtbaar is, kunnen blinden – <span class="text-italic">mits zij gelovig zijn heengegaan</span> – in dezelfde verhouding meer dan de grafbewoners zien. Zoals observeerders die door de telescopen met de sterkste zoomlenzen kijken, kunnen zij in het graf – <span class="text-italic">conform hun niveau</span> – de paradijselijke tuinen zien en bezichtigen.
</p>

</div>'
            ],
            [
                'page_number' => 28,
                'content' => '<div class="page" id="28">

<p class="text-end page-number">#28</p>

<p>
Voorwaar, dit lumineuze oog waarmee je vanonder de grond het paradijs boven de hemelen kunt zien en bezichtigen, kun jij onder de sluier van je toegedekte ogen via dank en geduld aantreffen.
</p>

<p>
Voorwaar, de oogspecialist die de sluier van je ogen zal verwijderen en jou door dat lumineuze oog zal laten kijken, is de Leerrijke Qur’an.
</p>

<p class="text-red small-title text-center">
<strong>De Vijftiende Genezing</strong>
</p>

<p class="text-center text-bold">
O jammerende zieke!
</p>

<p>
Jammer niet om het voorkomen van je ziekte, maar kijk naar haar betekenis en wees gerust. Als de betekenis achter het ziek-zijn niet mooi zou zijn, dan zou de Genadige Schepper Zijn geliefdste dienaren geen ziektes geven. In authentieke Ehâdîth is het volgende overgeleverd:
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: 0px auto 10px auto; max-width: 500px;">
اَشَدُّ النَّاسِ بَلَاءً الْاَنْبِيَاءُ ثُمَّ الْاَوْلِيَاءُ ثُمَّ الْاَمْثَلُ فَالْاَمْثَلُ
<span style="font-size: 23px;"> اَوْ كَمَا قَالَ</span>

</p>

<p>
Oftewel, <span class="text-italic text-bold">“Degenen die de meeste calamiteiten en moeilijkheden meemaken, zijn de beste en volmaaktste mensen.” </span><span class="honorific" dir="rtl" lang="ar">عليه السلام</span> voorop, hebben de Godsgezanten, de heiligen en de vromen de ziektes waaraan zij leden als een zuivere Godsdienstoefening en als een geschenk van de Barmhartige beschouwd. Zij betuigden geduldig dank en zagen hun ziekte als een chirurgische operatie die bij de Gratie van de Genadige Schepper werd uitgevoerd.
</p>

</div>'
            ],
            [
                'page_number' => 29,
                'content' => '<div class="page" id="29">

<p class="text-end page-number">#29</p>

<p>
O jammerende zieke! Indien jij tot deze lumineuze groep wil toetreden, blijf dan geduldig dank betuigen. Anders, als jij gaat klagen, dan zullen zij jou niet in hun groep accepteren. Jij zult dan in de kloven van de dwaalgeesten belanden en een duister pad bewandelen.
</p>

<p>
Waarlijk, er zijn bepaalde ziektes die een geestelijke rang gelijkwaardig aan de heiligheid van martelaarschap verschaffen wanneer ze in de dood resulteren.
</p>

<p>
Bijvoorbeeld, iemand die door een kraamziekte<sup>1</sup>, een maagaandoening, verdrinking, verbranding of pestilentie komt te overlijden, zal een geestelijke martelaar worden. Evenzo zijn er vele gezegende ziektes die middels de dood de rang van heiligheid verschaffen.
</p>

<p class="text-bold">
En omdat een ziekte de liefde en interesse voor de wereld inperkt, maakt ze de permanente scheiding met de wereld – <span class="text-italic">wat voor het aardsgezinde volk vreselijk zwaar en bitter is</span> – verdraagzaam en misschien zelfs geliefd.
</p>

<p class="text-red small-title text-center">
<strong>De Zestiende Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke die zich over de beproeving van zijn ziekte beklaagt!
</p>

<p>
Ziektes brengen eerbied en mededogen bij, wat voor het menselijke gemeenschapsleven essentieel en hoogst wenselijk is.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> De tijd waarin deze ziekte de rang van een geestelijke martelaar verschaft, is de kraamtijd van circa veertig dagen.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 30,
                'content' => '<div class="page" id="30">

<p class="text-end page-number">#30</p>

<p>
Want ziektes redden de mens van een zelfgenoegzaamheid waarbij vervreemding en hardvochtigheid worden aangewakkerd. Immers, volgens het geheim achter: <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">اِنَّ الْاِنْسَانَ لَيَطْغٰى ۞ اَنْ رَاٰهُ اسْتَغْنٰى</span> zal het kwaadgezinde ego dat door zijn gezondheid en welzijn in een staat van zelfgenoegzaamheid verkeert, voor vele eerbiedwaardige broederschappen geen eerbied koesteren. En voor medelijdenswaardige slachtoffers van calamiteiten en zieken zal hij geen mededogen voelen.
</p>

<p>
Pas op het moment dat hij ziek wordt, zal hij bij die ziekte zijn onmacht en behoeftigheid vernemen, en zijn eerbiedwaardige broeders waarderen. Jegens zijn gelovige broeders die hem komen bezoeken of bijstaan, zal er een gevoel van eerbied bij hem opkomen. En op basis van medemenselijkheid zullen er gevoelens van mededogen voor mensen en medelijden voor slachtoffers van calamiteiten – <span class="text-italic">wat een essentiële Islamitische eigenschap is</span> – in hem ontwaken. Hij zal zichzelf in hun schoenen plaatsen, volwaardige medelijden voor ze koesteren, meedogend voor ze zijn en als hij bij machte is, zal hij ze bijstaan. Hij zal op zijn minst beden voor ze verrichten, of ze volgens de Shariaanse Soenna een bezoek brengen om te vragen hoe het met ze gaat. Zodoende zal hij zegeningen verwerven.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> Voorzeker, de mens overschrijdt zijn grenzen; daar hij zich zelfgenoegzaam waant. - <em>de Heilige Qur’an, 96:6-7</em>
</p>

</div>

</div>'
            ],
            [
                'page_number' => 31,
                'content' => '<div class="page" id="31">

<p class="text-end page-number">#31</p>

<p class="text-red small-title text-center">
<strong>De Zeventiende Genezing</strong>
</p>

<p class="text-center text-bold" style="max-width: 400px;margin: 0 auto 1.1em auto;">
O zieke die klaagt omdat hij door toedoen van zijn ziekte geen weldaden kan verrichten!
</p>

<p>
Betuig dank... de poort tot de zuiverste weldaden wordt dankzij jouw ziekte geopend. Ziektes doen zieken evenals ziekenverzorgers die omwille van ALLAH dienst leveren aldoor zegeningen verschaffen, waarnaast ze als één van de invloedrijkste middelen ter verhoring van een bede dienen.
</p>

<p>
Waarlijk, het verzorgen van zieken levert gelovigen aanzienlijke zegeningen op. Zieken aandacht schenken en een bezoek brengen zonder ze tot last te zijn, vallen onder daden die tot de achtenswaardige Soenna behoren en in de vergeving van zonden resulteren. In een Hadith is het volgende overgeleverd:
</p>

<p class="text-italic text-bold">
“Vraag de zieken om voor jullie te bidden; hun beden worden verhoord.”
</p>

<p>
Vooral als een familielid – <span class="text-italic">en in het bijzonder een vader of moeder</span> – ziek is, dan geldt het verzorgen van de zieke als een aanzienlijke Godsdienstoefening evenals een zegenrijke weldaad. Het hart van zieken verblijden en geruststellen, wordt als een waardevolle aalmoes gerekend.
</p>

<p class="text-center text-italic text-bold">
Gelukzalig zij het kind dat het gevoelige hart van zijn vader en moeder tijdens hun ziektedagen geruststelt en hun heilbeden ontvangt.
</p>

</div>'
            ],
            [
                'page_number' => 32,
                'content' => '<div class="page" id="32">

<p class="text-end page-number">#32</p>

<p>
Waarlijk, één van de achtenswaardigste waarheden in het gemeenschapsleven wordt gevisualiseerd door het voorbeeldige kind dat zijn vader en moeder als tegenprestatie voor hun mededogen tijdens hun ziektedagen met een volmaakte eerbied en meedogendheid verzorgt. Tegenover dit tableau van trouwheid waarop de verhevenheid van de mens wordt weergegeven, brengen zelfs de engelen de woorden <span class="text-italic">“Mâshâ’ALLAH, BârakALLAH!”</span> met een ovatie tot uiting.
</p>

<p>
Waarlijk, manifestaties van mededogen, medelijden en erbarmen die zich tijdens ziekteperiodes rondom de zieke voordoen, kunnen fraaie en verademende genietingen verwekken die de kwelling van de ziekte doen laten vergeten. Het feit dat de beden van zieken invloedrijk zijn, is een bijzonder belangrijke aangelegenheid. Ik heb dertig à veertig jaar lang gebeden voor de genezing van een krampziekte waaraan ik leed. Ten slotte doorzag ik dat ziektes ten behoeve van beden worden gegeven. Omdat een bede niet wordt verricht om haarzelf op te heffen, heb ik begrepen dat de vrucht van een bede op het hiernamaals is gericht<sup>1</sup>; ze is een Godsdienstoefening waarbij een ziekte aan haar drager zijn onmacht herinnert, opdat hij toevlucht tot Gods Hof neemt.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> Waarlijk, dankzij bepaalde ziektes bestaan bepaalde beden. Als die beden er vervolgens toe leiden dat zulke ziektes verdwijnen, dan wordt de existentie van een bede de oorzaak van haar eigen vernietiging, wat dus niet kan.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 33,
                'content' => '<div class="page" id="33">

<p class="text-end page-number">#33</p>

<p>
Ondanks dat mijn beden voor mijn genezing ogenschijnlijk dertig jaar lang niet zijn verhoord, is het hierdoor nooit in mijn hart opgekomen om een einde aan mijn beden te brengen. Ziekte geeft slechts de tijd voor de bede aan; genezing is niet haar vrucht. Wanneer de Hoogst Genadige Alwijze genezing schenkt, dan schenkt Hij haar bij Zijn Gratie. En wanneer een bede niet naar onze wens wordt verhoord, kan er niet gezegd worden dat ze niet is verhoord. De Alwijze Schepper weet wat beter voor ons is; wat heilzamer voor ons is, zal Hij schenken. Soms verhoort Hij onze wereldse beden door ze voor ons bestwil tot ons hiernamaals te wenden. Maar goed... beden die dankzij het geheim achter ziektes zuiverheid verwerven, en vooral in een staat van onmacht, nederigheid en behoeftigheid worden verricht, hebben een hele hoge kans om verhoord te worden. Ziektes vormen de bron van zulke zuivere beden. Zowel de religieuze zieke als de gelovige ziekenverzorger dient zijn voordeel uit deze beden te halen.
</p>

<p class="text-red small-title text-center">
<strong>De Achttiende Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke die van dank tot klagen vervalt!
</p>

<p>
Klachten moeten op een recht berusten. Jou is geen recht ontnomen waarop jij je beklag zou kunnen baseren. Jij hebt veeleer vele dankbaarheidsplichten die op jou rusten nagelaten. Hoewel jij het recht van de Hoogste Gerechtigde niet eerbiedigt, beklaag jij je onterecht over iets waar jij geen recht op hebt.
</p>

</div>'
            ],
            [
                'page_number' => 34,
                'content' => '<div class="page" id="34">

<p class="text-end page-number">#34</p>

<p>
Jij mag niet kijken naar degenen die zich op een hoger gezondheidsniveau dan jij begeven en op basis daarvan klagen. Jij bent veeleer verplicht om te kijken naar de arme zieken die zich op een lager gezondheidsniveau dan jij begeven en dank te betuigen. Als jouw hand gebroken is, kijk dan naar degenen die hun hand hebben verloren. Als jij één oog hebt verloren, kijk dan naar de blinden die beide ogen hebben verloren en wees ALLAH dankbaar.
</p>

<p>
Waarlijk, bij gunsten heeft niemand het recht om naar mensen die het beter hebben te kijken en op basis daarvan beginnen te klagen. En bij calamiteiten is het eenieders recht om naar mensen die het slechter hebben te kijken, opdat hij dankbaar kan zijn. Dit geheim is in een aantal traktaten met een voorbeeld verklaard. De samenvatting ervan luidt als volgt:
</p>

<p>
Een vorst laat een arme man een minaret beklimmen. Op elke trede geeft hij de man een unieke gift; een speciaal geschenk. Wanneer de man uiteindelijk de top bereikt, krijgt hij het allergrootste geschenk aangereikt.
</p>

<p>
Hoewel er tegenover al die verscheidene geschenken dankbaarheid en erkentelijkheid van die man wordt verwacht, vergeet of onderwaardeert die akelige man alle geschenken die hij op elke trede heeft ontvangen. Hij betuigt geen dank en kijkt omhoog, zeggende:
</p>

</div>'
            ],
            [
                'page_number' => 35,
                'content' => '<div class="page" id="35">

<p class="text-end page-number">#35</p>

<p class="text-italic">
“Was deze minaret maar hoger, dan kon ik nog hoger komen... waarom is deze minaret niet zo hoog als de berg tegenover mij, of als de andere minaret daarginder?!”
</p>

<p>
Zodoende begint hij te klagen. Je kunt wel nagaan hoe ondankbaar en hoe onrechtvaardig deze man is.
</p>

<p>
Evenzo is de mens vanuit het onbestaan tot het bestaan getreden; hij is niet als steen of boom geschapen, noch is hij dier gebleven... hij is mens geworden en als moslim heeft hij veel gezondheid en welzijn ondervonden; hij is met een hoog begunstigde positie geëerd. Als hij desondanks door bepaalde tegenslagen zijn gezondheid, zijn welzijn of andere gunsten die hij niet verdient door zijn verkeerde keuzes of door wangebruik uit zijn handen heeft laten glippen of niet heeft kunnen bereiken, en vervolgens begint te klagen en ongeduld begint te tonen, zeggende: <span class="text-italic">“Waaraan heb ik dit verdiend!?”</span>, en zodoende met zijn houding de Goddelijke Heerschappij begint te bekritiseren, dan lijdt hij aan een geestelijke ziekte die veel kwaadaardiger dan een fysieke ziekte is. Zoals iemand die met een gebroken hand vecht, verergert hij slechts zijn ziekte met zijn beklag.
</p>

<p>
Hij die verstandig is, zal volgens het geheim achter: <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">لِكُلِّ مُصٖيبَةٍ اِنَّا لِلّٰهِ وَاِنَّٓا اِلَيْهِ رَاجِعُونَ</span> gelaten en geduldig blijven; totdat die ziekte waaraan hij lijdt haar taak heeft volbracht en vertrekt.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Voor elke calamiteit geldt: voorzeker... wij komen van ALLAH, en voorzeker... tot Hem zullen wij wederkeren.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 36,
                'content' => '<div class="page" id="36">

<p class="text-end page-number">#36</p>

<p class="text-red small-title text-center">
<strong>De Negentiende Genezing</strong>
</p>

<p>
Zoals de Onafhankelijke met de term: <span class="text-bold">“Esmâ El-husnâ”</span> aangeeft, zijn alle Namen van de Schone Ontzaglijke mooi. En in het bestaan is de allersubtielste, de allermooiste en de alleromvattendste spiegel van de Onafhankelijke: het leven. Een weerspiegeling van mooiheid is mooi. Een spiegel die de schoonheden van een mooiheid weergeeft, zal mooiheid ondervinden. Zoals alles wat die spiegel door die mooiheid overkomt mooi is, is alles wat het leven overkomt vanuit een waarachtig perspectief ook mooi. Het geeft immers de mooie weefsels van de <span class="text-bold">Schone Namen</span> weer.
</p>

<p>
Als het leven steeds gezond en welvarend monotoon verloopt, dan zal het een gebrekkige spiegel worden. Tevens zal het een vorm van nietigheid, non-existentie en onbeduidendheid laten voelen, verveling veroorzaken, de levenswaarde laten dalen en de genietingen op de levensweg in ellende omzetten. Uit verveling zal een mens zich dan ofwel in onzedelijkheden ofwel in amusementen storten om tijd te verdrijven. Alsof hij zijn tijd in gevangenschap doorbrengt, zal hij zich jegens zijn waardevolle leven vijandig opstellen en het snel willen doorbrengen door tijd te doden.
</p>

<p>
Echter, een leven dat afwisselend en beweeglijk in allerlei omstandigheden voortwentelt, doet zijn waarde vernemen, en het belang en de vreugde des levens beseffen. Al zou het bezwarend en rampzalig verlopen, alsnog zou een mens niet willen dat het voorbijgaat.
</p>

</div>'
            ],
            [
                'page_number' => 37,
                'content' => '<div class="page" id="37">

<p class="text-end page-number">#37</p>

<p>
Gedachten als: <span class="text-italic">“De zon gaat maar niet onder.”</span> of <span class="text-italic">“De nacht loopt maar niet ten einde.”</span> zullen niet in hem opkomen, noch zal hij uit verveling jammerend klagen.
</p>

<p>
Waarlijk, vraag aan een rijkaard die niet hoeft te werken en een luxeleven leidt hoe het met hem gaat. Je zult ongetwijfeld bittere reacties krijgen in de trant van: <span class="text-italic">“De tijd gaat maar niet voorbij; kom, laten we dobbelen.”</span> of <span class="text-italic">“Laten we wat leuks vinden om de tijd te doden.”</span> Of vanwege zijn aardse langetermijndoelen, zul je klachten vernemen als: <span class="text-italic">“Dit ontbreekt nog; kon ik mij ook maar in deze zaak mengen.”</span>
</p>

<p>
Vraag aan een slachtoffer van een calamiteit, of aan een arbeider, of aan een arme die het moeilijk heeft hoe het met hem gaat. Als hij bij verstande is, zal hij zich als volgt uitlaten:
</p>

<p class="text-center text-italic">
“Mijn Heer zij dank, het gaat goed; ik werk. Als de zon niet zo snel onderging, had ik meer werk kunnen verrichten. De tijd vliegt voorbij; het leven houdt niet aan, het verstrijkt. Al ervaar ik moeite, ook dit zal zoals alles snel voorbijgaan.”
</p>

<p>
Door aan te geven dat het snelle tijdsverloop hem bedroeft, geeft hij indirect aan hoe waardevol het leven is. Aldus ziet hij dankzij moeite en inspanning de vreugde en de waarde van het leven in. Rust en gezondheid daarentegen verzuren het leven en doen wensen dat het snel verstrijkt.
</p>

</div>'
            ],
            [
                'page_number' => 38,
                'content' => '<div class="page" id="38">

<p class="text-end page-number">#38</p>

<p>
<span class="text-bold">O zieke broeder!</span> Zoals in andere traktaten op een gedetailleerde wijze deugdelijk is bewezen, behoor jij te weten dat de essentie en het basiselement van calamiteiten, onheilzaamheden en zonden uit non-existentie bestaan. En non-existentie impliceert onheil; ze is donker. Omdat monotone gesteldheden zoals rust, stilstand, nietsdoenerij en passiviteit grenzen aan het onbestaan, doen ze de donkerte van non-existentie vernemen en veroorzaken ze onrust. Beweging en afwisseling daarentegen zijn existent en doen existentie vernemen. En existentie impliceert pure heil; ze is lumineus.
</p>

<p>
Om jouw waardevolle leven te zuiveren, te versterken en te bevorderen, om jouw overige menselijke instrumenten hulpvaardig tot jouw zieke orgaan te wenden, om verscheidene weefsels van de Namen der Alwijze Kunstenaar te tonen, en om vele dergelijke taken te vervullen, is jouw ziekte naar jouw lichaam te gast gezonden. Inshâ’ALLAH zal ze haar taak spoedig volbrengen en vertrekken. En tegen welvarendheid zal ze zeggen: <span class="text-italic">“Kom, vervang mijn plek voorgoed en vervul je taak. Dit is jouw huis, verblijf er met voorspoed.”</span>
</p>

<p class="text-red small-title text-center">
<strong>De Twintigste Genezing</strong>
</p>

<p class="text-center text-bold" style="max-width: 350px;margin: 0 auto 1.1em auto;">
O zieke die een geneesmiddel voor zijn aandoening zoekt!
</p>

<p>
Ziektes worden in twee categorieën verdeeld. De ene is de waarachtige categorie, de andere is de ingebeelde categorie.
</p>

</div>'
            ],
            [
                'page_number' => 39,
                'content' => '<div class="page" id="39">

<p class="text-end page-number">#39</p>

<p>
Bij de waarachtige categorie heeft de Ontzaglijke Alwijze Genezer in Zijn grandioze apotheek van de aardbol voor elke aandoening een genezing opgeslagen. Die genezingen vergen aandoeningen. Hij heeft voor elke aandoening een geneesmiddel geschapen. Voor behandeling is het geoorloofd om medicijnen te halen en in te nemen; het effect en de genezing dient echter aan de Hoogste Gerechtigde te worden toegekend. Zoals Hij Degene is Die de aandoening geeft, is ook Hij Degene Die genezing schenkt.
</p>

<p>
Het opvolgen van medische adviezen die van een religieuze arts afkomen, is een belangrijk medicament. Want de meeste ziektes komen voort uit wanpraktijken, slechte voedingspatronen, overdadige handelingen, vergissingen, onzedelijkheden en onoplettendheden. Een religieuze arts zal uiteraard binnen geoorloofde grenzen raad en advies geven. Hij zal wangebruik en overdaad afraden en troost bieden. Door die raad en die troost ter harte te nemen, zal de ziekte van de zieke verzachten, en in plaats van onrust een verademing verschaffen.
</p>

<p>
Bij de categorie van ingebeelde ziektes daarentegen schuilt genezing in haar verwaarlozing. Naarmate er waarde aan haar wordt gehecht, zal ze groeien en opzwellen. Als er geen waarde aan haar wordt gehecht, zal ze inkrimpen en wegvallen. Zoals bijen zal ze om je hoofd rondzwermen zolang jij je bezig met haar houdt, terwijl ze vervliegt als je haar negeert.
</p>

</div>'
            ],
            [
                'page_number' => 40,
                'content' => '<div class="page" id="40">

<p class="text-end page-number">#40</p>

<p>
Een glimp van een zwaaiend touw in het donker kan in de verbeelding verergeren naarmate er waarde aan wordt gehecht en je zelfs tot het punt brengen waarop je als een gek begint te vluchten. Als je er geen waarde aan hecht, zul je opmerken dat dat simpele touw geen slang is, waarop je om de misplaatste paniek in je hoofd zal lachen. Als deze ingebeelde ziekte een geruime poos aanhoudt, dan zal ze een ware ziekte worden. Bij waanzieke en prikkelbare mensen is dit een kwaadaardige ziekte. Zij hebben de gewoonte om van een mug een olifant te maken, waardoor hun geestelijke kracht verloren gaat. Als ze ook nog eens in de handen van genadeloze pseudoartsen of gewetenloze doktoren vallen, dan zullen hun waanvoorstellingen alleen maar intensiveren. Als ze rijk zijn, zullen ze hun eigendom verliezen; anders zullen ze ofwel hun verstand ofwel hun gezondheid verliezen.
</p>

<p class="text-red small-title text-center">
<strong>De Eenentwintigste Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke broeder!
</p>

<p>
Jouw ziekte bevat een fysieke kwelling. Echter, een waardevolle geestelijke genieting die het effect van die fysieke kwelling tenietdoet, heeft jou omgeven. Immers, als jij een vader, een moeder en verwanten hebt, dan zullen hun uiterst bevallige barmhartigheden die jij vergeten was weer rondom jou ontwaken, waardoor jij hun gemoedelijke blikken die je als laatst in je kinderjaren had gezien weer zult aanschouwen.
</p>

</div>'
            ],
            [
                'page_number' => 41,
                'content' => '<div class="page" id="41">

<p class="text-end page-number">#41</p>

<p>
Daarnaast zullen vele verborgen vrienden in jouw omgeving waarmee je vriendschap versluierd is geraakt door de aantrekkingskracht van jouw ziekte weer een liefdevol contact met jou krijgen, waartegenover deze fysieke kwelling van jou uiteraard een kleine prijs is.
</p>

<p>
En de individuen voor wie jij trots dienst hebt verricht en voor wier waardering jij je hebt ingezet, stellen zich nu door de toestand van jouw ziekte meedogend en dienstbaar voor jou op, wat jou in principe meerdere van jouw meerderen heeft gemaakt. En omdat jij de medemenselijkheid en de meedogendheid van mensen aantrekt, heb jij uit het niets vele behulpzame broeders en meedogende vrienden ontmoet.
</p>

<p>
En ten opzichte van vele vermoeiende diensten heb jij van je ziekte een rustsignaal gekregen; je bent aan het rusten... uiteraard behoort jouw beperkte kwelling tegenover deze geestelijke genietingen niet tot klagen maar tot dankbetuiging aan te sporen.
</p>

<p class="text-red small-title text-center">
<strong>De Tweeëntwintigste Genezing</strong>
</p>


<p class="text-center text-bold">
O broeder die door een zware aandoening als<br>
een beroerte is getroffen!
</p>

<p>
Vooraf wil ik mededelen dat een beroerte bij gelovigen als een zegen wordt geacht. Dit had ik menigmaal van heiligen vernomen, maar ik had het geheim erachter nooit begrepen. Wat betreft een geheim hieromtrent wordt mijn hart het volgende ingegeven:
</p>

</div>'
            ],
            [
                'page_number' => 42,
                'content' => '<div class="page" id="42">

<p class="text-end page-number">#42</p>

<p>
Om de Hoogste Gerechtigde te bereiken, de grote geestelijke gevaren op aarde te omzeilen en de eeuwige gelukzaligheid op te strijken, hebben de wijdelingen van ALLAH <span class="text-bold">twee grondbeginselen</span> vrijwillig gevolgd.
</p>

<p>
<span class="text-bold">Het eerste</span> is de doodsgedachte. Dat wil zeggen, denken aan de vergankelijkheid van de wereld waarin zijzelf een vergankelijke en taak-georiënteerde gast zijn. Met die gedachte hebben zij zich voor het eeuwige leven ingezet.
</p>

<p>
<span class="text-bold">Het tweede</span> is het ijveren om het kwaadgezinde ego via onthechting en ascese te doden om van de gevaren van het kwaadgezinde ego en de blinde emoties gered te worden.
</p>

<p class="text-bold">
O broeder die de helft van zijn fysieke gezondheid heeft verloren!
</p>

<p>
Mensen als jij hebben onvrijwillig twee snelle en eenvoudige richtlijnen die tot gelukzaligheid leiden aangereikt gekregen. De staat van jouw lichaam doet jou immers telkens aan de teloorgang van de aarde en de vergankelijkheid van de mens herinneren. Dientengevolge kan de wereld jou niet verstikken, noch kan onachtzaamheid jouw ogen verblinden. Bovendien kan het kwaadgezinde ego een individu dat nagenoeg halfmens is uiteraard niet middels onterende begeerten en egoïstische lusten misleiden. Zodoende kan hij zich snel van het ego’s kwaad bevrijden.
</p>

</div>'
            ],
        ];
    }
}

