<?php

namespace App\Providers;

use App\Services\LocationsApiService;
use App\Services\LocationsDbService;
use App\Services\LocationsServiceInterface;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(LocationsServiceInterface::class, LocationsApiService::class);

        $this->app->singleton('Locations', LocationsServiceInterface::class);
    }
}
