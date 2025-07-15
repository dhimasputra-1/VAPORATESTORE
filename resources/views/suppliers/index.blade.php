@extends('layouts.app')

@section('title', 'Data Supplier')

@section('content')
<div class="container">
  <h1 class="h3 mb-4 text-gray-800">Data Supplier</h1>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <form action="{{ route('suppliers.index') }}" method="GET" class="row g-3 mb-3">
    <div class="col-auto">
      <input type="text" name="keyword" class="form-control" placeholder="Cari supplier..."
             value="{{ request('keyword') }}">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i> Cari</button>
      <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
  </form>

  <div class="mb-3">
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah Supplier
    </a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-hover table-bordered">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Nama Supplier</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($suppliers as $index => $supplier)
            <tr>
              <td>{{ $loop->iteration + ($suppliers->firstItem() ?? 0) - 1 }}</td>
              <td>{{ $supplier->supplier_name }}</td>
              <td>{{ $supplier->phone }}</td>
              <td>{{ $supplier->address }}</td>
              <td>
                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-warning" title="Edit Supplier">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" title="Hapus Supplier">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>

            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">Tidak ada data supplier.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="d-flex justify-content-center">
    {{ $suppliers->withQueryString()->links() }}
  </div>
</div>
@endsection
