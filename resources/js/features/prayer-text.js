// Keep matching on normalized copies; source text and annotation offsets never change.
export function prayerAccentRanges(text, slug) {
    if (!['namaz-tesbihati', 'cevsen-ul-kebir'].includes(slug)) return [];
    const fold = word => word.normalize('NFKD').replace(/[\p{M}\u0640]/gu, '').replaceAll('ٱ', 'ا');
    const words = [...text.matchAll(/[\p{L}\p{M}]+/gu)].map(match => ({
        value: fold(match[0]), start: match.index, end: match.index + match[0].length,
    }));
    const ranges = [];
    const allah = word => /^(?:[وف]?[بكت]?الله|[وف]?لله|[وف]?اللهم)$/.test(word);
    const vocative = word => ['يا', 'ياذا', 'يامجيب', 'ياخالق'].includes(word);
    const adjacent = (a, b) => /^\s*$/.test(text.slice(words[a].end, words[b].start));
    for (let i = 0; i < words.length; i++) {
        const word = words[i];
        if (slug === 'cevsen-ul-kebir') {
            const next = words[i + 1]?.value;
            const afterNext = words[i + 2]?.value;
            const refrainAccent = word.value === 'يا' && next === 'لا' && afterNext === 'اله'
                || ['خلصنا', 'نجنا'].includes(word.value) && next === 'من' && afterNext === 'النار';
            if (refrainAccent && adjacent(i, i + 1) && adjacent(i + 1, i + 2)) {
                ranges.push({ start: word.start, end: word.end });
            }
        }
        const followsYa = i > 0 && words[i - 1].value === 'يا' && adjacent(i - 1, i);
        if (allah(word.value) && !followsYa) ranges.push({ start: word.start, end: word.end });
        if (!vocative(word.value)) continue;
        const attached = word.value !== 'يا';
        const headIndex = attached ? i : i + 1;
        if (!words[headIndex] || !attached && !adjacent(i, headIndex)) continue;
        const head = attached ? word.value.slice(2) : words[headIndex].value;
        // Keep linking words and the repeated "yā ALLAH" quiet, as in the printed layout.
        if (['لا', 'ليتني', 'رسول', 'امين', 'من', 'ذا'].includes(head) || allah(head)
            || head === 'حبيب' && words[headIndex + 1] && allah(words[headIndex + 1].value)) continue;
        const start = attached
            ? word.start + (text.slice(word.start, word.end).match(/^(?:\p{M}*\p{L}){2}\p{M}*/u)?.[0].length ?? 0)
            : words[headIndex].start;
        ranges.push({ start, end: words[headIndex].end });
    }
    const merged = [];
    for (const range of ranges.sort((a, b) => a.start - b.start)) {
        const previous = merged.at(-1);
        if (previous && range.start <= previous.end) previous.end = Math.max(previous.end, range.end);
        else merged.push({ ...range });
    }
    return merged;
}

export function markPrayerText(page, slug) {
    if (!['namaz-tesbihati', 'cevsen-ul-kebir'].includes(slug)) return;
    const verseWalker = document.createTreeWalker(page, NodeFilter.SHOW_TEXT);
    const verseNodes = [];
    while (verseWalker.nextNode()) {
        const node = verseWalker.currentNode;
        if (/\u06dd[\u0660-\u0669\u06f0-\u06f9]+/u.test(node.data)
            && !node.parentElement.closest('.prayer-verse-number')) verseNodes.push(node);
    }
    for (const node of verseNodes) {
        const fragment = document.createDocumentFragment();
        let cursor = 0;
        for (const match of node.data.matchAll(/\u06dd([\u0660-\u0669\u06f0-\u06f9]+)/gu)) {
            fragment.append(node.data.slice(cursor, match.index));
            const number = document.createElement('span');
            number.className = 'prayer-verse-number cevsen-verse-number';
            const sign = document.createElement('span');
            sign.className = 'prayer-verse-sign';
            sign.textContent = match[0].slice(0, 1);
            number.append(sign, match[1]);
            fragment.append(number);
            cursor = match.index + match[0].length;
        }
        fragment.append(node.data.slice(cursor));
        node.replaceWith(fragment);
    }
    page.querySelectorAll('.text-arabic, .text-arabic-inline, [lang="ar"]').forEach(element => {
        if (element.closest('.prayer-body, .page-footnote') || element.classList.contains('prayer-body')) return;
        element.classList.add('prayer-body');
        const ranges = prayerAccentRanges(element.textContent, slug);
        const walker = document.createTreeWalker(element, NodeFilter.SHOW_TEXT);
        const nodes = [];
        while (walker.nextNode()) nodes.push(walker.currentNode);
        let offset = 0;
        for (const node of nodes) {
            const start = offset;
            offset += node.data.length;
            if (node.parentElement.closest('.cevsen-separator, .cevsen-verse-number')) continue;
            const matches = ranges.filter(range => range.start < offset && range.end > start);
            if (!matches.length) continue;
            const fragment = document.createDocumentFragment();
            let cursor = 0;
            for (const range of matches) {
                const from = Math.max(0, range.start - start);
                const to = Math.min(node.data.length, range.end - start);
                fragment.append(node.data.slice(cursor, from));
                const span = document.createElement('span');
                span.className = 'prayer-accent';
                span.textContent = node.data.slice(from, to);
                fragment.append(span);
                cursor = to;
            }
            fragment.append(node.data.slice(cursor));
            node.replaceWith(fragment);
        }
    });
}
