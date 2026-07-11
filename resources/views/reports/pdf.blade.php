<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Catalog Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color:#222; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #ccc; padding:6px; }
        th { background:#efefef; }
        .header { margin-bottom: 12px; }
        .summary { margin-bottom: 14px; }
        .summary td { border:0; padding:3px 0; }
    </style>
</head>
<body>
<div class="header">
    <h3>Smart Catalog Analytics Report</h3>
    <strong>Detail Transaksi Penjualan</strong>
    <p>Tanggal Cetak: {{ now()->format('d M Y') }}</p>
</div>
<table class="summary">
    <tr><td>Total Transaksi</td><td>: {{ $summary['total_transactions'] }}</td></tr>
    <tr><td>Total Unit Terjual</td><td>: {{ $summary['total_qty'] }}</td></tr>
    <tr><td>Total Revenue</td><td>: Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</td></tr>
</table>
<table>
    <thead>
        <tr>
            <th>Nomor</th>
            <th>Tanggal</th>
            <th>Merchant</th>
            <th>Kode Produk</th>
            <th>Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->transaction_number }}</td>
            <td>{{ $transaction->transaction_date }}</td>
            <td>{{ $transaction->merchant_code }}</td>
            <td>{{ $transaction->product->product_code ?? '-' }}</td>
            <td>{{ $transaction->product->product_name ?? '-' }}</td>
            <td>{{ $transaction->qty }}</td>
            <td>Rp {{ number_format($transaction->price, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
