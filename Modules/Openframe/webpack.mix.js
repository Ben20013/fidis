const {
    mix
} = require('laravel-mix');
require('laravel-mix-merge-manifest');
mix.webpackConfig({
    output: {
        chunkFilename: 'modules/openframe/js/lazy/[name].[chunkhash].js'
    },
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "Resources/assets/js")
        }
    }
})
mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'modules/openframe/js/openframe.js')
    .sass(__dirname + '/Resources/assets/sass/app.scss', 'modules/openframe/css/openframe.css');

if (mix.inProduction()) {
    mix.version();
}