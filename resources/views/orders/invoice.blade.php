<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $transaction->order_code ?? $transaction->id }} - Pedasan Kunchung</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.4;
            color: #333;
            background: #f5f5f5;
            padding: 15px;
            font-size: 14px;
        }

        /* Invoice Container */
        .invoice-container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            overflow: hidden;
            padding: 0;
        }

        /* Header */
        .invoice-header {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            padding: 20px 25px;
            text-align: center;
            border-bottom: 3px solid #b91c1c;
        }

        .invoice-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
            color: red;
        }

        .invoice-header p {
            font-size: 12px;
            opacity: 0.9;
        }

        .invoice-id {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 15px;
            margin-top: 10px;
            font-weight: 600;
            font-size: 12px;
            color: black;
        }

        /* Info Section */
        .info-section {
            padding: 20px 25px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-card {
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background: #f8fafc;
        }

        .info-card h3 {
            font-size: 14px;
            color: #dc2626;
            margin-bottom: 10px;
            font-weight: 700;
            padding-bottom: 5px;
            border-bottom: 1px solid #fee2e2;
        }

        .info-row {
            display: flex;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .info-label {
            flex: 0 0 100px;
            color: #666;
            font-weight: 500;
        }

        .info-value {
            flex: 1;
            color: #333;
            font-weight: 500;
        }

        .wa-link {
            color: #333;
            text-decoration: none;
            font-weight: 600;
            font-size: 12px;
        }

        /* Products Section */
        .products-section {
            padding: 0 25px 15px;
        }

        .products-section h2 {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 12px;
        }

        .products-table th {
            background: #f1f5f9;
            color: #475569;
            font-weight: 600;
            font-size: 11px;
            padding: 8px 10px;
            text-align: left;
            border: 1px solid #e2e8f0;
        }

        .products-table td {
            padding: 10px;
            border: 1px solid #e2e8f0;
        }

        .product-name {
            font-weight: 600;
            color: #1e293b;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        /* Totals Section */
        .totals-section {
            padding: 0 25px 15px;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .totals-table td {
            padding: 8px 10px;
            border: 1px solid #e2e8f0;
        }

        .totals-table .label {
            background: #f1f5f9;
            font-weight: 600;
            color: #475569;
            width: 60%;
        }

        .grand-total {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        /* Footer */
        .invoice-footer {
            padding: 15px 25px;
            background: #1e293b;
            color: white;
            border-top: 3px solid #dc2626;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 15px;
        }

        .footer-col h4 {
            font-size: 12px;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-weight: 600;
        }

        .footer-col p {
            font-size: 11px;
            color: #94a3b8;
            line-height: 1.5;
        }

        .thank-you {
            text-align: center;
            padding-top: 15px;
            border-top: 1px solid #334155;
        }

        .thank-you h3 {
            font-size: 14px;
            margin-bottom: 5px;
            color: white;
        }

        .thank-you p {
            font-size: 11px;
            color: #cbd5e1;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-paid {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-shipped {
            background: #dbeafe;
            color: #1e40af;
        }

        /* Print & Responsive */
        .print-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #dc2626;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
            font-size: 13px;
            z-index: 1000;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .invoice-container {
                box-shadow: none;
                margin: 0;
                max-width: 100%;
            }

            .print-btn {
                display: none;
            }
        }

        @media (max-width: 600px) {

            .info-grid,
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .invoice-header,
            .info-section,
            .products-section,
            .totals-section,
            .invoice-footer {
                padding: 15px;
            }

            body {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Invoice Container -->
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <h1>INVOICE PEDASAN KUNCHUNG</h1>
            <p style="color: black;">Kontak WhatsApp: +62 813-9313-3583</p>
            <div class="invoice-id">
                NO: #{{ $transaction->order_code ?? str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}
            </div>
        </div>
        <!-- Invoice Container -->
        <div class="invoice-container">
            <!-- Info Section -->
            <div class="info-section">
                <div class="info-grid">
                    <!-- Order Details -->
                    <div class="info-card">
                        <h3>Detail Pesanan</h3>
                        <div class="info-row">
                            <div class="info-label">Tanggal</div>
                            <div class="info-value">{{ $transaction->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <!-- <div class="info-row">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                <span class="status-badge status-{{ $transaction->status }}">
                                    {{ strtoupper($transaction->status) }}
                                </span>
                            </div>
                        </div> -->
                        <div class="info-row">
                            <div class="info-label">Pembayaran</div>
                            <div class="info-value">QRIS Transfer</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Nama</div>
                            <div class="info-value">{{ $transaction->user->name }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Telp</div>
                            <div class="info-value">
                                <a href="https://wa.me/{{ $transaction->phone }}" target="_blank" class="wa-link">
                                    {{ $transaction->phone }}
                                </a>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Alamat</div>
                            <div class="info-value" style="font-size: 12px;">{{ $transaction->address }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="products-section">
                <h2>Detail Produk</h2>
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th class="text-center">Qty</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="product-name">{{ $detail->product->name }}</td>
                            <td class="text-center">{{ $detail->quantity }}</td>
                            <td class="text-right">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Totals Section -->
            <div class="totals-section">
                <table class="totals-table">
                    <tr>
                        <td class="label">Subtotal Produk</td>
                        <td class="text-right">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            <!-- Footer -->
            <!-- <div class="invoice-footer">
                <div class="footer-grid">
                    <div class="footer-col">
                        <h4>Kontak Pedasan Kunchung</h4>
                        <p>WhatsApp: +62 813-9313-3583</p>
                    </div>
                </div>
            </div> -->
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const status = '{{ $transaction->status }}';
                const badge = document.querySelector('.status-badge');

                if (status === 'paid' || status === 'completed') {
                    badge.classList.add('status-paid');
                } else if (status === 'pending') {
                    badge.classList.add('status-pending');
                } else if (status === 'shipped' || status === 'processing') {
                    badge.classList.add('status-shipped');
                }

                if (window.location.search.includes('print=true')) {
                    window.print();
                }
            });
        </script>
</body>

</html>