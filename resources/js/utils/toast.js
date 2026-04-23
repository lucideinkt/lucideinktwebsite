// Toast notification system

/**
 * Show a toast notification message
 * @param {string} message - Message to display
 * @param {boolean} isError - Whether this is an error message
 * @param {boolean} showCartLink - Whether to show a link to the cart
 */
export function showToast(message, isError = false, showCartLink = false) {
    // Remove any existing JS-created toast
    const existing = document.getElementById('js-toast');
    if (existing) {
        existing.remove();
    }

    const toast = document.createElement('div');
    toast.id = 'js-toast';
    toast.className = isError ? 'alert alert-error' : 'alert alert-success';

    // Icon
    const iconSpan = document.createElement('span');
    iconSpan.className = 'alert-icon';
    const iconEl = document.createElement('i');
    iconEl.className = isError ? 'fa-solid fa-circle-exclamation' : 'fa-solid fa-circle-check';
    iconSpan.appendChild(iconEl);
    toast.appendChild(iconSpan);

    // Text
    const textSpan = document.createElement('span');
    textSpan.className = 'alert-text';
    textSpan.textContent = message;
    toast.appendChild(textSpan);

    // Cart link
    if (showCartLink && !isError) {
        const cartLink = document.createElement('a');
        cartLink.href = '/winkel/cart';
        cartLink.textContent = 'Bekijk winkelwagen';
        toast.appendChild(cartLink);
    }

    // Close button
    const closeBtn = document.createElement('button');
    closeBtn.type = 'button';
    closeBtn.className = 'alert-close';
    closeBtn.setAttribute('aria-label', 'Sluiten');
    closeBtn.innerHTML = '&times;';
    toast.appendChild(closeBtn);

    document.body.appendChild(toast);

    // Auto-dismiss after 6 seconds (pause on hover like static alerts)
    function dismiss() {
        toast.classList.add('toast-hide');
        toast.addEventListener('animationend', () => toast.remove(), { once: true });
    }

    let autoDismiss = setTimeout(dismiss, 10000);

    toast.addEventListener('mouseenter', () => clearTimeout(autoDismiss));
    toast.addEventListener('mouseleave', () => { autoDismiss = setTimeout(dismiss, 3000); });

    // Close button cancels auto-dismiss and removes immediately
    closeBtn.onclick = () => {
        clearTimeout(autoDismiss);
        dismiss();
    };
}
