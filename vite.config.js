import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        tailwindcss(),
        react(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/login.css',
                'resources/css/site.css',
                'resources/css/novosite.css',
                'resources/js/app.jsx',
                'resources/js/tutorial.js',
                'resources/js/tutorial-ponto.js',
                'resources/css/filament/app/theme.css'
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
