<?php

namespace App\Providers;

use App\Contracts\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Models\Customer;
use App\Repository\RoleRespository;
use App\Repository\UserRepository;
use App\Services\AdminServices;
use App\Services\CustomerServices;
use Database\Seeders\RolesSeeder;
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

        $this->app->bind(RolesSeeder::class,function(Application $app){
            return new RolesSeeder($app->make(RoleRespository::class));
        });

        $this->app->when(AdminController::class)
        ->needs(User::class)
        ->give(AdminServices::class);

        $this->app->when(CustomerController::class)
        ->needs(User::class)
        ->give(CustomerServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
