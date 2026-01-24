// Sidebar toggle functionality

/**
 * Initialize sidebar toggles (main and admin sidebars)
 */
export function initSidebarToggles() {
    // Main sidebar
    const sidebar = document.querySelector('.sidebar');
    const toggleBtn = document.querySelector('.sidebar-toggle');
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

    if (sidebar && toggleBtn) {
        toggleBtn.addEventListener('click', () => {
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

    // Dropdown toggles in sidebar (mobile)
    const sidebarDropdowns = sidebar?.querySelectorAll('.nav-item.dropdown > a');
    if (sidebarDropdowns) {
        sidebarDropdowns.forEach(dropdownLink => {
            // Variable to track if we've handled the interaction
            let touchHandled = false;

            // Handle touch events (mobile)
            dropdownLink.addEventListener('touchstart', (e) => {
                // Prevent navigation and toggle dropdown on touch
                e.preventDefault();
                touchHandled = true;
                const parentLi = dropdownLink.closest('.nav-item.dropdown');
                if (parentLi) {
                    // Close other open dropdowns
                    document.querySelectorAll('.sidebar .nav-item.dropdown.open').forEach(function (item) {
                        if (item !== parentLi) item.classList.remove('open');
                    });
                    parentLi.classList.toggle('open');
                }
            }, { passive: false });

            // Handle click events (desktop / non-touch)
            dropdownLink.addEventListener('click', (e) => {
                // Prevent navigation and toggle dropdown
                e.preventDefault();
                // If touch already handled this, skip
                if (touchHandled) {
                    touchHandled = false;
                    return;
                }
                const parentLi = dropdownLink.closest('.nav-item.dropdown');
                if (parentLi) {
                    // Close other open dropdowns
                    document.querySelectorAll('.sidebar .nav-item.dropdown.open').forEach(function (item) {
                        if (item !== parentLi) item.classList.remove('open');
                    });
                    parentLi.classList.toggle('open');
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

// SIDEBAR DROPDOWN: Only for .sidebar .nav-item.dropdown
export function setupSidebarDropdowns() {
    // Remove all open classes on load
    document.querySelectorAll('.sidebar .nav-item.dropdown').forEach(function (item) {
        item.classList.remove('open');
    });
    // Add click event to toggle dropdown
    document.querySelectorAll('.sidebar .nav-item.dropdown > a').forEach(function (dropdownToggle) {
        dropdownToggle.addEventListener('click', function (e) {
            e.preventDefault();
            var parent = this.parentElement;
            // Close all other dropdowns
            document.querySelectorAll('.sidebar .nav-item.dropdown.open').forEach(function (item) {
                if (item !== parent) item.classList.remove('open');
            });
            // Toggle this dropdown
            parent.classList.toggle('open');
        });
    });
}
