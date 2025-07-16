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
    PemilikDashboardApiController
};

// ======================
// 🔓 Public Routes
// ======================

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ======================
// 🔐 Protected Routes
// ======================
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Dashboard
    Route::get('/pemilik-dashboard', [PemilikDashboardApiController::class, 'index']);

    // CRUD Resources
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('transaction-details', TransactionDetailController::class);
});
