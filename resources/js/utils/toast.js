// Toast notification system

/**
 * Show a toast notification message
 * @param {string} message - Message to display
 * @param {boolean} isError - Whether this is an error message
 * @param {boolean} showCartLink - Whether to show a link to the cart
 */
export function showToast(message, isError = false, showCartLink = false) {
    let toast = document.getElementById('copy-toast');

    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'copy-toast';
        toast.className = 'copy-toast';
        document.body.appendChild(toast);
    }

    // Clear previous content
    toast.innerHTML = '';

    // Add message
    const messageSpan = document.createElement('span');
    messageSpan.textContent = message;
    toast.appendChild(messageSpan);

    // Add cart link if requested
    if (showCartLink && !isError) {
        const cartLink = document.createElement('a');
        cartLink.href = '/winkel/cart';
        cartLink.textContent = 'Bekijk winkelwagen';
        cartLink.className = 'toast-cart-link';
        cartLink.style.marginLeft = '10px';
        cartLink.style.textDecoration = 'underline';
        cartLink.style.fontWeight = 'bold';
        toast.appendChild(cartLink);
    }

    toast.classList.remove('show', 'error');
    if (isError) toast.classList.add('error');

    void toast.offsetWidth; // Force reflow
    toast.classList.add('show');

    setTimeout(() => toast.classList.remove('show'), 4000); // Show longer when there's a link
}
