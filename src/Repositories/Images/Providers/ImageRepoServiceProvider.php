<?php

namespace Larapress\Repositories\Images\Providers;

use Illuminate\Support\ServiceProvider;

class ImageRepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ImageRepo', 'Larapress\Repositories\Images\ImageRepo');

        $this->publishes([
            __DIR__ . '/../Config' => config_path('larapress'),
        ], 'config');
    }
}
