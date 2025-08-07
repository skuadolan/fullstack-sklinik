<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\SearchController;

Route::middleware(['api'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('search')->group(function () {
            Route::get('wilayah', [SearchController::class, 'SearchWilayah']);
            Route::get('roles', [SearchController::class, 'SearchRoles']);
            Route::get('users', [SearchController::class, 'SearchUsers']);
            Route::get('pasien', [SearchController::class, 'SearchPasien']);
            Route::get('rajal', [SearchController::class, 'SearchRajal']);
            Route::get('ranap', [SearchController::class, 'SearchRanap']);

            Route::prefix('kunjungan')->group(function () {
                Route::get('pasien/{id}', [SearchController::class, 'SearchKunjunganPasienByID']);
            });
        });

        Route::prefix('pendaftaran')->group(function () {
            // Route::resource('client', UserController::class);
            // Route::resource('pasien', PendaftaranController::class);
        });
    });
});
