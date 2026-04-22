// ============================================================
// iOS SAFARI DOUBLE-TAP FIX
// A single empty touchstart listener on the document tells
// iOS Safari this page handles touch, so it stops intercepting
// the first tap as a :hover state — making every link, button
// and clickable element respond on the FIRST tap.
// ============================================================
document.addEventListener('touchstart', function () {}, { passive: true });

// Import Axios first (needed globally)
import axios from 'axios';

// Set CSRF token for all Axios requests
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
}

// Make axios available globally for Laravel
window.axios = axios;

// Import all utilities
import { formatEuro } from './utils/format.js';
import { showToast } from './utils/toast.js';

// Make utilities available globally
window.formatEuro = formatEuro;
window.showToast = showToast;

// Import all features
import { initShippingCostCalculator } from './features/shipping.js';
import { initSidebarToggles, setupSidebarDropdowns } from './features/sidebar.js';
import { initImagePickers } from './features/image-picker.js';
import { initFormLoaders } from './features/form-loader.js';
import { initAlternateShipping } from './features/alternate-shipping.js';
import { initOrderCalculation } from './features/order-calc.js';
import { initCopyPaymentLink } from './features/payment-link.js';
import { setupConfirmationModals, setupLivewireConfirmations } from './features/confirm-modal.js';
import { initDiscountCode } from './features/discount-code.js';
import './delivery-options.js';
import { setupPasswordToggles } from './features/password-toggle.js';
import { initAnimatedClock } from './features/clock.js';
import { initReadMoreModal } from './features/read-more-modal.js';
import { initHeaderScrollEffect } from './features/header-scroll.js';
import { initLivewireCart } from './features/live-wire-cart.js';
import { initContactForm } from './features/contact-form.js';
import { readerBook } from './features/reader-book.js';
import { initProductSwiper } from './features/product-swiper.js';
import { initAlerts } from './features/alerts.js';

// Import observers
import { initMutationObserver } from './observers/mutation-observer.js';

// ============================================================
// PAGE SETUP
// ============================================================

// Prevent browser from restoring scroll position
try {
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
    setTimeout(() => window.scrollTo(0, 0), 0);
} catch (error) {
    // Ignore errors
}

// ============================================================
// INITIALIZE FEATURES
// ============================================================

// Run shipping calculator immediately (has own listeners)
initShippingCostCalculator();

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize all features
    initSidebarToggles();
    initImagePickers();
    initFormLoaders();
    initAlternateShipping();
    initOrderCalculation();
    initCopyPaymentLink();
    setupConfirmationModals();
    setupLivewireConfirmations();
    initDiscountCode();
    // initMyParcelWidget() — replaced by delivery-options.js (custom CDO widget)
    setupPasswordToggles();
    initAnimatedClock();
    initLivewireCart();
    initReadMoreModal();
    initHeaderScrollEffect();
    initContactForm();
    setupSidebarDropdowns();
    readerBook();
    initProductSwiper();
    initAlerts();

    // Initialize observer (must be last)
    initMutationObserver();
});
