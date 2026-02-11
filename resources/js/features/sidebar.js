// Sidebar toggle functionality

/**
 * Initialize sidebar toggles (main and admin sidebars)
 */
export function initSidebarToggles() {
    // Main sidebar
    const sidebar = document.querySelector('.sidebar');
    const toggleBtn = document.querySelector('.sidebar-toggle');
    const desktopToggleBtn = document.querySelector('.desktop-hamburger-toggle');
    const closeBtn = document.querySelector('.close-toggle');

    // Create overlay element
    let overlay = document.querySelector('.sidebar-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);
    }

    // Function to open sidebar
    function openSidebar() {
        sidebar?.classList.add('open');
        overlay?.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    // Function to close sidebar
    function closeSidebar() {
        sidebar?.classList.remove('open');
        overlay?.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    }

    // Mobile sidebar toggle
    if (sidebar && toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    // Desktop hamburger toggle (appears when scrolled)
    if (sidebar && desktopToggleBtn) {
        desktopToggleBtn.addEventListener('click', () => {
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    if (sidebar && closeBtn) {
        closeBtn.addEventListener('click', closeSidebar);
    }

    // Close sidebar when clicking on overlay
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Dropdown toggles in sidebar - Works for both mobile and desktop
    const sidebarDropdowns = sidebar?.querySelectorAll('.nav-item.dropdown > a');
    if (sidebarDropdowns && sidebarDropdowns.length > 0) {
        sidebarDropdowns.forEach(dropdownLink => {
            // Handle click events for dropdown toggle
            dropdownLink.addEventListener('click', (e) => {
                // Always prevent navigation for dropdown links
                e.preventDefault();
                e.stopPropagation();

                const parentLi = dropdownLink.closest('.nav-item.dropdown');
                if (parentLi) {
                    const isOpen = parentLi.classList.contains('open');

                    // Close all open dropdowns first
                    document.querySelectorAll('.sidebar .nav-item.dropdown.open').forEach(function (item) {
                        item.classList.remove('open');
                    });

                    // Toggle this dropdown (opposite of previous state)
                    if (!isOpen) {
                        parentLi.classList.add('open');
                    }
                }

                return false; // Extra safeguard against navigation
            });

            // Also prevent default on touchstart for mobile
            dropdownLink.addEventListener('touchstart', (e) => {
                // Don't prevent default here as it will be handled by click
            }, { passive: true });
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

        // Close button inside admin sidebar (top-right)
        const adminClose = adminSidebar.querySelector('.close-toggle');
        if (adminClose) {
            adminClose.addEventListener('click', () => {
                // ensure classes mirror the closed state
                adminSidebar.classList.remove('open');
                adminSidebar.classList.add('close');

                adminToggle.classList.remove('open');
                adminToggle.classList.add('close');

                adminContainer.classList.remove('open');
                adminContainer.classList.add('close');
            });
        }
    }
}

// SIDEBAR DROPDOWN: Reset dropdown states
export function setupSidebarDropdowns() {
    // Remove all open classes on load to ensure clean state
    document.querySelectorAll('.sidebar .nav-item.dropdown').forEach(function (item) {
        item.classList.remove('open');
    });
}
