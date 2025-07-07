<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function index()
    {
        return TransactionDetail::with(['transaction', 'product'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required',
            'product_id'     => 'required',
            'quantity'       => 'required',
            'price'          => 'required',
            'subtotal'       => 'required'
        ]);

        return TransactionDetail::create($request->all());
    }

    public function show($id)
    {
        return TransactionDetail::with(['transaction', 'product'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $detail = TransactionDetail::findOrFail($id);
        $detail->update($request->all());
        return $detail;
    }

    public function destroy($id)
    {
        $detail = TransactionDetail::findOrFail($id);
        $detail->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
