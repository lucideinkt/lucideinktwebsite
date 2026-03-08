# Audioboeken - Quick Reference

## 🎵 URLs

- **Bibliotheek**: `/audioboeken`
- **Speler**: `/audioboeken/{slug}`

## 📁 Belangrijke Bestanden

### Controllers
- `app/Http/Controllers/AudioboekenController.php`

### Views
- `resources/views/audioboeken.blade.php` - Bibliotheek grid
- `resources/views/audioboeken-player.blade.php` - Audio speler

### Styling
- `resources/css/front-end-components/audioboeken.css`

### Routes
```php
Route::get('/audioboeken', [AudioboekenController::class, 'index'])->name('audioboeken');
Route::get('/audioboeken/{slug}', [AudioboekenController::class, 'listen'])->name('audioboekenListen');
```

## 🗄️ Database

### Migratie
```bash
php artisan migrate
```

### Kolom
- **Tabel**: `products`
- **Kolom**: `audio_file` (nullable string)
- **Storage**: `storage/app/public/audio/`

## 📤 Audio Upload

### Product Toevoegen/Bewerken
1. Dashboard → Producten
2. Upload audiobestand (max 100MB)
3. Ondersteunde formaten: MP3, M4A, OGG, WAV

### Validatie Regels
```php
'audio_file' => 'nullable|file|mimes:mp3,mpga,mpeg,m4a,ogg,wav|max:102400'
```

## 🎨 CSS Classes

### Bibliotheek
- `.audioboeken` - Container
- `.audioboeken-grid` - Grid layout (3→2→1 kolommen)
- `.audio-book-card` - Individuele kaart
- `.audio-book-overlay` - Hover overlay

### Speler
- `.audioboeken-player` - Container
- `.audio-player-container` - Main wrapper
- `.audio-player-controls` - Audio controls
- `.audio-player-info` - Book informatie

## 🔍 SEO

### Pagina SEO
```php
SEOService::getPageSEO('audioboeken')
```

### Product SEO
```php
SEOService::getProductSEO($product, 'audioboeken')
```

## 🧪 Testing Checklist

- [ ] Upload audiobestand naar product
- [ ] Navigeer naar `/audioboeken`
- [ ] Klik op audioboek kaart
- [ ] Controleer audio afspelen
- [ ] Test responsive design (mobile/tablet/desktop)
- [ ] Controleer breadcrumbs
- [ ] Verify SEO meta tags

## 💡 Tips

### Storage Link
Zorg dat storage link bestaat:
```bash
php artisan storage:link
```

### Grote Bestanden
Pas PHP upload limiet aan in `php.ini`:
```ini
upload_max_filesize = 100M
post_max_size = 100M
```

### Audio Formaat Conversie
Voor beste compatibiliteit, gebruik MP3:
```bash
ffmpeg -i input.wav -b:a 192k output.mp3
```

## 🚀 Deployment

1. Run migratie op productie
2. Zorg voor write permissions op `storage/app/public/audio/`
3. Compile assets: `npm run build`
4. Clear cache: `php artisan config:cache`

## 📝 Notities

- Audio speler gebruikt native HTML5 `<audio>` element
- Meerdere formaten worden aangeboden voor cross-browser support
- Styling consistent met "Online Lezen" feature
- Responsive design voor alle schermformaten

