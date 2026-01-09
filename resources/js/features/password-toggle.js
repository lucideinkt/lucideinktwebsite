// Password show/hide toggle

/**
 * Initialize password visibility toggles
 */
export function setupPasswordToggles() {
    document.querySelectorAll('input[type="password"]').forEach(input => {
        if (input.parentElement?.classList.contains('password-toggle-container')) {
            return;
        }

        const container = document.createElement('div');
        container.className = 'password-toggle-container';
        container.style.position = 'relative';

        input.parentNode.insertBefore(container, input);
        container.appendChild(input);

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'password-toggle-btn';
        button.style.position = 'absolute';
        button.style.right = '8px';
        button.style.top = '50%';
        button.style.transform = 'translateY(-50%)';
        button.style.background = 'none';
        button.style.border = 'none';
        button.style.cursor = 'pointer';
        button.style.padding = '0';
        button.style.zIndex = '2';
        button.innerHTML = '<i style="font-size: 20px;color: var(--main-font-color);opacity: 0.5" class="fa fa-eye"></i>';

        container.appendChild(button);

        button.addEventListener('click', () => {
            if (input.type === 'password') {
                input.type = 'text';
                button.innerHTML = '<i style="font-size: 20px;color: var(--main-font-color);opacity: 0.5" class="fa fa-eye-slash"></i>';
            } else {
                input.type = 'password';
                button.innerHTML = '<i style="font-size: 20px;color: var(--main-font-color);opacity: 0.5" class="fa fa-eye"></i>';
            }
        });
    });
}
