<?php

namespace App\Providers;

use App\Services\FilterProductsService;
use Illuminate\Support\ServiceProvider;

class FilterProductsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('filterService', function ($app) {
            return new FilterProductsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
