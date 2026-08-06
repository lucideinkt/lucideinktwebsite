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
            [
                'page_number' => 43,
                'content' => '<div class="page" id="43">

<p class="text-end page-number">#43</p>

<p>
Voorwaar, een gelovige kan dankzij het geloofsgeheim, middels overgave en gelatenheid, uit een zware aandoening zoals een beroerte in een korte periode zoveel profijt als de ascese van heiligen halen. In dit geval is die zware aandoening maar een kleine prijs.
</p>

<p class="text-red small-title text-center">
<strong>De Drieëntwintigste Genezing</strong>
</p>

<p class="text-center text-bold">
O arme, eenzame, in de steek gelaten zieke!
</p>

<p>
Als jouw ziekte, met daarenboven jouw verlatenheid en vervreemding, zelfs bij de verhardste harten medeleven voor jou opwekt en hun meedogende blik aantrekt, wat zal het dan doen met jouw Genadige Schepper, Die Zichzelf aan het begin van alle Soera’s in de Qur’an met de Eigenschappen: <span class="text-bold">“de Barmhartige, de Genadige”</span> voorstelt, en Wiens ene Flits van Mededogen alle baby’s middels het voortreffelijke mededogen van hun moeders opvoedt, en Wiens ene glimp van Genade elke lente het aardoppervlak met gunsten overlaadt, en Wiens ene glimp van Genade voor het eeuwige leven het paradijs met al zijn pracht tot stand brengt?
</p>

<p>
Als jij je met geloof aan Hem bindt, Hem erkent en in de machteloze taal van jouw ziekte tot Hem smeekt, dan zal jouw zieke, vervreemde en verlaten staat uiteraard Zijn alles overschitterende Blik van Genade aantrekken. Aangezien Hij bestaat en jou ziet, bestaat alles voor jou.
</p>

</div>'
            ],
            [
                'page_number' => 44,
                'content' => '<div class="page" id="44">

<p class="text-end page-number">#44</p>

<p>
Degene die zich in ware vervreemding en verlatenheid begeeft, is degene die zich niet met geloof en overgave aan Hem bindt, of geen waarde aan een band met Hem hecht.
</p>

<p class="text-red small-title text-center">
<strong>De Vierentwintigste Genezing</strong>
</p>

<p class="text-center text-bold" style="max-width: 500px;margin: 0 auto 1.1em auto;">
O verzorgers die zorg dragen voor onschuldige zieke
kinderen en ouderen die kinds zijn geworden!
</p>

<p>
Ten aanzien van het hiernamaals is er een aanzienlijke handel voor jullie weggelegd. Met passie en ijver kunnen jullie die handel winstgevend maken.
</p>

<p>
Ziektes bij onschuldige kinderen zijn als een training voor hun fragiele lichamen, een disciplinering, een vaccinatie tegen toekomstige aardse kwalen en een opvoeding des Heren. Zo zijn er nog vele wijsheden die ziektes voor het aardse leven van een kind met zich meebrengen. En ten aanzien van hun zielenleven dienen ze als een zuivering die – <em>in tegenstelling tot de boetedoening bij volwassenen</em> – als vaccinaties worden toegediend om ze in de toekomst of in het hiernamaals geestelijk te bevorderen. Zoals waarheidsdeskundigen hebben vastgesteld, zullen alle zegeningen die aan zulke ziekten ontspruiten in het dadenschrift van de vader en de moeder, op de pagina van weldaden worden opgenomen – <em>met name van de moeder die volgens het geheim achter mededogen de gezondheid van haar kind boven haar eigen gezondheid verkiest.</em>
</p>

</div>'
            ],
            [
                'page_number' => 45,
                'content' => '<div class="page" id="45">

<p class="text-end page-number">#45</p>

<p>
Wat ouderenzorg betreft, hierin schuilen enorme zegeningen. Daarnaast, wanneer de beden van de ouderen – <em>en vooral van een vader of moeder</em> – worden verworven, wanneer hun harten worden verblijd en wanneer ze erkentelijk worden gediend, dan zal dat volgens de vaststelling van authentieke overleveringen evenals vele historische gebeurtenissen zowel voorspoed op aarde als gelukzaligheid in het hiernamaals opleveren. Een weldadig kind dat zijn oude vader en moeder volwaardig gehoorzaamt, zal van zijn kind hetzelfde ontmoeten. Evenzo zal een ellendig kind dat zijn ouders krenkt – <em>getuige vele voorvallen die dit verifiëren</em> – naast kwelling in het hiernamaals ook op aarde met vele tegenslagen bestraft worden. Waarlijk, aangezien gelovigen volgens het geloofsgeheim een ware broederband met elkaar hebben, behoren zij hun zorg niet slechts tot de ouderen en kinderen van hun eigen familie te beperken. Wanneer een gelovige een noodlijdende oudere of kind aantreft, dan vereist de Islam dat hij met hart en ziel zorg voor hem draagt.
</p>

<p class="text-red small-title text-center">
<strong>De Vijfentwintigste Genezing</strong>
</p>

<p class="text-center text-bold">
O zieke broeders!
</p>

<p>
Indien jullie naar een zeer heilzame, algenezende, waarachtige, zoete en heilige triakel verlangen, laat jullie geloof dan ontplooien. Met andere woorden, met berouw en spijtbetuiging, met salât en dienaarschap, behoren jullie die heilige triakel des geloofs en het medicament ontsproten aan het geloof in te nemen.
</p>

</div>'
            ],
            [
                'page_number' => 46,
                'content' => '<div class="page" id="46">

<p class="text-end page-number">#46</p>

<p>
Waarlijk, ten gevolge van de liefde en interesse voor de wereld bezitten de onachtzame mensen impliciet een wereldgroot lichaam dat ziek is en van top tot teen met wonden is overdekt. Tegenover die wereldgrote tegenslagen van teloorgang en scheiding, levert het geloof een onmiddellijke genezing aan dat zwaar verwonde geestelijke lichaam; het bevrijdt hem van wonden en schenkt ware genezing zoals wij in vele traktaten deugdelijk hebben bewezen. Om jullie hoofdpijn te besparen, zal ik het kort houden…
</p>

<p>
De medicatie des geloofs laat haar werking vooral zien wanneer de geboden in acht worden genomen. Onachtzaamheid, onzede, egoïstische begeerten en zondige amusementen ondermijnen het effect van die triakel. Aangezien ziektes onachtzaamheid verdrijven, begeerten intomen en de weg tot zondige amusementen versperren, behoren jullie profijt uit jullie ziektes te halen. Hanteer de heilige medicaties en lichten van het ware geloof middels berouw en spijtbetuiging, beden en aanroepingen.
</p>

<p class="text-center text-bold" style="max-width: 525px;margin: 0 auto 1.1em auto;">
<em>Moge de Hoogste Gerechtigde jullie genezing schenken
en jullie zondes met jullie ziektes vergelden.</em>
</p>

<p class="text-center text-bold">
<em>Âmîn, âmîn, âmîn!</em>
</p>

</div>'
            ],
            [
                'page_number' => 47,
                'content' => '<div class="page" id="47">

<p class="text-end page-number">#47</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin:0 auto; max-width:500px;">
اَلْحَمْدُ لِلّٰهِ الَّذٖى هَدٰينَا لِهٰذَا وَمَا كُنَّا لِنَهْتَدِىَ لَوْلَٓا اَنْ هَدٰينَا اللّٰهُ لَقَدْ جَٓاءَتْ رُسُلُ رَبِّنَا بِالْحَقِّ
<span class="fn-ref-wrap"><span class="fn-ref-word"></span><button class="fn-ref" type="button" aria-label="Voetnoot 1" data-fn="1" data-html="&lt;p class=&quot;footnote-p fn-popover__para&quot;&gt;“De lof zij ALLAH die ons tot hier heeft geleid. Wij hadden geen leiding zonder de Leiding van ALLAH kunnen vinden. De profeten van onze Heer hebben ons daadwerkelijk de waarheid gebracht.” - &lt;em&gt;De Heilige Qur’an, 7:43&lt;/em&gt;&lt;/p&gt;"><sup>1</sup></button></span>
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin:10px auto 0 auto; max-width:500px;">
سُبْحَانَكَ لَا عِلْمَ لَنَٓا اِلَّا مَا عَلَّمْتَنَٓا اِنَّكَ اَنْتَ الْعَلٖيمُ الْحَكٖيمُ
<span class="fn-ref-wrap"><span class="fn-ref-word"></span><button class="fn-ref" type="button" aria-label="Voetnoot 2" data-fn="2" data-html="&lt;p class=&quot;footnote-p fn-popover__para&quot;&gt;“U bent Feilloos. Buiten hetgeen U ons hebt onderwezen, beschikken wij over geen kennis. Voorzeker, U bent de Alwetende, de Alwijze.” - &lt;em&gt;De Heilige Qur’an, 2:32&lt;/em&gt;&lt;/p&gt;"><sup>2</sup></button></span>
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin:18px auto 0 auto; max-width:500px;">
اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ طِبِّ الْقُلُوبِ وَدَوَائِهَا وَعَافِيَةِ الْاَبْدَانِ وَشِفَائِهَا وَنُورِ الْاَبْصَارِ وَضِيَائِهَا وَعَلٰى اٰلِهٖ وَصَحْبِهٖ وَسَلِّمْ
<span class="fn-ref-wrap"><span class="fn-ref-word"></span><button class="fn-ref" type="button" aria-label="Voetnoot 3" data-fn="3" data-html="&lt;p class=&quot;footnote-p fn-popover__para&quot;&gt;O ALLAH, laat zegeningen neerdalen op Mohammed, alias de heling van onze harten, de gezondheid en de genezing van onze lichamen, het licht en de schittering van onze ogen, evenals op zijn familie en zijn metgezellen.&lt;/p&gt;"><sup>3</sup></button></span>
</p>

<div class="text-center" style="margin-top:40px;">
    <img src="/images/end-ornament.svg" alt="Ornament" style="width:95px;">
</div>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “De lof zij ALLAH die ons tot hier heeft geleid. Wij hadden geen leiding zonder de Leiding van ALLAH kunnen vinden. De profeten van onze Heer hebben ons daadwerkelijk de waarheid gebracht.” - <em>De Heilige Qur’an, 7:43</em>
</p>

<p class="footnote-p">
<sup>2</sup> “U bent Feilloos. Buiten hetgeen U ons hebt onderwezen, beschikken wij over geen kennis. Voorzeker, U bent de Alwetende, de Alwijze.” - <em>De Heilige Qur’an, 2:32</em>
</p>

<p class="footnote-p">
<sup>3</sup> O ALLAH, laat zegeningen neerdalen op Mohammed, alias de heling van onze harten, de gezondheid en de genezing van onze lichamen, het licht en de schittering van onze ogen, evenals op zijn familie en zijn metgezellen.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 47,
                'content' => '<div class="page" id="47">

<p class="text-end page-number">#47</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: 0px auto 0 auto; max-width: 500px;">
اَلْحَمْدُ لِلّٰهِ الَّذٖى هَدٰينَا لِهٰذَا وَمَا كُنَّا لِنَهْتَدِىَ لَوْلَٓا اَنْ هَدٰينَا اللّٰهُ لَقَدْ جَٓاءَتْ رُسُلُ رَبِّنَا بِالْحَقِّ<sup>1</sup>
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: 0px auto 0 auto; max-width: 500px;">
سُبْحَانَكَ لَا عِلْمَ لَنَٓا اِلَّا مَا عَلَّمْتَنَٓا اِنَّكَ اَنْتَ الْعَلٖيمُ الْحَكٖيمُ<sup>2</sup>
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: 0px auto 0 auto; max-width: 500px;">
اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ طِبِّ الْقُلُوبِ وَدَوَائِهَا وَعَافِيَةِ الْاَبْدَانِ وَشِفَائِهَا وَنُورِ الْاَبْصَارِ وَضِيَائِهَا وَعَلٰى اٰلِهٖ وَصَحْبِهٖ وَسَلِّمْ<sup>3</sup>
</p>

<div class="page-footnote">

<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “De lof zij ALLAH die ons tot hier heeft geleid. Wij hadden geen leiding zonder de Leiding van ALLAH kunnen vinden. De profeten van onze Heer hebben ons daadwerkelijk de waarheid gebracht.” - <em>De Heilige Qur’an, 7:43</em>
</p>

<p class="footnote-p">
<sup>2</sup> “U bent Feilloos. Buiten hetgeen U ons hebt onderwezen, beschikken wij over geen kennis. Voorzeker, U bent de Alwetende, de Alwijze.” - <em>De Heilige Qur’an, 2:32</em>
</p>

<p class="footnote-p">
<sup>3</sup> O ALLAH, laat zegeningen neerdalen op Mohammed, alias de heling van onze harten, de gezondheid en de genezing van onze lichamen, het licht en de schittering van onze ogen, evenals op zijn familie en zijn metgezellen.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 48,
                'content' => '<div class="page" id="48">

<p class="text-end page-number">#48</p>

<div class="text-center page-title-chapter delima-font">
    <h2>De Zeventiende Brief</h2>
</div>

<p class="text-center text-italic" style="margin-top: -18px;">
(Een aanvulling op De Vijfentwintigste Flits)
</p>

<p class="text-center text-red text-bold" style="font-size:20px;line-height:1.4;max-width: 400px;margin: 0 auto 1.1em auto;">
EEN CONDOLEANCE IN VERBAND MET HET VERLIES VAN EEN KIND
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin:-18px auto 0 auto; max-width:500px;">
بِاسْمِهٖ سُبْحَانَهُ<sup>1</sup> ۞ وَ اِنْ مِنْ شَىْءٍ اِلَّا يُسَبِّحُ بِحَمْدِهٖ<sup>2</sup>
</p>

<p class="text-center text-bold" style="margin:0 auto 1.1em auto; max-width: 500px;">
Mijn eerbiedwaardige broeder van het hiernamaals Hâfız Hâlid Efendi!
</p>

<p class="text-center text-arabic-bismillah" dir="rtl" lang="ar">
<img src="/images/bismillah .svg" alt="Bismillah" class="bismillah-svg bismillah-svg-light">
<img src="/images/bismillah-dark.svg" alt="Bismillah" class="bismillah-svg bismillah-svg-dark">
<span class="fn-ref-wrap"><span class="fn-ref-word"></span><button class="fn-ref" type="button" aria-label="Voetnoot 3" data-fn="3" data-html="&lt;p class=&quot;footnote-p fn-popover__para&quot;&gt;
 “In de Naam van ALLAH, de Barmhartige, de Genadige.”
&lt;/p&gt;"><sup>3</sup></button></span>
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin:0px auto 0 auto; max-width:400px;">
وَبَشِّرِ الصَّابِرٖينَ ۞ الَّذٖينَ اِذَٓا اَصَابَتْهُمْ مُصٖيبَةٌ قَالُٓوا اِنَّا لِلّٰهِ وَاِنَّٓا اِلَيْهِ رَاجِعُونَ<sup>4</sup>
</p>

<p style="margin-top:18px;">
Mijn broeder, het overlijden van jouw kind heeft mij bedroefd. Echter,
<sup>5</sup><span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحُكْمُ لِلّٰهِ</span>,
tevredenheid over Gods Vonnis en overgave aan het lot behoren tot de herkenningstekenen van de Islam.
</p>

<div class="page-footnote">

<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “In Zijn Naam; Hij is Feilloos.”
</p>

<p class="footnote-p">
<sup>2</sup> “En er is niets, of het prijst Hem met lof.”
</p>

<p class="footnote-p">
<sup>3</sup> “In de Naam van ALLAH, de Barmhartige, de Genadige.”
</p>

<p class="footnote-p">
<sup>4</sup> “Geef blijde tijding aan de geduldigen. Wanneer rampspoed hen treft, zeggen zij: ‘Voorzeker... wij komen van ALLAH, en voorzeker... tot Hem zullen wij wederkeren’.” - <em>de Heilige Qur’an, 2:155-156</em>
</p>

<p class="footnote-p">
<sup>5</sup> “Het oordeel behoort ALLAH toe.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 49,
                'content' => '<div class="page" id="49">

<p class="text-end page-number">#49</p>

<p class="text-italic text-bold">
Moge de Hoogste Gerechtigde jullie een voorbeeldig
geduld schenken... en moge Hij de overledene als jullie
helper en bemiddelaar in het hiernamaals aanstellen.
</p>

<p>
Wij zullen <span class="text-bold">“Vijf Punten”</span> uiteenzetten waarin jou
evenals Godvrezende gelovigen zoals jij een blijde tijding
en een ware troost worden gepresenteerd.
</p>

<p class="text-red small-title text-center">
<strong>Het Eerste Punt</strong>
</p>

<p>
Hierop volgt een geheim en een uitleg van het volgende vers uit de Leerrijke Qur’an:
<sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">وِلْدَانٌ مُخَلَّدُونَ</span>.
De kinderen van gelovigen die voor hun pubertijd komen te overlijden, zullen in het paradijs met een paradijs waardig uiterlijk als schattige kinderen eeuwig blijven voortbestaan. En voor hun vader en moeder die het paradijs intreden, zullen zij op hun schoten eeuwige bronnen van vreugde zijn; zij zullen het ultieme plezier achter het liefkozen en knuffelen van een kind aan hun ouders verschaffen. Elke vorm van genot bevindt zich in het paradijs. Aldus is het volgende standpunt onwaar: <em>“Omdat er in het paradijs geen voortplanting plaatsvindt, zal daar zoiets als het liefkozen en knuffelen van kinderen niet bestaan.”</em>
</p>

<p>
In plaats van op aarde een kind gedurende een korte periode van tien jaar tijdens het grootbrengen te liefkozen en te knuffelen, zullen de gelovigen één van
</p>

<div class="page-footnote">

<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Kinderen die immer jeugdig zullen blijven.” - <em>de Heilige Qur’an, 56:17, 76:19</em>
</p>

</div>

</div>'
            ],
            [
                'page_number' => 50,
                'content' => '<div class="page" id="50">

<p class="text-end page-number">#50</p>

<p>
de grootste bronnen van gelukzaligheid ontmoeten wanneer zij hun kind in de zuiverste vorm ongehinderd voor eeuwig mogen knuffelen en liefkozen. Dit alles wordt dus aangeduid en meegedeeld in de Edele Aya:
<sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">وِلْدَانٌ مُخَلَّدُونَ</span>.
</p>

<p class="text-red small-title text-center">
<strong>Het Tweede Punt</strong>
</p>

<p>
Eens bevond een man zich in de gevangenis. Eén van zijn dierbare kinderen werd naar hem gebracht. Naast zijn eigen leed, ervoer die arme gevangene kwelling door de vergeefse moeite die hij deed om het daar voor zijn kind comfortabel te maken. Vervolgens zond de meedogende heerser één van zijn onderdanen naar hem met de volgende boodschap:
</p>

<p class="text-italic">
“Dit kind is wellicht jouw kind, maar hij behoort tot
mijn burgers en tot mijn volk. Ik ga hem meenemen en in
een mooi paleis grootbrengen.”
</p>

<p>
Daarop begon de gevangene te wenen en te jammeren, zeggende:
</p>

<p class="text-italic">
“Ik wil mijn kind... mijn bron van troost niet afstaan.”
</p>

<p>
Zijn vrienden zeiden toen:
</p>

<p class="text-italic">
“Je verdriet is misplaatst. Als jij daadwerkelijk medelijden met je kind hebt, besef dan dat hij in plaats van deze vieze, muffe en benauwende gevangenis in een verademend paleis van gelukzaligheid gaat verblijven.”
</p>

<div class="page-footnote">

<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Kinderen die immer jeugdig zullen blijven.” - <em>de Heilige Qur’an, 56:17, 76:19</em>
</p>

</div>

</div>'
            ],
            [
                'page_number' => 51,
                'content' => '<div class="page" id="51">

<p class="text-end page-number">#51</p>

<p class="text-italic">
Als jij voor jezelf treurt en je eigen baat beoogt, overweeg dan het volgende: als het kind hier blijft, dan zul jij naast een betwijfelbare baat, veel moeite en kwelling door de lasten van het kind ondervinden. Als het kind naar het paleis gaat, dan zal dat jou duizend baten opleveren. Want daar kan hij het mededogen van de koning op jou richten en als jouw bemiddelaar fungeren. De koning zal jullie uiteindelijk willen reüniëren. Om deze reünie te realiseren, zal de koning uiteraard niet hem naar de gevangenis sturen, maar jou uit de gevangenis halen en naar het paleis laten brengen om jullie te herenigen; onder de voorwaarde dat jij de koning trouw bent en hem gehoorzaamt.”
</p>

<p>
Voorwaar, mijn eerbiedwaardige broeder! Wanneer gelovigen zoals jij hun kind verliezen, dienen zij als volgt te denken:
</p>

<p class="text-italic">
Dit kind is onschuldig, en zijn Schepper is Genadig en Genereus. In plaats van mijn gebrekkige opvoeding en mededogen, heeft het kind Zijn Sublieme Gratie en Genade ontmoet. Hij heeft mijn kind uit de kwellende, ellendige en bezwarende gevangenis van de aarde gehaald en naar Zijn paradijs van Firdaus gezonden. Welzalig zij dat kind! Als hij op deze wereld zou blijven, wie weet wat er dan van hem terecht zou komen? Al bij al heb ik geen medelijden met hem, maar acht ik hem gelukzalig.
</p>

<p class="text-italic">
Als het aankomt op mijn eigen baat, dan heb ik ook geen medelijden met mezelf, noch raak ik overmatig bedroefd.
</p>

</div>'
            ],
            [
                'page_number' => 52,
                'content' => '<div class="page" id="52">

<p class="text-end page-number">#52</p>

<p class="text-italic">
Immers, als hij op aarde zou blijven, dan zou hij tijdelijk een tienjarige kinderliefde vermengd met leed verschaffen. Als hij vroom en met wereldse zaken welvarend zou worden, dan zou hij mij eventueel kunnen bijstaan.
</p>

<p class="text-italic">
Echter, met zijn overlijden dient hij als mijn bemiddelaar voor het bereiken van de eeuwige gelukzaligheid waarbij ik tien miljoen jaar lang kinderliefde in het eeuwige paradijs mag ervaren.
</p>

<p class="text-bold text-italic">
Uiteraard zal iemand die een betwijfelbare, directe baat verliest, maar duizend gegarandeerde en uitgestelde baten aanwint, geen overmatig verdriet tonen en wanhopig weeklagen.
</p>

<p class="text-red small-title text-center">
<strong>Het Derde Punt</strong>
</p>

<p>
Het overleden kind was een schepsel, een dienaar, een onderdaan en in al zijn hoedanigheden een kunstwerk van een Genadige Schepper; dat kind was een gezel van zijn ouders dat Hem toebehoort en Hij had hem tijdelijk onder het toezicht van zijn ouders geplaatst. De vader en moeder had Hij dienstig jegens het kind gesteld. Als directe beloning voor hun ouderlijke diensten had Hij hen een plezierige vorm van mededogen geschonken.
</p>

<p>
Als Die Genadige Schepper, Die uit de duizend aandelen in dat kind negenhonderdnegenennegentig aandelen bezit, op basis van Genade en Wijsheid dat kind uit jouw handen neemt en jou vrij van je dienst stelt, dan siert het een gelovige niet om met zijn ene ogenschijnlijke aandeel tegenover de Eigenlijke Bezitter van alle duizend aandelen op een nagenoeg klagende wijze wanhopig te treuren en te weeklagen; zoiets betaamt de achteloze mensen en de dwaalgeesten.
</p>

</div>'
            ],
            [
                'page_number' => 53,
                'content' => '<div class="page" id="53">

<p class="text-end page-number">#53</p>

<p class="text-red small-title text-center">
<strong>Het Vierde Punt</strong>
</p>

<p>
Als de aarde voor altijd zou aanhouden, als de mens er voorgoed zou verblijven en als scheiding permanent zou zijn, dan zouden een troosteloos verdriet en een wanhopige treurnis enigszins gegrond zijn.
</p>

<p>
Echter, de aarde is een gastenverblijf; zowel jullie als wij zullen vertrekken naar de plaats waarnaar het overleden kind is heengegaan. Tevens is sterven niet alleen voor dat kind bestemd; iedereen zal het meemaken. Bovendien is scheiding niet permanent; in de toekomst zal er zowel in de tussenwereld als in het paradijs een reünie plaatsvinden. Aldus dient men:
<span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحُكْمُ لِلّٰهِ<sup>1</sup></span>
te zeggen... Hij geeft en Hij ontneemt... men dient:
<span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ عَلٰى كُلِّ حَالٍ<sup>2</sup></span>
te zeggen en geduldig dank te betuigen.
</p>

<p class="text-red small-title text-center">
<strong>Het Vijfde Punt</strong>
</p>

<p>
Mededogen – <em>wat zich als één van de fijnste, mooiste, fraaiste en bevalligste weerschijnsels van de Goddelijke Genade manifesteert</em> – is een lumineus elixer. Het is veel doordringender dan verliefdheid en het kan je snel naar de Hoogste Gerechtigde brengen.
</p>

<div class="page-footnote">

<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> Het oordeel behoort ALLAH toe.
</p>

<p class="footnote-p">
<sup>2</sup> De lof zij ALLAH voor elke omstandigheid.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 54,
                'content' => '<div class="page" id="54">

<p class="text-end page-number">#54</p>

<p>
Zoals een valse verliefdheid en een wereldse verliefdheid zeer problematisch in een ware verliefdheid kunnen omslaan en tot de Hoogste Gerechtigde kunnen leiden, kan mededogen evenzo – <em>alleen dan probleemloos</em> – het hart op een veel snellere en zuiverdere wijze aan de Hoogste Gerechtigde binden.
</p>

<p>
Zowel vaders als moeders koesteren een wereldgrote liefde voor hun kind. Wanneer hen hun kind wordt ontnomen, dan zullen de voorspoedige en ware gelovige ouders hun gezicht van de wereld afwenden en zich op de Ware Begunstiger richten, zeggende:
</p>

<p class="text-italic">
“Aangezien de aarde vergankelijk is, is zij een band met het hart onwaardig.”
</p>

<p>
De plaats waar hun kind naartoe is gegaan, zal een interesse bij ze opwekken. Zodoende zullen ze een verheven geestelijke gesteldheid aanwinnen.
</p>

<p>
De onachtzame mensen en de dwaalgeesten krijgen niets van de blijde tijdingen en de gelukzaligheden binnen deze vijf waarheden mee. Met het volgende voorbeeld kunnen jullie afwegen hoe ellendig hun toestand is:
</p>

<p>
Een oude vrouw ziet haar enige dierbare kind zijn laatste doodsstrijd leveren. Omdat ze de aarde oneindig waant, leidt haar onachtzaamheid of dwaling ertoe dat ze de dood als een vernietiging en een eeuwige scheiding ervaart.
</p>

</div>'
            ],
            [
                'page_number' => 55,
                'content' => '<div class="page" id="55">

<p class="text-end page-number">#55</p>

<p>
Ze beeldt zich in hoe haar kind ter vervanging van zijn zachte bed onder de grond van het graf zal liggen, terwijl ze door haar onachtzaamheid of dwaling niet aan de Hemelse Genade en de Paradijselijke Begunstiging van de Genadigste der Genadigen denkt. Je kunt je wel voorstellen wat voor ontroostbare droefenis en kwelling ze zal ondergaan.
</p>

<p>
Echter, het geloof en de Islam waaraan de twee gelukzaligheden in beide oorden ontspruiten, zeggen tegen een gelovige:
</p>

<p>
    <span class="text-italic">
        “De Genadige Schepper van dit stervende kind haalt hem uit deze vergankelijke wereld en neemt hem mee naar Zijn paradijs. Hij zal hem jouw bemiddelaar evenals jouw eeuwige kind maken. Scheiding is tijdelijk; wees gerust, zeg:
    </span>

    <span class="text-arabic-inline" dir="rtl" lang="ar" style="margin-right: 10px;">
        اَلْحُكْمُ لِلّٰهِ<sup>1</sup> ۞ اِنَّا لِلّٰهِ وَاِنَّٓا اِلَيْهِ رَاجِعُونَ<sup>2</sup>
    </span>

    <span class="text-italic">
        en wees geduldig.”
    </span>
</p>

<p class="text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="text-align: right; margin-top: 0;margin-bottom: 0;text-indent: 0">
اَلْبَاقٖى هُوَ الْبَاقٖى<sup>3</sup>
</p>

<p class="text-italic" style="text-align: right">
<em>Said Nursî</em>
</p>

<div class="page-footnote">

<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Het oordeel behoort ALLAH toe.”
</p>

<p class="footnote-p">
<sup>2</sup> “Voorzeker... wij komen van ALLAH, en voorzeker... tot Hem zullen wij wederkeren.” - <em>de Heilige Qur’an, 2:156</em>
</p>

<p class="footnote-p">
<sup>3</sup> “De Eeuwige; Hij is de Eeuwige.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 56,
                'content' => '<div class="page" id="56">

<p class="text-end page-number">#56</p>

<div class="text-center page-title-chapter delima-font">
    <h2>De Tweede Flits</h2>
</div>

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
   style="margin:0px auto 10px auto; max-width:500px;">
اِذْ نَادٰى رَبَّهُٓ اَنّٖى مَسَّنِىَ الضُّرُّ وَاَنْتَ اَرْحَمُ الرَّاحِمٖينَ<sup>2</sup>
</p>

<p>
Deze smeekbede van Eyyoûb <span class="honorific" dir="rtl" lang="ar">عليه السلام</span> alias het toonbeeld van geduld is zowel beproefd als effectief. Echter, op basis van de inspiratie die wij uit deze Aya opdoen, behoren wij onze smeekbede als volgt uit te spreken:
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin:-18px auto 0 auto; max-width:500px;">
رَبِّ اِنّٖى مَسَّنِىَ الضُّرُّ وَاَنْتَ اَرْحَمُ الرَّاحِمٖينَ<sup>3</sup>
</p>

<p>
De samenvatting van het bekende verhaal van Eyyoûb <span class="honorific" dir="rtl" lang="ar">عليه السلام</span> luidt als volgt:
</p>

<p>
Ondanks dat hij een geruime poos met vele vreselijke wonden en zweren doorbracht, hield hij de opzienbarende beloning van zijn ziekte in gedachte en bleef hij met een voorbeeldig geduld volharden. Op den duur ontstonden er maden in zijn wonden die zijn hart en zijn tong begonnen te doordringen.
</p>

<div class="page-footnote">

<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> In de Naam van ALLAH, de Barmhartige, de Genadige.
</p>

<p class="footnote-p">
<sup>2</sup> “Toen hij tot zijn Heer uitriep: ‘Voorzeker, tegenspoed heeft mij getroffen; en U bent de Genadigste der Genadigen’.” - <em>de Heilige Qur’an, 21:83</em>
</p>

<p class="footnote-p">
<sup>3</sup> “O Heer, voorzeker, tegenspoed heeft mij getroffen; en U bent de Genadigste der Genadigen.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 57,
                'content' => '<div class="page" id="57">

<p class="text-end page-number">#57</p>

<p>
Omdat de centra voor Godsverering en Godskennis, oftewel zijn hart en zijn tong, door die maden werden aangetast, vreesde hij dat zijn dienaarschap daaronder zou lijden, waarna hij niet om zijn eigen gemakzucht, maar omwille van zijn Godsdienstigheid uitriep:
<em>“O Heer! Tegenspoed heeft mij getroffen! Ze benadeelt de verering die ik met mijn tong verricht evenals het dienaarschap dat ik met mijn hart betracht.”</em>
</p>

<p>
Zodoende had hij een smeekbede verricht. Bijgevolg had de Hoogste Gerechtigde die zuivere smeekbede – <em>die onverbitterd, puur omwille van ALLAH werd uitgesproken</em> – op een buitengewoon bijzondere wijze verhoord. Hij schonk hem zijn volle gezondheid en liet hem varianten van Zijn Genade ondervinden.
</p>

<p class="text-center text-bold">
Voorwaar, deze “Flits” bevat “Vijf Punten”
</p>

<p class="text-red small-title text-center">
<strong>Het Eerste Punt</strong>
</p>

<p>
In tegenstelling tot de uitwendige zweerziektes van Eyyoûb <span class="honorific" dir="rtl" lang="ar">عليه السلام</span> lijden wij aan ziektes die betrekking op ons innerlijk, onze ziel en ons hart hebben. Als wij binnenstebuiten zouden worden gekeerd, dan zouden wij er vele malen zieker en gewonder dan Eyyoûb <span class="honorific" dir="rtl" lang="ar">عليه السلام</span> uitzien. Want elke zonde die wij bedrijven en elke twijfel die in ons opkomt, slaan wonden in ons hart en in onze ziel.
</p>

<p>
De wonden van Eyyoûb <span class="honorific" dir="rtl" lang="ar">عليه السلام</span> brachten slechts zijn kortstondige leven op aarde in gevaar. Onze geestelijke ziektes brengen ons eeuwigdurende leven in gevaar.
</p>

</div>'
            ],
            [
                'page_number' => 58,
                'content' => '<div class="page" id="58">

<p class="text-end page-number">#58</p>

<p>
Ten opzichte van die eminentie hebben wij duizendmaal meer behoefte aan die Eyyoûbische smeekbede.
</p>

<p>
De maden die uit de wonden van die eminentie voortkwamen, tastten zijn hart en zijn tong aan. Onze zonden slaan ook wonden waaruit influisteringen en twijfels voortkomen die – <em>moge ALLAH ons bijstaan</em> – het centrum van het geloof in de kern van het hart doordringen en het zielsgenot achter geloofsuitingen met de tong aantasten. Zodoende doen ze afkerig afstand van Godsverering nemen.
</p>

<p>
Waarlijk, een zonde tast het hart aan en blijft hem net zo lang verzwarten, totdat ze het geloofslicht volledig uit het hart heeft verdreven. Binnen elke zonde schuilt een weg die tot ongeloof leidt. Als die zonde niet snel door middel van berouw wordt weggewist, dan zal ze niet als een made, maar als een grote geestelijke slang aan het hart knagen.
</p>

<p>
<strong><em>Bijvoorbeeld,</em></strong> wanneer een persoon stiekem een gênante zonde pleegt en zich diep zou schamen als anderen daar getuige van zouden zijn, dan zal het bestaan van engelen en zielen voor hem moeilijk te verdragen zijn. Bijgevolg zal hij bij een kleine aanleiding al de neiging krijgen om ze te verloochenen.
</p>

<p>
<strong><em>Bijvoorbeeld,</em></strong> wanneer een persoon een grote zonde pleegt die in de hellestraf zal uitmonden, maar na het vernemen van waarschuwingen over de hel niet middels spijtbetuiging toevlucht daartegen neemt, dan zal hij met heel zijn ziel wensen dat de hel niet bestaat.
</p>

</div>'
            ],
            [
                'page_number' => 59,
                'content' => '<div class="page" id="59">

<p class="text-end page-number">#59</p>

<p>
Hierdoor zal hij het lef krijgen om bij de geringste aanleiding of twijfel de hel te loochenen.
</p>

<p>
<strong><em>Bijvoorbeeld,</em></strong> wanneer een persoon zijn geboden gebeden niet verricht en zijn Godsdienstplichten niet betracht, hoewel diezelfde persoon al ontmoedigd wordt wanneer een simpele werkgever hem om een simpele nalatigheid lichtelijk berispt, dan zal zijn luiheid tegenover de geboden die door de Onbegonnen en Eeuwige Sultan herhaaldelijk worden bevolen een enorme onrust in hem stoken. Bijgevolg zal hij de volgende wens koesteren en impliciet tot uiting brengen:
</p>

<p class="text-italic">
“Ik wou dat die Godsdienstplicht niet bestond.”
</p>

<p>
Door deze wens zal er bij hem een wens tot ontkenning opkomen vanwaaruit een geestelijke vijandschap tegen God kan worden geconstateerd. Als er een twijfel over Gods bestaan zijn hart indringt, dan zal hij geneigd zijn om zich daaraan vast te klampen – <em>als ware het een doorslaggevend bewijs.</em> Zodoende zal er een grote poort tot verdoemenis voor hem opengaan.
</p>

<p>
Die ellendeling beseft niet dat hij met zijn ontkenning de kleine last achter Godsdienstplichten ontduikt, waartegenover hij zichzelf doelwit van geestelijke lasten maakt die miljoenen malen ernstiger zijn. Om te ontkomen aan een muggenbeet aanvaardt hij een slangensteek.
</p>

</div>'
            ],
            [
                'page_number' => 60,
                'content' => '<div class="page" id="60">

<p class="text-end page-number">#60</p>

<p>
Enzovoort... neem deze drie voorbeelden in overweging opdat het geheim achter:
<span class="text-arabic-inline" dir="rtl" lang="ar">بَلْ رَانَ عَلٰى قُلُوبِهِمْ<sup>1</sup></span>
zich ontvouwt.
</p>

<p class="text-red small-title text-center">
<strong>Het Tweede Punt</strong>
</p>

<p>
Zoals in “Het Zesentwintigste Woord” aangaande het geheim achter het lot is verklaard, heeft de mens bij ziekten en calamiteiten in drie opzichten geen recht om te klagen.
</p>

<p class="text-bold">
Het eerste opzicht
</p>

<p>
De Hoogste Gerechtigde heeft de lichamelijke kledij waarmee Hij de mens heeft bekleed vatbaar voor Zijn Kunstvaardigheid gesteld. Hij heeft de mens een model gemaakt waarop hij die lichamelijke kledij kan knippen, vervormen, veranderen en aanpassen om een glimp van Zijn Uiteenlopende Namen te demonstreren. Zoals de Naam “de Genezer” ziektes vergt, behoeft de Naam “de Onderhouder” honger, enzovoort.
</p>

<p class="text-center text-arabic delima-font"
   dir="rtl"
   lang="ar"
   style="margin: 0px auto 0 auto; max-width: 500px;">
مَالِكُ الْمُلْكِ يَتَصَرَّفُ فٖى مُلْكِهٖ كَيْفَ يَشَٓاءُ<sup>2</sup>
</p>

<p class="text-bold">
Het tweede opzicht
</p>

<p>
Het leven kan dankzij calamiteiten en ziekten zuiveren, ontwikkelen, kracht ondervinden, ontplooien, vruchten afwerpen en volmaaktheid bereiken, waardoor de levenstaak volwaardig kan worden volbracht.
</p>

<div class="page-footnote">

<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Hun harten zijn verroest.” - <em>de Heilige Qur’an, 83:14</em>
</p>

<p class="footnote-p">
<sup>2</sup> Een bezitter van eigendom doet met zijn eigendom wat hij wil.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 61,
                'content' => '<div class="page" id="61">

<p class="text-end page-number">#61</p>

<p>
Een monotoon leven in een rustbed komt veeleer dan existentie, wat pure heil belichaamt, overeen met non-existentie, wat pure onheil belichaamt; tenslotte zal het ook daarin uitmonden.
</p>

<p class="text-bold">
Het derde opzicht
</p>

<p>
Dit aardse oord is de plaats om beproefd te worden en dienst te verrichten, en niet om lusten te bevredigen, beloning te ontvangen en winst te bejagen. Aangezien dit het oord is om dienst te verrichten en dienaarschap te betrachten, behoren wij in gedachte te houden dat ziektes en calamiteiten – <em>zolang ze geen betrekking op het geloof hebben en geduld worden</em> – zeer toepasselijk en bevorderlijk zijn ten opzichte van die dienst en dat dienaarschap. En omdat ze elk uur als een dag lange gebedsdienst doen laten gelden, dient er niet geklaagd maar dank betuigd te worden.
</p>

<p>
Waarlijk, Godsdienstigheid kent twee varianten; de ene variant is actief, de andere is passief. De actieve variant is bekend. Bij de passieve variant verneemt een slachtoffer van ziektes en calamiteiten zijn zwakheid en onmacht, waarna hij zich hulpbehoevend tot zijn Genadige Heer wendt, Hem gedenkt, Hem smeekt en een zuivere Godsdienstigheid betracht. Bij deze Godsdienstigheid kan er geen sprake van huichelarij zijn; ze is zuiver. Als het slachtoffer geduldig blijft, de beloning van de calamiteit gedenkt en dank betuigt, dan zal elk uur voor hem als een dag lange gebedsdienst gelden.

</div>'
            ],
            [
                'page_number' => 62,
                'content' => '<div class="page" id="62">

<p class="text-end page-number">#62</p>

<p>
Uit dit gezichtspunt zal zijn kortstondige leven langdurend worden. Er zijn zelfs variëteiten waarbij elke minuut als een dag lange gebedsdienst geldt. Eens maakte ik mij erg druk om een ernstige ziekte waar mijn broeder van het hiernamaals genaamd Muhâcir Hâfız Ahmed aan leed. Plotseling werd mijn hart het volgende ingegeven:
</p>

<p class="text-italic">
“Feliciteer hem, want elke minuut die hij doorbrengt, geldt als een dag lange gebedsdienst.”
</p>

<p>
Die broeder verkeerde al in een staat waarin hij geduldig dank betuigde.
</p>

<p class="text-red small-title text-center">
<strong>Het Derde Punt</strong>
</p>

<p>
Zoals we in een aantal woorden hebben verklaard, zal ieder mens dat aan zijn verleden denkt in zijn hart en uit zijn mond ofwel een zucht van verdriet ofwel een zucht van opluchting slaken. Met andere woorden, hij zal ofwel jammeren, ofwel
<span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ<sup>1</sup></span>
zeggen.
</p>

<p>
Hetgeen hem doet jammeren, zijn de geestelijke kwellingen die door de teloorgang en scheiding van vroegere genietingen tot stand komen. Want de teloorgang van genot is kwellend. Soms kan een kortstondige genieting een aanhoudende kwelling veroorzaken. Herinneringen rijten die kwelling open en laten er jammerklachten uit vloeien.
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
                'page_number' => 63,
                'content' => '<div class="page" id="63">

<p class="text-end page-number">#63</p>

<p>
De teloorgang en scheiding van vroegere tijdelijke kwellingen baren geestelijke en aanhoudende genietingen die:
<span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ<sup>1</sup></span>
doen laten uitspreken. Als de mens naast deze natuurlijke hoedanigheid aan de vruchten van calamiteiten, bestaande uit zegeningen en beloningen in het hiernamaals denkt, en als hij zich realiseert dat dankzij een calamiteit zijn kortstondige leven als een langdurend leven geldt, dan zal hij – <em>veeleer dan geduld tonen</em> – dank betuigen. Het komt hem dan toe om:
<span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ عَلٰى كُلِّ حَالٍ سِوَى الْكُفْرِ وَالضَّلَالِ<sup>2</sup></span>
te zeggen.
</p>

<p>
De uitspraak: <em>“Calamiteiten duren lang”</em> is bekend.
</p>

<p>
Waarlijk, calamiteiten duren lang. Echter, ze duren niet lang omdat ze vervelend zijn zoals in het algemeen wordt opgevat; ze duren lang omdat ze levensvruchten opleveren die slechts gedurende een langdurend leven kunnen worden afgeworpen.
</p>

<p class="text-red small-title text-center">
<strong>Het Vierde Punt</strong>
</p>

<p>
Zoals in het eerste thema van <strong>“Het Eenentwintigste Woord”</strong> is verklaard, zal de geduldkracht die de Hoogste Gerechtigde aan de mens schenkt voor elke calamiteit toereikend zijn, zolang hij haar niet aan waanvoorstellingen verdoet.
</p>

<div class="page-footnote">

<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> De lof zij ALLAH.
</p>

<p class="footnote-p">
<sup>2</sup> De lof zij ALLAH voor elke omstandigheid, behalve voor ongeloof en dwaling.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 64,
                'content' => '<div class="page" id="64">

<p class="text-end page-number">#64</p>

<p>
Echter, door toedoen van overweldigende waanideeën, menselijke onachtzaamheden en onsterfelijkheidsgedachten ten opzichte van dit vergankelijke leven, strooit de mens zijn duldkracht over het verleden en de toekomst uit, waarna zijn geduld voor de aanwezige calamiteit ongenoegzaam wordt en hij vervolgens begint te klagen. Hij gaat zich dan nagenoeg – <em>God verhoede</em> – bij mensen over de Hoogste Gerechtigde beklagen. Tevens gaat hij op een uiterst onterechte wijze als een bezetene klagen en ongeduld tonen.
</p>

<p>
Immers, bij elke verstreken dag is de last van de calamiteit verdwenen, de rust erna is achtergebleven; de kwelling ervan is vergaan, het genot van haar teloorgang is bijgebleven; de narigheid ervan is voorbij, haar zegen is nagebleven. Hierom dient er niet geklaagd maar opgelucht dank betuigd te worden; hiervoor hoort er geen afkeer maar liefde gekoesterd te worden. Dat vergane vergankelijke levensmoment zal dankzij die calamiteit enigszins als een eeuwig en gelukzalig levensmoment gelden. Met waanvoorstellingen terug aan de destijdse kwellingen denken en zodoende een deel van je geduld daaraan verliezen is absurd.
</p>

<p>
Wat de toekomstige dagen betreft, aangezien ze nog niet zijn aangebroken, is het belachelijk om de ziekten en calamiteiten die je dan eventueel kunnen overkomen nu voor ogen te houden, je geduld daardoor te verliezen en beginnen te klagen. Hoe buitengewoon dwaas is het om vandaag door de gedachte: <em>“Ik ga de aankomende dagen honger en dorst lijden”</em> volop te eten en drinken?</em>
</p>

</div>'
            ],
            [
                'page_number' => 65,
                'content' => '<div class="page" id="65">

<p class="text-end page-number">#65</p>

<p>
Vandaag aan de momenteel onbestaande ziektes en calamiteiten van aankomende dagen denken en nú daarmee zitten, ongeduld tonen en jezelf voor niks kwaad aandoen, is evenzeer zo belachelijk, dat je daardoor je recht op mededogen en medelijden verliest.
</p>

<p class="text-bold text-italic">
Tot slot
</p>

<p>
Zoals dankbetuiging gunsten doet toenemen, doen klachten calamiteiten toenemen, evenals het recht op mededogen vervallen. Tijdens het eerste jaar van de eerste wereldoorlog was een gezegend individu uit Erzurum ernstig ziek geworden. Ik bracht hem een bezoek. Hij zei:
</p>

<p class="text-italic">
“Ik heb de afgelopen honderd nachten mijn hoofd niet éénmaal op een kussen kunnen leggen om te slapen.”
</p>

<p>
Zodoende had hij een bittere klacht tot uiting gebracht. Ik had het erg met hem te doen. Plotseling kreeg ik een ingeving en zei ik:
</p>

<p class="text-italic">
“Broeder, je honderd pijnlijk verstreken dagen gelden nu als honderd welzalige dagen. Klaag niet wanneer je aan ze denkt; haal ze voor de geest en betuig dank. Wat de aankomende dagen betreft, aangezien ze nog niet zijn aangebroken, behoor jij in de Genade van jouw Heer alias de Genadige Barmhartige te berusten. Huil niet voordat je geslagen wordt, wees niet bang voor niets en geef non-existentie geen kleur van bestaan. Denk aan dit moment. Jouw duldkracht zal voldoende zijn voor het aanwezige moment.
</p>

</div>'
            ],
            [
                'page_number' => 66,
                'content' => '<div class="page" id="66">

<p class="text-end page-number">#66</p>

<p class="text-italic">
Gedraag je niet als een dwaze commandant die in de volgende omstandigheid verkeert:
</p>

<p class="text-italic">
Hoewel de vijandelijke krachten tegenover zijn rechterflank zich bij hem aansluiten en hem verse kracht bieden, waarnaast er tegenover zijn linkerflank geen vijand te bekennen is, verplaatst hij zijn krachten vanuit het centrum naar zijn rechter- en linkerflank, waardoor hij het centrum verzwakt en de vijand vervolgens met een minieme moeite het centrum verwoest.”
</p>

<p class="text-italic">
Ik zei: “Broeder, gedraag je niet zoals hij. Bundel al je krachten voor dit moment. Houd de Goddelijke Genade en de beloning in het hiernamaals in gedachte, en besef dat jij je kortstondige levensduur in een eeuwigdurende vorm omzet. Betuig in plaats van deze bittere klacht een verademende dank.”
</p>

<p>
Daarop kwam hij volledig op adem en zei hij:
<span class="text-italic">“</span><span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ<sup>1</sup></span>, <span class="text-italic">mijn ziekte is tienmaal verzacht.”</span>
</p>

<p class="text-red small-title text-center">
<strong>Het Vijfde Punt</strong>
</p>

<p class="text-center text-bold">
Bestaat uit Drie Kwesties
</p>

<p class="text-bold">
De Eerste Kwestie
</p>

<p>
Een ware calamiteit en een kwalijke calamiteit, is een calamiteit die de religie aantast. Tegenover een religieuze calamiteit dient er elk moment huiverend toevlucht tot het Goddelijke Hof te worden genomen.
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
                'page_number' => 67,
                'content' => '<div class="page" id="67">

<p class="text-end page-number">#67</p>

<p>
Calamiteiten die geen betrekking op de religie hebben, zijn vanuit een waarachtig oogpunt geen calamiteiten. Een deel ervan dient als een vermaning van de Barmhartige. Zoals schapen die door hun herder een steen krijgen toegeworpen wanneer ze op het punt staan om andermans graasweide te betreden, en via die steen vernemen dat ze voor iets kwaads worden gehoed en vervolgens tevreden terugkeren, zijn er evenzo vele ogenschijnlijke calamiteiten die als Goddelijke vermaningen en waarschuwingen dienen. Een ander deel dient als een boetedoening. Weer een ander deel verdrijft onachtzaamheid, herinnert de mens aan zijn onmacht en zwakheid en verschaft een zekere vorm van Godsbesef.
</p>

<p>
Calamiteiten die onder de categorie van ziektes vallen, zijn – <em>zoals voorheen beschreven</em> – geen calamiteiten maar veeleer een Gratie des Heren; een zuivering.
</p>

<p>
In een overlevering is het volgende bekendgemaakt:
</p>

<p class="text-italic">
“Zoals een volwaardige fruitboom zijn gerijpte vruchten laat vallen wanneer hij wordt geschud, zullen rillingen tijdens koorts zonden evenzo laten vallen.”
</p>

<p>
Eyyoûb <span class="honorific" dir="rtl" lang="ar">عليه السلام</span> had tijdens zijn smeekbede niet voor zijn persoonlijke gemakzucht gesmeekt. Pas wanneer zijn verering met de tong en zijn bezinning in het hart werden ondermijnd, verzocht hij omwille van zijn dienaarschap om genezing.
</p>

</div>'
            ],
            [
                'page_number' => 68,
                'content' => '<div class="page" id="68">

<p class="text-end page-number">#68</p>

<p>
Wij behoren bij die smeekbede in eerste instantie te streven naar de genezing van onze spirituele wonden die onze zonden in onze ziel hebben geslagen.
</p>

<p>
Tegen fysieke ziekten kunnen wij toevlucht zoeken wanneer ze ons dienaarschap belemmeren. Er hoort echter niet tegensprakig en klagerig, maar nederig en hulpbehoevend toevlucht te worden gezocht. Aangezien wij tevreden over Zijn Heerschappij zijn, is het vereist om tevreden te zijn over hetgeen Hij op basis van Zijn Heerschappij schenkt.
</p>

<p>
Weeklagen op een jammerende toon waaruit protest tegen Zijn Vonnis en lot kan worden afgeleid, impliceert enigszins kritiek op Zijn lot en bezwaar op Zijn Genade. Hij die het lot bekritiseert, slaat zijn hoofd op een aambeeld kapot. Hij die zich over Genade bezwaart, zal van Genade worden onthouden. Zoals wraak nemen met een gebroken hand de breuk alleen maar verergert, zal een mens de calamiteit waaronder hij lijdt slechts verdubbelen als hij haar op een opstandige wijze klagerig en zorgelijk verwelkomt.
</p>

<p class="text-bold">
De tweede kwestie
</p>

<p>
Fysieke calamiteiten zetten zich uit als ze worden overschat en krimpen in als ze worden geringgeschat.
</p>

<p>
Bijvoorbeeld, ’s nachts kan er bij de mens een waanvoorstelling opkomen. Als hij haar aandacht schenkt, dan zal ze opzwellen; als hij haar negeert, dan zal ze verdwijnen.
</p>

</div>'
            ],
            [
                'page_number' => 69,
                'content' => '<div class="page" id="69">

<p class="text-end page-number">#69</p>

<p>
Zoals agressieve bijen agressiever worden als ze worden getreiterd, terwijl ze wegvliegen als ze worden genegeerd, zullen fysieke calamiteiten zich evenzo uitzetten zolang ze met een zorgelijke blik als ernstig worden beschouwd. Door zorgen zal zo’n calamiteit het fysieke ontstijgen, wortels in het hart schieten en een geestelijke calamiteit teweegbrengen waarop ze zich kan berusten en kan blijven aanhouden.
</p>

<p>
Wanneer die zorgen middels tevredenheid jegens Gods Vonnis en gelatenheid worden verdreven, dan zal de fysieke calamiteit verzachten en zoals een ontwortelde boom uiteindelijk volledig uitdrogen en verdwijnen. Om deze waarheid uit te drukken, had ik eens het volgende onder woorden gebracht:
</p>

<p class="text-center text-italic text-bold">
Zie af van beklag, o wanhopige;<br />
reageer gelaten op onheil.
</p>

<p class="text-center text-italic text-bold">
Immers, beklag genereert onheil<br />
binnen zondigheid binnen onheil, besef dit.
</p>

<p class="text-center text-italic text-bold">
Als jij de Schenker van onheil vindt, dan zul jij plezier<br />
binnen Gratie binnen onheil ontmoeten, doorzie dit.
</p>

<p class="text-center text-italic text-bold">
Als jij Hem niet vindt, dan zal de hele wereld ellende<br />
binnen teloorgang binnen onheil belichamen.
</p>

<p class="text-center text-italic text-bold">
Hoewel een wereldgroot onheil op je staat te wachten,<br />
vraag ik je waarom jij om een klein onheil krijst?<br />
Kom, wees gelaten.
</p>

<p class="text-center text-italic text-bold">
Lach gelaten in het aangezicht van onheil,<br />
opdat hij teruglacht. Naarmate jij lacht,<br />
zal hij krimpen en metamorfoseren.
</p>

</div>'
            ],
            [
                'page_number' => 70,
                'content' => '<div class="page" id="70">

<p class="text-end page-number">#70</p>

<p>
Tijdens een woordenstrijd tegen een driftige tegenstander kan een glimlach de gemoederen sussen, wrok in een geestigheid omzetten en vijandschap terugdringen en vernietigen. Evenzo zal een gelaten reactie op een calamiteit hetzelfde effect uitoefenen.
</p>

<p class="text-bold">
De Derde Kwestie
</p>

<p>
Elke tijd heeft een eigen tijdgeest. Gedurende deze tijden van onachtzaamheid hebben calamiteiten een andere gedaante aangenomen. Onder bepaalde omstandigheden en bij bepaalde individuen is onheil geen onheil maar een Godsgeschenk.
</p>

<p>
Omdat ik de hedendaagse slachtoffers van ziektes en andere calamiteiten – <em>zolang de calamiteit de religie niet deert</em> – voorspoedig acht, komen er noch afkerige gevoelens jegens ziektes en calamiteiten, noch medelijden voor de slachtoffers bij mij op.
</p>

<p>
Immers, bij elke zieke jongere die mij heeft bezocht, heb ik opgemerkt dat hij in vergelijking met zijn leeftijdsgenoten een sterkere verbondenheid met zijn taken inzake de religie en het hiernamaals koestert. Daaruit heb ik begrepen dat dergelijke ziektes voor zulke personen geen calamiteit maar een Goddelijke gunst zijn. Immers, alhoewel die ziektes een last voor hun vergankelijke en kortstondige aardse leven opleveren, bevoordelen ze hun eeuwige leven; ze gelden in zekere zin als een gebedsdienst.
</p>

</div>'
            ],
            [
                'page_number' => 71,
                'content' => '<div class="page" id="71">

<p class="text-end page-number">#71</p>

<p>
Als hun gezondheid zou herstellen, dan zouden ze door toedoen van de dronkenschap der jeugdigheid en de hedendaagse zedeloosheden de zielsgesteldheid gedurende hun ziektes uiteraard niet kunnen voortzetten, misschien zouden ze zich zelfs in onzede storten.
</p>

</div>'
            ],
            [
                'page_number' => 72,
                'content' => '<div class="page" id="72">

<p class="text-end page-number">#72</p>

<p class="text-red small-title text-center">
<strong>Slot</strong>
</p>

<p>
De Hoogste Gerechtigde heeft in de mens een eindeloze onmacht en een grenzeloze behoeftigheid gevestigd om Zijn Eindeloze Macht en Zijn Grenzeloze Genade te tonen.
</p>

<p>
En om de eindeloze weefsels van Zijn Namen te demonstreren, heeft Hij de mens in de hoedanigheid van een machine geschapen die op ontelbare manieren zowel kwellingen als genietingen kan ondervinden. En die menselijke machine is uitgerust met honderden instrumenten die elk een distinctieve kwelling, een distinctieve genieting, een distinctieve taak en een distinctieve beloning bevatten. Alle Goddelijke Namen Die Zich bij de macro-mens alias de wereld manifesteren, worden allemaal evenzeer op de micro-wereld alias de mens weerschenen.
</p>

<p>
Hierbij zijn er bevallige beschikkingen, zoals gezondheid, welzijn en genot, die dank doen betuigen en die machine in vele opzichten tot haar taken wenden, waardoor de mens als een fabriek fungeert die dank produceert.
</p>

</div>'
            ],
            [
                'page_number' => 73,
                'content' => '<div class="page" id="73">

<p class="text-end page-number">#73</p>

<p>
Evenzo zijn er calamiteiten, ziekten, kwellingen en andere spanningverwekkende en turbulente storingen die de overige tandwielen van die machine activeren en laten draaien. Dientengevolge wordt de mijn van onmacht, zwakheid en behoeftigheid binnenin de aard van de mens in werking gezet. Dit resulteert in een gesteldheid waarbij er niet in één taal, maar in de taal van elk instrument een smeekbede en een noodroep tot uiting wordt gebracht.
</p>

<p>
De mens wordt dankzij die storingen als het ware een beweeglijke pen die duizenden verschillende pennen omvat. Op zijn levensbladzijde of op het Tableau van gelijkenissen legt hij zijn voorbeschikte leven vast, stelt hij een openbaarmaking van Goddelijke Namen samen en rondt hij als een ode aan de Feilloze zijn natuurlijke taak af.
</p>

</div>'
            ],
            [
                'page_number' => 74,
                'content' => '<div class="page" id="74">

<p class="text-end page-number">#74</p>

<p class="text-bold text-italic" style="text-transform: uppercase">
Een Brief aan een dokter die veel passie voor de Risale-i Nur koestert en na zich erin verdiept te hebben tot ontwaking is gekomen.
</p>

<p class="text-italic">
O voorspoedige dokter die zijn eigen ziekte heeft kunnen vaststellen! Mijn trouwe en eerbiedwaardige vriend... hoe gaat het met je?
</p>

<p class="text-italic">
Jouw zielsontwaking die uit jouw vurige brief is af te leiden, verdient een felicitatie.
</p>

<p class="text-bold text-italic">
Besef dat onder alle verschijnselen in het bestaan het leven het allerwaardevolst is. En onder alle taken zijn de diensten ter bevordering van het leven het allerwaardevolst. En onder de diensten die het leven bevorderen, is de ijver om het vergankelijke leven in een eeuwig leven om te zetten het allerwaardevolst. Alle waarde en belang van dit leven zijn gevestigd in zijn hoedanigheid waarbij hij als zaad, als bron en als oorsprong van het eeuwige leven dient.
</p>

<p class="text-italic">
Anders, als iemand met zijn kijk op dit vergankelijke leven zijn eeuwige leven vergiftigt en bederft, dan begaat hij een dwaasheid die gelijkstaat aan het verkiezen van een ogenblikkelijke bliksemflits boven een eeuwige zon.
</p>

</div>'
            ],
            [
                'page_number' => 75,
                'content' => '<div class="page" id="75">

<p class="text-end page-number">#75</p>

<p class="text-italic">
Uit een waarachtig oogpunt zijn materialistische en onachtzame doktoren zieker dan iedereen. Als zij zich van de triakelachtige geloofsmedicijnen uit de Heilige Apotheek van de Qur’an konden voorzien, dan zouden zij zowel hun eigen ziektes als de wonden van de mensheid kunnen helen. Inshâ’ALLAH zal deze ontwaking van jou een zalf over jouw wond strijken en de ziektes van doktoren via jou genezen.
</p>

<p class="text-italic">
Daarnaast ben jij er ook van bewust dat geestelijke troost voor een wanhopige en radeloze zieke soms heilzamer dan duizend geneesmiddelen kan zijn. Echter, een dokter die in het moeras van naturalisme is verzonken, zal de schrijnende wanhoop van die arme zieke slechts met extra duisternis beladen. Inshâ’ALLAH zal deze ontwaking van jou ertoe leiden dat jij voor zulke arme zieken een bron van troost en een lumineuze dokter kunt zijn.
</p>

<p class="text-bold text-italic">
Jij weet dat het leven kort is, terwijl er een overvloed aan belangrijke taken zijn. Indien jij net als ik alle kennis in je hoofd nagaat, wie weet hoeveel nutteloze, overbodige en waardeloze informatie jij dan zult aantreffen die als gefossiliseerde houtstapels in je hoofd zijn opgeslagen? Immers, ik heb mijn kennis geanalyseerd en ben veel nutteloze informatie tegengekomen. Voorwaar, er hoort gezocht te worden naar een manier om die wetenschappelijke informatie en die filosofische kennis nuttig, lumineus en bezield te maken.
</p>

</div>'
            ],
            [
                'page_number' => 76,
                'content' => '<div class="page" id="76">

<p class="text-end page-number">#76</p>

<p class="text-italic">
Wens van de Hoogste Gerechtigde ook in dit opzicht om een ontwaking, opdat Hij jouw kennis aan Zijn Ontzaglijke Wijsheid koppelt, en die houtstapels in vlam zet en verlicht; opdat jouw nutteloze wetenschappelijke kennis als waardevolle Godskennis kan dienen.
</p>

<p class="text-italic">
Mijn scherpzinnige vriend! Lang heeft mijn hart verlangd naar de verschijning van individuen onder de wetenschappers die ten aanzien van geloofslichten en Qur’anische geheimen een gepassioneerde behoeftigheid gelijkwaardig aan die van Hulûsi Bey vernemen.
</p>

<p class="text-italic">
En aangezien <strong>“De Woorden”</strong> jouw geweten kunnen toespreken, kun jij elk <strong>“Woord”</strong> als een brief zien die niet door mij persoonlijk maar door de heraut van de Qur’an aan jou is geschreven; waardeer elk ervan als een recept uit de Heilige Apotheek van de Qur’an. Ondanks mijn fysieke afwezigheid kun je daarmee altijd een tegenwoordig gesprek met mij starten.
</p>

<p class="text-italic">
Daarnaast kun jij mij altijd een brief schrijven. Vat het echter niet persoonlijk op als ik niet reageer. Sinds vroeger schrijf ik maar heel weinig brieven. Zelfs de vele brieven die mijn broertje de afgelopen drie jaar naar mij heeft gezonden, heb ik maar met één brief beantwoord...
</p>

<p class="text-italic" style="text-align: right">
Said Nursî
</p>

</div>'
            ],
        ];
    }
}

