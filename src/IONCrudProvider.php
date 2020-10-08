<?php

namespace ION\Crud;

use Illuminate\Support\ServiceProvider;
use ION\Commands\CrudCommand;

class IONCrudProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CrudCommand::class
            ]);
        }
    }
}
