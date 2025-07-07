@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Edit Produk</h1>
  <form action="{{ url('/products/'.$product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label>Nama Produk</label>
      <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" required>
    </div>
    <div class="form-group">
      <label>Kategori</label>
      <select name="category_id" class="form-control">
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->category_name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Supplier</label>
      <select name="supplier_id" class="form-control">
        @foreach($suppliers as $supplier)
          <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
            {{ $supplier->supplier_name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Harga</label>
      <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>
    <div class="form-group">
      <label>Stok</label>
      <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
@endsection
