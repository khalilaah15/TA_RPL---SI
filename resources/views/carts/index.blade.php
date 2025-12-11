<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Keranjang Belanja') }}
            </h2>
            <a href="{{ route('products.index') }}"
                class="flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali Berbelanja
            </a>
        </div>
    </x-slot>

    <style>
        /* ========== Spacing Tokens ========== */
        :root {
            --page-pad-x: 1rem;
            /* mobile horizontal padding */
            --page-pad-x-lg: 2rem;
            /* desktop horizontal padding */
            --g-4: 1rem;
            /* general gap */
            --g-6: 1.5rem;
            --card-pad: 1.25rem;
            /* internal card padding */
            --card-pad-lg: 1.5rem;
            --muted: #6b7280;
            --border: #e5e7eb;
            --surface: #ffffff;
            --accent: #10b981;
        }

        /* ========== Page layout ========== */
        .page {
            padding: 2rem var(--page-pad-x) 3rem;
            background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
            min-height: 100vh;
        }

        @media(min-width: 1024px) {
            .page {
                padding-left: var(--page-pad-x-lg);
                padding-right: var(--page-pad-x-lg);
            }
        }

        .container {
            max-width: 1120px;
            margin: 0 auto;
        }

        .g-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--g-6);
        }

        @media(min-width: 1024px) {
            .g-row {
                grid-template-columns: 2fr 1fr;
            }
        }

        /* ========== Card & common ========== */
        .card {
            background: var(--surface);
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        .cart-card {
            padding: var(--card-pad);
        }

        .order-card {
            padding: var(--card-pad);
        }

        @media(min-width:1024px) {

            .cart-card,
            .order-card {
                padding: var(--card-pad-lg);
            }
        }

        /* ========== Cart items ========== */
        .cart-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .cart-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            padding: 0.9rem;
            border-radius: 10px;
            border: 1px solid #f3f4f6;
            background: #fff;
            transition: background .18s, transform .18s;
        }

        .cart-item:hover {
            background: #fbfbfb;
            transform: translateY(-2px);
        }

        .cart-item-media {
            width: 76px;
            min-width: 76px;
            height: 76px;
            border-radius: 8px;
            overflow: hidden;
            background: #f3f4f6;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-item-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .cart-item-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .cart-item-title {
            font-weight: 700;
            color: #111827;
            font-size: 0.98rem;
            line-height: 1.2;
        }

        .cart-item-meta {
            color: var(--muted);
            font-size: 0.9rem;
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .cart-item-actions {
            margin-left: 0.5rem;
            display: flex;
            align-items: flex-start;
        }

        /* ========== Order summary ========== */
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .5rem;
            padding: .5rem 0;
        }

        .summary-label {
            color: var(--muted);
            font-size: 0.95rem;
        }

        .summary-value {
            font-weight: 600;
            color: #111827;
        }

        /* ========== Buttons & form ========== */
        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, #059669 100%);
            color: #fff;
            border-radius: 10px;
            padding: 12px 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-primary:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .btn-danger {
            background: #fff5f5;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 8px 10px;
            border-radius: 8px;
            display: inline-flex;
            gap: 8px;
            align-items: center;
            cursor: pointer;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 0.95rem;
            background: #fff;
        }

        .form-input:focus {
            outline: none;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.06);
            border-color: var(--accent);
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        /* ========== QRIS box ========== */
        .qris-box {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 10px;
            padding: 14px;
            border: 1px solid #bae6fd;
            text-align: center;
        }

        .qris-img {
            width: 220px;
            height: 220px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        /* ========== Empty state ========== */
        .empty-cart {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-cart-icon {
            font-size: 56px;
            margin-bottom: 14px;
            opacity: .6;
        }

        /* ========== Tiny helpers ========== */
        .muted {
            color: var(--muted);
        }

        .small {
            font-size: 0.92rem;
            color: var(--muted);
        }

        /* ========== Loader ========== */
        .loader {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* responsiveness tweaks */
        @media(max-width:640px) {
            .cart-item {
                padding: .75rem;
                gap: .75rem;
            }

            .cart-item-media {
                width: 64px;
                height: 64px;
                min-width: 64px;
            }

            .qris-img {
                width: 160px;
                height: 160px;
            }
        }
    </style>

    <div class="page">
        <div class="container">
            <!-- Notifications -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-green-800 font-medium">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-red-800 font-medium">{{ session('error') }}</span>
                </div>
            </div>
            @endif

            <!-- Grid: left cart list, right order summary -->
            <div class="g-row">
                <!-- LEFT -->
                <div class="card cart-card">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Detail Pesanan</h3>
                            <p class="small mt-1">{{ $carts->count() }} item dalam keranjang</p>
                        </div>
                        <div class="badge badge-info" style="display:inline-flex; align-items:center; gap:.5rem; padding:.45rem .9rem; border-radius:20px; background:#dbeafe; color:#1e40af; font-weight:700;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span>{{ $carts->sum('quantity') }} total barang</span>
                        </div>
                    </div>

                    @if($carts->count() > 0)
                    <div class="cart-list">
                        @foreach($carts as $cart)
                        <div class="cart-item">
                            <div class="cart-item-media">
                                @if($cart->product->image)
                                <img src="{{ asset('storage/' . $cart->product->image) }}" alt="{{ $cart->product->name }}">
                                @else
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                @endif
                            </div>

                            <div class="cart-item-body">
                                <div class="cart-item-title">{{ $cart->product->name }}</div>
                                <div class="cart-item-meta">
                                    <div class="small">Harga: Rp {{ number_format($cart->product->price,0,',','.') }}/item</div>
                                    <div class="small">•</div>
                                    <div class="small">Jumlah: <strong class="text-gray-900 ml-1">{{ $cart->quantity }}</strong></div>
                                    <div class="small">•</div>
                                    <div class="small">Subtotal: <span class="text-green-600 font-bold ml-1">Rp {{ number_format($cart->product->price * $cart->quantity,0,',','.') }}</span></div>
                                </div>
                            </div>

                            <div class="cart-item-actions">
                                <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger" onclick="return confirm('Hapus item dari keranjang?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- totals -->
<div class="mt-6 pt-6 border-t border-gray-100">
    @php 
        // 1. Hitung Subtotal (Harga Barang x Jumlah)
        $subtotal = $carts->sum(fn($c) => $c->product->price * $c->quantity);
        
        // 2. Tentukan Ongkir (Bisa diubah dinamis nanti, sekarang fix 30rb)
        $ongkir = 30000; 
        
        // 3. Hitung Total Akhir
        $total = $subtotal + $ongkir;
    @endphp

    <div class="summary-row">
        <div class="summary-label">Subtotal</div>
        <div class="summary-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
    </div>

    <div class="summary-row">
        <div class="summary-label">Ongkos Kirim</div>
        <div class="summary-value">Rp {{ number_format($ongkir, 0, ',', '.') }}</div>
    </div>

    <div class="summary-row">
        <div class="summary-label">Biaya Layanan</div>
        <div class="summary-value">Rp 0</div>
    </div>

    <div class="summary-row" style="border-top:1px solid #f3f4f6; padding-top:1rem; margin-top:1rem; font-size:1.05rem;">
        <div class="summary-label font-bold">Total Pembayaran</div>
        <div class="summary-value text-green-600 font-bold">Rp {{ number_format($total, 0, ',', '.') }}</div>
    </div>
</div>
                    @else
                    <div class="empty-cart">
                        <div class="empty-cart-icon">🛒</div>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">Keranjang Belanja Kosong</h3>
                        <p class="small mb-6">Tambahkan produk ke keranjang untuk melanjutkan</p>
                        <!-- <a href="{{ route('products.index') }}" class="btn-primary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Mulai Belanja
                            </a> -->
                    </div>
                    @endif
                </div>

                <!-- RIGHT -->
                @if($carts->count() > 0)
                <div class="card order-card">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Data Pengiriman</h3>

                    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data" id="orderForm">
                        @csrf
                        <div style="display:flex; flex-direction:column; gap:1rem;">
                            <div>
                                <label class="form-label">Nama Penerima</label>
                                <input type="text" name="receiver_name" class="form-input" placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div>
                                <label class="form-label">Nomor Telepon</label>
                                <input type="tel" name="phone" class="form-input" placeholder="Contoh: 081234567890" required>
                            </div>

                            <div>
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="address" class="form-input" style="min-height:120px;" placeholder="Masukkan alamat lengkap termasuk nomor rumah, RT/RW, kecamatan, kota" required></textarea>
                            </div>

                            <div>
                                <label class="form-label">Catatan (Opsional)</label>
                                <textarea name="note" class="form-input" style="min-height:90px;" placeholder="Contoh: Tolong dikirim sebelum jam 5 sore"></textarea>
                            </div>

                            <div>
                                <label class="form-label">Pembayaran QRIS</label>
                                <div class="qris-box">
                                    <div style="margin-bottom:.75rem;">
                                        <strong class="text-gray-800">Scan QR Code di bawah</strong>
                                    </div>
                                    <div class="inline-block p-2 bg-white rounded-lg border border-gray-200 mb-3">
                                        <img src="{{ asset('image.png') }}" alt="QRIS Payment" class="qris-img">
                                    </div>
                                    <div class="small">
                                        <div class="font-semibold">a.n Duan Tangguh Manggala</div>
                                        <div>Pastikan nominal transfer sesuai dengan total pembayaran</div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="form-label">Upload Bukti Transfer</label>
                                <input type="file" name="payment_proof" id="payment_proof" class="form-input" accept="image/*,.pdf" required>
                                <p class="small mt-2">Format: JPG, PNG, atau PDF (maks. 2MB)</p>

                                <div id="filePreview" class="mt-3" style="display:none;">
                                    <div style="display:flex; gap:.75rem; align-items:center; padding:.6rem; background:#ecfdf5; border-radius:.6rem; border:1px solid #bbf7d0;">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span id="fileName" class="text-sm text-green-800 font-medium"></span>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: .5rem;">
                                <button type="submit" id="submitBtn" class="btn-primary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Konfirmasi & Bayar</span>
                                </button>
                                <p class="small text-center" style="margin-top:.6rem;">Dengan melanjutkan, Anda menyetujui Syarat dan Ketentuan yang berlaku</p>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Preview file upload
            const fileInput = document.getElementById('payment_proof');
            const filePreview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');

            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        if (file.size > 2 * 1024 * 1024) {
                            alert('File terlalu besar. Maksimal 2MB.');
                            this.value = '';
                            filePreview.style.display = 'none';
                            return;
                        }

                        fileName.textContent = file.name;
                        filePreview.style.display = 'block';
                    } else {
                        filePreview.style.display = 'none';
                    }
                });
            }

            // Form submission handler
            const orderForm = document.getElementById('orderForm');
            const submitBtn = document.getElementById('submitBtn');

            if (orderForm) {
                orderForm.addEventListener('submit', function(e) {
                    // Validasi sebelum submit
                    const requiredFields = this.querySelectorAll('[required]');
                    let isValid = true;

                    requiredFields.forEach(field => {
                        if (!field.value || !String(field.value).trim()) {
                            isValid = false;
                            field.style.borderColor = '#ef4444';
                        } else {
                            field.style.borderColor = '';
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        alert('Harap lengkapi semua field yang wajib diisi.');
                        return;
                    }

                    // Ubah teks tombol saat loading
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                            <div class="loader" style="margin-right:.6rem;"></div>
                            Memproses...
                        `;
                    }
                });
            }

            // subtle animation delay for items
            const cartItems = document.querySelectorAll('.cart-item');
            cartItems.forEach((item, index) => {
                item.style.opacity = 0;
                item.style.transform = 'translateY(8px)';
                setTimeout(() => {
                    item.style.transition = 'opacity .32s ease, transform .32s ease';
                    item.style.opacity = 1;
                    item.style.transform = 'translateY(0)';
                }, index * 60);
            });
        });
    </script>
</x-app-layout>