@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>

  {{-- Tampilkan pesan error validasi --}}
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  {{-- Tampilkan pesan sukses --}}
  @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif

  <form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Nama Produk</label>
      <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" required>
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <select name="category_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->category_name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Supplier</label>
      <select name="supplier_id" class="form-control" required>
        <option value="">-- Pilih Supplier --</option>
        @foreach($suppliers as $supplier)
          <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
            {{ $supplier->supplier_name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Harga</label>
      <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
    </div>

    <div class="form-group">
      <label>Stok</label>
      <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
@endsection
