import { defineConfig, loadEnv, } from 'vite';

import fs from 'fs';
import laravel from 'laravel-vite-plugin';
import mkcert from 'vite-plugin-mkcert';
import { resolve } from 'path';
// import path from 'path';
import vuePlugin from '@vitejs/plugin-vue';
import tailwindcss from "@tailwindcss/vite";
import { fsync, writeFileSync, writeSync } from 'fs';


export default (data) => {
    process.env = { ...process.env, ...loadEnv(data.mode, process.cwd()) };

    // Validate file paths in rollupOptions.input
    const validateFilePaths = (inputPaths) => {
        Object.entries(inputPaths).forEach(([key, filePath]) => {
            if (!fs.existsSync(filePath)) {
                console.warn(`Warning: The file path for '${key}' does not exist: ${filePath}`);
            }
        });
    };

    // console.log(data);

    if (data === 'development') {
        // let's console log current server address
    }

    return defineConfig({
        build: {
            // outDir: resolve(__dirname, 'public'),
            emptyOutDir: true,
            sourcemap: false,
            rollupOptions: {
                input: {
                    bootstrap: resolve(__dirname, 'resources/ts/bootstrap.ts'),
                    // app: resolve(__dirname, 'resources/ts/app.ts'),
                    // auth: resolve(__dirname, 'resources/ts/auth.ts'),
                    // setup: resolve(__dirname, 'resources/ts/setup.ts'),
                    // update: resolve(__dirname, 'resources/ts/update.ts'),
                    // dev: resolve(__dirname, 'resources/ts/dev.ts'),
                    // langLoader: resolve(__dirname, 'resources/ts/lang-loader.ts'),
                    // popups: resolve(__dirname, 'resources/ts/popups.ts'),
                    // widgets: resolve(__dirname, 'resources/ts/widgets.ts'),
                    // wizard: resolve(__dirname, 'resources/ts/wizard.ts'),

                    // // css
                    // appCss: resolve(__dirname, 'resources/css/app.css'),
                    // gridCss: resolve(__dirname, 'resources/css/grid.css'),
                    // animationsCss: resolve(__dirname, 'resources/css/animations.css'),
                    // fontsCss: resolve(__dirname, 'resources/css/fonts.css'),

                    // // scss
                    // lineAwesomeScss: resolve(__dirname, 'resources/scss/line-awesome/1.3.0/scss/line-awesome.scss'),

                    // // themes
                    lightCss: resolve(__dirname, 'resources/css/light.css'),
                    // darkCss: resolve(__dirname, 'resources/css/dark.css'),
                    // phosphorCss: resolve(__dirname, 'resources/css/phosphor.css'),
                },
            },
        },
        resolve: {
            alias: [
                {
                    find: '&',
                    replacement: resolve(__dirname, 'resources'),
                }, {
                    find: '~',
                    replacement: resolve(__dirname, 'resources/ts'),
                },
            ]
        },
        plugins: [
            tailwindcss(),
            mkcert(),
            vuePlugin({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
    });
};