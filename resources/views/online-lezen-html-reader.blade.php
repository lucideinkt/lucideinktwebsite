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
            <button class="reader-btn" id="font-smaller" title="Kleinere tekst" aria-label="Kleinere tekst">A−</button>
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

    {{-- Bottom bar — huidig paginanummer + spring naar pagina ── --}}
    <nav class="reader-bottombar" aria-label="Paginanavigatie">
        <span class="reader-page-label">Pagina</span>
        <span class="reader-page-current" id="page-current">—</span>
        <div class="reader-page-jump">
            <button class="reader-page-btn" id="page-jump-btn" aria-haspopup="listbox" aria-expanded="false">
                <i class="fa-solid fa-list-ol" aria-hidden="true"></i> Spring naar
            </button>
            <div class="reader-page-dropdown" id="page-dropdown" role="listbox" aria-label="Kies pagina">
                @foreach($pages as $page)
                    <button
                        class="reader-page-dropdown-item"
                        data-page="{{ $page->page_number }}"
                        role="option"
                    >Pagina {{ $page->page_number }}</button>
                @endforeach
            </div>
        </div>
    </nav>

    {{-- Boekinhoud --}}
    <main class="reader-wrap">
        <article class="book-reader-scope" id="reader-content" lang="nl" data-product-id="{{ $product->id }}">

            @php $bookTitle = $pages->first()?->book_title; @endphp
            @if($bookTitle)
            <div class="text-center page-title-series">
                <p>Uit de Reeks van de Risale-i Nur</p>
                <h1 class="book-title">{{ $bookTitle }}</h1>
                <p>Bedîüzzaman Said Nursî</p>
            </div>
            @endif

            @foreach($pages as $page)
                {!! $page->content !!}
            @endforeach
        </article>

        <div class="reader-end">
            <p>✦ &nbsp; Einde &nbsp; ✦</p>
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

        const readerEl    = document.getElementById('reader-content');
        const progressFill = document.getElementById('progress-fill');
        const pageCurrent  = document.getElementById('page-current');
        const dropdown     = document.getElementById('page-dropdown');
        const jumpBtn      = document.getElementById('page-jump-btn');
        const toTopBtn     = document.getElementById('to-top-btn');

        if (!readerEl) return;

        // ── Build page map ──
        const pageEls = Array.from(readerEl.querySelectorAll('.page'));
        if (!pageEls.length) return;

        const pageMap = {};
        pageEls.forEach(el => {
            const numEl = el.querySelector('.page-number');
            let n = numEl ? parseInt((numEl.textContent || '').replace(/[^0-9]/g, ''), 10) : NaN;
            if (!n) n = parseInt(el.getAttribute('id') || '', 10);
            if (n && !isNaN(n)) pageMap[n] = el;
        });

        const sorted    = Object.keys(pageMap).map(Number).sort((a, b) => a - b);
        const firstPage = sorted[0];

        // ── Helpers ──
        function updateUI(page) {
            if (pageCurrent) pageCurrent.textContent = page;
            if (progressFill) {
                const pct = Math.round(((sorted.indexOf(page) + 1) / sorted.length) * 100);
                progressFill.style.width = pct + '%';
            }
        }

        function save(page) {
            try { localStorage.setItem(STORAGE_KEY, String(page)); } catch (_) {}
        }

        function load() {
            try { const v = localStorage.getItem(STORAGE_KEY); return v ? parseInt(v, 10) : null; } catch (_) { return null; }
        }

        function saveFont(size) {
            try { localStorage.setItem(FONT_KEY, String(size)); } catch (_) {}
        }

        function loadFont() {
            try { const v = localStorage.getItem(FONT_KEY); return v ? parseFloat(v) : null; } catch (_) { return null; }
        }

        function applyFont(size) {
            readerEl.querySelectorAll('.page').forEach(p => { p.style.fontSize = size + 'px'; });
        }

        function visiblePage() {
            let closest = null, best = Infinity;
            sorted.forEach(n => {
                const d = Math.abs(pageMap[n].getBoundingClientRect().top - TOPBAR_H);
                if (d < best) { best = d; closest = n; }
            });
            return closest || firstPage;
        }

        function jumpTo(page, smooth) {
            const el = pageMap[page];
            if (!el) return;
            window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - TOPBAR_H, behavior: smooth ? 'smooth' : 'auto' });
            updateUI(page);
            save(page);
        }

        // ── Scroll listener ──
        let saveTimer = null;
        window.addEventListener('scroll', function () {
            // to-top button
            if (toTopBtn) toTopBtn.classList.toggle('show', window.scrollY > 300);
            // page label — update on every tick
            const cur = visiblePage();
            updateUI(cur);
            // debounce save — read visiblePage again at fire time so it's never stale
            clearTimeout(saveTimer);
            saveTimer = setTimeout(() => save(visiblePage()), 300);
        }, { passive: true });

        // ── Dropdown ──
        if (dropdown && jumpBtn) {
            dropdown.querySelectorAll('.reader-page-dropdown-item').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation(); // prevent document click-outside from firing simultaneously
                    jumpTo(parseInt(btn.dataset.page, 10), true);
                    dropdown.classList.remove('open');
                    jumpBtn.setAttribute('aria-expanded', 'false');
                });
            });

            jumpBtn.addEventListener('click', (e) => {
                e.stopPropagation(); // prevent document click-outside from closing immediately
                dropdown.classList.toggle('open');
                jumpBtn.setAttribute('aria-expanded', String(dropdown.classList.contains('open')));
            });

            document.addEventListener('click', ev => {
                if (!dropdown.contains(ev.target) && !jumpBtn.contains(ev.target) && dropdown.classList.contains('open')) {
                    dropdown.classList.remove('open');
                    jumpBtn.setAttribute('aria-expanded', 'false');
                }
            });

            document.addEventListener('keydown', ev => {
                if ((ev.key === 'Escape') && dropdown.classList.contains('open')) {
                    dropdown.classList.remove('open');
                    jumpBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // ── Font size ──
        document.getElementById('font-smaller')?.addEventListener('click', () => {
            const pages = readerEl.querySelectorAll('.page');
            const current = parseFloat(getComputedStyle(pages[0]).fontSize) || 18;
            const next = Math.max(12, current - 1);
            applyFont(next);
            saveFont(next);
        });
        document.getElementById('font-larger')?.addEventListener('click', () => {
            const pages = readerEl.querySelectorAll('.page');
            const current = parseFloat(getComputedStyle(pages[0]).fontSize) || 18;
            const next = Math.min(36, current + 1);
            applyFont(next);
            saveFont(next);
        });

        // ── Dark mode ──
        document.getElementById('dark-mode-toggle')?.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
        });

        // ── To-top ──
        toTopBtn?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        // ── Restore progress — wait for full layout before scrolling ──
        function restoreProgress() {
            // restore font size first (affects layout/scroll positions)
            const savedFont = loadFont();
            if (savedFont) applyFont(savedFont);

            const saved = load();
            const startPage = (saved && pageMap[saved]) ? saved : firstPage;
            jumpTo(startPage, false);
            // sync label to what actually ended up visible
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    const actual = visiblePage();
                    updateUI(actual);
                    save(actual);
                });
            });
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

