import { keepOrnamentsWithWords } from '../../resources/js/features/arabic-ornaments.js';

// Run in a reader page with its styles loaded, via Vite's /tests/js/ URL.
export function verifyArabicOrnamentLayout() {
    const fixtures = [
        {
            html: 'Zoals de Aya: <span class="fn-arabic-inline fn-arabic-inline--wrap"><span class="text-arabic-inline" dir="rtl"><span class="text-arabic-chunk">يَسْتَحِبُّونَ</span> <span class="text-arabic-chunk">الْحَيٰوةَ</span> <span class="text-arabic-chunk fn-arabic-tail">الدُّنْيَا<button class="fn-ref">1</button></span></span></span> aangeeft.',
            unchanged: true,
        },
        {
            html: 'Zoals de Aya: <span class="text-arabic-inline" dir="rtl">يَسْتَحِبُّونَ الْحَيٰوةَ الدُّنْيَا<button class="fn-ref">1</button></span> aangeeft.',
        },
        {
            html: 'Zoals de Aya: <span class="fn-arabic-inline"><span class="text-arabic-inline text-arabic-inline--short" dir="rtl">اَللّٰهُ</span><button class="fn-ref">1</button></span> aangeeft.',
            unchanged: true,
        },
        {
            html: '<span class="text-arabic-inline" dir="rtl">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢</span><button class="fn-ref">1</button></span>',
        },
        {
            html: '<strong id="ornament-regression-anchor">Eerste laatste</strong> <button class="fn-ref">1</button><button class="fn-ref">2</button> volgende.',
        },
        {
            html: '<span class="text-arabic" dir="rtl">يَا رَحٖيمُ <span class="cevsen-separator">۞</span> يَا عَلٖيمُ <span class="cevsen-separator">۞</span> النَّارِ <span class="cevsen-verse-number">۝٢</span></span>',
        },
    ];
    const assert = (condition, message) => { if (!condition) throw new Error(message); };
    const host = document.createElement('div');
    host.className = 'book-reader-scope';
    host.style.cssText = 'position:fixed;left:0;top:0;max-width:none;visibility:hidden;pointer-events:none';
    document.body.append(host);
    let checks = 0;
    try {
        for (const width of [240, 320, 390, 768]) {
            for (const fontSize of [22, 29, 42, 60]) {
                for (const [index, fixture] of fixtures.entries()) {
                    const label = `fixture ${index}, ${width}px, ${fontSize}px`;
                    host.style.width = width + 'px';
                    host.style.setProperty('--reader-arabic-font-size', fontSize + 'px');
                    host.innerHTML = `<p style="direction:ltr">${fixture.html}</p>`;
                    const paragraph = host.firstElementChild;
                    const text = paragraph.textContent;
                    const rtlRuns = [...paragraph.querySelectorAll('[dir="rtl"]')];
                    const originalRuns = rtlRuns.map(run => run.textContent);
                    const before = paragraph.innerHTML;
                    let clicks = 0;
                    const buttons = [...paragraph.querySelectorAll('.fn-ref')];
                    buttons.forEach(button => button.addEventListener('click', () => clicks++));
                    const wordPositions = () => [...paragraph.querySelectorAll('.text-arabic-chunk')].map(word => {
                        const rect = word.getBoundingClientRect();
                        return [rect.x, rect.y, rect.width, rect.height];
                    });
                    const positions = JSON.stringify(wordPositions());
                    keepOrnamentsWithWords(host);
                    assert(paragraph.textContent === text, label + ': changed source order');
                    assert(paragraph.querySelectorAll('[dir="rtl"]').length === rtlRuns.length, label + ': split RTL run');
                    rtlRuns.forEach((run, i) => {
                        assert(run.isConnected && run.textContent === originalRuns[i], label + ': replaced RTL context');
                    });
                    if (fixture.unchanged) {
                        assert(paragraph.innerHTML === before, label + ': modified protected group');
                        assert(JSON.stringify(wordPositions()) === positions, label + ': moved protected words');
                    }
                    buttons.forEach(button => {
                        assert(button.isConnected, label + ': detached footnote');
                        button.click();
                    });
                    paragraph.querySelectorAll('.fn-ref, .cevsen-separator, .cevsen-verse-number').forEach(marker => {
                        const group = marker.closest('.arabic-ornament-tail, .fn-arabic-tail, .fn-arabic-inline:not(.fn-arabic-inline--wrap)');
                        assert(group && /[\p{L}]/u.test(group.textContent), label + ': orphaned badge');
                        const style = getComputedStyle(group);
                        assert(style.whiteSpace === 'nowrap' || style.display === 'inline-flex', label + ': breakable badge group');
                    });
                    assert(clicks === buttons.length, label + ': lost click handler');
                    assert(paragraph.querySelectorAll('#ornament-regression-anchor').length <= 1, label + ': duplicate anchor');
                    const grouped = paragraph.innerHTML;
                    keepOrnamentsWithWords(host);
                    assert(paragraph.innerHTML === grouped, label + ': grouping is not idempotent');
                    checks++;
                }
            }
        }
        return { checks, widths: [240, 320, 390, 768], fontSizes: [22, 29, 42, 60] };
    } finally {
        host.remove();
    }
}
