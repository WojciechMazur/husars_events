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

mix.js( 'resources/assets/js/admin/admin.js',                           'public/js/admin')
    .js('resources/assets/js/admin/customers.js',                       'public/js/admin')
    .js('resources/assets/js/admin/orders.js',                          'public/js/a1dmin')

    .js('resources/assets/js/user/shop.js',                             'public/js/user')
    .js('resources/assets/js/user/trainings.js',                        'public/js/user')
    .js('resources/assets/js/user/profile.js',                          'public/js/user')
    .js('resources/assets/js/user/races.js',                            'public/js/user')

    .js('resources/assets/js/expandable_list.js',                       'public/js')
    .js('resources/assets/js/utils.js',                                 'public/js')
    .js('resources/assets/js/jquery-3.2.1.js',                          'public/js')

    .sass('resources/assets/sass/admin.scss',                           'public/css')
    .sass('resources/assets/sass/base.scss',                            'public/css')
    .sass('resources/assets/sass/product_tiles.scss',                   'public/css')
    .sass('resources/assets/sass/profile.scss',                         'public/css')
    .sass('resources/assets/sass/trainings.scss',                       'public/css')
    .sass('resources/assets/sass/races.scss',                           'public/css')

    .sass('resources/assets/font-awesome-4.7.0/scss/font-awesome.scss', 'public/css');
