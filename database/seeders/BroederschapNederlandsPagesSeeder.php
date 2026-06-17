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
Toen hij mij kwam bezoeken, had ik gezegd dat het handschrift van de andere broeder mooier dan zijn handschrift was. Ik zei dat het schrijfwerk van de andere broeder meer dienst zou verrichten. Ik zag dat Hâfız Ali werkelijk welgemeend en oprecht trots was op en plezier haalde uit het uitblinkende talent van
</p>

</div>'
            ],
        ];
    }
}
