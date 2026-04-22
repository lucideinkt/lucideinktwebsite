# 🔍 Audio Debug Fix - 500 Error Oplossing

## 📸 Probleem (uit Screenshots)

**Fout:** `500 Internal Server Error` op audio streaming
```
GET https://phplaravel-1560214-6053327.cloudwaysapps.com/stream/audio/kktks2FSKotEhMkVaSmVrRbV0UeAcKJHK2saZy.mp3
Status: 500 (Internal Server Error)
```

**Directe link werkt wel:**
```
https://phplaravel-1560214-6053327.cloudwaysapps.com/storage/audio/vI2RC7WlNJbCbWVFSRuYctAXPVrlfYCVrJV8r1qp.mp3
```

## ✅ Oplossing

### 1. Uitgebreide Debugging Toegevoegd

Beide audio routes hebben nu **gedetailleerde logging** om te zien waarom bestanden niet gevonden worden:

#### `/stream/audio/{path}` Route:
- ✅ Logt alle geprobeerde paden
- ✅ Logt of elk pad bestaat, een bestand is, en leesbaar is
- ✅ Logt bestandsgrootte bij succes
- ✅ Logt volledige exception stack trace bij errors

#### `/audio-proxy/{path}` Route:
- ✅ Logt gevraagde pad
- ✅ Logt volledige systeempad
- ✅ Logt of bestand bestaat/leesbaar is
- ✅ Logt errors met context

### 2. Try-Catch Blokken
Alle audio routes zijn gewrapped in try-catch om **500 errors** te voorkomen en te loggen.

---

## 🚀 Deployment naar Cloudways

```bash
# Lokaal commit
git add routes/web.php
git commit -m "Debug: Add detailed logging to audio routes for 500 error

- Added comprehensive logging to /stream/audio/ route
- Added debugging to /audio-proxy/ route  
- Wrapped both in try-catch for better error handling
- Logs will show exactly which paths are checked and why files aren't found
- Helps diagnose 500 errors on Cloudways"

git push origin bilal-updates

# Op Cloudways
cd /home/master/applications/[app]/public_html
git pull origin main

php artisan route:clear
php artisan config:clear
php artisan view:clear

# Test en check logs
tail -f storage/logs/laravel.log
```

---

## 📋 Check Laravel Logs

Na deployment, test het audioboek en check de logs:

```bash
# Op Cloudways
tail -f storage/logs/laravel.log

# Of via browser (als je .env APP_DEBUG=true hebt)
# De errors zullen nu gedetailleerde info tonen
```

### Wat te Zoeken in Logs:

#### Bij Audio Stream Request:
```
[timestamp] INFO: Audio stream request {"requested_path":"...","trying_paths":[...]}
```

#### Als Bestand Niet Gevonden:
```
[timestamp] ERROR: Audio file not found after checking all paths {
    "requested_path": "kktks2FSKotEhMkVaSmVrRbV0UeAcKJHK2saZy.mp3",
    "checked_paths": [
        {
            "path": "/full/path/to/storage/app/public/audio/kktks...mp3",
            "exists": false,
            "is_file": false,
            "readable": false
        },
        ...
    ]
}
```

Dit toont **exact** welke paden werden gecheckt en waarom het faalde!

#### Als Bestand Gevonden:
```
[timestamp] INFO: Audio file found {
    "path": "/full/path/to/file.mp3",
    "size": 5242880
}
```

---

## 🔍 Diagnose Stappen

### Stap 1: Reproduceer de Error
1. Bezoek het audioboek dat 500 error geeft
2. Probeer audio af te spelen
3. Check browser console voor exacte URL

### Stap 2: Check Laravel Logs
```bash
tail -50 storage/logs/laravel.log
```

Zoek naar:
- `Audio stream request`
- `Audio file not found after checking all paths`
- `Audio stream exception`

### Stap 3: Verifieer Bestand Locatie

Van uit logs zie je welke paden werden gecheckt. SSH naar server:

```bash
# Check als bestand bestaat
ls -la storage/app/public/audio/[bestandsnaam].mp3

# Check permissies
stat storage/app/public/audio/[bestandsnaam].mp3

# Check symlink
ls -la public/storage
```

### Stap 4: Check Database

```bash
php artisan tinker
>>> Product::whereNotNull('audio_file')->get(['id', 'title', 'audio_file']);
```

Verifieer dat `audio_file` veld correct pad bevat.

---

## 🎯 Mogelijke Oorzaken (en Oplossingen)

### 1. Bestand Bestaat Niet
**Log toont:** `"exists": false` voor alle paden

**Oplossing:**
```bash
# Upload bestand naar juiste locatie
# Via SFTP naar: storage/app/public/audio/[bestandsnaam].mp3
```

### 2. Verkeerde Bestandsnaam in Database
**Log toont:** Bestand naam komt niet overeen

**Oplossing:**
```bash
php artisan tinker
>>> $product = Product::find([id]);
>>> $product->audio_file = 'correcte-naam.mp3';
>>> $product->save();
```

### 3. Permissie Probleem
**Log toont:** `"exists": true, "readable": false`

**Oplossing:**
```bash
chmod 644 storage/app/public/audio/[bestandsnaam].mp3
chown master:www-data storage/app/public/audio/[bestandsnaam].mp3
```

### 4. Symlink Kapot
**Log toont:** public/storage paden werken niet

**Oplossing:**
```bash
rm public/storage
php artisan storage:link
```

### 5. PHP Execution Error
**Log toont:** Exception met stack trace

**Oplossing:** Check de exacte error message in logs

---

## 📊 Verwachte Log Output

### Succesvolle Audio Stream:
```
[2026-03-08 14:30:00] INFO: Audio stream request {
    "requested_path": "vI2RC7WlNJbCbWVFSRuYctAXPVrlfYCVrJV8r1qp.mp3",
    "trying_paths": [
        "/path/to/storage/app/public/audio/vI2RC7WlNJbCbWVFSRuYctAXPVrlfYCVrJV8r1qp.mp3",
        ...
    ]
}

[2026-03-08 14:30:00] INFO: Audio file found {
    "path": "/path/to/storage/app/public/audio/vI2RC7WlNJbCbWVFSRuYctAXPVrlfYCVrJV8r1qp.mp3",
    "size": 5242880
}
```
→ Audio speelt af ✅

### Gefaalde Audio Stream:
```
[2026-03-08 14:30:00] INFO: Audio stream request {
    "requested_path": "kktks2FSKotEhMkVaSmVrRbV0UeAcKJHK2saZy.mp3",
    ...
}

[2026-03-08 14:30:00] ERROR: Audio file not found after checking all paths {
    "requested_path": "kktks2FSKotEhMkVaSmVrRbV0UeAcKJHK2saZy.mp3",
    "checked_paths": [
        {"path": "...", "exists": false, "is_file": false, "readable": false},
        {"path": "...", "exists": false, "is_file": false, "readable": false},
        {"path": "...", "exists": false, "is_file": false, "readable": false},
        {"path": "...", "exists": false, "is_file": false, "readable": false}
    ]
}
```
→ 404 Error (bestand bestaat niet) ❌

---

## 🔧 Quick Fixes

### Als Logs Tonen: "File not found"
```bash
# 1. Check welk pad het zoekt
tail storage/logs/laravel.log | grep "Audio stream request"

# 2. Check of bestand daar is
ls -la [path from log]

# 3. Als niet, upload het of update database
```

### Als Logs Tonen: "Permission denied" 
```bash
# Fix permissies
chmod -R 755 storage/app/public/audio/
chown -R master:www-data storage/app/public/audio/
```

### Als Logs Tonen: Exception
```bash
# Check volledige error
tail -100 storage/logs/laravel.log | grep -A 20 "Audio stream exception"

# Vaak is het:
# - PHP memory limit
# - PHP execution timeout
# - File too large
```

---

## ✅ Na Fix Checklist

- [ ] Code deployed naar Cloudways
- [ ] Caches cleared (`php artisan route:clear` etc.)
- [ ] Test audioboek in browser
- [ ] Check Laravel logs: `tail -f storage/logs/laravel.log`
- [ ] Logs tonen "Audio file found" ✅
- [ ] Audio speelt af zonder 500 error ✅
- [ ] Browser console: geen errors ✅

---

## 📝 Samenvatting

**Probleem:** 500 error op `/stream/audio/` zonder duidelijke oorzaak

**Oplossing:** Uitgebreide debugging toegevoegd

**Resultaat:** Logs tonen nu **exact**:
- Welke paden werden gecheckt
- Of bestanden bestaan/leesbaar zijn
- Waarom het faalde
- Volledige stack trace bij exceptions

**Next Steps:**
1. Deploy naar Cloudways
2. Test audioboek
3. Check logs voor details
4. Fix based on log output

---

**Status:** ✅ Debugging Ready  
**Deploy:** Push & test on Cloudways  
**Logs:** `tail -f storage/logs/laravel.log`  
**Datum:** 2026-03-08

