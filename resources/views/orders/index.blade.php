<x-app-layout>
    <style>
        header.bg-white {
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%) !important;
            border-bottom: none !important;
        }

        header h2 {
            color: white !important;
        }

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
    </style>
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
                <div id="cart-types-container" class="admin-primary-btn">
                    <span id="cart-types-display">{{ $cartTypes ?? 0 }} item di keranjang</span>
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

        /* Grid container */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            width: 100%;
        }

        /* Card produk */
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
            cursor: pointer;
            /* Menandakan bisa diklik */
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-color: #10b981;
            /* Highlight warna hijau saat hover */
        }

        /* Gambar produk */
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

        /* Badge stok */
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
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%);
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
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
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

        /* Toast & Animations */
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
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
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

        /* MODAL STYLES */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 50;
            display: none;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: white;
            width: 90%;
            max-width: 800px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: scale(0.95);
            transition: transform 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .modal-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
        }

        .modal-image-area {
            background: #f3f4f6;
            height: 100%;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-details {
            padding: 32px;
            display: flex;
            flex-direction: column;
        }

        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: none;
            z-index: 10;
        }

        .modal-close:hover {
            background: #f3f4f6;
        }

        @media (max-width: 768px) {
            .modal-grid {
                grid-template-columns: 1fr;
            }

            .modal-image-area {
                height: 250px;
            }

            .modal-details {
                padding: 20px;
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
        @if(session('success')) <div class="notification success">✅ {{ session('success') }}</div> @endif
        @if(session('error')) <div class="notification error">⚠️ {{ session('error') }}</div> @endif

        <div class="products-header">
            <div>
                <h1 class="text-xl font-bold text-gray-900">Semua Produk Tersedia</h1>
                <p class="products-count">{{ $products->count() }} produk ditemukan</p>
            </div>
        </div>

        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card"
                onclick="openDetail(this)"
                data-id="{{ $product->id }}"
                data-name="{{ $product->name }}"
                data-price="{{ number_format($product->price, 0, ',', '.') }}"
                data-stock="{{ $product->stock }}"
                data-description="{{ $product->description }}"
                data-image="{{ asset('storage/' . $product->image) }}">

                <div class="product-image-container">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                    @if($product->stock <= 0)
                        <div class="stock-badge">HABIS
                </div>
                @endif
            </div>

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

                <div class="product-actions" onclick="event.stopPropagation()">
                    @if($product->stock > 0)
                    <form class="ajax-add-to-cart flex items-center" action="{{ route('carts.store', $product->id) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="20" min="20" max="{{ $product->stock }}" class="quantity-input" required>
                        <button type="submit" class="add-to-cart-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah
                        </button>
                    </form>
                    @else
                    <button disabled class="add-to-cart-btn">Stok Habis</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($products->count() == 0)
    <div class="empty-state">
        <div class="empty-icon">📦</div>
        <h3>Tidak ada produk tersedia</h3>
        <p>Silakan coba lagi nanti</p>
    </div>
    @endif
    </div>

    <div id="productModal" class="modal-overlay" onclick="closeDetail(event)">
        <div class="modal-content relative">
            <button class="modal-close" onclick="closeDetail(event, true)">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="modal-grid">
                <div class="modal-image-area">
                    <img id="modalImage" src="" alt="Detail Produk" class="modal-image">
                </div>
                <div class="modal-details">
                    <div class="mb-4">
                        <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded">Tersedia</span>
                        <h2 id="modalName" class="text-2xl font-bold text-gray-900 mt-2 mb-1">Nama Produk</h2>
                        <p id="modalPrice" class="text-3xl font-extrabold text-orange-600">Rp 0</p>
                    </div>

                    <div class="prose prose-sm text-gray-600 mb-6 flex-grow overflow-y-auto max-h-40">
                        <h4 class="font-semibold text-gray-900 mb-1">Deskripsi:</h4>
                        <p id="modalDesc" style="white-space: pre-line;">Deskripsi produk akan muncul di sini.</p>
                    </div>

                    <div class="border-t border-gray-100 pt-4 mt-auto">
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>Stok Tersedia: <strong id="modalStock">0</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // FUNGSI MODAL
        function openDetail(element) {
            // Ambil data dari atribut element
            const name = element.getAttribute('data-name');
            const price = element.getAttribute('data-price');
            const stock = element.getAttribute('data-stock');
            const desc = element.getAttribute('data-description');
            const image = element.getAttribute('data-image');

            // Isi konten modal
            document.getElementById('modalName').innerText = name;
            document.getElementById('modalPrice').innerText = 'Rp ' + price;
            document.getElementById('modalStock').innerText = stock;
            document.getElementById('modalDesc').innerText = desc || 'Tidak ada deskripsi.';
            document.getElementById('modalImage').src = image;

            // Tampilkan modal
            const modal = document.getElementById('productModal');
            modal.style.display = 'flex';
            // Sedikit delay biar animasi CSS jalan
            setTimeout(() => {
                modal.classList.add('active');
            }, 10);
            document.body.style.overflow = 'hidden'; // Matikan scroll body
        }

        function closeDetail(event, force = false) {
            // Tutup hanya jika klik overlay background atau tombol close
            if (force || event.target.id === 'productModal') {
                const modal = document.getElementById('productModal');
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300); // Sesuaikan dengan durasi transition CSS
                document.body.style.overflow = 'auto'; // Hidupkan scroll body
            }
        }

        // --- SCRIPT LAMA (TOAST & AJAX CART) ---
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

        function updateCartBadge(count) {
            const badge = document.getElementById('cart-count-badge');
            if (!badge) return;
            const n = parseInt(count) || 0;
            badge.textContent = n;
            badge.style.display = n > 0 ? 'flex' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.ajax-add-to-cart');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            forms.forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (!submitBtn) return;

                    const action = form.getAttribute('action');
                    const formData = new FormData(form);

                    submitBtn.disabled = true;
                    const originalHtml = submitBtn.innerHTML;
                    submitBtn.innerHTML = '...';

                    try {
                        const response = await fetch(action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        let data = null;
                        try {
                            data = await response.json();
                        } catch (err) {
                            data = null;
                        }

                        if (!response.ok) {
                            const msg = data && (data.message || data.error) ? (data.message || data.error) : 'Gagal menambah ke keranjang';
                            showToast(msg, 'error');
                        } else {
                            const msg = data && (data.message || data.success) ? (data.message || data.success) : 'Produk berhasil ditambahkan ke keranjang';
                            showToast(msg, 'success');
                            if (data && typeof data.cartCount !== 'undefined') {
                                updateCartBadge(data.cartCount);
                            }
                        }
                    } catch (err) {
                        console.error('AJAX error:', err);
                        showToast('Terjadi kesalahan koneksi.', 'error');
                    } finally {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalHtml;
                    }
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