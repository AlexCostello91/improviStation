import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import fs from 'fs';

//Configure HTTPS for vite
const sslOptions = {
    key: fs.readFileSync('./docker/nginx/ssl/nginx.key'),
    cert: fs.readFileSync('./docker/nginx/ssl/nginx.crt'),
};

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: { //Add options for docker dev config
        https: sslOptions,
        host: 'localhost',
        hmr: {
            host: 'localhost',
        },
    },
});
