<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class TransactionWebController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $code = 'TRX' . date('YmdHis');
        $categories = Category::all();
        $products   = Product::where('stock', '>', 0)->get();

        return view('transactions.create', compact('code', 'categories', 'products'));
    }



    public function struk($id)
    {
        $transaction = Transaction::with(['details.product', 'user'])->findOrFail($id);
        return view('transactions.struk', compact('transaction'));
    }



    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'transaction_code' => 'required',
            'transaction_date' => 'required|date',
            'payment_method' => 'required|in:cash,transfer,ewallet,qris',
            'products' => 'required|array',
            'quantities' => 'required|array',
            'subtotals' => 'required|array',
            'total_amount' => 'required|numeric',
        ]);

        if (!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'User belum login']);
        }

        DB::beginTransaction();

        try {
            // Simpan transaksi utama
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'transaction_code' => $request->transaction_code,
                'transaction_date' => $request->transaction_date,
                'payment_method' => $request->payment_method,
                'total_price' => 0, // sementara
            ]);

            $total = 0;

            foreach ($request->products as $index => $productId) {
                $product = Product::findOrFail($productId);
                $qty = $request->quantities[$index];
                $subtotal = $request->subtotals[$index];

                if ($qty > $product->stock) {
                    throw new \Exception("Stok produk {$product->product_name} tidak mencukupi.");
                }

                // Validasi subtotal dari client, boleh nonaktif kalau yakin
                $expectedSubtotal = $product->price * $qty;
                if ($subtotal != $expectedSubtotal) {
                    throw new \Exception("Subtotal tidak valid untuk produk {$product->product_name}.");
                }

                // Simpan detail transaksi
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                // Kurangi stok produk
                $product->decrement('stock', $qty);

                $total += $subtotal;
            }

            // Update total transaksi
            $transaction->update(['total_price' => $total]);

            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function payment($id)
{
    $transaction = Transaction::with('details.product')->findOrFail($id);
    return view('transactions.payment', compact('transaction'));
}

public function paymentProcess(Request $request, $id)
{
    $transaction = Transaction::findOrFail($id);

    $request->validate([
        'payment_channel' => 'required',
        'payment_proof' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    if ($request->hasFile('payment_proof')) {
        $fileName = 'payment_' . time() . '.' . $request->payment_proof->extension();
        $request->payment_proof->move(public_path('uploads/payments'), $fileName);
        $transaction->payment_proof = $fileName;
    }

    $transaction->payment_channel = $request->payment_channel;
    $transaction->payment_status = 'paid';
    $transaction->save();

    return redirect()->route('transactions.index')->with('success', 'Pembayaran berhasil diselesaikan!');
}



}
