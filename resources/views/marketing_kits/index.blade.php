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
        <div class="flex justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Marketing Kit') }}
                </h2>
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

        /* Card Hover & Pointer */
        .card-hover {
            transition: transform .28s cubic-bezier(.4, 0, .2, 1), box-shadow .28s;
            will-change: transform;
            cursor: pointer;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, .12);
        }

        .media-container {
            transition: transform .45s ease;
            position: relative;
            height: 200px;
            overflow: hidden;
            background: #111827;
        }

        .card-hover:hover .media-container {
            transform: scale(1.03);
        }

        .media-container img,
        .media-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Buttons */
        .copy-btn,
        .download-btn,
        .edit-btn,
        .delete-btn {
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
            font-size: 13px;
        }

        .copy-btn {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .copy-btn:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }

        .download-btn {
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%);
            color: white;
        }

        .download-btn:hover {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            transform: translateY(-2px);
        }

        .edit-btn {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fbbf24;
        }

        .delete-btn {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
        }

        /* Month Header */
        .month-header {
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 1.5rem;
        }

        /* Caption */
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

        /* Grid */
        .kits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        @media(max-width:640px) {
            .kits-grid {
                grid-template-columns: 1fr;
            }
        }

        /* File Type Badge */
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

        /* Card Content */
        .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            min-height: 240px;
        }

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

        .action-buttons,
        .admin-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 8px;
        }

        .admin-actions {
            grid-column: span 2;
        }

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

        /* MODAL STYLES (BARU) */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 9999;
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
            width: 95%;
            max-width: 900px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: scale(0.95);
            transition: transform 0.3s ease;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        @media(min-width: 768px) {
            .modal-content {
                flex-direction: row;
                height: 600px;
            }
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .modal-media {
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 300px;
            position: relative;
        }

        @media(min-width: 768px) {
            .modal-media {
                width: 60%;
                height: 100%;
            }
        }

        .modal-media img,
        .modal-media video {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .modal-info {
            padding: 32px;
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            color: white;
            transition: background 0.2s;
            z-index: 10;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .modal-close-mobile {
            position: absolute;
            top: 16px;
            right: 16px;
            background: #f3f4f6;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            color: #374151;
            z-index: 10;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            right: 20px;
            top: 20px;
            z-index: 10000;
            min-width: 280px;
            padding: 14px 18px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            animation: toastIn 0.3s;
            color: white;
        }

        .toast-success {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
        }

        .toast-info {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
        }

        .toast-download {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes toastOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100%);
            }
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
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">{{ $monthYear }}</h3>
                    </div>
                </div>

                <div class="kits-grid">
                    @foreach($monthKits as $kit)
                    @php
                    $extension = strtolower(pathinfo($kit->image_path, PATHINFO_EXTENSION));
                    $isVideo = in_array($extension, ['mp4','mov','avi','mkv']);
                    $isImage = in_array($extension, ['jpg','jpeg','png','gif','webp']);
                    $mediaUrl = asset('storage/' . $kit->image_path);
                    @endphp

                    <article class="card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden flex flex-col h-full"
                        onclick="openModal(this)"
                        data-title="{{ $kit->title }}"
                        data-caption="{{ $kit->caption }}"
                        data-date="{{ $kit->created_at->format('d M Y') }}"
                        data-type="{{ $isVideo ? 'video' : 'image' }}"
                        data-src="{{ $mediaUrl }}"
                        data-ext="{{ strtoupper($extension) }}">

                        <div class="media-container">
                            @if($isVideo)
                            <video muted playsinline class="w-full h-full object-cover">
                                <source src="{{ $mediaUrl }}" type="video/{{ $extension }}">
                            </video>
                            <div class="absolute inset-0 flex items-center justify-center bg-black/40 pointer-events-none">
                                <div class="bg-white/20 p-3 rounded-full backdrop-blur-sm">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                                    </svg>
                                </div>
                            </div>
                            @else
                            <img src="{{ $mediaUrl }}" loading="lazy" class="w-full h-full object-cover">
                            @endif
                            <div class="file-type-badge">{{ strtoupper($extension) }}</div>
                        </div>

                        <div class="card-body">
                            <header>
                                <h4 class="card-title">{{ $kit->title }}</h4>
                                <div class="flex items-center gap-2 mt-2 text-sm text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $kit->created_at->format('d M Y') }}
                                </div>
                            </header>

                            <div class="mt-2 flex-1">
                                <div class="caption-container" id="caption-{{ $kit->id }}">
                                    <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $kit->caption }}</p>
                                </div>
                            </div>

                            <div class="mt-4" onclick="event.stopPropagation()">
                                <div class="action-buttons">
                                    {{-- Copy Button --}}
                                    @if(Auth::user()->role === 'reseller')
                                    <button type="button" onclick="copyCaption('caption-{{ $kit->id }}')" class="copy-btn">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <span>Copy</span>
                                    </button>

                                    {{-- Download Button --}}
                                    <a href="{{ $mediaUrl }}" download onclick="showToast('Mengunduh: {{ addslashes($kit->title) }}', 'download')" class="download-btn">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span>Unduh</span>
                                    </a>
                                    @endif

                                    @if(Auth::user()->role === 'admin')
                                    <div class="admin-actions">
                                        <a href="{{ route('marketing-kits.edit', $kit->id) }}" class="edit-btn flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span>Edit</span>
                                        </a>
                                        <form action="{{ route('marketing-kits.destroy', $kit->id) }}" method="POST" onsubmit="return confirm('Yakin hapus materi ini?');" class="h-full w-full">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="delete-btn w-full flex items-center justify-center gap-2">
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

            @if($kits->count() == 0)
            <div class="text-center py-20">
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum ada materi promosi</h3>
                <p class="text-gray-600">Upload materi pertama Anda untuk memulai promosi.</p>
            </div>
            @endif
        </div>
    </div>

    <div id="kitModal" class="modal-overlay" onclick="closeModal(event)">
        <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <div class="modal-media" id="modalMediaContainer">
                <button class="modal-close" type="button" aria-label="Tutup" onclick="closeModal(event, true)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="modal-info h-full flex flex-col">
                <div>
                    <span id="modalExt" class="inline-block bg-indigo-100 text-indigo-700 text-xs font-bold px-2 py-1 rounded mb-2">JPG</span>
                    <h2 id="modalTitle" class="text-2xl font-bold text-gray-900 mb-2">Judul Materi</h2>
                    <p id="modalDate" class="text-sm text-gray-500 mb-6 flex items-center gap-2">12 Dec 2025</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 flex-grow overflow-y-auto">
                    <p id="modalCaption" class="text-gray-700 leading-relaxed whitespace-pre-line text-sm"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(element) {
            const data = {
                title: element.getAttribute('data-title'),
                caption: element.getAttribute('data-caption'),
                date: element.getAttribute('data-date'),
                type: element.getAttribute('data-type'),
                src: element.getAttribute('data-src'),
                ext: element.getAttribute('data-ext')
            };

            document.getElementById('modalTitle').innerText = data.title;
            document.getElementById('modalCaption').innerText = data.caption;

            document.getElementById('modalDate').innerHTML = `
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> 
                ${data.date}
            `;

            document.getElementById('modalExt').innerText = data.ext;

            const container = document.getElementById('modalMediaContainer');
            container.innerHTML = '';

            if (data.type === 'video') {
                const video = document.createElement('video');
                video.controls = true;
                video.autoplay = true;
                video.className = 'w-full h-full object-contain';
                const source = document.createElement('source');
                source.src = data.src;
                video.appendChild(source);
                container.appendChild(video);
            } else {
                const img = document.createElement('img');
                img.src = data.src;
                img.className = 'w-full h-full object-contain';
                container.appendChild(img);
            }

            const modal = document.getElementById('kitModal');
            modal.style.display = 'flex';
            setTimeout(() => modal.classList.add('active'), 10);
            document.body.style.overflow = 'hidden';
        }

        function closeModal(event, force = false) {
            if (force || event.target.id === 'kitModal') {
                const modal = document.getElementById('kitModal');
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.style.display = 'none';
                    document.getElementById('modalMediaContainer').innerHTML = '';
                }, 300);
                document.body.style.overflow = 'auto';
            }
        }

        let toastTimeout;

        function showToast(message, type = 'success') {
            if (toastTimeout) clearTimeout(toastTimeout);

            const existingToast = document.querySelector('.toast');
            if (existingToast) existingToast.remove();

            const toast = document.createElement('div');
            let bgClass = type === 'download' ? 'toast-download' : (type === 'info' ? 'toast-info' : 'toast-success');
            toast.className = `toast ${bgClass}`;

            let icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';

            toast.innerHTML = `${icon} <span class="font-medium text-sm">${message}</span>`;
            document.body.appendChild(toast);

            toastTimeout = setTimeout(() => {
                toast.style.animation = 'toastOut 0.3s forwards';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function copyCaption(elementId) {
            if (event) event.stopPropagation();

            const el = document.getElementById(elementId);
            if (el) {
                const text = el.innerText || el.textContent;
                navigator.clipboard.writeText(text.trim()).then(() => {
                    showToast('Caption berhasil disalin!', 'success');
                }).catch(() => {
                    // Fallback manual
                    const ta = document.createElement('textarea');
                    ta.value = text;
                    document.body.appendChild(ta);
                    ta.select();
                    document.execCommand('copy');
                    document.body.removeChild(ta);
                    showToast('Caption berhasil disalin!', 'success');
                });
            }
        }

        function handleDownload(title) {
            if (event) event.stopPropagation();
            showToast(`Mengunduh: ${title}`, 'download');
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.media-container video').forEach(v => {
                v.addEventListener('mouseenter', () => v.play());
                v.addEventListener('mouseleave', () => v.pause());
            });
        });
    </script>
</x-app-layout>