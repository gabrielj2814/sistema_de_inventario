<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::prefix("auth")->group(function(){
    Route::get("/",[LoginController::class,"view"])->name("auth.login.admin");
    Route::get("/company/{company_id}",[LoginController::class,"viewLoginCompany"])->name("auth.login.company");

    Route::post("/login",              [LoginController::class,"login"])->name("web.login");
    Route::get("/logout",              [LoginController::class,"logout"])->name("web.logout")->middleware("auth");
    Route::get("/remove-all-session",  [LoginController::class,"removerAllSession"])->name("web.removeAllSession")->middleware("auth");
});

Route::prefix("admin")->group(function(){

    Route::prefix("user")->group(function(){
        Route::get("/",        [AdminController::class,"consultAll"])->middleware("auth")->name("api.admin.all");
        Route::get("/{id}",    [AdminController::class,"consultUserForId"])->middleware("auth")->name("api.admin.id");
        Route::post("/",       [AdminController::class,"createdUser"])->middleware("auth")->name("api.admin.create");
        Route::put("/{id}",    [AdminController::class,"updatedUser"])->middleware("auth")->name("api.admin.update");
        Route::delete("/{id}", [AdminController::class,"deleteUser"])->middleware("auth")->name("api.admin.delete");
    });

    Route::prefix("company")->group(function(){
        Route::get("/",                [CompanyController::class,"consultAllCompanies"])->middleware("auth")->name("api.auth.admin.company.all");
        Route::post("/",               [CompanyController::class,"creatCompany"])->middleware("auth")->name("api.auth.admin.company.create");
        Route::put("/{id}",            [CompanyController::class,"updateCompany"])->middleware("auth")->name("api.auth.admin.company.update");
        Route::delete("/{id}",         [CompanyController::class,"deleteCompany"])->middleware("auth")->name("api.auth.admin.company.id.delete");
        Route::get("/{id}",            [CompanyController::class,"consultCompanyForId"])->middleware("auth")->name("api.auth.admin.company.id");
    });
});

Route::prefix("register")->group(function(){
    // se creara el usuario pero antes de responder se ejecutara un evento que creara la empresa y se le assignara de una vez
    Route::post("/my-account",                  [CustomerController::class,"register"])->name("api.public.user.create");
});


Route::get("dashboard", function () {
    $user=Auth::user();
    return Inertia::render("Dashboard",[
        "user" => $user
    ]);
})->name("dashboard")->middleware("auth");

Route::get("/module/example", [ExampleController::class,"index"])->name("example.index");

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
