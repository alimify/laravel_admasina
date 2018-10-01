let mix = require('laravel-mix');

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

/*Copy SVG */
mix.copy('resources/assets/talvbansal/media-manager/fonts/', 'public/assets/admin/fonts/');


mix.js('resources/assets/js/app.js', 'public/assets/admin/js')
   .sass('resources/assets/sass/app.scss', 'public/assets/admin/css');
