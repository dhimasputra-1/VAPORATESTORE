@extends('layouts.app')

@section('title', 'Pembayaran Transaksi')

@section('content')
<div class="container">
    <h2>Pembayaran Transaksi #{{ $transaction->transaction_code }}</h2>

    <div class="card mb-4">
        <div class="card-body">
            <strong>Tanggal:</strong> {{ $transaction->transaction_date }} <br>
            <strong>Total:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }} <br>
            <strong>Metode:</strong> {{ strtoupper($transaction->payment_method) }} 
        </div>
    </div>

    <h5>Detail Barang</h5>
    <ul class="list-group mb-4">
        @foreach($transaction->details as $detail)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $detail->product->product_name }} x {{ $detail->quantity }}
            <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
        </li>
        @endforeach
    </ul>

    <form action="{{ route('transactions.paymentProcess', $transaction->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Pilihan VA atau E-Wallet --}}
        @if($transaction->payment_method == 'transfer')
        <h5>Pilih Bank Virtual Account</h5>
        @php $banks = ['BCA'=>'014', 'BNI'=>'009', 'BRI'=>'002', 'Mandiri'=>'008', 'CIMB Niaga'=>'022', 'Permata Bank'=>'013']; @endphp
        <select class="form-select mb-3" name="payment_channel" id="payment_channel" required>
            <option value="" selected disabled>-- Pilih Bank --</option>
            @foreach($banks as $bank => $kode)
            <option value="{{ $bank }}" data-code="{{ $kode }}">{{ $bank }}</option>
            @endforeach
        </select>

        @elseif($transaction->payment_method == 'ewallet')
        <h5>Pilih E-Wallet</h5>
        @php $wallets = ['GoPay'=>'89808', 'OVO'=>'80908', 'DANA'=>'852808', 'ShopeePay'=>'89308', 'LinkAja'=>'91108']; @endphp
        <select class="form-select mb-3" name="payment_channel" id="payment_channel" required>
            <option value="" selected disabled>-- Pilih E-Wallet --</option>
            @foreach($wallets as $wallet => $prefix)
            <option value="{{ $wallet }}" data-code="{{ $prefix }}">{{ $wallet }}</option>
            @endforeach
        </select>
        @endif

        {{-- Nomor VA --}}
        <div id="va-result" class="mb-4"></div>

        {{-- QRIS (Simulasi Pembayaran) --}}
        <h5>Pembayaran via QR (Simulasi)</h5>
        <div class="text-center mb-4">
            <img id="qris-image"
                 src="https://api.qrserver.com/v1/create-qr-code/?data=DefaultQR&size=200x200"
                 alt="QRIS"
                 style="max-width:200px; border:1px solid #ccc; padding:5px;">
            <p class="mt-2">Scan QR ini untuk melihat info simulasi pembayaran</p>
        </div>

        {{-- Bukti Transfer --}}
        <div class="mb-3 mt-4">
            <label>Bukti Pembayaran (Opsional, JPG/PNG/PDF)</label>
            <input type="file" name="payment_proof" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Selesaikan Pembayaran</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    const products = [
        @foreach($transaction->details as $detail)
            {
                name: "{{ $detail->product->product_name }}",
                qty: {{ $detail->quantity }},
            },
        @endforeach
    ];

    $('#payment_channel').on('change', function () {
        const selected = $(this).find('option:selected').val();
        const code = $(this).find('option:selected').data('code');
        const transactionId = {{ $transaction->id }};
        const transactionCode = "{{ $transaction->transaction_code }}";
        const total = {{ $transaction->total_price }};
        const method = "{{ strtoupper($transaction->payment_method) }}";
        const random = Math.floor(1000 + Math.random() * 9000);
        const nomorVA = `${code}${transactionId}${random}`;
        const formattedTotal = new Intl.NumberFormat('id-ID').format(total);

        $('#va-result').html(`
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between">
                    Virtual Account ${selected}
                    <span>${nomorVA}</span>
                </li>
            </ul>
        `);

        // Ringkasan Produk
        const produkSummary = products.map(p => `${p.name}x${p.qty}`).join(', ');

        // Isi QR Singkat
        const qrText = `TRX: ${transactionCode} | ${produkSummary} | Total: Rp${formattedTotal} | VA: ${nomorVA}`;

        const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(qrText)}&size=200x200`;
        $('#qris-image').attr('src', qrUrl);
    });
});

</script>
@endpush
