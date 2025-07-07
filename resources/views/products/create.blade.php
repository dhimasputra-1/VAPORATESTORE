@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>
  <form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Nama Produk</label>
      <input type="text" name="product_name" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Kategori</label>
      <select name="category_id" class="form-control" required>
        {{-- @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach --}}
      </select>
    </div>
    <div class="form-group">
      <label>Supplier</label>
      <select name="supplier_id" class="form-control" required>
        {{-- @foreach($suppliers as $supplier)
          <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
        @endforeach --}}
      </select>
    </div>
    <div class="form-group">
      <label>Harga</label>
      <input type="number" name="price" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Stok</label>
      <input type="number" name="stock" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
@endsection
