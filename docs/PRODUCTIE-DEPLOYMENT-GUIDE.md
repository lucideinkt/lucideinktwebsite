# 🚀 PRODUCTIE DEPLOYMENT GUIDE

## 📋 OVERZICHT: WAT VERANDERT IN PRODUCTIE?

### ✅ WAT JE KUNT BEHOUDEN (blijft werken):
- ✅ **Alle mailable classes** (ContactFormMail, OrderPaidMail, etc.)
- ✅ **HasMailtrapForwarding trait** (detecteert automatisch productie)
- ✅ **config/mail.php** (bevat alle configuratie)
- ✅ **Code blijft ongewijzigd** (geen code aanpassingen nodig!)

### 🔄 WAT JE MOET AANPASSEN:
- 🔄 `.env` bestand (SMTP instellingen + environment)
- 🔄 Mailtrap uitzetten
- 🔄 Productie SMTP server instellen (Gmail, SendGrid, Mailgun, etc.)

---

## 🎯 PRODUCTIE .ENV CONFIGURATIE

### 1. APP ENVIRONMENT
```env
APP_ENV=production          ← Van "staging" naar "production"
APP_DEBUG=false            ← BELANGRIJK: false in productie!
APP_URL=https://jouw-productie-domein.nl
```

### 2. MAIL CONFIGURATIE

#### Optie A: Gmail SMTP (gratis voor kleine volumes)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=jouw-email@gmail.com
MAIL_PASSWORD=jouw-app-wachtwoord  # Niet je normale wachtwoord!
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@lucideinkt.nl"
MAIL_FROM_NAME="${APP_NAME}"

# ❌ VERWIJDER OF COMMENT UIT:
# MAILTRAP_FORWARD_EMAIL="lucideinkt@gmail.com"
```

**Gmail App Password aanmaken:**
1. Ga naar Google Account → Security
2. Enable 2-Factor Authentication
3. Zoek "App passwords"
4. Genereer nieuw app password voor "Mail"
5. Gebruik deze 16-character code in `MAIL_PASSWORD`

---

#### Optie B: SendGrid (aanbevolen voor professie)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=jouw-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@lucideinkt.nl"
MAIL_FROM_NAME="${APP_NAME}"

# ❌ VERWIJDER OF COMMENT UIT:
# MAILTRAP_FORWARD_EMAIL="lucideinkt@gmail.com"
```

**SendGrid Setup:**
1. Maak account op sendgrid.com (gratis tot 100 emails/dag)
2. Verify je domein (lucideinkt.nl)
3. Genereer API key
4. Gebruik API key als `MAIL_PASSWORD`

---

#### Optie C: Mailgun
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=postmaster@jouw-domein.nl
MAIL_PASSWORD=jouw-mailgun-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@lucideinkt.nl"
MAIL_FROM_NAME="${APP_NAME}"

# ❌ VERWIJDER OF COMMENT UIT:
# MAILTRAP_FORWARD_EMAIL="lucideinkt@gmail.com"
```

---

#### Optie D: Eigen Mail Server (TransIP, Mijndomein, etc.)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.jouw-hosting-provider.nl
MAIL_PORT=587  # Of 465 voor SSL
MAIL_USERNAME=info@lucideinkt.nl
MAIL_PASSWORD=jouw-email-wachtwoord
MAIL_ENCRYPTION=tls  # Of ssl voor port 465
MAIL_FROM_ADDRESS="info@lucideinkt.nl"
MAIL_FROM_NAME="${APP_NAME}"

# ❌ VERWIJDER OF COMMENT UIT:
# MAILTRAP_FORWARD_EMAIL="lucideinkt@gmail.com"
```

---

## 🔒 HOE DE TRAIT WERKT IN PRODUCTIE

### In Staging/Local (zoals nu):
```php
app()->environment('staging', 'local', 'development')  // TRUE
↓
Triple fallback actief:
1. config('mail.mailtrap_forward_email')
2. env('MAILTRAP_FORWARD_EMAIL')
3. Hardcoded: 'lucideinkt@gmail.com' ← GEBRUIKT DIT
↓
Resultaat: CC veld met lucideinkt@gmail.com
```

### In Productie (APP_ENV=production):
```php
app()->environment('staging', 'local', 'development')  // FALSE
↓
Alleen config en env worden geprobeerd:
1. config('mail.mailtrap_forward_email')  // null (niet ingesteld)
2. env('MAILTRAP_FORWARD_EMAIL')         // null (niet ingesteld)
3. Hardcoded fallback wordt NIET gebruikt  ← VEILIG!
↓
Resultaat: GEEN CC veld, emails gaan alleen naar echte ontvangers
```

**VEILIGHEID GEGARANDEERD:** 
- ✅ Hardcoded email werkt ALLEEN in staging/local
- ✅ In productie wordt het nooit gebruikt
- ✅ Je kunt de code gewoon laten staan!

---

## 📋 PRODUCTIE DEPLOYMENT CHECKLIST

### Stap 1: .env Aanpassen
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL=https://jouw-productie-domein.nl`
- [ ] SMTP settings van je gekozen provider
- [ ] `MAILTRAP_FORWARD_EMAIL` verwijderd of gecomment

### Stap 2: Mollie API Key Wijzigen
```env
# Van test naar live key:
MOLLIE_KEY=live_jouwlivekeyhier  # i.p.v. test_...
```

### Stap 3: Webhook URLs Aanpassen
```env
# Gebruik de productie URL:
WEBHOOK_URL_PRODUCTION=https://jouw-productie-domein.nl/webhooks/mollie
```

### Stap 4: MyParcel URL Aanpassen
```env
MYPARCEL_URL_PRODUCTION=https://jouw-productie-domein.nl/
```

### Stap 5: Database Configuratie
```env
DB_CONNECTION=mysql
DB_HOST=jouw-productie-db-host
DB_PORT=3306
DB_DATABASE=jouw_productie_database
DB_USERNAME=jouw_productie_user
DB_PASSWORD=jouw_productie_wachtwoord
```

### Stap 6: Queue Configuration
```env
# Op productie vaak Redis in plaats van database:
QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### Stap 7: Cache Configuration
```env
# Op productie vaak Redis in plaats van database:
CACHE_STORE=redis
```

### Stap 8: Deploy Commando's
```bash
# Upload alle bestanden
# SSH naar productie server
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
php artisan migrate --force
php artisan queue:restart
```

---

## 🧪 PRODUCTIE TESTS

### Test 1: Controleer Environment
```bash
php artisan tinker
>>> app()->environment()
# Moet zijn: "production"
```

### Test 2: Controleer Mailtrap Forwarding (moet uit zijn)
```bash
php artisan tinker
>>> (new \App\Mail\ContactFormMail('Test', 'test@test.com', 'NL', 'Test', 'Test'))->testForwardingEmail()
```

**Verwacht resultaat:**
```php
[
  "final_email" => null,          ← GEEN forwarding email
  "method_used" => "none",        ← Geen methode actief
  "app_env" => "production",      ← Productie environment
  "config_value" => null,         ← Niet ingesteld
  "env_value" => null,            ← Niet ingesteld
  "hardcoded_fallback" => null,   ← NIET actief in productie!
]
```

✅ **Dit is CORRECT voor productie!**

### Test 3: Test Echte Email
1. Verstuur test email via contactformulier
2. Email moet aankomen bij `LUCIDE_INKT_MAIL` (info@lucideinkt.nl)
3. **GEEN CC veld** (geen forwarding)
4. Email komt aan in echte inbox (niet Mailtrap)

---

## 📊 VERGELIJKING: STAGING vs PRODUCTIE

| Setting | Staging | Productie |
|---------|---------|-----------|
| `APP_ENV` | `staging` | `production` |
| `APP_DEBUG` | `true` | `false` |
| `MAIL_HOST` | `sandbox.smtp.mailtrap.io` | `smtp.gmail.com` (of andere) |
| `MAILTRAP_FORWARD_EMAIL` | `"lucideinkt@gmail.com"` | ❌ Verwijderd |
| Hardcoded fallback | ✅ Actief | ❌ Niet actief |
| CC veld in emails | ✅ Ja | ❌ Nee |
| Emails naar | Mailtrap | Echte ontvangers |
| `MOLLIE_KEY` | `test_...` | `live_...` |

---

## 🎯 WELKE SMTP PROVIDER KIEZEN?

### Gmail (Gratis)
**Voor:**
- ✅ Gratis
- ✅ Makkelijk te configureren
- ✅ Betrouwbaar

**Tegen:**
- ❌ Max 500 emails/dag
- ❌ Kan als spam gemarkeerd worden
- ❌ Minder professioneel

**Geschikt voor:** Kleine webshops (<50 orders/dag)

---

### SendGrid (Aanbevolen)
**Voor:**
- ✅ 100 emails/dag gratis
- ✅ Zeer professioneel
- ✅ Goede deliverability
- ✅ Analytics & tracking
- ✅ Makkelijk op te schalen

**Tegen:**
- ⚠️ Vereist domein verificatie
- ⚠️ Betaald bij meer volume

**Geschikt voor:** Professionele webshops

---

### Mailgun
**Voor:**
- ✅ Eerste 5000 emails/maand gratis (3 maanden)
- ✅ Zeer betrouwbaar
- ✅ Goede API
- ✅ Goed voor developers

**Tegen:**
- ⚠️ Betaald na trial
- ⚠️ Complex voor beginners

**Geschikt voor:** Groeiende webshops

---

### Eigen Mail Server
**Voor:**
- ✅ Volledige controle
- ✅ Vaak al beschikbaar bij hosting

**Tegen:**
- ❌ Vaak slechte deliverability
- ❌ Kan spam problemen geven
- ❌ Moeilijker te configureren

**Geschikt voor:** Als je eigen mail server goed ingesteld is

---

## 💡 MIJN AANBEVELING VOOR LUCIDE INKT

### Voor Nu (Staging):
✅ **Huidige setup blijven gebruiken:**
- Mailtrap voor alle emails
- Forward naar lucideinkt@gmail.com
- Perfecte test setup!

### Voor Productie (Live):
✅ **SendGrid gebruiken:**
1. Gratis starten (100 emails/dag)
2. Domein verificatie opzetten (lucideinkt.nl)
3. SPF/DKIM records toevoegen voor goede deliverability
4. Opschalen indien nodig (betaald plan)

**Waarom SendGrid?**
- ✅ Professioneel
- ✅ Betrouwbaar
- ✅ Goede deliverability (emails komen aan!)
- ✅ Gratis tier voldoende voor start
- ✅ Makkelijk op te schalen

---

## 🔧 PRODUCTIE .ENV VOORBEELD (SendGrid)

```env
# === APP ===
APP_NAME="Lucide Inkt"
APP_ENV=production                    ← PRODUCTIE!
APP_KEY=base64:jouwproductiekey...
APP_DEBUG=false                       ← DEBUG UIT!
APP_URL=https://lucideinkt.nl

APP_LOCALE=nl
APP_FALLBACK_LOCALE=en

# === DATABASE ===
DB_CONNECTION=mysql
DB_HOST=jouw-productie-db-host
DB_PORT=3306
DB_DATABASE=jouw_productie_db
DB_USERNAME=jouw_productie_user
DB_PASSWORD=jouw_sterke_wachtwoord

# === QUEUE & CACHE ===
QUEUE_CONNECTION=redis
CACHE_STORE=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# === MAIL (SendGrid) ===
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=SG.jouw_sendgrid_api_key_hier
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@lucideinkt.nl"
MAIL_FROM_NAME="${APP_NAME}"

# ❌ MAILTRAP FORWARDING UITGESCHAKELD IN PRODUCTIE
# MAILTRAP_FORWARD_EMAIL="lucideinkt@gmail.com"

LUCIDE_INKT_MAIL="info@lucideinkt.nl"

# === MOLLIE (LIVE) ===
MOLLIE_KEY=live_jouw_live_key_hier
WEBHOOK_URL_PRODUCTION=https://lucideinkt.nl/webhooks/mollie

# === MYPARCEL ===
MYPARCEL_API_KEY=jouw_api_key
MYPARCEL_URL_PRODUCTION=https://lucideinkt.nl/
```

---

## ⚠️ BELANGRIJKE WARNINGS PRODUCTIE

### 1. NOOIT Debug Mode in Productie
```env
APP_DEBUG=false  # ALTIJD false in productie!
```
Anders zien bezoekers alle errors en database info!

### 2. Verwijder Mailtrap Forwarding
```env
# MAILTRAP_FORWARD_EMAIL="lucideinkt@gmail.com"  # Comment uit!
```

### 3. Gebruik Live Mollie Key
```env
MOLLIE_KEY=live_...  # Niet test_...
```

### 4. Cache Configuratie
```bash
# Productie moet altijd gecached zijn voor performance:
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 5. HTTPS Verplicht
```env
APP_URL=https://lucideinkt.nl  # Niet http://
```

---

## 🎉 SAMENVATTING

### Wat je KUNT laten staan (geen wijzigingen nodig):
- ✅ Alle PHP code (mailable classes, trait, etc.)
- ✅ config/mail.php bestand
- ✅ Controllers en models
- ✅ Views

### Wat je MOET aanpassen:
- 🔄 `.env` bestand (SMTP + environment settings)
- 🔄 Mollie key (van test naar live)
- 🔄 Webhook URLs
- 🔄 Database credentials

### De Trait Is Veilig:
```php
// In productie doet de trait automatisch NIETS met forwarding
// Geen code wijzigingen nodig!
if (app()->environment('staging', 'local', 'development')) {
    return 'lucideinkt@gmail.com';  // ← ALLEEN in staging!
}
```

**Je code is production-ready! Alleen .env aanpassen en je bent klaar!** ✅

---

**Vragen? Check de volledige documentatie of test eerst alles uitgebreid op staging!** 🚀

