<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ImageManager::class, function ($app) {
            return new ImageManager(new Driver()); // Inisialisasi dengan driver GD
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
