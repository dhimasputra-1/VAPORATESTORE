<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::with('details')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_code' => 'required|unique:transactions',
            'user_id'          => 'required',
            'total_price'      => 'required',
            'payment_method'   => 'required',
            'transaction_date' => 'required'
        ]);

        return Transaction::create($request->all());
    }

    public function show($id)
    {
        return Transaction::with('details')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());
        return $transaction;
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
