let mix = require('laravel-mix');
let path = require('path');

mix.less('resources/assets/less/app.less', 'public/css')
    .copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.min.js')
    .copy('node_modules/sweetalert/dist/sweetalert.css', 'public/css/sweetalert.css')
    .js('resources/assets/js/app.js', 'public/js')
    .webpackConfig({
        resolve: {
            modules: [
                path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js'),
                'node_modules'
            ],
            alias: {
                'vue$': 'vue/dist/vue.js'
            }
        }
    });