<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // GET /api/products
    public function index()
    {
        return response()->json(Product::with(['category', 'supplier'])->get());
    }

    // POST /api/products
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|integer',
            'supplier_id'  => 'required|integer',
            'price'        => 'required|numeric',
            'stock'        => 'required|integer',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'product_name' => $request->product_name,
            'category_id'  => $request->category_id,
            'supplier_id'  => $request->supplier_id,
            'price'        => $request->price,
            'stock'        => $request->stock,
            'image'        => $imagePath,
        ]);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'data'    => $product
        ], 201);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::with(['category', 'supplier'])->findOrFail($id);
        return response()->json($product);
    }

    // PUT /api/products/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'sometimes|required|string|max:255',
            'category_id'  => 'sometimes|required|integer',
            'supplier_id'  => 'sometimes|required|integer',
            'price'        => 'sometimes|required|numeric',
            'stock'        => 'sometimes|required|integer',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Simpan gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $request->file('image')->store('products', 'public');
        }

        // Update field lain
        $product->fill($request->except('image'));
        $product->save();

        return response()->json([
            'message' => 'Produk berhasil diperbarui',
            'data'    => $product
        ]);
    }

    // DELETE /api/products/{id}
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
