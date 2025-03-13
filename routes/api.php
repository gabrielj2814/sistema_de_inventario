<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix("v1")->group(function(){

    Route::post("/login",[LoginController::class,"login"])->name("api.login");
    Route::get("/logout",[LoginController::class,"logout"])->middleware("auth:sanctum")->name("api.logout");
    Route::get("/remove-all-session",[LoginController::class,"removerAllSession"])->middleware("auth:sanctum")->name("api.removeAllSession");


});
