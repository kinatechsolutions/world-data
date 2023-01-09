<?php

namespace Kinatech\World\Providers;

use Illuminate\Support\ServiceProvider;
use World;

class WorldServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('world', function (){
            return new World();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        /* Load routes */
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

        /* load migrations */
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        /* publish migrations */
        $this->publishes([
            __DIR__.'/../Database/migrations/' => database_path('migrations')
        ], 'migrations');
    }
}
