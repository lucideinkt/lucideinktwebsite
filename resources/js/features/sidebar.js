// Sidebar toggle functionality

/**
 * Initialize sidebar toggles (main and admin sidebars)
 */
export function initSidebarToggles() {
    // Main sidebar
    const sidebar = document.querySelector('.sidebar');
    const toggleBtn = document.querySelector('.sidebar-toggle');
    const closeBtn = document.querySelector('.close-toggle');

    if (sidebar && toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
    }

    if (sidebar && closeBtn) {
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('open');
        });
    }

    // Dropdown toggles in sidebar (mobile)
    const sidebarDropdowns = sidebar?.querySelectorAll('.nav-item.dropdown > a');
    if (sidebarDropdowns) {
        sidebarDropdowns.forEach(dropdownLink => {
            // Variable to track if we've handled the interaction
            let touchHandled = false;

            // Handle touch events (mobile)
            dropdownLink.addEventListener('touchstart', (e) => {
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    touchHandled = true;
                    const parentLi = dropdownLink.closest('.nav-item.dropdown');
                    if (parentLi) {
                        parentLi.classList.toggle('open');
                    }
                }
            }, { passive: false });

            // Handle click events (backup for non-touch devices)
            dropdownLink.addEventListener('click', (e) => {
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    // If touch already handled this, skip
                    if (touchHandled) {
                        touchHandled = false;
                        return;
                    }
                    const parentLi = dropdownLink.closest('.nav-item.dropdown');
                    if (parentLi) {
                        parentLi.classList.toggle('open');
                    }
                }
            });
        });
    }

    // Dashboard sidebar
    const adminSidebar = document.querySelector('.sidebar.admin-panel');
    const adminToggle = document.querySelector('.admin-sidebar-toggle');
    const adminContainer = document.querySelector('.container.page.dashboard');

    if (adminSidebar && adminToggle && adminContainer) {
        adminToggle.addEventListener('click', () => {
            [adminSidebar, adminToggle, adminContainer].forEach(el => {
                el.classList.toggle('open');
                el.classList.toggle('close');
            });
        });
    }
}
