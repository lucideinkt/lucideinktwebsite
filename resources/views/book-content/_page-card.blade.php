<div class="page-card-header">
    <span class="drag-handle" title="Slepen"><i class="fa-solid fa-grip-vertical"></i></span>
    <span class="page-badge">Pagina <span class="badge-nr">#{{ $page->page_number }}</span></span>
    <span class="accordion-toggle" title="Klik om open/dicht te klappen">
        <i class="fa-solid fa-chevron-down accordion-icon"></i>
    </span>
    <input type="hidden" name="pages[{{ $page->id }}][id]" value="{{ $page->id }}">
    <input type="hidden" name="pages[{{ $page->id }}][page_number]" class="page-number-input" value="{{ $page->page_number }}">
</div>
<div class="page-card-body page-card-collapsible" style="display:none;">
    <textarea
        class="page-textarea"
        name="pages[{{ $page->id }}][content]"
        spellcheck="false"
    >{{ $page->content }}</textarea>
</div>
<div class="page-card-footer page-card-collapsible" style="display:none;">
    <span class="word-count">0 woorden</span>
    <button type="button" class="btn-delete-page">
        <i class="fa-solid fa-trash"></i> Verwijder
    </button>
</div>
