<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductWebController;
use App\Http\Controllers\SupplierWebController;
use App\Http\Controllers\TransactionWebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanWebController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Kasir Area (Protected by auth & role:kasir)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('kasir.dashboard');

    // Produk
    Route::resource('/products', ProductWebController::class)->except(['show']);

    // Supplier
    Route::get('/suppliers', [SupplierWebController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierWebController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SupplierWebController::class, 'store'])->name('suppliers.store');

    // Transaksi
    Route::get('/transactions', [TransactionWebController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionWebController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionWebController::class, 'store'])->name('transactions.store');

    // Struk (Static view)
    Route::view('/struk', 'transactions.struk')->name('transactions.struk');
});

/*
|--------------------------------------------------------------------------
| Pemilik Area (Protected by auth & role:pemilik)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pemilik'])->group(function () {
    // Laporan
    Route::get('/laporan', [LaporanWebController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/harian', [LaporanWebController::class, 'harian'])->name('laporan.harian');
    Route::get('/laporan/bulanan', [LaporanWebController::class, 'bulanan'])->name('laporan.bulanan');
    Route::get('/laporan/tahunan', [LaporanWebController::class, 'tahunan'])->name('laporan.tahunan');

    // Manajemen User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

/*
|--------------------------------------------------------------------------
| Unauthorized Page (fallback)
|--------------------------------------------------------------------------
*/
Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');
