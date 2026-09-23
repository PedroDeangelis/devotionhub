import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import { defineConfig, lazyPlugins } from 'vite-plus';

export default defineConfig({
    plugins: lazyPlugins(() => [
        laravel({
            input: [
                'resources/css/portal/portal.css',
                'resources/css/admin/admin.css',
                'resources/js/app.js',
            ],
            refresh: true,
            fonts: [
                bunny('Bricolage Grotesque', {
                    weights: [400, 500, 600, 700],
                }),
                bunny('Manrope', {
                    weights: [400, 500, 600, 700],
                }),
                bunny('JetBrains Mono', {
                    weights: [400, 500],
                }),
            ],
        }),
        tailwindcss(),
    ]),
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        origin: 'https://devotionhub-vite.lndo.site',
        cors: true,
        hmr: {
            host: 'devotionhub-vite.lndo.site',
            protocol: 'wss',
            clientPort: 443,
        },
        watch: {
            ignored: [
                '**/.agents/**',
                '**/.claude/**',
                '**/.cursor/**',
                '**/.junie/**',
                '**/storage/framework/views/**',
                '**/vendor/**',
            ],
        },
    },
});
