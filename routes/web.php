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
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'));

/*
|--------------------------------------------------------------------------
| Kasir Area (Protected by auth & role:kasir)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/dashboard', [DashboardKasirController::class, 'index'])->name('kasir.dashboard');

    // Produk
    Route::resource('products', ProductWebController::class)->except(['show']);
    Route::get('/ajax/products', [ProductWebController::class, 'ajaxProducts'])->name('products.ajax');

    // Supplier
    Route::resource('suppliers', SupplierWebController::class)->except(['show']);

    // Transaksi
    Route::resource('transactions', TransactionWebController::class)->except(['show']);
    Route::get('/transactions/{id}/struk', [TransactionWebController::class, 'struk'])->name('transactions.struk');
    Route::get('/transactions/{id}/payment', [TransactionWebController::class, 'payment'])->name('transactions.payment');
    Route::post('/transactions/{id}/payment-process', [TransactionWebController::class, 'paymentProcess'])->name('transactions.paymentProcess');
});

/*
|--------------------------------------------------------------------------
| Pemilik Area (Protected by auth & role:pemilik)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pemilik'])->group(function () {
    Route::get('/pemilik/dashboard', function () {
        return view('dashboard_pemilik');
    })->name('pemilik.dashboard');
    Route::get('/laporan', [LaporanWebController::class, 'index'])->name('laporan.index');

    // Laporan
    Route::get('/laporan/harian', [LaporanWebController::class, 'harian'])->name('laporan.harian');
    Route::get('/laporan/harian/cetak', [LaporanWebController::class, 'cetakHarian'])->name('laporan.harian.cetak');

    Route::get('/laporan/bulanan', [LaporanWebController::class, 'bulanan'])->name('laporan.bulanan');
    Route::get('/laporan/bulanan/cetak', [LaporanWebController::class, 'cetakBulanan'])->name('laporan.bulanan.cetak');

    Route::get('/laporan/tahunan', [LaporanWebController::class, 'tahunan'])->name('laporan.tahunan');
    Route::get('/laporan/tahunan/cetak', [LaporanWebController::class, 'cetakTahunan'])->name('laporan.tahunan.cetak');

    // Manajemen User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});    

/*
|--------------------------------------------------------------------------
| Kategori Route (Kasir & Pemilik)
|--------------------------------------------------------------------------
*/
Route::resource('categories', CategoryController::class);

/*
|--------------------------------------------------------------------------
| Unauthorized Page
|--------------------------------------------------------------------------
*/
Route::get('/unauthorized', fn() => view('unauthorized'))->name('unauthorized');

Route::get('/dashboard-pemilik', [PemilikDashboardController::class, 'index'])->name('pemilik.dashboard')->middleware('auth');

