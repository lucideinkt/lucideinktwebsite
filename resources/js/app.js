// ============================================================
// UTILITY FUNCTIONS
// ============================================================

// Format numbers as Euro currency
function formatEuro(value) {
    return '€ ' + value.toFixed(2).replace('.', ',');
}

// Show toast notification messages
function showToast(message, isError = false) {
    let toast = document.getElementById('copy-toast');

    // Create toast element if it doesn't exist
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'copy-toast';
        toast.className = 'copy-toast';
        document.body.appendChild(toast);
    }

    // Display message
    toast.textContent = message;
    toast.classList.remove('show', 'error');
    if (isError) toast.classList.add('error');

    // Trigger animation
    void toast.offsetWidth; // Force reflow
    toast.classList.add('show');

    // Hide after 2 seconds
    setTimeout(() => toast.classList.remove('show'), 2000);
}

// Expose globally for use in imported modules
window.showToast = showToast;

// ============================================================
// AXIOS SETUP (for API requests)
// ============================================================

import axios from 'axios';
import { initLivewireCart } from './features/live-wire-cart.js';

// Set CSRF token for all API requests
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
}

// ============================================================
// SHIPPING COST CALCULATOR
// ============================================================

function initShippingCostCalculator() {
    const shippingCostEl = document.getElementById('shipping-cost');
    const orderTotalEl = document.getElementById('order-total');
    const altShippingCheckbox = document.getElementById('alt-shipping');
    // Country is now filled by Google Places autocomplete via hidden inputs
    const billingCountryInput = document.getElementById('billing_country');
    const shippingCountryInput = document.getElementById('shipping_country');

    // Get the country to calculate shipping for
    function getSelectedCountry() {
        // If alternate shipping is checked, use shipping country
        if (altShippingCheckbox?.checked && shippingCountryInput?.value) {
            return shippingCountryInput.value;
        }
        return billingCountryInput?.value || '';
    }

    // Update shipping cost when country changes
    function updateShippingCost() {
        if (!shippingCostEl || !orderTotalEl) return;

        const country = getSelectedCountry();
        const subtotal = parseFloat(orderTotalEl.dataset.subtotal) || 0;

        if (!country) {
            // No country yet — hide shipping line, show only subtotal
            shippingCostEl.textContent = '';
            orderTotalEl.textContent = '€ ' + subtotal.toFixed(2).replace('.', ',');
            return;
        }

        // Fetch shipping cost from API
        fetch(`/api/shipping-cost?country=${country}`)
            .then(response => response.json())
            .then(data => {
                const cost = parseFloat(data.cost) || 0;
                if (data.found) {
                    shippingCostEl.textContent = cost === 0
                        ? 'Verzendkosten: gratis'
                        : 'Verzendkosten: ' + formatEuro(cost);
                } else {
                    shippingCostEl.textContent = '';
                }

                orderTotalEl.textContent = 'Totaal: ' + formatEuro(subtotal + (data.found ? cost : 0));
            });
    }

    // Listen for the custom event fired by Google Places autocomplete
    document.addEventListener('countryChanged', updateShippingCost);
    // Also listen for manual select changes
    document.getElementById('billing_country')?.addEventListener('change', updateShippingCost);
    document.getElementById('shipping_country')?.addEventListener('change', updateShippingCost);
    altShippingCheckbox?.addEventListener('change', updateShippingCost);

    // Calculate on page load (skips if country is empty)
    updateShippingCost();
}

// Run shipping calculator when DOM is ready (not before)
document.addEventListener('DOMContentLoaded', () => {
    initShippingCostCalculator();
});

// ============================================================
// MAIN INITIALIZATION (runs when DOM is ready)
// ============================================================

document.addEventListener('DOMContentLoaded', () => {

    // ----------------------------------------------------------
    // PAGE SETUP
    // ----------------------------------------------------------

    // Prevent browser from restoring scroll position
    try {
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }
        setTimeout(() => window.scrollTo(0, 0), 0);
    } catch (error) {
        // Ignore errors
    }

  const showToast = (msg, isError = false) => {
    const toast = ensureToast();
    toast.textContent = msg;
    toast.classList.remove('show', 'error');
    if (isError) toast.classList.add('error');
    void toast.offsetWidth; // reflow
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2000);
  };

  // Expose showToast globally for use in other scripts
  window.showToast = showToast;

  // ------------------------------------------------------------
  // Page setup
  // ------------------------------------------------------------
  try {
    if ('scrollRestoration' in history) {
      history.scrollRestoration = 'manual';
    }

    initSidebarToggles();

    // ----------------------------------------------------------
    // IMAGE UPLOAD PREVIEW (for images 1-4)
    // ----------------------------------------------------------

    function initImagePickers() {
        for (let i = 1; i <= 4; i++) {
            const input = document.getElementById(`image_${i}`);
            if (!input) continue;

            const label = document.getElementById(`image_${i}_label_text`);
            const preview = document.getElementById(`image_${i}_preview`);
            const removeBtn = document.querySelector(`[data-input="image_${i}"]`);
            const deleteCheckbox = document.getElementById(`delete_image_${i}`);

            // When file is selected
            input.addEventListener('change', (event) => {
                const files = event.target.files;

                if (files.length > 0) {
                    const file = files[0];

                    // Update label with filename
                    if (label) label.textContent = file.name;

                    // Show preview
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        if (preview) {
                            preview.innerHTML = `<img src="${e.target.result}" style="max-width:60px;max-height:60px;" alt="Preview">`;
                        }
                    };
                    reader.readAsDataURL(file);

                    // Show remove button
                    if (removeBtn) removeBtn.style.display = 'inline-block';
                    if (deleteCheckbox) deleteCheckbox.checked = false;
                } else {
                    // Reset if no file selected
                    if (label) label.textContent = "Kies afbeelding...";
                    if (preview) preview.innerHTML = '';
                    if (removeBtn) removeBtn.style.display = 'none';
                    if (deleteCheckbox) deleteCheckbox.checked = false;
                }
            });

            // Remove button
            if (removeBtn) {
                removeBtn.addEventListener('click', () => {
                    input.value = "";
                    if (label) label.textContent = "Kies afbeelding...";
                    if (preview) preview.innerHTML = '';
                    removeBtn.style.display = 'none';
                    if (deleteCheckbox) deleteCheckbox.checked = true;
                });
            }
        }
    }

    initImagePickers();

    // ----------------------------------------------------------
    // LOADING SPINNER FOR SUBMIT BUTTONS
    // ----------------------------------------------------------

    // Helper functions for submit button loaders
    function enableAllSubmitButtons() {
        document.querySelectorAll('button[type="submit"], button.add-to-cart-button').forEach(button => {
            button.disabled = false;
            const loader = button.querySelector('.loader');
            if (loader) loader.style.display = 'none';
        });
    }

    function getSubmitButtonsForForm(form) {
        let buttons = Array.from(form.querySelectorAll('button[type="submit"]'));

        // Also find buttons outside form with matching form attribute
        if (form.id) {
            const externalButtons = Array.from(document.querySelectorAll(`button[form='${form.id}']`));
            buttons = buttons.concat(externalButtons);
        }

        // Remove duplicates
        return Array.from(new Set(buttons));
    }

    function showLoaderAndDisable(button) {
        if (!button) return;

        const loader = button.querySelector('.loader');
        if (loader) loader.style.display = 'inline-block';
        button.disabled = true;
    }

    function hideLoaderAndEnable(button) {
        if (!button) return;

        const loader = button.querySelector('.loader');
        if (loader) loader.style.display = 'none';
        button.disabled = false;
    }

    // Enable all submit buttons on page load
    enableAllSubmitButtons();

    // Add loader logic to all forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
            // Skip if form needs confirmation (handled separately)
            if (form.classList.contains('needs-confirm')) return;

            // Find button that triggered submit
            let button = event.submitter || getSubmitButtonsForForm(form).find(b => !b.disabled);

            showLoaderAndDisable(button);

            // Safety timeout to re-enable after 5 seconds
            setTimeout(() => hideLoaderAndEnable(button), 5000);
        });
    });

    // ----------------------------------------------------------
    // ALTERNATE SHIPPING ADDRESS TOGGLE
    // ----------------------------------------------------------

    function initAlternateShipping() {
        const altCheckbox = document.getElementById('alt-shipping');
        const altShippingPanel = document.querySelector('.customer-details.alternate');

        if (altCheckbox && altShippingPanel) {
            altCheckbox.addEventListener('change', () => {
                altShippingPanel.classList.toggle('open');

                // Clear all fields if unchecked
                if (!altCheckbox.checked) {
                    altShippingPanel.querySelectorAll('input, select').forEach(field => {
                        if (field.type === 'checkbox' || field.type === 'radio') {
                            field.checked = false;
                        } else {
                            field.value = '';
                        }
                    });
                }

                // Reset MyParcel state if available
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

    initAlternateShipping();

    // ----------------------------------------------------------
    // CLEAR BILLING FIELDS BUTTON
    // ----------------------------------------------------------

    (function initClearBillingFields() {
        const btn = document.getElementById('clear-billing-fields');
        if (!btn) return;

        btn.addEventListener('click', () => {
            const card = document.querySelector('.customer-details.checkout-card:not(.alternate)');
            if (!card) return;

            // Clear all visible text/email/number/textarea fields
            card.querySelectorAll('input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]), textarea').forEach(el => {
                el.value = '';
            });

            // Clear hidden country input and its display field
            const hiddenCountry = document.getElementById('billing_country');
            if (hiddenCountry) hiddenCountry.value = '';
            const displayCountry = document.getElementById('billing_country_display');
            if (displayCountry) displayCountry.value = '';

            // Re-trigger shipping cost update (country is now empty)
            document.dispatchEvent(new CustomEvent('countryChanged'));
        });
    })();

    // ----------------------------------------------------------
    // ORDER CALCULATION (instant price updates)
    // ----------------------------------------------------------

    function initOrderCalculation() {
        const qtyInputs = document.querySelectorAll('.qty-input');
        if (qtyInputs.length === 0) return;

        const totalEl = document.getElementById('total-price');
        const discountedTotalEl = document.getElementById('discounted-total');
        const discountValueInput = document.getElementById('discount_value');
        const discountTypeSelect = document.getElementById('discount_type');

        function updatePrices() {
            let total = 0;

            // Calculate total from all quantity inputs
            qtyInputs.forEach(input => {
                const quantity = parseFloat(input.value) || 0;
                const price = parseFloat(input.dataset.price) || 0;
                const itemId = input.dataset.id;
                const subtotal = quantity * price;

                total += subtotal;

                // Update individual item subtotal
                const subtotalEl = document.getElementById(`sub-item-price-${itemId}`);
                if (subtotalEl) {
                    subtotalEl.innerText = quantity > 0 ? formatEuro(subtotal) : '';
                }
            });

            // Update main total
            if (totalEl) {
                totalEl.innerText = total > 0 ? ' - Totaal: ' + formatEuro(total) : '';
            }

            // Calculate discounted total if discount exists
            if (discountValueInput && discountTypeSelect && discountedTotalEl) {
                const discountValue = parseFloat(discountValueInput.value) || 0;
                const discountType = discountTypeSelect.value;

                if (discountValue > 0) {
                    let discountedTotal = total;

                    if (discountType === 'percent') {
                        discountedTotal = total - (total * discountValue / 100);
                    } else {
                        discountedTotal = total - discountValue;
                    }

                    discountedTotal = Math.max(discountedTotal, 0);
                    discountedTotalEl.innerText = 'Totaal na korting: ' + formatEuro(discountedTotal);
                } else {
                    discountedTotalEl.innerText = '';
                }
            }
        }

        // Listen for changes on all quantity inputs
        qtyInputs.forEach(input => {
            input.addEventListener('input', updatePrices);
            input.addEventListener('change', updatePrices);
        });

        // Listen for discount changes
        discountValueInput?.addEventListener('input', updatePrices);
        discountTypeSelect?.addEventListener('change', updatePrices);

        // Calculate on page load
        updatePrices();
    }

    initOrderCalculation();

    // ----------------------------------------------------------
    // COPY PAYMENT LINK TO CLIPBOARD
    // ----------------------------------------------------------

    function initCopyPaymentLink() {
        const copyBtn = document.getElementById('copy-payment-link');
        if (!copyBtn) return;

        // Get link from data attribute or anchor tag
        const explicitLink = copyBtn.dataset.paymentLink;
        const anchorLink = document.querySelector('#payment-link a')?.href || '';
        const linkToCopy = explicitLink || anchorLink;

        // Fallback copy method for older browsers
        function fallbackCopy(text) {
            try {
                const textarea = document.createElement('textarea');
                textarea.value = text;
                textarea.readOnly = true;
                textarea.style.position = 'absolute';
                textarea.style.left = '-9999px';
                document.body.appendChild(textarea);
                textarea.select();

                const success = document.execCommand('copy');
                document.body.removeChild(textarea);

                if (success) {
                    showToast('Betaallink gekopieerd naar klembord');
                } else {
                    showToast('Kopiëren mislukt, kopieer handmatig', true);
                }
            } catch (error) {
                showToast('Kopiëren mislukt, kopieer handmatig', true);
            }
        }

        copyBtn.addEventListener('click', () => {
            if (!linkToCopy) return;

            // Try modern clipboard API first
            if (navigator.clipboard?.writeText) {
                navigator.clipboard.writeText(linkToCopy)
                    .then(() => showToast('Betaallink gekopieerd naar klembord'))
                    .catch(() => fallbackCopy(linkToCopy));
            } else {
                fallbackCopy(linkToCopy);
            }
        });
    }

    initCopyPaymentLink();

    // ----------------------------------------------------------
    // CUSTOM CONFIRMATION MODAL
    // ----------------------------------------------------------

    let confirmModalOpen = false;
    let lastConfirmButton = null;

    window.showConfirmModal = function(message, onConfirm, triggerButton) {
        if (confirmModalOpen) return;

        confirmModalOpen = true;
        lastConfirmButton = triggerButton || null;

        // Remove any existing modals
        document.querySelectorAll('.custom-confirm-modal').forEach(modal => modal.remove());

        // Create modal
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

        // Confirm button
        modal.querySelector('.confirm-btn').onclick = () => {
            confirmModalOpen = false;
            modal.remove();
            if (onConfirm) onConfirm();
            lastConfirmButton = null;
        };

        // Cancel button and backdrop
        const closeModal = () => {
            confirmModalOpen = false;
            modal.remove();

            // Hide loader if present
            if (lastConfirmButton) {
                const loader = lastConfirmButton.querySelector('.loader');
                if (loader) loader.style.display = 'none';
                lastConfirmButton.disabled = false;
                lastConfirmButton = null;
            }
        };

        modal.querySelector('.cancel-btn').onclick = closeModal;
        modal.querySelector('.custom-confirm-modal-backdrop').onclick = closeModal;
    };

    // ----------------------------------------------------------
    // DISCOUNT CODE FUNCTIONALITY
    // ----------------------------------------------------------

    function initDiscountCode() {
        const discountButton = document.getElementById('add_discount_code');
        const discountInput = document.getElementById('discount_code');
        let messageEl = document.getElementById('discount_code_msg');

        if (!discountButton || !discountInput) return;

        // Create message element if it doesn't exist
        if (!messageEl) {
            messageEl = document.createElement('div');
            messageEl.id = 'discount_code_msg';
            messageEl.style.marginTop = '6px';
            messageEl.style.fontSize = '15px';
            discountInput.parentNode.appendChild(messageEl);
        }

        const loader = discountButton.querySelector('.loader');
        if (loader) loader.style.display = 'none';

        // Update discount display in checkout
        function updateDiscountUI(data, code) {
            const discountRow = document.getElementById('discount-row');
            const newTotalRow = document.getElementById('new-total-row');
            const discountAmount = document.getElementById('discount-amount');
            const orderTotal = document.getElementById('order-total');
            const orderNewTotal = document.getElementById('order-new-total');
            const discountCodeLabel = document.getElementById('discount-code-label');
            const removeDiscountContainer = document.getElementById('remove-discount-container');

            if (data && data.discount_amount > 0) {
                // Format discount display
                const isPercent = data.discount?.discount_type === 'percent';
                const displayDiscount = isPercent
                    ? `${Number(data.discount.discount)}%`
                    : formatEuro(data.discount_amount);

                // Show discount rows
                if (discountRow) discountRow.style.display = '';
                if (newTotalRow) newTotalRow.style.display = '';
                if (discountAmount) discountAmount.textContent = displayDiscount;
                if (orderNewTotal) orderNewTotal.textContent = formatEuro(data.new_total);
                if (orderTotal) orderTotal.textContent = formatEuro(data.total);
                if (discountCodeLabel && code) discountCodeLabel.textContent = '(' + code + ')';
                if (removeDiscountContainer) removeDiscountContainer.style.display = '';
            } else {
                // Hide discount rows
                if (discountRow) discountRow.style.display = 'none';
                if (newTotalRow) newTotalRow.style.display = 'none';
                if (discountAmount) discountAmount.textContent = '0,00';
                if (orderNewTotal) orderNewTotal.textContent = '€ 0,00';
                if (orderTotal && data) orderTotal.textContent = formatEuro(data.total);
                if (discountCodeLabel) discountCodeLabel.textContent = '';
                if (removeDiscountContainer) removeDiscountContainer.style.display = 'none';
            }
        }

        // Apply discount code
        discountButton.addEventListener('click', (event) => {
            event.preventDefault();

            const code = discountInput.value.trim();
            const emailInput = document.querySelector('[name="billing_email"]');
            const email = emailInput ? emailInput.value.trim() : '';

            // Validation
            if (!email) {
                messageEl.textContent = 'Vul eerst een e-mailadres in.';
                messageEl.style.color = '#b30000';
                return;
            }

            if (!code) {
                messageEl.textContent = 'Vul een kortingscode in.';
                messageEl.style.color = '#b30000';
                return;
            }

            // Show loader
            if (loader) loader.style.display = 'inline-block';
            discountButton.disabled = true;

            // Send request
            axios.post('/winkel/checkout/apply-discount-code', {
                code: code,
                billing_email: email
            }, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
                .then(response => {
                    const data = response.data;

                    if (data.success) {
                        messageEl.textContent = 'Kortingscode toegepast.';
                        messageEl.style.color = 'green';
                        updateDiscountUI(data, code);
                    } else {
                        messageEl.textContent = data.message || 'Code bestaat niet.';
                        messageEl.style.color = '#b30000';
                        updateDiscountUI(null);
                    }
                })
                .catch(error => {
                    let errorMessage = 'Er is een fout opgetreden.';
                    if (error.response?.data?.message) {
                        errorMessage = error.response.data.message;
                    }
                    messageEl.textContent = errorMessage;
                    messageEl.style.color = '#b30000';
                })
                .finally(() => {
                    if (loader) loader.style.display = 'none';
                    discountButton.disabled = false;
                });
        });

        // Remove discount code
        const removeButton = document.getElementById('remove_discount_code');
        if (removeButton) {
            removeButton.addEventListener('click', () => {
                axios.delete('/winkel/checkout/remove-discount-code', {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {}
                })
                    .then(response => {
                        updateDiscountUI(response.data);
                        messageEl.textContent = 'Kortingscode verwijderd.';
                        messageEl.style.color = '#b30000';
                        discountInput.value = '';
                    })
                    .catch(() => {
                        messageEl.textContent = 'Er is een fout opgetreden.';
                        messageEl.style.color = '#b30000';
                    });
            });
        }
    }

    initDiscountCode();

    // ----------------------------------------------------------
    // MYPARCEL DELIVERY OPTIONS WIDGET
    // ----------------------------------------------------------

    function initMyParcelWidget() {
        const WIDGET_SELECTOR = '#myparcel-delivery-options';
        const myparcelRadios = document.querySelectorAll('input[name="myparcel_choice"]');

        let myparcelEnabled = false;

        // Get currently selected MyParcel choice
        function getCurrentChoice() {
            const checked = document.querySelector('input[name="myparcel_choice"]:checked');
            return checked ? checked.value : undefined;
        }

        // Get current address details
        function getCurrentAddress() {
            const useAlternate = document.getElementById('alt-shipping')?.checked;
            const prefix = useAlternate ? 'shipping_' : 'billing_';

            const street = document.querySelector(`[name="${prefix}street"]`)?.value || '';
            const number = document.querySelector(`[name="${prefix}house_number"]`)?.value || '';

            return {
                cc: document.querySelector(`[name="${prefix}country"]`)?.value || 'NL',
                postalCode: (document.querySelector(`[name="${prefix}postal_code"]`)?.value || '')
                    .replace(/\s+/g, '')
                    .toUpperCase(),
                number: number,
                street: street && number ? `${street} ${number}` : street,
                city: document.querySelector(`[name="${prefix}city"]`)?.value || '',
            };
        }

        // Check if address is complete
        function isAddressComplete(address) {
            return address && address.cc && address.postalCode &&
                address.number && address.street && address.city;
        }

        // Ensure hidden input exists
        function ensureHiddenInput() {
            let input = document.getElementById('myparcel_delivery_options');

            if (!input) {
                input = document.createElement('input');
                input.type = 'hidden';
                input.id = 'myparcel_delivery_options';
                input.name = 'myparcel_delivery_options';
                document.querySelector('form')?.appendChild(input);
            }

            return input;
        }

        // Get locale strings for widget
        function getLocaleStrings(locale) {
            const strings = {
                nl: {
                    deliveryTitle: 'Levering thuis of op het werk',
                    pickupTitle: 'Ophalen bij een afleverpunt',
                    deliveryStandard: 'Thuisbezorging',
                    free: 'Gratis',
                    close: 'Sluiten',
                    loading: 'Opties laden...',
                    // ... (include all other strings)
                },
                en: {
                    deliveryTitle: 'Home or work delivery',
                    pickupTitle: 'Pick up at a service point',
                    deliveryStandard: 'Home delivery',
                    free: 'Free',
                    close: 'Close',
                    loading: 'Loading options...',
                    // ... (include all other strings)
                }
            };

            return strings[locale] || strings['en'];
        }

        // Update MyParcel widget
        function updateWidget() {
            if (!myparcelEnabled) return;

            const address = getCurrentAddress();
            const container = document.querySelector(WIDGET_SELECTOR);

            if (!container) return;

            // Hide if address incomplete
            if (!isAddressComplete(address)) {
                container.style.display = 'none';
                ensureHiddenInput().value = '';
                return;
            }

            container.style.display = '';

            // Get locale
            let locale = document.documentElement.lang ||
                document.querySelector('meta[name="app-locale"]')?.content;
            if (!locale || locale.length < 2) locale = 'en';

            // Configure widget
            const configuration = {
                selector: WIDGET_SELECTOR,
                address: address,
                config: {
                    platform: 'myparcel',
                    locale: locale,
                    packageType: 'package',
                    dropOffDelay: 1,
                    deliveryDaysWindow: 0,
                    allowPickupLocationsViewSelection: true,
                    pickupLocationsDefaultView: 'list',
                    showPriceZeroAsFree: false,
                    carrierSettings: {
                        postnl: {
                            allowDeliveryOptions: true,
                            allowStandardDelivery: true,
                            allowPickupLocations: true,
                        }
                    }
                },
                strings: getLocaleStrings(locale)
            };

            // Dispatch to widget
            document.dispatchEvent(
                new CustomEvent('myparcel_update_delivery_options', {
                    detail: configuration
                })
            );
        }

        // Listen for widget updates
        document.addEventListener('myparcel_updated_delivery_options', (event) => {
            if (!myparcelEnabled) return;

            console.log('[MyParcel] Updated:', event.detail);
            const input = ensureHiddenInput();
            input.value = event.detail ? JSON.stringify(event.detail) : '';
        });

        // Listen for errors
        document.addEventListener('myparcel_error_delivery_options', (event) => {
            console.error('[MyParcel] Error:', event.detail);
        });

        // Attach address field listeners (only once)
        let listenersAttached = false;
        function attachAddressListeners() {
            if (listenersAttached) return;
            listenersAttached = true;

            const fields = [
                'billing_country', 'billing_postal_code', 'billing_street',
                'billing_house_number', 'billing_city',
                'shipping_country', 'shipping_postal_code', 'shipping_street',
                'shipping_house_number', 'shipping_city', 'alt-shipping'
            ];

            fields.forEach(fieldName => {
                const element = document.querySelector(`[name="${fieldName}"]`);
                if (element) {
                    element.addEventListener('input', updateWidget);
                    element.addEventListener('change', updateWidget);
                }
            });
        }

        // Enable MyParcel widget
        function enableWidget() {
            if (myparcelEnabled) return;

            myparcelEnabled = true;
            const container = document.querySelector(WIDGET_SELECTOR);
            if (container) container.style.display = '';

            attachAddressListeners();
            updateWidget();
        }

        // Disable MyParcel widget
        function disableWidget() {
            if (!myparcelEnabled) return;

            myparcelEnabled = false;
            const container = document.querySelector(WIDGET_SELECTOR);

            if (container) {
                container.style.display = 'none';
                container.innerHTML = '';
            }

            const input = document.getElementById('myparcel_delivery_options');
            if (input) {
                input.value = '';
                input.remove();
            }
        }

        // Listen for radio changes
        myparcelRadios.forEach(radio => {
            radio.addEventListener('change', (event) => {
                if (!event.target.checked) return;

                const choice = event.target.value;
                console.log('MyParcel choice:', choice);

                if (choice === 'with_myparcel') {
                    enableWidget();
                } else {
                    disableWidget();
                }
            });
        });

        // Initialize based on current selection
        const currentChoice = getCurrentChoice();
        if (currentChoice === 'with_myparcel') {
            enableWidget();
        } else {
            disableWidget();
        }
    }

    initMyParcelWidget();

    // ----------------------------------------------------------
    // UNIVERSAL CONFIRMATION MODALS
    // ----------------------------------------------------------

    function setupConfirmationModals() {
        document.querySelectorAll('form.needs-confirm').forEach(form => {
            const formId = form.id;
            let buttons = [];

            // Find buttons associated with this form
            if (formId) {
                buttons = Array.from(document.querySelectorAll(`button[form='${formId}']`));
            }

            const insideButton = form.querySelector('button[type="submit"]');
            if (insideButton) buttons.push(insideButton);

            // Remove duplicates
            buttons = Array.from(new Set(buttons));

            buttons.forEach(button => {
                if (!button) return;

                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    const message = form.getAttribute('data-confirm') || 'Weet je het zeker?';

                    window.showConfirmModal(message, function() {
                        showLoaderAndDisable(button);
                        form.submit();

                        // Safety timeout
                        setTimeout(() => hideLoaderAndEnable(button), 5000);
                    }, button);
                });
            });
        });
    }

    setupConfirmationModals();

    // ----------------------------------------------------------
    // PASSWORD SHOW/HIDE TOGGLE
    // ----------------------------------------------------------

    function setupPasswordToggles() {
        document.querySelectorAll('input[type="password"]').forEach(input => {
            // Skip if already wrapped
            if (input.parentElement?.classList.contains('password-toggle-container')) {
                return;
            }

            // Create wrapper container
            const container = document.createElement('div');
            container.className = 'password-toggle-container';
            container.style.position = 'relative';

            input.parentNode.insertBefore(container, input);
            container.appendChild(input);

            // Create toggle button
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'password-toggle-btn';
            button.style.position = 'absolute';
            button.style.right = '8px';
            button.style.top = '50%';
            button.style.transform = 'translateY(-50%)';
            button.style.background = 'none';
            button.style.border = 'none';
            button.style.cursor = 'pointer';
            button.style.padding = '0';
            button.style.zIndex = '2';
            button.innerHTML = '<i style="font-size: 20px;color: var(--main-font-color);opacity: 0.5" class="fa fa-eye"></i>';

            container.appendChild(button);

            // Toggle visibility
            button.addEventListener('click', () => {
                if (input.type === 'password') {
                    input.type = 'text';
                    button.innerHTML = '<i style="font-size: 20px;color: var(--main-font-color);opacity: 0.5" class="fa fa-eye-slash"></i>';
                } else {
                    input.type = 'password';
                    button.innerHTML = '<i style="font-size: 20px;color: var(--main-font-color);opacity: 0.5" class="fa fa-eye"></i>';
                }
            });
        });
    }

    setupPasswordToggles();

    // ----------------------------------------------------------
    // ANIMATED CLOCK (realtime)
    // ----------------------------------------------------------

    function initAnimatedClock() {
        const hourHand = document.querySelector('.css-hour-hand');
        const minuteHand = document.querySelector('.css-minute-hand');
        const secondHand = document.querySelector('.css-second-hand');

  // ------------------------------------------------------------
  // Livewire Cart Events
  // ------------------------------------------------------------
  function updateCartBadge(totalQuantity) {
    // Update all cart quantity badges
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
      showToast(message, false);
    });

    Livewire.on('cart-error', (event) => {
      const message = event[0]?.message || event?.message || 'Er is een fout opgetreden.';
      showToast(message, true);
    });
  }

  // Also listen for browser events (fallback)
  window.addEventListener('cart-updated', (event) => {
    const totalQuantity = event.detail?.totalQuantity || 0;
    updateCartBadge(totalQuantity);
  });

  window.addEventListener('cart-success', (event) => {
    const message = event.detail?.message || 'Product toegevoegd aan winkelwagen!';
    showToast(message, false);
  });

  window.addEventListener('cart-error', (event) => {
    const message = event.detail?.message || 'Er is een fout opgetreden.';
    showToast(message, true);
  });

    /* ===== Realtime klok-animatie =====
       Bereken elke frame de echte tijd → geen drift, altijd synchroon.
       Wil je versnellen/vertragen? Zet multipliers <> 1.
    */
    (function(){
        const hourEl   = document.querySelector('.css-hour-hand');
        const minuteEl = document.querySelector('.css-minute-hand');
        const secondEl = document.querySelector('.css-second-hand');

        // Only run clock animation if all elements exist
        if (!hourEl || !minuteEl || !secondEl) return;

        const speed = { hour: 400, minute: 100, second: 4 }; // 1 = realtime

        function updateClock() {
            const now = new Date();

            // Get time components
            const hours = now.getHours() % 12;
            const minutes = now.getMinutes();
            const seconds = now.getSeconds();
            const milliseconds = now.getMilliseconds();

            // Calculate angles (with smooth transitions)
            const secondAngle = ((seconds + milliseconds / 1000) * 6) * speed.second;
            const minuteAngle = ((minutes + (seconds + milliseconds / 1000) / 60) * 6) * speed.minute;
            const hourAngle = ((hours + (minutes + seconds / 60) / 60) * 30) * speed.hour;

            // Apply rotation
            hourHand.style.transform = `translate(-50%, 0) rotate(${hourAngle}deg)`;
            minuteHand.style.transform = `translate(-50%, 0) rotate(${minuteAngle}deg)`;
            secondHand.style.transform = `translate(-50%, 0) rotate(${secondAngle}deg)`;

            requestAnimationFrame(updateClock);
        }

        requestAnimationFrame(updateClock);
    }

    initAnimatedClock();

    // ----------------------------------------------------------
    // LIVEWIRE CART EVENTS
    // ----------------------------------------------------------

    initLivewireCart();
    initProductSwiper();

    // ----------------------------------------------------------
    // HOME PAGE "READ MORE" MODAL
    // ----------------------------------------------------------

    function initReadMoreModal() {
        const modal = document.getElementById('leesMeerModal');
        const openButton = document.getElementById('openModalBtn');
        const closeButton = document.getElementById('closeModalBtn');
        const content = document.getElementById('scrollModalContent');

        if (!modal || !openButton || !closeButton || !content) return;

        // Initially hide modal
        modal.classList.add('hidden');

        function openModal() {
            modal.classList.remove('hidden');
            // Force reflow to allow transition
            void modal.offsetWidth;
            modal.classList.add('show');
            modal.classList.remove('fading-out');
            scrollModalContent.classList.remove('close');
            setTimeout(function() {
                scrollModalContent.classList.add('open');
            }, 10);
        }
        function closeScrollModal() {
            scrollModalContent.classList.remove('open');
            scrollModalContent.classList.add('close');
            modal.classList.add('fading-out');
            modal.classList.remove('show');
            setTimeout(function() {
                modal.classList.add('hidden');
                modal.classList.remove('fading-out');
                scrollModalContent.classList.remove('close');
            }, 1100); // match the new slower transition duration
        }
        // Initially hide modal
        modal.classList.add('hidden');
        openBtn.addEventListener('click', openScrollModal);
        closeBtn.addEventListener('click', closeScrollModal);
        window.addEventListener('click', function(e) {
            if (e.target === modal || e.target.classList.contains('custom-modal-overlay')) {
                closeScrollModal();
            }
        });
        window.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeScrollModal();
            }
        });
    }

        // Event listeners
        openButton.addEventListener('click', openModal);
        closeButton.addEventListener('click', closeModal);

        // Close on backdrop click
        window.addEventListener('click', (event) => {
            if (event.target === modal || event.target.classList.contains('custom-modal-overlay')) {
                closeModal();
            }
        });

        // Close on Escape key
        window.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    }

    initReadMoreModal();

    // ----------------------------------------------------------
    // HEADER SCROLL EFFECT (hide on scroll down, show on scroll up)
    // ----------------------------------------------------------

    function initHeaderScrollEffect() {
        const header = document.querySelector('.header');
        if (!header) return;

        const SCROLL_DELTA = 10; // Minimum scroll distance to trigger
        const SCROLLED_THRESHOLD = 50; // When header switches to "scrolled" state

        let lastScrollY = window.scrollY || 0;
        let ticking = false;

        // Get logo elements
        const logoContainer = header.querySelector('.logo-container');
        const logoImg = logoContainer ? logoContainer.querySelector('img') : header.querySelector('img');

        // Set initial state
        if (window.scrollY > SCROLLED_THRESHOLD) {
            header.classList.add('scrolled');
            logoContainer?.classList.add('logo-hidden');
            logoImg?.classList.add('logo-hidden-img');
        } else {
            header.classList.remove('scrolled');
            logoContainer?.classList.remove('logo-hidden');
            logoImg?.classList.remove('logo-hidden-img');
        }

        // Handle scroll
        window.addEventListener('scroll', () => {
            if (ticking) return;

            ticking = true;

            requestAnimationFrame(() => {
                const currentScrollY = window.scrollY || 0;

                // Ignore small movements
                if (Math.abs(currentScrollY - lastScrollY) <= SCROLL_DELTA) {
                    ticking = false;
                    return;
                }

                const isMobile = window.innerWidth <= 992;
                const logoThreshold = isMobile ? 60 : 100;

                if (currentScrollY <= 0) {
                    // At top - show everything
                    header.classList.remove('scrolled');
                    logoContainer?.classList.remove('logo-hidden');
                    logoImg?.classList.remove('logo-hidden-img');
                } else if (currentScrollY > lastScrollY) {
                    // Scrolling down - hide logo
                    header.classList.add('scrolled');
                    logoContainer?.classList.add('logo-hidden');
                    logoImg?.classList.add('logo-hidden-img');
                } else {
                    // Scrolling up
                    if (currentScrollY <= logoThreshold) {
                        // Close to top - show logo
                        header.classList.remove('scrolled');
                        logoContainer?.classList.remove('logo-hidden');
                        logoImg?.classList.remove('logo-hidden-img');
                    } else {
                        // Far from top - show header but hide logo
                        header.classList.remove('scrolled');
                        logoContainer?.classList.add('logo-hidden');
                        logoImg?.classList.add('logo-hidden-img');
                    }
                }

                lastScrollY = currentScrollY;
                ticking = false;
            });
        });

        // Handle viewport resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                const currentScrollY = window.scrollY || 0;
                const isMobile = window.innerWidth <= 992;
                const logoThreshold = isMobile ? 60 : 100;

                // Re-apply state with new breakpoint
                if (currentScrollY <= 0) {
                    header.classList.remove('scrolled');
                    logoContainer?.classList.remove('logo-hidden');
                    logoImg?.classList.remove('logo-hidden-img');
                } else if (currentScrollY <= logoThreshold) {
                    header.classList.remove('scrolled');
                    logoContainer?.classList.remove('logo-hidden');
                    logoImg?.classList.remove('logo-hidden-img');
                } else {
                    header.classList.remove('scrolled');
                    logoContainer?.classList.add('logo-hidden');
                    logoImg?.classList.add('logo-hidden-img');
                }
            }, 150);
        });
    }

    initHeaderScrollEffect();

    // ----------------------------------------------------------
    // MUTATION OBSERVER (handle dynamic content)
    // ----------------------------------------------------------

    // Watch for new content and re-initialize features
    new MutationObserver((mutations) => {
        enableAllSubmitButtons();

        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType !== 1) return; // Only element nodes

                // Handle new forms
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

    // Helper to setup loader for a form
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

});
