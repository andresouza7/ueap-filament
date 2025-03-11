import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/carousel.css',
                'resources/js/carousel.js',
                'resources/css/filament/portalTransparencia/theme.css'
            ],
            refresh: [
                ...refreshPaths,
                'resources/views/**',
                'app/Filament/**',
                'app/Http/Controllers/**',
                'app/Models/**',
                'app/Livewire/**',
                'app/Providers/Filament/**',
            ],
        }),
    ],
});
