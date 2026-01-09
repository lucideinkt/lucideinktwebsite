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
    const billingCountrySelect = document.querySelector('select[name="billing_country"]');
    const shippingCountrySelect = document.querySelector('select[name="shipping_country"]');

    function getSelectedCountry() {
        if (altShippingCheckbox?.checked && shippingCountrySelect) {
            return shippingCountrySelect.value;
        }
        return billingCountrySelect?.value || 'NL';
    }

    function updateShippingCost() {
        if (!shippingCostEl || !orderTotalEl) return;

        const country = getSelectedCountry();
        if (!country) return;

        fetch(`/api/shipping-cost?country=${country}`)
            .then(response => response.json())
            .then(data => {
                const cost = parseFloat(data.cost) || 0;
                shippingCostEl.textContent = 'Verzendkosten: ' + formatEuro(cost);

                let subtotal = 0;
                if (orderTotalEl.dataset.subtotal) {
                    subtotal = parseFloat(orderTotalEl.dataset.subtotal);
                } else {
                    const match = orderTotalEl.textContent.replace(',', '.').match(/([\d\.]+)/);
                    subtotal = match ? parseFloat(match[1]) : 0;
                }

                orderTotalEl.textContent = 'Totaal: ' + formatEuro(subtotal + cost);
            });
    }

    billingCountrySelect?.addEventListener('change', updateShippingCost);
    shippingCountrySelect?.addEventListener('change', updateShippingCost);
    altShippingCheckbox?.addEventListener('change', updateShippingCost);

    updateShippingCost();
}
