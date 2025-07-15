@extends('layouts.app')

@section('title', 'Laporan Tahunan')

@section('content')
<div class="container">
  <h1 class="h3 mb-4 text-gray-800">Laporan Tahunan</h1>

  <div class="mb-3">
    <a href="{{ route('laporan.tahunan.cetak') }}" class="btn btn-success">
      <i class="bi bi-printer"></i> Cetak Laporan
    </a>
    <a href="{{ route('pemilik.dashboard') }}" class="btn btn-secondary">Kembali</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-hover table-bordered">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Total Penjualan</th>
          </tr>
        </thead>
        <tbody>
          @forelse($transaksi as $key => $item)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $item->tahun }}</td>
            <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center">Belum ada transaksi tahun ini.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
