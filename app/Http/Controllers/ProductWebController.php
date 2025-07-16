<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    // Tampilkan semua produk
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $products = Product::with(['category', 'supplier'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('product_name', 'like', "%$keyword%");
            })->get();

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
        'stock'        => 'required|integer|min:0',
        'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

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
            'stock'        => 'required|integer|min:0',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }


    // Hapus produk
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

    // Endpoint AJAX select2 untuk transaksi
    public function ajaxProducts(Request $request)
    {
        $query = Product::query()->where('stock', '>', 0);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('q')) {
            $query->where('product_name', 'like', '%' . $request->q . '%');
        }

        $products = $query->limit(20)->get();

        $results = [];
        foreach ($products as $product) {
            $results[] = [
                'id'    => $product->id,
                'text'  => $product->product_name,
                'price' => $product->price
            ];
        }

        return response()->json(['results' => $results]);
    }
}
