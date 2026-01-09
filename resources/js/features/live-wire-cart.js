// ============================================================
// LIVEWIRE CART FUNCTIONALITY
// ============================================================

/**
 * Initialize Livewire cart event listeners
 * Handles cart badge updates and toast notifications for Livewire v3
 */
export function initLivewireCart() {
    // Update cart badge display
    function updateCartBadge(totalQuantity) {
        document.querySelectorAll('.cart-quantity').forEach(badge => {
            if (totalQuantity > 0) {
                badge.textContent = totalQuantity;
                badge.style.display = 'inline-block';
            } else {
                badge.textContent = '0';
                badge.style.display = 'none';
            }
        });
    }


    // Listen for Livewire events (Livewire v3)
    if (window.Livewire) {
        Livewire.on('cart-updated', (event) => {
            const totalQuantity = event[0]?.totalQuantity || event?.totalQuantity || 0;
            updateCartBadge(totalQuantity);
        });

        Livewire.on('cart-success', (event) => {
            const message = event[0]?.message || event?.message || 'Product toegevoegd aan winkelwagen!';
            window.showToast(message, false, true); // Show with cart link
        });

        Livewire.on('cart-error', (event) => {
            const message = event[0]?.message || event?.message || 'Er is een fout opgetreden.';
            window.showToast(message, true);
        });
    }

    // Also listen for browser events (fallback)
    window.addEventListener('cart-updated', (event) => {
        const totalQuantity = event.detail?.totalQuantity || 0;
        updateCartBadge(totalQuantity);
    });

    window.addEventListener('cart-success', (event) => {
        const message = event.detail?.message || 'Product toegevoegd aan winkelwagen!';
        window.showToast(message, false, true); // Show with cart link
    });

    window.addEventListener('cart-error', (event) => {
        const message = event.detail?.message || 'Er is een fout opgetreden.';
        window.showToast(message, true);
    });
}
