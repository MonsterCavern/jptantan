let mix = require("laravel-mix")

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

mix.browserSync({
    // port: 3000,
    host: "192.168.10.10",
    proxy: "jptantan.test",
    open: false
})

mix.options({
    extractVueStyles: true, //extractVueStyles:提取 .vue 組件樣式(CSS在<style>標籤內)到一個專用文件，而不是將其嵌入到HTML中。
    processCssUrls: true,
    uglify: {},
    purifyCss: false,
    //purifyCss: {},
    postCss: [require("autoprefixer")],
    clearConsole: true
})

mix.webpackConfig({
    resolve: {
        alias: {
            "@components": path.resolve(
                __dirname,
                "resources/assets/js/components"
            ),
            "@model": path.resolve(
                __dirname,
                "resources/assets/js/store/model"
            ),
            "@pages": path.resolve(__dirname, "resources/assets/js/pages")
        }
    }
})

mix.js(["resources/assets/js/app.js"], "public/js").
    sass("resources/assets/sass/app.scss", "public/css").
    sourceMaps().
    version()
