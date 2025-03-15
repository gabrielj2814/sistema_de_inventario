<?php

use App\Http\Controllers\CategoryController;
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

    // Company
    Route::prefix("company")->group(function(){
        Route::get("/",                [CompanyController::class,"consultAllCompanies"])->middleware("auth:sanctum")->name("api.company.all");
        Route::post("/",               [CompanyController::class,"creatCompany"])->name("api.company.create");
        // TODO: probrar endpoint
        Route::put("/{id}",               [CompanyController::class,"updateCompany"])->name("api.company.update");
        // Route::delete("/{id}",               [CompanyController::class,"consultCompanyForId"])->name("api.company.create");
        Route::get("/{id}",            [CompanyController::class,"consultCompanyForId"])->name("api.company.id");
    });

    Route::prefix("customer")->group(function(){

    });

    Route::prefix("category")->group(function(){
        Route::get("/",[CustomerController::class,""])->name("");
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
