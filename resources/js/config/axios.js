// Axios configuration for API requests

import axios from 'axios';

/**
 * Initialize Axios with CSRF token
 */
export function initAxios() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (csrfToken) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
    }
}

export default axios;
