@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Tambah Supplier</h1>
  <form action="{{ route('suppliers.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Nama Supplier</label>
      <input type="text" name="supplier_name" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Telepon</label>
      <input type="text" name="phone" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <textarea name="address" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
@endsection
