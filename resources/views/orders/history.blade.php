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
                    {{ __('Riwayat Pesanan') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <style>
        /* Main Container */
        .history-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
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
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            padding-bottom: 16px;
            border-bottom: 2px solid #e5e7eb;
        }

        .filter-tab {
            padding: 10px 20px;
            border-radius: 50px;
            background: white;
            border: 2px solid #e5e7eb;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        /* UBAH: Hover jadi Merah */
        .filter-tab:hover {
            border-color: #ef4444;
            color: #ef4444;
        }

        /* UBAH: Aktif jadi Gradient Merah */
        .filter-tab.active {
            background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Order Cards */
        .order-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 24px;
            overflow: hidden;
            transition: transform 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .order-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            border-color: #fecaca;
            /* Border merah muda saat hover */
        }

        .order-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
            background: #fff1f2;
            /* Background header agak kemerahan */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .order-id {
            font-size: 18px;
            font-weight: 700;
            color: #991b1b;
            /* Merah gelap */
        }

        .order-date {
            color: #6b7280;
            font-size: 14px;
        }

        .order-status {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Status Colors - Keep logic but adjust where needed */
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-paid {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-processing {
            background: #ffedd5;
            color: #c2410c;
        }

        .status-shipped {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Shipped jadi nuansa merah/pink */
        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-cancelled {
            background: #f3f4f6;
            color: #374151;
        }

        /* Order Body */
        .order-body {
            padding: 24px;
        }

        .order-items {
            margin-bottom: 24px;
        }

        .order-item {
            display: grid;
            grid-template-columns: 60px 1fr auto;
            gap: 16px;
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
        }

        .item-info h4 {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .item-quantity {
            color: #6b7280;
            font-size: 13px;
        }

        .item-price {
            font-weight: 600;
            color: #ef4444;
            /* Harga item merah */
            text-align: right;
        }

        /* Order Summary */
        .order-summary {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #f3f4f6;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            color: #4b5563;
        }

        .summary-row.total {
            border-top: 2px solid #e5e7eb;
            padding-top: 16px;
            margin-top: 16px;
            font-size: 18px;
            font-weight: 700;
            color: #b91c1c;
            /* Total merah gelap */
        }

        /* Order Actions */
        .order-actions {
            padding: 20px 24px;
            border-top: 1px solid #f3f4f6;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
            cursor: pointer;
        }

        /* UBAH: Tombol Invoice jadi Merah */
        .invoice-btn {
            background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
            color: white;
            border: none;
        }

        .invoice-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Tombol Complete tetap hijau agar intuitif sebagai tombol "Sukses" */
        .complete-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
        }

        .complete-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* Tracking Progress */
        .tracking-container {
            margin-top: 24px;
            padding: 20px;
            background: linear-gradient(135deg, #fff1f2 0%, #fff 100%);
            border-radius: 12px;
            border: 1px solid #ffe4e6;
        }

        .tracking-title {
            font-size: 16px;
            font-weight: 700;
            color: #991b1b;
            margin-bottom: 16px;
        }

        .tracking-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            padding: 0 20px;
        }

        .tracking-steps::before {
            content: '';
            position: absolute;
            top: 12px;
            left: 40px;
            right: 40px;
            height: 3px;
            background: #e5e7eb;
            z-index: 1;
        }

        .tracking-step {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }

        .step-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e5e7eb;
            margin: 0 auto 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #9ca3af;
        }

        .step-text {
            font-size: 12px;
            color: #6b7280;
        }

        /* UBAH: Tracking aktif jadi Merah */
        .step.active .step-icon {
            border-color: #ef4444;
            background: #ef4444;
            color: white;
        }

        .step.active .step-text {
            color: #ef4444;
            font-weight: 600;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: #fee2e2;
            /* Merah muda */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: #ef4444;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-close {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
        }

        .modal-close:hover {
            background: #f3f4f6;
        }

        /* Shipping Info */
        .shipping-info {
            background: #fff1f2;
            /* Merah sangat muda */
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #ffe4e6;
        }

        .info-row {
            display: flex;
            margin-bottom: 12px;
        }

        .info-label {
            min-width: 120px;
            color: #6b7280;
            font-size: 14px;
        }

        .info-value {
            flex: 1;
            color: #1f2937;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .history-container {
                padding: 16px;
            }

            .order-header {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .order-item {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .item-price {
                text-align: left;
            }

            .tracking-steps {
                flex-direction: column;
                gap: 20px;
            }

            .tracking-steps::before {
                top: 0;
                bottom: 0;
                left: 12px;
                right: auto;
                width: 3px;
                height: auto;
            }

            .tracking-step {
                display: flex;
                align-items: center;
                gap: 12px;
                text-align: left;
            }

            .step-icon {
                margin: 0;
                flex-shrink: 0;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>

    <div class="history-container">
        <div class="stats-grid">
            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Total Pesanan</h3>
                    <div class="value">{{ $transactions->count() }}</div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: linear-gradient(135deg, #dcfce7 0%, #86efac 100%);">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Pesanan Selesai</h3>
                    <div class="value">{{ $transactions->where('status', 'completed')->count() }}</div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Sedang Diproses</h3>
                    <div class="value">{{ $transactions->whereIn('status', ['pending', 'paid', 'processing', 'shipped'])->count() }}</div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ffe4e6 0%, #fda4af 100%);">
                    <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Total Belanja</h3>
                    <div class="value text-rose-700">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <div class="filter-tabs">
            <button class="filter-tab active" onclick="filterOrders('all')">Semua Pesanan</button>
            <button class="filter-tab" onclick="filterOrders('pending')">Menunggu Pembayaran</button>
            <button class="filter-tab" onclick="filterOrders('paid')">Pembayaran Diterima</button>
            <button class="filter-tab" onclick="filterOrders('processing')">Diproses</button>
            <button class="filter-tab" onclick="filterOrders('shipped')">Dikirim</button>
            <button class="filter-tab" onclick="filterOrders('completed')">Selesai</button>
        </div>

        @if($transactions->isEmpty())
        <div class="empty-state fade-in">
            <div class="empty-icon">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-700 mb-3">Belum ada pesanan</h3>
            <p class="text-gray-500 mb-6">Mulai belanja dan lihat riwayat pesanan Anda di sini</p>
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-2 bg-red-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-red-700 transition-colors shadow-lg shadow-red-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Mulai Belanja
            </a>
        </div>
        @else
        <div id="ordersContainer">
            @foreach($transactions as $trx)
            <div class="order-card fade-in" data-status="{{ $trx->status }}" data-id="{{ $trx->id }}">
                <div class="order-header">
                    <div class="order-info">
                        <div>
                            <div class="order-id">#{{ $trx->order_code ?? $trx->id }}</div>
                            <div class="order-date">{{ $trx->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <span class="order-status status-{{ $trx->status }}">
                            @switch($trx->status)
                            @case('pending')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Menunggu Pembayaran
                            @break
                            @case('paid')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pembayaran Diterima
                            @break
                            @case('processing')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Diproses
                            @break
                            @case('shipped')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Dalam Pengiriman
                            @break
                            @case('completed')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Selesai
                            @break
                            @endswitch
                        </span>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Total Belanja</div>
                        <div class="text-xl font-bold text-red-600">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="order-body">
                    <div class="order-items">
                        @foreach($trx->details as $item)
                        <div class="order-item">
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                alt="{{ $item->product->name }}"
                                class="item-image">
                            <div class="item-info">
                                <h4>{{ $item->product->name }}</h4>
                                <div class="item-quantity">x {{ $item->quantity }} pcs</div>
                            </div>
                            <div class="item-price">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                        </div>
                        @endforeach
                    </div>

                    <div class="shipping-info">
                        <div class="info-row">
                            <div class="info-label">Penerima</div>
                            <div class="info-value">{{ $trx->receiver_name }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Alamat</div>
                            <div class="info-value">{{ Str::limit($trx->address, 100) }}</div>
                        </div>
                    </div>

                    <div class="tracking-container">
                        <h4 class="tracking-title">Status Pengiriman</h4>
                        <div class="tracking-steps">
                            @php
                            $steps = [
                            ['status' => 'pending', 'label' => 'Menunggu', 'icon' => '🕒'],
                            ['status' => 'paid', 'label' => 'Dibayar', 'icon' => '✓'],
                            ['status' => 'processing', 'label' => 'Diproses', 'icon' => '⚙️'],
                            ['status' => 'shipped', 'label' => 'Dikirim', 'icon' => '🚚'],
                            ['status' => 'completed', 'label' => 'Selesai', 'icon' => '🎉'],
                            ];

                            $statusOrder = ['pending', 'paid', 'processing', 'shipped', 'completed'];
                            $currentIndex = array_search($trx->status, $statusOrder);
                            if($trx->status == 'cancelled') $currentIndex = -1;
                            @endphp

                            @foreach($steps as $index => $step)
                            <div class="tracking-step step {{ $index <= $currentIndex ? 'active' : '' }}">
                                <div class="step-icon">{{ $step['icon'] }}</div>
                                <div class="step-text">{{ $step['label'] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="order-actions">
                    <a href="{{ route('order.invoice', $trx->id) }}"
                        class="action-btn invoice-btn"
                        target="_blank">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Download Invoice
                    </a>

                    @if($trx->status == 'shipped')
                    <form action="{{ route('order.complete', $trx->id) }}" method="POST" class="complete-form">
                        @csrf @method('PUT')
                        <button type="submit" class="action-btn complete-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Konfirmasi Diterima
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>

    <div class="modal" id="orderDetailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Detail Pesanan</h3>
                <button class="modal-close" onclick="closeModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="orderDetailContent"></div>
        </div>
    </div>

    <script>
        // ... (Javascript logic same as provided, ensuring interactions work)
        function filterOrders(status) {
            const orders = document.querySelectorAll('.order-card');
            const tabs = document.querySelectorAll('.filter-tab');
            tabs.forEach(tab => {
                if (tab.textContent.toLowerCase().includes(status) || (status === 'all' && tab.textContent.includes('Semua'))) {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });
            orders.forEach(order => {
                if (status === 'all' || order.dataset.status === status) {
                    order.style.display = 'block';
                    setTimeout(() => {
                        order.style.opacity = '1';
                        order.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    order.style.opacity = '0';
                    order.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        order.style.display = 'none';
                    }, 300);
                }
            });
        }

        // Close modal
        function closeModal() {
            document.getElementById('orderDetailModal').classList.remove('active');
        }
        document.getElementById('orderDetailModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Animation
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.fade-in');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</x-app-layout>