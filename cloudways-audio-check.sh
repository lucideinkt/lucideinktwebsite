#!/bin/bash

# CLOUDWAYS AUDIOBOEKEN FIX SCRIPT
# Dit script diagnosticeert audiobestand toegangsproblemen en 500 errors

echo "================================================"
echo "🎵 CLOUDWAYS AUDIOBOEKEN DIAGNOSTIEK"
echo "================================================"
echo ""

# Kleuren
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Stap 1: Controleer huidige locatie
echo -e "${BLUE}📍 Stap 1: Controleer locatie${NC}"
echo "-------------------------------------------"
if [ ! -f "artisan" ]; then
    echo -e "${RED}❌ FOUT: Niet in Laravel root directory${NC}"
    echo "Ga naar de juiste directory en run opnieuw"
    exit 1
fi
pwd
echo -e "${GREEN}✅ In correcte Laravel directory${NC}"
echo ""

# Stap 2: Controleer storage directories
echo -e "${BLUE}📁 Stap 2: Controleer storage directories${NC}"
echo "-------------------------------------------"
if [ -d "storage/app/public/audio" ]; then
    echo -e "${GREEN}✅ storage/app/public/audio bestaat${NC}"

    # Count files
    AUDIO_COUNT=$(find storage/app/public/audio/ -type f -name "*.mp3" 2>/dev/null | wc -l)
    echo "   Gevonden MP3 bestanden: $AUDIO_COUNT"

    if [ $AUDIO_COUNT -gt 0 ]; then
        echo "   Eerste 5 bestanden:"
        ls -lh storage/app/public/audio/ | head -6
    else
        echo -e "${YELLOW}⚠️  Geen MP3 bestanden gevonden in audio directory${NC}"
    fi
else
    echo -e "${RED}❌ storage/app/public/audio bestaat NIET${NC}"
    echo "   Maak directory aan: mkdir -p storage/app/public/audio"
fi
echo ""

# Stap 3: Controleer public/storage symlink
echo -e "${BLUE}🔗 Stap 3: Controleer public/storage symlink${NC}"
echo "-------------------------------------------"
if [ -L "public/storage" ]; then
    SYMLINK_TARGET=$(readlink public/storage)
    echo -e "${GREEN}✅ public/storage symlink bestaat${NC}"
    echo "   Wijst naar: $SYMLINK_TARGET"

    # Verify symlink is correct
    if [ -d "public/storage" ]; then
        echo -e "${GREEN}✅ Symlink is geldig${NC}"
    else
        echo -e "${RED}❌ Symlink is KAPOT${NC}"
        echo "   Herstel met: rm public/storage && php artisan storage:link"
    fi
else
    echo -e "${RED}❌ public/storage symlink bestaat NIET${NC}"
    echo "   Maak symlink: php artisan storage:link"
fi
echo ""

# Stap 4: Controleer bestandspermissies
echo -e "${BLUE}🔐 Stap 4: Controleer bestandspermissies${NC}"
echo "-------------------------------------------"
if [ -d "storage/app/public/audio" ]; then
    DIR_PERMS=$(stat -c "%a" storage/app/public/audio/ 2>/dev/null || stat -f "%Lp" storage/app/public/audio/)
    echo "Directory permissies: $DIR_PERMS"
    ls -ld storage/app/public/audio/

    if [ "$DIR_PERMS" == "755" ] || [ "$DIR_PERMS" == "775" ]; then
        echo -e "${GREEN}✅ Directory permissies zijn correct${NC}"
    else
        echo -e "${YELLOW}⚠️  Directory permissies mogelijk incorrect${NC}"
        echo "   Aanbevolen: chmod -R 755 storage/app/public/audio/"
    fi

    # Check sample file permissions
    SAMPLE_FILE=$(find storage/app/public/audio/ -type f -name "*.mp3" | head -1)
    if [ ! -z "$SAMPLE_FILE" ]; then
        echo ""
        echo "Voorbeeld bestand permissies:"
        ls -l "$SAMPLE_FILE"
    fi
else
    echo -e "${YELLOW}⚠️  Kan permissies niet controleren - directory bestaat niet${NC}"
fi
echo ""

# Stap 5: Controleer PHP instellingen
echo -e "${BLUE}⚙️  Stap 5: Controleer PHP instellingen${NC}"
echo "-------------------------------------------"
echo "PHP Versie: $(php -v | head -1)"
echo "Max execution time: $(php -r 'echo ini_get("max_execution_time");')s"
echo "Memory limit: $(php -r 'echo ini_get("memory_limit");')"
echo "Max file upload: $(php -r 'echo ini_get("upload_max_filesize");')"
echo "Post max size: $(php -r 'echo ini_get("post_max_size");')"
echo -e "${GREEN}✅ PHP configuratie gecontroleerd${NC}"
echo ""

# Stap 6: Test bestandstoegang vanuit PHP
echo -e "${BLUE}🧪 Stap 6: Test bestandstoegang vanuit PHP${NC}"
echo "-------------------------------------------"
php -r "
\$paths = [
    'storage/app/public/audio' => 'Storage path (primary)',
    'storage/app/public' => 'Storage public',
    'public/storage/audio' => 'Public symlink path',
    'public/audio' => 'Public direct path',
];

foreach (\$paths as \$path => \$desc) {
    echo \"\n\$desc (\$path):\n\";
    if (file_exists(\$path)) {
        echo \"  ✅ Path is accessible\n\";
        if (is_readable(\$path)) {
            echo \"  ✅ Path is readable\n\";
            \$files = glob(\$path . '/*.mp3');
            if (count(\$files) > 0) {
                echo \"  ✅ Found \" . count(\$files) . \" MP3 file(s)\n\";
                echo \"     Sample: \" . basename(\$files[0]) . \"\n\";
            } else {
                echo \"  ⚠️  No MP3 files found\n\";
            }
        } else {
            echo \"  ❌ Path is NOT readable (permission issue)\n\";
        }
    } else {
        echo \"  ❌ Path does NOT exist\n\";
    }
}
"
echo ""

# Stap 7: Controleer .htaccess bestanden
echo -e "${BLUE}📄 Stap 7: Controleer .htaccess bestanden${NC}"
echo "-------------------------------------------"
if [ -f "public/.htaccess" ]; then
    echo -e "${GREEN}✅ public/.htaccess bestaat${NC}"
else
    echo -e "${RED}❌ public/.htaccess ONTBREEKT${NC}"
    echo "   Dit kan routing problemen veroorzaken"
fi

if [ -f "storage/app/public/.htaccess" ]; then
    echo -e "${GREEN}✅ storage/app/public/.htaccess bestaat${NC}"
    echo ""
    echo "Inhoud:"
    cat storage/app/public/.htaccess
else
    echo -e "${YELLOW}⚠️  storage/app/public/.htaccess ontbreekt (optioneel)${NC}"
fi
echo ""

# Stap 8: Test route registratie
echo -e "${BLUE}🛣️  Stap 8: Test route registratie${NC}"
echo "-------------------------------------------"
echo "Audioboeken routes:"
php artisan route:list --path=audio 2>/dev/null || php artisan route:list | grep -i audio
echo ""

# Stap 9: Clear alle caches
echo -e "${BLUE}🗑️  Stap 9: Clear alle caches${NC}"
echo "-------------------------------------------"
php artisan route:clear
echo "✅ Route cache cleared"
php artisan config:clear
echo "✅ Config cache cleared"
php artisan view:clear
echo "✅ View cache cleared"
echo -e "${GREEN}✅ Alle caches verwijderd${NC}"
echo ""

# Stap 10: Check recente Laravel logs
echo -e "${BLUE}📋 Stap 10: Check recente Laravel logs${NC}"
echo "-------------------------------------------"
if [ -f "storage/logs/laravel.log" ]; then
    echo "Laatste 10 audio-gerelateerde log entries:"
    echo ""
    grep -i "audio" storage/logs/laravel.log | tail -10 || echo "Geen audio-gerelateerde logs gevonden"
else
    echo -e "${YELLOW}⚠️  Geen Laravel log bestand gevonden${NC}"
fi
echo ""

# Samenvatting
echo "================================================"
echo -e "${BLUE}📊 SAMENVATTING & AANBEVELINGEN${NC}"
echo "================================================"
echo ""

# Check if any critical issues were found
ISSUES_FOUND=0

if [ ! -d "storage/app/public/audio" ]; then
    echo -e "${RED}❌ KRITIEK: Audio directory bestaat niet${NC}"
    echo "   Oplossing: mkdir -p storage/app/public/audio"
    echo ""
    ISSUES_FOUND=1
fi

if [ ! -L "public/storage" ]; then
    echo -e "${RED}❌ KRITIEK: Storage symlink ontbreekt${NC}"
    echo "   Oplossing: php artisan storage:link"
    echo ""
    ISSUES_FOUND=1
fi

AUDIO_COUNT=$(find storage/app/public/audio/ -type f -name "*.mp3" 2>/dev/null | wc -l)
if [ $AUDIO_COUNT -eq 0 ]; then
    echo -e "${YELLOW}⚠️  WAARSCHUWING: Geen MP3 bestanden gevonden${NC}"
    echo "   Upload audiobestanden naar storage/app/public/audio/"
    echo ""
fi

if [ $ISSUES_FOUND -eq 0 ]; then
    echo -e "${GREEN}✅ GEEN KRITIEKE PROBLEMEN GEVONDEN${NC}"
    echo ""
fi

echo -e "${YELLOW}📌 VOLGENDE STAPPEN:${NC}"
echo ""
echo "1. Als symlink ontbreekt:"
echo "   php artisan storage:link"
echo ""
echo "2. Als permissies verkeerd zijn:"
echo "   chmod -R 755 storage/app/public/audio/"
echo "   chown -R master:www-data storage/app/public/audio/"
echo ""
echo "3. Test de routes in browser:"
echo "   https://your-domain.com/audioboeken"
echo ""
echo "4. Monitor real-time logs:"
echo "   tail -f storage/logs/laravel.log"
echo ""
echo "5. Als 500 errors blijven, check Apache logs:"
echo "   tail -f ~/logs/apache/error.log"
echo ""
echo "================================================"
echo -e "${GREEN}🎉 DIAGNOSTIEK COMPLEET${NC}"
echo "================================================"
echo ""

