@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Edit Produk</h1>
  <form action="{{ url('/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="product_name" class="form-label">Nama Produk</label>
      <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" required>
    </div>

    <div class="mb-3">
      <label for="category_id" class="form-label">Kategori</label>
      <select name="category_id" class="form-control">
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->category_name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="supplier_id" class="form-label">Supplier</label>
      <select name="supplier_id" class="form-control">
        @foreach($suppliers as $supplier)
          <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
            {{ $supplier->supplier_name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Harga</label>
      <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>

    <div class="mb-3">
      <label for="stock" class="form-label">Stok</label>
      <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Foto Produk</label>
      @if($product->image)
        <div><img src="{{ asset('storage/' . $product->image) }}" width="100"></div>
      @endif
      <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
@endsection