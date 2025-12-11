<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Detail Pesanan #') . ($transaction->order_code ?? $transaction->id) }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola dan monitor pesanan pelanggan</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke Daftar</span>
                </a>
                <a href="{{ route('order.invoice', $transaction->id) }}" target="_blank"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download Invoice
                </a>
            </div>
        </div>
    </x-slot>

    <style>
        /* Detail Container */
        .detail-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }
        
        /* Order Summary Card */
        .order-summary-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 24px;
            margin-bottom: 24px;
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 2px solid #f3f4f6;
        }
        
        .order-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
        }
        
        .info-item h4 {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 4px;
        }
        
        .info-item p {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
        }
        
        .order-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }
        
        /* Products Table */
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
        }
        
        .products-table th {
            background: #f9fafb;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .products-table td {
            padding: 20px 16px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .product-row:hover {
            background: #f9fafb;
        }
        
        .product-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
        }
        
        .product-details h4 {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }
        
        .product-details p {
            font-size: 14px;
            color: #6b7280;
        }
        
        .price-cell {
            font-weight: 600;
            color: #1f2937;
        }
        
        .quantity-cell {
            text-align: center;
            font-weight: 600;
        }
        
        .subtotal-cell {
            font-weight: 700;
            color: #ea580c;
            text-align: right;
        }
        
        /* Totals Section */
        .totals-section {
            margin-top: 32px;
            padding-top: 32px;
            border-top: 2px solid #e5e7eb;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            color: #4b5563;
        }
        
        .grand-total {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            border-top: 2px solid #e5e7eb;
            padding-top: 20px;
            margin-top: 20px;
        }
        
        /* Shipping & Payment Cards */
        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 24px;
            margin-top: 24px;
        }
        
        .info-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 24px;
        }
        
        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f3f4f6;
        }
        
        .info-grid {
            display: grid;
            gap: 16px;
        }
        
        .info-field label {
            display: block;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 6px;
        }
        
        .info-field p {
            font-size: 15px;
            color: #1f2937;
            font-weight: 500;
        }
        
        .wa-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #25D366;
            text-decoration: none;
            font-weight: 600;
        }
        
        .wa-link:hover {
            text-decoration: underline;
        }
        
        /* Payment Proof */
        .payment-proof {
            text-align: center;
            margin-top: 16px;
        }
        
        .proof-image {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .proof-image:hover {
            transform: scale(1.02);
        }
        
        /* Status Update Card */
        .status-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 24px;
            margin-top: 24px;
        }
        
        .status-form {
            display: flex;
            gap: 16px;
            align-items: center;
        }
        
        .status-select {
            flex: 1;
            padding: 12px 16px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            color: #374151;
            background: white;
        }
        
        .status-btn {
            background: white;
            color: #764ba2;
            border: none;
            border-radius: 10px;
            padding: 12px 32px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .status-btn:hover {
            background: #f8fafc;
            transform: translateY(-2px);
        }
        
        /* Note Box */
        .note-box {
            background: #fff8e1;
            border: 2px solid #ffecb3;
            border-radius: 12px;
            padding: 20px;
            margin-top: 16px;
        }
        
        .note-label {
            font-size: 14px;
            color: #ff9800;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .detail-container {
                padding: 16px;
            }
            
            .order-header {
                flex-direction: column;
                gap: 16px;
            }
            
            .info-cards {
                grid-template-columns: 1fr;
            }
            
            .products-table {
                font-size: 14px;
            }
            
            .status-form {
                flex-direction: column;
                align-items: stretch;
            }
        }
        
        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="detail-container">
        <!-- Order Summary -->
        <div class="order-summary-card fade-in">
            <div class="order-header">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Ringkasan Pesanan</h3>
                    <p class="text-sm text-gray-500">Dibuat: {{ $transaction->created_at->format('d F Y, H:i') }}</p>
                </div>
                <span class="order-status status-{{ $transaction->status }}">
                    @switch($transaction->status)
                        @case('pending')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            MENUNGGU PEMBAYARAN
                            @break
                        @case('paid')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            PEMBAYARAN DITERIMA
                            @break
                        @case('processing')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            SEDANG DIPROSES
                            @break
                        @case('shipped')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            DALAM PENGIRIMAN
                            @break
                        @case('completed')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            SELESAI
                            @break
                        @case('cancelled')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            DIBATALKAN
                            @break
                    @endswitch
                </span>
            </div>
            
            <div class="order-info">
                <div class="info-item">
                    <h4>ID Pesanan</h4>
                    <p>#{{ $transaction->order_code ?? $transaction->id }}</p>
                </div>
                <div class="info-item">
                    <h4>Pelanggan</h4>
                    <p>{{ $transaction->user->name }}</p>
                </div>
                <div class="info-item">
                    <h4>Total Item</h4>
                    <p>{{ $transaction->details->sum('quantity') }} produk</p>
                </div>
                <div class="info-item">
                    <h4>Total Pembayaran</h4>
                    <p class="text-orange-600 font-bold">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        
        <!-- Products Table -->
        <div class="order-summary-card fade-in">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Rincian Produk</h3>
            
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Kuantitas</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->details as $detail)
                    <tr class="product-row">
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('storage/' . $detail->product->image) }}" 
                                     alt="{{ $detail->product->name }}"
                                     class="product-image">
                                <div class="product-details">
                                    <h4>{{ $detail->product->name }}</h4>
                                    <p>SKU: {{ $detail->product->sku ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="price-cell">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                        <td class="quantity-cell">{{ $detail->quantity }}</td>
                        <td class="subtotal-cell">Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="totals-section">
                <div class="total-row">
                    <span>Subtotal Produk</span>
                    <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="total-row">
                    <span>Ongkos Kirim</span>
                    <span class="text-green-600 font-semibold">Gratis</span>
                </div>
                <div class="total-row">
                    <span>Biaya Layanan</span>
                    <span>Rp 0</span>
                </div>
                <div class="grand-total">
                    <span>Total Pembayaran</span>
                    <span class="text-orange-600">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Information Cards -->
        <div class="info-cards fade-in">
            <!-- Shipping Information -->
            <div class="info-card">
                <h3 class="card-title">Informasi Pengiriman</h3>
                <div class="info-grid">
                    <div class="info-field">
                        <label>Nama Penerima</label>
                        <p>{{ $transaction->receiver_name }}</p>
                    </div>
                    <div class="info-field">
                        <label>Reseller / Pembeli</label>
                        <p>{{ $transaction->user->name }}</p>
                    </div>
                    <div class="info-field">
                        <label>Nomor Telepon</label>
                        <p>
                            <a href="https://wa.me/{{ $transaction->phone }}" 
                               target="_blank" 
                               class="wa-link">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                </svg>
                                {{ $transaction->phone }}
                            </a>
                        </p>
                    </div>
                    <div class="info-field">
                        <label>Alamat Lengkap</label>
                        <p class="leading-relaxed">{{ $transaction->address }}</p>
                    </div>
                </div>
                
                @if($transaction->note)
                <div class="note-box">
                    <div class="note-label">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Catatan Pemesan
                    </div>
                    <p class="text-gray-700 italic">"{{ $transaction->note }}"</p>
                </div>
                @endif
            </div>
            
            <!-- Payment Information -->
            <div class="info-card">
                <h3 class="card-title">Informasi Pembayaran</h3>
                <div class="info-grid">
                    <div class="info-field">
                        <label>Metode Pembayaran</label>
                        <p>QRIS Transfer</p>
                    </div>
                    <div class="info-field">
                        <label>Nama Rekening</label>
                        <p>Pedasan Kunchung</p>
                    </div>
                    <div class="info-field">
                        <label>Status Pembayaran</label>
                        <p>
                            @if($transaction->status == 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                    Menunggu Konfirmasi
                                </span>
                            @elseif(in_array($transaction->status, ['paid', 'processing', 'shipped', 'completed']))
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    Sudah Dibayar
                                </span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                                    Dibatalkan
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
                
                <div class="payment-proof">
                    @if($transaction->payment_proof)
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Bukti Transfer</h4>
                        <a href="{{ asset('storage/' . $transaction->payment_proof) }}" target="_blank">
                            <img src="{{ asset('storage/' . $transaction->payment_proof) }}" 
                                 alt="Bukti Transfer" 
                                 class="proof-image">
                        </a>
                        <p class="text-xs text-gray-500 mt-2">Klik gambar untuk memperbesar</p>
                    @else
                        <div class="text-center py-8 bg-red-50 rounded-lg">
                            <svg class="w-12 h-12 text-red-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-red-600 font-semibold">Belum ada bukti pembayaran</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Status Update -->
        <div class="status-card fade-in">
            <h3 class="text-white text-lg font-bold mb-4">Update Status Pesanan</h3>
            <form action="{{ route('admin.orders.update', $transaction->id) }}" method="POST" class="status-form">
                @csrf
                @method('PUT')
                <select name="status" class="status-select">
                    <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu Pembayaran)</option>
                    <option value="paid" {{ $transaction->status == 'paid' ? 'selected' : '' }}>Paid (Pembayaran Diterima)</option>
                    <option value="processing" {{ $transaction->status == 'processing' ? 'selected' : '' }}>Processing (Sedang Diproses)</option>
                    <option value="shipped" {{ $transaction->status == 'shipped' ? 'selected' : '' }}>Shipped (Dalam Pengiriman)</option>
                    <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                    <option value="cancelled" {{ $transaction->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                </select>
                <button type="submit" class="status-btn">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

    <script>
        // Add form submission loading
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.status-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('.status-btn');
                    const originalText = button.textContent;
                    
                    button.innerHTML = `
                        <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Memproses...
                    `;
                    button.disabled = true;
                });
            }
            
            // Add spin animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes spin {
                    from { transform: rotate(0deg); }
                    to { transform: rotate(360deg); }
                }
                
                .animate-spin {
                    animation: spin 1s linear infinite;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</x-app-layout>