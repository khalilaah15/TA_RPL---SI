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
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        /* Custom Dashboard Styles */
        .dash-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }

        /* Hero/Welcome Section */
        .welcome-banner {
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%);
            border-radius: 20px;
            padding: 32px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(185, 28, 28, 0.4);
            margin-bottom: 32px;
        }

        .welcome-pattern {
            position: absolute;
            top: 0;
            right: 0;
            opacity: 0.1;
            pointer-events: none;
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
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #f3f4f6;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-color: #fecaca;
        }

        .stat-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        /* Quick Menu Grid */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .menu-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        .menu-card:hover {
            background: #fff1f2;
            border-color: #fda4af;
            transform: scale(1.02);
        }

        .menu-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 12px;
            border-radius: 50%;
            background: #fee2e2;
            color: #b91c1c;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-title {
            font-weight: 600;
            color: #374151;
        }

        /* Contact Info Card */
        .contact-card {
            background: linear-gradient(to right, #fff, #fff1f2);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #fecaca;
            margin-bottom: 32px;
        }

        .contact-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
            align-items: center;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            padding: 10px 20px;
            background: white;
            border-radius: 50px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.2s;
            border: 1px solid #e5e7eb;
        }

        .contact-item:hover {
            transform: translateY(-2px);
            border-color: #b91c1c;
        }

        /* Recent Activity Table */
        .recent-section {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #f3f4f6;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th {
            text-align: left;
            padding: 12px;
            color: #6b7280;
            font-size: 14px;
            border-bottom: 1px solid #f3f4f6;
        }

        .custom-table td {
            padding: 16px 12px;
            border-bottom: 1px solid #f3f4f6;
            color: #1f2937;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        /* Animation */
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* Responsive */
        @media (max-width: 768px) {
            .dash-container { padding: 16px; }
            .contact-grid { flex-direction: column; align-items: stretch; }
            .contact-item { justify-content: center; }
            .custom-table { display: block; overflow-x: auto; }
        }
    </style>

    <div class="dash-container">
        
        <div class="welcome-banner fade-in">
            <svg class="welcome-pattern w-64 h-64" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#FFFFFF" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.2,-19.2,95.8,-5.3C93.5,8.6,81.9,21.5,70.6,32.3C59.3,43.1,48.2,51.8,36.4,58.6C24.5,65.4,11.9,70.2,-2.2,74C-16.3,77.8,-32.1,80.6,-45.5,74.7C-58.9,68.8,-69.9,54.2,-77.2,38.5C-84.5,22.8,-88.1,6,-84.9,-9.4C-81.7,-24.8,-71.7,-38.8,-59.8,-49.6C-47.9,-60.4,-34.1,-68,-20.3,-71.7C-6.5,-75.4,7.3,-75.2,20.8,-75.2" transform="translate(100 100)" />
            </svg>
            <div class="relative z-10">
                <h1 class="text-3xl font-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h1>
                
                @if(Auth::user()->role == 'admin')
                    <p class="text-red-100 text-lg opacity-90">Selamat bekerja. Berikut ringkasan performa penjualan hari ini.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.orders.index') }}" class="bg-white text-red-600 px-6 py-2 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg">
                            Kelola Pesanan
                        </a>
                    </div>
                @else
                    <p class="text-red-100 text-lg opacity-90">Selamat datang kembali di Dashboard Reseller Pedasan Kunchung.</p>
                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('order.index') }}" class="bg-white text-red-600 px-6 py-2 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="stats-grid fade-in">
            @if(Auth::user()->role == 'admin')
                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-gray-500 text-sm">Total Pendapatan</p>
                    <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($data['total_revenue'], 0, ',', '.') }}</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-yellow-100 text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-gray-500 text-sm">Pesanan Pending</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $data['pending_orders'] }}</h3>
                    <p class="text-xs text-red-500 mt-1">Perlu konfirmasi</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-gray-500 text-sm">Pesanan Selesai</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $data['completed_orders'] }}</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-purple-100 text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <p class="text-gray-500 text-sm">Total Reseller</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $data['total_users'] }}</h3>
                </div>

            @else
                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-red-100 text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-gray-500 text-sm">Total Belanja</p>
                    <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($data['total_spent'], 0, ',', '.') }}</h3> 
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-yellow-100 text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                    <p class="text-gray-500 text-sm">Pesanan Aktif</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $data['active_orders'] }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Sedang diproses</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-gray-500 text-sm">Pesanan Selesai</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $data['completed_orders_count'] }}</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <p class="text-gray-500 text-sm">Isi Keranjang</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $data['cart_count'] }} Item</h3>
                    <p class="text-xs text-red-500 mt-1 hover:underline cursor-pointer"><a href="{{ route('carts.index') }}">Checkout →</a></p>
                </div>
            @endif
        </div>

        <h3 class="text-lg font-bold text-gray-800 mb-4">Akses Cepat</h3>
        <div class="menu-grid fade-in">
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.orders.index') }}" class="menu-card">
                    <div class="menu-icon"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg></div>
                    <div class="menu-title">Kelola Pesanan</div>
                </a>
                <a href="{{ route('products.index') }}" class="menu-card">
                    <div class="menu-icon"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg></div>
                    <div class="menu-title">Kelola Menu</div>
                </a>
            @else
                <a href="{{ route('order.index') }}" class="menu-card">
                    <div class="menu-icon"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg></div>
                    <div class="menu-title">Belanja Produk</div>
                </a>
                <a href="{{ route('carts.index') }}" class="menu-card">
                    <div class="menu-icon"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg></div>
                    <div class="menu-title">Keranjang</div>
                </a>
                <a href="{{ route('order.history') }}" class="menu-card">
                    <div class="menu-icon"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg></div>
                    <div class="menu-title">Riwayat Pesanan</div>
                </a>
            @endif
            <a href="{{ route('profile.edit') }}" class="menu-card">
                <div class="menu-icon"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg></div>
                <div class="menu-title">Profil Saya</div>
            </a>
        </div>

        <div class="contact-card fade-in">
            <div class="text-center mb-6">
                <h4 class="font-bold text-gray-800 text-lg">Pusat Bantuan & Kontak Resmi</h4>
                <p class="text-gray-500">Hubungi kami jika ada kendala pesanan atau pertanyaan produk.</p>
            </div>
            <div class="contact-grid">
                <a href="https://wa.me/6281393133583" target="_blank" class="contact-item group">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">WhatsApp Admin</p>
                        <p class="font-bold text-gray-800">+62 813-9313-3583</p>
                    </div>
                </a>

                <a href="https://instagram.com/pedasan.kunchung" target="_blank" class="contact-item group">
                    <div class="w-10 h-10 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center group-hover:bg-pink-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Instagram</p>
                        <p class="font-bold text-gray-800">@pedasan.kunchung</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="recent-section fade-in">
            <div class="table-header">
                <h3 class="font-bold text-lg text-gray-800">
                    {{ Auth::user()->role == 'admin' ? 'Pesanan Terbaru (Semua)' : 'Pesanan Terakhir Saya' }}
                </h3>
                <a href="{{ Auth::user()->role == 'admin' ? route('admin.orders.index') : route('order.history') }}" class="text-sm text-red-600 hover:text-red-800 font-semibold">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Pembeli</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data['recent_orders'] as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="font-medium">#{{ $order->order_code ?? $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td class="text-red-600 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>
                                <span class="status-badge 
                                    @if($order->status == 'completed') bg-green-100 text-green-800
                                    @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-6">Belum ada transaksi terbaru</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>