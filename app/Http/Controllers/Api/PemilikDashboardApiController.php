<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemilikDashboardApiController extends Controller
{
    public function index()
    {
        // Total penjualan hari ini
        $penjualanHariIni = Transaction::whereDate('transaction_date', now())->sum('total_price');

        // Total penjualan bulan ini
        $penjualanBulanIni = Transaction::whereMonth('transaction_date', now()->month)->sum('total_price');

        // Total penjualan tahun ini
        $penjualanTahunIni = Transaction::whereYear('transaction_date', now()->year)->sum('total_price');

        // Jumlah transaksi hari ini
        $jumlahTransaksiHariIni = Transaction::whereDate('transaction_date', now())->count();

        // Produk terlaris bulan ini (top 5)
        $produkTerlaris = TransactionDetail::select('product_id', DB::raw('SUM(quantity) as jumlah_terjual'))
            ->whereMonth('created_at', now()->month)
            ->groupBy('product_id')
            ->orderByDesc('jumlah_terjual')
            ->with('product')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->product->product_name,
                    'jumlah_terjual' => $item->jumlah_terjual
                ];
            });

        // Label bulan dan total penjualan per bulan (12 bulan)
        $labelBulan = [];
        $dataPenjualan = [];

        for ($i = 1; $i <= 12; $i++) {
            $labelBulan[] = Carbon::create()->month($i)->format('F');
            $dataPenjualan[] = Transaction::whereMonth('transaction_date', $i)
                ->whereYear('transaction_date', now()->year)
                ->sum('total_price');
        }

        // Kirim response JSON
        return response()->json([
            'penjualan_hari_ini' => $penjualanHariIni,
            'penjualan_bulan_ini' => $penjualanBulanIni,
            'penjualan_tahun_ini' => $penjualanTahunIni,
            'jumlah_transaksi_hari_ini' => $jumlahTransaksiHariIni,
            'produk_terlaris' => $produkTerlaris,
            'label_bulan' => $labelBulan,
            'data_penjualan_per_bulan' => $dataPenjualan
        ]);
    }
}
