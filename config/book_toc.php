<?php

/**
 * Table of contents per book (keyed by product slug).
 *
 * Each entry has:
 *   level    – 'main' (chapter heading) or 'sub' (sub-section)
 *   title    – display title shown in the sidebar
 *   subtitle – optional italic line below the title (or null)
 *   page     – page number to jump to when clicked
 *
 * To add a new book, add a new key matching the product slug and fill in
 * the entries array following the same pattern.
 */
return [

    'het-traktaat-over-de-herzameling-nederlands' => [
        ['level' => 'main', 'title' => 'Het Tiende Woord',       'subtitle' => 'Aangaande Hashr – De Herzameling', 'page' => 5],
        ['level' => 'sub',  'title' => 'Opmerking',               'subtitle' => null, 'page' => 5],

        ['level' => 'main', 'title' => 'Het Symbolische Verhaal', 'subtitle' => null, 'page' => 6],
        ['level' => 'sub',  'title' => 'Het Eerste Aanzicht',     'subtitle' => null, 'page' => 8],
        ['level' => 'sub',  'title' => 'Het Tweede Aanzicht',     'subtitle' => null, 'page' => 9],
        ['level' => 'sub',  'title' => 'Het Derde Aanzicht',      'subtitle' => null, 'page' => 10],
        ['level' => 'sub',  'title' => 'Het Vierde Aanzicht',     'subtitle' => null, 'page' => 10],
        ['level' => 'sub',  'title' => 'Het Vijfde Aanzicht',     'subtitle' => null, 'page' => 12],
        ['level' => 'sub',  'title' => 'Het Zesde Aanzicht',      'subtitle' => null, 'page' => 13],
        ['level' => 'sub',  'title' => 'Het Zevende Aanzicht',    'subtitle' => null, 'page' => 15],
        ['level' => 'sub',  'title' => 'Het Achtste Aanzicht',    'subtitle' => null, 'page' => 17],
        ['level' => 'sub',  'title' => 'Het Negende Aanzicht',    'subtitle' => null, 'page' => 18],
        ['level' => 'sub',  'title' => 'Het Tiende Aanzicht',     'subtitle' => null, 'page' => 19],
        ['level' => 'sub',  'title' => 'Het Elfde Aanzicht',      'subtitle' => null, 'page' => 21],
        ['level' => 'sub',  'title' => 'Het Twaalfde Aanzicht',   'subtitle' => null, 'page' => 23],

        ['level' => 'main', 'title' => 'Voorwoord',               'subtitle' => null, 'page' => 27],
        ['level' => 'sub',  'title' => 'De Eerste Aanwijzing',    'subtitle' => null, 'page' => 27],
        ['level' => 'sub',  'title' => 'De Tweede Aanwijzing',    'subtitle' => null, 'page' => 31],
        ['level' => 'sub',  'title' => 'De Derde Aanwijzing',     'subtitle' => null, 'page' => 34],
        ['level' => 'sub',  'title' => 'De Vierde Aanwijzing',    'subtitle' => null, 'page' => 35],

        ['level' => 'main', 'title' => 'De Twaalf Waarheden',     'subtitle' => null, 'page' => 36],
        ['level' => 'sub',  'title' => 'De Eerste Waarheid',      'subtitle' => null, 'page' => 36],
        ['level' => 'sub',  'title' => 'De Tweede Waarheid',      'subtitle' => null, 'page' => 36],
        ['level' => 'sub',  'title' => 'De Derde Waarheid',       'subtitle' => null, 'page' => 41],
        ['level' => 'sub',  'title' => 'De Vierde Waarheid',      'subtitle' => null, 'page' => 45],
        ['level' => 'sub',  'title' => 'De Vijfde Waarheid',      'subtitle' => null, 'page' => 50],
        ['level' => 'sub',  'title' => 'De Zesde Waarheid',       'subtitle' => null, 'page' => 59],
        ['level' => 'sub',  'title' => 'De Zevende Waarheid',     'subtitle' => null, 'page' => 68],
        ['level' => 'sub',  'title' => 'De Achtste Waarheid',     'subtitle' => null, 'page' => 73],
        ['level' => 'sub',  'title' => 'De Negende Waarheid',     'subtitle' => null, 'page' => 74],
        ['level' => 'sub',  'title' => 'De Tiende Waarheid',      'subtitle' => null, 'page' => 82],
        ['level' => 'sub',  'title' => 'De Elfde Waarheid',       'subtitle' => null, 'page' => 90],
        ['level' => 'sub',  'title' => 'De Twaalfde Waarheid',    'subtitle' => null, 'page' => 93],

        ['level' => 'main', 'title' => 'Slot',                    'subtitle' => null, 'page' => 96],
    ],

    'het-traktaat-over-de-natuur' => [
        ['level' => 'main', 'title' => 'Voorwoord',                  'subtitle' => null, 'page' => 5],

        ['level' => 'main', 'title' => 'De Drieëntwintigste Flits',  'subtitle' => null, 'page' => 9],
        ['level' => 'sub',  'title' => 'Waarschuwing',               'subtitle' => null, 'page' => 9],

        ['level' => 'main', 'title' => 'Inleiding',                  'subtitle' => null, 'page' => 13],

        ['level' => 'main', 'title' => 'De eerste kwestie',          'subtitle' => null, 'page' => 14],
        ['level' => 'sub',  'title' => 'De eerste onmogelijkheid',   'subtitle' => null, 'page' => 14],
        ['level' => 'sub',  'title' => 'De tweede onmogelijkheid',   'subtitle' => null, 'page' => 16],
        ['level' => 'sub',  'title' => 'De derde onmogelijkheid',    'subtitle' => null, 'page' => 17],

        ['level' => 'main', 'title' => 'De tweede kwestie',          'subtitle' => null, 'page' => 18],
        ['level' => 'sub',  'title' => 'De eerste onmogelijkheid',   'subtitle' => null, 'page' => 18],
        ['level' => 'sub',  'title' => 'De tweede onmogelijkheid',   'subtitle' => null, 'page' => 20],
        ['level' => 'sub',  'title' => 'De derde onmogelijkheid',    'subtitle' => null, 'page' => 21],

        ['level' => 'main', 'title' => 'De derde kwestie',           'subtitle' => null, 'page' => 22],
        ['level' => 'sub',  'title' => 'De eerste onmogelijkheid',   'subtitle' => null, 'page' => 22],
        ['level' => 'sub',  'title' => 'De tweede onmogelijkheid',   'subtitle' => null, 'page' => 23],
        ['level' => 'sub',  'title' => 'De derde onmogelijkheid',    'subtitle' => null, 'page' => 28],

        ['level' => 'main', 'title' => 'Slot',                       'subtitle' => null, 'page' => 41],
        ['level' => 'sub',  'title' => 'De eerste vraag',            'subtitle' => null, 'page' => 41],
        ['level' => 'sub',  'title' => 'De tweede vraag',            'subtitle' => null, 'page' => 44],
        ['level' => 'sub',  'title' => 'De derde vraag',             'subtitle' => null, 'page' => 49],
    ],

    // Add future books here:
    // 'slug-van-volgend-boek' => [ ... ],

];

