# PDF.js Viewer Snelgids - Configuratie Aanpassen

## 📍 Waar vind ik de configuratie?

### Voor Toolbar Knoppen (Download, Print, etc.):
**Bestand:** `/public/pdfjs/web/viewer.html`  
**Zoek naar:** De `<style>` sectie met "Custom CSS voor Lucide Inkt Webshop"

### Voor Viewer Instellingen (Zoom, Pagina, etc.):
**Bestand:** `resources/views/online-lezen-reader.blade.php`  
**Zoek naar:** Het `pdfConfig` object in de `<script>` sectie (regel ~90)

---

## ⚙️ Toolbar Knoppen Tonen/Verbergen

### ✅ WERKENDE METHODE: Via viewer.html

1. **Open:** `/public/pdfjs/web/viewer.html`
2. **Zoek naar:** De `<style>` sectie (rond regel 33-115)
3. **Pas aan:** Comment/uncomment de gewenste regels
4. **Sla op** en refresh je browser

### Huidige Status:
```css
/* ✅ VERBORGEN */
#downloadButton { display: none !important; }  /* Download knop */
#printButton { display: none !important; }     /* Print knop */
#openFile, #openFileButton { display: none !important; }  /* Open File */
#documentProperties, #documentPropertiesButton { display: none !important; } /* Properties */
```

### Voorbeeld: Download Knop Weer Tonen

In `/public/pdfjs/web/viewer.html`, verander:
```css
/* Verberg download knop */
#downloadButton {
  display: none !important;
}
```

Naar (comment toevoegen):
```css
/* Verberg download knop */
/*
#downloadButton {
  display: none !important;
}
*/
```

### Voorbeeld: Print Knop Tonen

In `/public/pdfjs/web/viewer.html`, verander:
```css
#printButton {
  display: none !important;
}
```

Naar:
```css
/*
#printButton {
  display: none !important;
}
*/
```

---

## 🎛️ Viewer Instellingen Aanpassen

### In `online-lezen-reader.blade.php` (regel ~90):

```javascript
const pdfConfig = {
    zoom: 'auto',        // Verander naar 'page-width', 'page-fit', of nummer
    page: 1,             // Startpagina
    pagemode: 'none',    // Verander naar 'thumbs', 'bookmarks', etc.
    scrollmode: 0,       // 0=vertical, 1=horizontal, 2=wrapped
    spreadmode: 0,       // 0=no spreads, 1=odd, 2=even
};
```

---

## 📋 Veelgebruikte Aanpassingen

### 1. Download Toestaan (Voor Admin Gebruik)

**Bestand:** `/public/pdfjs/web/viewer.html`

Comment deze regel:
```css
/*
#downloadButton {
  display: none !important;
}
*/
```

### 2. Print Toestaan

**Bestand:** `/public/pdfjs/web/viewer.html`

Comment deze regel:
```css
/*
#printButton {
  display: none !important;
}
*/
```

### 3. Presentatie Modus Verbergen

**Bestand:** `/public/pdfjs/web/viewer.html`

Uncomment deze regels:
```css
#presentationMode,
#presentationModeButton {
  display: none !important;
}
```

### 4. Rotatie Knoppen Verbergen

**Bestand:** `/public/pdfjs/web/viewer.html`

Uncomment deze regels:
```css
#pageRotateCw,
#pageRotateCcw {
  display: none !important;
}
```

### 5. Volle Breedte Weergave

**Bestand:** `online-lezen-reader.blade.php`

Verander:
```javascript
zoom: 'page-width',  // Was: 'auto'
```

### 6. Start met Miniaturen

**Bestand:** `online-lezen-reader.blade.php`

Verander:
```javascript
pagemode: 'thumbs',  // Was: 'none'
```

---

## 🔍 Alle Beschikbare Toolbar Elementen

In `/public/pdfjs/web/viewer.html` kun je deze elementen verbergen:

### Primaire Toolbar
```css
#downloadButton          /* Download knop */
#printButton            /* Print knop */
#openFile, #openFileButton  /* Open File */
#presentationMode, #presentationModeButton  /* Presentatie modus */
#viewBookmark, #viewBookmarkButton  /* Bookmark */
#viewFindButton         /* Zoek functie */
#sidebarToggleButton    /* Sidebar toggle */
```

### Secundaire Toolbar
```css
#documentProperties, #documentPropertiesButton  /* Document info */
#pageRotateCw, #pageRotateCcw  /* Rotatie */
#cursorSelectTool, #cursorHandTool  /* Cursor tools */
#scrollPage, #scrollVertical, #scrollHorizontal, #scrollWrapped  /* Scroll modes */
#spreadNone, #spreadOdd, #spreadEven  /* Spread modes */
```

---

## 📝 Stappenplan: Knoppen Verbergen/Tonen

### Stap 1: Open viewer.html
```
/public/pdfjs/web/viewer.html
```

### Stap 2: Zoek de Custom CSS sectie
Scroll naar regel ~33 of zoek naar:
```html
<!-- Custom CSS voor Lucide Inkt Webshop -->
```

### Stap 3: Pas CSS aan

**Om een knop te VERBERGEN:**
```css
#downloadButton {
  display: none !important;
}
```

**Om een knop te TONEN:**
```css
/*
#downloadButton {
  display: none !important;
}
*/
```

### Stap 4: Sla op en test
1. Sla het bestand op (Ctrl+S)
2. Ga naar je browser
3. Refresh de pagina (Ctrl+F5 voor harde refresh)
4. De wijzigingen zijn direct zichtbaar

---

## 🎯 Aanbevolen Configuraties

### Voor Webshop (Huidige Setup)
```css
/* In viewer.html - VERBORGEN: */
#downloadButton
#printButton  
#openFile, #openFileButton
#documentProperties, #documentPropertiesButton

/* ZICHTBAAR: alles andere */
```

### Voor Preview/Demo
```css
/* In viewer.html - VERBORGEN: */
#downloadButton
#printButton

/* ZICHTBAAR: alles andere inclusief navigatie */
```

### Voor Volledige Toegang
```css
/* In viewer.html - ALLES ZICHTBAAR */
/* Comment alle display: none regels */
```

---

## ⚠️ Belangrijke Notities

1. **viewer.html wijzigingen** zijn permanent totdat je ze weer aanpast
2. **Browser cache**: Gebruik Ctrl+F5 voor harde refresh
3. **Backup**: Maak een backup van viewer.html voor je wijzigingen maakt
4. **Veiligheid**: Verbergen van knoppen voorkomt niet dat technische gebruikers de PDF kunnen opslaan via developer tools

---

## 🆘 Problemen Oplossen

### "Ik zie de knoppen nog steeds"
- Zorg dat je het juiste bestand hebt bewerkt: `/public/pdfjs/web/viewer.html`
- Doe een harde refresh: Ctrl+F5 (Windows) of Cmd+Shift+R (Mac)
- Check browser cache: open in incognito/private mode

### "De CSS werkt niet"
- Controleer of `!important` aanwezig is
- Controleer of de `<style>` tags correct zijn
- Check browser console (F12) voor errors

### "Ik wil terug naar standaard"
- Verwijder de hele `<style>` sectie met "Custom CSS voor Lucide Inkt Webshop"
- Of download een nieuwe versie van PDF.js

---

## 📚 Meer Informatie

- **Volledige documentatie:** `docs/PDFJS-CONFIGURATIE-OPTIES.md`
- **Setup handleiding:** `docs/PDF-VIEWER-SETUP.md`

---

**Laatst bijgewerkt:** 23 januari 2026  
**Versie:** 2.0 (CSS methode in viewer.html - WERKEND!)
