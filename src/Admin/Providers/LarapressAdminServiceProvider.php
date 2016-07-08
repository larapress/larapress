<?php

namespace Larapress\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;

class LarapressAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        $this->publishes([
            realpath(__DIR__ . '/../Database/Migrations') => $this->app->databasePath() . '/migrations',
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../Resources/Assets' => resource_path('larapress'),
        ], 'assets');

        $this->publishes([
            __DIR__ . '/../Resources/Public' => public_path('larapress'),
        ], 'public');


        $this->publishes([
            __DIR__ . '/../Config' => config_path('larapress'),
        ], 'config');

        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../Routes/routes.php';
        }

        // Using Closure based composers...
        view()->composer('larapress::common.sidebar', function ($view) {
               return $view->with('menu', config('larapress.sidebar'));
        });

        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'larapress');

        parent::boot($events);

        $events->listen(\Larapress\Pages\Events\PageWasSaved::class, \Larapress\Pages\Listeners\TestListener::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('HTML', \Collective\Html\HtmlFacade::class);
        $loader->alias('Form', \Collective\Html\FormFacade::class);
    }
}
