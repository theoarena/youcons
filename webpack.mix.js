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

mix.js('resources/assets/js/app.js', 'public/js');

//mix.autoload({jquery: ['$', 'window.jQuery', 'jQuery'], });
//mix.copy('node_modules/jquery-mask-plugin/dist/jquery.mask.min.js', 'public/js');

mix.sass('resources/assets/sass/app.scss', 'public/css').
	//sass('resources/assets/sass/cliente.scss', 'public/css').
	sass('resources/assets/sass/admin.scss', 'public/css');


mix.copyDirectory('node_modules/inputmask', 'public/js/inputmask');