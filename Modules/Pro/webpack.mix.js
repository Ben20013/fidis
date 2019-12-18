const {
    mix
} = require('laravel-mix');
require('laravel-mix-merge-manifest');
const webpack = require("webpack")

function resolve(dir) {
    return path.join(__dirname, '..', dir)
}
mix.setPublicPath(path.normalize('../../public'))
    .js(__dirname + '/Resources/assets/js/app.js', 'modules/pro/js/pro.js')
    .sass(__dirname + '/Resources/assets/sass/app.scss', 'modules/pro/css/pro.css');
mix.copyDirectory(__dirname + '/Resources/assets/image', '../../public/modules/pro/static/image')
    .copyDirectory(__dirname + '/Resources/assets/images', '../../public/modules/pro/static/images')
    .copyDirectory(__dirname + '/Resources/assets/report', '../../public/modules/pro/static/report');
mix.webpackConfig({
    output: {
        chunkFilename: 'modules/pro/js/lazy/[name].[chunkhash].js'
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

//mix.js(__dirname + '/Resources/assets/js/app.js', 'modules/pro/js/pro.js')
//.sass(__dirname + '/Resources/assets/sass/app.scss', 'modules/pro/css/pro.css');


if (mix.inProduction()) {
    mix.version();
}