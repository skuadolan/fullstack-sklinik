<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



    Route::prefix('master-data')->group(function () {
        Route::get('/golongan-darah', [WebController::class, 'GolonganDarah'])->name('master-data.golongan-darah');
        Route::get('/user-system', [WebController::class, 'UserSystem'])->name('master-data.user-system');
        Route::get('/wilayah', [WebController::class, 'Wilayah'])->name('master-data.wilayah');
    });

    Route::prefix('transaksi')->group(function () {
        Route::get('/pendaftaran-pasien', [WebController::class, 'PendaftaranPasien'])->name('transaksi.pendaftaran-pasien');

        Route::prefix('pelaksanaan-pelayanan')->group(function () {
            Route::get('/', [PelaksanaanPelayananController::class, 'index']);
            Route::get('/{id_kunjungan}', [PelaksanaanPelayananController::class, 'show']);
        });
    });

    Route::prefix('v1')->group(function () {
        Route::prefix('transaksi')->group(function () {
            Route::post('/pendaftaran-pasien', [PendaftaranPasienController::class, 'store']);
        });
    });
});
