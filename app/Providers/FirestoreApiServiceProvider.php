<?php

namespace App\Providers;

use App\Services\FirestoreApiService;
use Illuminate\Support\ServiceProvider;

class FirestoreApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('FirestoreApi', function(Application $app){
        //     return new FirestoreApiService();
        // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
