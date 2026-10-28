import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';
import { prayerAccentRanges, markPrayerText } from '../resources/js/features/prayer-text.js';

const accents = (text, slug = 'namaz-tesbihati') => prayerAccentRanges(text, slug).map(r => text.slice(r.start, r.end));

test('divine names retain their exact spelling while requests and non-divine vocatives remain unaccented', () => {
    for (const word of ['اَللّٰهُمَّ', 'اللّٰهُ', 'لِلّٰهِ', 'بِاللّٰهِ', 'وَلِلّٰهِ', 'ﷲ']) {
        assert.deepEqual(accents(`قَبْلَ ${word} بَعْدَ`), [word]);
    }
    assert.deepEqual(accents('سُبْحَانَكَ يَا طَاهِرُ تَعَالَيْتَ يَا مُطَهِّرُ اَجِرْنَا مِنَ النَّارِ'),
        ['طَاهِرُ', 'مُطَهِّرُ']);
    assert.deepEqual(accents('يَا حَيُّ يَا قَيُّومُ بِرَحْمَتِكَ اَسْتَغٖيثُ'), ['حَيُّ', 'قَيُّومُ']);
    assert.deepEqual(accents('يَاذَا الْجَلَالِ وَالْاِكْرَامِ'), []);
    assert.deepEqual(accents('يَا اَرْحَمَ الرَّاحِمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ'),
        ['اَرْحَمَ', 'لِلّٰهِ']);
    assert.deepEqual(accents('يَا رَسُولَ اللّٰهِ ۞ يَا حَبٖيبَ اللّٰهِ ۞ يَا اَمٖينَ وَحْيِ اللّٰهِ'),
        ['اللّٰهِ', 'اللّٰهِ', 'اللّٰهِ']);
    assert.deepEqual(accents('يَا لَيْتَنٖي كُنْتُ تُرَابًا يَأْتِي'), []);
});

test('Cevsen accents only the head word, leaving ya, relative clauses and refrains quiet', () => {
    assert.deepEqual(accents('يَا سَيِّدَ السَّادَاتِ ۞ يَا مَنْ لَهُ الْعِزُّ وَالْجَمَالُ ۞ سُبْحَانَكَ', 'cevsen-ul-kebir'),
        ['سَيِّدَ']);
    assert.deepEqual(accents('سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ', 'cevsen-ul-kebir'), ['يَا']);
});

test('only Cevsen accents the indicated refrain words, including both deliver-us variants', () => {
    for (const word of ['خَلِّصْنَا', 'خَلِّصْنَا', 'نَجِّنَا', 'نَجِّنَا']) {
        const text = `سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ ${word} مِنَ النَّارِ ۝١`;
        assert.deepEqual(accents(text, 'cevsen-ul-kebir'), ['يَا', word]);
        assert.deepEqual(accents(text, 'namaz-tesbihati'), []);
        assert.deepEqual(accents(text, 'another-book'), []);
        assert.deepEqual(accents(`${word} مِنَ ۞ النَّارِ`, 'cevsen-ul-kebir'), []);
    }
});
test('repeated name lists accent only the varying name, matching the screenshot', () => {
    const text = 'يَا جَمٖيلُ يَٓا اَللّٰهُ ۝١ يَا قَرٖيبُ يَٓا اَللّٰهُ ۝٢ يَا حَبٖيبُ يَٓا اَللّٰهُ';
    for (const slug of ['namaz-tesbihati', 'cevsen-ul-kebir']) {
        assert.deepEqual(accents(text, slug), ['جَمٖيلُ', 'قَرٖيبُ', 'حَبٖيبُ']);
        assert.deepEqual(accents('يَا رَحْمٰنُ ۞ يَا رَحٖيمُ', slug), ['رَحْمٰنُ', 'رَحٖيمُ']);
        assert.deepEqual(accents('اٰمٖينَ يَامُجٖيبَ الدَّعَوَاتِ', slug), ['مُجٖيبَ']);
        assert.deepEqual(accents('يَاخَالِقَ كُلِّ شَيْءٍ', slug), ['خَالِقَ']);
    }
    assert.deepEqual(accents(text, 'another-book'), []);
});

test('other books are untouched and theme rules distinguish body text, divine names and existing ornaments', () => {
    markPrayerText({ querySelectorAll: () => assert.fail('must not inspect other books') }, 'another-book');
    const css = readFileSync('resources/css/reader-preferences.css', 'utf8');
    assert.match(css, /\.prayer-body\s*\{[^}]*color: #25211b !important/);
    assert.match(css, /\.prayer-body \.prayer-accent\s*\{[^}]*color: var\(--reader-accent\) !important/);
    const reader = readFileSync('resources/js/features/reader-book.js', 'utf8');
    assert.match(reader, /markPrayerText\(page, readerEl\.dataset\.bookSlug\)/);
});

test('paired verse decorations preserve theme color and hide only the original enclosing sign', () => {
    const css = readFileSync('resources/css/reader-preferences.css', 'utf8');
    assert.match(css, /\.prayer-verse-number::before\s*\{ content: "﴿"/);
    assert.match(css, /\.prayer-verse-number::after\s*\{ content: "﴾"/);
    assert.match(css, /\.prayer-verse-sign\s*\{ font-size: 0 !important/);
    assert.match(css, /\.prayer-verse-number\s*\{[^}]*white-space: nowrap;[^}]*unicode-bidi: isolate;/);
    assert.doesNotMatch(css, /\.prayer-verse-number\s*\{[^}]*color:/);
});
