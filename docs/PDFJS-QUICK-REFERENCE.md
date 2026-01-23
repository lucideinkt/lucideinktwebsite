# PDF.js Quick Reference - Lucide Inkt Webshop

## Knoppen Verbergen/Tonen

**Bestand:** `/public/pdfjs/web/viewer.html` (regel ~33-115)

### Download Knop
```css
/* VERBORGEN (huidige status) */
#downloadButton { display: none !important; }

/* TONEN - uncomment: */
/* #downloadButton { display: none !important; } */
```

### Print Knop
```css
/* VERBORGEN (huidige status) */
#printButton { display: none !important; }

/* TONEN - uncomment: */
/* #printButton { display: none !important; } */
```

### Open File Knop
```css
/* VERBORGEN (huidige status) */
#openFile,
#openFileButton { display: none !important; }
```

### Document Eigenschappen
```css
/* VERBORGEN (huidige status) */
#documentProperties,
#documentPropertiesButton { display: none !important; }
```

## Viewer Instellingen

**Bestand:** `resources/views/online-lezen-reader.blade.php` (regel ~90)

```javascript
const pdfConfig = {
    zoom: 'auto',        // 'auto', 'page-fit', 'page-width', of nummer
    page: 1,             // Startpagina
    pagemode: 'none',    // 'none', 'thumbs', 'bookmarks', 'attachments'
    scrollmode: 0,       // 0=vertical, 1=horizontal, 2=wrapped
    spreadmode: 0,       // 0=geen, 1=oneven, 2=even
};
```

## Stappenplan

1. Open `/public/pdfjs/web/viewer.html`
2. Zoek naar "CUSTOM CSS VOOR LUCIDE INKT WEBSHOP"
3. Comment/uncomment de gewenste CSS regels
4. Sla op (Ctrl+S)
5. Refresh browser (Ctrl+F5)

## Meer Info

- **Snelgids:** `docs/PDFJS-SNELGIDS.md`
- **Volledige opties:** `docs/PDFJS-CONFIGURATIE-OPTIES.md`
