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
            dropdownLink.addEventListener('click', (e) => {
                // Only prevent default on mobile (when sidebar is visible)
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    const parentLi = dropdownLink.closest('.nav-item.dropdown');
                    if (parentLi) {
                        const wasOpen = parentLi.classList.contains('open');
                        parentLi.classList.toggle('open');
                        console.log('Dropdown toggled:', wasOpen ? 'closed' : 'opened', parentLi);
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
