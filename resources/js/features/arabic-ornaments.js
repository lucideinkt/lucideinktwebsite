export function keepOrnamentsWithWords(page) {
    page.querySelectorAll('.text-arabic, .text-arabic-inline').forEach(paragraph => {
        const ornaments = [...paragraph.querySelectorAll('.cevsen-separator')].reverse();
        for (const ornament of ornaments) {
            if (ornament.textContent !== '\u06de' || ornament.closest('.arabic-ornament-tail')) continue;
            const walker = document.createTreeWalker(paragraph, NodeFilter.SHOW_TEXT);
            const leaves = [];
            let prefix = '';
            while (walker.nextNode()) {
                const node = walker.currentNode;
                if (ornament.contains(node)) break;
                leaves.push({ node, start: prefix.length });
                prefix += node.data;
            }
            const match = /[^\s\u06de]+[^\S\r\n]*$/u.exec(prefix);
            if (!match || !/\p{L}/u.test(match[0])) continue;
            const start = leaves.findLast(leaf => leaf.start <= match.index);
            const check = document.createRange();
            check.setStart(start.node, match.index - start.start);
            check.setEndAfter(ornament);
            if (check.cloneContents().querySelector('br')) continue;
            const before = document.createRange();
            before.setStart(paragraph, 0);
            before.setEnd(start.node, match.index - start.start);
            const prefixContent = before.extractContents();
            const range = document.createRange();
            range.setStart(paragraph, 0);
            range.setEndAfter(ornament);
            const group = document.createElement('span');
            group.className = 'arabic-ornament-tail';
            group.append(range.extractContents());
            paragraph.prepend(prefixContent, group);
        }
    });
}
