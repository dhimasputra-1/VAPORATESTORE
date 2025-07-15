@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
<div class="container">
  <h1 class="h3 mb-4 text-gray-800">Data Kategori</h1>

  {{-- Flash Success --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Tombol Tambah --}}
  <div class="mb-3">
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah Kategori
    </a>
  </div>

  {{-- Tabel Kategori --}}
  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-hover table-bordered">
        <thead class="table-primary">
          <tr>
            <th>Nama Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $category)
            <tr>
              <td>{{ $category->category_name }}</td>
              <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning" title="Edit Kategori">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus kategori ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" title="Hapus Kategori">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="2" class="text-center">Belum ada kategori</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
