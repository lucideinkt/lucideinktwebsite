import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';
import vm from 'node:vm';

const view = readFileSync(new URL('../resources/views/online-lezen-html-reader.blade.php', import.meta.url), 'utf8');
const css = readFileSync(new URL('../resources/css/reader-preferences.css', import.meta.url), 'utf8');

test('paper menus use the app card and row palette and text settings have unboxed restore labels', () => {
    assert.match(css, /--reader-menu-bg: #fffdf5; --reader-menu-ink: #2a1a0a/);
    assert.match(css, /--reader-row-bg: #fbf0cb/);
    assert.match(css, /--reader-bg: #1e1e1e; --reader-surface: #2a2a2a; --reader-ink: #e5e5e5/);
    assert.match(css, /\.reader-sheet-reset-btn\s*\{[^}]*border: 0 !important/);
    assert.match(view, /id="sheet-font-reset"[^>]*>Herstellen<\/button>/);
    assert.match(css, /#topbar-mobile-toc-btn \{ display: flex/);
});

function navigation() {
    const elements = new Map(), jumps = [], properties = new Map();
    const document = {
        activeElement: null,
        documentElement: { style: { setProperty: (key, value) => properties.set(key, value) } },
        getElementById(id) {
            if (!elements.has(id)) elements.set(id, {
                id, value: '', placeholder: '', hidden: true, offsetParent: {}, handlers: {},
                style: { setProperty(key, value) { this[key] = value; } },
                focus() { document.activeElement = this; }, select() { this.selected = true; },
                replaceChildren() { this.children = []; },
                setAttribute(key, value) { this[key] = value; },
                removeAttribute(key) { delete this[key]; },
                addEventListener(event, callback) { this.handlers[event] = callback; },
            });
            return elements.get(id);
        },
    };
    const viewport = { offsetTop: 0, height: 844, addEventListener() {} };
    const context = vm.createContext({
        document, sorted: [5, 7, 9], visiblePage: () => 7,
        topbarMobilePage: { textContent: '7 / 9' },
        topbarEl: { getBoundingClientRect: () => ({ bottom: 44 }) },
        window: { innerHeight: 844, visualViewport: viewport, addEventListener() {} },
        jumpTo: (...args) => jumps.push(args), openToc() { jumps.push('toc'); },
    });
    const script = view.slice(view.indexOf('function positionReaderDialogs()'), view.indexOf('function _scrollTo('))
        .replaceAll("{{ $allPageMeta->min('page_number') }}", '5')
        .replaceAll("{{ $allPageMeta->max('page_number') }}", '9');
    vm.runInContext(script, context);
    return { element: id => document.getElementById(id), jumps, viewport, properties, context, document };
}

test('header icon buttons match the app without padded backgrounds or overflowing the header', () => {
    const rule = css.match(/#topbar-search-btn,\s*#topbar-mobile-toc-btn,\s*#topbar-bm-btn,\s*#topbar-settings-btn\s*\{([^}]+)\}/)[1];
    for (const declaration of [
        'padding: 0 !important;', 'background: transparent !important;',
        'border: 0 !important;', 'box-shadow: none !important;',
        'height: 100% !important;', 'max-height: 44px;',
        'font-size: 14px !important;', 'color: var(--reader-muted) !important;',
    ]) assert.ok(rule.includes(declaration), declaration);
    assert.match(css, /\.reader-topbar-actions \{ height: 100%; \}/);
});

test('page picker steps through existing pages and confirms only an actual page', () => {
    const r = navigation();
    r.element('topbar-mobile-page').handlers.click();
    assert.equal(r.element('goto-page-input').value, '7');
    assert.equal(r.element('goto-page-overlay').hidden, false);
    r.element('goto-page-next').handlers.click();
    assert.equal(r.element('goto-page-input').value, '9');
    assert.equal(r.element('goto-page-next').disabled, true);
    assert.equal(r.element('goto-page-slider').style['--goto-progress'], '100%');
    assert.deepEqual(r.jumps, []);
    r.element('goto-page-input').value = '8';
    r.element('goto-page-confirm').handlers.click();
    assert.equal(r.element('goto-page-error').hidden, false);
    assert.deepEqual(r.jumps, []);
    r.element('goto-page-slider').value = '0';
    r.element('goto-page-slider').handlers.input();
    assert.equal(r.element('goto-page-input').value, '5');
    assert.equal(r.element('goto-page-prev').disabled, true);
    r.element('goto-page-confirm').handlers.click();
    assert.deepEqual(r.jumps, [[5, false]]);
    assert.equal(r.element('goto-page-overlay').hidden, true);
});

test('page picker opens from desktop too and closes with Escape without a duplicate contents link', () => {
    const r = navigation();
    r.element('topbar-page-cur').handlers.click();
    assert.doesNotMatch(view, /goto-page-toc/);
    assert.doesNotMatch(view, /id="topbar-toc-btn"/);
    assert.equal((view.match(/id="topbar-mobile-toc-btn"/g) ?? []).length, 1);
    r.element('goto-page-overlay').handlers.keydown({ key: 'Escape', preventDefault() {} });
    assert.equal(r.element('goto-page-overlay').hidden, true);
});

test('dialog bounds adapt to the visible viewport when the software keyboard opens', () => {
    const r = navigation();
    r.context.positionReaderDialogs();
    assert.equal(r.properties.get('--reader-dialog-top'), '54px');
    assert.equal(r.properties.get('--reader-dialog-height'), '778px');
    r.viewport.height = 360;
    r.context.positionReaderDialogs();
    assert.equal(r.properties.get('--reader-dialog-height'), '294px');
    r.viewport.offsetTop = 100;
    r.context.positionReaderDialogs();
    assert.equal(r.properties.get('--reader-dialog-top'), '112px');
    assert.equal(r.properties.get('--reader-dialog-height'), '336px');
});

test('desktop settings expose the full tabbed controls instead of cycling themes or duplicating font controls', () => {
    assert.match(view, /id="topbar-settings-btn"[^>]*aria-haspopup="dialog"/);
    assert.match(view, /getElementById\('topbar-settings-btn'\)\?\.addEventListener\('click', \(\) => openSheet\('controls'\)\)/);
    assert.doesNotMatch(view, /id="topbar-(?:theme-btn|font-range|arabic-font-range|goto-input)"/);
    assert.match(view, /aria-label="Zoektekst" placeholder="Typ hier om te zoeken" maxlength="200"/);
});

function search() {
    const r = navigation();
    const panel = r.element('reader-search-panel'), backdrop = r.element('reader-search-backdrop');
    for (const element of [panel, backdrop]) {
        element.classes = new Set();
        element.classList = { add: value => element.classes.add(value), remove: value => element.classes.delete(value) };
    }
    const trigger = { getClientRects: () => [1], focus() { r.document.activeElement = trigger; } };
    const input = r.element('reader-search-input');
    input.blur = () => { r.document.activeElement = null; };
    r.document.activeElement = trigger;
    const calls = [], timers = new Map(), pending = [];
    Object.assign(r.context, {
        panel, backdrop, input, fab: trigger, closeToc() {}, AbortController,
        clearBtn: r.element('reader-search-clear'), metaEl: r.element('reader-search-meta'),
        resultsEl: r.element('reader-search-results'), keyboardDismiss: r.element('reader-search-keyboard-dismiss'),
        SEARCH_URL: '/search',
        setTimeout(fn) { const id = timers.size + 1; timers.set(id, fn); return id; },
        clearTimeout(id) { timers.delete(id); },
        fetch(url, options) { return new Promise(resolve => pending.push({ url, options, resolve })); },
        renderResults(...args) { calls.push(args); },
    });
    vm.runInContext(view.slice(view.indexOf('let currentMark = null'), view.indexOf('function clearAllHighlights()')), r.context);
    vm.runInContext(view.slice(view.indexOf('function debounceSearch()'), view.indexOf('function renderResults(')), r.context);
    return { ...r, panel, backdrop, input, trigger, calls, timers, pending };
}

test('search opens empty and focused and closes immediately without a delayed hide racing a reopen', () => {
    const r = search();
    const { panel, backdrop, input, trigger } = r;
    r.context.openSearch();
    assert.equal(panel.hidden, false);
    assert.equal(panel.classes.has('open'), true);
    assert.equal(r.document.activeElement, input);
    r.context.closeSearch();
    assert.equal(panel.hidden, true);
    assert.equal(backdrop.classes.has('open'), false);
    assert.equal(r.document.activeElement, trigger);
    r.context.openSearch();
    assert.equal(panel.hidden, false);
    assert.equal(r.document.activeElement, input);
    assert.equal(input.value, '');
    assert.equal(r.element('reader-search-clear').hidden, true);
});

test('search aborts stale requests on new text, clearing and closing; only latest results render', async () => {
    const r = search();
    r.context.openSearch();
    r.input.value = 'geloof';
    r.context.debounceSearch();
    const first = r.context.runSearch();
    assert.equal(r.panel['aria-busy'], 'true');
    r.input.value = 'licht';
    r.context.debounceSearch();
    assert.equal(r.pending[0].options.signal.aborted, true);
    const second = r.context.runSearch();
    r.pending[1].resolve({ ok: true, json: async () => ({ results: [{ page: 5, snippet: 'licht' }], total: 1 }) });
    await second;
    r.pending[0].resolve({ ok: true, json: async () => ({ results: [], total: 0 }) });
    await first;
    assert.equal(r.calls.length, 1);
    assert.equal(r.calls[0][2], 'licht');
    assert.equal(r.panel['aria-busy'], undefined);
    r.input.value = 'li';
    r.context.debounceSearch();
    const closing = r.context.runSearch();
    r.context.closeSearch();
    assert.equal(r.pending[2].options.signal.aborted, true);
    r.pending[2].resolve({ ok: true, json: async () => ({ results: [], total: 0 }) });
    await closing;
    assert.equal(r.calls.length, 1);
    assert.equal(r.element('reader-search-meta').textContent, '');
    assert.equal(r.timers.size, 0);
    r.input.value = 'a';
    r.context.debounceSearch();
    assert.equal(r.timers.size, 0);
});

test('search reports HTTP and malformed response errors instead of showing success', async () => {
    for (const response of [{ ok: false }, { ok: true, json: async () => ({ results: null }) }]) {
        const r = search();
        r.input.value = 'geloof';
        const request = r.context.runSearch();
        r.pending[0].resolve(response);
        await request;
        assert.equal(r.element('reader-search-meta').role, 'alert');
        assert.match(r.element('reader-search-meta').textContent, /niet gelukt/);
        assert.equal(r.calls.length, 0);
    }
});

test('search displays the app result count, including zero and singular results', () => {
    const r = search();
    const start = view.indexOf('function renderResults(');
    vm.runInContext(view.slice(start, view.indexOf('\n        })();', start)), r.context);
    for (const [total, expected] of [[0, '0 resultaten'], [1, '1 resultaat'], [28, '28 resultaten']]) {
        r.context.renderResults([], total, 'geloof');
        assert.equal(r.element('reader-search-meta').textContent, expected);
    }
});

test('search offers keyboard dismissal only while the focused field has a reduced viewport', () => {
    const r = search();
    r.context.openSearch();
    r.context.syncSearchKeyboard();
    assert.equal(r.element('reader-search-keyboard-dismiss').hidden, true);
    r.viewport.height = 360;
    r.context.syncSearchKeyboard();
    assert.equal(r.element('reader-search-keyboard-dismiss').hidden, false);
    r.input.blur();
    r.context.syncSearchKeyboard();
    assert.equal(r.element('reader-search-keyboard-dismiss').hidden, true);
});

test('contents marks only the last chapter at or before the current page with an accessible label', () => {
    const r = navigation();
    const items = [5, 7, 7, 9].map((page, index) => {
        const element = r.element('toc-' + index);
        element.dataset = { page: String(page) };
        element.classes = new Set();
        element.classList = { add: value => element.classes.add(value), remove: value => element.classes.delete(value) };
        element.getAttribute = key => element[key];
        element.querySelector = () => ({ textContent: 'Hoofdstuk ' + index });
        return element;
    });
    r.context.tocPanelBody = { querySelectorAll: () => items };
    vm.runInContext(view.slice(view.indexOf('function markActiveTocItem()'), view.indexOf('let tocTrigger = null')), r.context);
    r.context.markActiveTocItem();
    assert.deepEqual(items.map(item => item.classes.has('active')), [false, false, true, false]);
    assert.equal(items[2]['aria-current'], 'location');
    assert.equal(items[2]['aria-label'], 'Hoofdstuk 2, pagina 7, huidige hoofdstuk');
    r.context.markActiveTocItem();
    assert.equal(items[2]['aria-label'], 'Hoofdstuk 2, pagina 7, huidige hoofdstuk');
});

test('search and contents match app fields, inline results and wrapping chapter rows', () => {
    assert.match(css, /#reader-search-input\s*\{[^}]*border: 0 !important/);
    assert.match(css, /:is\(#reader-search-backdrop, #toc-backdrop\)\s*\{[^}]*background: transparent;[^}]*backdrop-filter: none/);
    assert.match(view, /pageBadge.textContent = 'p\.' \+ r.page \+ ' · '/);
    assert.match(css, /\.reader-search-result-item\s*\{[^}]*flex: 0 0 auto; height: auto/);
    assert.match(view, /setTimeout\(runSearch, 120\)/);
    assert.match(css, /#toc-panel \.toc-panel-item-title\s*\{[^}]*white-space: normal/);
    assert.match(css, /#toc-panel \.toc-panel-item\.active\s*\{[^}]*border-left: 3px/);
    assert.doesNotMatch(view, /active\.scrollIntoView/);
    assert.match(view, /aria-current', 'location'/);
    assert.match(view, /id="reader-search-keyboard-dismiss"/);
    assert.match(view, /id="sheet-menu-clear-search"/);
});

test('dialog keyboard focus wraps only through visible enabled controls', () => {
    const r = navigation();
    const first = r.element('first'), last = r.element('last');
    first.getClientRects = last.getClientRects = () => [1];
    const disabled = { disabled: true }, hidden = { getClientRects: () => [] };
    const container = { querySelectorAll: () => [first, disabled, hidden, last] };
    let prevented = false;
    last.focus();
    r.context.trapReaderDialogFocus({ key: 'Tab', preventDefault() { prevented = true; } }, container);
    assert.equal(prevented, true);
    assert.equal(r.document.activeElement, first);
    r.context.trapReaderDialogFocus({ key: 'Tab', shiftKey: true, preventDefault() {} }, container);
    assert.equal(r.document.activeElement, last);
});
