<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionWebController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_code' => 'required|unique:transactions',
            'total_price'      => 'required',
            'payment_method'   => 'required',
            'transaction_date' => 'required'
        ]);

        Transaction::create($request->all());
        return redirect('/transactions')->with('success', 'Transaksi berhasil disimpan!');
    }
}
