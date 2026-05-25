<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    {{-- Non-production environments: always block indexing --}}
    @if(!app()->isProduction())
        <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex, nofollow">
    @endif

    @if(isset($SEOData))
        {!! seo($SEOData) !!}
    @else
        <title>Bibliotheek | Lucide Inkt</title>
        <meta name="description" content="Blader door onze digitale bibliotheek en lees boeken online.">
    @endif

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://use.typekit.net/ixm0jkz.css">
    <link rel="stylesheet" href="https://use.typekit.net/pwj1cgt.css">
    <link rel="stylesheet" href="https://use.typekit.net/pwj1cgt.css">

    @vite(['resources/css/bookshelf.css'])
</head>
<body>

<div class="bookshelf-page">

    {{-- Back to website link --}}
    <a href="{{ route('home') }}" class="bookshelf-back-link">
        <i class="fa-solid fa-chevron-left"></i> Terug naar de website
    </a>

    {{-- Two-column layout: sidebar + cabinet --}}
    <div class="bookshelf-layout">

    {{-- ═══════════════════════════════════════
         SIDEBAR
         ═══════════════════════════════════════ --}}
    <aside class="bookshelf-sidebar">

        {{-- Search --}}
        <div class="bs-panel">
            <h2 class="bs-section-title">Zoeken in boeken</h2>
            <div class="bs-panel-body">
                <div class="bs-search-wrap">
                    <input type="text" id="bs-search-input" class="bs-search-input" placeholder="Zoek tekst in boeken..." autocomplete="off">
                    <button class="bs-search-btn" id="bs-search-clear" aria-label="Zoeken">
                        <i class="fa-solid fa-magnifying-glass" id="bs-search-icon"></i>
                    </button>
                </div>
                <div class="bs-search-results" id="bs-search-results" hidden></div>
            </div>
        </div>

        {{-- Laatst gelezen --}}
        <div class="bs-panel">
            <h2 class="bs-section-title">Laatst gelezen</h2>
            <div class="bs-panel-body bs-panel-body--list" id="bs-last-read-list">
                <div class="bs-list-empty"><i class="fa-regular fa-clock"></i> Nog geen boeken gelezen.</div>
            </div>
        </div>

        {{-- Bladwijzers --}}
        <div class="bs-panel">
            <h2 class="bs-section-title">Bladwijzers</h2>
            <div class="bs-panel-body bs-panel-body--list" id="bs-bookmarks-list">
                <div class="bs-list-empty"><i class="fa-solid fa-bookmark"></i> Geen bladwijzers opgeslagen.</div>
            </div>
        </div>

        {{-- Markeringen --}}
        <div class="bs-panel">
            <h2 class="bs-section-title">Markeringen</h2>
            <div class="bs-panel-body bs-panel-body--list" id="bs-highlights-list">
                <div class="bs-list-empty"><i class="fa-solid fa-highlighter"></i> Geen markeringen opgeslagen.</div>
            </div>
        </div>

    </aside>

    {{-- ═══════════════════════════════════════
         CABINET (existing bookshelf)
         ═══════════════════════════════════════ --}}
    <div class="bookshelf-cabinet-wrap">

    {{-- Dark wood textured frame that wraps the cabinet --}}
    <div class="bookshelf-cabinet-frame">

    {{-- The wooden cabinet --}}
    <div class="bookshelf-cabinet">

        {{-- Ceiling spotlights --}}
        <div class="bookshelf-lights">
            <div class="bookshelf-light"></div>
            <div class="bookshelf-light"></div>
            <div class="bookshelf-light"></div>
        </div>

        {{-- Left candle --}}
        <div class="bookshelf-candle bookshelf-candle--left">
            <div class="candle-flame-wrap">
                <div class="candle-flame candle-flame--glow"></div>
                <div class="candle-flame candle-flame--outer"></div>
                <div class="candle-flame candle-flame--inner"></div>
                <div class="candle-flame candle-flame--core"></div>
            </div>
            <div class="candle-wick"></div>
            <div class="candle-body"></div>
            <div class="candle-base"></div>
        </div>

        {{-- Right candle --}}
        <div class="bookshelf-candle bookshelf-candle--right">
            <div class="candle-flame-wrap">
                <div class="candle-flame candle-flame--glow"></div>
                <div class="candle-flame candle-flame--outer"></div>
                <div class="candle-flame candle-flame--inner"></div>
                <div class="candle-flame candle-flame--core"></div>
            </div>
            <div class="candle-wick"></div>
            <div class="candle-body"></div>
            <div class="candle-base"></div>
        </div>

        {{-- Header sign --}}
        <div class="bookshelf-header-sign">
            <h1 class="bookshelf-title">Biblio<span class="herina-t"></span>heek</h1>
            <div class="bookshelf-title-ornament">
                <span>❧ Klik op een boek om te lezen ❧</span>
            </div>
            <p class="bookshelf-subtitle">Lucide Inkt</p>
        </div>

        {{-- Flat book pool — JS will build shelf rows --}}
        <div class="bookshelf-books-pool" style="display:none;">
            @forelse ($products as $product)
                @php
                    $href = $product->book_pages_count > 0
                        ? route('onlineLezenReadHtml', $product->slug)
                        : route('onlineLezenRead', ['slug' => $product->slug, 'fullscreen' => '1']);
                @endphp
                <a href="{{ $href }}" class="shelf-book" title="{{ $product->title }}"
                   data-category="{{ $product->category_id ?? '' }}"
                   data-title="{{ strtolower($product->title) }}"
                   data-product-id="{{ $product->id }}"
                   data-reader-url="{{ $href }}">
                    <div class="shelf-book-cover">
                        <div class="shelf-book-spine"></div>
                        {{-- Top divider ornament --}}
                        <svg class="shelf-book-ornament" viewBox="0 0 120 20" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0" y1="10" x2="44" y2="10" stroke="currentColor" stroke-width="0.8" opacity="0.6"/>
                            <line x1="76" y1="10" x2="120" y2="10" stroke="currentColor" stroke-width="0.8" opacity="0.6"/>
                            <path d="M44,10 Q50,3 60,10 Q70,17 76,10" fill="none" stroke="currentColor" stroke-width="1"/>
                            <circle cx="60" cy="10" r="2.5" fill="currentColor"/>
                            <circle cx="44" cy="10" r="1.5" fill="currentColor" opacity="0.8"/>
                            <circle cx="76" cy="10" r="1.5" fill="currentColor" opacity="0.8"/>
                            <path d="M38,10 Q41,6 44,10" fill="none" stroke="currentColor" stroke-width="0.8" opacity="0.6"/>
                            <path d="M76,10 Q79,14 82,10" fill="none" stroke="currentColor" stroke-width="0.8" opacity="0.6"/>
                        </svg>
                        <span class="shelf-book-title">{{ $product->title }}</span>
                        {{-- Bottom divider ornament --}}
                        <svg class="shelf-book-ornament-bottom" viewBox="0 0 120 20" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0" y1="10" x2="44" y2="10" stroke="currentColor" stroke-width="0.8" opacity="0.6"/>
                            <line x1="76" y1="10" x2="120" y2="10" stroke="currentColor" stroke-width="0.8" opacity="0.6"/>
                            <path d="M44,10 Q50,3 60,10 Q70,17 76,10" fill="none" stroke="currentColor" stroke-width="1"/>
                            <circle cx="60" cy="10" r="2.5" fill="currentColor"/>
                            <circle cx="44" cy="10" r="1.5" fill="currentColor" opacity="0.8"/>
                            <circle cx="76" cy="10" r="1.5" fill="currentColor" opacity="0.8"/>
                            <path d="M38,10 Q41,14 44,10" fill="none" stroke="currentColor" stroke-width="0.8" opacity="0.6"/>
                            <path d="M76,10 Q79,6 82,10" fill="none" stroke="currentColor" stroke-width="0.8" opacity="0.6"/>
                        </svg>
                        {{-- LEZEN button --}}
                        <div class="shelf-book-read-btn">
                            <i class="fa-solid fa-book-open"></i> Lezen
                        </div>
                    </div>
                    <span class="shelf-book-tooltip">{{ $product->title }}</span>
                </a>
            @empty
                <div class="bookshelf-empty">
                    <i class="fa-solid fa-book-open"></i>
                    <p>Binnenkort insha'ALLAH!</p>
                </div>
            @endforelse
        </div>

        {{-- Shelf rows injected here by JS --}}
        <div class="bookshelf-shelves" id="bookshelf-shelves"></div>

        {{-- Bottom floor bar — same z-index trick as header-sign, so poles tuck behind it --}}
        <div class="bookshelf-footer-bar"></div>

    </div>{{-- /.bookshelf-cabinet --}}
    </div>{{-- /.bookshelf-cabinet-frame --}}

    </div>{{-- /.bookshelf-cabinet-wrap --}}
    </div>{{-- /.bookshelf-layout --}}


    {{-- Floating bookmark button (hidden — bookmarks shown inline in sidebar) --}}
    <button class="bm-fab" id="bm-fab" aria-label="Bladwijzers & Markeringen" title="Bladwijzers & Markeringen" style="display:none">
        <i class="fa-solid fa-bookmark" aria-hidden="true"></i>
        <span class="bm-fab-badge" id="bm-fab-badge" aria-hidden="true" hidden></span>
    </button>

    {{-- Bookmark + Marker panel --}}
    <div class="bm-panel" id="bm-panel" hidden role="dialog" aria-label="Bladwijzers & Markeringen" aria-modal="true">
        <div class="bm-panel-header">
            <span class="bm-panel-title"><i class="fa-solid fa-bookmark" aria-hidden="true"></i> Mijn Bibliotheek</span>
            <button class="bm-panel-close" id="bm-panel-close" aria-label="Sluiten">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        {{-- Tabs --}}
        <div class="bm-tabs">
            <button class="bm-tab active" id="bm-tab-bookmarks" data-tab="bookmarks">
                <i class="fa-solid fa-bookmark" aria-hidden="true"></i> Bladwijzers
            </button>
            <button class="bm-tab" id="bm-tab-highlights" data-tab="highlights">
                <i class="fa-solid fa-highlighter" aria-hidden="true"></i> Markeringen
            </button>
        </div>
        <div class="bm-panel-list" id="bm-panel-list"></div>
    </div>
    <div class="bm-panel-backdrop" id="bm-panel-backdrop"></div>

</div>{{-- /.bookshelf-page --}}

<style>
/* ── Floating bookmark button ── */
.bm-fab {
    position: fixed;
    bottom: 28px;
    right: 28px;
    z-index: 200;
    width: 52px; height: 52px;
    border-radius: 50%;
    border: none;
    background: linear-gradient(145deg, #c8902a 0%, #7a5010 100%);
    color: #fdf0c0;
    font-size: 20px;
    cursor: pointer;
    box-shadow: 0 4px 18px rgba(0,0,0,0.7), 0 0 0 2px rgba(200,144,42,0.35);
    display: flex; align-items: center; justify-content: center;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.bm-fab:hover { transform: scale(1.08); box-shadow: 0 6px 24px rgba(0,0,0,0.8); }
.bm-fab-badge {
    position: absolute;
    top: 4px; right: 4px;
    min-width: 18px; height: 18px;
    background: #e03030;
    color: #fff;
    font-size: 10px; font-weight: 700;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    padding: 0 4px;
    border: 2px solid #1a0e05;
    pointer-events: none;
}

/* ── Panel backdrop ── */
.bm-panel-backdrop {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: 300;
    backdrop-filter: blur(2px);
}
.bm-panel-backdrop.open { display: block; }

/* ── Panel itself ── */
.bm-panel {
    position: fixed;
    bottom: 0; right: 0;
    width: min(400px, 100vw);
    max-height: 70vh;
    background: linear-gradient(180deg, #2e1a0a 0%, #1a0e05 100%);
    border-radius: 14px 14px 0 0;
    box-shadow: none;
    z-index: 400;
    display: flex; flex-direction: column;
    overflow: hidden;
    transform: translateY(100%);
    transition: transform 0.28s cubic-bezier(0.32,0.72,0,1), box-shadow 0.28s ease;
}
.bm-panel.open {
    transform: translateY(0);
    box-shadow: 0 -6px 40px rgba(0,0,0,0.9), 0 0 0 1px rgba(120,67,24,0.5);
}

.bm-panel-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 20px 12px;
    border-bottom: 1px solid rgba(120,67,24,0.4);
    flex-shrink: 0;
}
.bm-panel-title {
    font-family: 'DelimaMTProRegular', serif;
    color: #f0c040;
    font-size: 15px;
    letter-spacing: 1px;
    display: flex; align-items: center; gap: 8px;
}
.bm-panel-close {
    background: none; border: none;
    color: rgba(200,160,80,0.6);
    font-size: 18px; cursor: pointer;
    padding: 4px 6px; border-radius: 6px;
    transition: color 0.15s;
}
.bm-panel-close:hover { color: #f0c040; }

/* ── Tabs ── */
.bm-tabs {
    display: flex;
    border-bottom: 1px solid rgba(120,67,24,0.4);
    flex-shrink: 0;
    background: rgba(0,0,0,0.2);
}
.bm-tab {
    flex: 1;
    background: none; border: none;
    padding: 10px 6px;
    color: rgba(200,160,80,0.5);
    font-family: 'DelimaMTProRegular', serif;
    font-size: 12px;
    letter-spacing: 0.5px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center; gap: 6px;
    border-bottom: 2px solid transparent;
    transition: color 0.15s, border-color 0.15s;
}
.bm-tab.active { color: #f0c040; border-bottom-color: #c8902a; }
.bm-tab:hover:not(.active) { color: rgba(200,160,80,0.8); }

.bm-panel-list {
    overflow-y: auto;
    flex: 1;
    padding: 10px 12px 20px;
}

/* ── Bookmark items ── */
.bm-item {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 12px 10px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.15s;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.bm-item:last-child { border-bottom: none; }
.bm-item:hover { background: rgba(200,144,42,0.12); }

.bm-item-icon {
    color: #c8902a;
    font-size: 15px;
    margin-top: 2px;
    flex-shrink: 0;
}
.bm-item-body { flex: 1; min-width: 0; }
.bm-item-book {
    font-family: 'DelimaMTProRegular', serif;
    font-size: 13px;
    color: #f5dda0;
    margin-bottom: 2px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.bm-item-page {
    font-size: 11px;
    color: rgba(200,160,80,0.6);
    margin-bottom: 2px;
}
.bm-item-text {
    font-size: 11px;
    color: rgba(200,180,130,0.5);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.bm-item-del {
    background: none; border: none;
    color: rgba(200,80,80,0.5);
    font-size: 13px; cursor: pointer;
    padding: 4px; border-radius: 4px;
    transition: color 0.15s;
    flex-shrink: 0;
}
.bm-item-del:hover { color: #e05050; }

/* ── Highlight colour dots ── */
.bm-item-icon.hl-yellow  { color: #e8c020; }
.bm-item-icon.hl-green   { color: #3aaa5a; }
.bm-item-icon.hl-blue    { color: #4090d0; }
.bm-item-icon.hl-pink    { color: #d060a0; }
.bm-item-icon.hl-orange  { color: #e07020; }

.bm-empty {
    text-align: center;
    padding: 40px 20px;
    color: rgba(200,160,80,0.4);
    font-family: 'DelimaMTProRegular', serif;
    font-size: 14px;
    letter-spacing: 0.5px;
}
.bm-empty i { display: block; font-size: 2rem; margin-bottom: 12px; opacity: 0.25; }

@media (max-width: 480px) {
    .bm-fab { bottom: 20px; right: 20px; width: 46px; height: 46px; font-size: 18px; }
}
</style>

<script>
// iOS Safari double-tap fix
document.addEventListener('touchstart', function () {}, { passive: true });
</script>

<script>
(function () {
    const SEARCH_URL = '{{ route("onlineLezenSearchAll") }}';

    function escHtml(s) { return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }
    function lsParse(k, def) { try { return JSON.parse(localStorage.getItem(k) || 'null') ?? def; } catch(_) { return def; } }

    // ── Laatst gelezen list ───────────────────────────────
    (function renderLastRead() {
        const el = document.getElementById('bs-last-read-list');
        if (!el) return;
        const history = lsParse('bibliotheek_reading_history', []);
        if (!history.length) return;
        el.innerHTML = '';
        history.forEach(function (item) {
            const a = document.createElement('a');
            a.className = 'bs-list-item';
            a.href = item.readerUrl;
            a.innerHTML =
                '<i class="fa-regular fa-clock"></i>' +
                '<div class="bs-list-item-body">' +
                    '<span class="bs-list-item-title">' + escHtml(item.productTitle) + '</span>' +
                    '<span class="bs-list-item-meta">Pagina ' + item.page + '</span>' +
                '</div>';
            el.appendChild(a);
        });
    })();

    // ── Bladwijzers list ─────────────────────────────────
    (function renderBookmarks() {
        const el = document.getElementById('bs-bookmarks-list');
        if (!el) return;
        const bms = lsParse('reader_bookmarks_global', [])
            .slice().sort((a,b) => (a.productTitle||'').localeCompare(b.productTitle||'') || a.pageNum - b.pageNum);
        if (!bms.length) return;
        el.innerHTML = '';
        bms.forEach(function (bm) {
            const item = document.createElement('div');
            item.className = 'bs-list-item';
            item.style.cursor = 'pointer';
            item.innerHTML =
                '<i class="fa-solid fa-bookmark" style="color:var(--gold-mid)"></i>' +
                '<div class="bs-list-item-body">' +
                    '<span class="bs-list-item-title">' + escHtml(bm.productTitle || 'Onbekend') + '</span>' +
                    '<span class="bs-list-item-meta">Pagina ' + bm.pageNum + (bm.text ? ' · ' + escHtml(bm.text.slice(0,35)) + '…' : '') + '</span>' +
                '</div>' +
                '<button class="bs-list-del" title="Verwijder"><i class="fa-solid fa-xmark"></i></button>';
            item.querySelector('.bs-list-del').addEventListener('click', function(e) {
                e.stopPropagation();
                try { localStorage.setItem('reader_bookmarks_global', JSON.stringify(lsParse('reader_bookmarks_global',[]).filter(x=>x.id!==bm.id))); } catch(_){}
                item.remove();
            });
            item.addEventListener('click', function(e) {
                if (e.target.closest('.bs-list-del')) return;
                try { localStorage.setItem('reading_progress_'+bm.productId, String(bm.pageNum)); } catch(_){}
                window.location.href = bm.readerUrl;
            });
            el.appendChild(item);
        });
    })();

    // ── Markeringen list ─────────────────────────────────
    (function renderHighlights() {
        const el = document.getElementById('bs-highlights-list');
        if (!el) return;
        const all = [];
        try {
            for (let i = 0; i < localStorage.length; i++) {
                const k = localStorage.key(i);
                if (!k || !k.startsWith('hl_')) continue;
                lsParse(k,[]).forEach(h => all.push({ _key: k, ...h }));
            }
        } catch(_){}
        all.sort((a,b)=>(a.productTitle||'').localeCompare(b.productTitle||'')||a.pageNum-b.pageNum);
        if (!all.length) return;
        el.innerHTML = '';
        const colorMap = {yellow:'#e8c020',green:'#3aaa5a',blue:'#4090d0',pink:'#d060a0',orange:'#e07020'};
        all.forEach(function(hl) {
            const item = document.createElement('div');
            item.className = 'bs-list-item';
            item.style.cursor = 'pointer';
            item.innerHTML =
                '<i class="fa-solid fa-highlighter" style="color:'+(colorMap[hl.color]||'#c8902a')+'"></i>' +
                '<div class="bs-list-item-body">' +
                    '<span class="bs-list-item-title">' + escHtml(hl.productTitle||'Onbekend') + '</span>' +
                    '<span class="bs-list-item-meta">Pagina ' + hl.pageNum + (hl.text?' · '+escHtml(hl.text.slice(0,35))+'…':'') + '</span>' +
                '</div>' +
                '<button class="bs-list-del" title="Verwijder"><i class="fa-solid fa-xmark"></i></button>';
            item.querySelector('.bs-list-del').addEventListener('click', function(e) {
                e.stopPropagation();
                try { localStorage.setItem(hl._key, JSON.stringify(lsParse(hl._key,[]).filter(x=>x.id!==hl.id))); } catch(_){}
                item.remove();
            });
            item.addEventListener('click', function(e) {
                if (e.target.closest('.bs-list-del')) return;
                if (hl.readerUrl) { try{localStorage.setItem('reading_progress_'+hl.productId,String(hl.pageNum));}catch(_){} window.location.href=hl.readerUrl; }
            });
            el.appendChild(item);
        });
    })();

    // ── Full-text search ─────────────────────────────────
    const searchInput  = document.getElementById('bs-search-input');
    const searchIcon   = document.getElementById('bs-search-icon');
    const resultsPanel = document.getElementById('bs-search-results');
    let searchTimer = null, activeXHR = null;

    function setSearchIcon(s) {
        if (searchIcon) searchIcon.className = {idle:'fa-solid fa-magnifying-glass',loading:'fa-solid fa-spinner fa-spin',clear:'fa-solid fa-xmark'}[s]||'fa-solid fa-magnifying-glass';
    }
    function showResults(data, query) {
        if (!resultsPanel) return;
        resultsPanel.removeAttribute('hidden');
        resultsPanel.innerHTML = '';
        try { sessionStorage.setItem('bibliotheek_search', JSON.stringify({query,data})); } catch(_){}
        if (!data.results||!data.results.length) { resultsPanel.innerHTML='<div class="bs-sr-empty"><i class="fa-solid fa-book-open"></i> Geen resultaten voor <em>"'+escHtml(query)+'"</em></div>'; return; }
        const m=document.createElement('div'); m.className='bs-sr-meta'; m.textContent=data.total+' resultaat'+(data.total!==1?'en':'')+' voor "'+query+'"'; resultsPanel.appendChild(m);
        const byBook={};
        data.results.forEach(r=>{ if(!byBook[r.productId]) byBook[r.productId]={title:r.productTitle,hits:[]}; byBook[r.productId].hits.push(r); });
        Object.values(byBook).forEach(function(book) {
            const b=document.createElement('div'); b.className='bs-sr-book';
            b.innerHTML='<div class="bs-sr-book-title"><i class="fa-solid fa-book"></i> '+escHtml(book.title)+'</div>';
            book.hits.forEach(function(hit) {
                const a=document.createElement('a'); a.className='bs-sr-item'; a.href=hit.readerUrl+'?page='+hit.page+'&q='+encodeURIComponent(query);
                a.innerHTML='<span class="bs-sr-page">Pagina '+hit.page+'</span><span class="bs-sr-snippet">'+escHtml(hit.snippet).replace(/\[\[HIT\]\]/g,'<mark class="bs-sr-hit">').replace(/\[\[\/HIT\]\]/g,'</mark>')+'</span>';
                b.appendChild(a);
            });
            resultsPanel.appendChild(b);
        });
    }
    function hideResults() { if(resultsPanel) resultsPanel.setAttribute('hidden',''); try{sessionStorage.removeItem('bibliotheek_search');}catch(_){} }
    function doSearch(q) {
        if(activeXHR){activeXHR.abort();activeXHR=null;}
        if(!q||q.length<2){hideResults();setSearchIcon('idle');return;}
        setSearchIcon('loading');
        activeXHR=new XMLHttpRequest(); activeXHR.open('GET',SEARCH_URL+'?q='+encodeURIComponent(q));
        activeXHR.onload=function(){if(activeXHR.status===200){try{showResults(JSON.parse(activeXHR.responseText),q);}catch(_){}}setSearchIcon('clear');activeXHR=null;};
        activeXHR.onerror=function(){setSearchIcon('idle');activeXHR=null;};
        activeXHR.send();
    }
    if (searchInput) {
        searchInput.addEventListener('input',function(){const q=searchInput.value.trim();setSearchIcon(q.length>=2?'loading':'idle');clearTimeout(searchTimer);searchTimer=setTimeout(()=>doSearch(q),400);});
        searchInput.addEventListener('keydown',function(e){if(e.key==='Escape'){searchInput.value='';hideResults();setSearchIcon('idle');if(activeXHR){activeXHR.abort();activeXHR=null;}}});
    }
    document.getElementById('bs-search-clear')?.addEventListener('click',function(){if(searchInput?.value.trim()){searchInput.value='';hideResults();setSearchIcon('idle');searchInput.focus();}});
    // Restore after back-navigation
    (function(){try{const s=sessionStorage.getItem('bibliotheek_search');if(!s)return;const{query,data}=JSON.parse(s);if(!query||!data)return;if(searchInput)searchInput.value=query;setSearchIcon('clear');showResults(data,query);}catch(_){}})();

})();
</script>



<script>
(function () {
    const BM_KEY   = 'reader_bookmarks_global';
    const fab      = document.getElementById('bm-fab');
    const badge    = document.getElementById('bm-fab-badge');
    const panel    = document.getElementById('bm-panel');
    }

    function showResults(data, query) {
        if (!resultsPanel) return;
        resultsPanel.removeAttribute('hidden');
        resultsPanel.innerHTML = '';

        // Persist for back-navigation
        try { sessionStorage.setItem('bibliotheek_search', JSON.stringify({ query, data })); } catch(_) {}

        if (!data.results || !data.results.length) {
            resultsPanel.innerHTML = '<div class="bs-sr-empty"><i class="fa-solid fa-book-open"></i> Geen resultaten gevonden voor <em>"' + escHtml(query) + '"</em></div>';
            return;
        }

        const meta = document.createElement('div');
        meta.className = 'bs-sr-meta';
        meta.textContent = data.total + ' resultaat' + (data.total !== 1 ? 'en' : '') + ' voor "' + query + '"';
        resultsPanel.appendChild(meta);

        // Group by book
        const byBook = {};
        data.results.forEach(function (r) {
            if (!byBook[r.productId]) byBook[r.productId] = { title: r.productTitle, url: r.readerUrl, hits: [] };
            byBook[r.productId].hits.push(r);
        });

        Object.values(byBook).forEach(function (book) {
            const bookEl = document.createElement('div');
            bookEl.className = 'bs-sr-book';

            const titleEl = document.createElement('div');
            titleEl.className = 'bs-sr-book-title';
            titleEl.innerHTML = '<i class="fa-solid fa-book"></i> ' + escHtml(book.title);
            bookEl.appendChild(titleEl);

            book.hits.forEach(function (hit) {
                const item = document.createElement('a');
                item.className = 'bs-sr-item';
                // Pass both page AND query so reader can highlight
                item.href = hit.readerUrl + '?page=' + hit.page + '&q=' + encodeURIComponent(query);
                item.innerHTML =
                    '<span class="bs-sr-page">Pagina ' + hit.page + '</span>' +
                    '<span class="bs-sr-snippet">' + formatSnippet(hit.snippet) + '</span>';
                bookEl.appendChild(item);
            });

            resultsPanel.appendChild(bookEl);
        });
    }

    function hideResults() {
        if (resultsPanel) resultsPanel.setAttribute('hidden', '');
        try { sessionStorage.removeItem('bibliotheek_search'); } catch(_) {}
    }

    // ── Restore search after back-navigation ─────────────
    (function restoreSearch() {
        try {
            const stored = sessionStorage.getItem('bibliotheek_search');
            if (!stored) return;
            const { query, data } = JSON.parse(stored);
            if (!query || !data) return;
            if (searchInput) searchInput.value = query;
            setSearchIcon('clear');
            showResults(data, query); // re-renders panel (also re-saves to sessionStorage — fine)
        } catch(_) {}
    })();

    function escHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function formatSnippet(snippet) {
        return escHtml(snippet)
            .replace(/\[\[HIT\]\]/g, '<mark class="bs-sr-hit">')
            .replace(/\[\[\/HIT\]\]/g, '</mark>');
    }

    function doSearch(q) {
        if (activeXHR) { activeXHR.abort(); activeXHR = null; }
        if (!q || q.length < 2) {
            hideResults();
            setSearchIcon('idle');
            return;
        }
        setSearchIcon('loading');
        const url = SEARCH_URL + '?q=' + encodeURIComponent(q);
        activeXHR = new XMLHttpRequest();
        activeXHR.open('GET', url);
        activeXHR.onload = function () {
            if (activeXHR.status === 200) {
                try {
                    const data = JSON.parse(activeXHR.responseText);
                    showResults(data, q);
                } catch (_) {}
            }
            setSearchIcon('clear');
            activeXHR = null;
        };
        activeXHR.onerror = function () { setSearchIcon('idle'); activeXHR = null; };
        activeXHR.send();
    }

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = searchInput.value.trim();
            setSearchIcon(q.length >= 2 ? 'loading' : 'idle');
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function () { doSearch(q); }, 400);
        });

        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                searchInput.value = '';
                hideResults();
                setSearchIcon('idle');
                if (activeXHR) { activeXHR.abort(); activeXHR = null; }
            }
        });
    }

    // Clear/search button
    document.getElementById('bs-search-clear')?.addEventListener('click', function () {
        if (searchInput && searchInput.value.trim()) {
            searchInput.value = '';
            hideResults();
            setSearchIcon('idle');
            searchInput.focus();
        } else if (searchInput) {
            const q = searchInput.value.trim();
            if (q.length >= 2) doSearch(q);
        }
    });

    // ── Leeslijst button ─────────────────────────────────
    document.getElementById('bm-fab-sidebar')?.addEventListener('click', function () {
        document.getElementById('bm-fab')?.click();
    });

    // ── Laatst gelezen ───────────────────────────────────
    document.getElementById('bs-last-read-btn')?.addEventListener('click', function () {
        try {
            const raw = localStorage.getItem('bibliotheek_last_read');
            if (raw) {
                const meta = JSON.parse(raw);
                if (meta && meta.readerUrl) {
                    window.location.href = meta.readerUrl;
                    return;
                }
            }
        } catch (_) {}

        const book = getPool().find(b => {
            const id = b.dataset.productId;
            return id && localStorage.getItem('reading_progress_' + id);
        });
        if (book && book.dataset.readerUrl) {
            window.location.href = book.dataset.readerUrl;
        } else {
            alert('Je hebt nog geen boek gelezen.');
        }
    });

    // Show last-read book title in sub-label
    (function () {
        try {
            const raw = localStorage.getItem('bibliotheek_last_read');
            if (!raw) return;
            const meta = JSON.parse(raw);
            const sub  = document.querySelector('#bs-last-read-btn .bs-action-btn-sub');
            if (sub && meta.productTitle) sub.textContent = meta.productTitle;
        } catch (_) {}
    })();

})();
</script>

<script>
(function () {
    const BM_KEY   = 'reader_bookmarks_global';
    const fab      = document.getElementById('bm-fab');
    const badge    = document.getElementById('bm-fab-badge');
    const panel    = document.getElementById('bm-panel');
    const list     = document.getElementById('bm-panel-list');
    const close    = document.getElementById('bm-panel-close');
    const backdrop = document.getElementById('bm-panel-backdrop');
    const tabBm    = document.getElementById('bm-tab-bookmarks');
    const tabHl    = document.getElementById('bm-tab-highlights');

    let activeTab  = 'bookmarks';

    function bmLoad() {
        try { return JSON.parse(localStorage.getItem(BM_KEY) || '[]'); } catch { return []; }
    }
    function bmSave(a) {
        try { localStorage.setItem(BM_KEY, JSON.stringify(a)); } catch {}
    }
    function hlLoadAll() {
        const all = [];
        try {
            for (let i = 0; i < localStorage.length; i++) {
                const k = localStorage.key(i);
                if (!k || !k.startsWith('hl_')) continue;
                const arr = JSON.parse(localStorage.getItem(k) || '[]');
                arr.forEach(h => all.push({ _storageKey: k, ...h }));
            }
        } catch {}
        return all;
    }
    function hlDeleteOne(storageKey, id) {
        try {
            const arr = JSON.parse(localStorage.getItem(storageKey) || '[]');
            localStorage.setItem(storageKey, JSON.stringify(arr.filter(x => x.id !== id)));
        } catch {}
    }

    function totalCount() {
        return bmLoad().length + hlLoadAll().length;
    }

    function updateBadge() {
        const count = totalCount();
        badge.hidden = count === 0;
        badge.textContent = count > 9 ? '9+' : String(count);
    }

    function renderBookmarks() {
        list.innerHTML = '';
        const bms = bmLoad().slice().sort((a, b) =>
            (a.productTitle || '').localeCompare(b.productTitle || '') || a.pageNum - b.pageNum
        );
        if (!bms.length) {
            list.innerHTML = '<div class="bm-empty"><i class="fa-solid fa-bookmark"></i>Geen bladwijzers opgeslagen.<br>Voeg bladwijzers toe tijdens het lezen.</div>';
            return;
        }
        bms.forEach(bm => {
            const item = document.createElement('div');
            item.className = 'bm-item';
            item.innerHTML = `
                <div class="bm-item-icon"><i class="fa-solid fa-bookmark"></i></div>
                <div class="bm-item-body">
                    <div class="bm-item-book">${bm.productTitle || 'Onbekend boek'}</div>
                    <div class="bm-item-page">Pagina ${bm.pageNum}</div>
                    ${bm.text ? `<div class="bm-item-text">${bm.text}</div>` : ''}
                </div>
                <button class="bm-item-del" title="Verwijder bladwijzer" aria-label="Verwijder bladwijzer">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;
            item.addEventListener('click', e => {
                if (e.target.closest('.bm-item-del')) return;
                try { localStorage.setItem('reading_progress_' + bm.productId, String(bm.pageNum)); } catch {}
                window.location.href = bm.readerUrl;
            });
            item.querySelector('.bm-item-del').addEventListener('click', e => {
                e.stopPropagation();
                bmSave(bmLoad().filter(x => x.id !== bm.id));
                updateBadge();
                renderBookmarks();
            });
            list.appendChild(item);
        });
    }

    function renderHighlights() {
        list.innerHTML = '';
        const hls = hlLoadAll().slice().sort((a, b) =>
            (a.productTitle || '').localeCompare(b.productTitle || '') || a.pageNum - b.pageNum
        );
        if (!hls.length) {
            list.innerHTML = '<div class="bm-empty"><i class="fa-solid fa-highlighter"></i>Geen markeringen opgeslagen.<br>Markeer tekst tijdens het lezen.</div>';
            return;
        }
        hls.forEach(hl => {
            const item = document.createElement('div');
            item.className = 'bm-item';
            const colorClass = hl.color ? 'hl-' + hl.color : '';
            item.innerHTML = `
                <div class="bm-item-icon ${colorClass}"><i class="fa-solid fa-highlighter"></i></div>
                <div class="bm-item-body">
                    <div class="bm-item-book">${hl.productTitle || 'Onbekend boek'}</div>
                    <div class="bm-item-page">Pagina ${hl.pageNum}</div>
                    ${hl.text ? `<div class="bm-item-text">${hl.text}</div>` : ''}
                </div>
                <button class="bm-item-del" title="Verwijder markering" aria-label="Verwijder markering">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;
            item.addEventListener('click', e => {
                if (e.target.closest('.bm-item-del')) return;
                if (hl.readerUrl) {
                    try { localStorage.setItem('reading_progress_' + hl.productId, String(hl.pageNum)); } catch {}
                    window.location.href = hl.readerUrl;
                }
            });
            item.querySelector('.bm-item-del').addEventListener('click', e => {
                e.stopPropagation();
                hlDeleteOne(hl._storageKey, hl.id);
                updateBadge();
                renderHighlights();
            });
            list.appendChild(item);
        });
    }

    function renderActive() {
        activeTab === 'bookmarks' ? renderBookmarks() : renderHighlights();
    }

    function switchTab(tab) {
        activeTab = tab;
        tabBm.classList.toggle('active', tab === 'bookmarks');
        tabHl.classList.toggle('active', tab === 'highlights');
        renderActive();
    }

    tabBm?.addEventListener('click', () => switchTab('bookmarks'));
    tabHl?.addEventListener('click', () => switchTab('highlights'));

    function openPanel() {
        renderActive();
        panel.removeAttribute('hidden');
        backdrop.classList.add('open');
        requestAnimationFrame(() => panel.classList.add('open'));
    }
    function closePanel() {
        panel.classList.remove('open');
        backdrop.classList.remove('open');
        setTimeout(() => panel.setAttribute('hidden', ''), 300);
    }

    fab.addEventListener('click', openPanel);
    close.addEventListener('click', closePanel);
    backdrop.addEventListener('click', closePanel);
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && !panel.hidden) closePanel();
    });

    updateBadge();
})();
</script>

<script>
(function () {
    const BREAKPOINT_MOBILE = 768;

    window.buildShelves = function buildShelves() {
        const pool   = document.querySelector('.bookshelf-books-pool');
        const target = document.getElementById('bookshelf-shelves');
        // Only non-filtered books
        const books  = Array.from(pool.querySelectorAll('.shelf-book, .bookshelf-empty'))
                           .filter(b => b.dataset.hidden !== '1');
        const perRow = window.innerWidth <= BREAKPOINT_MOBILE ? 2 : 4;

        target.innerHTML = '';

        if (!books.length) {
            const empty = document.createElement('div');
            empty.className = 'bookshelf-empty';
            empty.innerHTML = '<i class="fa-solid fa-book-open"></i><p>Geen boeken gevonden.</p>';
            const row = document.createElement('div');
            row.className = 'bookshelf-shelf-row';
            const plank = document.createElement('div');
            plank.className = 'bookshelf-plank';
            plank.appendChild(empty);
            row.appendChild(plank);
            target.appendChild(row);
            return;
        }

        for (let i = 0; i < books.length; i += perRow) {
            const chunk = books.slice(i, i + perRow);
            const row   = document.createElement('div');
            row.className = 'bookshelf-shelf-row';
            const plank = document.createElement('div');
            plank.className = 'bookshelf-plank';
            chunk.forEach(book => plank.appendChild(book.cloneNode(true)));
            row.appendChild(plank);
            target.appendChild(row);
        }
    }

    buildShelves();

    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(buildShelves, 150);
    });
})();
</script>

{{-- Cookie Consent Banner (GDPR/AVG) --}}
<x-cookie-consent />



</body>
</html>
