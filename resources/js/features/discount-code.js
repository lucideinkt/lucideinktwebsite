// Discount code functionality

import axios from '../config/axios.js';
import { formatEuro } from '../utils/format.js';

/**
 * Update discount display in UI
 * @param {Object} data - Discount data from API
 * @param {string} code - Discount code
 */
function updateDiscountUI(data, code) {
    const discountRow = document.getElementById('discount-row');
    const newTotalRow = document.getElementById('new-total-row');
    const discountAmount = document.getElementById('discount-amount');
    const orderTotal = document.getElementById('order-total');
    const orderNewTotal = document.getElementById('order-new-total');
    const discountCodeLabel = document.getElementById('discount-code-label');
    const removeDiscountContainer = document.getElementById('remove-discount-container');

    if (data && data.discount_amount > 0) {
        const isPercent = data.discount?.discount_type === 'percent';
        const displayDiscount = isPercent
            ? `${Number(data.discount.discount)}%`
            : formatEuro(data.discount_amount);

        if (discountRow) discountRow.style.display = '';
        if (newTotalRow) newTotalRow.style.display = '';
        if (discountAmount) discountAmount.textContent = displayDiscount;
        if (orderNewTotal) orderNewTotal.textContent = formatEuro(data.new_total);
        if (orderTotal) orderTotal.textContent = formatEuro(data.total);
        if (discountCodeLabel && code) discountCodeLabel.textContent = '(' + code + ')';
        if (removeDiscountContainer) removeDiscountContainer.style.display = '';
    } else {
        if (discountRow) discountRow.style.display = 'none';
        if (newTotalRow) newTotalRow.style.display = 'none';
        if (discountAmount) discountAmount.textContent = '0,00';
        if (orderNewTotal) orderNewTotal.textContent = '€ 0,00';
        if (orderTotal && data) orderTotal.textContent = formatEuro(data.total);
        if (discountCodeLabel) discountCodeLabel.textContent = '';
        if (removeDiscountContainer) removeDiscountContainer.style.display = 'none';
    }
}

/**
 * Initialize discount code functionality
 */
export function initDiscountCode() {
    const discountButton = document.getElementById('add_discount_code');
    const discountInput = document.getElementById('discount_code');
    let messageEl = document.getElementById('discount_code_msg');

    if (!discountButton || !discountInput) return;

    if (!messageEl) {
        messageEl = document.createElement('div');
        messageEl.id = 'discount_code_msg';
        messageEl.style.marginTop = '6px';
        messageEl.style.fontSize = '15px';
        discountInput.parentNode.appendChild(messageEl);
    }

    const loader = discountButton.querySelector('.loader');
    if (loader) loader.style.display = 'none';

    discountButton.addEventListener('click', (event) => {
        event.preventDefault();

        const code = discountInput.value.trim();
        const emailInput = document.querySelector('[name="billing_email"]');
        const email = emailInput ? emailInput.value.trim() : '';

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

        if (loader) loader.style.display = 'inline-block';
        discountButton.disabled = true;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

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

    const removeButton = document.getElementById('remove_discount_code');
    if (removeButton) {
        removeButton.addEventListener('click', () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

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
