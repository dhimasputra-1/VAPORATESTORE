<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class PemilikDashboardController extends Controller
{
    public function index()
    {
        $penjualanHariIni = Transaction::whereDate('transaction_date', now())->sum('total_price');
        $penjualanBulanIni = Transaction::whereMonth('transaction_date', now()->month)->sum('total_price');
        $penjualanTahunIni = Transaction::whereYear('transaction_date', now()->year)->sum('total_price');
        $jumlahTransaksiHariIni = Transaction::whereDate('transaction_date', now())->count();

        $produkTerlaris = TransactionDetail::select('product_id', DB::raw('SUM(quantity) as jumlah_terjual'))
                        ->whereMonth('created_at', now()->month)
                        ->groupBy('product_id')
                        ->orderByDesc('jumlah_terjual')
                        ->with('product')
                        ->limit(5)
                        ->get()
                        ->map(function($item){
                            return (object)[
                                'nama' => $item->product->product_name,
                                'jumlah_terjual' => $item->jumlah_terjual
                            ];
                        });

        $labelBulan = [];
        $dataPenjualan = [];
        for ($i = 1; $i <= 12; $i++) {
            $labelBulan[] = \Carbon\Carbon::create()->month($i)->format('F');
            $dataPenjualan[] = Transaction::whereMonth('transaction_date', $i)
                                    ->whereYear('transaction_date', now()->year)
                                    ->sum('total_price');
        }

        return view('dashboard_pemilik', compact(
            'penjualanHariIni',
            'penjualanBulanIni',
            'penjualanTahunIni',
            'jumlahTransaksiHariIni',
            'produkTerlaris',
            'labelBulan',
            'dataPenjualan'
        ));
    }
}
