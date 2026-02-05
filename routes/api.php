<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

Route::post('register', [AuthController::class, 'register']);
Route::post('verify_otp', [AuthController::class, 'verifyOtp']);

Route::get('customers', [CustomerController::class, 'allCustomers']);
Route::get('customer', [CustomerController::class, 'singleCustomer']);
Route::post('edit_customer', [CustomerController::class, 'updateCustomer']);
Route::post('create_customer', [CustomerController::class, 'addCustomer']);
Route::post('delete_customer', [CustomerController::class, 'deleteCustomer']);

Route::get('transactions', [TransactionController::class, 'transactions']);
Route::post('create_transaction', [TransactionController::class, 'createTransaction']);
Route::post('edit_transaction', [TransactionController::class, 'updateTransaction']);
Route::post('delete_transaction', [TransactionController::class, 'deleteTransaction']);

Route::get('user_data', [DashboardController::class, 'userData']);
