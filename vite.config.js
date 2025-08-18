import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app2.css', 'resources/js/app2.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
