# ⚡ QUICK REFERENCE - Productie Deployment

## 🎯 WAT JE MOET DOEN VOOR PRODUCTIE

### 1. .env Aanpassingen (VERPLICHT)

```env
# Environment
APP_ENV=production          ← staging → production
APP_DEBUG=false            ← true → false
APP_URL=https://jouw-domein.nl

# Mail (kies je provider)
MAIL_HOST=smtp.sendgrid.net      ← mailtrap → sendgrid (of andere)
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=jouw-api-key

# Mailtrap forwarding UIT
# MAILTRAP_FORWARD_EMAIL="lucideinkt@gmail.com"  ← Comment uit of verwijder!

# Mollie Live
MOLLIE_KEY=live_jouwkey     ← test_ → live_
```

---

## ✅ WAT JE KUNT LATEN (geen wijzigingen)

```
✅ Alle mailable classes (ContactFormMail.php, etc.)
✅ HasMailtrapForwarding trait
✅ config/mail.php
✅ Controllers
✅ Models
✅ Views
✅ Routes
```

**De code is al production-ready!** 🎉

---

## 🔒 WAAROM DE TRAIT VEILIG IS

```php
// De trait checkt automatisch het environment:
if (app()->environment('staging', 'local', 'development')) {
    return 'lucideinkt@gmail.com';  // ← ALLEEN in staging!
}

// In productie:
app()->environment('production')  // TRUE
↓
Hardcoded email wordt NIET gebruikt
↓
Geen CC veld, emails gaan alleen naar echte ontvangers ✅
```

---

## 📧 SMTP PROVIDERS (kies er één)

### Gmail (Gratis, eenvoudig)
```env
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=jouw@gmail.com
MAIL_PASSWORD=app-wachtwoord  # Niet je normale wachtwoord!
MAIL_ENCRYPTION=tls
```
**Limit:** 500 emails/dag

---

### SendGrid (Aanbevolen)
```env
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=SG.jouw_api_key
MAIL_ENCRYPTION=tls
```
**Limit:** 100 emails/dag (gratis), opschaalbaar

---

### Mailgun
```env
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=postmaster@jouw-domein.nl
MAIL_PASSWORD=jouw-mailgun-password
MAIL_ENCRYPTION=tls
```
**Limit:** 5000 emails/maand gratis (3 maanden)

---

### Eigen Mail Server
```env
MAIL_HOST=smtp.jouw-host.nl
MAIL_PORT=587  # Of 465
MAIL_USERNAME=info@lucideinkt.nl
MAIL_PASSWORD=jouw-wachtwoord
MAIL_ENCRYPTION=tls  # Of ssl
```

---

## 🚀 DEPLOYMENT COMMANDO'S

```bash
# 1. Upload alle bestanden naar productie server

# 2. SSH naar server
ssh user@jouw-server

# 3. Navigeer naar applicatie
cd /pad/naar/applicatie

# 4. Cache alles (productie vereist caching!)
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# 5. Migraties draaien
php artisan migrate --force

# 6. Queue herstarten
php artisan queue:restart

# 7. Verify environment
php artisan tinker
>>> app()->environment()
# Moet zijn: "production"
>>> exit
```

---

## 🧪 PRODUCTIE TESTS

### Test 1: Environment Check
```bash
php artisan tinker
>>> app()->environment()
# "production" ✅
```

### Test 2: Mailtrap Forwarding (moet UIT zijn)
```bash
php artisan tinker
>>> (new \App\Mail\ContactFormMail('Test', 'test@test.com', 'NL', 'Test', 'Test'))->testForwardingEmail()
```

**Verwacht:**
```php
[
  "final_email" => null,        ← GEEN forwarding
  "method_used" => "none",      ← Geen CC veld
  "app_env" => "production",    ← Productie!
  "hardcoded_fallback" => null, ← Niet actief ✅
]
```

### Test 3: Verstuur Echte Email
- Contactformulier testen
- Moet aankomen in ECHTE inbox
- GEEN CC veld
- NIET via Mailtrap

---

## ⚠️ PRODUCTIE WARNINGS

```env
# NOOIT in productie:
APP_DEBUG=true          ❌ GEVAARLIJK!
APP_ENV=local           ❌ Moet production zijn
MOLLIE_KEY=test_...     ❌ Moet live_ zijn
MAILTRAP_FORWARD_EMAIL  ❌ Moet uit zijn
```

---

## 📋 DEPLOYMENT CHECKLIST

- [ ] `.env` aangepast (APP_ENV=production, APP_DEBUG=false)
- [ ] SMTP provider geconfigureerd
- [ ] `MAILTRAP_FORWARD_EMAIL` verwijderd/gecomment
- [ ] Mollie live key ingesteld
- [ ] Database credentials correct
- [ ] Bestanden geüpload
- [ ] `php artisan config:cache` uitgevoerd
- [ ] `php artisan route:cache` uitgevoerd
- [ ] `php artisan view:cache` uitgevoerd
- [ ] `php artisan migrate --force` uitgevoerd
- [ ] `php artisan queue:restart` uitgevoerd
- [ ] Environment getest (moet "production" zijn)
- [ ] Mailtrap forwarding getest (moet "none" zijn)
- [ ] Echte email test gedaan

---

## 🎯 STAGING vs PRODUCTIE

| Item | Staging | Productie |
|------|---------|-----------|
| `APP_ENV` | `staging` | `production` |
| `APP_DEBUG` | `true` | `false` |
| `MAIL_HOST` | Mailtrap | SendGrid/Gmail |
| `MAILTRAP_FORWARD_EMAIL` | Set | ❌ Uit |
| Forwarding | ✅ Actief | ❌ Uit |
| `MOLLIE_KEY` | test_ | live_ |
| Cache | Optioneel | Verplicht |

---

## 💡 AANBEVELING

**Voor Lucide Inkt webshop:**
- 🥇 **1e keus:** SendGrid (professioneel, betrouwbaar, gratis start)
- 🥈 **2e keus:** Mailgun (goed voor groei)
- 🥉 **3e keus:** Gmail (alleen voor kleine volume)

**Setup tijd:** ~30 minuten voor SendGrid incl. domein verificatie

---

## 🆘 HULP NODIG?

Zie uitgebreide guide:
- `docs/PRODUCTIE-DEPLOYMENT-GUIDE.md`

---

**Onthoud:** Code hoeft NIET aangepast, alleen .env! 🎉

