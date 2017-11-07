let mix = require('laravel-mix')

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

var BaseJsPath = 'public/build/js';
var BaseCssPath = 'public/build/css';

mix.js('resources/assets/js/app.js', BaseJsPath)
  .sass('resources/assets/sass/app.scss', BaseCssPath)//

// mix.js('resources/assets/js/home.js', BaseJsPath)

mix.js('resources/assets/js/novel/list', BaseJsPath)
