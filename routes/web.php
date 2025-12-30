<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Sections\WebViewController;

Route::get('/', [WebViewController::class, 'app_view'])->name('welcome');
Route::get('/home', [WebViewController::class, 'home_view'])->name('home');
Route::get('/dashboard', [WebViewController::class, 'dashboard_view'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
