<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                </div>
                <div>
                    <h2 class="font-bold text-xl text-gray-800">Laporan Keuangan Bulanan</h2>
                    <p class="text-sm text-gray-500 mt-1">Analisis pendapatan dan performa penjualan</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Grafik dan Filter -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Analisis Pendapatan Bulanan</h3>
                        <p class="text-sm text-gray-500 mt-1">Visualisasi performa keuangan berdasarkan waktu</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-gradient-to-r from-blue-500 to-blue-600"></div>
                            <span class="text-sm text-gray-600">Pendapatan</span>
                        </div>
                        <button id="toggleChart" class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-exchange-alt mr-1"></i> Ubah Grafik
                        </button>
                    </div>
                </div>

                <div class="relative h-80">
                    <canvas id="financeChart"></canvas>
                </div>

                <!-- Chart Legend -->
                <div class="flex flex-wrap gap-4 mt-6 pt-6 border-t border-gray-100">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded bg-gradient-to-r from-blue-500 to-blue-600"></div>
                        <span class="text-sm text-gray-700">Pendapatan Harian</span>
                        <span class="text-sm font-semibold text-gray-900">
                            Rp {{ number_format(array_sum($totals), 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded bg-gradient-to-r from-green-500 to-green-600"></div>
                        <span class="text-sm text-gray-700">Pendapatan Tertinggi</span>
                        <span class="text-sm font-semibold text-gray-900">
                            Rp {{ number_format(max($totals), 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded bg-gradient-to-r from-gray-400 to-gray-500"></div>
                        <span class="text-sm text-gray-700">Pendapatan Terendah</span>
                        <span class="text-sm font-semibold text-gray-900">
                            Rp {{ number_format(min($totals), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Detail Transaksi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Detail Transaksi Selesai</h3>
                            <p class="text-sm text-gray-500 mt-1">Daftar lengkap transaksi yang telah berhasil</p>
                        </div>
                    </div>
                </div>

                @if($transactions->isEmpty())
                <div class="p-12 text-center">
                    <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-receipt text-gray-400 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada transaksi</h4>
                    <p class="text-gray-500 max-w-md mx-auto">
                        Data transaksi akan muncul di sini setelah pelanggan melakukan pembelian.
                    </p>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <span>ID Transaksi</span>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <span>Tanggal</span>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <span>Pembeli</span>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <span>Total</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($transactions as $trx)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="font-mono text-sm text-gray-900 font-medium">
                                        #{{ str_pad($trx->id, 6, '0', STR_PAD_LEFT) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($trx->created_at)->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold">
                                            {{ strtoupper(substr($trx->user->name ?? 'G', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 text-sm">
                                                {{ $trx->user->name ?? 'Guest' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $trx->user->email ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">
                                        Rp {{ number_format($trx->total_amount, 0, ',', '.') }}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right font-semibold text-gray-700">
                                    Total Keseluruhan:
                                </td>
                                <td colspan="2" class="px-6 py-4 font-bold text-lg text-gray-900">
                                    Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Detail Transaksi -->
    <div id="transactionModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Detail Transaksi</h3>
                    <button onclick="closeTransactionModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
                <div id="modalContent">
                    <!-- Content will be loaded here -->
                    <div class="animate-pulse">
                        <div class="h-4 bg-gray-200 rounded w-3/4 mb-4"></div>
                        <div class="h-4 bg-gray-200 rounded w-1/2 mb-2"></div>
                        <div class="h-4 bg-gray-200 rounded w-1/4 mb-6"></div>
                        <div class="h-10 bg-gray-200 rounded w-full mb-2"></div>
                        <div class="h-10 bg-gray-200 rounded w-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @if(!isset($fontAwesomeLoaded))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @php $fontAwesomeLoaded = true @endphp
    @endif

    <style>
        /* Custom styles */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-enter {
            animation: fadeIn 0.3s ease-out;
        }

        /* Scrollbar styling */
        .overflow-x-auto {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }

        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Responsive table */
        @media (max-width: 1024px) {
            table {
                min-width: 1200px;
            }
        }
    </style>

    <script>
        // Chart configuration
        let chartType = 'bar';
        let financeChart;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize chart
            initChart();

            // Search functionality
            const searchInput = document.getElementById('searchTransaction');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase().trim();
                    const rows = document.querySelectorAll('tbody tr');

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });
            }

            // Toggle chart type
            document.getElementById('toggleChart').addEventListener('click', function() {
                chartType = chartType === 'bar' ? 'line' : 'bar';
                financeChart.destroy();
                initChart();

                // Update button text
                const icon = chartType === 'bar' ? 'fa-exchange-alt' : 'fa-exchange-alt';
                this.innerHTML = `<i class="fas ${icon} mr-1"></i> Ubah ke ${chartType === 'bar' ? 'Garis' : 'Batang'}`;
            });

            // Period filter
            document.getElementById('periodSelect').addEventListener('change', function() {
                if (this.value === 'custom') {
                    // In real app, show date picker modal
                    alert('Fitur periode kustom akan segera tersedia');
                    this.value = 'monthly';
                } else {
                    // Reload data based on selected period
                    window.location.href = '?period=' + this.value;
                }
            });
        });

        function initChart() {
            const ctx = document.getElementById('financeChart').getContext('2d');

            // Gradient for line chart
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0.1)');

            financeChart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: JSON.parse(`{!! json_encode($labels) !!}`),
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: JSON.parse(`{!! json_encode($totals) !!}`),
                        backgroundColor: chartType === 'bar' ?
                            'rgba(59, 130, 246, 0.7)' :
                            gradient,
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: chartType === 'bar' ? 0 : 2,
                        fill: chartType === 'line',
                        tension: 0.4,
                        borderRadius: chartType === 'bar' ? 6 : 0,
                        pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(1) + ' Jt';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + ' Rb';
                                    }
                                    return 'Rp ' + value;
                                },
                                padding: 10
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                padding: 10
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }

        function viewTransactionDetail(id) {
            // In real app, fetch transaction detail via AJAX
            // For demo, show sample data
            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = `
                <div class="space-y-6">
                    <!-- Header -->
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Transaksi #${String(id).padStart(6, '0')}</h4>
                            <p class="text-sm text-gray-500">Detail informasi transaksi</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                            Sukses
                        </span>
                    </div>
                    
                    <!-- Info Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h5 class="text-sm font-medium text-gray-500 mb-2">Informasi Pembeli</h5>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="font-medium text-gray-900">John Doe</p>
                                <p class="text-sm text-gray-600">john@example.com</p>
                                <p class="text-sm text-gray-600 mt-2">+62 812 3456 7890</p>
                            </div>
                        </div>
                        
                        <div>
                            <h5 class="text-sm font-medium text-gray-500 mb-2">Informasi Transaksi</h5>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-900">
                                    <span class="font-medium">Tanggal:</span> 
                                    15 Des 2023 14:30
                                </p>
                                <p class="text-sm text-gray-900 mt-2">
                                    <span class="font-medium">Metode Pembayaran:</span> 
                                    Transfer Bank
                                </p>
                                <p class="text-sm text-gray-900 mt-2">
                                    <span class="font-medium">Status:</span> 
                                    <span class="text-green-600 font-medium">Berhasil</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Items -->
                    <div>
                        <h5 class="text-sm font-medium text-gray-500 mb-2">Produk yang Dibeli</h5>
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                <div class="grid grid-cols-12 gap-4 text-sm font-medium text-gray-700">
                                    <div class="col-span-6">Produk</div>
                                    <div class="col-span-2 text-center">Qty</div>
                                    <div class="col-span-2 text-right">Harga</div>
                                    <div class="col-span-2 text-right">Subtotal</div>
                                </div>
                            </div>
                            <div class="p-4 space-y-3">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-6">
                                        <p class="font-medium text-gray-900">Nama Produk 1</p>
                                        <p class="text-sm text-gray-500">Kategori: Elektronik</p>
                                    </div>
                                    <div class="col-span-2 text-center">2</div>
                                    <div class="col-span-2 text-right">Rp 500.000</div>
                                    <div class="col-span-2 text-right font-medium">Rp 1.000.000</div>
                                </div>
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-6">
                                        <p class="font-medium text-gray-900">Nama Produk 2</p>
                                        <p class="text-sm text-gray-500">Kategori: Fashion</p>
                                    </div>
                                    <div class="col-span-2 text-center">1</div>
                                    <div class="col-span-2 text-right">Rp 250.000</div>
                                    <div class="col-span-2 text-right font-medium">Rp 250.000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Summary -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-700">Subtotal</span>
                            <span class="font-medium">Rp 1.250.000</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-700">Pengiriman</span>
                            <span class="font-medium">Rp 25.000</span>
                        </div>
                        <div class="flex justify-between items-center pt-3 border-t border-gray-300">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-lg font-bold text-gray-900">Rp 1.275.000</span>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex gap-3 pt-4 border-t border-gray-200">
                        <button class="flex-1 px-4 py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">
                            <i class="fas fa-print mr-2"></i> Cetak Invoice
                        </button>
                        <button class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg font-medium hover:bg-gray-50 transition">
                            <i class="fas fa-download mr-2"></i> Unduh PDF
                        </button>
                    </div>
                </div>
            `;

            // Show modal
            const modal = document.getElementById('transactionModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex', 'modal-enter');
        }

        function closeTransactionModal() {
            const modal = document.getElementById('transactionModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function printReport() {
            window.print();
        }

        function exportReport() {
            alert('Laporan akan diekspor dalam format PDF/Excel');
            // In real app, implement export functionality
        }

        // Close modal when clicking outside
        document.getElementById('transactionModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeTransactionModal();
            }
        });
    </script>
</x-app-layout>