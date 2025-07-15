@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
<div class="container">
  <h1 class="h3 mb-4 text-gray-800">Data Produk</h1>

  {{-- Flash Success --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Form Pencarian --}}
  <form action="{{ route('products.index') }}" method="GET" class="row g-3 mb-3">
    <div class="col-auto">
      <input type="text" name="keyword" class="form-control" placeholder="Cari produk..." value="{{ request('keyword') }}">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-outline-primary">
        <i class="bi bi-search"></i> Cari
      </button>
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
  </form>

  {{-- Tombol Tambah --}}
  <div class="mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah Produk
    </a>
  </div>

  {{-- Tabel Produk --}}
  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-hover table-bordered">
        <thead class="table-primary">
          <tr>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Supplier</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($products as $product)
            <tr>
              <td>{{ $product->product_name }}</td>
              <td>{{ $product->category->category_name ?? '-' }}</td>
              <td>{{ $product->supplier->supplier_name ?? '-' }}</td>
              <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
              <td>{{ $product->stock }}</td>
              <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning" title="Edit Produk">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus produk ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" title="Hapus Produk">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>


            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">Belum ada produk</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
