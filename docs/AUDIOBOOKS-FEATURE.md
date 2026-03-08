# Audioboeken Feature

## Overzicht
De audioboeken feature stelt gebruikers in staat om audioboeken te beluisteren via de website, vergelijkbaar met de "Online Lezen" functionaliteit maar dan voor audiobestanden.

## Bestanden Structuur

```
app/
├── Http/
│   └── Controllers/
│       └── AudioboekenController.php          # Controller voor audioboeken pagina's
├── Models/
│   └── Product.php                            # Bevat 'audio_file' kolom
└── Services/
    └── SEOService.php                         # SEO configuratie voor audioboeken

database/
└── migrations/
    └── 2026_03_08_140800_add_audio_file_to_products_table.php

resources/
├── css/
│   └── front-end-components/
│       └── audioboeken.css                    # Styling voor audioboeken pagina's
└── views/
    ├── audioboeken.blade.php                  # Bibliotheek overzicht
    └── audioboeken-player.blade.php           # Audio speler pagina

routes/
└── web.php                                    # Routes: /audioboeken en /audioboeken/{slug}
```

## Features

### 1. Audioboeken Bibliotheek (`/audioboeken`)
- Grid layout met alle beschikbare audioboeken
- Toont alleen producten met een `audio_file`
- Responsive design (3 kolommen → 2 → 1)
- Hover effect met "Beluister" overlay
- Categorieën en taal informatie

### 2. Audio Speler Pagina (`/audioboeken/{slug}`)
- Native HTML5 audio speler
- Boek cover afbeelding
- Titel en ondertitel weergave
- Categorie en taal informatie
- Korte beschrijving van het boek
- Breadcrumbs navigatie

### 3. Database
Nieuwe kolom toegevoegd aan `products` tabel:
- `audio_file` (nullable string) - Pad naar audiobestand in storage

### 4. Product Management
De ProductController ondersteunt nu:
- Upload van audiobestanden (*.mp3, *.ogg, *.mp4, *.m4a, *.wav)
- Opslag in `storage/app/public/audio/`
- Verwijderen van oude audiobestanden bij update
- Verwijderen van audiobestanden bij product delete

## Routes

```php
// Audioboeken bibliotheek
Route::get('/audioboeken', [AudioboekenController::class, 'index'])->name('audioboeken');

// Audio speler voor specifiek boek
Route::get('/audioboeken/{slug}', [AudioboekenController::class, 'listen'])->name('audioboekenListen');
```

## SEO Configuratie

De SEOService bevat specifieke configuratie voor:
- Audioboeken bibliotheek pagina
- Individuele audioboek pagina's met context 'audioboeken'

## Gebruik

### Audio Bestand Toevoegen
1. Ga naar Dashboard → Producten → Product bewerken
2. Upload een audiobestand in het "Audio bestand" veld
3. Ondersteunde formaten: MP3, OGG, M4A, WAV
4. Sla het product op

### Audio Bestand Verwijderen
1. Bewerk het product
2. Vink "Verwijder audio bestand" aan
3. Sla op

## Styling

De audioboeken pagina's gebruiken een consistente styling met:
- Herina font voor titels
- Gouden accent kleuren
- Little pluses achtergrondpatroon
- Card-based layout met schaduwen
- Smooth hover transitions

## Browser Ondersteuning

De HTML5 audio speler werkt in alle moderne browsers:
- Chrome/Edge
- Firefox
- Safari
- Opera

Meerdere audio formaten worden aangeboden voor maximale compatibiliteit.

## Toekomstige Uitbreidingen

Mogelijke verbeteringen:
- Playlist functionaliteit
- Bookmark/resume functionaliteit
- Download optie
- Afspeel snelheid aanpassing
- Hoofdstuk markers
- Transcript weergave

## Testing

Om te testen:
1. Voeg een audiobestand toe aan een product
2. Navigeer naar `/audioboeken`
3. Klik op een audioboek om de speler te openen
4. Controleer of de audio correct wordt afgespeeld

## Notities

- Audiobestanden worden opgeslagen in `storage/app/public/audio/`
- Zorg dat de `storage/app/public/audio/` directory beschrijfbaar is
- Grote audiobestanden kunnen upload limieten van PHP overschrijden (verhoog indien nodig)

