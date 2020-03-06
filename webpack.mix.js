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

mix.js('resources/js/services/app.js', 'public/js')
.sass('resources/css/app.scss', 'public/css');

mix.js('resources/js/services/admin.js', 'public/js')
.css('resources/css/admin.css', 'public/css')

mix.js('resources/js/services/executor.js', 'public/js')
.css('resources/css/executor.css', 'public/css')
