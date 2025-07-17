@extends('layouts.app')

@section('title', 'Dashboard Pemilik')

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Pemilik</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    {{-- Ringkasan --}}
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card border-primary shadow">
                <div class="card-body text-center">
                    <h5>Penjualan Hari Ini</h5>
                    <h4>Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success shadow">
                <div class="card-body text-center">
                    <h5>Penjualan Bulan Ini</h5>
                    <h4>Rp {{ number_format($penjualanBulanIni, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning shadow">
                <div class="card-body text-center">
                    <h5>Penjualan Tahun Ini</h5>
                    <h4>Rp {{ number_format($penjualanTahunIni, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info shadow">
                <div class="card-body text-center">
                    <h5>Transaksi Hari Ini</h5>
                    <h4>{{ $jumlahTransaksiHariIni }} Transaksi</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Penjualan --}}
    <div class="card mt-4 shadow">
        <div class="card-header">Grafik Penjualan {{ date('Y') }}</div>
        <div class="card-body">
            <canvas id="penjualanChart"></canvas>
        </div>
    </div>

    {{-- Produk Terlaris --}}
    <div class="card mt-4 shadow">
        <div class="card-header">5 Produk Terlaris Bulan Ini</div>
        <div class="card-body p-0">
            <table class="table table-bordered m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produkTerlaris as $key => $produk)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $produk->nama }}</td>
                        <td>{{ $produk->jumlah_terjual }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

   
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('penjualanChart').getContext('2d');
    var penjualanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labelBulan) !!},
            datasets: [{
                label: 'Penjualan (Rp)',
                data: {!! json_encode($dataPenjualan) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
