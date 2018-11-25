<?php

namespace App\Providers\Services;

use Illuminate\Support\ServiceProvider;

class ImportManagerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Imports\ImportManager',
            'App\Services\Imports\MsSqlManager');
    }
}