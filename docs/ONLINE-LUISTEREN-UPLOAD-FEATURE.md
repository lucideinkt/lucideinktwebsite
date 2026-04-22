# Online Luisteren Upload Feature - Implementatie

## ✅ Wat is toegevoegd?

Er is een **"Online Luisteren"** sectie toegevoegd aan het product aanmaken/bewerken formulier, vergelijkbaar met de "Online Lezen" (PDF) sectie.

## 📍 Locatie in Formulier

```
Product Formulier:
├── Beschrijving (Titel, omschrijvingen, etc.)
├── Product Details (Prijs, voorraad, etc.)
├── Product Specificaties (Gewicht, afmetingen, etc.)
├── Afbeeldingen (4 afbeeldingen)
├── 📄 Online Lezen (PDF upload)
└── 🎵 Online Luisteren (Audio upload) ← NIEUW!
    └── SEO Instellingen
```

## 🎨 UI Features

### Audio Upload Sectie
```
┌─────────────────────────────────────────────┐
│  Online Luisteren                           │
│                                             │
│  Audio Bestand                              │
│  ┌─────────────────────────────────────┐   │
│  │ Kies audio bestand...               │   │
│  └─────────────────────────────────────┘   │
│                                             │
│  ℹ️ Upload een audiobestand om dit boek    │
│     beschikbaar te maken in de              │
│     Audioboeken bibliotheek. Max 100MB.     │
│     Formaten: MP3, M4A, OGG, WAV.           │
└─────────────────────────────────────────────┘
```

### Wanneer Audio al bestaat
```
┌─────────────────────────────────────────────┐
│  Online Luisteren                           │
│                                             │
│  Audio Bestand                              │
│  ┌─────────────────────────────────────┐   │
│  │ audiobook.mp3                       │   │
│  └─────────────────────────────────────┘   │
│                                             │
│  🎧 Huidig bestand: Beluister Audio        │
│  [ Verwijder Audio ]                        │
└─────────────────────────────────────────────┘
```

## 🔧 Technische Details

### Input Field
```html
<input 
  type="file" 
  name="audio_file" 
  id="audio_file" 
  accept="audio/*,.mp3,.m4a,.ogg,.wav" 
  class="custom-file-input"
>
```

### Ondersteunde Formaten
- ✅ MP3 (.mp3)
- ✅ M4A (.m4a)
- ✅ OGG (.ogg)
- ✅ WAV (.wav)
- ✅ MPEG (.mpga, .mpeg)

### Validatie
- **Max grootte**: 100 MB (102400 KB)
- **Veld**: Optioneel (nullable)
- **Accept**: audio/* + specifieke extensies

## 🎯 Functionaliteiten

### 1. Upload Nieuw Audiobestand
- Browse en selecteer audiobestand
- Bestandsnaam wordt getoond na selectie
- Opgeslagen in `storage/app/public/audio/`

### 2. Bekijk Huidig Audiobestand
- Link naar bestaand audiobestand
- "Beluister Audio" link opent in nieuwe tab
- Icoon: 🎧 (headphones)

### 3. Verwijder Audiobestand
- "Verwijder Audio" knop
- Confirmation dialog
- Checkbox wordt geactiveerd bij bevestiging
- Bestand wordt verwijderd bij opslaan

### 4. JavaScript Handlers
```javascript
// Auto-update bestandsnaam bij selectie
audioInput.addEventListener('change', function(e) {
    audioLabel.textContent = e.target.files[0].name;
});

// Delete handler met confirmation
removeAudioBtn.addEventListener('click', function() {
    if (confirm('Weet u zeker dat u dit audiobestand wilt verwijderen?')) {
        deleteAudioCheckbox.checked = true;
        // Update UI
    }
});
```

## 📝 Form Fields

### Nieuwe Input Velden
1. **audio_file** - File upload input
2. **delete_audio_file** - Hidden checkbox voor delete actie

### Hidden Checkbox
```html
<input 
  type="checkbox" 
  name="delete_audio_file" 
  id="delete_audio_file" 
  value="1" 
  style="display:none;"
>
```

## 🔄 Data Flow

### Upload Flow
```
User selects audio file
    ↓
JavaScript updates filename label
    ↓
Form submit
    ↓
ProductController validates (max 100MB, correct mimetype)
    ↓
File stored in storage/app/public/audio/
    ↓
Database updated with file path
    ↓
Product visible on /audioboeken
```

### Delete Flow
```
User clicks "Verwijder Audio"
    ↓
Confirmation dialog
    ↓
Hidden checkbox activated
    ↓
Form submit
    ↓
ProductController checks delete_audio_file
    ↓
File deleted from storage
    ↓
Database field set to null
```

## 🎨 Styling

De sectie gebruikt dezelfde styling als de PDF sectie:
- `.section` class voor consistente layout
- `.audio-section` voor specifieke styling
- `.custom-file-input-wrapper` voor file input styling
- `.current-file` voor huidige bestand info
- `.help-text` voor instructies

## 💾 Backend Integratie

### ProductController Wijzigingen
Reeds geïmplementeerd:
- ✅ `store()` - Upload audio bij nieuw product
- ✅ `update()` - Update/vervang audio
- ✅ `destroy()` - Verwijder audio bij product delete

### Validation Rules
Reeds toegevoegd in:
- ✅ `StoreProductRequest.php`
- ✅ `UpdateProductRequest.php`

```php
'audio_file' => 'nullable|file|mimes:mp3,mpga,mpeg,m4a,ogg,wav|max:102400'
```

## 📱 Responsive Design

De sectie is volledig responsive:
- Desktop: Volledige breedte binnen grid
- Tablet: Aangepaste layout
- Mobile: Stack layout met touch-friendly knoppen

## ✨ User Experience

### Feedback
- ✅ Bestandsnaam toont na selectie
- ✅ "Beluister Audio" link voor preview
- ✅ Confirmation bij verwijderen
- ✅ Visual feedback bij delete (text update)
- ✅ Help text met duidelijke instructies

### Error Handling
- ✅ Validatie errors worden getoond onder veld
- ✅ Max file size error
- ✅ Invalid file type error

## 🚀 Testing Checklist

- [x] Audio upload field zichtbaar in formulier
- [x] Bestandsselectie werkt correct
- [x] Bestandsnaam wordt getoond na selectie
- [x] "Beluister Audio" link werkt bij bestaand bestand
- [x] "Verwijder Audio" knop toont confirmation
- [x] Delete checkbox wordt geactiveerd
- [x] Form submit werkt met audio
- [x] Validatie werkt (max size, file types)
- [x] Assets gecompileerd zonder errors

## 📊 Volledig Voorbeeld

### Product Aanmaken
```blade
<div class="section audio-section">
    <h3>Online Luisteren</h3>
    <div class="form-input">
        <label for="audio_file">Audio Bestand</label>
        <div class="custom-file-input-wrapper">
            <input type="file" name="audio_file" id="audio_file" 
                   accept="audio/*,.mp3,.m4a,.ogg,.wav" 
                   class="custom-file-input">
            <label for="audio_file" class="custom-file-label">
                <span id="audio_file_label_text">
                    Kies audio bestand...
                </span>
            </label>
        </div>
        <small class="help-text">
            Upload een audiobestand om dit boek beschikbaar te maken 
            in de Audioboeken bibliotheek. Max 100MB. 
            Formaten: MP3, M4A, OGG, WAV.
        </small>
    </div>
</div>
```

### Product Bewerken (met bestaand audio)
```blade
<div class="section audio-section">
    <h3>Online Luisteren</h3>
    <div class="form-input">
        <label for="audio_file">Audio Bestand</label>
        <div class="custom-file-input-wrapper">
            <input type="file" name="audio_file" id="audio_file" 
                   accept="audio/*,.mp3,.m4a,.ogg,.wav" 
                   class="custom-file-input">
            <label for="audio_file" class="custom-file-label">
                <span id="audio_file_label_text">audiobook.mp3</span>
            </label>
            
            <div style="margin-top: 10px;">
                <p class="current-file">
                    <i class="fa-solid fa-headphones"></i>
                    Huidig bestand:
                    <a href="{{ asset('storage/audio/audiobook.mp3') }}" 
                       target="_blank">
                        Beluister Audio
                    </a>
                </p>
                <button type="button" class="btn small" 
                        id="remove-audio-btn">
                    Verwijder Audio
                </button>
                <input type="checkbox" name="delete_audio_file" 
                       id="delete_audio_file" value="1" 
                       style="display:none;">
            </div>
        </div>
    </div>
</div>
```

## 🎉 Resultaat

De "Online Luisteren" upload functionaliteit is nu volledig geïntegreerd in het product formulier en werkt identiek aan de "Online Lezen" (PDF) functionaliteit. Admins kunnen nu eenvoudig audiobestanden uploaden, bekijken en verwijderen bij elk product!

---

**Status**: ✅ Compleet en klaar voor gebruik
**Getest**: ✅ Alle functionaliteiten gevalideerd
**Assets**: ✅ Gecompileerd en up-to-date

