<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Marketing Kit Promosi') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Koleksi materi promosi untuk penjualan camilan</p>
            </div>

            @if(Auth::user()->role === 'admin')
            <a href="{{ route('marketing-kits.create') }}"
                class="admin-primary-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Upload Baru</span>
            </a>
            @endif
        </div>
    </x-slot>

    <style>
        .admin-primary-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        /* -- Layout adjustments -- */
        .page-wrap {
            padding-top: 32px;
            padding-bottom: 48px;
        }

        .container-inner {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media(min-width: 768px) {
            .container-inner {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        /* Card hover / media */
        .card-hover {
            transition: transform .28s cubic-bezier(.4, 0, .2, 1), box-shadow .28s;
            will-change: transform;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, .12);
        }

        .media-container {
            transition: transform .45s ease;
        }

        .card-hover:hover .media-container {
            transform: scale(1.03);
        }

        /* Badges */
        .badge {
            backdrop-filter: blur(6px);
            background: rgba(0, 0, 0, 0.6);
        }

        /* Buttons */
        .copy-btn,
        .download-btn {
            transition: all .2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 10px;
        }

        .copy-btn {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .copy-btn:hover {
            background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Download button */
        .download-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: 1px solid #059669;
        }

        .download-btn:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* Admin buttons */
        .edit-btn {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid #fbbf24;
        }

        .delete-btn {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid #f87171;
        }

        /* Month header */
        .month-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 1.5rem;
        }

        /* Caption fade */
        .caption-container {
            max-height: 84px;
            overflow: hidden;
            position: relative;
        }

        .caption-container::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 28px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            pointer-events: none;
        }

        /* Animate on entry */
        .fade-in {
            animation: fadeIn .46s ease-out both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Grid like e-comm */
        .kits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        @media(max-width:768px) {
            .kits-grid {
                grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
                gap: 20px;
            }
        }

        @media(max-width:640px) {
            .kits-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        /* Media height and object fit */
        .media-container {
            height: 200px;
            display: block;
            overflow: hidden;
            background: linear-gradient(135deg, #111827, #0f172a);
            position: relative;
        }

        .media-container img,
        .media-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Card content spacing */
        .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            min-height: 240px;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            right: 20px;
            top: 20px;
            z-index: 9999;
            min-width: 280px;
            padding: 14px 18px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transform-origin: top right;
            animation: toastSlideIn 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .toast-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.95) 0%, rgba(5, 150, 105, 0.95) 100%);
            color: white;
        }

        .toast-info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.95) 0%, rgba(37, 99, 235, 0.95) 100%);
            color: white;
        }

        .toast-download {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.95) 0%, rgba(124, 58, 237, 0.95) 100%);
            color: white;
        }

        @keyframes toastSlideIn {
            0% {
                opacity: 0;
                transform: translateX(100%) scale(0.9);
            }

            70% {
                opacity: 1;
                transform: translateX(-10px) scale(1.02);
            }

            100% {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes toastSlideOut {
            0% {
                opacity: 1;
                transform: translateX(0) scale(1);
            }

            30% {
                opacity: 1;
                transform: translateX(-10px) scale(1.02);
            }

            100% {
                opacity: 0;
                transform: translateX(100%) scale(0.9);
            }
        }

        /* File type badge */
        .file-type-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            backdrop-filter: blur(4px);
        }

        /* Title styling */
        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            line-height: 1.3;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Action buttons container */
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 8px;
        }

        .admin-actions {
            grid-column: span 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 8px;
        }
    </style>

    <div class="page-wrap bg-gradient-to-b from-gray-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto container-inner px-4 sm:px-6 lg:px-8">

            {{-- Group by month --}}
            @php
            $groupedKits = $kits->groupBy(function($kit) {
            return $kit->created_at->format('F Y');
            });
            @endphp

            @foreach($groupedKits as $monthYear => $monthKits)
            <section class="mb-12 fade-in">
                <div class="month-header">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="bg-white/20 p-2 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white leading-tight">{{ $monthYear }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kits-grid">
                    @foreach($monthKits as $kit)
                    @php
                    $extension = strtolower(pathinfo($kit->image_path, PATHINFO_EXTENSION));
                    $isVideo = in_array($extension, ['mp4','mov','avi','mkv']);
                    $isImage = in_array($extension, ['jpg','jpeg','png','gif','webp']);
                    @endphp

                    <article class="card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden flex flex-col h-full">
                        <a href="{{ route('marketing-kits.show', $kit->id) }}" class="block" aria-label="Lihat {{ $kit->title }}">
                            <div class="media-container">
                                @if($isVideo)
                                <video muted playsinline preload="metadata" class="w-full h-full object-cover" poster="{{ $kit->thumbnail_url ?? '' }}">
                                    <source src="{{ asset('storage/' . $kit->image_path) }}" type="video/{{ $extension }}">
                                </video>
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <div class="bg-black/40 p-3 rounded-full">
                                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path d="M9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                                        </svg>
                                    </div>
                                </div>
                                @elseif($isImage)
                                <img src="{{ asset('storage/' . $kit->image_path) }}" alt="{{ $kit->title }}" loading="lazy" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-800 to-gray-900">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-gray-400 text-sm mt-2">{{ strtoupper($extension) }}</p>
                                    </div>
                                </div>
                                @endif

                                <div class="file-type-badge">
                                    {{ strtoupper($extension) }}
                                </div>
                            </div>
                        </a>

                        <div class="card-body">
                            <header>
                                <h4 class="card-title" title="{{ $kit->title }}">{{ $kit->title }}</h4>
                                <div class="flex items-center gap-4 mt-2 small muted">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $kit->created_at->format('d M Y') }}
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $kit->uploader->name ?? 'Admin' }}
                                    </span>
                                </div>
                            </header>

                            <div class="mt-2 flex-1">
                                {{-- PERBAIKAN: Tambah ID ke caption container --}}
                                <div class="caption-container" id="caption-{{ $kit->id }}">
                                    <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">
                                        {{ $kit->caption }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="action-buttons">
                                    {{-- Copy Button - PERBAIKAN: Menggunakan ID yang benar --}}
                                    <button type="button"
                                        onclick="copyCaption('caption-{{ $kit->id }}')"
                                        class="copy-btn">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <span>Copy</span>
                                    </button>

                                    {{-- Download Button --}}
                                    <a href="{{ asset('storage/' . $kit->image_path) }}" download
                                        onclick="showDownloadToast('{{ addslashes($kit->title) }}')"
                                        class="download-btn"
                                        title="Unduh {{ $kit->title }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span>Unduh</span>
                                    </a>

                                    {{-- Admin actions --}}
                                    @if(Auth::user()->role === 'admin')
                                    <div class="admin-actions">
                                        <a href="{{ route('marketing-kits.edit', $kit->id) }}"
                                            class="edit-btn flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span>Edit</span>
                                        </a>

                                        <form action="{{ route('marketing-kits.destroy', $kit->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus materi ini?');" class="h-full">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="delete-btn w-full flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>
            @endforeach

            {{-- Empty state --}}
            @if($kits->count() == 0)
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <div class="bg-gradient-to-br from-indigo-100 to-purple-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-14 h-14 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum ada materi promosi</h3>
                    <p class="text-gray-600 mb-8">Upload materi pertama Anda untuk memulai promosi.</p>
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('marketing-kits.create') }}"
                        class="inline-flex items-center gap-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3.5 rounded-xl font-bold hover:from-indigo-700 hover:to-purple-700 shadow-lg hover:shadow-xl transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Upload Materi Pertama</span>
                    </a>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>

    <script>
        // Fungsi copy caption yang diperbaiki
        function copyCaption(elementId) {
            // Cari elemen dengan ID yang diberikan
            const captionElement = document.getElementById(elementId);

            if (!captionElement) {
                console.error('Element tidak ditemukan:', elementId);
                showToast('Gagal menemukan teks caption', 'info');
                return;
            }

            // Ambil teks dari elemen (dari elemen p di dalamnya)
            const textElement = captionElement.querySelector('p');
            if (!textElement) {
                console.error('Elemen teks tidak ditemukan di:', elementId);
                showToast('Gagal menemukan teks caption', 'info');
                return;
            }

            const captionText = textElement.textContent || textElement.innerText;

            if (!captionText.trim()) {
                showToast('Tidak ada teks caption', 'info');
                return;
            }

            // Gunakan Clipboard API modern
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(captionText.trim()).then(() => {
                    showToast('Caption berhasil disalin!', 'success');
                }).catch(err => {
                    console.error('Clipboard API error:', err);
                    fallbackCopyText(captionText.trim());
                });
            } else {
                // Fallback untuk browser lama
                fallbackCopyText(captionText.trim());
            }
        }

        // Fallback copy method untuk browser lama
        function fallbackCopyText(text) {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            textArea.style.top = '-999999px';
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                const successful = document.execCommand('copy');
                document.body.removeChild(textArea);
                if (successful) {
                    showToast('Caption berhasil disalin!', 'success');
                } else {
                    showToast('Gagal menyalin teks', 'info');
                }
            } catch (err) {
                console.error('Fallback copy error:', err);
                document.body.removeChild(textArea);
                showToast('Gagal menyalin teks', 'info');
            }
        }

        // Download toast
        function showDownloadToast(title) {
            const decodedTitle = title.replace(/\\'/g, "'");
            showToast(`Mengunduh: ${decodedTitle}`, 'download');
        }

        // Toast notification system
        let toastTimeout;

        function showToast(message, type = 'success') {
            // Clear existing timeout
            if (toastTimeout) {
                clearTimeout(toastTimeout);
            }

            // Remove existing toast
            const existingToast = document.querySelector('.toast');
            if (existingToast) {
                existingToast.style.animation = 'toastSlideOut 0.3s forwards';
                setTimeout(() => existingToast.remove(), 300);
            }

            // Create new toast
            const toast = document.createElement('div');
            let toastClass = 'toast';

            switch (type) {
                case 'info':
                    toastClass += ' toast-info';
                    break;
                case 'download':
                    toastClass += ' toast-download';
                    break;
                default:
                    toastClass += ' toast-success';
            }

            toast.className = toastClass;

            // Determine icon based on type
            let iconSvg = '';
            switch (type) {
                case 'info':
                    iconSvg = `
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    `;
                    break;
                case 'download':
                    iconSvg = `
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    `;
                    break;
                default:
                    iconSvg = `
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    `;
            }

            toast.innerHTML = `
                ${iconSvg}
                <div style="flex: 1; font-weight: 500; font-size: 14px;">${message}</div>
                <button onclick="this.parentElement.remove()" style="background: transparent; border: none; color: white; cursor: pointer; padding: 4px; opacity: 0.7;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;

            document.body.appendChild(toast);

            // Auto remove after 4 seconds
            toastTimeout = setTimeout(() => {
                toast.style.animation = 'toastSlideOut 0.3s forwards';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            // Video hover play/pause
            document.querySelectorAll('video').forEach(video => {
                video.addEventListener('mouseenter', () => {
                    video.play().catch(() => {
                        // Autoplay blocked, ignore
                    });
                });
                video.addEventListener('mouseleave', () => {
                    video.pause();
                });
            });

            // Animate cards on load
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 80);
            });

            // Tambah efek klik pada tombol copy
            document.querySelectorAll('.copy-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    // Efek visual saat diklik
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            .copy-btn:active {
                transform: scale(0.95);
                transition: transform 0.1s;
            }
        `;
        document.head.appendChild(style);
    </script>
</x-app-layout>