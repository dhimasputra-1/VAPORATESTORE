<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class LaporanWebController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function harian()
    {
        $today = Carbon::today();
        $transaksi = Transaction::whereDate('created_at', $today)->get();
        return view('laporan.harian', compact('transaksi'));
    }

    public function bulanan()
    {
        $month = Carbon::now()->month;
        $transaksi = Transaction::whereMonth('created_at', $month)->get();
        return view('laporan.bulanan', compact('transaksi'));
    }

    public function tahunan()
    {
        $year = Carbon::now()->year;
        $transaksi = Transaction::whereYear('created_at', $year)->get();
        return view('laporan.tahunan', compact('transaksi'));
    }
}
