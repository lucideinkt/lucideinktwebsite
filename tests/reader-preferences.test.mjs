import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';
import vm from 'node:vm';

const view = readFileSync(new URL('../resources/views/online-lezen-html-reader.blade.php', import.meta.url), 'utf8');
const css = readFileSync(new URL('../resources/css/reader-preferences.css', import.meta.url), 'utf8');
const readerScript = readFileSync(new URL('../resources/js/features/reader-book.js', import.meta.url), 'utf8');
const layoutScript = view.slice(view.indexOf('function preferenceStorageError('), view.indexOf('function visiblePage('));
const themeScript = view.slice(view.indexOf("const THEME_KEY = 'reader-theme'"), view.indexOf('// --- TOC Panel ---'));

test('Bismillah wrappers retain both original variants and apply a theme-colored alpha mask without changing the image', () => {
    const images = ['bismillah-svg bismillah-svg-light', 'bismillah-svg bismillah-svg-dark'].map(className => ({
        className, src: 'https://example.test/bismillah%20.svg', replaceWith(wrapper) { this.wrapper = wrapper; },
    }));
    const document = {
        createElement(tag) {
            return { tag, style: { setProperty(key, value) { this[key] = value; } },
                appendChild(child) { this.child = child; } };
        },
    };
    const context = vm.createContext({ document });
    vm.runInContext(readerScript.slice(readerScript.indexOf('function themeBismillahImages('),
        readerScript.indexOf('function wireFootnotesForPage(')), context);
    const page = { querySelectorAll(selector) { assert.equal(selector, 'img.bismillah-svg'); return images.filter(image => image.className); } };
    context.themeBismillahImages(page);
    for (const [index, image] of images.entries()) {
        assert.equal(image.wrapper.className, `bismillah-svg bismillah-svg-${index ? 'dark' : 'light'} reader-themed-image`);
        assert.equal(image.wrapper.child, image);
        assert.equal(image.wrapper.style['--image-mask'], 'url("https://example.test/bismillah%20.svg")');
    }
    const wrapper = images[0].wrapper;
    context.themeBismillahImages(page);
    assert.equal(images[0].wrapper, wrapper, 'wrapping is idempotent');
    assert.match(css, /:not\(\[data-reader-theme="light"\]\):not\(\[data-reader-theme="dark"\]\) \.book-reader-scope \.reader-themed-image\s*\{[^}]*mask: var\(--image-mask\)/);
    assert.match(css, /:is\(\.fn-ref, \.sup-pointer\)\s*\{[^}]*background: var\(--reader-accent\) !important;[^}]*color: var\(--reader-active-ink\) !important/);
    assert.match(css, /:is\(\.fn-ref-num, \.sup-pointer-num\)\s*\{[^}]*color: var\(--reader-active-ink\) !important/);
});

function reader(saved = {}) {
    const storage = new Map(Object.entries(saved));
    const properties = new Map(), elements = new Map(), classes = new Set(), system = { matches: false };
    const errors = [], events = [], anchors = [];
    let systemChange;
    function element(id) {
        if (!elements.has(id)) elements.set(id, {
            value: '', textContent: '', attributes: new Map(), handlers: {},
            step: id === 'reader-line-height' ? '0.1' : '4',
            hidden: id === 'reader-settings-colors', tabIndex: 0,
            focus() { this.focused = true; },
            click() { this.handlers.click?.(); },
            addEventListener(event, callback) { this.handlers[event] = callback; },
            setAttribute(name, value) { this.attributes.set(name, value); },
        });
        return elements.get(id);
    }
    const themes = ['system', 'light', 'dark', 'ivory', 'white', 'sepia', 'green', 'gray', 'night', 'black'].map(theme => ({
        ...element(theme), dataset: { theme }, classList: { toggle() {} },
    }));
    const classList = {
        toggle(name, active) { if (active) classes.add(name); else classes.delete(name); },
        remove(name) { classes.delete(name); },
    };
    const document = {
        body: { dataset: {}, classList },
        documentElement: { dataset: {}, classList, style: { setProperty: (key, value) => properties.set(key, value) } },
        getElementById: element,
        querySelector() { return {}; },
        querySelectorAll() { return themes; },
        dispatchEvent(event) { events.push(event.type); },
    };
    const context = vm.createContext({
        document, localStorage: {
            getItem(key) { return storage.get(key) ?? null; },
            setItem(key, value) { storage.set(key, value); },
        },
        window: {
            showToast(message) { errors.push(message); },
            matchMedia() { return { ...system, addEventListener(_, callback) { systemChange = callback; } }; },
        },
        console: { error(...args) { errors.push(args); } },
        Event: class { constructor(type) { this.type = type; } },
        getComputedStyle() { return { paddingLeft: '32px' }; },
        captureAnchor() { anchors.push('capture'); return { top: 100 }; },
        restoreAnchor() { anchors.push('restore'); },
    });
    vm.runInContext(layoutScript + themeScript, context);
    return { storage, properties, document, element, themes, errors, events, anchors, context,
        setDark(value) { system.matches = value; systemChange(); } };
}

test('new layout preferences preserve existing data and restore the page anchor', () => {
    const r = reader({ 'reader-theme': 'sepia', 'reader-font-size': '21', bookmarks: '[12]' });
    assert.equal(r.properties.get('--reader-line-height'), '1.5');
    assert.equal(r.properties.get('--reader-side-padding'), '32px', 'desktop retains its original padding');
    const spacing = r.element('reader-line-height');
    spacing.value = '2.1';
    spacing.handlers.input();
    assert.equal(r.storage.get('reader-line-height'), '2.1');
    assert.equal(r.properties.get('--reader-line-height'), '2.1');
    assert.deepEqual(r.anchors, ['capture', 'restore']);
    assert.deepEqual(r.events, ['reader-layout-change']);
    assert.equal(r.storage.get('bookmarks'), '[12]');
    assert.equal(r.storage.get('reader-font-size'), '21');
    r.element('reader-line-height-reset').handlers.click();
    assert.equal(r.properties.get('--reader-line-height'), '1.5');
    assert.equal(r.storage.get('reader-line-height'), '1.5');
});

test('saved layout values are bounded and non-finite or invalid inputs use defaults', () => {
    for (const [value, expected] of [['9', '2.2'], ['-2', '1.2'], ['NaN', '1.5'], ['Infinity', '1.5'], ['1.74', '1.7'], ['', '1.5']]) {
        assert.equal(reader({ 'reader-line-height': value }).properties.get('--reader-line-height'), expected);
    }
    assert.equal(reader({ 'reader-side-padding': '999' }).properties.get('--reader-side-padding'), '64px');
    assert.equal(reader({ 'reader-side-padding': '64' }).element('reader-side-padding-value').textContent, '64');
    assert.match(view, /'label' => 'Zijruimte', 'min' => '8', 'max' => '64'/);
    assert.equal(reader({ 'reader-side-padding': '-1' }).properties.get('--reader-side-padding'), '8px');
    assert.equal(reader({ 'reader-line-height': '1.2' }).properties.get('--reader-arabic-line-scale'), '1');
    const r = reader();
    const padding = r.element('reader-side-padding');
    padding.value = '40'; padding.handlers.input();
    assert.equal(reader(Object.fromEntries(r.storage)).properties.get('--reader-side-padding'), '40px');
});

test('layout steppers use the actual setting bounds, save and preserve the anchor', () => {
    const r = reader();
    r.element('reader-line-height-inc').click();
    assert.equal(r.storage.get('reader-line-height'), '1.6');
    r.element('reader-line-height-dec').click();
    assert.equal(r.storage.get('reader-line-height'), '1.5');
    r.element('reader-side-padding-inc').click();
    assert.equal(r.storage.get('reader-side-padding'), '36');
    r.element('reader-side-padding-dec').click();
    assert.equal(r.storage.get('reader-side-padding'), '32');
    for (let i = 0; i < 30; i++) r.element('reader-side-padding-inc').click();
    assert.equal(r.storage.get('reader-side-padding'), '64');
    for (let i = 0; i < 30; i++) r.element('reader-line-height-dec').click();
    assert.equal(r.storage.get('reader-line-height'), '1.2');
    assert.equal(r.anchors.length, 128);
});

test('settings tabs keep text and colors separate and color reset leaves all text preferences unchanged', () => {
    const r = reader({ 'reader-theme': 'sepia', 'reader-font-size': '21', 'reader-line-height': '1.8', 'reader-side-padding': '40', bookmarks: '[12]', highlights: '[7]' });
    vm.runInContext(view.slice(view.indexOf('// --- Reader settings tabs ---'), view.indexOf('// --- End reader settings tabs ---')), r.context);
    r.element('reader-settings-tab-colors').click();
    assert.equal(r.element('reader-settings-text').hidden, true);
    assert.equal(r.element('reader-settings-colors').hidden, false);
    assert.equal(r.element('reader-settings-tab-colors').attributes.get('aria-selected'), 'true');
    assert.equal(r.element('reader-settings-tab-text').tabIndex, -1);
    let prevented = false;
    r.element('reader-settings-tab-colors').handlers.keydown({ key: 'ArrowLeft', preventDefault() { prevented = true; } });
    assert.equal(prevented, true);
    assert.equal(r.element('reader-settings-text').hidden, false);
    assert.equal(r.element('reader-settings-colors').hidden, true);
    assert.equal(r.element('reader-settings-tab-text').focused, true);
    r.element('reader-theme-reset').click();
    assert.equal(r.storage.get('reader-theme'), 'system');
    assert.equal(r.storage.get('reader-font-size'), '21');
    assert.equal(r.storage.get('reader-line-height'), '1.8');
    assert.equal(r.storage.get('reader-side-padding'), '40');
    assert.equal(r.storage.get('bookmarks'), '[12]');
    assert.equal(r.storage.get('highlights'), '[7]');
    assert.doesNotMatch(view, /id="reader-settings-reset"/);
    assert.match(view, /id="reader-theme-reset"[\s\S]*?<\/div>\s*<div class="reader-sheet-bottom-safe"/);
});

test('individual layout resets leave other settings and the theme unchanged', () => {
    const r = reader({ 'reader-theme': 'sepia', 'reader-font-size': '21', 'reader-line-height': '1.8', 'reader-side-padding': '40' });
    r.element('reader-line-height-reset').click();
    assert.equal(r.storage.get('reader-line-height'), '1.5');
    assert.equal(r.storage.get('reader-side-padding'), '40');
    r.element('reader-side-padding-reset').click();
    assert.equal(r.storage.get('reader-side-padding'), '32');
    assert.equal(r.storage.get('reader-font-size'), '21');
    assert.equal(r.storage.get('reader-theme'), 'sepia');
    assert.match(css, /\.reader-sheet-reset-btn\s*\{[^}]*min-width: 44px; min-height: 44px;/);
});

test('flat themes replace the visible paper layer rather than only changing the body underneath it', () => {
    assert.match(css, /body\[data-reader-theme\]:not\(\[data-reader-theme="light"\]\):not\(\[data-reader-theme="dark"\]\) \.online-reader-html\s*\{\s*background: var\(--reader-bg\);/);
    assert.match(css, /#reader-control-sheet\s*\{[^}]*overflow-y: auto;/);
    assert.match(view, /id="reader-settings-tab-text"[^>]*role="tab"[^>]*aria-controls="reader-settings-text"/);
    assert.match(view, /id="reader-settings-tab-colors"[^>]*role="tab"[^>]*aria-controls="reader-settings-colors"/);
});

test('round theme previews keep the actual background/text pairs independent of the selected theme', () => {
    for (const [theme, background, ink] of [
        ['ivory', '#f8f5eb', '#302d28'], ['white', '#faf9f6', '#252525'],
        ['sepia', '#f2e6d1', '#46392a'], ['green', '#eff3eb', '#24352d'],
        ['gray', '#1e2226', '#e4e2dd'], ['black', '#000000', '#d8d8d8'],
        ['night', '#1e1e1e', '#e5e5e5'],
    ]) {
        assert.ok(css.includes(`[data-theme="${theme}"] { --swatch-bg: ${background}; --swatch-ink: ${ink}; }`));
    }
    assert.match(view, /class="reader-theme-swatch" aria-hidden="true">Aa<\/span>/);
    assert.match(css, /\.reader-theme-swatch\s*\{[^}]*border-radius: 50%;[^}]*background: var\(--swatch-bg\) !important;[^}]*color: var\(--swatch-ink\) !important;/);
    assert.match(css, /font-family: 'DelimaMTProRegular', serif !important;/);
});

test('all fixed themes persist; only system follows OS changes and legacy values migrate', () => {
    const r = reader();
    assert.equal(r.document.body.dataset.readerTheme, 'light');
    r.setDark(true);
    assert.equal(r.document.body.dataset.readerTheme, 'dark');
    for (const button of r.themes.filter(button => button.dataset.theme !== 'system')) {
        button.handlers.click();
        const theme = button.dataset.theme;
        assert.equal(r.document.body.dataset.readerTheme, theme);
        assert.equal(r.document.documentElement.dataset.readerTheme, theme);
        assert.equal(r.storage.get('reader-theme'), theme);
        assert.equal(button.attributes.get('aria-pressed'), 'true');
        r.setDark(false);
        assert.equal(r.document.body.dataset.readerTheme, theme);
        assert.equal(reader({ 'reader-theme': theme }).document.body.dataset.readerTheme, theme);
    }
    assert.equal(reader({ 'reader-dark-mode': '0' }).document.body.dataset.readerTheme, 'light');
    assert.equal(reader({ 'reader-theme': 'invalid' }).document.body.dataset.readerTheme, 'light');
    for (const [theme, background, ink] of [
        ['ivory', '#f8f5eb', '#302d28'], ['white', '#faf9f6', '#252525'],
        ['sepia', '#f2e6d1', '#46392a'], ['green', '#eff3eb', '#24352d'],
        ['gray', '#1e2226', '#e4e2dd'], ['black', '#000000', '#d8d8d8'],
    ]) {
        const block = css.match(new RegExp(`:root\\[data-reader-theme="${theme}"\\]\\s*\\{([^}]+)\\}`))[1];
        assert.ok(block.includes(`--reader-bg: ${background};`), `${theme} background`);
        assert.ok(block.includes(`--reader-ink: ${ink};`), `${theme} text`);
    }
    assert.match(css, /:root\[data-reader-theme="night"\]\s*\{[^}]*--reader-bg: #1e1e1e;[^}]*--reader-ink: #e5e5e5/);
    assert.doesNotMatch(css, /:root\[data-reader-theme="dark"\]\s*\{/);
    assert.match(view, /'night' => 'Nachtmodus'/);
    assert.match(view, /'black' => 'Zwart'/);
    for (const selector of css.matchAll(/(?:html|body)\[data-reader-theme\]([^{}]*(?:\.book-reader-scope|\.online-reader-html)[^{}]*)\{/g)) {
        assert.ok(selector[1].includes(':not([data-reader-theme="dark"])'), 'Original Donker keeps its original reading-content CSS');
    }
});

test('ordinary footnote badges are raised slightly while Arabic keeps its existing offsets', () => {
    const bookCss = readFileSync(new URL('../resources/css/reader-book.css', import.meta.url), 'utf8');
    assert.equal([...bookCss.matchAll(/top: var\(--fn-badge-raise, -4px\);/g)].length, 2);
    for (const offset of ['6px', '-7px', '11px']) {
        assert.ok(bookCss.includes(`--fn-badge-raise: ${offset};`));
    }
});

test('dark extra themes have distinct coordinated accents and secondary text for content and controls', () => {
    for (const [theme, accent, muted] of [
        ['gray', '#a9cce8', '#a5b3bf'],
        ['night', '#b8c9ad', '#a6afa0'],
        ['black', '#c8b78f', '#aaa394'],
    ]) {
        const block = css.match(new RegExp(`:root\\[data-reader-theme="${theme}"\\]\\s*\\{([^}]+)\\}`))[1];
        assert.ok(block.includes(`--reader-accent: ${accent};`), `${theme} accent`);
        assert.ok(block.includes(`--reader-muted: ${muted};`), `${theme} secondary text`);
    }
    assert.match(css, /:is\(\[data-reader-theme="gray"\], \[data-reader-theme="night"\], \[data-reader-theme="black"\]\) \.book-reader-scope :is\(h1, h2, h3, h4, \.book-title, \.small-title\)\s*\{\s*color: var\(--reader-accent\) !important/);
});

test('menu and appearance settings hide their headers while the saved library retains its header', () => {
    const r = reader();
    const controlSheet = { scrollTop: 100, classList: { contains: () => false } };
    r.context.controlSheet = controlSheet;
    vm.runInContext(view.slice(view.indexOf('function showPanel(which)'), view.indexOf('let sheetTrigger = null')), r.context);
    for (const [panel, hidden, title] of [
        ['menu', true, 'Leesmenu'], ['controls', true, 'Leesinstellingen'],
        ['library', false, 'Bladwijzers en markeringen'], ['menu', true, 'Leesmenu'],
    ]) {
        r.context.showPanel(panel);
        assert.equal(r.element('reader-sheet-header').hidden, hidden);
        assert.equal(r.element('reader-sheet-heading').textContent, title);
        assert.equal(r.element(`sheet-panel-${panel}`).hidden, false);
        assert.equal(controlSheet.scrollTop, 0);
    }
    assert.match(css, /\.reader-settings-heading\[hidden\]\s*\{\s*display: none;/);
    assert.match(view, /document\.getElementById\(which === 'controls' \? 'sheet-panel-controls' : 'sheet-panel-menu'\)\.querySelector\('button'\)\?\.focus/);
});

test('storage failures are reported while the selected preference remains usable', () => {
    const r = reader();
    vm.runInContext("localStorage.setItem = () => { throw new Error('Storage unavailable'); }", r.context);
    r.themes.find(button => button.dataset.theme === 'black').handlers.click();
    assert.equal(r.document.body.dataset.readerTheme, 'black');
    assert.ok(r.errors.length > 0);
});
