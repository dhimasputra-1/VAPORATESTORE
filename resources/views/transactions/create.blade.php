@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaksi Baru</h2>

    <form method="POST" action="{{ route('transactions.store') }}" id="transactionForm">
        @csrf

        <div class="mb-3">
            <label>Kode Transaksi</label>
            <input type="text" name="transaction_code" class="form-control" value="{{ $code }}" readonly required>
        </div>

        <div class="mb-3">
            <label>Tanggal Transaksi</label>
            <input type="date" name="transaction_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="payment_method" class="form-control" required>
                <option value="">-- Pilih Metode --</option>
                <option value="cash">Tunai</option>
                <option value="transfer">Transfer Bank</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Filter Kategori Produk</label>
            <select class="form-control" id="filterKategori">
                <option value="">-- Semua Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <hr>
        <h5>Produk</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="productRows">
                <tr>
                    <td>
                        <select name="products[]" class="form-control selectProduct" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" 
                                    data-category="{{ $product->category_id }}" 
                                    data-price="{{ $product->price }}">
                                    {{ $product->product_name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="quantities[]" class="form-control qtyInput" min="1" value="1">
                    </td>
                    <td>
                        <span class="productSubtotal">Rp 0</span>
                        <input type="hidden" name="subtotals[]" class="subtotalInput" value="0">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-secondary mb-3" id="addProduct">+ Tambah Produk</button>

        <div class="mb-3">
            <strong>Total Belanja: <span id="totalDisplay">Rp 0</span></strong>
            <input type="hidden" name="total_amount" id="totalAmountInput" value="0">
        </div>

        <button type="submit" class="btn btn-primary">Proses Transaksi</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
function formatRupiah(angka) {
    return 'Rp ' + angka.toLocaleString('id-ID');
}

function updateSubtotal(row) {
    let price = parseInt(row.find('.selectProduct option:selected').data('price')) || 0;
    let qty = parseInt(row.find('.qtyInput').val()) || 0;
    let subtotal = price * qty;
    row.find('.productSubtotal').text(formatRupiah(subtotal));
    row.find('.subtotalInput').val(subtotal);
    updateTotal();
}

function updateTotal() {
    let total = 0;
    $('.subtotalInput').each(function () {
        total += parseInt($(this).val()) || 0;
    });
    $('#totalDisplay').text(formatRupiah(total));
    $('#totalAmountInput').val(total);
}

function bindRowEvents(row) {
    row.find('.qtyInput').on('input', function () {
        updateSubtotal(row);
    });
    row.find('.selectProduct').on('change', function () {
        updateSubtotal(row);
    });
}

$(document).ready(function () {
    bindRowEvents($('#productRows tr:first'));

    $('#addProduct').on('click', function () {
        let newRow = $('#productRows tr:first').clone();
        newRow.find('select').val('');
        newRow.find('.qtyInput').val(1);
        newRow.find('.productSubtotal').text('Rp 0');
        newRow.find('.subtotalInput').val(0);
        newRow.appendTo('#productRows');

        // Apply kategori filter ke produk baru
        let selectedCategory = $('#filterKategori').val();
        newRow.find('.selectProduct option').each(function () {
            let optionCategory = $(this).data('category');
            let optionValue = $(this).val();
            if (!optionValue) return;
            if (!selectedCategory || selectedCategory == optionCategory) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        bindRowEvents(newRow);
    });

    $('#productRows').on('click', '.removeRow', function () {
        if ($('#productRows tr').length > 1) {
            $(this).closest('tr').remove();
            updateTotal();
        } else {
            alert("Minimal 1 produk harus dipilih.");
        }
    });

    $('#filterKategori').on('change', function () {
        let selectedCategory = $(this).val();
        $('#productRows tr').each(function () {
            let select = $(this).find('.selectProduct');
            let selectedValue = select.val(); // simpan produk yang dipilih

            select.find('option').each(function () {
                let optionCategory = $(this).data('category');
                let optionValue = $(this).val();
                if (!optionValue) return;
                if (!selectedCategory || selectedCategory == optionCategory || optionValue == selectedValue) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
});
</script>
@endsection
