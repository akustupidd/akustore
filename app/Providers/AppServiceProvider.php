<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stevebauman\Location\Facades\Location;
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
        view()->composer('*', function ($view) {
            $position = Location::get(request()->ip());
            $countryCode = $position ? $position->countryCode : 'Unknown';
            $view->with('countryCode', $countryCode);
        });
        
    }
}
