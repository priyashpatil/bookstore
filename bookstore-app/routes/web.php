<?php

use Illuminate\Support\Facades\Route;

// Admin Routes
Route::prefix('/admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\LoginController::class, 'show'])->name('admin.login');
    Route::post('/', [\App\Http\Controllers\Admin\LoginController::class, 'handleLogin']);
    Route::get('/sign-out', [\App\Http\Controllers\Admin\LoginController::class, 'signOut'])->name('admin.sign-out');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');
        Route::resource('/books', \App\Http\Controllers\Admin\BookController::class, ['as' => 'admin']);
    });
});

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
Route::get('/{book}', \App\Http\Controllers\BookShowController::class)->name('books.show');

