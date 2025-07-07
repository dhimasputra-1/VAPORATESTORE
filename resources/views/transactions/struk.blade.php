@extends('layouts.app')

@section('title', 'Cetak Struk')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Struk Transaksi</h1>
  <div class="border p-3">
    <p><strong>Kode:</strong> #TRX001</p>
    <p><strong>Tanggal:</strong> 07-07-2025</p>
    <p><strong>Total:</strong> Rp 250.000</p>
    <p><strong>Metode:</strong> Cash</p>
    <hr>
    <p>Terima kasih atas pembelian Anda!</p>
  </div>
  <a href="#" class="btn btn-primary mt-3" onclick="window.print()">Cetak</a>
@endsection
