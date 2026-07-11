<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BroederschapNederlandsPagesSeeder extends BookPagesSeeder
{
    protected function productSlug(): string
    {
        // return the exact slug used when creating the product in DatabaseSeeder
        return 'broederschap-oprechtheid-nederlands';
    }

    protected function bookTitle(): string
    {
        return 'Broederschap & Oprechtheid';
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
        <h2>De Tweeëntwintigste Brief</h2>
    </div>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar">
بِاسْمِهٖ <sup>1</sup> ۞ وَ اِنْ مِنْ شَىْءٍ اِلَّا يُسَبِّحُ بِحَمْدِهٖ <sup>2</sup>
</p>

<p class="text-center" style="max-width: 500px; margin: 0 auto;margin-bottom: 18px;">
Deze Brief bestaat uit twee thema’s.
Het Eerste Thema nodigt de gelovigen uit tot:
broederschap en liefde.
</p>


    <div class="text-center page-title-chapter delima-font">
        <h2>Het Eerste Thema</h2>
    </div>

<p class="text-center text-arabic-bismillah" dir="rtl" lang="ar">
<img src="/images/bismillah .svg" alt="Bismillah" class="bismillah-svg bismillah-svg-light">
<img src="/images/bismillah-dark.svg" alt="Bismillah" class="bismillah-svg bismillah-svg-dark">
<span class="fn-ref-wrap"><span class="fn-ref-word"></span><button class="fn-ref" type="button" aria-label="Voetnoot 1" data-fn="1" data-html="&lt;p class=&quot;footnote-p fn-popover__para&quot;&gt;
 “In de Naam van ALLAH, de Barmhartige, de Genadige.”
&lt;/p&gt;"><sup>1</sup></button></span>
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar">
﴿ اِنَّمَا الْمُؤْمِنُونَ اِخْوَةٌ فَاَصْلِحُوا بَيْنَ اَخَوَيْكُمْ ﴾ <sup>4</sup>
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar">
﴿ اِدْفَعْ بِالَّتٖى هِىَ اَحْسَنُ فَاِذَا الَّذٖى بَيْنَكَ وَبَيْنَهُ عَدَاوَةٌ كَاَنَّهُ وَلِىٌّ حَمٖيمٌ ﴾ <sup>5</sup>
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar">
﴿ وَالْكَاظِمٖينَ الْغَيْظَ وَالْعَافٖينَ عَنِ النَّاسِ وَاللّٰهُ يُحِبُّ الْمُحْسِنٖينَ ﴾ <sup>6</sup>
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “In Zijn Naam.”
</p>

<p class="footnote-p">
<sup>2</sup> “En er is niets, of het prijst Hem met lof.” - Qur’an, 17:44
</p>

<p class="footnote-p">
<sup>3</sup> “In de Naam van ALLAH, de Barmhartige, de Genadige.”
</p>

<p class="footnote-p">
<sup>4</sup> “Voorzeker, de gelovigen zijn elkaars broeders; verzoen jullie dus onderling met jullie broeders.” - Qur’an, 49:10
</p>

<p class="footnote-p">
<sup>5</sup> “Vergeld kwaad met goed, en je zult zien dat de persoon waarmee jij vijandig was, jouw trouwe zielsvriend wordt.” - Qur’an, 41:34
</p>

<p class="footnote-p">
<sup>6</sup> “Zij die hun woede in toom houden en de mensen vergeven; en ALLAH houdt van de weldoeners.” - Qur’an, 3:134
</p>

</div>

</div>'
            ],
            [
                'page_number' => 6,
                'content' => '<div class="page" id="6">
<p class="text-end page-number">#6</p>

<p>
Partijdigheid, koppigheid en jaloezie onder de gelovigen, waaruit huichelarij en verdeeldheid, wrok en vijandschap oprijzen, zijn volgens de maatstaven van de waarheid, de wijsheid, de ultieme menselijkheid alias de Islam, het persoonlijke leven, het gemeenschapsleven en het spirituele leven: lelijk en verwerpelijk, verderfelijk en onrechtvaardig; ze zijn een gif voor het mensenleven.
</p>

<p class="text-center text-italic">
Uit de vele opzichten van deze waarheid zullen wij<br>
<span class="text-bold">“Zes Opzichten”</span> uiteenzetten.
</p>

<p class="text-center text-red small-title"><strong>Het Eerste Opzicht</strong></p>

<p class="text-center text-bold">
Uit het oogpunt van de waarheid<br>
is het onrechtvaardig.
</p>

<p>
O onredelijke mens die wrok en vijandschap jegens een gelovige koestert! Als jij je samen met negen onschuldigen en één wreedaard op een schip of in een huis zou bevinden, dan zou jij wel beseffen wat voor onrecht iemand zou plegen als hij dat schip tot zinken zou willen brengen of dat huis zou willen afbranden. Jij zou je zo luidruchtig over zijn onrecht uitlaten, dat je kreet door de hemelen zou galmen. Al zouden slechts één onschuldige en negen wreedaards aan boord zijn, dan kan dat schip alsnog volgens geen enkele rechtvaardige wet tot zinken worden gebracht.
</p>

<p>
Evenzo is een gelovige een huis des Heren en een Goddelijk schip wiens bestaan geen negen maar wel twintig onschuldige eigenschappen herbergt – <span class="text-italic">zoals geloof, Islam en buurschap.</span>
</p>

</div>'
            ],
            [
                'page_number' => 7,
                'content' => '<div class="page" id="7">
<p class="text-end page-number">#7</p>

<p>
Indien jij desondanks door één nare eigenschap die jou tegenzit of niet aanstaat aan wrok en vijandschap toegeeft, en een poging doet of een wens koestert om dat geestelijke huis impliciet te laten zinken en af te branden, te verwoesten en te gronde te richten, dan pleeg jij een net zo gruwelijk en barbaars onrecht.
</p>

<p class="text-center text-red small-title"><strong>Het Tweede Opzicht</strong></p>

<p class="text-center text-bold">
Ook uit het oogpunt van wijsheid<br>
is het onrechtvaardig.
</p>

<p>
Immers, het is bekend dat vijandschap en liefde evenals licht en duisternis contrasten zijn; het is onmogelijk om ze in hun ware vorm te verenigen.
</p>

<p>
Als liefde naar aanleiding van haar overweldigende redenen daadwerkelijk in een hart zetelt, dan zal vijandschap schijn worden en in medelijden omslaan. Waarlijk, een gelovige houdt van zijn broeder en hoort ook van hem te houden. Om zijn kwalijke eigenschappen heeft hij slechts medelijden. Hij zal niet opdringerig maar welwillend zijn best doen om hem tot inkeer te brengen. Daarom meldt een concrete Hadîth:
</p>

<p class="text-italic">
“Een gelovige mag niet langer dan drie dagen boos blijven en het contact met zijn medegelovige verbreken.”
</p>

<p>
Indien redenen tot vijandschap de overhand krijgen en als vijandschap zich in haar ware vorm in het hart nestelt, dan zal liefde schijn worden en in gekunsteldheid en mooidoenerij omslaan.
</p>

</div>'
            ],
            [
                'page_number' => 8,
                'content' => '<div class="page" id="8">
<p class="text-end page-number">#8</p>

<p>
O onredelijke mens! Kijk nu hoe onrechtvaardig het is om wrok en vijandschap jegens jouw gelovige broeder te koesteren.
</p>

<p>
Immers, als jij zou beweren dat simpele kiezelsteentjes waardevoller dan de Kaäba en groter dan het Oehoed-gebergte zijn, dan zul jij een lelijke dwaasheid begaan.
</p>

<p>
Als jij over een verstand beschikt, dan zul jij ook beseffen hoe onredelijk, hoe dwaas en hoe buitengewoon kwaadaardig het is om de vele islamitische elementen die liefde en eenheid vergen – <span class="text-italic">zoals het geloof dat zo achtenswaardig is als de Kaäba en de Islam die zo geweldig is als het Oehoed-gebergte</span> – niet in aanmerking te nemen, en in plaats daarvan enkele kiezelkleine tekortkomingen die vijandschap jegens een gelovige aanwakkeren de voorkeur boven het geloof en de Islam te geven.
</p>

<p>
Waarlijk, eenheid in het geloof behoeft uiteraard eenheid in de harten. En eenheid in de overtuiging vergt eenheid in de omgang.
</p>

<p>
Waarlijk, als jij met iemand in hetzelfde bataljon zou dienen, dan kun je niet ontkennen dat jij een kameraadschappelijke verbondenheid tussen jullie zou ontwaren. En omdat jullie onder het bevel van dezelfde commandant staan, zou jij een vriendschappelijke betrekking tussen jullie vernemen. En door in hetzelfde land te leven, zal jij een broederlijke binding tussen jullie voelen.
</p>

</div>'
            ],
            [
                'page_number' => 9,
                'content' => '<div class="page" id="9">
<p class="text-end page-number">#9</p>

<p>
Echter, gezien het licht en inzicht dat het geloof verschaft, zijn er zoveel verenigende betrekkingen, unificerende verbondenheden en broederlijke bindingen als het aantal Goddelijke Namen dat het geloof jou toont en onderwijst. Bijvoorbeeld:
</p>

<p class="text-bold">
Jullie Schepper is Eén, jullie Eigenaar is Eén, jullie Aanbedene is Eén... zo zijn er wel duizend overeenkomsten.
</p>

<p class="text-bold">
Tevens is jullie profeet één, jullie religie is één, jullie qibla is één... zo zijn er wel honderden overeenkomsten.
</p>

<p class="text-bold">
Ten slotte is jullie dorp één, jullie land is één, jullie provincie is één... zo zijn er wel tientallen overeenkomsten.
</p>

<p>
Ondanks dat zoveel overeenkomsten eenheid en uniteit, saamhorigheid en eendracht, liefde en broederschap vergen, en ondanks dat er zulke spirituele ketenen zijn die het universum en de hemellichamen met elkaar verbinden, kun jij – <span class="text-italic">mits je hart niet gestorven en je verstand niet gedoofd is</span> – ook wel begrijpen hoe onderwaarderend het is tegenover die verenigende verbondenheden, hoe minachtend het is tegenover die redenen tot liefde, en hoe onrechtvaardig en onterecht het is tegenover die broederlijke bindingen om alsnog zaken die zo waardeloos en instabiel als spinnenwebben zijn, en verdeeldheid en huichelarij, wrok en vijandschap veroorzaken, de voorkeur te geven door ware vijandschap en wrok jegens een gelovige te koesteren.
</p>

</div>'
            ],
            [
                'page_number' => 10,
                'content' => '<div class="page" id="10">
<p class="text-end page-number">#10</p>

<p class="text-center text-red small-title"><strong>Het Derde Opzicht</strong></p>

<p>
Volgens het geheim achter: <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">وَلَا تَزِرُ وَازِرَةٌ وِزْرَ اُخْرٰى</span> – <span class="text-italic">wat pure rechtvaardigheid uitdrukt</span> – is het een immens onrecht om wegens één nare eigenschap van een gelovige impliciet al zijn overige onschuldige eigenschappen te veroordelen door vijandschap en wrok tegen hem te koesteren; vooral als jij je aan een kwalijke eigenschap van een gelovige ergert, boos wordt en je vijandschap tot de familieleden van die gelovige uitbreidt, rest de vraag hoe jij nog kunt vinden dat jij gelijk hebt en <span class="text-italic">“Ik ben in mijn recht!”</span> kunt zeggen nadat de waarheid, de Sharia en de wijsheid van de Islam met de beladen formulering: <sup>2</sup><span class="text-arabic-inline" dir="rtl" lang="ar">اِنَّ الْاِنْسَانَ لَظَلُومٌ</span> jou eraan herinneren dat jij een geweldig groot onrecht pleegt.
</p>

<p>
Uit een waarachtig oogpunt zijn zondigheden die vijandschap en onheil veroorzaken donker zoals onheil en aarde; ze behoren anderen niet te includeren en te beschijnen. Dat iemand van een ander zondigheden kan leren en onheil kan bedrijven is een andere zaak.
</p>

<p>
Deugden die liefde opwekken zijn stralend zoals liefde; includeren en beschijnen behoren tot hun karakteristieken.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “En geen zondaar bezondigt zich aan de zonden van een ander.” - Qur’an, 17:15
</p>

<p class="footnote-p">
<sup>2</sup> “Voorzeker, de mens is onrechtvaardig.” - Qur’an, 14:34
</p>

</div>

</div>'
            ],
            [
                'page_number' => 11,
                'content' => '<div class="page" id="11">
<p class="text-end page-number">#11</p>

<p>
Daarom is de uitspraak: <span class="text-italic">“De vriend van een vriend is een vriend.”</span> spreekwoordelijk geworden... en daarom wordt de uitspraak: <span class="text-italic">“Uit liefde voor één worden velen geliefd.”</span> regelmatig vernomen.
</p>

<p>
Voorwaar, o onredelijke mens! Aangezien het oog van de waarheid het zo ziet, kun jij zolang jij eerlijk bent wel inzien hoe oneerlijk het is om tegen een liefdewaardige en onschuldige broeder en naaste van iemand die jij niet liefhebt vijandschap te koesteren.
</p>

<p class="text-center text-red small-title"><strong>Het Vierde Opzicht</strong></p>

<p class="text-center text-bold">
Ook uit het oogpunt van het persoonlijke leven is<br>
het onrechtvaardig.
</p>

<p>
Luister naar een aantal principes die de essentie van dit vierde opzicht vormen.
</p>

<p class="text-bold">
Het eerste principe
</p>

<p>
Wanneer jij jouw weg en jouw opvattingen juist acht, dan heb jij het recht om: <span class="text-italic">“Mijn weg is juist”</span> of <span class="text-italic">“Mijn weg is beter”</span> te zeggen. Jij hebt echter niet het recht om: <span class="text-italic">“Slechts mijn weg is juist”</span> te zeggen. Volgens het geheim achter:
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin-top: 0px">
وَعَيْنُ الرِّضَا عَنْ كُلِّ عَيْبٍ كَلٖيلَةٌ ۞ وَلٰكِنَّ عَيْنَ السُّخْطِ تُبْدِى الْمَسَاوِيَا <sup>1</sup>
</p>

<p>
kunnen jouw onredelijke blik en jouw subjectieve opvatting niet voor rechter spelen en de weg van een ander vals verklaren.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Een tevreden blik is blind tegenover alle tekortkomingen. Een ontevreden blik daarentegen richt zich vooral op gebreken.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 12,
                'content' => '<div class="page" id="12">
<p class="text-end page-number">#12</p>

<p class="text-bold">
Het tweede principe
</p>

<p>
De verantwoordelijkheid die op jou rust, verplicht jou om altijd de waarheid te spreken. Echter, jij hebt niet het recht om elke waarheid mee te delen. Alles wat jij zegt hoort juist te zijn. Echter, het is niet juist om elke juistheid onder woorden te brengen. Immers, het advies van iemand met een gebrek aan een zuivere intentie zoals jij, kan soms irritaties opwekken, waardoor het averechts kan uitpakken.
</p>

<p class="text-bold">
Het derde principe
</p>

<p>
Als jij vijandig wil zijn, wees dan vijandig jegens de vijandigheid in je hart en probeer haar te verdrijven. En sta vijandig tegenover je kwaadgezinde ego en je egoïstische lusten waarvan jij de meeste schade ondervindt, en ijver voor hun herstel. Ga niet omwille van jouw verderfelijke ego vijandschap tegen gelovigen koesteren. Indien jij per se vijandschap wilt koesteren, dan zijn er genoeg kafirs en heidenen; wees vijandig tegen hen.
</p>

<p>
Waarlijk, zoals liefde een karakteristiek is die liefde verdient, is vijandschap evenzo een attribuut dat bovenal vijandschap verdient. Als jij je vijand wil overwinnen, beantwoord zijn kwaadwilligheid dan met goedgunstigheid. Immers, als jij kwaadzinnig reageert, dan zal vijandschap toenemen. Zelfs als je hem ogenschijnlijk een nederlaag toebrengt, zal wrok in zijn hart voortwoekeren en zijn vijandschap voortzetten. Als jij hem goedgunstig benadert, dan zal hij spijt krijgen en bevriend met jou raken.
</p>

</div>'
            ],
            [
                'page_number' => 13,
                'content' => '<div class="page" id="13">
<p class="text-end page-number">#13</p>

<p>
Volgens het standpunt:
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin-top: 0">
اِذَا اَنْتَ اَكْرَمْتَ الْكَرٖيمَ مَلَكْتَهُ ۞ وَ اِنْ اَنْتَ اَكْرَمْتَ اللَّئٖيمَ تَمَرَّدًا <sup>1</sup>
</p>

<p>
is edelmoedigheid een herkenningsteken van een gelovige. Door jouw weldadigheid zal hij zich inschikkelijk jegens jou opstellen. Al oogt hij valshartig, gezien zijn geloof is hij edelmoedig.
</p>

<p>
Waarlijk, het komt regelmatig voor dat een slecht persoon zich betert wanneer je telkens: <span class="text-italic">“Jij bent een goed persoon”</span> tegen hem zegt, terwijl een goed persoon verslechtert wanneer je steeds: <span class="text-italic">“Jij bent een slecht persoon”</span> tegen hem zegt.
</p>

<p class="text-bold">
Geef dus gehoor aan de Heilige Principes van de Qur’an Die vermeld staan in Aya’s als:
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin-top: 0">
﴿ وَاِذَا مَرُّوا بِاللَّغْوِ مَرُّوا كِرَامًا ﴾ <sup>2</sup>
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin-top: 0">
﴿ وَاِنْ تَعْفُوا وَتَصْفَحُوا وَتَغْفِرُوا فَاِنَّ اللّٰهَ غَفُورٌ رَحٖيمٌ ﴾ <sup>3</sup>
</p>

<p class="text-center text-bold">
Gelukzaligheid en vrede schuilen in Hem.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Als je een edelmoedig persoon goedgunstig benadert, dan zul je hem aanwinnen; en als je een valsaard goedgunstig benadert, dan zal hij harder tegen jou ingaan.”
</p>

<p class="footnote-p">
<sup>2</sup> “En wanneer zij op onzinnigheid stuiten, lopen ze haar edelmoedig voorbij.” - Qur’an, 25:72
</p>

<p class="footnote-p">
<sup>3</sup> “En wanneer jullie hen vergeven, ontschulden en begenadigen, voorzeker, weet dan dat ALLAH Vergevensgezind en Genadig is.” - Qur’an, 64:14
</p>

</div>

</div>'
            ],
            [
                'page_number' => 14,
                'content' => '<div class="page" id="14">
<p class="text-end page-number">#14</p>

<p class="text-bold">
Het vierde principe
</p>

<p>
Wrokkige en vijandige mensen doen zowel zichzelf als hun geloofsbroeder als de Goddelijke Genade onrecht aan. Want door wrok en vijandschap te koesteren, stelt zo iemand zichzelf bloot aan een frustrerende kwelling. Met frustraties over de gunsten die zijn tegenstander toekomen en met kwellingen die aan zijn angst voor hem ontspruiten, doet hij zichzelf onrecht aan.
</p>

<p>
Als vijandschap uit jaloezie voortkomt, dan is dat geheel en al een marteling. Immers, in eerste instantie doet jaloezie de jaloerse persoon stikken, branden en creperen. De persoon waartegen jaloezie wordt gekoesterd, ondervindt daarentegen ofwel weinig ofwel totaal geen nadeel.
</p>

<p class="text-bold text-italic">
Het middel tegen jaloezie:
</p>

<p>
De jaloerse persoon dient de afloop van de zaken waarop hij jaloers is in ogenschouw te nemen, opdat hij inziet dat de wereldse praal, kracht, status en weelde van zijn tegenstander vergankelijk en kortstondig zijn; ze leveren weinig op, terwijl ze enorme lasten met zich meebrengen. Als het aankomt op aangelegenheden die betrekking op het hiernamaals hebben, dan kan daar überhaupt geen jaloezie tegen worden gekoesterd. Als iemand zelfs daar jaloers op is, dan is diegene ofwel zelf een schijnheil die zijn bezittingen voor het hiernamaals aan het aardse wil prijsgeven, of hij veronderstelt dat degene waarop hij jaloers is schijnheilig is, wat oneerlijk en onterecht is.
</p>

</div>'
            ],
            [
                'page_number' => 15,
                'content' => '<div class="page" id="15">
<p class="text-end page-number">#15</p>

<p>
En door voldoening te beleven aan de tegenslagen en te treuren om de gunsten die zijn tegenstander toekomen, ergert hij zich aan de goedgunstigheden die hem vanuit het lot en de Goddelijke Genade toevloeien. Hij heeft nagenoeg kritiek op het lot en bezwaar tegen Genade.
</p>

<p class="text-bold">
Hij die het lot bekritiseert, slaat zijn hoofd op een aambeeld kapot; hij die bezwaar tegen Genade heeft, zal van Genade worden onthouden.
</p>

<p>
Welk gemoed zou het accepteren om een jaar lang wrok en vijandschap te koesteren om iets dat geen dag vijandschap waard is? Welk onbedorven geweten zou zoiets kunnen verdragen? Daar komt bij dat jij een tegenslag die jou aan de hand van jouw geloofsbroeder heeft getroffen niet volledig op hem kunt afschuiven en hem niet kunt veroordelen.
</p>

<p class="text-bold">
Immers:
</p>

<p>
<span class="text-italic text-bold">Ten eerste</span> heeft het lot er een aandeel in. Dat aandeel van het lot en het Godsbesluit behoor je af te scheiden en in tevredenheid te verwelkomen.
</p>

<p>
<span class="text-italic text-bold">Ten tweede</span> hoor je ook het aandeel van het ego en de duivel af te scheiden, waarna je in afwachting van zijn inkeer geen vijandschap maar medelijden voor hem moet voelen omdat hij door zijn ego is overwonnen.
</p>

<p>
<span class="text-italic text-bold">Ten derde</span> dien je de tekorten van jezelf – <span class="text-italic">die je niet ziet of wilt zien</span> – ook onder ogen te zien en daar ook een aandeel aan te geven.
</p>

</div>'
            ],
            [
                'page_number' => 16,
                'content' => '<div class="page" id="16">
<p class="text-end page-number">#16</p>

<p>
<span class="text-italic">Tenslotte</span>, als jij tegenover het kleine overgebleven aandeel vergeeflijk, toegeeflijk en edelmoedig reageert, wat jou de vredigste en snelste overwinning op jouw tegenstander zal schenken, dan zul jij van onrecht en nadeligheid worden gered.
</p>

<p>
Anders gedraag jij je als een dronken en krankzinnige Joodse juwelier die stukken glas en blokken ijs voor de prijs van diamanten inkoopt wanneer jij tegenover vergankelijke, onbestendige, kortstondige en waardeloze wereldse zaken die geen vijf cent waard zijn, optreedt alsof jij eeuwig met die zaken op aarde zult verblijven door met een onverzadigbare hebzucht en een onstilbare wrok onophoudelijk vijandschap te koesteren. Dit is in beladen termen een ongerechtigheid ofwel een dronkenschap. Tevens is het een vorm van krankzinnigheid.
</p>

<p>
Voorwaar, als jij jezelf liefhebt, sta dan niet toe dat vijandigheden en wraakgedachten die jouw persoonlijke leven zodanig benadelen jouw hart indringen. Als ze je hart al zijn ingedrongen, geef dan geen gehoor aan ze. Luister naar wat de waarheidkenner alias Hafez-e Shirâz zegt:
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="fa" style="margin-top: 0">
دُنْيَا نَه مَتَاعٖيسْتٖى كِه اَرْزَدْ بَنِزَاعٖى
</p>

<p>
Oftewel, <span class="text-italic">“De wereld is niet zo kostbaar dat ze ruzie waard is.”</span> Immers, omdat ze vergankelijk en kortstondig is, is ze nietswaardig. Als de enorme wereld al zo is, kun je wel nagaan hoe waardeloos de simpele wereldse zaken zijn.
</p>

</div>'
            ],
            [
                'page_number' => 17,
                'content' => '<div class="page" id="17">
<p class="text-end page-number">#17</p>

<p>
Bovendien zei hij:
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="fa" style="margin-top: 0">
اٰسَايِشِ دُو گٖيتٖى تَفْسٖيرِ اٖينْ دُو حَرْفَسْتْ
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="fa">
بَادُوسِتَانْ مُرُوَّتْ بَادُشْمَنَانْ مُدَارَا
</p>

<p>
Oftewel, <span class="text-italic">“Twee woorden vertolken en verschaffen rust en vrede in beide werelden: edelmoedige omgang met vrienden en vreedzame omgang met vijanden.”</span>
</p>

<p class="text-bold">
Indien jij het volgende opmerkt:
</p>

<p class="text-italic">
“Ik heb het niet in de hand; vijandschap zit in mijn aard. Wat mij is aangedaan, kan ik niet loslaten.”
</p>

<p class="text-bold">
Het antwoord
</p>

<p>
Als jij geen voortbrengselen van een slecht karakter en een kwade gezindheid toont, als jij niet op basis van zaken als roddels en de invloeden daarvan handelt, en als jij je fout erkent, dan kan het geen kwaad. Aangezien jij het niet in de hand hebt en er niet van kunt afzien, zullen jouw schuldbesef en jouw schulderkenning ten opzichte van die onterechte gezindheid als een impliciete spijtbetuiging, een geheim berouw en een stille bede om vergeving gelden, en jou van haar kwaad redden.
</p>

<p>
Dit thema in deze brief hebben wij uiteindelijk ook geschreven om deze impliciete bede om vergeving tot stand te brengen; opdat onrecht niet wordt gerechtvaardigd en een tegenstander die in zijn recht staat geen ongelijk wordt gegeven.
</p>

</div>'
            ],
            [
                'page_number' => 18,
                'content' => '<div class="page" id="18">
<p class="text-end page-number">#18</p>

<p class="text-bold text-italic">
Een opmerkenswaardige gebeurtenis:
</p>

<p>
Eens had ik als resultaat van een bittere partijdigheid meegemaakt dat een religieuze wetenschapper een vrome geleerde met andere politieke opvattingen zo erg afkraakte, dat hij hem nagenoeg van ongeloof betichtte, terwijl hij een huichelaar die zijn politieke opvattingen steunde eerbiedig prees. Voorwaar, deze kwade gevolgen van de politiek deden mij huiveren; ik zei: <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">اَعُوذُ بِاللّٰهِ مِنَ الشَّيْطَانِ وَ السِّيَاسَةِ‌</span>. Sindsdien heb ik afstand van het politieke leven genomen.
</p>

<p class="text-center text-red small-title"><strong>Het Vijfde Opzicht</strong></p>

<p class="text-center text-bold">
Dit opzicht verklaart dat koppigheid en<br>
partijdigheid uiterst verderfelijk voor het<br>
gemeenschapsleven zijn.
</p>

<p>
<span class="text-bold">Stelling:</span><span class="text-italic"> “In een Hadîth is het volgende overgeleverd: </span> <sup>2</sup><span class="text-arabic-inline" dir="rtl" lang="ar">اِخْتِلَافُ اُمَّتٖى رَحْمَةٌ</span>. <span class="text-italic">Onenigheid vergt echter partijdigheid.</span>
</p>

<p class="text-italic">
<strong>Bovendien</strong> redt de kwaal van onenigheid het onderdrukte burgervolk van het kwaad dat de wreedaardige elites uitoefenen. Want wanneer de elites in een gemeente of dorp zich samenbundelen, dan tiranniseren zij de onderdrukte burgers. Als er partijdigheid is, dan kan een onderdrukte toevlucht tot een partij nemen en zichzelf redden.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Ik neem toevlucht tot ALLAH tegen de duivel en tegen de politiek.”
</p>

<p class="footnote-p">
<sup>2</sup> “Onenigheid onder mijn oemma is een genade.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 19,
                'content' => '<div class="page" id="19">
<p class="text-end page-number">#19</p>

<p class="text-italic">
<strong>Bovendien</strong> kan de waarheid dankzij gedachtewisselingen en botsende ideeën in haar volle glorie aan het licht komen.”
</p>

<p class="text-bold">
Het antwoord
</p>

<p>
<span class="text-italic">Op de eerste stelling zeggen wij:</span> met de onenigheid in de Hadîth wordt een gunstige onenigheid bedoeld. Met andere woorden, bij een dergelijke onenigheid wijdt eenieder zich aan de verbetering en bestendiging van zijn eigen weg. Men ijvert niet voor de verwoesting en ontkrachting, maar voor de bevordering en herstelling van andermans weg. Een ongunstige onenigheid daarentegen, waarbij er onderling verbitterd en vijandig geijverd wordt om elkaar te gronde te richten, is uit het oogpunt van de Hadîth verwerpelijk. Immers, zij die onderling ruziën, kunnen niet gunstig handelen.
</p>

<p>
<span class="text-italic">Op de tweede stelling zeggen wij:</span> als partijdigheid in de naam van rechtvaardigheid plaatsvindt, dan kan ze een houvast voor de rechtvaardigen zijn. Echter, de hedendaagse bittere partijdigheden die namens het ego plaatsvinden, vormen een houvast en steunpunt voor valsaards. Immers, wanneer een bitter partijdige man door de duivel wordt benaderd en met sympathie voor zijn opvattingen steun van hem ondervindt, dan zal die man die duivel genade toewensen. Als een engelachtige man tot de tegenpartij toetreedt, dan zal die man hem zo’n onrecht aandoen, dat hij hem wel – God verhoede – zou kunnen vervloeken.
</p>

</div>'
            ],
            [
                'page_number' => 20,
                'content' => '<div class="page" id="20">
<p class="text-end page-number">#20</p>

<p>
<span class="text-italic">Op de derde stelling zeggen wij:</span> bij gedachtewisselingen die in de naam van rechtvaardigheid, ten dienste van de waarheid worden gehouden, is iedereen qua doel en essentie eendrachtig; alleen wat strategie betreft zijn ze onenig. Door alle aspecten van een waarheid te onthullen, kunnen ze rechtvaardigheid en de waarheid dienen. Echter, partijdige en bittere gedachtewisselingen die op basis van het gefaraoniseerde en kwaadgezinde ego pronkerig en roemzuchtig worden gehouden, doen geen waarheidslichten schitteren, maar vuren van oproer opvlammen. Immers, hoewel het doel eendracht behoeft, is er zelfs op aarde nergens een raakvlak tussen de gedachten van zulke personen te bekennen. Omdat gerechtigheid niet wordt beoogd, zal er een grenzeloos radicalisme plaatsvinden, wat tot onherstelbare verdeeldheden leidt. De toestand van de wereld getuigt hiervan.
</p>

<p class="text-bold">
Conclusie
</p>

<p>
Als de verheven principes:

<sup>3</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">۞ وَالْحُكْمُ لِلّٰهِ</span><sup>2</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">۞ وَالْبُغْضُ فِى اللّٰهِ</span><sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَلْحُبُّ لِلّٰهِ</span>niet als beweegredenen worden gehanteerd, dan zullen huichelarij en verdeeldheid de gelegenheid aangrijpen.

Waarlijk, als men geen:

<sup>3</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">۞ وَالْحُكْمُ لِلّٰهِ </span>
<sup>2</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَلْبُغْضُ فِى اللّٰهِ </span> zegt en die principes niet voor ogen houdt, dan zal hij ongeacht zijn rechtvaardige intenties onrecht plegen.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Liefhebben omwille van ALLAH.”
</p>

<p class="footnote-p">
<sup>2</sup> “Verafschuwen omwille van ALLAH.”
</p>

<p class="footnote-p">
<sup>3</sup> “Het oordeel behoort ALLAH toe.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 21,
                'content' => '<div class="page" id="21">
<p class="text-end page-number">#21</p>

<p class="text-bold text-italic">
Een gedenkwaardige gebeurtenis:
</p>

<p>
Tijdens een strijd had imam Ali <span class="text-arabic-inline honorific" dir="rtl" lang="ar">رضي الله عنه</span> een kafir op de grond gesmeten. Net toen hij zijn zwaard had geheven om hem de laatste slag toe te brengen, spuugde die kafir in zijn gezicht. Daarop liet hij die kafir gaan; hij maakte hem niet dood. Die kafir vroeg:
</p>

<p class="text-italic">
“Waarom heb je mij niet gedood?”
</p>

<p>
Imam Ali zei: <span class="text-italic">“Ik zou jou omwille van ALLAH doden. Echter, jij hebt op mij gespuugd, waardoor ik door woede werd overmand. Omdat mijn ego een aandeel in mijn daad kreeg, werd mijn oprechtheid aangetast. Daarom heb ik jou niet gedood.”</span>
</p>

<p>
Daarop zei de kafir: <span class="text-italic">“Ik spuugde op jou zodat jij mij uit woede een snelle dood zou schenken. Aangezien jullie religie zo zuiver en puur is, kan die religie niet anders dan waarachtig zijn.”</span>
</p>

<p class="text-bold text-italic">
Een opmerkenswaardige gebeurtenis:
</p>

<p>
Eens werd een rechter door zijn rechtvaardige superieur in de gaten gehouden toen hij de hand van een dief eraf sneed. Omdat hij tekenen van woede toonde, werd hij van zijn taak ontheven. Want als hij namens de Sharia, ten dienste van Gods Wet zou snijden, dan zou zijn ego medelijden met de dief hebben. En tijdens het snijden zou hij in zijn hart geen woede, maar ook geen mededogen koesteren. Omdat hij dus een aandeel in dat oordeel aan zijn ego had gegeven, had hij zijn taak niet rechtmatig volbracht.
</p>

</div>'
            ],
            [
                'page_number' => 22,
                'content' => '<div class="page" id="22">
<p class="text-end page-number">#22</p>

<p class="text-bold text-italic">
Een treurige gemeenschappelijke gesteldheid en een ernstige ziekte binnen het gemeenschapsleven die het hart van de Islam tot huilen brengt:
</p>

<p>
<span class="text-italic">“Wanneer externe vijanden verschijnen en aanvallen, moeten interne vetes gestaakt en vergeten worden.”</span> Zelfs de primitiefste stammen waarderen en beogen dit gemeenschapsbelang. Wat mankeren degenen die deze moslimgemeenschap beweren te dienen dan, dat zij – <span class="text-italic">ondanks de aanwezigheid van talloze vijanden die achter elkaar in aanvalshouding paraat staan</span> – persoonlijke vetes niet vergeten en zodoende de vijand de gelegenheid geven om toe te slaan? Deze gesteldheid is een verval, een barbarij en een verraad ten aanzien van het Islamitische gemeenschapsleven.
</p>

<p class="text-bold text-italic">
Een gedenkwaardig verhaal:
</p>

<p>
Het Bedoeïnische volk van Hasenan had ooit twee stammen die vijanden van elkaar waren. Hoewel zij wel meer dan vijftig man van elkaar hadden gedood, vergaten die twee stammen hun oude vetes wanneer zij oog in oog met stammen van volken zoals Sipkan en Hayderan kwamen te staan; op dat moment streden ze schouder aan schouder en brachten zij hun interne vetes niet in herinnering voordat ze dat volk van buitenaf hadden verdreven.
</p>

<p>
Voorwaar, o gelovigen! Hebben jullie wel een idee hoeveel vijandige volkeren met kwade intenties zich tegen het gelovige volk hebben gekeerd? Er zijn meer dan honderd van zulke kringen die jullie als concentrische cirkels hebben omsingeld.
</p>

</div>'
            ],
            [
                'page_number' => 23,
                'content' => '<div class="page" id="23">
<p class="text-end page-number">#23</p>

<p>
Ondanks dat het noodzakelijk is om tegenover elk daarvan hand in hand een verdedigingshouding aan te nemen, siert het de gelovigen toch niet om hun aanval te vergemakkelijken en nagenoeg de poorten tot het heilige centrum van de Islam voor ze te openen door in een bittere partijdigheid en een koppige vijandschap te blijven volharden? Vanaf de dwaalgeesten en de atheïsten, tot aan de wereld van de heidenen, tot aan de aardse angsten en tegenslagen, begeven zich binnen die vijandige kringen wel zeventig soorten vijanden die achter elkaar in een dreigende houding gulzig en bloeddorstig naar jullie staren.
</p>

<p>
Tegenover al deze vijanden vind jij jouw krachtige wapen, jouw schild en jouw burcht binnen de Islamitische broederschap. Doorzie hoe gewetenloos en hoe ongunstig het is voor de Islam om deze Islamitische burcht door simpele vijandigheden en smoesjes aan het wankelen te brengen, en kom tot inkeer!
</p>

<p class="text-bold text-italic">
In een Hadîth-i Sharîf is het volgende overgeleverd:
</p>

<p>
De extreme onheilbrengers uit de eindtijd zoals de Soefyaan en de Dedjâl die aan het hoofd van de huichelaars en de heidenen zullen staan, zullen de hebzucht en de verdeeldheid onder de moslims en de mensen uitbuiten, en met weinig inspanning de mensheid in het verderf storten, en de enorme Islamitische wereld in hechtenis nemen.
</p>

<p>
O gelovigen! Als jullie niet schandelijk in gevangenschap willen vervallen, kom dan tot inkeer!
</p>

</div>'
            ],
            [
                'page_number' => 24,
                'content' => '<div class="page" id="24">
<p class="text-end page-number">#24</p>

<p>
Tegenover de wreedaards die jullie onenigheid uitbuiten, behoren jullie in de heilige burcht van: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اِنَّمَا الْمُؤْمِنُونَ اِخْوَةٌ</span> te treden en toevlucht te zoeken. Anders kunnen jullie noch voor jullie leven, noch voor jullie rechten opkomen. Het is bekend dat een kind twee krijgers die met elkaar strijden kan overmeesteren. Als twee bergen elkaar op een balans in evenwicht houden, dan kan een kleine steen hun evenwicht verstoren en met ze spelen; hij kan de ene berg omhoog en de andere berg omlaag halen.
</p>

<p>
Voorwaar, o gelovigen! Door jullie gulzigheden en jullie vijandige partijdigheden zal jullie kracht vergaan; jullie kunnen dan met weinig inspanning verpletterd worden. Indien jullie waarde hechten aan jullie gemeenschapsleven, maak dan een levensprincipe van het verheven principe:
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin-top: 0">
اَلْمُؤْمِنُ لِلْمُؤْمِنِ كَالْبُنْيَانِ الْمَرْصُوصِ يَشُدُّ بَعْضُهُ بَعْضًا <sup>2</sup>
</p>

<p>
opdat jullie van ontbering op aarde en van kwelling in het hiernamaals worden gered!
</p>

<p class="text-center text-red small-title"><strong>Het Zesde Opzicht</strong></p>

<p>
Het spirituele leven en de zuiverheid van dienaarschap worden door vijandschap en koppigheid aangetast. Want het middel tot bevrijding en de sleutel van verlossing bestaande uit oprechtheid raakt daardoor verloren.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Voorzeker, de gelovigen zijn elkaars broeders.”
</p>

<p class="footnote-p">
<sup>2</sup> “De band tussen gelovigen is als een stevig gebouw dat zijn elementen bijeenhoudt.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 25,
                'content' => '<div class="page" id="25">
<p class="text-end page-number">#25</p>

<p>
Immers, een partijdige dwarsligger zal met zijn weldaden zijn tegenstander willen overtreffen, waardoor hij er niet vaak in kan slagen om daden puur omwille van ALLAH te verrichten. En als het aankomt op zijn keuzes en zijn omgang, zal hij zijn medestander bevoorrechten en niet rechtvaardig kunnen handelen.
</p>

<p>
Voorwaar, de essentie van heilzame daden en handelingen, bestaande uit oprechtheid en rechtvaardigheid, gaat door haat en vijandschap verloren.
</p>

<p>
Dit <span class="text-bold">Zesde Opzicht</span> is vrij lang. Maar omdat het te veel voor dit thema wordt, houden wij het kort.
</p>

</div>'
            ],
            [
                'page_number' => 26,
                'content' => '<div class="page" id="26">
<p class="text-end page-number">#26</p>

<div class="text-center page-title-chapter delima-font">
        <h2>Het Tweede Thema</h2>
    </div>

<p class="text-center text-arabic-bismillah" dir="rtl" lang="ar">
<img src="/images/bismillah .svg" alt="Bismillah" class="bismillah-svg bismillah-svg-light">
<img src="/images/bismillah-dark.svg" alt="Bismillah" class="bismillah-svg bismillah-svg-dark">
<span class="fn-ref-wrap"><span class="fn-ref-word"></span><button class="fn-ref" type="button" aria-label="Voetnoot 1" data-fn="1" data-html="&lt;p class=&quot;footnote-p fn-popover__para&quot;&gt;
 “In de Naam van ALLAH, de Barmhartige, de Genadige.”
&lt;/p&gt;"><sup>1</sup></button></span>
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar">
﴿ اِنَّ اللّٰهَ هُوَ الرَّزَّاقُ ذُو الْقُوَّةِ الْمَتٖينُ ﴾ <sup>2</sup>
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar">
﴿ وَكَاَيِّنْ مِنْ دَٓابَّةٍ لَا تَحْمِلُ رِزْقَهَا اَللّٰهُ يَرْزُقُهَا وَاِيَّاكُمْ وَ هُوَ السَّمٖيعُ الْعَلٖيمُ ﴾ <sup>3</sup>
</p>

<p>
O gelovigen! Uit het vorige thema hebben jullie kunnen afleiden hoe schadelijk vijandschap is. Besef ook dat hebzucht evenals vijandschap een uiterst kwaadaardige ziekte voor het Islamitische leven is. Hebzucht is een oorzaak van falen, ze is een kwaal en een verval, en ze brengt ontbering en ellende met zich mee.
</p>

<p>
Waarlijk, alle schande en ellende die zich voordoen bij de Joden, waarover bekend is dat zij de wereld hebzuchtiger dan alle andere volkeren bestormen, vormen een onwrikbare bevestiging van dit standpunt.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “In de Naam van ALLAH, de Barmhartige, de Genadige.”
</p>

<p class="footnote-p">
<sup>2</sup> “Voorzeker, ALLAH is de Onderhouder, Bezitter van Stabiele Kracht.” - Qur’an, 51:58
</p>

<p class="footnote-p">
<sup>3</sup> “En hoeveel dieren dragen hun onderhoud niet met zich mee? ALLAH voorziet hen en jou in onderhoud; en Hij is de Alhorende, de Alwetende.” - Qur’an, 29:60
</p>

</div>

</div>'
            ],
            [
                'page_number' => 27,
                'content' => '<div class="page" id="27">
<p class="text-end page-number">#27</p>

<p>
Waarlijk, vanaf de wijdste kringen tot aan het specifiekste individu binnen de wereld der levenden, overal toont hebzucht haar negatieve werking. Een gelaten verzoek om onderhoud daarentegen vormt een bron van rust en toont overal zijn positieve werking.
</p>

<p>
Voorwaar, onder de levenssoorten die behoeftig zijn aan onderhoud, tonen de vruchtdragende bomen en planten geen hebzucht door op hun plek gelaten en tevreden af te wachten, waardoor hun onderhoud zich naar ze toesnelt. Ze verzorgen heel wat meer nakomelingen dan dieren. Dieren daarentegen rennen hebzuchtig achter hun onderhoud aan, waardoor ze met geweldige inspanning gebrekkig onderhoud vergaren.
</p>

<p>
En de borelingen binnen de kring van het dierenrijk, die in de taal van hun machteloze en behoeftige houding gelatenheid uitdrukken, krijgen vanuit de Weelde der Genadige geoorloofd, fraai en voortreffelijk onderhoud aangereikt, terwijl roofdieren die hun onderhoud hebzuchtig bestormen met enorme moeite ongeoorloofd en onaangenaam onderhoud verwerven. Dit toont aan dat hebzucht een oorzaak van ontbering is, terwijl gelatenheid en tevredenheid genademiddelen zijn.
</p>

<p>
En binnen de kring der mensheid is er geen volk dat zich met zoveel hebzucht aan de wereld vastklampt en zich met zoveel hartstocht aan het aardse leven bindt als het Joodse volk.
</p>

</div>'
            ],
            [
                'page_number' => 28,
                'content' => '<div class="page" id="28">
<p class="text-end page-number">#28</p>

<p>
Het ongeoorloofde rente-kapitaal waar de Joden slechts schatbewaarders van zijn, baat ze weinig, hoewel zij het met enorme moeite vergaren. De klap van schande en ellende, moord en verraad die ze daardoor van alle volken hebben opgelopen, laat zien dat hebzucht een bron van schande en verlies is.
</p>

<p>
Tevens zijn er zoveel incidenten waarbij een hebzuchtige persoon in verlies vervalt, dat de uitspraak: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَلْحَرٖيصُ خَائِبٌ خَاسِرٌ</span> spreekwoordelijk is geworden en door iedereen als een universele waarheid wordt beschouwd. Mocht jij dus veel liefde voor bezit koesteren, streef dan niet met hebzucht maar met tevredenheid naar bezit, opdat het jou rijkelijk toevloeit.
</p>

<p>
Tevreden mensen en hebzuchtige mensen lijken op twee personen die de ontvangstzaal van een adel binnentreden. De ene zegt in zijn hart:
</p>

<p class="text-italic">
“Als hij mij slechts welkom heet en ik van de kou buiten word gered, dan ben ik allang tevreden. Al zou hij mij de laagste zetel aanwijzen, dan is dat alsnog een gunst.”
</p>

<p>
De tweede persoon gedraagt zich alsof hij ergens recht op heeft en iedereen hem eerbied verschuldigd is. Hij zegt: <span class="text-italic">“Mij hoort de hoogste zetel gegeven te worden.”</span>
</p>

<p>
Hij treedt met die gretigheid binnen, richt zijn blik op hoge posities en wenst daar een plek voor zichzelf in te nemen.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Hebzucht baart teleurstelling en verlies.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 29,
                'content' => '<div class="page" id="29">
<p class="text-end page-number">#29</p>

<p>
De gastheer daarentegen stuurt hem terug en wijst hem een lagere zetel aan. Hoewel hij daarvoor dankbaar hoort te zijn, koestert hij geen dank maar woede in zijn hart. In plaats van de gastheer te bedanken, bekritiseert hij hem. Dientengevolge knapt de gastheer op hem af.
</p>

<p>
De eerste persoon treedt bescheiden binnen en neemt plaats op een laag geplaatste zetel. Die tevredenheid van hem behaagt de gastheer, waarna de heer het volgende verzoekt: <span class="text-italic">“Kom, neem plaats op een hogere zetel.”</span> Daarop betuigt hij meer dank, terwijl zijn tevredenheid toeneemt naarmate hij vordert.
</p>

<p>
Voorwaar, deze wereld is een ontvangstzaal van de Barmhartige. Het aardoppervlak is een tafel van Genadigheid. De onderhoudsniveaus en gunstgehaltes gelden als zetels.
</p>

<p>
Ook kan iedereen bij zelfs de simpelste zaken de negatieve werking van hebzucht vernemen. Bijvoorbeeld, wanneer twee bedelaars om iets bedelen, dan zal iedereen in zijn hart vernemen dat de opdringerige bedelaar afkeer opwekt, waardoor men geneigd is om hem niets te geven, terwijl de kalme bedelaar mededogen opwekt, waardoor men geneigd is om hem tegemoet te komen.
</p>

<p>
Of wanneer jij bijvoorbeeld ’s avonds je slaap verliest terwijl jij wilt slapen, dan kun je slaap krijgen als jij je daar nonchalant tegenover opstelt. Als jij met de gedachte: <span class="text-italic">“Ik moet slapen, ik moet slapen!”</span> jouw slaap gretig terug wilt winnen, dan zal je slaap jou volledig ontglippen.
</p>

</div>'
            ],
            [
                'page_number' => 30,
                'content' => '<div class="page" id="30">
<p class="text-end page-number">#30</p>

<p>
Of wanneer jij bijvoorbeeld voor een belangrijke uitslag gretig op iemand wacht, dan kan de gedachte: <span class="text-italic">“Waar blijft hij, waar blijft hij!”</span> ertoe leiden dat jouw gretigheid jouw geduld op den duur uitput, waarna jij opstaat en vertrekt. Een minuut later arriveert de man, maar de belangrijke uitslag waar jij op wachtte loop je mis...
</p>

<p class="text-center text-bold text-italic" style="max-width: 400px; margin: 18px auto">
Het geheim achter deze omstandigheden is het volgende:
</p>

<p>
Zoals de totstandkoming van brood afhankelijk is van een akker, een oogst, een molen en een oven, schuilt er ook achter de totstandkoming van zaken een tactische wijsheid. Omdat een hebzuchtig mens tactloos handelt, legt hij de figuurlijke treden voor de totstandkoming van zaken niet af; óf hij springt en valt, óf hij slaat een trede over, waardoor hij zijn doel niet kan bereiken.
</p>

<p>
Voorwaar, o broeders die door financiële zorgen en wereldse hebzucht zijn versuft! Hoe kunnen jullie, ondanks dat hebzucht zo verderfelijk en vervloekt is, alsnog op het pad van hebzucht aan allerlei schandelijkheden toegeven, en zonder rekening te houden met wat haram en wat halal is allerlei goederen aannemen, en vele zaken die benodigd zijn voor het hiernamaals daaraan prijsgeven? En hoe kunnen jullie een belangrijke zuil van de Islam alias <span class="text-bold">“de Zakaat”</span> op het pad van hebzucht verzaken?
</p>

<p>
De Zakaat dient tevens voor ieder individu als een middel tot zegeningen en een verdrijver van onheil.
</p>

</div>'
            ],
            [
                'page_number' => 31,
                'content' => '<div class="page" id="31">
<p class="text-end page-number">#31</p>

<p>
Degene die de Zakaat verzaakt, zal hoe dan ook een bezit ter waarde van de Zakaat inleveren; óf hij zal het aan onnozele zaken verkwisten, óf een tegenslag zal het hem ontnemen. Tijdens het vijfde jaar van de Eerste Wereldoorlog werd mij in een waarachtig visioen het volgende gevraagd: <span class="text-italic">“Waaraan hebben de moslims deze hongersnood, dit vermogensverlies en deze fysieke afmattingen te danken?”</span>
</p>

<p>
In dat visioen zei ik: <span class="text-italic">“De Hoogste Gerechtigde had ons verzocht om een tiende<sup>1</sup> of een veertigste<sup>2</sup> van bepaalde bezittingen die Hij ons had geschonken af te staan, opdat het ons de heilbeden van de armen zou verschaffen, en geen wrok en jaloezie in ze zouden opborrelen. Wij hebben door onze hebzucht gierig gehandeld en geen gehoor aan Zijn verzoek gegeven. Daarop heeft de Hoogste Gerechtigde de opgehoopte Zakaat <span class="text-bold">(dertig veertigste en acht tiende)</span> ingevorderd.</span>
</p>

<p class="text-italic">
Daarnaast had Hij ons verzocht om slechts één maand per jaar te voldoen aan een honger waarin zeventig wijsheden schuilen. Wij hadden medelijden met ons ego, waarop wij een kortstondige en prettige honger niet hadden verdragen. Als straf heeft de Hoogste Gerechtigde ons vijf jaar lang dwangmatig een zeventigvoudig vervloekte vorm van vasten laten verrichten.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> Een tiende van de bezittingen die Hij jaarlijks vers schenkt, zoals tarwe.
</p>

<p class="footnote-p">
<sup>2</sup> Deze veertig duidt op wat Hij vroeger heeft geschonken, vanwaaruit Hij jaarlijks via bijvoorbeeld handelswinst of veefokkerij weer meestal minstens tien vers schenkt.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 32,
                'content' => '<div class="page" id="32">
<p class="text-end page-number">#32</p>

<p class="text-italic">
Daarnaast had Hij ons verzocht om slechts één van de vierentwintig uren aan een fraaie en hemelse, een stralende en bevorderlijke training des Heren te wijden. Wij hadden lui gehandeld, en de salâts en gebeden niet uitgevoerd. Dat ene uur hadden wij aan de overige uren toegevoegd en verkwist. Ter vergelding heeft de Hoogste Gerechtigde ons vijf jaar lang middels militaire trainingen, oefeningen en missies een zekere vorm van salât laten verrichten.”
</p>

<p>
Vervolgens kwam ik tot mezelf, dacht ik na en zag ik in dat er een opzienbarende waarheid in dat visioen schuilde.
</p>

<p>
In <span class="text-bold">“Het Vijfentwintigste Woord”</span>, in het gedeelte over de afwegingen tussen de moderne beschaving en de Qur’anische Standpunten, is aangetoond en opgehelderd dat de bron van alle zedeloosheden en oproeren uit twee begrippen bestaat.
</p>

<p>
<span class="text-bold">Het ene begrip:</span> <span class="text-italic">“Zolang ik verzadigd ben, maakt het mij niet uit dat een ander sterft van de honger.”</span>
</p>

<p>
<span class="text-bold">Het tweede begrip:</span> <span class="text-italic">“Jij werkt, ik eet.”</span>
</p>

<p>
Hetgeen deze twee begrippen doet standhouden, bestaat uit de invoering van de rente en de verzaking van de Zakaat.
</p>

<p>
Deze twee vreselijke gemeenschappelijke ziektes kunnen alleen genezen worden als de Zakaat als een gemeenschappelijke norm wordt aanvaard, en het Zakaat-gebod en het renteverbod worden ingevoerd.
</p>

</div>'
            ],
            [
                'page_number' => 33,
                'content' => '<div class="page" id="33">
<p class="text-end page-number">#33</p>

<p>
Bovendien is de Zakaat een essentieel fundament voor het levensgeluk van niet alleen individuen en bepaalde groeperingen, maar van de gehele mensheid… de Zakaat is zelfs een onmisbare grondslag voor de voortgang van het mensenleven. Immers, de elites en de burgers vormen de twee klassen binnen de mensheid. Het middel dat bij de elites mededogen en weldadigheid jegens de burgers, en bij de burgers eerbied en gehoorzaamheid jegens de elites zal opwekken, is de Zakaat. Anders zal er vanboven onrecht en onderdrukking op de burgers neerdalen, terwijl er wrok en opstand van de burgers naar de rijken zal rijzen. De twee mensenklassen zullen voortdurend in een spirituele strijd en een rumoerige onenigheid verkeren. Op den duur kan er zoals in Rusland een strijd tussen arbeid en kapitaal ontstaan.
</p>

<p>
O edele en gewetensvolle bevorderaars! O gulle en genereuze begunstigers! Als aalmoezen niet in naam van de Zakaat worden gegeven, dan baart dat drie nadelen. Soms kunnen ze zelfs vergeefs vergaan. Immers, omdat jij niet namens ALLAH doneert, impliceer jij dat de ontvanger afhankelijk van jou is, waardoor jij een keuzeloze arme in gevoelens van afhankelijkheid gevangen houdt. Tevens word jij van zijn aanvaarde beden onthouden. En ondanks dat jij eigenlijk een distributeur bent die het eigendom van de Hoogste Gerechtigde aan Zijn onderdanen behoort te verstrekken, acht jij jezelf eigenaar, waardoor jij Gods Begunstiging ontkent.
</p>

</div>'
            ],
            [
                'page_number' => 34,
                'content' => '<div class="page" id="34">
<p class="text-end page-number">#34</p>

<p>
Indien jij in naam van de Zakaat verstrekt, dan verstrek jij namens de Hoogste Gerechtigde, waardoor jij een zegen verwerft en een dank jegens Zijn Begunstiging betoont. En doordat de behoeftige niet tot vleierij wordt gedwongen, blijft zijn trots ongedeerd en wordt zijn bede voor jou aanvaard.
</p>

<p>
Waarlijk, is het beter om een bedrag gelijk aan of hoger dan de Zakaat via giften of andere soorten onverplichte liefdadigheden te doneren, en zodoende schijnheiligheid en roem, afhankelijkheid en schandelijkheid, en dergelijke verderfenissen te kweken? Of is het beter om die weldadigheden in naam van de Zakaat te realiseren en zodoende zowel een Goddelijk Gebod in acht te nemen als zegeningen, oprechtheid en aanvaarde beden te verwerven?
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin-top: 0">
﴿ سُبْحَانَكَ لَا عِلْمَ لَنَٓا اِلَّا مَا عَلَّمْتَنَٓا اِنَّكَ اَنْتَ الْعَلٖيمُ الْحَكٖيمُ ﴾ <sup>1</sup>
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “U bent Feilloos. Buiten hetgeen U ons hebt onderwezen, beschikken wij over geen kennis. Voorzeker, U bent de Alwetende, de Alwijze.” - Qur’an, 2:32
</p>

</div>

</div>'
            ],
            [
                'page_number' => 35,
                'content' => '<div class="page" id="35">
<p class="text-end page-number">#35</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin: 0px auto 0 auto; max-width: 500px;">
اَللّٰهُمَّ صَلِّ وَ سَلِّمْ عَلٰى سَيِّدِنَا مُحَمَّدٍ الَّذٖى قَالَ «اَلْمُؤْمِنُ لِلْمُؤْمِنِ كَالْبُنْيَانِ الْمَرْصُوصِ يَشُدُّ بَعْضُهُ بَعْضًا» وَ قَالَ «اَلْقَنَاعَةُ كَنْزٌ لَا يَفْنٰى» وَعَلٰى اٰلِهٖ وَصَحْبِهٖ اَجْمَعٖينَ اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <sup>1</sup>
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “O ALLAH, laat zegeningen en vrede neerdalen op onze meester Mohammed, die eigenaar is van de uitspraak: <span class="text-italic">‘De band tussen gelovigen is als een stevig gebouw dat zijn elementen bijeenhoudt.’</span> en de uitspraak: <span class="text-italic">‘Tevredenheid is een onuitputtelijke schat.’</span> en op al zijn familieleden en metgezellen evenzeer; âmîn... en de lof zij ALLAH, Heer der werelden.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 35,
                'content' => '<div class="page" id="35">
<p class="text-end page-number">#35</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin:0 auto; max-width: 500px;">
اَللّٰهُمَّ صَلِّ وَ سَلِّمْ عَلٰى سَيِّدِنَا مُحَمَّدٍ<sub style="margin-right: 0px;margin-left: -5px; font-size: 55%; vertical-align: sub; line-height: 0;">نِ</sub> الَّذٖى قَالَ: اَلْمُؤْمِنُ لِلْمُؤْمِنِ كَالْبُنْيَانِ الْمَرْصُوصِ يَشُدُّ بَعْضُهُ بَعْضًا وَ قَالَ: اَلْقَنَاعَةُ كَنْزٌ لَا يَفْنٰى وَعَلٰى اٰلِهٖ وَصَحْبِهٖ اَجْمَعٖينَ اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <sup>1</sup>
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “O ALLAH, laat zegeningen en vrede neerdalen op onze meester Mohammed, die eigenaar is van de uitspraak: <span class="text-italic">‘De band tussen gelovigen is als een stevig gebouw dat zijn elementen bijeenhoudt.’</span> en de uitspraak: <span class="text-italic">‘Tevredenheid is een onuitputtelijke schat.’</span> en op al zijn familieleden en metgezellen evenzeer; âmîn... en de lof zij ALLAH, Heer der werelden.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 36,
                'content' => '<div class="page" id="36">
<p class="text-end page-number">#36</p>

<div class="text-center page-title-chapter delima-font">
        <h2>Slot</h2>
    </div>

<p class="text-red small-title text-center" style="margin-bottom: 0">
<strong>Aangaande roddelen</strong>
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin: 0 auto;">
بِاسْمِهٖ <sup>1</sup> ۞ وَ اِنْ مِنْ شَىْءٍ اِلَّا يُسَبِّحُ بِحَمْدِهٖ <sup>2</sup>
</p>

<p style="margin-top: 18px">
In <span class="text-bold">“Het Vijfde Punt”</span> van <span class="text-bold">“De Eerste Straal”</span> uit <span class="text-bold">“De Eerste Sprankel”</span> van <span class="text-bold">“Het Vijfentwintigste Woord”</span>, waar voorbeelden van de veroordelende en verhoedende categorie worden gegeven, wordt verklaard hoe één enkele Aya op een miraculeuze wijze op zes manieren een afkeer tegen roddelen bezorgt. Omdat daar volwaardig wordt getoond hoe verachtelijk roddelen volgens de visie van de Qur’an is, heeft het geen behoefte aan verdere verheldering nagelaten. <span class="text-bold">Waarlijk, na een verheldering van de Qur’an is verdere verheldering ondoenlijk evenals onnodig.</span>
</p>

<p>
Voorwaar, in de Aya: <sup>3</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَيُحِبُّ اَحَدُكُمْ اَنْ يَاْكُلَ لَحْمَ اَخٖيهِ مَيْتًا</span> wordt veroordelen in zes opzichten veroordeeld; vanuit zes invalshoeken wordt de mens dringend van roddelen verhoed.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “In Zijn Naam; Hij is Feilloos.”
</p>

<p class="footnote-p">
<sup>2</sup> “En er is niets, of het prijst Hem met lof.” - Qur’an, 17:44
</p>

<p class="footnote-p">
<sup>3</sup> “Is er dan één onder jullie die ervan houdt om het vlees van zijn dode broer te eten?” - Qur’an, 49:12
</p>

</div>

</div>'
            ],
            [
                'page_number' => 37,
                'content' => '<div class="page" id="37">
<p class="text-end page-number">#37</p>

<p>
Indien deze Aya rechtstreeks aan roddelaars wordt geadresseerd, dan omvat Hij de volgende betekenis:
</p>

<p>
Het is bekend dat de <span class="text-bold">“Hemze”</span> aan het begin van de Aya een vragende betekenis <span class="text-italic">(in dan-vorm)</span> heeft. Die vragende betekenis kan als water alle woorden van de Aya invloeien. In ieder woord schuilt een impliciet standpunt.
</p>

<p style="margin-bottom: 0px">
<span class="text-bold">Voorwaar, ten eerste zegt de Aya met de Hemze:</span>
</p>

<p class="text-italic" style="margin-top: 0px">
“Hebben jullie dan geen verstand waar vragen en antwoorden zetelen, dat jullie zoiets afgrijselijks niet doorzien?”
</p>

<p style="margin-bottom: -7px">
<span class="text-bold">Ten tweede zegt Hij met de term</span> <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">يُحِبُّ</span>:
</p>

<p class="text-italic" style="margin-top: 0px">
“Is jullie hart waarin liefde en haat zetelen dan bedorven, dat jullie zoiets hatelijks liefhebben?”
</p>

<p style="margin-bottom: -7px">
<span class="text-bold">Ten derde zegt Hij met het woord</span> <sup>2</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَحَدُكُمْ</span>:
</p>

<p class="text-italic"  style="margin-top: 0px">
“Wat mankeert er dan aan jullie sociale leven en jullie beschaving die hun leven aan de gemeenschap te danken hebben, dat jullie een daad die zo giftig is voor jullie leven accepteren?”
</p>

<p style="margin-bottom: -7px">
<span class="text-bold">Ten vierde zegt Hij met de uitspraak</span> <sup>3</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَنْ يَاْكُلَ لَحْمَ</span>:
</p>

<p class="text-italic"  style="margin-top: 0px">
“Wat is er dan met jullie menselijkheid gebeurd, dat jullie als beesten jullie vriend met jullie tanden verscheuren?”
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Die ervan houdt”
</p>

<p class="footnote-p">
<sup>2</sup> “Eén onder jullie”
</p>

<p class="footnote-p">
<sup>3</sup> “Om vlees te eten”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 38,
                'content' => '<div class="page" id="38">
<p class="text-end page-number">#38</p>

<p style="margin-bottom: -7px">
<span class="text-bold">Ten vijfde zegt Hij met het woord</span> <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَخٖيهِ</span>:
</p>

<p class="text-italic" style="margin-top: 0px">
“Voelen jullie dan helemaal geen naastenliefde... geen verwantschap... dat jullie de spirituele persoonlijkheid van een weerloos individu, dat in vele opzichten jullie broeder is, meedogenloos verslinden? En hebben jullie dan helemaal geen verstand, dat jullie met jullie eigen tanden jullie eigen orgaan vermalen?”
</p>

<p style="margin-bottom: -7px">
<span class="text-bold">Ten zesde zegt Hij met de uitspraak</span> <sup>2</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">مَيْتًا</span>:
</p>

<p class="text-italic" class="text-italic" style="margin-top: 0px">
“Waar is jullie geweten? Zijn jullie dan ontaard, dat jullie je jegens een hoogst eerbiedwaardige broeder met zo’n uiterst misselijke daad als kannibalen gedragen?”
</p>

<p>
Al bij al concludeert de Aya met Zijn formulering evenals de diverse standpunten binnen Zijn woorden dat veroordelen en roddelen volgens de maatstaven van het verstand, het hart, het mens-zijn, het geweten en het volk verwerpelijk zijn.
</p>

<p>
Voorwaar, aanschouw hoe deze Aya op een vloeiende wijze veroordelen in zes opzichten veroordeelt en op een miraculeuze wijze vanuit zes invalshoeken van die overtreding verhoedt.
</p>

<p>
Roddels zijn een geniepig wapen dat vooral vijandige, jaloerse en stijfkoppige mensen hanteren. Iemand met eigenwaarde zal zich nimmer tot het hanteren van dit verachtelijke wapen verlagen. Zoals een bekend persoon ooit zei:
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Zijn broer”
</p>

<p class="footnote-p">
<sup>2</sup> “Dode”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 39,
                'content' => '<div class="page" id="39">
<p class="text-end page-number">#39</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin-bottom: -10px">
اُكَبِّرُ نَفْسٖى عَنْ جَزَاءٍ بِغِيْبَةٍ
۞</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar">
فَكُلُّ اِغْتِيَابٍ جَهْدُ مَنْ لَا لَهُ جَهْدٌ
۞</p>

<p>
Oftewel, <span class="text-italic">“Mijn vijand met roddels bestraffen, is een daad waarboven ik verheven ben en waartoe ik mij nimmer zal verlagen. Roddels zijn immers het wapen van zwakke, gluiperige en geniepige zielenpoten.”</span>
</p>

<p class="text-bold">
Roddelen houdt het volgende in:
</p>

<p>
Als de persoon waarover geroddeld wordt aanwezig zou zijn en het gesprokene zou aanhoren, dan zou hij zich daaraan storen en zich gekwetst voelen. Als het gesprokene waar is, dan valt dat per definitie onder roddelen. Indien het gesprokene onwaar is, dan is dat zowel een roddel als een laster; het is dan een lelijke tweelaagse zonde.
</p>

<p>
Roddelen kan onder enkele uitzonderlijke omstandigheden geoorloofd zijn.
</p>

<p>
<span class="text-bold">Een omstandigheid:</span> iemand kan klagen bij een bevoegde persoon omdat hij vals van iets wordt beschuldigd, opdat de bevoegde hem kan helpen om hem van die valse verdenking en beschuldiging te zuiveren, en hij voor zijn rechten kan opkomen.
</p>

<p>
<span class="text-bold">Een andere omstandigheid:</span> iemand wil met een persoon samenwerken en met jou daarover overleggen. Om het overleg recht te doen, kun jij zonder haatgevoelens, puur om zijn bestwil, een uitspraak doen als: <span class="text-italic">“Niet met hem samenwerken, want het zal slecht voor jou uitpakken.”</span>
</p>

</div>'
            ],
            [
                'page_number' => 40,
                'content' => '<div class="page" id="40">
<p class="text-end page-number">#40</p>

<p>
<span class="text-bold">Een andere omstandigheid:</span> niet om iemand te beledigen en belachelijk te maken, maar om iemand te beschrijven en kenbaar te maken, kun je bijvoorbeeld zeggen: <span class="text-italic">“Die ene manke gek is daarheen gegaan.”</span>
</p>

<p>
<span class="text-bold">Een andere omstandigheid:</span> de persoon waarover geroddeld wordt, is een openlijke zondaar. Dat wil zeggen dat hij zich niet druk om zijn overtredingen maakt, maar veeleer pronkt met de zonden die hij bedrijft; hij haalt plezier uit zijn wandaden die hij schaamteloos openlijk pleegt.
</p>

<p>
Voorwaar, onder deze specifieke omstandigheden kunnen roddels zonder inmenging van haatgevoelens puur ten dienste van rechtvaardigheid en welvarendheid geoorloofd zijn. Anders zullen roddels, zoals vuur hout aanvreet en verteert, vrome daden aanvreten en verteren. Als iemand een roddel heeft bijgewoond of willens heeft aangehoord, dan behoort hij: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَللّٰهُمَّ اغْفِرْلَنَا وَ لِمَنِ اغْتَبْنَاهُ</span> te zeggen. Vervolgens, wanneer hij de persoon waarover geroddeld is aantreft, dan dient hij: <span class="text-italic">“Vergeef mij”</span> te zeggen.
</p>

<p class="text-arabic delima-font text-red" dir="rtl" lang="ar" style="text-align: right;text-indent: 0;margin-bottom: -5px;margin-top: 0">
اَلْبَاقٖى هُوَ الْبَاقٖى <sup>2</sup>
</p>

<p class="text-red text-italic"  style="text-align: right;text-indent: 0">
Said Nursî
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “O ALLAH, vergeef ons en degene waarover wij hebben geroddeld.”
</p>

<p class="footnote-p">
<sup>2</sup> “De Eeuwige, Hij is de Eeuwige.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 41,
                'content' => '<div class="page" id="41">
<p class="text-end page-number">#41</p>

<div class="page-title-chapter">
<h2>Dit Gedeelte Is Zeer Belangrijk</h2>
</div>

<p>
De Hoogste Gerechtigde heeft op basis van Zijn Volmaakte Generositeit, Genade en Rechtvaardigheid een directe beloning in weldaden en een directe bestraffing in wandaden gevestigd. Hij heeft in deugden geestelijke genietingen gevestigd die de zegeningen uit het hiernamaals in herinnering brengen, terwijl Hij in zonden geestelijke straffen heeft gevestigd die de kwellingen uit het hiernamaals doen vernemen.
</p>

<p>
<span class="text-bold">Bijvoorbeeld</span>, liefde onder de gelovigen is voor de gelovigen een mooie weldaad. Binnen die weldaad is een geestelijke genieting, een geneugte en een hartverheffende verademing gevestigd die aan de fysieke zegeningen uit het hiernamaals doen denken. Iedereen die zijn hart raadpleegt, zal dit genot waarnemen.
</p>

<p>
<span class="text-bold">Bijvoorbeeld</span>, haat en vijandschap onder de gelovigen is een zonde. Binnen die zonde zullen nobele zielen een gewetenskwelling vernemen die het hart en de ziel van benauwenissen doet stikken. Ik heb bij mezelf wel meer dan honderdmaal ervaren dat ik tijdens een moment waarop ik vijandig was jegens een geloofsbroeder zodanig werd gekweld, dat ik zonder enige twijfel door die vijandschap een directe bestraffing onderging.
</p>

</div>'
            ],
            [
                'page_number' => 42,
                'content' => '<div class="page" id="42">
<p class="text-end page-number">#42</p>

<p>
<span class="text-bold">Bijvoorbeeld,</span> eerbiedwaardige individuen eerbiedigen en genadewaardige mensen meedogend behandelen en ten dienste staan, is een deugd; een weldaad. Deze deugd die de zegeningen uit het hiernamaals doet waarnemen, herbergt een dusdanige genieting en geneugte, dat ze een eerbied en mededogen opwekken waarvoor men zijn leven zou opofferen. Het genot en de beloning die een moeder via haar mededogen voor haar kind verwerft, brengen haar tot het punt waarop ze haar leven op dat pad van mededogen zou opofferen. In het dierenrijk belichaamt een kip die een leeuw aanvalt om haar kuiken te redden een voorbeeld van deze waarheid. Aldus schuilt er een directe beloning in mededogen en eerbied. Edelmoedige en nobele mensen nemen dit waar, waardoor zij zich heldhaftig opstellen.
</p>

<p>
<span class="text-bold">Ook schuilt in bijvoorbeeld</span> hebzucht en overdaad een dusdanige straf, dat de weeklachten, de zorgen, de mentale kwelling en de hartenpijn die aan die straf ontspruiten de mens versuffen. En in afgunst en jaloezie schuilt een directe bestraffing waarbij die afgunst de afgunstige verteert. En in gelatenheid en tevredenheid schuilt een dusdanige beloning, dat die behaaglijke en directe zegen de vloek en ellende van armoede en behoeftigheid wegneemt.
</p>

<p>
<span class="text-bold">Ook schuilt in bijvoorbeeld</span> egotripperij en grootdoenerij een dusdanig zware last, dat de egotripper die van iedereen eerbied verwacht, juist door die verwachting mensen van zich afstoot, waardoor hij aldoor kwelling ondergaat.
</p>

</div>'
            ],
            [
                'page_number' => 43,
                'content' => '<div class="page" id="43">
<p class="text-end page-number">#43</p>

<p>
Waarlijk, eerbied wordt je gegeven, daar hoor je niet om te vragen.
</p>

<p>
<span class="text-bold">Ook schuilt in bijvoorbeeld</span> bescheidenheid en in de intoming van het ego een dusdanig behaaglijke beloning, dat ze de mens van een zware last en van een koude gekunsteldheid redt.
</p>

<p>
<span class="text-bold">Ook schuilt in bijvoorbeeld</span> wantrouwigheid en kwaaddenkerij een directe bestraffing. Volgens het principe: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">مَنْ دَقَّ دُقَّ</span> zal degene die wantrouwt, zelf worden gewantrouwd. De handelingen van degenen die de handelingen van hun geloofsbroeders negatief beoordelen, zullen spoedig ook negatief worden beoordeeld; zodoende zullen zij worden bestraft. Enzovoort... alle weldadige en zondige karaktereigenschappen behoren volgens deze maatstaven te worden afgewogen.
</p>

<p>
Bij Gods Gratie hoop ik dat degenen die in deze tijden aan de hand van de Risale-i Nur de Qur’anische Miraculeusheid hebben geproefd, deze geestelijke genietingen waarnemen; inshâ’ALLAH zullen zij niet aan een kwaad karakter toegeven.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> Een uitdrukking als: “Wie de bal kaatst, kan hem terug verwachten.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 44,
                'content' => '<div class="page" id="44">
<p class="text-end page-number">#44</p>

<div class="page-title-chapter">
<h2>Het Derde Punt</h2>
</div>

<p class="text-center text-bold" style="max-width: 500px; margin: 0 auto;">
Een omschrijving van een satanische list die het
menselijke gemeenschapsleven verziekt:
</p>

<p style="margin-top: 18px;">
Met één enkele zonde van een gelovige bedekt de duivel al zijn weldaden. Onredelijke woestelingen die gehoor aan deze satanische list geven, koesteren vervolgens vijandschap jegens die gelovige.
</p>

<p>
Echter, wanneer de Hoogste Gerechtigde na de wederopstanding de toerekenbare daden op Zijn Ultieme Balans volgens Absolute Rechtvaardigheid afweegt, dan oordeelt Hij op basis van het over- of onderwicht van weldaden ten opzichte van wandaden. En omdat zonden vele aanleidingen hebben en eenvoudig bedreven kunnen worden, bedekt Hij soms met één enkele weldaad vele van zijn zonden.
</p>

<p>
Aldus dient de omgang op deze wereld op die Goddelijke Rechtvaardigheid te worden afgestemd. Als iemands deugden zijn zondigheden kwantitatief of kwalitatief overtreffen, dan verdient diegene liefde en respect. Eén waardevolle weldaad behoeft zelfs dat vele van zijn zonden door de vingers worden gezien.
</p>

<p>
Echter, de mens kan met zijn ingeschapen vermogen tot kwaad doen op advies van satan honderd weldaden van iemand door één enkele zonde vergeten, vijandschap tegen zijn geloofsbroeder koesteren en in zonden vervallen.
</p>

</div>'
            ],
            [
                'page_number' => 45,
                'content' => '<div class="page" id="45">
<p class="text-end page-number">#45</p>

<p>
Zoals een vliegenvleugel een berg kan bedekken wanneer die op een oog terechtkomt, kan de mens uit nijd met één zonde ter grootte van een vliegenvleugel een berg aan weldaden bedekken en vergeten, vijandschap tegen zijn geloofsbroeder koesteren en tot een giftig instrument voor het menselijke gemeenschapsleven verworden.
</p>

<div class="page-title-chapter">
<h2>Het Vierde Woord</h2>
</div>

<p>
Al mijn levenservaringen en bevindingen rondom het menselijke gemeenschapsleven hebben mij tot de volgende definitieve conclusie gebracht:
</p>

<p class="text-italic">
De eigenschap die bovenal liefde verdient, is liefde... en de eigenschap die bovenal vijandschap verdient, is vijandschap...
</p>

<p>
Met andere woorden, de eigenschap die het bestaan van het menselijke gemeenschapsleven mogelijk maakt en gelukzaligheid verschaft, bestaande uit liefde en waardering, is bovenal liefde en waardering waard. En haat en vijandschap waaraan het menselijke gemeenschapsleven ten onder gaat, belichamen een lelijke en verderfelijke eigenschap die bovenal haat, vijandschap en vermijding waard is.
</p>

<p>
Omdat deze waarheid in <span class="text-bold">“De Tweeëntwintigste Brief”</span> van de Risale-i Nur is verklaard, zullen wij hier kort daarover spreken.
</p>

</div>'
            ],
            [
                'page_number' => 46,
                'content' => '<div class="page" id="46">
<p class="text-end page-number">#46</p>

<p>
De tijd van haat en vijandschap is voorbij. De twee wereldoorlogen hebben laten zien hoe verderfelijk, destructief en vreselijk onrechtvaardig vijandschap is. Het is gebleken dat ze niets heilzaams met zich meebrengt. Aldus dienen de zonden van onze vijanden – <span class="text-italic">zolang zij geen rechten schenden</span> – geen vijandschap in jullie op te wekken. De hel en de Goddelijke Bestraffing is genoeg voor ze...
</p>

<p>
Soms kan de mens uit trots en egoïsme onbewust ongegrond vijandschap tegen gelovigen koesteren, terwijl hij zichzelf daartoe gerechtigd acht. Echter, met deze haat en vijandschap geeft hij aan dat hij het geloof, de Islam, het mens-zijn en dergelijke krachtige redenen om gelovigen lief te hebben licht opvat en onderwaardeert. Dit is een dwaasheid waarbij de loze redenen om vijandschap te koesteren de voorkeur genieten boven de geweldige redenen om lief te hebben.
</p>

<p>
Aangezien liefde en vijandschap in contrast met elkaar zijn en – <span class="text-italic">evenals licht en duisternis</span> – niet in hun ware vorm verenigd kunnen worden, zal de eigenschap waarvan de oorzaken domineren in haar ware vorm in het hart zetelen; de ware vorm van haar contrast zal niet aanwezig zijn.
</p>

<p>
<span class="text-bold text-italic">Bijvoorbeeld,</span> als ware liefde aanwezig is, dan zal vijandschap in mededogen en medelijden omslaan. Zo hoort de gesteldheid tegenover gelovigen te zijn. Of als ware vijandschap in het hart zetelt, dan zal liefde in tolerantie, in onverschilligheid en in een schijnvriendschap veranderen.
</p>

</div>'
            ],
            [
                'page_number' => 47,
                'content' => '<div class="page" id="47">
<p class="text-end page-number">#47</p>

<p>
Deze gesteldheid kan tegenover de dwaalgeesten die geen rechten schenden worden aangenomen.
</p>

<p>
Waarlijk, redenen om lief te hebben, zoals geloof, Islam en humaniteit, zijn lumineuze en krachtige ketenen en geestelijke burchten. Redenen tot vijandschap jegens gelovigen bestaan uit enkele specifieke punten die zo miezerig zijn als kiezelsteentjes. Aldus begaat degene die ware vijandschap jegens een gelovige koestert een enorme fout door impliciet de redenen tot liefde ter grootte van bergen licht op te vatten.
</p>

<p>
<span class="text-bold">Tot slot:</span> liefde, broederschap en waardering belichamen de aard en het bindmiddel van de Islam. Vijandige mensen lijken op een ontaard kind dat wil janken en iets zoekt om te kunnen janken. Bijgevolg wordt iets dat zo waardeloos is als een vliegenvleugel een excuus voor zijn gejank. Tevens lijken zij op een pessimist die niet optimistisch zal zijn zolang negatieve interpretaties mogelijk zijn. Met één zonde bedekt zo iemand tien weldaden. Dit wordt echter verworpen door redelijkheid en optimisme, wat eigenschappen zijn die tot de Islamitische karakteristieken behoren.
</p>

</div>'
            ],
            [
                'page_number' => 48,
                'content' => '<div class="page" id="48">
<p class="text-end page-number">#48</p>

<p class="text-bold">
Mijn geachte, loyale broeders!
</p>

<p>
Ik wil jullie vertellen over een verontrusting waardoor mijn ziel plotseling werd aangegrepen. Omdat de dwaalgeesten de diamanten zwaarden van de Risale-i Nur niet kunnen aanvechten, heb ik aangevoeld en ingezien dat zij met behulp van financiële zorgen en verleidingen van het lenteseizoen zwaktes uit de verschillen in de mentaliteiten of gemoedstoestanden onder de Nur-studenten willen vinden om hun saamhorigheid te verstoren. Sta dit absoluut niet toe! Wees extra op jullie hoede, opdat er geen tweedracht tussen jullie wordt gezaaid. Een mens kan niet feilloos zijn. Echter, de poort tot vergiffenis staat open.
</p>

<p>
Wanneer het ego en de duivel jullie aansporen om tegen jullie broeder in te gaan en gegronde kritiek op hem uit te oefenen, zeg dan: <span class="text-italic">“Wij zijn niet alleen verplicht om zulke simpele rechten van ons, maar zelfs ons leven, onze waardigheid en onze wereldse welvaart aan het krachtigste bindmiddel van de Risale-i Nur bestaande uit saamhorigheid op te offeren. Gezien het resultaat dat ze ons oplevert, is het onze taak om alles wat met de wereld en met het ego te maken heeft op te offeren.”</span> Leg zodoende jullie ego het zwijgen op. Mocht er een geschilpunt zijn, overleg daar dan over. Wees niet te strikt; niet iedereen heeft dezelfde mentaliteit. Momenteel is het noodzakelijk om verdraagzaam jegens elkaar te zijn.
</p>

<p class="text-italic">
Wij wensen al onze broeders één voor één selâm toe.
</p>

<p class="text-red text-italic" style="text-indent: 0; text-align: right">
Said Nursî
</p>

</div>'
            ],
            [
                'page_number' => 49,
                'content' => '<div class="page" id="49">
<p class="text-end page-number">#49</p>

<p class="text-center text-bold">
Ik zal jullie over een broederschapsprincipe vertellen<br>
dat jullie serieus in acht moeten nemen.
</p>

<p>
Leven is het resultaat van eenheid en eendrachtigheid. Op het moment dat de harmonische eendrachtigheid vergaat, zal het spirituele leven evenzeer vergaan.
</p>

<p>
Zoals: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">وَلَا تَنَازَعُوا فَتَفْشَلُوا وَتَذْهَبَ رٖيحُكُمْ</span> aangeeft, zal het verval van saamhorigheid de sfeer van de gemeenschap bederven. Jullie weten dat drie Elifs<sup>2</sup> een getalwaarde van drie krijgen als ze afzonderlijk worden geschreven. Als ze volgens een numerieke saamhorigheid bijeenkomen, dan zullen ze een getalwaarde van honderdelf krijgen. Ook wanneer drie à vier waarheidsdienaars zoals jullie afzonderlijk, zonder onderlinge taakverdeling te werk gaan, dan zal hun kracht gelijk aan drie à vier man zijn. Als zij een ware broederschap praktiseren, saamhorig trots op elkaars gaven zijn, elkaar volgens het eenwordingsgeheim <span class="text-italic">(tefânî)</span> als absolute gelijke achten en zodoende handelen, dan zullen die vier dienaren de kracht en waarde van vierhonderd man verwerven.
</p>

<p>
Jullie dienen als de machinisten van een elektrisch netwerk waarmee niet alleen de grote stad Isparta, maar een enorm land wordt verlicht. De tandwielen van een machine zijn genoodzaakt om met elkaar samen te werken.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “En verval onderling niet tot onenigheid, anders zal angst jullie overmannen en jullie kracht verloren gaan.” - <em>Qur’an, 8:46</em>
</p>

<p class="footnote-p">
<sup>2</sup> Noot van de vertalers: dit is de eerste letter van het Arabische alfabet die tevens de getalwaarde van één heeft.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 50,
                'content' => '<div class="page" id="50">
<p class="text-end page-number">#50</p>

<p>
Tevens zullen de tandwielen met uitblinkende krachten bij de anderen geen jaloezie maar juist genoegen opwekken. Een tandwiel dat wij bewust achten, zou blij worden als hij een sterker tandwiel dan hijzelf zou aantreffen; zijn taak wordt immers dankzij hem verlicht. Zij die ten dienste van gerechtigheid, de waarheid, de Qur’an en het geloof een verheven schat op hun schouders dragen, zullen trots, erkentelijk en dankbaar reageren wanneer zij door sterkere schouders worden ondersteund.
</p>

<p>
Nooit mogen jullie de poort tot onderlinge kritiek ontgrendelen! Buiten jullie broeders om zijn er genoeg kringen die van kritiekpunten overvloeien. Ik ben trots op jullie talenten. Wanneer die talenten bij mij ontbreken, dan ben ik blij dat jullie over ze beschikken en acht ik ze als de mijne. Ook jullie dienen met de blik van jullie leermeester naar elkaar te kijken. Eenieder van jullie behoort als het ware de verspreider van elkanders talenten te zijn.
</p>

<p>
Het broederschapsgevoel dat onze broeder Hâfız Ali Efendi uit İslâmköy jegens een andere eventueel concurrente broeder had getoond, acht ik bijzonder waardevol. Daarom zal ik jullie daarover vertellen.
</p>

<p>
Toen hij mij kwam bezoeken, had ik gezegd dat het handschrift van de andere broeder mooier dan zijn handschrift was. Ik zei dat het schrijfwerk van de andere broeder meer dienst zou verrichten. Ik zag dat Hâfız Ali werkelijk welgemeend en oprecht trots was op en plezier haalde uit het uitblinkende talent van van de andere broeder.
</p>

</div>'
            ],
            [
                'page_number' => 51,
                'content' => '<div class="page" id="51">
<p class="text-end page-number">#51</p>

<p>
En omdat hij daarenboven de genegen blik van zijn leermeester ving, werd hij met tevredenheid vervuld. Ik vestigde mijn aandacht op zijn hart en merkte op dat hij niet huichelde… ik voelde aan dat hij oprecht was.
</p>

<p>
Ik dankte de Alhoge ALLAH om de aanwezigheid van broeders die zulke verheven gevoelens koesteren. Inshâ’ALLAH zal dit gevoel grote diensten vervullen. <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span>, langzaamaan begint dit gevoel op broeders uit onze omgeving over te gaan.
</p>

<p class="text-center text-arabic delima-font text-red" style="margin: 0">
بِاسْمِهٖ سُبْحَانَهُ <sup>2</sup>
</p>

<p class="text-bold">
Mijn geachte, loyale broeders!
</p>

<p>
In deze wereld, vooral in deze tijden, geldt met name voor slachtoffers van tegenslagen en in het bijzonder voor de Nur-studenten, dat zij tegenover de vreselijke verdrukkingen en radeloosheden waaraan ze blootstaan de effectiefste genezing kunnen ontmoeten wanneer zij elkaar troosten en verademing geven, elkaars geestelijke kracht versterken, elkaars pijn, verdriet en leed als ware toegewijde broeders verzachten en de gegriefde gemoederen met pure mededogen strelen. De ware broederschap onder ons die op het hiernamaals is gefundeerd, kan geen ruzie en partijdigheid verdragen.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “De lof zij ALLAH.”
</p>

<p class="footnote-p">
<sup>2</sup> “In Zijn Naam; Hij is Feilloos.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 52,
                'content' => '<div class="page" id="52">
<p class="text-end page-number">#52</p>

<p>
Met al mijn kracht heb ik mij in volle vertrouwen op jullie verlaten. Jullie weten en constateren dat ik heb besloten om niet alleen mijn rust, mijn waardigheid en mijn eer, maar zelfs mijn leven met genoegen voor jullie op te offeren. Tevens zweer ik jullie dat mijn hart de afgelopen acht dagen kwelling ondergaat vanwege een onbeduidende kwestie waarbij twee pilaren van onze Nur-dienst zich ogenschijnlijk aanstellerig tegenover elkaar gedragen en elkaar treiteren in plaats van elkaar te troosten. Huiverend hebben mijn ziel, mijn hart en mijn verstand het volgende uitgehuild:
</p>

<p class="text-italic">
“<sup>1</sup><span style="font-style: normal;" class="text-arabic-inline text-red" dir="rtl" lang="ar">اَلْاَمَانُ، اَلْاَمَانُ</span>, O Genadigste der Genadigen... sta ons bij! Behoed ons! Bevrijd ons van het onheil dat de demonische en menselijke duivels zaaien! Vervul de harten van mijn broeders met pure wederzijdse loyaliteit, liefde, broederschap en mededogen!”
</p>

<p>
O mijn broeders die zo onbuigzaam zijn als ijzer! Sta mij terzijde... onze kwestie is uiterst delicaat. Omdat ik veel vertrouwen in jullie had gesteld, had ik al mijn taken aan jullie geestelijke persoonlijkheid overgelaten. Hierop dienen jullie je dringend met al jullie kracht te haasten om mij bij te staan.
</p>

<p>
Al was jullie frictie zeer beperkt, kortstondig en klein, alsnog kan zelfs een haartje of stofdeeltje schade berokkenen als het op het veertje van ons uurwerk of op de pupil van ons oog belandt.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Sta ons bij, sta ons bij!”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 53,
                'content' => '<div class="page" id="53">
<p class="text-end page-number">#53</p>

<p>
Voorzorg in dit kader is zodanig van belang, dat drie materiële explosies en drie immateriële bevestigingen exact hierover hebben bericht.
</p>

<p style="text-align: right;" class="text-italic text-red">
Said Nursî
</p>

<p class="text-center text-arabic delima-font text-red" style="margin: 0;">
بِاسْمِهٖ سُبْحَانَهُ <sup>1</sup>
</p>

<p>
Het is noodzakelijk voor ons geworden om binnen de kring der mogelijkheden met al onze kracht de principes uit <span class="text-bold">“De Flits der Oprechtheid”</span> en het geheim achter ware oprechtheid onderling en wederzijds na te leven.
</p>

<p>
Ik heb betrouwbare informatie ontvangen over drie mannen die sinds de afgelopen drie maanden speciaal zijn ingeschakeld om hier de band tussen vooraanstaande broeders te verkillen door het verschil in hun mentaliteit of gedachtegang uit te buiten. En om de standvastige Nur-studenten zat en van streek te maken, en om de lichtgeraakte en onverdraagzame broeders argwaan in te blazen en van de Nur-dienst te doen laten afzien, stellen ze onze rechtszaak voor niets uit..
</p>

<p>
Wees op jullie hoede! Sta niet toe dat de opofferingsgezinde broederschap en oprechte liefde die jullie tot op heden voor elkaar koesterden tot wankelen wordt gebracht! Zelfs de kleinste tegenslag kan ons enorm schaden.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “In Zijn Naam; Hij is Feilloos.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 54,
                'content' => '<div class="page" id="54">
<p class="text-end page-number">#54</p>

<p>
Aangezien onze missie ten dienste van de Qur’an en het geloof vereist dat wij – <span class="text-italic">indien nodig</span> – zelfs onze zielen voor elkaar opofferen, zullen frustraties of andere oorzaken die prikkelbaarheden baren, ware toegewijde broeders uiteraard nimmer uiteendrijven; met een volwaardige ingetogenheid, bescheidenheid en overgave zullen zij veeleer de verantwoordelijkheid van alle onaangenaamheden opeisen, en ijveren om hun liefde en toewijding te versterken. Anders kunnen simpele zaken worden opgeblazen en in onherstelbare schade uitmonden. Ik laat het voor de rest aan jullie inzicht over en houd het kort.
</p>

<p class="text-red text-italic" style="text-align: right;text-indent: 0">
Said Nursî
</p>

</div>'
            ],
            [
                'page_number' => 55,
                'content' => '<div class="page" id="55">
<p class="text-end page-number">#55</p>

<p class="text-bold text-italic">
Ik verzoek het volgende van mijn broeders:
</p>

<p class="text-italic">
Akelige en lelijke woorden die vrienden vanwege frustraties, benauwde zielsgesteldheden, geprikkeldheden, toegeeflijkheden jegens egoïstische en satanische listen of onnadenkendheden uitspreken, behoren geen redenen te zijn om elkaar de rug toe te keren en gedachten als “Mijn trots is gekrenkt” tot uiting te brengen. Ik neem die kwalijke woorden op mij; erger je er dus niet aan. Al zou ik duizend vormen van trots bezitten, alsnog zou ik ze aan de wederzijdse liefde en toewijding onder mijn broeders opofferen.
</p>

<p class="text-red text-italic" style="text-align: right;text-indent: 0">
Said Nursî
</p>

</div>'
            ],
            [
                'page_number' => 57,
                'content' => '<div class="page" id="57">
<p class="text-end page-number">#57</p>

<div class="text-center page-title-chapter delima-font">
        <h2>De Twintigste Flits</h2>
    </div>

<p class="text-red small-title text-center">
<strong>Aangaande Oprechtheid</strong>
</p>

<p style="text-align: justify; text-indent: 0;">
Hoewel dit traktaat <span class="text-bold">Het Eerste Punt</span> van <span class="text-bold">De Vijf Punten</span> uit <span class="text-bold">De Tweede Kwestie</span> van <span class="text-bold">De Zeven Kwesties</span> uit <span class="text-bold">De Zeventiende Nota</span> van <span class="text-bold">De Zeventiende Flits</span> was, is het vanwege zijn belang: <span class="text-bold">De Twintigste Flits</span> geworden.
</p>

<p class="text-center text-arabic-bismillah" dir="rtl" lang="ar">
<img src="/images/bismillah .svg" alt="Bismillah" class="bismillah-svg bismillah-svg-light">
<img src="/images/bismillah-dark.svg" alt="Bismillah" class="bismillah-svg bismillah-svg-dark">
<span class="fn-ref-wrap"><span class="fn-ref-word"></span><button class="fn-ref" type="button" aria-label="Voetnoot 1" data-fn="1" data-html="&lt;p class=&quot;footnote-p fn-popover__para&quot;&gt;
 “In de Naam van ALLAH, de Barmhartige, de Genadige.”
&lt;/p&gt;"><sup>1</sup></button></span>
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin: 18px auto 0 auto; max-width: 450px;">
﴿ اِنَّٓا اَنْزَلْنَٓا اِلَيْكَ الْكِتَابَ بِالْحَقِّ فَاعْبُدِ اللّٰهَ مُخْلِصًا لَهُ الدّٖينَ ۞ اَلَا لِلّٰهِ الدّٖينُ الْخَالِصُ ﴾ <sup>2</sup>
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin: 0px auto 0 auto; max-width: 500px;">
هَلَكَ النَّاسُ اِلَّا الْعَالِمُونَ وَهَلَكَ الْعَالِمُونَ اِلَّا الْعَامِلُونَ وَهَلَكَ الْعَامِلُونَ اِلَّا الْمُخْلِصُونَ وَالْمُخْلِصُونَ عَلٰى خَطَرٍ عَظٖيمٍ <sup>3</sup>
</p>

<p class="text-center text-arabic delima-font text-red" dir="rtl" lang="ar" style="margin: -8px auto 0 auto; max-width: 500px;font-size: 25px">
﴿ اَوْ كَمَا قَالَ ﴾
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “In de Naam van ALLAH, de Barmhartige, de Genadige.”
</p>

<p class="footnote-p">
<sup>2</sup> “Voorzeker, Wij hebben jou het Boek met de waarheid neergezonden; dien ALLAH, beleid Zijn religie oprecht. Weet dat alleen de zuivere religie ALLAH toebehoort.” - Qur’an, 39:2-3
</p>

<p class="footnote-p">
<sup>3</sup> “De mensheid is verdoemd, behalve de geleerden... de geleerden zijn verdoemd, behalve de praktiserenden... de praktiserenden zijn verdoemd, behalve de oprechten... en de oprechten begeven zich in groot gevaar.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 58,
                'content' => '<div class="page" id="58">
<p class="text-end page-number">#58</p>

<p>
Zowel de voornoemde Aya als de daaropvolgende Hadîth-i Sharîf laten zien wat voor een belangrijke grondslag oprechtheid binnen de Islam is. Uit de vele subtiliteiten omtrent deze oprechtheidskwestie zullen wij slechts <span class="text-bold">“Vijf Punten”</span> bondig uiteenzetten.
</p>

<p class="text-red small-title text-center">
<strong>Opmerking</strong>
</p>

<p class="text-bold">
In deze gezegende stad Isparta heerst een fraaie voorspoed die dank doet betuigen. Want vergeleken met andere streken valt hier tussen de Godvrezenden, de Soefi\'s en de geleerden geen concurrentiële onenigheid te bemerken. Al moet ik bekennen dat de benodigde ware liefde en eendracht hier ook ontbreken, alsnog is hier ten opzichte van andere gebieden geen sprake van een kwaadaardige verdeeldheid en rivaliteit.
</p>

<p class="text-red small-title text-center">
<strong>Het Eerste Punt</strong>
</p>

<p class="text-bold text-italic">
Een belangrijke en aangrijpende vraag:
</p>

<p class="text-italic">
“Hoe is het mogelijk dat de aardsgezinden, de onachtzamen en zelfs de dwalers en de huichelaars zonder wedijver eendrachtig kunnen zijn, terwijl de Godsdienstfunctionarissen, de geleerden en de soefi-mystici die rechtschapen en welgezind zijn, wedijverig in onenigheid vervallen? De welgezinden hebben recht op eendracht en de huichelaars verdienen verdeeldheid. Waarom is desondanks dat recht tot de tegenpartij overgegaan, terwijl die ongerechtigheid ons heeft bereikt?”
</p>

</div>'
            ],
            [
                'page_number' => 59,
                'content' => '<div class="page" id="59">
<p class="text-end page-number">#59</p>

<p>
<span class="text-bold">Het antwoord:</span> Uit de vele redenen van deze kwellende, ellendige en verderfelijke toestand die volksvrienden tot tranen beroert, zullen wij <span class="text-bold">zeven redenen</span> uiteenzetten.
</p>

<p class="text-red small-title text-center">
<strong>De Eerste Reden</strong>
</p>

<p class="text-bold" >
Zoals de onenigheid tussen de rechtschapenen niet uit onwaarheden is voortgekomen, is de eendracht tussen de dwaalgeesten evenmin aan waarheden ontsproten.
</p>

<p>
Het is veeleer zo dat de aardsgezinden, de politici, de onderwijsmensen en dergelijke leden van groepen, partijen en organisaties met een bepaalde taak en een specifieke dienst binnen zekere lagen van de maatschappij, elk een functie bekleedt die is geclassificeerd en gespecificeerd. Ook het salaris dat ze als materiële vergoeding evenals de aandacht van mensen<sup>1</sup> die ze ter bevrediging van liefde voor status en aanzien als immateriële vergoeding voor hun taken ontvangen, is geclassificeerd en gespecificeerd.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> <span class="text-bold">Waarschuwing:</span> de aandacht van mensen hoort niet gevraagd maar gegeven te worden. Als ze wordt verkregen, dan mag er niet van genoten worden. Als iemand daarvan geniet, dan zal hij zijn oprechtheid verliezen en beginnen te huichelen. De aandacht van mensen die op basis van roem en eerzucht wordt verkregen, is geen vergoeding en beloning, maar veeleer een berisping en een bestraffing vanwege het gemis aan oprechtheid. Waarlijk, een aandacht, eer en aanzien waaronder het leven van vrome daden bestaande uit oprechtheid lijdt, leveren tijdelijk tot aan de poort van het graf een vluchtig genot op, waartegenover ze aan de andere kant van het graf als kwelling in het graf tot een lelijke gedaante metamorfoseren. Aldus dient de aandacht van mensen niet gewenst, maar gevreesd en vermeden te worden. Mogen de oren suizen van degenen die aan roemzucht lijden en degenen die eer en faam najagen.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 60,
                'content' => '<div class="page" id="60">
<p class="text-end page-number">#60</p>

<p>
Deelname in dit kader baart geen sabotage, geschil en rivaliteit. Het maakt dus niet uit hoe kwaadaardig de weg is waarop zij voortgaan, zij kunnen altijd eendrachtig zijn.
</p>

<p>
Echter, wat de Godsdienstfunctionarissen, de geleerden en de soefi-mystici betreft, elk van hen bekleedt een functie die betrekking op de hele gemeenschap heeft. Tevens is hun directe loon niet geclassificeerd en gespecificeerd. Ook op het gebied van status, aandacht en acceptatie is niemands aandeel gespecificeerd. Velen kunnen zich kandidaat voor dezelfde functie stellen. Velen kunnen zich in zowel elke materiële als immateriële vergoeding mengen. Dit baart sabotage en rivaliteit, waardoor saamhorigheid in huichelarij en eendracht in onenigheid omslaat.
</p>

<p>
Voorwaar, het medicijn tegen deze vreselijke ziekte is oprechtheid. Deze oprechtheid kunnen zij bereiken als zij:
</p>

<p style="text-indent: 0">
• Rechtzinnigheid de voorkeur boven zelfzuchtigheid geven;
</p>

<p style="text-indent: 0">
• Het rechtvaardigheidsbelang over het ego en het eigenbelang laten triomferen...
</p>

<p style="text-indent: 0">
• Het geheim achter: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اِنْ اَجْرِىَ اِلَّا عَلَى اللّٰهِ</span> verinnerlijken en van alle zowel materiële als immateriële ververgoedingen van mensen onafhankelijk worden<sup>2</sup>...
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Mijn beloning is enkel bij ALLAH.” - Qur’an, 34:47
</p>

<p class="footnote-p">
<sup>2</sup> Het: <span class="text-arabic-inline text-red" dir="rtl" lang="ar">اٖيثَارٌ</span> attribuut van de Sahaba’s waarover de Qur’an lovend spreekt als leidraad nemen. Dit impliceert: anderen bij het aannemen van liefdadigheden en aalmoezen de voorkeur geven. En materiële winsten die religieuze diensten meebrengen noch begeren, noch in het hart beogen, en ze slechts als Goddelijke giften beschouwen; geen afhankelijkheid jegens mensen voelen en niets ter vergoeding voor religieuze diensten aannemen. Want voor religieuze diensten mag er op aarde niets gewenst worden, opdat oprechtheid niet verloren gaat. Dienaren in dit kader hebben er echter wel recht op dat de oemma hen in hun levensonderhoud voorziet. Ook hebben zij recht op Zakaat. Hier horen zij echter niet om te vragen; dit wordt ze ongevraagd gegeven. En wanneer zij het krijgen, mogen ze niet: <span class="text-italic">“Dit is de vergoeding voor mijn dienst”</span> zeggen. Door zo tevreden mogelijk andere rechthebbenden die het meer verdienen de voorkeur boven henzelf te geven, kunnen zij met inachtneming van het geheim achter: <span class="text-arabic-inline text-red" dir="rtl" lang="ar">وَ يُؤْثِرُونَ عَلٰى اَنْفُسِهِمْ وَلَوْ كَانَ بِهِمْ خَصَاصَةٌ</span> [<span class="text-italic">“En zij prefereren anderen boven henzelf, al verkeren zij zelf in behoeftigheid.” - Qur’an, 59:9</span>] van dit ernstige gevaar gered worden en oprechtheid verwerven.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 61,
                'content' => '<div class="page" id="61">
<p class="text-end page-number">#61</p>

<p>
• Het geheim achter: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">وَمَا عَلَى الرَّسُولِ اِلَّا الْبَلَاغُ</span> verinnerlijken en beseffen dat het verwerven van erkenning, invloed en publieke aandacht tot de taken en gunsten van de Hoogste Gerechtigde behoren, wat hun overdrachtstaak noch includeert, noch behoeft, noch verplicht.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “En de profeet is enkel met overdracht belast.” - Qur’an, 24:54
</p>

</div>

</div>'
            ],
            [
                'page_number' => 62,
                'content' => '<div class="page" id="62">
<p class="text-end page-number">#62</p>

<p class="text-center text-italic">
Worden deze punten niet in acht genomen, dan zal oprechtheid verloren gaan.
</p>

<p class="text-red small-title text-center">
<strong>De Tweede Reden</strong>
</p>

<p class="text-center text-bold">
De laagheid van de dwaalgeesten brengt ze tot eendracht, de trots van de geloofsverkondigers leidt ze tot tweedracht.
</p>

<p>
Met andere woorden, omdat de onachtzamen alias de aardsgezinden en de dwaalgeesten niet op gerechtigheid en waarheid steunen, zijn zij zwak en laag. Hun laagheid baart de behoefte om kracht te vergaren. Deze behoefte leidt ertoe dat zij zich innig aan andermans steun en alliantie vastklampen. Zelfs als zij een dwaalweg aanhouden, blijven zij hun eendracht handhaven. Zij ontwikkelen gewoonweg een gerechtigheid in hun onrecht, een oprechtheid in hun dwaling, een goddeloos fanatisme in hun ongodsdienstigheid en een saamhorigheid in hun huichelarij, waardoor ze succes oogsten. Want zelfs als oprechtheid voor het heilloze wordt gehanteerd, zal dat alsnog niet vruchteloos blijven. Waarlijk, iets dat door iemand oprecht wordt gewenst, zal ALLAH schenken.<sup>1</sup>
</p>

<p>
Echter, wat de geloofsverkondigers, de Godsdienstfunctionarissen, de geleerden en de mystici betreft, omdat zij op gerechtigheid en waarheid berusten, en omdat elk van hen met slechts zijn Heer in gedachte en met vertrouwen in Zijn Gratie individueel op het waarheidspad voortgaat, bezitten zij geestelijk een trots die hun weg verschaft.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> Waarlijk, <span class="text-arabic-inline text-red" dir="rtl" lang="ar">مَنْ طَلَبَ وَ جَدَّ وَجَدَ</span> <span class="text-italic">{Wie zoekt, zal vinden}</span> is een wezenlijk principe. Zijn omvattendheid is verreikend en zijn reikwijdte kan ook onze weg beslaan.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 63,
                'content' => '<div class="page" id="63">
<p class="text-end page-number">#63</p>

<p>
Wanneer één van hen zich zwak voelt, dan zal hij in plaats van mensen zijn Heer raadplegen en Hèm om bijstand vragen. Vanwege de mentaliteitsverschillen zal hij tegenover iemand die indruist tegen de mentaliteit waaraan hij zich houdt de behoefte aan samenwerking niet volwaardig vernemen; hij kan de behoefte aan eendracht niet inzien.
</p>

<p>
Als hij daarenboven ook aan egocentrisme en zelfoverschatting lijdt, dan zal hij wanen dat hij gelijk en zijn tegenstander ongelijk heeft, wat in plaats van eendracht en liefde, tweedracht en rivaliteit tussen hen teweegbrengt. Tenslotte zal hij oprechtheid niet kunnen bereiken en zijn taak volledig te gronde richten.
</p>

<p>
Voorwaar, de rampzalige gevolgen van deze zorgelijke oorzaak kan hij alleen met inachtneming van <span class="text-bold">negen stelregels</span> mijden.
</p>

<p style="padding-left: 1.5em; text-indent: -1.5em;">
1. Positief handelen. Oftewel, handelen uit liefde voor zijn eigen weg. De vijandigheid en minachting van andere wegen mogen geen invloed op zijn denkwijze en zijn kennis uitoefenen; hij hoort zich daar niet mee bezig te houden;
</p>

<p style="padding-left: 1.5em; text-indent: -1.5em;">
2. In gedachte houden dat er tussen iedereen binnen de kring der Islam – <span class="text-italic">ongeacht de mentaliteitsverschillen</span> – vele verbindende factoren zijn die liefde, broederschap en eendracht vereisen om vervolgens eendracht te verwezenlijken;
</p>

</div>'
            ],
            [
                'page_number' => 64,
                'content' => '<div class="page" id="64">
<p class="text-end page-number">#64</p>

<p style="padding-left: 1.5em; text-indent: -1.5em;">
3. Het volgende gewetensprincipe als leidraad nemen: op voorwaarde dat de weg van een ander niet wordt geridiculiseerd, kan elke volger van een waarachtige weg: <span class="text-italic">“Mijn weg is juist”</span> of <span class="text-italic">“Mijn weg is beter”</span> zeggen. Insinueren dat andere wegen onjuist of lelijk zijn met uitingen als: <span class="text-italic">“Alleen mijn weg is juist”</span> of <span class="text-italic">“Alleen onze groepsmentaliteit is voorbeeldig”</span> moet vermeden worden;
</p>

<p style="padding-left: 1.5em; text-indent: -1.5em;">
4. Beseffen dat eendracht met de rechtschapenen een aanleiding tot Gods Gratie en een bron van Godsdienstige glorie is;
</p>

<p style="padding-left: 1.5em; text-indent: -1.5em;">
5. Het volgende inzien: wanneer de dwaalgeesten en de onrechtplegers uit solidariteit collectief een sterke geestelijke persoonlijkheid tot stand brengen en met haar genialiteit aanvallen, dan zal zelfs de sterkste individuele weerstand tegenover die geestelijke persoonlijkheid breken. Vervolgens via eendracht met de rechtschapenen een geestelijke persoonlijkheid tot stand brengen en gerechtigheid tegen die vreselijke geestelijke persoonlijkheid van dwaling beschermen;
</p>

<p style="padding-left: 1.5em; text-indent: -1.5em;">
6. En om de waarheid van valsheid te bevrijden:
</p>

<p style="padding-left: 1.5em; text-indent: -1.5em;">
7. Zijn ego en zijn eigenwaan...
</p>

<p style="padding-left: 1.5em; text-indent: -1.5em;">
8. Zijn misplaatste trots...
</p>

<p style="padding-left: 1.5em; text-indent: -1.5em;">
9. En zijn zinloze competitieve gevoelens achterwege laten.
</p>

</div>'
            ],
            [
                'page_number' => 65,
                'content' => '<div class="page" id="65">
<p class="text-end page-number">#65</p>

<p class="text-center text-italic">
Zodoende kan hij oprechtheid verwerven en zijn taak volwaardig vervullen.<sup>1</sup>
</p>

<p class="text-red small-title text-center">
<strong>De Derde Reden</strong>
</p>

<p class="text-center text-bold">
Noch komt de onenigheid onder de rechtschapenen voort uit onbereidwilligheid en lafhartigheid,
noch komt de eendracht onder de dwalers voort uit een verheven bereidwilligheid.
</p>

<p>
De geloofsverkondigers hebben hun onenigheid veeleer te wijten aan de verkeerde hantering van hun verheven bereidwilligheid, terwijl de dwalers hun eendracht te danken hebben aan de zwakheid en machteloosheid die hun onbereidwilligheid kweekt.
</p>

<p>
Wat de geloofsverkondigers aanleiding geeft om hun verheven bereidwilligheid verkeerd te hanteren en zodoende in onenigheid en rivaliteit te vervallen, bestaat uit een karakteristiek die uit het oogpunt van het hiernamaals prijzenswaardig is, namelijk: gretig zijn naar zegeningen en geen genoegen nemen met taken die op het hiernamaals zijn gericht.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> In een authentieke Hadîth is zelfs vermeld dat in de eindtijd de ware religieuzen onder de Christenen zich met de volgers van de Qur’an zullen alliëren om zich tegen hun gedeelde heidense vijanden staande te houden. Evenzo hebben de Godsdienstfunctionarissen en de waarheidsdienaars niet alleen behoefte aan hechte eendracht met hun geloofsverwanten, dienstgenoten en medebroeders; zij hebben zelfs de behoefte om momenteel de geschilpunten tussen hen en de ware Christelijke geestelijken te negeren en niet te bediscussiëren, opdat ze tegenover hun gedeelde vijand bestaande uit de agressieve heidenen eendrachtig kunnen zijn.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 66,
                'content' => '<div class="page" id="66">
<p class="text-end page-number">#66</p>

<p>
Oftewel, door gedachten als: <span class="text-italic">“Ik wil deze zegen verwerven; ik wil deze mensen discipline toedienen; ik wil gehoord worden...”</span> neemt een geloofsverkondiger jegens een ware broeder en een persoon aan wiens liefde, samenwerking, broederschap en hulp hij daadwerkelijk behoefte heeft een competitieve houding aan. Gedachten als: <span class="text-italic">“Waarom bezoeken mijn studenten hem? Waarom heb ik niet zoveel studenten als hij?”</span> geven zijn ego de gelegenheid om een interesse voor de verworpen karakteristiek: <span class="text-italic">“liefde voor status”</span> in hem op te wekken, waarna oprechtheid vergaat en de poort tot schijnheiligheid opengaat.
</p>

<p>
Voorwaar, de genezing van deze gebrekkigheid, deze wond en deze ernstige zielsziekte schuilt in de volgende formule: <span class="text-italic">“Het Welbehagen van de Hoogste Gerechtigde kan dankzij oprechtheid worden verworven. Een groot aantal volgelingen en veelvoudige successen spelen hierbij geen rol. Zulke zaken behoren immers tot Gods Taken. Aldus behoren ze niet te worden nagestreefd; ze worden zo nu en dan gegund.”</span>
</p>

<p>
Waarlijk, soms kan één enkel woord de reden van iemands redding en de aanleiding tot Gods Welbehagen zijn. Het belang van kwantiteit behoort niet zo’n groot aandachtspunt te zijn. Want soms kan de disciplinering van één persoon God zo behagen als de disciplinering van duizend man.
</p>

<p>
Bovendien vergen oprechtheid en rechtschapenheid dat de bevordering van moslims te allen tijde wordt voorgestaan, ongeacht van waar of van wie het afkomstig is.
</p>

</div>'
            ],
            [
                'page_number' => 67,
                'content' => '<div class="page" id="67">
<p class="text-end page-number">#67</p>

<p>
Anders zijn gedachten als: <span class="text-italic">“Ik wil mensen onderrichten zodat zij mij zegeningen opleveren.”</span> een list van het ego en het ik-complex.
</p>

<p>
O mens die gretig naar zegeningen is en geen genoegen neemt met taken die op het hiernamaals zijn gericht! Er zijn een aantal profeten verschenen die op enkelen na geen volgelingen hadden. Desondanks hebben zij de eindeloze verdiensten van de heilige profetentaak ontvangen. Aldus wordt deugdelijkheid niet door een groot aantal volgelingen, maar door het verwerven van Gods Welbehagen bepaald. Wie denk jij te zijn, dat jij zo gretig met de gedachte <span class="text-italic">“Iedereen moet naar mij luisteren!”</span> je eigen taak vergeet en je met Gods Taak bemoeit? Acceptatie creëren en het volk rondom jou verzamelen zijn taken die de Hoogste Gerechtigde toebehoren. Vervul jouw taak en bemoei je niet met ALLAH’s Taak.
</p>

<p>
Daarnaast zijn mensen niet de enigen die gerechtigheid en waarheid toehoren en de sprekers ervan zegeningen verschaffen. De bewuste schepselen, zielen en engelen van de Hoogste Gerechtigde hebben het universum overladen en het overal verlevendigd. Aangezien jij naar veel zegeningen verlangt, neem oprechtheid dan als basis en beoog uitsluitend Gods Welbehagen, opdat de klanken van de gezegende woorden die uit jouw mond vloeien dankzij oprechtheid en een zuivere intentie in de luchtdeeltjes tot leven komen, de oren van ontelbare bewuste schepselen binnentreden, hen verlichten en jou zegeningen verschaffen.
</p>

</div>'
            ],
            [
                'page_number' => 68,
                'content' => '<div class="page" id="68">
<p class="text-end page-number">#68</p>

<p>
Want wanneer jij bijvoorbeeld: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span> zegt, dan zal die uiting van <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span> met Gods Bewilliging groot- en kleinschalig miljoenen malen als woorden in de lucht worden geschreven. Omdat de Alwijze Schoonschrijver boven futiliteit en verspilling verheven is, heeft Hij zoveel toehorende oren als het aantal van die talloze gezegende woorden geschapen. Als die woorden in de lucht middels oprechtheid en een zuivere intentie tot leven komen, dan zullen ze als kostelijke vruchten de oren van zielen intreden. Als Gods Welbehagen en oprechtheid die woorden in de lucht niet tot leven wekken, dan zullen ze niet beluisterd worden; de zegen zal dan slechts tot de verbale uiting worden beperkt.
</p>

<p class="text-italic">
Mogen de oren suizen van de Hafizoen<sup>2</sup> die treuren omdat ze met hun matige stem weinig luisteraars aantrekken!
</p>

<p class="text-red small-title text-center">
<strong>De Vierde Reden</strong>
</p>

<p class="text-bold">
De concurrentiële onenigheid tussen de geloofsverkondigers ontstaat niet omdat ze gevolgen niet onder ogen zien en kortzichtig zijn, noch komt de hechte eendracht onder de dwalers tot stand omdat ze stil bij gevolgen staan en ruimdenkend zijn.
</p>

<p>
Het is veeleer zo dat de geloofsverkondigers zich dankzij de invloed van gerechtigheid en waarheid niet laten meeslepen door de blinde emoties van het ego, maar laten leiden door de toekomstgerichte aandriften van het hart en het verstand.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “De lof zij ALLAH.”
</p>

<p class="footnote-p">
<sup>2</sup> Noot van de vertalers: moslims die de Qur’an hebben gememoriseerd.
</p>

</div>

</div>'
            ],
            [
                'page_number' => 69,
                'content' => '<div class="page" id="69">
<p class="text-end page-number">#69</p>

<p>
Helaas kunnen zij daarbij hun rechtzinnigheid en oprechtheid niet in stand houden, waardoor zij die hoge rang niet kunnen behouden en in onenigheid vervallen.
</p>

<p>
De dwaalgeesten daarentegen laten zich onder invloed van het ego en de lusten meeslepen door blinde emoties die gevolgen niet overzien en een miezerig voorhanden genot de voorkeur boven geweldige toekomstige genietingen geven. Bijgevolg zijn zij omwille van een directe baat en een voorhanden genot uiterst eendrachtig met elkaar. Waarlijk, rondom aardse voorhanden genietingen en profijten brengen lage en harteloze egoïsten een innige eendracht en uniteit tot stand.
</p>

<p>
De geloofsverkondigers hebben dankzij de verheven principes van het hart en verstand hun aandacht op vruchten en ontwikkelingen met betrekking tot het hiernamaals gevestigd, wat een gegronde rechtzinnigheid, een ideale oprechtheid, en een uiterst toegewijde uniteit en eendrachtigheid mogelijk maakt. Desondanks kunnen zij niet van eigenwaan afzien, waardoor zij wegens radicaliteit en laksheid een verheven krachtbron die gevestigd is in eendracht verliezen. Daarnaast zal hun oprechtheid bezwijken en hun taak met betrekking tot het hiernamaals eronder lijden. Ten slotte zal Gods Welbehagen ook niet meer zo eenvoudig behaald kunnen worden. De zalf en het medicijn tegen deze ernstige ziekte kan men vinden wanneer hij:
</p>

</div>'
            ],
            [
                'page_number' => 70,
                'content' => '<div class="page" id="70">
<p class="text-end page-number">#70</p>

<p style="text-indent: 0">
• Op basis van het geheim achter: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">اَلْحُبُّ فِى اللّٰهِ</span> de volgers van de waarachtige weg met trots vergezelt;
</p>

<p style="text-indent: 0">
• hen navolgt;
</p>

<p style="text-indent: 0">
• de eer van het imamaat aan hen overlaat;
</p>

<p style="text-indent: 0">
• inziet dat iedereen op die waarachtige weg – <span class="text-italic">zonder uitzonderingen</span> – beter dan hijzelf kan zijn, opdat hij van zijn eigenwaan afziet en oprechtheid verwerft;
</p>

<p style="text-indent: 0">
• beseft dat de simpelste oprechte daad de voorkeur boven bergen aan onoprechte daden geniet;
</p>

<p style="text-indent: 0">• volgzaamheid boven de verantwoordelijke en riskante leiderschapspositie prefereert.
</p>

<p class="text-italic">
Zodoende kan hij van die ziekte gered worden, oprechtheid verwerven en zijn taak met betrekking tot het hiernamaals volwaardig volbrengen.
</p>

<p class="text-red small-title text-center">
<strong>De Vijfde Reden</strong>
</p>


<p class="text-bold">
Zoals de onenigheid en het gemis aan eendracht onder de geloofsverkondigers niet uit hun zwakheid voortkomt, komt de sterke eendracht onder de dwalers evenmin door hun kracht tot stand.
</p>

<p>
Het gemis aan eendracht onder de geloofsverkondigers is veeleer tot stand gekomen door de kracht uit hun steunpunt dat zij aan hun volmaakte geloof te danken hebben, terwijl de eendracht onder de onachtzamen en de dwalers is voortgekomen uit de zwakheid en machteloosheid waaraan zij lijden omdat zij in hun hart een steunpunt missen.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “Liefhebben omwille van ALLAH.”
</p>

</div>

</div>'
            ],
            [
                'page_number' => 71,
                'content' => '<div class="page" id="71">
<p class="text-end page-number">#71</p>

<p>
Immers, omdat zwakken behoeftig zijn aan eendracht, brengen zij een sterke eendracht tot stand. Omdat sterken die behoefte niet zo sterk vernemen, is hun eendracht zwak. Omdat leeuwen en vossen geen behoefte aan eendracht hebben, leiden ze een solitair leven. Omdat wilde geiten zich tegen wolven willen weren, vormen ze een kudde. Al bij al is de groepsvorming en de geestelijke persoonlijkheid van zwakken sterk<sup>1</sup>, evenals de groepsvorming en de geestelijke persoonlijkheid van sterken zwak is. In de Qur’an wordt dit geheim op een fraaie en subtiele wijze als volgt aangeduid:
</p>

<p>
Hoewel de Aya: <sup>2</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">وَ قَالَ نِسْوَةٌ فِى الْمَدٖينَةِ</span> dubbelvoudig vrouwelijk is, wordt de vrouwengemeenschap met het mannelijke werkwoord <sup>3</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">قَالَ</span> aangesproken, terwijl de mannengemeenschap in de Aya: <sup>4</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">قَالَتِ الْاَعْرَابُ</span> met het vrouwelijke werkwoord: <sup>5</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">قَالَتْ</span> wordt aangesproken.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> In navolging van de Amerikaanse vrouwenrechtencomité is in Europa één van de gezagvolste, effectiefste en enigermate sterkste comités door het zwakke, fragiele en elegante vrouwengeslacht opgericht. En ondanks dat de Armenen qua volk over een kleine populatie en weinig macht beschikken, geven zij met hun comité een sterke en opofferingsgezinde gesteldheid weer. Deze omstandigheden bekrachtigen onze stelling.
</p>

<p class="footnote-p">
<sup>2</sup> “En de vrouwen in de stad zeiden” - Qur’an, 12:30
</p>

<p class="footnote-p">
<sup>3</sup> “Zeiden <span class="text-italic">(mannelijk)</span>” - Qur’an, 12:30
</p>

<p class="footnote-p">
<sup>4</sup> “De bedoeïenen zeiden” - Qur’an, 49:14
</p>

<p class="footnote-p">
<sup>5</sup> “Zeiden <span class="text-italic">(vrouwelijk)</span>” - Qur’an, 34:47
</p>

</div>

</div>'
            ],
            [
                'page_number' => 72,
                'content' => '<div class="page" id="72">
<p class="text-end page-number">#72</p>

<p>
Zodoende wordt subtiel het volgende aangegeven: De groepsvorming van zwakke, elegante en gevoelige vrouwen maakt ze sterker, harder en baldadiger, waardoor zij enigszins mannelijkheid verwerven. Omdat de zinsopbouw een mannelijk werkwoord vereist, is de verwoording: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">وَ قَالَ نِسْوَةٌ</span> uiterst fraai uitgekomen. Omdat de mannen – <span class="text-italic">en vooral de Arabische bedoeïenen</span> – op eigen kracht vertrouwen, is hun groepsvorming zwak, waardoor zij een behoedzame en zachtaardige houding aannemen, en enigszins in een vrouwelijke hoedanigheid treden. Omdat de zinsopbouw een vrouwelijk werkwoord vereist, is de verwoording: <sup>2</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">قَالَتِ الْاَعْرَابُ</span> met haar vrouwelijke werkwoord voortreffelijk geplaatst.
</p>

<p>
Waarlijk, omdat het geloof in ALLAH als een uiterst sterk steunpunt gelatenheid en overgave aan de rechtschapenen schenkt, brengen zij bij anderen hun behoefte niet onder woorden en vragen ze niet om andermans assistentie en bijstand. Al zou één van hen daar om vragen, dan zou hij zich daar alsnog niet met een vurige toewijding aan vastklampen.
</p>

<p>
Omdat de aardsgezinden bij hun aardse zaken hun ware steunpunt veronachtzamen, worden zij door zwakheid en machteloosheid overmand, waardoor zij een extreme behoefte aan andermans bijstand vernemen. Bijgevolg brengen zij een innige en zelfs toegewijde vorm van eendracht tot stand.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “En de vrouwen zeiden.” - Qur’an, 12:30
</p>

<p class="footnote-p">
<sup>2</sup> “De bedoeïenen zeiden” - Qur’an, 49:14
</p>

</div>

</div>'
            ],
            [
                'page_number' => 73,
                'content' => '<div class="page" id="73">
<p class="text-end page-number">#73</p>

<p>
Voorwaar, omdat de rechtschapenen de deugdelijke kracht achter eendracht niet overwegen en beogen, ondervinden zij de ondeugdelijke en kwaadaardige consequentie daarvan door in onenigheid te vervallen.
</p>

<p>
Omdat de ondeugdelijke dwaalgeesten daarentegen de kracht achter eendracht door hun onmacht vernemen, hebben zij de aanzienlijke succesformule van eendracht weten te bemachtigen.
</p>

<p>
Voorwaar, de rechtschapenen kunnen de zalf en het medicijn tegen de ondeugdelijke ziekte van onenigheid vinden door de felle Goddelijke Berisping in de Aya: <sup>1</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">وَلَا تَنَازَعُوا فَتَفْشَلُوا وَتَذْهَبَ رٖيحُكُمْ</span> en het Hoogst Wijze Godsgebod omtrent het gemeenschapsleven in de Aya: <sup>2</sup><span class="text-arabic-inline text-red" dir="rtl" lang="ar">وَتَعَاوَنُوا عَلَى الْبِرِّ وَالتَّقْوٰى</span> ter harte te nemen, en te overwegen in hoeverre onenigheid de Islam schaadt en de zege van de dwalers over de rechtschapenen versoepelt, opdat zij met een ideale zwakte en onmacht toegewijd en innig tot die karavaan der rechtschapenen kunnen toetreden; men moet zijn eigenheid vergeten en zich van schijnheiligheid en mooidoenerij verlossen om oprechtheid te verwerven.
</p>

<div class="page-footnote">
<hr class="hr-footnote" />

<p class="footnote-p">
<sup>1</sup> “En verval onderling niet in onenigheid; anders zal angst jullie overmannen en jullie kracht verloren gaan.” - Qur’an, 8:46
</p>

<p class="footnote-p">
<sup>2</sup> “En ondersteun elkaar in het kader van weldadigheid en Godsvrees.” - Qur’an, 5:2
</p>

</div>

</div>'
            ],
        ];
    }
}
