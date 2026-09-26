<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/test-error', function () {
    abort(500); // Atau buat syntax error / undefined variable
});

Route::get('/', [WebController::class, 'WelcomeGet'])->name('welcome');

Route::prefix('demo')->group(function () {
    Route::get('/', [WebController::class, 'DemoGet'])->name('demo');
    Route::get('/patients', [WebController::class, 'PatientsGet'])->name('patients');
    Route::get('/billing', [WebController::class, 'BillingGet'])->name('billing');
    Route::get('/inventory', [WebController::class, 'InventoryGet'])->name('inventory');
});

Route::get('/dashboard', WebController::class.'@DashboardGet')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
