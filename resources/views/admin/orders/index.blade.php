<x-app-layout>

    <style>
        header.bg-white {
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%) !important;
            border-bottom: none !important;
        }

        header h2 {
            color: white !important;
        }
    </style>
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Dashboard Pesanan Admin') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <style>
        /* Main Container */
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 24px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        /* UBAH: Border saat aktif jadi Merah */
        .stat-card.active {
            border-color: #ef4444; 
            background-color: #fef2f2; /* Sedikit kemerahan */
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-content h3 {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .stat-content .value {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        .stat-content .trend {
            font-size: 12px;
            margin-top: 4px;
        }

        .trend.up {
            color: #10b981;
        }

        .trend.down {
            color: #ef4444;
        }

        /* Filter Bar */
        .filter-bar {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
            border-left: 4px solid #ef4444; /* Aksen Merah */
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-label {
            font-size: 14px;
            font-weight: 600;
            color: #4b5563;
            white-space: nowrap;
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            min-width: 140px;
            background: white;
        }

        .filter-select:focus {
            border-color: #ef4444;
            outline: none;
            ring: 2px solid #fca5a5;
        }

        /* Orders Table */
        .orders-table {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        /* UBAH: Header Tabel jadi Gradasi Merah */
        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%);
            color: white;
        }

        .table-content {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        .table th {
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            background: #fef2f2; /* Header kolom agak kemerahan dikit */
            border-bottom: 2px solid #fecaca;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table td {
            padding: 20px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: top;
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #fff1f2; /* Hover row jadi pink sangat muda */
        }

        /* Order Info */
        .order-id {
            font-size: 15px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .order-date {
            font-size: 13px;
            color: #6b7280;
        }

        /* Customer Info */
        .customer-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .customer-name {
            font-weight: 600;
            color: #1f2937;
        }

        .customer-contact {
            font-size: 13px;
            color: #6b7280;
        }

        /* Product List */
        .product-list {
            max-width: 250px;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 4px 0;
        }

        .product-image {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
        }

        .product-name {
            font-size: 13px;
            color: #4b5563;
            line-height: 1.3;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-paid { background: #dbeafe; color: #1e40af; }
        .status-processing { background: #fce7f3; color: #9d174d; } /* Pinkish for process */
        .status-shipped { background: #dcfce7; color: #166534; }
        .status-completed { background: #f3f4f6; color: #374151; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }

        /* UBAH: Total Amount jadi Merah Gelap */
        .total-amount {
            font-size: 16px;
            font-weight: 700;
            color: #b91c1c; 
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        /* UBAH: Tombol Detail jadi Merah */
        .detail-btn {
            background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
            color: white;
        }

        .detail-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        /* Status Update Form */
        .status-form {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .status-select {
            padding: 8px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 13px;
            min-width: 120px;
            background: white;
        }
        
        .status-select:focus {
             border-color: #ef4444;
             outline: none;
        }

        .update-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: #fee2e2; /* Background icon kosong merah muda */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: #ef4444;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-container { padding: 16px; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .filter-group { flex-direction: column; align-items: flex-start; }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeIn 0.3s ease-out; }
    </style>

    <div class="admin-container">
        <div class="stats-grid">
            <div class="stat-card fade-in" onclick="filterByStatus('all')">
                <div class="stat-icon" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Total Pesanan</h3>
                    <div class="value">{{ $transactions->count() }}</div>
                    <div class="trend up">+{{ rand(5, 20) }}% dari bulan lalu</div>
                </div>
            </div>

            <div class="stat-card fade-in" onclick="filterByStatus('pending')">
                <div class="stat-icon" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Menunggu Pembayaran</h3>
                    <div class="value">{{ $transactions->where('status', 'pending')->count() }}</div>
                    <div class="trend up">Perlu konfirmasi</div>
                </div>
            </div>

            <div class="stat-card fade-in" onclick="filterByStatus('processing')">
                <div class="stat-icon" style="background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Diproses</h3>
                    <div class="value">{{ $transactions->whereIn('status', ['paid', 'processing'])->count() }}</div>
                    <div class="trend up">Siap dikirim</div>
                </div>
            </div>

            <div class="stat-card fade-in" onclick="filterByStatus('shipped')">
                <div class="stat-icon" style="background: linear-gradient(135deg, #dcfce7 0%, #86efac 100%);">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Selesai Bulan Ini</h3>
                    <div class="value">{{ $transactions->where('status', 'completed')->count() }}</div>
                    <div class="trend up">+{{ rand(10, 30) }}% dari bulan lalu</div>
                </div>
            </div>
        </div>

        <div class="filter-bar fade-in">
            <div class="filter-group">
                <span class="filter-label">Filter Status:</span>
                <select class="filter-select" id="statusFilter">
                    <option value="all">Semua Status</option>
                    <option value="pending">Menunggu Pembayaran</option>
                    <option value="paid">Pembayaran Diterima</option>
                    <option value="processing">Diproses</option>
                    <option value="shipped">Dikirim</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
            </div>
        </div>

        <div class="orders-table fade-in">
            <div class="table-header">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="text-lg font-bold">Daftar Pesanan Masuk</h3>
                    </div>
                    <span class="text-sm opacity-90">{{ $transactions->count() }} pesanan</span>
                </div>
            </div>

            <div class="table-content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Pembeli</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $trx)
                        <tr class="fade-in" data-status="{{ $trx->status }}">
                            <td>
                                <div class="order-id">#{{ $trx->order_code ?? $trx->id }}</div>
                                <div class="order-date">{{ $trx->created_at->format('d M Y, H:i') }}</div>
                            </td>

                            <td>
                                <div class="customer-info">
                                    <div class="customer-name">{{ $trx->user->name }}</div>
                                    <div class="customer-contact">{{ $trx->phone }}</div>
                                    <div class="text-xs text-gray-500">{{ $trx->receiver_name }}</div>
                                </div>
                            </td>

                            <td>
                                <div class="product-list">
                                    @foreach($trx->details as $item)
                                    <div class="product-item">
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}"
                                            class="product-image">
                                        <div>
                                            <div class="product-name">{{ Str::limit($item->product->name, 30) }}</div>
                                            <div class="text-xs text-gray-500">x{{ $item->quantity }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </td>

                            <td>
                                <div class="total-amount">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</div>
                            </td>

                            <td>
                                <span class="status-badge status-{{ $trx->status }}">
                                    @switch($trx->status)
                                    @case('pending')
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    MENUNGGU
                                    @break
                                    @case('paid')
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    DITERIMA
                                    @break
                                    @case('processing')
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    DIPROSES
                                    @break
                                    @case('shipped')
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    DIKIRIM
                                    @break
                                    @case('completed')
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    SELESAI
                                    @break
                                    @case('cancelled')
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    BATAL
                                    @break
                                    @endswitch
                                </span>
                            </td>

                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.orders.show', $trx->id) }}"
                                        class="action-btn detail-btn">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </a>

                                    <form action="{{ route('admin.orders.update', $trx->id) }}" method="POST" class="status-form">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="status-select" onchange="this.form.submit()">
                                            <option value="pending" {{ $trx->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $trx->status == 'paid' ? 'selected' : '' }}>Dibayar</option>
                                            <option value="processing" {{ $trx->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                            <option value="shipped" {{ $trx->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="completed" {{ $trx->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $trx->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if($transactions->isEmpty())
        <div class="empty-state fade-in">
            <div class="empty-icon">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-700 mb-3">Belum ada pesanan</h3>
            <p class="text-gray-500">Tidak ada pesanan masuk saat ini.</p>
        </div>
        @endif
    </div>

    <script>
        // Filter functionality
        function filterByStatus(status) {
            const rows = document.querySelectorAll('tbody tr[data-status]');
            const filterSelect = document.getElementById('statusFilter');

            // Update select
            filterSelect.value = status;

            // Update stats cards
            document.querySelectorAll('.stat-card').forEach(card => {
                card.classList.remove('active');
            });
            
            // Add active class to clicked card based on mapping (simple logic)
            // Note: In a real app you might want to map specific IDs to cards
            
            // Show/hide rows
            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                    setTimeout(() => {
                        row.style.opacity = '1';
                        row.style.transform = 'translateX(0)';
                    }, 10);
                } else {
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-20px)';
                    setTimeout(() => {
                        row.style.display = 'none';
                    }, 300);
                }
            });
        }

        // Status filter select
        document.getElementById('statusFilter').addEventListener('change', function(e) {
            filterByStatus(e.target.value);
        });

        // Auto-submit status forms
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading animation to status update buttons
            document.querySelectorAll('.status-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('.status-select');
                    button.disabled = true;

                    // Show loading indicator
                    const originalHTML = button.innerHTML;
                    // Keep width to prevent jump
                    button.style.width = button.offsetWidth + 'px'; 
                    button.innerHTML = '<option>Loading...</option>';
                });
            });
        });
    </script>
</x-app-layout>