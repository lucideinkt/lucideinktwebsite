export function readerBook() {
    const readerEl = document.getElementById('reader-content');
    if (!readerEl) return;

    // Returns true if the HTML string ends with a → continuation arrow
    function endsWithArrow(html) {
        const text = html.replace(/<[^>]*>/g, '').trim();
        return text.endsWith('→') || text.endsWith('\u2192');
    }

    // Collect continuation paragraphs from the start of a page's .page-footnote
    function getContinuationHtml(nextPage) {
        const fps = nextPage.querySelectorAll('.page-footnote .footnote-p');
        let html = '';
        let hasArrow = false;
        for (const fp of fps) {
            if (fp.querySelector('sup')) break;
            const clone = fp.cloneNode(true);
            if (endsWithArrow(clone.innerHTML.trim())) hasArrow = true;
            clone.innerHTML = clone.innerHTML.replace(/\s*→\s*$/g, '').replace(/\s*&rarr;\s*$/g, '');
            clone.classList.add('fn-popover__para');
            if (clone.innerHTML.trim()) html += clone.outerHTML;
        }
        return { html, hasArrow };
    }

    // ── Wire up footnote popovers for a SINGLE page ─────────────────────────
    // Tracks which pages have already been wired so we never double-process
    const wiredPages = new WeakSet();

    function wireFootnotesForPage(page) {
        if (wiredPages.has(page)) return;
        wiredPages.add(page);

        const footnoteMap = {};
        const arrowNums   = new Set();
        let currentNum    = null;

        page.querySelectorAll('.page-footnote .footnote-p').forEach(fp => {
            const supEl = fp.querySelector('sup');
            if (supEl) {
                currentNum = supEl.textContent.trim();
                const clone = fp.cloneNode(true);
                clone.querySelector('sup')?.remove();
                const html = clone.innerHTML.trim();
                if (endsWithArrow(html)) arrowNums.add(currentNum);
                clone.innerHTML = clone.innerHTML.replace(/\s*→\s*$/g, '').replace(/\s*&rarr;\s*$/g, '');
                clone.classList.add('fn-popover__para');
                if (currentNum && clone.innerHTML.trim()) footnoteMap[currentNum] = clone.outerHTML;
            } else if (currentNum) {
                const clone = fp.cloneNode(true);
                const html  = clone.innerHTML.trim();
                if (endsWithArrow(html)) arrowNums.add(currentNum);
                clone.innerHTML = clone.innerHTML.replace(/\s*→\s*$/g, '').replace(/\s*&rarr;\s*$/g, '');
                clone.classList.add('fn-popover__para');
                if (clone.innerHTML.trim()) footnoteMap[currentNum] += clone.outerHTML;
            }
        });

        if (!Object.keys(footnoteMap).length) return;

        page.querySelectorAll('sup').forEach(sup => {
            if (sup.closest('.page-footnote')) return;
            if (sup.closest('.fn-ref')) return;
            const num = sup.textContent.trim();
            if (!footnoteMap[num]) return;

            const btn = document.createElement('button');
            btn.className = 'fn-ref';
            btn.setAttribute('type', 'button');
            btn.setAttribute('aria-label', `Voetnoot ${num}`);
            btn.setAttribute('data-fn', num);
            btn.setAttribute('data-html', footnoteMap[num]);
            if (arrowNums.has(num)) btn.setAttribute('data-needs-continuation', 'true');
            btn.innerHTML = sup.outerHTML;

            const wrapper = document.createElement('span');
            wrapper.className = 'fn-ref-wrap';
            const prevNode = sup.previousSibling;
            if (prevNode && prevNode.nodeType === Node.TEXT_NODE) {
                const text = prevNode.textContent;
                const lastSpace = text.search(/\s\S*$/);
                if (lastSpace >= 0) {
                    const wordSpan = document.createElement('span');
                    wordSpan.className = 'fn-ref-word';
                    wordSpan.textContent = text.slice(lastSpace + 1);
                    prevNode.textContent = text.slice(0, lastSpace + 1);
                    wrapper.appendChild(wordSpan);
                }
            }
            wrapper.appendChild(btn);
            sup.replaceWith(wrapper);
        });

        resolveContinuations(page);
    }

    // ── Resolve continuation footnotes for a single page ────────────────────
    function resolveContinuations(scopePage) {
        const selector = '.fn-ref[data-needs-continuation]';
        const btns = scopePage
            ? scopePage.querySelectorAll(selector)
            : readerEl.querySelectorAll(selector);

        btns.forEach(btn => {
            const lastFetchedPageNum = btn.getAttribute('data-continuation-last-page');
            let searchStartPage = lastFetchedPageNum
                ? readerEl.querySelector(`.page#${lastFetchedPageNum}`)
                : btn.closest('.page');
            if (!searchStartPage) return;

            let nextPage = searchStartPage.nextElementSibling;
            while (nextPage && !nextPage.classList.contains('page')) {
                nextPage = nextPage.nextElementSibling;
            }
            if (!nextPage) return;

            const continuation = getContinuationHtml(nextPage);
            if (!continuation.html) {
                btn.removeAttribute('data-needs-continuation');
                btn.removeAttribute('data-continuation-last-page');
                return;
            }
            btn.setAttribute('data-html', btn.getAttribute('data-html') + continuation.html);
            btn.setAttribute('data-continuation-last-page', nextPage.getAttribute('id'));
            if (!continuation.hasArrow) {
                btn.removeAttribute('data-needs-continuation');
                btn.removeAttribute('data-continuation-last-page');
            }
        });
    }

    // ── Lazy wiring via IntersectionObserver ─────────────────────────────────
    // Wire each page's footnotes only when the page is within 150% of the viewport
    // (well before it scrolls into view) instead of wiring the entire book at once.
    const pageWireObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                wireFootnotesForPage(entry.target);
                pageWireObserver.unobserve(entry.target);
            }
        });
    }, { rootMargin: '150% 0px' });

    readerEl.querySelectorAll('.page').forEach(page => pageWireObserver.observe(page));

    // ── Watch for dynamically loaded pages (lazy-loaded books) ───────────────
    // Only watch direct children of readerEl — NOT subtree — to avoid firing on
    // every highlight / bookmark marker DOM change.
    const mutationObserver = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === Node.ELEMENT_NODE && node.classList?.contains('page')) {
                    // Observe the new page for lazy wiring
                    pageWireObserver.observe(node);
                    // Also resolve any pending continuations that may now have a next page
                    resolveContinuations();
                }
            });
        });
    });
    // childList only, no subtree — avoids firing on highlight/bookmark DOM mutations
    mutationObserver.observe(readerEl, { childList: true });

    // ── Persistent popover element (created once, reused on every click) ─────
    const popover = document.createElement('div');
    popover.className = 'fn-popover';
    popover.setAttribute('role', 'tooltip');
    popover.setAttribute('aria-live', 'polite');
    // Off-screen by default so measurement frame doesn't flash at 0,0
    popover.style.top  = '-9999px';
    popover.style.left = '-9999px';
    popover.hidden = true;
    document.body.appendChild(popover);

    let activeBtn = null;

    function showPopover(btn) {
        activeBtn?.classList.remove('fn-ref--active');
        activeBtn = btn;
        btn.classList.add('fn-ref--active');

        const fnNum = btn.dataset.fn || '';
        // Update content
        popover.innerHTML =
            `<button class="fn-popover__close" aria-label="Sluiten" type="button">&#215;</button>` +
            (fnNum ? `<span class="fn-popover__num" aria-hidden="true">${fnNum}</span>` : '') +
            `<div class="fn-popover__body"><div class="fn-popover__text">${btn.dataset.html}</div></div>`;

        popover.querySelector('.fn-popover__close').addEventListener('click', e => {
            e.stopPropagation();
            hidePopover();
        });

        // Make visible (but not yet animated) so the browser can compute dimensions
        popover.hidden = false;
        popover.classList.remove('fn-popover--show');

        // Position + animate in next paint — a single rAF is enough since
        // hidden=false already triggered a style recalc before this rAF runs
        requestAnimationFrame(() => {
            positionPopover(btn);
            popover.classList.add('fn-popover--show');
        });
    }

    function hidePopover() {
        if (!activeBtn && popover.hidden) return;
        popover.classList.remove('fn-popover--show');
        activeBtn?.classList.remove('fn-ref--active');
        activeBtn = null;
        // Wait for CSS transition to finish before hiding
        setTimeout(() => { if (!activeBtn) popover.hidden = true; }, 200);
    }

    function positionPopover(btn) {
        const rect   = btn.getBoundingClientRect();
        const PW     = popover.offsetWidth;
        const PH     = popover.offsetHeight;
        const VW     = window.innerWidth;
        const VH     = window.innerHeight;
        const MARGIN = 10;

        let left = rect.left + rect.width / 2 - PW / 2;
        left = Math.max(MARGIN, Math.min(left, VW - PW - MARGIN));

        let top = rect.top - PH - 8;
        if (top < MARGIN) top = rect.bottom + 8;
        top = Math.max(MARGIN, Math.min(top, VH - PH - MARGIN));

        popover.style.top  = top  + 'px';
        popover.style.left = left + 'px';
    }

    // ── Event delegation ──────────────────────────────────────────────────
    readerEl.addEventListener('click', e => {
        const btn = e.target.closest('.fn-ref')
            ?? e.target.closest('.fn-ref-word')?.closest('.fn-ref-wrap')?.querySelector('.fn-ref');
        if (btn) {
            e.preventDefault();
            e.stopPropagation();
            if (btn === activeBtn) { hidePopover(); return; }
            showPopover(btn);
            return;
        }
        if (!popover.hidden && !popover.contains(e.target)) {
            hidePopover();
            e.stopImmediatePropagation();
        }
    });

    document.addEventListener('click', e => {
        if (!popover.hidden && !readerEl.contains(e.target) && !popover.contains(e.target)) {
            hidePopover();
        }
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') hidePopover();
    });

    // Reposition on scroll/resize using rAF to avoid layout thrashing
    let _posRaf = false;
    function scheduleReposition() {
        if (_posRaf || popover.hidden || !activeBtn) return;
        _posRaf = true;
        requestAnimationFrame(() => {
            _posRaf = false;
            if (!popover.hidden && activeBtn) positionPopover(activeBtn);
        });
    }
    window.addEventListener('scroll', scheduleReposition, { passive: true });
    window.addEventListener('resize', scheduleReposition);
}
