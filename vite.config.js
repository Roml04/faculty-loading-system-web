import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/calendar.css', 
                'resources/css/media-queries.css', 
                'resources/css/style.css', 
                'resources/js/app.js', 
                'resources/js/bootstrap.js', 
                'resources/js/program-selection.js',
                'resources/js/html2canvas.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        cors: {
            origin: '*'
        },
        watch: {
            ignored: ['**/vendor/**']
        }
    }
});
