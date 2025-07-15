<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardKasirController extends Controller
{
    public function index()
    {
        $jumlahProduk     = Product::count();
        $jumlahSupplier   = Supplier::count();
        $jumlahTransaksi  = Transaction::count();

        // Data transaksi per bulan untuk Chart
        $transaksiPerBulan = Transaction::select(
                DB::raw("MONTH(created_at) as bulan"),
                DB::raw("COUNT(*) as total")
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Transaksi terbaru
        $transaksiTerbaru = Transaction::latest()->limit(5)->get();

        return view('dashboard', compact(
            'jumlahProduk',
            'jumlahSupplier',
            'jumlahTransaksi',
            'transaksiPerBulan',
            'transaksiTerbaru'
        ));
    }
}
