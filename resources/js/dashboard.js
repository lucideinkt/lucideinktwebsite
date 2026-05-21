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
