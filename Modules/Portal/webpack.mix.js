const { mix } = require('laravel-mix');
require('laravel-mix-merge-manifest');
const webpack = require("webpack")

function resolve(dir) {
    return path.join(__dirname, '..', dir)
}
mix.setPublicPath(path.normalize('../../public/modules/portal'))
    .js(__dirname + '/Resources/assets/js/app.js', 'js/portal.js')
    .sass(__dirname + '/Resources/assets/sass/app.scss', 'css/portal.css').sourceMaps();
mix.copyDirectory(__dirname + '/Resources/assets/images', '../../public/modules/portal/static/images');
mix.webpackConfig({
    output: {
        chunkFilename: 'js/lazy/[name].[chunkhash].js'
    },
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "Resources"),
            '$api.js': path.resolve(__dirname, 'Resources/assets/js/fetch/api.build.js'),
            '$config': path.resolve(__dirname, 'Resources/assets/js/config/config.js'),
            '$system': path.resolve(__dirname, 'Resources/assets/js/config/system.js'),
            '@components': path.resolve(__dirname, 'Resources/assets/js/components'),
        }
    },
    plugins: [
        //new webpack.optimize.CommonsChunkPlugin('common.js'),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery"
        })
    ],
})

/*mix.js(__dirname + '/Resources/assets/js/app.js', 'modules/portal/js/portal.js')
    .sass(__dirname + '/Resources/assets/sass/app.scss', 'modules/portal/css/portal.css');*/

if (mix.inProduction()) {
    mix.version();
}