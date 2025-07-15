<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierWebController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $suppliers = Supplier::when($keyword, function ($query) use ($keyword) {
            $query->where('supplier_name', 'like', "%{$keyword}%")
                  ->orWhere('phone', 'like', "%{$keyword}%")
                  ->orWhere('address', 'like', "%{$keyword}%");
        })->paginate(10); // <-- Tambahkan paginate di sini

        // Kirim juga keyword agar pagination tetap mempertahankan pencarian
        return view('suppliers.index', compact('suppliers', 'keyword'));
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

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'supplier_name' => $request->supplier_name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Data supplier berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Data supplier berhasil dihapus.');
    }
}
