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
// mix.js('resources/assets/js/jquery.js' ,'public/js/jquery.js');
// mix.js('resources/assets/js/jqueryui.js' ,'public/js/jqueryui.js');
// mix.js(
// 	'resources/assets/dist/js/app.min.js', 'public/dist/js/'
// 	).version();
// mix.sass('resources/assets/sass/admin.scss', 'public/css/admin.css').version();
// mix.sass('resources/assets/sass/app.scss','public/css/app.css').version();
mix.sass('resources/assets/sass/custom.scss','public/css/custom.css');
mix.js('resources/assets/js/dashboard.js','public/js/dashboard.js');