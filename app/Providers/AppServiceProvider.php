<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(
            'App\Repositories\Contract\UserContract',
            'App\Repositories\UserRepository'
        );

        app()->bind(
            'App\Repositories\Contract\VendorContract',
            'App\Repositories\VendorRepository'
        );
    }
}
