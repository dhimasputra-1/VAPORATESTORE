<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierWebController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required',
            'phone'         => 'required',
            'address'       => 'required'
        ]);

        Supplier::create($request->all());
        return redirect('/suppliers')->with('success', 'Supplier berhasil ditambahkan!');
    }
}
