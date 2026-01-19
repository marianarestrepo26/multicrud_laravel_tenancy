<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Tenant\PublicController;
use App\Http\Controllers\Tenant\AuthController;
use App\Http\Controllers\Tenant\ProductController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Public Catalog
    Route::get('/', [PublicController::class, 'index'])->name('tenant.home');

    // Authentication
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('tenant.login.submit');
    });
    Route::post('logout', [AuthController::class, 'logout'])->name('tenant.logout');

    // Tenant Admin Panel
    Route::middleware('auth')->prefix('admin')->name('tenant.admin.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('tenant.admin.products.index');
        })->name('dashboard');

        Route::resource('products', ProductController::class);
    });
});