#!/bin/bash

# CLOUDWAYS MAILTRAP FIX SCRIPT
# Dit script lost het CC forwarding probleem op

echo "================================================"
echo "🔧 CLOUDWAYS MAILTRAP FORWARDING FIX"
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
pwd
echo ""

# Stap 2: Stop alle queue workers
echo -e "${BLUE}🛑 Stap 2: Stop queue workers${NC}"
echo "-------------------------------------------"
php artisan queue:restart
echo -e "${GREEN}✅ Queue workers gestopt${NC}"
echo ""

# Stap 3: Verwijder ALLE cache (inclusief config, routes, views)
echo -e "${BLUE}🗑️  Stap 3: Verwijder ALLE cache${NC}"
echo "-------------------------------------------"
php artisan config:clear
echo "Config cache cleared"
php artisan cache:clear
echo "Application cache cleared"
php artisan route:clear
echo "Route cache cleared"
php artisan view:clear
echo "View cache cleared"
php artisan optimize:clear
echo "Optimize cache cleared"
echo -e "${GREEN}✅ Alle cache verwijderd${NC}"
echo ""

# Stap 4: Controleer .env bestand
echo -e "${BLUE}🔍 Stap 4: Controleer .env bestand${NC}"
echo "-------------------------------------------"
if grep -q "MAILTRAP_FORWARD_EMAIL=" .env; then
    FORWARD_EMAIL=$(grep "MAILTRAP_FORWARD_EMAIL=" .env | cut -d '=' -f2 | tr -d '"' | tr -d "'")
    echo "MAILTRAP_FORWARD_EMAIL in .env: '$FORWARD_EMAIL'"

    if [ -z "$FORWARD_EMAIL" ] || [ "$FORWARD_EMAIL" == "" ]; then
        echo -e "${RED}❌ PROBLEEM: MAILTRAP_FORWARD_EMAIL is LEEG in .env${NC}"
        echo "Voeg toe aan .env: MAILTRAP_FORWARD_EMAIL=\"lucideinkt@gmail.com\""
    else
        echo -e "${GREEN}✅ .env bevat forward email: $FORWARD_EMAIL${NC}"
    fi
else
    echo -e "${RED}❌ PROBLEEM: MAILTRAP_FORWARD_EMAIL niet gevonden in .env${NC}"
    echo "Voeg toe aan .env: MAILTRAP_FORWARD_EMAIL=\"lucideinkt@gmail.com\""
fi
echo ""

# Stap 5: Test configuratie (ZONDER cache)
echo -e "${BLUE}🧪 Stap 5: Test configuratie (live, zonder cache)${NC}"
echo "-------------------------------------------"
TESTED_EMAIL=$(php artisan tinker --execute="echo config('mail.mailtrap_forward_email');")
echo "config('mail.mailtrap_forward_email') = '$TESTED_EMAIL'"

if [ -z "$TESTED_EMAIL" ] || [ "$TESTED_EMAIL" == "" ] || [ "$TESTED_EMAIL" == "null" ]; then
    echo -e "${RED}❌ PROBLEEM: Config retourneert geen waarde${NC}"
    echo ""
    echo "Mogelijke oorzaken:"
    echo "1. config/mail.php niet correct geüpload"
    echo "2. .env bestand niet correct"
    echo ""
    echo "Controleer of config/mail.php deze regel heeft:"
    echo "'mailtrap_forward_email' => env('MAILTRAP_FORWARD_EMAIL'),"
    echo ""
else
    echo -e "${GREEN}✅ Config werkt correct: $TESTED_EMAIL${NC}"
fi
echo ""

# Stap 6: Controleer mailable bestanden
echo -e "${BLUE}📋 Stap 6: Controleer mailable bestanden${NC}"
echo "-------------------------------------------"
MAILABLES=(
    "app/Mail/ContactFormMail.php"
    "app/Mail/NewOrderMail.php"
    "app/Mail/OrderPaidMail.php"
)

for mailable in "${MAILABLES[@]}"; do
    if [ -f "$mailable" ]; then
        if grep -q "config('mail.mailtrap_forward_email')" "$mailable"; then
            echo -e "${GREEN}✅ $mailable - Gebruikt config()${NC}"
        else
            echo -e "${RED}❌ $mailable - Gebruikt GEEN config()${NC}"
            echo "   Zoek naar deze regel en update:"
            echo "   config('mail.mailtrap_forward_email')"
        fi
    else
        echo -e "${RED}❌ $mailable - NIET GEVONDEN${NC}"
    fi
done
echo ""

# Stap 7: Herstart queue workers
echo -e "${BLUE}🔄 Stap 7: Herstart queue workers${NC}"
echo "-------------------------------------------"
php artisan queue:restart
echo -e "${GREEN}✅ Queue workers herstart${NC}"
echo ""

# Stap 8: Check supervisor status
echo -e "${BLUE}👀 Stap 8: Check supervisor status${NC}"
echo "-------------------------------------------"
if command -v supervisorctl &> /dev/null; then
    SUPERVISOR_STATUS=$(supervisorctl status 2>/dev/null | grep -i queue || echo "Geen queue worker gevonden")
    echo "$SUPERVISOR_STATUS"

    if [[ $SUPERVISOR_STATUS == *"RUNNING"* ]]; then
        echo -e "${GREEN}✅ Supervisor queue worker draait${NC}"
    else
        echo -e "${YELLOW}⚠️  Supervisor queue niet actief - activeer in Cloudways dashboard${NC}"
    fi
else
    echo -e "${YELLOW}⚠️  Supervisorctl niet beschikbaar op deze server${NC}"
fi
echo ""

# Samenvatting
echo "================================================"
echo -e "${BLUE}📊 SAMENVATTING${NC}"
echo "================================================"
echo ""
echo "✅ Alle cache verwijderd (config, cache, routes, views, optimize)"
echo "✅ Queue workers herstart"
echo "✅ Configuratie getest"
echo ""
echo -e "${YELLOW}⚠️  BELANGRIJK:${NC}"
echo "Cloudways cache soms config zelfs NA config:clear"
echo ""
echo -e "${GREEN}OPTIE A - Aanbevolen (Tijdelijke oplossing):${NC}"
echo "Gebruik config:cache om configuratie te forceren:"
echo "  php artisan config:cache"
echo ""
echo -e "${GREEN}OPTIE B - Debug Mode:${NC}"
echo "Als het nog niet werkt, test direct met env():"
echo "  php artisan tinker"
echo "  >>> env('MAILTRAP_FORWARD_EMAIL')"
echo ""
echo "================================================"
echo -e "${BLUE}🧪 TEST NU:${NC}"
echo "================================================"
echo ""
echo "1. Ga naar: https://phplaravel-1560214-6053327.cloudwaysapps.com/contact"
echo "2. Verstuur test email"
echo "3. Check Mailtrap inbox → CC veld"
echo ""
echo "Als CC veld er NIET is, probeer dan:"
echo "  php artisan config:cache"
echo "  php artisan queue:restart"
echo ""

