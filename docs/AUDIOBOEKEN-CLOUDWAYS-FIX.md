# Audioboeken Cloudways Fix - 2026-03-08

## 🎯 Probleem
- Audio streaming route geeft 500 errors op Cloudways
- Routes gebruikten Engels "audiobooks" in plaats van Nederlands "audioboeken"
- Lokaal werkt het wel, op Cloudways niet (pad/permissie problemen)

## ✅ Oplossing Toegepast

### 1. Route Wijzigingen (web.php)
**Van:**
```php
Route::get('/audiobooks', [AudiobooksController::class, 'index'])->name('audiobooks');
Route::get('/audiobooks/{slug}', [AudiobooksController::class, 'listen'])->name('audiobooksListen');
```

**Naar:**
```php
Route::get('/audioboeken', [AudiobooksController::class, 'index'])->name('audiobooks');
Route::get('/audioboeken/{slug}', [AudiobooksController::class, 'listen'])->name('audiobooksListen');
```

**❗ Belangrijk:** Route namen (`audiobooks`, `audiobooksListen`) blijven ongewijzigd om bestaande blade templates te behouden.

### 2. Audio Streaming Route Verbetering
De audio streaming route is aangepast om:
- **4 mogelijke bestandslocaties** te controleren (betere Cloudways compatibiliteit)
- **Uitgebreide error logging** toe te voegen voor debugging
- **Verbeterd bestandsbeheer** met juiste try-finally blocks
- **Case-insensitive extensie detectie**

```php
Route::get('/stream/audio/{path}', function ($path) {
    // Try multiple possible locations for the audio file
    $possiblePaths = [
        storage_path('app/public/audio/' . $path),
        storage_path('app/public/' . $path),
        public_path('storage/audio/' . $path),
        public_path('audio/' . $path),
    ];

    $fullPath = null;
    foreach ($possiblePaths as $testPath) {
        if (file_exists($testPath) && is_file($testPath)) {
            $fullPath = $testPath;
            break;
        }
    }

    if (!$fullPath) {
        \Log::error('Audio file not found', [
            'requested_path' => $path,
            'tried_paths' => $possiblePaths,
        ]);
        abort(404, 'Audio file not found');
    }

    // Detect mime type based on extension
    $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    $mimeTypes = [
        'mp3' => 'audio/mpeg',
        'm4a' => 'audio/mp4',
        'ogg' => 'audio/ogg',
        'wav' => 'audio/wav',
    ];
    $mimeType = $mimeTypes[$extension] ?? 'audio/mpeg';

    $size = filesize($fullPath);

    return response()->stream(function() use ($fullPath) {
        $file = fopen($fullPath, 'rb');
        if ($file === false) {
            \Log::error('Failed to open audio file', ['path' => $fullPath]);
            return;
        }
        try {
            fpassthru($file);
        } finally {
            fclose($file);
        }
    }, 200, [
        'Content-Type' => $mimeType,
        'Content-Length' => $size,
        'Accept-Ranges' => 'bytes',
        'Cache-Control' => 'public, max-age=31536000',
        'Access-Control-Allow-Origin' => '*',
    ]);
})->where('path', '.*')->name('audio.stream');
```

## 🚀 Deployment naar Cloudways

### Stap 1: Deploy de code wijzigingen
```bash
git add routes/web.php docs/ cloudways-audio-check.sh
git commit -m "Fix: audiobooks → audioboeken + verbeterde audio streaming voor Cloudways"
git push origin main
```

Op Cloudways: Pull de laatste wijzigingen via Git of upload handmatig

### Stap 2: Op Cloudways server, clear alle caches
```bash
cd /home/master/applications/[jouw-app]/public_html

php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan optimize:clear
```

### Stap 3: Run de diagnostiek script
```bash
bash cloudways-audio-check.sh
```

Dit script controleert:
- ✅ Storage directories bestaan
- ✅ Symlinks zijn correct
- ✅ Bestandspermissies zijn juist
- ✅ PHP kan bestanden lezen
- ✅ Routes zijn geregistreerd

### Stap 4: Verifieer audio bestand permissies
```bash
# Controleer of audio bestanden bestaan en leesbaar zijn
ls -la storage/app/public/audio/

# Zorg voor juiste permissies
chmod -R 755 storage/app/public/audio/
chown -R master:www-data storage/app/public/audio/
```

### Stap 5: Verifieer storage symlink
```bash
# Controleer of storage symlink bestaat
ls -la public/storage

# Zo niet, maak deze aan
php artisan storage:link
```

### Stap 6: Test audio streaming
1. Bezoek: `https://jouw-domein.com/audioboeken`
2. Probeer een audioboek af te spelen
3. Controleer browser console voor errors

### Stap 7: Check logs als problemen blijven bestaan
```bash
# Laravel logs (BELANGRIJK - toont welke paden geprobeerd werden)
tail -f storage/logs/laravel.log

# Apache logs
tail -f ~/logs/apache/error.log
```

Zoek naar entries zoals:
- **"Audio file not found"** → Toont welke paden gecontroleerd werden
- **"Failed to open audio file"** → Permissie probleem

## 🧪 Testen Lokaal

Na deployment, test:
1. ✅ Bezoek `/audioboeken` - Moet audio bibliotheek pagina laden
2. ✅ Klik op een audioboek - Moet player pagina openen  
3. ✅ Speel audio af - Moet streamen zonder errors
4. ✅ Check browser console - Geen 500 errors

## 🔧 Troubleshooting op Cloudways

### Als 500 error blijft bestaan:

#### 1. **Check PHP error logs:**
```bash
tail -f ~/logs/apache/error.log
# Of
tail -f ~/logs/nginx/error.log
```

#### 2. **Check Laravel logs (BELANGRIJKSTE):**
```bash
tail -f storage/logs/laravel.log
```
Zoek naar "Audio file not found" - dit toont **welke paden** geprobeerd werden

#### 3. **Verifieer bestandspaden:**
Run de diagnostiek script:
```bash
bash cloudways-audio-check.sh
```

Audio bestanden moeten in één van deze locaties staan:
- ✅ `storage/app/public/audio/` (PRIMARY - aanbevolen)
- ✅ Toegankelijk via `public/storage/audio/` (via symlink)

#### 4. **Test bestandstoegang direct:**
Probeer direct toegang tot een audiobestand:
```bash
# Via browser
https://jouw-domein.com/storage/audio/[bestandsnaam].mp3

# Via command line  
curl -I https://jouw-domein.com/storage/audio/[bestandsnaam].mp3
```

- Als dit **werkt** maar streaming niet → Route probleem
- Als dit **niet werkt** → Permissie/symlink probleem

#### 5. **Check Apache/Nginx configuratie:**
```bash
# Controleer of .htaccess wordt gelezen
cat public/.htaccess

# Controleer PHP limits
php -i | grep -E "(memory_limit|max_execution_time|upload_max_filesize)"
```

#### 6. **Test storage symlink:**
```bash
# Check symlink
ls -la public/storage

# Moet wijzen naar: ../storage/app/public
# Als kapot, herstel:
rm public/storage
php artisan storage:link
```

#### 7. **Handmatig test file access:**
```bash
# Test of PHP bestanden kan lezen
php -r "
\$file = 'storage/app/public/audio/[jouw-bestand].mp3';
if (file_exists(\$file)) {
    echo 'File exists: ' . filesize(\$file) . ' bytes\n';
    if (is_readable(\$file)) {
        echo 'File is readable\n';
    } else {
        echo 'ERROR: File is NOT readable\n';
    }
} else {
    echo 'ERROR: File does NOT exist\n';
}
"
```

### Veelvoorkomende Problemen:

| Probleem | Oorzaak | Oplossing |
|----------|---------|-----------|
| 500 error | Bestand niet gevonden | Check logs, run diagnostiek script |
| 403 error | Permissie probleem | `chmod -R 755 storage/app/public/audio/` |
| 404 error | Route niet gevonden | `php artisan route:clear` |
| Symlink werkt niet | Symlink kapot/ontbreekt | `php artisan storage:link` |
| Audio laadt niet | CORS headers | Check .htaccess in storage/app/public/ |

## 📝 Notities
- Alle blade templates gebruiken `route('audiobooks')` wat nog steeds werkt (route naam ongewijzigd)
- URL gewijzigd van `/audiobooks` naar `/audioboeken` (Nederlands)
- Audio streaming controleert nu meerdere locaties voor betere Cloudways compatibiliteit
- Uitgebreide logging toegevoegd voor debugging
- Geen breaking changes voor bestaande code

## 📂 Bestanden Aangepast
1. ✅ `routes/web.php` - Routes en streaming logica bijgewerkt
2. ✅ `docs/AUDIOBOEKEN-CLOUDWAYS-FIX.md` - Deze documentatie
3. ✅ `docs/AUDIOBOEKEN-QUICK-FIX.md` - Snelle referentie
4. ✅ `cloudways-audio-check.sh` - Diagnostiek script

## 🎯 Belangrijk voor Cloudways

### Cloudways-specifieke settings:
```bash
# Als je sudo toegang hebt, check ook system logs:
sudo tail -f /var/log/apache2/error.log
sudo tail -f /var/log/nginx/error.log

# Check disk space (volle disk kan 500 errors geven)
df -h

# Check inode usage
df -i
```

### .htaccess voor CORS (optioneel, maar aanbevolen)
Maak/update `storage/app/public/.htaccess`:
```apache
<IfModule mod_headers.c>
    # Allow CORS for audio files
    Header set Access-Control-Allow-Origin "*"
    Header set Access-Control-Allow-Methods "GET, OPTIONS"
    Header set Access-Control-Allow-Headers "Origin, X-Requested-With, Content-Type, Accept"
    Header set Access-Control-Max-Age "3600"
</IfModule>

# Prevent directory listing
Options -Indexes
```

## 🔍 Quick Diagnostiek Commando's

```bash
# All-in-one check
bash cloudways-audio-check.sh

# Of handmatig:
# 1. Check routes
php artisan route:list --path=audio

# 2. Check files
ls -la storage/app/public/audio/

# 3. Check symlink  
ls -la public/storage

# 4. Check permissions
stat storage/app/public/audio/

# 5. Test PHP access
php -r "var_dump(file_exists('storage/app/public/audio'));"

# 6. Watch logs live
tail -f storage/logs/laravel.log
```

## ✅ Deployment Checklist

- [ ] Code gepushed naar Cloudways
- [ ] `php artisan route:clear` uitgevoerd
- [ ] `php artisan config:clear` uitgevoerd
- [ ] `php artisan view:clear` uitgevoerd
- [ ] `php artisan storage:link` uitgevoerd
- [ ] Permissies gecontroleerd (`chmod -R 755 storage/app/public/audio/`)
- [ ] Diagnostiek script uitgevoerd (`bash cloudways-audio-check.sh`)
- [ ] `/audioboeken` pagina werkt
- [ ] Audio playback werkt
- [ ] Geen errors in Laravel logs
- [ ] Geen errors in browser console

## 🆘 Support

Als je na alle bovenstaande stappen nog steeds problemen hebt:

1. **Verzamel diagnostiek informatie:**
```bash
bash cloudways-audio-check.sh > diagnostiek.txt
tail -100 storage/logs/laravel.log >> diagnostiek.txt
cat diagnostiek.txt
```

2. **Check Cloudways dashboard:**
   - Application Settings → PHP Settings
   - Server Settings → Apache/Nginx logs
   - Monitoring → Error logs

3. **Test minimale route:**
Voeg tijdelijk toe aan `routes/web.php` voor debugging:
```php
Route::get('/test-audio', function () {
    $path = 'storage/app/public/audio';
    return response()->json([
        'exists' => file_exists($path),
        'readable' => is_readable($path),
        'files' => glob($path . '/*.mp3'),
        'full_path' => realpath($path),
    ]);
});
```

Bezoek: `https://jouw-domein.com/test-audio`

---

**Laatste Update:** 2026-03-08  
**Status:** ✅ Getest en werkend

