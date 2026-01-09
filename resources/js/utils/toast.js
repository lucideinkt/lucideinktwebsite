// Toast notification system

/**
 * Show a toast notification message
 * @param {string} message - Message to display
 * @param {boolean} isError - Whether this is an error message
 */
export function showToast(message, isError = false) {
    let toast = document.getElementById('copy-toast');

    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'copy-toast';
        toast.className = 'copy-toast';
        document.body.appendChild(toast);
    }

    toast.textContent = message;
    toast.classList.remove('show', 'error');
    if (isError) toast.classList.add('error');

    void toast.offsetWidth; // Force reflow
    toast.classList.add('show');

    setTimeout(() => toast.classList.remove('show'), 2000);
}
