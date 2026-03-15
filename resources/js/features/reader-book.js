export function readerBook() {
    // Tooltip logic (active only when .sup-pointer elements exist)
    if (!document.querySelector('.sup-pointer')) return;
    let tooltipEl = null;
    let hideTimeout = null;
    let lastTarget = null;
    document.addEventListener('click', function (e) {
        const target = e.target.closest('.sup-pointer');
        if (target) {
            e.preventDefault();
            e.stopPropagation();
            if (target === lastTarget && tooltipEl) {
                hideTooltip(true);
                lastTarget = null;
            } else {
                showTooltip(target, e);
                lastTarget = target;
            }
        } else {
            hideTooltip();
            lastTarget = null;
        }
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            hideTooltip(true);
            lastTarget = null;
        }
    });
    function showTooltip(element, event) {
        clearTimeout(hideTimeout);
        hideTooltip(true);
        const text = element.getAttribute('data-title');
        if (!text) return;
        tooltipEl = document.createElement('div');
        tooltipEl.className = 'reader-tooltip';
        tooltipEl.setAttribute('role', 'tooltip');
        tooltipEl.textContent = text;
        if (/[\u0600-\u06FF]/.test(text)) tooltipEl.classList.add('text-arabic');
        document.body.appendChild(tooltipEl);
        positionTooltip(event);
        requestAnimationFrame(() => {
            requestAnimationFrame(() => tooltipEl?.classList.add('show'));
        });
    }
    function positionTooltip(event) {
        if (!tooltipEl) return;
        const TW = tooltipEl.offsetWidth;
        const TH = tooltipEl.offsetHeight;
        const VW = window.innerWidth;
        const VH = window.innerHeight;
        const MARGIN = 10;
        const OFFSET = 14;
        let top  = event.clientY + OFFSET;
        let left = event.clientX - TW / 2;
        left = Math.max(MARGIN, Math.min(left, VW - TW - MARGIN));
        if (top + TH + MARGIN > VH) top = event.clientY - TH - OFFSET;
        tooltipEl.style.top  = top + 'px';
        tooltipEl.style.left = left + 'px';
        const arrowLeft = event.clientX - left;
        tooltipEl.style.setProperty('--arrow-left', Math.max(12, Math.min(arrowLeft, TW - 12)) + 'px');
    }
    function hideTooltip(immediate = false) {
        if (!tooltipEl) return;
        tooltipEl.classList.remove('show');
        if (immediate) {
            tooltipEl.remove();
            tooltipEl = null;
        } else {
            const el = tooltipEl;
            hideTimeout = setTimeout(() => {
                el.remove();
                if (tooltipEl === el) tooltipEl = null;
            }, 200);
        }
    }
}