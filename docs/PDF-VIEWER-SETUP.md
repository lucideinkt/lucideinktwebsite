# PDF Viewer Setup - Lucide Inkt Webshop

## Huidige Configuratie

**Viewer:** PDF.js (Mozilla)  
**Locatie:** `/public/pdfjs/web/viewer.html`  
**Gebruikt in:** `resources/views/online-lezen-reader.blade.php`

## Hoe het werkt

1. PDF-bestand wordt opgehaald via de `pdf.proxy` route (met CORS headers)
2. PDF.js viewer toont het bestand in een iframe
3. Gebruikers krijgen een volledig uitgeruste PDF-lezer met zoom, navigatie, download en print opties
4. Via JavaScript configuratie kunnen UI elementen worden aangepast

## Configuratie Opties

### In `online-lezen-reader.blade.php` vind je het `pdfConfig` object:

```javascript
const pdfConfig = {
    // === ZOOM OPTIES ===
    zoom: 'auto',                // 'auto', 'page-fit', 'page-width', 'page-height', of nummer (50, 75, 100, 125, 150, 200)
    
    // === PAGINA NAVIGATIE ===
    page: 1,                     // Start pagina nummer
    
    // === WEERGAVE MODUS ===
    pagemode: 'none',            // 'none', 'thumbs', 'bookmarks', 'attachments'
    
    // === SCROLL & SPREAD MODUS ===
    scrollmode: 0,               // 0 = vertical, 1 = horizontal, 2 = wrapped
    spreadmode: 0,               // 0 = no spreads, 1 = odd spreads, 2 = even spreads
    
    // === UI ELEMENTEN (true/false) ===
    hideDownload: true,          // Download knop verbergen (AANBEVOLEN voor webshop)
    hidePrint: false,            // Print knop verbergen
    hideOpenFile: true,          // Open File knop verbergen (AANBEVOLEN)
    hideToolbar: false,          // Hele toolbar verbergen
    hideSidebar: false,          // Sidebar verbergen
    hideSecondaryToolbar: false, // Secundaire toolbar verbergen
};
```

## Praktische Voorbeelden

### Voorbeeld 1: Minimale Viewer (alleen lezen)
```javascript
const pdfConfig = {
    zoom: 'page-width',
    hideDownload: true,
    hidePrint: true,
    hideOpenFile: true,
    hideToolbar: false,          // Toolbar blijft zichtbaar voor navigatie
    hideSidebar: true,           // Sidebar verbergen
    hideSecondaryToolbar: true,  // Secundaire toolbar verbergen
};
```

### Voorbeeld 2: Boek Preview (met miniaturen)
```javascript
const pdfConfig = {
    zoom: 'auto',
    page: 1,
    pagemode: 'thumbs',          // Start met miniaturen sidebar
    hideDownload: true,
    hideOpenFile: true,
    hidePrint: false,            // Print wel toestaan
};
```

### Voorbeeld 3: Presentatie Modus
```javascript
const pdfConfig = {
    zoom: 'page-fit',
    pagemode: 'none',
    hideDownload: true,
    hideOpenFile: true,
    hideToolbar: false,
    hideSidebar: true,
};
```

### Voorbeeld 4: Volledige Controle (alles zichtbaar)
```javascript
const pdfConfig = {
    zoom: 'auto',
    page: 1,
    pagemode: 'thumbs',
    hideDownload: false,         // Download toegestaan
    hidePrint: false,            // Print toegestaan
    hideOpenFile: false,
    hideToolbar: false,
    hideSidebar: false,
    hideSecondaryToolbar: false,
};
```

## Extra Aanpassingen

In het JavaScript blok vind je ook uitgecommentarieerde opties voor het verbergen van specifieke elementen:

```javascript
// Verberg presentatie modus knop
// hideElement('presentationMode');
// hideElement('presentationModeButton');

// Verberg bookmark knop
// hideElement('viewBookmark');
// hideElement('viewBookmarkButton');

// Verberg zoek functie
// hideElement('viewFind');

// Verberg pagina rotatie knoppen
// hideElement('pageRotateCw');
// hideElement('pageRotateCcw');
```

Uncomment deze regels om specifieke functionaliteit te verbergen.

## Route Configuratie

**Route:** `pdf.proxy`  
**Bestand:** `routes/web.php`  
**Headers:** 
- Content-Type: application/pdf
- Access-Control-Allow-Origin: *
- CORS headers voor externe toegang

## Implementatie

```javascript
// Basis implementatie
const pdfUrl = "{{ route('pdf.proxy', ['path' => $product->pdf_file]) }}";
let viewerUrl = '/pdfjs/web/viewer.html?file=' + encodeURIComponent(pdfUrl);
pdfViewer.src = viewerUrl;
```

## Beschikbare Toolbar Elementen

Alle elementen die je kunt aanpassen via `hideElement()`:

### Primaire Toolbar
- `download` / `downloadButton` - Download knop
- `print` / `printButton` - Print knop
- `openFile` / `openFileButton` - Open File knop
- `presentationMode` / `presentationModeButton` - Presentatie modus
- `viewBookmark` / `viewBookmarkButton` - Bookmark knop
- `viewFind` - Zoek functie
- `previous` / `next` - Navigatie knoppen
- `zoomOut` / `zoomIn` - Zoom knoppen
- `sidebarToggle` - Sidebar toggle

### Secundaire Toolbar
- `secondaryToolbar` - Hele secundaire toolbar
- `firstPage` / `lastPage` - Eerste/laatste pagina
- `pageRotateCw` / `pageRotateCcw` - Rotatie knoppen
- `cursorSelectTool` / `cursorHandTool` - Cursor tools
- `scrollVertical` / `scrollHorizontal` / `scrollWrapped` - Scroll opties
- `spreadNone` / `spreadOdd` / `spreadEven` - Spread opties
- `documentProperties` - Document eigenschappen

### Sidebar
- `sidebarContainer` - Hele sidebar
- `viewThumbnail` - Miniaturen tab
- `viewOutline` - Bladwijzers tab
- `viewAttachments` - Bijlagen tab

## Bestandsstructuur

```
public/
  pdfjs/
    web/
      viewer.html      ← Hoofd PDF.js viewer
    build/             ← PDF.js library bestanden
    LICENSE
```

PDFs worden opgeslagen in: `storage/app/public/pdfs/`

## Aanbevolen Configuratie voor Webshop

Voor een online boeken lezer waar je wilt dat klanten kunnen lezen maar niet eenvoudig kunnen downloaden:

```javascript
const pdfConfig = {
    zoom: 'auto',
    page: 1,
    pagemode: 'none',
    hideDownload: true,          // ✅ Download verbergen
    hidePrint: true,             // ✅ Print verbergen (optioneel)
    hideOpenFile: true,          // ✅ Open File verbergen
    hideToolbar: false,          // ✅ Toolbar behouden voor navigatie
    hideSidebar: false,          // ✅ Sidebar behouden voor miniaturen
    hideSecondaryToolbar: false,
};
```

## Troubleshooting

### Same-Origin Policy Waarschuwing
Als je in de console ziet: "Kan iframe inhoud niet aanpassen (mogelijk Same-Origin beleid)"

Dit betekent dat de JavaScript niet bij de iframe content kan vanwege beveiligingsredenen. Dit is normaal en verwacht gedrag.

**Oplossing:** De basis configuratie (zoom, page, pagemode) werkt altijd via URL parameters. Voor verdere aanpassingen moet je `/public/pdfjs/web/viewer.html` direct bewerken.

### PDF laadt niet
1. Check console voor errors (F12)
2. Verifieer dat `pdf.proxy` route werkt
3. Check of PDF bestand bestaat in storage

## Onderhoud

- PDF.js is een standalone library, geen npm package nodig
- Updates: Download nieuwe versie van https://mozilla.github.io/pdf.js/
- Huidige versie werkt uitstekend, alleen updaten bij security issues

## Documentatie Links

- **Volledige configuratie opties:** `docs/PDFJS-CONFIGURATIE-OPTIES.md`
- **Custom CSS styling:** `resources/css/pdfviewer-custom.css`
- **PDF.js Documentatie:** https://mozilla.github.io/pdf.js/

## Status

✅ Werkend en getest (23-01-2026)  
✅ Download knop verborgen  
✅ Open File knop verborgen  
✅ Volledige configuratie beschikbaar
