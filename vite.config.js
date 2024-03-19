import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/scss/admin/admin.scss',
                'resources/js/app.js',
                'resources/js/cart.js',
                'resources/js/admin/images-actions.js',
                'resources/js/admin/images-preview.js',
                'resources/js/payment/paypal.js',
                'resources/js/cart.js',
            ],
            refresh: true,
        }),
    ],
});
