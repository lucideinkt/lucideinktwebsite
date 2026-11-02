// Placeholders are layout-only: the source text and its annotation offsets stay unchanged.
export function inlineSymbolRanges(text) {
    const tokens = [...text.matchAll(/[^\s\ufffc\ufff9]+|[\ufffc\ufff9]+/gu)];
    const ranges = [];
    for (const [index, token] of tokens.entries()) {
        if (!/^[\ufffc\ufff9]+$/u.test(token[0])) continue;
        const neighbor = direction => {
            for (let i = index + direction; i >= 0 && i < tokens.length; i += direction) {
                const candidate = tokens[i];
                const between = text.slice(Math.min(token.index, candidate.index), Math.max(token.index, candidate.index));
                if (/[\r\n]/u.test(between)) return undefined;
                if (/[\p{L}\p{N}]/u.test(candidate[0])) return candidate;
            }
            return undefined;
        };
        const word = token[0].startsWith('\ufff9') ? neighbor(1) : neighbor(-1) ?? neighbor(1);
        if (word) ranges.push({
            start: Math.min(word.index, token.index),
            end: Math.max(word.index + word[0].length, token.index + token[0].length),
        });
    }
    const merged = [];
    for (const range of ranges.sort((a, b) => a.start - b.start)) {
        const previous = merged.at(-1);
        if (previous && range.start < previous.end) previous.end = Math.max(previous.end, range.end);
        else merged.push({ ...range });
    }
    return merged;
}

export function keepOrnamentsWithWords(page) {
    const blocks = 'p, h1, h2, h3, h4, h5, h6, li, td, th, div.text-arabic';
    const markers = '.cevsen-separator, .cevsen-verse-number, .prayer-verse-number, .arabic-waqf, .fn-ref, .sup-pointer, .honorific, .reader-inline-symbol';
    page.querySelectorAll(blocks).forEach(paragraph => {
        const walker = document.createTreeWalker(paragraph, NodeFilter.SHOW_TEXT);
        const raw = [];
        while (walker.nextNode()) {
            if (!walker.currentNode.parentElement.closest(markers)) raw.push(walker.currentNode);
        }
        for (const node of raw) {
            const matches = [...node.data.matchAll(/\u06dd[\u0660-\u0669\u06f0-\u06f9]*|[\u06de\ufd3e\ufd3f\ufdfa\ufdfb]/gu)];
            if (!matches.length) continue;
            const fragment = document.createDocumentFragment();
            let cursor = 0;
            for (const match of matches) {
                fragment.append(node.data.slice(cursor, match.index));
                const symbol = document.createElement('span');
                symbol.className = 'reader-inline-symbol';
                symbol.textContent = match[0];
                fragment.append(symbol);
                cursor = match.index + match[0].length;
            }
            fragment.append(node.data.slice(cursor));
            node.replaceWith(fragment);
        }
        const originalIds = new Set([...paragraph.querySelectorAll('[id]')].map(element => element.id));
        const layout = () => {
            const leaves = [];
            let text = '';
            const collect = node => {
                if (node.nodeType === Node.TEXT_NODE) {
                    leaves.push({ node, start: text.length, end: text.length + node.data.length });
                    text += node.data.replace(/[\r\n]/gu, ' ');
                } else if (node.nodeType === Node.ELEMENT_NODE) {
                    if (node.matches(markers)) {
                        leaves.push({ node, start: text.length, end: text.length + 1 });
                        text += node.textContent.trim() === '\ufd3f' ? '\ufff9' : '\ufffc';
                    } else if (node.matches(`br, img, ${blocks}`)) {
                        text += '\n';
                    } else node.childNodes.forEach(collect);
                }
            };
            paragraph.childNodes.forEach(collect);
            return { text, leaves };
        };
        // Recollect nodes after each extraction: styled words can share a source text node.
        for (const range of inlineSymbolRanges(layout().text).reverse()) {
            const { leaves } = layout();
            const start = leaves.find(leaf => leaf.start <= range.start && leaf.end > range.start);
            const end = leaves.findLast(leaf => leaf.start < range.end && leaf.end >= range.end);
            const group = start.node.parentElement.closest('.arabic-ornament-tail');
            if (group?.contains(end.node)) continue;
            const before = document.createRange();
            before.setStart(paragraph, 0);
            if (start.node.nodeType === Node.TEXT_NODE) before.setEnd(start.node, range.start - start.start);
            else before.setEndBefore(start.node);
            const prefix = before.extractContents();
            const tail = document.createRange();
            tail.setStart(paragraph, 0);
            if (end.node.nodeType === Node.TEXT_NODE) tail.setEnd(end.node, range.end - end.start - (start === end ? range.start - start.start : 0));
            else tail.setEndAfter(end.node);
            const wrapper = document.createElement('span');
            wrapper.className = 'arabic-ornament-tail';
            wrapper.append(tail.extractContents());
            paragraph.prepend(prefix, wrapper);
        }
        // Range extraction clones partial ancestors; an anchor belongs only to its first fragment.
        const seen = new Set();
        paragraph.querySelectorAll('[id]').forEach(element => {
            if (originalIds.has(element.id) && seen.has(element.id)) element.removeAttribute('id');
            else seen.add(element.id);
        });
    });
}
