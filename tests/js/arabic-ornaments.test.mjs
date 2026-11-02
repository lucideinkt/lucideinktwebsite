import assert from 'node:assert/strict';
import test from 'node:test';
import { inlineSymbolRanges } from '../../resources/js/features/arabic-ornaments.js';

test('markers stay with the adjacent word without grouping whole sentences', () => {
    const text = 'Eerste laatste \ufffc tekst النَّارِ \ufffc\ufffc';
    assert.deepEqual(inlineSymbolRanges(text).map(({ start, end }) => text.slice(start, end)),
        ['laatste \ufffc', 'النَّارِ \ufffc\ufffc']);
});

test('opening ornaments and leading badges use the following word', () => {
    const text = '\ufff9 Eerste woord \ufffc \ufffc einde';
    assert.deepEqual(inlineSymbolRanges(text).map(({ start, end }) => text.slice(start, end)),
        ['\ufff9 Eerste', 'woord \ufffc \ufffc']);
    assert.deepEqual(inlineSymbolRanges('\ufffc Eerste woord'), [{ start: 0, end: 8 }]);
});

test('explicit breaks and symbol-only blocks are left alone', () => {
    assert.deepEqual(inlineSymbolRanges('woord\n\ufffc'), []);
    assert.deepEqual(inlineSymbolRanges('\ufffc\nwoord'), []);
    assert.deepEqual(inlineSymbolRanges('\ufffc \ufffc'), []);
});
