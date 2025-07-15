<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;

class LaporanWebController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function harian()
    {
        $transaksi = Transaction::selectRaw('DATE(transaction_date) as tanggal, SUM(total_price) as total_harga')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('laporan.harian', compact('transaksi'));
    }

    public function bulanan()
    {
        $transaksi = Transaction::selectRaw('YEAR(transaction_date) as tahun, MONTH(transaction_date) as bulan, SUM(total_price) as total_harga')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('laporan.bulanan', compact('transaksi'));
    }

    public function tahunan()
    {
        $transaksi = Transaction::selectRaw('YEAR(transaction_date) as tahun, SUM(total_price) as total_harga')
            ->groupBy('tahun')
            ->orderBy('tahun', 'desc')
            ->get();

        return view('laporan.tahunan', compact('transaksi'));
    }

    public function cetakHarian()
{
    $transaksi = Transaction::selectRaw('DATE(transaction_date) as tanggal, SUM(total_price) as total_harga')
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('laporan.harian_print', compact('transaksi'));
}

public function cetakBulanan()
{
    $transaksi = Transaction::selectRaw('YEAR(transaction_date) as tahun, MONTH(transaction_date) as bulan, SUM(total_price) as total_harga')
        ->groupBy('tahun', 'bulan')
        ->orderBy('tahun', 'desc')
        ->orderBy('bulan', 'desc')
        ->get();

    return view('laporan.bulanan_print', compact('transaksi'));
}

public function cetakTahunan()
{
    $transaksi = Transaction::selectRaw('YEAR(transaction_date) as tahun, SUM(total_price) as total_harga')
        ->groupBy('tahun')
        ->orderBy('tahun', 'desc')
        ->get();

    return view('laporan.tahunan_print', compact('transaksi'));
}

}
