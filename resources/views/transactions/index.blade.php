@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
<div class="container">
  <h1 class="h3 mb-4 text-gray-800">Riwayat Transaksi</h1>

  <div class="mb-3">
    <a href="{{ route('transactions.create') }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Transaksi Baru
    </a>
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-hover table-bordered">
        <thead class="table-primary">
          <tr>
            <th>Kode Transaksi</th>
            <th>Tanggal</th>
            <th>Total Harga</th>
            <th>Metode Bayar</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($transactions as $transaction)
            <tr>
              <td>{{ $transaction->transaction_code }}</td>
              <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}</td>
              <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
              <td>{{ strtoupper($transaction->payment_method) }}</td>
              <td>
                @if ($transaction->payment_status == 'paid')
                  <span class="badge bg-success">Sudah Dibayar</span>
                @else
                  <span class="badge bg-warning">Belum Dibayar</span>
                @endif
              </td>
              <td>
                <a href="{{ route('transactions.struk', $transaction->id) }}" class="btn btn-sm btn-primary mb-1">
                  <i class="bi bi-receipt"></i> Struk
                </a>
                @if ($transaction->payment_status == 'pending')
                  <a href="{{ route('transactions.payment', $transaction->id) }}" class="btn btn-sm btn-success">
                    <i class="bi bi-credit-card"></i> Bayar
                  </a>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">Belum ada transaksi.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
