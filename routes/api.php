<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

use App\Http\Services\Api\UserServices;
use App\Http\Services\Api\SearchServices;
use App\Http\Services\Api\PendaftaranServices;

Route::middleware(['api'])->group(function () {
    Route::get('/search', [SearchServices::class, 'index']);

    Route::post('/users', [UserServices::class, 'store']);
    Route::get('/users', [UserServices::class, 'index']);
    Route::get('/users/{id}', [UserServices::class, 'show']);
    Route::put('/users/{id}', [UserServices::class, 'edit']);
    Route::delete('/users/{id}', [UserServices::class, 'destroy']);

    Route::get('/pendaftaran-pasien', [PendaftaranServices::class, 'index']);
    Route::post('/pendaftaran-pasien', [PendaftaranServices::class, 'store']);
    Route::put('/pendaftaran-pasien/{id}', [PendaftaranServices::class, 'edit']);
    Route::delete('/pendaftaran-pasien/{id}', [PendaftaranServices::class, 'destroy']);
});
