<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KasirDashboardApiController extends Controller
{
    public function index()
    {
        try {
            // 📦 Jumlah Produk & Supplier
            $total_produk = Product::count();
            $total_supplier = Supplier::count();

            // 📊 Grafik Transaksi Bulanan (Tahun Ini)
            $grafik_transaksi = Transaction::select(
                    DB::raw('MONTH(created_at) as bulan'),
                    DB::raw('COUNT(*) as total')
                )
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get()
                ->pluck('total', 'bulan')
                ->mapWithKeys(function ($item, $key) {
                    $month = Carbon::create()->month($key)->locale('id')->translatedFormat('F');
                    return [$month => $item];
                });

            // 🧾 5 Transaksi Terbaru
            $transaksi_terbaru = Transaction::orderBy('created_at', 'desc')
                ->take(5)
                ->get(['transaction_code', 'created_at', 'total_price'])
                ->map(function ($trx) {
                    return [
                        'kode' => $trx->transaction_code,
                        'tanggal' => Carbon::parse($trx->created_at)->format('Y-m-d'),
                        'total' => $trx->total_price,
                    ];
                });

            // ✅ Respon sukses
            return response()->json([
                'success' => true,
                'total_produk' => $total_produk,
                'total_supplier' => $total_supplier,
                'grafik_transaksi' => $grafik_transaksi,
                'transaksi_terbaru' => $transaksi_terbaru,
            ]);
        } catch (\Throwable $th) {
            // ❌ Error handler
            return response()->json([
                'error' => true,
                'message' => $th->getMessage(),
                'line' => $th->getLine()
            ], 500);
        }
    }
}
