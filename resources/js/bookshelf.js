export function getShelfSections(books, history) {
    const groups = [
        { key: 'recent', title: 'Laatst gelezen', icon: 'fa-clock', books: [] },
        { key: 'nl', title: 'Nederlandse boeken', icon: 'fa-book-open', books: [] },
        { key: 'en', title: 'Engelse boeken', icon: 'fa-book-open', books: [] },
        { key: 'tr', title: 'Turkse boeken', icon: 'fa-book-open', books: [] },
        { key: 'dua-quran', title: 'Dua’s & Qur’an', icon: 'fa-book-quran', books: [] },
        { key: 'other', title: 'Overige boeken', icon: 'fa-book', books: [] },
    ];
    const visibleBooks = books.filter(book => book.dataset.hidden !== '1');
    const byId = new Map(visibleBooks.map(book => [String(book.dataset.productId), book]));
    const seen = new Set();

    if (Array.isArray(history)) {
        history
            .filter(item => item && typeof item === 'object')
            .slice()
            .sort((a, b) => (Number(b.timestamp) || 0) - (Number(a.timestamp) || 0))
            .forEach(item => {
                const id = String(item.productId);
                const book = byId.get(id);
                if (!book?.dataset.readerUrl || seen.has(id)) return;
                seen.add(id);
                const page = Number(item.page);
                groups[0].books.push({
                    book,
                    page: Number.isInteger(page) && page > 0 ? page : null,
                });
            });
    }

    visibleBooks.forEach(book => {
        const isPrayerBook = ['duaboek', 'quran'].includes(book.dataset.bookType);
        const key = isPrayerBook ? 'dua-quran' : book.dataset.language;
        const group = groups.find(group => group.key === key && group.key !== 'recent')
            || groups[groups.length - 1];
        group.books.push({ book, page: null });
    });

    return groups.filter(group => group.books.length > 0);
}

function readHistory() {
    try {
        return JSON.parse(localStorage.getItem('bibliotheek_reading_history') || '[]');
    } catch (error) {
        console.warn('De leesgeschiedenis kon niet worden geladen.', error);
        return [];
    }
}

function readShelfGrid(key) {
    try {
        const value = localStorage.getItem('library-shelf-layout:' + key);
        if (value !== null && value !== 'row' && value !== 'grid') throw new Error('Ongeldige boekenplankweergave');
        return value === 'grid';
    } catch (error) {
        console.warn('De boekenplankweergave kon niet worden geladen.', error);
        return false;
    }
}

function buildShelves() {
    const pool = document.querySelector('.bookshelf-books-pool');
    const target = document.getElementById('bookshelf-shelves');
    const books = Array.from(pool.querySelectorAll('.shelf-book'));
    const groups = getShelfSections(books, readHistory());
    const positions = new Map(Array.from(target.querySelectorAll('.bookshelf-section'))
        .map(section => [section.dataset.section, section.querySelector('.bookshelf-track')?.scrollLeft || 0]));
    target.replaceChildren();

    if (!groups.length) {
        const empty = pool.querySelector('.bookshelf-empty')?.cloneNode(true)
            || document.createElement('div');
        if (!empty.className) {
            empty.className = 'bookshelf-empty';
            empty.textContent = 'Geen boeken gevonden.';
        }
        const row = document.createElement('div');
        row.className = 'bookshelf-shelf-row';
        const plank = document.createElement('div');
        plank.className = 'bookshelf-plank';
        plank.appendChild(empty);
        row.appendChild(plank);
        target.appendChild(row);
        return;
    }

    groups.forEach(group => {
        const section = document.createElement('section');
        section.className = 'bookshelf-section';
        section.dataset.section = group.key;
        let preferredGrid = readShelfGrid(group.key);
        section.classList.toggle('bookshelf-section--grid', preferredGrid);
        const headingId = 'bookshelf-heading-' + group.key;
        section.setAttribute('aria-labelledby', headingId);

        const header = document.createElement('div');
        header.className = 'bookshelf-section-header';
        const heading = document.createElement('h2');
        heading.id = headingId;
        heading.className = 'bookshelf-section-title';
        const icon = document.createElement('i');
        icon.className = 'fa-solid ' + group.icon;
        icon.setAttribute('aria-hidden', 'true');
        const title = document.createElement('span');
        title.textContent = group.title;
        const count = document.createElement('span');
        count.className = 'bookshelf-section-count';
        count.textContent = group.books.length + (group.books.length === 1 ? ' boek' : ' boeken');
        heading.append(icon, title);
        header.append(heading, count);
        section.appendChild(header);

        const controls = document.createElement('span');
        controls.className = 'bookshelf-section-controls';
        const track = document.createElement('div');
        track.className = 'bookshelf-track';
        track.id = 'bookshelf-track-' + group.key;
        track.setAttribute('role', 'group');
        track.setAttribute('aria-labelledby', headingId);
        const layoutButton = document.createElement('button');
        layoutButton.type = 'button';
        layoutButton.className = 'bookshelf-layout-button';
        layoutButton.setAttribute('aria-controls', track.id);
        const layoutIcon = document.createElement('i');
        layoutIcon.className = 'fa-solid fa-table-cells-large';
        layoutIcon.setAttribute('aria-hidden', 'true');
        const layoutLabel = document.createElement('span');
        layoutButton.append(layoutIcon, layoutLabel);
        header.appendChild(layoutButton);
        layoutButton.addEventListener('click', () => {
            const grid = !section.classList.contains('bookshelf-section--grid');
            try {
                localStorage.setItem('library-shelf-layout:' + group.key, grid ? 'grid' : 'row');
            } catch (error) {
                console.warn('De boekenplankweergave kon niet worden opgeslagen.', error);
                window.alert('De boekenplankweergave kon niet worden opgeslagen. Probeer het opnieuw.');
                return;
            }
            preferredGrid = grid;
            section.classList.toggle('bookshelf-section--grid', grid);
            track.scrollLeft = 0;
            updateControls();
        });
        const buttons = [-1, 1].map(direction => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'bookshelf-scroll-button';
            button.setAttribute('aria-label', (direction < 0 ? 'Vorige boeken: ' : 'Volgende boeken: ') + group.title);
            button.setAttribute('aria-controls', track.id);
            const arrow = document.createElement('i');
            arrow.className = 'fa-solid fa-chevron-' + (direction < 0 ? 'left' : 'right');
            arrow.setAttribute('aria-hidden', 'true');
            button.appendChild(arrow);
            button.addEventListener('click', () => track.scrollBy({
                left: direction * track.clientWidth,
                behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth',
            }));
            controls.appendChild(button);
            return button;
        });
        header.appendChild(controls);
        const updateControls = () => {
            const bookWidth = track.firstElementChild?.getBoundingClientRect().width || 0;
            const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
            const capacity = bookWidth > 0 ? Math.max(1, Math.floor((track.clientWidth + gap + 1) / (bookWidth + gap))) : group.books.length;
            const canExpand = group.books.length > capacity;
            const grid = preferredGrid && canExpand;
            section.classList.toggle('bookshelf-section--grid', grid);
            layoutButton.hidden = !canExpand;
            layoutButton.setAttribute('aria-expanded', String(grid));
            const text = grid ? 'Inklappen' : 'Uitklappen';
            const label = text + ': ' + group.title;
            layoutIcon.className = 'fa-solid ' + (grid ? 'fa-grip-lines' : 'fa-table-cells-large');
            layoutLabel.textContent = text;
            layoutButton.setAttribute('aria-label', label);
            layoutButton.title = label;
            plank.querySelectorAll('.bookshelf-row-board').forEach(board => board.remove());
            if (grid) {
                const rowBottoms = [...new Set(Array.from(track.children, book => book.offsetTop + book.offsetHeight))].sort((a, b) => a - b);
                rowBottoms.slice(0, -1).forEach(bottom => {
                    const board = document.createElement('div');
                    board.className = 'bookshelf-row-board';
                    board.setAttribute('aria-hidden', 'true');
                    board.style.top = bottom + 'px';
                    plank.appendChild(board);
                });
            }
            const maxScroll = track.scrollWidth - track.clientWidth;
            controls.hidden = grid || maxScroll <= 1;
            buttons[0].disabled = track.scrollLeft <= 1;
            buttons[1].disabled = track.scrollLeft >= maxScroll - 1;
            track.tabIndex = !grid && maxScroll > 1 ? 0 : -1;
        };
        track.addEventListener('scroll', updateControls, { passive: true });
        track.addEventListener('bookshelf:resize', updateControls);
        track.addEventListener('keydown', event => {
            if (section.classList.contains('bookshelf-section--grid') || event.target !== track || !['ArrowLeft', 'ArrowRight'].includes(event.key)) return;
            event.preventDefault();
            buttons[event.key === 'ArrowLeft' ? 0 : 1].click();
        });
        const row = document.createElement('div');
        row.className = 'bookshelf-shelf-row';
        const plank = document.createElement('div');
        plank.className = 'bookshelf-plank';
        group.books.forEach(({ book, page }) => {
            const clone = book.cloneNode(true);
            if (group.key === 'recent' && page) {
                const url = new URL(book.dataset.readerUrl, window.location.origin);
                url.searchParams.set('page', page);
                clone.href = url.href;
                clone.title = book.title + ' — Verder lezen op pagina ' + page;
                const progress = document.createElement('span');
                progress.className = 'shelf-book-progress';
                progress.textContent = 'Pagina ' + page;
                clone.querySelector('.shelf-book-cover').appendChild(progress);
            }
            track.appendChild(clone);
        });

        plank.appendChild(track);
        row.appendChild(plank);
        section.appendChild(row);
        target.appendChild(section);
        track.scrollLeft = positions.get(group.key) || 0;
        requestAnimationFrame(updateControls);
    });
}

if (typeof document !== 'undefined') {
    window.buildShelves = buildShelves;
    buildShelves();

    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            document.querySelectorAll('.bookshelf-track')
                .forEach(track => track.dispatchEvent(new Event('bookshelf:resize')));
        }, 150);
    });
    window.addEventListener('pageshow', buildShelves);
    window.addEventListener('storage', event => {
        if (event.key === null || event.key === 'bibliotheek_reading_history') buildShelves();
    });
}
