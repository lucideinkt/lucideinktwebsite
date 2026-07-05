// =====================================================
// ARTIKEL BLOCK BUILDER
// =====================================================

let blockIndex = 0;
const container = document.getElementById('blocks-container');

const existingBlocks = @json($existingBlocks);

// Featured image preview
document.getElementById('featured_image_input')?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    document.getElementById('featured_image_preview').src = URL.createObjectURL(file);
    document.getElementById('featured_image_preview_wrapper').classList.remove('hidden');
});

const defaultWidths = { left:'40%', right:'40%', center:'680px', full:'100%' };

// ── Toolbar helpers ──────────────────────────────────
function wrapSel(btn, before, after) {
    const ta = btn.closest('.block-item').querySelector('textarea');
    if (!ta) return;
    const s = ta.selectionStart, e = ta.selectionEnd;
    const sel = ta.value.substring(s, e);
    ta.value = ta.value.substring(0, s) + before + sel + after + ta.value.substring(e);
    ta.selectionStart = s + before.length;
    ta.selectionEnd   = s + before.length + sel.length;
    ta.focus();
}
function wrapSelLink(btn) {
    const ta = btn.closest('.block-item').querySelector('textarea');
    if (!ta) return;
    const s = ta.selectionStart, e = ta.selectionEnd;
    const sel = ta.value.substring(s, e) || 'Linktekst';
    const url = prompt('URL invoeren:', 'https://');
    if (!url) return;
    const tag = `<a href="${url}">${sel}</a>`;
    ta.value = ta.value.substring(0, s) + tag + ta.value.substring(e);
    ta.focus();
}
// ────────────────────────────────────────────────────

function addBlock(type, data) {
    const idx = blockIndex++;
    const el  = document.createElement('div');
    el.className = 'block-item';
    el.dataset.index = idx;
    el.dataset.type  = type;

    if (type === 'text') {
        const html       = data?.html       ?? '';
        const source     = data?.source     ?? '';
        const indent     = data?.indent     ?? true;
        const imgPath    = data?.img_path    ?? '';
        const imgAlt     = data?.img_alt     ?? '';
        const imgCaption = data?.img_caption ?? '';
        const imgAlign   = data?.img_align   ?? 'right';
        const imgWidth   = data?.img_width   ?? '';
        const imgUrl     = imgPath ? `/storage/${imgPath}` : '';
        const defaultW   = defaultWidths[imgAlign] ?? '40%';

        el.innerHTML = `
            <div class="block-item__header">
                <span class="block-type-badge block-type-text">Tekst</span>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="moveBlock(this,-1)" title="Omhoog" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-sm px-1">↑</button>
                    <button type="button" onclick="moveBlock(this,1)"  title="Omlaag" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-sm px-1">↓</button>
                    <button type="button" onclick="removeBlock(this)" class="text-red-500 hover:text-red-700 text-xs px-2 py-1 rounded border border-red-200 hover:bg-red-50 dark:hover:bg-red-900/30">Verwijderen</button>
                </div>
            </div>
            <input type="hidden" name="blocks[${idx}][type]" value="text">

            <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">Tekst (HTML ondersteund)</label>

            <div class="text-toolbar">
                <button type="button" onclick="wrapSel(this,'<strong>','</strong>')" title="Vet"><strong>B</strong></button>
                <button type="button" onclick="wrapSel(this,'<em>','</em>')" title="Cursief" style="font-style:italic;">I</button>
                <div class="tb-sep"></div>
                <button type="button" onclick="wrapSel(this,'<h2>','</h2>')" title="Kopje H2">H2</button>
                <button type="button" onclick="wrapSel(this,'<h3>','</h3>')" title="Kopje H3">H3</button>
                <div class="tb-sep"></div>
                <button type="button" onclick="wrapSel(this,'<p>','</p>')" title="Alinea">¶ p</button>
                <button type="button" onclick="wrapSel(this,'<blockquote><p>','</p></blockquote>')" title="Citaat">" cit.</button>
                <div class="tb-sep"></div>
                <button type="button" onclick="wrapSelLink(this)" title="Link invoegen">🔗 link</button>
            </div>

            <textarea name="blocks[${idx}][html]" rows="6"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white font-mono text-xs"
                placeholder="<p>Uw tekst hier...</p>">${escapeHtml(html)}</textarea>
            <p class="mt-1 mb-3 text-xs text-gray-400 dark:text-gray-500">💡 Selecteer tekst en klik een knop hierboven om op te maken.</p>

            <div class="flex items-center gap-4 mb-3">
                <label class="flex items-center gap-1.5 text-xs font-medium text-gray-600 dark:text-gray-300 cursor-pointer select-none">
                    <input type="checkbox" name="blocks[${idx}][indent]" value="1" ${indent ? 'checked' : ''}
                        class="w-3.5 h-3.5 text-primary-600 rounded focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                    Tekst inlaten (indent)
                </label>
            </div>

            <div class="mb-3">
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">Bron / bronvermelding <span class="text-gray-400">(optioneel)</span></label>
                <input type="text" name="blocks[${idx}][source]" value="${escapeHtml(source)}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Bijv. Risale-i Nur, Woorden, 22e Woord — p. 312">
            </div>

            <details class="mt-1 border border-dashed border-amber-300 dark:border-amber-700 rounded-lg p-3 bg-amber-50/40 dark:bg-amber-900/10" ${imgPath ? 'open' : ''}>
                <summary class="cursor-pointer text-xs font-semibold text-amber-700 dark:text-amber-400 select-none">
                    📷 Afbeelding bij deze tekst <span class="font-normal text-gray-400">(optioneel)</span>
                </summary>
                <div class="mt-3 space-y-3">
                    <input type="hidden" name="blocks[${idx}][img_existing_path]" value="${escapeHtml(imgPath)}" class="text-img-existing-path">
                    ${imgUrl ? `<div><p class="text-xs text-gray-500 mb-1">Huidige afbeelding:</p><img src="${imgUrl}" alt="${escapeHtml(imgAlt)}" style="max-height:120px;border-radius:6px;border:1px solid #e5e7eb;"></div>` : ''}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">${imgPath ? 'Nieuwe afbeelding (laat leeg om huidige te behouden)' : 'Afbeelding uploaden'}</label>
                        <input type="file" name="blocks[${idx}][img_file]" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 dark:text-gray-400 text-block-img-file">
                        <div class="text-block-img-preview-wrapper hidden mt-2"><img src="" alt="" style="max-height:120px;border-radius:6px;border:1px solid #e5e7eb;"></div>
                    </div>
                    ${imgPath ? `<label class="flex items-center gap-1.5 text-xs text-red-600 cursor-pointer"><input type="checkbox" name="blocks[${idx}][img_remove]" value="1" class="w-3.5 h-3.5"> Afbeelding verwijderen</label>` : ''}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">Alt-tekst afbeelding</label>
                        <input type="text" name="blocks[${idx}][img_alt]" value="${escapeHtml(imgAlt)}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Beschrijving van de afbeelding">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">Bijschrift <span class="text-gray-400">(optioneel)</span></label>
                        <input type="text" name="blocks[${idx}][img_caption]" value="${escapeHtml(imgCaption)}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Bijschrift onder de afbeelding...">
                    </div>
                    <div class="flex gap-4 items-end flex-wrap">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">Positie</label>
                            <select name="blocks[${idx}][img_align]" onchange="updateTextImgWidthPlaceholder(this)"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-img-align-select">
                                <option value="right"  ${imgAlign==='right'  ?'selected':''}>Rechts van de tekst</option>
                                <option value="left"   ${imgAlign==='left'   ?'selected':''}>Links van de tekst</option>
                                <option value="center" ${imgAlign==='center' ?'selected':''}>Gecentreerd (boven tekst)</option>
                                <option value="full"   ${imgAlign==='full'   ?'selected':''}>Volledige breedte (boven tekst)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">Breedte <span class="text-gray-400">(optioneel)</span></label>
                            <input type="text" name="blocks[${idx}][img_width]" value="${escapeHtml(imgWidth)}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-36 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white text-img-width-input"
                                placeholder="${defaultW}">
                            <p class="mt-1 text-xs text-gray-400">Standaard: <span class="text-img-width-hint">${defaultW}</span></p>
                        </div>
                    </div>
                </div>
            </details>
        `;

        setTimeout(() => {
            el.querySelector('.text-block-img-file')?.addEventListener('change', function () {
                const file = this.files[0]; if (!file) return;
                const w = el.querySelector('.text-block-img-preview-wrapper');
                const i = w?.querySelector('img');
                if (i) i.src = URL.createObjectURL(file);
                w?.classList.remove('hidden');
            });
        }, 0);

    } else if (type === 'image') {
        const existingPath    = data?.path    ?? '';
        const existingAlt     = data?.alt     ?? '';
        const existingCaption = data?.caption ?? '';
        const existingAlign   = data?.align   ?? 'center';
        const existingWidth   = data?.width   ?? '';
        const existingUrl     = existingPath ? `/storage/${existingPath}` : '';
        const defaultW        = defaultWidths[existingAlign] ?? '680px';

        el.innerHTML = `
            <div class="block-item__header">
                <span class="block-type-badge block-type-image">Afbeelding</span>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="moveBlock(this,-1)" title="Omhoog" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-sm px-1">↑</button>
                    <button type="button" onclick="moveBlock(this,1)"  title="Omlaag" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-sm px-1">↓</button>
                    <button type="button" onclick="removeBlock(this)" class="text-red-500 hover:text-red-700 text-xs px-2 py-1 rounded border border-red-200 hover:bg-red-50 dark:hover:bg-red-900/30">Verwijderen</button>
                </div>
            </div>
            <input type="hidden" name="blocks[${idx}][type]" value="image">
            <input type="hidden" name="blocks[${idx}][existing_path]" value="${escapeHtml(existingPath)}" class="existing-path-input">
            ${existingUrl ? `<div class="mb-2"><p class="text-xs text-gray-500 mb-1">Huidige afbeelding:</p><img src="${existingUrl}" alt="${escapeHtml(existingAlt)}" class="image-preview block-current-image"></div>` : ''}
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">${existingPath ? 'Nieuwe afbeelding uploaden (laat leeg om huidige te behouden)' : 'Afbeelding uploaden *'}</label>
                    <input type="file" name="blocks[${idx}][file]" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 dark:text-gray-400 block-file-input">
                    <div class="block-preview-wrapper hidden mt-2"><img src="" alt="" class="image-preview block-preview-img"></div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">Alt-tekst <span class="text-red-400">*</span></label>
                    <input type="text" name="blocks[${idx}][alt]" value="${escapeHtml(existingAlt)}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Beschrijf de afbeelding">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">Bijschrift (optioneel)</label>
                    <input type="text" name="blocks[${idx}][caption]" value="${escapeHtml(existingCaption)}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Bijschrift onder de afbeelding...">
                </div>
                <div class="flex gap-4 items-end flex-wrap">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">Uitlijning</label>
                        <select name="blocks[${idx}][align]" onchange="updateWidthPlaceholder(this)"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white align-select">
                            <option value="center" ${existingAlign==='center'?'selected':''}>Gecentreerd</option>
                            <option value="left"   ${existingAlign==='left'  ?'selected':''}>Links (met tekst ernaast)</option>
                            <option value="right"  ${existingAlign==='right' ?'selected':''}>Rechts (met tekst ernaast)</option>
                            <option value="full"   ${existingAlign==='full'  ?'selected':''}>Volledige breedte</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">Breedte <span class="text-gray-400">(optioneel)</span></label>
                        <input type="text" name="blocks[${idx}][width]" value="${escapeHtml(existingWidth)}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-36 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white width-input"
                            placeholder="${defaultW}">
                        <p class="mt-1 text-xs text-gray-400">Standaard: <span class="default-width-hint">${defaultW}</span></p>
                    </div>
                </div>
            </div>
        `;

        setTimeout(() => {
            el.querySelector('.block-file-input')?.addEventListener('change', function () {
                const file = this.files[0]; if (!file) return;
                el.querySelector('.block-preview-img').src = URL.createObjectURL(file);
                el.querySelector('.block-preview-wrapper').classList.remove('hidden');
            });
        }, 0);
    }

    container.appendChild(el);
}

function updateWidthPlaceholder(selectEl) {
    const block = selectEl.closest('.block-item');
    const def = defaultWidths[selectEl.value] ?? '680px';
    const wi = block.querySelector('.width-input');
    const hi = block.querySelector('.default-width-hint');
    if (wi) wi.placeholder = def;
    if (hi) hi.textContent = def;
}

function updateTextImgWidthPlaceholder(selectEl) {
    const block = selectEl.closest('details');
    const def = defaultWidths[selectEl.value] ?? '40%';
    const wi = block.querySelector('.text-img-width-input');
    const hi = block.querySelector('.text-img-width-hint');
    if (wi) wi.placeholder = def;
    if (hi) hi.textContent = def;
}

function removeBlock(btn) {
    if (confirm('Verwijder dit blok?')) btn.closest('.block-item').remove();
}

function moveBlock(btn, direction) {
    const block = btn.closest('.block-item');
    if (direction === -1 && block.previousElementSibling) container.insertBefore(block, block.previousElementSibling);
    else if (direction === 1 && block.nextElementSibling)  container.insertBefore(block.nextElementSibling, block);
    renumberBlocks();
}

function renumberBlocks() {
    container.querySelectorAll('.block-item').forEach((block, newIdx) => {
        block.dataset.index = newIdx;
        block.querySelectorAll('[name]').forEach(input => {
            input.name = input.name.replace(/blocks\[\d+\]/, `blocks[${newIdx}]`);
        });
    });
}

function escapeHtml(str) {
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

existingBlocks.forEach(block => addBlock(block.type, block));
