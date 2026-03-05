import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/index.css',
                'resources/css/auth.css',
                'resources/css/musculos.css',
                'resources/css/tienda.css',
                'resources/css/progreso.css',
                'resources/css/perfil.css',
                'resources/css/crear_rutina.css',
                'resources/css/editar_rutina.css',
                'resources/css/admin.css',
                'resources/css/recursos.css',
                'resources/css/mis_compras.css',
                'resources/css/checkout.css',
                'resources/js/app.js',
                'resources/js/index.js',
                'resources/js/auth.js',
                'resources/js/procesar_compra.js',
            ],
            refresh: true, // ✅ Hot reload habilitado
        }),
    ],
});
