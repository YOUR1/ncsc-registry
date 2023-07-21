<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 */
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Required for serving assets over https when running behind the load balancers.
        // Because we you use the remoteip module with Apache, Laravel's TrustedProxy solution will not work.
        if(config('app.env') !== 'local') {
            \URL::forceScheme('https');
        }
        
        Paginator::useBootstrap();
    }
}
