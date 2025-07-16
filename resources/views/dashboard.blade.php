@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Kasir Vape Store</h1>

    {{-- Card Statistik --}}
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 hover-shadow">
                <div class="card-body d-flex align-items-center">
                    <div class="mr-3">
                        <i class="bi bi-box-seam fs-1 text-primary"></i>
                    </div>
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Produk</div>
                        <h4 class="font-weight-bold">{{ $jumlahProduk }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 hover-shadow">
                <div class="card-body d-flex align-items-center">
                    <div class="mr-3">
                        <i class="bi bi-people fs-1 text-success"></i>
                    </div>
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Supplier</div>
                        <h4 class="font-weight-bold">{{ $jumlahSupplier }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 hover-shadow">
                <div class="card-body d-flex align-items-center">
                    <div class="mr-3">
                        <i class="bi bi-receipt fs-1 text-warning"></i>
                    </div>
                    <div>
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Transaksi</div>
                        <h4 class="font-weight-bold">{{ $jumlahTransaksi }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Transaksi --}}
    <div class="card shadow mb-4">
        <div class="card-header font-weight-bold text-primary">
            Grafik Transaksi per Bulan
        </div>
        <div class="card-body">
            <canvas id="transaksiChart" height="100"></canvas>
        </div>
    </div>

    {{-- Transaksi Terbaru --}}
    <div class="card shadow mb-5">
        <div class="card-header font-weight-bold text-info">
            5 Transaksi Terbaru
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
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
                backgroundColor: 'rgba(78, 115, 223, 0.6)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endsection
