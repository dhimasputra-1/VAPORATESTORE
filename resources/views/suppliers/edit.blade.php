@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Edit Supplier</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="supplier_name" class="form-label">Nama Supplier</label>
      <input type="text" name="supplier_name" class="form-control" value="{{ $supplier->supplier_name }}" required>
    </div>

    <div class="mb-3">
      <label for="phone" class="form-label">Telepon</label>
      <input type="text" name="phone" class="form-control" value="{{ $supplier->phone }}" required>
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Alamat</label>
      <textarea name="address" class="form-control" rows="3" required>{{ $supplier->address }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
@endsection
