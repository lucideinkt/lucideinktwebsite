# Boekcontent: huidig formaat en JSON-doel

## Doel

De seeder- en databasecontent is de bron voor alle boeklezers. Het doel is:

- de bestaande Laravel-reader en diens visuele opmaak behouden
- inhoud semantisch en uniform genoeg opslaan om betrouwbaar te kunnen converteren
- een versieerbare JSON-API aanbieden die native React Native-elementen kan renderen

De huidige boekinhoud is legacy HTML met bestaande CSS-klassen en inline styles. De API behoudt de structuur en zet een deel van de herkenbare opmaak om naar platform-neutrale tokens, maar geeft niet alle CSS/layout 1:1 door. De React Native-app moet die tokens zelf vormgeven; exacte visuele gelijkheid met de website is nog niet aangetoond.

## Huidige architectuur

```text
Seeders -> book_pages.content (HTML) -> Laravel HTML-reader (bestaande HTML + CSS)
                                  \-> /api/v1/books/{slug}/pages -> native-friendly JSON nodes
                                      /api/v1/books -> gepubliceerde HTML-boekcatalogus voor ontdekking
                                      /bibliotheek/{slug}/paginas -> legacy JSON met ruwe HTML
```

De bestaande `GET /bibliotheek/{slug}/paginas`-route geeft `page_number` en `content` als HTML terug. Voor React Native is `/api/v1/books/{slug}/pages` het bedoelde endpoint: het levert een gestructureerde renderboom, zodat de app de legacy HTML niet zelf hoeft te parsen.

## Boekcatalogus voor mobiele apps

`GET /api/v1/books?page=1&limit=20` geeft de gepubliceerde HTML-boeken terug die ten minste één boekpagina hebben. Conceptboeken en producten zonder boekpagina's worden niet opgenomen. De lijst is alfabetisch gesorteerd en gepagineerd; `limit` is 1 t/m 50. Nieuwe boeken verschijnen vanzelf zodra ze gepubliceerd zijn en pagina's hebben, zonder dat er een app-release of aparte API-configuratie nodig is. De client vraagt de catalogus opnieuw op om wijzigingen te ontdekken; de API pusht geen updates naar een app die niet actief aanvraagt.

Een boekitem bevat `slug`, `title`, `description`, `cover_image`, `page_count` en `pages_url`. De cover gebruikt eerst de specifieke `online_lezen_image` en anders `image_1`; bestandspaden worden als absolute URL teruggegeven. De app kan `pages_url` ophalen om het pagina-endpoint te gebruiken. Een voorbeeldresponse:

```json
{
  "schema_version": 1,
  "books": [
    {
      "slug": "voorbeeldboek",
      "title": "Voorbeeldboek",
      "description": "Korte omschrijving",
      "cover_image": "https://example.test/storage/products/cover.webp",
      "page_count": 120,
      "pages_url": "https://example.test/api/v1/books/voorbeeldboek/pages"
    }
  ],
  "pagination": {
    "page": 1,
    "limit": 20,
    "total": 1,
    "last_page": 1,
    "has_more": false
  }
}
```

## Afgesproken contentregels

- Iedere pagina blijft een zelfstandige `.page` met het bestaande paginanummer en alle bestaande typografie-, layout- en taalmetadata.
- Een voetnootverwijzing is een gewone `<sup>N</sup>` op de plek van de verwijzing.
- De nootinhoud staat uitsluitend in het `.page-footnote`-blok als `.footnote-p`-elementen; niet in een `<button>` of `data-html`-attribuut.
- De bestaande reader maakt van `<sup>`-verwijzingen tijdens het renderen interactieve popovers op basis van het aparte voetnotenblok. Het verborgen blok blijft ook de bron voor printweergave en toekomstige export.
- De badge en de bijbehorende tekst openen dezelfde noot: volledige Arabische citaten en Bismillah-afbeeldingen zijn aantikbaar, bij Nederlandse tekst alleen het woord direct voor de badge. Een badge voor een Arabisch citaat wordt aan dat volgende citaat gekoppeld. De website ondersteunt ook Enter/Spatie op deze tekst; gewone links behouden hun navigatie. De native client leidt deze tapdoelen lokaal af, zonder wijziging van het API-contract of de seeders.
- Behoud bestaande inline markup, classes, styles, talen, RTL-richting, afbeeldingen en tekst. Normaliseren betekent hier niet dat boekopmaak verwijderd of opnieuw ontworpen wordt.
- Beide lezers groeperen inline Arabische citaten met hun badge aan het Arabische leeseinde (links). Een verwijzing direct voor of na het citaat wordt alleen in de weergave verplaatst; broncontent en API-target blijven ongewijzigd. Bismillah en losse Arabische alinea's behouden hun bestaande indeling.
- De inline citaatgroep op de website erft geen alinea-inspringing (`text-indent: 0`), zodat er naast de normale woordspatie geen extra gat voor de Nederlandse vervolgtekst ontstaat.

## JSON-contract voor de React Native-client

De eerste versie van de JSON-conversielaag is geïmplementeerd als afzonderlijk endpoint: `GET /api/v1/books/{slug}/pages?after=0&limit=10`. Alleen boeken met gepubliceerde boekcontent zijn openbaar beschikbaar; andere boeken geven 404. `after` is een niet-negatief paginanummer en `limit` is 1 t/m 20 (standaard 10); ongeldige waarden geven 422. Het endpoint is begrensd op 60 aanvragen per minuut. De bestaande HTML-reader en HTML-pagina-API blijven ongewijzigd.

De API-response is een inhoudsboom, niet een HTML-string in een knop of in een attribuut:

```json
{
  "schema_version": 1,
  "book": { "slug": "voorbeeldboek", "title": "Voorbeeldboek" },
  "pages": [
    {
      "page_number": 17,
      "blocks": [
        {
          "type": "paragraph",
          "presentation": { "alignment": "center" },
          "children": [
            { "type": "text", "text": "Tekst met voetnoot " },
            { "type": "footnote_ref", "number": 1, "target": "17:1" }
          ]
        }
      ],
      "footnotes": [
        {
          "number": 1,
          "target": "17:1",
          "blocks": [
            {
              "type": "paragraph",
              "children": [{ "type": "text", "text": "Voetnootinhoud" }]
            }
          ],
          "continues_from_previous_page": false,
          "continues_to_next_page": false
        }
      ]
    }
  ],
  "pagination": {
    "after": 0,
    "limit": 10,
    "next_after": 17,
    "has_more": false
  }
}
```

Contractregels:

- `schema_version` bepaalt de vorm van de JSON, onafhankelijk van de versie van de mobiele app.
- Het endpoint retourneert boekslug en titel, gestructureerde pagina's en cursorgestuurde paginering (`after`, `limit`, `next_after`, `has_more`).
- `blocks` bevat getypeerde blokken (zoals `paragraph`, `heading`, `image` en `list`) met geneste inline nodes (zoals `text`, `strong`, `emphasis`, `link` en `footnote_ref`).
- Echte `<strong>`- en `<em>`-elementen blijven semantische `strong`- en `emphasis`-nodes. De legacy CSS-classes `text-bold` en `text-italic` worden daarentegen opmaaktokens (`font_weight` en `font_style`), zodat een gestylede paragraaf een paragraaf blijft en visueel vet niet automatisch als semantische nadruk wordt gelezen.
- Een voetnootverwijzing bevat alleen nummer en target. De noot staat één keer in `footnotes`; meerdere verwijzingen naar dezelfde noot kunnen hetzelfde target delen.
- Voetnoten behouden rijke inhoud en meerdere paragrafen. Nummerloze noten aan het begin van een pagina worden gemarkeerd als voortzetting vanaf de vorige pagina; een afsluitende `→` wordt `continues_to_next_page`.
- Een blok of inline node met Arabisch/RTL bevat expliciete `language` en `direction` metadata, bijvoorbeeld `ar` en `rtl`.
- `presentation` bevat uitsluitend allowlisted, platform-neutrale tokens voor een deel van de boekopmaak, zoals uitlijning, accent, semibold/italic, typeface, inhoudsrol en beperkte breedte. De React Native-app moet deze tokens naar native `Text`/`View`-stijlen mappen; ze zijn geen CSS.
- Afbeeldingen worden nodes met een bron-URL en alternatieve tekst; site-relatieve paden worden door de app opgelost tegen de geconfigureerde API-origin. Ruwe HTML wordt niet als uitvoerbaar element aan de app doorgegeven.
- Paginering behoudt `after`, `limit` en `has_more`, zodat bestaande laadlogica bruikbaar blijft.

Controle over alle vijf gepubliceerde boeken (605 databasepagina's) bevestigde behoud van de tekst en de volgorde van verwijzingen en noten. Zeven noten die eindigen op `→` worden doelbewust weergegeven met `continues_to_next_page: true` in plaats van de pijl als tekstnode; dit zijn doorlopende noten op pagina's 13, 50, 53, 55, 63, 66 en 71 van *Het Traktaat Over De Herzameling*. De lege pagina's blijven als pagina-object met een lege `blocks`-lijst aanwezig.

Dat garandeert geen identieke pixels: de website-CSS bevat boekfonts, responsive Arabische fontgroottes, margins, line-height, breedtes, themakleuren en dark-mode gedrag. Die eigenschappen zijn niet allemaal in JSON gemodelleerd en moeten voor de app doelbewust in native styles worden nagebouwd en visueel vergeleken. De bron bevat één HTML-tabel en Arabische `<sub>`-opmaak; de serializer bewaart deze als generieke `element`-nodes met een `tag`. De React Native-renderer toont tabellen als horizontaal scrollbare native rijen/cellen en subscripts als kleinere inline tekst; dit is een benadering van de webopmaak. Serializer- en endpointtests controleren nodevorm, tekstbehoud, zichtbaarheid, paginering en voetnootrelaties; ze zijn geen visuele React Native-regressietests.

## Richtlijnen voor de latere semantische conversie

De volgende regels beschrijven de gewenste semantiek van de JSON-conversie; ze betekenen niet dat de huidige bron-HTML nu al volledig naar deze vorm moet worden herschreven.

### 1. Root-element
- Gebruik `<article class="book-content">` als root.
- Dit is het canonieke document voor één boek.

### 2. Pagina-elementen
- Gebruik `<section class="book-page" data-page="N">` per pagina.
- `data-page` is verplicht.
- `aria-label` mag worden toegevoegd wanneer nodig.

### 3. Headings
- Gebruik `h1`/`h2`/`h3` volgens documentstructuur.
- `h1` is book title of first-level title.
- `h2` is hoofdstuk/sectie titel.
- `h3` is onderafdeling wanneer nodig.
- Geen generieke `div`-heading containers in canonical HTML.

### 4. Paragraphs
- Normale tekst gaat in `<p>`.
- Citaten die semantisch een citaat zijn, gaan in `<blockquote>`.
- Standaard tekst bevat geen inline style; stijl hoort bij de consumer.

### 5. Lists
- Gebruik `ul` en `ol` wanneer inhoud echt een lijst is.
- `li` is verplicht voor list-items.

### 6. Footnotes and references
- In bron-HTML is een verwijzing `<sup>N</sup>` en staat de inhoud in `.page-footnote .footnote-p`.
- In JSON wordt de verwijzing een `footnote_ref`-node met een target; de volledige noot staat één keer in de `footnotes`-lijst van de pagina.
- De JSON-conversie mag geen noottekst in een button- of HTML-attribuut bewaren.

### 7. Arabic / RTL / multilingual content
- Gebruik `p` of `blockquote` met `lang="ar" dir="rtl"` voor Arabic tekst.
- Laat de consumer de juiste font, size en line-height regelen.
- Gebruik `lang` en `dir` als semantische metadata, niet als presentational workaround.

### 8. Images and illustrations
- Gebruik `<figure>` en `<img>` wanneer een afbeelding een echte inhoudscomponent is.
- `figcaption` is toegestaan wanneer de afbeelding extra context nodig heeft.
- Bismillah-illustraties kunnen als `<figure class="bismillah">` staan.

### 9. Page metadata
Gebruik deze 1:1 met bestaande content:
- `data-page` op de pagina-sectie
- `page-number` als tekst of metadata
- `book_title` kan als `header`/`h1` of `meta` worden opgenomen

## Semantische JSON-vocabulaire

De JSON-converter vertaalt HTML naar stabiele types en presentatie-tokens. HTML-classes dienen daarbij als invoer voor een expliciete mapping, niet als React Native-style properties:

- `book-content`
- `book-page`
- `page-header`
- `page-number`
- `book-title`
- `chapter-title`
- `chapter-subtitle`
- `footnote-ref`
- `footnote`
- `arabic`
- `citation`
- `blockquote`
- `figure`
- `bismillah`
- `section-label`

Niet-standaard, boek-specifieke visual classes mogen in een compatibility layer worden vertaald, maar moeten niet de kern van het canonical schema vormen.

## Legacy-HTML naar JSON-mapping

| Legacy pattern | Canonical pattern |
|---|---|
| `<div class="page" id="5">` | `<section class="book-page" data-page="5">` |
| `<p class="text-end page-number">#5</p>` | `<p class="page-number">5</p>` |
| `<div class="text-center page-title-chapter delima-font"><h2>...</h2></div>` | `<h2 class="chapter-title">...</h2>` |
| `.page-footnote .footnote-p` | `footnotes[]` met getypeerde inhoudsblokken |
| `<sup>N</sup>` | inline `footnote_ref` met nummer en target |
| `fn-ref` met `data-html` | niet toegestaan in bron of API-uitvoer; de nootinhoud staat in `.page-footnote` |
| `text-arabic` | `<p class="arabic" lang="ar" dir="rtl">` |
| `text-bold` / `text-italic` | gebruik `strong` / `em` semantisch |
| `div`-wrapper voor quote | `blockquote` of `p` met `cite`/`em` |
| inline `style=` en legacy classes | expliciet vertalen naar gecontroleerde presentatie-tokens; bronstyling pas verwijderen na visuele regressietests |

## Acceptatiecriteria voor de JSON-conversie

De conversie is acceptabel wanneer:
- pagina's, blokken, inline nadruk, afbeeldingen, paginanummers en voetnootrelaties expliciet zijn getypeerd
- Arabisch/RTL expliciet `language` en `direction` metadata behoudt
- dezelfde seeders reproduceerbare JSON geven zonder verloren tekst of volgorde
- presentatie via gecontroleerde tokens aan native `Text`/`View`-stijlen wordt gekoppeld
- de Laravel-reader na het normaliseren van bron-footnotes visueel ongewijzigd blijft

## Exceptions / manual review

De volgende gevallen moeten handmatig beoordeeld worden:
- zeer complexe legacy `div`-nets met mixed typography
- footnotes met continuation logic (`→`)
- pagina’s met meerdere verschillende script- en taalstromen in één blok
- Bismillah SVG-composities met embedded semantics
- oudere seeder-content die niet consistent is met nieuwe canonical structure

## Notitie over compatibiliteit

De canonical HTML is de source of truth. Legacy classes en `data-*`-attributen zijn een compatibility layer en mogen pas worden weggehaald nadat de consumer-layers (reader, JSON-export, EPUB) zijn bijgewerkt en gevalideerd.

### Huidige reader-integratie

De huidige reader past `BookHtmlNormalizer` uitsluitend toe op de in-memory HTML die aan de reader-view wordt geleverd. De database en de admin-editor blijven ongewijzigd. Deze compatibiliteitsstap voegt semantische classes en `data-page`, `lang` en `dir` toe, maar verwijdert of vervangt geen bestaande tags, classes, inline styles of attributen. De bestaande `.page`-elementen blijven directe siblings in de reader, zoals vereist voor paginanavigatie en voetnootcontinuatie.

Dit is bewust nog geen volledige omzetting naar de canonical structuur hierboven. Die omzetting mag pas plaatsvinden nadat de uitzonderingen en alle consumer-layers afzonderlijk zijn gevalideerd.

### Validator en huidige reikwijdte

`BookHtmlValidator` controleert HTML alleen-lezen op ontbrekende `.page`-markup, afwijkende opgeslagen/gedrukte paginanummers, ontbrekende Arabische `lang`/`dir`-metadata, lokale voetnootverwijzingen zonder definitie en herstelbare parsefouten. Een voetnootverwijzing zonder definitie op dezelfde pagina is slechts een waarschuwing, omdat noten over pagina's kunnen doorlopen. De validator is nog niet gekoppeld aan opslag of publicatie.

De proof of concept gebruikt representatieve markup uit `AfwegingenNederlandsPagesSeeder`: een `.page`, paginanummer, Bismillah-afbeeldingen, Arabische tekst met inline styling en genummerde voetnoten. Dit valideert de normalizer en validator op die gevallen, maar is geen volledige audit van de seeder of alle boeken.

De read-only audit kan worden herhaald met `php artisan books:validate-html`; `--product=<id>` beperkt de controle tot één product. De oorspronkelijke audit van 7 oktober 2026 controleerde 605 opgeslagen pagina's en wijzigde geen content. Handmatige controle wees uit dat de Arabische taalwaarschuwingen `lang="fa"` (Perzisch) en overgeërfde `lang`/`dir` niet als fouten mogen tellen; de validator is daarop aangepast. Ook decoratieve Qur'an-tekens en niet-numerieke superscripts zoals `الخ` zijn geen Arabische tekst of voetnootnummers.

De seederbronnen zijn opnieuw gecontroleerd: alle 605 pagina-definities hebben unieke paginanummers en geen voetnootknoppen met ingebedde `data-html`. De voetnootverwijzing op pagina 212 van *Afwegingen van Geloof & Ongeloof* heeft ook een reguliere noot onderaan de pagina. De tekst is overgenomen uit de bestaande voetnoot-pop-up.

De bevestigde bronfouten zijn gericht gecorrigeerd in seeders: pagina 115 van *Broederschap & Oprechtheid - Nederlands* had `id="114"`; diverse losse `</em>`-tags op pagina's van *Het Traktaat over de Herzameling* en *Het Traktaat Voor de Zieken* zijn verwijderd; verkeerd geneste emphasis op pagina 34 en 36 van *Het Traktaat over de Herzameling* is hersteld; en pagina 141 van *Afwegingen van Geloof & Ongeloof* sloot een `<p>` af met `</h2>`. Expliciete Arabic `lang`/`dir`-attributen zijn toegevoegd waar die ontbraken. Een dubbele brondefinitie van pagina 104 in *Afwegingen van Geloof & Ongeloof* is verwijderd; beide versies bevatten dezelfde tekst en de overblijvende versie is de versie die als laatste werd ge-upsert. De correcties wijzigen geen inline styling of presentational classes.

De vijf boekseeders zijn in de geconfigureerde lokale staging-database gezamenlijk in een transactie uitgevoerd. Vooraf kwamen de databaseaantallen exact overeen met de brondefinities (260, 115, 112, 46 en 72 pagina's); na afloop kwamen alle vijf aantallen nog steeds overeen. `BookPageSeedersValidationTest` controleert alle 605 seederpagina's op resterende validatiemeldingen, dubbele paginanummers en ingebedde voetnootpayloads.

## Final recommendation

De migration should not discard old reader behavior abruptly. Instead:

1. parse legacy HTML into canonical semantic HTML
2. preserve a compatibility layer for the existing reader
3. validate both HTML reader and JSON conversion output
4. only then remove legacy-specific class dependencies

This keeps the current site stable while creating a structured, reusable content layer.
