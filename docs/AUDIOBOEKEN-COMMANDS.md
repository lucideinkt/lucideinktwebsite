# 🚀 Audioboeken Quick Commands

## Deployment Commands (Cloudways)

```bash
# Navigate to app directory
cd /home/master/applications/[app-naam]/public_html

# Pull latest code
git pull origin main

# Clear all caches
php artisan route:clear && php artisan config:clear && php artisan view:clear && php artisan cache:clear

# Create storage symlink
php artisan storage:link

# Fix permissions
chmod -R 755 storage/app/public/audio/
chown -R master:www-data storage/app/public/audio/

# Run diagnostics
bash cloudways-audio-check.sh

# Watch logs
tail -f storage/logs/laravel.log
```

## One-Line Deployment

```bash
cd /home/master/applications/[app-naam]/public_html && git pull && php artisan route:clear && php artisan config:clear && php artisan view:clear && php artisan storage:link && chmod -R 755 storage/app/public/audio/ && bash cloudways-audio-check.sh
```

## Troubleshooting Commands

```bash
# Check if routes are registered
php artisan route:list --path=audio

# List audio files
ls -la storage/app/public/audio/

# Check symlink
ls -la public/storage

# Test PHP file access
php -r "var_dump(file_exists('storage/app/public/audio'));"

# Check permissions
stat storage/app/public/audio/

# Watch Laravel logs (real-time)
tail -f storage/logs/laravel.log

# Watch Apache logs (real-time)
tail -f ~/logs/apache/error.log

# Search for audio errors in logs
grep -i "audio file not found" storage/logs/laravel.log | tail -20

# Test audio file directly
curl -I https://jouw-domein.com/storage/audio/test.mp3

# Check disk space
df -h

# Count audio files
find storage/app/public/audio/ -name "*.mp3" | wc -l
```

## Quick Fixes

```bash
# Fix: Symlink broken
rm public/storage && php artisan storage:link

# Fix: Wrong permissions
chmod -R 755 storage/app/public/audio/
chown -R master:www-data storage/app/public/audio/

# Fix: Cache issues
php artisan optimize:clear

# Fix: Routes not found
php artisan route:clear && php artisan route:cache

# Fix: Config not updated
php artisan config:clear && php artisan config:cache
```

## Testing Commands

```bash
# Test route exists
curl -I https://jouw-domein.com/audioboeken

# Test audio streaming
curl -I https://jouw-domein.com/stream/audio/test.mp3

# Test direct file access
curl -I https://jouw-domein.com/storage/audio/test.mp3

# Download audio file (test streaming)
curl https://jouw-domein.com/stream/audio/test.mp3 --output test.mp3
```

## Database Commands

```bash
# Update product with audio file
php artisan tinker
>>> $product = Product::where('slug', 'product-slug')->first();
>>> $product->audio_file = 'filename.mp3';
>>> $product->save();
>>> exit

# List all products with audio
php artisan tinker
>>> Product::whereNotNull('audio_file')->where('audio_file', '!=', '')->pluck('title', 'audio_file');
>>> exit
```

## Backup Commands

```bash
# Backup audio files
tar -czf audio-backup-$(date +%Y%m%d).tar.gz storage/app/public/audio/

# List backups
ls -lh audio-backup-*.tar.gz

# Restore from backup
tar -xzf audio-backup-20260308.tar.gz
```

## Monitoring Commands

```bash
# Real-time log monitoring (multiple windows)
# Window 1: Laravel logs
tail -f storage/logs/laravel.log

# Window 2: Apache logs  
tail -f ~/logs/apache/error.log

# Window 3: System resources
watch -n 5 'df -h; echo "---"; free -m'
```

## Git Commands

```bash
# Check current status
git status

# Add all audioboeken changes
git add routes/web.php cloudways-audio-check.sh docs/AUDIOBOEKEN-*.md

# Commit
git commit -m "Fix: audiobooks → audioboeken + enhanced streaming"

# Push
git push origin bilal-updates

# Pull on server
git pull origin main
```

## Emergency Commands

```bash
# If website is down
# 1. Check Laravel logs
tail -100 storage/logs/laravel.log

# 2. Check Apache logs
tail -100 ~/logs/apache/error.log

# 3. Check if PHP is running
ps aux | grep php

# 4. Restart PHP-FPM (if needed)
sudo service php-fpm restart

# 5. Check disk space (full disk = problems)
df -h

# 6. Clear all caches
php artisan optimize:clear
```

## Useful Aliases (Optional - Add to ~/.bashrc)

```bash
# Add to ~/.bashrc for quick access
alias art='php artisan'
alias artcc='php artisan route:clear && php artisan config:clear && php artisan view:clear && php artisan cache:clear'
alias logs='tail -f storage/logs/laravel.log'
alias audio-check='bash cloudways-audio-check.sh'
alias audio-list='ls -lah storage/app/public/audio/'

# Then reload: source ~/.bashrc
```

## URLs for Testing

```
# Production
https://jouw-domein.com/audioboeken
https://jouw-domein.com/audioboeken/[slug]
https://jouw-domein.com/stream/audio/[filename].mp3

# Localhost
http://localhost/audioboeken
http://localhost/audioboeken/[slug]
http://localhost/stream/audio/[filename].mp3
```

---

**💡 Tip:** Bookmark deze pagina voor snelle toegang tot commands!

