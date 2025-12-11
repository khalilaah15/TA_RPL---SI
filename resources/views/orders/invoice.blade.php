<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $transaction->id }}</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        .total { font-weight: bold; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>INVOICE PEMBELIAN</h2>
        <p>UMKM Camilan Enak</p>
    </div>

    <div class="details">
        <p><strong>No. Order:</strong> #{{ $transaction->id }}</p>
        <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Pemesan:</strong> {{ $transaction->user->name }}</p>
        <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
    </div>

    <table>
        <thead>
            <tr style="background-color: #ddd;">
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>Rp {{ number_format($detail->price) }}</td>
                <td>Rp {{ number_format($detail->quantity * $detail->price) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="total">TOTAL BAYAR</td>
                <td class="total">Rp {{ number_format($transaction->total_amount) }}</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: center; font-size: 12px; color: #555;">
        <p>Terima kasih sudah berbelanja di UMKM kami!</p>
        <p>Simpan bukti ini sebagai syarat pengambilan barang.</p>
    </div>
</body>
</html>