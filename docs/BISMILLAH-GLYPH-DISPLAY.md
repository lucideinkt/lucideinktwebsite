# Bismillah Glyph Display Guide

## Overview
The Besmellah font uses character substitution to display bismillah calligraphy. Instead of typing Arabic text, you type a specific character (like "3") and the font displays the corresponding bismillah glyph.

## HTML Structure
```html
<p class="text-center text-arabic-bismillah" dir="rtl" lang="ar">3<sup>1</sup></p>
```

**Explanation:**
- `3` = The character that maps to a bismillah glyph in the Besmellah font
- `<sup>1</sup>` = Footnote reference number in superscript
- `text-arabic-bismillah` = CSS class that applies the Besmellah font and styling
- `dir="rtl"` = Right-to-left text direction
- `lang="ar"` = Arabic language attribute

## CSS Styling

### Main Bismillah Glyph Styling
```css
.book-reader-scope .text-arabic-bismillah {
    font-family: 'Besmellah', serif;
    font-size: 180px;              /* Large size for glyph */
    line-height: 1;                /* Tight line height */
    height: auto;                  /* Auto height to fit glyph */
    direction: rtl;
    text-align: center;
    letter-spacing: 0;
    word-spacing: 0;
    color: #ca2a2a;               /* Red color */
    display: block;
    margin: 0.5em 0;              /* Vertical spacing */
    overflow: visible;            /* Allow glyph to display fully */
}
```

### Superscript Footnote Styling
```css
.book-reader-scope .text-arabic-bismillah sup {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    font-size: 16px;              /* Fixed size for footnote number */
    line-height: 1;
    vertical-align: super;
    color: #ca2a2a;
}
```

## Key Changes Made (2026-03-18)

### Problem
- The bismillah glyph was not displaying at the proper height
- Fixed height (250px) was constraining the glyph
- Negative margin was causing positioning issues

### Solution
1. **Increased font size** from 150px to 180px for better visibility
2. **Changed height** from fixed `250px` to `auto` to let glyph display naturally
3. **Set line-height to 1** to prevent extra vertical space
4. **Updated margin** from `0/-30px` to `0.5em 0` for proper spacing
5. **Added overflow: visible** to ensure glyph isn't clipped
6. **Added specific sup styling** with fixed 16px font size and proper font family

## Character Mapping

The Besmellah font maps specific characters to bismillah glyphs:
- Character `3` = Bismillah glyph (based on user's usage)
- Other characters may map to different calligraphic variations

## Testing

After making CSS changes:
1. Run `npm run build` to compile CSS
2. Hard refresh browser (Ctrl+F5)
3. Check that bismillah glyph displays at proper size
4. Verify footnote superscript appears correctly positioned
5. Ensure no clipping or overflow issues

## Troubleshooting

### Glyph appears too small
- Increase `font-size` value (currently 180px)

### Glyph is cut off/clipped
- Ensure `height: auto` and `overflow: visible`
- Check parent container doesn't have `overflow: hidden`

### Footnote number overlaps glyph
- Adjust `sup` positioning with `vertical-align` or `position: relative; top: -Xpx`

### Glyph appears stretched or compressed
- Ensure `line-height: 1` is set
- Remove any fixed width constraints

## Notes

- The Besmellah font in the project (`resources/fonts/Besmellah.ttf`) contains character-to-glyph mappings
- The glyph is vector-based, so it scales cleanly
- The red color `#ca2a2a` matches other Arabic text styling
- The font file is 517KB and contains decorative bismillah calligraphy

