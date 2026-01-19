<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Central\AuthController;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        Route::middleware('web')->group(function () {

            // Guest Routes
            Route::middleware('guest')->group(function () {
                Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
                Route::post('login', [AuthController::class, 'login'])->name('login.submit');
            });

            // Authenticated Routes
            Route::middleware('auth')->group(function () {
                Route::get('/', function () {
                    return redirect()->route('tenants.index');
                });

                Route::post('logout', [AuthController::class, 'logout'])->name('logout');

                Route::resource('tenants', App\Http\Controllers\Central\TenantController::class);
                Route::resource('tenants.admins', App\Http\Controllers\Central\TenantAdminController::class);
                Route::resource('admins', App\Http\Controllers\Central\AdminController::class);
            });
        });

    });
}