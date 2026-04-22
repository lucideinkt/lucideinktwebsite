// Copy payment link functionality

import { showToast } from '../utils/toast.js';

/**
 * Initialize copy payment link button
 */
export function initCopyPaymentLink() {
    const copyBtn = document.getElementById('copy-payment-link');
    if (!copyBtn) return;

    const explicitLink = copyBtn.dataset.paymentLink;
    const anchorLink = document.querySelector('#payment-link a')?.href || '';
    const linkToCopy = explicitLink || anchorLink;

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

        if (navigator.clipboard?.writeText) {
            navigator.clipboard.writeText(linkToCopy)
                .then(() => showToast('Betaallink gekopieerd naar klembord'))
                .catch(() => fallbackCopy(linkToCopy));
        } else {
            fallbackCopy(linkToCopy);
        }
    });
}
