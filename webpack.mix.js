let mix = require("laravel-mix");

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

mix.webpackConfig({
    resolve: {
        alias: {
            "@components": path.resolve(__dirname, "resources/components")
        }
    }
});

mix.
    autoload({
        jquery: [
            "$",
            "window.jQuery",
            "jQuery",
            "window.$",
            "jquery",
            "window.jquery"
        ],
        "popper.js/dist/umd/popper.js": ["Popper"],
        tether: ["Tether", "window.Tether"]
    }).
    js("resources/assets/js/app.js", "public/js").
    version();
mix.sass("resources/assets/sass/app.scss", "public/css").version();

// admin
mix.
    autoload({
        jquery: [
            "$",
            "window.jQuery",
            "jQuery",
            "window.$",
            "jquery",
            "window.jquery"
        ],
        "popper.js/dist/umd/popper.js": ["Popper"],
        tether: ["Tether", "window.Tether"]
    }).
    js("resources/assets/admin/js/app.js", "public/js/admin.js").
    version();
mix.
    sass("resources/assets/admin/sass/app.scss", "public/css/admin.css").
    version();
