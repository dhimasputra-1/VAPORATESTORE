@extends('layouts.app')

@section('title', 'Struk Transaksi')

@section('content')
<style>
  .struk-container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ddd;
    background-color: #fff;
    border-radius: 10px;
  }

  .logo-struk {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 50%;
  }

  .struk-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    margin-bottom: 20px;
  }

  .struk-title {
    flex-grow: 1;
    text-align: center;
    font-weight: bold;
    font-size: 1.5rem;
  }

  .no-print {
    display: block;
  }

  @media print {
    .no-print {
      display: none !important;
    }

    body {
      background-color: white;
    }

    .struk-container {
      border: none;
    }
  }
</style>

<div class="struk-container">
  <div class="struk-header">
    <img src="{{ asset('storage/logo-vape.jpg') }}" alt="Logo" class="logo-struk">
    <div class="struk-title">Struk Transaksi</div>
  </div>

  <div>
    <p><strong>Kode Transaksi:</strong> #{{ $transaction->transaction_code }}</p>
    <p><strong>Kasir:</strong> {{ $transaction->user->name ?? 'Kasir Tidak Diketahui'  }}</p>
    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ ucfirst($transaction->payment_method) }}</p>
  </div>

  <hr>

  <h5>Rincian Produk</h5>
  <table class="table table-sm table-bordered">
    <thead class="table-light">
      <tr>
        <th>Produk</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($transaction->details as $detail)
        <tr>
          <td>{{ $detail->product->product_name ?? '-' }}</td>
          <td>{{ $detail->quantity }}</td>
          <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
          <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <p class="text-end mt-3"><strong>Total:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>

  <hr>
  <p class="text-center">Terima kasih atas pembelian Anda!</p>

  <div class="no-print text-center mt-4">
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary me-2">← Kembali ke Transaksi</a>
    <a href="#" class="btn btn-primary ms-2" onclick="window.print()">🖨️ Cetak</a>
  </div>
</div>
@endsection
