<x-dashboard-layout>
<main class="container page dashboard">

    {{-- Breadcrumb --}}
    <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;font-size:14px;color:var(--ink-muted);">
        <a href="{{ route('bookContent.index') }}" style="color:var(--ink-muted);text-decoration:none;">
            <i class="fa-solid fa-book-open"></i> Book Content
        </a>
        <span>/</span>
        <span style="color:var(--main-font-color);">{{ $product->title }}</span>
    </div>

    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">{{ $product->title }}</h2>
        <div style="display:flex;gap:10px;align-items:center;">
            <a href="{{ route('onlineLezenReadHtml', $product->slug) }}" target="_blank" class="btn" style="font-size:13px;display:inline-flex;align-items:center;gap:6px;">
                <i class="fa-solid fa-eye"></i> Bekijk lezer
            </a>
            <a href="{{ route('bookContent.index') }}" class="btn" style="font-size:13px;background:var(--surface-2);color:var(--main-font-color);border:1px solid var(--border-1);">
                <i class="fa-solid fa-arrow-left"></i> Terug
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="position:relative;margin-bottom:16px;">
            {{ session('success') }}
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    <div style="background:#e8f5e9;border:1px solid #a5d6a7;border-radius:8px;padding:11px 16px;margin-bottom:22px;font-size:13px;color:#2e7d32;display:flex;align-items:center;gap:10px;">
        <i class="fa-solid fa-circle-info" style="flex-shrink:0;"></i>
        Het paginanummer wordt automatisch uitgelezen uit <code style="background:rgba(0,0,0,.07);padding:1px 5px;border-radius:3px;">&lt;div class="page" id="<strong>8</strong>"&gt;</code> in je HTML.
        Sleep de header van een kaart om de volgorde te wijzigen. <kbd>Ctrl+S</kbd> = opslaan.
    </div>

    <form method="POST" action="{{ route('bookContent.update', $product->id) }}" id="pages-form">
        @csrf
        @method('PUT')

        {{-- Boektitel invoer --}}
        <div style="background:#2d2d2d;border-radius:10px;padding:16px 18px;margin-bottom:20px;display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
            <label for="book_title_input" style="color:#aaa;font-size:12px;font-family:monospace;white-space:nowrap;flex-shrink:0;">
                <i class="fa-solid fa-book" style="color:#4a90d9;margin-right:5px;"></i> Boektitel
            </label>
            <input
                type="text"
                id="book_title_input"
                name="book_title"
                value="{{ $bookTitle }}"
                placeholder="bijv. Het Traktaat over de Herzameling"
                style="flex:1;min-width:240px;background:#1a1a1a;color:#e0e0e0;border:1px solid #444;border-radius:6px;padding:8px 12px;font-size:14px;font-family:'Courier New',monospace;outline:none;"
                onfocus="this.style.borderColor='#4a90d9'"
                onblur="this.style.borderColor='#444'"
            >
            <span style="font-size:11px;color:#666;font-family:monospace;">
                Reeks: <em style="color:#888;">Uit de Reeks van de Risale-i Nur</em> &nbsp;·&nbsp;
                Auteur: <em style="color:#888;">Bedîüzzaman Said Nursî</em>
            </span>
        </div>

        <div id="pages-list">
            @forelse($pages as $page)
                <div class="page-card" data-id="{{ $page->id }}">
                    @include('book-content._page-card', ['page' => $page, 'loop' => $loop])
                </div>
            @empty
                <p id="no-pages-msg" style="color:var(--ink-muted);font-style:italic;padding:20px 0;">
                    Nog geen pagina's. Klik op "+ Pagina toevoegen" om te beginnen.
                </p>
            @endforelse
        </div>

        <div style="display:flex;gap:12px;align-items:center;margin-top:20px;flex-wrap:wrap;padding:16px;background:var(--surface-1);border-radius:8px;border:1px solid var(--border-1);">
            <button type="button" id="btn-add-page" class="btn" style="display:inline-flex;align-items:center;gap:7px;background:#1565c0;color:#fff;border:none;">
                <i class="fa-solid fa-plus"></i> Pagina toevoegen
            </button>
            <button type="submit" class="btn" style="background:var(--green-2);color:#fff;display:inline-flex;align-items:center;gap:7px;">
                <i class="fa-solid fa-floppy-disk"></i> Alles opslaan
            </button>
            <span style="font-size:12px;color:var(--ink-muted);margin-left:4px;">
                <i class="fa-solid fa-circle-info"></i> Paginanummers worden automatisch opgeslagen vanuit je HTML
            </span>
        </div>
    </form>
</main>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/dracula.min.css">

<style>
/* ── Kaart ── */
.page-card {
    border: 1px solid var(--border-1);
    border-radius: 10px;
    margin-bottom: 14px;
    background: var(--surface-2);
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
    transition: box-shadow .2s;
    /* geen overflow:hidden — anders knipt CodeMirror af */
}
.page-card.dragging { opacity: .4; box-shadow: 0 8px 28px rgba(0,0,0,.22); }

/* ── Header ── */
.page-card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 14px;
    background: #2d2d2d;
    cursor: pointer;
    user-select: none;
    border-radius: 10px 10px 0 0;
    transition: background .15s;
}
.page-card-header:hover { background: #383838; }
.page-card.open .page-card-header { border-radius: 10px 10px 0 0; }
.page-card:not(.open) .page-card-header { border-radius: 10px; }
.drag-handle { color: #888; font-size: 14px; padding: 2px 4px; cursor: grab; }
.drag-handle:active { cursor: grabbing; }

/* ── Accordion toggle ── */
.accordion-toggle {
    margin-left: auto;
    color: #888;
    font-size: 13px;
    transition: transform .2s;
    pointer-events: none;
}
.page-card.open .accordion-icon {
    transform: rotate(180deg);
}
.accordion-icon { display: inline-block; transition: transform .2s; }

/* ── Badge ── */
.page-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #1565c0;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    padding: 3px 12px;
    border-radius: 20px;
    letter-spacing: .04em;
    font-family: monospace;
}
.page-badge .badge-nr {
    background: rgba(255,255,255,.2);
    padding: 1px 7px;
    border-radius: 10px;
    font-size: 13px;
}

/* ── Toolbar ── */
.page-toolbar {
    display: flex;
    align-items: center;
    gap: 4px;
    flex-wrap: wrap;
    padding: 6px 10px;
    background: #1e1e1e;
    border-bottom: 1px solid #333;
}
.tag-btn {
    background: #3a3a3a;
    color: #ccc;
    border: 1px solid #555;
    border-radius: 4px;
    padding: 3px 9px;
    font-size: 11px;
    cursor: pointer;
    font-family: 'Courier New', monospace;
    transition: background .12s, color .12s;
    line-height: 1.4;
}
.tag-btn:hover { background: #4a90d9; color: #fff; border-color: #4a90d9; }
.toolbar-sep { width: 1px; height: 18px; background: #444; margin: 0 4px; flex-shrink: 0; }

/* ── CodeMirror ── */
.CodeMirror {
    height: auto !important;
    min-height: 280px;
    font-size: 13.5px;
    font-family: 'Consolas', 'Courier New', monospace;
    line-height: 1.65;
    border-radius: 0;
    width: 100% !important;
}
.CodeMirror-scroll {
    min-height: 280px;
    overflow-y: auto !important;
    overflow-x: auto !important;
}
.CodeMirror-sizer { min-height: 260px !important; }

/* ── Footer ── */
.page-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 7px 14px;
    background: #1e1e1e;
    border-top: 1px solid #333;
    font-size: 12px;
    border-radius: 0 0 10px 10px;
}
.word-count { color: #777; font-family: monospace; }
.btn-delete-page {
    background: none;
    border: 1px solid #444;
    border-radius: 5px;
    color: #888;
    cursor: pointer;
    font-size: 12px;
    padding: 4px 10px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all .15s;
}
.btn-delete-page:hover { background: #3a0000; color: #ff6b6b; border-color: #ff6b6b; }

kbd {
    background: #eee; border: 1px solid #ccc;
    border-radius: 3px; padding: 1px 5px;
    font-size: 11px; font-family: monospace;
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/xml/xml.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/htmlmixed/htmlmixed.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/addon/edit/closetag.min.js"></script>

<script>
(function () {
    const productId = {{ $product->id }};
    const csrf      = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
    const list      = document.getElementById('pages-list');
    const noMsg     = document.getElementById('no-pages-msg');

    /* ── Lees boekpaginanummer simpel uit content ── */
    function getPageNr(content) {
        // Zoekt <div class="page" id="8"> of <div id="8" class="page">
        const m = content.match(/class="[^"]*\bpage\b[^"]*"[^>]*id="(\d+)"/i)
               || content.match(/id="(\d+)"[^>]*class="[^"]*\bpage\b[^"]*"/i);
        return m ? parseInt(m[1], 10) : null;
    }

    /* ── Badge updaten ── */
    function updateBadge(card) {
        const badge   = card.querySelector('.page-badge');
        const cm      = card._cm;
        const content = cm ? cm.getValue() : (card.querySelector('textarea')?.value ?? '');
        const nr      = getPageNr(content);
        const pos     = [...list.querySelectorAll('.page-card')].indexOf(card) + 1;

        if (!badge) return;
        if (nr) {
            badge.innerHTML = `Pagina <span class="badge-nr">#${nr}</span>`;
        } else {
            badge.textContent = `Pagina ${pos}`;
        }
    }

    /* ── Woordteller ── */
    function updateCount(card) {
        const cm      = card._cm;
        const content = cm ? cm.getValue() : (card.querySelector('textarea')?.value ?? '');
        const text    = content.replace(/<[^>]+>/g, ' ');
        const words   = text.trim() ? text.trim().split(/\s+/).filter(w => w.length > 0).length : 0;
        const el      = card.querySelector('.word-count');
        if (el) el.textContent = words + ' woorden';
        updateBadge(card);
    }

    /* ── CodeMirror initialiseren op een card ── */
    function initEditor(card) {
        const ta = card.querySelector('.page-textarea');
        if (!ta || card._cm) return;

        const cm = CodeMirror.fromTextArea(ta, {
            mode          : 'htmlmixed',
            theme         : 'dracula',
            lineNumbers   : true,
            lineWrapping  : true,
            autoCloseTags : true,
            tabSize       : 2,
            indentWithTabs: false,
            extraKeys     : {
                'Tab'      : cm => cm.execCommand('indentMore'),
                'Shift-Tab': cm => cm.execCommand('indentLess'),
            },
        });

        card._cm = cm;
        cm.on('change', () => updateCount(card));

        requestAnimationFrame(() => {
            cm.refresh();
            updateCount(card);
        });
    }

    /* ── Tag toolbar ── */
    function bindToolbar(card) {
        card.querySelectorAll('.tag-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const cm          = card._cm;
                const tag         = btn.dataset.tag;
                const selfClosing = btn.dataset.selfClosing === '1';

                if (!cm) return;

                const sel = cm.getSelection();
                const ins = selfClosing
                    ? `<${tag}>`
                    : sel
                        ? `<${tag}>${sel}</${tag}>`
                        : `<${tag}></${tag}>`;

                cm.replaceSelection(ins);

                // Cursor tussen tags plaatsen als er geen selectie was
                if (!selfClosing && !sel) {
                    const cur = cm.getCursor();
                    cm.setCursor({ line: cur.line, ch: cur.ch - tag.length - 3 });
                }
                cm.focus();
            });
        });
    }

    /* ── Verwijder knop ── */
    function bindDelete(card) {
        card.querySelector('.btn-delete-page')?.addEventListener('click', async () => {
            const pageId = card.dataset.id;
            if (!confirm('Pagina verwijderen?')) return;
            if (pageId) {
                await fetch(`/dashboard/book-content/${productId}/pages/${pageId}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                });
            }
            card.remove();
            renumber();
            toggleNoMsg();
        });
    }

    /* ── Accordion open/dicht ── */
    function bindAccordion(card) {
        card.querySelector('.page-card-header').addEventListener('click', function (e) {
            // Drag-handle klik niet laten togglen
            if (e.target.closest('.drag-handle')) return;
            toggleCard(card);
        });
    }

    function toggleCard(card, forceOpen) {
        const isOpen   = forceOpen !== undefined ? !forceOpen : card.classList.contains('open');
        const show     = !isOpen;
        card.classList.toggle('open', show);
        card.querySelectorAll('.page-card-collapsible').forEach(el => {
            el.style.display = show ? '' : 'none';
        });
        // Als CodeMirror al bestaat, refresh na animatie
        if (show && card._cm) {
            setTimeout(() => card._cm.refresh(), 10);
        }
        // Als CodeMirror nog niet bestaat maar we gaan open: initialiseer dan nu
        if (show && !card._cm) {
            initEditor(card);
        }
    }

    /* ── Renumber alle badges ── */
    function renumber() {
        list.querySelectorAll('.page-card').forEach(c => updateBadge(c));
    }

    function toggleNoMsg() {
        if (noMsg) noMsg.style.display = list.querySelectorAll('.page-card').length ? 'none' : 'block';
    }

    /* ── Drag & drop — alleen via drag-handle ── */
    let dragSrc = null;
    function bindDrag(card) {
        const handle = card.querySelector('.drag-handle');
        handle.setAttribute('draggable', true);
        handle.addEventListener('dragstart', e => {
            dragSrc = card; card.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.stopPropagation();
        });
        handle.addEventListener('dragend', () => {
            card.classList.remove('dragging'); dragSrc = null;
            renumber();
        });
        card.addEventListener('dragover', e => {
            e.preventDefault();
            if (!dragSrc || dragSrc === card) return;
            const mid = card.getBoundingClientRect().top + card.offsetHeight / 2;
            list.insertBefore(dragSrc, e.clientY < mid ? card : card.nextSibling);
        });
    }

    /* ── Nieuwe pagina toevoegen ── */
    document.getElementById('btn-add-page').addEventListener('click', async () => {
        const res  = await fetch(`/dashboard/book-content/${productId}/pages`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
        });
        const data = await res.json();
        const card = buildCard(data.id, '', list.querySelectorAll('.page-card').length + 1);
        list.appendChild(card);
        // Eerst in DOM, dan pas initialiseren
        requestAnimationFrame(() => {
            bindAccordion(card);
            bindToolbar(card);
            bindDelete(card);
            bindDrag(card);
            toggleCard(card, false); // open
            renumber();
            toggleNoMsg();
            setTimeout(() => card._cm?.focus(), 60);
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });

    /* ── Card HTML bouwen ── */
    function buildCard(id, content, pos) {
        const div = document.createElement('div');
        div.className = 'page-card';
        div.dataset.id = id;
        div.innerHTML = `
            <div class="page-card-header">
                <span class="drag-handle" title="Slepen"><i class="fa-solid fa-grip-vertical"></i></span>
                <span class="page-badge">Pagina ${pos}</span>
                <span class="accordion-toggle" title="Klik om open/dicht te klappen">
                    <i class="fa-solid fa-chevron-down accordion-icon"></i>
                </span>
                <input type="hidden" name="pages[${id}][id]" value="${id}">
                <input type="hidden" name="pages[${id}][page_number]" class="page-number-input" value="0">
            </div>
            <div class="page-card-body page-card-collapsible" style="display:none;">
                <div class="page-toolbar">
                    <button type="button" class="tag-btn" data-tag="div" title="Pagina wrapper"><span style="color:#e06c75">div</span>.page</button>
                    <div class="toolbar-sep"></div>
                    <button type="button" class="tag-btn" data-tag="h2">H2</button>
                    <button type="button" class="tag-btn" data-tag="h3">H3</button>
                    <button type="button" class="tag-btn" data-tag="p">P</button>
                    <div class="toolbar-sep"></div>
                    <button type="button" class="tag-btn" data-tag="span">span</button>
                    <div class="toolbar-sep"></div>
                    <button type="button" class="tag-btn" data-tag="sup">SUP</button>
                    <button type="button" class="tag-btn" data-tag="br" data-self-closing="1">BR</button>
                </div>
                <textarea class="page-textarea" name="pages[${id}][content]" spellcheck="false">${content}</textarea>
            </div>
            <div class="page-card-footer page-card-collapsible" style="display:none;">
                <span class="word-count">0 woorden</span>
                <button type="button" class="btn-delete-page"><i class="fa-solid fa-trash"></i> Verwijder</button>
            </div>`;
        return div;
    }

    /* ── Bestaande cards initialiseren na DOM ready ── */
    function initAll() {
        list.querySelectorAll('.page-card').forEach(card => {
            bindAccordion(card);
            bindToolbar(card);
            bindDelete(card);
            bindDrag(card);
            // Bestaande kaarten: NIET initEditor — wacht tot gebruiker openklapt (lazy)
        });
        toggleNoMsg();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }

    /* ── Bij opslaan: sync CodeMirror → textarea, dan controller doet de rest ── */
    function syncAll() {
        list.querySelectorAll('.page-card').forEach((card, i) => {
            // CodeMirror sync naar textarea (voor form submit)
            card._cm?.save();
            // Paginanummer invullen op basis van content
            const content = card._cm ? card._cm.getValue() : (card.querySelector('.page-textarea')?.value ?? '');
            const nr      = getPageNr(content);
            const input   = card.querySelector('.page-number-input');
            if (input) input.value = nr ?? (i + 1);
        });
    }

    document.getElementById('pages-form').addEventListener('submit', syncAll);

    document.addEventListener('keydown', e => {
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            syncAll();
            document.getElementById('pages-form').requestSubmit();
        }
    });
})();
</script>
</x-dashboard-layout>

