<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    // Tampilkan semua produk
        public function index()
    {
        $products = Product::with(['category', 'supplier'])->get();
        return view('products.index', compact('products'));
    }

    // Form tambah produk
    public function create()
    {
        $categories = Category::all();
        $suppliers  = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'supplier_id'  => 'required|exists:suppliers,id',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0'
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Form edit produk
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        $suppliers  = Supplier::all();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'supplier_id'  => 'required|exists:suppliers,id',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0'
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    // Hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
