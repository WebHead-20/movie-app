import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import purge from '@erbelion/vite-plugin-laravel-purgecss'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css'],
            refresh: true,
        }),
        purge({
            templates: ['blade']
        })
    ],
});
