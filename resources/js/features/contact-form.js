// ============================================================
// CONTACT FORM TOAST NOTIFICATIONS
// ============================================================

/**
 * Initialize contact form event listeners for toast notifications
 */
export function initContactForm() {
    // Listen for Livewire events (Livewire v3)
    if (window.Livewire) {
        Livewire.on('contact-success', (event) => {
            const message = event[0]?.message || event?.message || 'Bedankt! Uw bericht is verzonden.';
            if (window.showToast) {
                window.showToast(message, false);
            }
        });

        Livewire.on('contact-error', (event) => {
            const message = event[0]?.message || event?.message || 'Er is een fout opgetreden bij het verzenden van uw bericht.';
            if (window.showToast) {
                window.showToast(message, true);
            }
        });
    }

    // Also listen for browser events (fallback)
    window.addEventListener('contact-success', (event) => {
        const message = event.detail?.message || 'Bedankt! Uw bericht is verzonden.';
        if (window.showToast) {
            window.showToast(message, false);
        }
    });

    window.addEventListener('contact-error', (event) => {
        const message = event.detail?.message || 'Er is een fout opgetreden bij het verzenden van uw bericht.';
        if (window.showToast) {
            window.showToast(message, true);
        }
    });
}
