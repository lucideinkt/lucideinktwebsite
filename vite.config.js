import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/front-end-style.css', 'resources/css/dashboard-style.css', 'resources/js/main.js'],
            refresh: [
                'resources/views/**/*.blade.php',
                'routes/**/*.php',
            ],
        }),
    ],
});
