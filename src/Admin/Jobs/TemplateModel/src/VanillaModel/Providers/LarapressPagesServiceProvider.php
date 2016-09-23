--php

namespace {Vendor}\{Package}\{Models}\Providers;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use {Vendor}\{Package}\{Models}\Policies\{Model}Policy;
use {Vendor}\{Package}\{Models}\Models\{Model};

class {Model}ServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('{package}'),
        ], 'config');

        //the admin routess file
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../Routes/routes.php';
        }

        //register the packages views
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', '{package}');

        parent::boot($events);

        //register the events
        $events->listen(\{vendor}\{package}\Events\{Model}WasSaved::class, \{vendor}\{package}\Listeners\{Model}SavedListener::class);

        //register the authorization policies
        $gate->policy({Model}::class, {Model}Policy::class);

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
