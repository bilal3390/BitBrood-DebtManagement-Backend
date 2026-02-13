<?php

use App\Http\Controllers\Admin\Web\AdminWebAuthController;
use App\Http\Controllers\Admin\Web\AdminWebCustomerController;
use App\Http\Controllers\Admin\Web\AdminWebDashboardController;
use App\Http\Controllers\Admin\Web\AdminWebDataController;
use App\Http\Controllers\Admin\Web\AdminWebDebtController;
use App\Http\Controllers\Admin\Web\AdminWebUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin Panel (Blade UI, session auth)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminWebAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminWebAuthController::class, 'login']);

    Route::middleware('admin')->group(function () {
        Route::post('logout', [AdminWebAuthController::class, 'logout'])->name('logout');
        Route::get('/', [AdminWebDashboardController::class, 'index'])->name('dashboard');
        Route::post('data/delete-all', [AdminWebDataController::class, 'destroyAll'])->name('data.delete-all');

        Route::get('users', [AdminWebUserController::class, 'index'])->name('users.index');
        Route::get('users/{user_phone_e164}', [AdminWebUserController::class, 'show'])->name('users.show');

        Route::get('customers', [AdminWebCustomerController::class, 'index'])->name('customers.index');
        Route::get('customers/create', [AdminWebCustomerController::class, 'create'])->name('customers.create');
        Route::post('customers', [AdminWebCustomerController::class, 'store'])->name('customers.store');
        Route::get('customers/{customer_phone_e164}', [AdminWebCustomerController::class, 'show'])->name('customers.show');
        Route::get('customers/{customer_phone_e164}/edit', [AdminWebCustomerController::class, 'edit'])->name('customers.edit');
        Route::put('customers/{customer_phone_e164}', [AdminWebCustomerController::class, 'update'])->name('customers.update');
        Route::delete('customers/{customer_phone_e164}', [AdminWebCustomerController::class, 'destroy'])->name('customers.destroy');

        Route::get('debts', [AdminWebDebtController::class, 'index'])->name('debts.index');
        Route::get('debts/create', [AdminWebDebtController::class, 'create'])->name('debts.create');
        Route::post('debts', [AdminWebDebtController::class, 'store'])->name('debts.store');
        Route::get('debts/{id}', [AdminWebDebtController::class, 'show'])->name('debts.show');
        Route::get('debts/{id}/edit', [AdminWebDebtController::class, 'edit'])->name('debts.edit');
        Route::put('debts/{id}', [AdminWebDebtController::class, 'update'])->name('debts.update');
        Route::delete('debts/{id}', [AdminWebDebtController::class, 'destroy'])->name('debts.destroy');
    });
});
