// Header scroll effect (hide on scroll down, show on scroll up)

/**
 * Initialize header scroll effect
 */
export function initHeaderScrollEffect() {
    const header = document.querySelector('.header');
    if (!header) return;

    const SCROLL_DELTA = 10;
    const SCROLLED_THRESHOLD = 50;

    let lastScrollY = window.scrollY || 0;
    let ticking = false;

    const logoContainer = header.querySelector('.logo-container');
    const logoImg = logoContainer ? logoContainer.querySelector('img') : header.querySelector('img');

    // Set initial state
    if (window.scrollY > SCROLLED_THRESHOLD) {
        header.classList.add('scrolled');
        logoContainer?.classList.add('logo-hidden');
        logoImg?.classList.add('logo-hidden-img');
    } else {
        header.classList.remove('scrolled');
        logoContainer?.classList.remove('logo-hidden');
        logoImg?.classList.remove('logo-hidden-img');
    }

    window.addEventListener('scroll', () => {
        if (ticking) return;

        ticking = true;

        requestAnimationFrame(() => {
            const currentScrollY = window.scrollY || 0;

            if (Math.abs(currentScrollY - lastScrollY) <= SCROLL_DELTA) {
                ticking = false;
                return;
            }

            const isMobile = window.innerWidth <= 992;
            const logoThreshold = isMobile ? 60 : 100;
            const scrolledThreshold = 60; // Keep header filled until 60px from top

            if (currentScrollY <= scrolledThreshold) {
                header.classList.remove('scrolled');
                logoContainer?.classList.remove('logo-hidden');
                logoImg?.classList.remove('logo-hidden-img');
            } else if (currentScrollY > lastScrollY) {
                // Scrolling down
                header.classList.add('scrolled');
                logoContainer?.classList.add('logo-hidden');
                logoImg?.classList.add('logo-hidden-img');
            } else {
                // Scrolling up - keep scrolled state unless near top
                header.classList.add('scrolled');
                if (currentScrollY <= logoThreshold) {
                    logoContainer?.classList.remove('logo-hidden');
                    logoImg?.classList.remove('logo-hidden-img');
                } else {
                    logoContainer?.classList.add('logo-hidden');
                    logoImg?.classList.add('logo-hidden-img');
                }
            }

            lastScrollY = currentScrollY;
            ticking = false;
        });
    });

    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            const currentScrollY = window.scrollY || 0;
            const isMobile = window.innerWidth <= 992;
            const logoThreshold = isMobile ? 60 : 100;
            const scrolledThreshold = 60;

            if (currentScrollY <= scrolledThreshold) {
                header.classList.remove('scrolled');
                logoContainer?.classList.remove('logo-hidden');
                logoImg?.classList.remove('logo-hidden-img');
            } else {
                header.classList.add('scrolled');
                if (currentScrollY <= logoThreshold) {
                    logoContainer?.classList.remove('logo-hidden');
                    logoImg?.classList.remove('logo-hidden-img');
                } else {
                    logoContainer?.classList.add('logo-hidden');
                    logoImg?.classList.add('logo-hidden-img');
                }
            }
        }, 150);
    });
}
