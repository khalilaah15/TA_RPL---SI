<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Toko Camilan Online') }}
            </h2>
            <a id="cart-button" href="{{ route('carts.index') }}"
                class="relative flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <!-- Total jenis barang (distinct items) -->
                <div id="cart-types-container" class="bg-white shadow-sm text-gray-800 px-3 py-2 rounded-lg font-semibold text-sm flex items-center gap-2 border border-gray-100">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span id="cart-types-display">{{ $cartTypes ?? 0 }} item berada di keranjang</span>
                </div>
            </a>
        </div>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Reset dan base styles */
        * {
            box-sizing: border-box;
        }

        /* Grid container untuk produk */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            width: 100%;
        }

        /* Card produk yang kecil dan kompak */
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        /* Bagian gambar produk */
        .product-image-container {
            position: relative;
            width: 100%;
            height: 160px;
            overflow: hidden;
            background: #f9fafb;
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

        /* Badge untuk stok habis */
        .stock-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background: rgba(239, 68, 68, 0.95);
            color: white;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 12px;
            z-index: 10;
        }

        /* Konten card */
        .product-content {
            padding: 12px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 36px;
        }

        .product-price {
            font-size: 16px;
            font-weight: 800;
            color: #ea580c;
            margin-bottom: 4px;
        }

        .product-stock {
            font-size: 12px;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 12px;
        }

        .stock-icon {
            width: 12px;
            height: 12px;
        }

        /* Tombol dan input */
        .product-actions {
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
        }

        .quantity-input {
            width: 60px;
            height: 32px;
            text-align: center;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            margin-right: 8px;
        }

        .add-to-cart-btn {
            background: #10b981;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            flex-grow: 1;
        }

        .add-to-cart-btn:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .add-to-cart-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
        }

        /* Layout utama */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header info */
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .products-count {
            font-size: 14px;
            color: #6b7280;
        }

        .update-info {
            font-size: 13px;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Toast */
        .toast {
            position: fixed;
            right: 1rem;
            top: 1rem;
            z-index: 60;
            min-width: 220px;
            padding: .6rem 1rem;
            border-radius: .5rem;
            display: flex;
            gap: .6rem;
            align-items: center;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.12);
            transform-origin: top right;
            animation: toastIn .22s cubic-bezier(.2, .9, .3, 1);
            color: white;
        }

        .toast-success {
            background: linear-gradient(90deg, #10b981, #059669);
        }

        .toast-error {
            background: linear-gradient(90deg, #ef4444, #dc2626);
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateY(-8px) scale(.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsif tweaks */
        @media (max-width: 640px) {
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 12px;
            }

            .product-image-container {
                height: 140px;
            }
        }

        @media (min-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 20px;
            }
        }
    </style>

    <div class="main-container">
        <!-- Notifikasi server-side (fallback) -->
        @if(session('success'))
        <div class="notification success">
            ✅ {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="notification error">
            ⚠️ {{ session('error') }}
        </div>
        @endif

        <!-- Header produk -->
        <div class="products-header">
            <div>
                <h1 class="text-xl font-bold text-gray-900">Semua Produk Tersedia</h1>
                <p class="products-count">{{ $products->count() }} produk ditemukan</p>
            </div>
            <div class="update-info">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Diperbarui hari ini</span>
            </div>
        </div>

        <!-- Grid produk -->
        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card">
                <!-- Gambar produk -->
                <div class="product-image-container">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="product-image">

                    @if($product->stock <= 0)
                        <div class="stock-badge">HABIS
                </div>
                @endif
            </div>

            <!-- Konten produk -->
            <div class="product-content">
                <h3 class="product-name">{{ $product->name }}</h3>

                <div class="mb-2">
                    <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    <div class="product-stock">
                        <svg class="stock-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span>Stok: {{ $product->stock }}</span>
                    </div>
                </div>

                <!-- Aksi produk -->
                <div class="product-actions">
                    @if($product->stock > 0)
                    <form class="ajax-add-to-cart flex items-center" action="{{ route('carts.store', $product->id) }}" method="POST" data-product-id="{{ $product->id }}">
                        @csrf
                        <input type="number"
                            name="quantity"
                            value="20"
                            min="20"
                            max="{{ $product->stock }}"
                            class="quantity-input"
                            required>
                        <button type="submit" class="add-to-cart-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah
                        </button>
                    </form>
                    @else
                    <button disabled class="add-to-cart-btn">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Stok Habis
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Jika tidak ada produk -->
    @if($products->count() == 0)
    <div class="empty-state">
        <div class="empty-icon">📦</div>
        <h3>Tidak ada produk tersedia</h3>
        <p>Silakan coba lagi nanti</p>
    </div>
    @endif
    </div>

    <script>
        // UTIL: show toast
        function showToast(message, type = 'success', duration = 3000) {
            const toast = document.createElement('div');
            toast.className = 'toast ' + (type === 'error' ? 'toast-error' : 'toast-success');
            toast.innerHTML = `
                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" style="flex:0 0 auto; opacity:.95;">
                    ${ type === 'error'
                        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M6 18L18 6M6 6l12 12"/>'
                        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M5 13l4 4L19 7"/>'
                    }
                </svg>
                <div style="margin-left:8px; font-weight:600; font-size:.95rem;">${message}</div>
            `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.transition = 'opacity .25s, transform .25s';
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-8px) scale(.98)';
                setTimeout(() => toast.remove(), 300);
            }, duration);
        }

        // Update cart count badge
        function updateCartBadge(count) {
            const badge = document.getElementById('cart-count-badge');
            if (!badge) return;
            const n = parseInt(count) || 0;
            badge.textContent = n;
            badge.style.display = n > 0 ? 'flex' : 'none';
        }

        // Setup AJAX submit for add-to-cart forms
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.ajax-add-to-cart');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            forms.forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (!submitBtn) return;

                    // read action and formdata
                    const action = form.getAttribute('action');
                    const formData = new FormData(form);

                    // disable button to prevent double submit
                    submitBtn.disabled = true;
                    const originalHtml = submitBtn.innerHTML;
                    submitBtn.innerHTML = 'Memproses...';

                    try {
                        const response = await fetch(action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: formData,
                            credentials: 'same-origin'
                        });

                        // Try to parse JSON (best case)
                        let data = null;
                        try {
                            data = await response.json();
                        } catch (err) {
                            // not JSON — fallback
                            data = null;
                        }

                        if (!response.ok) {
                            // If server returned error status, try to show message from JSON, else generic
                            const msg = data && (data.message || data.error) ? (data.message || data.error) : 'Gagal menambah ke keranjang';
                            showToast(msg, 'error');
                        } else {
                            // Success: show message (from JSON) or default
                            const msg = data && (data.message || data.success) ? (data.message || data.success) : 'Produk berhasil ditambahkan ke keranjang';
                            showToast(msg, 'success');

                            // If server returns cartCount, update badge
                            if (data && typeof data.cartCount !== 'undefined') {
                                updateCartBadge(data.cartCount);
                            } else {
                                // Optional: increment badge client-side if present
                                const badge = document.getElementById('cart-count-badge');
                                if (badge) {
                                    const cur = parseInt(badge.textContent) || 0;
                                    updateCartBadge(cur + parseInt(formData.get('quantity') || 1));
                                }
                            }
                        }
                    } catch (err) {
                        console.error('AJAX add to cart error:', err);
                        showToast('Terjadi kesalahan. Coba lagi.', 'error');
                    } finally {
                        // restore button
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalHtml;
                    }
                });
            });

            // Small UX: validate quantity inputs (min/max)
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const min = parseInt(this.min || 1);
                    const max = parseInt(this.max || 999999);
                    let v = parseInt(this.value) || min;
                    if (v < min) v = min;
                    if (v > max) v = max;
                    this.value = v;
                });
            });

            // Card entry animation
            const cards = document.querySelectorAll('.product-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(16px)';
                setTimeout(() => {
                    card.style.transition = 'opacity .35s ease, transform .35s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 60);
            });
        });
    </script>
</x-app-layout>