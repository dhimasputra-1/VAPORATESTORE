<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return Supplier::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required',
            'phone'         => 'required',
            'address'       => 'required'
        ]);

        return Supplier::create($request->all());
    }

    public function show($id)
    {
        return Supplier::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        return $supplier;
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
