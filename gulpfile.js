var elixir = require('laravel-elixir');
var path = require('path');

require('laravel-elixir-vue-2');

elixir(function(mix) {
    mix.less('app.less')
        .webpack('app.js', null, null, {
            resolve: {
                modules: [
                    path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js'),
                    'node_modules'
                ]
            }
        })
        .copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.min.js')
        .copy('node_modules/sweetalert/dist/sweetalert.css', 'public/css/sweetalert.css')
        .copy('node_modules/font-awesome/fonts/', 'public/fonts');
});
