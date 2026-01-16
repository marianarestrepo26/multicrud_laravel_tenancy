<?php

use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        Route::middleware('web')->group(function () {

            Route::get('/', function () {
                return redirect()->route('tenants.index');
            });

            Route::resource('tenants', App\Http\Controllers\Central\TenantController::class);
            Route::resource('tenants.admins', App\Http\Controllers\Central\TenantAdminController::class);
            Route::resource('admins', App\Http\Controllers\Central\AdminController::class);
        });

    });
}