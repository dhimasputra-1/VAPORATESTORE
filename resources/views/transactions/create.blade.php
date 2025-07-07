@extends('layouts.app')

@section('title', 'Buat Transaksi')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Buat Transaksi</h1>
  <form action="{{ route('transactions.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Kode Transaksi</label>
      <input type="text" name="transaction_code" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Total Harga</label>
      <input type="number" name="total_price" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Metode Pembayaran</label>
      <select name="payment_method" class="form-control" required>
        <option value="Cash">Cash</option>
        <option value="QRIS">QRIS</option>
      </select>
    </div>
    <div class="form-group">
      <label>Tanggal</label>
      <input type="date" name="transaction_date" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Proses Transaksi</button>
  </form>
@endsection
