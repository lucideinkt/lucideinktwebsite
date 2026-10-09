## Lucide Inkt Website

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
