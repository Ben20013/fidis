const mix = require('laravel-mix');
const path = require('path');

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
    .setPublicPath(path.normalize('../../public/modules/admin'))
    .js('resources/assets/js/app.js', 'js/admin.js')
    .sass('resources/assets/sass/app.scss', 'css/admin.css');

/*

const {
    mix
} = require('laravel-mix');
require('laravel-mix-merge-manifest');
mix.webpackConfig({
    output: {
        chunkFilename: 'modules/admin/js/lazy/[name].[chunkhash].js'
    },
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "Resources/assets/js")
        }
    }
})
mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'modules/admin/js/admin.js')
    .sass(__dirname + '/Resources/assets/sass/app.scss', 'modules/admin/css/admin.css');


if (mix.inProduction()) {
    mix.version();
}


*/
