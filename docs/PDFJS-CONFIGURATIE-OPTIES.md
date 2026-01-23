# PDF.js Viewer Configuratie Opties

## URL Parameters die je kunt gebruiken

De PDF.js viewer ondersteunt de volgende URL parameters:

### Basis Parameters
```javascript
// In online-lezen-reader.blade.php

const pdfConfig = {
    // BESTAND
    file: 'url-naar-pdf',           // PDF bestand URL (verplicht)
    
    // ZOOM OPTIES
    zoom: 'auto',                    // Opties: 'auto', 'page-fit', 'page-width', 'page-height', of nummer (50, 100, 150, 200)
    
    // PAGINA NAVIGATIE
    page: 1,                         // Start pagina nummer (standaard: 1)
    
    // WEERGAVE MODUS
    pagemode: 'none',                // Opties: 'none', 'thumbs', 'bookmarks', 'attachments'
    
    // SCROLL MODUS (niet alle versies)
    scrollmode: 0,                   // 0 = vertical, 1 = horizontal, 2 = wrapped
    
    // SPREAD MODUS (niet alle versies)
    spreadmode: 0,                   // 0 = no spreads, 1 = odd spreads, 2 = even spreads
};
```

## Toolbar Knoppen Verbergen/Tonen

Voor het verbergen van specifieke toolbar knoppen moet je de `viewer.html` en/of `viewer.css` aanpassen.

### Methode 1: Via CSS (Eenvoudigste)

Voeg dit toe aan je CSS bestand:

```css
/* Verberg download knop */
#download {
    display: none !important;
}

/* Verberg print knop */
#print {
    display: none !important;
}

/* Verberg open file knop */
#openFile {
    display: none !important;
}

/* Verberg secondary toolbar */
#secondaryToolbar {
    display: none !important;
}

/* Verberg presentation mode knop */
#presentationMode {
    display: none !important;
}

/* Verberg sidebar toggle */
#sidebarToggle {
    display: none !important;
}

/* Verberg viewBookmark knop */
#viewBookmark {
    display: none !important;
}

/* Verberg hele toolbar */
#toolbarContainer {
    display: none !important;
}

/* Verberg sidebar */
#sidebarContainer {
    display: none !important;
}
```

### Methode 2: Viewer.html Aanpassen

Locatie: `/public/pdfjs/web/viewer.html`

Zoek de gewenste knoppen en verwijder ze of voeg `hidden` toe:

```html
<!-- Voorbeeld: Download knop verbergen -->
<button id="download" hidden class="toolbarButton" title="Download" ...>
```

### Methode 3: Via JavaScript (na laden)

```javascript
// In online-lezen-reader.blade.php, na het laden van de iframe
pdfViewer.addEventListener('load', function() {
    try {
        const iframeDoc = pdfViewer.contentDocument || pdfViewer.contentWindow.document;
        
        // Verberg specifieke elementen
        const downloadBtn = iframeDoc.getElementById('download');
        if (downloadBtn) downloadBtn.style.display = 'none';
        
        const printBtn = iframeDoc.getElementById('print');
        if (printBtn) printBtn.style.display = 'none';
        
        // etc.
    } catch (e) {
        console.warn('Kan iframe inhoud niet aanpassen vanwege CORS/Same-Origin beleid');
    }
});
```

## Volledige Lijst van Toolbar Elementen

ID's die je kunt targeten in CSS of JavaScript:

### Primaire Toolbar (boven)
- `#sidebarToggle` - Toggle sidebar
- `#viewFind` - Zoek functie
- `#previous` - Vorige pagina
- `#next` - Volgende pagina
- `#pageNumber` - Pagina nummer input
- `#zoomOut` - Uitzoomen
- `#zoomIn` - Inzoomen
- `#presentationMode` - Presentatie modus
- `#openFile` - Open bestand
- `#print` - Printen
- `#download` - Downloaden
- `#viewBookmark` - Bookmark huidige view

### Secundaire Toolbar
- `#secondaryToolbar` - Hele secundaire toolbar
- `#secondaryToolbarToggle` - Toggle secundaire toolbar
- `#presentationModeButton` - Presentatie modus (secundair)
- `#openFileButton` - Open bestand (secundair)
- `#printButton` - Print (secundair)
- `#downloadButton` - Download (secundair)
- `#viewBookmarkButton` - Bookmark (secundair)
- `#firstPage` - Eerste pagina
- `#lastPage` - Laatste pagina
- `#pageRotateCw` - Roteer rechtsom
- `#pageRotateCcw` - Roteer linksom
- `#cursorSelectTool` - Selectie tool
- `#cursorHandTool` - Hand tool
- `#scrollVertical` - Verticaal scrollen
- `#scrollHorizontal` - Horizontaal scrollen
- `#scrollWrapped` - Wrapped scrollen
- `#spreadNone` - Geen spreads
- `#spreadOdd` - Oneven spreads
- `#spreadEven` - Even spreads
- `#documentProperties` - Document eigenschappen

### Sidebar
- `#sidebarContainer` - Hele sidebar container
- `#viewThumbnail` - Miniaturen tab
- `#viewOutline` - Bookmarks/outline tab
- `#viewAttachments` - Bijlagen tab

## Voorbeeld Configuraties

### Minimale Viewer (alleen lezen, geen knoppen)
```css
#toolbarContainer { display: none !important; }
#sidebarContainer { display: none !important; }
```

### Beperkte Viewer (geen download/print)
```css
#download, #downloadButton { display: none !important; }
#print, #printButton { display: none !important; }
#openFile, #openFileButton { display: none !important; }
```

### Presentatie Modus (clean)
```css
#secondaryToolbar { display: none !important; }
#sidebarContainer { display: none !important; }
#viewBookmark { display: none !important; }
```

## Aanbevolen Setup voor Webshop

Voor een boeken webshop waar je wilt dat gebruikers kunnen lezen maar niet eenvoudig kunnen downloaden:

```css
/* Verberg download en open file opties */
#download, #downloadButton,
#openFile, #openFileButton {
    display: none !important;
}

/* Optioneel: verberg print ook */
#print, #printButton {
    display: none !important;
}

/* Behoud: navigatie, zoom, zoeken, presentatie modus */
```

Voeg dit toe aan je `resources/css/app.css` of maak een apart bestand `pdfviewer-custom.css`.
