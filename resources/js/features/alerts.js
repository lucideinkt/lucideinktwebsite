// ============================================================
// ALERT AUTO-DISMISS
// All alerts are toasts — slide in from right, slide out after delay.
// ============================================================

export function initAlerts() {
    document.querySelectorAll('.alert').forEach(function (el) {
        var timer = setTimeout(function () { dismiss(el); }, 10000);

        // Pause on hover, give 3 s extra on mouse leave
        el.addEventListener('mouseenter', function () { clearTimeout(timer); });
        el.addEventListener('mouseleave', function () {
            timer = setTimeout(function () { dismiss(el); }, 3000);
        });

        // Wire up close button with animation
        var closeBtn = el.querySelector('.alert-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                clearTimeout(timer);
                dismiss(el);
            });
        }
    });
}

function dismiss(el) {
    el.classList.add('toast-hide');
    el.addEventListener('animationend', function () { el.remove(); }, { once: true });
}
