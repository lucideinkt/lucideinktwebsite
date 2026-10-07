# Boekcontentanalyse

## 1. Waar boekcontent wordt opgeslagen

Het project slaat boekinhoud op in twee lagen:

1. Product-niveau (legacy / fallback)
   - `products.book_content` is een nullable longText-vlag in de database.
   - Deze kolom bestaat en is gekoppeld aan de productentiteit, maar de huidige HTML-reader en book-page-seeders gebruiken voornamelijk de `book_pages`-tabellen.

2. Pagina-niveau (actuele HTML-implementatie)
   - `book_pages` bevat per pagina `product_id`, `page_number`, `content`, `book_title` en timestamps.
   - `bookPages()` op `App\Models\Product` haalt deze pagina’s op per product.

Belangrijk: de HTML-reader laadt uit `book_pages` en niet uit `products.book_content`, tenzij er legacy-content is dat nog niet is gemigreerd.

## 2. Relevante databasevelden

### `book_pages`

Gedefinieerd in:
- `database/migrations/2026_03_15_001041_create_book_pages_table.php`
- `database/migrations/2026_03_15_011120_add_book_header_to_book_pages_table.php`

Velden:
- `id`
- `product_id` (FK naar `products`)
- `page_number` (unsigned small integer)
- `content` (longText, HTML-inhoud per pagina)
- `book_title` (nullable string, eerder extra header per boek)
- `created_at`, `updated_at`

Index:
- `product_id`, `page_number`

### `products`

Gedefinieerd in `app/Models/Product.php` en gerelateerd aan content-ondersteuning:
- `book_content` (legacy content field)
- `book_content_published` (boolean)
- `pdf_file`
- `pdf_reader_enabled`
- `pdf_text_content` (voor PDF-indexering)

Deze velden zijn belangrijk voor de publicatie- en readerlogica, maar niet voor het canonical HTML-schema.

## 3. Relevante Laravel-bestanden

### Models
- `app/Models/Product.php`
  - bevat `bookPages()`
  - bevat `pdfPages()`
  - bevat publicatie-velden zoals `book_content_published`
- `app/Models/BookPage.php`
  - `fillable = ['product_id', 'page_number', 'content', 'book_title']`

### Controllers
- `app/Http/Controllers/OnlineLezenController.php`
  - bepaalt welke boeken public beschikbaar zijn
  - rendert HTML-reader via `readHtml()`
  - voert cross-book search uit op HTML- en PDF-content
- `app/Http/Controllers/BookContentController.php`
  - admin CRUD voor pagina’s
  - bulk upsert, reorder, delete, toggle publish

### Seeders
- `database/seeders/BookPagesSeeder.php`
  - abstract base class voor boeken
  - doet `upsert` op `product_id + page_number`
  - verwijdert stale pagina’s die niet meer in de seeder staan
- `database/seeders/HerzamelingNederlandsPagesSeeder.php`
- `database/seeders/ZiekenNederlandsPagesSeeder.php`
- `database/seeders/AfwegingenNederlandsPagesSeeder.php`
- `database/seeders/NatuurNederlandsPagesSeeder.php`
- `database/seeders/BroederschapNederlandsPagesSeeder.php`
- `database/seeders/DatabaseSeeder.php`
  - legt producten aan, inclusief boekmetadata

## 4. Relevante frontend-bestanden

### Blade / reader UI
- `resources/views/online-lezen-html-reader.blade.php`
  - rendert de volledige HTML-reader pagina
  - bevat CSS-injecties voor book-reader behavior
  - bevat de reader-toolbar, TOC, footnotes, theme, font controls

### JS
- `resources/js/features/reader-book.js`
  - script dat legacy HTML omvormt naar interactieve footnotes en continuation handling
  - koppelt class-names en `data-*` attributen aan gedrag

### CSS
- `resources/css/dashboard-style.css`
  - definieert `.text-arabic`, `.text-arabic-bismillah` etc.
- De reader styling is ook in `online-lezen-html-reader.blade.php` embedded via `<style>`, deels voor dynamic reader settings.

## 5. Bestaande HTML-patronen

### Kernstructuur van legacy content
In meerdere seeders worden pagina’s als volgt opgebouwd:

```html
<div class="page" id="5">
  <p class="text-end page-number">#5</p>
  <div class="text-center page-title-chapter delima-font">
    <h2>Het Tiende Woord</h2>
  </div>
  <p>...</p>
  <div class="page-footnote">
    <hr class="hr-footnote" />
    <p class="footnote-p">
      <sup>1</sup> ...
    </p>
  </div>
</div>
```

### Patronen die terugkomen
- `div.page` wrapper per pagina
- `id` op de pagina zoals `id="5"`, `id="17"`, etc.
- `page-number` als visuele paginanummer
- `text-center`, `text-end`, `text-red`, `small-title`, `text-bold`, `text-italic`
- `page-title-chapter` voor hoofdstuktitel
- `page-footnote` voor voetnotenblok
- `footnote-p` voor individuele voetnoten
- `sup` voor voetnootverwijzing/marker
- de reader-runtime genereert `button.fn-ref` met `data-fn` en `data-html` voor popovers
- `sup-pointer`, `sup-pointer-num` in legacy handling

De seeders bewaren voetnootverwijzingen als gewone `<sup>N</sup>`-elementen. De voetnootinhoud staat in `.page-footnote .footnote-p`; er hoort geen popoverknop of `data-html`-attribuut in de opgeslagen broncontent te staan.

### Verschillende soorten content
- normale proza paragrafen
- citaten in `<em>` en `<strong><em>`
- blokquotes worden niet structureel gebruikt; vaak worden ze in `<p><em>...</em></p>` gegoten
- Arabic tekst: `dir="rtl"`, `lang="ar"`, vaak met class `text-arabic` of `text-arabic-bismillah`
- Bismillah: SVG-beeld plus Arabic tekst, soms in een eigen paragraaf
- Qur’an-citaten: vaak als Arabic met `sup` nummers direct in de tekst

## 6. Bestaande footnote-implementatie

De huidige footnote-implementatie is sterk presentational en JS-gedreven. In `resources/js/features/reader-book.js`:

- `wireFootnotesForPage(page)` verwerkt elke `.page-footnote .footnote-p`
- `<sup>`-verwijzingen in de paginainhoud worden op basis van `.page-footnote .footnote-p` omgezet naar `button.fn-ref`
- `data-fn` en `data-html` worden tijdens reader-rendering op de knop gezet; dit is runtime-markup en geen seeder-opslagformaat
- wanneer een voetnoot in de volgende pagina doorloopt (`→`), wordt continuation logic toegepast
- `resolveContinuations(page)` zoekt volgende pagina’s om doorlopende voetnoten aan elkaar te plakken

Belangrijk: de reader vertrouwt op de volgende legacy patronen:
- `.page-footnote`
- `.footnote-p`
- `.fn-ref`
- `.fn-ref-num`
- `data-fn`
- `data-html`
- `data-needs-continuation`

Daarom mogen deze classes en data-attributen niet zonder meer worden verwijderd. Ze zijn niet alleen stijl, maar ook functionaliteit.

## 7. Arabic / RTL implementatie

### CSS
`resources/css/dashboard-style.css` definieert:

```css
.text-arabic {
  font-family: 'OmarNaskhRegular', serif;
  font-size: var(--reader-arabic-font-size, 29px);
  line-height: 2;
  direction: rtl;
  text-align: center;
  font-feature-settings: 'ss04', 'ss14', 'ss17';
}
```

### HTML patroon
- `dir="rtl"`
- `lang="ar"`
- classes zoals `text-arabic`, `text-arabic-bismillah`, `text-arabic-inline`
- soms `style="margin: 0 auto; max-width: 500px;"`

### Extra aandachtspunten
- AR/RTL-tekst is een semantische en linguïstische categorie, geen pure stylingvariant.
- De reader heeft aparte font-size controls voor Arabic (`arabic-font-step-range`), dus HTML moet RTL/Arabic markers behouden om consumer-apps later de juiste rendering te bieden.

## 8. Paginering

De huidige `book_pages`-structuur is pagina-gericht:
- een boek bestaat uit meerdere `BookPage` records
- `page_number` bepaalt de sorteervolgorde
- `OnlineLezenController::readHtml()` haalt alle pagina’s op via `orderBy('page_number')`
- de HTML-reader rendert ze allen in één view

Er is dus geen echte server-side paginering; het model is “collectie van pagina-blokken”.

Voor de reader zijn de volgende gegevens relevant:
- `page_number`
- `book_title`
- `content`

## 9. Verschillen tussen boeken

Er zijn duidelijke verschillen in stijl en inhoud tussen seeders:

### Herzameling
- veel symbolische/filosofische narratieve tekst
- veel `em`-citaten
- meerdere footnotes met continuation arrows `→`
- semantische `h2` voor hoofdstuktitel
- content voelt relatief “gestandaardiseerd”

### Zieken
- veel intro’s, genezingshoofdstukken en kortere alinea’s
- voorname `text-red small-title` headers en welkoms-blokjes
- footnotes zijn vaak standaard, maar sommige pagina’s hebben extra bolded calls-to-action

### Afwegingen / Broederschap / Natuur
- variëren in titellijsten, `small-title`, `text-red`, `text-bold`
- sommige boeken combineren veelvuldig Arabic blokken en Bismillah SVG’s
- footnote-structuur blijft consistent maar de tekst- en stijlklassen verschillen per boek

Conclusie: de inhoud is semantisch vergelijkbaar, maar de legacy presentatielagen zijn boek-specifiek en moeten worden gecanoniseerd naar een uniform schema.

## 10. Mogelijke risico's

1. Te veel visual classes verwijderen
   - De current JS and CSS rely on legacy classes; removal can break the reader.

2. HTML-structuur verkeerd normaliseren
   - Als `div.page` direct naar `article` wordt omgezet zonder `section.book-page`, kan pagina- en footnote-logic in reader of custom exporters breken.

3. Footnotes loskoppelen van referenties
   - `sup`-references en `aside`/`footnote`-onderdelen moeten gekoppeld blijven via `data-footnote-id` of equivalent semantische referentie.

4. Inline styles en `class`-overloads verwijderen zonder context
   - Sommige inline styles en classes zijn functioneel voor layout of Arabic rendering.

5. Arabic/RTL informatie verliezen
   - `lang="ar"` + `dir="rtl"` zijn essentieel voor correct rendering en accessibility.

6. Legacy “continuation footnotes” misinterpreteren
   - De `→` behandeling is een business-rule in de reader; deze mogen niet automatisch worden weggegooid.

## 11. Classes en data-attributen die niet zomaar verwijderd mogen worden

Deze zijn functioneel of semantisch relevant:

### Reader- en footnote-logic
- `page`
- `page-number`
- `page-footnote`
- `footnote-p`
- `fn-ref`
- `fn-ref-wrap`
- `fn-ref-word`
- `fn-ref-num`
- `sup-pointer`
- `sup-pointer-num`
- `data-fn`
- `data-html`
- `data-needs-continuation`
- `data-continuation-last-page`

### Arabic / RTL / script markup
- `text-arabic`
- `text-arabic-bismillah`
- `text-arabic-inline`
- `dir="rtl"`
- `lang="ar"`
- `bismillah-svg`
- `bismillah-svg-light`
- `bismillah-svg-dark`

### Boek-structuur / layout hints
- `page-title-chapter`
- `small-title`
- `text-red`
- `text-bold`
- `text-italic`
- `delima-font`
- `text-center`
- `text-end`

Deze classes kunnen later worden afgeschaft in de canonical HTML, maar alleen na een expliciete migratie waarbij de JS/CSS-compatibiliteitslaag is aangepast.

## 12. Uitzonderingen die handmatig moeten worden bekeken

De onderstaande patronen vereisen menselijke beoordeling voordat ze worden gecanoniseerd:

- pagina’s met `→` continuation footnotes
- pagina’s waarin een `sup` in het midden van een zin voorkomt zonder duidelijke `page-footnote` context
- voetnoten die uit meerdere alinea’s bestaan
- pagina’s met embedded SVG’s of Bismillah-afbeeldingen
- pagina’s met wisselende markup-varianten tussen boeken
- pagina’s met misvormde HTML-constructies of half-gesloten tags
- rare legacy classes die in één boek alleen voorkomen (bijv. boek-specifieke styling, experimentele classes)
- product-level `book_content` die nog niet is overgezet naar `book_pages`

## Conclusie

De huidige codebase gebruikt een sterk legacy HTML-format dat per boek varieert, maar met een duidelijke core-structuur:

- pagina per `div.page`
- footnotes in `page-footnote`
- Arabic/RTL markers in `dir="rtl" lang="ar"`
- JS-gedreven interpretation of legacy classes and `data-*` attributes

Dat is geschikt als invoer voor een canonical HTML-normalizer, maar niet als de juiste source of truth voor toekomstige structured rendering. De canonical renderer moet eerst de semantische intent van deze HTML opslaan en daarvoor het bestaande DOM omzetten naar een uniform, semantisch HTML-schema dat presentatie loskoppelt van betekenis.
