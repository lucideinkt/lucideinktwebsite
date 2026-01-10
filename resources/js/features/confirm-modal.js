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

/**
 * Setup Livewire confirmation interceptor
 * Replaces Livewire's wire:confirm with custom modal
 */
export function setupLivewireConfirmations() {
    // Wait for Livewire to initialize
    document.addEventListener('livewire:init', () => {
        // Use MutationObserver to watch for new Livewire elements
        const observer = new MutationObserver(() => {
            handleLivewireConfirmElements();
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });

        // Initial setup
        handleLivewireConfirmElements();
    });

    // Also run immediately in case Livewire is already initialized
    if (window.Livewire) {
        handleLivewireConfirmElements();

        // Set up observer immediately
        const observer = new MutationObserver(() => {
            handleLivewireConfirmElements();
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }
}

/**
 * Handle elements with wire:confirm attribute
 */
function handleLivewireConfirmElements() {
    document.querySelectorAll('[wire\\:confirm]').forEach(element => {
        // Skip if already processed
        if (element.dataset.confirmProcessed) return;
        element.dataset.confirmProcessed = 'true';

        const confirmMessage = element.getAttribute('wire:confirm');
        const wireClick = element.getAttribute('wire:click');

        if (!wireClick) return;

        // Remove wire:confirm to prevent browser dialog
        element.removeAttribute('wire:confirm');

        // Add click handler with highest priority
        element.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();

            showConfirmModal(confirmMessage || 'Weet je het zeker?', function() {
                // Find the closest Livewire component
                const livewireElement = element.closest('[wire\\:id]');

                if (livewireElement && window.Livewire) {
                    const componentId = livewireElement.getAttribute('wire:id');
                    const component = window.Livewire.find(componentId);

                    if (component) {
                        // Extract method name and parameters from wire:click
                        const methodMatch = wireClick.match(/^([^(]+)(?:\(([^)]*)\))?$/);
                        if (methodMatch) {
                            const methodName = methodMatch[1].trim();
                            let params = [];

                            if (methodMatch[2]) {
                                // Parse parameters, handling numbers properly
                                params = methodMatch[2].split(',').map(p => {
                                    p = p.trim();
                                    // Remove quotes if present
                                    if ((p.startsWith("'") && p.endsWith("'")) ||
                                        (p.startsWith('"') && p.endsWith('"'))) {
                                        return p.slice(1, -1);
                                    }
                                    // Try to parse as number
                                    const num = Number(p);
                                    if (!isNaN(num)) {
                                        return num;
                                    }
                                    return p;
                                });
                            }

                            // Call the Livewire method
                            component.call(methodName, ...params);
                        }
                    }
                }
            }, element);
        }, true); // Use capture phase to intercept before Livewire
    });
}

// Make showConfirmModal globally available
window.showConfirmModal = showConfirmModal;
