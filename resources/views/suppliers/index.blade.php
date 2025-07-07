@extends('layouts.app')

@section('title', 'Data Supplier')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Data Supplier</h1>
  <a href="#" class="btn btn-primary mb-3">+ Tambah Supplier</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama Supplier</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      {{-- Data supplier di sini --}}
    </tbody>
  </table>
@endsection
