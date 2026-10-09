## Lucide Inkt Website

### Boeknavigatie

`GET /api/v1/books/{slug}/navigation` geeft voor gepubliceerde boeken met pagina's
`schema_version`, `book` (`slug`, `title`), `page_numbers` (werkelijke, gesorteerde
paginanummers) en `toc` terug. De inhoudsopgave komt uit dezelfde
`config/book_toc.php` als de website. Elke entry bevat `level` (`main`/`sub`),
`title`, `subtitle` (tekst of `null`) en `page`. Zonder geconfigureerde
inhoudsopgave is `toc` een lege lijst. Onbekende, ongepubliceerde en lege boeken
geven 404. De route heeft dezelfde rate limit als de overige boeken-API.

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
