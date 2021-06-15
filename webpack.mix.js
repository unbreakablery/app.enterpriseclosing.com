const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/tasks.js', 'public/js')
    .js('resources/js/setting.js', 'public/js')
    .js('resources/js/outbound.js', 'public/js')
    .js('resources/js/opportunities.js', 'public/js')
    .js('resources/js/scripts.js', 'public/js')
    .js('resources/js/emails.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/sidebar.scss', 'public/css')
    .sass('resources/sass/setting.scss', 'public/css');
