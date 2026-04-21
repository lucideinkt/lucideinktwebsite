// ============================================================
// ALERT AUTO-DISMISS
// All alerts are toasts — slide in from right, slide out after delay.
// No close button interaction needed.
// ============================================================

export function initAlerts() {
    document.querySelectorAll('.alert').forEach(function (el) {
        var timer = setTimeout(function () { dismiss(el); }, 6000);

        // Pause on hover, give 2 s extra on mouse leave
        el.addEventListener('mouseenter', function () { clearTimeout(timer); });
        el.addEventListener('mouseleave', function () {
            timer = setTimeout(function () { dismiss(el); }, 2000);
        });
    });
}

function dismiss(el) {
    el.classList.add('toast-hide');
    el.addEventListener('animationend', function () { el.remove(); }, { once: true });
}
