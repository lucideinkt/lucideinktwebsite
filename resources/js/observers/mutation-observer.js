// DOM mutation observer for dynamic content

import { enableAllSubmitButtons, getSubmitButtonsForForm, showLoaderAndDisable, hideLoaderAndEnable } from '../features/form-loader.js';
import { setupConfirmationModals } from '../features/confirm-modal.js';
import { setupPasswordToggles } from '../features/password-toggle.js';

/**
 * Setup loader for a single form
 * @param {HTMLFormElement} form - Form element
 */
function setupFormLoader(form) {
    form.addEventListener('submit', function(event) {
        if (form.classList.contains('needs-confirm')) return;

        let button = event.submitter;
        if (!button) {
            button = getSubmitButtonsForForm(form).find(b => !b.disabled);
        }

        showLoaderAndDisable(button);
        setTimeout(() => hideLoaderAndEnable(button), 5000);
    });
}

/**
 * Initialize mutation observer for dynamic content
 */
export function initMutationObserver() {
    new MutationObserver((mutations) => {
        enableAllSubmitButtons();

        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType !== 1) return;

                if (node.tagName === 'FORM') {
                    setupFormLoader(node);
                } else if (node.querySelectorAll) {
                    node.querySelectorAll('form').forEach(setupFormLoader);
                }
            });
        });

        setupConfirmationModals();
        setupPasswordToggles();
    }).observe(document.body, {
        childList: true,
        subtree: true
    });
}
