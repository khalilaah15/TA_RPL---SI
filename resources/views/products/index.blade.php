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
                <h2 class="font-bold text-2xl leading-tight">
                    {{ __('Manajemen Produk Camilan') }}
                </h2>
            </div>

            <a href="{{ route('products.create') }}" class="admin-primary-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Tambah Produk Baru</span>
            </a>
        </div>
    </x-slot>

    <style>
        /* Style Tombol Orange */
        .admin-primary-btn {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            /* Orange */
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid #f59e0b;
        }

        .admin-primary-btn:hover {
            background: linear-gradient(135deg, #ea580c 0%, #f97316 100%);
            /* Orange Gelap saat Hover */
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(249, 115, 22, 0.6);
        }

        /* Jika mau lebih kontras, gunakan warna solid merah gelap */
        .admin-solid-btn {
            background-color: #b91c1c;
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(185, 28, 28, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .admin-solid-btn:hover {
            background-color: #991b1b;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(185, 28, 28, 0.4);
        }

        /* Main Container */
        .products-container {
            max-width: 1400px;
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
            padding: 20px;
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

        /* stat icon backgrounds use soft red tints */
        .stat-icon[data-variant="blue"] {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        }

        .stat-icon[data-variant="green"] {
            background: linear-gradient(135deg, #fff1f2 0%, #ffd6d6 100%);
        }

        .stat-icon[data-variant="yellow"] {
            background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%);
        }

        .stat-icon[data-variant="red"] {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
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

        /* Filter Bar */
        .filter-bar {
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%);
            border-radius: 16px;
            padding: 20px;
            color: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
        }

        .filter-bar .filter-label {
            color: white;
        }

        .filter-bar .filter-select {
            color: #374151;
            background-color: white;
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

        /* Search input with red-tinted icon */
        .search-input {
            padding: 10px 16px 10px 40px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            width: 300px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23ef4444'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/%3E%3C/svg%3E");
            background-position: 12px center;
            background-repeat: no-repeat;
            background-size: 20px;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        /* Product Card */
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        /* Product Image */
        .product-image-container {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%);
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .stock-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
        }

        .low-stock {
            background: linear-gradient(90deg, #f97316 0%, #ef4444 100%);
        }

        .out-of-stock {
            background: linear-gradient(90deg, #ef4444 0%, #b91c1c 100%);
        }

        .in-stock {
            background: linear-gradient(90deg, #fb7185 0%, #ef4444 100%);
        }

        /* Product Content */
        .product-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-header {
            margin-bottom: 16px;
        }

        .product-name {
            font-size: 18px;
            font-weight: 700;
            color: #7f1d1d;
            /* dark red title */
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .product-description {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Product Details */
        .product-details {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid #f3f4f6;
        }

        .price-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .product-price {
            font-size: 22px;
            font-weight: 800;
            color: #b91c1c;
            /* strong red price */
        }

        .stock-section {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }

        .stock-label {
            font-size: 14px;
            color: #6b7280;
        }

        .stock-value {
            font-size: 16px;
            font-weight: 700;
            color: #7f1d1d;
        }

        /* Stock Progress Bar */
        .stock-progress {
            height: 6px;
            background: #ffecee;
            border-radius: 3px;
            overflow: hidden;
            margin-top: 8px;
        }

        .stock-progress-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .progress-high {
            background: linear-gradient(90deg, #ef4444 0%, #b91c1c 100%);
        }

        .progress-medium {
            background: linear-gradient(90deg, #fb923c 0%, #ef4444 100%);
        }

        .progress-low {
            background: linear-gradient(90deg, #f97316 0%, #fb7185 100%);
        }

        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 16px;
        }

        .action-btn {
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .edit-btn {
            background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%);
            color: #7f1d1d;
            border: 1px solid #fca5a5;
        }

        .edit-btn:hover {
            background: linear-gradient(135deg, #ffe4e6 0%, #ffccd5 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(185, 28, 28, 0.12);
        }

        .delete-btn {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border: 1px solid #f87171;
        }

        .delete-btn:hover {
            background: linear-gradient(135deg, #fecaca 0%, #ffb4b4 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(185, 28, 28, 0.12);
        }

        /* Quick Actions */
        .quick-actions {
            position: absolute;
            top: 12px;
            left: 12px;
            display: flex;
            gap: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .quick-actions {
            opacity: 1;
        }

        .quick-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .quick-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .view-btn {
            color: #dc2626;
        }

        .duplicate-btn {
            color: #b91c1c;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            grid-column: 1 / -1;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: #fff1f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: #fca5a5;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(17, 24, 39, 0.6);
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
            animation: slideUp 0.3s ease;
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 24px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .products-container {
                padding: 16px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 16px;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-input {
                width: 100%;
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

    <div class="products-container">
        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Total Produk</h3>
                    <div class="value">{{ $products->count() }}</div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: linear-gradient(135deg, #dcfce7 0%, #86efac 100%);">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Tersedia</h3>
                    <div class="value">{{ $products->where('stock', '>', 0)->count() }}</div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Stok Rendah</h3>
                    <div class="value">{{ $products->where('stock', '<', 10)->where('stock', '>', 0)->count() }}</div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="stat-content">
                    <h3>Habis Stok</h3>
                    <div class="value">{{ $products->where('stock', '<=', 0)->count() }}</div>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar fade-in">
            <div class="filter-group">
                <span class="filter-label">Filter Stok:</span>
                <select class="filter-select" id="stockFilter">
                    <option value="all">Semua Stok</option>
                    <option value="available">Tersedia</option>
                    <option value="low">Stok Rendah</option>
                    <option value="out">Habis Stok</option>
                </select>
            </div>

            <div class="filter-group">
                <span class="filter-label">Urutkan:</span>
                <select class="filter-select" id="sortFilter">
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                    <option value="price_high">Harga Tertinggi</option>
                    <option value="price_low">Harga Terendah</option>
                    <option value="stock_high">Stok Terbanyak</option>
                    <option value="stock_low">Stok Tersedikit</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid">
            @foreach($products as $product)
            @php
            // Determine stock status
            $stockClass = '';
            $stockBadge = '';
            $progressClass = '';
            $progressWidth = 0;

            if($product->stock <= 0) {
                $stockClass='out-of-stock' ;
                $stockBadge='HABIS' ;
                } elseif($product->stock < 50) {
                    $stockClass='low-stock' ;
                    $stockBadge='TERBATAS' ;
                    $progressClass='progress-low' ;
                    $progressWidth=($product->stock / 100) * 100;
                    } elseif($product->stock < 200) {
                        $stockClass='low-stock' ;
                        $stockBadge='SEDANG' ;
                        $progressClass='progress-medium' ;
                        $progressWidth=($product->stock / 100) * 100;
                        } else {
                        $stockClass = 'in-stock';
                        $stockBadge = 'BANYAK';
                        $progressClass = 'progress-high';
                        $progressWidth = 100;
                        }
                        @endphp

                        <div class="product-card fade-in"
                            data-stock="{{ $product->stock }}"
                            data-price="{{ $product->price }}"
                            data-name="{{ strtolower($product->name) }}">
                            <!-- Product Image -->
                            <div class="product-image-container">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="product-image">

                                <!-- Stock Badge -->
                                <div class="stock-badge {{ $stockClass }}">
                                    {{ $stockBadge }}
                                </div>

                            </div>

                            <!-- Product Content -->
                            <div class="product-content">
                                <div class="product-header">
                                    <h3 class="product-name">{{ $product->name }}</h3>
                                    <p class="product-description">{{ $product->description }}</p>
                                </div>

                                <div class="product-details">
                                    <!-- Price Section -->
                                    <div class="price-section">
                                        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                        <div class="stock-section">
                                            <span class="stock-label">Stok:</span>
                                            <span class="stock-value">{{ $product->stock }} pcs</span>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="action-buttons">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="action-btn edit-btn">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        @if($products->isEmpty())
                        <!-- Empty State -->
                        <div class="empty-state fade-in">
                            <div class="empty-icon">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-700 mb-3">Belum ada produk</h3>
                            <p class="text-gray-500 mb-6">Tambahkan produk pertama Anda untuk mulai berjualan</p>
                            <a href="{{ route('products.create') }}"
                                class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Tambah Produk Pertama
                            </a>
                        </div>
                        @endif
        </div>

        <!-- Product Detail Modal -->
        <div class="modal" id="productDetailModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-lg font-bold text-gray-800">Detail Produk</h3>
                    <button class="modal-close" onclick="closeModal()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body" id="productDetailContent">
                    <!-- Content will be loaded via AJAX -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Filter products by stock
        document.getElementById('stockFilter').addEventListener('change', function(e) {
            const filter = e.target.value;
            const cards = document.querySelectorAll('.product-card');

            cards.forEach(card => {
                const stock = parseInt(card.dataset.stock);
                let shouldShow = true;

                switch (filter) {
                    case 'available':
                        shouldShow = stock > 0;
                        break;
                    case 'low':
                        shouldShow = stock > 0 && stock < 10;
                        break;
                    case 'out':
                        shouldShow = stock <= 0;
                        break;
                    default:
                        shouldShow = true;
                }

                if (shouldShow) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });

        // Sort products
        document.getElementById('sortFilter').addEventListener('change', function(e) {
            const sortBy = e.target.value;
            const container = document.querySelector('.products-grid');
            const cards = Array.from(document.querySelectorAll('.product-card:not([style*="display: none"])'));

            cards.sort((a, b) => {
                switch (sortBy) {
                    case 'newest':
                        return 0; // Assuming they're already in creation order
                    case 'oldest':
                        return 0;
                    case 'price_high':
                        return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                    case 'price_low':
                        return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                    case 'stock_high':
                        return parseFloat(b.dataset.stock) - parseFloat(a.dataset.stock);
                    case 'stock_low':
                        return parseFloat(a.dataset.stock) - parseFloat(b.dataset.stock);
                    default:
                        return 0;
                }
            });

            // Reorder cards
            cards.forEach(card => {
                container.appendChild(card);
            });
        });

        // Search products
        document.getElementById('searchProducts').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.product-card');

            cards.forEach(card => {
                const productName = card.dataset.name;

                if (productName.includes(searchTerm) || searchTerm === '') {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });

        // View product detail
        async function viewProduct(productId) {
            const modal = document.getElementById('productDetailModal');
            const content = document.getElementById('productDetailContent');

            // Show loading
            content.innerHTML = `
                <div class="text-center py-8">
                    <svg class="w-8 h-8 animate-spin mx-auto text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <p class="mt-2 text-gray-500">Memuat detail produk...</p>
                </div>
            `;

            modal.classList.add('active');

            // In a real app, you would fetch from API
            // For now, we'll create a static view
            setTimeout(() => {
                content.innerHTML = `
                    <div class="space-y-6">
                        <div class="text-center">
                            <img src="{{ asset('storage/') }}/products/${productId}.jpg" 
                                 alt="Product Image" 
                                 class="w-64 h-64 object-cover rounded-xl mx-auto mb-4">
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Informasi Produk</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">ID Produk:</span>
                                    <span class="font-medium">#${productId}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Dibuat:</span>
                                    <span class="font-medium">${new Date().toLocaleDateString('id-ID')}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Terakhir Diperbarui:</span>
                                    <span class="font-medium">${new Date().toLocaleDateString('id-ID')}</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="/admin/products/${productId}/edit" 
                               class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700">
                                Edit Produk
                            </a>
                        </div>
                    </div>
                `;
            }, 500);
        }

        // Duplicate product
        function duplicateProduct(productId) {
            if (confirm('Duplikat produk ini?')) {
                // In a real app, you would make an API call
                alert('Fitur duplikasi produk akan segera tersedia!');
            }
        }

        // Confirm delete
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target;

            Swal.fire({
                title: 'Hapus Produk?',
                text: "Produk yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Close modal
        function closeModal() {
            document.getElementById('productDetailModal').classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('productDetailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Add animations on load
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation delay to cards
            const cards = document.querySelectorAll('.product-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Add SweetAlert if not already loaded
            if (typeof Swal === 'undefined') {
                const script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
                document.head.appendChild(script);
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
                
                .product-card {
                    transition: opacity 0.3s ease, transform 0.3s ease;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</x-app-layout>