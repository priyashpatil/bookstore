<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
Route::get('/{book}', \App\Http\Controllers\BookShowController::class)->name('books.show');

// Admin Routes
Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class);
});
