// Shipping cost calculator

import { formatEuro } from '../utils/format.js';

/**
 * Initialize shipping cost calculator
 * Updates shipping costs dynamically based on selected country
 */
export function initShippingCostCalculator() {
    const shippingCostEl = document.getElementById('shipping-cost');
    const orderTotalEl = document.getElementById('order-total');
    const altShippingCheckbox = document.getElementById('alt-shipping');
    // Support both select (no Google Maps) and hidden input (Google Maps mode)
    const billingCountrySelect = document.querySelector('select[name="billing_country"]');
    const billingCountryInput = document.getElementById('billing_country');
    const shippingCountrySelect = document.querySelector('select[name="shipping_country"]');
    const shippingCountryInput = document.getElementById('shipping_country');

    function getSelectedCountry() {
        if (altShippingCheckbox?.checked) {
            const val = shippingCountrySelect?.value || shippingCountryInput?.value;
            if (val) return val;
        }
        return billingCountrySelect?.value || billingCountryInput?.value || '';
    }

    function updateShippingCost() {
        if (!shippingCostEl || !orderTotalEl) return;

        const country = getSelectedCountry();
        const subtotal = parseFloat(orderTotalEl.dataset.subtotal) || 0;

        if (!country) {
            shippingCostEl.textContent = '';
            orderTotalEl.textContent = '€ ' + subtotal.toFixed(2).replace('.', ',');
            return;
        }

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

    // Listen for Google Places autocomplete country change (hidden input mode)
    document.addEventListener('countryChanged', updateShippingCost);
    // Listen for select changes (fallback mode)
    billingCountrySelect?.addEventListener('change', updateShippingCost);
    shippingCountrySelect?.addEventListener('change', updateShippingCost);
    // Listen for hidden input changes (dispatched by autocomplete)
    billingCountryInput?.addEventListener('change', updateShippingCost);
    shippingCountryInput?.addEventListener('change', updateShippingCost);
    altShippingCheckbox?.addEventListener('change', updateShippingCost);

    updateShippingCost();
}
