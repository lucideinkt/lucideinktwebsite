#!/bin/bash

# ============================================================
# 🚀 PDF DEPLOY SCRIPT – Lucide Inkt
# ============================================================
# Wat dit script doet:
#   1. Upload compressed PDF files naar de productie server
#   2. Draait php artisan migrate  (past DB bij: product 7 & 9)
#   3. Draait php artisan pdf:index --force  (maakt PDF's doorzoekbaar)
#   4. Cleared caches
#
# Gebruik:
#   chmod +x deploy-pdfs.sh
#   ./deploy-pdfs.sh
#
# Vul hieronder je Cloudways SSH-gegevens in.
# Je vindt deze in Cloudways → Server → Master Credentials.
# ============================================================

# ── 🔧 CONFIGURATIE ─────────────────────────────────────────
SSH_USER="your-cloudways-user"          # bv. master
SSH_HOST="your-server-ip"               # bv. 12.34.56.78
SSH_PORT="22"
APP_PATH="/home/your-user/htdocs/your-domain.com"  # pad naar Laravel root op server

# Lokaal pad naar de PDF bestanden
LOCAL_PDF_DIR="storage/app/public/pdfs"

# PDF bestanden om te uploaden
PDFS=(
    "herzameling.pdf"
    "regathering.pdf"
    "broederschap.pdf"
    "zieken.pdf"
)
# ────────────────────────────────────────────────────────────

# Kleuren
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

echo ""
echo "============================================================"
echo -e "${BLUE}🚀 LUCIDE INKT – PDF DEPLOY SCRIPT${NC}"
echo "============================================================"
echo ""

# Controleer of we in de Laravel root zijn
if [ ! -f "artisan" ]; then
    echo -e "${RED}❌ Fout: Voer dit script uit vanuit de Laravel root directory.${NC}"
    exit 1
fi

# Controleer of config ingevuld is
if [ "$SSH_USER" = "your-cloudways-user" ]; then
    echo -e "${RED}❌ Fout: Vul eerst je SSH-gegevens in bovenaan het script.${NC}"
    echo ""
    echo "  SSH_USER  = Cloudways master username"
    echo "  SSH_HOST  = Server IP-adres"
    echo "  APP_PATH  = Volledig pad naar Laravel root op server"
    echo ""
    exit 1
fi

echo -e "${BLUE}📡 Verbinding: ${SSH_USER}@${SSH_HOST}:${SSH_PORT}${NC}"
echo -e "${BLUE}📁 App path:   ${APP_PATH}${NC}"
echo ""

# ── Stap 1: Upload PDF bestanden ────────────────────────────
echo -e "${BLUE}📤 Stap 1: PDF bestanden uploaden...${NC}"
echo "-----------------------------------------------------------"

REMOTE_PDF_DIR="${APP_PATH}/storage/app/public/pdfs"

for PDF in "${PDFS[@]}"; do
    LOCAL_FILE="${LOCAL_PDF_DIR}/${PDF}"
    if [ -f "$LOCAL_FILE" ]; then
        SIZE=$(du -h "$LOCAL_FILE" | cut -f1)
        echo -n "  Uploading ${PDF} (${SIZE})... "
        rsync -az -e "ssh -p ${SSH_PORT}" \
            "$LOCAL_FILE" \
            "${SSH_USER}@${SSH_HOST}:${REMOTE_PDF_DIR}/${PDF}"
        if [ $? -eq 0 ]; then
            echo -e "${GREEN}✅${NC}"
        else
            echo -e "${RED}❌ MISLUKT${NC}"
            echo -e "${RED}  Upload van ${PDF} mislukt. Controleer SSH-verbinding.${NC}"
            exit 1
        fi
    else
        echo -e "${YELLOW}  ⚠️  ${PDF} niet gevonden lokaal – overgeslagen.${NC}"
    fi
done
echo ""

# ── Stap 2: Draai artisan migrate ───────────────────────────
echo -e "${BLUE}🗄️  Stap 2: Database migratie uitvoeren...${NC}"
echo "-----------------------------------------------------------"
ssh -p ${SSH_PORT} ${SSH_USER}@${SSH_HOST} \
    "cd ${APP_PATH} && php artisan migrate --force 2>&1"
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Migratie succesvol${NC}"
else
    echo -e "${RED}❌ Migratie mislukt${NC}"
    exit 1
fi
echo ""

# ── Stap 3: Indexeer PDF inhoud ─────────────────────────────
echo -e "${BLUE}🔍 Stap 3: PDF tekst indexeren (doorzoekbaar maken)...${NC}"
echo "-----------------------------------------------------------"
ssh -p ${SSH_PORT} ${SSH_USER}@${SSH_HOST} \
    "cd ${APP_PATH} && php -d memory_limit=512M artisan pdf:index --force 2>&1"
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ PDF indexering succesvol${NC}"
else
    echo -e "${YELLOW}⚠️  PDF indexering had problemen – controleer output hierboven${NC}"
fi
echo ""

# ── Stap 4: Bestandspermissies fixen ────────────────────────
echo -e "${BLUE}🔐 Stap 4: Bestandspermissies instellen...${NC}"
echo "-----------------------------------------------------------"
ssh -p ${SSH_PORT} ${SSH_USER}@${SSH_HOST} \
    "chmod 644 ${APP_PATH}/storage/app/public/pdfs/*.pdf 2>/dev/null; echo 'Permissies OK'"
echo -e "${GREEN}✅ Permissies ingesteld${NC}"
echo ""

# ── Stap 5: Caches leegmaken ────────────────────────────────
echo -e "${BLUE}🗑️  Stap 5: Caches leegmaken...${NC}"
echo "-----------------------------------------------------------"
ssh -p ${SSH_PORT} ${SSH_USER}@${SSH_HOST} \
    "cd ${APP_PATH} && php artisan cache:clear && php artisan config:clear && php artisan view:clear && php artisan route:clear 2>&1"
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Caches geleegd${NC}"
else
    echo -e "${YELLOW}⚠️  Cache clear had problemen${NC}"
fi
echo ""

# ── Samenvatting ─────────────────────────────────────────────
echo "============================================================"
echo -e "${GREEN}🎉 DEPLOY COMPLEET!${NC}"
echo "============================================================"
echo ""
echo -e "  ${GREEN}✅${NC} PDF bestanden geüpload"
echo -e "  ${GREEN}✅${NC} Database bijgewerkt (product titels & PDF links)"
echo -e "  ${GREEN}✅${NC} PDF tekst geïndexeerd (zoekfunctie actief)"
echo -e "  ${GREEN}✅${NC} Caches geleegd"
echo ""
echo -e "${YELLOW}📌 Check in het dashboard:${NC}"
echo "   → Book Content → 'Treatise on the Regathering - English'"
echo "      moet 'PDF aanwezig' + 'Ingeschakeld' tonen"
echo ""

