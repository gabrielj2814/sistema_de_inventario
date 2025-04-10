<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix("v1")->group(function(){

    Route::post("/login",              [LoginController::class,"login"])->name("api.login");
    Route::get("/logout",              [LoginController::class,"logout"])->middleware("auth:sanctum")->name("api.logout");
    Route::get("/remove-all-session",  [LoginController::class,"removerAllSession"])->middleware("auth:sanctum")->name("api.removeAllSession");

    // rutas admin
    Route::prefix("admin")->group(function(){

        Route::prefix("user")->group(function(){
            Route::get("/",        [AdminController::class,"consultAll"])->middleware("auth:sanctum")->name("api.admin.all");
            Route::get("/{id}",    [AdminController::class,"consultUserForId"])->middleware("auth:sanctum")->name("api.admin.id");
            Route::post("/",       [AdminController::class,"createdUser"])->middleware("auth:sanctum")->name("api.admin.create");
            Route::put("/{id}",    [AdminController::class,"updatedUser"])->middleware("auth:sanctum")->name("api.admin.update");
            Route::delete("/{id}", [AdminController::class,"deleteUser"])->middleware("auth:sanctum")->name("api.admin.delete");
        });

        Route::prefix("company")->group(function(){
            Route::get("/",                [CompanyController::class,"consultAllCompanies"])->middleware("auth:sanctum")->name("api.auth.admin.company.all");
            Route::post("/",               [CompanyController::class,"creatCompany"])->middleware("auth:sanctum")->name("api.auth.admin.company.create");
            Route::put("/{id}",            [CompanyController::class,"updateCompany"])->middleware("auth:sanctum")->name("api.auth.admin.company.update");
            Route::delete("/{id}",         [CompanyController::class,"deleteCompany"])->middleware("auth:sanctum")->name("api.auth.admin.company.id.delete");
            Route::get("/{id}",            [CompanyController::class,"consultCompanyForId"])->middleware("auth:sanctum")->name("api.auth.admin.company.id");
        });
    });

    Route::prefix("register")->group(function(){
        // se creara el usuario pero antes de responder se ejecutara un evento que creara la empresa y se le assignara de una vez
        Route::post("/my-account",                  [CustomerController::class,"register"])->name("api.public.user.create");
    });

    Route::prefix("workspace")->group(function(){

        Route::prefix("customer")->group(function(){

        });

        Route::prefix("category")->group(function(){
            // Route::get("/",[CustomerController::class,""])->name("");
        });

        Route::prefix("product")->group(function(){

        });

        Route::prefix("supplier")->group(function(){

        });

        Route::prefix("warehouse")->group(function(){

        });

        Route::prefix("order")->group(function(){

        });

        Route::prefix("inventory")->group(function(){

        });

        Route::prefix("movement")->group(function(){

        });

    });



});
