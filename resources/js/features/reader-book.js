export function readerBook() {
    const readerEl = document.getElementById('reader-content');
    if (!readerEl) return;

    // Returns true if the HTML string ends with a → continuation arrow
    function endsWithArrow(html) {
        // Strip trailing whitespace / tags to find the last visible character
        const text = html.replace(/<[^>]*>/g, '').trim();
        return text.endsWith('→') || text.endsWith('\u2192');
    }

    // Collect continuation paragraphs (footnote-p without <sup>) from the start of
    // a page's .page-footnote, until we hit one that DOES have a <sup>.
    // Returns an object: { html: string, hasArrow: boolean }
    function getContinuationHtml(nextPage) {
        const fps = nextPage.querySelectorAll('.page-footnote .footnote-p');
        let html = '';
        let hasArrow = false;

        for (const fp of fps) {
            if (fp.querySelector('sup')) break; // reached the next numbered footnote

            // Clone the entire element to preserve classes like text-bold
            const clone = fp.cloneNode(true);
            let fpHtml = clone.innerHTML.trim();

            // Check if this paragraph ends with arrow before stripping
            if (endsWithArrow(fpHtml)) {
                hasArrow = true;
            }

            // Remove arrow characters from the clone
            clone.innerHTML = clone.innerHTML.replace(/\s*→\s*$/g, '').replace(/\s*&rarr;\s*$/g, '');

            // Add the popover class to preserve styling
            clone.classList.add('fn-popover__para');

            if (clone.innerHTML.trim()) {
                html += clone.outerHTML;
            }
        }

        return { html, hasArrow };
    }

    // ── Wire up footnote popovers for every .page ──────────────────────────
    function wireFootnotes(scope) {
        scope = scope || readerEl;

        scope.querySelectorAll('.page').forEach(page => {
            // Build a map: footnote number → HTML string (all paragraphs belonging to that note)
            const footnoteMap = {};
            const arrowNums   = new Set(); // footnote numbers whose last para ends with →
            let currentNum = null;

            page.querySelectorAll('.page-footnote .footnote-p').forEach(fp => {
                const supEl = fp.querySelector('sup');

                if (supEl) {
                    // New numbered footnote — start a fresh entry
                    currentNum = supEl.textContent.trim();
                    const clone = fp.cloneNode(true);
                    const firstSup = clone.querySelector('sup');
                    if (firstSup) firstSup.remove();

                    // Get the inner HTML to check for arrows
                    let html = clone.innerHTML.trim();

                    // Check for arrow BEFORE removing it
                    if (endsWithArrow(html)) {
                        arrowNums.add(currentNum);
                    }

                    // Remove arrow characters from the clone
                    clone.innerHTML = clone.innerHTML.replace(/\s*→\s*$/g, '').replace(/\s*&rarr;\s*$/g, '');

                    // Add the popover class to preserve styling
                    clone.classList.add('fn-popover__para');

                    if (currentNum && clone.innerHTML.trim()) {
                        footnoteMap[currentNum] = clone.outerHTML;
                    }
                } else if (currentNum) {
                    // Continuation paragraph on the same page
                    const clone = fp.cloneNode(true);
                    let html = clone.innerHTML.trim();

                    // Check for arrow BEFORE removing it
                    if (endsWithArrow(html)) {
                        arrowNums.add(currentNum);
                    }

                    // Remove arrow characters from the clone
                    clone.innerHTML = clone.innerHTML.replace(/\s*→\s*$/g, '').replace(/\s*&rarr;\s*$/g, '');

                    // Add the popover class to preserve styling
                    clone.classList.add('fn-popover__para');

                    if (clone.innerHTML.trim()) {
                        footnoteMap[currentNum] += clone.outerHTML;
                    }
                }
            });


            if (!Object.keys(footnoteMap).length) return;

            // Find all <sup> in the page body (NOT inside .page-footnote)
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

                if (arrowNums.has(num)) {
                    // Mark as needing continuation from the next page
                    btn.setAttribute('data-needs-continuation', 'true');
                }

                btn.innerHTML = sup.outerHTML;
                sup.replaceWith(btn);
            });
        });

        // After wiring, try to resolve any pending continuation buttons
        resolveContinuations();
    }

    // ── Resolve continuation footnotes ────────────────────────────────────
    // For every .fn-ref[data-needs-continuation] button, find the next .page
    // sibling and append its leading (unnumbered) footnote-p paragraphs.
    function resolveContinuations() {
        readerEl.querySelectorAll('.fn-ref[data-needs-continuation]').forEach(btn => {
            // Get the page we need to look at for continuation
            // If we've already fetched from some pages, use the last one
            const lastFetchedPageNum = btn.getAttribute('data-continuation-last-page');
            let searchStartPage;

            if (lastFetchedPageNum) {
                // Find the page with this number
                searchStartPage = readerEl.querySelector(`.page#${lastFetchedPageNum}`);
            } else {
                // First time - start from the page containing the button
                searchStartPage = btn.closest('.page');
            }

            if (!searchStartPage) return;

            // Find the next .page sibling in the DOM
            let nextPage = searchStartPage.nextElementSibling;
            while (nextPage && !nextPage.classList.contains('page')) {
                nextPage = nextPage.nextElementSibling;
            }
            if (!nextPage) return; // next page not loaded yet — will retry on next MutationObserver tick

            const continuation = getContinuationHtml(nextPage);
            if (!continuation.html) {
                // No continuation found on next page — remove the marker so we stop retrying
                btn.removeAttribute('data-needs-continuation');
                btn.removeAttribute('data-continuation-last-page');
                return;
            }

            // Append continuation HTML
            btn.setAttribute('data-html', btn.getAttribute('data-html') + continuation.html);

            // Track which page we just fetched from
            const nextPageId = nextPage.getAttribute('id');
            btn.setAttribute('data-continuation-last-page', nextPageId);

            // Only remove the marker if this is the final continuation (no arrow in continuation)
            if (!continuation.hasArrow) {
                btn.removeAttribute('data-needs-continuation');
                btn.removeAttribute('data-continuation-last-page');
            }
            // If continuation still has an arrow, keep the marker so we'll check the next page too
        });
    }

    wireFootnotes();

    // ── Watch for dynamically loaded pages ────────────────────────────────
    // When new pages are added to the DOM (lazy loading), wire their footnotes
    // and try to resolve any pending continuations
    const observer = new MutationObserver(mutations => {
        let hasNewPages = false;
        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === Node.ELEMENT_NODE && node.classList?.contains('page')) {
                    hasNewPages = true;
                }
            });
        });
        if (hasNewPages) {
            wireFootnotes();
        }
    });
    observer.observe(readerEl, { childList: true, subtree: true });

    // ── Popover ────────────────────────────────────────────────────────────
    let popover = null;
    let activeBtn = null;


    function showPopover(btn) {
        hidePopover();
        activeBtn = btn;
        btn.classList.add('fn-ref--active');

        const num  = btn.dataset.fn;
        const html = btn.dataset.html;

        popover = document.createElement('div');
        popover.className = 'fn-popover';
        popover.setAttribute('role', 'tooltip');
        popover.setAttribute('aria-live', 'polite');
        popover.innerHTML =
            `<button class="fn-popover__close" aria-label="Sluiten" type="button">&#215;</button>` +
            `<div class="fn-popover__body">` +
                `<div class="fn-popover__text">${html}</div>` +
            `</div>`;

        document.body.appendChild(popover);
        // First position with real DOM dimensions
        positionPopover(btn);

        popover.querySelector('.fn-popover__close').addEventListener('click', e => {
            e.stopPropagation();
            hidePopover();
        });

        requestAnimationFrame(() => requestAnimationFrame(() => {
            popover?.classList.add('fn-popover--show');
            // Reposition after transition so final painted size is clamped correctly
            if (popover && btn) positionPopover(btn);
        }));
    }

    function positionPopover(btn) {
        if (!popover) return;


        // Reset any inline position so offsetWidth/Height are accurate
        popover.style.top  = '0px';
        popover.style.left = '0px';

        const rect   = btn.getBoundingClientRect();
        const PW     = popover.offsetWidth;
        const PH     = popover.offsetHeight;
        const VW     = window.innerWidth;
        const VH     = window.innerHeight;
        const MARGIN = 10;

        // Horizontal: centre on the superscript, then clamp within viewport
        let left = rect.left + rect.width / 2 - PW / 2;
        left = Math.max(MARGIN, Math.min(left, VW - PW - MARGIN));

        // Vertical: prefer above the superscript, fall back to below
        let top = rect.top - PH - 8;
        if (top < MARGIN) top = rect.bottom + 8;

        // Final clamp — make sure it never goes below the viewport bottom
        top = Math.max(MARGIN, Math.min(top, VH - PH - MARGIN));

        popover.style.top  = top + 'px';
        popover.style.left = left + 'px';
    }

    function hidePopover() {
        if (!popover) return;
        popover.classList.remove('fn-popover--show');
        activeBtn?.classList.remove('fn-ref--active');
        const el = popover;
        setTimeout(() => el.remove(), 200);
        popover    = null;
        activeBtn  = null;
    }

    // ── Event delegation ──────────────────────────────────────────────────
    readerEl.addEventListener('click', e => {
        const btn = e.target.closest('.fn-ref');
        if (btn) {
            e.preventDefault();
            e.stopPropagation();
            if (btn === activeBtn) {
                hidePopover();
                return;
            }
            showPopover(btn);
            return;
        }
        // Click anywhere else in the reader closes popover
        if (popover && !popover.contains(e.target)) {
            hidePopover();
        }
    });

    // Close on outside-reader click (anywhere on the page)
    document.addEventListener('click', e => {
        if (popover && !readerEl.contains(e.target) && !popover.contains(e.target)) {
            hidePopover();
        }
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') hidePopover();
    });

    // Reposition on scroll/resize
    window.addEventListener('scroll', () => { if (popover && activeBtn) positionPopover(activeBtn); }, { passive: true });
    window.addEventListener('resize', () => { if (popover && activeBtn) positionPopover(activeBtn); });
}
