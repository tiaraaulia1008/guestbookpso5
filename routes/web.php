<?php

use App\Http\Controllers\GuestRegistrationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')
        ->name('home.index');
});

Route::controller(GuestRegistrationController::class)->group(function () {
    Route::get('guest/registration', 'create')
        ->name('registration.create');

    Route::post('guest/registration/create', 'store')
        ->name('registration.store');
});

use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return "Cache berhasil dihancurkan! Silakan kembali ke halaman utama.";
});
