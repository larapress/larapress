var elixir = require('laravel-elixir');

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


elixir(function(mix){
    /**
     * Change the defaults to make it work in package scope
     * @type {string}
     */
    elixir.config.assetsPath = 'src/'; //trailing slash required.
    elixir.config.js.folder = '';
    elixir.config.js.outputFolder = '';
    elixir.config.css.folder ='';
    elixir.config.css.sass.folder = '';

    //console.log(elixir.config);

    /**
     * Admin Styles
     */
    mix.sass([
        'Admin/Resources/Assets/sass/app.scss'
    ], 'src/Admin/Resources/Public/css/admin.css');


    /**
     * Admin js section of package
     */
    mix.scripts([
        'Admin/Resources/Assets/js/lib/ajquery-2.2.3.min.js',
        'Admin/Resources/Assets/js/lib/bootstrap.min.js',
        'Admin/Resources/Assets/js/vue_components',
        'Admin/Resources/Assets/js/main.js'
    ], 'src/Admin/Resources/Public/js/main.js')


    /**
     * Copy to the public path to make app workable when developing
     */
    mix.copy('src/Admin/Resources/Public/js/main.js', '../../../public/js/vendor/larapress/admin/main.js');
    mix.copy('src/Admin/Resources/Public/css/admin.css', '../../../public/css/vendor/larapress/admin/admin.css');
});
