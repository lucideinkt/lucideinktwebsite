# Standalone Bibliotheek Drop-in (Laravel)

This folder contains a full bibliotheek + HTML reader module you can copy into a **fresh Laravel installation**.

## What is included

- `app/Http/Controllers/OnlineLezenController.php`
- `app/Models/Product.php`
- `app/Models/BookPage.php`
- `resources/views/online-lezen.blade.php`
- `resources/views/online-lezen-html-reader.blade.php`
- `resources/js/main.js`
- `resources/js/features/reader-book.js`
- `resources/css/front-end-style.css`
- `resources/css/bookshelf.css`
- `resources/css/reader-book.css`
- `resources/css/front-end-components/cookie-consent.css`
- required fonts in `resources/fonts/`
- required images in `public/images/`
- migrations in `database/migrations/`
- seeders in `database/seeders/`
- routes in `routes/web.php`
- `config/book_toc.php`
- `vite.config.js`

## Install into a fresh Laravel app

Assume fresh app path is `/absolute/path/to/FreshLaravel`.

```bash
cd /Users/bilalvanloon/Herd/LucideInktWebshop/standalone-bibliotheek-dropin
chmod +x scripts/install-into-fresh-laravel.sh
./scripts/install-into-fresh-laravel.sh /absolute/path/to/FreshLaravel
```

Then in the fresh Laravel app:

```bash
cd /absolute/path/to/FreshLaravel
composer install
npm install
php artisan key:generate
php artisan migrate:fresh --seed
npm run build
php artisan serve
```

For local watch mode:

```bash
cd /absolute/path/to/FreshLaravel
npm run dev
```

## Notes

- This drop-in is intentionally standalone and does not depend on webshop cart/checkout logic.
- `Product` and `BookPage` schema are minimal for reader functionality.
- The copied bibliotheek blade still includes `<x-cookie-consent />`; this drop-in adds a placeholder component in `resources/views/components/cookie-consent.blade.php`.
- Seeder slugs are aligned to the page seeders for Natuur and Broederschap.

