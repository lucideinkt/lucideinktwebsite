# 🎵 Audioboeken Feature - Complete Documentatie

## 📋 Overzicht

De audioboeken feature stelt gebruikers in staat om audioversies van boeken te beluisteren via een ingebouwde audiospeler. Deze documentatie beschrijft de implementatie, deployment en troubleshooting.

## 🌐 URLs

### Productie (Cloudways)
- **Bibliotheek:** `https://jouw-domein.com/audioboeken`
- **Player:** `https://jouw-domein.com/audioboeken/{slug}`
- **Stream API:** `https://jouw-domein.com/stream/audio/{path}`

### Lokaal
- **Bibliotheek:** `http://localhost/audioboeken`
- **Player:** `http://localhost/audioboeken/{slug}`
- **Stream API:** `http://localhost/stream/audio/{path}`

## 🔧 Technische Implementatie

### Routes (`routes/web.php`)
```php
// Audioboeken pagina's
Route::get('/audioboeken', [AudiobooksController::class, 'index'])->name('audiobooks');
Route::get('/audioboeken/{slug}', [AudiobooksController::class, 'listen'])->name('audiobooksListen');

// Audio streaming endpoint
Route::get('/stream/audio/{path}', function ($path) {
    // Controleert 4 mogelijke locaties
    // Streamt bestand met CORS headers
    // Logt errors voor debugging
})->where('path', '.*')->name('audio.stream');
```

### Controller (`app/Http/Controllers/AudiobooksController.php`)
```php
class AudiobooksController extends Controller
{
    public function index()
    {
        // Haalt alle gepubliceerde producten met audio_file op
        $products = Product::with(['category', 'productCopy'])
            ->where('is_published', 1)
            ->whereNotNull('audio_file')
            ->where('audio_file', '!=', '')
            ->orderBy('title', 'asc')
            ->get();

        return view('audiobooks', ['products' => $products]);
    }

    public function listen($slug)
    {
        // Toont audio player voor specifiek audioboek
        $product = Product::where('slug', $slug)
            ->where('is_published', 1)
            ->firstOrFail();

        return view('audiobooks-player', ['product' => $product]);
    }
}
```

### Views
- `resources/views/audiobooks.blade.php` - Bibliotheek grid view
- `resources/views/audiobooks-player.blade.php` - Audio player

### Database
Audio bestanden worden opgeslagen in het `audio_file` veld van de `products` tabel:
```sql
ALTER TABLE products ADD COLUMN audio_file VARCHAR(255) NULL;
```

## 📁 Bestandsstructuur

```
storage/app/public/audio/          ← Primary locatie voor audio bestanden
    └── *.mp3, *.m4a, *.ogg

public/storage/                     ← Symlink naar storage/app/public/
    └── audio/
        └── [symlinked files]

public/.htaccess                    ← Apache rewrite rules
storage/app/public/.htaccess        ← CORS headers (optioneel)
```

## 🚀 Deployment Guide

### Lokaal Setup
```bash
# 1. Maak audio directory
mkdir -p storage/app/public/audio

# 2. Maak symlink
php artisan storage:link

# 3. Upload audio bestanden naar storage/app/public/audio/

# 4. Voeg audio_file toe aan product in database
```

### Cloudways Deployment

#### Stap 1: Code Deployen
```bash
git add .
git commit -m "Audioboeken feature"
git push origin main
```

#### Stap 2: Op Cloudways Server
```bash
cd /home/master/applications/[app-naam]/public_html

# Clear alle caches
php artisan route:clear
php artisan config:clear
php artisan view:clear
php artisan cache:clear

# Maak symlink
php artisan storage:link

# Check permissies
chmod -R 755 storage/app/public/audio/
chown -R master:www-data storage/app/public/audio/
```

#### Stap 3: Upload Audio Bestanden
Via SFTP of Cloudways File Manager:
- Upload naar: `application_name/public_html/storage/app/public/audio/`
- Zorg voor juiste permissies: `755` voor directories, `644` voor bestanden

#### Stap 4: Test
```bash
# Run diagnostiek
bash cloudways-audio-check.sh

# Check logs
tail -f storage/logs/laravel.log
```

## 🧪 Testing

### Functionaliteitstest
1. ✅ Bezoek `/audioboeken` - Grid met alle audioboeken
2. ✅ Klik op audioboek - Player pagina opent
3. ✅ Klik play - Audio begint af te spelen
4. ✅ Controleer controls - Pause, volume, progress bar werken
5. ✅ Check mobile - Responsive design werkt

### Performance Test
```bash
# Test streaming performance
curl -I https://jouw-domein.com/stream/audio/test.mp3

# Should return:
# HTTP/1.1 200 OK
# Content-Type: audio/mpeg
# Content-Length: [size]
# Accept-Ranges: bytes
```

## 🐛 Troubleshooting

### Probleem: 500 Error bij audio streaming

**Oorzaak:** Bestand niet gevonden of permissie probleem

**Oplossing:**
```bash
# 1. Run diagnostiek
bash cloudways-audio-check.sh

# 2. Check Laravel logs
tail -f storage/logs/laravel.log
# Kijk naar "Audio file not found" entries - toont geprobeerde paden

# 3. Verifieer bestand bestaat
ls -la storage/app/public/audio/

# 4. Check permissies
chmod -R 755 storage/app/public/audio/
```

### Probleem: Audio laadt niet (infinite loading)

**Oorzaak:** CORS issues of verkeerde URL

**Oplossing:**
```bash
# 1. Check browser console voor CORS errors

# 2. Voeg CORS headers toe aan storage/app/public/.htaccess:
cat > storage/app/public/.htaccess << 'EOF'
<IfModule mod_headers.c>
    Header set Access-Control-Allow-Origin "*"
    Header set Access-Control-Allow-Methods "GET, OPTIONS"
    Header set Access-Control-Allow-Headers "Origin, X-Requested-With, Content-Type, Accept"
</IfModule>
EOF

# 3. Test direct file access
curl -I https://jouw-domein.com/storage/audio/test.mp3
```

### Probleem: Symlink werkt niet

**Oorzaak:** Symlink niet aangemaakt of kapot

**Oplossing:**
```bash
# Verwijder oude symlink
rm public/storage

# Maak nieuwe symlink
php artisan storage:link

# Verifieer
ls -la public/storage
# Should point to: ../storage/app/public
```

### Probleem: Audio bestanden niet zichtbaar in bibliotheek

**Oorzaak:** `audio_file` veld is leeg in database

**Oplossing:**
```sql
-- Update product met audio file
UPDATE products 
SET audio_file = 'bestandsnaam.mp3' 
WHERE slug = 'product-slug';

-- Of via tinker
php artisan tinker
>>> $product = Product::where('slug', 'product-slug')->first();
>>> $product->audio_file = 'bestandsnaam.mp3';
>>> $product->save();
```

## 📊 Monitoring

### Real-time Log Monitoring
```bash
# Laravel logs (application errors)
tail -f storage/logs/laravel.log

# Apache logs (server errors)  
tail -f ~/logs/apache/error.log

# Nginx logs (als Nginx gebruikt wordt)
tail -f ~/logs/nginx/error.log
```

### Belangrijke Log Entries

**Succes:**
```
[timestamp] production.INFO: Audio file streamed successfully {"path":"audio/test.mp3","size":5242880}
```

**Fout - Niet gevonden:**
```
[timestamp] production.ERROR: Audio file not found {"requested_path":"audio/test.mp3","tried_paths":[...]}
```

**Fout - Niet te openen:**
```
[timestamp] production.ERROR: Failed to open audio file {"path":"/full/path/to/file.mp3"}
```

## 🔐 Beveiliging

### Aanbevelingen
1. ✅ Audio bestanden NIET direct toegankelijk maken (gebruik streaming route)
2. ✅ Implementeer rate limiting op streaming endpoint
3. ✅ Valideer bestandsextensies (alleen .mp3, .m4a, .ogg toegestaan)
4. ✅ Blokkeer directory traversal (`..` in paths)
5. ✅ Monitor disk usage (grote audiobestanden)

### Rate Limiting (optioneel)
```php
// In routes/web.php
Route::get('/stream/audio/{path}', function ($path) {
    // ... existing code
})->middleware('throttle:60,1'); // Max 60 requests per minuut
```

## 📚 Gerelateerde Documentatie

- `docs/AUDIOBOEKEN-CLOUDWAYS-FIX.md` - Deployment en troubleshooting guide
- `docs/AUDIOBOEKEN-QUICK-FIX.md` - Snelle referentie voor veelvoorkomende issues
- `cloudways-audio-check.sh` - Automatische diagnostiek script

## 🎯 Checklist voor Nieuwe Audioboek

- [ ] Audio bestand geüpload naar `storage/app/public/audio/`
- [ ] Product aangemaakt in database met `audio_file` veld ingevuld
- [ ] Product `is_published` = 1
- [ ] Cover image toegevoegd (image_1)
- [ ] Getest op localhost
- [ ] Getest op productie (Cloudways)
- [ ] Bestandsgrootte check (< 100MB aanbevolen)
- [ ] Audio kwaliteit check (bitrate, sample rate)

## 🔄 Onderhoud

### Wekelijks
- [ ] Check disk usage: `df -h`
- [ ] Review error logs voor audio streaming issues
- [ ] Verifieer alle audioboeken nog toegankelijk zijn

### Maandelijks
- [ ] Backup audio bestanden
- [ ] Check broken audio links
- [ ] Performance review (streaming snelheid)
- [ ] Update documentatie indien nodig

## 💡 Tips & Best Practices

1. **Bestandsnamen:** Gebruik descriptieve namen zonder spaties
   - ✅ `het-traktaat-voor-de-zieken.mp3`
   - ❌ `audio file (1).mp3`

2. **Bestandsgrootte:** Optimaliseer audio bestanden
   - Aanbevolen: 128-192kbps MP3
   - Max: 100MB per bestand

3. **Caching:** Browser caching voor audio (1 year)
   ```
   Cache-Control: public, max-age=31536000
   ```

4. **Testing:** Test altijd op mobiel EN desktop
   - iOS Safari (vaak CORS issues)
   - Android Chrome
   - Desktop browsers

5. **Logging:** Monitor streaming errors actief
   ```bash
   # Set up log alert (optioneel)
   grep -i "audio file not found" storage/logs/laravel.log
   ```

## 📞 Support

Voor vragen of problemen:
1. Check deze documentatie eerst
2. Run diagnostiek script: `bash cloudways-audio-check.sh`
3. Check Laravel logs: `tail -f storage/logs/laravel.log`
4. Zoek in `docs/` directory voor specifieke guides

---

**Versie:** 1.0  
**Laatste Update:** 2026-03-08  
**Status:** ✅ Productie-ready

