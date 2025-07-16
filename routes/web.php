<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductWebController;
use App\Http\Controllers\SupplierWebController;
use App\Http\Controllers\TransactionWebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanWebController;
use App\Http\Controllers\DashboardKasirController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PemilikDashboardController;





/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // ✅ pakai POST
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));

/*
|--------------------------------------------------------------------------
| Kasir Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/dashboard', [DashboardKasirController::class, 'index'])->name('kasir.dashboard');

    Route::resource('products', ProductWebController::class)->except(['show']);
    Route::resource('suppliers', SupplierWebController::class)->except(['show']);
    Route::resource('transactions', TransactionWebController::class)->except(['show']);

    Route::get('/transactions/{id}/struk', [TransactionWebController::class, 'struk'])->name('transactions.struk');
    Route::get('/transactions/{id}/payment', [TransactionWebController::class, 'payment'])->name('transactions.payment');
    Route::post('/transactions/{id}/payment-process', [TransactionWebController::class, 'paymentProcess'])->name('transactions.paymentProcess');
});

/*
|--------------------------------------------------------------------------
| Pemilik Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pemilik'])->group(function () {
    Route::get('/pemilik/dashboard', [PemilikDashboardController::class, 'index'])->name('pemilik.dashboard');

    Route::get('/laporan', [LaporanWebController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/harian', [LaporanWebController::class, 'harian'])->name('laporan.harian');
    Route::get('/laporan/harian/cetak', [LaporanWebController::class, 'cetakHarian'])->name('laporan.harian.cetak');
    Route::get('/laporan/bulanan', [LaporanWebController::class, 'bulanan'])->name('laporan.bulanan');
    Route::get('/laporan/bulanan/cetak', [LaporanWebController::class, 'cetakBulanan'])->name('laporan.bulanan.cetak');
    Route::get('/laporan/tahunan', [LaporanWebController::class, 'tahunan'])->name('laporan.tahunan');
    Route::get('/laporan/tahunan/cetak', [LaporanWebController::class, 'cetakTahunan'])->name('laporan.tahunan.cetak');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

/*
|--------------------------------------------------------------------------
| Kategori (auth untuk semua role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

/*
|--------------------------------------------------------------------------
| Produk
|--------------------------------------------------------------------------
*/
Route::resource('products', ProductWebController::class);