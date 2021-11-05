const mix = require('laravel-mix');

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
    /* CSS */
    .sass('resources/sass/main.scss', 'public/css/dashmix.css')
    .sass('resources/sass/dashmix/themes/xeco.scss', 'public/css/themes/')
    .sass('resources/sass/dashmix/themes/xinspire.scss', 'public/css/themes/')
    .sass('resources/sass/dashmix/themes/xmodern.scss', 'public/css/themes/')
    .sass('resources/sass/dashmix/themes/xsmooth.scss', 'public/css/themes/')
    .sass('resources/sass/dashmix/themes/xwork.scss', 'public/css/themes/')
    .sass('resources/sass/dashmix/themes/xdream.scss', 'public/css/themes/')
    .sass('resources/sass/dashmix/themes/xpro.scss', 'public/css/themes/')
    .sass('resources/sass/dashmix/themes/xplay.scss', 'public/css/themes/')

    /* JS */
    .js('resources/js/app.js', 'public/js/laravel.app.js')
    .js('resources/js/dashmix/app.js', 'public/js/dashmix.app.js')
    .copy('resources/js/devex.calendar.js', 'public/js/devex.calendar.js')
    .copy('resources/js/globalAreaSettings.js', 'public/js/globalAreaSettings.js')
    .copy('resources/js/globalGridSettings.js', 'public/js/globalGridSettings.js')

    /* Page JS */
    .js('resources/js/pages/tables_datatables.js', 'public/js/pages/tables_datatables.js')
    .js('resources/js/pages/home.js', 'public/js/pages/home.js')
    .js('resources/js/pages/profile.js', 'public/js/pages/profile.js')

    /* Tools */
    // .browserSync('localhost:8000')
    .disableNotifications()

    /* Options */
    .options({
        processCssUrls: false
    });
