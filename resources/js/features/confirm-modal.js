// Custom confirmation modal

import { showLoaderAndDisable, hideLoaderAndEnable } from './form-loader.js';

let confirmModalOpen = false;
let lastConfirmButton = null;

/**
 * Show confirmation modal
 * @param {string} message - Message to display
 * @param {Function} onConfirm - Callback when confirmed
 * @param {HTMLElement} triggerButton - Button that triggered modal
 */
export function showConfirmModal(message, onConfirm, triggerButton) {
    if (confirmModalOpen) return;

    confirmModalOpen = true;
    lastConfirmButton = triggerButton || null;

    document.querySelectorAll('.custom-confirm-modal').forEach(modal => modal.remove());

    const modal = document.createElement('div');
    modal.className = 'custom-confirm-modal';
    modal.innerHTML = `
    <div class="custom-confirm-modal-backdrop"></div>
    <div class="custom-confirm-modal-content">
      <div class="custom-confirm-modal-message">${message}</div>
      <div class="custom-confirm-modal-actions">
        <button class="btn confirm-btn small" type="button">Ja, bevestigen</button>
        <button class="btn cancel-btn small" type="button">Annuleren</button>
      </div>
    </div>
  `;

    document.body.appendChild(modal);
    modal.querySelector('.confirm-btn').focus();

    modal.querySelector('.confirm-btn').onclick = () => {
        confirmModalOpen = false;
        modal.remove();
        if (onConfirm) onConfirm();
        lastConfirmButton = null;
    };

    const closeModal = () => {
        confirmModalOpen = false;
        modal.remove();

        if (lastConfirmButton) {
            const loader = lastConfirmButton.querySelector('.loader');
            if (loader) loader.style.display = 'none';
            lastConfirmButton.disabled = false;
            lastConfirmButton = null;
        }
    };

    modal.querySelector('.cancel-btn').onclick = closeModal;
    modal.querySelector('.custom-confirm-modal-backdrop').onclick = closeModal;
}

/**
 * Initialize confirmation modals for forms with .needs-confirm class
 */
export function setupConfirmationModals() {
    document.querySelectorAll('form.needs-confirm').forEach(form => {
        const formId = form.id;
        let buttons = [];

        if (formId) {
            buttons = Array.from(document.querySelectorAll(`button[form='${formId}']`));
        }

        const insideButton = form.querySelector('button[type="submit"]');
        if (insideButton) buttons.push(insideButton);

        buttons = Array.from(new Set(buttons));

        buttons.forEach(button => {
            if (!button) return;

            button.addEventListener('click', function(event) {
                event.preventDefault();

                const message = form.getAttribute('data-confirm') || 'Weet je het zeker?';

                showConfirmModal(message, function() {
                    showLoaderAndDisable(button);
                    form.submit();
                    setTimeout(() => hideLoaderAndEnable(button), 5000);
                }, button);
            });
        });
    });
}

// Make showConfirmModal globally available
window.showConfirmModal = showConfirmModal;
