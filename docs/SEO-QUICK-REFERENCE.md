# SEO Quick Reference

## Add SEO to a Controller

```php
use App\Services\SEOService;

// For static pages
return view('page', [
    'SEOData' => SEOService::getPageSEO('page-identifier'),
]);

// For product pages
return view('product', [
    'SEOData' => SEOService::getProductSEO($product),
]);
```

## Add New Page SEO Config

Edit `app/Services/SEOService.php` → `getPageConfig()` method:

```php
'page-identifier' => [
    'title' => 'Page Title | Lucide Inkt',
    'description' => 'Page description (150-160 chars)',
    'url' => route('route-name'),
    'image' => secure_url('images/image.webp'),
    'type' => 'article', // or 'website'
],
```

## Available Pages

- `home`
- `saidnursi`
- `risale`
- `herzameling`
- `contact`
- `shop`
- `online-lezen`

## After Changes

```bash
php artisan optimize:clear
```

## Common Issues

| Problem | Solution |
|---------|----------|
| Old SEO showing | Clear cache: `php artisan optimize:clear` |
| Apostrophe breaks text | Escape it: `Qur\'an` not `Qur'an` |
| Image not in social preview | Use `secure_url('images/...')` |

## Test Tools

- Facebook: https://developers.facebook.com/tools/debug/
- Twitter: https://cards-dev.twitter.com/validator
- LinkedIn: https://www.linkedin.com/post-inspector/

