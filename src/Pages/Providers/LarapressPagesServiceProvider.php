<?php

namespace Larapress\Pages\Providers;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Larapress\Pages\Policies\PagePolicy;
use Larapress\Pages\Models\Page;

class LarapressPagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(DispatcherContract $events, Gate $gate)
    {
        $this->publishes([
            realpath(__DIR__ . '/../Database/Migrations') => $this->app->databasePath() . '/migrations',
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../Config' => config_path('larapress'),
        ], 'config');

        //the admin routess file
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../Routes/routes.php';
        }

        //register the packages views
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'larapress');

        parent::boot($events);

        //register the events
        $events->listen(\Larapress\Pages\Events\PageWasSaved::class, \Larapress\Pages\Listeners\PageSavedListener::class);

        //register the authorization policies
        $gate->policy(Page::class, PagePolicy::class);

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
