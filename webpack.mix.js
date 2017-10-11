const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/assets/backend/js/app.js', 'public/backend/js')
    .sass('resources/assets/backend/sass/app.scss', 'public/backend/css')
    .js('resources/assets/home/js/app.js', 'public/home/js')
    .sass('resources/assets/home/sass/app.scss', 'public/home/css')
    .js('resources/assets/v2/js/app.js', 'public/v2/js')
    .sass('resources/assets/v2/sass/app.scss', 'public/v2/css')
    .version();
