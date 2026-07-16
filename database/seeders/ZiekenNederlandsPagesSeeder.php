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
        ];
    }
}

