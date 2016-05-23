<?php

namespace Larapress\Portfolio\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;

class LarapressPortfolioServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('larapress'),
        ], 'config');

        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../Routes/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'larapress');

        parent::boot($events);

        $events->listen(\Larapress\Portfolio\Events\PortfolioWasSaved::class, \Larapress\Portfolio\Listeners\TestListener::class);
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
