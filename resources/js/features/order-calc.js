// Order calculation (instant price updates)

import { formatEuro } from '../utils/format.js';

/**
 * Initialize order calculation with live updates
 */
export function initOrderCalculation() {
    const qtyInputs = document.querySelectorAll('.qty-input');
    if (qtyInputs.length === 0) return;

    const totalEl = document.getElementById('total-price');
    const discountedTotalEl = document.getElementById('discounted-total');
    const discountValueInput = document.getElementById('discount_value');
    const discountTypeSelect = document.getElementById('discount_type');

    function updatePrices() {
        let total = 0;

        qtyInputs.forEach(input => {
            const quantity = parseFloat(input.value) || 0;
            const price = parseFloat(input.dataset.price) || 0;
            const itemId = input.dataset.id;
            const subtotal = quantity * price;

            total += subtotal;

            const subtotalEl = document.getElementById(`sub-item-price-${itemId}`);
            if (subtotalEl) {
                subtotalEl.innerText = quantity > 0 ? formatEuro(subtotal) : '';
            }
        });

        if (totalEl) {
            totalEl.innerText = total > 0 ? ' - Totaal: ' + formatEuro(total) : '';
        }

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

    qtyInputs.forEach(input => {
        input.addEventListener('input', updatePrices);
        input.addEventListener('change', updatePrices);
    });

    discountValueInput?.addEventListener('input', updatePrices);
    discountTypeSelect?.addEventListener('change', updatePrices);

    updatePrices();
}
