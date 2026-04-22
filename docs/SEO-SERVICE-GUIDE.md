# SEO Service - Centralized SEO Management

## Overview

The `SEOService` provides a centralized, maintainable way to manage SEO metadata across your entire application. Instead of manually creating `SEOData` objects in every controller, all SEO configurations are stored in one place.

## Features

✅ **Centralized Configuration** - All SEO data in one file  
✅ **Easy to Maintain** - Update SEO in one place instead of hunting through controllers  
✅ **Consistent Structure** - Ensures all pages follow the same SEO pattern  
✅ **Type Safety** - Proper escaping of special characters  
✅ **Reusable** - Dynamic product SEO generation  
✅ **Override Support** - Can override specific fields when needed

## File Structure

```
app/
├── Services/
│   └── SEOService.php       # Centralized SEO configuration
└── Http/
    └── Controllers/
        ├── PageController.php
        ├── ShopController.php
        └── OnlineLezenController.php
```

## Usage

### 1. Static Pages (Simple)

For static pages, just pass the page identifier:

```php
use App\Services\SEOService;

class PageController extends Controller
{
    public function saidNursi(): View
    {
        return view('saidnursi', [
            'SEOData' => SEOService::getPageSEO('saidnursi'),
        ]);
    }
}
```

### 2. Static Pages with Override

If you need to override specific fields:

```php
return view('page', [
    'SEOData' => SEOService::getPageSEO('home', [
        'title' => 'Custom Title Override',
        'description' => 'Custom description',
    ]),
]);
```

### 3. Dynamic Product Pages

For product-specific SEO:

```php
$product = Product::findOrFail($id);

return view('product-page', [
    'product' => $product,
    'SEOData' => SEOService::getProductSEO($product),
]);
```

For product pages in different contexts (shop vs online reader):

```php
// For shop product page
SEOService::getProductSEO($product, 'shop');

// For online reader
SEOService::getProductSEO($product, 'online-lezen');
```

## Adding New Pages

To add SEO for a new page, simply add it to the `$pages` array in `SEOService::getPageConfig()`:

```php
private static function getPageConfig(string $page): array
{
    $pages = [
        // ...existing pages...
        
        'nieuwe-pagina' => [
            'title' => 'Nieuwe Pagina | Lucide Inkt',
            'description' => 'Beschrijving van de nieuwe pagina.',
            'url' => route('nieuwe-pagina'),
            'image' => secure_url('images/nieuwe-pagina.webp'),
            'type' => 'article', // or 'website'
        ],
    ];
    
    return $pages[$page] ?? [];
}
```

Then in your controller:

```php
public function nieuwePagina(): View
{
    return view('nieuwe-pagina', [
        'SEOData' => SEOService::getPageSEO('nieuwe-pagina'),
    ]);
}
```

## Available Page Identifiers

Currently configured pages:

- `home` - Homepage
- `saidnursi` - Said Nursi biography page
- `risale` - Risale-i Nur information page
- `herzameling` - Herzameling traktaat page
- `contact` - Contact page
- `shop` - Shop index page
- `online-lezen` - Online reading library

## SEO Data Fields

Each page configuration can include:

| Field | Type | Description | Required |
|-------|------|-------------|----------|
| `title` | string | Page title (shown in browser tab and search results) | Yes |
| `description` | string | Meta description (shown in search results) | Yes |
| `url` | string | Canonical URL of the page | Yes |
| `image` | string | Open Graph image for social sharing | No |
| `author` | string | Content author | No |
| `locale` | string | Language locale (default: 'nl_NL') | No |
| `site_name` | string | Site name (default: 'Lucide Inkt') | No |
| `type` | string | Page type: 'website' or 'article' | No |

## Best Practices

### 1. Escaping Special Characters

When adding descriptions with apostrophes, escape them properly:

```php
// ✅ CORRECT
'description' => 'De Qur\'an is een spirituele zon.',

// ❌ WRONG - Will break the string
'description' => 'De Qur'an is een spirituele zon.',
```

### 2. Image URLs

Always use `secure_url()` for images to ensure HTTPS:

```php
'image' => secure_url('images/my-image.webp'),
```

### 3. Page Types

- Use `'type' => 'website'` for functional pages (home, shop, contact)
- Use `'type' => 'article'` for content pages (blog posts, articles, book descriptions)

### 4. Descriptions

- Keep descriptions between 150-160 characters for optimal display in search results
- Make them compelling and action-oriented
- Include relevant keywords naturally

### 5. Titles

- Format: `Page Name | Site Name`
- Keep under 60 characters when possible
- Put most important keywords first

## Benefits Over Previous Approach

### Before (Scattered in Controllers)
```php
// PageController.php
public function saidNursi(): View
{
    return view('saidnursi', [
        'SEOData' => new SEOData(
            title: 'Lucide Inkt | Bediüzzaman Said Nursi',
            description: 'Ik zal de wereld bewijzen...',
            url: route('saidnursi'),
            image: secure_url('images/said_nursi_sharp.jpg'),
            author: 'Lucide Inkt',
            locale: 'nl_NL',
            site_name: 'Lucide Inkt',
            type: 'article',
        ),
    ]);
}
```

❌ Problems:
- SEO data scattered across multiple controllers
- Hard to maintain and update
- Risk of typos in repeated fields
- Difficult to ensure consistency

### After (Centralized Service)
```php
// PageController.php
public function saidNursi(): View
{
    return view('saidnursi', [
        'SEOData' => SEOService::getPageSEO('saidnursi'),
    ]);
}

// All SEO configs in one place: SEOService.php
```

✅ Benefits:
- All SEO data in one file
- Easy to update all pages at once
- Consistent structure enforced
- Less code in controllers
- Easier to test and maintain

## Testing SEO

After adding or updating SEO data:

1. **Clear Caches:**
   ```bash
   php artisan optimize:clear
   ```

2. **View Page Source:**
   - Visit the page in browser
   - Right-click → "View Page Source" (or Ctrl+U)
   - Search for `<meta name="description"`
   - Verify all meta tags are correct

3. **Test with Tools:**
   - [Facebook Sharing Debugger](https://developers.facebook.com/tools/debug/)
   - [Twitter Card Validator](https://cards-dev.twitter.com/validator)
   - [LinkedIn Post Inspector](https://www.linkedin.com/post-inspector/)

## Troubleshooting

### Issue: SEO not updating
**Solution:** Clear all caches
```bash
php artisan optimize:clear
```

### Issue: Description showing fallback
**Solution:** 
1. Check the page identifier matches exactly in `getPageConfig()`
2. Verify apostrophes are escaped: `Qur\'an` not `Qur'an`
3. Check the SEOData is being passed to the view

### Issue: Images not showing in social previews
**Solution:**
1. Ensure using `secure_url()` not `url()`
2. Verify image path is correct and publicly accessible
3. Image should be at least 1200x630px for best results

## Future Enhancements

Consider adding:

- Multi-language support (EN/NL)
- Schema.org structured data
- Dynamic title suffixes based on language
- SEO data validation
- Admin panel for non-technical SEO updates

## Example: Full Controller

```php
<?php

namespace App\Http\Controllers;

use App\Services\SEOService;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'SEOData' => SEOService::getPageSEO('home'),
        ]);
    }

    public function saidNursi(): View
    {
        return view('saidnursi', [
            'SEOData' => SEOService::getPageSEO('saidnursi'),
        ]);
    }
    
    // More methods...
}
```

Clean, simple, maintainable! 🎉

