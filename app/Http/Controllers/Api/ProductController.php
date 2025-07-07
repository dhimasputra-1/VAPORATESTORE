<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with(['category', 'supplier'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'category_id'  => 'required',
            'supplier_id'  => 'required',
            'price'        => 'required',
            'stock'        => 'required'
        ]);

        return Product::create($request->all());
    }

    public function show($id)
    {
        return Product::with(['category', 'supplier'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return $product;
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
