<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TransactionDetailController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PemilikDashboardApiController;

// Route cek user login saat ini (pakai token)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
route::post('/login', [AuthController::class, 'login']);
// Auth routes (tanpa middleware)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/pemilik-dashboard', [PemilikDashboardApiController::class, 'index'])->middleware('auth:sanctum');

// Route protected, butuh token untuk akses
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Profile User
    Route::get('/profile', [AuthController::class, 'profile']);

    // Categories CRUD
    Route::apiResource('categories', CategoryController::class);

    // Suppliers CRUD
    Route::apiResource('suppliers', SupplierController::class);

    // Products CRUD
    Route::apiResource('products', ProductController::class);

    // Transactions CRUD
    Route::apiResource('transactions', TransactionController::class);

    // Transaction Details CRUD
    Route::apiResource('transaction-details', TransactionDetailController::class);
});
