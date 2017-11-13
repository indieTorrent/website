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
mix.webpackConfig({
    resolve: {
        alias: {
            Resources: path.resolve(__dirname, 'resources'),
            Components: path.resolve(__dirname, 'resources/components'),
            Mixins: path.resolve(__dirname, 'resources/assets/js/mixins'),
            Views: path.resolve(__dirname, 'resources/views')
        }
    }
});

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('node_modules/font-awesome/fonts', 'public/fonts');
