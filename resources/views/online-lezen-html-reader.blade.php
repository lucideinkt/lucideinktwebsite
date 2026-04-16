<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">


    @php
        $seoTitle       = $SEOData->title       ?? ($product->title . ' | Online Lezen | Lucide Inkt');
        $seoDescription = $SEOData->description ?? ($product->short_description ?? 'Lees ' . $product->title . ' online bij Lucide Inkt.');
        $seoUrl         = $SEOData->url         ?? url()->current();
        $seoImage       = $SEOData->image       ?? ($product->image_1 ? secure_url($product->image_1) : secure_url('images/books_standing_new.webp'));
        $seoAuthor      = $SEOData->author      ?? 'Lucide Inkt';
    @endphp

    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="author" content="{{ $seoAuthor }}">
    <link rel="canonical" href="{{ $seoUrl }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="article">
    <meta property="og:locale"      content="nl_NL">
    <meta property="og:site_name"   content="Lucide Inkt">
    <meta property="og:title"       content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url"         content="{{ $seoUrl }}">
    <meta property="og:image"       content="{{ $seoImage }}">
    <meta property="og:image:alt"   content="{{ $product->title }}">
    @if($product->created_at)
    <meta property="article:published_time" content="{{ $product->created_at->toIso8601String() }}">
    @endif
    @if($product->updated_at)
    <meta property="article:modified_time"  content="{{ $product->updated_at->toIso8601String() }}">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image"       content="{{ $seoImage }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/js/main.js', 'resources/css/front-end-style.css'])
    <style>
        /* Reader loading overlay */
        #reader-loader {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.86);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 180ms ease, visibility 180ms ease;
        }
        #reader-loader.visible { opacity: 1; visibility: visible; }
        #reader-loader .spinner {
            width: 64px;
            height: 64px;
            border: 6px solid rgba(0,0,0,0.12);
            border-top-color: #7b3f3f;
            border-radius: 50%;
            animation: reader-spin 1s linear infinite;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        @keyframes reader-spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>
<div class="online-reader-html">

    {{-- Topbalk --}}
    <header class="reader-topbar" role="banner">
        <div class="reader-topbar-left">
            <a href="{{ route('onlineLezen') }}" class="reader-back-btn" aria-label="Terug naar bibliotheek">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Bibliotheek
            </a>
            <div class="reader-topbar-divider" aria-hidden="true"></div>
            <span class="reader-book-title">{{ $product->title }}</span>
        </div>

            <div class="reader-topbar-right" role="toolbar" aria-label="Lezeropties">
            <span class="reader-topbar-page-badge" id="topbar-page-badge" aria-live="polite"></span>
        </div>
    </header>

    {{-- Progress bar — slim, just below topbar --}}
    <div class="reader-progress-bar-wrap" role="progressbar" aria-label="Leesvoortgang" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        <div class="reader-progress-bar-fill" id="progress-fill"></div>
    </div>

    {{-- Boekinhoud --}}
    <main class="reader-wrap">
        <article class="book-reader-scope" id="reader-content" lang="nl" role="main"
            data-product-id="{{ $product->id }}"
            data-api-url="{{ route('onlineLezenPagesApi', $product->slug) }}"
            data-last-page="{{ $pages->last()->page_number }}"
            data-total-pages="{{ $allPageMeta->max('page_number') }}"
        >
            @php $bookTitle = $pages->first()?->book_title; @endphp
            @if($bookTitle)
            <div class="text-center page-title-series">
                <p>Uit de Reeks van de Risale-i Nur</p>
                <h1 class="book-title">{{ $bookTitle }}</h1>
                <p>Bedi&uuml;zzaman Said Nurs&icirc;</p>
            </div>
            @endif

            @foreach($pages as $page)
                {!! $page->content !!}
                <div class="end-of-page-hr"></div>
            @endforeach

            {{-- Sentinel: IntersectionObserver watches this to trigger lazy loading --}}
            <div id="lazy-sentinel" style="height:1px;"></div>
        </article>

        <div class="reader-end">
            <p>&#10022; &nbsp; Einde &nbsp; &#10022;</p>
            <a href="{{ route('onlineLezen') }}" class="btn-terug">
                Naar de Bibliotheek
            </a>
        </div>
    </main>

    {{-- FAB — floating action button (bottom-right, thumb-reachable) --}}
    <button class="reader-fab" id="reader-fab" aria-label="Lezeropties" aria-expanded="false" aria-haspopup="dialog">
        <span class="reader-fab-icon-wrap" aria-hidden="true">
            <i class="fa-solid fa-sliders reader-fab-icon"></i>
        </span>
        <span class="reader-fab-page-wrap">
            <span class="reader-fab-page" id="fab-page-current">&mdash;</span>
            <span class="reader-fab-page-sub">
                <span class="reader-fab-sep">/</span>
                <span class="reader-fab-total">{{ $allPageMeta->max('page_number') }}</span>
            </span>
        </span>
    </button>


    {{-- ────── Control Sheet ────── --}}
    <div class="reader-control-sheet" id="reader-control-sheet" role="dialog" aria-label="Lezeropties" aria-hidden="true">
        {{-- Drag handle --}}
        <div class="reader-sheet-drag-handle" aria-hidden="true"></div>

        {{-- Progress bar --}}
        <div class="reader-sheet-progress-wrap" aria-hidden="true">
            <div class="reader-sheet-progress-fill" id="sheet-progress-fill"></div>
        </div>

        {{-- Tabs --}}
        <div class="reader-sheet-tabs" role="tablist">
            <button class="reader-sheet-tab active" id="sheet-tab-controls" data-tab="controls" role="tab" aria-selected="true">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i><span>Instellingen</span>
            </button>
            <button class="reader-sheet-tab" id="sheet-tab-library" data-tab="library" role="tab" aria-selected="false">
                <i class="fa-solid fa-bookmark" aria-hidden="true"></i><span>Bibliotheek</span>
            </button>
        </div>

        {{-- Controls panel --}}
        <div id="sheet-panel-controls">

        {{-- Page navigation --}}
        <div class="reader-sheet-section reader-sheet-nav-section">
            <button class="reader-sheet-arrow" id="sheet-prev-btn" aria-label="Vorige pagina" title="Vorige pagina">
                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
            </button>
            <div class="reader-sheet-page-display">
                <span class="reader-sheet-page-num" id="sheet-page-current">&mdash;</span>
                <span class="reader-sheet-page-sep">/</span>
                <span class="reader-sheet-page-total">{{ $allPageMeta->max('page_number') }}</span>
            </div>
            <button class="reader-sheet-arrow" id="sheet-next-btn" aria-label="Volgende pagina" title="Volgende pagina">
                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
            </button>
        </div>

        {{-- Page slider --}}
        <div class="reader-sheet-section reader-sheet-slider-row">
            <div class="reader-sheet-slider-meta">
                <span class="reader-sheet-slider-label"><i class="fa-solid fa-book-open" aria-hidden="true"></i> Pagina</span>
                <span class="reader-sheet-slider-preview" id="sheet-page-preview">{{ $allPageMeta->min('page_number') }}</span>
            </div>
            <input type="range" class="reader-sheet-slider" id="sheet-page-slider"
                   min="{{ $allPageMeta->min('page_number') }}"
                   max="{{ $allPageMeta->max('page_number') }}"
                   value="{{ $allPageMeta->min('page_number') }}"
                   aria-label="Ga naar pagina">
            <div class="reader-sheet-slider-ends">
                <span>{{ $allPageMeta->min('page_number') }}</span>
                <span>{{ $allPageMeta->max('page_number') }}</span>
            </div>
        </div>

        <div class="reader-sheet-divider"></div>

        {{-- Text font size --}}
        <div class="reader-sheet-section reader-sheet-slider-row">
            <div class="reader-sheet-slider-meta">
                <span class="reader-sheet-slider-label"><i class="fa-solid fa-font" aria-hidden="true"></i> Tekst</span>
                <div class="reader-sheet-slider-right">
                    <span class="reader-sheet-slider-val" id="sheet-font-val" aria-live="polite">18.0px</span>
                    <button class="reader-sheet-reset-btn" id="sheet-font-reset" type="button" aria-label="Lettergrootte resetten">↺</button>
                </div>
            </div>
            <input type="range" class="reader-sheet-slider" id="font-slider"
                   min="12" max="36" step="0.1" value="18"
                   aria-label="Lettergrootte tekst">
        </div>

        {{-- Arabic font size --}}
        <div class="reader-sheet-section reader-sheet-slider-row">
            <div class="reader-sheet-slider-meta">
                <span class="reader-sheet-slider-label"><i class="fa-solid fa-language" aria-hidden="true"></i> Arabisch</span>
                <div class="reader-sheet-slider-right">
                    <span class="reader-sheet-slider-val" id="arabic-font-size-display" aria-live="polite">28.0px</span>
                    <button class="reader-sheet-reset-btn" id="arabic-font-reset" type="button" aria-label="Arabische lettergrootte resetten">↺</button>
                </div>
            </div>
            <input type="range" class="reader-sheet-slider" id="arabic-font-slider"
                   min="16" max="52" step="0.1" value="28"
                   aria-label="Lettergrootte Arabisch">
        </div>

        <div class="reader-sheet-divider"></div>

        {{-- Theme --}}
        <div class="reader-sheet-section reader-sheet-theme-section">
            <span class="reader-sheet-section-label">Weergave</span>
            <div class="reader-sheet-theme-row">
                <button class="reader-sheet-theme-btn" data-theme="system" type="button" aria-label="Systeemthema">
                    <i class="fa-solid fa-circle-half-stroke" aria-hidden="true"></i><span>Systeem</span>
                </button>
                <button class="reader-sheet-theme-btn" data-theme="light" type="button" aria-label="Licht thema">
                    <i class="fa-solid fa-sun" aria-hidden="true"></i><span>Licht</span>
                </button>
                <button class="reader-sheet-theme-btn" data-theme="dark" type="button" aria-label="Donker thema">
                    <i class="fa-solid fa-moon" aria-hidden="true"></i><span>Donker</span>
                </button>
            </div>
        </div>

        @if(!empty($tocEntries))
        <div class="reader-sheet-divider"></div>
        <div class="reader-sheet-section reader-sheet-toc-section">
            <button class="reader-sheet-toc-btn" id="sheet-toc-btn" type="button">
                <i class="fa-solid fa-list" aria-hidden="true"></i> Inhoudsopgave
            </button>
        </div>
        @endif

        <div class="reader-sheet-bottom-safe"></div>
        </div>{{-- /sheet-panel-controls --}}

        {{-- Library panel: bookmarks + highlights across all books --}}
        <div id="sheet-panel-library" hidden>
            <div class="reader-lib-block">
                <div class="reader-lib-block-header">
                    <span><i class="fa-solid fa-bookmark" aria-hidden="true"></i> Bladwijzers</span>
                    <button class="reader-lib-clear-all" id="lib-clear-bookmarks" type="button">Wis alles</button>
                </div>
                <div class="reader-lib-list" id="lib-bookmarks-list"></div>
            </div>
            <div class="reader-lib-separator"></div>
            <div class="reader-lib-block">
                <div class="reader-lib-block-header">
                    <span><i class="fa-solid fa-highlighter" aria-hidden="true"></i> Markeringen</span>
                    <button class="reader-lib-clear-all" id="lib-clear-highlights" type="button">Wis alles</button>
                </div>
                <div class="reader-lib-list" id="lib-highlights-list"></div>
            </div>
            <div class="reader-sheet-bottom-safe"></div>
        </div>

    </div>
    <div class="reader-sheet-backdrop" id="reader-sheet-backdrop" aria-hidden="true"></div>

    {{-- Inhoudsopgave panel (sidebar drawer) — only rendered when the book has TOC entries --}}
    @if(!empty($tocEntries))
    <nav id="toc-panel" class="toc-panel" role="dialog" aria-label="Inhoudsopgave" aria-hidden="true">
        <div class="toc-panel-header">
            <span class="toc-panel-title"><i class="fa-solid fa-list" style="margin-right:7px;font-size:12px;opacity:0.6;" aria-hidden="true"></i>Inhoudsopgave</span>
            <button class="toc-panel-close" id="toc-close-btn" aria-label="Sluit inhoudsopgave">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
        </div>
        <div class="toc-panel-body" id="toc-panel-body">
            {{-- Items worden ingevuld door JavaScript --}}
        </div>
    </nav>
    <div id="toc-backdrop" class="toc-backdrop" aria-hidden="true"></div>
    @endif

    {{-- Highlight / selection popup --}}
    <div class="hl-popup" id="hl-popup" hidden role="toolbar" aria-label="Tekst opties">
        <button class="hl-color-btn" data-color="yellow" title="Geel"   aria-label="Geel markeren"></button>
        <button class="hl-color-btn" data-color="green"  title="Groen"  aria-label="Groen markeren"></button>
        <button class="hl-color-btn" data-color="blue"   title="Blauw"  aria-label="Blauw markeren"></button>
        <button class="hl-color-btn" data-color="pink"   title="Roze"   aria-label="Roze markeren"></button>
        <button class="hl-color-btn" data-color="orange" title="Oranje" aria-label="Oranje markeren"></button>
        <div class="hl-popup-sep" aria-hidden="true"></div>
        <button class="hl-action-btn" id="hl-copy-btn" title="Kopiëren" aria-label="Tekst kopiëren">
            <i class="fa-solid fa-copy" aria-hidden="true"></i>
        </button>
        <button class="hl-action-btn" id="hl-bookmark-btn" title="Bladwijzer" aria-label="Bladwijzer toevoegen">
            <i class="fa-solid fa-bookmark" aria-hidden="true"></i>
        </button>
        <button class="hl-action-btn" id="hl-remove-btn" title="Verwijder markering" aria-label="Markering verwijderen" hidden>
            <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
        </button>
    </div>

    {{-- Loading overlay shown while pages load --}}
    <div id="reader-loader" aria-hidden="true">
        <div class="spinner" role="status" aria-label="Pagina wordt geladen"></div>
    </div>

    <script>
    (function () {
        const TOPBAR_H    = 46;
        const STORAGE_KEY = 'reading_progress_{{ $product->id }}';
        const FONT_KEY    = 'reading_fontsize_{{ $product->id }}';
        const ARABIC_FONT_KEY = 'reading_arabicfontsize_{{ $product->id }}';
        const DEFAULT_FONT = 18;
        const DEFAULT_ARABIC_FONT = 28;
        // Cross-book meta
        const PRODUCT_ID    = {{ $product->id }};
        const PRODUCT_TITLE = @json($product->title);
        const PRODUCT_SLUG  = @json($product->slug);
        const READER_URL    = window.location.pathname;

        const readerEl          = document.getElementById('reader-content');
        const progressFill      = document.getElementById('progress-fill');
        const sheetProgressFill = document.getElementById('sheet-progress-fill');
        const fabPageCurrent    = document.getElementById('fab-page-current');
        const topbarBadge       = document.getElementById('topbar-page-badge');
        const controlSheet      = document.getElementById('reader-control-sheet');
        const sheetBackdrop     = document.getElementById('reader-sheet-backdrop');
        const sheetPageCurrent  = document.getElementById('sheet-page-current');
        const sheetPrevBtn      = document.getElementById('sheet-prev-btn');
        const sheetNextBtn      = document.getElementById('sheet-next-btn');
        const sheetPageSlider   = document.getElementById('sheet-page-slider');
        const sheetPagePreview  = document.getElementById('sheet-page-preview');
        const fontSlider        = document.getElementById('font-slider');
        const fontValEl         = document.getElementById('sheet-font-val');
        const arabicFontSlider  = document.getElementById('arabic-font-slider');
        const arabicFontValEl   = document.getElementById('arabic-font-size-display');
        const sheetTocBtn       = document.getElementById('sheet-toc-btn');
        const sentinel          = document.getElementById('lazy-sentinel');
        const loaderEl          = document.getElementById('reader-loader');
        const fab               = document.getElementById('reader-fab');
        function showLoader() { if (loaderEl) { loaderEl.classList.add('visible'); loaderEl.setAttribute('aria-hidden','false'); } }
        function hideLoader() { if (loaderEl) { loaderEl.classList.remove('visible'); loaderEl.setAttribute('aria-hidden','true'); } }

        if (!readerEl) return;

        const API_URL_VAL = readerEl.dataset.apiUrl;
        const allPageNumbers = @json($allPageMeta->pluck('page_number')->toArray());
        const sorted    = allPageNumbers.slice().sort((a, b) => a - b);
        const firstPage = sorted[0];

        // pageMap: only tracks pages that are currently in the DOM
        const pageMap = {};
        function registerPageEls() {
            readerEl.querySelectorAll('.page').forEach(el => {
                const numEl = el.querySelector('.page-number');
                let n = numEl ? parseInt((numEl.textContent || '').replace(/[^0-9]/g, ''), 10) : NaN;
                if (!n) n = parseInt(el.getAttribute('id') || '', 10);
                if (n && !isNaN(n)) pageMap[n] = el;
            });
        }
        registerPageEls();

        // Compute lastLoadedPage based on pages already rendered server-side
        // so we only fetch pages that are missing. If none present, start at 0.
        let lastLoadedPage = (function(){
            try {
                const nums = Object.keys(pageMap).map(n => parseInt(n, 10)).filter(Boolean);
                return nums.length ? Math.max.apply(null, nums) : 0;
            } catch (_) { return 0; }
        })();
         let isLoading      = false;
         let allLoaded      = sorted.every(n => pageMap[n]);

        // initial loader state: show while we still need to fetch pages
        if (allLoaded) {
            hideLoader();
        } else {
            showLoader();
        }

        // --- Eager load: fetch all remaining pages from the API (disable lazy IntersectionObserver) ---
        // This will repeatedly call the existing loadMorePages(upToPage) until the API reports no more pages.
        async function eagerLoadAllPages() {
            try {
                if (allLoaded) { hideLoader(); return; }
                const maxPage = sorted[sorted.length - 1];
                // Keep requesting batches until server indicates there are no more pages
                while (!allLoaded) {
                    // request up to `maxPage` — loadMorePages will cap the batch size
                    await loadMorePages(maxPage);
                    // brief pause to allow DOM updates and avoid tight-looping
                    await new Promise(r => setTimeout(r, 50));
                }
                hideLoader();
            } catch (err) {
                console.error('Eager load error:', err);
                // hide loader so user can see partial content and any errors
                hideLoader();
            }
        }

        // Start eager loading in the background (non-blocking)
        eagerLoadAllPages();

        // --- Helpers ---
        function updateUI(page) {
            if (sheetPageCurrent) sheetPageCurrent.textContent = page;
            if (fabPageCurrent)   fabPageCurrent.textContent  = page;
            if (topbarBadge)      topbarBadge.textContent     = page + ' / ' + sorted[sorted.length - 1];
            const idx = sorted.indexOf(page);
            const pct = idx >= 0 ? Math.round(((idx + 1) / sorted.length) * 100) : 0;
            if (progressFill)      progressFill.style.width      = pct + '%';
            if (sheetProgressFill) sheetProgressFill.style.width = pct + '%';
            if (sheetPageSlider && document.activeElement !== sheetPageSlider) sheetPageSlider.value = page;
            if (sheetPagePreview) sheetPagePreview.textContent = page;
        }
        function save(page)   { try { localStorage.setItem(STORAGE_KEY, String(page)); } catch (_) {} }
        function load()       { try { const v = localStorage.getItem(STORAGE_KEY); return v ? parseInt(v, 10) : null; } catch (_) { return null; } }
        function saveFont(sz) { try { localStorage.setItem(FONT_KEY, String(sz)); } catch (_) {} }
        function loadFont()   { try { const v = localStorage.getItem(FONT_KEY); return v ? parseFloat(v) : null; } catch (_) { return null; } }
        function applyFont(sz) {
            readerEl.querySelectorAll('.page').forEach(p => { p.style.fontSize = sz + 'px'; });
            if (fontValEl) fontValEl.textContent = sz.toFixed(1) + 'px';
            if (fontSlider && document.activeElement !== fontSlider) fontSlider.value = sz;
        }
        function saveArabicFont(sz) { try { localStorage.setItem(ARABIC_FONT_KEY, String(sz)); } catch (_) {} }
        function loadArabicFont()   { try { const v = localStorage.getItem(ARABIC_FONT_KEY); return v ? parseFloat(v) : null; } catch (_) { return null; } }
        function applyArabicFont(sz) {
            readerEl.style.setProperty('--reader-arabic-font-size', sz + 'px');
            if (arabicFontValEl) arabicFontValEl.textContent = sz.toFixed(1) + 'px';
            if (arabicFontSlider && document.activeElement !== arabicFontSlider) arabicFontSlider.value = sz;
        }

        function visiblePage() {
            let closest = null, best = Infinity;
            Object.keys(pageMap).forEach(n => {
                const d = Math.abs(pageMap[n].getBoundingClientRect().top - TOPBAR_H);
                if (d < best) { best = d; closest = parseInt(n, 10); }
            });
            return closest || firstPage;
        }

        // --- Lazy load: fetch next batch from the API ---
        function loadMorePages(upToPage) {
            if (isLoading || allLoaded) return Promise.resolve();
            isLoading = true;

            const limit = upToPage ? Math.min(upToPage - lastLoadedPage, 20) : 10;
            if (limit <= 0) { isLoading = false; return Promise.resolve(); }

            return fetch(`${API_URL_VAL}?after=${lastLoadedPage}&limit=${limit}`)
                .then(r => r.json())
                .then(data => {
                    if (!data.pages || !data.pages.length) { allLoaded = true; return; }

                    const savedFont = loadFont();
                    const fragment  = document.createDocumentFragment();

                    data.pages.forEach(p => {
                        if (pageMap[p.page_number]) return; // already in DOM
                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = p.content;
                        Array.from(wrapper.childNodes).forEach(node => fragment.appendChild(node));
                        // Add divider after each page
                        const hr = document.createElement('div');
                        hr.className = 'end-of-page-hr';
                        fragment.appendChild(hr);
                        lastLoadedPage = Math.max(lastLoadedPage, p.page_number);
                    });

                    if (sentinel && sentinel.parentNode) {
                        sentinel.parentNode.insertBefore(fragment, sentinel);
                    }
                    registerPageEls();
                    if (savedFont) applyFont(savedFont);
                    const savedArabicFont = loadArabicFont();
                    if (savedArabicFont) applyArabicFont(savedArabicFont);
                    // Restore highlights for newly loaded pages
                    data.pages.forEach(p => {
                        if (pageMap[p.page_number]) {
                            hlRestorePage(pageMap[p.page_number], p.page_number);
                            bmRenderMarkers(pageMap[p.page_number], p.page_number);
                        }
                    });

                    allLoaded = !data.has_more;
                    if (allLoaded && sentinel && sentinel.parentNode) sentinel.remove();
                })
                .catch(e => console.error('Lazy load error:', e))
                .finally(() => { isLoading = false; if (allLoaded) hideLoader(); });
        }

        // jumpTo: loads the page via API first if not yet in DOM, then scrolls
        function jumpTo(page, smooth) {
            if (pageMap[page]) {
                _scrollTo(page, smooth);
            } else {
                loadMorePages(page).then(() => {
                    if (pageMap[page]) _scrollTo(page, smooth);
                });
            }
        }

        function _scrollTo(page, smooth) {
            const el = pageMap[page];
            if (!el) return;
            window.scrollTo({
                top: el.getBoundingClientRect().top + window.scrollY - TOPBAR_H,
                behavior: smooth ? 'smooth' : 'auto'
            });
            updateUI(page);
            save(page);
        }

        // --- Scroll ---
        let saveTimer = null;
        window.addEventListener('scroll', function () {
            const cur = visiblePage();
            updateUI(cur);
            clearTimeout(saveTimer);
            saveTimer = setTimeout(() => save(visiblePage()), 300);
        }, { passive: true });

        // ── Control Sheet ──
        function openSheet() {
            if (!controlSheet) return;
            controlSheet.classList.add('open');
            controlSheet.setAttribute('aria-hidden', 'false');
            sheetBackdrop?.classList.add('open');
            sheetBackdrop?.setAttribute('aria-hidden', 'false');
            fab?.setAttribute('aria-expanded', 'true');
            const cur = visiblePage();
            if (sheetPageSlider) sheetPageSlider.value = cur;
            if (sheetPagePreview) sheetPagePreview.textContent = cur;
        }
        function closeSheet() {
            if (!controlSheet) return;
            controlSheet.classList.remove('open');
            controlSheet.setAttribute('aria-hidden', 'true');
            sheetBackdrop?.classList.remove('open');
            sheetBackdrop?.setAttribute('aria-hidden', 'true');
            fab?.setAttribute('aria-expanded', 'false');
        }
        function toggleSheet() { controlSheet?.classList.contains('open') ? closeSheet() : openSheet(); }

        fab?.addEventListener('click', e => { e.stopPropagation(); toggleSheet(); });
        sheetBackdrop?.addEventListener('click', closeSheet);
        document.addEventListener('keydown', ev => {
            if (ev.key === 'Escape' && controlSheet?.classList.contains('open')) closeSheet();
        });

        // Tap reading area to toggle sheet (excluding footnotes / links / buttons / marks)
        readerEl?.addEventListener('click', e => {
            if (e.target.closest('.fn-ref, .fn-popover, [data-toc-page], a, button, input, select, textarea, mark')) return;
            const sel = window.getSelection();
            if (sel && !sel.isCollapsed && sel.toString().trim().length > 0) return;
            toggleSheet();
        });

        // Sheet: page slider
        sheetPageSlider?.addEventListener('input', () => {
            if (sheetPagePreview) sheetPagePreview.textContent = sheetPageSlider.value;
        });
        sheetPageSlider?.addEventListener('change', () => {
            const p = parseInt(sheetPageSlider.value, 10);
            if (p) { jumpTo(p, true); closeSheet(); }
        });

        // Sheet: prev / next
        sheetPrevBtn?.addEventListener('click', () => {
            const cur = visiblePage();
            const idx = sorted.indexOf(cur);
            if (idx > 0) { jumpTo(sorted[idx - 1], true); closeSheet(); }
        });
        sheetNextBtn?.addEventListener('click', () => {
            const cur = visiblePage();
            const idx = sorted.indexOf(cur);
            if (idx < sorted.length - 1) { jumpTo(sorted[idx + 1], true); closeSheet(); }
        });

        // Sheet: font sliders
        fontSlider?.addEventListener('input', () => {
            applyFont(Math.round(parseFloat(fontSlider.value) * 10) / 10);
        });
        fontSlider?.addEventListener('change', () => {
            const sz = Math.round(parseFloat(fontSlider.value) * 10) / 10;
            applyFont(sz); saveFont(sz);
        });
        document.getElementById('sheet-font-reset')?.addEventListener('click', () => {
            applyFont(DEFAULT_FONT); saveFont(DEFAULT_FONT);
        });
        arabicFontSlider?.addEventListener('input', () => {
            applyArabicFont(Math.round(parseFloat(arabicFontSlider.value) * 10) / 10);
        });
        arabicFontSlider?.addEventListener('change', () => {
            const sz = Math.round(parseFloat(arabicFontSlider.value) * 10) / 10;
            applyArabicFont(sz); saveArabicFont(sz);
        });
        document.getElementById('arabic-font-reset')?.addEventListener('click', () => {
            applyArabicFont(DEFAULT_ARABIC_FONT); saveArabicFont(DEFAULT_ARABIC_FONT);
        });

        // --- Pinch-to-zoom for font size (touch gestures) ---
        let pinchStartDist = null;
        let pinchStartFontSize = null;

        readerEl.addEventListener('touchstart', e => {
            if (e.touches.length === 2) {
                e.preventDefault();
                const touch1 = e.touches[0];
                const touch2 = e.touches[1];
                pinchStartDist = Math.hypot(
                    touch2.pageX - touch1.pageX,
                    touch2.pageY - touch1.pageY
                );
                const currentPage = readerEl.querySelector('.page');
                pinchStartFontSize = currentPage ? parseFloat(getComputedStyle(currentPage).fontSize) || 19 : 19;
            }
        }, { passive: false });

        readerEl.addEventListener('touchmove', e => {
            if (e.touches.length === 2 && pinchStartDist !== null) {
                e.preventDefault();
                const touch1 = e.touches[0];
                const touch2 = e.touches[1];
                const currentDist = Math.hypot(
                    touch2.pageX - touch1.pageX,
                    touch2.pageY - touch1.pageY
                );

                // Apply dampening for smaller, more sensitive steps
                const rawScale = currentDist / pinchStartDist;
                const dampening = 0.15; // Lower = smaller steps, more sensitive, smoother
                const scale = 1 + (rawScale - 1) * dampening;
                const newSize = pinchStartFontSize * scale;
                const clampedSize = Math.max(12, Math.min(36, newSize));

                applyFont(clampedSize);
            }
        }, { passive: false });

        readerEl.addEventListener('touchend', e => {
            if (e.touches.length < 2 && pinchStartDist !== null) {
                // Save final font size
                const currentPage = readerEl.querySelector('.page');
                if (currentPage) {
                    const finalSize = parseFloat(getComputedStyle(currentPage).fontSize) || 19;
                    saveFont(finalSize);
                }
                pinchStartDist = null;
                pinchStartFontSize = null;
            }
        });

        readerEl.addEventListener('touchcancel', () => {
            pinchStartDist = null;
            pinchStartFontSize = null;
        });

        // --- Theme ---
        const THEME_KEY = 'reader-theme';
        function loadTheme() {
            try {
                const stored = localStorage.getItem(THEME_KEY);
                if (stored) return stored;
                const old = localStorage.getItem('reader-dark-mode');
                if (old === '0') return 'light';
                return 'dark';
            } catch (_) { return 'dark'; }
        }
        function saveTheme(mode) { try { localStorage.setItem(THEME_KEY, mode); } catch (_) {} }
        function applyTheme(mode) {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.body.classList.toggle('dark-mode', mode === 'dark' || (mode === 'system' && prefersDark));
            document.querySelectorAll('.reader-sheet-theme-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.theme === mode);
            });
        }
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (loadTheme() === 'system') applyTheme('system');
        });
        document.querySelectorAll('.reader-sheet-theme-btn').forEach(btn => {
            btn.addEventListener('click', () => { saveTheme(btn.dataset.theme); applyTheme(btn.dataset.theme); });
        });
        applyTheme(loadTheme());


        // --- TOC Panel ---
        const TOC_DATA = @json($tocEntries ?? []);
        const tocPanel      = document.getElementById('toc-panel');
        const tocPanelBody  = document.getElementById('toc-panel-body');
        const tocCloseBtn   = document.getElementById('toc-close-btn');
        const tocBackdrop   = document.getElementById('toc-backdrop');

        function buildTocPanel() {
            if (!tocPanelBody || !TOC_DATA.length) return;
            const frag = document.createDocumentFragment();
            TOC_DATA.forEach(entry => {
                const btn = document.createElement('button');
                btn.className = 'toc-panel-item' +
                    (entry.level === 'main' ? ' toc-panel-main' : ' toc-panel-sub');
                btn.dataset.page = entry.page;
                btn.setAttribute('type', 'button');

                const info = document.createElement('span');
                info.className = 'toc-panel-item-info';

                const title = document.createElement('span');
                title.className = 'toc-panel-item-title';
                title.textContent = entry.title;
                info.appendChild(title);

                if (entry.subtitle) {
                    const sub = document.createElement('span');
                    sub.className = 'toc-panel-item-subtitle';
                    sub.textContent = entry.subtitle;
                    info.appendChild(sub);
                }

                const pn = document.createElement('span');
                pn.className = 'toc-panel-item-page';
                pn.textContent = 'p.' + entry.page;

                btn.appendChild(info);
                btn.appendChild(pn);
                frag.appendChild(btn);
            });
            tocPanelBody.appendChild(frag);

            // Bind click events
            tocPanelBody.querySelectorAll('.toc-panel-item').forEach(btn => {
                btn.addEventListener('click', () => {
                    const page = parseInt(btn.dataset.page, 10);
                    if (page) { jumpTo(page, true); closeToc(); }
                });
            });
        }

        function markActiveTocItem() {
            if (!tocPanelBody) return;
            const cur = visiblePage();
            // Find the last TOC entry whose page <= current page
            const items = Array.from(tocPanelBody.querySelectorAll('.toc-panel-item'));
            let activeEl = null;
            items.forEach(btn => {
                btn.classList.remove('active');
                if (parseInt(btn.dataset.page, 10) <= cur) activeEl = btn;
            });
            if (activeEl) activeEl.classList.add('active');
        }

        function openToc() {
            if (!tocPanel) return;
            closeSheet();
            tocPanel.classList.add('open');
            tocPanel.setAttribute('aria-hidden', 'false');
            if (tocBackdrop) { tocBackdrop.classList.add('open'); tocBackdrop.setAttribute('aria-hidden', 'false'); }
            markActiveTocItem();
            // Scroll active item into view
            requestAnimationFrame(() => {
                const active = tocPanelBody?.querySelector('.toc-panel-item.active');
                if (active) active.scrollIntoView({ block: 'center' });
            });
        }

        function closeToc() {
            if (!tocPanel) return;
            tocPanel.classList.remove('open');
            tocPanel.setAttribute('aria-hidden', 'true');
            if (tocBackdrop) { tocBackdrop.classList.remove('open'); tocBackdrop.setAttribute('aria-hidden', 'true'); }
        }

        buildTocPanel();
        sheetTocBtn?.addEventListener('click', () => openToc());
        tocCloseBtn?.addEventListener('click', closeToc);
        tocBackdrop?.addEventListener('click', closeToc);
        document.addEventListener('keydown', ev => {
            if (ev.key === 'Escape' && tocPanel?.classList.contains('open')) closeToc();
        });

        // data-toc-page clicks in the book content
        readerEl.addEventListener('click', e => {
            const btn = e.target.closest('[data-toc-page]');
            if (btn) {
                e.preventDefault();
                const page = parseInt(btn.dataset.tocPage, 10);
                if (page) jumpTo(page, true);
            }
        });

        // --- Restore reading progress on load ---
        function restoreProgress() {
            const savedFont = loadFont();
            if (savedFont) { applyFont(savedFont); } else { applyFont(DEFAULT_FONT); }
            const savedArabicFont = loadArabicFont();
            if (savedArabicFont) { applyArabicFont(savedArabicFont); } else { applyArabicFont(DEFAULT_ARABIC_FONT); }
            hlRestoreAll(); // restore saved highlights for server-rendered pages
            bmRenderAllMarkers(); // restore bookmark paragraph markers

            const saved     = load();
            const startPage = (saved && sorted.includes(saved)) ? saved : null;

            // Nothing saved or first page: scroll to top so title is visible
            if (!startPage || startPage === firstPage) {
                window.scrollTo({ top: 0 });
                updateUI(firstPage);
            } else {
                // Page might not be in DOM yet — fetch first, then scroll
                jumpTo(startPage, false);
                requestAnimationFrame(() => requestAnimationFrame(() => {
                    const actual = visiblePage();
                    updateUI(actual);
                    save(actual);
                }));
            }
        }

        // ══════════════════════════════════════════
        //  SHEET TABS
        // ══════════════════════════════════════════
        const tabControls = document.getElementById('sheet-tab-controls');
        const tabLibrary  = document.getElementById('sheet-tab-library');
        const panelControls = document.getElementById('sheet-panel-controls');
        const panelLibrary  = document.getElementById('sheet-panel-library');

        function switchTab(tab) {
            if (tab === 'library') {
                tabControls?.classList.remove('active');
                tabLibrary?.classList.add('active');
                tabControls?.setAttribute('aria-selected', 'false');
                tabLibrary?.setAttribute('aria-selected', 'true');
                if (panelControls) panelControls.hidden = true;
                if (panelLibrary)  panelLibrary.removeAttribute('hidden');
                libRender();
            } else {
                tabLibrary?.classList.remove('active');
                tabControls?.classList.add('active');
                tabLibrary?.setAttribute('aria-selected', 'false');
                tabControls?.setAttribute('aria-selected', 'true');
                if (panelLibrary)  panelLibrary.hidden = true;
                if (panelControls) panelControls.removeAttribute('hidden');
            }
        }
        tabControls?.addEventListener('click', () => switchTab('controls'));
        tabLibrary?.addEventListener('click',  () => switchTab('library'));

        // ══════════════════════════════════════════
        //  HIGHLIGHTING SYSTEM
        // ══════════════════════════════════════════
        const HL_KEY  = 'hl_{{ $product->id }}';
        const BM_KEY  = 'reader_bookmarks_global'; // shared across ALL books
        const hlPopup = document.getElementById('hl-popup');
        let hlPending = null;   // { range, pageEl, pageNum }
        let hlMark    = null;   // active existing <mark>

        function bmLoad() { try { return JSON.parse(localStorage.getItem(BM_KEY) || '[]'); } catch { return []; } }
        function bmSave(a) { try { localStorage.setItem(BM_KEY, JSON.stringify(a)); } catch {} }

        // ── Library panel rendering ──────────────
        function libRender() {
            const bmList = document.getElementById('lib-bookmarks-list');
            const hlList = document.getElementById('lib-highlights-list');
            if (!bmList || !hlList) return;

            // Bookmarks — ALL books, sorted by book title then page
            const allBms = bmLoad();
            bmList.innerHTML = '';
            if (!allBms.length) {
                bmList.innerHTML = '<div class="reader-lib-empty">Geen bladwijzers opgeslagen</div>';
            } else {
                allBms
                    .slice()
                    .sort((a, b) => (a.productTitle || '').localeCompare(b.productTitle || '') || a.pageNum - b.pageNum)
                    .forEach(bm => {
                        const isCurrent = bm.productId === PRODUCT_ID;
                        const item = document.createElement('div');
                        item.className = 'reader-lib-item';
                        item.innerHTML = `
                            <div class="reader-lib-item-icon"><i class="fa-solid fa-bookmark"></i></div>
                            <div class="reader-lib-item-body">
                                <div class="reader-lib-item-book">${bm.productTitle || 'Onbekend boek'}</div>
                                <div class="reader-lib-item-page">Pagina ${bm.pageNum}</div>
                                <div class="reader-lib-item-text">${bm.text || ''}</div>
                            </div>
                            <button class="reader-lib-item-del" title="Verwijder" aria-label="Verwijder bladwijzer"><i class="fa-solid fa-xmark"></i></button>
                        `;
                        item.querySelector('.reader-lib-item-del').addEventListener('click', e => {
                            e.stopPropagation();
                            bmSave(bmLoad().filter(x => x.id !== bm.id));
                            document.querySelector(`.bm-marker[data-bm-id="${bm.id}"]`)?.remove();
                            libRender();
                        });
                        item.addEventListener('click', e => {
                            if (e.target.closest('.reader-lib-item-del')) return;
                            if (isCurrent) {
                                jumpTo(bm.pageNum, true); closeSheet();
                            } else {
                                // Set reading progress for target book so it opens on the right page
                                try { localStorage.setItem('reading_progress_' + bm.productId, String(bm.pageNum)); } catch (_) {}
                                window.location.href = bm.readerUrl;
                            }
                        });
                        bmList.appendChild(item);
                    });
            }

            // Highlights
            const hls = hlLoad();
            hlList.innerHTML = '';
            if (!hls.length) {
                hlList.innerHTML = '<div class="reader-lib-empty">Geen markeringen opgeslagen</div>';
            } else {
                hls.slice().sort((a,b) => a.pageNum - b.pageNum).forEach(hl => {
                    const item = document.createElement('div');
                    item.className = 'reader-lib-item';
                    const text = hl.text || ('Pagina ' + hl.pageNum);
                    item.innerHTML = `
                        <div class="reader-lib-item-icon hl-icon-${hl.color}"><i class="fa-solid fa-highlighter"></i></div>
                        <div class="reader-lib-item-body">
                            <div class="reader-lib-item-page">Pagina ${hl.pageNum}</div>
                            <div class="reader-lib-item-text">${text}</div>
                        </div>
                        <button class="reader-lib-item-del" title="Verwijder" aria-label="Verwijder markering"><i class="fa-solid fa-xmark"></i></button>
                    `;
                    item.querySelector('.reader-lib-item-del').addEventListener('click', e => {
                        e.stopPropagation();
                        // Remove mark from DOM
                        const markEl = document.querySelector(`[data-hl-id="${hl.id}"]`);
                        if (markEl) {
                            const p = markEl.parentNode;
                            while (markEl.firstChild) p.insertBefore(markEl.firstChild, markEl);
                            p.removeChild(markEl); p.normalize();
                        }
                        hlSave(hlLoad().filter(x => x.id !== hl.id));
                        libRender();
                    });
                    item.addEventListener('click', e => {
                        if (e.target.closest('.reader-lib-item-del')) return;
                        jumpTo(hl.pageNum, true); closeSheet();
                    });
                    hlList.appendChild(item);
                });
            }
        }

        // Clear all buttons
        document.getElementById('lib-clear-bookmarks')?.addEventListener('click', () => {
            if (confirm('Alle bladwijzers verwijderen?')) {
                bmSave([]);
                document.querySelectorAll('.bm-marker').forEach(m => m.remove());
                libRender();
            }
        });
        document.getElementById('lib-clear-highlights')?.addEventListener('click', () => {
            if (confirm('Alle markeringen verwijderen?')) {
                // Remove all marks from DOM
                document.querySelectorAll('mark.hl').forEach(m => {
                    const p = m.parentNode;
                    while (m.firstChild) p.insertBefore(m.firstChild, m);
                    p.removeChild(m); p.normalize();
                });
                hlSave([]); libRender();
            }
        });

        // Refresh library when sheet opens to 'library' tab

        function hlLoad() { try { return JSON.parse(localStorage.getItem(HL_KEY) || '[]'); } catch { return []; } }
        function hlSave(a) { try { localStorage.setItem(HL_KEY, JSON.stringify(a)); } catch {} }

        function hlShowPopup(rect, existing) {
            if (!hlPopup) return;
            const removeBtn = document.getElementById('hl-remove-btn');
            if (removeBtn) removeBtn.toggleAttribute('hidden', !existing);
            hlPopup.removeAttribute('hidden');
            const pw = hlPopup.offsetWidth || 220;
            const ph = hlPopup.offsetHeight || 44;
            let x = rect.left + rect.width / 2;
            let y = rect.top - ph - 10;
            if (y < 8) y = rect.bottom + 10;
            x = Math.max(pw / 2 + 8, Math.min(window.innerWidth - pw / 2 - 8, x));
            hlPopup.style.left = x + 'px';
            hlPopup.style.top  = y + 'px';
        }
        function hlHide() { hlPopup?.setAttribute('hidden', ''); hlPending = null; hlMark = null; }

        function hlPageEl(node) {
            let n = node;
            while (n && n !== readerEl) {
                if (n.nodeType === 1 && n.classList?.contains('page')) return n;
                n = n.parentNode;
            }
            return null;
        }
        function hlPageNum(el) { return parseInt(Object.keys(pageMap).find(k => pageMap[k] === el), 10) || null; }

        function hlSerialize(range, pageEl, pageNum) {
            const pre = document.createRange();
            pre.selectNodeContents(pageEl);
            pre.setEnd(range.startContainer, range.startOffset);
            const s = pre.toString().length;
            return { id: Date.now().toString(36) + Math.random().toString(36).slice(2, 6), pageNum, color: null, text: range.toString().trim().slice(0, 80), startOffset: s, endOffset: s + range.toString().length };
        }

        function hlDeserialize(pageEl, s, e) {
            let c = 0, sn = null, so = 0, en = null, eo = 0;
            function walk(n) {
                if (sn && en) return;
                if (n.nodeType === Node.TEXT_NODE) {
                    const l = n.textContent.length;
                    if (!sn && c + l > s)  { sn = n; so = s - c; }
                    if (!en && c + l >= e) { en = n; eo = e - c; }
                    c += l;
                } else { for (const ch of n.childNodes) { walk(ch); if (sn && en) break; } }
            }
            walk(pageEl);
            if (!sn || !en) return null;
            try { const r = document.createRange(); r.setStart(sn, so); r.setEnd(en, eo); return r.collapsed ? null : r; } catch { return null; }
        }

        function hlApply(range, color, id) {
            const mark = document.createElement('mark');
            mark.className = `hl hl-${color}`;
            mark.dataset.hlId = id;
            try { range.surroundContents(mark); }
            catch { const f = range.extractContents(); mark.appendChild(f); range.insertNode(mark); }
            hlBindMark(mark);
        }

        function hlBindMark(mark) {
            mark.addEventListener('click', e => {
                e.stopPropagation();
                hlMark = mark; hlPending = null;
                window.getSelection()?.removeAllRanges();
                hlShowPopup(mark.getBoundingClientRect(), true);
            });
        }

        function hlRestorePage(pageEl, pageNum) {
            hlLoad().filter(h => h.pageNum === pageNum).forEach(hl => {
                if (pageEl.querySelector(`[data-hl-id="${hl.id}"]`)) return;
                const r = hlDeserialize(pageEl, hl.startOffset, hl.endOffset);
                if (r) hlApply(r, hl.color, hl.id);
            });
        }

        function hlRestoreAll() {
            Object.entries(pageMap).forEach(([n, el]) => hlRestorePage(el, parseInt(n)));
        }

        // ── Bookmark paragraph markers ────────────
        const BM_BLOCK_SEL = 'p, h1, h2, h3, h4, h5, h6, li, blockquote';

        function bmGetPara(node, pageEl) {
            let n = node;
            while (n && n !== pageEl) {
                if (n.nodeType === 1 && n.matches && n.matches(BM_BLOCK_SEL)) return n;
                n = n.parentNode;
            }
            return null;
        }
        function bmParaIndex(paraEl, pageEl) {
            return Array.from(pageEl.querySelectorAll(BM_BLOCK_SEL)).indexOf(paraEl);
        }
        function bmGetParaByIndex(pageEl, idx) {
            return pageEl.querySelectorAll(BM_BLOCK_SEL)[idx] || null;
        }

        function bmCreateMarker(bm) {
            const marker = document.createElement('span');
            marker.className = 'bm-marker';
            marker.dataset.bmId = bm.id;
            marker.title = 'Bladwijzer verwijderen';
            marker.setAttribute('aria-label', 'Bladwijzer verwijderen');
            marker.innerHTML = '<i class="fa-solid fa-bookmark" aria-hidden="true"></i>';
            marker.addEventListener('click', e => {
                e.stopPropagation();
                bmSave(bmLoad().filter(x => x.id !== bm.id));
                marker.remove();
                if (panelLibrary && !panelLibrary.hidden) libRender();
                let t = document.getElementById('hl-toast');
                if (!t) { t = Object.assign(document.createElement('div'), { id: 'hl-toast', className: 'hl-toast' }); document.body.appendChild(t); }
                t.textContent = '✓ Bladwijzer verwijderd';
                t.classList.add('show'); clearTimeout(t._t); t._t = setTimeout(() => t.classList.remove('show'), 1600);
            });
            return marker;
        }

        function bmInsertMarker(bm, paraEl) {
            // Make paragraph the positioning context for the absolute marker
            if (!paraEl.style.position) paraEl.style.position = 'relative';
            paraEl.insertBefore(bmCreateMarker(bm), paraEl.firstChild);
        }

        function bmRenderMarkers(pageEl, pageNum) {
            // Remove stale markers for bookmarks no longer in storage
            const storedIds = new Set(bmLoad().filter(b => b.productId === PRODUCT_ID && b.pageNum === pageNum).map(b => b.id));
            pageEl.querySelectorAll('.bm-marker').forEach(m => {
                if (!storedIds.has(m.dataset.bmId)) m.remove();
            });
            // Add markers for stored bookmarks that have no marker yet
            bmLoad()
                .filter(b => b.productId === PRODUCT_ID && b.pageNum === pageNum && b.paraIndex >= 0)
                .forEach(bm => {
                    if (pageEl.querySelector(`.bm-marker[data-bm-id="${bm.id}"]`)) return;
                    const paraEl = bmGetParaByIndex(pageEl, bm.paraIndex);
                    if (!paraEl) return;
                    bmInsertMarker(bm, paraEl);
                });
        }

        function bmRenderAllMarkers() {
            Object.entries(pageMap).forEach(([n, el]) => bmRenderMarkers(el, parseInt(n)));
        }

        // Show popup after mouse/touch selection
        let _hlTimer = null;
        function hlCheckSel() {
            const sel = window.getSelection();
            if (!sel || sel.isCollapsed || !sel.rangeCount) return;
            const text = sel.toString().trim();
            if (!text) return;
            const range = sel.getRangeAt(0);
            const pageEl = hlPageEl(range.commonAncestorContainer);
            if (!pageEl) return;
            const pageNum = hlPageNum(pageEl);
            if (!pageNum) return;
            hlPending = { range: range.cloneRange(), pageEl, pageNum };
            hlMark = null;
            document.getElementById('hl-remove-btn')?.setAttribute('hidden', '');
            hlShowPopup(range.getBoundingClientRect(), false);
        }

        document.addEventListener('mouseup', () => {
            clearTimeout(_hlTimer);
            _hlTimer = setTimeout(hlCheckSel, 80);
        });
        readerEl?.addEventListener('touchend', () => {
            clearTimeout(_hlTimer);
            _hlTimer = setTimeout(hlCheckSel, 320);
        }, { passive: true });

        document.addEventListener('selectionchange', () => {
            const sel = window.getSelection();
            if (hlPopup && !hlPopup.hidden && !hlMark && (!sel || sel.isCollapsed)) hlHide();
        });

        // Prevent losing selection on color button mousedown
        hlPopup?.querySelectorAll('.hl-color-btn').forEach(btn => {
            btn.addEventListener('mousedown', e => e.preventDefault());
            btn.addEventListener('click', e => {
                e.stopPropagation();
                const color = btn.dataset.color;
                if (hlMark) {
                    const id = hlMark.dataset.hlId;
                    hlMark.className = `hl hl-${color}`;
                    const arr = hlLoad(); const i = arr.findIndex(h => h.id === id);
                    if (i >= 0) { arr[i].color = color; hlSave(arr); }
                } else if (hlPending) {
                    const { range, pageEl, pageNum } = hlPending;
                    const hl = hlSerialize(range, pageEl, pageNum);
                    hl.color = color;
                    hlApply(range, color, hl.id);
                    const arr = hlLoad(); arr.push(hl); hlSave(arr);
                }
                window.getSelection()?.removeAllRanges();
                hlHide();
            });
        });

        document.getElementById('hl-bookmark-btn')?.addEventListener('click', e => {
            e.stopPropagation();
            const anchorNode = hlMark ? hlMark : (hlPending?.range?.startContainer);
            const pageNum = hlMark
                ? (hlPageNum(hlPageEl(hlMark)) || 0)
                : (hlPending?.pageNum || 0);
            const text = hlMark
                ? (hlMark.textContent.trim().slice(0, 80))
                : (hlPending?.range.toString().trim().slice(0, 80) || '');
            if (!pageNum) { hlHide(); return; }

            // Find the paragraph that contains the selection
            const pageEl = anchorNode ? hlPageEl(anchorNode) : null;
            const paraEl = (pageEl && anchorNode) ? bmGetPara(anchorNode, pageEl) : null;
            const paraIndex = (paraEl && pageEl) ? bmParaIndex(paraEl, pageEl) : -1;

            const existing = bmLoad();
            const dupe = existing.some(b => b.productId === PRODUCT_ID && b.pageNum === pageNum && b.text === text);
            if (!dupe) {
                const newBm = {
                    id: Date.now().toString(36) + Math.random().toString(36).slice(2,6),
                    productId: PRODUCT_ID,
                    productTitle: PRODUCT_TITLE,
                    productSlug: PRODUCT_SLUG,
                    readerUrl: READER_URL,
                    pageNum,
                    paraIndex,
                    text,
                    date: new Date().toISOString()
                };
                existing.push(newBm);
                bmSave(existing);
                // Immediately render the marker in the paragraph
                if (paraEl && paraIndex >= 0) {
                    if (!paraEl.querySelector(`.bm-marker[data-bm-id="${newBm.id}"]`)) {
                        bmInsertMarker(newBm, paraEl);
                    }
                }
            }
            // Visual feedback
            const btn = document.getElementById('hl-bookmark-btn');
            if (btn) { btn.classList.add('active'); setTimeout(() => btn.classList.remove('active'), 600); }
            // Toast
            let t = document.getElementById('hl-toast');
            if (!t) { t = Object.assign(document.createElement('div'), { id: 'hl-toast', className: 'hl-toast' }); document.body.appendChild(t); }
            t.textContent = dupe ? '✓ Al opgeslagen' : '✓ Bladwijzer toegevoegd';
            t.classList.add('show'); clearTimeout(t._t); t._t = setTimeout(() => t.classList.remove('show'), 1800);
            window.getSelection()?.removeAllRanges();
            hlHide();
        });

        document.getElementById('hl-copy-btn')?.addEventListener('click', e => {
            e.stopPropagation();
            const text = hlMark ? hlMark.textContent : (hlPending?.range.toString() || '');
            if (text) navigator.clipboard?.writeText(text).catch(() => {
                const ta = Object.assign(document.createElement('textarea'), { value: text });
                Object.assign(ta.style, { position: 'fixed', opacity: '0' });
                document.body.appendChild(ta); ta.select(); document.execCommand('copy'); ta.remove();
            });
            window.getSelection()?.removeAllRanges();
            hlHide();
            // toast
            let t = document.getElementById('hl-toast');
            if (!t) { t = Object.assign(document.createElement('div'), { id: 'hl-toast', className: 'hl-toast', textContent: '✓ Gekopieerd' }); document.body.appendChild(t); }
            t.classList.add('show'); clearTimeout(t._t); t._t = setTimeout(() => t.classList.remove('show'), 1600);
        });

        document.getElementById('hl-remove-btn')?.addEventListener('click', e => {
            e.stopPropagation();
            if (!hlMark) return;
            const id = hlMark.dataset.hlId;
            const p = hlMark.parentNode;
            while (hlMark.firstChild) p.insertBefore(hlMark.firstChild, hlMark);
            p.removeChild(hlMark); p.normalize();
            hlSave(hlLoad().filter(h => h.id !== id));
            hlHide();
        });

        document.addEventListener('click', e => {
            if (hlPopup && !hlPopup.hidden && !hlPopup.contains(e.target) && !e.target.closest('mark.hl')) hlHide();
        });
        document.addEventListener('keydown', e => { if (e.key === 'Escape' && hlPopup && !hlPopup.hidden) hlHide(); });

        // ══════════════════════════════════════════

        if (document.readyState === 'complete') { restoreProgress(); }
        else { window.addEventListener('load', restoreProgress); }
    })();
    </script>
</div>
</body>
</html>

