import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';
import vm from 'node:vm';

const blade = readFileSync(new URL('../../resources/views/online-lezen-html-reader.blade.php', import.meta.url), 'utf8');
const source = blade.slice(blade.indexOf('// Preview without reflow;'), blade.indexOf('// --- Theme ---'));

function reader({ textAnchor = true } = {}) {
    const listeners = {};
    const applied = [];
    const scrolls = [];
    let restored = false;
    let top = 140;
    const text = { nodeType: 3, length: 10 };
    const context = {
        Node: { TEXT_NODE: 3 },
        readerEl: {
            style: {}, contains: node => node === text,
            getBoundingClientRect: () => ({ left: 20, top: -50 }),
            addEventListener: (type, listener) => { listeners[type] = listener; },
        },
        document: {
            caretPositionFromPoint: () => textAnchor ? { offsetNode: text, offset: 2 } : null,
            createRange: () => ({
                setStart() {}, setEnd() {},
                getBoundingClientRect: () => ({ top }),
            }),
        },
        window: { getSelection: () => ({ removeAllRanges() {} }), scrollBy: (...value) => scrolls.push(value) },
        requestAnimationFrame: callback => callback(),
        FONT_STEPS: Array.from({ length: 241 }, (_, i) => 12 + i / 10),
        ARABIC_STEPS: Array.from({ length: 361 }, (_, i) => 16 + i / 10),
        fontStepIdx: 70, arabicStepIdx: 130,
        nearestStepIdx: (steps, value) => steps.indexOf(Math.round(value * 10) / 10),
        setFontStep: (index, anchor) => { applied.push(['text', index, anchor]); top = 240; },
        setArabicStep: (index, anchor) => { applied.push(['arabic', index, anchor]); },
        captureAnchor: () => ({ el: 'page', top: 20 }),
        restoreAnchor: () => { restored = true; },
    };
    vm.runInNewContext(source, context);
    const touch = (type, distance = 100, count = 2) => listeners[type]({
        touches: Array.from({ length: count }, (_, i) => ({ clientX: 100 + i * distance, clientY: 200 })),
        preventDefault() {},
    });
    return { context, applied, scrolls, touch, restored: () => restored };
}

test('pinch previews smoothly, then commits both fonts and restores the passage once', () => {
    const r = reader();
    r.touch('touchstart');
    r.touch('touchmove', 125);
    assert.equal(r.context.readerEl.style.transform, 'scale(1.25)');
    assert.equal(r.context.readerEl.style.transformOrigin, '130px 250px');
    assert.deepEqual(r.applied, []);
    r.touch('touchend', 125, 1);
    assert.deepEqual(r.applied, [['text', 118, false], ['arabic', 203, false]]);
    assert.equal(r.context.readerEl.style.transform, '');
    assert.equal(r.context.readerEl.style.willChange, '');
    assert.deepEqual(r.scrolls, [[0, 100]]);
});

test('common scale respects both font limits without changing their ratio during preview', () => {
    for (const [distance, expected] of [[10000, 52 / 29], [0, 12 / 19]]) {
        const r = reader();
        r.touch('touchstart');
        r.touch('touchmove', distance);
        assert.equal(r.context.readerEl.style.transform, `scale(${expected})`);
        r.touch('touchend', distance, 0);
        assert.ok(r.applied.every(([, index]) => index >= 0));
    }
});

test('cancel and a third finger discard the preview without saving font sizes', () => {
    for (const type of ['touchcancel', 'touchstart']) {
        const r = reader();
        r.touch('touchstart');
        r.touch('touchmove', 150);
        r.touch(type, 150, 3);
        r.touch('touchend', 100, 0);
        assert.deepEqual(r.applied, []);
        assert.equal(r.context.readerEl.style.transform, '');
    }
});

test('one-finger scrolling stays untouched and missing caret support uses the page anchor', () => {
    const r = reader({ textAnchor: false });
    r.touch('touchstart', 100, 1);
    r.touch('touchmove', 150, 1);
    assert.deepEqual(r.applied, []);
    r.touch('touchstart');
    r.touch('touchmove', 110);
    r.touch('touchend', 110, 0);
    assert.equal(r.restored(), true);
});
