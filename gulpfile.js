var elixir = require('laravel-elixir');
var argv = require('yargs').argv;

require('laravel-elixir-vueify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/**
 * Change the defaults to make it work in package scope
 * @type {string}
 */
elixir.config.assetsPath = ''; //trailing slash required.
elixir.config.js.folder = '';
elixir.config.js.outputFolder = '';
elixir.config.css.folder = '';
elixir.config.css.sass.folder = '';

//console.log(elixir.config);


elixir(function (mix) {


    if (argv.build) {
        /**
         * Javascript libraries
         */
        mix.scripts([
            'src/Admin/Resources/Assets/js/lib/ajquery-2.2.3.min.js',
            'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.min.js',
            'bower_components/admin-lte.scss/javascripts/app.js'
        ], 'src/Admin/Resources/Public/js/larapress_libs.js')
            .copy('src/Admin/Resources/Public/js/larapress_libs.js', '../../../public/larapress/js/larapress_libs.js')
    }


    if(argv.sass || argv.dev) {
        /**
         * Admin Styles
         */
        mix.sass([
            'src/Admin/Resources/Assets/sass/app.scss'
        ], 'src/Admin/Resources/Public/css/admin.css')
            .copy('src/Admin/Resources/Public/css/admin.css', '../../../public/larapress/css/admin.css');
    }

    if(argv.vue || argv.dev) {
        /**
         * Admin vue.js section of package
         */
        mix.browserify([
            'src/Admin/Resources/Assets/js/larapress_vues.js'
        ], 'src/Admin/Resources/Public/js/larapress_vues.js')
            .copy('src/Admin/Resources/Public/js/larapress_vues.js', '../../../public/larapress/js/larapress_vues.js');
    }
});
