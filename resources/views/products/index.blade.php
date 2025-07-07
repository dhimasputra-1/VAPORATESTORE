@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Data Produk</h1>
  <a href="#" class="btn btn-primary mb-3">+ Tambah Produk</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama Produk</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->category->category_name ?? '-' }}</td>
        <td>{{ $product->supplier->supplier_name ?? '-' }}</td>
        <td>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>


  </table>
@endsection
