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
</head>
<body>

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
            <button class="reader-btn" id="font-smaller" title="Kleinere tekst" aria-label="Kleinere tekst">A&minus;</button>
            <button class="reader-btn" id="font-larger"  title="Grotere tekst"  aria-label="Grotere tekst">A+</button>
            <button class="reader-btn reader-btn-icon" id="dark-mode-toggle" title="Donkere modus" aria-label="Donkere modus aan/uit">
                <i class="fa-solid fa-moon" id="dark-mode-icon" aria-hidden="true"></i>
            </button>
        </div>
    </header>

    {{-- Leesvoortgang --}}
    <div class="reader-progress" role="progressbar" aria-label="Leesvoortgang" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        <div class="reader-progress-fill" id="progress-fill"></div>
    </div>

    {{-- Bottom bar --}}
    <nav class="reader-bottombar" aria-label="Paginanavigatie">
        <button class="reader-nav-arrow" id="page-prev-btn" aria-label="Vorige pagina" title="Vorige pagina">
            <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
        </button>

        <div class="reader-page-jump">
            <button class="reader-page-btn" id="page-jump-btn" aria-haspopup="listbox" aria-expanded="false" title="Ga naar pagina">
                <i class="fa-solid fa-book-open" aria-hidden="true"></i>
                <span class="reader-page-btn-label">
                    <span id="page-current">&mdash;</span>
                    <span class="reader-page-sep">/</span>
                    <span class="reader-page-total">{{ $allPageMeta->max('page_number') }}</span>
                </span>
                <i class="fa-solid fa-chevron-up reader-page-chevron" aria-hidden="true"></i>
            </button>
            <div class="reader-page-dropdown" id="page-dropdown" role="listbox" aria-label="Kies pagina">
                @foreach($allPageMeta as $meta)
                    <button
                        class="reader-page-dropdown-item"
                        data-page="{{ $meta->page_number }}"
                        role="option"
                    >Pagina {{ $meta->page_number }}</button>
                @endforeach
            </div>
        </div>

        <button class="reader-nav-arrow" id="page-next-btn" aria-label="Volgende pagina" title="Volgende pagina">
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </button>
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
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Terug naar Bibliotheek
            </a>
        </div>
    </main>

    <button class="reader-to-top" id="to-top-btn" aria-label="Terug naar boven">
        <i class="fa-solid fa-chevron-up" aria-hidden="true"></i>
    </button>

    <script>
    (function () {
        const TOPBAR_H    = 72;
        const STORAGE_KEY = 'reading_progress_{{ $product->id }}';
        const FONT_KEY    = 'reading_fontsize_{{ $product->id }}';

        const readerEl     = document.getElementById('reader-content');
        const progressFill = document.getElementById('progress-fill');
        const pageCurrent  = document.getElementById('page-current');
        const dropdown     = document.getElementById('page-dropdown');
        const jumpBtn      = document.getElementById('page-jump-btn');
        const prevBtn      = document.getElementById('page-prev-btn');
        const nextBtn      = document.getElementById('page-next-btn');
        const toTopBtn     = document.getElementById('to-top-btn');
        const sentinel     = document.getElementById('lazy-sentinel');

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

        let lastLoadedPage = parseInt(readerEl.dataset.lastPage || '0', 10);
        let isLoading      = false;
        let allLoaded      = sorted.every(n => pageMap[n]);

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
        function applyFont(sz) { readerEl.querySelectorAll('.page').forEach(p => { p.style.fontSize = sz + 'px'; }); }

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
                .finally(() => { isLoading = false; });
        }

        // IntersectionObserver: auto-load next batch when scrolling near bottom
        if (sentinel && 'IntersectionObserver' in window) {
            const obs = new IntersectionObserver(
                entries => { if (entries[0].isIntersecting) loadMorePages(); },
                { rootMargin: '400px' }
            );
            obs.observe(sentinel);
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

        // --- Dropdown ---
        function openDropdown() {
            dropdown.classList.add('open');
            jumpBtn.setAttribute('aria-expanded', 'true');
            // Mark current page as active and scroll it into view
            const cur = visiblePage();
            dropdown.querySelectorAll('.reader-page-dropdown-item').forEach(btn => {
                const isActive = parseInt(btn.dataset.page, 10) === cur;
                btn.classList.toggle('active', isActive);
                btn.setAttribute('aria-selected', String(isActive));
                if (isActive) {
                    // Small delay so dropdown is visible first
                    requestAnimationFrame(() => btn.scrollIntoView({ block: 'center' }));
                }
            });
        }
        function closeDropdown() {
            dropdown.classList.remove('open');
            jumpBtn.setAttribute('aria-expanded', 'false');
        }

        if (dropdown && jumpBtn) {
            dropdown.querySelectorAll('.reader-page-dropdown-item').forEach(btn => {
                btn.addEventListener('click', e => {
                    e.stopPropagation();
                    jumpTo(parseInt(btn.dataset.page, 10), true);
                    closeDropdown();
                });
            });
            jumpBtn.addEventListener('click', e => {
                e.stopPropagation();
                dropdown.classList.contains('open') ? closeDropdown() : openDropdown();
            });
            document.addEventListener('click', ev => {
                if (!dropdown.contains(ev.target) && !jumpBtn.contains(ev.target) && dropdown.classList.contains('open')) {
                    closeDropdown();
                }
            });
            document.addEventListener('keydown', ev => {
                if (ev.key === 'Escape' && dropdown.classList.contains('open')) closeDropdown();
            });
        }

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
            const cur  = parseFloat(getComputedStyle(readerEl.querySelector('.page')).fontSize) || 18;
            const next = Math.max(12, cur - 1);
            applyFont(next); saveFont(next);
        });
        document.getElementById('font-larger')?.addEventListener('click', () => {
            const cur  = parseFloat(getComputedStyle(readerEl.querySelector('.page')).fontSize) || 18;
            const next = Math.min(36, cur + 1);
            applyFont(next); saveFont(next);
        });

        // --- Dark mode ---
        document.getElementById('dark-mode-toggle')?.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
        });

        // --- To-top ---
        toTopBtn?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        // --- Restore reading progress on load ---
        function restoreProgress() {
            const savedFont = loadFont();
            if (savedFont) applyFont(savedFont);

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
</body>
</html>

