<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Sections\SearchController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::prefix('search')->group(function () {
        Route::prefix('wilayah')->group(function () {
            Route::get('/provinsi', [SearchController::class, 'getProvinsi']);
            Route::get('/kabupaten/{id_provinsi}', [SearchController::class, 'getKabupaten']);
            Route::get('/kecamatan/{id_kabupaten}', [SearchController::class, 'getKecamatan']);
            Route::get('/kelurahan/{id_kecamatan}', [SearchController::class, 'getKelurahan']);
        });
    });
});
