<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('welcome');
    });

    require __DIR__ . '/auth.php';
});
