<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HerzamelingNederlandsPagesSeeder extends BookPagesSeeder
{
    protected function productSlug(): string
    {
        // return the exact slug used when creating the product in DatabaseSeeder
        return 'het-traktaat-over-de-herzameling-nederlands';
    }

    protected function bookTitle(): string
    {
        return 'Het Traktaat Over De Herzameling';
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
      <h2>Het Tiende Woord</h2>
      <p><em>Aangaande Hashr - De Herzameling</em></p>
    </div>

    <p class="text-red text-bold small-title">OPMERKING</p>

    <p>
      De reden waarom ik de metaforen en voorbeelden in deze traktaten in verhaalvorm heb geschreven, is om
      ze begrijpelijker te maken en om te demonstreren hoe logisch, harmonieus, gefundeerd en samenhangend de
      waarheden van de Islam zijn. De betekenissen van de verhalen worden onthuld in de aansluitende waarheden.
      Met behulp van beeldspraak duiden die verhalen slechts op die waarheden. In essentie zijn het dus geen
      fictieve verhalen, maar wezenlijke waarheden.
    </p>

    <p class="text-center text-arabic delima-font" dir="rtl" lang="ar">
      بِسْمِ اللَّهِ الرَّحْمٰنِ الرَّحِيمِ<sup>1</sup>
    </p>

    <p style="margin: 0 auto;max-width: 500px" class="text-center text-arabic delima-font" dir="rtl" lang="ar">
      فَانْظُرْ اِلٰۤى اٰثاَرِ رَحْمَتِ اللهِ كَيْفَ يُحْيِى اْلأَرْضَ بَعْدَ مَوْتِهَا اِنَّ ذٰلِكَ لَمُحْيِى الْمَوْتٰى وَهُوَ عَلٰى كُلِّ شَىْءٍ قَدِيرٌ<sup>2</sup>
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p">
        <sup>1</sup> “In de Naam van ALLAH, de Barmhartige, de Genadige.”
      </p>
      <p class="footnote-p">
        <sup>2</sup> “Aanschouw de sporen van ALLAH’s Genade, hoe Hij de aarde na haar dood doet herleven.
        Voorzeker, Hij is Degene Die de doden tot leven brengt, en Hij bezit Macht over alles.” –
        <em>Qur’an, 30:50</em>
      </p>
    </div>
  </div>'
            ],
            [
                'page_number' => 6,
                'content' => '<div class="page" id="6">
    <p class="text-end page-number">#6</p>

    <p>
      Broeder, indien jij in de eenvoudige volkstaal heldere uitleg over de herzameling
      (<span class="text-italic">Hashr</span>) en het hiernamaals wenst, kijk dan samen met mijn nefs
      (<span class="text-italic">wezen</span>) naar dit symbolische verhaal en luister...
    </p>

    <p>
      Eens waren twee personen op weg naar een paradijselijk mooi land
      (<span class="text-italic">doelend op deze wereld</span>). Eenmaal aangekomen, zagen zij dat iedereen
      de toegang tot zijn woning en winkel onbewaakt openliet. Zonder een eigenaar in zicht, lagen alle
      goederen en geldmiddelen voor het rapen. Eén van die twee reizigers begon alles wat hij binnen handbereik
      begeerde te stelen of te plunderen. Hij gaf zich over aan zijn begeerte en bedreef allerlei soorten onrecht
      en onzede. Niemand van het volk hield hem tegen. Op den duur zei zijn vriend tegen hem:
    </p>

    <p class="text-italic">
      “Wat ben jij aan het doen? Je zult bestraft worden en mij ook in de moeilijkheden brengen! Deze goederen behoren de staat toe.
      Alle lieden van dit volk, inclusief de kinderen, zijn ofwel soldaten ofwel functionarissen. Momenteel zijn ze met bepaalde civiele taken belast,
      vandaar dat zij jou niet tegenhouden. Maar hier heerst een strikte orde! De vorst heeft overal telefoons aangesloten en agenten gestationeerd.
      Kom dus snel tot bezinning en gedraag je naar behoren!”
    </p>

    <p>De dwaze reiziger bleef echter volharden en zei:</p>

    <p class="text-italic">
      “Jij hebt het mis! Deze goederen zijn geen staatsbezit. Het zijn veeleer producten van een soort liefdadigheidsinstelling en behoren niemand specifiek toe;
      iedereen kan er vrijelijk over beschikken. Ik zie geen enkele reden om afstand te doen van deze schatten. Zolang ik met mijn ogen niets concreets zie,
      zal ik jou niet geloven.”
    </p>
  </div>'
            ],
            [
                'page_number' => 7,
                'content' => '<div class="page" id="7">
    <p class="text-end page-number">#7</p>

    <p>
      Vervolgens kraamde hij allerlei filosofische drogredenen uit, waarop een serieuze discussie tussen de twee losbrak.
      Als eerste zei die dwaas:
    </p>

    <p class="text-italic">“Over welke vorst heb jij het? Ik erken zijn bestaan niet.”</p>

    <p>Daarop zei zijn vriend:</p>

    <p class="text-italic">
      “Geen dorp is zonder beheerder. Geen speld ontstaat zonder vervaardiger; ze moet een maker hebben. Geen letter kan tot
      stand komen zonder schrijver, dit weet je! Hoe zou dit eindeloos geordende land dan zonder regeerder kunnen zijn? En kijk
      naar al deze weelde! Elk uur lijkt het alsof een trein<sup>3</sup>
      uit het verborgene ladingen waardevolle en kunstrijke goederen komt aanvoeren, waarna ze weer verdwijnen. Hoe zouden al deze
      producten nou bezitterloos kunnen zijn? En hoe zit het met alle alom zichtbare mededelingsbrieven en toelichtende geschriften,
      alle monogrammen, zegels en signaturen op alle artikelen, en alle vlaggen die in alle uithoeken wapperen? Hoe kunnen die allemaal
      zonder eigenaar zijn? Jij hebt je blijkbaar verdiept in bepaalde westerse studies, maar deze Islamitische geschriften kun je niet
      lezen. Tevens neem je niet de moeite om aan kenners te vragen wat ze inhouden. Kom, dan zal ik jou het vorstelijke decreet voorlezen.”
    </p>

    <p>De dwaas onderbrak hem en zei:</p>

    <p class="text-italic">
      “Zelfs als de vorst zou bestaan, wat voor schade zou mijn geringe consumptie hem nou opleveren? Wat zou hij van zijn weelde
      verliezen? Bovendien zijn hier geen kerkers of iets dergelijks te bekennen; nergens zie ik straffen voltrokken worden.”
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p">
        <sup>3</sup> Dit verwijst naar een jaar. Waarlijk, elke lente is een voedselwagon die uit het verborgene verschijnt.
      </p>
    </div>
  </div>'
            ],
            [
                'page_number' => 8,
                'content' => '<div class="page" id="8">
    <p class="text-end page-number">#8</p>

    <p>Zijn vriend antwoordde:</p>

    <p class="text-italic">
      “Dit land dat je ziet, is een oefenterrein. Tegelijkertijd is het een galerie waar de buitengewone kunstwerken van de vorst worden tentoongesteld.
      Tevens is het zijn tijdelijke, instabiele gastenverblijf. Zie je dan niet dat dagelijks een karavaan verschijnt, terwijl een andere vertrekt en verdwijnt?
      Het wordt hier voortdurend gevuld en ontruimd. Op een dag zal dit land hervormd worden. Deze bevolking zal naar een ander, permanent rijk worden overgeplaatst.
      Daar zal iedereen voor zijn geleverde diensten ofwel bestraft ofwel beloond worden.”
    </p>

    <p>Opnieuw verzette die verraderlijke dwaas zich en zei:</p>

    <p class="text-italic">
      “Ik geloof jou niet! Is het ooit voor mogelijk te houden dat dit land wordt verwoest en alles naar een ander land wordt overgeplaatst?”
    </p>

    <p>Daarop zei zijn vertrouwde vriend:</p>

    <p class="text-italic">
      “Aangezien jij zo koppig blijft volharden, kom mee... dan zal ik jou binnen alle eindeloze bewijzen met behulp van ‘Twaalf Aanzichten’ aantonen dat een Ultieme
      Berechting zal plaatsvinden, dat een oord van beloning en begiftiging bestaat, dat een oord van bestraffing en gevangenschap evenzeer bestaat, en dat dit land,
      dat dagelijks gedeeltelijk wordt bevolkt en ontvolkt, op een dag volledig zal worden ontruimd en verwoest.”
    </p>

    <p class="text-center text-bold small-title" style="margin-top: 18px;">HET EERSTE AANZICHT</p>

    <p>
      Is het ooit voor mogelijk te houden dat in een rijk – met name zo’n grandioos sultanaat – geen beloningen voor de volgzame dienaren noch straffen voor de
      dwarse opstandelingen zijn weggelegd? Hier worden die vrijwel niet verstrekt...
    </p>
  </div>'
            ],
            [
                'page_number' => 9,
                'content' => '<div class="page" id="9">
    <p class="text-end page-number">#9</p>

    <p class="text-center text-bold text-center-constrained">
      Dit geeft aan dat elders een Ultieme Berechting zal plaatsvinden.
    </p>

    <p class="text-center text-bold small-title" style="margin-top: 10px;">
      HET TWEEDE AANZICHT
    </p>

    <p class="text-center">
      Kijk naar deze ontwikkelingen; aanschouw het heersende beleid!
    </p>

    <p>
      Hetzij de armste, hetzij de zwakste, iedereen wordt voortreffelijk in onderhoud voorzien.
      Eenzame zieken worden uitstekend verzorgd. Bovendien is dit land rijk aan kostelijke gerechten,
      kostbare dienschalen, juwelen emblemen, sierlijke gewaden en majestelijke festijnen.
      Kijk om je heen! Afgezien van dwazen als jij komt iedereen zijn plicht zorgvuldig na.
      Niemand gaat ook maar een greintje zijn boekje te buiten. In een sfeer van vrees en ontzag
      verricht zelfs het grootste individu nederig zijn dienst met optimale onderdanigheid.
      Hieruit blijkt dat de eigenaar van dit rijk over een geweldige gulheid en een omvangrijke
      genadigheid beschikt, gecombineerd met een verheven statigheid, en een ontzaglijke waardigheid en eer.
    </p>

    <p>
      In essentie vergt gulheid begunstiging. Genadigheid is incompleet zonder weldadigheid.
      Statigheid vraagt om rectificatie. Eer en waardigheid vereisen de disciplinering van de zedelozen.
      Desalniettemin wordt in dit land voor geen duizendste aan de vereisten van die genadigheid en eer voldaan.
      Terwijl de onderdrukker zijn trots behoudt, blijft de onderdrukte in bitterheid verkeren wanneer ze dit land
      verlaten en emigreren.
    </p>

    <p class="text-center text-bold text-center-constrained">
      Dit geeft aan dat hun vereffening aan de Ultieme Berechting wordt overgelaten!
    </p>
  </div>'
            ],
            [
                'page_number' => 10,
                'content' => '<div class="page" id="10">
    <p class="text-end page-number">#10</p>

    <p class="text-center text-bold small-title">HET DERDE AANZICHT</p>

    <p>
      Kijk met wat voor verheven wijsheid en orde de ontwikkelingen zich ontvouwen, en met wat voor ware
      rechtvaardigheid en afgewogenheid de processen zich voltrekken. De wijsheid van het regeringsbeleid
      vereist de ondersteuning van behoeftigen die onder de beschermende vleugel van het rijk hun toevlucht
      zoeken. Rechtvaardigheid vergt de bescherming van burgerlijke rechten, opdat de statigheid van de
      regering en de glorie van het rijk intact blijven.
    </p>

    <p>
      Echter, in deze streken worden voor geen duizendste aan deze vereisten van wijsheid en
      rechtvaardigheid voldaan. In de meeste gevallen gaan dwazen zoals jij ongestraft hier vandaan.
    </p>

    <p class="text-center text-bold text-center-constrained">
      Dit geeft aan dat dergelijke onafgehandelde zaken aan de Ultieme Berechting worden overgelaten.
    </p>

    <p class="text-center text-bold small-title" style="margin-top: 14px;">HET VIERDE AANZICHT</p>

    <p>
      Aanschouw! De ontelbare unieke edelstenen in deze tentoonstellingsruimtes en de onvergelijkelijke
      gerechten op deze tafels tonen aan dat de vorst van deze streken over een oneindige vrijgevigheid en
      over eindeloze schatten beschikt. Echter, een dusdanige vrijgevigheid en zulke onuitputtelijke schatten
      behoeven een eeuwig festijn in een oord waar al het begeerde immer voorradig is. Tevens vereisen ze het
      voortbestaan van genietende gasten, zodat de pijn van eindigheid en afscheid hen nimmer kan deren.
      Immers, zoals de eindiging van leed genot verschaft, baart de eindiging van genot leed.
    </p>

    <p>
      Kijk nu naar deze vertoningen! Let op deze mededelingen! Geef gehoor aan deze herauten die de
      antie-
    </p>
  </div>'
            ],
            [
                'page_number' => 11,
                'content' => '<div class="page" id="11">
    <p class="text-end page-number">#11</p>

    <p>
      ke kunstwerken van een wonderdadige vorst presenteren en demonstreren: ze veraanschouwelijken zijn
      volmaaktheden, onthullen zijn weergaloze spirituele schoonheid, en omschrijven de subtiliteiten van zijn
      verborgen pracht. De vorst bezit dus zeer belangrijke en verwonderlijke volmaaktheden en spirituele schoonheden. Een verhulde, feilloze volmaaktheid verlangt van nature naar onthulling in het bijzijn van waarderende
      getuigen die haar met uitingen van “mâshâ’ALLAH” bewonderen. Ook een verborgen schoonheid zonder
      aanschouwers wil uiteindelijk zien en gezien worden.
    </p>

    <p>
      Met andere woorden, ze wil haar eigen schoonheid op twee manieren zien. Enerzijds wil ze zichzelf in verscheidene spiegels direct aanschouwen, anderzijds wil ze zichzelf door de ogen van smachtende toeschouwers
      en verwonderde bewonderaars aanschouwen. Ze wil dus zien en gezien worden; voor eeuwig aanschouwen
      en voor altijd aanschouwd worden. Tevens verlangt die oneindige schoonheid naar het voortbestaan van
      smachtende toeschouwers en bewonderaars. Want een tijdeloze schoonheid kan geen genoegen nemen met
      een vergankelijke bewonderaar. Immers, een toeschouwer die gedoemd is voorgoed te vergaan, zal bij de
      gedachte aan zijn ondergang vernemen dat zijn liefde
      overgaat tot haat. Zijn bewondering en eerbied zullen
      omslaan in minachting. De mens is immers vijandig
      tegenover hetgeen hij niet kan begrijpen en bereiken.
    </p>

    <p>
      Nu zien wij dat alle gasten deze gastenverblijven zeer
      snel verlaten en verdwijnen. Ze zien maar een glimp,
      of slechts een zwakke schaduw van die volmaaktheid
      en die schoonheid, waarna ze opeens onverzadigd vertrekken.
    </p>
  </div>'
            ],
            [
                'page_number' => 12,
                'content' => '<div class="page" id="12">
    <p class="text-end page-number">#12</p>

    <p class="text-center text-bold text-center-constrained">
      Dit geeft aan dat ze op weg zijn naar een eeuwig schouwparadijs...
    </p>

    <p class="text-center text-bold small-title">HET VIJFDE AANZICHT</p>

    <p>
      Aanschouw! Blijkens de activiteiten die zich hier afspelen, beschikt die onvergelijkelijke majesteit over
      een geweldig mededogen. Want hij komt snel elk slachtoffer te hulp. Hij reageert op elke vraag en elk verzoek.
      Kijk! Zodra hij ook maar de geringste behoefte bij zijn nietigste onderdaan ontwaart, komt hij daaraan
      meedogend tegemoet. Als een schaap van een herder zijn poot bezeert, stuurt hij meteen een zalf of een
      veearts.
    </p>

    <p>
      Kom, laten we verdergaan. Op het eiland daarginder vindt een grote bijeenkomst plaats. Alle notabelen van
      dit land hebben zich daar verzameld.
    </p>

    <p>
      Kijk! Een nobele adjudant die een hoogaanzienlijk embleem draagt, leest een toespraak voor. Hij heeft
      bepaalde wensen die hij aan zijn meedogende vorst voordraagt. Heel het volk sluit zich bij hem aan en zegt:
    </p>

    <p class="text-italic text-bold">“Wij wensen hetzelfde!”</p>

    <p>Ze beamen en ondersteunen hem. Luister; deze geliefde van de vorst zegt:</p>

    <p class="text-italic text-bold">
      “O sultan die ons met pure gunsten meedogend opvoedt! Toon ons de oervormen, de oorsprongen van alle
      voorbeelden en schaduwen die u ons hier laat zien. Dirigeer ons naar de zetel van uw rijk. Laat ons niet
      creperen in deze woestijnen. Verhef ons tot uw tegenwoordigheid. Wees ons genadig. Schenk ons het
      voorrecht om daar ten volle te mogen genieten van uw kostelijke gunsten die u ons hier hebt laten proeven.
      Folter ons
    </p>
  </div>'
            ],
            [
                'page_number' => 13,
                'content' => '<div class="page" id="13">
    <p class="text-end page-number">#13</p>

    <p class="text-italic text-bold">
      niet met eindigheid en afstandelijkheid. Dit dankbare volk van u smacht naar u... Breng ons niet ten ondergang door ons te verlaten.”
    </p>

    <p>
      Zo brengt hij vele smeekbeden tot uiting; jij hoort het ook. Is het nou ooit voor mogelijk te houden dat
      zo’n meedogende en machtige vorst het kleinste verzoek van zijn geringste onderdaan zorgvuldig inwilligt,
      maar de mooiste wens van zijn geliefdste en nobelste adjudant niet vervult? Daar komt nog bij dat de wens
      van die geliefde iedereens wens is, de vorst ook welgevallig is, en bovendien strookt met wat de vorstelijke
      genade en rechtvaardigheid vereisen. Overigens is het
      verhoren van die wens eenvoudig voor de vorst; het is
      geenszins bezwarend. Het is in feite minder bezwarend
      dan het onderhoud van de tijdelijke parken in deze
      gastenverblijven.
    </p>

    <p>
      Aangezien hij zoveel in deze kortstondige schouwplaatsen investeert en dit land heeft opgericht om
      voorbeelden van zijn gunsten te demonstreren, zal hij
      uiteraard zijn ware schatten, zijn volmaaktheden en
      zijn voortreffelijkheden in het centrum van zijn rijk op
      zo\'n sublieme wijze tentoonstellen, en zulke schouwplaatsen openen, dat het verstanden versteld zal laten
      staan.
    </p>

    <p class="text-center text-bold text-center-constrained">
      De aanwezigen in deze beproevingsplaats zijn dus niet aan henzelf overgelaten; zalige paleizen en beangstigende kerkers staan hen te wachten.
    </p>

    <p class="text-center text-bold small-title" style="margin-top: 14px;">HET ZESDE AANZICHT</p>

    <p>
      Kom en aanschouw! Deze opzienbarende treinen, vliegtuigen, voorzieningen, magazijnen, galerieën en
      evenementen beduiden dat achter de schermen een
    </p>
  </div>'
            ],
            [
                'page_number' => 14,
                'content' => '<div class="page" id="14">
    <p class="text-end page-number">#14</p>

    <p>
      grandioos, albeheersend sultanaat bestaat<sup>4</sup>.
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p">
        <sup>4</sup> <span class="text-bold">Bijvoorbeeld</span>, wanneer het bevel: <span class="text-italic">“Presenteer geweer! Bevestig bajonet!”</span> tijdens een oorlogsoefening op een exercitieterrein wordt uitgevoerd,
      dan neemt een geweldig leger dat in gelid staat de gedaante aan van een doornig eikenwoud.
    </p>

    <p class="footnote-p">
      <span class="text-bold">Of wanneer het bevel:</span> <span class="text-italic">“Trek jullie ceremoniële tenuen aan! Speld jullie emblemen op!”</span> wordt uitgevaardigd om op een nationale feestdag te paraderen,
      dan transformeert het hele legerkamp nagenoeg in een levendige siertuin die bezaaid is met kleurrijke bloemen.
    </p>

    <p class="footnote-p">
      <span class="text-bold">Zo beschikt de Onbegonnen Sultan over eindeloze soorten soldaten,</span> waaronder engelen, djinns, mensen en dieren.
      De onbewuste planten op het veld van het aardrijk vormen ook een divisie, onderhevig aan de wet:
      <span class="text-arabic delima-font" dir="rtl" lang="ar">كُنْ فَيَكُونُ</span> (“Wees!” En het wordt!)
      Wanneer ze ter verdediging tijdens hun jihad om levensbehoud het Goddelijke bevel: <span class="text-italic">“Vat de wapens op en gord jullie aan!”</span> ontvangen,
      en de doornige bomen en planten hun bajonetten opplanten, dan neemt het hele oppervlak de gedaante aan van een fenomenaal legerkamp
      bezaaid met soldaten die zijn uitgerust met steekwapens.
    </p>

    <p class="footnote-p">
      <span class="text-bold">Bovendien geldt elke dag en elke week van de lente als een feestdag voor de plantendivisie,</span> waarbij de ene eenheid na de andere onder het Toeziend Oog van de
      Tijdeloze Sultan paradeert met de juwelen emblemen die de Sultan aan de planten heeft bevestigd om zijn prachtige geschenken te veraanschouwelijken.
      Deze toestand duidt aan dat alle planten en bomen gehoor geven aan het bevel des Heren: <span class="text-italic">“Doe de juwelen van de kunst des Heren om, speld de Goddelijke
      Scheppingsemblemen genaamd ‘bloemen en vruchten’ op, en floreer!”</span> Zo transformeert het aardoppervlak nagenoeg in een fantastisch legerkamp waar soldaten op een
      fenomenale feestdag in getooide tenuen met glimmende emblemen paraderen. &rarr;
      </p>
    </div>
  </div>'
            ],
            [
                'page_number' => 15,
                'content' => '<div class="page" id="15">
    <p class="text-end page-number">#15</p>

    <p>
      Een dergelijk sultanaat behoeft waardige onderdanen. Echter, je ziet dat heel het volk zich in dit gastenverblijf heeft verzameld, terwijl dit verblijf dagelijks wordt gevuld en geleegd. Alle onderdanen bevinden zich op
      dit beproevingsterrein voor training, terwijl dit terrein ieder uur wordt aangepast. Heel het volk verblijft enkele minuten in deze tentoonstellingsruimte om in de opengestelde galerieën voorbeelden van de waardevolle
      giften en de antieke kunstwerken van de vorst te bezichtigen, terwijl deze ruimte elke minuut verandering
      ondergaat. Zij die vertrekken, keren niet terug; zij die verschijnen, zullen vroeg of laat vertrekken.
    </p>

    <p>
      Voorwaar, deze toestand toont absoluut aan dat achter dit gastenverblijf, dit terrein en deze tentoonstellingsruimte eeuwige paleizen en permanente woningen
      bestaan, gelegen tussen tuinen en schatten die gevuld
      zijn met de zuivere en zalige originelen van alle voorbeelden en verschijnselen die wij hier waarnemen.
    </p>

    <p class="text-center text-bold text-center-constrained">
      De inspanningen hier zijn dus daarvoor bedoeld. Hier wordt gewerkt, daar wordt beloning uitgeloofd. Voor iedereen is daar een gelukzaligheid naargelang zijn potentie weggelegd...
    </p>

    <p class="text-center text-bold small-title" style="margin-top: 14px;">HET ZEVENDE AANZICHT</p>

    <p>
      Kom, laten we een beetje rondreizen en kijken naar wat voor ontwikkelingen zich zoal voordoen in deze beschaafde gemeenschap.
      Kijk! Overal, in elke hoek, zijn velerlei camera’s geplaatst die beelden vastleggen.
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p">
        Voorwaar, deze voorzieningen en versieringen die met zoveel wijsheid en orde worden verwezenlijkt, tonen uiteraard aan de
        niet-blinden dat dit op bevel van een Almachtige Sultan en een Alwijze Regeerder geschiedt.
      </p>
    </div>
  </div>'
            ],
            [
                'page_number' => 16,
                'content' => '<div class="page" id="16">
    <p class="text-end page-number">#16</p>

    <p>
      Overal zitten verscheidene schrijvers aantekeningen te maken. Ze registreren alles. Zelfs de onbeduidendste
      dienst, de gewoonste gebeurtenis slaan ze op.
    </p>

    <p>
      Kijk! Op die hoge bergtop is speciaal voor de vorst een grote camera opgesteld<sup>5</sup> waarmee de beelden van
      alle ontwikkelingen in deze streken worden vastgelegd. De vorst heeft dus bevolen dat alle concrete gedragingen
      en activiteiten in zijn rijk geregistreerd moeten worden. Dit betekent dat die verheven majesteit alle gebeurtenissen
      laat opnemen en alle beelden ervan verzamelt. Voorwaar, zo’n zorgvuldige registratie en bewaring zijn uiteraard
      voor een rekenschap bedoeld.
    </p>

    <p>
      Is het nou ooit voor mogelijk te houden dat een albewarende regeerder, die zelfs de gewoonste handelingen van zijn geringste onderdanen niet verwaarloost,
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p">
        <sup>5</sup> De betekenissen waarop gezinspeeld wordt in dit aanzicht, worden deels in “De Zevende Waarheid” verklaard.
      Hier willen wij er alleen op wijzen dat met de grote specifieke camera van de vorst het “Bewaartableau”
      <span class="text-arabic delima-font" dir="rtl" lang="ar">لَوْحُ مَحْفُوظ</span> wordt bedoeld. In “Het Zesentwintigste Woord”
      is de bestaanswerkelijkheid van het Bewaartableau als volgt bewezen:
    </p>

    <p class="footnote-p">
      Kleine identiteitsbewijzen duiden op het bestaan van een groot bevolkingsregister, kleine transactiebonnen wijzen op de
      existentie van een grootboek, en voortvloeiende druppels onthullen de aanwezigheid van een grote waterbron. De geheugens van mensenkinderen, de vruchten van bomen en de zaadjes van vruchten – die als minuscule identiteitsbewijzen gelden, de betekenissen van een mini-bewaartableau belichamen, en als fijne stippen ontrollen aan de Pen waarmee het
      Grote Bewaartableau is geschreven – onthullen, openbaren en
      bewijzen uiteraard ook het bestaan van een Subliem Geheugen, een Universeel Grootboek en een Ultiem Bewaartableau
      – voor scherpe verstanden worden ze zelfs zichtbaar.
      </p>
    </div>
  </div>'
            ],
            [
                'page_number' => 17,
                'content' => '<div class="page" id="17">
    <p class="text-end page-number">#17</p>

    <p>
      de aanzienlijkste daden van zijn voornaamste onderdanen niet zal bewaren, niet zal beoordelen, en niet
      met een gepaste beloning of bestraffing zal vergelden?
      Ondanks dat lieden onder die voornaamste individuen
      handelingen plegen die zijn statigheid en digniteit aantasten, en zijn genadige karakter geenszins kan aanvaarden, worden ze hier niet bestraft.
    </p>

    <p class="text-center text-bold text-center-constrained">
      Dit betekent dat zulke onafgehandelde zaken aan de Ultieme Berechting worden overgelaten...
    </p>

    <p class="text-center text-bold small-title" style="margin-top: 14px;">HET ACHTSTE AANZICHT</p>

    <p>
      Kom, dan zal ik jou nu de vorstelijke decreten voorlezen. Kijk, herhaaldelijk brengt hij zijn beloften en
      zijn heftige dreigementen onder woorden, zeggende:
      <span class="text-italic">“Ik zal jullie uit jullie huidige verblijven halen en naar het centrum van mijn rijk brengen,
      waar ik de gehoorzamen zal verblijden en de opstandelingen zal opsluiten. Ik zal dat vergankelijke land verwoesten
      en een ander oord met eeuwige paleizen en kerkers oprichten.”</span>
      De waarmaking van zijn beloften is zeer eenvoudig voor hem,
      terwijl het voor zijn onderdanen van primair belang is.
      Beloftebreuk daarentegen staat in schril contrast met
      de integriteit van zijn regeermacht.
    </p>

    <p>
      Kijk nu, o dwaas! Jij beaamt jouw valse waanideeën, jouw bazelende verstand en jouw bedrieglijke nefs.
      Ondertussen verloochen jij een entiteit die geen enkele reden heeft om ontrouw of inconsequent te zijn;
      een majesteit wiens integriteit in geen enkel opzicht met inconsistentie kan harmoniëren, en wiens
      waarachtigheid door alle zichtbare activiteiten wordt bevestigd. Hiervoor verdien jij uiteraard een
      geweldige straf! Jij lijkt op een reiziger die zijn ogen voor het zonlicht sluit en in het domein van zijn
      verbeelding staart,
    </p>
  </div>'
            ],
            [
                'page_number' => 18,
                'content' => '<div class="page" id="18">
    <p class="text-end page-number">#18</p>

    <p>
      waar zijn waan als een vuurvlieg zijn angstwekkende pad tracht te verlichten met het schijnsel dat van
      zijn hoofd afschemert. Aangezien de vorst een belofte heeft gedaan, zal hij zijn belofte uiteraard
      vervullen! Tevens is de vervulling van zijn belofte niet alleen uiterst eenvoudig voor hem, het is voor
      ons, voor alle wezens, voor hem en voor zijn rijk eveneens hoogstnodig.
    </p>

    <p class="text-center text-bold text-center-constrained">
      Al bij al zal een Ultieme Berechting plaatsvinden, en een Sublime Gelukzaligheid geschonken worden.
    </p>

    <p class="text-center text-bold small-title" style="margin-top: 14px;">HET NEGENDE AANZICHT</p>

    <p>
      Kom, wij gaan nu een aantal leiders van deze kringen en gemeenschappen bezoeken<sup>6</sup>. Zoals je ziet, beschikt elk van hen over een privételefoon waarmee hij
      de vorst persoonlijk kan spreken. Sommigen van hen
      hebben zelfs tot zijn tegenwoordigheid mogen rijzen.
      Laten wij luisteren naar wat zij zeggen... Unaniem verkondigen zij dat de vorst ter beloning en bestraffing
      een adembenemende en een angstaanjagende plaats
      heeft klaargemaakt. Ze vertellen over zijn stellige beloften en heftige dreigementen. Bovendien benadrukken ze dat zijn statigheid en majesteit de schande die
      gepaard gaat met het verzaken van een belofte nooit
      zouden kunnen aanvaarden.
    </p>

    <p>
      Die verkondigers, die in aantal de leden van massale
      overleveringsketenen evenaren en uit kracht van een
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p">
        <sup>6</sup> De betekenissen die in dit aanzicht worden geïllustreerd, zullen in "De Achtste Waarheid" worden onthuld. Bijvoorbeeld, de leiders van de kringen vertegenwoordigen de profeten en de heiligen. De telefoon symboliseert een band met
        de Heer die zich vormt in het medium van openbaringen
        (<em>wahy</em>) en de ontvanger van ingevingen (<em>ilhām</em>), oftewel het
        hart. <span class="text-italic">(Het hart dient als de hoorn van die telefoon.)</span>
      </p>
    </div>
  </div>'
            ],
            [
                'page_number' => 19,
                'content' => '<div class="page" id="19">
    <p class="text-end page-number">#19</p>

    <p>
      collectieve consensus spreken, delen unaniem het volgende mee:
    </p>

    <p>
      Het centrum en de zetel van het geweldige sultanaat
      waar wij hier slechts enkele voortbrengselen van zien,
      bevinden zich elders, in een ander land, ver hier vandaan. De constructies op dit beproevingsterrein zijn tijdelijk. Later zullen ze worden omgevormd tot eeuwige
      paleizen. Deze streken zullen verandering ondergaan.
    </p>

    <p>
      Immers, zo’n geweldig en onvergankelijk sultanaat,
      waarvan de verhevenheid via zijn werken kan worden
      ontwaard, kan niet op zulke tijdelijke, onbestendige,
      onzekere, futiele, wisselvallige, instabiele, gebrekkige
      en onbevorderlijke beschikkingen gegrondvest worden
      en standhouden... Het rust dus op aanhoudende, vaststaande, onvergankelijke, stabiele, volmaakte en voortreffelijke beschikkingen die dat sultanaat waard zijn....
    </p>

    <p class="text-center text-bold text-center-constrained">
      Er bestaat dus een ander oord waarnaar onontkoombaar gemigreerd zal worden...
    </p>

    <p class="text-center text-bold small-title" style="margin-top: 14px;">HET TIENDE AANZICHT</p>

    <p>
      Kom, vandaag wordt het Sultanische Nieuwjaar gevierd<sup>7</sup>. Er zal een overgang plaatsvinden; merkwaardi-
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p">
        <sup>7</sup> De inhoud van dit "Aanzicht" zal in "De Negende Waarheid" worden onthuld. Bijvoorbeeld, de nieuwjaarsdag representeert het lenteseizoen. Het groene, bloemige woestijnland symboliseert het aardoppervlak gedurende de lente. De
        veranderende beelden en weergaven duiden op de periode
        vanaf de aanvang van de lente tot aan het einde van de
        zomer, waarin de Almachtige en Ontzaglijke Kunstenaar, de
        Alwijze en Sublime Voortbrenger, allerlei soorten voorjaarswezens, zomercreaties en voedingsmiddelen voor dieren en
        mensen met perfecte orde verandert, met volmaakte Genade
        ververst, en achtereenvolgens afzendt.
      </p>
    </div>
  </div>'
            ],
            [
                'page_number' => 20,
                'content' => '<div class="page" id="20">
    <p class="text-end page-number">#20</p>

    <p>
      ge ontwikkelingen gaan optreden. Laten wij op deze prachtige lentedag dat mooie, groene en bloemige
      woestijnland bereiken.
    </p>

    <p>
      Kijk, ook het volk komt deze kant op. Er heerst iets magisch in de atmosfeer. Daarginder stonden bouwwerken
      die plotseling zijn verwoest; ze hebben andere gedaantes aangenomen. Kijk, een mirakel doet zich voor!
      Die verwoeste constructies worden hier opeens herbouwd. Deze verlaten woestijn transformeert vrijwel
      in een moderne stad. Zoals veranderende beelden op een bioscoopdoek geeft ze om het uur een andere wereld weer;
      ze neemt steeds een andere gedaante aan.
    </p>

    <p>
      Let op! Ondanks dat zoveel beelden der werkelijkheden warrig lijken langs te flitsen, heerst er zo’n voortreffelijke orde,
      dat alles perfect op elkaar aansluit. Zelfs fictieve beelden in bioscoopfilms kunnen niet zo uitgebalanceerd zijn.
      Miljoenen bekwame tovenaars zijn niet in staat om zulke kunsten te demonstreren. De vorst die onzichtbaar voor ons is,
      kan dus geweldige mirakelen tot stand brengen.
    </p>

    <p>
      O dwaas, jij vraagt:
      <span class="text-italic">“Hoe zou dit geweldige land vernietigd en elders opgericht kunnen worden?”</span>
    </p>

    <p>
      Voorwaar, vergelijkbaar met de transitie van dit land, wat jouw verstand weigert te aanvaarden, vinden vele overgangen en
      transities ieder uur voor jouw ogen plaats! Deze verzamelingen, ontbindingen en omstandigheden leiden tot de conclusie dat
      al deze rappe samenkomsten en scheidingen, deze constructies en destructies een hoger doel dienen. Voor een uur durende
      samenkomst wordt immers grofweg een tienjarige investering gedaan. Deze huidige toestanden op zichzelf
    </p>
  </div>'
            ],
            [
                'page_number' => 21,
                'content' => '<div class="page" id="21">
    <p class="text-end page-number">#21</p>

    <p>
      zijn dus niet het einddoel; ze dienen veeleer als een representatie, een simulatie van iets hogers. De vorst
      brengt ze op een miraculeuze wijze tot stand, opdat de beelden ervan worden opgenomen en gecompileerd,
      en de resultaten ervan worden bewaard en geregistreerd –
      <span class="text-italic">net zoals alles tijdens een militair examen op een oefenterrein wordt vastgelegd en genoteerd.</span>
      Dit betekent dus dat een geweldige bijeenzameling zal plaatsvinden waarbij de verdere gang van zaken om
      de resultaten van deze toestanden zal draaien.
    </p>

    <p>
      Tevens zullen de beeldopnames in een grandioze tentoonstellingsruimte voor eeuwig worden weergegeven.
      Deze voorbijgaande en onbestendige omstandigheden werpen dus blijvende beelden en eeuwige vruchten af.
    </p>

    <p class="text-center text-bold text-center-constrained">
      Al bij al zijn deze ceremoniën dus bedoeld voor een Sublieme Gelukzaligheid en een Ultieme Berechting, en voor meerdere verheven doeleinden die ons onbekend zijn...
    </p>

    <p class="text-center text-bold small-title" style="margin-top: 14px;">HET ELFDE AANZICHT</p>

    <p>
      Kom, o koppige vriend! Laten we een vliegreis maken en vervolgens in een trein stappen die ons naar
      het oosten of westen – <span class="text-italic">oftewel het verleden of de toekomst</span> – kan vervoeren. Laten we kijken wat voor soort
      mirakelen deze wonderdadige majesteit in andere streken demonstreert.
    </p>

    <p>
      Voorwaar, aanschouw! Merkwaardigheden zoals de verblijven, terreinen en tentoonstellingsruimtes die we
      eerder zagen, zijn overal aanwezig. Alleen op het gebied van kunst en gedaante verschillen ze van elkaar.
      Maar als je aandachtig observeert, dan zul je in al die instabiele verblijven, tijdelijke terreinen en vergankelij-
    </p>
  </div>'
            ],
            [
                'page_number' => 22,
                'content' => '<div class="page" id="22">
    <p class="text-end page-number">#22</p>

    <p>
      ke galerijen bemerken wat voor ordeningen van een zonneklare wijsheid, wat voor tekenen van een evidente bijstand, wat voor verschijnselen van een verheven rechtvaardigheid en wat voor vruchten van een omvangrijke genade er te zien zijn. Iedereen die niet kortzichtig is, ziet met een ontwijfelbare zekerheid in dat een volmaaktere wijsheid dan zijn wijsheid, een schonere gratie dan zijn gratie, een omvangrijkere genade dan zijn genade en een subliemere rechtvaardigheid dan zijn rechtvaardigheid noch bestaanbaar noch voorstelbaar zijn.
    </p>

    <p>
      Als wij zouden uitgaan van jouw waan dat binnen de kring van zijn rijk geen eeuwige verblijven, verheven gewesten, permanente woningen en onvergankelijke leefgebieden bestaan, waar vaste bewoners en gelukzalige onderdanen leven, hoe zou de situatie er dan uitzien? De werkelijkheden van de heersende wijsheid, gratie, genade en rechtvaardigheid kunnen in dit vergankelijke land duidelijk niet tot hun recht komen. Mocht er elders ook geen plaats zijn waar die werkelijkheden volwaardig tot uiting kunnen komen, dan zullen wij, zoals een dwaas die op klaarlichte dag de zon ontkent terwijl hij haar licht aanschouwt, de wijsheid voor onze ogen moeten loochenen, de gratie die wij ondervinden moeten loochenen, de genade die wij waarnemen moeten loochenen, en de rechtvaardigheid met al haar sterke en onmiskenbare verschijnselen en tekenen allemaal moeten loochenen.
    </p>

    <p>
      Bovendien moeten wij aannemen dat de regisseur van deze wijze beschikkingen, weldadige activiteiten en genaderijke gunsten – <span class="text-italic">God verhoede</span> – een roekeloze spelleider en een wrede tiran is. Dit zou betekenen dat
    </p>
  </div>'
            ],
            [
                'page_number' => 23,
                'content' => '<div class="page" id="23">
    <p class="text-end page-number">#23</p>

    <p>
      werkelijkheden tot hun tegenpolen verworden. Echter, volgens de unanieme opvatting van alle intellectuelen – <span class="text-italic">met uitzondering van de bezopen sofisten die het bestaan van alles ontkennen</span> – is de verwording van werkelijkheden ondenkbaar.
    </p>

    <p class="text-center text-bold text-center-constrained">
      Al bij al bestaat elders een ander oord, waar een Ultieme Berechting, een Alhoge Gerechtigheid en een Grandioze Begiftiging zullen plaatsvinden, opdat deze genade, wijsheid, gratie en rechtvaardigheid volwaardig tot hun recht kunnen komen...
    </p>

    <p class="text-center text-bold small-title" style="margin-top: 14px;">HET TWAALFDE AANZICHT</p>

    <p>
      Kom, laten we terugkeren. Wij gaan nu de leiders en officieren van deze gemeenschappen ontmoeten en hun uitrustingen onderzoeken, zodat wij kunnen vaststellen of die uitrustingen zijn gegeven om alleen kortstondig op dat beproevingsterrein te overleven, of om een gelukzalig leven in een ander oord te verwerven.
    </p>

    <p>
      Wij kunnen niet ieder individu en elke uitrusting analyseren. Maar om een indruk te krijgen, gaan wij het <span class="text-bold">identiteitsbewijs</span> en het <span class="text-bold">handboek</span> van deze officier bekijken. Op dit identiteitsbewijs staan de <span class="text-bold">rang</span>, het <span class="text-bold">loon</span>, de taak, de wensen en de <span class="text-bold">gedragscode</span> van de officier vermeld.
    </p>

    <p>
      Kijk, deze rang kan niet voor enkele dagen verleend zijn, maar voor een zeer ruime tijdspanne. Hier staat: <span class="text-italic">"U zult dit loon uit de majesteitelijke schatkist op \'die en die\' datum ontvangen."</span> Echter, die datum ligt ver in de toekomst en valt pas nadat dit terrein wordt afgesloten. Tevens is deze taak niet afgestemd op dit tijdelijke oord; die is veeleer gegeven om een blijvende gelukza-
    </p>
  </div>'
            ],
            [
                'page_number' => 24,
                'content' => '<div class="page" id="24">
    <p class="text-end page-number">#24</p>

    <p>
      ligheid in de nabijheid van de vorst te verwerven. Ook deze <span class="text-bold">wensen</span> corresponderen niet met een paardaags bestaan in dit gastenverblijf; alleen een lang en gelukzalig leven kan ze bevredigen. Overigens onthult deze <span class="text-bold">gedragscode</span> eveneens dat de eigenaar van dit identiteitsbewijs bestemd is voor een ander oord; hij werkt voor een andere wereld.
    </p>

    <p>
      Kijk, in deze <span class="text-bold">handboeken</span> zijn de gebruiksinstructies van de uitrustingen en de bijbehorende verantwoordelijkheden vastgelegd. Als er buiten dit terrein elders geen verheven en permanent oord bestaat, dan verliezen dit officiële <span class="text-bold">handboek</span> en dat legitieme <span class="text-bold">identiteitsbewijs</span> volledig hun betekenis. Tevens zal deze geachte officier, nobele commandant en gerespecteerde leider vervallen tot een niveau dat hem lager, ongelukkiger, hopelozer, ellendiger, rampzaliger, armer en zwakker maakt dan iedereen.
    </p>

    <p>
      Voorwaar, overweeg deze analyse. Waar je ook op let, alles getuigt ervan dat na deze eindigheid een eeuwigheid zal volgen.
    </p>

    <p>
      Begrijp dus, o vriend, dit tijdelijke land dient als een akker. Het is een oefenterrein; een handelsplaats. Op den duur zullen ongetwijfeld een Ultieme Berechting en een Sublieme Gelukzaligheid volgen. Wanneer je dit ontkent, dan zul je alle identiteitsbewijzen, handboeken, uitrustingen en gedragscodes van al deze officieren, en daarenboven alle ordeningen in dit land moeten ontkennen. Zelfs de regering en het staand beleid zul je moeten loochenen. Op dat moment kun jij noch mens noch een bewust wezen worden genoemd; je zult dan verstandelozer dan de sofisten zijn.
    </p>
  </div>'
            ],
            [
                'page_number' => 25,
                'content' => '<div class="page" id="25">
    <p class="text-end page-number">#25</p>

    <p>
      Je moet beslist niet denken dat de bewijzen voor de transitie van dit land beperkt zijn tot deze <span class="text-italic">"Twaalf Aanzichten"</span>. Er zijn in feite ontelbare indicaties en bewijzen die aantonen dat dit onbestendige en wisselvallige land getransformeerd zal worden tot een onvergankelijk en stabiel land. Bovendien zijn er talloze aanwijzingen en tekenen die aangeven dat de inwoners hier uit deze tijdelijke gastenverblijven zullen worden gehaald en naar het eeuwige centrum van het sultanaat zullen worden overgeplaatst. Tot besluit zal ik je nog één bewijs laten zien dat sterker is dan de vorige <span class="text-italic">"Twaalf Aanzichten"</span>.
    </p>

    <p>
      Kom kijken! Daar in de verte, in die drukke menigte, staat de drager van het hoogaanzienlijke embleem; de nobele adjudant die wij voorheen op het schiereiland hadden gezien. Hij houdt een preek. Laten wij ook gaan en luisteren naar wat hij verkondigt. Kijk, die stralende adjudant informeert over het ultieme decreet dat op die verheven hoogte is ingegrift, zeggende:
    </p>

    <p class="text-italic">
      "Bereid jullie voor! Jullie zullen naar een ander, permanent land migreren… en wel een land dat dit oord slechts op een gevangenis doet lijken. Jullie zullen naar het sultanatische centrum van onze vorst reizen, waar jullie zijn genade en gratie zullen ondervinden, op voorwaarde dat jullie dit decreet aandachtig aanhoren en opvolgen… Anders, als jullie in opstand komen en niet luisteren, dan zullen jullie in huiveringwekkende kerkers worden gesmeten."
    </p>

    <p>
      Zo deelt hij tijdingen mee…
    </p>

    <p>
      Zoals je ziet, is het ultieme decreet voorzien van zo\'n miraculeus zegel, dat het op geen enkele wijze kan worden vervalst. Afgezien van dwazen zoals jij, weet iedereen dat het decreet toebehoort aan de vorst.
    </p>
  </div>'
            ],
            [
                'page_number' => 26,
                'content' => '<div class="page" id="26">
    <p class="text-end page-number">#26</p>

    <p>
      Bovendien draagt die stralende adjudant zulke emblemen, dat buiten blinden zoals jij iedereen met ontwijfelbare zekerheid weet dat hij de waarachtige uitvaardiger van de vorstelijke bevelen is.
    </p>

    <p>
      Nu rijst de vraag of de transitie van dit land, waarover de nobelste adjudant aan de hand van dat ultieme decreet met al zijn kracht dawa en mededelingen heeft gedaan, ooit nog in twijfel kan worden getrokken. Uiteraard kan dat niet! Tenzij jij alles wat wij tot dusver hebben waargenomen gaat ontkennen!
    </p>

    <p>
      Welnu, mijn vriend, het woord is aan jou. Vertel, wat heb jij hierop te zeggen?
    </p>

    <p class="text-italic">
      – Wat kan ik zeggen? Kan hier nog iets tegenin gebracht worden? Is het mogelijk om de zon in de middaggloed tegen te gaan? Ik zeg alleen: <sup>8</sup><span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span>, <span class="text-italic">God zij honderdduizendmaal dank; ik ben verlost van de overheersing van mijn waanideeën en begeerten, ik ben gered van de greep van mijn nefs en lusten, ik ben bevrijd van permanente gevangenschap en opsluiting, en ik ben tot het inzicht gekomen dat buiten deze chaotische en instabiele gastenverblijven een gelukzalig oord in de vorstelijke nabijheid bestaat, en wij zijn daarvoor gekandideerd.</span>"
    </p>

    <p>
      Voorwaar, dit symbolische verhaal dat zinspeelt op de herzameling en het hiernamaals is hier afgerond. Bij Gods Gratie gaan wij nu over naar de verheven waarheden. In aansluiting op de voorgaande "Twaalf Aanzichten" gaan wij "Twaalf Samenhangende Waarheden" uiteenzetten, beginnend met een "Voorwoord".
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p"><sup>8</sup> "Alle lof zij ALLAH."</p>
    </div>
  </div>'
            ],
            [
                'page_number' => 27,
                'content' => '<div class="page" id="27">
    <p class="text-end page-number">#27</p>

    <div class="text-center page-title-chapter delima-font">
      <h2>Voorwoord</h2>
    </div>

    <p>
      [Met een aantal <span class="text-bold">"Aanwijzingen"</span> zullen wij bepaalde onderwerpen aanstippen die uiteengezet zijn in andere delen, namelijk in de <span class="text-bold">Tweeëntwintigste</span>, <span class="text-bold">Negentiende</span> en <span class="text-bold">Zesentwintigste Woorden</span>.]
    </p>

    <div class="text-center">
      <p class="text-center text-bold small-title">De Eerste Aanwijzing</p>
    </div>

    <p>
      De dwaas en zijn vertrouwde vriend uit het verhaal staan symbool voor drie waarheden.
    </p>

    <p>
      <span class="text-bold">In eerste instantie</span> belichamen ze mijn kwaadgezinde nefs en mijn hart.
    </p>

    <p>
      <span class="text-bold">In tweede instantie</span> vertegenwoordigen ze de filosofiestudenten en de leerlingen van de Qur\'an-el\'Hakîm.
    </p>

    <p>
      <span class="text-bold">In derde instantie</span> representeren ze de Islamitische Oemma en het volk des ongeloofs.
    </p>

    <p>
      De allerergste dwaling van de filosofiestudenten, de ongelovigen en de kwaadgezinde nefs bestaat uit het miskennen van de Alwaarachtige.
    </p>

    <p>
      De vertrouwde man uit het verhaal zei:
    </p>

    <p class="text-italic">
      "Een letter kan niet zonder een schrijver tot stand komen; een wet kan niet zonder een regeerder in werking treden." Voortredenerend zeggen wij:
    </p>

    <p>
      Wanneer we spreken over een boek, waarin een ander boek in elk woord met een micro-pen is vastgelegd, en een gestructureerde ode in elke letter in minuscuul schrift is geschreven, dan is het absoluut ondenkbaar dat een dergelijk boek geen schrijver heeft.
    </p>
  </div>'
            ],
            [
                'page_number' => 28,
                'content' => '<div class="page" id="28">
    <p class="text-end page-number">#28</p>

    <p>
      Evenzo is het in talloze opzichten ondenkbaar dat dit universum geen Auteur heeft. Immers, dit universum is een dusdanig boek, dat elke bladzijde ervan vele boeken bevat. Er schuilt zelfs een boek in elk woord, een ode in elke letter. Het aardoppervlak is een bladzijde; kijk hoeveel boeken daarover zijn uitgespreid. Een boom is een woord; kijk hoeveel bladzijden die beslaat. Een vrucht is een letter, een zaadje is een punt. Dat punt bevat het programma en de inhoud van een enorme boom.
    </p>

    <p>
      Voorwaar, een dergelijk boek kan alleen zijn voortgevloeid uit de Machtspen van een Glorieuze Entiteit Die over Ontzaglijke en Elegante Attributen beschikt, en een Eindeloze Macht en Wijsheid bezit. Aldus noodzaakt de waarneming van de wereld imaan <span class="text-italic">(geloof)</span>, mits men niet dronken is van dwaling...
    </p>

    <p>
      Bovendien is een woning zonder bouwmeester eveneens onbestaanbaar. Met name als het gaat om een woonpaleis dat met voortreffelijke kunstwerken, merkwaardige gravures en unieke versierselen is gedecoreerd, en elke bouwsteen ervan zo kunstig als een paleis is vervaardigd. Geen enkel verstand zou kunnen aanvaarden dat zo\'n woning zonder bouwmeester tot stand zou kunnen komen; een dergelijke constructie behoeft een uiterst bekwame kunstenaar.
    </p>

    <p>
      Vooral als in dat paleis ware structuren om het uur zo vloeiend als beelden op een bioscoopdoek materialiseren, en met perfecte orde zo moeiteloos als het wisselen van kleren worden vervangen, terwijl daarenboven in elk verschijnend beeld verscheidene microstructuren worden gecreëerd.
    </p>
  </div>'
            ],
            [
                'page_number' => 29,
                'content' => '<div class="page" id="29">
    <p class="text-end page-number">#29</p>

    <p>
      Evenzo behoeft dit universum een Alwijze, Alwetende en Almachtige Kunstenaar. Immers, dit grandioze universum is een paleis waarin de zon en de maan als lampen, en de sterren als kaarsen dienen. De tijd is een draad; een lijn waarop Die Ontzaglijke Kunstenaar jaarlijks een andere wereld vestigt en tentoonstelt. De verschijning van de wereld die Hij vestigt, ververst hij op 360 geordende manieren. Met perfecte Orde en Wijsheid brengt Hij veranderingen aan. Het aardoppervlak laat Hij dienen als een tafel van gunsten die Hij elke lente met 300.000 soorten kunstwerken decoreert en met ontelbare soorten geschenken belaadt. En ondanks dat al die kunstwerken en geschenken uiterst dicht op elkaar warrig met elkaar verweven zijn, worden ze met uiterst distinctieve kenmerken van elkaar onderscheiden. Zo kun je andere aspecten verder afwegen…
    </p>

    <p class="text-bold">
      Hoe kan iemand tegenover de Kunstenaar van zo\'n paleis onachtzaam blijven?
    </p>

    <p>
      Bovendien kun je nagaan wat voor dwaze waanzin het zou zijn om op een wolkeloze middag de zon te ontkennen, terwijl haar schittering en reflectie op alle luchtbellen op het zeeoppervlak, op alle glimmende objecten op het aardoppervlak en op alle kristallen in sneeuwvlokken te zien zijn en waargenomen worden. Want zodra één enkele zon ontkend en niet aanvaard wordt, is het noodzakelijk om evenveel wezenlijke en zelfstandige zonnetjes te aanvaarden als het bestaande aantal waterdruppels, luchtbellen en reflecterende deeltjes. Er moet dan verondersteld worden dat ieder atoom, dat slechts ruimte heeft voor één atoompje, de waarheid van een geweldige zon omvat.
    </p>
  </div>'
            ],
            [
                'page_number' => 30,
                'content' => '<div class="page" id="30">
    <p class="text-end page-number">#30</p>

    <p>
      Evenzo is het een nog grotere waanzin en dwaling om na het aanschouwen van dit ordelijke universum, dat binnen een aaneenschakeling van gebeurtenissen voortdurend met wijsheid verandering ondergaat en aldoor systematisch wordt ververst, alsnog de Ontzaglijke Schepper en Zijn Volmaakte Eigenschappen te ontkennen. Want er moet dan verondersteld worden dat alles, zelfs elk atoom, een absolute Goddelijkheid omvat.
    </p>

    <p>
      Bijvoorbeeld, elk luchtdeeltje kan zich in elke bloem, in elke vrucht en in elk blad een weg banen en er binnen werk verrichten. Als dit deeltje geen functionaris zou zijn, dan moet het bekend zijn met de bouwprogramma\'s, de gedaantes en de structuren van alle kunstwerken waarin het kan treden en werken om effectief te functioneren. Kortom, het moet dan over een omvattende kennis en macht beschikken om te kunnen doen wat het doet.
    </p>

    <p>
      Bijvoorbeeld, elk gronddeeltje kan voor alle verschillende soorten zaden en pitten als basis en bakermat dienen. Als dit deeltje geen functionaris zou zijn, dan zou het over zoveel figuurlijke apparaten en machines als het aantal grassprieten en bomen moeten beschikken. Óf er zou aan dat deeltje een kunstvaardigheid en macht toegekend moeten worden waarmee het de bouwprogramma\'s van alle plantensoorten kan lezen en verwezenlijken, en alle vormen waarmee ze bekleed worden kan onderscheiden en weven. Trek deze vergelijking door naar andere wezens, opdat je inziet dat in alles vele evidente bewijzen voor de Goddelijke Eenheid te vinden zijn.
    </p>

    <p>
      Waarlijk, uit één iets alles voortbrengen en uit alles één iets vervaardigen, is een daad die uitsluitend
    </p>
  </div>'
            ],
            [
                'page_number' => 31,
                'content' => '<div class="page" id="31">
    <p class="text-end page-number">#31</p>

    <p>
      is voorbehouden aan de Al-Schepper. Sla acht op het Glorieuze Vers: <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">وَ اِنْ مِنْ شَيْءٍ اِلَّا يُسَبِّحُ بِحَمْدِهِ</span>. De Ene Enige niet aanvaarden, noodzaakt dus tot de aanvaarding van zoveel goden als het aantal wezens in het bestaan.
    </p>

    <div class="text-center">
      <p class="text-center text-bold small-title">De Tweede Aanwijzing</p>
    </div>

    <p>
      In het verhaal kwam een nobele adjudant voor waarover werd gezegd: <span class="text-italic">"Iedereen die niet blind is, kan bij het zien van zijn emblemen ontwaren dat die eminentie op bevel van de majesteit handelt; hij is de uitverkoren onderdaan van de vorst."</span> Voorwaar, die nobele adjudant is de Nobelste Godsbode <span class="text-arabic-inline" dir="rtl" lang="ar">ﷺ</span>.
    </p>

    <p>
      Waarlijk, voor de Heilige Kunstenaar van zo\'n prachtig universum is een dergelijke Nobele Godsbode zo onmisbaar als licht is voor de zon. Want net zoals de zon zonder het uitstralen van licht ondenkbaar is, is het eveneens onmogelijk dat Goddelijkheid Zich niet via de afvaardiging van profeten zou openbaren.
    </p>

    <p>
      Is het bovendien ooit voor mogelijk te houden dat een schoonheid, verankerd in eindeloze volmaaktheid, zichzelf niet aan de hand van een onthullend en beschrijvend medium zou willen veraanschouwelijken?
    </p>

    <p>
      En is het voor mogelijk te houden dat een volmaakt kunstenaarschap, doordrenkt met sublieme schoonheid, niet aan de hand van een belangwekkende heraut gepresenteerd zou willen worden?
    </p>

    <p>
      En is het ooit voor mogelijk te houden dat bij een Universele Heerschappij, gevoerd over een Alomvattend Sultanaat, er geen wens zou bestaan om binnen
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p"><sup>1</sup> "En er is niets, of het verheerlijkt Hem met lof."</p>
    </div>
  </div>'
            ],
            [
                'page_number' => 32,
                'content' => '<div class="page" id="32">
    <p class="text-end page-number">#32</p>

    <p>
      alle lagen van diversiteiten en verscheidenheden de monarchale Eenheid en Soevereiniteit aan de hand van
      een tweevleugelige zendeling bekend te maken? Tweevleugelig wil zeggen dat die zendeling zich enerzijds,
      in verband met zijn universele dienaarschap, als vertegenwoordiger van alle bestaanslagen van diversiteiten
      op het Goddelijke Hof richt, terwijl hij zich anderzijds, in verband met zijn Nabijheid tot ALLAH en zijn
      profeetschap, als functionaris van het Goddelijke Hof op alle bestaanslagen van diversiteiten richt.
    </p>

    <p>
      En is het ooit voor mogelijk te houden dat een inherente Bezitter van Eindeloze Pracht de bekoorlijkheden
      van Zijn Schoonheid en de subtiele nuances van Zijn Charme niet in spiegels zou willen aanschouwen
      en tentoonstellen? Hiervoor zal Hij een geliefde boodschapper verkiezen, die enerzijds Zijn geliefde is omdat
      hij zichzelf met zijn dienaarschap geliefd bij Hem maakt en als Zijn spiegel fungeert, terwijl hij anderzijds Zijn
      boodschapper is die bij Zijn schepselen liefde voor Hem doet ontvlammen en Zijn Schone Namen demonstreert.
    </p>

    <p>
      En is het ooit voor mogelijk te houden dat een Bezitter van schatten overladen met verbazende mirakelen
      en zeldzame kostbaarheden geen wil of wens zou hebben om ze met behulp van een vaardige beschrijver en
      toelichtende tentoonsteller publiekelijk te onthullen om Zijn verborgen Volmaaktheden te openbaren?
    </p>

    <p>
      En is het voor mogelijk te houden dat Hij dit universum versiert met creaties die de volmaaktheden van
      al Zijn Namen uitdrukken, en het aldus doet lijken op een museaal schouwpaleis gedecoreerd met unieke en
      fijnzinnige kunstwerken, maar vervolgens geen geleerde gids aanstelt om verlichting te verschaffen?
    </p>
  </div>',
            ],
            [
                'page_number' => 33,
                'content' => '<div class="page" id="33">
    <p class="text-end page-number">#33</p>

    <p>
      En is het ooit voor mogelijk te houden dat de Eigenaar van deze kosmos het doel en plan achter de
      overgangen in dit universum, en het mysterie van de drie lastige vragen over waar wezens vandaan komen,
      waar ze naartoe gaan en wat ze inhouden, niet aan de hand van een afgezant zal laten ontvouwen?
    </p>

    <p>
      En is het ooit voor mogelijk te houden dat de Ontzaglijke Kunstenaar, Die Zichzelf met zulke fraaie
      kunstwerken aan bewuste wezens bekendmaakt en met waardevolle gunsten geliefd maakt, niet aan die
      bewuste wezens via een afgezant zal laten weten wat Hem behaagt en wat Hij als tegenprestatie verlangt?
    </p>

    <p>
      En is het ooit voor mogelijk te houden dat de Schepper de mensheid creëert met een bewustzijn dat gehecht
      is aan diversiteit en een potentie die geschikt is voor een universeel dienaarschap, maar desondanks
      niet haar aandacht via een onderwijzende gids van diversiteit naar Eenheid zal willen verleggen?
    </p>

    <p>
      Zo zijn er nog vele profetische taken die elk op zichzelf absoluut aantonen dat Goddelijkheid niet zonder
      profeetschap kan… In het licht van de voornoemde eigenschappen en taken rest nu de vraag of er ooit iemand
      is verschenen die bekwamer en rijker was dan Mohammed de Arabier <span class="text-arabic-inline" dir="rtl" lang="ar">ﷺ</span>? Heeft de tijd ooit iemand
      getoond die de rang van profeetschap en de taak van verkondiging waardiger was dan hij? Nooit
      en te nimmer! Hij is de meester van alle profeten, de imam van alle gezanten, de mentor van alle gezuiverden,
      de nabijste onder Gods nabije dienaren, de volmaaktste van alle creaties en de sultan van alle geestelijke
      gidsen.
    </p>
  </div>',
            ],
            [
                'page_number' => 34,
                'content' => '<div class="page" id="34">
    <p class="text-end page-number">#34</p>

    <p>
      Waarlijk, afgezien van de ontelbare bewijzen voor zijn profeetschap waarover erkende waarheidsonderzoekers
      unaniem zijn, zoals de maansplijting, het water dat uit zijn vingers vloeide en nog circa duizend
      verwante mirakelen, is de Glorierijke Qur\'an als oceaan van waarheden met veertig miraculeuze aspecten een
      ultiem mirakel dat voldoende is om zijn profeetschap zonneklaar aan te tonen. Omdat wij in andere traktaten,
      en met name in <span class="text-italic">"Het Vijfentwintigste Woord"</span>, bijna veertig miraculeuze aspecten van de Qur\'an hebben
      behandeld, zullen wij het hierbij laten.
    </p>

    <div class="text-center">
      <p class="text-center text-bold small-title">De Derde Aanwijzing</p>
    </div>

    <p>
      Laat de volgende gedachte niet bij je opkomen:
    </p>

    <p class="text-italic">
      "Wat voor belang heeft deze minuscule mens nou, dat deze geweldige wereld voor de rekenschap van zijn daden
      zal sluiten en een andere dimensie zal ontluiken?"
    </p>

    <p>
      Immers, omdat deze minuscule mens op basis van zijn omvattende aard als leidsman van alle wezens, als
      heraut van het Goddelijke Sultanaat en als vervuller van een universeel dienaarschap kan optreden, bekleedt
      hij een positie die van groot belang is.
    </p>

    <p>
      Ook de volgende gedachte moet je niet voeden:
    </p>

    <p class="text-italic">
      "Hoe kan de mens gedurende een kortstondig leven een eeuwige straf verdienen?"
    </p>

    <p>
      Immers, ondanks dat dit universum de status en waardigheid van <span class="text-bold">"de Schriftuur van de Soevereine
      <span class="text-italic">(Samed)</span>"</span> bekleedt, stort ongeloof het in een afgrond van betekenisloosheid en doelloosheid, wat beledigend
      is tegenover het hele universum. Daarnaast leidt de ontkenning die inherent is aan ongeloof tot de verwer-
    </p>
  </div>',
            ],
            [
                'page_number' => 35,
                'content' => '<div class="page" id="35">
    <p class="text-end page-number">#35</p>

    <p>
      ping van alle Heilige Goddelijke Namen waarvan de reflecties en verwevingen bij alle wezens te zien zijn.
      Tevens is ongeloof een loochening van alle talloze bewijzen die de Waarachtigheid en Getrouwheid van de
      Alwaarachtige aantonen. <span class="text-italic text-bold">Aldus is ongeloof een grenzeloos misdrijf – en een grenzeloos misdrijf behoeft een grenzeloze straf.</span>
    </p>

    <div class="text-center">
      <p class="text-center text-bold small-title">De Vierde Aanwijzing</p>
    </div>

    <p>
      Zoals wij in het verhaal aan de hand van <span class="text-bold">"Twaalf Aanzichten"</span> hebben gezien, is het geenszins mogelijk
      dat een vorst van zo\'n statuur wél een land heeft dat hij als een tijdelijk gastenverblijf beheert, maar elders,
      in het centrum van zijn geweldige sultanaat, geen ander, stabiel en permanent land bezit waar zijn majesteit
      ten volle tot haar recht komt.
    </p>

    <p>
      Evenzo is het geenszins mogelijk dat de Eeuwige Schepper deze tijdelijke wereld wél creëert, maar een
      eeuwige wereld níet formeert. Het is onmogelijk dat de Tijdeloze Kunstenaar dit onvergelijkelijke en vergankelijke
      universum schept, maar geen ander, stabiel en permanent universum tot stand brengt. Voorzeker, het
      is onmogelijk dat de Alwijze, Almachtige en Genadige Voortbrenger deze wereld als een tentoonstellingsruimte,
      als een oefenterrein en als een akker creëert, maar het oord van het hiernamaals waarop alle doelen van
      deze wereld gericht zijn niet schept.
    </p>

    <p>
      Toegang tot deze waarheid kan via <span class="text-bold">"Twaalf Poorten"</span> worden verkregen. Met <span class="text-bold">"Twaalf Waarheden"</span> kunnen
      die poorten worden ontgrendeld. We zullen met de kortste en eenvoudigste beginnen…
    </p>
  </div>',
            ],
            [
                'page_number' => 36,
                'content' => '<div class="page" id="36">
    <p class="text-end page-number">#36</p>

    <div class="text-center text-center-constrained">
      <p class="text-center text-bold small-title">De Eerste Waarheid</p>
      <p class="text-center"><span class="text-italic text-bold">De poort van Gods Heerschappij en Sultanaat; Een glimp van de Naam "Rab" (Heer).</span></p>
    </div>

    <p>
      Is het ooit voor mogelijk te houden dat de Heer, gezien de hoedanigheid van Zijn Heerschappij en het
      Sultanaat van Zijn Goddelijkheid, dit universum heeft opgericht om Zijn Volmaaktheden middels sublieme
      doelen en verheven wensen te tonen, zonder een beloning uit te loven aan de gelovigen die met geloof
      en dienaarschap aan Zijn doeleinden en wensen beantwoorden? En zal Hij de dwalers, die afwijzend en
      spottend reageren op die wensen, er ongestraft mee laten wegkomen?
    </p>

    <div class="text-center text-center-constrained">
      <p class="text-center text-bold small-title">De Tweede Waarheid</p>
      <p class="text-center"><span class="text-italic text-bold">De poort van Vrijgevigheid en Genadigheid; Een glimp van de Namen: "de Genereuze en de Genadige"</span>
      <span class="text-arabic" dir="rtl" lang="ar">اَلْكَرِيمُ وَالرَّحِيمُ</span></p>
    </div>

    <p>
      Is het ooit voor mogelijk te houden dat de Heer van deze wereld, Die blijkens Zijn waarneembare werken
      Bezitter is van een Grenzeloze Generositeit en Genade, evenals een Eindeloze Statigheid en Digniteit, geen
      beloning naar Zijn Generositeit en Genade, noch straf conform Zijn Statigheid en Digniteit zal toekennen?
    </p>
  </div>',
            ],
            [
                'page_number' => 37,
                'content' => '<div class="page" id="37">
    <p class="text-end page-number">#37</p>

    <p>
      Waarlijk, wanneer de voortgang van deze wereld in ogenschouw wordt genomen, dan blijkt dat aan ieder
      levend wezen, vanaf de onbekwaamste en zwakste<sup>1</sup> tot aan de sterkste levensvorm, passend onderhoud wordt
      verstrekt. Het weekste en onkundigste wezen wordt van het beste onderhoud voorzien. Elke hulpbehoevende
      wordt via onverwachte wegen hulp toegesneld. De festijnen en schenkingen vinden met zo\'n verheven
      generositeit plaats, dat ze onmiskenbaar de dirigering van een eindeloos Genereuze Hand laten zien.
    </p>

    <p>
      <span class="text-italic text-bold">Bijvoorbeeld</span>, in de lente worden alle bomen als paradijselijke schoonheden in zijden gewaden bekleed,
      met bloemen en vruchten als sieraden getooid, en als bedienden aangesteld, waarop ze ons via hun elegante
      handen in de gedaante van takken allerlei heerlijke en beeldige vruchten serveren. En uit de hand van een
      giftig insect worden wij met genezende en zalige honing gevoed. En aan de hand van een handeloze rups
      worden wij met de mooiste en zachtste kledij bekleed. En een grote schat van Genade wordt voor ons in een
      klein zaadje bewaard.
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p">
        <sup>1</sup> Halal onderhoud wordt niet met kundigheid verworven, maar op basis van behoeftigheid geschonken.
        Een onomstotelijk bewijs hiervan is het contrast tussen het zuivere levensonderhoud van onkundige borelingen
        en het schaarse levensonderhoud van kundige beesten, of de forse lichamen van onintelligente vissen en de
        magere lichamen van intelligente, sluwe vossen en apen die door de strijd voor hun levensonderhoud iel blijven.
      </p>
      <p class="footnote-p">
        Onderhoud is dus omgekeerd evenredig gecorreleerd met kundigheid en keuze. Hoe meer een wezen op zijn
        kunde en keuze rekent, des te zwaarder de lasten van levensonderhoud zullen zijn.
      </p>
    </div>
  </div>',
            ],
            [
                'page_number' => 38,
                'content' => '<div class="page" id="38">
    <p class="text-end page-number">#38</p>

    <p>
      Uit deze verschijnselen kan duidelijk worden afgeleid hoe prachtig de Generositeit en hoe subtiel de Genade
      zijn waaraan ze ontspruiten.
    </p>

    <p>
      En op mensen en enkele beesten na, komt alles – <span class="text-italic">vanaf de zon, de maan en de aarde tot aan het allerkleinste schepsel</span> –
      zijn plicht uiterst zorgvuldig na, zonder ook maar een greintje buiten zijn grenzen te treden. In de
      alomtegenwoordigheid van een geweldige Majesteit heerst een universele gehoorzaamheid. Dit toont aan dat
      alles handelt op bevel van een Hoogst Ontzaglijke Bezitter van Statigheid.
    </p>

    <p>
      En het genadevolle mededogen van alle moeders<sup>2</sup>, hetzij plant, dier of mens, en de heilzame voeding
      zoals melk, afgestemd op de opvoeding van hun machteloze en zwakke nageslacht, laten onmiskenbaar zien
      hoe verreikend de invloed is die een glimp van Genade uitoefent. Al bij al bezit de Beheerder van deze
      wereld een eindeloze Generositeit, een grenzeloze Genade, en een oneindige Glorie en Statigheid… Oneindige
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p">
        <sup>2</sup> Waarlijk, een hongerige leeuwin die haar zwakke welp boven haarzelf verkiest en het vlees dat ze vangt
        niet zelf eet, maar aan haar jong geeft; een laffe kip die een hond of leeuw aanvalt om haar kuikens te
        beschermen; en een vijgenboom die zelf modder consumeert, terwijl ze haar nakomelingen, oftewel haar
        vruchten, zuivere melk schenkt, zijn allemaal verschijnselen die klaarblijkelijk aan de niet-blinden tonen
        dat ze volgens het Plan van een eindeloos Genadig, Genereus en Meedogend Opperwezen handelen.
      </p>
      <p class="footnote-p">
        Waarlijk, het feit dat onbewuste wezens zoals planten en dieren taken vervullen waarvoor een uiterst omvattend
        bewustzijn en wijsheid vereist zijn, laat noodzakelijkerwijs zien dat er een Alwetende en Alwijze Entiteit
        is Die ze dirigeert; ze handelen namens Hem.
      </p>
    </div>
  </div>',
            ],
            [
                'page_number' => 39,
                'content' => '<div class="page" id="39">
    <p class="text-end page-number">#39</p>

    <p>
      Glorie en Statigheid vereisen de disciplinering van de zedelozen. Eindeloze Generositeit vereist eindeloze
      begunstiging. Grenzeloze Genade vereist een aansluitende weldadigheid.
    </p>

    <p>
      Echter, gelijkwaardig aan een druppel uit de oceaan, kan slechts één deel uit de miljoenen aspecten van
      deze vereisten een plek vinden en tot uiting komen in deze vergankelijke wereld en dit kortstondige leven.
      Er moet dus een oord van gelukzaligheid bestaan dat recht doet aan die Goddelijke Generositeit en Genade.
      Anders, vergelijkbaar met de ontkenning van de zon wanneer ze de dag met haar licht verguldt, zal het
      bestaan van deze waarneembare Genade verloochend moeten worden. Immers, omdat onomkeerbare ondergang
      zonder kans op wederkeer mededogen in ellende, liefde in smart, begunstiging in kwelling, het verstand
      in een vervloekt marteltuig, en genot in leed verandert, gaat de waarheid van Genade onvermijdelijk verloren.
    </p>

    <p>
      Bovendien moet er ook een oord van bestraffing zijn waar de voornoemde Glorie en Statigheid tot Hun recht
      kunnen komen. Immers, in de meeste gevallen behoudt een onderdukker zijn trots, terwijl de onderdrukte
      vernederd blijft wanneer zij van dit aardrijk vertrekken en vergaan. <span class="text-bold">Dit geeft aan dat deze zaken aan de
      Ultieme Berechting worden overgelaten; ze zijn uitgesteld en worden dus niet genegeerd.</span>
    </p>

    <p>
      Soms brengt Hij ook straf op aarde ten uitvoer. De rampen waaraan opstandige en oproerige volkeren uit
      vroegere tijdperken ten prooi zijn gevallen, laten zien dat de mens niet toezichtloos is. Hij is altijd vatbaar
      voor een klap van Glorie en Digniteit.
    </p>
  </div>',
            ],
            [
                'page_number' => 40,
                'content' => '<div class="page" id="40">
    <p class="text-end page-number">#40</p>

    <p>
      Waarlijk, te midden van heel het bestaan, is het de mens die met een aanzienlijke taak en een waardevolle
      potentie is toegerust. Wanneer vervolgens de Heer der mensheid Zichzelf met zoveel uitgebalanceerde
      kunstwerken kenbaar maakt, maar de mens Hem niet middels geloof erkent; en wanneer de Heer Zichzelf met
      zoveel sierlijke genadevruchten geliefd maakt, maar de mens zichzelf niet bij Hem middels dienaarschap
      geliefd maakt; en wanneer de Heer met zoveel verscheidene soorten gunsten Zijn Genegenheid en Genade laat
      zien, maar de mens Hem niet met dank en lof eerbiedigt, is het dan voor mogelijk te houden dat zo\'n mens
      ongestraft zal blijven en geen verantwoording zal moeten afleggen? En zal het Ontzaglijke Opperwezen, de
      Bezitter van Digniteit en Statigheid, geen oord van vergelding oprichten?
    </p>

    <p>
      En wanneer gelovigen in antwoord op Zijn Zelfonthulling erkenning betuigen middels geloof, in antwoord
      op Zijn liefdebetoon wederliefde koesteren en verspreiden middels dienaarschap, en in antwoord op Zijn
      Genade eerbied bewijzen middels dankbetuiging, is het dan voor mogelijk te houden dat die Barmhartige
      Genadige hen geen eeuwige gelukzaligheid in een oord van beloning zal schenken?
    </p>
  </div>',
            ],
            [
                'page_number' => 41,
                'content' => '<div class="page" id="41">
    <p class="text-end page-number">#41</p>

    <div class="text-center text-center-constrained">
      <p class="text-center text-bold small-title">De Derde Waarheid</p>
      <p class="text-center"><span class="text-italic text-bold">De poort van Wijsheid en Rechtvaardigheid; Een glimp van de Namen: "de Alwijze en de Rechtvaardige"</span>
      <span class="text-arabic" dir="rtl" lang="ar">اَلْحَكِيمُ وَالْعَادِلُ</span></p>
    </div>

    <p>
      Is het ooit voor mogelijk te houden<sup>1</sup> dat het Ontzaglijke Opperwezen, enerzijds laat zien hoe Hij de
      Heerschappij over Zijn Sultanaat voert met de Wijsheid en orde, de Rechtvaardigheid en balans die zich
      vanaf de atomen tot aan de zonnen voordoen, maar anderzijds de gelovigen, die toevlucht tot de Beschermende
      Vleugel van Zijn Heerschappij nemen, en zich met geloof en dienaarschap aan Zijn heersende Wijsheid en
      Rechtvaardigheid conformeren, niet zal begenadigen?
    </p>

    <div class="page-footnote">
      <hr class="hr-footnote" />
      <p class="footnote-p">
        <sup>1</sup> De formulering: <span class="text-italic text-bold">"Is het ooit voor mogelijk te houden"</span> wordt vaak herhaald om een belangrijk
        geheim uit te drukken. Ongeloof en dwaling rijzen voornamelijk op wanneer iets als vergezocht wordt
        aangemerkt. Met andere woorden, wanneer iemand iets onwaarschijnlijk en buiten het bereik van het verstand
        acht, dan neigt hij ertoe datgene te ontkennen. Echter, in <span class="text-bold">"Het Traktaat over de Herzameling"</span> is
        onbetwistbaar aangetoond dat juist het pad van ongeloof en de weg van dwaling doordrenkt zijn met
        vergezochteden, onwaarschijnlijkheden, onredelijkheden, onaannemelijkheden en onoverkomelijke problematieken.
        Tevens wordt aangetoond dat reële mogelijkheden, logische waarschijnlijkheden en onontkoombare aannemelijkheden
        te vinden zijn op het pad des geloofs en in de laan van de Islam.
      </p>
      <p class="footnote-p">
        <span class="text-bold">Conclusie:</span> terwijl filosofen tot ontkenning neigen wanneer ze iets vergezocht achten, maakt
        <span class="text-bold">"Het Tiende Woord"</span> middels de retorische vraagvorm duidelijk aan welke kant daadwerkelijke vergezochtheid
        ligt, en legt hen zodoende de hand op de mond.
      </p>
    </div>
  </div>',
            ],
            [
                'page_number' => 42,
                'content' => '<div class="page" id="42">
    <p class="text-end page-number">#42</p>

    <p>
      En zal Hij de zedelozen, die zich met verloochening en ongehoorzaamheid tegen die Wijsheid en
      Rechtvaardigheid verzetten, niet disciplineren?
    </p>

    <p>
      In deze tijdelijke wereld wordt bij de mens voor geen duizendste aan die Wijsheid en Rechtvaardigheid
      voldaan; de vervulling ervan is dus uitgesteld. De meeste dwalers blijven onbestraft en de meeste
      gelovigen onbeloond wanneer ze deze wereld verlaten en vergaan. Dit geeft aan dat een Ultieme Berechting
      en een Sublieme Gelukzaligheid zullen volgen.
    </p>

    <p class="text-italic text-bold">
      Waarlijk, de Entiteit Die deze wereld beheert, brengt ontwikkelingen met een eindeloze Wijsheid tot stand.
      Wil je hier een bewijs voor?
    </p>

    <p>
      <span class="text-bold">Bij alles beoogt Hij voordelen en nuttigheden.</span> Zie je dan niet dat alle
      menselijke organen, beenderen en aderen, en zelfs alle cellen en delen van het lichaam, afgestemd zijn op
      nuttigheden en wijsheden? In bepaalde organen verweeft Hij zelfs zoveel wijsheden en gunstigheden als het
      aantal vruchten aan een boom. Dit laat zien dat alle ontwikkelingen middels een Hand van Eindeloze
      Wijsheid plaatsvinden.
    </p>

    <p>
      Ook de aanwezigheid van eindeloze orde in de kunstige creatie van alles toont aan dat ontwikkelingen zich
      volgens een eindeloze Wijsheid voltrekken. Waarlijk, de wijze waarop het gedetailleerde programma van een
      elegante bloem in haar minuscule zaadje wordt opgeslagen, of de manier waarop de pagina van daden, de
      levensgeschiedenis en het onderdelenregister van een enorme boom met de spirituele Pen des Lots in een
      klein zaadje worden vastgelegd, wijzen erop dat een Pen van Eindeloze Wijsheid actief is.
    </p>
  </div>',
            ],
            [
                'page_number' => 43,
                'content' => '<div class="page" id="43"> <p class="text-end page-number">#43</p>
<p>
  Ook de aanwezigheid van een uiterst subliem kunstenaarschap in de schepping van alle wezens toont
  aan dat alles het ontwerp is van een Oneindig Wijze Kunstenaar. Waarlijk, de wijze waarop de samenvatting
  van het hele universum, de sleutels tot alle schatten van Genade en de spiegels van alle Goddelijke Namen
  in het kleine mensenlichaam zijn gevestigd, getuigt van een Wijsheid binnen een uiterst subliem kunstenaarschap.
  Voorwaar, is het ooit voor mogelijk te houden dat een dergelijke Wijsheid, heersend over het universele
  beleid van de Goddelijke Heerschappij, de gehoorzame gelovigen die toevlucht onder de Vleugel van die
  Heerschappij zoeken, niet zal willen begenadigen en niet eeuwig zal begiftigen?
</p>

<p class="text-italic text-bold">
  Wil je ook bewijs dat ontwikkelingen zich met rechtvaardigheid en balans voltrekken?
</p>

<p>
  De wijze waarop alles volgens nauwkeurige afwegingen en specifieke afmetingen een bestaan wordt gegeven,
  met een gedaante wordt bekleed en in de meest geschikte omgeving wordt gedepositioneerd, toont aan dat
  ontwikkelingen volgens een eindeloze Rechtvaardigheid en Balans tot stand komen. En de manier waarop het
  inherente recht van elk wezen in evenredigheid met zijn potentie wordt toegekend, wat inhoudt dat alle benodigdheden
  voor zijn bestaan en alle uitrustingen voor zijn overleving op de meest gepaste wijze worden verstrekt,
  laat een Hand van grenzeloze Rechtvaardigheid zien. Ook de voortdurende beantwoording van alles wat in de
  taal van potentie, de taal van natuurlijke behoeftigheid en de taal van urgentie wordt gevraagd en verzocht,
  getuigt van een eindeloze Rechtvaardigheid en Wijsheid.
</p>

  </div>'
            ],
            [
                'page_number' => 44,
                'content' => '<div class="page" id="44"> <p class="text-end page-number">#44</p>
<p>
  Voorwaar, is het ooit voor mogelijk te houden dat zo’n Rechtvaardigheid en Wijsheid, Die zelfs aan
  de kleinste behoefte van het nietigste schepsel tegemoetkomen, de ultieme behoefte van het aanzienlijkste
  schepsel, oftewel de eeuwigheidsbehoefte van de mens, zullen verwaarlozen? Zullen Ze zijn dringendste
  verzoek en cruciaalste vraag onbeantwoord laten? Zullen Ze de Majesteit van de Goddelijke Heerschappij niet
  in stand houden door de rechten van Gods dienaren te beschermen? De mens die in deze vergankelijke wereld
  een vluchtig leven leidt, kan en zal de werkelijkheid van zo’n Rechtvaardigheid hier niet ervaren. Hij wordt
  dus overgeleverd aan een Ultieme Berechting. Ware rechtvaardigheid vereist immers dat deze kleine mens
  niet naar zijn fysieke nietigheid, maar naar de ernst van zijn misdaden, het belang van zijn wezen en de
  omvang van zijn verantwoordelijkheid wordt beloond of bestraft.
</p>

<p>
  Aangezien deze vergankelijke, voorbijgaande wereld bij verre na niet in staat is om de mens, die voor eeuwigheid
  is geschapen, de vereiste Rechtvaardigheid en Wijsheid te bieden, is het niet meer dan vanzelfsprekend dat
  elders een permanente hel en een eeuwig paradijs zijn klaargemaakt door de Ontzaglijke Bezitter van Schoonheid,
  Die Rechtvaardig is; de Schone Bezitter van Glorie, Die Alwijs is...
</p>

  </div>'
            ],
            [
                'page_number' => 45,
                'content' => '<div class="page" id="45"> <p class="text-end page-number">#45</p>

<div class="text-center text-center-constrained">
  <p class="text-center text-bold small-title">De Vierde Waarheid</p>
  <p class="text-center"><span class="text-italic text-bold">De poort van Vrijgevigheid en Schoonheid; Een glimp van de Namen: “de Vrijgevige en de Schone”</span></p>
  <p class="text-center">
    <span class="text-arabic" dir="rtl" lang="ar">اَلْجَوَادُ وَ الْجَمِيلُ</span>
  </p>
</div>

<p>
  Is het ooit voor mogelijk te houden dat een grenzeloze Vrijgevigheid en Gulheid, een oneindige weelde,
  een overvloed aan onuitputtelijke schatten, een onvergelijkelijke, eeuwige Schoonheid, en een onberispelijke,
  eindeloze Volmaaktheid niet zouden verlangen naar een gelukzalig oord en een rijk van festijnen waar
  dankbare behoeftigen, smachtende weerspiegelaars en verwonderde toeschouwers voor altijd zullen verblijven?
</p>

<p>
  Waarlijk, de wijze waarop het aangezicht van de wereld met zoveel sierlijke kunstwerken is getooid, de
  maan en de zon tot lampen zijn aangesteld, het aardoppervlak als een tafel van gunsten met de kostelijkste
  voedselsoorten is beladen, vruchtdragende bomen als fruitschalen dienstbaar zijn gemaakt, en vernieuwingen
  seizoensgewijs menigmaal teweeg worden gebracht, getuigt van een grenzeloze Vrijgevigheid en Gulheid.
</p>

<p>
  Zo’n grenzeloze Vrijgevigheid en Gulheid, zo’n onuitputtelijke weelde en Genadigheid, vereisen een eeuwig
  festijn in een gelukzalig oord waar al het gewenste altijd voorradig is. Tevens vergen ze ongetwijfeld dat de
  genieters van dat festijn in dat gelukzalige oord blijven voortbestaan en daar voor altijd verblijven, opdat ze
  niet door eindigheid en scheiding worden gekweld. Want net zoals het einde van leed plezier verschaft,
  brengt het einde van plezier leed teweeg. Een dergelijke Gulheid zal geen dergelijk leed willen verwekken;
</p>

  </div>'
            ],
            [
                'page_number' => 46,
                'content' => '<div class="page" id="46"> <p class="text-end page-number">#46</p>
<p>
  Ze zou veeleer verlangen naar een eeuwig paradijs bevolkt door eeuwige behoeftigen. Grenzeloze vrijgevigheid
  en gulheid willen immers eindeloos begiftigen en begunstigen. Eindeloos begiftigen en begunstigen
  vereisen op hun beurt eindeloze afhankelijkheid en ontvankelijkheid. Dit vergt weer het voortbestaan van
  de begiftigde, opdat hij voor die aanhoudende begunstiging zijn dankbaarheid en afhankelijkheid kan
  betuigen. Anders is een beperkte genieting die spoedig door eindigheid verbittert onverenigbaar met de eisen
  van een dergelijke Vrijgevigheid en Gulheid.
</p>

<p>
  Bezichtig ook de Goddelijke kunstgalerijen die zich over het gehele aardrijk uitstrekken. Let op de mededelingsbrieven
  des Heren in de handen van de planten en dieren die over het aardoppervlak zijn uitgespreid<sup>1</sup>.
  Geef gehoor aan de profeten en heiligen die de herauten zijn van de schoonheden der Goddelijke Heerschappij.
  Zie hoe zij unaniem de Feilloze Volmaaktheden van de Ontzaglijke Kunstenaar onthullen en verklaren door Zijn
  buitengewone kunstwerken tentoon te stellen en de aandacht daarop te vestigen.
</p>

<p>
  De Kunstenaar van deze wereld bezit dus bijzonder waardevolle, verbazingwekkende en verborgen Volmaaktheden
  Die Hij aan de hand van deze voortreffelijke kunstwerken wil demonstreren. Verborgen, feilloze
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>1</sup> Waarlijk, een fijn bewerkte, elegante bloem of een kunstrijke, sierlijke vrucht die aan een haardunne tak van
    een beendroge boom hangt, is uiteraard een mededelingsbrief waaruit bewuste wezens de kunstzinnige sublimiteit
    van een uiterst kunstlievende, wonderbaarlijke en Alwijze Kunstenaar kunnen aflezen. Zo kun je deze observatie van
    planten ook toepassen op dieren…
  </p>
</div>
  </div>'
            ],
            [
                'page_number' => 47,
                'content' => '<div class="page" id="47"> <p class="text-end page-number">#47</p>

<p>
  Volmaaktheden verlangen immers naar onthulling in het bijzijn van toeschouwers die ze met uitingen van
  <span class="text-italic">“mâshâ’ALLAH”</span> waarderen en bewonderen. Daarnaast willen permanente Volmaaktheden permanent zichtbaar
  zijn, wat weer het voortbestaan van waarderende bewonderaars vereist. Want in de ogen van een bewonderaar
  die niet blijvend is, zullen Volmaaktheden hun waarde verliezen.<sup>2</sup>
</p>

<p>
  En zoals het daglicht de zon kenbaar maakt, zo onthullen de mooie, kunstrijke, stralende en sierlijke wezens
  die over het aangezicht van het universum zijn uitgespreid, de sublimiteit van een onvergelijkelijke, spirituele
  Schoonheid; ze kenschetsen de subtiliteiten van een verborgen, weergaloze Pracht.<sup>3</sup> De glimpen van de
  Onberispelijke Pracht en Heilige Schoonheid beduiden dat in elke Goddelijke Naam vele verborgen schatten schuilen.
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>2</sup> Waarlijk, zoals een klassiek voorbeeld luidt, was er eens een schone dame van wereldklasse die een ordinaire
    beminnaar van zich wegjoeg. Om zichzelf te troosten, zei die man: <span class="text-italic">“Bah, wat was zij lelijk zeg!”</span>
    Zodoende verloochenende hij de schoonheid van die schone vrouw. Ook was er eens een beer die onder een zoete
    druiventros kroop om druiven te eten. Echter, zijn klauwen reikten niet tot die druiven, noch was hij in staat om
    de druivenstok te beklimmen. Om zichzelf te troosten, zei hij in zijn eigen taal: <span class="text-italic">“Die druiven zijn vast
    en zeker zuur”</span>, waarna hij brommend wegslenterde.
  </p>
  <p class="footnote-p">
    <sup>3</sup> Terwijl wezens in hun rol als spiegels achtereenvolgens vergaan en verdwijnen, zijn de glimpen van diezelfde
    pracht en schoonheid te zien op de gedaantes en gelaten van hun opvolgers. Dit laat zien dat die Schoonheid niet
    hen toebehoort... Die Schoonheden zijn veeleer Aya’s en tekenen van een Onberispelijke Pracht en een Heilige
    Schoonheid.
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 48,
                'content' => '<div class="page" id="48"> <p class="text-end page-number">#48</p>

<p>
  Voorwaar, de Bezitter van een verborgen Schoonheid Die zo verheven en onvergelijkelijk is, zal Zijn Eigen
  Pracht in een spiegel willen aanschouwen, en de niveaus van Zijn Pracht, de dimensies van Zijn Schoonheid,
  middels een bewuste en smachtende weerspiegelaar willen bezichtigen. Bovendien zal Hij door anderen
  gezien willen worden om Zijn geliefde Schoonheid ook door hun ogen waar te nemen.
</p>

<p class="text-bold">
  Hij wil Zijn Schoonheid dus op twee manieren aanschouwen:
</p>

<p>
  <span class="text-italic text-bold">Enerzijds</span> wil Hij Zijn Schoonheid in verscheidene spiegels met distinctieve kleuren direct aanschouwen.
</p>

<p>
  <span class="text-italic text-bold">Anderzijds</span> wil Hij Zijn Schoonheid door de ogen van smachtende toeschouwers en verwonderde bewonderaars bezichtigen.
</p>

<p>
  Pracht en Schoonheid willen dus zien en gezien worden. De realisatie van zien en gezien worden vereist
  het bestaan van smachtende toeschouwers en verwonderde bewonderaars. Omdat die Pracht en Schoonheid
  tevens eeuwig en onverwelkbaar zijn, verlangen Ze eveneens naar het permanente voortbestaan van Hun
  bewonderaars. Want een eeuwige Schoonheid kan geen genoegen nemen met een vergankelijke bewonderaar.
</p>

<p>
  Immers, een toeschouwer die gedoemd is tot eeuwige ondergang zonder wederkeer, zal bij de gedachte
  aan zijn eindigheid zijn liefde zien overgaan in haat; zijn verwondering zal uitlopen op een teleurstelling,
  zijn eerbied zal omslaan in minachting. Want de egocentrische mens is niet alleen vijandig tegenover het
  onbevattelijke, maar ook afkerig van het onbereikbare. Hierdoor kan zijn binnenwereld ten opzichte van een
</p>
  </div>'
            ],
            [
                'page_number' => 49,
                'content' => '<div class="page" id="49"> <p class="text-end page-number">#49</p>
<p>
  Schoonheid Die eeuwige liefde, eindeloze passie en grenzeloze bewondering verdient, vervuld zijn van vijandschap,
  wrok en ontkenning. Voorwaar, het geheim achter de vijandschap van een kafir jegens ALLAH kan
  hieruit worden begrepen.
</p>

<p>
  De grenzeloze Gulheid en Vrijgevigheid, de onvergelijkelijke Schoonheid en Pracht, en de feilloze
  Volmaaktheden in kwestie verlangen dus naar eeuwige dankbetuigers, aanbidders en bewonderaars...
</p>

<p>
  Desondanks zien wij dat iedereen in dit wereldse gastenverblijf spoedig vertrekt en verdwijnt. Bezoekers
  proeven maar een vleugje van die Vrijgevigheid. Hun eetlust wordt opgewekt, maar ze vertrekken voordat ze
  kunnen eten. Ze werpen slechts een vluchtige blik op een vonkje of een zwakke schaduw van die Schoonheid
  en Volmaaktheid, waarna ze onverzadigd vergaan.
</p>

<p class="text-bold">
  Ze trekken dus naar een eeuwig schouwparadijs.
</p>

<p class="text-italic text-bold">Conclusie:</p>

<p>
  Net zoals deze wereld met al haar wezens onmiskenbaar duidt op haar Ontzaglijke Kunstenaar, zo beduiden,
  onthullen en vereisen de Eigenschappen en de Heilige Namen van de Ontzaglijke Kunstenaar het oord van
  het hiernamaals.
</p>

  </div>'
            ],
            [
                'page_number' => 50,
                'content' => '<div class="page" id="50"> <p class="text-end page-number">#50</p>

<div class="text-center text-center-constrained">
  <p class="text-center text-bold small-title">De Vijfde Waarheid</p>
  <p class="text-center"><span class="text-italic text-bold">De poort van Mededogen en het Mohammedaanse dienaarschap</span> <span class="text-arabic-inline" dir="rtl" lang="ar">عَلَيْهِ ٱلصَّلَاةُ وَٱلسَّلَامُ</span><span class="text-italic text-bold">; Een glimp van de Namen: “de Antwoorder en de Genadige”</span></p>
  <p class="text-center">
    <span class="text-arabic" dir="rtl" lang="ar">اَلْمُجِيبُ وَالرَّحِيمُ</span>
  </p>
</div>

<p>
  Is het ooit voor mogelijk te houden dat een Heer met een eindeloze Meedogendheid en Genade: enerzijds
  de geringste behoefte van Zijn onbeduidendste schepsel ziet en vanuit onverwachte wegen met volmaakte
  Compassie bevredigt, de stilste aanroep van Zijn meest verborgen schepsel verneemt en redding schenkt, en
  op alle zowel verbale als non-verbale wensen reageert, terwijl Hij anderzijds de ultieme behoefte van Zijn
  grootste onderdaan<sup>1</sup> en geliefdste schepsel ziet maar
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>1</sup> Waarlijk, een eminentie die inmiddels 1350 jaar aan het hoofd staat van een sultanaat dat nog altijd heerst en door
    de eeuwen heen doorgaans meer dan 350 miljoen onderdanen beheert; een leider wiens volgelingen allemaal dagelijks
    hun eed van trouw opnieuw afleggen, terwijl ze zijn volmaaktheden bevestigen en zijn bevelen met volwaardige
    gehoorzaamheid opvolgen; een individu wiens spirituele tint de helft van de aarde en een vijfde van de mensheid heeft
    doordrenkt en bekleurd; een excellentie die de geliefde der harten en de opvoeder der zielen is geworden, zal uiteraard
    de uitverkoren onderdaan zijn van de Heer Die over dit universum regeert.
  </p>
  <p class="footnote-p">
    En wanneer de meeste bestaansvormen in het universum elk één van zijn miraculeuze vruchten voor hem dragen om
    zijn missie en functie toe te juichen, dan is het niet meer dan vanzelfsprekend dat die eminentie het allergeliefdste
    schepsel van de Schepper der kosmos is.
  </p>
  <p class="footnote-p">
    Tevens is eeuwigheid een behoefte van de gehele mensheid waarnaar ze met al haar potenties verlangt. &rarr;
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 51,
                'content' => '<div class="page" id="51"> <p class="text-end page-number">#51</p>

<p>
  niet bevredigt en vervult, en de meest verheven bede verneemt maar niet aanvaardt?
</p>

<p>
  Waarlijk, de zichtbare gratie en geriefelijkheid in bijvoorbeeld de wijze waarop zwakke en jonge dieren in
  onderhoud en opvoeding worden voorzien, tonen aan dat de Eigenaar van dit universum Zijn Heerschappij
  met een grenzeloze Genade voert. Is het dan mogelijk dat zo’n Meedogendheid, Die zo Genadig over de
  Goddelijke Heerschappij heerst, de mooiste bede van de voortreffelijkste der schepselen niet zal verhoren?
</p>

<p>
  Deze waarheid die ik reeds in “Het Negentiende Woord” heb uitgelegd, zullen wij hier wederom als
  volgt ontvouwen... O vriend die meeluistert met mijn nefs! In het symbolische verhaal hadden wij het over
  een bijeenkomst op een eiland waar een nobele adjudant een toespraak voorlas. We zullen nu de waarheid
  van deze symboliek ophelderen.
</p>

<p>
  Kom, laten wij ons van het heden onthechten, in gedachten naar de gelukzalige eeuw reizen en het Arabische
  schiereiland bezoeken, opdat wij de Nobelste Godsbode tijdens de uitvoering van zijn missie en de
  beoefening van zijn dienaarschap kunnen ontmoeten. Aanschouw! Zoals deze eminentie op basis van zijn
  profeetschap en leiding de sleutelpersoon en het middel is voor de verwerving van eeuwige gelukzaligheid,
  zo is hij op basis van zijn dienaarschap en bede eveneens de bestaansreden van die gelukzaligheid en de
  aanleiding voor de schepping van het paradijs.
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    Want deze behoefte haalt de mens uit de diepste diepten en eleveert hem tot de allerhoogste hoogtes. Uiteraard
    is deze behoefte een ultieme behoefte die de uitverkoren onderdaan namens allen aan de Vervuller van behoeften zal
    voordragen.
  </p>
</div>
  </div>'
            ],
            [
                'page_number' => 52,
                'content' => '<div class="page" id="52"> <p class="text-end page-number">#52</p>

<p>
  Kijk nu mee! Terwijl die eminentie om eeuwige gelukzaligheid bidt, staat hij in zo’n sublieme salaat en in
  zo’n verheven gebed, dat vrijwel dit hele schiereiland, en zelfs de hele aarde, zich bij zijn majestueuze salaat
  aansluiten en met hem meebidden. Zijn dienaarschap omvat immers niet alleen het dienaarschap van zijn
  volgzame oemma, maar belichaamt op basis van het unanimiteitsgeheim ook het collectieve dienaarschap
  van alle profeten.
</p>

<p>
  Bovendien verricht hij die sublieme salaat en zijn smeekbede te midden van zo’n geweldige gemeenschap,
  dat vrijwel alle verlichte en volmaakte Adamskinderen, vanaf de tijd van Adam tot het heden en voorts tot
  aan de oordeelsdag volgzaam met hem meedoen en “âmîn” op zijn bede zeggen.<sup>2</sup>
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>2</sup> Waarlijk, vanaf het moment waarop de Ahmedaanse smeekbede <span class="text-arabic-inline" dir="rtl" lang="ar">ﷺ</span> werd
    verricht tot aan het heden gelden alle salaats en zegenwensen van heel zijn oemma als een ononderbroken en gezamenlijk
    uitgesproken “âmîn” op zijn bede. Zelfs elke zegen die hem wordt toegewenst, geldt als een afzonderlijke “âmîn” op zijn bede.
    De salaat en vrede die tijdens elk gebed door ieder lid van zijn oemma over hem worden afgebeden, en de bede die de volgers
    van de Shafi-school na elke iqama voor hem verrichten, gelden als een zeer krachtige en gemeenschappelijke “âmîn” op zijn
    bede om eeuwige gelukzaligheid.
  </p>
  <p class="footnote-p">
    Voorwaar, om oneindigheid en eeuwige gelukzaligheid te bereiken – <span class="text-italic">waar ieder mens in de natuurlijke taal van zijn
    menselijke aard tot al zijn kracht naar verlangt</span> – bidt de profeet Ahmed <span class="text-arabic-inline" dir="rtl" lang="ar">ﷺ</span> namens de
    gehele mensheid, waarop de verlichte mensen achter hem “âmîn” zeggen.
  </p>
  <p class="footnote-p text-bold">
    Is het ooit voor mogelijk te houden dat deze bede onverhoord zal blijven?
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 53,
                'content' => '<div class="page" id="53"> <p class="text-end page-number">#53</p>

<p>
  Kijk! De behoefte aan eeuwigheid waarvoor hij bidt is zo universeel, dat niet alleen de aardbewoners, maar
  ook de hemelingen en zelfs alle wezens zich aansluiten bij zijn smeekbede; in de taal van hun houding zeggen ze:
</p>

<p class="text-italic text-bold">
  “O Heer, vervul zijn wens! Verhoor zijn bede! Ook wij verlangen dit!”
</p>

<p>
  En kijk, de wijze waarop hij om eeuwige gelukzaligheid bidt, is zo ontroerend, zo liefdevol, zo vurig en zo
  deemoedig, dat hij het hele universum tot tranen roert en meevoert om aan zijn bede deel te nemen.
</p>

<p>
  Kijk! Hij beoogt daarenboven zo’n nobel doel wanneer hij om gelukzaligheid bidt, dat hij daarmee de mens
  evenals alle schepselen vanuit de diepste laagtes van complete vernietiging, verderf, onwaarding, nutteloosheid
  en futiliteit, verheft tot de hoogste hoogtes van waarde en eeuwigheid, waarbij ze een verheven functie bekleden
  als <span class="text-italic text-bold">“de Schrifturen van de Soevereine”</span>.
</p>

<p>
  Kijk! Hij bidt met zo’n verheven intensiteit en smeekt met zo’n zoete aanroep, dat zijn stem als het ware
  het hele bestaan, de hemelen en het Oppertoon bereikt, in vervoering brengt en aanzet tot het uiten van:
  <span class="text-italic text-bold">“Âmîn o ALLAH, âmîn!”</span><sup>3</sup>
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>3</sup> Waarlijk, aangezien de Beheerder van deze wereld al Zijn beschikkingen willens en wetens waarneembaar
    met Wijsheid ten uitvoer brengt, is het geenszins mogelijk dat Die Beheerder onbewust en onwetend is van wat het
    uitverkoren individu onder Zijn creatie verricht.
  </p>
  <p class="footnote-p">
    Aangezien Die Alwetende Beheerder op de hoogte is van wat dat uitverkoren individu verricht en verzoekt, is het
    eveneens geenszins mogelijk dat Hij daar onverschillig tegenover zou blijven en er geen waarde aan zou hechten. &rarr;
  </p>
</div>
  </div>'
            ],
            [
                'page_number' => 54,
                'content' => '<div class="page" id="54"> <p class="text-end page-number">#54</p>

<p>
  Kijk! Degene tot Wie hij bidt om gelukzaligheid en eeuwigheid is tevens zo Alhorend, Generous en Almachtig,
  zo Alziend, Genadig en Alwetend, dat Die Majesteit klaarblijkelijk de geheimste wens en stilste aanroep van
  de meest verborgen levensvorm ziet, verneemt en meedogend verhoort.
</p>

<p class="text-italic text-bold">
  Zelfs wanneer een wens in de taal van houding wordt uitgedrukt, reageert Hij daarop.
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    En aangezien Die Almachtige en Genadige Beheerder niet onverschillig zal blijven tegenover de beden van de
    uitverkorene, is het eveneens geenszins mogelijk dat Hij ze niet zal verhoren.
  </p>

<p class="footnote-p">
  Waarlijk, dankzij de Lichternis van de Ahmedaanse Persoonlijkheid <span class="text-arabic-inline" dir="rtl" lang="ar">ﷺ</span>
  is de gestalte van de wereld veranderd. De ware aard van de mens en het hele universum is dankzij dat Licht
  verschenen; dientengevolge is gebleken dat elke creatie in dit universum een brief is van de Soevereine
  <span class="text-italic">(Samed)</span> waarvan Goddelijke Namen kunnen worden afgelezen; ieder schepsel is een aangestelde functionaris
  met een waardevol en betekenisvol bestaan bestemd voor eeuwigheid. Zonder dat Licht zou het bestaan als
  waardeloos, betekenisloos, zinloos, futiel en warrig speeltje van toevalligheden hopeloos verstrikt blijven in de
  duisternissen van waan, gedoemd tot absolute vernietiging.
</p class="footnote-p">

<p class="footnote-p">
  Voorwaar, vanwege dit geheim zeggen niet alleen mensen “âmîn” op de beden van de Ahmedaanse Persoonlijkheid
  <span class="text-arabic-inline" dir="rtl" lang="ar">ﷺ</span>, maar ook het hele bestaan, vanaf de Oppertoon tot aan de aardbodem,
  de geosfeer tot aan de Pleiaden, toont een trotse verbondenheid met zijn Lichternis. De ziel van het Ahmedaanse
  dienaarschap <span class="text-arabic-inline" dir="rtl" lang="ar">ﷺ</span> is in feite een bede. In wezen zijn alle bewegingen en
  diensten van het heelal een vorm van bede.
</p>

<p class="footnote-p">
  <span class="text-italic text-bold">Bijvoorbeeld,</span> de beweging van een zaadje geldt als een bede aan zijn Schepper om uit te
  mogen bloeien tot boom...
</p>
</div>

  </div>'
            ],
            [
                'page_number' => 55,
                'content' => '<div class="page" id="55"> <p class="text-end page-number">#55</p>

<p>
  Hij begenadigt en reageert met zo’n Wijsheid, Alziendheid en Genadigheid, dat het een einde maakt
  aan alle twijfel:
</p>

<p class="text-italic text-bold">
  De alomheersende vorming en voorzienigheid worden uitsluitend door de Alhorende en Alziende gerealiseerd,
  en kunnen alleen aan de Genereuze en Genadige worden toegekend.
</p>

<p>
  Terwijl de glorie der mensheid en tijdeloze uitblinker van het bestaan alle adamskinderen op aarde achter
  zich verzamelt en zijn handpalmen tot de Oppertoon richt om te bidden binnen de waarheidskring van het
  Ahmedaanse dienaarschap <span class="text-arabic-inline" dir="rtl" lang="ar">ﷺ</span>, waarin de essentie van het menselijke
  dienaarschap schuilt, rijst de vraag waar deze trots van het universum om smeekt. Laten wij luisteren...
</p>

<p>
  Kijk! Voor zowel zichzelf als zijn oemma wenst hij eeuwige gelukzaligheid. Hij wil oneindigheid; hij wil
  het paradijs. En de wensen van alle Heilige Goddelijke Namen Die Hun Schoonheden in de spiegels der
  wezens weergeven, betrekt hij bij zijn verzoeken. Hij vraagt Die Namen om te bemiddelen, je ziet het.
</p>

<p>
  Al zouden de ontelbare redenen en bewijzen voor het bestaan van het hiernamaals ontbreken, dan zou
  één enkele bede van deze eminentie alsnog voldoende zijn voor de Genadige Schepper om het paradijs te
  creëren, wat ten aanzien van Zijn Macht zo licht is als de creatie van onze lente.<sup>4</sup>
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>4</sup> Waarlijk, op het aardoppervlak – <span class="text-italic">dat in verhouding tot het hiernamaals slechts een knappe pagina is</span> –
    worden vele voortreffelijke voorbeelden van kunst, en talloze illustraties van de herzameling en de herrijzenis
    tentoongesteld; &rarr;
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 56,
                'content' => '<div class="page" id="56"> <p class="text-end page-number">#56</p>

<p>
  Waarlijk, voor de Absolute Almacht Die gedurende onze lente het aardoppervlak in een verzamelplaats
  verandert en honderdduizend voorbeelden van de herzameling creëert, kan de creatie van het paradijs toch
  niet bezwarend zijn?
</p>

<p class="text-bold">Kortom:</p>

<p>
  Net zoals het profeetschap van de eindprofeet tot de totstandkoming van dit beproevingsoord heeft geleid
  en hem de bestemming heeft gemaakt van het geheim:
  <sup>5</sup><span class="text-arabic-inline" dir="rtl" lang="ar">لَوْلَاكَ لَوْلَاكَ لَمَا خَلَقْتُ اْلأَفْلَاكَ</span>,
  zo heeft zijn dienaarschap tot de ontluiking van het rijk der gelukzaligheid geleid.
</p>

<p>
  Is het dan voor mogelijk te houden dat de evidente orde in de wereld – <span class="text-italic">die alle verstanden versteld doet
  staan</span> – het onberispelijke kunstenaarschap – <span class="text-italic">dat met Genade is doordrenkt</span> – en de onvergelijkelijke schoonheid
  – <span class="text-italic">die de Goddelijke Heerschappij heeft vervuld</span> – ooit zoiets lelijks, zoiets genadeloos en zoiets ordeloos als
  het onbeantwoord laten van zijn bede zouden permitteren?
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    op die enkele pagina worden meer dan driehonderdduizend soorten uitgebalanceerde creaties als boeken uiterst ordelijk
    geschreven en vastgelegd. Dit is uiteraard uitdagender dan de bouw en schepping van het elegante en gestructureerde
    paradijs in het ruime rijk van het hiernamaals.
  </p>
  <p class="footnote-p">
    Waarlijk, net zoals het paradijs veruit verheven is boven de lente, kan verondersteld worden dat de schepping van de
    lentetuinen in gelijke mate gecompliceerder en verbazender is dan die van het paradijs.
  </p>
  <p class="footnote-p">
    <sup>5</sup> <span class="text-italic text-bold">“Was het niet voor jou, was het niet voor jou, dan had Ik de hemelsferen niet geschapen.”</span>
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 57,
                'content' => '<div class="page" id="57"> <p class="text-end page-number">#57</p>

<p>
  Met andere woorden, zou de Schepper de simpelste en onbeduidendste wensen en stemmen aandachtig
  aanhoren, inwilligen en vervullen, maar de belangrijkste en dringendste wensen waardeloos achten, niet
  begrijpen en negeren? God verhoede, dit is geenszins mogelijk! Een dergelijke Schoonheid kan nimmer zoiets
  lelijks aanvaarden en verlelijken.<sup>6</sup>
</p>

<p class="text-center text-bold">Conclusie:</p>

<p class="text-center text-bold text-center-constrained">
  Zoals de Nobelste Godsbode <span class="text-arabic-inline" dir="rtl" lang="ar">عَلَيْهِ ٱلصَّلَاةُ وَٱلسَّلَامُ</span> de poort tot de wereld heeft geopend met zijn
  profeetschap, zo ontgrendelt hij de poort tot het hiernamaals met zijn dienaarschap.
</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">
  عَلَيْهِ صَلَوَاتُ الرَّحْمٰنِ مِلْءَ الدُّنْيَا وَدَارِ الْجِنَانِ<sup>7</sup>
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>6</sup> Waarlijk, het is universeel aanvaard dat de omvorming van waarheden onmogelijk is. Onder de varianten daarvan
    valt iets dat omvormt tot zijn tegenpool onder een meerlagige onmogelijkheid. Vooral als het gaat om iets dat enerzijds
    zijn wezenlijke hoedanigheid behoudt, terwijl het anderzijds tegelijkertijd in zijn tegenpool verandert, is er sprake van
    een duizendvoudige onmogelijkheid. Denk bijvoorbeeld aan een eindeloze schoonheid die tegelijkertijd zowel daadwerkelijk
    mooi als lelijk is.
  </p>
  <p class="footnote-p">
    Voorwaar, in onze context zou dit suggereren dat de Schone Heerschappij, Die waarneembaar en onbetwistbaar bestaat,
    enerzijds Haar inherente Schoonheid behoudt, terwijl Ze anderzijds tegelijkertijd wezenlijk lelijk wordt. Voorwaar, onder
    alle onmogelijkheden en verzinsels in de wereld staat deze bovenaan de lijst der absurditeiten...
  </p>
  <p class="footnote-p">
    <sup>7</sup> Mogen de zegeningen van de Genadige naar de omvang van de aarde en het oord der paradijzen op hem neerdalen.
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 58,
                'content' => '<div class="page" id="58"> <p class="text-end page-number">#58</p>
<p class="text-center-constrained">
  <span class="text-arabic delima-font" dir="rtl" lang="ar">
    اللّٰهُمَّ صَلِّ وَسَلِّمْ
    عَلَى عَبْدِكَ وَرَسُولِكَ ذٰلِكَ الْحَبِيبِ الَّذِى
    هُوَ سَيِّدُ الْكَوْنَيْنِ وَفَخْرُ الْعَالَمَيْنِ وَحَيَاةُ الدَّارَيْنِ
    وَسِيلَةُ السَّعَادَتَيْنِ وَذُو الْجَنَاحَيْنِ وَرَسُولُ الثَّقَلَيْنِ
    وَعَلٰى اٰلِهِ وَصَحْبِهِ اَجْمَعِينَ
    وَعَلٰى اِخْوَانِهِ مِنَ النَّبِيِّينَ وَالْمُرْسَلِينَ
    اٰمِينَ<sup>8</sup>
  </span>
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>8</sup> O ALLAH, laat zegeningen en vrede neerdalen over Uw dienaar en Uw gezant; de geliefde die gekenmerkt is als de
    meester van beide dimensies, de trots van beide werelden, het leven van beide domeinen en het middel tot beide
    gelukzaligheden, de tweevleugelige boodschapper voor zowel mens als djinn, en over al zijn familieleden en metgezellen,
    en over zijn gebroeders onder de gezanten en profeten... Âmîn.
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 59,
                'content' => '<div class="page" id="59"> <p class="text-end page-number">#59</p>

<div class="text-center text-center-constrained">
  <p class="text-center text-bold small-title">De Zesde Waarheid</p>
  <p class="text-center"><span class="text-italic text-bold">De poort van Majesteit en Oneindigheid; Een glimp van de Namen: “de Ontzaglijke en de Eeuwige”</span></p>
  <p class="text-center">
    <span class="text-arabic" dir="rtl" lang="ar">اَلْجَلِيلُ وَالْبَاقِى</span>
  </p>
</div>

<p>
  Is het ooit voor mogelijk te houden dat een Majesteitelijke Heerschappij, waarbij alle bestaansvormen –
  <span class="text-italic">vanaf de zonnen en bomen tot aan de atomen</span> – als gehoorzame soldaten worden beheerst en beheerd,
  slechts beperkt kan zijn tot dit wereldse gastenverblijf waar arme stervelingen een vluchtig leven leiden? Zal de Heerser
  geen blijvend, oneindig domein conform Zijn Majesteit, geen eeuwig, verheven centrum voor Zijn Heerschappij creëren?
</p>

<p>
  Waarlijk, de majesteitelijke processen zoals de seizoenen die systematisch veranderen, de imponerende
  bewegingen zoals de wentelingen van planeten die als vliegende vaartuigen voortreizen, de geweldige
  betuigingen die de aarde voor de mens als wieg en de zon voor de aardbewoners als lamp doen dienen,
  de geweldige overgangen zoals de wederopwekking en optooiing van het dode en dorre aardoppervlak,
  en dergelijke zichtbare verschijnselen in het universum tonen altezamen aan dat vanachter de schermen
  een fenomenale Heerschappij van een grandioos Sultanaat regeert. Een Heerschappij Die over een dusdanig
  Sultanaat wordt gevoerd, behoeft waardige onderdanen en een aansluitend manifestatieveld.
</p>

<p>
  Echter, je ziet dat de aanzienlijkste onderdanen en getrouwen met de omvattendste aard in een zorgelijke
  staat tijdelijk zijn bijeengekomen in dit aardse gasten-
</p>

  </div>'
            ],
            [
                'page_number' => 60,
                'content' => '<div class="page" id="60"> <p class="text-end page-number">#60</p>

<p>
  verblijf. Ondertussen loopt het verblijf zelf elke dag vol en leeg.
</p>

<p>
  Overigens verblijven alle onderdanen tijdelijk op dit beproevingsterrein om hun dienstbaarheid op de proef
  te stellen. Ondertussen ondergaat het terrein zelf ieder uur verandering.
</p>

<p>
  Tevens vertoeven al die onderdanen enkele minuten in deze tentoonstellingsruimte om in de wonderlijke
  galerijen van de wereldse marktplaats de voorbeelden van de kostbare geschenken en de antieke kunstwerken
  van de Ontzaglijke Kunstenaar met een handelaarsblik te bezichtigen, waarna ze verdwijnen. Ondertussen
  maakt deze tentoonstellingsruimte zelf elke minuut een overgang door. Wie vertrekt, komt niet terug; wie
  komt, zal vroeg of laat vertrekken.
</p>

<p>
  Waarlijk, deze omstandigheden tonen ongetwijfeld aan dat voorbij dit gastenverblijf, dit terrein en deze
  tentoonstellingsruimte, in een domein waar het centrum en manifestatieveld van dat oneindige Sultanaat
  zijn gelegen, eeuwige paleizen en permanente woningen zijn gevestigd, omgeven met tuinen en schatten
  gevuld met de zuiverste en verhevenste oervormen van alle voorbeelden en verschijnselen die wij in deze
  wereld waar hebben mogen nemen. De inspanningen hier zijn dus daarvoor bedoeld. Hier wordt gewerkt,
  daar wordt beloning verstrekt. Voor iedereen is daar een gelukzaligheid conform zijn potentie weggelegd,
  mits hij niet tot de verliezers behoort.
</p>

<p>
  Waarlijk, het is ondenkbaar dat zo’n oneindig Sultanaat beperkt is tot deze vergankelijke wezens en
  vervliegende schimmen op aarde. Observeer deze waarheid door de verrekijker van deze gelijkenis:
</p>

  </div>'
            ],
            [
                'page_number' => 61,
                'content' => '<div class="page" id="61"> <p class="text-end page-number">#61</p>
<p>
  Stel je voor dat jij tijdens een reis een herberg langs de weg ontwaart die een hoogachtbaar individu voor
  zijn bezoekers heeft opgebouwd. Om zijn gasten een nacht ter lering en vermaak te bieden, besteedt hij
  miljoenen goudstukken aan de decoratie van de herberg. De gasten worden een korte tijd gegund om een
  vluchtige blik op enkele versieringen te werpen en een vleugje van de aanwezige gunsten te proeven, waarna
  ze onverzadigd vertrekken.
</p>

<p>
  Echter, elke bezoeker legt met zijn persoonlijke camera beelden vast van de verschijningen die hij in de
  herberg aantreft. Daarnaast houden de bedienden van het hoogachtbaar individu de gedragingen van de
  gasten zorgvuldig bij; ze registreren alles. Ook zie je dat die gastheer dagelijks de waardevolle decoraties
  grotendeels afbreekt, en nieuwe versieringen voor de nieuwe gasten vervaardigt.
</p>

<p>
  Nadat jij dit hebt aanschouwd, zou jij het dan nog betwijfelen dat de gastheer – <span class="text-italic">die langs deze weg deze
  herberg heeft gebouwd</span> – over oneindige, hemelse woonverblijven; over onuitputtelijke, waardevolle schatten,
  en over een onophoudelijke, geweldige vrijgevigheid beschikt? Met de gastvrijheid die hij in deze herberg
  demonstreert, wekt hij bij zijn gasten de interesse op voor alles wat hij in zijn nabijheid bewaart. Daarnaast
  ontketent hij een verlangen naar de geschenken die hij voor hen heeft klaargemaakt.
</p>

<p>
  Evenzo, wanneer je de toestand van dit aardse gastenverblijf zonder dronkenschap aandachtig observeert,
  dan zul je de navolgende “Negen Kernpunten” ontwaren:
</p>
  </div>'
            ],
            [
                'page_number' => 62,
                'content' => '<div class="page" id="62"> <p class="text-end page-number">#62</p>

<p class="text-bold">Het Eerste Kernpunt</p>

<p>
  Je zult ontwaren dat deze wereld – <span class="text-italic">evenals die herberg</span> – niet voor haarzelf bestaat... het is ondenkbaar
  dat ze uit haarzelf deze gedaante heeft aangenomen. Ze is veeleer volgens wijsheid opgericht als een aldoor
  vol- en leeglopen gastverblijf voor de karavanen der schepselen die komen en gaan.
</p>

<p class="text-bold">Het Tweede Kernpunt</p>

<p>
  Je zult ontwaren dat de bewoners van deze herberg gasten zijn; hun Genereuze Heer nodigt hen uit naar
  het vredesoord.
</p>

<p class="text-bold">Het Derde Kernpunt</p>

<p>
  Je zult ontwaren dat de decoraties in deze wereld niet alleen voor genot of vermaak zijn bedoeld. Immers,
  ondanks dat aardse bekoorlijkheden kortstondig genot verschaffen, levert de scheiding met ze langdurig leed op.
  Ze geven je een voorproef, ontvlammen verlangens, maar verzadigen niet. Want de levensduur van ofwel het
  aardse schoon ofwel jou is te kort om verzadiging te schenken. Deze waardevolle doch kortstondige mooiheden
  zijn dus bedoeld om lering te bieden<sup>1</sup>, dankbaarheid te ontwaken en interesse voor hun onvergankelijke
  oervormen op te roepen. Zo dienen ze nog velerlei verheven doeleinden.
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>1</sup> Waarlijk, hoewel de waarde en kunstzinnige complexiteit van elk schepsel hoogverheven en fraai zijn, heeft het een
    korte levensduur. Dit geeft aan dat deze schepselen voorbeelden zijn; ze dienen als illustraties van andere bestaansvormen.
    En aangezien er een sfeer heerst waarin ze de aandacht van hun klanten op hun oervormen lijken te richten, kan uiteraard
    geconcludeerd, beargumenteerd en bevestigd worden dat zulke sierlijke schepselen in deze wereld voorbeelden zijn van de
    paradijselijke gunsten die de Barmhartige Genadige voor Zijn geliefde dienaren heeft bereid.
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 63,
                'content' => '<div class="page" id="63"> <p class="text-end page-number">#63</p>

<p class="text-bold">Het vierde fundament</p>

<p>
  Je zult ontwaren dat de decoraties in deze wereld als voorbeelden en illustraties dienen van de gunsten voor
  de gelovigen die bij de Genade van de Barmhartige in het paradijs zijn opgeslagen.<sup>2</sup>
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>2</sup> Waarlijk, elk schepsel heeft verscheidene bestaansredenen en verschaft meerdere levensresultaten die niet beperkt
    zijn tot alleen het aardse en de nefs – <span class="text-italic">zoals gewaand wordt door de dwalers.</span> Een schepsel kan dus niet
    bevlekt worden met zinloosheid en onwijsheid. Voorzeker, de bestaansredenen en levensresultaten van elk schepsel
    worden onderverdeeld in drie categorieën.
  </p>
  <p class="footnote-p">
    <span class="text-bold">De eerste en meest verheven categorie</span> is gericht op zijn Kunstenaar. Hierbij behoren de voortreffelijke juwelen van
    Goddelijke Kunstenaarschap waarmee een schepsel is getooid, paradegewijs gepresenteerd te worden ter aanschouwing van
    de Tijdeloze Getuige. Voor deze Goddelijke Aanschouwing is een voorbijflitsend levensmoment voldoende. Zelfs de potentie
    van een schepsel, die als een ongerealiseerde intentie niet tot ontplooiing is kunnen komen, is hierbij voldoende. Voorwaar,
    de delicate creaties die snel vergaan, en de kunstrijke wonderwerken in de vorm van zaden en pitten die zich niet
    materialiseren, oftewel niet ontkiemen, voldoen volledig aan dit doel; ze zijn immuun voor nutteloosheid en futiliteit.
    Het primaire doel van elk schepsel impliceert dus: de machtsmirakelen en kunstwerken van zijn Kunstenaar met zijn leven
    en bestaan tentoonstellen, en deze ter aanschouwing van de Ontzaglijke Sultan presenteren.
  </p>
  <p class="footnote-p">
    <span class="text-bold">De tweede categorie</span> van bestaansredenen en levensresultaten is gericht op bewuste wezens. Hierbij dient elk schepsel
    als een waarheid onthullende brief, een subtiele ode en een zinrijk woord van de Ontzaglijke Kunstenaar dat gepresenteerd
    wordt ter aanschouwing van engelen, djinns, dieren en mensen; het nodigt ze uit tot contemplatie. Voor ieder bewust wezen
    dat naar een dergelijk schepsel kijkt, is het dus een leerrijke bron van bezinning. &rarr;
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 64,
                'content' => '<div class="page" id="64"> <p class="text-end page-number">#64</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <span class="text-bold">De derde categorie</span> van bestaansredenen en levensresultaten is gericht op de nefs <span class="text-italic">(het eigen zelf)</span>
    van een schepsel. Hierbij staan genot, amusement, overleven, comfort en dergelijke specifieke resultaten centraal.
    Bijvoorbeeld, als wij kijken naar het doel van een onderdaan die als stuurman dient op een groot sultansschip, dan zien wij
    dat slechts één procent van alle scheepsaangelegenheden betrekking heeft op zijn persoonlijke loon, terwijl negenennegentig
    procent gewijd is aan de sultan. Evenzo geldt voor elk schepsel dat wanneer één doel bestemd is voor zijn nefs en de wereld,
    negenennegentig doelen gericht zijn tot zijn Kunstenaar.
  </p>
  <p class="footnote-p">
    Voorwaar, deze uiteenlopende doelen zorgen ervoor dat wijsheid en zuinigheid harmoniëren met hun ogenschijnlijke tegenpolen,
    bestaande uit vrijgevigheid en gulheid – <span class="text-italic">met name Gods grenzeloze Gulheid.</span> Het geheim van deze harmonie is het
    volgende:
  </p>
  <p class="footnote-p">
    Uit het oogpunt van specifieke doelen heersen vrijgevigheid en gulheid. Hierbij manifesteert de Naam: <span class="text-bold">“de Vrijgevige”</span>.
    In het kader van zulke specifieke doelen is er bijvoorbeeld een overvloed aan vruchten en granen, wat een grenzeloze
    vrijgevigheid weergeeft. Echter, uit het oogpunt van universele doelen heerst wijsheid. Hierbij manifesteert de Naam:
    <span class="text-bold">“de Alwijze”.</span> Zoals een rijk beladen boom vele vruchten draagt, zo bevat elke vrucht eveneens velerlei doelen
    die onderverdeeld zijn in de voornoemde drie categorieën. Deze universele doelen geven dus een eindeloze wijsheid en
    zuinigheid weer. Zo komen eindeloze wijsheid en grenzeloze gulheid als ogenschijnlijke tegenpolen feilloos bijeen.
    <span class="text-italic text-bold">Bijvoorbeeld,</span> een doel van een leger is de handhaving van de openbare orde. Voor dit doel zijn er soldaten
    in overvloed en kan hun aantal zelfs te veel lijken. Echter, voor taken zoals het bewaken van grenzen en het bestrijden
    van vijanden is dit aantal net voldoende en aldus perfect in balans met wijsheid. Zo wordt de wijsheid van een regering
    met haar majesteit verenigd. Aldus kan men stellen dat er in dat leger geen sprake is van overbodigheid.
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 64,
                'content' => '<div class="page" id="64"> <p class="text-end page-number">#64</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <span class="text-bold">De derde categorie</span> van bestaansredenen en levensresultaten is gericht op de nefs <span class="text-italic">(het eigen zelf)</span>
    van een schepsel. Hierbij staan genot, amusement, overleven, comfort en dergelijke specifieke resultaten centraal.
    Bijvoorbeeld, als wij kijken naar het doel van een onderdaan die als stuurman dient op een groot sultansschip, dan zien wij
    dat slechts één procent van alle scheepsaangelegenheden betrekking heeft op zijn persoonlijke loon, terwijl negenennegentig
    procent gewijd is aan de sultan. Evenzo geldt voor elk schepsel dat wanneer één doel bestemd is voor zijn nefs en de wereld,
    negenennegentig doelen gericht zijn tot zijn Kunstenaar.
  </p>
  <p class="footnote-p">
    Voorwaar, deze uiteenlopende doelen zorgen ervoor dat wijsheid en zuinigheid harmoniëren met hun ogenschijnlijke tegenpolen,
    bestaande uit vrijgevigheid en gulheid – <span class="text-italic">met name Gods grenzeloze Gulheid.</span> Het geheim van deze harmonie is het
    volgende:
  </p>
  <p class="footnote-p">
    Uit het oogpunt van specifieke doelen heersen vrijgevigheid en gulheid. Hierbij manifesteert de Naam: <span class="text-bold">“de Vrijgevige”</span>.
    In het kader van zulke specifieke doelen is er bijvoorbeeld een overvloed aan vruchten en granen, wat een grenzeloze
    vrijgevigheid weergeeft. Echter, uit het oogpunt van universele doelen heerst wijsheid. Hierbij manifesteert de Naam:
    <span class="text-bold">“de Alwijze”.</span> Zoals een rijk beladen boom vele vruchten draagt, zo bevat elke vrucht eveneens velerlei doelen
    die onderverdeeld zijn in de voornoemde drie categorieën. Deze universele doelen geven dus een eindeloze wijsheid en
    zuinigheid weer. Zo komen eindeloze wijsheid en grenzeloze gulheid als ogenschijnlijke tegenpolen feilloos bijeen.
    <span class="text-italic text-bold">Bijvoorbeeld,</span> een doel van een leger is de handhaving van de openbare orde. Voor dit doel zijn er soldaten
    in overvloed en kan hun aantal zelfs te veel lijken. Echter, voor taken zoals het bewaken van grenzen en het bestrijden
    van vijanden is dit aantal net voldoende en aldus perfect in balans met wijsheid. Zo wordt de wijsheid van een regering
    met haar majesteit verenigd. Aldus kan men stellen dat er in dat leger geen sprake is van overbodigheid.
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 65,
                'content' => '<div class="page" id="65"> <p class="text-end page-number">#65</p>

<p class="text-bold">Het Vijfde Fundament</p>

<p>
  Je zult ontwaren dat de bestemming van deze vergankelijke creaties geen vernietiging kan zijn; ze zijn
  niet geschapen om even te verschijnen en vervolgens te verdwijnen.
</p>

<p>
  Ze komen veeleer kortstondig in het bestaan bijeen en nemen een gewenste houding aan, opdat hun
  gedaantes opgenomen, hun gelijkenissen bewaard, hun betekenissen doorgrond en hun resultaten opgeslagen
  kunnen worden... Dit resulteert onder meer in de vereeuwiging van blijvende beelden voor het eeuwige
  volk. Verder zullen ze in het eeuwige rijk nog diverse doeleinden dienen.
</p>

<p>
  Een bewijs dat schepselen voor eeuwigheid zijn geschapen, niet voor vergankelijkheid zijn bestemd, en
  – <span class="text-italic">ondanks hun fysieke teloorgang</span> – in feite na hun taakvervulling worden vrijgesteld, kan worden
  afgeleid uit het feit dat een vergankelijk schepsel in één opzicht vergaat, terwijl het in velerlei opzichten
  blijft voortbestaan.
</p>

<p>
  Kijk bijvoorbeeld naar een bloem die zich als een woord van Goddelijke Macht manifesteert. Ze kijkt ons
  even glimlachend aan, waarna ze zich snel achter de sluier van vergankelijkheid verschuilt. Zoals een woord
  dat uit jouw mond vloeit, verdwijnt ze, terwijl ze duizenden gelijkenissen aan haar publiek nalaat. In evenredigheid
  met het aantal verstanden dat haar opneemt, vereeuwigt ze haar betekenissen in de geesten. Want nadat
  ze haar betekenis heeft ontvouwd, is haar taak volbracht, waarna ze vertrekt. Echter, voordat ze vertrekt,
  laat ze haar fysieke gedaante in de geheugens
</p>

  </div>'
            ],
            [
                'page_number' => 66,
                'content' => '<div class="page" id="66"> <p class="text-end page-number">#66</p>

<p>
  van al haar toeschouwers en haar spirituele wezen in al haar zaden na. Elk geheugen en elk zaad zijn als
  het ware een foto waarop haar schoonheid wordt bewaard en een burcht waarin haar voortbestaan wordt
  gewaarborgd.
</p>

<p>
  Indien dit het geval is bij een kunstwerk dat zich op het simpelste levensniveau bevindt, kun je wel nagaan
  hoezeer de mens, die zich op het allerhoogste levensniveau bevindt en een eeuwige ziel bezit, in relatie staat
  tot de eeuwigheid. De wijze waarop de samenstellingswet – <span class="text-italic">die verwant is aan een ziel</span> – en de gelijkenis van
  elke grote bloem- en vruchtdragende plant gedurende woelige ontwikkelingsstadia uiterst ordelijk in minuscule
  zaden worden vereeuwigd en bewaard, geeft aan hoezeer de bewuste en lumineuze mensenziel –
  <span class="text-italic">die als belichaming van een Goddelijke wet over een zeer omvattend en verheven wezen beschikt, en met
  een extern bestaan is bekleed</span> – verbonden is met de eeuwigheid.
</p>

<p class="text-bold">Het Zesde Fundament</p>

<p>
  Je zult ontwaren dat de mens niet als een dier met een touw om zijn nek vrij is gelaten om te grazen waar
  hij wil. Integendeel, alle beelden van zijn daden worden opgenomen en alle uitwerkingen van zijn handelingen
  worden vastgelegd voor rekenschap.
</p>

<p class="text-bold">Het Zevende Fundament</p>

<p>
  Je zult ontwaren dat de afbraak die de mooie schepselen van de lente en zomer in de herfst ondergaan,
  geen vernietiging is, maar een vrijstelling na de voltooiing van hun taken.<sup>3</sup> Daarnaast is het een ontrui-
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>3</sup> Waarlijk, wanneer vruchten, bloesems en bladeren verschijnen aan de toppen en takken van een boom, &rarr;
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 67,
                'content' => '<div class="page" id="67"> <p class="text-end page-number">#67</p>

<p>
  ming om ruimte vrij te maken voor de schepselen die de volgende lente zullen verschijnen; het is een voorbereiding
  op de komst van de nieuwe functionarissen en dienstplichtigen. Tevens is het een vermaning van
  de Feilloze voor bewuste wezens die door onachtzaamheid hun taken vergeten en door dronkenschap hun
  dankbetoon verzaken.
</p>

<p class="text-bold">Het Achtste Fundament</p>

<p>
  Je zult ontwaren dat de Tijdeloze Kunstenaar van deze tijdelijke wereld een ander, eeuwig rijk bezit
  waarnaar Hij Zijn dienaren dirigeert en waarvoor Hij een passie in hen ontvlamt.
</p>

<p class="text-bold">Het Negende Fundament</p>

<p>
  Je zult ontwaren dat de Barmhartige in dat rijk giften voor zijn uitverkoren onderdanen heeft bereid die
  door geen oog zijn aanschouwd, door geen oor zijn vernomen, en in geen mensenhart zijn opgekomen. Dit
  is wat wij geloven...
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    die zich manifesteert als een voedingsschat van Genade, dan verwelken ze geleidelijk. Nadat ze hun taak voltooien,
    behoren ze te vertrekken, opdat de poort voor hun navolgende plaatsvervangers niet wordt gesloten. Anders zal de
    omvang van Genade ingeperkt en de diensten van hun gebroeders verhinderd worden. Tevens zullen ze zelf door de
    teloorgang van hun jeugd in een ellendige en erbarmelijke staat vervallen. Voorwaar, in dit kader is ook de lente een
    vruchtbare boom die aan de herzameling doet denken. Ieder tijdperk binnen de mensenwereld is een leerrijke boom. Ook
    de aarde is een machtsboom gelijkend aan een verzamelplaats van bijzonderheden. En de wereld is eveneens een wonderlijke
    boom waarvan de vruchten naar de bazaar van het hiernamaals worden gezonden.
  </p>
</div>
  </div>'
            ],
            [
                'page_number' => 68,
                'content' => '<div class="page" id="68"> <p class="text-end page-number">#68</p>

<div class="text-center text-center-constrained">
  <p class="text-center text-bold small-title">De Zevende Waarheid</p>
  <p class="text-center"><span class="text-italic text-bold">De poort van Bewaring en Preservatie; Een glimp van de Namen: “de Bewaarder en de Opzichter”</span></p>
  <p class="text-center">
    <span class="text-arabic" dir="rtl" lang="ar">اَلْحَفِيظُ وَالرَّقِيبُ</span>
  </p>
</div>

<p>
  Is het ooit voor mogelijk te houden dat enerzijds, zowel in de hemel als op de aarde, op het land en in
  de zee, overal een Bewaring heerst, waarbij alles – <span class="text-italic">hetzij nat of droog, groot of klein, gewoon of verheven</span> –
  binnen een perfecte orde en balans wordt bewaard, en de daaruit voortvloeiende gevolgen volgens een bepaalde
  rekenschap worden uitgezeefd, maar anderzijds, als het aankomt op de mens – <span class="text-italic">die een omvattende aard bezit,
  de rang van ‘ultieme khalief’ bekleedt en de taak met de grootste verantwoordelijkheid draagt</span> – zullen zijn daden
  en handelingen, die direct betrekking hebben op Gods universele Heerschappij, dan niet worden bewaard, niet
  door de zeef van rekenschap worden gehaald en niet op de balans van Rechtvaardigheid worden afgewogen
  om een passende straf of beloning vast te stellen? Dit is absoluut onmogelijk!
</p>

<p>
  Waarlijk, de Entiteit Die dit universum beheert, bewaart alles binnen een bepaalde orde en balans. Orde
  en balans zijn verschijnselen van Kennis en Wijsheid, gecombineerd met Wil en Macht. Immers, bij het
  ontstaan van een schepsel zien wij dat het uiterst geordend en gebalanceerd wordt geschapen. Ook de fysieke
  veranderingen die een schepsel gedurende zijn leven ondergaat, voltrekken zich op een ordelijke wijze,
  terwijl het geheel van deze veranderingen eveneens afgestemd is op een ordelijk systeem.
</p>

  </div>'
            ],
            [
                'page_number' => 69,
                'content' => '<div class="page" id="69"> <p class="text-end page-number">#69</p>

<p>
  Wij zien immers dat aan het leven van elk wezen een einde wordt gebracht nadat het zijn taak heeft voltooid,
  waarna het deze waarneembare wereld verlaat. Echter, in geheugens – <span class="text-italic">die als bewaartableaus dienen</span><sup>1</sup> –
  en in spiegels van gelijkenissen bewaart de Ontzaglijke Bewaarder velerlei verschijningsvormen van dat wezen;
  Hij graveert de levensgeschiedenis ervan in diens zaden en voortbrengselen. Zodoende vereeuwigt Hij elk wezen
  in zichtbare en onzichtbare spiegels.
</p>

<p>
  <span class="text-italic text-bold">Bijvoorbeeld,</span> het geheugen van de mens, de vrucht van een boom, de pit van een vrucht en het
  zaad van een bloem geven de geweldige reikwijdte van de wet der Bewaring weer.
</p>

<p>
  Zie je dan niet dat alle specifieke dadenschriften, samenstellingswetten en uiterlijke gelijkenissen van alle
  bloemrijke en vruchtdragende flora van een weelderige lente in compacte zaadjes worden opgeschreven en
  bewaard? In een volgende lente worden hun dadenschriften volgens een bepaalde rekenschap ontvouwd, waardoor
  er met een voortreffelijke Orde en Wijsheid een geweldige nieuwe voorjaarse wereld ontstaat. Dit toont aan
  hoe ruimschoots de wet der Bewaring van kracht is.
</p>

<p>
  Indien bij zulke voorbijgaande, simpele, onbestendige en onbeduidende zaken al een dusdanige Bewaring
  heerst, kan het dan ooit mogelijk zijn dat de daden van mensen – <span class="text-italic">die in de verborgen wereld, het hiernamaals
  en de zielenwereld aanzienlijke vruchten met betrekking tot Gods universele Heerschappij afwerpen</span> – niet onder
  een waakzaam Oog worden bewaard en zorgvuldig worden vastgelegd? Dit is absoluut onmogelijk!
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p"><sup>1</sup> Zie de voetnoot in “Het Zevende Aanzicht”.</p>
</div>

  </div>'
            ],
            [
                'page_number' => 70,
                'content' => '<div class="page" id="70"> <p class="text-end page-number">#70</p>

<p>
  Waarlijk, blijkens deze manifestatie van Bewaring wijdt de Eigenaar van heel dit bestaan veel zorg aan
  het toezicht over alles wat zich afspeelt in Zijn rijk. Hij hanteert Zijn Gezag met optimale aandacht en voert
  de Heerschappij over Zijn Sultanaat met uiterste precisie; zozeer, dat Hij zelfs de kleinste gebeurtenis en
  de geringste dienst zelf vastlegt en laat vastleggen. De beelden van alles wat zich in Zijn rijk afspeelt, slaat
  Hij in meerdere bewaarplaatsen op.
</p>

<p class="text-bold">
  Deze Bewaring duidt aan dat er een aanzienlijk grootboek voor de rekenschap van daden zal worden opgeslagen.
</p>

<p>
  En vooral de grote daden en gewichtige handelingen van de mens, die gezien zijn wezen het omvattendste,
  nobelste en geëerdste schepsel is, zullen aan een doorslaggevende rekenschap en afweging worden onderworpen;
  zijn dadenschrift zal worden onthuld.
</p>

<p>
  Kan het dan ooit mogelijk zijn dat de mens met het khalifaat en de grootste verantwoordelijkheidstaak wordt
  vernobeld, en tot getuige van de Universele Gesteldheden des Heren wordt verkozen, en vervolgens overal
  binnen de kringen der diversiteiten zijn rol als heraut van de Goddelijke Eenheid openbaar maakt, en met
  zijn deelname aan de verheerlijkingen en godsdienstoefeningen van de meeste bestaansvormen tot de rang van
  opzichter en getuige rijst, om uiteindelijk ongestoord in het graf te rusten zonder ooit gewekt te worden?
  Zal hij niet voor al zijn zowel kleine als grote daden ter verantwoording worden geroepen? Zal hij niet
  voorttrekken naar de herzamelplaats en de Ultieme Berechting ondergaan? Dit is absoluut onmogelijk!
</p>

  </div>'
            ],
            [
                'page_number' => 71,
                'content' => '<div class="page" id="71"> <p class="text-end page-number">#71</p>

<p>
  En dat de Heer bij machte is om alle toekomstige mogelijkheden<sup>2</sup> te realiseren, wordt bevestigd door alle
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>2</sup> Waarlijk, het gehele verleden, dat vanaf het heden teruggaat tot aan het begin der schepping, bestaat volledig uit
    vaststaande gebeurtenissen. Alle verstreken dagen, jaren en eeuwen in de geschiedenis zijn regels, pagina’s en boeken
    die met de Pen der Beschikking zijn opgetekend. De Hand van Macht heeft daarin de mirakelen van Goddelijke Ayaat
    met volmaakte Wijsheid en Orde geschreven. De toekomst, die zich vanaf het heden tot de dag der opstanding en de
    entree in het paradijs uitstrekt, en tot aan de oneindige eeuwigheid doorloopt, is een tijdruimte die volledig uit mogelijkheden
    bestaat. Kortom, het verleden bestaat uit vaststaande gebeurtenissen; de toekomst bestaat uit mogelijkheden.
  </p>
  <p class="footnote-p">
    Voorwaar, wanneer deze twee tijdlijnen tegenover elkaar worden gebracht, dan zal niemand betwijfelen of de Entiteit Die
    de dag van gisteren met alle toenmalige wezens heeft geschapen, bij machte is om de dag van morgen met alle bijbehorende
    wezens te scheppen. Zo zijn de wezens en fenomenen binnen de mysterieuze tijdruimte van het verleden ongetwijfeld
    mirakelen van een Ontzaglijke Almacht. Ze getuigen ervan dat Die Almacht absoluut in staat is om de gehele toekomst
    met haar mogelijkheden te creëren en alle gerelateerde wonderen te onthullen.
  </p>
  <p class="footnote-p">
    Waarlijk, degene die één appel wil scheppen, moet bij machte zijn om alle appels op aarde te scheppen en een geweldige
    lente voort te brengen. Wie de lente niet kan creëren, kan evenmin één appel creëren. Die appel wordt immers in de
    weverij van het voorjaar vervaardigd. Hij Die één appel kan creëren, kan evenzeer een lente creëren. Een appel is in
    wezen een miniatuur van een boom, een tuin, en wellicht zelfs een heel universum. Bovendien is een appelpit, die
    de hele levensgeschiedenis van een enorme boom draagt, een dusdanig kunstrijk wonderwerk, dat Degene Die haar
    zodanig heeft gecreëerd, tegenover niets machteloos staat.&rarr;
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 72,
                'content' => '<div class="page" id="72"> <p class="text-end page-number">#72</p>

<p>
  vroegere gebeurtenissen die zich als mirakelen van Macht hebben voltrokken, en door de winter en de
  lente die Hij naar de gelijkenis van de herrijzenis en de herzameling steeds opnieuw blijft voortbrengen.
  Hoe denkt de mens zich dan te kunnen onttrekken aan het bestaan om aan zo’n Ontzaglijke Almacht te
  ontkomen? Of waant de mens dat hij onder de grond voor Hem kan schuilen?
</p>

<p>
  Aangezien in deze wereld geen waardige rekenschap wordt afgelegd en geen oordeel wordt uitgesproken,
  zal er uiteraard een Ultieme Berechting komen en een eindeloze gelukzaligheid volgen.
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    Evenzo is Degene Die de dag van vandaag heeft geschapen in staat om de dag van de herrijzenis te scheppen.
    En de Entiteit Die de lente kan voortbrengen, is eveneens bij machte om de herzameling te verwezenlijken.
    Hij Die alle werelden van het verleden aan de koord des tijds met volmaakte Wijsheid en Orde heeft aaneengeregen
    en getoond, kan en zal uiteraard een ander universum aan de tijdlijn van de toekomst rijgen en tentoonstellen.
  </p>
  <p class="footnote-p">
    In verscheidene “Woorden”, en vooral in “Het Tweeëntwintigste Woord”, hebben wij deugdelijk bewezen
    dat degene die niet alles kan creëren, in wezen niets kan creëren, terwijl degene die één iets kan scheppen,
    alles kan creëren.
  </p>
  <p class="footnote-p">
    En wanneer de schepping van wezens aan één enkele Entiteit wordt overgelaten, dan komen alle wezens zo
    eenvoudig als één wezen tot stand; er zal een natuurlijke eenvoud optreden. Wordt de schepping van wezens
    daarentegen aan meerdere oorzaken overgelaten en aan diversiteiten toegedicht, dan zal de totstandkoming
    van één wezen zo lastig zijn als de schepping van alle wezens; er zullen onoverkomelijke complicaties opdoemen.
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 73,
                'content' => '<div class="page" id="73"> <p class="text-end page-number">#73</p>

<div class="text-center text-center-constrained">
  <p class="text-center text-bold small-title">De Achtste Waarheid</p>
  <p class="text-center"><span class="text-italic text-bold">De poort van Belofte en Bedreiging; Een glimp van de Namen: “de Schone en de Ontzaglijke”</span></p>
  <p class="text-center">
    <span class="text-arabic" dir="rtl" lang="ar">اَلْجَمِيلُ وَالْجَلِيلُ</span>
  </p>
</div>

<p>
  Is het ooit voor mogelijk te houden dat de Alwetende en Almachtige Kunstenaar van al deze kunstige
  creaties Zijn herhaaldelijke Beloften en Goddelijke Dreigementen, Die door alle profeten middels massale
  overleveringsketenen zijn verkondigd, en door alle getrouwen en heiligen unaniem zijn bevestigd, niet zal
  waarmaken, en zodoende – <span class="text-italic">God verhoede</span> – Zijn onmacht en onwetendheid zal tonen? Daar komt bij dat
  het voldoen aan de vereisten van Zijn Beloftes en Dreigementen Zijn Macht geenszins bezwaart; het is zeer
  licht en gemakkelijk voor Hem, vergelijkbaar met het gemak waarmee de talloze wezens van de verstreken
  lente het aankomende voorjaar – deels identiek<sup>1</sup> en deels gelijksortig<sup>2</sup> – worden herschapen.
</p>

<p class="text-bold">
  Bovendien is de waarmaking van Zijn belofte niet alleen voor ons, maar voor alle wezens, voor Hemzelf en
  voor de Heerschappij van Zijn Sultanaat van essentieel belang.
</p>

<p>
  De verbreking van Zijn belofte daarentegen druist in tegen zowel de integriteit van Zijn regeermacht als
  de omvattendheid van Zijn Kennis. Immers, beloftebreuk komt voort uit ofwel onwetendheid ofwel onmacht.
</p>

<p class="text-italic text-bold">
  O loochenaar! Besef jij wel wat voor dwaze misdaad jij met je ongeloof en ontkenning begaat?
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p"><sup>1</sup> Zoals de wortels van bomen en grasplanten.</p>
  <p class="footnote-p"><sup>2</sup> Zoals bladeren en vruchten.</p>
</div>

  </div>'
            ],
            [
                'page_number' => 74,
                'content' => '<div class="page" id="74"> <p class="text-end page-number">#74</p>

<p>
  Je beaamt jouw valse waan, jouw ijlende verstand en jouw bedrieglijke nefs. Ondertussen verloochen jij
  een Entiteit Die geenszins ontrouw of inconsequent hoeft te zijn; een Majesteit Wiens Statigheid en Integriteit
  het absoluut niet betaamt om inconsistent te zijn, en Wiens Trouwheid en Waarachtigheid door alle
  zichtbare activiteiten wordt onderlijnd. In je oneindige miezierigheid bega jij een eindeloos misdrijf! Hiervoor
  verdien jij uiteraard een zware, grenzeloze straf. Dat één tand van sommige helbewoners zo groot als een
  berg zal zijn, is als maatstaf vermeld om de omvang van hun misdrijf aan te duiden.
</p>

<p>
  Jij lijkt op een reiziger die zijn ogen voor het zonlicht sluit en in het domein van zijn verbeelding staart,
  waar zijn waan als een vuurvlieg zijn angstwekkende pad tracht te verlichten met het schijnsel dat van zijn
  hoofd afschermt.
</p>

<p>
  Met alle creaties in het bestaan als Zijn trouwe Woorden Die waarheden verkondigen, en alle gebeurtenissen
  in het universum als Zijn eloquente Ayaat Die werkelijkheden uitdrukken, heeft de Alwaarachtige een belofte
  uitgesproken... Uiteraard zal Hij Zijn belofte waarmaken; Hij zal een Ultieme Berechting verwezenlijken en
  een sublieme gelukzaligheid schenken.
</p>

<div class="text-center text-center-constrained">
  <p class="text-center text-bold small-title">De Negende Waarheid</p>
  <p class="text-center"><span class="text-italic text-bold">De poort van Verlevendiging en Doding; Een glimp van de Namen: “De Allevende en Consistente, de Schenker des levens en Brenger des doods”</span></p>
  <p class="text-center text-arabic delima-font" dir="rtl" lang="ar">اَلْحَىُّ الْقَيُّومُ ۞ اَلْمُحْيِى وَالْمُمِيتُ</p>
</div>

  </div>'
            ],
            [
                'page_number' => 75,
                'content' => '<div class="page" id="75"> <p class="text-end page-number">#75</p>

<p>
  Is het ooit voor mogelijk te houden dat Degene Die de grote, dode en dorre aarde tot leven wekt, en Die
  bij deze opwekking meer dan driehonderdduizend soorten schepselen soort voor soort zo wonderlijk als de
  menselijke herzameling bijeenbrengt en veraanschouwelijkt, en zodoende Zijn Macht demonstreert, en Die
  tijdens deze verzameling en veraanschouwelijking binnen grenzeloze vermengingen en verwervingen met
  perfecte distincties en onderscheidingen de reikwijdte van Zijn Kennis demonstreert, en Die in al Zijn Hemelse
  Decreten de herzameling van de mens belooft, en zodoende de aandacht van al Zijn dienaren op de eeuwige
  gelukzaligheid richt, en alle creaties zij aan zij, schouder aan schouder, hand in hand eendrachtig binnen
  de kring van Zijn Bevel en Wil laat circuleren, en ze als elkaars helpers onderwerpt, en zodoende de grandeur
  van Zijn Heerschappij demonstreert, en Die de mensheid als de omvattendste, fragielste, teerhartigste,
  delicaatste en afhankelijkste vrucht van de scheppingsboom voortbrengt, als gesprekspartner verkiest, alles
  tot haar dienst stelt, en zodoende aantoont hoeveel waarde Hij aan de mensheid hecht, al bij al, is het
  denkbaar dat zo’n Genadige Almachtige, zo’n Alwetende Alwijze, de herrijzenis niet zal realiseren, de herzameling
  niet zal of kan waarmaken, de mensheid niet opnieuw tot leven zal of kan wekken, de Ultieme Berechting
  niet kan verwezenlijken, en het paradijs en de hel niet kan scheppen? God verhoede!
</p>

<p>
  Waarlijk, de Glorierijke Beheerder van deze wereld brengt elke eeuw, elk jaar en elke dag op het krappe
  oppervlak van deze tijdelijke aarde vele gelijkenissen, voorbeelden en tekenen van de Ultieme Herzameling
  en het veld van de herrijzenis tot stand.
</p>

  </div>'
            ],
            [
                'page_number' => 76,
                'content' => '<div class="page" id="76"> <p class="text-end page-number">#76</p>

<p>
  Zo zien wij bijvoorbeeld dat Hij tijdens de voorjaarse bijeenzameling in vijf à zes dagen meer dan driehonderdduizend
  kleine en grote plant- en diersoorten bijeenbrengt en veraanschouwelijkt. De wortels van alle
  boom- en grassoorten, inclusief bepaalde diersoorten, brengt Hij opnieuw tot leven en herstelt Hij in ere.
  Andere schepselen brengt Hij nagenoeg als identieke exemplaren van hun voorgangers voort. Hoewel zaden
  met minimale materiële verschillen zo dicht met elkaar vermengd zijn, worden ze met voortreffelijke onderscheidingen
  en karakteristieken op een zeer vlotte, uitvoerige en soepele wijze in zes dagen of zes weken
  binnen een perfecte orde en balans tot leven gebracht. Is het dan aannemelijk dat voor de Uitvoerder van
  deze werken iets zwaar kan vallen; dat Hij de hemelen en de aarde niet in zes dagen kan scheppen, en de
  mensheid niet met één oproep kan herzamelen? God verhoede!
</p>

<p>
  Stel je voor dat er een schrijver met wondergaven bestaat. Zonder in verwarring te raken, iets weg te laten
  of een vergissing te maken, schrijft hij op een prachtige wijze driehonderdduizend boeken met vervaagde
  of verdwenen letters op één enkele pagina binnen één uur volledig uit. Vervolgens zegt iemand tegen jou:
</p>

<p class="text-italic">
  “Deze schrijver, die de oorspronkelijke auteur is van jouw boek dat in het water is gevallen, zal dat boek in
  één minuut uit zijn geheugen herschrijven.”
</p>

<p>
  Zou jij dan kunnen zeggen: “Dat kan hij niet; ik geloof jou niet...”?
</p>

<p>
  Of stel je voor dat een miraculeuze sultan ter vertoning van macht of ter lering en vermaak voor jouw
  ogen met één sein bergen verzet, continenten herschikt en zeeën in land verandert. Vervolgens zie je dat een
</p>
  </div>'
            ],
            [
                'page_number' => 77,
                'content' => '<div class="page" id="77"> <p class="text-end page-number">#77</p>

<p>
  groot rotsblok in een vallei is gerold, waardoor de weg van de gasten die de sultan speciaal voor een feestmaal
  heeft uitgenodigd, versperd is geraakt; ze kunnen niet verder... Iemand zegt tegen jou:
  <span class="text-italic">“De sultan zal dat rotsblok – hoe groot het ook is – met één sein verzetten of verpulveren. Hij zal
  zijn gasten niet aan hun lot overlaten.”</span> Zou jij dan zeggen: <span class="text-italic">“Hij zal dat rotsblok niet verplaatsen”</span> of:
  <span class="text-italic">“Hij is daartoe niet in staat...”</span>?
</p>

<p>
  Of stel je voor dat een bevelvoerder in één dag een compleet nieuw leger van enorme omvang opricht.
  Vervolgens zegt iemand: <span class="text-italic">“Die bevelvoerder zal met een bazuingeschal de rustende soldaten van de
  ontbonden bataljons bijeenroepen, waarop de bataljons onder zijn gezag paraat zullen staan.”</span> Als jij daarop
  zegt: <span class="text-italic">“Dat geloof ik niet!”</span>, dan besef jij ook hoe dwaas jouw reactie is.
</p>

<p>
  Voorwaar, indien jij deze drie voorbeelden hebt begrepen, kijk dan toe! De Tijdeloze Schoonschrijver slaat
  voor onze ogen de witte pagina van de winter om, vouwt de groene bladzijden van de lente en zomer open,
  en legt met de Pen der Beschikking en Macht op de pagina van het aardoppervlak meer dan driehonderdduizend
  soorten wezens in de mooiste vorm vast. Ze bevinden zich weliswaar zeer dicht op elkaar, toch haalt Hij
  ze niet door elkaar. Hij schrijft ze allemaal gelijktijdig uit, zonder dat ze elkaar hinderen. Hoewel hun ontwerp
  en uiterlijk van elkaar verschillen, raakt Hij nimmer in de war; nooit begaat Hij een fout in Zijn Schrijverschap.
</p>

<p>
  Waarlijk, als er gesproken wordt over de Alwijze Bewaarder, Die het zielsprogramma van de grootste boomsoort
  in het kleinste zaadje ter grootte van een stipje vestigt en bewaart, mag er toch geen vraag op-
</p>

  </div>'
            ],
            [
                'page_number' => 78,
                'content' => '<div class="page" id="78"> <p class="text-end page-number">#78</p>

<p>
  rijzen als: <span class="text-italic">“Kan Hij de zielen van overledenen bewaren?”</span> En als het gaat om de Almachtige Entiteit,
  Die de aardbol als een slingersteen laat wentelen, is het toch niet gepast om een opmerking te maken als:
  <span class="text-italic">“Hoe zal Hij deze aarde, die het pad van Zijn gasten op weg naar het hiernamaals versperd, kunnen
  verzetten of verwoesten?”</span>
</p>

<p>
  En wanneer we het hebben over het Ontzaglijke Opperwezen, Die vanuit het niets in de lichamelijke bataljons
  van alle legers der levende wezens met volmaakte orde atomen op Zijn bevel: <sup>3</sup><span class="text-arabic-inline" dir="rtl" lang="ar">كُنْ فَيَكُونُ</span>
  rekruteert en stationeert, en zodoende nieuwe legers creëert, kan er dan twijfel zijn over Zijn Vermogen om de
  elementaire deeltjes en basiselementen van de bataljons der lichamen, die elkaar vanaf hun eerste formatie al
  kennen, met één oproep weer bijeen te brengen?
</p>

<p>
  En vergelijkbaar met de voorjaarse bijeenzameling, kun je in elk tijdperk en elke eeuw op aarde, bij elke
  wisseling van dag en nacht, en zelfs bij elke vorming en verdwijning van de wolken in het luchtruim met eigen
  ogen zien hoeveel voorbeelden, illustraties en tekenen van de herzameling Hij samenweeft... Als jij jezelf in
  gedachten duizend jaar terugplaatst en de twee vleugels des tijds, bestaande uit het verleden en de toekomst,
  met elkaar vergelijkt, dan zul jij zoveel illustraties van de herzameling en voorbeelden van de herrijzenis
  aanschouwen als het aantal eeuwen en dagen dat binnen die tijdspannen valt. Wanneer jij je vervolgens, ondanks
  zoveel voorbeelden en illustraties aanschouwd te hebben, de fysieke herzameling alsnog ontkent omdat jij het te
  vergezocht en ondenkbaar acht, dan besef jij ook hoe absurd dat is.
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p"><sup>3</sup> “(God zegt) Wees! en het wordt.”</p>
</div>

  </div>'
            ],
            [
                'page_number' => 79,
                'content' => '<div class="page" id="79"> <p class="text-end page-number">#79</p>

<p>
  Kijk naar wat het Ultieme Decreet zegt over de waarheid in kwestie:
</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">
  فَانْظُرْ اِلٰۤى اٰثَارِ رَحْمَتِ اللّٰهِ كَيْفَ يُحْيِى اْلأَرْضَ بَعْدَ مَوْتِهَا
  اِنَّ ذٰلِكَ لَمُحْيِ الْمَوْتٰى وَهُوَ عَلٰى كُلِّ شَىْءٍ قَدِيرٌ<sup>4</sup>
</p>

<p class="text-bold">Kortom:</p>

<p>
  Er is helemaal niets dat de herzameling in de weg staat, terwijl alles haar verwezenlijking vereist.
</p>

<p>
  Waarlijk, een Entiteit Die deze verbazende verzamelplaats van de enorme aarde als een simpele levensvorm
  laat sterven en herleven, en haar voor mens en dier als een aangename wieg en een fraai schip laat dienen,
  en voor de bewoners van dit gastenverblijf de zon als een verlichtende en verwarmende lamp laat werken,
  terwijl Hij voor Zijn engelen de planeten als vervoersmiddelen laat fungeren, voert zo’n majesteitelijke en
  eindeloze Heerschappij, zo’n grandioos en omvangrijk Bewind, dat het uiteraard niet enkel gevestigd is en
  staande blijft op deze voorbijgaande, onbestendige, wankelbare, onbeduidende, veranderlijke, oneeuwige,
  gebrekkige en onvolmaakte wereldse aangelegenheden.
</p>

<p>
  Elders bestaat dus een aanhoudend, bestendig, onvergankelijk en majestueus oord dat Zijn Heerschappij
  en Soevereiniteit recht doet; Hij bezit een ander rijk dat eeuwig is. Hij laat ons daarvoor werken en no-
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>4</sup> “Aanschouw de sporen van ALLAH’s Genade, hoe Hij de aarde na haar dood doet herleven. Voorzeker, Hij is Degene
    Die de doden tot leven brengt, en Hij bezit Macht over alles.” <em>– Qur’an, 30:50</em>
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 80,
                'content' => '<div class="page" id="80"> <p class="text-end page-number">#80</p>

<p>
  digt ons daartoe uit... En dat Hij ons daarnaartoe zal overplaatsen, wordt beaamd door alle leidende
  bezitters van stralende zielen, lumineuze harten en verlichte verstanden, die vanuit het schijnbare tot de
  waarheidszijn gerezen en de nabijheid van Zijn Tegenwoordigheid hebben mogen genieten. Unaniem verkondigen
  zij dat Hij zowel beloning als bestraffing heeft voorbereid. Tevens leveren zij over dat Hij herhaaldelijk
  stellige beloftes en hevige dreigementen tot uiting brengt.
</p>

<p>
  Zoals men weet, is het breken van een belofte zowel schandelijk als beschamend, en aldus geenszins verenigbaar
  met Zijn Glorie en Heiligheid. Tevens kan de herroeping van een dreigement alleen voortkomen uit
  vergeving of onmacht. Echter, ongeloof is een ultiem misdrijf dat onvergeeflijk is.<sup>5</sup>
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>5</sup> Waarlijk, omdat ongeloof (koefr) alle wezens van hun waarde berooft en van betekenisloosheid beticht, is het een
    belediging jegens het hele universum... en omdat het de glimpen van Goddelijke Namen in de spiegels der wezens
    ontkent, is het een bespotting van alle Heilige Namen... en omdat het alle eenheidsgetuigenissen van bestaansvormen
    verwerpt, is het een verloochening van alle schepselen... Al deze aspecten zorgen ervoor dat de menselijke potentie
    zodanig ontaardt, dat ze het niet meer verdient om heil en deugd te aanvaarden. Bovendien is het een immense
    verduistering waarbij de rechten van alle schepselen en alle Goddelijke Namen worden geschonden.
  </p>
  <p class="footnote-p">
    Voorwaar, de bescherming van deze rechten en het onvermogen van een ongelovige om heil te aanvaarden, leiden
    uiteindelijk tot de onvergeeflijkheid van ongeloof.
    <span class="text-arabic-inline" dir="rtl" lang="ar">اِنَّ الشِّرْكَ لَظُلْمٌ عَظِيمٌ</span>
    <span class="text-italic text-bold">“Voorzeker, afgoderij is een gigantische duisternis.”</span>
    <em>– Qur’an, 31:13</em> drukt deze betekenis uit.
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 81,
                'content' => '<div class="page" id="81"> <p class="text-end page-number">#81</p>

<p>
  Daarnaast is de Absolute Almacht verheven en heilig boven elke vorm van onmacht.
</p>

<p>
  Wat de bevestigers en verkondigers betreft: hoewel hun wegen, mentaliteiten en leertradities uiteenlopen,
  heerst onder hen een volstrekt unanieme overeenstemming over de kern van deze kwestie. Hun talrijkheid
  evenaart het niveau van massale overleveringsketenen <span class="text-italic">(tewatur)</span> en hun boodschap draagt de kracht van een
  collectieve consensus <span class="text-italic">(idjma)</span>. Qua status zijn zij de sterren onder de mensheid, de ogen van een gemeenschap
  en de trots van een natie. In het kader van onze kwestie zijn zij zowel experts als bewijsvoerders.
</p>

<p>
  In kunst of wetenschap worden twee experts verkozen boven duizenden ondeskundigen, en bij een verkondiging
  genieten twee bewijsvoerders de voorkeur boven duizenden tegensprekers. Bijvoorbeeld, twee mannen die de
  verschijning van de Ramadan-maan aankondigen, ontkrachten de ontkenning van duizenden ontkenners.
</p>

<p class="text-bold">Conclusie:</p>

<p>
  Een betrouwbaardere verkondiging, een krachtigere bewering en een evidenter waarheid zijn in deze wereld
  simpelweg onbestaanbaar. Al bij al is de aarde een akker; het verzamelveld is een dorsvloer; het paradijs en
  de hel zijn de bewaaarplaatsen van de oogst.
</p>

  </div>'
            ],
            [
                'page_number' => 82,
                'content' => '<div class="page" id="82"> <p class="text-end page-number">#82</p>

<div class="text-center text-center-constrained">
  <p class="text-center text-bold small-title">De Tiende Waarheid</p>
  <p class="text-center"><span class="text-italic text-bold">De poort van Wijsheid, Gratie, Genade en Rechtvaardigheid; Een glimp van de Namen: “De Alwijze, de Genereuze, de Rechtvaardige en de Barmhartige.”</span></p>
  <p class="text-center text-arabic" dir="rtl" lang="ar">اَلْحَكِيمُ ۞ اَلْكَرِيمُ ۞ اَلْعَادِلُ ۞ اَلرَّحِيمُ</p>
</div>

<p>
  Is het ooit voor mogelijk te houden dat de Ontzaglijke Eigenaar van het geschapen Rijk in dit vergankelijke
  gastenverblijf van de wereld, in dit tijdelijke terrein van beproeving en in deze instabiele tentoonstellingsruimte
  van de aarde zo veel tekenen van een stralende Wijsheid, een waarneembare Gratie, een overweldigende
  Rechtvaardigheid en een omvangrijke Genade demonstreert, maar desondanks, binnen de kring van
  Zijn Domein, in de materiële en immateriële wereld, niet over bestendige woningen met eeuwige bewoners,
  eeuwige verblijven met onvergankelijke schepselen beschikt, waardoor de waarheden van deze zichtbare
  Wijsheid, Gratie, Rechtvaardigheid en Genade helemaal verloren gaan?
</p>

<p>
  En kan het ooit aanvaardbaar zijn dat Die Alwijze Entiteit uit alle schepselen de mens voor Zichzelf tot
  universele gesprekspartner en alomvattende spiegel uitverkiest, hem de inhoud van alle Genadeschatten laat
  proeven, aftasten en onderkennen, Zichzelf met al Zijn Namen aan hem openbaart, en hem zowel liefheeft
  als geliefd maakt, om uiteindelijk die arme mens de toegang tot Zijn Eeuwige Rijk te weigeren? Zal Hij de
  mens niet tot het oord der gelukzaligheid uitnodigen om hem daar voor altijd te vervullen van geluk?
</p>

  </div>'
            ],
            [
                'page_number' => 83,
                'content' => '<div class="page" id="83"> <p class="text-end page-number">#83</p>

<p>
  En kan het redelijkerwijs ooit aannemelijk zijn dat Hij zelfs een creatie zoals een zaadje met de taken
  van een boom belast, met zoveel wijsheden als zijn bloesems belaadt, en met zoveel nuttigheden als zijn
  vruchten verrijkt, om uiteindelijk al die taken, wijsheden en nuttigheden aan een aards doel zo miniem als
  een zaadkorrel te wijden? Zal Hij hun bestemming tot slechts een aards bestaan met minder waarde dan een
  mosterdzaad beperken? Zal Hij deze aangelegenheden niet als zaden voor de wereld der betekenissen en als
  zaaïland voor de wereld van het hiernamaals laten dienen, opdat alles zijn ware en waardige doel kan bereiken?
  Zal Hij al deze geweldige ceremoniën doelloos, leeg en vergeefs laten eindigen? Zal Hij hun bestaan niet op
  de wereld der betekenissen en de wereld van het hiernamaals afstemmen, opdat hun ware doelen en hun waardige
  vruchten aan het licht kunnen komen?
</p>

<p>
  Waarlijk, is het ooit voor mogelijk te houden dat Hij, door dit alles zo in strijd met de waarheid te brengen,
  Zijn Wezenlijke Attributen: de Alwijze, de Genereuze, de Rechtvaardige en de Genadige als Hun tegenpolen
  – <span class="text-italic">God verhoede</span> – zal laten afbeelden, en zodoende alle waarheden in het universum die van Zijn
  Wijsheid, Generositeit, Rechtvaardigheid en Genade getuigen ronduit zal verloochenen; de getuigenissen van
  alle bestaansvormen zal verwerpen, en de bewijzingen van alle creaties zal ontkrachten? En kan het verstand
  ooit aanvaarden dat Hij het hoofd en de interne zintuigen van de mens met zoveel taken als zijn hoofdhaaren
  belast, om hem uiteindelijk een aardse vergoeding ter waarde van een haarspriet toe te kennen? Zal Hij ingaan
  tegen Zijn ware Rechtvaardigheid en wezenlijke Wijsheid door zoiets betekenisloos tot stand te brengen?
</p>
  </div>'
            ],
            [
                'page_number' => 84,
                'content' => '<div class="page" id="84"> <p class="text-end page-number">#84</p>

<p>
  En is het ooit voor mogelijk te houden dat Hij elke levensvorm, elk orgaan – <span class="text-italic">zoals de tong</span> –
  en elke creatie met zoveel wijsheden en nuttigheden als de voortbrengselen en vruchten van een boom uitrust,
  en zodoende bewijst en demonstreert dat Hij een Alwijze Entiteit is, maar vervolgens de grootste wijsheid,
  het voornaamste nut en het hoogstnodige resultaat dat wijsheid werkelijk wijsheid, gunst werkelijk gunst en
  genade werkelijk genade maakt, en dat zowel de bron als het doel van alle wijsheden, gunsten, genaden en
  nuttigheden belichaamt, bestaande uit eeuwigheid, het eeuwige samenzijn en oneindige gelukzaligheid, niet
  zal schenken, en bijgevolg al Zijn ondernemingen in de afgrond van absolute futiliteit zal laten verzinken?
  Zal Hij Zichzelf presenteren als iemand die een prachtig paleis bouwt met duizenden gravures op elke steen,
  duizenden decoraties aan elke wand, en duizenden kostbare apparaten en huishoudelijke benodigdheden in
  elke kamer, maar het vervolgens niet met een koepel overdekt, waardoor alles bederft en vergeefs vergaat?
  God verhoede!
</p>

<p class="text-bold">
  Pure heil brengt heil tot stand. Sublieme schoonheid brengt pracht teweeg. Uit Absolute Wijsheid vloeit
  niets zinloos voort.
</p>

<p>
  Waarlijk, iedereen die in gedachten de geschiedenis induikt en het verleden bereist, zal zien dat de wereld
  die wij thans als een tijdelijk verblijf, een beproevingsterrein en een kunstgalerij ervaren, voorafgegaan is
  aan zoveel vergane verblijven, terreinen, galerijen en werelden als het aantal verstreken jaren. Hoewel ze in
  voorkomen en hoedanigheid van elkaar verschillen, vertonen ze gelijkenissen in ordelijke en wonderlijke
</p>

  </div>'
            ],
            [
                'page_number' => 85,
                'content' => '<div class="page" id="85"> <p class="text-end page-number">#85</p>

<p>
  aspecten; ze lijken op elkaar wat betreft het tonen van de Macht en de Wijsheid van de Kunstenaar.
</p>

<p>
  Bovendien zal hij bij die instabiele woningen, vergankelijke terreinen en tijdelijke galerijen ordeningen
  van zo’n stralende Wijsheid, signalen van zo’n evidente Gratie, tekenen van zo’n overweldigende Gerechtigheid
  en vruchten van zo’n omvattende Genade ontwaren, dat hij – <span class="text-italic">zolang hij niet blind is</span> – met volle overtuiging
  zal inzien dat de volmaaktheid van Die Wijsheid niet kan worden overtroffen, dat de schoonheid van Die Gratie
  met Haar onmiskenbare uitwerkingen niet kan worden overschitterd, dat het ontzag van Die Gerechtigheid met
  Haar waarneembare tekenen niet kan worden geëvenaard, en dat de omvattendheid van Die Genade met Haar
  zichtbare vruchten niet kan worden voorbijgestreefd.
</p>

<p>
  Als wij nu uitgaan van de onwaarschijnlijke aanname dat de Tijdeloze Sultan, Die al deze ontwikkelingen
  beheert, de gasten voortdurend vervangt en de gastenverblijven aldoor verandert, in Zijn Rijk geen eeuwige
  verblijven, verheven gewesten, permanente woningen en onvergankelijke leefgebieden bezit, waar vaste bewoners
  en gelukzalige dienaren leven, dan zullen de waarheden van de vier Spirituele Elementen – Wijsheid, Rechtvaardigheid,
  Gratie en Genade – Die zo krachtig en universeel zijn als licht, lucht, water en aarde verloochenend
  moeten worden, en Hun bestaan dat zo waarneembaar is als de voornoemde vier fysieke elementen zou eveneens
  ontkend moeten worden. Want het is bekend dat deze vergankelijke aarde met al haar weelde niet in staat is om
  Hun waarheden volwaardig tot uitdrukking te brengen.
</p>

  </div>'
            ],
            [
                'page_number' => 86,
                'content' => '<div class="page" id="86"> <p class="text-end page-number">#86</p>

<p>
  Als elders ook geen plaats bestaat waar Ze volledig tot uiting kunnen komen, dan zullen wij, zoals een
  dwaas die op klaarlichte dag de zon ontkent terwijl hij haar licht aanschouwt, de alomtegenwoordige Wijsheid
  voor onze ogen, de Gratie Die wij elk moment bij onszelf en bij de meeste wezens kunnen ontwaren, de
  Gerechtigheid met al haar krachtige en onmiskenbare tekenen<sup>6</sup>, en de alom zichtbare Genade allemaal moeten
  loochenen. Daarnaast moeten wij aannemen dat de Regisseur van de wijze beschikkingen, weldadige
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>6</sup> Waarlijk, Rechtvaardigheid kent twee varianten. <span class="text-italic text-bold">De ene is distributief, de andere is vergeldend.</span>
  </p>
  <p class="footnote-p">
    <span class="text-italic text-bold">De distributieve variant impliceert:</span> de rechthebbende geven waar hij recht op heeft. Deze vorm van
    Rechtvaardigheid heeft in deze wereld een hele evidente reikwijdte. Immers, zoals in “De Derde Waarheid” is bewezen,
    worden alle wensen die een wezen in de taal van potentie, in de taal van natuurlijke behoeftigheid en in de taal van
    hoogdringendheid voordraagt aan zijn Ontzaglijke Voortbrenger waarneembaar verhoord; alle rechten die essentieel zijn
    voor zijn bestaan en leven worden volgens specifieke afwegingen en vastgestelde maatstaven toegekend. De aanwezigheid
    van deze rechtvaardigheid is dus net zo zeker als het bestaan en het leven zelf.
  </p>
  <p class="footnote-p">
    <span class="text-italic text-bold">De tweede variant is vergeldend.</span> Hierbij worden onrechtplegers gedisciplineerd. Met andere woorden, het recht dat
    onrechtplegers toekomt, wordt toegepast middels kastijding en bestraffing. Hoewel deze variant in deze wereld niet volledig
    tot uiting komt, zijn er talloze tekenen en aanwijzingen die het bestaan van deze waarheid laten aanvoelen. Waarlijk,
    vanaf de stammen van Âd en Thamood tot aan de opstandige volkeren van deze tijd: de disciplinerende klappen en kwellende
    straffen die hen troffen tonen absoluut aan dat er een uiterst verheven Rechtvaardigheid heerst.
  </p>
</div>
  </div>'
            ],
            [
                'page_number' => 87,
                'content' => '<div class="page" id="87"> <p class="text-end page-number">#87</p>

<p>
  activiteiten en genaderijke gunsten die wij in dit universum aanschouwen – <span class="text-italic">God verhoede</span> – een roekeloze
  spelleider en wrede tiran is, wat een uiterst onmogelijke verwording van werkelijkheden zou impliceren.
  Zelfs de dwaze sofisten die heel het bestaan en hun eigen existentie ontkennen, zouden moeite hebben om
  deze gedachtegang serieus te nemen.
</p>

<p>
  Kortom, deze zichtbare wereldse gesteldheden, waarbij geweldige samenkomsten tijdens het leven en snelle
  scheidingen tijdens de dood, grandioze verzamelingen en rappe ontbindingen, opzienbarende ceremoniën en
  grootschalige manifestaties plaatsvinden, staan totaal niet in verhouding tot hun kortstondige, geringe vruchten
  en hun waardeloze, tijdelijke doelen die voor deze vergankelijke wereld bestemd zijn. Immers, dit komt er
  nagenoeg op neer dat een kleine kiezelsteen met bergen aan wijsheden en doelen wordt beladen, terwijl een
  enorme berg slechts een miniem en vluchtig doel ter grootte van een kiezelsteen moet dienen, wat indruist
  tegen elk gezond verstand en elke wijsheid.
</p>

<p>
  Het feit dat deze bestaansvormen en gesteldheden zozeer in wanverhouding staan tot hun wereldse doeleinden
  getuigt er absoluut van dat de aangezichten van wezens tot de wereld der betekenissen zijn gewend, waar hun
  waardige vruchten worden afgeworpen. Hun ogen zijn gevestigd op Gods Heilige Namen. Hun doelen zijn
  gericht op de wereld. Hun kernen ontkiemen onder de grond van het aardse bestaan, terwijl hun bloemen
  ontluiken in de wereld der gelijkenissen. In overeenstemming met de potentie die de mens bezit, zaait hij en
  wordt hij gezaaid in dit leven; in het hiernamaals zal hij de oogst binnenhalen.
</p>
  </div>'
            ],
            [
                'page_number' => 88,
                'content' => '<div class="page" id="88"> <p class="text-end page-number">#88</p>

<p>
  Waarlijk, als je deze creaties aanschouwt op basis van hun aangezicht dat tot de Goddelijke Namen en
  het hiernamaals is gewend, dan zul je ontwaren dat elk zaad dat zich als machtsmirakel manifesteert, een
  doel zo groot als een boom draagt. Elke bloem die als een Woord van Wijsheid verschijnt<sup>7</sup>, bevat zoveel
  betekenissen als de bloesems van een boom. En elke vrucht die als een wonderlijk kunstwerk en een compositie
  van Genade ontplooit, bevat zoveel wijsheden als de vruchten van een boom. Dat ze voor ons als voedingsmiddel
  dient, is slechts één van die duizenden wijsheden, waarbij ze haar taak afrondt, haar betekenis uitdrukt,
  sterft en in onze maag wordt begraven.
</p>

<p>
  Aangezien deze vergankelijke creaties elders eeuwige vruchten voortbrengen, blijvende weergaven nalaten,
  onsterfelijke betekenissen uitdrukken en tijdeloze verheerlijkingen verrichten, en aangezien de mens pas werkelijk
  mens wordt en te midden van het vergankelijke een weg naar de eeuwigheid vindt wanneer hij dit aspect van
  hen in ogenschouw neemt, komt alles erop neer dat deze wezens, die in de draaikolk van leven en dood bijeenkomen
  en uiteengaan, een hoger doel dienen...
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p">
    <sup>7</sup> <span class="text-bold">Vraag:</span>
    <span class="text-italic">“Waarom haalt u bij uw voorbeelden vooral bloemen, zaden en vruchten aan?”</span>
  </p>
  <p class="footnote-p">
    <span class="text-bold">Het antwoord:</span>
    Omdat ze tot de antiekste, wonderbaarlijkste en delicaatste mirakelen van Macht behoren. De naturalisten, dwaalgeesten
    en filosofen hebben het fijne schrift dat de Pen der Beschikking en Macht in hen heeft vastgelegd, niet kunnen lezen,
    waardoor ze in het moeras van naturalisme zijn verdronken.
  </p>
</div>

  </div>'
            ],
            [
                'page_number' => 89,
                'content' => '<div class="page" id="89"> <p class="text-end page-number">#89</p>

<p>
  Deze toestanden lijken op scenario’s die opgezet en uitgewerkt worden om iets na te bootsen en af te beelden.
  Bijvoorbeeld, voor kortstondige bijeenkomsten die gevolgd worden door scheidingen, worden soms hoge kosten
  gemaakt om opnames te maken en samen te stellen voor permanente vertoningen in theaters.
</p>

<p>
  Evenzo wordt in deze wereld een kortstondig persoonlijk en gemeenschappelijk leven ervaren voor onder
  meer het volgende doel:
</p>

<p>
  Opnames maken en samenstellen, resultaten van daden vastleggen en bewaren, opdat ze op een ultiem verzamelveld
  kunnen worden beoordeeld, in een grandioze tentoonstellingsruimte kunnen worden gepresenteerd, en de
  kwalificatie voor een sublieme gelukzaligheid kan worden aangetoond. In een Hadîth-el’Sharîf wordt deze
  waarheid als volgt verwoord:
</p>

<p class="text-italic text-bold text-center">
  “De wereld is een akker voor het hiernamaals.”
</p>

<p>
  Aangezien de aarde bestaat, en aangezien verschijnselen op aarde aanduiden dat Wijsheid, Gratie, Genade
  en Rechtvaardigheid eveneens bestaan, staat het zo vast als het bestaan van de aarde dat het hiernamaals
  ook bestaat. Aangezien alles op aarde in zekere zin op die wereld is gericht, betekent dit dat de bestemming
  het hiernamaals is. Het hiernamaals ontkennen impliceert het ontkennen van de aarde en al wat ze bevat.
</p>

<p class="text-center text-bold">Conclusie:</p>

<p class="text-center text-bold text-center-constrained">
  Net zoals het doodsuur en het graf
  de mens te wachten staan,
  kijken het paradijs en de hel evenzeer
  afwachtend uit naar de komst van de mens.
</p>

  </div>'
            ],
            [
                'page_number' => 90,
                'content' => '<div class="page" id="90"> <p class="text-end page-number">#90</p>

<div class="text-center text-center-constrained">
  <p class="text-center text-bold small-title">De Elfde Waarheid</p>
  <p class="text-center"><span class="text-italic text-bold">De poort van Mensheid; Een glimp van de Naam: “De Alwaarachtige.”</span></p>
  <p class="text-center">
    <span class="text-arabic" dir="rtl" lang="ar">اَلْحَقُّ</span>
  </p>
</div>

<p>
  Is het ooit voor mogelijk te houden dat de Alwaarachtige en Rechtmatige Aanbedene, ten aanzien van Zijn
  Absolute Heerschappij over alle werelden in het universum, de mens als de aanzienlijkste onderdaan tegenover
  Zijn Universele Heerschappij, de diepst denkende adressaat van Zijn Feilloze Toespraak, en de
  omvattendste spiegel van Zijn Namen creëert, en hem volgens de mooiste compositie als Zijn prachtigste
  Machtsmirakel formeert, en bij hem zodoende zowel Zijn Ultieme Naam als het ultieme niveau van Elke
  Naam manifesteert, en hem met de fijnste weeginstrumenten en apparaten uitrust, en daarmee in staat stelt
  om Zijn Genadeschatten af te wegen en te onderkennen, terwijl Hij hem daarenboven de meest behoeftige
  aan Zijn eindeloze gunsten, de meest lijdende onder vergankelijkheid, de meest smachtende naar eeuwigheid,
  de meest tedere, delicate, arme en afhankelijke in het dierenrijk, en de meest vatbare voor leed en ellende
  in het leven van het aardrijk maakt, maar qua potentie in de meest verheven vorm en met de hoogste aard
  schept, om hem al bij al uiteindelijk niet naar een eeuwig oord te zenden waar zijn potenties tot hun recht
  kunnen komen en waar heel zijn wezen terecht naar verlangt?
</p>

<p>
  Zal Hij zodoende de waarheid van het mens-zijn tenietdoen? Zal Hij lijnrecht in strijd met Zijn Eigen
  Waarachtigheid een onrecht begaan dat weerzinwekkend is in de ogen van de waarheid?
</p>

  </div>'
            ],
            [
                'page_number' => 91,
                'content' => '<div class="page" id="91"> <p class="text-end page-number">#91</p>

<p>
  En kan het ooit mogelijk zijn dat de Algerechtigde Regeerder en Absolute Genadige de mens voorziet van
  een dusdanige potentie, dat hij daarmee de ultieme verantwoordelijkheid – <span class="text-italic">waarvoor de aarde, de hemelen en
  de bergen terugdeinsden</span> – kan dragen, wat wil zeggen dat hij met zijn persoonlijke afwegingen en beperkte
  kunstvaardigheden de omvattende Eigenschappen, de universele Gesteldheden en de eindeloze manifestaties
  van zijn Schepper kan afwegen en onderkennen, en dat de Heer hem als het meest fragiele, delicate, gevoelige,
  machteloze en zwakke wezen op aarde schept, maar desondanks tot een soort officiële rentmeester
  van alle plantaardige en dierlijke schepselen op aarde aanstelt, en hem toelaat om in hun verheerlijkingen
  en godsdienstoefeningen te mengen, en zodoende hem als miniatuur van Zijn Goddelijke Beleid in het universum
  afbeeldt, en via hem Zijn Feilloze Heerschappij in daad en woord door het heelal openbaart, hem boven
  zijn engelen verkiest en met de rang van Khalifaat bekleedt, om uiteindelijk het doel, het resultaat en de
  vrucht van al deze taken – <span class="text-italic">bestaande uit eeuwige gelukzaligheid</span> – niet aan hem te schenken?
</p>

<p>
  Zal Hij onder al Zijn schepselen uitgerekend de mens in de meest ongelukkige, wanhopige, rampzalige,
  zorgelijke en vernederende toestand laten storten, en de meest gezegende, stralende en gelukzalige gift van
  Wijsheid – <span class="text-italic">bekend als het verstand</span> – voor hem tot een vervloekt en duister marteltuig maken, en aldus
  een meedogenloosheid begaan die voluit in strijd is met Zijn absolute Wijsheid en geheel indruist tegen Zijn
  absolute Genadigheid?
</p>

<p class="text-bold">
  God verhoede!
</p>

  </div>'
            ],
            [
                'page_number' => 92,
                'content' => '<div class="page" id="92"> <p class="text-end page-number">#92</p>

<p>
  <span class="text-bold">Conclusie:</span> Toen wij naar het identiteitsbewijs en het handboek van de officier uit het symbolische
  verhaal keken, zagen wij dat zijn rang, zijn taak, zijn loon, zijn gedragscode en zijn uitrusting niet voor dat tijdelijke
  terrein waren bestemd; die officier zou naar een permanent oord trekken en bereidde zich daarop voor. Evenzo zijn
  alle subtiliteiten in het ‘identiteitsbewijs’ van het mensenhart, alle vermogens in het ‘handboek’ van het mensenverstand
  en alle instrumenten van de menselijke potentie volledig en eensgezind afgestemd op de eeuwige gelukzaligheid; ze
  zijn daarvoor bestemd en daarvoor verstrekt. Zowel erkende waarheidsonderzoekers als spirituele waarnemers zijn
  unaniem over deze kwestie.
</p>

<p>
  Bijvoorbeeld, als aan het voorstellingsvermogen – <span class="text-italic">dat als de portrettist van het verstand dient</span> – het volgende
  wordt voorgesteld: <span class="text-italic">“Jou zal een miljoenjarig bestaan inclusief wereldheerschappij worden geschonken, maar daarna
  zul jij in het niets verdwijnen”</span> dan zal de mens, op voorwaarde dat zijn waan hem niet misleidt en zijn nefs niet
  ingrijpt, geen vreugdekreet uitslaan maar een zucht van weemoed slaken. Dit laat zien dat het grootste aanbod van het
  vergankelijke zelfs niet het kleinste instrument en zintuig van de mens kan bevredigen.
</p>

<p>
  Voorwaar, op basis van deze potentie van de mens tonen zijn ambities – <span class="text-italic">die tot aan de eeuwigheid reiken</span> –
  zijn gedachten – <span class="text-italic">die het universum omvatten</span> – en zijn verlangens – <span class="text-italic">die over de varianten van eeuwige
  gelukzaligheden zijn uitgespreid</span> – dat deze mens geschapen is voor eeuwigheid en op weg is naar de eeuwigheid.
  Deze wereld is voor hem een gastenverblijf en een wachtruimte voor zijn hiernamaals.
</p>

  </div>'
            ],
            [
                'page_number' => 93,
                'content' => '<div class="page" id="93"> <p class="text-end page-number">#93</p>

<div class="text-center text-center-constrained">
  <p class="text-center text-bold small-title">De Twaalfde Waarheid</p>
  <p class="text-center"><span class="text-italic text-bold">De poort van Profeetschap en Revelatie; Een glimp van: “In de Naam van ALLAH, de Barmhartige, de Genadige.”</span></p>
  <p class="text-center text-arabic delima-font" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيمِ</p>
</div>

<p>
  Waarlijk, terwijl alle Godsgezanten – <span class="text-italic">ondersteund door hun mirakelen</span> – zijn woorden beamen, alle heiligen –
  <span class="text-italic">ondersteund door hun waarnemingen en kerâmaat</span> – zijn dawa bevestigen, en alle gezuiverden –
  <span class="text-italic">ondersteund door hun waarheidsvindingen</span> – zijn waarachtigheid erkennen, heeft de Nobelste Godsbode
  <span class="text-arabic-inline" dir="rtl" lang="ar">ﷺ</span>, steunend op de kracht van duizend vervulde mirakelen, met al zijn kracht,
  tezamen met de Leerrijke Qur’an – <span class="text-italic">Die Zelf met Zijn veertig miraculeuze aspecten ook op duizenden onbetwistbare Ayaat
  steunt</span> – de weg naar het hiernamaals en de poort tot het paradijs met volstrekte zekerheid geopend. Is het nog
  voor mogelijk te houden dat deze gesloten kunnen worden door loze influisteringen en twijfels die nog zwakker
  zijn dan een vliegenvleugel?
</p>

<p class="text-center">✧ ✧ ✧</p>

<p>
  Uit de voorgaande “Waarheden” is helder geworden dat het concept van de “Herzameling” zo’n diepgewortelde
  waarheid is, dat zelfs een kracht die de aarde uit haar baan zou kunnen slingeren en zou kunnen verwoesten
  niet in staat zal zijn om die waarheid tot wankelen te brengen. Immers, die waarheid wordt door de
  Alwaarachtige met alle vereisten van Zijn Namen en Eigenschappen gespecificeerd, door de Nobelste Godsbode
  met al zijn mirakelen en redeneringen beaamd, door de Qur’an-el’Hakîm met al Zijn waarheden en
</p>

  </div>'
            ],
            [
                'page_number' => 94,
                'content' => '<div class="page" id="94"> <p class="text-end page-number">#94</p>

<p>
  Ayaat bewezen, en door dit universum met al zijn kosmische Ayaat en leerrijke gesteldheden benadrukt.
</p>

<p>
  Kan het dan ooit voor mogelijk worden gehouden dat enerzijds het Noodzakelijke Opperwezen en het hele
  bestaan – <span class="text-italic">buiten de kafirs om</span> – dit concept van de herzameling unaniem bevestigen, maar anderzijds
  satanische influisteringen met minder kracht dan een haarspriet zo’n verheven en gegrondveste berg van een
  waarheid tot wankelen kunnen brengen of kunnen wegvagen? God verhoede!
</p>

<p>
  Je moet beslist niet denken dat de bewijzen voor de herzameling beperkt zijn tot de “Twaalf Waarheden”
  die wij besproken hebben. Verre van! Alleen de Qur’an-el’Hakîm op Zich – <span class="text-italic">Die ons de voorgaande “Twaalf
  Waarheden” heeft onderricht</span> – wijst nog op duizenden aspecten die ieder op zich als een krachtig teken aangeven
  dat onze Schepper ons van dit vergankelijke oord naar een eeuwig rijk zal overplaatsen.
</p>

<p>
  Tevens moet je beslist niet denken – <span class="text-italic">zoals we eerder aangaven</span> – dat de Goddelijke Namen Die de
  herzameling vereisen, beperkt zijn tot de Namen: <span class="text-italic">“de Alwijze”, “de Genereuze”, “de Genadige”, “de
  Rechtvaardige” en “de Bewaarder”.</span> Verre van! Alle Goddelijke Namen Die Zich ten behoeve van de regelingen in het
  universum manifesteren, vereisen en benodigen het hiernamaals.
</p>

<p>
  Je moet ook niet denken dat de kosmische Ayaat in het universum Die de herzameling bewijzen, beperkt zijn
  tot wat wij behandeld hebben. Verre van! Zoals gordijnen die naar links en rechts kunnen opschuiven, bevatten
  de meeste bestaansvormen aspecten en hoedanigheden die enerzijds getuigen van de Kunstenaar en anderzijds
  duiden op de herzameling.
</p>

  </div>'
            ],
            [
                'page_number' => 95,
                'content' => '<div class="page" id="95"> <p class="text-end page-number">#95</p>

<p>
  Bijvoorbeeld, zoals de kunstrijke pracht binnen de mooiste compositie van de mens de Kunstenaar laat
  zien, zo laat de abrupte vergankelijkheid van zijn omvattende capaciteit binnen die sublieme compositie de
  herzameling zien. Soms kunnen twee perspectieven op één aspect zowel de Kunstenaar als de herzameling
  weergeven.
</p>

<p>
  Bijvoorbeeld, de orde van Wijsheid, de elegantie van Gratie, de balans van Gerechtigheid en de gunst
  van Genade zijn bij de meeste bestaansvormen waarneembaar. Wanneer de aard van hun manifestaties in
  ogenschouw wordt genomen, dan zullen ze aantonen dat ze aan de Machtshand van de Wijze, Genereuze,
  Rechtvaardige en Genadige Kunstenaar zijn ontsproten. Evenzo, wanneer hun kracht en onbeperktheid worden
  bekeken en vergeleken met het onbeduidende en korte bestaan van deze vergankelijke wezens die hen
  manifesteren, dan zal het hiernamaals verschijnen. Al bij al reciteert en weergeeft alles in de taal van zijn
  houding:
</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">
  اٰمَنْتُ بِاللّٰهِ وَبِالْيَوْمِ اْلاٰخِرِ<sup>1</sup>
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p"><sup>1</sup> “Ik geloof in ALLAH en in de Laatste Dag.”</p>
</div>

  </div>'
            ],
            [
                'page_number' => 96,
                'content' => '<div class="page" id="96"> <p class="text-end page-number">#96</p>

<div class="text-center page-title-chapter delima-font">
  <h2>Slot</h2>
</div>

<p>
  De voorgaande “Twaalf Waarheden” bevestigen, vervolmaken en bekrachtigen elkaar. Gezamenlijk vormen
  ze een harmonisch geheel en brengen de conclusie aan het licht. Welke waan zou deze twaalf ijzersterke muren
  van diamant kunnen doorbreken en schade kunnen toebrengen aan de ondoordringbare burcht waarin het
  geloof in de herzameling is gevestigd?
</p>

<p>
  De edele Aya: <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">مَا خَلْقُكُمْ وَلَا بَعْثُكُمْ إِلَّا كَنَفْسٍ وَاحِدَةٍ</span> geeft
  het volgende aan: <span class="text-italic text-bold">“De schepping en herzameling van alle mensen is voor de Goddelijke Macht zo licht
  als de schepping en herzameling van één mens.”</span> Waarlijk, zo is de werkelijkheid. In een traktaat getiteld
  <span class="text-italic">“Het Punt”</span> heb ik in het hoofdstuk over de herzameling uitgebreid geschreven over de waarheid
  die deze Aya uitdrukt. Hier zullen wij met enkele gelijkenissen uit dat traktaat een beknopte schets ervan
  presenteren. Wie interesse heeft, kan <span class="text-italic">“Het Punt”</span> raadplegen.
</p>

<p>
  <span class="text-italic text-bold">Bijvoorbeeld:</span> <sup>2</sup><span class="text-arabic-inline" dir="rtl" lang="ar">وَلِلّٰهِ الْمَثَلُ اْلأَعْلٰى</span> – een gelijkenis
  aanvoeren is geen overtreding – als de zon volgens het geheim van “lichternis” haar glimp naar eigen wil zou
  kunnen afgeven, dan zou ze met hetzelfde gemak zowel aan één enkel deeltje als aan talloze transparante objecten
  een reflectie kunnen schenken.
</p>

<div class="page-footnote">
  <hr class="hr-footnote" />
  <p class="footnote-p"><sup>1</sup> “Noch jullie schepping noch jullie verwekking is anders dan die van één nefs.” <em>– Qur’an, 31:28</em></p>
  <p class="footnote-p"><sup>2</sup> “Aan ALLAH behoort de hoogste gelijkenis.” <em>– Qur’an, 16:60</em></p>
</div>

  </div>'
            ],
            [
                'page_number' => 97,
                'content' => '<div class="page" id="97"> <p class="text-end page-number">#97</p>

<p>
  En volgens het geheim van “transparantie” zijn de minuscule pupil van een transparant deeltje en het
  wijde oppervlak van de oceaan gelijk in het ontvangen van de weerkaatsing van de zon.
</p>

<p>
  En volgens het geheim van “ordening” kan een kind met zijn vinger zowel zijn speelgoedbootje als een
  gigantische dreadnought laten draaien.
</p>

<p>
  En volgens het geheim van “gehoorzaamheid” kan een commandant met één en hetzelfde bevel zowel
  één soldaat als een heel leger in beweging brengen.
</p>

<p>
  En volgens het geheim van “evenwicht” bevindt zich in de kosmische ruimte een balans. Laten we ons voorstellen
  dat ze zo gevoelig, nauwkeurig en kolossaal is, dat haar twee schalen zowel twee walnoten kunnen
  waarnemen als twee zonnen kunnen dragen en wegen. Terwijl ze van die twee walnoten op haar schalen de
  ene naar de hemelen kan tillen en de andere naar de aarde kan laten zakken, kan ze in het geval van twee
  zonnen eveneens met dezelfde kracht de ene naar de oppertroon verheffen en de andere naar de aardbodem
  laten dalen.
</p>

<p>
  In deze alledaagse, gebrekkige en vergankelijke wereld der mogelijkheden leiden de geheimen van lichternis,
  transparantie, ordening, gehoorzaamheid en evenwicht er dus toe dat het grootste gelijk is aan het
  kleinste; ontelbare zaken ogen gelijkwaardig aan één zaak.
</p>

<p>
  Als we dan kijken naar de lichtrijke manifestaties van Gods wezenlijke, eindeloze en volmaakte Macht,
  naar de spirituele transparantie van al het geschapene, naar de ordeningen van Wijsheid en het lot, naar
</p>

  </div>'
            ],
            [
                'page_number' => 98,
                'content' => '<div class="page" id="98"> <p class="text-end page-number">#98</p>

<p>
  de volstrekte gehoorzaamheid van alle creaties aan de Goddelijke scheppingswetten, en naar het evenwicht
  der mogelijkheden waarbij bestaan en niet-bestaan in balans zijn, dan blijkt uit deze geheimen dat begrippen
  als ‘veel’ of ‘weinig’, ‘groot’ of ‘klein’ uiteraard eveneens gelijkwaardig zijn voor de Schepper; met één
  oproep kan Hij alle mensen herzamelen als waren zij één mens.
</p>

<p class="text-italic text-bold">
  Bovendien ontstaan de niveaus van sterkte en zwakte door de invloed van hun tegenpolen.
</p>

<p class="text-bold">Bijvoorbeeld:</p>

<p>
  De mate van warmte wordt door de invloed van kou bepaald. De waarde van schoonheid wordt door de
  invloed van lelijkheid geconstateerd. De sterkte van licht wordt door de invloed van donkerte vastgesteld.
  Echter, als iets wezenlijk is en niet accidenteel, dan kan zijn tegenpool geen invloed erop uitoefenen. Want
  in dat geval zouden twee tegenpolen moeten samenkomen, wat onmogelijk is. Bij iets dat puur en wezenlijk
  is, bestaan dus geen gradaties.
</p>

<p>
  Aangezien de Macht van de Absolute Almacht wezenlijk is en niet accidenteel – <span class="text-italic">zoals dat het geval is bij
  het mogelijke</span> – en aangezien Zijn Macht volmaakt is, kan de tegenpool daarvan, oftewel onmacht, geenszins
  invloed erop uitoefenen. Een lente scheppen is voor het Ontzaglijke Opperwezen dus zo eenvoudig als de
  creatie van een bloem. Zou de schepping aan oorzaken worden toegeschreven, dan zou een bloem zo lastig
  als een lente tot stand komen. De wederopwekking en herzameling van alle mensen is voor Hem aldus zo
  licht als de wederopwekking van één nefs.
</p>

  </div>'
            ],
            [
                'page_number' => 99,
                'content' => '<div class="page" id="99"> <p class="text-end page-number">#99</p>

<p>
  Wat wij vanaf het begin tot hiertoe hebben verklaard in de symbolische “Aanzichten” en de “Waarheden”
  over de kwestie van de herzameling, is te danken aan de zegen <span class="text-italic">(feyz)</span> van de Qur’an-el’Hakîm.
  Het is bedoeld om de nefs tot overgave en het hart tot aanvaarding te brengen. Het ware Woord behoort
  echter de Qur’an toe. Hij is immers het Woord, en aan Hem is het Woord. Laten we luisteren:
</p>


<div class="text-center" style="margin-top: 40px;">
<div style="border-bottom: 2px solid #ca2a2a;"></div>
  <p class="text-red text-bold small-title">{Noot van de vertalers:</p>
  <p class="text-red">
  Hierop volgen passages uit de Qur’an. De oorspronkelijke Qur’anpassages staan op de rechterpagina’s; de
  vertalingen op de linker. Echter, zoals elders in de Risale-i Nur is vermeld, willen wij ook hier onderstrepen
  dat een ware vertaling van de Qur’an in wezen onmogelijk is. De beladen termen van de Arabische taal,
  evenals de oneindige zegeningen in de Qur’anische Verzen, kunnen uiteraard niet overgebracht worden in een
  andere taal.
</p>

<p class="text-red text-italic text-bold">
  Wij hopen dan ook dat de lezer beseft dat onze menselijke formuleringen het Goddelijke Woord geenszins
  recht doen; onze vertalingen zijn hoogstens zeer doffe schaduwen van de alomstralende Ayaat.}
</p>
</div>
  </div>'
            ],

[
    'page_number' => 100,
    'content' => '<div class="page" id="100">
    <p class="text-end page-number">#100</p>

    <p class="text-center text-italic">“Aan ALLAH behoort het beslissende bewijs.”</p>
    <p class="text-center text-italic"><em>– Qur’an, 6:149</em></p>

    <p class="text-center" style="margin: 18px auto 0 auto; max-width: 500px;">
      “Aanschouw de sporen van ALLAH’s Genade, hoe Hij de aarde
      na haar dood doet herleven.
      Voorzeker, Hij is Degene Die
      de doden tot leven brengt,
      en Hij bezit Macht over alles.”
    </p>
    <p class="text-center text-italic" style="margin: 18px auto 0 auto; max-width: 500px;"><em>– Qur’an, 30:50</em></p>

    <p class="text-center" style="margin: 18px auto 0 auto; max-width: 500px;">
      “(De ongelovige) vraagt: ‘Wie zal
      de beenderen doen herleven
      nadat ze zijn uiteengevallen?’
      Zeg: ‘Hij Die ze aanvankelijk
      heeft gecreëerd, zal ze doen
      herleven’, en ‘Hij bezit kennis
      over al het geschapene.’”
    </p>
    <p class="text-center text-italic" style="margin: 18px auto 0 auto; max-width: 500px;"><em>– Qur’an, 36:78-79</em></p>

  </div>'
],
            [
                'page_number' => 101,
                'content' => '<div class="page" id="101"> <p class="text-end page-number">#101</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 0 auto; max-width: 500px;">
  فَلِلّٰهِ الْحُجَّةُ الْبَالِغَةُ ۞
</p>

  <div class="text-center text-red">✧</div>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 0 auto; max-width: 500px;">
  فَانْظُرْ اِلٰۤى اٰثَارِ رَحْمَتِ اللّٰهِ
  كَيْفَ يُحْيِى اْلأَرْضَ بَعْدَ مَوْتِهَا اِنَّ ذٰلِكَ
  لَمُحْيِ الْمَوْتٰى وَهُوَ عَلٰى كُلِّ شَىْءٍ قَدِيرٌ ۞
</p>

  <div class="text-center text-red">✧</div>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 0 auto; max-width: 500px;">
  قَالَ مَنْ يُحْيِ الْعِظَامَ
  وَهِىَ رَمِيمٌ ۞ قُلْ يُحْيِيهَا الَّذِى
  اَنْشَاَهَا اَوَّلَ مَرَّةٍ
  وَهُوَ بِكُلِّ خَلْقٍ عَلِيمٌ ۞
</p>

  </div>'
            ],
            [
                'page_number' => 102,
                'content' => '<div class="page" id="102"> <p class="text-end page-number">#102</p>

<p class="text-center" style="margin: 18px auto 0 auto; max-width: 600px;">
  “O mensen,
  vrees jullie Heer!
  Voorzeker,
  de beving van het Uur
  is een immens gebeuren!
  Op die dag zul je zien
  dat iedere zogende moeder
  haar zuigeling zal vergeten,
  en elke zwangere vrouw
  zal haar last laten vallen.
  De mensen
  zul je in een staat
  van dronkenschap aantreffen,
  doch ze zijn niet dronken –
  maar de straf van ALLAH
  is zwaar.”
</p>
<p class="text-center text-italic" style="margin: 18px auto 0 auto; max-width: 500px;"><em>– Qur’an, 22:1-2</em></p>

  </div>'
            ],
            [
                'page_number' => 103,
                'content' => '<div class="page" id="103"> <p class="text-end page-number">#103</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 0 auto; max-width: 600px;">
  يَا أَيُّهَا النَّاسُ اتَّقُوا رَبَّكُمْ
  اِنَّ زَلْزَلَةَ السَّاعَةِ شَىْءٌ عَظِيمٌ ۞
  يَوْمَ تَرَوْنَهَا تَذْهَلُ
  كُلُّ مُرْضِعَةٍ عَمَّا أَرْضَعَتْ
  وَتَضَعُ كُلُّ ذَاتِ حَمْلٍ حَمْلَهَا
  وَتَرَى النَّاسَ سُكَارٰى
  وَمَا هُمْ بِسُكَارٰى
  وَلٰكِنَّ عَذَابَ اللّٰهِ شَدِيدٌ ۞
</p>

  </div>'
            ],
            [
                'page_number' => 104,
                'content' => '<div class="page" id="104"> <p class="text-end page-number">#104</p>

<p class="text-center" style="margin: 18px auto 0 auto; max-width: 500px;">
  “ALLAH,
  buiten Wie geen God bestaat,
  zal jullie op de dag der opstanding
  bijeenzamelen,
  daarover bestaat
  geen twijfel!
  En wie spreekt
  waarachtiger dan ALLAH?”
</p>
<p class="text-center text-italic" style="margin: 18px auto 0 auto; max-width: 500px;"><em>– Qur’an, 4:87</em></p>

<p class="text-center" style="margin: 18px auto 0 auto; max-width: 500px;">
  “Welzeker,
  de vromen verkeren
  in gelukzaligheid.
  En de verdorvenen verwijlen
  in een gloeiend vuur.”
</p>
<p class="text-center text-italic" style="margin: 18px auto 0 auto; max-width: 500px;"><em>– Qur’an, 82:13-14</em></p>

  </div>'
            ],
            [
                'page_number' => 105,
                'content' => '<div class="page" id="105"> <p class="text-end page-number">#105</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 0 auto; max-width: 500px;">
  اَللّٰهُ لَا إِلٰهَ إِلَّا هُوَ
  لَيَجْمَعَنَّكُمْ إِلٰى يَوْمِ الْقِيَامَةِ
  لَا رَيْبَ فِيهِ
  وَمَنْ أَصْدَقُ مِنَ اللّٰهِ حَدِيثًا ۞
</p>

<div class="text-center text-red">✧</div>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 0 auto; max-width: 500px;">
  إِنَّ الْأَبْرَارَ لَفِى نَعِيمٍ
  وَإِنَّ الْفُجَّارَ لَفِى جَحِيمٍ
</p>
  </div>'
            ],
            [
                'page_number' => 106,
                'content' => '<div class="page" id="106"> <p class="text-end page-number">#106</p>

<p class="text-center" style="margin: 18px auto 0 auto; max-width: 500px;">
  “Wanneer de aarde
  tijdens haar laatste stuipen siddert
  en haar lasten naar buiten werpt,
  en de mens vraagt
  wat haar overkomt,
  zal de dag zijn
  waarop ze haar verhaal vertelt,
  zodra jouw Heer haar
  daartoe inspireert.
  Die dag zullen mensen
  groepsgewijs verschijnen
  om hun daden te bezichtigen.
  Wie ook maar een weldaad
  zo licht als een stofdeeltje verricht,
  zal dat aanschouwen.
  En wie ook maar een wandaad
  zo licht als een stofdeeltje bedrijft,
  zal dat eveneens aanschouwen.”
</p>
<p class="text-center text-italic" style="margin: 18px auto 0 auto; max-width: 500px;"><em>– Qur’an, 99:1-8</em></p>

  </div>'
            ],
            [
                'page_number' => 107,
                'content' => '<div class="page" id="107"> <p class="text-end page-number">#107</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 0 auto; max-width: 500px;">
  اِذَا زُلْزِلَتِ الْأَرْضُ زِلْزَالَهَا ۞
  وَأَخْرَجَتِ الْأَرْضُ أَثْقَالَهَا ۞
  وَقَالَ الْإِنْسَانُ مَالَهَا ۞
  يَوْمَئِذٍ تُحَدِّثُ أَخْبَارَهَا ۞
  بِأَنَّ رَبَّكَ أَوْحٰى لَهَا ۞
  يَوْمَئِذٍ يَصْدُرُ النَّاسُ أَشْتَاتًا لِيُرَوْا أَعْمَالَهُمْ ۞
  فَمَنْ يَعْمَلْ مِثْقَالَ ذَرَّةٍ خَيْرًا يَرَهُ ۞
  وَمَنْ يَعْمَلْ مِثْقَالَ ذَرَّةٍ شَرًّا يَرَهُ ۞
</p>
  </div>'
            ],
            [
                'page_number' => 108,
                'content' => '<div class="page" id="108"> <p class="text-end page-number">#108</p>

<p class="text-center" style="margin: 18px auto 0 auto; max-width: 500px;">
  “El’Qâri’ah!
  Wat is El’Qâri’ah?
  En wat kan jou besef geven
  van El’Qâri’ah?
  Een dag waarop mensen ogen
  als verstrooide motten,
  en bergen als geplozen wolvlokken.
  Wiens balans die dag beladen is,
  zal leven in voldoening.
  En wiens balans tekortschiet,
  zal Hâwiyeh
  als zijn moeder ontmoeten.
  En hoe zou jij kunnen
  beseffen wat zij is?
  ‘Een laaiend inferno!’”
</p>
<p class="text-center text-italic" style="margin: 18px auto 0 auto; max-width: 500px;"><em>– Qur’an, 101:1-8</em></p>

  </div>'
            ],
            [
                'page_number' => 109,
                'content' => '<div class="page" id="109"> <p class="text-end page-number">#109</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 0 auto; max-width: 600px;">
  اَلْقَارِعَةُ ۞ مَا الْقَارِعَةُ
  وَمَٓا أَدْرٰيكَ مَا الْقَارِعَةُ ۞ يَوْمَ يَكُونُ
  النَّاسُ كَالْفَرَاشِ الْمَبْثُوثِ ۞
  وَتَكُونُ الْجِبَالُ كَالْعِهْنِ الْمَنْفُوشِ ۞
  فَأَمَّا مَنْ ثَقُلَتْ مَوَازِينُهُ ۞
  فَهُوَ فِى عِيشَةٍ رَاضِيَةٍ ۞
  وَأَمَّا مَنْ خَفَّتْ مَوَازِينُهُ ۞
  فَأُمُّهُ هَاوِيَةٌ ۞ وَمَٓا أَدْرٰيكَ مَا هِيَهْ ۞
  نَارٌ حَامِيَةٌ ۞
</p>

  </div>'
            ],
            [
                'page_number' => 110,
                'content' => '<div class="page" id="110"> <p class="text-end page-number">#110</p>

<p class="text-center" style="margin: 18px auto 0 auto; max-width: 500px;">
  “Wat verborgen is
  in de hemelen en op aarde,
  is bekend bij ALLAH.
  Het Uur
  is nader dan een oogwenk,
  of zelfs dichterbij.
  Voorzeker,
  ALLAH bezit Macht
  over alles.”
</p>
<p class="text-center text-italic" style="margin: 18px auto 0 auto; max-width: 500px;"><em>– Qur’an, 16:77</em></p>

  </div>'
            ],

            [
                'page_number' => 111,
                'content' => '<div class="page" id="111"> <p class="text-end page-number">#111</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 0 auto; max-width: 500px;">
  وَلِلّٰهِ
  غَيْبُ السَّمٰوَاتِ وَالْأَرْضِ
  وَمَٓا أَمْرُ السَّاعَةِ
  إِلَّا كَلَمْحِ الْبَصَرِ
  أَوْ هُوَ أَقْرَبُ ۞
  إِنَّ اللّٰهَ عَلٰى كُلِّ شَىْءٍ قَدِيرٌ
</p>
  </div>'
            ],

            [
                'page_number' => 112,
                'content' => '<div class="page" id="112"> <p class="text-end page-number">#112</p>

<p>
  Laten we aldus gehoor geven aan zulke verhelderende Ayaat van de Qur’an, en laten wij reageren met:
  <span class="text-bold">“Wij geloven en beamen dit.”</span>
</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 18px auto 0 auto; max-width: 500px;">
  آمَنْتُ بِاللّٰهِ وَمَلَائِكَتِهِ وَكُتُبِهِ وَرُسُلِهِ وَالْيَوْمِ الْاٰخِرِ
  وَبِالْقَدَرِ خَيْرِهِ وَشَرِّهِ مِنَ اللّٰهِ تَعَالٰى وَالْبَعْثُ
  بَعْدَ الْمَوْتِ حَقٌّ وَأَنَّ الْجَنَّةَ حَقٌّ وَالنَّارَ حَقٌّ
  وَأَنَّ الشَّفَاعَةَ حَقٌّ وَأَنَّ مُنْكَرًا وَنَكِيرًا حَقٌّ
  وَأَنَّ اللّٰهَ يَبْعَثُ مَنْ فِى الْقُبُورِ
  أَشْهَدُ أَنْ لَا إِلٰهَ إِلَّا اللّٰهُ وَأَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ
  اَللّٰهُمَّ صَلِّ عَلٰى أَلْطَفِ وَأَشْرَفِ وَأَكْمَلِ
  ثَمَرَاتِ طُوبٰى رَحْمَتِكَ الَّذِى أَرْسَلْتَهُ رَحْمَةً لِلْعَالَمِينَ
  وَسِيلَةً لِوُصُولِنَا إِلٰى أَزْيَنِ وَأَحْسَنِ وَأَجَلِّ وَأَعْلٰى ثَمَرَاتِ
  تِلْكَ الطُّوبٰى الْمُتَدَلِّيَةِ مِنْ دَارِ الْاٰخِرَةِ أَىِ الْجَنَّةِ
  اَللّٰهُمَّ أَجِرْنَا وَوَالِدَيْنَا مِنَ النَّارِ
  وَأَدْخِلْنَا وَوَالِدَيْنَا الْجَنَّةَ مَعَ الْأَبْرَارِ
  بِجَاهِ نَبِيِّكَ الْمُخْتَارِ آمِينَ
</p>

  </div>'
            ],

            [
                'page_number' => 113,
                'content' => '<div class="page" id="113"> <p class="text-end page-number">#113</p>

<p class="text-center text-bold text-center-constrained">
  “Ik geloof in ALLAH, in Zijn engelen, in Zijn Boeken en
  in Zijn profeten, in de Laatste Dag en in het Lot, waarbij
  zowel heil als onheil onderworpen zijn aan
  ALLAH, de Verhevene.
</p>

<p class="text-center text-bold text-center-constrained">
  Ik geloof in de werkelijkheid van de herrijzenis na de
  dood, de werkelijkheid van het paradijs, de werkelijkheid
  van het hellevuur, de werkelijkheid van de bemiddeling,
  en de werkelijkheid van Moenker en Nekier
  <span class="text-italic">(de twee engelen die de overledenen in het graf ondervragen).</span>
</p>

<p class="text-center text-bold text-center-constrained">
  Ik geloof dat ALLAH de overledenen
  uit hun graven zal laten rijzen.
</p>

<p class="text-center text-bold text-center-constrained">
  Ik getuig dat er geen God is behalve ALLAH, en ik getuig
  dat Mohammed de boodschapper is van ALLAH.”
</p>

<p class="text-center text-bold text-center-constrained">
  “O ALLAH, laat zegeningen neerdalen op Uw subtielste,
  edelste, volmaaktste en prachtigste vrucht van Uw
  Tûba-boom der Genade, die U heeft afgevaardigd als genade
  voor alle werelden, en als middel voor ons om de
  mooiste, schoonste, subliemste en verhevenste vruchten
  van die Tûba-boom te bereiken, die hangen in de hoogtes
  van het hiernamaals, in de gewesten van het paradijs. O
  ALLAH, behoed ons en onze ouders voor het vuur, schenk
  ons en onze ouders toegang tot het paradijs, in het gezelschap
  van de rechtschapenen, omwille van de eer van Uw
  uitverkoren profeet, âmîn.”
</p>

<p>
  O broeder die dit traktaat naar eer en geweten bestudeert. Zeg niet:
  <span class="text-italic">“Waarom kan ik dit ‘Tiende Woord’ niet meteen volledig begrijpen?”</span>
  En wees niet ontmoedigd als alles niet direct helemaal helder wordt. Want zelfs een filosofisch genie zoals
  Ibn Sina <span class="text-italic">(Avicenna)</span> zei:
</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">
  اَلْحَشْرُ لَيْسَ عَلٰى مَقَايِيسِ عَقْلِيَّةٍ
</p>

  </div>'
            ],

            [
                'page_number' => 114,
                'content' => '<div class="page" id="114"> <p class="text-end page-number">#114</p>

<p class="text-italic">
  “De herzameling laat zich niet meten naar de maatstaf van het verstand.”
</p>

<p>Hij concludeerde:</p>

<p class="text-italic">
  “Wij geloven, maar voor het verstand is deze weg onbegaanbaar.”
</p>

<p>
  Bovendien hebben alle islamgeleerden unaniem als volgt geoordeeld:
  <span class="text-italic">“De herzameling is een geloofskwestie die is overgeleverd. Het bewijs ervan berust op transmissie.
  Met het verstand alleen kan ze niet bereikt worden.”</span>
  Het is dan ook vanzelfsprekend dat zo’n diep en spiritueel verheven pad niet opeens kan veranderen in een
  openbare laan die voor ieder verstand toegankelijk is.
</p>

<p>
  In dit tijdperk, waarin traditionele navolging en overgave nagenoeg verloren zijn, behoren wij duizendmaal
  dank te betuigen omdat wij, met de zegen van de Qur’an en de Gratie van de Genadige Schepper, ten opzichte
  van zo’n diep en verheven pad zo genereus zijn begunstigd. Want het is voldoende om ons imaan
  <span class="text-italic">(geloof)</span> te redden. Wij horen tevreden te zijn met wat wij eruit begrijpen en naar meer diepgang te streven
  door dit traktaat herhaaldelijk te bestuderen. Een reden waarom de herzameling niet met het verstand wordt
  benaderd, schuilt in het volgende geheim:
</p>

<p>
  De ultieme herzameling zal geschieden via de manifestatie van Gods Ultieme Naam. Daarom behoren eerst
  de majestueuze activiteiten van de Alwaarachtige, die zich voltrekken via de manifestatie van zowel Zijn Ultieme
  Naam als het ultieme niveau van elke Goddelijke Naam, aanschouwd en gepresenteerd te worden, waarna
  de ultieme herzameling zo helder als de lente eenvoudig bewezen, ten volle beaamd en met onwankelbare
  zekerheid aanvaard kan worden.
</p>

  </div>'
            ],
            [
                'page_number' => 115,
                'content' => '<div class="page" id="115"> <p class="text-end page-number">#115</p>
<p>
  In dit “Tiende Woord” worden deze activiteiten dankzij de zegen van de Qur’an op deze wijze veraanschouwelijkt
  en gepresenteerd. Anders, als het verstand slechts aan zijn eigen bekrompen en beperkte principes zou worden
  overgelaten, dan zou het machteloos staan en gedwongen zijn tot blinde navolging.
</p>

  </div>'
            ],

            [
                'page_number' => 116,
                'content' => '<div class="page" id="116"> <p class="text-end page-number">#116</p>


<p class="text-italic">
  Hoewel “Het Tiende Woord” hier eindigt, heeft de auteur in het oorspronkelijke traktaat bepaalde aanvullende
  delen uit de Risale-i Nur als bijlagen opgenomen. Tot onze grote spijt is het ons in deze editie niet gelukt
  om deze bijlagen te vertalen. Moge ALLAH ons in staat stellen om deze in de eerstvolgende druk ook te vertalen
  en toe te voegen.
</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 18px auto 0 auto; max-width: 500px;">
  رَبَّنَا لَا تُزِغْ قُلُوبَنَا بَعْدَ إِذْ هَدَيْتَنَا وَهَبْ لَنَا مِن لَّدُنكَ رَحْمَةً
  إِنَّكَ أَنتَ الْوَهَّابُ
</p>

<p class="text-center" style="margin: 18px auto 0 auto; max-width: 500px;">
  “O Heer,
  laat onze harten niet dwalen
  nadat U ons hebt geleid.
  Schenk ons Genade vanuit Uw Verhevenheid.
  Voorzeker, U bent de Vrijgevige Schenker.”
</p>
<p class="text-center text-italic" style="margin: 18px auto 0 auto; max-width: 500px;"><em>– Qur’an, 3:8</em></p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 18px auto 0 auto; max-width: 500px;">
  وَآخِرُ دَعْوَاهُمْ أَنِ الْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمِينَ
</p>

<p class="text-center" style="margin: 18px auto 0 auto; max-width: 500px;">
  “En zij eindigen hun beden met:
  alle lof zij ALLAH,
  de Heer der werelden.”
</p>
<p class="text-center text-italic" style="margin: 18px auto 0 auto; max-width: 500px;"><em>– Qur’an, 10:10</em></p>

<p class="text-end text-italic" style="margin-top: 24px;">De Vertalers</p>

  </div>'
            ],




        ];
    }
}
