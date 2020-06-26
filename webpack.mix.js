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


//admin JS and SCSS files
mix.js('resources/js/admin_app.js', 'public/js')
    .sass('resources/sass/admin/app.scss', 'public/css');

//front JS and SCSS files
mix.js('resources/js/front_app.js', 'public/js')
    .sass('resources/sass/front/template.scss', 'public/front/css');
