import 'flowbite';
import axios from 'axios';

// CSRF token for all Axios requests
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
}
window.axios = axios;

// Dark mode — class-based, dashboard only
(function () {
    const root = document.documentElement;
    if (localStorage.getItem('dashboard-theme') === 'dark') {
        root.classList.add('dark');
    }

    window.toggleDashboardTheme = function () {
        const isDark = root.classList.toggle('dark');
        localStorage.setItem('dashboard-theme', isDark ? 'dark' : 'light');
        updateToggleIcon(isDark);
    };

    function updateToggleIcon(isDark) {
        const sunIcon = document.getElementById('theme-icon-sun');
        const moonIcon = document.getElementById('theme-icon-moon');
        if (!sunIcon || !moonIcon) return;
        if (isDark) {
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        } else {
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateToggleIcon(root.classList.contains('dark'));
    });
})();

// ─── Global form loading state ────────────────────────────────────────────────
//
// When any dashboard form is submitted:
//   • The submit button is disabled (prevents double-submit)
//   • A spinner replaces its icon and the label reads "Laden…"
// Forms that handle their own loading state set  data-no-loading="1"  on the
// <form> element and are skipped here.
// ─────────────────────────────────────────────────────────────────────────────
(function () {
    const SPINNER_HTML =
        '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">' +
        '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>' +
        '<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.854 3 7.938l3-2.647z"></path>' +
        '</svg>';

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form').forEach(function (form) {
            // Skip forms that manage their own state (e.g. newsletter AJAX send)
            if (form.dataset.noLoading) return;

            form.addEventListener('submit', function (e) {
                // If the inline onsubmit (e.g. confirm dialog) cancelled the
                // submission, defaultPrevented is true — don't show the spinner.
                if (e.defaultPrevented) return;

                const btn = form.querySelector('button[type="submit"], input[type="submit"]');
                if (!btn || btn.disabled) return;

                btn.disabled          = true;
                btn.style.opacity     = '0.7';
                btn.style.cursor      = 'not-allowed';

                // Preserve original content so it can be restored on back-navigation
                if (!btn.dataset.originalHtml) {
                    btn.dataset.originalHtml = btn.innerHTML;
                }
                if (btn.tagName === 'BUTTON') {
                    btn.innerHTML = SPINNER_HTML + 'Laden…';
                }
            });
        });

        // Restore buttons when the user navigates back (bfcache)
        window.addEventListener('pageshow', function (e) {
            if (e.persisted) {
                document.querySelectorAll('button[type="submit"][data-original-html]').forEach(function (btn) {
                    btn.innerHTML     = btn.dataset.originalHtml;
                    btn.disabled      = false;
                    btn.style.opacity = '';
                    btn.style.cursor  = '';
                });
            }
        });
    });
})();

