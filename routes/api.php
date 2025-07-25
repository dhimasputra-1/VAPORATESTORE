<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    CategoryController,
    SupplierController,
    ProductController,
    TransactionController,
    TransactionDetailController,
    UserController,
    PemilikDashboardApiController,
    KasirDashboardApiController
};

// ======================
// 🔓 Public Routes
// ======================

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ======================
// 🔐 Protected Routes (Login Required)
// ======================
Route::middleware('auth:sanctum')->group(function () {

    // 👤 Auth & User Info
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/user', fn(Request $request) => $request->user());

    // 📊 Dashboard Pemilik & Laporan
    Route::prefix('pemilik')->group(function () {
        Route::get('/dashboard', [PemilikDashboardApiController::class, 'index']);
        Route::get('/laporan-harian', [PemilikDashboardApiController::class, 'laporanHarian']);
        Route::get('/laporan-bulanan', [PemilikDashboardApiController::class, 'laporanBulanan']);
        Route::get('/laporan-tahunan', [PemilikDashboardApiController::class, 'laporanTahunan']);
    });

    // 📊 Dashboard Kasir
    Route::get('/kasir-dashboard', [KasirDashboardApiController::class, 'index']);

    // 📂 Master Data
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/suppliers', SupplierController::class);
    Route::apiResource('/products', ProductController::class);
    Route::apiResource('/users', UserController::class); // bisa digunakan oleh admin

    // 💰 Transaksi & Detail Transaksi
    Route::apiResource('/transactions', TransactionController::class);
    Route::apiResource('/transaction-details', TransactionDetailController::class);
});
