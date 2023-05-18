<?php

namespace App\Providers;

use App\Models\RealEstateType;
use App\Models\Location;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            $view->with('globalLocations', Location::all());
            $view->with('globalEventTypes', RealEstateType::all());
        });
    }
}
