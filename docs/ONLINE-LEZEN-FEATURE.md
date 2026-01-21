# Online Lezen Feature - Documentation

## Overview
The Online Lezen (Online Reading) feature allows users to browse and read books directly on the website using a built-in PDF reader. This creates a library-like experience where visitors can preview or read entire books online.

---

## Features

### 📚 Online Library Page (`/online-lezen`)
- Beautiful grid layout showcasing all available books
- Book cards with cover images
- Hover effects revealing "Lees Online" (Read Online) button
- Category and language information for each book
- Fully responsive design (desktop, tablet, mobile)
- Smooth animations and transitions

### 📖 PDF Reader Page (`/online-lezen/{slug}`)
- Full-screen PDF viewer
- Book information and description
- Call-to-action to purchase the book
- Breadcrumb navigation
- Links back to library and product pages

---

## File Structure

```
app/
├── Http/Controllers/
│   └── OnlineLezenController.php          # Handles library and reader pages
└── Models/
    └── Product.php                         # Updated with pdf_file field

database/
└── migrations/
    └── 2026_01_21_224436_add_pdf_file_to_products_table.php

resources/
├── css/
│   └── front-end-components/
│       └── online-lezen.css                # All styles for the feature
└── views/
    ├── online-lezen.blade.php              # Library page
    ├── online-lezen-reader.blade.php       # PDF reader page
    └── components/
        └── navbar.blade.php                # Updated with menu link

routes/
└── web.php                                 # Routes added
```

---

## Routes

| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/online-lezen` | `onlineLezen` | Display the book library |
| GET | `/online-lezen/{slug}` | `onlineLezenRead` | Display the PDF reader for a specific book |

---

## Database Changes

A new column has been added to the `products` table:

```php
$table->string('pdf_file')->nullable();
```

This stores the path to the PDF file relative to `storage/app/public/`.

---

## How to Use

### 1. Upload PDF Files

#### Option A: Through File Manager
1. Upload your PDF files to `storage/app/public/pdfs/`
2. Make sure the storage is linked: `php artisan storage:link`

#### Option B: Through Admin Panel (Recommended)
You'll need to add a file upload field to the product edit form:

**In `resources/views/products/edit.blade.php`:**

```html
<div class="form-input">
    <label for="pdf_file">PDF Bestand (voor Online Lezen)</label>
    <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf">
    @if($product->pdf_file)
        <p class="current-file">
            Huidig bestand: 
            <a href="{{ asset('storage/' . $product->pdf_file) }}" target="_blank">
                Bekijk PDF
            </a>
        </p>
    @endif
    @error('pdf_file')
        <div class="error">{{ $message }}</div>
    @enderror
</div>
```

**In `app/Http/Controllers/ProductController.php` update method:**

```php
// In the update() method, add:
if ($request->hasFile('pdf_file')) {
    // Delete old PDF if exists
    if ($product->pdf_file) {
        Storage::disk('public')->delete($product->pdf_file);
    }
    
    // Store new PDF
    $path = $request->file('pdf_file')->store('pdfs', 'public');
    $validated['pdf_file'] = $path;
}
```

### 2. Access the Feature

#### For Visitors:
1. Navigate to the main menu
2. Click on "RİSALE-İ NUR" dropdown
3. Select "Online Lezen"
4. Click on any book to read it

#### Direct URLs:
- Library: `https://yoursite.com/online-lezen`
- Specific book: `https://yoursite.com/online-lezen/book-slug`

---

## Styling & Customization

### Colors
The design uses your existing color variables:
- `--main-font-color`: Main text color
- `--ink-2`: Secondary text color
- `--green-2`: Category highlights
- `--red-1`: Primary accent (overlays, CTAs)
- `--surface-1`, `--surface-2`: Background colors

### Animations
- **Hover effects**: Cards lift on hover with smooth transitions
- **Overlay reveal**: Red overlay with "Lees Online" appears on hover
- **Floating icon**: Book icon floats up and down on overlay

### Responsive Breakpoints
- **Desktop**: Full grid with multiple columns
- **Tablet (992px)**: Adjusted spacing and sizing
- **Mobile (768px)**: 2-column grid
- **Small mobile (480px)**: Single column

---

## PDF Viewer Options

The current implementation uses a simple `<iframe>` to display PDFs. For enhanced functionality, consider these alternatives:

### Option 1: PDF.js (Recommended)
Mozilla's PDF.js provides a full-featured PDF viewer with controls:

```bash
npm install pdfjs-dist
```

### Option 2: Google Docs Viewer
Simple iframe solution:
```html
<iframe src="https://docs.google.com/viewer?url=YOUR_PDF_URL&embedded=true"></iframe>
```

### Option 3: Embed.ly
Third-party service with rich PDF viewing:
```html
<iframe src="https://embed.ly/code?url=YOUR_PDF_URL"></iframe>
```

---

## Security Considerations

### PDF File Access
- PDFs are stored in `storage/app/public/` which is publicly accessible
- Consider implementing authentication if books should be restricted
- Add middleware to routes if needed:

```php
Route::get('/online-lezen/{slug}', [OnlineLezenController::class, 'read'])
    ->middleware('auth')
    ->name('onlineLezenRead');
```

### File Validation
When uploading PDFs through admin panel, validate:
- File type (only PDFs)
- File size (max 50MB recommended)
- Malware scanning for user uploads

---

## Future Enhancements

### Planned Features
- [ ] Bookmarking functionality (save reading position)
- [ ] Full-text search within PDFs
- [ ] Reading statistics and analytics
- [ ] Download PDF option (conditional)
- [ ] Print functionality
- [ ] Dark mode for reader
- [ ] Zoom controls
- [ ] Page navigation controls
- [ ] Favorites/Reading list

### Technical Improvements
- [ ] Lazy loading for PDF files
- [ ] CDN integration for faster loading
- [ ] Progressive Web App (PWA) support
- [ ] Offline reading capability
- [ ] Text-to-speech integration

---

## Troubleshooting

### PDFs Not Displaying
1. **Check file exists**: Verify the PDF file is in `storage/app/public/pdfs/`
2. **Storage link**: Run `php artisan storage:link`
3. **Permissions**: Ensure proper file permissions (755 for directories, 644 for files)
4. **Browser compatibility**: Test in different browsers
5. **File path**: Check the `pdf_file` column in database has correct path

### Styling Issues
1. **Clear cache**: `php artisan cache:clear`
2. **Rebuild assets**: `npm run build`
3. **Browser cache**: Hard refresh (Ctrl+Shift+R)

### Performance Issues
1. **Optimize PDFs**: Use PDF compression tools
2. **Enable caching**: Configure Laravel caching
3. **Use CDN**: Store PDFs on CDN for faster delivery
4. **Implement pagination**: For libraries with many books

---

## CSS Classes Reference

### Library Page
- `.online-lezen` - Main container
- `.online-lezen-header` - Header section
- `.online-lezen-title` - Main title
- `.online-lezen-subtitle` - Subtitle text
- `.online-lezen-grid` - Book grid container
- `.online-book-card` - Individual book card
- `.online-book-overlay` - Hover overlay effect
- `.online-book-image` - Book cover image
- `.online-book-content` - Book information section

### Reader Page
- `.online-reader` - Main reader container
- `.reader-header` - Header with title and actions
- `.pdf-viewer-wrapper` - PDF container
- `.pdf-iframe` - The PDF viewer iframe
- `.pdf-no-file` - Message when no PDF available
- `.reader-description` - Book description section
- `.reader-cta` - Call-to-action section
- `.reader-cta-actions` - Action buttons

---

## Browser Compatibility

### Supported Browsers
- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Opera 76+

### Mobile Browsers
- ✅ iOS Safari 14+
- ✅ Chrome Mobile
- ✅ Firefox Mobile
- ✅ Samsung Internet

---

## Support & Maintenance

For questions or issues related to the Online Lezen feature:
1. Check this documentation
2. Review the troubleshooting section
3. Check Laravel logs: `storage/logs/laravel.log`
4. Inspect browser console for JavaScript errors

---

## Credits

**Design & Development**: Built for Lucide Inkt webshop
**PDF Viewing**: Native browser PDF rendering
**Fonts**: Herina, Delima MTPro
**Icons**: Font Awesome 6

---

*Last Updated: 2026-01-21*
