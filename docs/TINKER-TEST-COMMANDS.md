# 🧪 TINKER TEST COMMANDO'S - Mailtrap Forwarding

## ✅ JUISTE TEST COMMANDO'S

### Test 1: Simpele test (retourneert alleen email)
```php
php artisan tinker
>>> (new \App\Mail\ContactFormMail('Test', 'test@test.com', 'NL', 'Test', 'Test'))->getForwardingEmail()
```
**Verwacht resultaat:** `"lucideinkt@gmail.com"`

---

### Test 2: Uitgebreide debug test (toont alle details)
```php
php artisan tinker
>>> (new \App\Mail\ContactFormMail('Test', 'test@test.com', 'NL', 'Test', 'Test'))->testForwardingEmail()
```

**Verwacht resultaat:**
```php
=> [
     "final_email" => "lucideinkt@gmail.com",
     "method_used" => "config",  // Of "env" of "hardcoded"
     "app_env" => "local",
     "config_value" => "lucideinkt@gmail.com",
     "env_value" => "lucideinkt@gmail.com",
     "hardcoded_fallback" => "lucideinkt@gmail.com",
   ]
```

---

## 📊 INTERPRETATIE RESULTATEN

### Scenario 1: Config werkt (ideaal)
```php
"method_used" => "config"
"config_value" => "lucideinkt@gmail.com"
```
✅ **PERFECT!** Config is correct geladen.

### Scenario 2: Env werkt (fallback)
```php
"method_used" => "env"
"config_value" => null
"env_value" => "lucideinkt@gmail.com"
```
⚠️ **WERKT maar niet ideaal.** Config cache heeft een probleem, maar env() werkt als fallback.

### Scenario 3: Hardcoded werkt (laatste redmiddel)
```php
"method_used" => "hardcoded"
"config_value" => null
"env_value" => null
"hardcoded_fallback" => "lucideinkt@gmail.com"
```
⚠️ **WERKT maar check .env!** Noch config noch env werkt, gebruikt hardcoded fallback.

### Scenario 4: Niets werkt (FOUT in productie)
```php
"method_used" => "none"
"final_email" => null
"app_env" => "production"
```
❌ **PROBLEEM!** Geen enkele methode werkt. Check `.env` bestand.

---

## 🚀 CLOUDWAYS TEST COMMANDO'S

Na upload en cache clear op Cloudways:

```bash
cd applications/phplaravel-1560214-6053327/public_html
php artisan tinker
```

### Snelle test:
```php
>>> (new \App\Mail\ContactFormMail('Test', 'test@test.com', 'NL', 'Test', 'Test'))->getForwardingEmail()
```

### Debug test:
```php
>>> $result = (new \App\Mail\ContactFormMail('Test', 'test@test.com', 'NL', 'Test', 'Test'))->testForwardingEmail()
>>> print_r($result)
```

### Exit tinker:
```php
>>> exit
```

---

## 🔍 TROUBLESHOOTING

### Als je `null` krijgt op Cloudways:

**Check app environment:**
```php
>>> app()->environment()
```
Moet zijn: `"staging"` of `"local"` (niet `"production"`)

**Check env waarde direct:**
```php
>>> env('MAILTRAP_FORWARD_EMAIL')
```
Moet zijn: `"lucideinkt@gmail.com"`

**Check config waarde direct:**
```php
>>> config('mail.mailtrap_forward_email')
```
Moet zijn: `"lucideinkt@gmail.com"` (of `null` als cache probleem)

**Check .env bestand op server:**
```bash
grep MAILTRAP_FORWARD_EMAIL .env
```
Moet tonen: `MAILTRAP_FORWARD_EMAIL="lucideinkt@gmail.com"`

---

## ✅ ALLE TESTS

### Lokaal testen (voor upload):
```bash
php artisan tinker
>>> (new \App\Mail\ContactFormMail('Test', 'test@test.com', 'NL', 'Test', 'Test'))->testForwardingEmail()
>>> exit
```

### Cloudways testen (na upload):
```bash
ssh master@your-server-ip
cd applications/phplaravel-1560214-6053327/public_html
php artisan config:clear
php artisan tinker
>>> (new \App\Mail\ContactFormMail('Test', 'test@test.com', 'NL', 'Test', 'Test'))->testForwardingEmail()
>>> exit
```

### Echte email test:
1. Ga naar contactformulier op website
2. Verstuur test email
3. Check Mailtrap inbox → CC veld
4. Check Gmail inbox → Doorgestuurde email

---

## 📋 VERWACHTE FLOW

### 1. Lokaal (development)
```
method_used: "config" (of "env" of "hardcoded")
final_email: "lucideinkt@gmail.com"
✅ Werkt
```

### 2. Cloudways staging
```
method_used: "config" (ideaal) of "env" (fallback) of "hardcoded" (noodoplossing)
final_email: "lucideinkt@gmail.com"
✅ Werkt (minstens 1 van de 3 methodes)
```

### 3. Productie (later)
```
MAILTRAP_FORWARD_EMAIL niet ingesteld in .env
method_used: "none"
final_email: null
✅ Correct! Geen forwarding in productie
```

---

## 💡 TIPS

**Voor Cloudways debug:**
```bash
# Alle waarden tegelijk checken
php artisan tinker --execute="
\$mail = new \App\Mail\ContactFormMail('Test', 'test@test.com', 'NL', 'Test', 'Test');
print_r(\$mail->testForwardingEmail());
"
```

**Voor snelle verificatie:**
```bash
# One-liner check
php artisan tinker --execute="echo (new \App\Mail\ContactFormMail('Test', 'test@test.com', 'NL', 'Test', 'Test'))->getForwardingEmail();"
```

---

## 🎯 SUCCESS CRITERIA

✅ `getForwardingEmail()` retourneert `"lucideinkt@gmail.com"`  
✅ `testForwardingEmail()` toont `method_used` (niet "none")  
✅ Test email via website heeft CC veld in Mailtrap  
✅ Gmail ontvangt doorgestuurde email  

**Als alle 4 criteria kloppen = PERFECT!** 🎉

