import { markPrayerText } from './prayer-text.js';

export function readerBook() {
    const readerEl = document.getElementById('reader-content');
    if (!readerEl) return;

    // Browser hyphenation dictionaries miss many Dutch compounds, which leaves wide
    // gaps in justified lines. Insert explicit soft hyphens (same approach as the app);
    // highlight offsets, search and copy ignore U+00AD.
    const hyphenatorReady = import('hyphen/nl').then(m => m.hyphenateSync).catch(() => null);
    const hyphenSkipSelector = '[class*="arabic"], [lang^="ar"], h1, h2, h3, h4, h5, h6, .text-center, script, style, button';

    function hyphenatePage(page) {
        hyphenatorReady.then(hyphenateSync => {
            if (!hyphenateSync) return;
            const walker = document.createTreeWalker(page, NodeFilter.SHOW_TEXT, {
                acceptNode: node => /[A-Za-zÀ-ÿ]{6}/.test(node.data) && !/[\u0600-\u06FF]/.test(node.data)
                    && !node.parentElement?.closest(hyphenSkipSelector)
                    ? NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_REJECT,
            });
            const nodes = [];
            while (walker.nextNode()) nodes.push(walker.currentNode);
            nodes.forEach(node => {
                const hyphenated = hyphenateSync(node.data, { html: false, minWordLength: 6 });
                if (hyphenated !== node.data) node.data = hyphenated;
            });
        });
    }

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
    const textFootnotes = new WeakMap();
    let badgeCenterRaf = false;

    function centerBadgeNumber(numEl) {
        const badgeEl = numEl.closest('.fn-ref, .sup-pointer');
        if (!badgeEl || !numEl.isConnected) return;

        numEl.style.setProperty('--badge-num-shift-x', '0px');
        numEl.style.setProperty('--badge-num-shift-y', '0px');

        const range = document.createRange();
        range.selectNodeContents(numEl);
        const glyphRect = range.getBoundingClientRect();
        const badgeRect = badgeEl.getBoundingClientRect();
        range.detach?.();

        if ((!glyphRect.width && !glyphRect.height) || !badgeRect.width || !badgeRect.height) return;

        const badgeCenterX = badgeRect.left + (badgeRect.width / 2);
        const badgeCenterY = badgeRect.top + (badgeRect.height / 2);
        const glyphCenterX = glyphRect.left + (glyphRect.width / 2);
        const glyphCenterY = glyphRect.top + (glyphRect.height / 2);

        numEl.style.setProperty('--badge-num-shift-x', `${(badgeCenterX - glyphCenterX).toFixed(2)}px`);
        numEl.style.setProperty('--badge-num-shift-y', `${(badgeCenterY - glyphCenterY).toFixed(2)}px`);
    }

    function centerBadgeNumbers() {
        readerEl.querySelectorAll('.fn-ref-num, .sup-pointer-num').forEach(centerBadgeNumber);
    }

    function scheduleBadgeCentering() {
        if (badgeCenterRaf) return;
        badgeCenterRaf = true;
        requestAnimationFrame(() => {
            badgeCenterRaf = false;
            flowCenteredBreaks();
            centerBadgeNumbers();
        });
    }

    function queueBadgeCentering() {
        scheduleBadgeCentering();
        document.fonts?.ready?.then(() => {
            scheduleBadgeCentering();
        });
    }

    // A hard break in a centred Dutch paragraph is layout for wide pages. When a segment wraps on its own
    // anyway (mobile), the break only adds a ragged extra line, so it is hidden and the lines are balanced.
    function flowCenteredBreaks() {
        readerEl.querySelectorAll('p:not(.text-arabic)').forEach(block => {
            if (!block.querySelector('br') || block.querySelector('.text-arabic, .arabic-short, .arabic-chunk')) return;
            if (getComputedStyle(block).textAlign !== 'center') return;
            block.querySelectorAll('br:not(.soft-br, .hard-br)').forEach(br => {
                const before = document.createRange();
                before.setStart(block, 0);
                before.setEndBefore(br);
                // A break after punctuation ends a verse or sentence and stays.
                const soft = /[\p{L}\p{N}]$/u.test(before.toString().trimEnd());
                br.classList.add(soft ? 'soft-br' : 'hard-br');
                if (soft && (br.nextSibling?.nodeType !== Node.TEXT_NODE || !/^\s/.test(br.nextSibling.textContent))) br.after(' ');
            });
            block.classList.remove('break-flow');
            const style = getComputedStyle(block);
            const lineHeight = parseFloat(style.lineHeight) || parseFloat(style.fontSize) * 1.5;
            const nodes = [...block.childNodes];
            const range = document.createRange();
            let from = 0;
            const wraps = [...nodes.map((node, index) => node.nodeName === 'BR' ? index : -1).filter(index => index >= 0), nodes.length]
                .some(end => {
                    range.setStart(block, from);
                    range.setEnd(block, end);
                    from = end + 1;
                    const tops = [...range.getClientRects()].filter(rect => rect.width > 0).map(rect => rect.top);
                    return tops.length > 1 && Math.max(...tops) - Math.min(...tops) > lineHeight / 2;
                });
            block.classList.toggle('break-flow', wraps);
        });
    }

    function normalizeLegacySupPointers(page) {
        page.querySelectorAll('.sup-pointer').forEach(pointer => {
            if (pointer.querySelector('.sup-pointer-num')) return;
            const num = pointer.textContent.trim();
            if (!num) return;
            pointer.textContent = '';
            const numSpan = document.createElement('span');
            numSpan.className = 'sup-pointer-num';
            numSpan.setAttribute('aria-hidden', 'true');
            numSpan.textContent = num;
            pointer.appendChild(numSpan);
        });
    }

    // A hard <br> right before an inline Arabic quote (optionally via a footnote marker) is
    // source layout; it would leave a short ragged line, so let the quote continue the line.
    function joinBreaksBeforeInlineArabic(page) {
        page.querySelectorAll('br').forEach(br => {
            let next = br.nextSibling;
            while (next && ((next.nodeType === Node.TEXT_NODE && !next.textContent.trim())
                || (next.nodeType === Node.ELEMENT_NODE && (next.matches('sup, .fn-ref, .sup-pointer'))))) next = next.nextSibling;
            if (!next || next.nodeType !== Node.ELEMENT_NODE || !next.matches('.text-arabic-inline')) return;
            const prev = br.previousSibling;
            if (!prev || prev.nodeName === 'BR') return;
            if (/\s$/.test(prev.textContent || '')) br.remove();
            else br.replaceWith(' ');
        });
    }

    // Short inline Arabic phrases must never wrap or get stretched by justification.
    // Multi-word plain-text phrases are split into unbreakable single words so a justified
    // line can break between any two Arabic words instead of leaving wide gaps.
    function markShortInlineArabic(page) {
        page.querySelectorAll('.text-arabic-inline').forEach(el => {
            const words = el.textContent.trim().split(/\s+/).filter(Boolean);
            if (!words.length) return;
            if (words.length === 1 || el.children.length) {
                if (words.length <= 4) el.classList.add('text-arabic-inline--short');
                return;
            }
            const chunks = words.map(word => [word]);
            el.textContent = '';
            chunks.forEach((chunk, index) => {
                if (index) el.append(' ');
                const span = document.createElement('span');
                span.className = 'text-arabic-chunk';
                span.textContent = chunk.join(' ');
                el.appendChild(span);
            });
        });
    }

    // Verse ornaments (۞ ﴾ ﴿) in running Arabic get the same muted colour as Cevsen separators.
    function markArabicOrnaments(page) {
        page.querySelectorAll('.text-arabic, .text-arabic-inline').forEach(el => {
            const walker = document.createTreeWalker(el, NodeFilter.SHOW_TEXT);
            const nodes = [];
            while (walker.nextNode()) {
                const node = walker.currentNode;
                if (/[\u06DE\uFD3E\uFD3F]/.test(node.data) && !node.parentElement.closest('.cevsen-separator')) nodes.push(node);
            }
            nodes.forEach(node => {
                const frag = document.createDocumentFragment();
                node.data.split(/([\u06DE\uFD3E\uFD3F])/).forEach((part, index) => {
                    if (index % 2) {
                        const span = document.createElement('span');
                        span.className = 'cevsen-separator';
                        span.textContent = part;
                        frag.appendChild(span);
                    } else if (part) frag.append(part);
                });
                node.replaceWith(frag);
            });
        });
        page.querySelectorAll('.cevsen-separator').forEach(ornament => {
            const previous = ornament.previousSibling;
            if (previous?.nodeType === Node.TEXT_NODE && /\s$/.test(previous.data)) {
                previous.data = previous.data.replace(/\s+$/, '\u00A0');
            }
        });
    }

    // Every line holding inline Arabic gets the same, symmetric extra space above and below,
    // sized for the tallest marks and deepest letters in the book, so no letter ever touches
    // the neighbouring lines and all Arabic lines look alike. The margins are calc() expressions
    // on the font-size variables, so they follow both font sliders without re-measuring.
    const ARABIC_INK_ABOVE = 1.05; // highest mark above the baseline, in Arabic em
    const ARABIC_INK_BELOW = 0.75; // deepest letter below the baseline, in Arabic em
    const ARABIC_LINE_GAP = 0.1;   // minimum clearance to the neighbouring line, in Latin em
    const fontMetricsCache = new Map();
    const fontMetricsCanvas = document.createElement('canvas').getContext('2d');
    async function fontMetrics(family) {
        if (fontMetricsCache.has(family)) return fontMetricsCache.get(family);
        const font = `100px ${family}`;
        try { await document.fonts.load(font); } catch {}
        fontMetricsCanvas.font = font;
        const box = fontMetricsCanvas.measureText('H');
        const metrics = {
            ascent: box.fontBoundingBoxAscent / 100,
            descent: box.fontBoundingBoxDescent / 100,
            inkAscent: fontMetricsCanvas.measureText('bdfhklH').actualBoundingBoxAscent / 100,
            inkDescent: fontMetricsCanvas.measureText('gjpqy').actualBoundingBoxDescent / 100,
        };
        if (!metrics.ascent) return null;
        fontMetricsCache.set(family, metrics);
        return metrics;
    }
    async function fitInlineArabicBoxes(page) {
        const boxes = page.querySelectorAll('.text-arabic-inline--short, .text-arabic-chunk, .fn-arabic-tail');
        const fixed = n => n.toFixed(4);
        for (const el of boxes) {
            const block = el.parentElement?.closest(':not(.text-arabic-inline):not(.fn-arabic-inline):not(.text-arabic-chunk):not(.fn-arabic-tail)');
            if (!block) continue;
            const blockStyle = getComputedStyle(block);
            const [latin, arabic] = await Promise.all([fontMetrics(blockStyle.fontFamily), fontMetrics(getComputedStyle(el).fontFamily)]);
            if (!latin || !arabic) continue;
            const size = parseFloat(blockStyle.fontSize);
            const ratio = (parseFloat(blockStyle.lineHeight) || (latin.ascent + latin.descent) * size) / size;
            const sliderSize = parseFloat(blockStyle.getPropertyValue('--reader-font-size'));
            const latinLength = k => sliderSize
                ? `var(--reader-font-size) * ${fixed(k * size / sliderSize)}`
                : `${fixed(k * size)}px`;
            // Ink is sized on the regular Arabic size, so smaller honorifics get the same lines.
            const arabicLength = k => `var(--reader-arabic-font-size, 1em) * ${k}`;
            const halfLeading = (ratio - latin.ascent - latin.descent) / 2;
            const extra = `max(${arabicLength(ARABIC_INK_ABOVE)} + ${latinLength(ARABIC_LINE_GAP + latin.inkDescent - ratio)}, `
                + `${arabicLength(ARABIC_INK_BELOW)} + ${latinLength(ARABIC_LINE_GAP + latin.inkAscent - ratio)}, 0px)`;
            el.style.setProperty('line-height', fixed(arabic.ascent + arabic.descent), 'important');
            el.style.marginTop = `calc(${latinLength(latin.ascent + halfLeading)} + ${extra} - ${fixed(arabic.ascent)}em)`;
            el.style.marginBottom = `calc(${latinLength(latin.descent + halfLeading)} + ${extra} - ${fixed(arabic.descent)}em)`;
        }
    }

    document.addEventListener('reader-layout-change', () => {
        Promise.all([...readerEl.querySelectorAll('.page')].map(fitInlineArabicBoxes))
            .catch(error => {
                console.error('Arabische regelafstand kon niet worden bijgewerkt.', error);
                window.showToast?.('De Arabische regelafstand kon niet worden bijgewerkt.', 'error');
            });
    });

    function normalizeServerRenderedFnRefs(page) {
        page.querySelectorAll('.fn-ref').forEach(btn => {
            if (btn.querySelector('.fn-ref-num')) return;
            const num = (btn.getAttribute('data-fn') || btn.textContent || '').trim();
            if (!num) return;
            btn.textContent = '';
            const numSpan = document.createElement('span');
            numSpan.className = 'fn-ref-num';
            numSpan.setAttribute('aria-hidden', 'true');
            numSpan.textContent = num;
            btn.appendChild(numSpan);
        });
    }

    function wireFootnoteText(page) {
        const arabicSelector = '[lang="ar"], .text-arabic, .text-arabic-inline, .text-arabic-bismillah';
        const meaningfulSibling = (node, direction) => {
            let sibling = node[direction];
            while (sibling && sibling.nodeType === Node.TEXT_NODE && !sibling.textContent.trim()) {
                sibling = sibling[direction];
            }
            return sibling;
        };
        const mark = (element, btn) => {
            if (!element || element.closest('a, .page-footnote') || textFootnotes.has(element)) return;
            textFootnotes.set(element, btn);
            element.classList.add('fn-ref-text');
            element.setAttribute('role', 'button');
            element.setAttribute('tabindex', '0');
            element.setAttribute('aria-label', `Open voetnoot ${btn.dataset.fn}`);
        };
        const markLastWord = (node, btn) => {
            if (!node) return;
            if (node.nodeType === Node.ELEMENT_NODE) {
                if (node.matches('a, button, .fn-ref-wrap')) return;
                let child = node.lastChild;
                while (child?.nodeType === Node.TEXT_NODE && !child.textContent.trim()) child = child.previousSibling;
                markLastWord(child, btn);
                return;
            }
            if (node.nodeType !== Node.TEXT_NODE) return;
            const match = /(\S+)(\s*)$/.exec(node.textContent);
            if (!match) return;
            const word = document.createElement('span');
            word.textContent = match[1];
            const trailing = document.createTextNode(match[2]);
            node.textContent = node.textContent.slice(0, match.index);
            node.after(word, trailing);
            mark(word, btn);
        };
        page.querySelectorAll('.fn-ref').forEach(btn => {
            const wrapper = btn.closest('.fn-ref-wrap');
            const anchor = wrapper || btn;
            const paragraph = btn.closest(arabicSelector);
            const before = meaningfulSibling(anchor, 'previousSibling');
            const after = meaningfulSibling(anchor, 'nextSibling');
            const citation = paragraph?.matches('span') ? paragraph :
                after?.nodeType === Node.ELEMENT_NODE && after.matches(`span:is(${arabicSelector})`) ? after :
                before?.nodeType === Node.ELEMENT_NODE && before.matches(`span:is(${arabicSelector})`) ? before : null;
            if (citation) {
                mark(citation, btn);
                const group = document.createElement('span');
                group.className = 'fn-arabic-inline';
                citation.before(group);
                group.append(citation, btn);
                // Long phrases may wrap between words (like the app); only the last word stays with the badge.
                const lastChunk = citation.querySelector('.text-arabic-chunk:last-child');
                if (lastChunk) {
                    lastChunk.classList.add('fn-arabic-tail');
                    lastChunk.append(btn);
                    group.classList.add('fn-arabic-inline--wrap');
                } else if (!citation.classList.contains('text-arabic-inline--short')) {
                    const walker = document.createTreeWalker(citation, NodeFilter.SHOW_TEXT);
                    let lastText = null;
                    while (walker.nextNode()) if (walker.currentNode.textContent.trim()) lastText = walker.currentNode;
                    const match = lastText && /(\S+)(\s*)$/.exec(lastText.textContent);
                    if (match) {
                        const tail = document.createElement('span');
                        tail.className = 'fn-arabic-tail';
                        tail.textContent = match[1];
                        lastText.textContent = lastText.textContent.slice(0, match.index);
                        lastText.after(tail);
                        tail.append(btn);
                        group.classList.add('fn-arabic-inline--wrap');
                    }
                }
                if (wrapper?.isConnected) {
                    if (wrapper.contains(group)) wrapper.replaceWith(group);
                    else wrapper.replaceWith(...wrapper.childNodes);
                }
                return;
            }
            if (paragraph && paragraph.querySelectorAll('.fn-ref').length === 1) {
                mark(paragraph, btn);
                return;
            }
            if (after?.nodeType === Node.ELEMENT_NODE && after.matches(arabicSelector)) mark(after, btn);
            else if (before?.nodeType === Node.ELEMENT_NODE && before.matches(`${arabicSelector}, img`)) mark(before, btn);
            else if (wrapper?.querySelector('.fn-ref-word')) mark(wrapper.querySelector('.fn-ref-word'), btn);
            else markLastWord(before, btn);
        });
    }

    function themeBismillahImages(page) {
        page.querySelectorAll('img.bismillah-svg').forEach(image => {
            const wrapper = document.createElement('span');
            wrapper.className = image.className + ' reader-themed-image';
            wrapper.style.setProperty('--image-mask', `url(${JSON.stringify(image.src)})`);
            image.className = '';
            image.replaceWith(wrapper);
            wrapper.appendChild(image);
        });
    }

    function wireFootnotesForPage(page) {
        if (wiredPages.has(page)) return;
        wiredPages.add(page);

        themeBismillahImages(page);
        normalizeLegacySupPointers(page);
        normalizeServerRenderedFnRefs(page);
        joinBreaksBeforeInlineArabic(page);
        markShortInlineArabic(page);
        markPrayerText(page, readerEl.dataset.bookSlug);
        markArabicOrnaments(page);
        hyphenatePage(page);

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

        if (!Object.keys(footnoteMap).length) {
            wireFootnoteText(page);
            fitInlineArabicBoxes(page);
            return;
        }

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
            btn.innerHTML = `<span class="fn-ref-num" aria-hidden="true">${num}</span>`;

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

        wireFootnoteText(page);
        fitInlineArabicBoxes(page).then(queueBadgeCentering);
        resolveContinuations(page);
        queueBadgeCentering();
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

    document.addEventListener('copy', e => {
        const selection = window.getSelection();
        const text = selection?.toString() || '';
        if (!text.includes('\u00AD') || !readerEl.contains(selection.anchorNode)) return;
        e.clipboardData.setData('text/plain', text.replace(/\u00AD/g, ''));
        e.preventDefault();
    });

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
    function footnoteButtonForTarget(target) {
        const badge = target.closest('.fn-ref');
        if (badge) return badge;
        if (target.closest('a')) return null;
        for (let element = target; element && element !== readerEl; element = element.parentElement) {
            const btn = textFootnotes.get(element);
            if (btn) return btn;
        }
        return null;
    }

    readerEl.addEventListener('click', e => {
        const btn = footnoteButtonForTarget(e.target);
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

    readerEl.addEventListener('keydown', e => {
        if (e.key !== 'Enter' && e.key !== ' ') return;
        if (!textFootnotes.has(e.target)) return;
        e.preventDefault();
        e.target.click();
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
    window.addEventListener('resize', () => {
        scheduleReposition();
        queueBadgeCentering();
    });
    document.fonts?.addEventListener?.('loadingdone', queueBadgeCentering);
    queueBadgeCentering();
}
