@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Riwayat Transaksi</h1>
  <a href="#" class="btn btn-success mb-3">+ Transaksi Baru</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Kode Transaksi</th>
        <th>Tanggal</th>
        <th>Total Harga</th>
        <th>Metode Bayar</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      {{-- Data transaksi di sini --}}
    </tbody>
  </table>
@endsection
