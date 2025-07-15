@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Dashboard Kasir Vape Store</h1>

    {{-- Card Statistik --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <i class="bi bi-box-seam"></i> TOTAL PRODUK
                    <h3 class="mt-2">{{ $jumlahProduk }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <i class="bi bi-people"></i> TOTAL SUPPLIER
                    <h3 class="mt-2">{{ $jumlahSupplier }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <i class="bi bi-receipt"></i> TOTAL TRANSAKSI
                    <h3 class="mt-2">{{ $jumlahTransaksi }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Transaksi --}}
    <div class="card shadow mb-4">
        <div class="card-header">Grafik Transaksi per Bulan</div>
        <div class="card-body">
            <canvas id="transaksiChart"></canvas>
        </div>
    </div>

    {{-- Transaksi Terbaru --}}
    <div class="card shadow mb-4">
        <div class="card-header">5 Transaksi Terbaru</div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Metode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksiTerbaru as $trx)
                        <tr>
                            <td>{{ $trx->transaction_code }}</td>
                            <td>{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d-m-Y') }}</td>
                            <td>Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                            <td>{{ $trx->payment_method }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('transaksiChart').getContext('2d');
    const transaksiChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($transaksiPerBulan->pluck('bulan')) !!},
            datasets: [{
                label: 'Jumlah Transaksi',
                data: {!! json_encode($transaksiPerBulan->pluck('total')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
