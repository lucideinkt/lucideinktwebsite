# Herina Font Gebruiksinstructies

## Overzicht
De Herina font is een decoratief font met speciale Arabische karakters die gebruikt worden voor titels en headers op de website.

## Verbeteringen
De volgende verbeteringen zijn aangebracht:

### 1. CSS Custom Properties
Alle Herina font referenties en speciale karakters zijn nu gedefinieerd als CSS custom properties in `:root`:

```css
:root {
    --font-herina: 'Herina', serif;
    
    /* Speciale karakters */
    --herina-u: "\E026";
    --herina-k: "\E012";
    --herina-h: "\E007";
    --herina-t: "\E024";
    --herina-in: "\E04E";
    --herina-r: "\E022";
    --herina-a-one: "\E000";
    --herina-e-r: "\E049";
    --herina-me: "\E057";
}
```

### 2. Utility Classes
Er zijn nu herbruikbare utility classes beschikbaar:

```css
.font-herina {
    font-family: var(--font-herina);
}

.herina-u::before { content: var(--herina-u); }
.herina-k::before { content: var(--herina-k); }
.herina-h::before { content: var(--herina-h); }
/* etc. */
```

## Gebruik

### Optie 1: Bestaande Markup (Blijft werken)
```html
<h2 class="title">Welkom op L<span class="title-u"></span>cide In<span class="title-k"></span>t</h2>
```

### Optie 2: Met Utility Classes (Aanbevolen - Herbruikbaar)
```html
<h2 class="font-herina">Welkom op L<span class="herina-u"></span>cide In<span class="herina-k"></span>t</h2>
```

### Optie 3: Directe Unicode in HTML (NIET AANBEVOLEN)
```html
<h2 class="font-herina">Welkom op Lcide Int</h2>
```
**Waarom niet aanbevolen?**
- Unicode karakters (zoals  en ) zijn niet typbaar op een normaal toetsenbord
- Onleesbaar in de code editor (rare symbolen)
- Moeilijk te bewerken en onderhouden
- **Conclusie**: Gebruik Optie 1 of 2 in plaats daarvan!

### Optie 4: CSS Custom Properties gebruiken
```css
.my-custom-title::before {
    font-family: var(--font-herina);
    content: var(--herina-h);
}
```

## Aanbevolen Gebruik

**✅ Beste keuzes:**
- **Optie 1**: Als je oude code hebt die al werkt, laat het zo
- **Optie 2**: Voor nieuwe code - herbruikbare utility classes
- **Optie 4**: Voor custom styling in CSS

**❌ Vermijd:**
- **Optie 3**: Directe Unicode is onpraktisch en onleesbaar

## Voordelen van deze aanpak

1. **Centraal beheer**: Alle Herina karakters staan op één plek in `:root`
2. **Makkelijk te onderhouden**: Unicode waarden wijzigen = één locatie
3. **Herbruikbaar**: Utility classes kunnen overal gebruikt worden
4. **Consistent**: Altijd dezelfde font-family via `var(--font-herina)`
5. **Type-safe**: Gebruik `::before` in plaats van `:before` (moderne standaard)
6. **Backwards compatible**: Oude code blijft gewoon werken

## Beschikbare Speciale Karakters

| Class | Unicode | Gebruik voor |
|-------|---------|--------------|
| `.herina-u` | `\E026` | Letter 'u' met Arabisch accent |
| `.herina-k` | `\E012` | Letter 'k' met Arabisch accent |
| `.herina-h` | `\E007` | Letter 'h' met Arabisch accent |
| `.herina-t` | `\E024` | Letter 't' met Arabisch accent |
| `.herina-in` | `\E04E` | Woord 'in' met Arabisch accent |
| `.herina-r` | `\E022` | Letter 'r' met Arabisch accent |
| `.herina-a-one` | `\E000` | Letter 'a' variant 1 |
| `.herina-e-r` | `\E049` | Combinatie 'er' |
| `.herina-me` | `\E057` | Woord 'me' |

## Toekomstige Verbeteringen (Optioneel)

### Component-based benadering
Je zou een helper functie kunnen maken:

```php
// In een Blade component of helper
function herina($text, $replacements = []) {
    foreach ($replacements as $char => $class) {
        $text = str_replace($char, '<span class="herina-'.$class.'"></span>', $text);
    }
    return '<span class="font-herina">'.$text.'</span>';
}

// Gebruik:
{!! herina('Lucide Inkt', ['u' => 'u', 'k' => 'k']) !!}
```

### Blade Component
```php
// resources/views/components/herina-text.blade.php
<span {{ $attributes->merge(['class' => 'font-herina']) }}>
    {{ $slot }}
</span>

// Gebruik:
<x-herina-text>Welkom op L<span class="herina-u"></span>cide In<span class="herina-k"></span>t</x-herina-text>
```

## Troubleshooting

**Probleem**: Font wordt niet geladen
- Check of `gtherina-regular.otf` bestaat in `resources/fonts/`
- Controleer browser console voor 404 errors
- Run `npm run build` om assets opnieuw te builden

**Probleem**: Speciale karakters tonen niet
- Zorg dat parent element `font-family: var(--font-herina)` heeft
- Check of de Unicode waarde correct is
- Gebruik `::before` in plaats van `:before`

