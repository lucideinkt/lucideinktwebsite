// Submit button loader functionality

/**
 * Show loader and disable a button
 * @param {HTMLElement} button - Button to disable
 */
export function showLoaderAndDisable(button) {
    if (!button) return;

    const loader = button.querySelector('.loader');
    if (loader) loader.style.display = 'inline-block';
    button.disabled = true;
}

/**
 * Hide loader and enable a button
 * @param {HTMLElement} button - Button to enable
 */
export function hideLoaderAndEnable(button) {
    if (!button) return;

    const loader = button.querySelector('.loader');
    if (loader) loader.style.display = 'none';
    button.disabled = false;
}

/**
 * Get all submit buttons for a form (including external buttons)
 * @param {HTMLFormElement} form - Form element
 * @returns {Array<HTMLElement>} Array of submit buttons
 */
export function getSubmitButtonsForForm(form) {
    let buttons = Array.from(form.querySelectorAll('button[type="submit"]'));

    if (form.id) {
        const externalButtons = Array.from(document.querySelectorAll(`button[form='${form.id}']`));
        buttons = buttons.concat(externalButtons);
    }

    return Array.from(new Set(buttons));
}

/**
 * Enable all submit buttons and hide their loaders
 */
export function enableAllSubmitButtons() {
    document.querySelectorAll('button[type="submit"], button.add-to-cart-button').forEach(button => {
        button.disabled = false;
        const loader = button.querySelector('.loader');
        if (loader) loader.style.display = 'none';
    });
}

/**
 * Initialize form loader functionality
 */
export function initFormLoaders() {
    enableAllSubmitButtons();

    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
            if (form.classList.contains('needs-confirm')) return;

            let button = event.submitter || getSubmitButtonsForForm(form).find(b => !b.disabled);

            showLoaderAndDisable(button);
            setTimeout(() => hideLoaderAndEnable(button), 5000);
        });
    });
}
