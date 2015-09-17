<?php
namespace Linfo\Laravel;

use Illuminate\Support\ServiceProvider;
use Linfo\Laravel\Commands\LinfoGetCommand;

class LinfoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->publishes([
            __DIR__ . '/../config/linfo.php' => config_path('linfo.php'),
        ], 'config');

        $this->registerCommands();
        $this->commands('linfoget');
    }

    public function boot()
    {
        //
    }

    private function registerCommands()
    {
        $this->app['linfoget'] = $this->app->share(function($app) {
            return new LinfoGetCommand();
        });
    }
}