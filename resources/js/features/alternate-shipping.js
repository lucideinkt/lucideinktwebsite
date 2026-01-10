// Alternate shipping address toggle

/**
 * Initialize alternate shipping address panel
 */
export function initAlternateShipping() {
    const altCheckbox = document.getElementById('alt-shipping');
    const altShippingPanel = document.querySelector('.customer-details.alternate');

    if (altCheckbox && altShippingPanel) {
        altCheckbox.addEventListener('change', () => {
            altShippingPanel.classList.toggle('open');

            if (!altCheckbox.checked) {
                altShippingPanel.querySelectorAll('input, select').forEach(field => {
                    if (field.type === 'checkbox' || field.type === 'radio') {
                        field.checked = false;
                    } else {
                        field.value = '';
                    }
                });
            }

            try {
                if (typeof hardResetMyParcelState === 'function') {
                    hardResetMyParcelState();
                }
            } catch (error) {
                // Ignore if function doesn't exist
            }
        });
    }
}
