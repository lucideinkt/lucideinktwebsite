// ─── Custom Product Gallery + Lightbox ───────────────────────────────────────
// Zero external dependencies. Works correctly inside Livewire wire:ignore blocks.

export function initProductSwiper() {
    const gallery = document.querySelector('.pd-gallery');
    if (!gallery || gallery._pdInit) return;
    gallery._pdInit = true;

    // ── State ────────────────────────────────────────────────────────────────
    const images  = JSON.parse(gallery.dataset.images || '[]');
    const title   = gallery.dataset.title || '';
    const imgs    = Array.from(gallery.querySelectorAll('.pd-gallery__img'));
    const thumbs  = Array.from(gallery.querySelectorAll('.pd-gallery__thumb'));
    const btnPrev = gallery.querySelector('.pd-gallery__arrow--prev');
    const btnNext = gallery.querySelector('.pd-gallery__arrow--next');
    const btnZoom = gallery.querySelector('.pd-gallery__zoom');
    let   current = 0;

    // ── Gallery helpers ──────────────────────────────────────────────────────
    function goTo(idx, animate = true) {
        if (idx === current && animate) return;
        const prev = current;
        current = (idx + images.length) % images.length;

        imgs[prev]?.classList.remove('is-active');
        thumbs[prev]?.classList.remove('is-active');

        imgs[current]?.classList.add('is-active');
        thumbs[current]?.classList.add('is-active');
        thumbs[current]?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }

    // ── Arrow buttons ────────────────────────────────────────────────────────
    btnPrev?.addEventListener('click', () => goTo(current - 1));
    btnNext?.addEventListener('click', () => goTo(current + 1));

    // ── Thumbnail clicks ─────────────────────────────────────────────────────
    thumbs.forEach(t => {
        const activate = () => goTo(+t.dataset.index);
        t.addEventListener('click', activate);
        t.addEventListener('keydown', e => (e.key === 'Enter' || e.key === ' ') && activate());
    });

    // ── Touch/swipe on stage ─────────────────────────────────────────────────
    let touchStartX = 0;
    const stage = gallery.querySelector('.pd-gallery__stage');
    stage.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].clientX; }, { passive: true });
    stage.addEventListener('touchend', e => {
        const dx = e.changedTouches[0].clientX - touchStartX;
        if (Math.abs(dx) > 40) goTo(dx < 0 ? current + 1 : current - 1);
    });

    // ── Keyboard on stage (when focused) ────────────────────────────────────
    stage.setAttribute('tabindex', '0');
    stage.addEventListener('keydown', e => {
        if (e.key === 'ArrowLeft')  goTo(current - 1);
        if (e.key === 'ArrowRight') goTo(current + 1);
    });

    // ── Lightbox ─────────────────────────────────────────────────────────────
    let lb = document.getElementById('pd-lightbox');
    if (!lb) {
        lb = document.createElement('div');
        lb.id = 'pd-lightbox';
        lb.className = 'pd-lightbox';
        lb.setAttribute('aria-hidden', 'true');
        lb.setAttribute('role', 'dialog');
        lb.setAttribute('aria-modal', 'true');
        lb.innerHTML = `
            <div class="pd-lightbox__backdrop"></div>
            <button class="pd-lightbox__close" aria-label="Sluiten">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <button class="pd-lightbox__nav pd-lightbox__nav--prev" aria-label="Vorige">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="pd-lightbox__nav pd-lightbox__nav--next" aria-label="Volgende">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            <div class="pd-lightbox__stage">
                <img class="pd-lightbox__img" src="" alt="">
            </div>
            <div class="pd-lightbox__counter"></div>`;
        document.body.appendChild(lb);
    }

    const lbImg     = lb.querySelector('.pd-lightbox__img');
    const lbCounter = lb.querySelector('.pd-lightbox__counter');
    const lbClose   = lb.querySelector('.pd-lightbox__close');
    const lbPrev    = lb.querySelector('.pd-lightbox__nav--prev');
    const lbNext    = lb.querySelector('.pd-lightbox__nav--next');
    const lbBack    = lb.querySelector('.pd-lightbox__backdrop');
    let   lbIndex   = 0;

    function lbOpen(idx) {
        lbIndex = (idx + images.length) % images.length;
        lbImg.src = images[lbIndex];
        lbImg.alt = `${title} ${lbIndex + 1}`;
        lbCounter.textContent = `${lbIndex + 1} / ${images.length}`;
        lb.setAttribute('aria-hidden', 'false');
        lb.classList.add('is-open');
        document.body.style.overflow = 'hidden';
        lbClose.focus();

        // Hide/show nav if only 1 image
        lbPrev.style.display = images.length > 1 ? '' : 'none';
        lbNext.style.display = images.length > 1 ? '' : 'none';
    }

    function lbClose_() {
        lb.classList.remove('is-open');
        lb.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        stage.focus();
    }

    function lbGo(idx) {
        lbIndex = (idx + images.length) % images.length;
        lbImg.classList.add('is-switching');
        setTimeout(() => {
            lbImg.src = images[lbIndex];
            lbImg.alt = `${title} ${lbIndex + 1}`;
            lbCounter.textContent = `${lbIndex + 1} / ${images.length}`;
            lbImg.classList.remove('is-switching');
        }, 150);
        goTo(lbIndex); // keep gallery in sync
    }

    lbClose.addEventListener('click', lbClose_);
    lbBack.addEventListener('click', lbClose_);
    lbPrev.addEventListener('click', () => lbGo(lbIndex - 1));
    lbNext.addEventListener('click', () => lbGo(lbIndex + 1));

    // Keyboard inside lightbox
    lb.addEventListener('keydown', e => {
        if (!lb.classList.contains('is-open')) return;
        if (e.key === 'Escape')     lbClose_();
        if (e.key === 'ArrowLeft')  lbGo(lbIndex - 1);
        if (e.key === 'ArrowRight') lbGo(lbIndex + 1);
    });

    // Swipe inside lightbox
    let lbTouchX = 0;
    lb.addEventListener('touchstart', e => { lbTouchX = e.changedTouches[0].clientX; }, { passive: true });
    lb.addEventListener('touchend', e => {
        const dx = e.changedTouches[0].clientX - lbTouchX;
        if (Math.abs(dx) > 40) lbGo(dx < 0 ? lbIndex + 1 : lbIndex - 1);
    });

    // Open lightbox on main image click OR zoom button — desktop only
    const isMobile = () => window.innerWidth <= 768;
    imgs.forEach((img, i) => img.addEventListener('click', () => { if (!isMobile()) lbOpen(i); }));
    btnZoom?.addEventListener('click', () => { if (!isMobile()) lbOpen(current); });
    stage.style.cursor = 'zoom-in';

    // ── Force sharp repaint on load ───────────────────────────────────────────
    // Mimics what clicking the slider does: remove is-active, let browser flush,
    // then restore it. This breaks the blurry-compositing-layer on first paint.
    const forceRepaint = () => {
        const activeImg = imgs[current >= 0 ? current : 0];
        if (!activeImg) return;
        activeImg.classList.remove('is-active');
        void activeImg.offsetWidth; // force synchronous reflow
        activeImg.classList.add('is-active');
    };

    current = -1;
    const firstImg = imgs[0];
    const activate = () => {
        goTo(0, false);
        // Wait for image decode, then force repaint
        const repaint = () => requestAnimationFrame(() => requestAnimationFrame(forceRepaint));
        if (firstImg && typeof firstImg.decode === 'function') {
            firstImg.decode().then(repaint).catch(repaint);
        } else {
            repaint();
        }
    };
    // Use window.load to ensure all resources (including the image) are ready
    if (document.readyState === 'complete') {
        activate();
    } else {
        window.addEventListener('load', activate, { once: true });
    }
}
