<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\PendaftaranController;
use App\Http\Controllers\Api\MasterData\PendudukController;

// Route::middleware(['api', 'web'])->group(function () {
    Route::get('/search', [SearchController::class, 'index']);

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'edit']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::get('/pendaftaran-pasien', [PendaftaranController::class, 'index']);
    Route::get('/pendaftaran-pasien/{id}', [PendaftaranController::class, 'show']);
    Route::post('/pendaftaran-pasien', [PendaftaranController::class, 'store']);
    Route::put('/pendaftaran-pasien/{id}', [PendaftaranController::class, 'edit']);
    Route::delete('/pendaftaran-pasien/{id}', [PendaftaranController::class, 'destroy']);

    Route::get('/penduduk', [PendudukController::class, 'index']);
    Route::get('/penduduk/{id}', [PendudukController::class, 'show']);
    Route::post('/penduduk', [PendudukController::class, 'store']);
    Route::put('/penduduk/{id}', [PendudukController::class, 'edit']);
    Route::delete('/penduduk/{id}', [PendudukController::class, 'destroy']);

// });
