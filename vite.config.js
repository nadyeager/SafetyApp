import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/user-chart.js',
            ],
            refresh: [
                'resources/views/**/*.blade.php', // hanya Blade asli
            ],
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/**', '**/node_modules/**'], // abaikan storage & node_modules
        },
    },
});
