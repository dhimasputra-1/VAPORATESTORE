<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Bulanan</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #444; padding: 8px; text-align: center; }
        .header { text-align: center; margin-bottom: 10px; }
        .info { margin-top: 5px; font-size: 13px; text-align: center; }
        .no-print { margin-top: 20px; text-align: center; }
        @media print { .no-print { display: none; } }
        .btn {
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #333;
            border-radius: 4px;
            margin: 5px;
            display: inline-block;
        }
        .btn-success { background-color: #28a745; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
    </style>
</head>
<body>

<div class="header">
    <h2>VAPORATESTORE</h2>
    <h3>Laporan Penjualan Bulanan</h3>
</div>

<div class="info">
    Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
</div>

<table>
    <thead style="background:#e2e3e5;">
        <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @php $grandTotal = 0; @endphp
        @foreach($transaksi as $key => $item)
        @php $grandTotal += $item->total_harga; @endphp
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ \Carbon\Carbon::create($item->tahun, $item->bulan)->format('F Y') }}</td>
            <td style="text-align: right;">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr style="background:#f8f9fa; font-weight:bold;">
            <td colspan="2">Total Keseluruhan</td>
            <td style="text-align: right;">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>

<div class="no-print">
    <a href="#" onclick="window.print()" class="btn btn-success">Cetak</a>
    <a href="{{ route('laporan.bulanan') }}" class="btn btn-secondary">Kembali</a>
</div>

</body>
</html>
