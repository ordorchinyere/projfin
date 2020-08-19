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

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/jquery-3.2.1.min.js', 'public/js')
    .js('resources/js/pages.min.js', 'public/js')
    .js('resources/js/plugins/bootstrap-select2/select2.min.js', 'public/js')
    .js('resources/js/plugins/classie/classie.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles(['resources/sass/assets/plugins/bootstrap.min.css'], 'public/css/bootstrap.min.css')
    .styles(['resources/sass/assets/plugins/select2.min.css'], 'public/css/select2.min.css')
    .styles(['resources/sass/pages/css/pages.css'], 'public/css/pages.css');
