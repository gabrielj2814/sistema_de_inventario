<?php

namespace App\Providers;

use App\Repository\UserRepository;
use Database\Seeders\UserRootSeeder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        $this->app->bind(UserRootSeeder::class, function(Application $app){
            return new UserRootSeeder($app->make(UserRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
