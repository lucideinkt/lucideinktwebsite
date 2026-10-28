<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="google" content="notranslate">
    <link rel="preload" href="/fonts/OmarNaskh-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    @php
        $seoTitle        = $SEOData->title        ?? $product->title;
        $seoDescription  = $SEOData->description  ?? $product->short_description ?? '';
        $seoUrl          = $SEOData->url           ?? url()->current();
        $seoCanonical    = $SEOData->canonical_url ?? $seoUrl;
        $seoImage        = $SEOData->image         ?? secure_url('images/books_standing_new.webp');
        $seoAuthor       = $SEOData->author        ?? 'Lucide Inkt';
        $seoRobots       = $SEOData->robots        ?? null;
        $publishedTime   = $SEOData->published_time ?? $product->created_at ?? null;
        $modifiedTime    = $SEOData->modified_time  ?? $product->updated_at  ?? null;
    @endphp

    @if(!app()->environment('production'))
    <meta name="robots" content="noindex, nofollow">
    @elseif($seoRobots)
    <meta name="robots" content="{{ $seoRobots }}">
    @endif

    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="author"      content="{{ $seoAuthor }}">
    <link rel="canonical"    href="{{ $seoCanonical }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="article">
    <meta property="og:locale"      content="nl_NL">
    <meta property="og:site_name"   content="Lucide Inkt">
    <meta property="og:title"       content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url"         content="{{ $seoUrl }}">
    <meta property="og:image"       content="{{ $seoImage }}">
    <meta property="og:image:alt"   content="{{ $seoTitle }}">
    @if($publishedTime)
    <meta property="article:published_time" content="{{ $publishedTime instanceof \Carbon\Carbon ? $publishedTime->toIso8601String() : $publishedTime }}">
    @endif
    @if($modifiedTime)
    <meta property="article:modified_time"  content="{{ $modifiedTime instanceof \Carbon\Carbon ? $modifiedTime->toIso8601String() : $modifiedTime }}">
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
                let stored = localStorage.getItem('reader-theme');
                // Default to system theme when nothing is saved yet
                let mode = ['system', 'light', 'dark', 'ivory', 'white', 'sepia', 'green', 'gray', 'night', 'black'].includes(stored)
                    ? stored : (localStorage.getItem('reader-dark-mode') === '0' ? 'light' : 'system');
                let prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                document.documentElement.dataset.readerTheme = mode === 'system' ? (prefersDark ? 'dark' : 'light') : mode;
                if (mode === 'dark' || mode === 'gray' || mode === 'night' || mode === 'black' || (mode === 'system' && prefersDark)) {
                    document.documentElement.classList.add('reader-preload-dark');
                }
            } catch(error) { console.warn('Leesthema kon niet vooraf worden geladen.', error); }
            // Detect iOS to disable unsupported font-feature-settings (ss04)
            try {
                let isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) ||
                    (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);
                if (isIOS) {
                    document.documentElement.classList.add('ios-device');
                }
            } catch(_) {}
        })();
    </script>
    <style>
        /* Prevent page from scrolling horizontally when keyboard opens on mobile (iOS Safari) */
        html, body {
            overflow-x: clip;
            overscroll-behavior-x: none;
            max-width: 100vw;
        }

        /* ── Search highlight inside book text ── */
        .reader-search-highlight {
            background: rgba(255, 210, 60, 0.38);
            color: inherit;
            border-radius: 3px;
            padding: 0 2px;
            outline: 1px solid rgba(220, 170, 40, 0.5);
            box-shadow: 0 0 0 3px rgba(220, 170, 40, 0.12);
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
        .reader-sheet-theme-btn span                     { font-size: 12px !important; }
        .reader-sheet-theme-btn i                        { font-size: 16px !important; }
        .reader-back-btn                                 { font-size: 12px !important; }
        .reader-topbar-page-badge                        { font-size: 11px !important; }
        .toc-panel-close                                 { font-size: 15px !important; }
        .reader-sheet-bm-nav-btn                         { font-size: 11px !important; }
        /* Bookmark page marker — sits at top of page, padding-top makes room */
        .book-reader-scope .page                         { position: relative; font-size: let(--reader-font-size, 19px); }
        .bm-page-marker                                  { position: absolute !important; top: 0px !important; left: 8px !important; margin: 0 !important; padding: 0 !important; }
        /* GPU layer for overlay panels — prevents theme/popover repaints thrashing book content */
        .reader-control-sheet, .toc-panel, .hl-popup, .reader-search-panel { will-change: transform; }
        .book-reader-scope { contain: style; }
        /* Suppress native browser text-selection callout (iOS long-press copy/search popup) */
        #reader-content {
            -webkit-touch-callout: none; /* iOS Safari */
        }
    </style>
</head>
<body>
<div class="online-reader-html">

    {{-- Topbalk --}}
    <header class="reader-topbar" role="banner">
        <div class="reader-topbar-left">
            <a href="{{ route('onlineLezen') }}" class="reader-back-btn" aria-label="Terug naar bibliotheek">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                <span class="reader-back-btn-label">Bibliotheek</span>
            </a>
            <div class="reader-topbar-divider" aria-hidden="true"></div>
            <span class="reader-book-title">{{ $product->title }}</span>
        </div>

        {{-- Center: page slider navigation (desktop only) --}}
        <div class="reader-topbar-nav" aria-label="Paginanavigatie">
            <div class="reader-topbar-nav-pills">
                {{-- Pill 1: slider + page badge --}}
                <div class="reader-topbar-font-group reader-topbar-nav-group">
                    <input type="range" class="reader-topbar-font-range reader-topbar-page-slider" id="topbar-page-slider"
                           min="{{ $allPageMeta->min('page_number') }}"
                           max="{{ $allPageMeta->max('page_number') }}"
                           value="{{ $allPageMeta->min('page_number') }}"
                           style="width: 120px;"
                           aria-label="Ga naar pagina">
                    <span class="reader-topbar-font-val reader-topbar-page-badge" id="topbar-page-cur" aria-live="polite" role="button" tabindex="0" aria-label="Ga naar pagina" aria-haspopup="dialog">
                        <span id="topbar-page-cur-num">—</span><span class="reader-topbar-page-sep"> / {{ $allPageMeta->max('page_number') }}</span>
                    </span>
                </div>
            </div>
        </div>

        <div class="reader-topbar-right" role="toolbar" aria-label="Lezeropties">
            {{-- Mobile page indicator (≤1024px only) --}}
            <span class="reader-topbar-mobile-page reader-topbar-mobile-page--tappable" id="topbar-mobile-page" aria-live="polite" role="button" tabindex="0" title="Ga naar pagina" aria-label="Pagina — van {{ $allPageMeta->max('page_number') }}, klik om te navigeren">— / {{ $allPageMeta->max('page_number') }}</span>
            @if(!empty($tocEntries))
            <button class="reader-topbar-icon-btn reader-topbar-mobile-toc" id="topbar-mobile-toc-btn" type="button" aria-label="Inhoudsopgave" title="Inhoudsopgave">
                <i class="fa-solid fa-list-ul" aria-hidden="true"></i>
            </button>
            @endif
            {{-- Action icon buttons (desktop only) --}}
            <div class="reader-topbar-actions">
                <div class="reader-topbar-actions-divider" aria-hidden="true"></div>
                <button class="reader-topbar-icon-btn" id="topbar-search-btn" type="button" aria-label="Zoeken in boek" title="Zoeken">
                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                </button>
                <button class="reader-topbar-icon-btn reader-topbar-bm-icon-btn" id="topbar-bm-btn" type="button" aria-label="Bladwijzer toevoegen" title="Bladwijzer">
                    <i class="fa-regular fa-bookmark" aria-hidden="true"></i>
                </button>
                <button class="reader-topbar-icon-btn" id="topbar-settings-btn" type="button" aria-label="Thema's en instellingen" title="Thema's en instellingen" aria-haspopup="dialog">
                    <i class="fa-solid fa-sliders" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </header>

    {{-- Progress bar — slim, just below topbar --}}
    <div class="reader-progress-bar-wrap" role="progressbar" aria-label="Leesvoortgang" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        <div class="reader-progress-bar-fill" id="progress-fill"></div>
    </div>

    {{-- Go-to-page modal --}}
    <div id="goto-page-overlay" class="goto-page-overlay" role="dialog" aria-modal="true" aria-label="Ga naar pagina" hidden>
        <div class="goto-page-modal">
            <button type="button" id="goto-page-cancel" class="goto-page-close" aria-label="Paginanavigatie sluiten">×</button>
            <p class="goto-page-label">Ga naar pagina</p>
            <div class="goto-page-input-row">
                <button type="button" id="goto-page-prev" class="goto-page-step" aria-label="Vorige pagina">
                    <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                </button>
                <div class="goto-page-field">
                <input type="number" id="goto-page-input" class="goto-page-input"
                       min="{{ $allPageMeta->min('page_number') }}"
                       max="{{ $allPageMeta->max('page_number') }}"
                       inputmode="numeric"
                       aria-label="Paginanummer">
                <span class="goto-page-total">/ {{ $allPageMeta->max('page_number') }}</span>
                </div>
                <button type="button" id="goto-page-next" class="goto-page-step" aria-label="Volgende pagina">
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
            <input type="range" id="goto-page-slider" class="goto-page-slider" min="0" max="{{ $allPageMeta->count() - 1 }}" step="1" value="0" aria-label="Pagina kiezen">
            <div class="goto-page-range"><span>{{ $allPageMeta->min('page_number') }}</span><span>{{ $allPageMeta->max('page_number') }}</span></div>
            <p id="goto-page-error" class="goto-page-error" role="alert" hidden></p>
            <button type="button" id="goto-page-confirm" class="goto-page-btn goto-page-btn--confirm">Ga naar pagina <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
        </div>
    </div>

    {{-- Boekinhoud --}}
    <main class="reader-wrap">
        <article class="book-reader-scope" id="reader-content" lang="nl" role="main"
            data-book-slug="{{ $product->slug }}"
            data-product-id="{{ $product->id }}"
            data-api-url="{{ route('onlineLezenPagesApi', $product->slug) }}"
            data-last-page="{{ $pages->last()->page_number }}"
            data-total-pages="{{ $allPageMeta->max('page_number') }}"
        >
            @php
                $bookTitle = $pages->first()?->book_title;
                $isStandaloneDuaBook = in_array($product->slug, ['cevsen-ul-kebir', 'namaz-tesbihati'], true);
            @endphp
            @if($bookTitle)
            <div class="text-center page-title-series{{ $isStandaloneDuaBook ? ' page-title-series--cevsen' : '' }}">
                @if(!$isStandaloneDuaBook)
                <p>Uit de Reeks van de Risale-i Nur</p>
                @endif
                <h1 class="book-title">{{ $bookTitle }}</h1>
                @if(!$isStandaloneDuaBook)
                <p>Bedi&uuml;zzaman Said Nurs&icirc;</p>
                @endif
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

    {{-- Search FAB — sits above the bookmark FAB --}}
    <button class="reader-search-fab" id="fab-search-btn" type="button" aria-label="Zoeken in boek" title="Zoeken">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
    </button>

    {{-- Bookmark FAB — sits above the main FAB --}}
    <button class="reader-bm-fab" id="fab-bm-btn" type="button" aria-label="Bladwijzer toevoegen" title="Bladwijzer toevoegen">
        <i class="fa-solid fa-bookmark" aria-hidden="true"></i>
    </button>

    {{-- FAB — floating action button (bottom-right, thumb-reachable) --}}
    <button class="reader-fab reader-fab--icon-only" id="reader-fab" aria-label="Lezeropties" aria-expanded="false" aria-haspopup="dialog">
        <span class="reader-fab-icon-wrap" aria-hidden="true">
            <i class="fa-solid fa-sliders reader-fab-icon"></i>
        </span>
    </button>


    {{-- ────── Control Sheet ────── --}}
    <div class="reader-control-sheet" id="reader-control-sheet" role="dialog" aria-modal="true" aria-labelledby="reader-sheet-heading" aria-hidden="true" inert>
        {{-- Drag handle --}}
        <div class="reader-sheet-drag-handle" aria-hidden="true"></div>

        {{-- Progress bar --}}
        <div class="reader-sheet-progress-wrap" aria-hidden="true">
            <div class="reader-sheet-progress-fill" id="sheet-progress-fill"></div>
        </div>

        <div class="reader-settings-heading" id="reader-sheet-header" hidden>
            <h2 id="reader-sheet-heading">Leesmenu</h2>
            <button class="reader-sheet-close-x" id="reader-sheet-close-btn" type="button" aria-label="Sluiten">
                <span aria-hidden="true">×</span>
            </button>
        </div>

        {{-- ══ Apple Books-style main menu panel (mobile default) ══ --}}
        <div id="sheet-panel-menu" hidden>

            {{-- Dark pill: page slider + progress (like Apple Books "Inhoud • 14%") --}}
            <div class="sheet-menu-prog-pill">
                {{-- Header: "Inhoud" label + page counter + progress % + optional TOC button --}}
                <div class="sheet-menu-pill-header">
                    <span class="sheet-menu-pill-label">Inhoud</span>
                    <div class="sheet-menu-pill-right">
                        <span class="sheet-menu-page-counter" id="sheet-menu-current">— / —</span>
                        <span class="sheet-menu-pill-pct" id="sheet-menu-progress-pct">—%</span>
                        @if(!empty($tocEntries))
                        <button class="sheet-menu-toc-btn" id="sheet-menu-toc-btn" type="button" aria-label="Inhoudsopgave">
                            <i class="fa-solid fa-list-ul" aria-hidden="true"></i>
                        </button>
                        @endif
                    </div>
                </div>
                {{-- Page slider --}}
                <div class="sheet-menu-slider-wrap">
                    <input type="range" class="sheet-menu-slider" id="sheet-menu-page-slider"
                           min="{{ $allPageMeta->min('page_number') }}"
                           max="{{ $allPageMeta->max('page_number') }}"
                           value="{{ $allPageMeta->min('page_number') }}"
                           aria-label="Ga naar pagina">
                </div>
            </div>

            {{-- Action rows --}}
            <button class="sheet-menu-row" id="sheet-menu-search-btn" type="button" aria-label="Zoeken in boek">
                <span class="sheet-menu-row-label">Zoek in boek</span>
                <i class="fa-solid fa-magnifying-glass sheet-menu-row-icon" aria-hidden="true"></i>
            </button>
            <button id="sheet-menu-clear-search" type="button" hidden>
                <i class="fa-solid fa-eraser" aria-hidden="true"></i> Zoekmarkeringen wissen
            </button>

            <button class="sheet-menu-row sheet-menu-bm-row" id="sheet-menu-bm-btn" type="button" aria-label="Bladwijzer toevoegen">
                <span class="sheet-menu-row-label" id="sheet-menu-bm-label">Bladwijzer toevoegen</span>
                <i class="fa-solid fa-bookmark sheet-menu-row-icon" aria-hidden="true"></i>
            </button>


            <button class="sheet-menu-row" id="sheet-menu-settings-btn" type="button" aria-label="Thema's en instellingen">
                <span class="sheet-menu-row-label">Thema's en instellingen</span>
                <span class="sheet-menu-aa-icon" aria-hidden="true">AA</span>
            </button>

            <button class="sheet-menu-row sheet-menu-row--last" id="sheet-menu-library-btn" type="button" aria-label="Bladwijzers en markeringen">
                <span class="sheet-menu-row-label">Bladwijzers en markeringen</span>
                <i class="fa-regular fa-bookmark sheet-menu-row-icon" aria-hidden="true"></i>
            </button>

        </div>{{-- /sheet-panel-menu --}}

        {{-- Controls panel — Thema's en instellingen --}}
        <div id="sheet-panel-controls">

        {{-- Back button (mobile: shown when navigated from menu) --}}
        <button class="sheet-panel-back-btn" id="sheet-controls-back-btn" type="button" aria-label="Terug naar menu">
            <i class="fa-solid fa-chevron-left" aria-hidden="true"></i> Terug
        </button>

        <div class="reader-settings-tabs" role="tablist" aria-label="Leesinstellingen">
            <button id="reader-settings-tab-text" class="reader-settings-tab" type="button" role="tab" aria-selected="true" aria-controls="reader-settings-text" tabindex="0">Tekst</button>
            <button id="reader-settings-tab-colors" class="reader-settings-tab" type="button" role="tab" aria-selected="false" aria-controls="reader-settings-colors" tabindex="-1">Kleuren</button>
        </div>
        <div id="reader-settings-text" role="tabpanel" aria-labelledby="reader-settings-tab-text">
        {{-- Text font size --}}
        <div class="reader-sheet-section reader-sheet-fontpicker-row reader-setting-row">
            <div class="reader-sheet-slider-meta">
                <span class="reader-sheet-slider-label">Nederlandse tekst</span>
                <div class="reader-sheet-slider-right">
                    <span class="reader-sheet-slider-val" id="sheet-font-val" aria-live="polite">19.0px</span>
                    <button class="reader-sheet-reset-btn" id="sheet-font-reset" type="button" aria-label="Nederlandse tekst herstellen">Herstellen</button>
                </div>
            </div>
            <div class="font-step-control" id="font-step-control">
                <button class="font-step-az" id="font-dec-btn" type="button" aria-label="Kleiner lettertype">−</button>
                <output class="reader-setting-value" id="reader-font-value" aria-live="polite">19</output>
                <input type="range" class="font-step-range reader-setting-slider" id="font-step-range"
                       min="0" step="1" aria-label="Lettergrootte">
                <button class="font-step-az" id="font-inc-btn" type="button" aria-label="Groter lettertype">+</button>
            </div>
        </div>

        {{-- Arabic font size --}}
        <div class="reader-sheet-section reader-sheet-fontpicker-row reader-setting-row">
            <div class="reader-sheet-slider-meta">
                <span class="reader-sheet-slider-label">Arabische tekst</span>
                <div class="reader-sheet-slider-right">
                    <span class="reader-sheet-slider-val" id="arabic-font-size-display" aria-live="polite">29.0px</span>
                    <button class="reader-sheet-reset-btn" id="arabic-font-reset" type="button" aria-label="Arabische tekst herstellen">Herstellen</button>
                </div>
            </div>
            <div class="font-step-control" id="arabic-font-step-control">
                <button class="font-step-az" id="arabic-font-dec-btn" type="button" aria-label="Kleiner Arabisch lettertype">−</button>
                <output class="reader-setting-value" id="reader-arabic-value" aria-live="polite">29</output>
                <input type="range" class="font-step-range reader-setting-slider" id="arabic-font-step-range"
                       min="0" step="1" aria-label="Arabische lettergrootte">
                <button class="font-step-az" id="arabic-font-inc-btn" type="button" aria-label="Groter Arabisch lettertype">+</button>
            </div>
        </div>

        <div class="reader-sheet-divider"></div>

        @foreach ([
            ['id' => 'line-height', 'label' => 'Regelafstand', 'min' => '1.2', 'max' => '2.2', 'step' => '0.1', 'default' => '1.5'],
            ['id' => 'side-padding', 'label' => 'Zijruimte', 'min' => '8', 'max' => '64', 'step' => '4', 'default' => '16'],
        ] as $control)
        <div class="reader-sheet-section reader-sheet-fontpicker-row reader-setting-row">
            <div class="reader-sheet-slider-meta">
                <label class="reader-sheet-slider-label" for="reader-{{ $control['id'] }}">{{ $control['label'] }}</label>
                <div class="reader-sheet-slider-right">
                    <button class="reader-sheet-reset-btn" id="reader-{{ $control['id'] }}-reset" type="button" aria-label="{{ $control['label'] }} herstellen">Herstellen</button>
                </div>
            </div>
            <div class="font-step-control">
            <button class="font-step-az" id="reader-{{ $control['id'] }}-dec" type="button" aria-label="{{ $control['label'] }} verkleinen">−</button>
            <output class="reader-setting-value" id="reader-{{ $control['id'] }}-value" for="reader-{{ $control['id'] }}">{{ $control['default'] }}</output>
            <input type="range" class="font-step-range reader-setting-slider" id="reader-{{ $control['id'] }}"
                   min="{{ $control['min'] }}" max="{{ $control['max'] }}" step="{{ $control['step'] }}" value="{{ $control['default'] }}">
            <button class="font-step-az" id="reader-{{ $control['id'] }}-inc" type="button" aria-label="{{ $control['label'] }} vergroten">+</button>
            </div>
        </div>
        @endforeach
        <div class="reader-alignment-control">
            <span class="reader-sheet-slider-label" id="reader-alignment-label">Tekstuitlijning</span>
            <div class="reader-settings-tabs" role="group" aria-labelledby="reader-alignment-label">
                <button type="button" class="reader-settings-tab" data-text-alignment="justify" aria-pressed="true">Uitgevuld</button>
                <button type="button" class="reader-settings-tab" data-text-alignment="left" aria-pressed="false">Links uitgelijnd</button>
            </div>
        </div>
        </div>

        {{-- Theme --}}
        <div id="reader-settings-colors" role="tabpanel" aria-labelledby="reader-settings-tab-colors" hidden>
        <div class="reader-sheet-section reader-sheet-theme-section">
            <span class="reader-sheet-section-label">Weergave</span>
            <div class="reader-sheet-theme-row">
                <button class="reader-sheet-theme-btn" data-theme="system" type="button" aria-label="Systeemthema">
                    <span class="reader-theme-swatch" aria-hidden="true">Aa</span><span>Systeem</span>
                </button>
                <button class="reader-sheet-theme-btn" data-theme="light" type="button" aria-label="Papier thema">
                    <span class="reader-theme-swatch" aria-hidden="true">Aa</span><span>Papier</span>
                </button>
                <button class="reader-sheet-theme-btn" data-theme="dark" type="button" aria-label="Donker thema">
                    <span class="reader-theme-swatch" aria-hidden="true">Aa</span><span>Donker</span>
                </button>
                @foreach (['ivory' => 'Warm ivoor', 'white' => 'Papierwit', 'sepia' => 'Klassiek sepia', 'green' => 'Zacht saliegroen', 'gray' => 'Donker grafiet', 'night' => 'Nachtmodus', 'black' => 'Zwart'] as $value => $label)
                <button class="reader-sheet-theme-btn" data-theme="{{ $value }}" type="button" aria-label="{{ $label }} thema">
                    <span class="reader-theme-swatch" aria-hidden="true">Aa</span><span>{{ $label }}</span>
                </button>
                @endforeach
            </div>
        </div>
        <button id="reader-theme-reset" class="reader-settings-reset" type="button">Standaardkleur herstellen</button>
        </div>

        <div class="reader-sheet-bottom-safe"></div>
        </div>{{-- /sheet-panel-controls --}}

        {{-- Library panel: bookmarks + highlights across all books --}}
        <div id="sheet-panel-library" hidden>
            <button class="sheet-panel-back-btn" id="sheet-library-back-btn" type="button" aria-label="Terug naar menu">
                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i> Terug
            </button>
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

    {{-- Inhoudsopgave — only rendered when the book has TOC entries --}}
    @if(!empty($tocEntries))
    <nav id="toc-panel" class="toc-panel" role="dialog" aria-label="Inhoudsopgave" aria-modal="true" aria-hidden="true" inert>
        <div class="toc-panel-header">
            <span class="toc-panel-title">Inhoudsopgave</span>
            <button class="toc-panel-close" id="toc-close-btn" aria-label="Sluit inhoudsopgave">
                <span aria-hidden="true">×</span>
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
    <div id="reader-search-panel" class="reader-search-panel" hidden role="dialog" aria-label="Zoek in boek" aria-modal="true">
        <div class="reader-search-header">
            <span class="reader-search-title">Zoek in boek</span>
            <button class="reader-search-close" id="reader-search-close" aria-label="Venster sluiten" type="button">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="reader-search-body">
            <div class="reader-search-input-wrap">
                <i class="fa-solid fa-magnifying-glass reader-search-icon" aria-hidden="true"></i>
                <input type="search" id="reader-search-input" class="reader-search-input"
                       aria-label="Zoektekst" placeholder="Typ hier om te zoeken" maxlength="200" autocomplete="off" autocapitalize="none" spellcheck="false" enterkeyhint="done">
                <button class="reader-search-clear" id="reader-search-clear" aria-label="Zoektekst wissen" type="button" hidden>
                    <i class="fa-solid fa-circle-xmark" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="reader-search-meta" id="reader-search-meta" aria-live="polite"></div>
        <div class="reader-search-results" id="reader-search-results" role="group" aria-label="Zoekresultaten"></div>
        <button id="reader-search-keyboard-dismiss" class="reader-search-keyboard-dismiss" type="button" hidden>
            <i class="fa-regular fa-keyboard" aria-hidden="true"></i> Toetsenbord verbergen
        </button>
    </div>
    <div class="reader-search-backdrop" id="reader-search-backdrop"></div>

    {{-- ── Bottom page scrubber — MUST be in DOM before the IIFE script below ── --}}
    {{-- Page scrubber removed --}}

    <script>
    (function () {
        // Prevent iOS Safari from overriding JS-controlled scroll restoration
        if ('scrollRestoration' in history) history.scrollRestoration = 'manual';

        const topbarEl    = document.querySelector('.reader-topbar');
        const progressEl  = document.querySelector('.reader-progress-bar-wrap');
        const TOPBAR_H    = (topbarEl?.offsetHeight ?? 56) + (progressEl?.offsetHeight ?? 2);
        function centerReaderPassage(element) {
            const rect = element.getBoundingClientRect();
            const center = TOPBAR_H + (window.innerHeight - TOPBAR_H) / 2;
            window.scrollTo({ top: Math.max(0, window.scrollY + rect.top + rect.height / 2 - center), behavior: 'smooth' });
        }
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
        const topbarBadge       = document.getElementById('topbar-page-cur-num');
        const topbarMobilePage  = document.getElementById('topbar-mobile-page');
        const totalPages        = {{ $allPageMeta->max('page_number') }};
        const controlSheet      = document.getElementById('reader-control-sheet');
        const sheetBackdrop     = document.getElementById('reader-sheet-backdrop');
        const sheetPageCurrent  = document.getElementById('sheet-page-current');
        const sheetPrevBtn      = document.getElementById('sheet-prev-btn');
        const sheetNextBtn      = document.getElementById('sheet-next-btn');
        const sheetPageSlider   = document.getElementById('sheet-page-slider');
        const sheetPagePreview  = document.getElementById('sheet-page-preview');
        const rpsSlider         = document.getElementById('rps-slider');
        const rpsCurrent        = document.getElementById('rps-current');
        const fontValEl         = document.getElementById('sheet-font-val');
        const arabicFontValEl   = document.getElementById('arabic-font-size-display');
        const sheetTocBtn       = document.getElementById('sheet-toc-btn');
        const sentinel          = document.getElementById('lazy-sentinel');
        const loaderEl          = document.getElementById('reader-loader');
        const fab               = document.getElementById('reader-fab');
        function showLoader() { if (loaderEl) { loaderEl.classList.add('visible'); loaderEl.setAttribute('aria-hidden','false'); } }
        function hideLoader() { if (loaderEl) { loaderEl.classList.remove('visible'); loaderEl.setAttribute('aria-hidden','true'); } }

        if (!readerEl) return;

        function readerTextMatch(text, query) {
            const fold = value => value.normalize('NFD').replace(/[\u0300-\u036f\u00AD]/g, '').toLowerCase();
            let folded = '';
            const sourceIndex = [];
            for (let i = 0; i < text.length; i++) {
                const part = fold(text[i]);
                for (let j = 0; j < part.length; j++) { folded += part[j]; sourceIndex.push(i); }
            }
            const needle = fold(query);
            const index = needle ? folded.indexOf(needle) : -1;
            if (index === -1) return null;
            return {
                start: sourceIndex[index],
                end: sourceIndex[index + needle.length - 1] + 1,
            };
        }

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
            if (topbarBadge)      topbarBadge.textContent     = page;
            if (topbarMobilePage) topbarMobilePage.textContent = page + ' / ' + totalPages;
            // sync topbar page slider
            const tbSlider = document.getElementById('topbar-page-slider');
            if (tbSlider && document.activeElement !== tbSlider) tbSlider.value = page;
            updateTopbarSliderFill(page);
            const idx = sorted.indexOf(page);
            const pct = idx >= 0 ? Math.round(((idx + 1) / sorted.length) * 100) : 0;
            if (progressFill)      progressFill.style.width      = pct + '%';
            if (sheetProgressFill) sheetProgressFill.style.width = pct + '%';
            if (sheetPageSlider && document.activeElement !== sheetPageSlider) sheetPageSlider.value = page;
            if (sheetPagePreview) sheetPagePreview.textContent = page;
            if (rpsSlider  && document.activeElement !== rpsSlider)  rpsSlider.value  = page;
            if (rpsCurrent) rpsCurrent.textContent = page;
            // Menu panel (Apple Books style)
            const total = sorted[sorted.length - 1];
            const menuPct = document.getElementById('sheet-menu-progress-pct');
            if (menuPct) menuPct.textContent = pct + '%';
            const menuCurrent = document.getElementById('sheet-menu-current');
            if (menuCurrent) menuCurrent.textContent = page + '/' + total;
            const menuSlider = document.getElementById('sheet-menu-page-slider');
            if (menuSlider && document.activeElement !== menuSlider) menuSlider.value = page;
            updateMenuSliderFill();
            bmPageLabel();
        }
        function save(page)   {
            try {
                localStorage.setItem(STORAGE_KEY, String(page));
                const meta = {
                    productId:    PRODUCT_ID,
                    productTitle: PRODUCT_TITLE,
                    readerUrl:    READER_URL,
                    page:         page,
                    timestamp:    Date.now()
                };
                // Write single "last read" key
                localStorage.setItem('bibliotheek_last_read', JSON.stringify(meta));
                // Maintain full history array (latest-first, max 20 books)
                try {
                    let history = JSON.parse(localStorage.getItem('bibliotheek_reading_history') || '[]');
                    history = history.filter(h => h.productId !== PRODUCT_ID); // update existing entry
                    history.unshift(meta);
                    if (history.length > 20) history = history.slice(0, 20);
                    localStorage.setItem('bibliotheek_reading_history', JSON.stringify(history));
                } catch(_) {}
            } catch (_) {}
        }
        function load()       { try { const v = localStorage.getItem(STORAGE_KEY); return v ? parseInt(v, 10) : null; } catch (_) { return null; } }
        function saveFont(sz) { try { localStorage.setItem(FONT_KEY, String(sz)); } catch (_) {} }
        function loadFont()   { try { const v = localStorage.getItem(FONT_KEY); return v ? parseFloat(v) : null; } catch (_) { return null; } }
        // Capture a scroll anchor (current page el + its viewport top) — call BEFORE layout changes
        function captureAnchor() {
            const el = pageMap ? pageMap[visiblePage()] : null;
            return el ? { el, top: el.getBoundingClientRect().top } : null;
        }
        // Restore scroll so that `anchor.el` stays at `anchor.top` — call in rAF AFTER layout changes
        function restoreAnchor(anchor) {
            if (!anchor) return;
            requestAnimationFrame(() => {
                window.scrollBy(0, anchor.el.getBoundingClientRect().top - anchor.top);
            });
        }

        function applyFont(sz, anchor) {
            // anchor can be: true (auto-capture), false/null (no correction), or {el,top} object (frozen anchor)
            const frozenAnchor = (anchor && typeof anchor === 'object') ? anchor
                : (anchor === true ? captureAnchor() : null);
            readerEl.style.setProperty('--reader-font-size', sz + 'px');
            if (frozenAnchor) restoreAnchor(frozenAnchor);
            if (fontValEl) fontValEl.textContent = sz.toFixed(1) + 'px';
            document.getElementById('reader-font-value').textContent = String(Math.round(sz * 10) / 10);
        }
        function saveArabicFont(sz) { try { localStorage.setItem(ARABIC_FONT_KEY, String(sz)); } catch (_) {} }
        function loadArabicFont()   { try { const v = localStorage.getItem(ARABIC_FONT_KEY); return v ? parseFloat(v) : null; } catch (_) { return null; } }
        function applyArabicFont(sz, anchor) {
            const frozenAnchor = (anchor && typeof anchor === 'object') ? anchor
                : (anchor === true ? captureAnchor() : null);
            readerEl.style.setProperty('--reader-arabic-font-size', sz + 'px');
            if (frozenAnchor) restoreAnchor(frozenAnchor);
            if (arabicFontValEl) arabicFontValEl.textContent = sz.toFixed(1) + 'px';
            document.getElementById('reader-arabic-value').textContent = String(Math.round(sz * 10) / 10);
        }

        function preferenceStorageError(error) {
            console.error('Leesinstellingen konden niet worden bewaard of geladen.', error);
            if (window.showToast) window.showToast('Je leesinstellingen konden niet worden bewaard of geladen.', 'error');
        }
        const alignmentButtons = document.querySelectorAll('[data-text-alignment]');
        document.querySelectorAll('.book-reader-scope .page p:not(.text-arabic):not([lang="ar"]):not(.footnote-p):not(.page-number)').forEach(paragraph => {
            const style = getComputedStyle(paragraph);
            if (style.direction !== 'rtl' && ['justify', 'left', 'start'].includes(style.textAlign)) {
                paragraph.classList.add('reader-alignable');
            }
        });
        function applyTextAlignment(value, persist) {
            const alignment = value === 'left' ? 'left' : 'justify';
            const anchor = persist ? captureAnchor() : null;
            document.documentElement.style.setProperty('--reader-text-alignment', alignment);
            alignmentButtons.forEach(button => button.setAttribute('aria-pressed', String(button.dataset.textAlignment === alignment)));
            if (persist) {
                document.dispatchEvent(new Event('reader-layout-change'));
                if (anchor) restoreAnchor(anchor);
                try { localStorage.setItem('reader-text-alignment', alignment); }
                catch (error) { preferenceStorageError(error); }
            }
        }
        let savedAlignment = null;
        try { savedAlignment = localStorage.getItem('reader-text-alignment'); }
        catch (error) { preferenceStorageError(error); }
        applyTextAlignment(savedAlignment, false);
        alignmentButtons.forEach(button => button.addEventListener('click', () => applyTextAlignment(button.dataset.textAlignment, true)));
        [
            { id: 'line-height', key: 'reader-line-height', property: '--reader-line-height', min: 1.2, max: 2.2, fallback: 1.5, unit: '' },
            { id: 'side-padding', key: 'reader-side-padding', property: '--reader-side-padding', min: 8, max: 64, fallback: parseFloat(getComputedStyle(document.querySelector('.reader-wrap')).paddingLeft), unit: 'px' },
        ].forEach(control => {
            const input = document.getElementById('reader-' + control.id);
            const output = document.getElementById('reader-' + control.id + '-value');
            function apply(value, persist) {
                const number = Number(value);
                const normalized = value !== null && value !== '' && Number.isFinite(number)
                    ? Math.round(Math.min(control.max, Math.max(control.min, number)) * 10) / 10 : control.fallback;
                const anchor = persist ? captureAnchor() : null;
                document.documentElement.style.setProperty(control.property, normalized + control.unit);
                if (control.id === 'line-height') {
                    document.documentElement.style.setProperty('--reader-arabic-line-scale', String(Math.max(1, normalized / 1.5)));
                    document.body.classList.toggle('reader-custom-spacing', normalized !== 1.5);
                    if (persist) document.dispatchEvent(new Event('reader-layout-change'));
                }
                input.value = String(normalized);
                output.textContent = String(normalized);
                input.setAttribute('aria-valuetext', output.textContent);
                if (anchor) restoreAnchor(anchor);
                if (persist) {
                    try { localStorage.setItem(control.key, String(normalized)); }
                    catch (error) { preferenceStorageError(error); }
                }
            }
            let saved = null;
            try { saved = localStorage.getItem(control.key); }
            catch (error) { preferenceStorageError(error); }
            apply(saved, false);
            input.addEventListener('input', () => apply(input.value, true));
            document.getElementById('reader-' + control.id + '-dec').addEventListener('click', () => apply(Number(input.value) - Number(input.step), true));
            document.getElementById('reader-' + control.id + '-inc').addEventListener('click', () => apply(Number(input.value) + Number(input.step), true));
            document.getElementById('reader-' + control.id + '-reset').addEventListener('click', () => apply(control.fallback, true));
        });

        function visiblePage() {
            let low = 0, high = sorted.length - 1;
            while (low < high) {
                const mid = Math.floor((low + high) / 2);
                if (pageMap[sorted[mid]].getBoundingClientRect().top < TOPBAR_H) low = mid + 1;
                else high = mid;
            }
            const next = sorted[low];
            if (low === 0) return next || firstPage;
            const previous = sorted[low - 1];
            return Math.abs(pageMap[previous].getBoundingClientRect().top - TOPBAR_H)
                <= Math.abs(pageMap[next].getBoundingClientRect().top - TOPBAR_H) ? previous : next;
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

        function positionReaderDialogs() {
            const viewport = window.visualViewport;
            const viewportTop = viewport?.offsetTop ?? 0;
            const viewportBottom = viewportTop + (viewport?.height ?? window.innerHeight);
            const top = Math.max(viewportTop + 12, topbarEl.getBoundingClientRect().bottom + 10);
            document.documentElement.style.setProperty('--reader-dialog-top', top + 'px');
            document.documentElement.style.setProperty('--reader-dialog-height', Math.max(0, viewportBottom - top - 12) + 'px');
        }
        window.addEventListener('resize', positionReaderDialogs);
        window.visualViewport?.addEventListener('resize', positionReaderDialogs);
        window.visualViewport?.addEventListener('scroll', positionReaderDialogs);

        function trapReaderDialogFocus(event, container) {
            if (event.key !== 'Tab') return;
            const controls = [...container.querySelectorAll('button, input, [tabindex="0"]')]
                .filter(el => !el.disabled && el.getClientRects().length);
            if (event.shiftKey && document.activeElement === controls[0]) { event.preventDefault(); controls.at(-1)?.focus(); }
            else if (!event.shiftKey && document.activeElement === controls.at(-1)) { event.preventDefault(); controls[0]?.focus(); }
        }

        // ── Go-to-page modal ──────────────────────────────────────────────
        (function () {
            const overlay    = document.getElementById('goto-page-overlay');
            const input      = document.getElementById('goto-page-input');
            const confirmBtn = document.getElementById('goto-page-confirm');
            const cancelBtn  = document.getElementById('goto-page-cancel');
            const prevBtn    = document.getElementById('goto-page-prev');
            const nextBtn    = document.getElementById('goto-page-next');
            const badge      = document.getElementById('topbar-mobile-page');
            const desktopBadge = document.getElementById('topbar-page-cur');
            const slider = document.getElementById('goto-page-slider');
            const errorLabel = document.getElementById('goto-page-error');
            const minPage    = {{ $allPageMeta->min('page_number') }};
            const maxPage    = {{ $allPageMeta->max('page_number') }};

            function syncPageControls() {
                const index = sorted.indexOf(Number(input.value));
                prevBtn.disabled = index <= 0;
                nextBtn.disabled = index === sorted.length - 1;
                slider.style.setProperty('--goto-progress', Math.max(0, index) / Math.max(1, sorted.length - 1) * 100 + '%');
            }

            function step(delta) {
                const base = input.value.trim() !== '' ? input.value : input.placeholder;
                let n = parseInt(base, 10);
                if (isNaN(n)) n = minPage;
                const index = sorted.indexOf(n);
                n = sorted[Math.min(sorted.length - 1, Math.max(0, (index < 0 ? 0 : index) + delta))];
                input.value = n.toString();
                input.placeholder = n.toString();
                slider.value = sorted.indexOf(n);
                errorLabel.hidden = true;
                syncPageControls();
            }

            function openModal() {
                const current = visiblePage() || minPage;
                input.value = String(current);
                slider.value = sorted.indexOf(current);
                errorLabel.hidden = true;
                // Set placeholder to current page so user knows where they are
                const curPage = parseInt((topbarMobilePage?.textContent || '').split('/')[0].trim(), 10);
                input.placeholder = (!isNaN(curPage) ? curPage : minPage).toString();
                overlay.hidden = false;
                positionReaderDialogs();
                syncPageControls();
                cancelBtn.focus();
            }

            function closeModal() {
                overlay.hidden = true;
                input.value = '';
                (badge.offsetParent ? badge : desktopBadge)?.focus();
            }

            function confirm() {
                // If field is empty, fall back to the placeholder (= current page)
                const raw = input.value.trim() !== '' ? input.value : input.placeholder;
                const n = Number(raw);
                if (Number.isInteger(n) && sorted.includes(n)) {
                    closeModal();
                    jumpTo(n, false);
                } else {
                    errorLabel.textContent = `Kies een bestaande pagina tussen ${minPage} en ${maxPage}.`;
                    errorLabel.hidden = false;
                    input.select();
                }
            }

            if (badge)      badge.addEventListener('click', openModal);
            desktopBadge?.addEventListener('click', openModal);
            desktopBadge?.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openModal(); } });
            cancelBtn?.addEventListener('click', closeModal);
            slider?.addEventListener('input', () => { input.value = String(sorted[Number(slider.value)]); errorLabel.hidden = true; syncPageControls(); });
            input?.addEventListener('input', () => { const index = sorted.indexOf(Number(input.value)); if (index >= 0) slider.value = index; syncPageControls(); });
            overlay?.addEventListener('keydown', e => {
                if (e.key === 'Escape') { e.preventDefault(); closeModal(); }
                trapReaderDialogFocus(e, overlay);
            });
            if (badge)      badge.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openModal(); } });
            if (confirmBtn) confirmBtn.addEventListener('click', confirm);
            if (prevBtn)    prevBtn.addEventListener('click', () => step(-1));
            if (nextBtn)    nextBtn.addEventListener('click', () => step(1));
            if (overlay)    overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });
            if (input)      input.addEventListener('keydown', e => {
                if (e.key === 'Enter') confirm();
                if (e.key === 'Escape') closeModal();
            });
        })();

        function _scrollTo(page, smooth) {
            const el = pageMap[page];
            if (!el) return;
            // Prefer scrolling to the page-number label so the text lands
            // right below the topbar instead of the raw page-border edge
            const anchor = el.querySelector('.page-number') || el;
            const anchorTop = anchor.getBoundingClientRect().top + window.scrollY;
            // Tighter gap on mobile (≤1024px), small buffer on desktop
            const buffer = window.innerWidth <= 1024 ? 2 : 6;
            window.scrollTo({
                top: Math.max(0, anchorTop - TOPBAR_H - buffer),
                behavior: smooth ? 'smooth' : 'auto'
            });
            updateUI(page);
            save(page);
        }

        // --- Scroll ---
        let saveTimer = null;
        let scrollFrame = null;
        let lastScrollPage = null;
        window.addEventListener('scroll', function () {
            if (scrollFrame !== null) return;
            scrollFrame = requestAnimationFrame(() => {
                scrollFrame = null;
                const cur = visiblePage();
                if (cur !== lastScrollPage) {
                    updateUI(cur);
                    lastScrollPage = cur;
                }
            });
            clearTimeout(saveTimer);
            saveTimer = setTimeout(() => save(visiblePage()), 300);
        }, { passive: true });

        // ── Control Sheet ──
        function showPanel(which) {
            // which: 'menu' | 'controls' | 'library'
            const ids = { menu: 'sheet-panel-menu', controls: 'sheet-panel-controls', library: 'sheet-panel-library' };
            Object.entries(ids).forEach(([key, id]) => {
                const el = document.getElementById(id);
                if (el) el.hidden = (key !== which);
            });
            document.getElementById('reader-sheet-heading').textContent = {
                menu: 'Leesmenu', controls: 'Leesinstellingen', library: 'Bladwijzers en markeringen',
            }[which];
            document.getElementById('reader-sheet-header').hidden = which !== 'library';
            controlSheet.scrollTop = 0;
            if (controlSheet.classList.contains('open')) {
                const panel = document.getElementById(ids[which]);
                panel.querySelector('button')?.focus({ preventScroll: true });
            }
        }
        let sheetTrigger = null;
        function openSheet(which = 'menu') {
            if (!controlSheet) return;
            sheetTrigger = document.activeElement;
            const cur = visiblePage();
            showPanel(which);
            positionReaderDialogs();
            if (sheetPageSlider) sheetPageSlider.value = cur;
            if (sheetPagePreview) sheetPagePreview.textContent = cur;
            controlSheet.classList.add('open');
            controlSheet.inert = false;
            controlSheet.setAttribute('aria-hidden', 'false');
            sheetBackdrop?.classList.add('open');
            sheetBackdrop?.setAttribute('aria-hidden', 'false');
            fab?.setAttribute('aria-expanded', 'true');
            bmPageLabel();
            updateUI(cur);
            document.getElementById(which === 'controls' ? 'sheet-panel-controls' : 'sheet-panel-menu').querySelector('button')?.focus({ preventScroll: true });
        }
        function closeSheet() {
            if (!controlSheet) return;
            controlSheet.classList.remove('open');
            controlSheet.inert = true;
            controlSheet.setAttribute('aria-hidden', 'true');
            sheetBackdrop?.classList.remove('open');
            sheetBackdrop?.setAttribute('aria-hidden', 'true');
            fab?.setAttribute('aria-expanded', 'false');
            (sheetTrigger?.getClientRects().length ? sheetTrigger : fab)?.focus({ preventScroll: true });
        }
        function toggleSheet() { controlSheet?.classList.contains('open') ? closeSheet() : openSheet(); }

        fab?.addEventListener('click', e => { e.stopPropagation(); toggleSheet(); });
        document.getElementById('reader-sheet-close-btn')?.addEventListener('click', closeSheet);
        controlSheet?.addEventListener('keydown', event => trapReaderDialogFocus(event, controlSheet));
        sheetBackdrop?.addEventListener('click', () => { closeSheet(); closeToc?.(); });
        document.addEventListener('keydown', ev => {
            if (ev.key === 'Escape' && controlSheet?.classList.contains('open')) closeSheet();
        });

        // ── Menu panel button wiring (Apple Books-style) ──
        document.getElementById('sheet-menu-settings-btn')?.addEventListener('click', () => showPanel('controls'));
        document.getElementById('sheet-menu-library-btn')?.addEventListener('click',  () => { showPanel('library'); libRender(); });
        document.getElementById('sheet-controls-back-btn')?.addEventListener('click', () => showPanel('menu'));
        document.getElementById('sheet-library-back-btn')?.addEventListener('click',  () => showPanel('menu'));
        document.getElementById('sheet-menu-bm-btn')?.addEventListener('click', () => bmPageToggle());
        document.getElementById('sheet-menu-toc-btn')?.addEventListener('click', () => { closeSheet(); openToc?.(); });
        // sheet-menu-search-btn is wired inside the search IIFE below (needs access to openSearch)
        document.getElementById('sheet-menu-prev-btn')?.addEventListener('click', () => {
            const cur = visiblePage(), idx = sorted.indexOf(cur);
            if (idx > 0) { jumpTo(sorted[idx - 1], true); closeSheet(); }
        });
        document.getElementById('sheet-menu-next-btn')?.addEventListener('click', () => {
            const cur = visiblePage(), idx = sorted.indexOf(cur);
            if (idx < sorted.length - 1) { jumpTo(sorted[idx + 1], true); closeSheet(); }
        });

        // ── Desktop topbar button wiring ──
        function updateTopbarSliderFill(page) {
            const tbSlider = document.getElementById('topbar-page-slider');
            if (!tbSlider) return;
            const min = parseInt(tbSlider.min, 10), max = parseInt(tbSlider.max, 10);
            const pct = max > min ? Math.round(((page - min) / (max - min)) * 100) : 0;
            tbSlider.style.setProperty('--tb-slider-pct', pct + '%');
        }
        const topbarPageSlider = document.getElementById('topbar-page-slider');
        topbarPageSlider?.addEventListener('input', () => {
            const raw = parseInt(topbarPageSlider.value, 10);
            const nearest = sorted.reduce((a, b) => Math.abs(b - raw) < Math.abs(a - raw) ? b : a);
            if (topbarBadge) topbarBadge.textContent = nearest;
            if (topbarMobilePage) topbarMobilePage.textContent = nearest + ' / ' + totalPages;
            updateTopbarSliderFill(nearest);
        });
        topbarPageSlider?.addEventListener('change', () => {
            const raw = parseInt(topbarPageSlider.value, 10);
            const nearest = sorted.reduce((a, b) => Math.abs(b - raw) < Math.abs(a - raw) ? b : a);
            jumpTo(nearest, false);
        });

        document.getElementById('topbar-prev-btn')?.addEventListener('click', () => {
            const cur = visiblePage(), idx = sorted.indexOf(cur);
            if (idx > 0) jumpTo(sorted[idx - 1], true);
        });
        document.getElementById('topbar-next-btn')?.addEventListener('click', () => {
            const cur = visiblePage(), idx = sorted.indexOf(cur);
            if (idx < sorted.length - 1) jumpTo(sorted[idx + 1], true);
        });

        document.getElementById('topbar-mobile-toc-btn')?.addEventListener('click', () => openToc?.());
        // topbar-bm-btn wired below (line ~1774) alongside fab-bm-btn
        // topbar-search-btn wired inside search IIFE below
        document.getElementById('topbar-settings-btn')?.addEventListener('click', () => openSheet('controls'));


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

        // Bottom page scrubber
        rpsSlider?.addEventListener('input', () => {
            const raw = parseInt(rpsSlider.value, 10);
            const nearest = sorted.reduce((a, b) => Math.abs(b - raw) < Math.abs(a - raw) ? b : a);
            if (rpsCurrent) rpsCurrent.textContent = nearest;
            updateRpsFill();
        });
        rpsSlider?.addEventListener('change', () => {
            const raw = parseInt(rpsSlider.value, 10);
            const nearest = sorted.reduce((a, b) => Math.abs(b - raw) < Math.abs(a - raw) ? b : a);
            if (nearest) jumpTo(nearest, false);
        });

        // Keep the CSS filled-track gradient in sync
        function updateRpsFill() {
            if (!rpsSlider) return;
            const min = parseFloat(rpsSlider.min) || 0;
            const max = parseFloat(rpsSlider.max) || 100;
            const val = parseFloat(rpsSlider.value) || min;
            const pct = ((val - min) / (max - min) * 100).toFixed(2) + '%';
            rpsSlider.style.setProperty('--rps-pct', pct);
        }
        function updateMenuSliderFill() {
            const s = document.getElementById('sheet-menu-page-slider');
            if (!s) return;
            const min = parseFloat(s.min) || 0, max = parseFloat(s.max) || 100, val = parseFloat(s.value) || min;
            s.style.setProperty('--menu-slider-pct', ((val - min) / (max - min) * 100).toFixed(2) + '%');
        }
        window.addEventListener('scroll', updateRpsFill, { passive: true });
        updateRpsFill();

        // Menu panel page slider
        const menuPageSlider = document.getElementById('sheet-menu-page-slider');
        menuPageSlider?.addEventListener('input', () => {
            const raw = parseInt(menuPageSlider.value, 10);
            const nearest = sorted.reduce((a, b) => Math.abs(b - raw) < Math.abs(a - raw) ? b : a);
            const menuCurrent = document.getElementById('sheet-menu-current');
            if (menuCurrent) menuCurrent.textContent = nearest + '/' + sorted[sorted.length - 1];
            updateMenuSliderFill();
        });
        menuPageSlider?.addEventListener('change', () => {
            const raw = parseInt(menuPageSlider.value, 10);
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
            // Capture anchor once at the start of a drag gesture
            if (!fontRange._dragAnchor) fontRange._dragAnchor = captureAnchor();
            if (fontRange._raf) return;
            fontRange._raf = requestAnimationFrame(() => {
                fontRange._raf = null;
                setFontStep(parseInt(fontRange.value), fontRange._dragAnchor || false);
            });
        });
        arabicRange?.addEventListener('input', () => {
            if (!arabicRange._dragAnchor) arabicRange._dragAnchor = captureAnchor();
            if (arabicRange._raf) return;
            arabicRange._raf = requestAnimationFrame(() => {
                arabicRange._raf = null;
                setArabicStep(parseInt(arabicRange.value), arabicRange._dragAnchor || false);
            });
        });
        // On slider release — clear the frozen drag anchor
        fontRange?.addEventListener('change', () => {
            setFontStep(parseInt(fontRange.value), fontRange._dragAnchor || true);
            fontRange._dragAnchor = null;
        });
        arabicRange?.addEventListener('change', () => {
            setArabicStep(parseInt(arabicRange.value), arabicRange._dragAnchor || true);
            arabicRange._dragAnchor = null;
        });

        document.getElementById('font-dec-btn')?.addEventListener('click',        () => setFontStep(fontStepIdx - 1));
        document.getElementById('font-inc-btn')?.addEventListener('click',        () => setFontStep(fontStepIdx + 1));
        document.getElementById('arabic-font-dec-btn')?.addEventListener('click', () => setArabicStep(arabicStepIdx - 1));
        document.getElementById('arabic-font-inc-btn')?.addEventListener('click', () => setArabicStep(arabicStepIdx + 1));

        document.getElementById('sheet-font-reset')?.addEventListener('click', () => {
            setFontStep(nearestStepIdx(FONT_STEPS, DEFAULT_FONT));
        });
        document.getElementById('arabic-font-reset')?.addEventListener('click', () => {
            setArabicStep(nearestStepIdx(ARABIC_STEPS, DEFAULT_ARABIC_FONT));
        });

        // --- Pinch-to-zoom for font size (touch gestures) ---
        let pinchStartDist    = null;
        let pinchStartFontIdx = null;  // step index at gesture start (not raw px)
        let pinchAnchor       = null;  // frozen scroll anchor captured at pinch start
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
                pinchAnchor       = captureAnchor(); // freeze scroll anchor once at gesture start
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
                    // Throttle: only apply once per animation frame, with frozen anchor
                    if (!_pinchRaf) {
                        _pinchRaf = true;
                        requestAnimationFrame(() => {
                            _pinchRaf = false;
                            if (_pinchTargetIdx !== null) {
                                setFontStep(_pinchTargetIdx, pinchAnchor || false);
                                _pinchTargetIdx = null;
                            }
                        });
                    }
                }
            }
        }, { passive: false });

        readerEl.addEventListener('touchend', e => {
            if (e.touches.length < 2 && pinchStartDist !== null) {
                // Pinch ended — final apply with frozen anchor, then clear
                if (_pinchTargetIdx !== null) setFontStep(_pinchTargetIdx, pinchAnchor || true);
                else setFontStep(fontStepIdx, pinchAnchor || true);
                pinchStartDist    = null;
                pinchStartFontIdx = null;
                pinchAnchor       = null;
                _pinchTargetIdx   = null;
            }
        });

        readerEl.addEventListener('touchcancel', () => {
            pinchStartDist    = null;
            pinchStartFontIdx = null;
            pinchAnchor       = null;
            _pinchTargetIdx   = null;
        });

        // --- Theme ---
        const THEME_KEY = 'reader-theme';
        const READER_THEMES = ['system', 'light', 'dark', 'ivory', 'white', 'sepia', 'green', 'gray', 'night', 'black'];
        function loadTheme() {
            try {
                const stored = localStorage.getItem(THEME_KEY);
                if (READER_THEMES.includes(stored)) return stored;
                const old = localStorage.getItem('reader-dark-mode');
                if (old === '0') return 'light';
                return 'system'; // default: follow OS preference
            } catch (error) { preferenceStorageError(error); return 'system'; }
        }
        let currentTheme = loadTheme();
        function saveTheme(mode) { try { localStorage.setItem(THEME_KEY, mode); } catch (error) { preferenceStorageError(error); } }
        function applyTheme(mode) {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            currentTheme = mode;
            const resolved = mode === 'system' ? (prefersDark ? 'dark' : 'light') : mode;
            document.body.dataset.readerTheme = resolved;
            document.documentElement.dataset.readerTheme = resolved;
            document.body.classList.toggle('dark-mode', resolved === 'dark' || resolved === 'gray' || resolved === 'night' || resolved === 'black');
            document.querySelectorAll('.reader-sheet-theme-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.theme === mode);
                btn.setAttribute('aria-pressed', String(btn.dataset.theme === mode));
            });
        }
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (currentTheme === 'system') applyTheme('system');
        });
        document.querySelectorAll('.reader-sheet-theme-btn').forEach(btn => {
            btn.addEventListener('click', () => { saveTheme(btn.dataset.theme); applyTheme(btn.dataset.theme); });
        });
        applyTheme(currentTheme);
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
                btn.removeAttribute('aria-current');
                btn.setAttribute('aria-label', `${btn.querySelector('.toc-panel-item-title').textContent}, pagina ${btn.dataset.page}`);
                if (parseInt(btn.dataset.page, 10) <= cur) activeEl = btn;
            });
            if (activeEl) {
                activeEl.classList.add('active');
                activeEl.setAttribute('aria-current', 'location');
                activeEl.setAttribute('aria-label', activeEl.getAttribute('aria-label') + ', huidige hoofdstuk');
            }
        }

        let tocTrigger = null;
        function openToc() {
            if (!tocPanel) return;
            tocTrigger = document.activeElement;
            const searchPanel = document.getElementById('reader-search-panel');
            if (searchPanel && !searchPanel.hidden) {
                document.getElementById('reader-search-close').click();
            }
            positionReaderDialogs();
            tocPanel.classList.add('open');
            tocPanel.inert = false;
            tocPanel.setAttribute('aria-hidden', 'false');
            tocCloseBtn?.focus({ preventScroll: true });
            if (tocBackdrop) { tocBackdrop.classList.add('open'); tocBackdrop.setAttribute('aria-hidden', 'false'); }
            markActiveTocItem();
            // Scroll active item into view
            requestAnimationFrame(() => {
                const active = tocPanelBody?.querySelector('.toc-panel-item.active');
                if (active) tocPanelBody.scrollTop = Math.max(0,
                    active.getBoundingClientRect().top - tocPanelBody.getBoundingClientRect().top +
                    tocPanelBody.scrollTop + active.offsetHeight / 2 - tocPanelBody.clientHeight / 2);
            });
        }

        function closeToc() {
            if (!tocPanel) return;
            tocPanel.classList.remove('open');
            tocPanel.inert = true;
            tocPanel.setAttribute('aria-hidden', 'true');
            if (tocBackdrop) { tocBackdrop.classList.remove('open'); tocBackdrop.setAttribute('aria-hidden', 'true'); }
            if (tocTrigger?.getClientRects().length) tocTrigger.focus({ preventScroll: true });
        }

        buildTocPanel();
        sheetTocBtn?.addEventListener('click', () => tocPanel?.classList.contains('open') ? closeToc() : openToc());
        tocCloseBtn?.addEventListener('click', closeToc);
        tocPanel?.addEventListener('keydown', event => trapReaderDialogFocus(event, tocPanel));
        tocBackdrop?.addEventListener('click', () => { closeToc(); closeSheet(); });
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
            // Allow ?page=N in URL to override saved progress (e.g. from search results)
            const urlParams = new URLSearchParams(window.location.search);
            const urlPage   = (function() {
                const p = parseInt(urlParams.get('page'), 10);
                return (!isNaN(p) && sorted.includes(p)) ? p : null;
            })();
            const urlQuery  = (urlParams.get('q') || '').trim(); // search term to highlight
            const urlHlId   = (urlParams.get('hlid') || '').trim(); // highlight id to scroll to
            const urlBmId   = (urlParams.get('bmid') || '').trim(); // bookmark id to scroll to
            const startPage = urlPage || ((saved && sorted.includes(saved)) ? saved : null);

            // Nothing saved or first page: scroll to top so title is visible
            if (!startPage || startPage === firstPage) {
                window.scrollTo({ top: 0 });
                updateUI(firstPage);
                save(firstPage);
                // Highlight search term on first page if requested
                if (urlQuery) setTimeout(() => window.readerHighlightDirect?.(urlQuery, pageMap[urlPage || firstPage]), 80);
            } else {
                const doJump = () => {
                    if (urlQuery) {
                        // First scroll to the page, then highlight the search term.
                        // jumpTo ensures navigation even if readerHighlightDirect can't
                        // find the exact text match.
                        jumpTo(urlPage, false);
                        updateUI(urlPage);
                        save(urlPage);
                        // Slight delay so the page scroll completes before we search for
                        // the text position and do the fine-grained scroll to the mark.
                        setTimeout(() => window.readerHighlightDirect?.(urlQuery, pageMap[urlPage]), 80);
                    } else {
                        jumpTo(startPage, false);
                        requestAnimationFrame(() => requestAnimationFrame(() => {
                            const actual = visiblePage();
                            updateUI(actual);
                            save(actual);
                            // Scroll to specific highlight or bookmark if requested via URL
                            if (urlHlId || urlBmId) {
                                setTimeout(() => {
                                    let targetEl = null;
                                    if (urlHlId) {
                                        const pageEl = pageMap[startPage];
                                        if (pageEl && !document.querySelector(`[data-hl-id="${urlHlId}"]`)) {
                                            hlRestorePage(pageEl, startPage);
                                        }
                                        targetEl = document.querySelector(`[data-hl-id="${urlHlId}"]`);
                                    } else if (urlBmId) {
                                        targetEl = document.querySelector(`.bm-marker[data-bm-id="${urlBmId}"]`)
                                                || (pageMap[startPage] && bmGetParaByIndex(pageMap[startPage], (bmLoad().find(b=>b.id===urlBmId)||{}).paraIndex ?? -1));
                                    }
                                    if (targetEl) {
                                        if (urlHlId) centerReaderPassage(targetEl);
                                        else {
                                            const markTop = targetEl.getBoundingClientRect().top + window.scrollY - Math.floor(window.innerHeight / 3);
                                            window.scrollTo({ top: Math.max(0, markTop), behavior: 'smooth' });
                                        }
                                    }
                                }, 350);
                            }
                        }));
                    }
                };
                // On mobile, delay slightly so the browser has finished its own scroll restoration
                if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
                    setTimeout(doJump, 120);
                } else {
                    doJump();
                }
            }
        }

        const panelLibrary  = document.getElementById('sheet-panel-library');

        // --- Reader settings tabs ---
        const settingsTabs = ['text', 'colors'];
        function selectSettingsTab(selected, focus = false) {
            settingsTabs.forEach(name => {
                const active = name === selected;
                const tab = document.getElementById('reader-settings-tab-' + name);
                tab.setAttribute('aria-selected', String(active));
                tab.tabIndex = active ? 0 : -1;
                document.getElementById('reader-settings-' + name).hidden = !active;
                if (active && focus) tab.focus({ preventScroll: true });
            });
        }
        settingsTabs.forEach((name, index) => {
            const tab = document.getElementById('reader-settings-tab-' + name);
            tab.addEventListener('click', () => selectSettingsTab(name));
            tab.addEventListener('keydown', event => {
                let next;
                if (event.key === 'ArrowRight' || event.key === 'ArrowLeft') next = settingsTabs[1 - index];
                else if (event.key === 'Home') next = settingsTabs[0];
                else if (event.key === 'End') next = settingsTabs[1];
                else return;
                event.preventDefault();
                selectSettingsTab(next, true);
            });
        });
        document.getElementById('reader-theme-reset').addEventListener('click', () => {
            saveTheme('system');
            applyTheme('system');
        });
        // --- End reader settings tabs ---

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
                                // Find target BEFORE closing (same pattern as working search)
                                const pageEl = pageMap[bm.pageNum];
                                const markerEl = document.querySelector(`.bm-marker[data-bm-id="${bm.id}"]`)
                                              || (pageEl && bm.paraIndex >= 0 ? bmGetParaByIndex(pageEl, bm.paraIndex) : null)
                                              || pageEl;
                                closeSheet();
                                setTimeout(() => {
                                    if (markerEl) {
                                        const markTop = markerEl.getBoundingClientRect().top + window.scrollY - Math.floor(window.innerHeight / 3);
                                        window.scrollTo({ top: Math.max(0, markTop), behavior: 'smooth' });
                                        updateUI(bm.pageNum);
                                        save(bm.pageNum);
                                    }
                                }, 230);
                            } else {
                                // Set reading progress for target book so it opens on the right page
                                try { localStorage.setItem('reading_progress_' + bm.productId, String(bm.pageNum)); } catch (_) {}
                                const url = bm.readerUrl + (bm.readerUrl.indexOf('?') >= 0 ? '&' : '?') + 'page=' + bm.pageNum;
                                window.location.href = url;
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
                            // Ensure mark is in DOM, then capture element BEFORE closing sheet
                            const pageEl = pageMap[hl.pageNum];
                            if (pageEl && !document.querySelector(`[data-hl-id="${hl.id}"]`)) {
                                hlRestorePage(pageEl, hl.pageNum);
                            }
                            const markEl = document.querySelector(`[data-hl-id="${hl.id}"]`) || pageEl;
                            closeSheet();
                            setTimeout(() => {
                                const foundMark = document.querySelector(`[data-hl-id="${hl.id}"]`);
                                const target = foundMark || markEl || pageEl;
                                if (target) {
                                    centerReaderPassage(target);
                                    updateUI(hl.pageNum);
                                    save(hl.pageNum);
                                }
                            }, 230);
                        } else {
                            try { localStorage.setItem('reading_progress_' + hl.productId, String(hl.pageNum)); } catch (_) {}
                            const url = hl.readerUrl + (hl.readerUrl.indexOf('?') >= 0 ? '&' : '?') + 'page=' + hl.pageNum + '&hlid=' + encodeURIComponent(hl.id);
                            window.location.href = url;
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

        const stripShy = value => value.replace(/\u00AD/g, '');

        function hlSerialize(range, pageEl, pageNum) {
            const pre = document.createRange();
            pre.selectNodeContents(pageEl);
            pre.setEnd(range.startContainer, range.startOffset);
            const s = stripShy(pre.toString()).length;
            const text = stripShy(range.toString());
            return { id: Date.now().toString(36) + Math.random().toString(36).slice(2, 6), pageNum, color: null, text: text.trim().slice(0, 80), startOffset: s, endOffset: s + text.length, productId: PRODUCT_ID, productTitle: PRODUCT_TITLE, readerUrl: READER_URL };
        }

        // Offsets count source characters; soft hyphens inserted for justification are skipped.
        function hlDeserialize(pageEl, s, e) {
            let c = 0, sn = null, so = 0, en = null, eo = 0;
            function walk(n) {
                if (sn && en) return;
                if (n.nodeType === Node.TEXT_NODE) {
                    const t = n.textContent;
                    for (let i = 0; i <= t.length && !(sn && en); i++) {
                        if (!sn && c === s && i < t.length && t[i] !== '\u00AD') { sn = n; so = i; }
                        if (!en && c === e && i > 0) { en = n; eo = i; }
                        if (i < t.length && t[i] !== '\u00AD') c++;
                    }
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
                t.textContent = '✓ Bladwijzer verwijderd – pagina ' + bm.pageNum;
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
            const has = bmLoad().some(b => b.productId === PRODUCT_ID && b.pageNum === pageNum && b.paraIndex === -1);
            const label = has ? 'Bladwijzer verwijderen' : 'Voeg bladwijzer toe';
            // Old sheet button (may have been removed, safely no-op if absent)
            const sheetBtn = document.getElementById('sheet-bm-page-btn');
            if (sheetBtn) {
                sheetBtn.classList.toggle('active', has);
                sheetBtn.title = label;
                sheetBtn.setAttribute('aria-label', label);
            }
            // New topbar bookmark button
            const topbarBtn = document.getElementById('topbar-bm-btn');
            if (topbarBtn) {
                topbarBtn.classList.toggle('active', has);
                topbarBtn.title = label;
                topbarBtn.setAttribute('aria-label', label);
                // Swap icon between hollow (regular) and filled (solid)
                const topbarIcon = topbarBtn.querySelector('i');
                if (topbarIcon) {
                    topbarIcon.className = has ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark';
                }
            }
            // FAB bookmark button
            const fabBmBtn = document.getElementById('fab-bm-btn');
            if (fabBmBtn) {
                fabBmBtn.classList.toggle('active', has);
                fabBmBtn.title = label;
                fabBmBtn.setAttribute('aria-label', label);
            }
            // Sheet action bookmark button (inside the popup)
            const sheetBmBtn = document.getElementById('sheet-bm-btn');
            if (sheetBmBtn) {
                sheetBmBtn.classList.toggle('active', has);
                sheetBmBtn.title = label;
                sheetBmBtn.setAttribute('aria-label', label);
                const sheetBmSpan = sheetBmBtn.querySelector('span');
                if (sheetBmSpan) sheetBmSpan.textContent = has ? 'Verwijderen' : 'Bladwijzer';
            }
            // Menu panel bookmark row (Apple Books style)
            const menuBmRow = document.getElementById('sheet-menu-bm-btn');
            if (menuBmRow) {
                menuBmRow.classList.toggle('active', has);
                const menuBmLabel = document.getElementById('sheet-menu-bm-label');
                if (menuBmLabel) menuBmLabel.textContent = has ? 'Bladwijzer verwijderen' : 'Bladwijzer toevoegen';
            }
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
                t.textContent = '✓ Bladwijzer verwijderd – pagina ' + pageNum;
                t.classList.add('show'); clearTimeout(t._t); t._t = setTimeout(() => t.classList.remove('show'), 1600);
            } else {
                // Add
                const newBm = { id: Date.now().toString(36) + Math.random().toString(36).slice(2,6), productId: PRODUCT_ID, productTitle: PRODUCT_TITLE, productSlug: PRODUCT_SLUG, readerUrl: READER_URL, pageNum, paraIndex: -1, text: '', date: new Date().toISOString() };
                existing.push(newBm);
                bmSave(existing);
                if (pageEl) bmInsertPageMarker(newBm, pageEl);
                let t = document.getElementById('hl-toast');
                if (!t) { t = Object.assign(document.createElement('div'), { id: 'hl-toast', className: 'hl-toast' }); document.body.appendChild(t); }
                t.textContent = '✓ Bladwijzer toegevoegd – pagina ' + pageNum;
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
                t.textContent = '✓ Bladwijzer verwijderd – pagina ' + bm.pageNum;
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
        document.getElementById('topbar-bm-btn')?.addEventListener('click', () => {
            bmPageToggle();
        });
        document.getElementById('fab-bm-btn')?.addEventListener('click', () => {
            bmPageToggle();
        });
        document.getElementById('sheet-bm-btn')?.addEventListener('click', () => {
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

        // Suppress native browser context menu (right-click & long-press) so only our popup shows
        readerEl?.addEventListener('contextmenu', e => e.preventDefault());

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
            const text = stripShy(hlMark
                ? hlMark.textContent
                : (hlPending?.range.toString() || '')).trim().slice(0, 80);
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
            const text = stripShy(hlMark ? hlMark.textContent : (hlPending?.range.toString() || ''));
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
            const keyboardDismiss = document.getElementById('reader-search-keyboard-dismiss');
            const clearMarksBtn = document.getElementById('sheet-menu-clear-search');
            if (!panel || !input) return;

            let currentMark = null;
            let searchTimer = null;
            let searchController = null;
            let searchVersion = 0;
            let searchViewportHeight = window.visualViewport?.height ?? window.innerHeight;
            function resetSearch() {
                clearTimeout(searchTimer);
                searchController?.abort();
                searchVersion++;
                metaEl.textContent = '';
                metaEl.removeAttribute('role');
                resultsEl.replaceChildren();
                resultsEl.scrollTop = 0;
                panel.removeAttribute('aria-busy');
            }
            function syncSearchKeyboard() {
                const viewport = window.visualViewport;
                keyboardDismiss.hidden = panel.hidden || document.activeElement !== input ||
                    !viewport || searchViewportHeight - viewport.height < 100;
            }
            window.visualViewport?.addEventListener('resize', syncSearchKeyboard);
            input.addEventListener('focus', syncSearchKeyboard);
            input.addEventListener('blur', () => { keyboardDismiss.hidden = true; });
            keyboardDismiss.addEventListener('click', () => input.blur());
            resultsEl.addEventListener('touchmove', () => input.blur(), { passive: true });

            let searchTrigger = null;
            function openSearch() {
                searchTrigger = document.activeElement;
                closeToc();
                resetSearch();
                input.value = '';
                clearBtn.hidden = true;
                searchViewportHeight = window.visualViewport?.height ?? window.innerHeight;
                positionReaderDialogs();
                panel.hidden = false;
                panel.classList.add('open');
                backdrop.classList.add('open');
                // iOS requires synchronous focus in the user gesture to open the keyboard.
                input.focus({ preventScroll: true });
            }
            function closeSearch() {
                panel.classList.remove('open');
                backdrop.classList.remove('open');
                panel.hidden = true;
                resetSearch();
                input.blur();
                (searchTrigger?.getClientRects().length ? searchTrigger : fab)?.focus({ preventScroll: true });
                // Note: highlights are intentionally NOT cleared here —
                // they only clear when a new search result is clicked.
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
                clearMarksBtn.hidden = true;
            }
            clearMarksBtn.addEventListener('click', () => { clearAllHighlights(); closeSheet(); });

            openBtn?.addEventListener('click', openSearch);
            document.getElementById('fab-search-btn')?.addEventListener('click', openSearch);
            document.getElementById('topbar-search-btn')?.addEventListener('click', openSearch);
            document.getElementById('sheet-search-btn')?.addEventListener('click', () => {
                closeSheet();
                openSearch();
            });
            document.getElementById('sheet-menu-search-btn')?.addEventListener('click', () => {
                closeSheet();
                openSearch();
            });
            closeBtn.addEventListener('click', closeSearch);
            backdrop.addEventListener('click', closeSearch);
            document.addEventListener('keydown', e => { if (e.key === 'Escape' && !panel.hidden) closeSearch(); });
            panel.addEventListener('keydown', event => trapReaderDialogFocus(event, panel));

            // Direct highlight (no panel) — used when arriving from library search (?q=)
            window.readerHighlightDirect = function (query, pageEl) {
                if (!query || !pageEl) return;
                clearAllHighlights();

                function findAndScroll() {
                    const walker = document.createTreeWalker(pageEl, NodeFilter.SHOW_TEXT, {
                        acceptNode(node) {
                            const p = node.parentElement;
                            if (!p) return NodeFilter.FILTER_REJECT;
                            if (['script','style','button','mark'].includes(p.tagName.toLowerCase())) return NodeFilter.FILTER_REJECT;
                            if (p.classList.contains('page-number')) return NodeFilter.FILTER_REJECT;
                            return NodeFilter.FILTER_ACCEPT;
                        }
                    });

                    let node;
                    while ((node = walker.nextNode())) {
                        const match = readerTextMatch(node.textContent, query);
                        if (!match) continue;

                        const before = document.createTextNode(node.textContent.slice(0, match.start));
                        const mark   = document.createElement('mark');
                        mark.className = 'reader-search-highlight';
                        mark.textContent = node.textContent.slice(match.start, match.end);
                        const after  = document.createTextNode(node.textContent.slice(match.end));
                        node.parentNode.insertBefore(before, node);
                        node.parentNode.insertBefore(mark, node);
                        node.parentNode.insertBefore(after, node);
                        node.parentNode.removeChild(node);
                        currentMark = mark;
                        clearMarksBtn.hidden = false;

                        // Single smooth scroll directly to the highlighted word
                        requestAnimationFrame(() => {
                            centerReaderPassage(mark);
                        });
                        return;
                    }
                    // Fallback: text not found — scroll to page top via jumpTo if possible,
                    // otherwise use scrollIntoView
                    const pageNum = parseInt(Object.keys(pageMap).find(k => pageMap[k] === pageEl) || '0', 10);
                    if (pageNum && pageMap[pageNum]) {
                        _scrollTo(pageNum, true);
                    } else {
                        pageEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }

                // Wait for fonts so position measurements are accurate, then find + scroll in one shot
                (document.fonts ? document.fonts.ready : Promise.resolve()).then(() => {
                    requestAnimationFrame(findAndScroll);
                });
            };

            input.addEventListener('input', () => {
                clearBtn.hidden = !input.value;
                debounceSearch();
            });
            input.addEventListener('keydown', event => {
                if (event.key === 'Enter') { event.preventDefault(); input.blur(); }
            });
            clearBtn.addEventListener('click', () => {
                input.value = ''; clearBtn.hidden = true;
                resetSearch();
                input.focus({ preventScroll: true });
            });

            function debounceSearch() {
                resetSearch();
                const query = input.value.trim();
                if (query.length < 2 || query.length > 200) return;
                panel.setAttribute('aria-busy', 'true');
                metaEl.setAttribute('role', 'status');
                metaEl.textContent = 'Zoeken…';
                searchTimer = setTimeout(runSearch, 120);
            }

            async function runSearch() {
                const query = input.value.trim();
                if (query.length < 2 || query.length > 200) return;
                const version = searchVersion;
                const controller = new AbortController();
                searchController = controller;
                try {
                    const res = await fetch(SEARCH_URL + '?q=' + encodeURIComponent(query), { signal: controller.signal });
                    if (!res.ok) throw new Error('Zoeken is niet gelukt.');
                    const data = await res.json();
                    if (!Array.isArray(data.results) || !Number.isInteger(data.total) || data.total < 0 ||
                        !data.results.every(result => Number.isInteger(result.page) && typeof result.snippet === 'string')) {
                        throw new Error('Ongeldig zoekantwoord.');
                    }
                    if (version === searchVersion && !controller.signal.aborted) renderResults(data.results, data.total, query);
                } catch (e) {
                    if (version === searchVersion && !controller.signal.aborted) {
                        metaEl.setAttribute('role', 'alert');
                        metaEl.textContent = 'Zoeken is niet gelukt. Probeer opnieuw.';
                    }
                } finally {
                    if (version === searchVersion) panel.removeAttribute('aria-busy');
                }
            }

            function renderResults(results, total, query) {
                resultsEl.innerHTML = '';
                metaEl.textContent = total + (total === 1 ? ' resultaat' : ' resultaten');

                results.forEach((r, index) => {
                    // Build snippet — escape HTML first, then restore [[HIT]] marks
                    const snippetHtml = r.snippet
                        .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
                        .replace(/\[\[HIT\]\]([\s\S]*?)\[\[\/HIT\]\]/g, '<mark>$1</mark>');

                    const item = document.createElement('button');
                    item.className = 'reader-search-result-item';
                    item.type = 'button';

                    const pageBadge = document.createElement('span');
                    pageBadge.className = 'reader-search-result-page';
                    pageBadge.textContent = 'p.' + r.page + ' · ';

                    const snippet = document.createElement('span');
                    snippet.className = 'reader-search-result-snippet';
                    snippet.innerHTML = snippetHtml;

                    item.appendChild(pageBadge);
                    item.appendChild(snippet);

                    item.addEventListener('click', () => {
                        const pageEl = pageMap[r.page];
                        if (!pageEl) {
                            metaEl.setAttribute('role', 'alert');
                            metaEl.textContent = 'Deze pagina kon niet worden geopend. Probeer opnieuw.';
                            return;
                        }
                        clearAllHighlights();
                        let remaining = results.slice(0, index).filter(result => result.page === r.page).length;


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
                            let offset = 0;
                            let match = readerTextMatch(node.textContent, query);
                            while (match && remaining > 0) {
                                remaining--;
                                offset = match.end;
                                const next = readerTextMatch(node.textContent.slice(offset), query);
                                match = next ? { start: offset + next.start, end: offset + next.end } : null;
                            }
                            if (!match) continue;

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
                            const before = document.createTextNode(node.textContent.slice(0, match.start));
                            const mark   = document.createElement('mark');
                            mark.className = 'reader-search-highlight';
                            mark.textContent = node.textContent.slice(match.start, match.end);
                            const after  = document.createTextNode(node.textContent.slice(match.end));
                            node.parentNode.insertBefore(before, node);
                            node.parentNode.insertBefore(mark, node);
                            node.parentNode.insertBefore(after, node);
                            node.parentNode.removeChild(node);
                            currentMark = mark;
                            clearMarksBtn.hidden = false;
                            found = true;
                            break;
                        }

                        // Close panel, then open footnote popover (if needed) and scroll to highlight
                        closeSearch();
                        setTimeout(() => {
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
                                        const match = readerTextMatch(pNode.textContent, query);
                                        if (!match) continue;
                                        const pBefore = document.createTextNode(pNode.textContent.slice(0, match.start));
                                        const pMark   = document.createElement('mark');
                                        pMark.className = 'reader-search-highlight';
                                        pMark.textContent = pNode.textContent.slice(match.start, match.end);
                                        const pAfter  = document.createTextNode(pNode.textContent.slice(match.end));
                                        pNode.parentNode.insertBefore(pBefore, pNode);
                                        pNode.parentNode.insertBefore(pMark, pNode);
                                        pNode.parentNode.insertBefore(pAfter, pNode);
                                        pNode.parentNode.removeChild(pNode);
                                        currentMark = pMark;
                                        clearMarksBtn.hidden = false;
                                        break;
                                    }
                                }, 120); // wait for popover animation to start
                            } else if (found && currentMark) {
                                // Single smooth scroll directly to the highlighted word
                                centerReaderPassage(currentMark);
                            } else if (pageEl) {
                                pageEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            }
                        }, 230);
                    });
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

        // Let iOS handle viewport offsets during momentum scrolling and keyboard changes.
        // Dialogs follow visualViewport without moving the document itself.
        // Note: we deliberately do NOT restore scrollY on focusin here anymore.
        // The search panel is a bottom sheet — iOS keeps the reader page behind
        // it exactly where it was; no scroll restoration is needed.
    })();
    </script>
</div>

{{-- Cookie Consent Banner (GDPR/AVG) --}}
<x-cookie-consent />


</body>
</html>
