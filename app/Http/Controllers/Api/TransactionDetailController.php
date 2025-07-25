<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TransactionDetailController extends Controller
{
    public function index()
    {
        return TransactionDetail::with(['transaction', 'product'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'product_id'     => 'required|exists:products,id',
            'quantity'       => 'required|integer|min:1',
            'price'          => 'required|numeric|min:0',
            'subtotal'       => 'required|numeric|min:0',
        ]);

        return DB::transaction(function () use ($validated) {
            $product = Product::findOrFail($validated['product_id']);

            // Cek stok cukup
            if ($product->stock < $validated['quantity']) {
                return response()->json([
                    'message' => 'Stok produk tidak mencukupi',
                ], 400);
            }

            // Kurangi stok
            $product->stock -= $validated['quantity'];
            $product->save();

            // Simpan detail transaksi
            $detail = TransactionDetail::create($validated);

            return response()->json([
                'message' => 'Detail transaksi berhasil disimpan',
                'data' => $detail
            ], 201);
        });
    }

    public function show($id)
    {
        $detail = TransactionDetail::with(['transaction', 'product'])->findOrFail($id);

        return response()->json($detail);
    }

    public function update(Request $request, $id)
    {
        $detail = TransactionDetail::findOrFail($id);

        $validated = $request->validate([
            'quantity' => 'sometimes|required|integer|min:1',
            'price'    => 'sometimes|required|numeric|min:0',
            'subtotal' => 'sometimes|required|numeric|min:0',
        ]);

        $detail->update($validated);

        return response()->json([
            'message' => 'Detail transaksi diperbarui',
            'data' => $detail
        ]);
    }

    public function destroy($id)
    {
        $detail = TransactionDetail::findOrFail($id);

        // Tambahkan stok kembali saat detail dihapus (opsional)
        $product = Product::find($detail->product_id);
        if ($product) {
            $product->stock += $detail->quantity;
            $product->save();
        }

        $detail->delete();

        return response()->json(['message' => 'Detail transaksi dihapus']);
    }
}
