var elixir = require('laravel-elixir');

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
elixir.config.css.folder ='';
elixir.config.css.sass.folder = '';

//console.log(elixir.config);


var libs = elixir(function(mix){
    /**
     * Javascript libraries
     */
    mix.scripts([
        'src/Admin/Resources/Assets/js/lib/ajquery-2.2.3.min.js',
        'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.min.js',
        'bower_components/admin-lte.scss/javascripts/app.js'
    ], 'src/Admin/Resources/Public/js/larapress_libs.js')
        .copy('src/Admin/Resources/Public/js/larapress_libs.js', '../../public/js/larapress_libs.js')


});

var admin = elixir(function(mix){
    /**
     * Admin Styles
     */
    mix.sass([
        'src/Admin/Resources/Assets/sass/app.scss'
    ], 'src/Admin/Resources/Public/css/admin.css')
        .copy('src/Admin/Resources/Public/css/admin.css', '../../public/css/admin.css');;


    /**
     * Admin vue.js section of package
     */
    mix.browserify([
        'src/Admin/Resources/Assets/js/larapress_vues.js'
    ], 'src/Admin/Resources/Public/js/larapress_vues.js')
        .copy('src/Admin/Resources/Public/js/larapress_vues.js', '../../public/js/larapress_vues.js');

});
