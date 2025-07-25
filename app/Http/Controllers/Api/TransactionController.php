<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionController extends Controller
{
    // 🔍 Ambil semua transaksi dengan user, detail & produk
    public function index()
    {
        $transactions = Transaction::with([
            'user',
            'details.product.supplier'
        ])->get();

        return response()->json([
    'status' => 'success',
    'message' => 'Daftar transaksi berhasil diambil.',
    'data' => $transactions
]);

    }

    // ➕ Simpan transaksi baru (transaction_code otomatis)
        public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'payment_method' => 'required',
            'payment_status' => 'required',
        ]);

        $transaction = Transaction::create([
            'transaction_code' => 'TRX' . now()->format('YmdHis') . Str::upper(Str::random(5)),
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method,
            'transaction_date' => now(),
            'payment_status' => $request->payment_status,
        ]);

        return response()->json([
            'message' => 'Transaction created successfully',
            'data' => $transaction
        ]);
    }

    // 🔍 Detail transaksi
    public function show($id)
    {
        $transaction = Transaction::with([
            'user',
            'details.product.supplier'
        ])->findOrFail($id);

        return response()->json($transaction);
    }

    // ✏️ Update transaksi
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Transaksi berhasil diperbarui.',
            'data'    => $transaction
        ]);
    }

    // ❌ Hapus transaksi
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus.']);
    }

    // 💳 Proses pembayaran
    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'payment_channel' => 'required|string',
            'payment_proof'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $transaction = Transaction::findOrFail($id);

        if ($request->hasFile('payment_proof')) {
            $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');
            $transaction->payment_proof = $filePath;
        }

        $transaction->payment_channel = $request->payment_channel;
        $transaction->payment_status = 'pending';
        $transaction->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pembayaran berhasil diproses.',
            'data'    => [
                'transaction_code'   => $transaction->transaction_code,
                'payment_channel'    => $transaction->payment_channel,
                'payment_method'     => $transaction->payment_method,
                'payment_status'     => $transaction->payment_status,
                'total'              => $transaction->total_price,
                'payment_proof_url'  => $transaction->payment_proof ? asset('storage/' . $transaction->payment_proof) : null
            ]
        ]);
    }

    // ✅ Konfirmasi pembayaran manual
    public function confirmPayment($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->payment_status = 'paid';
        $transaction->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pembayaran telah dikonfirmasi.',
            'data'    => $transaction
        ]);
    }

    // 🖨 Tandai sudah dicetak
    public function markAsPrinted($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->print_status = 1;
        $transaction->printed_at = now();
        $transaction->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Transaksi ditandai telah dicetak.',
            'data'    => $transaction
        ]);
    }
}
