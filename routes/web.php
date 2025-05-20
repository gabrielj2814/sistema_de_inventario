<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonalAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::prefix("app")->middleware("auth")->group(function(){

    Route::get("dashboard", function () {
        $user=Auth::user();
        $app_url=env("APP_URL");
        $rutas=Route::getRoutes()->getRoutesByName();
        return Inertia::render("Home",[
            "rutas" => $rutas,
            "app_url" => $app_url
        ]);
    })->name("dashboard");

    Route::prefix("auth")->group(function(){
        Route::get("/logout",              [LoginController::class,"logout"])->name("web.logout");
        Route::get("/remove-all-session",  [LoginController::class,"removerAllSession"])->name("web.removeAllSession");
    });

    Route::prefix("admin")->group(function(){

        Route::prefix("user")->group(function(){
            Route::get("/index",   [AdminController::class,"viewIndex"])->name("view.personal.admin.index");
            Route::get("/",        [AdminController::class,"consultAll"])->middleware("auth")->name("web.admin.all");
            Route::get("/{id}",    [AdminController::class,"consultUserForId"])->middleware("auth")->name("web.admin.id");
            Route::post("/",       [AdminController::class,"createdUser"])->middleware("auth")->name("web.admin.create");
            Route::put("/{id}",    [AdminController::class,"updatedUser"])->middleware("auth")->name("web.admin.update");
            Route::delete("/{id}", [AdminController::class,"deleteUser"])->middleware("auth")->name("web.admin.delete");
        });

        Route::prefix("company")->group(function(){
            Route::get("/",                [CompanyController::class,"consultAllCompanies"])->middleware("auth")->name("web.auth.admin.company.all");
            Route::post("/",               [CompanyController::class,"creatCompany"])->middleware("auth")->name("web.auth.admin.company.create");
            Route::put("/{id}",            [CompanyController::class,"updateCompany"])->middleware("auth")->name("web.auth.admin.company.update");
            Route::delete("/{id}",         [CompanyController::class,"deleteCompany"])->middleware("auth")->name("web.auth.admin.company.id.delete");
            Route::get("/{id}",            [CompanyController::class,"consultCompanyForId"])->middleware("auth")->name("web.auth.admin.company.id");
        });
    });

    Route::prefix("register")->group(function(){
        // se creara el usuario pero antes de responder se ejecutara un evento que creara la empresa y se le assignara de una vez
        Route::post("/my-account",                  [CustomerController::class,"register"])->name("web.public.user.create");
    });



});

Route::prefix("auth")->group(function(){
    Route::get("/login",                         [LoginController::class,"view"])->name("view.auth.login.admin");
    Route::post("/login",                        [LoginController::class,"login"])->name("web.auth.login");
    Route::get("/login/company/{company_id}",    [LoginController::class,"viewLoginCompany"])->name("web.auth.login.company");
});








Route::get("/module/example", [ExampleController::class,"index"])->name("example.index");

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
