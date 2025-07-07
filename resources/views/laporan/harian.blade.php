@extends('layouts.app')

@section('title', 'Laporan Harian')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Laporan Harian</h1>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Total Harga</th>
    </tr>
  </thead>
  <tbody>
    @foreach($transaksi as $key => $item)
    <tr>
      <td>{{ $key+1 }}</td>
      <td>{{ $item->created_at->format('d-m-Y') }}</td>
      <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
