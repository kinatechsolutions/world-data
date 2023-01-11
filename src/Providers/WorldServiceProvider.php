<?php

namespace Kinatech\World\Providers;

use App\Console\Commands\PopulateWorldDataCommand;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Kinatech\World\World;

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
        AboutCommand::add('World Data', fn() => ['Version' => '1.0.0']);

        if ($this->app->runningInConsole()){
            $this->commands([
                PopulateWorldDataCommand::class
            ]);
        }

        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        $this->publishes([
            __DIR__.'/../Database/migrations/' => database_path('migrations')
        ], 'migrations');
    }
}
