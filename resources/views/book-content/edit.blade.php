<x-dashboard-layout>

{{-- Breadcrumb --}}
<nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="{{ route('bookContent.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-3 h-3 me-2.5" fill="currentColor" viewBox="0 0 20 20"><path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/></svg>
                Book Content
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $product->title }}</span>
            </div>
        </li>
    </ol>
</nav>

{{-- Page header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
    <div>
        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $product->title }}</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">HTML-pagina's bewerken</p>
    </div>
    <div class="flex items-center gap-2 flex-shrink-0">
        <a href="{{ route('onlineLezenReadHtml', $product->slug) }}" target="_blank"
            class="inline-flex items-center gap-1.5 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
            Bekijk lezer
        </a>
        <a href="{{ route('bookContent.index') }}"
            class="inline-flex items-center gap-1.5 text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0 7-7m-7 7h18"/></svg>
            Terug
        </a>
    </div>
</div>

@if(session('success'))
<div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
    <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
    <span class="ms-2 text-sm font-medium">{{ session('success') }}</span>
    <button type="button" onclick="document.getElementById('alert-success').remove()" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700">
        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
    </button>
</div>
@endif

{{-- Info banner --}}
<div class="flex items-start gap-3 p-4 mb-5 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-200 dark:border-green-800">
    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd"/></svg>
    <span>
        Het paginanummer wordt automatisch uitgelezen uit <code class="px-1 py-0.5 rounded text-xs font-mono bg-green-100 dark:bg-gray-700">&lt;div class="page" id="<strong>8</strong>"&gt;</code> in je HTML.
        Sleep de header van een kaart om de volgorde te wijzigen. <kbd class="px-1 py-0.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Ctrl+S</kbd> = opslaan.
    </span>
</div>

<form method="POST" action="{{ route('bookContent.update', $product->id) }}" id="pages-form">
    @csrf
    @method('PUT')

    {{-- Boektitel card --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-5">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-4 h-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 0 0 5.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 0 1 5.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0 1 14.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0 0 14.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 1 1-2 0V4.804Z"/></svg>
                Boektitel
            </h2>
        </div>
        <div style="background:#2d2d2d;border-radius:0 0 8px 8px;padding:14px 18px;display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
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
            <span style="font-size:11px;color:#888;font-family:monospace;white-space:nowrap;">
                Reeks: <em style="color:#aaa;">Uit de Reeks van de Risale-i Nur</em> &nbsp;·&nbsp;
                Auteur: <em style="color:#aaa;">Bedîüzzaman Said Nursî</em>
            </span>
        </div>
    </div>

    {{-- Pages list --}}
    <div id="pages-list">
        @forelse($pages as $page)
            <div class="page-card" data-id="{{ $page->id }}">
                @include('book-content._page-card', ['page' => $page, 'loop' => $loop])
            </div>
        @empty
            <p id="no-pages-msg" class="text-sm text-gray-500 dark:text-gray-400 italic py-5">
                Nog geen pagina's. Klik op "+ Pagina toevoegen" om te beginnen.
            </p>
        @endforelse
    </div>

    {{-- Bottom action bar --}}
    <div class="flex items-center gap-3 flex-wrap mt-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <button type="button" id="btn-add-page"
            class="inline-flex items-center gap-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/></svg>
            Pagina toevoegen
        </button>
        <button type="submit"
            class="inline-flex items-center gap-2 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3m-1 4-3 3m0 0-3-3m3 3V4"/></svg>
            Alles opslaan
        </button>
        <span class="text-xs text-gray-400 dark:text-gray-500 flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd"/></svg>
            Paginanummers worden automatisch opgeslagen vanuit je HTML
        </span>
    </div>
</form>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/dracula.min.css">

<style>
.page-card {
    border: 1px solid #3a3a3a;
    border-radius: 10px;
    margin-bottom: 14px;
    background: #252525;
    box-shadow: 0 1px 4px rgba(0,0,0,.18);
    transition: box-shadow .2s;
}
.page-card.dragging { opacity: .4; box-shadow: 0 8px 28px rgba(0,0,0,.32); }

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

.accordion-toggle {
    margin-left: auto;
    color: #888;
    font-size: 13px;
    transition: transform .2s;
    pointer-events: none;
}
.accordion-icon { display: inline-block; transition: transform .2s; }
.page-card.open .accordion-icon { transform: rotate(180deg); }

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

    function getPageNr(content) {
        const m = content.match(/class="[^"]*\bpage\b[^"]*"[^>]*id="(\d+)"/i)
               || content.match(/id="(\d+)"[^>]*class="[^"]*\bpage\b[^"]*"/i);
        return m ? parseInt(m[1], 10) : null;
    }

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

    function updateCount(card) {
        const cm      = card._cm;
        const content = cm ? cm.getValue() : (card.querySelector('textarea')?.value ?? '');
        const text    = content.replace(/<[^>]+>/g, ' ');
        const words   = text.trim() ? text.trim().split(/\s+/).filter(w => w.length > 0).length : 0;
        const el      = card.querySelector('.word-count');
        if (el) el.textContent = words + ' woorden';
        updateBadge(card);
    }

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
        requestAnimationFrame(() => { cm.refresh(); updateCount(card); });
    }

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
                    : sel ? `<${tag}>${sel}</${tag}>` : `<${tag}></${tag}>`;
                cm.replaceSelection(ins);
                if (!selfClosing && !sel) {
                    const cur = cm.getCursor();
                    cm.setCursor({ line: cur.line, ch: cur.ch - tag.length - 3 });
                }
                cm.focus();
            });
        });
    }

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

    function bindAccordion(card) {
        card.querySelector('.page-card-header').addEventListener('click', function (e) {
            if (e.target.closest('.drag-handle')) return;
            toggleCard(card);
        });
    }

    function toggleCard(card, forceOpen) {
        const isOpen = forceOpen !== undefined ? !forceOpen : card.classList.contains('open');
        const show   = !isOpen;
        card.classList.toggle('open', show);
        card.querySelectorAll('.page-card-collapsible').forEach(el => {
            el.style.display = show ? '' : 'none';
        });
        if (show && card._cm) { setTimeout(() => card._cm.refresh(), 10); }
        if (show && !card._cm) { initEditor(card); }
    }

    function renumber() {
        list.querySelectorAll('.page-card').forEach(c => updateBadge(c));
    }

    function toggleNoMsg() {
        if (noMsg) noMsg.style.display = list.querySelectorAll('.page-card').length ? 'none' : 'block';
    }

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
            card.classList.remove('dragging'); dragSrc = null; renumber();
        });
        card.addEventListener('dragover', e => {
            e.preventDefault();
            if (!dragSrc || dragSrc === card) return;
            const mid = card.getBoundingClientRect().top + card.offsetHeight / 2;
            list.insertBefore(dragSrc, e.clientY < mid ? card : card.nextSibling);
        });
    }

    document.getElementById('btn-add-page').addEventListener('click', async () => {
        const res  = await fetch(`/dashboard/book-content/${productId}/pages`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
        });
        const data = await res.json();
        const card = buildCard(data.id, '', list.querySelectorAll('.page-card').length + 1);
        list.appendChild(card);
        requestAnimationFrame(() => {
            bindAccordion(card);
            bindToolbar(card);
            bindDelete(card);
            bindDrag(card);
            toggleCard(card, false);
            renumber();
            toggleNoMsg();
            setTimeout(() => card._cm?.focus(), 60);
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });

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

    function initAll() {
        list.querySelectorAll('.page-card').forEach(card => {
            bindAccordion(card);
            bindToolbar(card);
            bindDelete(card);
            bindDrag(card);
        });
        toggleNoMsg();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }

    function syncAll() {
        list.querySelectorAll('.page-card').forEach((card, i) => {
            card._cm?.save();
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
