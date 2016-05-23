<?php

namespace Larapress\Posts\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;

class LarapressPostsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__ . '/../Database/Migrations') => $this->app->databasePath() . '/migrations',
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../Config' => config_path('larapress'),
        ], 'config');

        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../Routes/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'larapress');
   }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
