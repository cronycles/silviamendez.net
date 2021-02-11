const mix = require('laravel-mix');
const webpack = require("webpack");
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
require('laravel-mix-polyfill');

const publicFolderName = 'public_html';
const doesGenerateSourcemapsForProduction = false;

mix.setPublicPath(publicFolderName + '/');

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
var postCssPlugins = [
    require('postcss-nested'),
    require('autoprefixer'),
    // require('postcss-media-variables'),
    require('postcss-custom-media'),
    require('postcss-custom-properties')({preserve: false}),
    // require('postcss-calc'),
    // require('postcss-media-variables'),
    // require('postcss-media-minmax'),
    require('postcss-hexrgba'),
];

if (mix.inProduction) {
    postCssPlugins.push(require('cssnano'))
}

mix.webpackConfig({
    plugins: [
        new CleanWebpackPlugin({
            verbose: true,
            cleanOnceBeforeBuildPatterns: ["css/**/*.*", "js/**/*.*"]
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        })
    ]
});

mix.js('resources/js/app.js', publicFolderName + '/js')
    .js('resources/js/lazy.js', publicFolderName + '/js')
    .extract()
    .sass('resources/sass/app.scss', publicFolderName + '/css').options({
    postCss: postCssPlugins
})
    .sourceMaps(doesGenerateSourcemapsForProduction)
    .polyfill({
        enabled: true,
        useBuiltIns: "usage",
        targets: "> 10%, not dead"
    });
if (mix.inProduction()) {
    mix.version();
}
