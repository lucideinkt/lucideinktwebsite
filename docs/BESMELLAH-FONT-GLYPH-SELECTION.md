# Besmellah Font - Glyph Selection Guide

## Problem
The Besmellah.ttf font contains multiple honorific/bismillah calligraphic variants. We need to select glyph position 3 specifically.

## Current Implementation
Located in: `resources/css/reader-book.css` line 286-298

```css
.book-reader-scope .text-arabic-bismillah {
    font-family: 'Besmellah', serif;
    font-size: 1.65em;
    line-height: 2;
    direction: rtl;
    text-align: center;
    font-feature-settings: 'salt' 3; /* Stylistic alternates - position 3 */
    letter-spacing: 0;
    word-spacing: 0;
    color: #ca2a2a;
    margin: 0.3em 0 0.3em;
    display: block;
}
```

## Alternative Approaches to Try

If `'salt' 3` doesn't work, try these alternatives in order:

### Option 1: Character Variant (cv03)
```css
font-feature-settings: 'cv03' 1;
```

### Option 2: Stylistic Set 03
```css
font-feature-settings: 'ss03' 1;
/* or just */
font-feature-settings: 'ss03';
```

### Option 3: Stylistic Set with explicit ON value
```css
font-feature-settings: 'ss03' on;
```

### Option 4: Stylistic Alternates with value 1
```css
font-feature-settings: 'salt' 1;
```

### Option 5: Access via Unicode Private Use Area
If the font maps glyphs to Private Use Area (E000-F8FF):
```css
.text-arabic-bismillah::before {
    content: "\E003"; /* or \E002 for 0-indexed */
}
```

### Option 6: Using font-variant-alternates
```css
font-variant-alternates: styleset(3);
/* or */
font-variant-alternates: character-variant(3);
```

## Font Investigation Tools

To determine the correct approach, inspect the font using:

1. **FontForge** (free, open source)
   - Open Besmellah.ttf
   - View → Goto → Select glyph by index 3
   - Check if it has alternates defined
   - Look at Format → Font Info → Lookups to see what features are available

2. **Microsoft Font Properties Extension**
   - Right-click font file → Properties → Details tab
   - Shows available OpenType features

3. **Online Font Inspector**
   - https://opentype.js.org/font-inspector.html
   - Upload font to see all glyphs and features

## Testing

After changing the CSS:

1. Run `npm run build` to compile CSS
2. Hard refresh browser (Ctrl+F5)
3. Open browser DevTools → Fonts tab to see which glyph is rendered
4. If wrong glyph appears, try next option

## Current Status

✅ **Implemented**: `font-feature-settings: 'salt' 3;`

If this doesn't work, try the options above in sequence.

## Notes

- The Besmellah font appears to contain multiple calligraphic bismillah variants
- Position/glyph 3 should be selected
- The exact method depends on how the font designer implemented the alternates
- Some fonts use 0-based indexing (so position 3 = index 2)
- Some fonts use 1-based indexing (position 3 = index 3)

