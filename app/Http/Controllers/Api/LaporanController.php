<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function harian()
    {
        $transaksi = Transaction::selectRaw('DATE(transaction_date) as tanggal, SUM(total_price) as total_harga')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json($transaksi);
    }

    public function bulanan()
    {
        $transaksi = Transaction::selectRaw('YEAR(transaction_date) as tahun, MONTH(transaction_date) as bulan, SUM(total_price) as total_harga')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return response()->json($transaksi);
    }

    public function tahunan()
    {
        $transaksi = Transaction::selectRaw('YEAR(transaction_date) as tahun, SUM(total_price) as total_harga')
            ->groupBy('tahun')
            ->orderBy('tahun', 'desc')
            ->get();

        return response()->json($transaksi);
    }
}
