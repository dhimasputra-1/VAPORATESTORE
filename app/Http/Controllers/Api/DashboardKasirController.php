<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardKasirController extends Controller
{
    public function index()
    {
        $jumlahProduk     = Product::count();
        $jumlahSupplier   = Supplier::count();
        $jumlahTransaksi  = Transaction::count();

        $transaksiPerBulan = Transaction::select(
            DB::raw("MONTH(created_at) as bulan"),
            DB::raw("COUNT(*) as total")
        )->groupBy('bulan')
         ->orderBy('bulan')
         ->get();

        $transaksiTerbaru = Transaction::latest()->limit(5)->get();

        return response()->json([
            'jumlah_produk' => $jumlahProduk,
            'jumlah_supplier' => $jumlahSupplier,
            'jumlah_transaksi' => $jumlahTransaksi,
            'transaksi_per_bulan' => $transaksiPerBulan,
            'transaksi_terbaru' => $transaksiTerbaru
        ]);
    }
}
