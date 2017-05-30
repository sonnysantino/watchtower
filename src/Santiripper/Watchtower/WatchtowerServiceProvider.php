<?php

namespace Santiripper\Watchtower;

use Illuminate\Support\ServiceProvider;

class WatchtowerServiceProvider extends ServiceProvider
{
    /**
     * Package initialization
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/watchtower.php' => config_path('watchtower.php'),
        ], 'watchtower');

        require_once __DIR__ . '/helpers.php';
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('watchtower', function ($app) {
            return new Client();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
