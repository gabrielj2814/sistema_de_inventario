<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Route::get("/post", [PostController::class,"vistaIndex"])->name("post.index");
// Route::get("/post/{id}", [PostController::class,"postId"])->name("post.id");

Route::prefix("/autor")->group(function(){
    Route::get("/{autor_id}",                             [PostController::class,"vistaIndex"])->name("autor.index");
    Route::get("/{autor_id}/post",                       [PostController::class,"crearPostView"])->name("autor.post.formuarlio");
    Route::post("/{autor_id}/post",                       [PostController::class,"crearPost"])->name("autor.post.crear");
    Route::get("/{autor_id}/post/{post_id}",              [PostController::class,"postId"])->name("autor.post.id");
    // Route::get("/post", [PostController::class,"vistaIndex"])->name("autor.post.index");
    // Route::get("/post/{id}", [PostController::class,"postId"])->name("autor.post.id");
});






require __DIR__.'/auth.php';
