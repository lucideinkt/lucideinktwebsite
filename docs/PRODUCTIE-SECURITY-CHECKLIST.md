# 🔐 Productie Security Checklist

> Gegenereerd: 26 mei 2026 — Controleer dit voor elke deployment naar productie.

---

## ✅ Al geregeld in de codebase

| Item | Status | Toelichting |
|------|--------|-------------|
| `.env` in `.gitignore` | ✅ | Geen secrets in Git |
| `APP_DEBUG` default `false` | ✅ | `config/app.php` defaults naar `false` |
| CSRF-bescherming | ✅ | Actief op alle formulieren; alleen Mollie webhook uitgezonderd |
| Mollie webhook verificatie | ✅ | Gebruikt `mollie->payments->get()` API-check + order ID match |
| Role-based access control | ✅ | `CheckRole` middleware + `authorize()` Policy checks |
| Admin routes beveiligd | ✅ | `auth` + `role:admin` middleware op alle /dashboard/* routes |
| SQL injection | ✅ | Alleen Eloquent ORM; geen user-input in raw queries |
| Mass assignment | ✅ | `$fillable` gedefinieerd; `role` veld **niet** mass-assignable |
| File upload validatie | ✅ | `mimes:`, `max:` validatie in FormRequests |
| Throttle / rate limiting | ✅ | Login: 10/min, checkout: 20/min, newsletter: 3/min, APIs: 60/min |
| Wachtwoord reset bescherming | ✅ | Email enumeration-proof; throttled |
| Password hashing | ✅ | bcrypt via `'password' => 'hashed'` cast |
| Session security | ✅ | `secure: true` in production/staging, `http_only: true`, `same_site: lax` |
| Beveiligingsheaders | ✅ | X-Frame-Options, X-Content-Type, Referrer-Policy, Permissions-Policy, X-XSS-Protection |
| **Content Security Policy** | ✅ | Toegevoegd 26-05-2026 |
| Order eigenaarschap check | ✅ | `showMyOrder` filtert op `customer_id`, factuur check op email |
| Path traversal (audio/PDF) | ✅ | `realpath()` + `startsWith(root)` check |
| Robots.txt productie | ✅ | Automatisch blokkeert alles buiten productie |
| **CVE's packages** | ✅ | `composer audit` meldt 0 kwetsbaarheden (bijgewerkt 26-05-2026) |
| **Huidige wachtwoord verplicht** | ✅ | Profiel wijzigen vereist nu `current_password` |

---

## ⚠️ VERPLICHT op de productieserver instellen

### `.env` op de server

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://jouwdomein.nl

SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

LOG_LEVEL=error   # Niet debug in productie!
```

### Na deployment uitvoeren

```bash
php artisan optimize          # config + routes + views cachen
php artisan migrate --force   # migraties uitvoeren
php artisan storage:link      # public storage symlink
php artisan queue:restart     # queue workers herstarten
```

---

## 📝 Aandachtspunten (geen blockers)

| Item | Risico | Toelichting |
|------|--------|-------------|
| `{!! $page->content !!}` in boeklezer | Laag | Alleen admin kan inhoud invoeren, geen user input |
| `{!! $newsletter->content !!}` in mailtemplates | Laag | Alleen admin kan campagnes aanmaken |
| `payment/success?order=ID` publiek | Laag | Lekt of order bestaat; status is idempotent en veilig |
| CSP `unsafe-inline` voor scripts | Medium | Nodig voor Livewire + inline JS; monitor op toekomstige verbetering |
| Geen e-mailverificatie bij registratie | Laag | `MustVerifyEmail` is uitgecommentarieerd in User model; overweeg activeren |

---

## 🔄 Periodiek bijhouden

- Voer maandelijks `composer audit` uit
- Voer `composer update` uit bij security-patches
- Controleer Mollie API key rotatie
- Controleer MyParcel API key rotatie

