<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                </div>
                Data Reseller Terdaftar
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Kontrol dan Filter -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="relative flex-1 lg:max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        </div>
                        <input type="text"
                            id="searchInput"
                            class="pl-10 w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="Cari reseller berdasarkan nama, domisili, atau kontak...">
                    </div>
                </div>
            </div>

            <!-- Tabel Data Reseller -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-max">
                        <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700">
                            <tr>
                                <th class="px-6 py-4 text-left">
                                    <div class="flex items-center gap-2 text-black font-semibold text-sm uppercase tracking-wide">
                                        <span>Reseller</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left">
                                    <div class="flex items-center gap-2 text-black font-semibold text-sm uppercase tracking-wide">
                                        <span>Kontak</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left">
                                    <div class="flex items-center gap-2 text-black font-semibold text-sm uppercase tracking-wide">
                                        <span>Domisili</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left">
                                    <span class="text-black font-semibold text-sm uppercase tracking-wide">Alamat Lengkap</span>
                                </th>
                                <th class="px-6 py-4 text-left">
                                    <div class="flex items-center gap-2 text-black font-semibold text-sm uppercase tracking-wide">
                                        <span>Bergabung</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($resellers as $reseller)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="min-w-0">
                                            <div class="font-semibold text-gray-900 truncate">{{ $reseller->name }}</div>
                                            <div class="text-sm text-gray-500">ID: RS-{{ str_pad($loop->iteration, 6, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($reseller->phone)
                                    <a href="https://wa.me/{{ $reseller->phone }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium transition">
                                        <i class="fab fa-whatsapp text-lg"></i>
                                        <span>{{ $reseller->phone }}</span>
                                    </a>
                                    @else
                                    <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 text-gray-700">
                                        <i class="fas fa-map-marker-alt text-gray-400 text-sm"></i>
                                        <span>{{ $reseller->domicile ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-700 max-w-xs line-clamp-2">
                                        {{ $reseller->address ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">
                                        {{ $reseller->created_at->format('d M Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500 mt-0.5">
                                        {{ $reseller->created_at->diffForHumans() }}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- CSS Styling -->
    <style>
        /* Animasi Fade In */
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

        /* Custom Select Arrow */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.25em 1.25em;
            padding-right: 2.5rem;
        }

        /* Line Clamp untuk teks panjang */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth scrolling untuk tabel */
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

        /* Responsif - Tabel */
        @media (max-width: 1024px) {
            table {
                min-width: 1200px;
            }
        }
    </style>

    <!-- Font Awesome -->
    @if(!isset($fontAwesomeLoaded))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @php $fontAwesomeLoaded = true @endphp
    @endif

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi Pencarian
            const searchInput = document.getElementById('searchInput');
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
        });
    </script>
</x-app-layout>