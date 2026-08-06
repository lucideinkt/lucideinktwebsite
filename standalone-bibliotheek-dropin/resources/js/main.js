import { readerBook } from './features/reader-book.js';

document.addEventListener('touchstart', function () {}, { passive: true });

document.addEventListener('DOMContentLoaded', () => {
    readerBook();
});

