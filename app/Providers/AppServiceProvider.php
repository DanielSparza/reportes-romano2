<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('GuzzleHttp\Client', function(){
            return new Client([
                //'base_uri' => 'http://api-reportes-romano.test:90/api/'
                'base_uri' => 'https://api-reportes-romano.up.railway.app/api/'
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
