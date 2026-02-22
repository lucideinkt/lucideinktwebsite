// Read more modal (homepage)

/**
 * Initialize read more modal
 */
export function initReadMoreModal() {
    const modal = document.getElementById('leesMeerModal');
    const openButton = document.getElementById('openModalBtn');
    const closeButton = document.getElementById('closeModalBtn');
    const content = document.getElementById('scrollModalContent');

    if (!modal || !openButton || !closeButton || !content) return;

    modal.classList.add('hidden');

    function openModal() {
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.add('show');
        modal.classList.remove('fading-out');
        content.classList.remove('close');

        // Prevent background scrolling
        document.body.style.overflow = 'hidden';

        setTimeout(() => content.classList.add('open'), 10);
    }

    function closeModal() {
        content.classList.remove('open');
        content.classList.add('close');
        modal.classList.add('fading-out');
        modal.classList.remove('show');

        // Re-enable background scrolling immediately
        document.body.style.overflow = '';

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('fading-out');
            content.classList.remove('close');
        }, 1100);
    }

    openButton.addEventListener('click', openModal);
    closeButton.addEventListener('click', closeModal);

    window.addEventListener('click', (event) => {
        if (event.target === modal || event.target.classList.contains('custom-modal-overlay')) {
            if (modal.classList.contains('show')) {
                closeModal();
            }
        }
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && modal.classList.contains('show')) {
            closeModal();
        }
    });
}
