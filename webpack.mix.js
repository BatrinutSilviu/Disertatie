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
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/material-icons/css/material-icons.min.css', 'public/css/material-icons.min.css')
    .copy('node_modules/fullcalendar/main.js', 'public/js/fullcalendar.js')
    .copy('node_modules/fullcalendar/main.css', 'public/css/fullcalendar.css');

//	.browserSync('my-domain.test');