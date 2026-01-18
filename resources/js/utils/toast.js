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

    // Add icon and message wrapper
    const messageSpan = document.createElement('span');

    // Add icon
    const icon = document.createElement('i');
    icon.className = isError ? 'fas fa-exclamation-circle toast-icon' : 'fas fa-check-circle toast-icon';
    messageSpan.appendChild(icon);

    // Add message text
    const messageText = document.createTextNode(message);
    messageSpan.appendChild(messageText);

    toast.appendChild(messageSpan);

    // Add cart link if requested
    if (showCartLink && !isError) {
        const cartLink = document.createElement('a');
        cartLink.href = '/winkel/cart';
        cartLink.textContent = 'Bekijk winkelwagen';
        cartLink.className = 'toast-cart-link';
        toast.appendChild(cartLink);
    }

    // Add close button
    const closeBtn = document.createElement('button');
    closeBtn.className = 'toast-close';
    closeBtn.innerHTML = '<i class="fas fa-times"></i>';
    closeBtn.setAttribute('aria-label', 'Sluiten');
    closeBtn.onclick = () => {
        toast.classList.remove('show');
    };
    toast.appendChild(closeBtn);

    toast.classList.remove('show', 'error');
    if (isError) toast.classList.add('error');

    void toast.offsetWidth; // Force reflow
    toast.classList.add('show');

    // Verwijder automatische verwijdering - gebruiker moet nu zelf sluiten
    // setTimeout(() => toast.classList.remove('show'), 4000);
}
