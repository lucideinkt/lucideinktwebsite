import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/front-end-style.css', 'resources/css/dashboard-style.css', 'resources/css/reader-book.css', 'resources/css/bookshelf.css', 'resources/js/main.js', 'resources/js/dashboard.js'],
            refresh: [
                'resources/views/**/*.blade.php',
                'routes/**/*.php',
            ],
        }),
    ],
});
