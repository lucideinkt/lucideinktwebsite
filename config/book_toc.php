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
        ['level' => 'sub',  'title' => 'Het Zesde Aanzicht',      'subtitle' => null, 'page' => 14],
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

    'het-traktaat-over-de-natuur-nederlands' => [
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

    'afwegingen-van-geloof-ongeloof-nederlands' => [
        ['level' => 'main', 'title' => 'De Vijftiende Straal',                                                                        'subtitle' => null, 'page' => 5],
        ['level' => 'main', 'title' => 'Het Eerste Woord',                                                                            'subtitle' => null, 'page' => 12],
        ['level' => 'main', 'title' => 'Het Tweede Woord',                                                                            'subtitle' => null, 'page' => 16],
        ['level' => 'main', 'title' => 'Het Derde Woord',                                                                             'subtitle' => null, 'page' => 19],
        ['level' => 'main', 'title' => 'Het Vierde Woord',                                                                            'subtitle' => null, 'page' => 22],
        ['level' => 'main', 'title' => 'Het Vijfde Woord',                                                                            'subtitle' => null, 'page' => 25],
        ['level' => 'main', 'title' => 'Het Zesde Woord',                                                                             'subtitle' => null, 'page' => 28],
        ['level' => 'main', 'title' => 'Het Zevende Woord',                                                                           'subtitle' => null, 'page' => 35],
        ['level' => 'main', 'title' => 'Het Achtste Woord',                                                                           'subtitle' => null, 'page' => 41],
        ['level' => 'main', 'title' => 'Het Twaalfde Woord',                                                                          'subtitle' => null, 'page' => 50],
        ['level' => 'main', 'title' => 'Het Tweede Thema Uit Het Dertiende Woord',                                                    'subtitle' => null, 'page' => 53],
        ['level' => 'sub',  'title' => 'Een waarschuwing, een les en een vermaning voor een aantal arme jongeren',                    'subtitle' => null, 'page' => 57],
        ['level' => 'sub',  'title' => 'Een Aanvulling op Het Tweede Thema van Het Dertiende Woord',                                  'subtitle' => null, 'page' => 61],
        ['level' => 'sub',  'title' => 'O arme slachtoffers van gevangenschap!',                                                      'subtitle' => null, 'page' => 64],
        ['level' => 'sub',  'title' => 'Een belangrijke kwestie die mij tijdens de nacht van Qadr werd ingegeven',                    'subtitle' => null, 'page' => 69],
        ['level' => 'main', 'title' => 'Slot Van Het Veertiende Woord',                                                               'subtitle' => null, 'page' => 71],
        ['level' => 'main', 'title' => 'Het Zeventiende Woord',                                                                       'subtitle' => null, 'page' => 74],
        ['level' => 'sub',  'title' => 'Een Smeekbede Die Mijn Hart Perzisch Is Ingegeven',                                           'subtitle' => null, 'page' => 79],
        ['level' => 'sub',  'title' => 'Perzische Passages',                                                                          'subtitle' => null, 'page' => 85],
        ['level' => 'sub',  'title' => 'Het Eerste Tableau',                                                                          'subtitle' => null, 'page' => 90],
        ['level' => 'sub',  'title' => 'Het Tweede Tableau',                                                                          'subtitle' => null, 'page' => 91],
        ['level' => 'main', 'title' => 'Het Drieëntwintigste Woord',                                                                  'subtitle' => null, 'page' => 92],
        ['level' => 'main', 'title' => 'De Vijfde Tak Van Het Vierentwintigste Woord',                                                'subtitle' => null, 'page' => 122],
        ['level' => 'main', 'title' => 'Uit Het Vijfentwintigste Woord',                                                              'subtitle' => null, 'page' => 132],
        ['level' => 'main', 'title' => 'Uit De Vruchten',                                                                             'subtitle' => null, 'page' => 140],
        ['level' => 'main', 'title' => 'Uit Het Zesentwintigste Woord',                                                               'subtitle' => null, 'page' => 143],
        ['level' => 'main', 'title' => 'Het Dertigste Woord',                                                                         'subtitle' => null, 'page' => 148],
        ['level' => 'main', 'title' => 'Uit Het Tweeëndertigste Woord',                                                               'subtitle' => null, 'page' => 165],
        ['level' => 'main', 'title' => 'De Eerste Flits',                                                                             'subtitle' => null, 'page' => 174],
        ['level' => 'main', 'title' => 'Vijfde Nota Uit De Zeventiende Flits',                                                        'subtitle' => null, 'page' => 178],
        ['level' => 'main', 'title' => 'De Vierentwintigste Flits',                                                                   'subtitle' => null, 'page' => 187],
        ['level' => 'main', 'title' => 'De Vierde Vraag Uit De Eerste Brief',                                                         'subtitle' => null, 'page' => 193],
        ['level' => 'main', 'title' => 'Uit De Negende Brief',                                                                        'subtitle' => null, 'page' => 196],
        ['level' => 'main', 'title' => 'Het Vijfde Traktaat Uit De Negenentwintigste Brief',                                          'subtitle' => null, 'page' => 200],
        ['level' => 'main', 'title' => 'Uit De Leidraad Voor De Jeugd',                                                               'subtitle' => null, 'page' => 205],
        ['level' => 'sub',  'title' => 'Een Belangrijke Kwestie Die Mij Plotseling Is Ingegeven',                                     'subtitle' => null, 'page' => 208],
        ['level' => 'sub',  'title' => 'Samenvatting Van De Tweede Kwestie Uit De Vruchten',                                          'subtitle' => null, 'page' => 210],
        ['level' => 'sub',  'title' => 'De Derde Kwestie Uit De Leidraad voor De Jeugd',                                              'subtitle' => null, 'page' => 214],
        ['level' => 'sub',  'title' => 'De Vierde Kwestie Uit De Leidraad voor De Jeugd',                                             'subtitle' => null, 'page' => 219],
        ['level' => 'sub',  'title' => 'Een Samenvatting Van De Achtste Kwestie',                                                     'subtitle' => null, 'page' => 222],
        ['level' => 'main', 'title' => 'Het Tweede Niveau Uit De Stralendste Bewijzen',                                               'subtitle' => null, 'page' => 230],
        ['level' => 'main', 'title' => 'De Tweede Poort Uit De Negenentwintigste Flits',                                              'subtitle' => null, 'page' => 237],
        ['level' => 'main', 'title' => 'Tijdens Een Droombijeenkomst',                                                                'subtitle' => null, 'page' => 247],
        ['level' => 'main', 'title' => 'Alle Ware Leed Schuilt In Dwaling, Alle Ware Genot Schuilt In Geloof Uit De Schitteringen',  'subtitle' => null, 'page' => 255],
        ['level' => 'main', 'title' => 'Goddelijke Namen',                                                                            'subtitle' => null, 'page' => 264],
    ],

    // Add future books here:
    // 'slug-van-volgend-boek' => [ ... ],

];

