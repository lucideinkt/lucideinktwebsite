import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';
import { waqfDisplayText } from '../../resources/js/features/prayer-text.js';

test('waqf letters use normal glyphs at a shared display size', () => {
    for (const [source, expected] of [
        ['ۚ', 'ج'], ['ۜ', 'ط'], ['ۙ', 'لا'], ['ۘ', 'م'],
        ['ۖ', 'ص'], ['ࣞ', 'قف'], ['۟', 'ع'], ['ز', 'ز'],
    ]) {
        assert.equal(waqfDisplayText(source), expected);
        assert.equal(waqfDisplayText(expected), expected);
    }
});

test('paired waqf marks keep their three-dot annotation', () => {
    assert.equal(waqfDisplayText('ۚۛ'), 'جۛ');
    assert.equal(waqfDisplayText('ࣞۛ'), 'قفۛ');
});

test('all An-Naba sad signs use the reference small sad', () => {
    const source = readFileSync(new URL('../../database/seeders/TesbihatPagesSeeder.php', import.meta.url), 'utf8');
    for (const word of ['اَوْتَادًا', 'مَعَاشًا', 'وَهَّاجًا']) {
        assert.ok(source.includes(`${word}<span class="arabic-waqf">ص</span>`));
        assert.equal(waqfDisplayText('ص'), 'ص');
    }
    assert.ok(!source.includes('ۖ'));
    assert.equal(waqfDisplayText('ۖ'), 'ص');
});

test('all five Ayat al-Kursi repetitions match the nine reference waqf signs', () => {
    const source = readFileSync(new URL('../../database/seeders/TesbihatPagesSeeder.php', import.meta.url), 'utf8');
    const verses = [...source.matchAll(/<p class="text-center text-arabic"[^>]*>(.*?)<\/p>/gu)]
        .map(match => match[1])
        .filter(text => text.endsWith('۝٢٥٥</span>'));
    const expected = [
        ['هُوَ', 'ج'],
        ['الْقَيُّومُ', 'ج'], ['نَوْمٌ', 'ط'], ['الْاَرْضِ', 'ط'], ['بِاِذْنِهٖ', 'ط'],
        ['خَلْفَهُمْ', 'ج'], ['شَٓاءَ', 'ج'], ['وَالْاَرْضَ', 'ج'], ['حِفْظُهُمَا', 'ج'],
    ];
    assert.equal(verses.length, 5);
    for (const verse of verses) {
        assert.ok(verse.includes('اِلَّا هُوَ<span class="arabic-waqf">ۚ</span> اَلْحَيُّ'));
        const marks = [...verse.matchAll(/(\S+)<span class="arabic-waqf">([^<]+)<\/span>/gu)]
            .map(match => [match[1], waqfDisplayText(match[2])]);
        assert.deepEqual(marks, expected);
    }
    assert.equal(new Set(verses).size, 1);
});

test('Al-Fath 27–29 attaches each reference sign to the correct word', () => {
    const source = readFileSync(new URL('../../database/seeders/TesbihatPagesSeeder.php', import.meta.url), 'utf8');
    const verses = [...source.matchAll(/<p class="text-center text-arabic"[^>]*>(.*?)<\/p>/gu)]
        .map(match => match[1])
        .filter(text => /^(?:لَقَدْ صَدَقَ|هُوَ الَّذٖٓي اَرْسَلَ|مُحَمَّدٌ رَسُولُ)/u.test(text));
    const expected = [
        [['بِالْحَقِّ', 'ج'], ['اٰمِنٖينَ', 'لا'], ['وَمُقَصِّرٖينَ', 'لا'], ['تَخَافُونَ', 'ط']],
        [['كُلِّهٖ', 'لا'], ['شَهٖيدًا', 'ط']],
        [['اللّٰهِ', 'ط'], ['وَرِضْوَانًا', 'ز'], ['السُّجُودِ', 'ط'],
            ['التَّوْرٰيةِ', 'جۛ'], ['الْاِنْجٖيلِ', 'قفۛ'], ['الْكُفَّارَ', 'ط']],
    ];
    assert.equal(verses.length, expected.length);
    for (const [index, verse] of verses.entries()) {
        const marks = [...verse.matchAll(/(\S+)<span class="arabic-waqf">([^<]+)<\/span>/gu)]
            .map(match => [match[1], waqfDisplayText(match[2])]);
        assert.deepEqual(marks, expected[index]);
    }
});
