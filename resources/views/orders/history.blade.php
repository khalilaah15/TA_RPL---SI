<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Riwayat Pesanan') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Lacak dan kelola semua pesanan Anda di satu tempat</p>
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
        
        .filter-tab:hover {
            border-color: #6366f1;
            color: #6366f1;
        }
        
        .filter-tab.active {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-color: transparent;
            color: white;
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
        }
        
        .order-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
            background: #f9fafb;
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
            color: #1f2937;
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
        
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-paid { background: #dbeafe; color: #1e40af; }
        .status-processing { background: #f3e8ff; color: #7c3aed; }
        .status-shipped { background: #dcfce7; color: #166534; }
        .status-completed { background: #f0f9ff; color: #0369a1; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }
        
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
            color: #ea580c;
            text-align: right;
        }
        
        /* Order Summary */
        .order-summary {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
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
            color: #1f2937;
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
        }
        
        .invoice-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
        }
        
        .invoice-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        .complete-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border: none;
        }
        
        .complete-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .detail-btn {
            background: white;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        
        .detail-btn:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }
        
        /* Tracking Progress */
        .tracking-container {
            margin-top: 24px;
            padding: 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
        }
        
        .tracking-title {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
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
        
        .step.active .step-icon {
            border-color: #10b981;
            background: #10b981;
            color: white;
        }
        
        .step.active .step-text {
            color: #10b981;
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
            background: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: #9ca3af;
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
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
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
            from { opacity: 0; }
            to { opacity: 1; }
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
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Sedang Diproses</h3>
                    <div class="value">{{ $transactions->whereIn('status', ['pending', 'paid', 'processing', 'shipped'])->count() }}</div>
                </div>
            </div>
            
            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f3e8ff 0%, #d8b4fe 100%);">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Total Belanja</h3>
                    <div class="value">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        
        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="filter-tab active" onclick="filterOrders('all')">Semua Pesanan</button>
            <button class="filter-tab" onclick="filterOrders('pending')">Menunggu Pembayaran</button>
            <button class="filter-tab" onclick="filterOrders('paid')">Pembayaran Diterima</button>
            <button class="filter-tab" onclick="filterOrders('processing')">Diproses</button>
            <button class="filter-tab" onclick="filterOrders('shipped')">Dikirim</button>
            <button class="filter-tab" onclick="filterOrders('completed')">Selesai</button>
        </div>
        
        @if($transactions->isEmpty())
        <!-- Empty State -->
        <div class="empty-state fade-in">
            <div class="empty-icon">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-700 mb-3">Belum ada pesanan</h3>
            <p class="text-gray-500 mb-6">Mulai belanja dan lihat riwayat pesanan Anda di sini</p>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Mulai Belanja
            </a>
        </div>
        @else
        <!-- Order Cards -->
        <div id="ordersContainer">
            @foreach($transactions as $trx)
            <div class="order-card fade-in" data-status="{{ $trx->status }}" data-id="{{ $trx->id }}">
                <!-- Order Header -->
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Menunggu Pembayaran
                                    @break
                                @case('paid')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Pembayaran Diterima
                                    @break
                                @case('processing')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Diproses
                                    @break
                                @case('shipped')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Dalam Pengiriman
                                    @break
                                @case('completed')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Selesai
                                    @break
                            @endswitch
                        </span>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Total Belanja</div>
                        <div class="text-xl font-bold text-orange-600">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</div>
                    </div>
                </div>
                
                <!-- Order Body -->
                <div class="order-body">
                    <!-- Order Items -->
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
                    
                    <!-- Shipping Information -->
                    <div class="shipping-info">
                        <div class="info-row">
                            <div class="info-label">Penerima</div>
                            <div class="info-value">{{ $trx->receiver_name }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Telepon</div>
                            <div class="info-value">{{ $trx->phone }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Alamat</div>
                            <div class="info-value">{{ Str::limit($trx->address, 100) }}</div>
                        </div>
                        @if($trx->note)
                        <div class="info-row">
                            <div class="info-label">Catatan</div>
                            <div class="info-value">{{ $trx->note }}</div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Tracking Progress -->
                    <div class="tracking-container">
                        <h4 class="tracking-title">Status Pengiriman</h4>
                        <div class="tracking-steps">
                            @php
                                $steps = [
                                    ['status' => 'pending', 'label' => 'Menunggu Pembayaran', 'icon' => '🕒'],
                                    ['status' => 'paid', 'label' => 'Pembayaran Diterima', 'icon' => '✓'],
                                    ['status' => 'processing', 'label' => 'Pesanan Diproses', 'icon' => '⚙️'],
                                    ['status' => 'shipped', 'label' => 'Dalam Pengiriman', 'icon' => '🚚'],
                                    ['status' => 'completed', 'label' => 'Pesanan Selesai', 'icon' => '🎉'],
                                ];
                                
                                $statusOrder = ['pending', 'paid', 'processing', 'shipped', 'completed'];
                                $currentIndex = array_search($trx->status, $statusOrder);
                            @endphp
                            
                            @foreach($steps as $index => $step)
                            <div class="tracking-step step {{ $index <= $currentIndex ? 'active' : '' }}">
                                <div class="step-icon">{{ $step['icon'] }}</div>
                                <div class="step-text">{{ $step['label'] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="order-summary">
                        <div class="summary-row">
                            <span>Subtotal Produk</span>
                            <span>Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Ongkos Kirim</span>
                            <span class="text-green-600 font-semibold">Gratis</span>
                        </div>
                        <div class="summary-row">
                            <span>Biaya Layanan</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total Pembayaran</span>
                            <span class="text-orange-600">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Order Actions -->
                <div class="order-actions">
                    <a href="{{ route('order.invoice', $trx->id) }}" 
                       class="action-btn invoice-btn" 
                       target="_blank">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Invoice
                    </a>
                    
                    <button type="button" 
                            class="action-btn detail-btn"
                            onclick="showOrderDetail('{{ $trx->id }}')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Detail Pesanan
                    </button>
                    
                    @if($trx->status == 'shipped')
                    <form action="{{ route('order.complete', $trx->id) }}" method="POST" class="complete-form">
                        @csrf @method('PUT')
                        <button type="submit" class="action-btn complete-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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
        
        <!-- Order Detail Modal -->
        <div class="modal" id="orderDetailModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Detail Pesanan</h3>
                    <button class="modal-close" onclick="closeModal()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="modal-body" id="orderDetailContent">
                    <!-- Content will be loaded via AJAX -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Filter orders by status
        function filterOrders(status) {
            const orders = document.querySelectorAll('.order-card');
            const tabs = document.querySelectorAll('.filter-tab');
            
            // Update active tab
            tabs.forEach(tab => {
                if (tab.textContent.toLowerCase().includes(status) || (status === 'all' && tab.textContent.includes('Semua'))) {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });
            
            // Show/hide orders
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
        
        // Search orders
        document.getElementById('searchOrders').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const orders = document.querySelectorAll('.order-card');
            
            orders.forEach(order => {
                const orderId = order.querySelector('.order-id').textContent.toLowerCase();
                const items = order.querySelectorAll('.item-info h4');
                let hasMatch = orderId.includes(searchTerm);
                
                // Check product names
                items.forEach(item => {
                    if (item.textContent.toLowerCase().includes(searchTerm)) {
                        hasMatch = true;
                    }
                });
                
                // Check receiver name
                const receiverInfo = order.querySelector('.info-value');
                if (receiverInfo && receiverInfo.textContent.toLowerCase().includes(searchTerm)) {
                    hasMatch = true;
                }
                
                if (hasMatch || searchTerm === '') {
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
        });
        
        // Show order detail modal
        async function showOrderDetail(orderId) {
            const modal = document.getElementById('orderDetailModal');
            const content = document.getElementById('orderDetailContent');
            
            // Show loading
            content.innerHTML = `
                <div class="text-center py-8">
                    <svg class="w-8 h-8 animate-spin mx-auto text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <p class="mt-2 text-gray-500">Memuat detail pesanan...</p>
                </div>
            `;
            
            modal.classList.add('active');
            
            try {
                // Fetch order details (you might need to create a new route for this)
                const response = await fetch(`/order/${orderId}/detail`);
                if (response.ok) {
                    const data = await response.json();
                    content.innerHTML = renderOrderDetail(data);
                } else {
                    content.innerHTML = `
                        <div class="text-center py-8">
                            <p class="text-red-500">Gagal memuat detail pesanan.</p>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error:', error);
                content.innerHTML = `
                    <div class="text-center py-8">
                        <p class="text-red-500">Terjadi kesalahan.</p>
                    </div>
                `;
            }
        }
        
        // Render order detail HTML
        function renderOrderDetail(data) {
            return `
                <div class="space-y-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-700 mb-2">Informasi Pesanan</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-sm text-gray-500">ID Pesanan</p>
                                <p class="font-medium">#${data.order_code || data.id}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Pesan</p>
                                <p class="font-medium">${new Date(data.created_at).toLocaleDateString('id-ID', { 
                                    day: 'numeric', 
                                    month: 'long', 
                                    year: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit'
                                })}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium 
                                    ${data.status === 'completed' ? 'bg-green-100 text-green-800' : 
                                      data.status === 'shipped' ? 'bg-blue-100 text-blue-800' :
                                      data.status === 'processing' ? 'bg-purple-100 text-purple-800' :
                                      data.status === 'paid' ? 'bg-blue-100 text-blue-800' :
                                      'bg-yellow-100 text-yellow-800'}">
                                    ${data.status === 'pending' ? 'Menunggu Pembayaran' :
                                      data.status === 'paid' ? 'Pembayaran Diterima' :
                                      data.status === 'processing' ? 'Diproses' :
                                      data.status === 'shipped' ? 'Dalam Pengiriman' :
                                      'Selesai'}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total</p>
                                <p class="font-medium text-orange-600">Rp ${data.total_amount.toLocaleString('id-ID')}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-3">Item Pesanan</h4>
                        <div class="space-y-3">
                            ${data.items.map(item => `
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <img src="${item.product_image}" alt="${item.product_name}" 
                                             class="w-12 h-12 rounded-lg object-cover">
                                        <div>
                                            <p class="font-medium">${item.product_name}</p>
                                            <p class="text-sm text-gray-500">${item.quantity} x Rp ${item.price.toLocaleString('id-ID')}</p>
                                        </div>
                                    </div>
                                    <p class="font-semibold">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</p>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-3">Informasi Pengiriman</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="font-medium">${data.receiver_name}</p>
                            <p class="text-gray-600">${data.phone}</p>
                            <p class="text-gray-600 mt-2">${data.address}</p>
                            ${data.note ? `<p class="text-gray-600 mt-2"><span class="font-medium">Catatan:</span> ${data.note}</p>` : ''}
                        </div>
                    </div>
                    
                    ${data.payment_proof ? `
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-3">Bukti Pembayaran</h4>
                        <div class="text-center">
                            <img src="${data.payment_proof}" alt="Bukti Pembayaran" 
                                 class="max-w-full h-auto rounded-lg mx-auto max-h-64">
                            <a href="${data.payment_proof}" target="_blank" 
                               class="inline-block mt-2 text-indigo-600 hover:text-indigo-800 text-sm">
                                Lihat ukuran penuh
                            </a>
                        </div>
                    </div>
                    ` : ''}
                </div>
            `;
        }
        
        // Close modal
        function closeModal() {
            document.getElementById('orderDetailModal').classList.remove('active');
        }
        
        // Close modal when clicking outside
        document.getElementById('orderDetailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Add submit handler for complete forms
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.complete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Konfirmasi pesanan telah diterima?')) {
                        e.preventDefault();
                        return;
                    }
                    
                    // Show loading state
                    const button = this.querySelector('button');
                    const originalText = button.innerHTML;
                    button.innerHTML = `
                        <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span>Memproses...</span>
                    `;
                    button.disabled = true;
                });
            });
            
            // Add animation on load
            const cards = document.querySelectorAll('.fade-in');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
        
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
            
            .order-card {
                transition: opacity 0.3s ease, transform 0.3s ease;
            }
        `;
        document.head.appendChild(style);
    </script>
</x-app-layout>