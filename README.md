## Lucide Inkt Website

### Leesinstellingen

Het leesmenu gebruikt op mobiel en desktop hetzelfde zwevende venster zonder
kopbalk. Sluiten kan buiten het venster of met Escape.
Tekst/Kleuren heeft ook geen kopbalk en biedt **Terug** naar het leesmenu.
Bladwijzers en markeringen behoudt zijn titel en sluitknop.
Op desktop vervangt de instellingenknop de losse lettergroottebediening en
themaschakelaar in de bovenbalk. Deze knop opent dezelfde volledige instellingen.
Zoeken, paginakeuze en inhoudsopgave openen als compacte vensters onder de
bovenbalk, ook op mobiel. Zoekresultaten scrollen binnen het venster; de hoogte
past zich aan de zichtbare ruimte boven het schermtoetsenbord aan.
Zoeken gebruikt dezelfde enkele invoerrand, inline resultaatrijen (`p. … · tekst`),
markeerkleuren en transparante sluitlaag als de app. Zoekopdrachten starten na
120 ms vanaf twee tekens; wijzigen, wissen en sluiten annuleren oude aanvragen.
Opnieuw openen begint met een leeg zoekveld. Op mobiel kan het toetsenbord
worden verborgen zonder het zoekvenster te sluiten; zoekmarkeringen kunnen
afzonderlijk via het leesmenu worden gewist.
De inhoudsopgave toont volledige, afbreekbare hoofdstuktitels en ondertitels,
met paginanummers rechts en een rand bij het huidige hoofdstuk. Bij openen
wordt alleen de lijst naar dat hoofdstuk geschoven, niet de boektekst erachter.
De vensters, invoervelden, knoppen en bovenbalk volgen het gekozen kleurthema.
De website gebruikt dezelfde menuoppervlakken, compacte rijen en herstelknoppen
onder de tekstlabels als de app. De inhoudsopgaveknop staat rechts naast de
paginanummers in de bovenbalk; niet meer onderaan het paginakeuzevenster.
Desktop heeft hiervoor slechts een enkele knop in de bovenbalk.
Onder **Thema's en instellingen** staan twee toetsenbordbedienbare tabs:
**Tekst** (Nederlandse en Arabische lettergrootte, regelafstand en zijruimte met
plus/min-knoppen) en **Kleuren**. Ronde kleurvoorbeelden tonen de achtergrond
met `Aa` in de bijbehorende tekstkleur; Systeem volgt ook in dit voorbeeld de
apparaatinstelling. Het menu gebruikt compacte, rustige typografie.
Elke tekstinstelling heeft een eigen herstelknop. **Standaardkleur herstellen**
staat alleen bij Kleuren en kiest Systeem, zonder de tekstinstellingen te wijzigen.
Herstellen verandert nooit de leespositie, bladwijzers of markeringen.
Extra kleurthema's vervangen ook de papiertextuur op de zichtbare leeslaag;
het oorspronkelijke thema Papier behoudt zijn textuur.
Bismillah-afbeeldingen en voetnootknoppen gebruiken bij de extra thema's
de bijbehorende accentkleur, met contrasterende cijfers op de knoppen.
Donker grafiet gebruikt koel blauw (`#A9CCE8`), Nachtmodus zacht saliegroen
(`#B8C9AD`) en Zwart champagnegoud (`#C8B78F`), ook voor Arabisch en titels,
met per thema afgestemde secundaire tekst.
De headericonen volgen de app: 14 px iconen zonder achtergrond of binnenpadding,
met een brede klikzone die binnen de headerhoogte blijft.
Papier en Donker behouden hun oorspronkelijke SVG-kleuren en badgeverlopen. Ook Arabisch en titels volgen het geselecteerde thema.
De afbeeldingsvorm, voetnootacties en leespositie blijven bij wisselen behouden.

In het leesmenu bij **Thema's en instellingen** kunnen lezers de regelafstand
(1,2–2,2) en zijruimte (8–64, zonder technische eenheid in het menu) aanpassen en afzonderlijk resetten.
Zonder opgeslagen voorkeur blijft de bestaande zijruimte behouden: 16 px op
smalle schermen en 32 px op desktop. De standaardregelafstand is 1,5.
Arabische blokken houden bij een kleinere regelafstand voldoende ruimte voor
diakritische tekens en worden bij een grotere instelling ruimer.

Papier en het oorspronkelijke warme Donker blijven behouden. Daarnaast zijn er
Warm ivoor (`#F8F5EB` / `#302D28`), Papierwit (`#FAF9F6` / `#252525`),
Klassiek sepia (`#F2E6D1` / `#46392A`), Zacht saliegroen (`#EFF3EB` / `#24352D`),
Donker grafiet (`#1E2226` / `#E4E2DD`), Nachtmodus (`#1E1E1E` / `#E5E5E5`)
en Zwart / AMOLED (`#000000` / `#D8D8D8`), telkens achtergrond / tekst,
plus Systeem (automatisch Papier of het oorspronkelijke Donker).
Papier en Donker staan vooraan; alleen Papier heeft een papiertextuur. Tekst, menu's, zoekvensters en voetnootvensters krijgen
bijpassende kleuren. Een oude donkere voorkeur blijft donker.
Voorkeuren worden lokaal in dezelfde browser bewaard, niet met de app
gesynchroniseerd. Leesposities, bladwijzers en markeringen blijven behouden.

Controleer met `node --test tests/reader-preferences.test.mjs tests/reader-dialogs.test.mjs` en `npm run build`.
Deploy de Blade-template, reader-JavaScript en gebouwde CSS samen; opnieuw
seeden of bestaande boeken opnieuw downloaden is voor deze instellingen niet nodig.

### Arabisch op iPhone/iPad

De boeklezer gebruikt alleen op iOS `resources/fonts/OmarNaskh-Reader.ttf`.
Dit is dezelfde Omar Naskh met ongewijzigde glyphs en letterbreedtes; een guard in
GSUB lookup 76 voorkomt dat CoreText klinkertekens tweemaal invoegt. De variant
komt uit de mobiele app (`risale-lezer/scripts/build-reader-font.py`).
Android en desktop houden het oorspronkelijke font. Er worden geen extra
verbindingstekens aan de tekst toegevoegd: die werden door CoreText als spaties
getekend en verstoorden sommige letterverbindingen.

Deploy de reader-template samen met de gebouwde CSS en font-assets
(`npm run build`). Opnieuw seeden of boekinhoud wijzigen is niet nodig.

### Arabische scheidingsornamenten

De webreader houdt het Arabische scheidingsornament (`۞`) met een vaste spatie
bij het voorafgaande woord, ook op later ingeladen pagina's. Hiervoor is opnieuw
seeden niet nodig; bouw en deploy de reader-assets met `npm run build`.

### Boeknavigatie

`GET /api/v1/books/{slug}/navigation` geeft voor gepubliceerde boeken met pagina's
`schema_version`, `book` (`slug`, `title`), `page_numbers` (werkelijke, gesorteerde
paginanummers) en `toc` terug. De inhoudsopgave komt uit dezelfde
`config/book_toc.php` als de website. Elke entry bevat `level` (`main`/`sub`),
`title`, `subtitle` (tekst of `null`) en `page`. Zonder geconfigureerde
inhoudsopgave is `toc` een lege lijst. Onbekende, ongepubliceerde en lege boeken
geven 404. De route heeft dezelfde rate limit als de overige boeken-API.

### Versies voor offline boeken

Catalogusitems (`GET /api/v1/books`) en het `book`-object van navigatie en
pagina's bevatten aanvullend `content_version`: een stabiele SHA-256 van de
boekinhoud. `schema_version` blijft 1; bestaande clients hoeven niet te wijzigen.
De versie verandert bij gewijzigde tekst/voetnoten, toegevoegde of verwijderde
pagina's, paginanummers, titel/beschrijving, omslag, inhoudsopgave en gewijzigde
lokale afbeeldingsbestanden (ook bij vervanging onder dezelfde naam).
Wijzigingen aan de JSON-serializer krijgen eveneens een nieuwe versie.
Een algemene producttijdstempel wijzigt de versie niet.

`BookContentVersion` leest de actuele pagina's en configuratie, zonder migratie
of afhankelijkheid van model-events. Daarmee worden ook bulk-imports en directe
pagina-updates herkend. Afbeeldingsbronnen worden kort gecachet op basis van de
inhoud; lokale bestandsbytes worden opnieuw gehasht. Externe afbeeldingen worden
alleen op URL vergeleken: gebruik daarvoor een nieuwe/versioned URL bij vervanging.
Gebruik de publieke opslag of bestanden onder `public/` voor detectie van
vervangingen op dezelfde URL. Tijdens publicatie kan een onvolledige import
tijdelijk een andere versie geven; publiceer volledige wijzigingen samen.

Optioneel accepteert `GET /api/v1/books/{slug}/pages` een `version`-parameter
(64 kleine hextekens). Als die niet overeenkomt met de actuele versie, volgt
HTTP 409 met een melding om opnieuw te beginnen. Zonder parameter blijft het
bestaande gedrag behouden. De paginareactie en versie gebruiken dezelfde
pagina-snapshot. De mobiele app controleert bovendien na het opslaan van alle
afbeeldingen opnieuw de navigatieversie, voordat de offline download wordt
vastgelegd.

Deploy de aangepaste controllers en `app/Services/BookContentVersion.php` samen.
Gebruik bij een deployment van gewijzigde inhoudsopgaven de normale
config-cacheverversing van Laravel, zodat de API de nieuwe configuratie ziet.
Er zijn geen database-migraties nodig. De app toont meldingen voor verschillen
met de gedownloade versie en laat de gebruiker opnieuw downloaden; bestaande
downloads zonder versie moeten eenmaal opnieuw worden opgehaald. Dit zijn
meldingen binnen de app, geen pushmeldingen wanneer de app gesloten is.

In de lezer opent de paginavoortgang in de bovenbalk een compact venster met
paginanummer en schuifbalk. De knop rechts ervan opent de inhoudsopgave; het
Inhoud-blok met schuifbalk blijft ook beschikbaar in het mobiele
instellingenmenu. Het paginavenster verduistert of vervaagt de boektekst niet.

`GET /api/v1/books/{slug}/search?q=...` doorzoekt alle pagina's van een
gepubliceerd boek met dezelfde accentongevoelige zoekfunctie als de website.
De zoektekst bevat 2 tot 200 tekens. De reactie bevat `results` (maximaal 100
treffers met `page` en `snippet`) en `total`. Bladwijzers en markeringen worden
lokaal opgeslagen; website en app synchroniseren deze niet.

Zoekresultaten en opgeslagen tekstmarkeringen openen bij de gemarkeerde
passage, gecentreerd in het leesvenster onder de bovenbalk. Een opgeslagen
markering uit een ander boek behoudt daarbij haar vindplaats. Gewone
paginasprongen en bladwijzers behouden hun bestaande navigatie.
