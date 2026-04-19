<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
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
    {{-- Apply theme before first paint to avoid flash of wrong theme --}}
    <script>
        (function(){
            try {
                var stored = localStorage.getItem('reader-theme');
                // Default to system theme when nothing is saved yet
                var mode = stored || 'system';
                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (mode === 'dark' || (mode === 'system' && prefersDark)) {
                    document.documentElement.classList.add('reader-preload-dark');
                }
            } catch(_) {}
        })();
    </script>
    <style>
        /* Prevent page from scrolling horizontally when keyboard opens on mobile (iOS Safari) */
        html, body {
            overflow-x: clip; /* clip instead of hidden — prevents horizontal overflow painting without breaking mouse-wheel scroll */
            overscroll-behavior-x: none;
            max-width: 100vw;
        }
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

        /* Prevent iOS Safari auto-zoom on input focus (font-size must be >= 16px) */
        .online-reader-html input[type="range"],
        .online-reader-html input,
        .online-reader-html select,
        .online-reader-html textarea,
        .online-reader-html button {
            font-size: 16px;
        }
        /* Override visual sizes back for specific elements */
        .reader-sheet-reset-btn                          { font-size: 13px !important; }
        .reader-sheet-slider-label                       { font-size: 10px !important; }
        .reader-sheet-slider-val                         { font-size: 10px !important; }
        .reader-sheet-toc-btn                            { font-size: 11px !important; }
        .reader-sheet-tab                                { font-size: 11px !important; }
        .reader-sheet-tab span                           { font-size: 11px !important; }
        .reader-sheet-tab i                              { font-size: 12px !important; }
        .reader-sheet-section-label                      { font-size: 10px !important; }
        .font-step-az--small                             { font-size: 12px !important; }
        .font-step-az--large                             { font-size: 18px !important; }
        .font-step-az--small.font-step-az--arabic        { font-size: 14px !important; }
        .font-step-az--large.font-step-az--arabic        { font-size: 22px !important; }
        .reader-lib-clear-all                            { font-size: 11px !important; }
        .reader-sheet-arrow                              { font-size: 12px !important; }
        .reader-sheet-theme-btn span                     { font-size: 9px !important; }
        .reader-sheet-theme-btn i                        { font-size: 16px !important; }
        .reader-back-btn                                 { font-size: 12px !important; }
        .reader-topbar-page-badge                        { font-size: 11px !important; }
        .toc-panel-close                                 { font-size: 15px !important; }
        .reader-sheet-bm-nav-btn                         { font-size: 11px !important; }
        /* Bookmark page marker — sits at top of page, padding-top makes room */
        .book-reader-scope .page                         { position: relative; font-size: var(--reader-font-size, 19px); }
        .bm-page-marker                                  { position: absolute !important; top: 0px !important; left: 8px !important; margin: 0 !important; padding: 0 !important; }
        /* GPU layer for overlay panels — prevents theme/popover repaints thrashing book content */
        .reader-control-sheet, .toc-panel, .hl-popup, .reader-search-panel { will-change: transform; }
        .book-reader-scope { contain: style; }
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
            <button class="reader-btn reader-search-open-btn" id="reader-search-open-btn" aria-label="Zoeken in boek" title="Zoeken">
                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
            </button>
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

        {{-- Book title (visible on mobile where topbar title is hidden) --}}
        <div class="reader-sheet-book-title" aria-hidden="true">{{ $product->title }}</div>

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
                <span class="reader-sheet-slider-label"><i class="fa-solid fa-book-open" aria-hidden="true"></i> Ga naar pagina</span>
                <button class="reader-sheet-bm-nav-btn" id="sheet-bm-page-btn" type="button" title="Voeg bladwijzer toe" aria-label="Voeg bladwijzer toe">
                    <i class="fa-solid fa-bookmark" aria-hidden="true"></i>
                </button>
            </div>
            <input type="range" class="reader-sheet-slider" id="sheet-page-slider"
                   min="{{ $allPageMeta->min('page_number') }}"
                   max="{{ $allPageMeta->max('page_number') }}"
                   value="{{ $allPageMeta->min('page_number') }}"
                   aria-label="Ga naar pagina">
        </div>

        <div class="reader-sheet-divider"></div>

        {{-- Text font size --}}
        <div class="reader-sheet-section reader-sheet-fontpicker-row">
            <div class="reader-sheet-slider-meta">
                <span class="reader-sheet-slider-label"><i class="fa-solid fa-font" aria-hidden="true"></i> Tekst</span>
                <div class="reader-sheet-slider-right">
                    <span class="reader-sheet-slider-val" id="sheet-font-val" aria-live="polite">19.0px</span>
                    <button class="reader-sheet-reset-btn" id="sheet-font-reset" type="button" aria-label="Lettergrootte resetten">↺</button>
                </div>
            </div>
            <div class="font-step-control" id="font-step-control">
                <button class="font-step-az font-step-az--small" id="font-dec-btn" type="button" aria-label="Kleiner lettertype">a</button>
                <input type="range" class="font-step-range" id="font-step-range"
                       min="0" step="1" aria-label="Lettergrootte">
                <button class="font-step-az font-step-az--large" id="font-inc-btn" type="button" aria-label="Groter lettertype">A</button>
            </div>
        </div>

        {{-- Arabic font size --}}
        <div class="reader-sheet-section reader-sheet-fontpicker-row">
            <div class="reader-sheet-slider-meta">
                <span class="reader-sheet-slider-label"><i class="fa-solid fa-language" aria-hidden="true"></i> Arabisch</span>
                <div class="reader-sheet-slider-right">
                    <span class="reader-sheet-slider-val" id="arabic-font-size-display" aria-live="polite">29.0px</span>
                    <button class="reader-sheet-reset-btn" id="arabic-font-reset" type="button" aria-label="Arabische lettergrootte resetten">↺</button>
                </div>
            </div>
            <div class="font-step-control" id="arabic-font-step-control">
                <button class="font-step-az font-step-az--small font-step-az--arabic" id="arabic-font-dec-btn" type="button" aria-label="Kleiner Arabisch lettertype">ا</button>
                <input type="range" class="font-step-range" id="arabic-font-step-range"
                       min="0" step="1" aria-label="Arabische lettergrootte">
                <button class="font-step-az font-step-az--large font-step-az--arabic" id="arabic-font-inc-btn" type="button" aria-label="Groter Arabisch lettertype">ا</button>
            </div>
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
        <button class="hl-action-btn" id="hl-remove-btn" title="Verwijder markering" aria-label="Markering verwijderen" hidden>
            <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
        </button>
    </div>

    {{-- Loading overlay shown while pages load --}}
    <div id="reader-loader" aria-hidden="true">
        <div class="spinner" role="status" aria-label="Pagina wordt geladen"></div>
    </div>

    {{-- Search panel --}}
    <div id="reader-search-panel" class="reader-search-panel" hidden role="dialog" aria-label="Zoeken in boek" aria-modal="true">
        <div class="reader-search-header">
            <span class="reader-search-title"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i> Zoeken</span>
            <button class="reader-search-close" id="reader-search-close" aria-label="Sluiten">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="reader-search-body">
            <div class="reader-search-input-wrap">
                <i class="fa-solid fa-magnifying-glass reader-search-icon" aria-hidden="true"></i>
                <input type="search" id="reader-search-input" class="reader-search-input"
                       placeholder="Zoekterm…" autocomplete="off" spellcheck="false">
                <button class="reader-search-clear" id="reader-search-clear" aria-label="Wissen" hidden>
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
        <div class="reader-search-meta" id="reader-search-meta" aria-live="polite"></div>
        <div class="reader-search-results" id="reader-search-results" role="list"></div>
    </div>
    <div class="reader-search-backdrop" id="reader-search-backdrop"></div>

    <script>
    (function () {
        const TOPBAR_H    = 46;
        const STORAGE_KEY = 'reading_progress_{{ $product->id }}';
        const FONT_KEY    = 'reading_fontsize_{{ $product->id }}';
        const ARABIC_FONT_KEY = 'reading_arabicfontsize_{{ $product->id }}';
        const DEFAULT_FONT = 19;
        const DEFAULT_ARABIC_FONT = 29;
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
        const fontValEl         = document.getElementById('sheet-font-val');
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

        // All pages are server-side rendered — no lazy/eager loading needed
        const allLoaded = true;
        hideLoader();


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
            bmPageLabel();
        }
        function save(page)   { try { localStorage.setItem(STORAGE_KEY, String(page)); } catch (_) {} }
        function load()       { try { const v = localStorage.getItem(STORAGE_KEY); return v ? parseInt(v, 10) : null; } catch (_) { return null; } }
        function saveFont(sz) { try { localStorage.setItem(FONT_KEY, String(sz)); } catch (_) {} }
        function loadFont()   { try { const v = localStorage.getItem(FONT_KEY); return v ? parseFloat(v) : null; } catch (_) { return null; } }
        function applyFont(sz, anchor) {
            if (anchor) {
                // Snapshot anchor position BEFORE the style change (one layout read)
                const anchorEl = pageMap ? pageMap[visiblePage()] : null;
                const offsetBefore = anchorEl ? anchorEl.getBoundingClientRect().top : null;
                readerEl.style.setProperty('--reader-font-size', sz + 'px');
                if (anchorEl && offsetBefore !== null) {
                    // Correct scroll AFTER the browser has reflowed the new font size (next frame)
                    // — avoids forced synchronous reflow entirely
                    requestAnimationFrame(() => {
                        window.scrollBy(0, anchorEl.getBoundingClientRect().top - offsetBefore);
                    });
                }
            } else {
                readerEl.style.setProperty('--reader-font-size', sz + 'px');
            }
            if (fontValEl) fontValEl.textContent = sz.toFixed(1) + 'px';
        }
        function saveArabicFont(sz) { try { localStorage.setItem(ARABIC_FONT_KEY, String(sz)); } catch (_) {} }
        function loadArabicFont()   { try { const v = localStorage.getItem(ARABIC_FONT_KEY); return v ? parseFloat(v) : null; } catch (_) { return null; } }
        function applyArabicFont(sz, anchor) {
            if (anchor) {
                const anchorEl = pageMap ? pageMap[visiblePage()] : null;
                const offsetBefore = anchorEl ? anchorEl.getBoundingClientRect().top : null;
                readerEl.style.setProperty('--reader-arabic-font-size', sz + 'px');
                if (anchorEl && offsetBefore !== null) {
                    requestAnimationFrame(() => {
                        window.scrollBy(0, anchorEl.getBoundingClientRect().top - offsetBefore);
                    });
                }
            } else {
                readerEl.style.setProperty('--reader-arabic-font-size', sz + 'px');
            }
            if (arabicFontValEl) arabicFontValEl.textContent = sz.toFixed(1) + 'px';
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
            return Promise.resolve(); // no-op: all pages are server-side rendered
        }


        // jumpTo: loads the page via API first if not yet in DOM, then scrolls
        function jumpTo(page, smooth) {
            if (pageMap[page]) {
                _scrollTo(page, smooth);
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
            bmPageLabel();
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
            if (e.target.closest('.fn-ref, .fn-ref-word, .fn-popover, [data-toc-page], a, button, input, select, textarea, mark')) return;
            const sel = window.getSelection();
            if (sel && !sel.isCollapsed && sel.toString().trim().length > 0) return;
            // Don't open sheet if a footnote popover is visible
            if (document.querySelector('.fn-popover.fn-popover--show')) return;
            // Don't open sheet if hl-popup is visible OR was just dismissed (selectionchange hides it before click fires)
            if (!hlPopup?.hidden || (Date.now() - _hlHideTime < 350)) return;
            toggleSheet();
        });

        // Sheet: page slider
        sheetPageSlider?.addEventListener('input', () => {
            // Snap to nearest real page while dragging
            const raw = parseInt(sheetPageSlider.value, 10);
            const nearest = sorted.reduce((a, b) => Math.abs(b - raw) < Math.abs(a - raw) ? b : a);
            if (sheetPageCurrent) sheetPageCurrent.textContent = nearest;
        });
        sheetPageSlider?.addEventListener('change', () => {
            const raw = parseInt(sheetPageSlider.value, 10);
            const nearest = sorted.reduce((a, b) => Math.abs(b - raw) < Math.abs(a - raw) ? b : a);
            if (nearest) { jumpTo(nearest, false); closeSheet(); }
        });

        // Sheet: prev / next
        sheetPrevBtn?.addEventListener('click', () => {
            const cur = visiblePage();
            const idx = sorted.indexOf(cur);
            if (idx > 0) { jumpTo(sorted[idx - 1], true); }
        });
        sheetNextBtn?.addEventListener('click', () => {
            const cur = visiblePage();
            const idx = sorted.indexOf(cur);
            if (idx < sorted.length - 1) { jumpTo(sorted[idx + 1], true); }
        });

        // Sheet: font step controls
        // Generate steps at 0.1px resolution
        const FONT_STEPS   = Array.from({length: Math.round((36 - 12) / 0.1) + 1}, (_, i) => Math.round((12 + i * 0.1) * 10) / 10);
        const ARABIC_STEPS = Array.from({length: Math.round((52 - 16) / 0.1) + 1}, (_, i) => Math.round((16 + i * 0.1) * 10) / 10);

        function nearestStepIdx(steps, val) {
            let best = 0, bestD = Infinity;
            steps.forEach((s, i) => { const d = Math.abs(s - val); if (d < bestD) { bestD = d; best = i; } });
            return best;
        }

        function buildDots(containerId, steps, getCurrentIdx, onSelect) {
            const wrap = document.getElementById(containerId);
            if (!wrap) return;
            wrap.innerHTML = '';
            steps.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'font-step-dot' + (i === getCurrentIdx() ? ' active' : '');
                dot.setAttribute('aria-label', 'Stap ' + (i + 1));
                dot.addEventListener('click', () => onSelect(i));
                wrap.appendChild(dot);
            });
        }

        function refreshDots(containerId, steps, activeIdx) {
            const wrap = document.getElementById(containerId);
            if (!wrap) return;
            wrap.querySelectorAll('.font-step-dot').forEach((dot, i) => {
                dot.classList.toggle('active', i === activeIdx);
            });
        }

        let fontStepIdx   = nearestStepIdx(FONT_STEPS, DEFAULT_FONT);
        let arabicStepIdx = nearestStepIdx(ARABIC_STEPS, DEFAULT_ARABIC_FONT);

        function setFontStep(idx, anchor = true) {
            fontStepIdx = Math.max(0, Math.min(FONT_STEPS.length - 1, idx));
            const sz = FONT_STEPS[fontStepIdx];
            applyFont(sz, anchor); saveFont(sz);
            syncRangeSlider('font-step-range', FONT_STEPS, fontStepIdx);
        }
        function setArabicStep(idx, anchor = true) {
            arabicStepIdx = Math.max(0, Math.min(ARABIC_STEPS.length - 1, idx));
            const sz = ARABIC_STEPS[arabicStepIdx];
            applyArabicFont(sz, anchor); saveArabicFont(sz);
            syncRangeSlider('arabic-font-step-range', ARABIC_STEPS, arabicStepIdx);
        }

        // ── Range slider helpers ──────────────────────────────────────────
        const fontRange   = document.getElementById('font-step-range');
        const arabicRange = document.getElementById('arabic-font-step-range');

        function initRangeSlider(el, steps) {
            if (!el) return;
            el.min = 0;
            el.max = steps.length - 1;
            el.step = 1;
        }
        function syncRangeSlider(id, steps, idx) {
            const el = document.getElementById(id);
            if (el) el.value = idx;
        }

        initRangeSlider(fontRange,   FONT_STEPS);
        initRangeSlider(arabicRange, ARABIC_STEPS);

        fontRange?.addEventListener('input', () => {
            // Throttle with rAF — no anchor during continuous drag (prevents layout thrashing)
            if (fontRange._raf) return;
            fontRange._raf = requestAnimationFrame(() => {
                fontRange._raf = null;
                setFontStep(parseInt(fontRange.value), false);
            });
        });
        arabicRange?.addEventListener('input', () => {
            if (arabicRange._raf) return;
            arabicRange._raf = requestAnimationFrame(() => {
                arabicRange._raf = null;
                setArabicStep(parseInt(arabicRange.value), false);
            });
        });
        // On slider release — do a final apply WITH anchor correction so position snaps correctly
        fontRange?.addEventListener('change', () => setFontStep(parseInt(fontRange.value), true));
        arabicRange?.addEventListener('change', () => setArabicStep(parseInt(arabicRange.value), true));

        document.getElementById('font-dec-btn')?.addEventListener('click',        () => setFontStep(fontStepIdx - 1));
        document.getElementById('font-inc-btn')?.addEventListener('click',        () => setFontStep(fontStepIdx + 1));
        document.getElementById('arabic-font-dec-btn')?.addEventListener('click', () => setArabicStep(arabicStepIdx - 1));
        document.getElementById('arabic-font-inc-btn')?.addEventListener('click', () => setArabicStep(arabicStepIdx + 1));

        document.getElementById('sheet-font-reset')?.addEventListener('click', () => {
            fontStepIdx = nearestStepIdx(FONT_STEPS, DEFAULT_FONT);
            applyFont(DEFAULT_FONT, true); saveFont(DEFAULT_FONT);
            syncRangeSlider('font-step-range', FONT_STEPS, fontStepIdx);
        });
        document.getElementById('arabic-font-reset')?.addEventListener('click', () => {
            arabicStepIdx = nearestStepIdx(ARABIC_STEPS, DEFAULT_ARABIC_FONT);
            applyArabicFont(DEFAULT_ARABIC_FONT, true); saveArabicFont(DEFAULT_ARABIC_FONT);
            syncRangeSlider('arabic-font-step-range', ARABIC_STEPS, arabicStepIdx);
        });

        // --- Pinch-to-zoom for font size (touch gestures) ---
        let pinchStartDist    = null;
        let pinchStartFontIdx = null;  // step index at gesture start (not raw px)
        let _pinchRaf         = false;
        let _pinchTargetIdx   = null;

        readerEl.addEventListener('touchstart', e => {
            if (e.touches.length === 2) {
                e.preventDefault();
                pinchStartDist    = Math.hypot(
                    e.touches[1].pageX - e.touches[0].pageX,
                    e.touches[1].pageY - e.touches[0].pageY
                );
                pinchStartFontIdx = fontStepIdx; // snapshot index, no layout read needed
            }
        }, { passive: false });

        readerEl.addEventListener('touchmove', e => {
            if (e.touches.length === 2 && pinchStartDist !== null) {
                e.preventDefault();
                const currentDist = Math.hypot(
                    e.touches[1].pageX - e.touches[0].pageX,
                    e.touches[1].pageY - e.touches[0].pageY
                );
                const ratio = currentDist / pinchStartDist;
                let targetIdx = pinchStartFontIdx;
                if (ratio > 1.15) targetIdx = Math.min(FONT_STEPS.length - 1, pinchStartFontIdx + Math.floor((ratio - 1) / 0.15));
                if (ratio < 0.87) targetIdx = Math.max(0, pinchStartFontIdx - Math.floor((1 - ratio) / 0.13));

                if (targetIdx !== fontStepIdx) {
                    _pinchTargetIdx = targetIdx;
                    // Throttle: only apply once per animation frame, no anchor during move
                    if (!_pinchRaf) {
                        _pinchRaf = true;
                        requestAnimationFrame(() => {
                            _pinchRaf = false;
                            if (_pinchTargetIdx !== null) {
                                setFontStep(_pinchTargetIdx, false); // no anchor — zero layout reads
                                _pinchTargetIdx = null;
                            }
                        });
                    }
                }
            }
        }, { passive: false });

        readerEl.addEventListener('touchend', e => {
            if (e.touches.length < 2 && pinchStartDist !== null) {
                // Pinch ended — do one final apply WITH anchor so scroll position snaps back
                if (_pinchTargetIdx !== null) setFontStep(_pinchTargetIdx, true);
                else setFontStep(fontStepIdx, true);
                pinchStartDist    = null;
                pinchStartFontIdx = null;
                _pinchTargetIdx   = null;
            }
        });

        readerEl.addEventListener('touchcancel', () => {
            pinchStartDist    = null;
            pinchStartFontIdx = null;
            _pinchTargetIdx   = null;
        });

        // --- Theme ---
        const THEME_KEY = 'reader-theme';
        function loadTheme() {
            try {
                const stored = localStorage.getItem(THEME_KEY);
                if (stored) return stored;
                const old = localStorage.getItem('reader-dark-mode');
                if (old === '0') return 'light';
                return 'system'; // default: follow OS preference
            } catch (_) { return 'system'; }
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
        document.documentElement.classList.remove('reader-preload-dark');


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
            // Close settings sheet and search panel if open
            closeSheet();
            const searchPanel = document.getElementById('reader-search-panel');
            const searchBackdrop = document.getElementById('reader-search-backdrop');
            if (searchPanel && !searchPanel.hidden) {
                searchPanel.classList.remove('open');
                searchBackdrop?.classList.remove('open');
                setTimeout(() => { searchPanel.hidden = true; }, 220);
            }
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
        sheetTocBtn?.addEventListener('click', () => tocPanel?.classList.contains('open') ? closeToc() : openToc());
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
            const initFont = savedFont || DEFAULT_FONT;
            applyFont(initFont);
            fontStepIdx = nearestStepIdx(FONT_STEPS, initFont);
            syncRangeSlider('font-step-range', FONT_STEPS, fontStepIdx);

            const savedArabicFont = loadArabicFont();
            const initArabic = savedArabicFont || DEFAULT_ARABIC_FONT;
            applyArabicFont(initArabic);
            arabicStepIdx = nearestStepIdx(ARABIC_STEPS, initArabic);
            syncRangeSlider('arabic-font-step-range', ARABIC_STEPS, arabicStepIdx);
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
                            document.querySelector(`.bm-page-marker[data-bm-id="${bm.id}"]`)?.remove();
                            bmPageLabel();
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

            // Highlights — ALL books
            const hls = hlLoadAll()
                .slice()
                .sort((a, b) => (a.productTitle || '').localeCompare(b.productTitle || '') || a.pageNum - b.pageNum);
            hlList.innerHTML = '';
            if (!hls.length) {
                hlList.innerHTML = '<div class="reader-lib-empty">Geen markeringen opgeslagen</div>';
            } else {
                hls.forEach(hl => {
                    const isCurrent = hl.productId === PRODUCT_ID || !hl.productId;
                    const item = document.createElement('div');
                    item.className = 'reader-lib-item';
                    const text = hl.text || ('Pagina ' + hl.pageNum);
                    item.innerHTML = `
                        <div class="reader-lib-item-icon hl-icon-${hl.color}"><i class="fa-solid fa-highlighter"></i></div>
                        <div class="reader-lib-item-body">
                            <div class="reader-lib-item-book">${hl.productTitle || 'Onbekend boek'}</div>
                            <div class="reader-lib-item-page">Pagina ${hl.pageNum}</div>
                            <div class="reader-lib-item-text">${text}</div>
                        </div>
                        <button class="reader-lib-item-del" title="Verwijder" aria-label="Verwijder markering"><i class="fa-solid fa-xmark"></i></button>
                    `;
                    item.querySelector('.reader-lib-item-del').addEventListener('click', e => {
                        e.stopPropagation();
                        // Remove mark from DOM (only if current book)
                        if (isCurrent) {
                            const markEl = document.querySelector(`[data-hl-id="${hl.id}"]`);
                            if (markEl) {
                                const p = markEl.parentNode;
                                while (markEl.firstChild) p.insertBefore(markEl.firstChild, markEl);
                                p.removeChild(markEl); p.normalize();
                            }
                        }
                        // Remove from its own storage key
                        const storageKey = hl._storageKey || HL_KEY;
                        try {
                            const arr = JSON.parse(localStorage.getItem(storageKey) || '[]');
                            localStorage.setItem(storageKey, JSON.stringify(arr.filter(x => x.id !== hl.id)));
                        } catch (_) {}
                        libRender();
                    });
                    item.addEventListener('click', e => {
                        if (e.target.closest('.reader-lib-item-del')) return;
                        if (isCurrent) {
                            jumpTo(hl.pageNum, true); closeSheet();
                        } else {
                            try { localStorage.setItem('reading_progress_' + hl.productId, String(hl.pageNum)); } catch (_) {}
                            window.location.href = hl.readerUrl;
                        }
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
                // Remove all marks from DOM (current book)
                document.querySelectorAll('mark.hl').forEach(m => {
                    const p = m.parentNode;
                    while (m.firstChild) p.insertBefore(m.firstChild, m);
                    p.removeChild(m); p.normalize();
                });
                // Clear highlights from ALL books in localStorage
                try {
                    for (let i = localStorage.length - 1; i >= 0; i--) {
                        const k = localStorage.key(i);
                        if (k && k.startsWith('hl_')) localStorage.removeItem(k);
                    }
                } catch (_) {}
                libRender();
            }
        });

        // Refresh library when sheet opens to 'library' tab

        function hlLoad() { try { return JSON.parse(localStorage.getItem(HL_KEY) || '[]'); } catch { return []; } }
        function hlSave(a) { try { localStorage.setItem(HL_KEY, JSON.stringify(a)); } catch {} }
        function hlLoadAll() {
            // Scan all localStorage keys matching hl_* and aggregate across all books
            const all = [];
            try {
                for (let i = 0; i < localStorage.length; i++) {
                    const k = localStorage.key(i);
                    if (!k || !k.startsWith('hl_')) continue;
                    const arr = JSON.parse(localStorage.getItem(k) || '[]');
                    arr.forEach(h => {
                        // Backfill missing product info for highlights saved before this update
                        if (!h.productId && k === HL_KEY) {
                            h.productId = PRODUCT_ID;
                            h.productTitle = PRODUCT_TITLE;
                            h.readerUrl = READER_URL;
                        }
                        all.push({ _storageKey: k, ...h });
                    });
                }
            } catch (_) {}
            return all;
        }

        let hlBackdrop = null;
        let _hlHideTime = 0;  // timestamp of last hlHide(), used to suppress sheet toggle
        function hlShowPopup(rect, existing) {
            if (!hlPopup) return;
            const removeBtn = document.getElementById('hl-remove-btn');
            if (removeBtn) removeBtn.toggleAttribute('hidden', !existing);
            hlPopup.removeAttribute('hidden');
            const MARGIN = 8;
            const VW = window.innerWidth;
            const VH = window.innerHeight;
            // Read real dimensions now that the element is visible
            const pw = hlPopup.offsetWidth  || 220;
            const ph = hlPopup.offsetHeight || 44;
            // Desired position: horizontally centred on the selection
            let left = rect.left + rect.width / 2 - pw / 2;
            // Clamp left edge so popup never overflows left or right
            left = Math.max(MARGIN, Math.min(VW - pw - MARGIN, left));
            // Prefer above the selection; fall back to below
            let top = rect.top - ph - 10;
            if (top < MARGIN) top = rect.bottom + 10;
            // Final vertical clamp — never overflow bottom of viewport
            top = Math.max(MARGIN, Math.min(VH - ph - MARGIN, top));
            hlPopup.style.left = left + 'px';
            hlPopup.style.top  = top  + 'px';
        }

        function hlHide() {
            if (hlPopup && !hlPopup.hidden) _hlHideTime = Date.now();
            hlPopup?.setAttribute('hidden', '');
            hlPending = null; hlMark = null;
        }

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
            return { id: Date.now().toString(36) + Math.random().toString(36).slice(2, 6), pageNum, color: null, text: range.toString().trim().slice(0, 80), startOffset: s, endOffset: s + range.toString().length, productId: PRODUCT_ID, productTitle: PRODUCT_TITLE, readerUrl: READER_URL };
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
            Object.entries(pageMap).forEach(([n, el]) => {
                bmRenderMarkers(el, parseInt(n));
                bmRenderPageMarkers(el, parseInt(n));
            });
        }

        // ── Page-level bookmark (via control panel button) ──────────
        function bmPageLabel() {
            const pageNum = visiblePage();
            const btn = document.getElementById('sheet-bm-page-btn');
            if (!btn) return;
            const has = bmLoad().some(b => b.productId === PRODUCT_ID && b.pageNum === pageNum && b.paraIndex === -1);
            btn.classList.toggle('active', has);
            const label = has ? 'Bladwijzer verwijderen' : 'Voeg bladwijzer toe';
            btn.title = label;
            btn.setAttribute('aria-label', label);
        }

        function bmPageToggle() {
            const pageNum = visiblePage();
            const pageEl  = pageMap[pageNum];
            const existing = bmLoad();
            const idx = existing.findIndex(b => b.productId === PRODUCT_ID && b.pageNum === pageNum && b.paraIndex === -1);
            if (idx >= 0) {
                // Remove
                const id = existing[idx].id;
                bmSave(existing.filter((_, i) => i !== idx));
                pageEl?.querySelector(`.bm-page-marker[data-bm-id="${id}"]`)?.remove();

                let t = document.getElementById('hl-toast');
                if (!t) { t = Object.assign(document.createElement('div'), { id: 'hl-toast', className: 'hl-toast' }); document.body.appendChild(t); }
                t.textContent = '✓ Bladwijzer verwijderd';
                t.classList.add('show'); clearTimeout(t._t); t._t = setTimeout(() => t.classList.remove('show'), 1600);
            } else {
                // Add
                const newBm = { id: Date.now().toString(36) + Math.random().toString(36).slice(2,6), productId: PRODUCT_ID, productTitle: PRODUCT_TITLE, productSlug: PRODUCT_SLUG, readerUrl: READER_URL, pageNum, paraIndex: -1, text: '', date: new Date().toISOString() };
                existing.push(newBm);
                bmSave(existing);
                if (pageEl) bmInsertPageMarker(newBm, pageEl);
                let t = document.getElementById('hl-toast');
                if (!t) { t = Object.assign(document.createElement('div'), { id: 'hl-toast', className: 'hl-toast' }); document.body.appendChild(t); }
                t.textContent = '✓ Bladwijzer toegevoegd';
                t.classList.add('show'); clearTimeout(t._t); t._t = setTimeout(() => t.classList.remove('show'), 1600);
            }
            bmPageLabel();
            if (panelLibrary && !panelLibrary.hidden) libRender();
        }

        function bmInsertPageMarker(bm, pageEl) {
            if (pageEl.querySelector(`.bm-page-marker[data-bm-id="${bm.id}"]`)) return;
            pageEl.style.position = 'relative';
            const marker = document.createElement('div');
            marker.className = 'bm-page-marker';
            marker.dataset.bmId = bm.id;
            marker.title = 'Bladwijzer verwijderen';
            marker.setAttribute('aria-label', 'Bladwijzer verwijderen');
            marker.innerHTML = '<svg viewBox="0 0 18 28" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><polygon points="0,0 18,0 18,28 9,20 0,28"/></svg>';
            marker.addEventListener('click', e => {
                e.stopPropagation();
                bmSave(bmLoad().filter(x => x.id !== bm.id));
                marker.remove();
                bmPageLabel();
                if (panelLibrary && !panelLibrary.hidden) libRender();
                let t = document.getElementById('hl-toast');
                if (!t) { t = Object.assign(document.createElement('div'), { id: 'hl-toast', className: 'hl-toast' }); document.body.appendChild(t); }
                t.textContent = '✓ Bladwijzer verwijderd';
                t.classList.add('show'); clearTimeout(t._t); t._t = setTimeout(() => t.classList.remove('show'), 1600);
            });
            pageEl.appendChild(marker);
        }

        function bmRenderPageMarkers(pageEl, pageNum) {
            // Remove stale
            const storedIds = new Set(bmLoad().filter(b => b.productId === PRODUCT_ID && b.pageNum === pageNum && b.paraIndex === -1).map(b => b.id));
            pageEl.querySelectorAll('.bm-page-marker').forEach(m => { if (!storedIds.has(m.dataset.bmId)) m.remove(); });
            // Remove padding if no markers left

            // Add missing
            bmLoad().filter(b => b.productId === PRODUCT_ID && b.pageNum === pageNum && b.paraIndex === -1)
                .forEach(bm => bmInsertPageMarker(bm, pageEl));
        }

        document.getElementById('sheet-bm-page-btn')?.addEventListener('click', () => {
            bmPageToggle();
        });

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

        // Escape key closes the highlight popup
        document.addEventListener('keydown', e => { if (e.key === 'Escape' && hlPopup && !hlPopup.hidden) hlHide(); });

        // Click outside the popup (but not on a mark) closes it without triggering anything else
        document.addEventListener('click', e => {
            if (hlPopup && !hlPopup.hidden && !hlPopup.contains(e.target) && !e.target.closest('mark.hl')) {
                clearTimeout(_hlTimer);          // cancel any pending re-open from mouseup
                window.getSelection()?.removeAllRanges(); // clear selection so hlCheckSel won't reopen
                hlHide();
            }
        });

        // ══════════════════════════════════════════
        // ZOEKFUNCTIE (server-side via database API)
        // ══════════════════════════════════════════
        (function () {
            const SEARCH_URL = '{{ route('onlineLezenSearchApi', $product->slug) }}';
            const panel     = document.getElementById('reader-search-panel');
            const backdrop  = document.getElementById('reader-search-backdrop');
            const openBtn   = document.getElementById('reader-search-open-btn');
            const closeBtn  = document.getElementById('reader-search-close');
            const input     = document.getElementById('reader-search-input');
            const clearBtn  = document.getElementById('reader-search-clear');
            const metaEl    = document.getElementById('reader-search-meta');
            const resultsEl = document.getElementById('reader-search-results');
            if (!panel || !input) return;

            let currentMark = null;

            // ── Pin panel to visual viewport so keyboard open/close never moves it ──
            // Only active on mobile (≤600px) — desktop uses CSS positioning
            function isMobile() { return window.innerWidth <= 600; }
            function pinPanelToViewport() {
                if (!window.visualViewport || panel.hidden || !isMobile()) return;
                const vv = window.visualViewport;
                // Disable CSS transition while we reposition to avoid sliding animation
                panel.style.transition = 'none';
                panel.style.top    = vv.offsetTop + 'px';
                panel.style.left   = vv.offsetLeft + 'px';
                panel.style.width  = vv.width + 'px';
                // Use layout viewport height (window.innerHeight) — does NOT change when keyboard opens
                panel.style.height = window.innerHeight + 'px';
                // Re-enable transition after repositioning (next frame)
                requestAnimationFrame(() => {
                    panel.style.transition = '';
                });
            }
            function startPinning() {
                if (!window.visualViewport) return;
                window.visualViewport.addEventListener('resize', pinPanelToViewport);
                window.visualViewport.addEventListener('scroll', pinPanelToViewport);
                pinPanelToViewport();
            }
            function stopPinning() {
                if (!window.visualViewport) return;
                window.visualViewport.removeEventListener('resize', pinPanelToViewport);
                window.visualViewport.removeEventListener('scroll', pinPanelToViewport);
                // Only clear inline styles if we're on mobile (desktop was never touched)
                if (isMobile()) {
                    panel.style.top = panel.style.left = panel.style.width = panel.style.height = panel.style.transition = '';
                }
            }

            function openSearch() {
                panel.hidden = false;
                backdrop.classList.add('open');
                requestAnimationFrame(() => {
                    panel.classList.add('open');
                    startPinning();
                });
                setTimeout(() => input.focus({ preventScroll: true }), 50);
            }
            function closeSearch() {
                stopPinning();
                panel.classList.remove('open');
                backdrop.classList.remove('open');
                setTimeout(() => { panel.hidden = true; }, 220);
                clearAllHighlights();
            }
            function clearHighlight() {
                if (currentMark && currentMark.parentNode) {
                    const parent = currentMark.parentNode;
                    parent.replaceChild(document.createTextNode(currentMark.textContent), currentMark);
                    parent.normalize();
                }
                currentMark = null;
            }
            function clearAllHighlights() {
                // Remove all search highlights from the entire document
                document.querySelectorAll('mark.reader-search-highlight').forEach(mark => {
                    const parent = mark.parentNode;
                    if (parent) {
                        parent.replaceChild(document.createTextNode(mark.textContent), mark);
                        parent.normalize();
                    }
                });
                currentMark = null;
            }

            openBtn?.addEventListener('click', openSearch);
            closeBtn.addEventListener('click', closeSearch);
            backdrop.addEventListener('click', closeSearch);
            document.addEventListener('keydown', e => { if (e.key === 'Escape' && !panel.hidden) closeSearch(); });

            input.addEventListener('input', () => {
                clearBtn.hidden = !input.value;
                debounceSearch();
            });
            clearBtn.addEventListener('click', () => {
                input.value = ''; clearBtn.hidden = true;
                metaEl.textContent = ''; resultsEl.innerHTML = '';
                clearHighlight();
                pinPanelToViewport(); // re-pin before focus to prevent shift
                const savedY = window.scrollY;
                input.focus({ preventScroll: true });
                setTimeout(() => window.scrollTo(0, savedY), 50);
                setTimeout(() => window.scrollTo(0, savedY), 200);
            });

            let searchTimer = null;
            function debounceSearch() {
                clearTimeout(searchTimer);
                if (input.value.trim().length < 2) { metaEl.textContent = ''; resultsEl.innerHTML = ''; return; }
                metaEl.textContent = 'Zoeken…';
                searchTimer = setTimeout(runSearch, 350);
            }

            async function runSearch() {
                const query = input.value.trim();
                if (query.length < 2) return;
                try {
                    const res  = await fetch(SEARCH_URL + '?q=' + encodeURIComponent(query));
                    const data = await res.json();
                    renderResults(data.results, data.total, query);
                } catch (e) {
                    metaEl.textContent = 'Zoekfout. Probeer opnieuw.';
                }
            }

            function renderResults(results, total, query) {
                resultsEl.innerHTML = '';
                if (!results.length) { metaEl.textContent = 'Geen resultaten voor "' + query + '".'; return; }
                metaEl.textContent = total + ' resultaat' + (total !== 1 ? 'en' : '');

                results.forEach(r => {
                    // Build snippet — escape HTML first, then restore [[HIT]] marks
                    const snippetHtml = r.snippet
                        .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
                        .replace(/\[\[HIT\]\]([\s\S]*?)\[\[\/HIT\]\]/g, '<mark>$1</mark>');

                    // Use <div> not <button> so flex-direction:column works reliably
                    const item = document.createElement('div');
                    item.className = 'reader-search-result-item';
                    item.setAttribute('role', 'button');
                    item.setAttribute('tabindex', '0');

                    const pageBadge = document.createElement('span');
                    pageBadge.className = 'reader-search-result-page';
                    pageBadge.textContent = 'Pagina ' + r.page;

                    const snippet = document.createElement('span');
                    snippet.className = 'reader-search-result-snippet';
                    snippet.innerHTML = snippetHtml;

                    item.appendChild(pageBadge);
                    item.appendChild(snippet);

                    item.addEventListener('click', () => {
                        clearAllHighlights();
                        const pageEl = pageMap[r.page];
                        if (!pageEl) { closeSearch(); return; }

                        // First scroll to page, then find & highlight the match
                        pageEl.scrollIntoView({ behavior: 'smooth', block: 'start' });

                        // Helper: remove diacritics for accent-insensitive DOM matching
                        function normStr(s) {
                            return s.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
                        }
                        const queryNorm = normStr(query);

                        const walker = document.createTreeWalker(pageEl, NodeFilter.SHOW_TEXT, {
                            acceptNode(node) {
                                const p = node.parentElement;
                                if (!p) return NodeFilter.FILTER_REJECT;
                                if (['script','style','button'].includes(p.tagName.toLowerCase())) return NodeFilter.FILTER_REJECT;
                                if (p.classList.contains('page-number')) return NodeFilter.FILTER_REJECT;
                                return NodeFilter.FILTER_ACCEPT;
                            }
                        });
                        let found = false;
                        let node;
                        let matchInFootnote = false;
                        let fnRefBtn = null;

                        while ((node = walker.nextNode())) {
                            const idx = normStr(node.textContent).indexOf(queryNorm);
                            if (idx === -1) continue;

                            // Check if this match lives inside a hidden .page-footnote
                            const footnoteSection = node.parentElement?.closest('.page-footnote');
                            if (footnoteSection) {
                                matchInFootnote = true;
                                // Determine which numbered footnote owns this text node
                                const allFps = footnoteSection.querySelectorAll('.footnote-p');
                                let currentFnNum = null;
                                for (const fp of allFps) {
                                    const supEl = fp.querySelector('sup');
                                    if (supEl) currentFnNum = supEl.textContent.trim();
                                    if (fp.contains(node)) break;
                                }
                                if (currentFnNum) {
                                    fnRefBtn = pageEl.querySelector(`.fn-ref[data-fn="${currentFnNum}"]`);
                                }
                                // Don't insert a mark in the hidden section — we'll highlight inside the popover instead
                                found = true;
                                break;
                            }

                            // Normal (visible) match — wrap in <mark>
                            const before = document.createTextNode(node.textContent.slice(0, idx));
                            const mark   = document.createElement('mark');
                            mark.className = 'reader-search-highlight';
                            mark.textContent = node.textContent.slice(idx, idx + query.length);
                            const after  = document.createTextNode(node.textContent.slice(idx + query.length));
                            node.parentNode.insertBefore(before, node);
                            node.parentNode.insertBefore(mark, node);
                            node.parentNode.insertBefore(after, node);
                            node.parentNode.removeChild(node);
                            currentMark = mark;
                            found = true;
                            break;
                        }

                        // Close panel, then open footnote popover (if needed) and scroll to highlight
                        panel.classList.remove('open');
                        backdrop.classList.remove('open');
                        setTimeout(() => {
                            panel.hidden = true;

                            if (matchInFootnote && fnRefBtn) {
                                // Open the footnote popover by simulating a click on the fn-ref button
                                fnRefBtn.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                fnRefBtn.click();

                                // After the popover is rendered, find the query text inside it and highlight it
                                setTimeout(() => {
                                    const popoverText = document.querySelector('.fn-popover__text');
                                    if (!popoverText) return;
                                    const pWalker = document.createTreeWalker(popoverText, NodeFilter.SHOW_TEXT);
                                    let pNode;
                                    while ((pNode = pWalker.nextNode())) {
                                        const pIdx = normStr(pNode.textContent).indexOf(queryNorm);
                                        if (pIdx === -1) continue;
                                        const pBefore = document.createTextNode(pNode.textContent.slice(0, pIdx));
                                        const pMark   = document.createElement('mark');
                                        pMark.className = 'reader-search-highlight';
                                        pMark.textContent = pNode.textContent.slice(pIdx, pIdx + query.length);
                                        const pAfter  = document.createTextNode(pNode.textContent.slice(pIdx + query.length));
                                        pNode.parentNode.insertBefore(pBefore, pNode);
                                        pNode.parentNode.insertBefore(pMark, pNode);
                                        pNode.parentNode.insertBefore(pAfter, pNode);
                                        pNode.parentNode.removeChild(pNode);
                                        currentMark = pMark;
                                        break;
                                    }
                                }, 120); // wait for popover animation to start
                            } else {
                                const target = found ? currentMark : pageEl;
                                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }, 230);
                    });
                    item.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') item.click(); });
                    resultsEl.appendChild(item);
                });
            }
        })();

        // ══════════════════════════════════════════

        if (document.readyState === 'complete') { restoreProgress(); }
        else { window.addEventListener('load', restoreProgress); }
    })();

    // ── iOS Safari keyboard-shift lock ────────────────────────────────────
    // iOS Safari shifts the page horizontally/vertically when the virtual
    // keyboard opens. The visualViewport API lets us detect and cancel this.
    (function () {
        // Hard-lock: any horizontal document scroll → snap back immediately
        function resetHorizontalScroll() {
            if (window.scrollX !== 0) window.scrollTo(0, window.scrollY);
        }
        window.addEventListener('scroll', resetHorizontalScroll, { passive: true });

        // visualViewport fires when iOS shifts the viewport offset (keyboard open).
        // We pin it back to offset 0,0 every time.
        if (window.visualViewport) {
            window.visualViewport.addEventListener('scroll', function () {
                if (window.visualViewport.offsetLeft !== 0 || window.visualViewport.offsetTop !== 0) {
                    window.scrollTo(
                        window.scrollX + window.visualViewport.offsetLeft,
                        window.scrollY + window.visualViewport.offsetTop
                    );
                }
            });
        }

        // When search input is focused (keyboard about to open), snapshot Y and restore it
        document.addEventListener('focusin', function (e) {
            if (e.target.matches('input, textarea, select')) {
                const savedY = window.scrollY;
                setTimeout(() => window.scrollTo(0, savedY), 50);
                setTimeout(() => window.scrollTo(0, savedY), 200);
                setTimeout(() => window.scrollTo(0, savedY), 500);
            }
        }, { passive: true });
    })();
    </script>
</div>
</body>
</html>

