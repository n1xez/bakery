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
        $class = env('APP_ENV', 'production') == 'production'
            ? 'App\Services\Imports\MsSqlManager'
            : 'App\Services\Imports\FakeManager';

        $this->app->bind('App\Services\Imports\ImportManager',
            $class);
    }
}