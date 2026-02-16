# 🔧 Fix voor Mailtrap Auto-Forwarding op Cloudways

## Probleem Opgelost ✅

De emails werden **niet doorgestuurd** naar `lucideinkt@gmail.com` omdat:
- `env()` functie werkt niet goed met gecachede configuratie op Cloudways
- Oplossing: `config()` functie gebruiken in plaats van `env()`

## Wat is er aangepast?

### 1. Mail Configuratie (`config/mail.php`)
✅ Toegevoegd:
```php
'mailtrap_forward_email' => env('MAILTRAP_FORWARD_EMAIL'),
```

### 2. Alle Mailable Classes
✅ Aangepast van:
```php
$forwardEmail = env('MAILTRAP_FORWARD_EMAIL');
```

✅ Naar:
```php
$forwardEmail = config('mail.mailtrap_forward_email');
```

**Aangepaste bestanden:**
- `app/Mail/ContactFormMail.php`
- `app/Mail/NewOrderMail.php`
- `app/Mail/OrderPaidMail.php`
- `app/Mail/WelcomeMail.php`
- `app/Mail/NewUserMail.php`
- `app/Mail/NewsletterMail.php`

## 🚀 Deployment Stappen voor Cloudways

### Stap 1: Upload de bestanden
Upload via Git of SFTP:
```
config/mail.php
app/Mail/ContactFormMail.php
app/Mail/NewOrderMail.php
app/Mail/OrderPaidMail.php
app/Mail/WelcomeMail.php
app/Mail/NewUserMail.php
app/Mail/NewsletterMail.php
```

### Stap 2: SSH naar Cloudways server
```bash
ssh master@your-server-ip
cd applications/phplaravel-1560214-6053327/public_html
```

### Stap 3: Clear alle caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan queue:restart
```

### Stap 4: Cache de configuratie (optioneel, voor performance)
```bash
php artisan config:cache
```

⚠️ **LET OP:** Na `config:cache` moet je **altijd** `config:clear` draaien als je `.env` aanpast!

### Stap 5: Controleer de configuratie
```bash
php artisan tinker
>>> config('mail.mailtrap_forward_email')
=> "lucideinkt@gmail.com"
```

Als het `null` returnt, voer dan eerst `config:clear` uit.

### Stap 6: Test een email
Ga naar de website en test het contactformulier.

## 📧 Verificatie Checklist

Na deployment, controleer:

1. **Mailtrap Inbox:**
   - [ ] Email ontvangen in Mailtrap
   - [ ] `lucideinkt@gmail.com` zichtbaar in **CC veld**

2. **Gmail Inbox:**
   - [ ] Email doorgestuurd naar `lucideinkt@gmail.com`
   - [ ] Attachments (bijv. factuur PDF) meegestuurd

3. **Mailtrap Dashboard:**
   - [ ] Auto Forwarding Rule actief voor `lucideinkt@gmail.com`

## 🐛 Troubleshooting

### Email niet in CC veld?
```bash
# SSH naar server
php artisan config:clear
php artisan cache:clear
php artisan queue:restart

# Test in tinker
php artisan tinker
>>> config('mail.mailtrap_forward_email')
# Moet returnen: "lucideinkt@gmail.com"
```

### Gmail ontvangt geen emails?
1. Check Mailtrap inbox → Zie je CC veld met `lucideinkt@gmail.com`?
2. Check Gmail spam folder
3. Check Mailtrap dashboard → Auto Forwarding Rules → Status moet "Active" zijn

### Queue werkt niet?
```bash
# Check of supervisor jobs draaien
supervisorctl status

# Restart queue
php artisan queue:restart

# Check failed jobs
php artisan queue:failed
```

### Config cached op Cloudways?
```bash
# Als config gecached is, moet je na ELKE .env wijziging:
php artisan config:clear
php artisan config:cache
```

## 🎯 Test Scenario

1. **Contact Form Test:**
   ```
   - Ga naar: https://phplaravel-1560214-6053327.cloudwaysapps.com/contact
   - Vul formulier in
   - Submit
   - Check Mailtrap → CC moet lucideinkt@gmail.com tonen
   - Check Gmail → Email moet aangekomen zijn
   ```

2. **Order Test:**
   ```
   - Plaats test bestelling
   - Betaal met Mollie (test mode)
   - Check beide emails (OrderPaidMail + NewOrderMail)
   - Beide moeten CC hebben en doorgestuurd worden
   ```

## 📝 Productie Setup (Later)

Wanneer je naar productie gaat:

### Aanpassen in `.env`:
```env
APP_ENV=production
MAIL_HOST=smtp.gmail.com  # Of andere productie SMTP
MAIL_PORT=587
# MAILTRAP_FORWARD_EMAIL=""  ← Verwijderen of leeg laten!
```

De code checkt automatisch of `config('mail.mailtrap_forward_email')` bestaat en valid is. Als het leeg is, wordt er **niets** toegevoegd aan CC.

## ⚠️ Belangrijke Opmerkingen

1. **Gebruik NOOIT `env()` direct in code** - gebruik altijd `config()`
2. **Na elke .env wijziging op Cloudways**: `php artisan config:clear`
3. **Queue restart** na code wijzigingen: `php artisan queue:restart`
4. **Supervisor jobs** moeten draaien op Cloudways voor queue processing

## 🎉 Samenvatting

✅ **Lokaal:** Alle bestanden geüpdatet en getest  
✅ **Config:** `mail.mailtrap_forward_email` toegevoegd  
✅ **Mailable classes:** Gebruiken nu `config()` in plaats van `env()`  
⏳ **Cloudways:** Upload bestanden + clear caches  
⏳ **Test:** Stuur test email en verifieer in Gmail  

**Verwacht resultaat:** Alle emails worden doorgestuurd naar `lucideinkt@gmail.com` ✉️

