@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>
  <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="product_name" class="form-label">Nama Produk</label>
      <input type="text" name="product_name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="category_id" class="form-label">Kategori</label>
      <select name="category_id" class="form-control" required>
        @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="supplier_id" class="form-label">Supplier</label>
      <select name="supplier_id" class="form-control" required>
        @foreach($suppliers as $supplier)
          <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Harga</label>
      <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="stock" class="form-label">Stok</label>
      <input type="number" name="stock" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Foto Produk</label>
      <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
@endsection