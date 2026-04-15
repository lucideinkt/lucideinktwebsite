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
            @if(!empty($tocEntries))
            <button class="reader-btn reader-btn-icon" id="toc-toggle-btn" title="Inhoudsopgave" aria-label="Inhoudsopgave tonen/verbergen" aria-expanded="false">
                <i class="fa-solid fa-list" aria-hidden="true"></i>
            </button>
            @endif
            <button class="reader-btn reader-btn-icon" id="settings-toggle-btn" title="Instellingen" aria-label="Instellingen openen" aria-expanded="false" aria-haspopup="dialog">
                <i class="fa-solid fa-gear" aria-hidden="true"></i>
            </button>
        </div>
    </header>

    {{-- Settings popup (fixed below topbar) --}}
    <div class="reader-settings-popup" id="settings-popup" hidden role="dialog" aria-label="Lezerinstellingen">
        <div class="reader-settings-header">
            <span class="reader-settings-title"><i class="fa-solid fa-gear" style="margin-right:5px;font-size:9px;opacity:0.65;" aria-hidden="true"></i>Instellingen</span>
            <button class="reader-settings-close" id="settings-close-btn" type="button" aria-label="Instellingen sluiten">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
        </div>

        {{-- Font size --}}
        <div class="reader-settings-section">
            <div class="reader-settings-label">Lettergrootte</div>
            <div class="reader-settings-font-row">
                <button class="reader-btn" id="font-smaller" title="Kleinere tekst" aria-label="Kleinere tekst">A&minus;</button>
                <span class="reader-font-indicator" id="font-size-display" aria-live="polite" aria-label="Huidige lettergrootte">19.0px</span>
                <button class="reader-btn" id="font-larger" title="Grotere tekst" aria-label="Grotere tekst">A+</button>
                <button class="reader-btn reader-btn-reset-font" id="font-reset" title="Standaard lettergrootte" aria-label="Lettergrootte resetten">Reset</button>
            </div>
        </div>

        {{-- Theme --}}
        <div class="reader-settings-section">
            <div class="reader-settings-label">Weergave</div>
            <div class="reader-settings-theme-row">
                <button class="reader-theme-btn" id="theme-system" type="button" data-theme="system" aria-label="Systeemthema">
                    <i class="fa-solid fa-circle-half-stroke" aria-hidden="true"></i> Systeem
                </button>
                <button class="reader-theme-btn" id="theme-light" type="button" data-theme="light" aria-label="Licht thema">
                    <i class="fa-solid fa-sun" aria-hidden="true"></i> Licht
                </button>
                <button class="reader-theme-btn" id="theme-dark" type="button" data-theme="dark" aria-label="Donker thema">
                    <i class="fa-solid fa-moon" aria-hidden="true"></i> Donker
                </button>
            </div>
        </div>
    </div>

    {{-- Page nav bar (flush directly below topbar; progress bar is inside) --}}
    <nav class="reader-bottombar" aria-label="Paginanavigatie">
        {{-- Leesvoortgang — inside the nav bar so there is no gap --}}
        <div class="reader-progress" role="progressbar" aria-label="Leesvoortgang" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="reader-progress-fill" id="progress-fill"></div>
        </div>
        {{-- Prev & Next — both to the left of the page count --}}
        <button class="reader-nav-arrow" id="page-prev-btn" aria-label="Vorige pagina" title="Vorige pagina">
            <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
        </button>
        <button class="reader-nav-arrow" id="page-next-btn" aria-label="Volgende pagina" title="Volgende pagina">
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </button>

        {{-- Page count button — click to open popup --}}
        <div class="reader-page-jump">
            <button class="reader-page-btn" id="page-jump-btn" aria-haspopup="dialog" aria-expanded="false" title="Ga naar pagina">
                <i class="fa-solid fa-book-open" aria-hidden="true"></i>
                <span class="reader-page-btn-label">
                    <span id="page-current">&mdash;</span>
                    <span class="reader-page-sep">/</span>
                    <span class="reader-page-total">{{ $allPageMeta->max('page_number') }}</span>
                </span>
                <i class="fa-solid fa-chevron-down reader-page-chevron" aria-hidden="true"></i>
            </button>

            {{-- Page-jump popup (slider + number input) --}}
            <div class="reader-page-popup" id="page-popup" hidden role="dialog" aria-label="Ga naar pagina">
                <div class="reader-page-popup-header">
                    <span class="reader-page-popup-title">Ga naar pagina</span>
                    <button class="reader-page-popup-close" id="page-popup-close" type="button" aria-label="Sluiten" title="Sluiten">
                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                </div>

                {{-- Slider (above the input) --}}
                <div class="reader-page-slider-section">
                    <input type="range"
                           class="reader-page-slider"
                           id="page-slider"
                           min="{{ $allPageMeta->min('page_number') }}"
                           max="{{ $allPageMeta->max('page_number') }}"
                           value="{{ $allPageMeta->min('page_number') }}"
                           aria-label="Schuif naar pagina">
                    <div class="reader-page-slider-labels">
                        <span>{{ $allPageMeta->min('page_number') }}</span>
                        <span class="reader-slider-current" id="slider-preview">{{ $allPageMeta->min('page_number') }}</span>
                        <span>{{ $allPageMeta->max('page_number') }}</span>
                    </div>
                </div>

                {{-- Number input + Ga button --}}
                <div class="reader-page-input-section">
                    <input type="number"
                           class="reader-page-input"
                           id="page-number-input"
                           min="{{ $allPageMeta->min('page_number') }}"
                           max="{{ $allPageMeta->max('page_number') }}"
                           placeholder="Paginanummer"
                           aria-label="Paginanummer invoeren">
                    <button class="reader-page-go-btn" id="page-go-btn" type="button">Ga</button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Boekinhoud --}}
    <main class="reader-wrap">
        <article class="book-reader-scope" id="reader-content" lang="nl"
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

    <button class="reader-to-top" id="to-top-btn" aria-label="Terug naar boven">
        <i class="fa-solid fa-chevron-up" aria-hidden="true"></i>
    </button>

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

    {{-- Loading overlay shown while pages load --}}
    <div id="reader-loader" aria-hidden="true">
        <div class="spinner" role="status" aria-label="Pagina wordt geladen"></div>
    </div>

    <script>
    (function () {
        const TOPBAR_H    = 74;  // topbar(44) + nav-bar(30)
        const STORAGE_KEY = 'reading_progress_{{ $product->id }}';
        const FONT_KEY    = 'reading_fontsize_{{ $product->id }}';
        const DEFAULT_FONT = window.innerWidth <= 600 ? 18 : 19;

        const readerEl     = document.getElementById('reader-content');
        const progressFill = document.getElementById('progress-fill');
        const pageCurrent  = document.getElementById('page-current');
        const popup        = document.getElementById('page-popup');
        const popupClose   = document.getElementById('page-popup-close');
        const jumpBtn      = document.getElementById('page-jump-btn');
        const pageSlider   = document.getElementById('page-slider');
        const sliderPreview= document.getElementById('slider-preview');
        const pageInput    = document.getElementById('page-number-input');
        const pageGoBtn    = document.getElementById('page-go-btn');
        const prevBtn      = document.getElementById('page-prev-btn');
        const nextBtn      = document.getElementById('page-next-btn');
        const toTopBtn     = document.getElementById('to-top-btn');
        const sentinel     = document.getElementById('lazy-sentinel');
        const loaderEl     = document.getElementById('reader-loader');

        function showLoader() { if (loaderEl) { loaderEl.classList.add('visible'); loaderEl.setAttribute('aria-hidden','false'); } }
        function hideLoader() { if (loaderEl) { loaderEl.classList.remove('visible'); loaderEl.setAttribute('aria-hidden','true'); } }

        if (!readerEl) return;

        const API_URL_VAL = readerEl.dataset.apiUrl;

        // All page numbers known upfront (lightweight - no content loaded)
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
            if (pageCurrent) pageCurrent.textContent = page;
            if (progressFill) {
                const idx = sorted.indexOf(page);
                const pct = idx >= 0 ? Math.round(((idx + 1) / sorted.length) * 100) : 0;
                progressFill.style.width = pct + '%';
            }
        }
        function save(page)    { try { localStorage.setItem(STORAGE_KEY, String(page)); }  catch (_) {} }
        function load()        { try { const v = localStorage.getItem(STORAGE_KEY); return v ? parseInt(v, 10) : null; } catch (_) { return null; } }
        function saveFont(sz)  { try { localStorage.setItem(FONT_KEY, String(sz)); }       catch (_) {} }
        function loadFont()    { try { const v = localStorage.getItem(FONT_KEY); return v ? parseFloat(v) : null; }     catch (_) { return null; } }
        function applyFont(sz) {
            readerEl.querySelectorAll('.page').forEach(p => { p.style.fontSize = sz + 'px'; });
            const display = document.getElementById('font-size-display');
            if (display) display.textContent = sz.toFixed(1) + 'px';
        }

        // Dark mode helpers removed — theme now handled by applyTheme() below

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

        // --- Scroll listener ---
        let saveTimer = null;
        window.addEventListener('scroll', function () {
            if (toTopBtn) toTopBtn.classList.toggle('show', window.scrollY > 300);
            const cur = visiblePage();
            updateUI(cur);
            clearTimeout(saveTimer);
            saveTimer = setTimeout(() => save(visiblePage()), 300);
        }, { passive: true });

        // --- Popup (page navigator) ---
        const MIN_PAGE = parseInt(pageSlider?.min || '1', 10);
        const MAX_PAGE = parseInt(pageSlider?.max || '1', 10);

        function openPopup() {
            if (!popup) return;
            const cur = visiblePage();
            if (pageSlider) { pageSlider.value = cur; }
            if (sliderPreview) { sliderPreview.textContent = cur; }
            if (pageInput) { pageInput.value = ''; pageInput.placeholder = 'Paginanummer'; }
            popup.removeAttribute('hidden');
            jumpBtn?.setAttribute('aria-expanded', 'true');
        }
        function closePopup() {
            if (!popup) return;
            popup.setAttribute('hidden', '');
            jumpBtn?.setAttribute('aria-expanded', 'false');
        }

        // Slider: update preview while dragging, navigate on release
        pageSlider?.addEventListener('input', () => {
            if (sliderPreview) sliderPreview.textContent = pageSlider.value;
        });
        pageSlider?.addEventListener('change', () => {
            const p = parseInt(pageSlider.value, 10);
            if (p) { jumpTo(p, true); closePopup(); }
        });

        // "Ga" button + Enter key
        pageGoBtn?.addEventListener('click', () => {
            const val = parseInt(pageInput?.value, 10);
            if (val && val >= MIN_PAGE && val <= MAX_PAGE) {
                jumpTo(val, true); closePopup();
            }
        });
        pageInput?.addEventListener('keydown', e => {
            if (e.key === 'Enter') pageGoBtn?.click();
        });

        // Toggle popup on page-count button click
        if (jumpBtn) {
            jumpBtn.addEventListener('click', e => {
                e.stopPropagation();
                popup?.hasAttribute('hidden') ? openPopup() : closePopup();
            });
        }

        // Close popup on outside click
        document.addEventListener('click', ev => {
            if (popup && !popup.hasAttribute('hidden') &&
                !popup.contains(ev.target) && !jumpBtn?.contains(ev.target)) {
                closePopup();
            }
        });

        // Close popup on Escape
        popupClose?.addEventListener('click', closePopup);
        document.addEventListener('keydown', ev => {
            if (ev.key === 'Escape' && popup && !popup.hasAttribute('hidden')) closePopup();
        });

        // --- Prev / Next page buttons ---
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                const cur = visiblePage();
                const idx = sorted.indexOf(cur);
                if (idx > 0) jumpTo(sorted[idx - 1], true);
            });
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                const cur = visiblePage();
                const idx = sorted.indexOf(cur);
                if (idx < sorted.length - 1) jumpTo(sorted[idx + 1], true);
            });
        }

        // --- Font size ---
        document.getElementById('font-smaller')?.addEventListener('click', () => {
            const cur  = parseFloat(getComputedStyle(readerEl.querySelector('.page')).fontSize) || DEFAULT_FONT;
            const next = Math.max(12, Math.round((cur - 0.1) * 10) / 10);
            applyFont(next); saveFont(next);
        });
        document.getElementById('font-larger')?.addEventListener('click', () => {
            const cur  = parseFloat(getComputedStyle(readerEl.querySelector('.page')).fontSize) || DEFAULT_FONT;
            const next = Math.min(36, Math.round((cur + 0.1) * 10) / 10);
            applyFont(next); saveFont(next);
        });
        document.getElementById('font-reset')?.addEventListener('click', () => {
            applyFont(DEFAULT_FONT);
            saveFont(DEFAULT_FONT);
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
                pinchStartFontSize = currentPage ? parseFloat(getComputedStyle(currentPage).fontSize) || 18 : 18;
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
                    const finalSize = parseFloat(getComputedStyle(currentPage).fontSize) || 18;
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

        // --- Settings popup ---
        const settingsToggleBtn = document.getElementById('settings-toggle-btn');
        const settingsPopup     = document.getElementById('settings-popup');
        const settingsCloseBtn  = document.getElementById('settings-close-btn');

        function openSettings() {
            settingsPopup?.removeAttribute('hidden');
            settingsToggleBtn?.setAttribute('aria-expanded', 'true');
        }
        function closeSettings() {
            settingsPopup?.setAttribute('hidden', '');
            settingsToggleBtn?.setAttribute('aria-expanded', 'false');
        }
        settingsToggleBtn?.addEventListener('click', e => {
            e.stopPropagation();
            settingsPopup?.hasAttribute('hidden') ? openSettings() : closeSettings();
        });
        settingsCloseBtn?.addEventListener('click', closeSettings);
        document.addEventListener('click', ev => {
            if (settingsPopup && !settingsPopup.hasAttribute('hidden') &&
                !settingsPopup.contains(ev.target) && !settingsToggleBtn?.contains(ev.target)) {
                closeSettings();
            }
        });
        document.addEventListener('keydown', ev => {
            if (ev.key === 'Escape' && settingsPopup && !settingsPopup.hasAttribute('hidden')) closeSettings();
        });

        // --- Theme (System / Light / Dark) — default: Dark ---
        const THEME_KEY = 'reader-theme';

        function loadTheme() {
            try {
                const stored = localStorage.getItem(THEME_KEY);
                if (stored) return stored;
                // Migrate: if user explicitly had light mode before, respect that
                const old = localStorage.getItem('reader-dark-mode');
                if (old === '0') return 'light';
                return 'dark'; // default
            } catch (_) { return 'dark'; }
        }
        function saveTheme(mode) { try { localStorage.setItem(THEME_KEY, mode); } catch (_) {} }

        function applyTheme(mode) {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = mode === 'dark' || (mode === 'system' && prefersDark);
            document.body.classList.toggle('dark-mode', isDark);
            // Update active button state
            document.querySelectorAll('.reader-theme-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.theme === mode);
            });
        }

        // Listen for OS theme changes when in system mode
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (loadTheme() === 'system') applyTheme('system');
        });

        // Theme buttons
        document.querySelectorAll('.reader-theme-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const mode = btn.dataset.theme;
                saveTheme(mode);
                applyTheme(mode);
            });
        });

        // Apply saved (or default) theme immediately
        applyTheme(loadTheme());

        // --- To-top ---
        toTopBtn?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        // --- TOC Panel ---
        const TOC_DATA = @json($tocEntries ?? []);

        const tocPanel      = document.getElementById('toc-panel');
        const tocPanelBody  = document.getElementById('toc-panel-body');
        const tocToggleBtn  = document.getElementById('toc-toggle-btn');
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
            tocPanel.classList.add('open');
            tocPanel.setAttribute('aria-hidden', 'false');
            tocToggleBtn?.setAttribute('aria-expanded', 'true');
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
            tocToggleBtn?.setAttribute('aria-expanded', 'false');
            if (tocBackdrop) { tocBackdrop.classList.remove('open'); tocBackdrop.setAttribute('aria-hidden', 'true'); }
        }

        buildTocPanel();
        tocToggleBtn?.addEventListener('click', () => {
            tocPanel?.classList.contains('open') ? closeToc() : openToc();
        });
        tocCloseBtn?.addEventListener('click', closeToc);
        tocBackdrop?.addEventListener('click', closeToc);
        document.addEventListener('keydown', ev => {
            if (ev.key === 'Escape' && tocPanel?.classList.contains('open')) closeToc();
        });

        // Handle data-toc-page clicks in the book content (seeder page inhoudsopgave)
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
            if (savedFont) {
                applyFont(savedFont);
            } else {
                // Show default font size in the indicator
                const display = document.getElementById('font-size-display');
                if (display) display.textContent = DEFAULT_FONT.toFixed(1) + 'px';
            }

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

        if (document.readyState === 'complete') {
            restoreProgress();
        } else {
            window.addEventListener('load', restoreProgress);
        }
    })();
    </script>
</div>
</body>
</html>

