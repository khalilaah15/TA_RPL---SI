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
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Edit Marketing Kit: {{ $marketingKit->title }}</h2>
            </div>

            <a href="{{ route('marketing-kits.index') }}" class="flex items-center gap-2 text-white hover:text-white font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </x-slot>

    <style>
        :root {
            --page-max-w: 880px;
            --card-radius: 16px;
            --border: #e6e7eb;
            --muted: #6b7280;
            --accent: #4f46e5;
            --success: #10b981;
        }

        body {
            background: linear-gradient(180deg, #f7fbff 0, #ffffff 100%);
        }

        .form-container {
            max-width: var(--page-max-w);
            margin: 2.25rem auto;
            padding: 1.25rem;
        }

        .form-card {
            background: #fff;
            border-radius: var(--card-radius);
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 8px 28px rgba(15, 23, 42, 0.06);
        }

        .form-header {
            padding: 1.25rem 1.5rem;
            display: flex;
            gap: .75rem;
            align-items: center;
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%);
            color: white;
            border-bottom: 1px solid #f3f4f6;
        }

        .form-header h3 {
            font-size: 1.125rem;
            font-weight: 700;
            display: flex;
            gap: .6rem;
            align-items: center;
        }

        .form-body {
            padding: 1.75rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: .5rem;
            font-weight: 700;
            color: #374151;
            font-size: .975rem;
        }

        .required {
            color: #ef4444;
            margin-left: .35rem;
            font-weight: 700;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1.75px solid var(--border);
            font-size: .98rem;
            background: #fff;
            transition: box-shadow .18s, border-color .18s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.08);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .file-upload {
            position: relative;
            margin-top: .5rem;
        }

        .file-input {
            position: absolute;
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            z-index: -1;
        }

        .file-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 28px 20px;
            border-radius: 14px;
            border: 2.5px dashed #d1d5db;
            background: #fbfdff;
            cursor: pointer;
            text-align: center;
            transition: background .18s, border-color .18s, transform .12s;
        }

        .file-label:hover {
            background: #f4f6ff;
            transform: translateY(-3px);
            border-color: #9ca3af;
        }

        .file-label.drag-over {
            background: #eef2ff;
            border-color: var(--accent);
        }

        .upload-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: linear-gradient(135deg, #e6eeff, #d6d8ff);
            color: var(--accent);
        }

        .image-preview,
        .media-preview {
            margin-top: 1rem;
            text-align: center;
        }

        .preview-container {
            max-width: 420px;
            margin: 0 auto;
            position: relative;
        }

        .preview-image,
        .preview-video {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(2, 6, 23, 0.04);
            background: #000;
        }

        .remove-preview {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 36px;
            height: 36px;
            border-radius: 999px;
            border: none;
            background: #ef4444;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.18);
        }

        .form-actions {
            display: flex;
            gap: .75rem;
            justify-content: flex-end;
            padding: 1.15rem 1.5rem;
            border-top: 1px solid #f3f4f6;
            background: #fbfbfc;
        }

        @media(max-width:768px) {
            .form-actions {
                flex-direction: column;
            }

            .form-actions>* {
                width: 100%;
            }
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--success) 0, #059669 100%);
            color: white;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 700;
            border: none;
            display: inline-flex;
            gap: .6rem;
            align-items: center;
            justify-content: center;
        }

        .cancel-btn {
            background: #fff;
            border: 1px solid var(--border);
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            color: #374151;
            display: inline-flex;
            gap: .6rem;
            align-items: center;
        }

        .form-hint {
            font-size: .9rem;
            color: var(--muted);
            margin-top: .4rem;
            display: flex;
            gap: .5rem;
            align-items: center;
        }

        .text-muted {
            color: var(--muted);
            font-size: .95rem;
        }

        .error-message {
            color: #ef4444;
            font-weight: 600;
            font-size: .93rem;
            margin-top: .5rem;
            display: flex;
            gap: .5rem;
            align-items: center;
        }

        .loader {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.35);
            border-top-color: rgba(255, 255, 255, 0.95);
            animation: spin 1s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="form-container">
        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <strong class="block font-bold text-red-700">Oops! Ada kesalahan.</strong>
            <p class="text-sm text-red-700 mt-1">Mohon periksa kembali inputan Anda.</p>
            <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-card">
            <div class="form-header">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <h3>Perbarui Marketing Kit</h3>
            </div>

            <form id="marketingEditForm" action="{{ route('marketing-kits.update', $marketingKit->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="form-body">
                    {{-- Judul --}}
                    <div class="form-group">
                        <label class="form-label">Judul Promosi <span class="required">*</span></label>
                        <input type="text" name="title" class="form-input @error('title') input-error @enderror" maxlength="150" required value="{{ old('title', $marketingKit->title) }}">
                        @error('title')
                        <div class="error-message">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Caption --}}
                    <div class="form-group">
                        <label class="form-label">Caption (Untuk di-copy Reseller) <span class="required">*</span></label>
                        <textarea name="caption" class="form-input form-textarea @error('caption') input-error @enderror" required rows="5">{{ old('caption', $marketingKit->caption) }}</textarea>
                        @error('caption')
                        <div class="error-message">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- File (opsional) --}}
                    <div class="form-group">
                        <label class="form-label">Ganti File Promosi (Gambar / Video — Opsional)</label>

                        <div class="form-hint">Kosongkan jika tidak ingin mengganti file. Format: JPG, PNG, MP4. Maks: 20MB.</div>

                        <div class="file-upload">
                            <input type="file" id="marketingFile" name="image_path" class="file-input @error('image_path') input-error @enderror" accept="image/*,video/*">
                            <label for="marketingFile" id="marketingFileLabel" class="file-label" aria-hidden="true">
                                <div class="upload-icon" aria-hidden="true">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div style="font-weight:600; color:#111827;">Klik untuk pilih file baru atau drag & drop di sini</div>
                                    <div class="text-muted" style="margin-top:.25rem;">JPG, PNG, MP4 — Maks 20MB</div>
                                </div>
                            </label>
                        </div>

                        @error('image_path')
                        <div class="error-message" style="margin-top:.75rem;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror

                        {{-- existing file preview (image or video) --}}
                        <div id="marketingPreview" class="media-preview" style="display:none;">
                            <div class="preview-container" id="marketingPreviewContainer">
                                <!-- preview injected here -->
                            </div>
                        </div>

                        {{-- store existing file url and mime-type in hidden DOM for JS --}}
                        <div id="existingMarketingFile" data-url="{{ $marketingKit->image_path ? asset('storage/' . $marketingKit->image_path) : '' }}" data-mime="{{ $marketingKit->image_path ? \Illuminate\Support\Facades\File::mimeType(storage_path('app/public/' . $marketingKit->image_path)) : '' }}" style="display:none;"></div>

                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('marketing-kits.index') }}" class="cancel-btn" aria-label="Batal">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>

                    <button type="submit" class="submit-btn" id="submitBtn" aria-label="Simpan Perubahan">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const fileInput = document.getElementById('marketingFile');
            const fileLabel = document.getElementById('marketingFileLabel');
            const previewWrapper = document.getElementById('marketingPreviewContainer');
            const previewArea = document.getElementById('marketingPreview');
            const existingEl = document.getElementById('existingMarketingFile');
            const existingUrl = existingEl ? existingEl.dataset.url : '';
            const existingMime = existingEl ? existingEl.dataset.mime : '';

            function clearPreview() {
                previewWrapper.innerHTML = '';
                previewArea.style.display = 'none';
                fileLabel.style.display = 'flex';
                fileLabel.classList.remove('drag-over');
            }

            function showPreviewImage(src) {
                previewWrapper.innerHTML = '';
                const img = document.createElement('img');
                img.src = src;
                img.alt = 'Preview';
                img.className = 'preview-image';
                previewWrapper.appendChild(img);

                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'remove-preview';
                btn.onclick = () => {
                    clearPreview();
                    fileInput.value = '';
                };
                btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
                previewWrapper.appendChild(btn);

                previewArea.style.display = 'block';
                fileLabel.style.display = 'none';
            }

            function showPreviewVideo(src) {
                previewWrapper.innerHTML = '';
                const video = document.createElement('video');
                video.src = src;
                video.controls = true;
                video.className = 'preview-video';
                previewWrapper.appendChild(video);

                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'remove-preview';
                btn.onclick = () => {
                    clearPreview();
                    fileInput.value = '';
                };
                btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
                previewWrapper.appendChild(btn);

                previewArea.style.display = 'block';
                fileLabel.style.display = 'none';
            }

            // show existing file on load (if any)
            if (existingUrl) {
                // try to infer by mime; fallback check extension
                const imgTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];
                const videoTypes = ['video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/x-matroska'];

                if (existingMime && imgTypes.includes(existingMime)) showPreviewImage(existingUrl);
                else if (existingMime && videoTypes.includes(existingMime)) showPreviewVideo(existingUrl);
                else {
                    // fallback by extension
                    const ext = existingUrl.split('.').pop().toLowerCase();
                    if (['jpg', 'jpeg', 'png', 'webp', 'gif'].includes(ext)) showPreviewImage(existingUrl);
                    else showPreviewVideo(existingUrl);
                }
            }

            // drag & drop UX
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(ev => {
                fileLabel.addEventListener(ev, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });

            ['dragenter', 'dragover'].forEach(ev => {
                fileLabel.addEventListener(ev, () => fileLabel.classList.add('drag-over'));
            });

            ['dragleave', 'drop'].forEach(ev => {
                fileLabel.addEventListener(ev, () => fileLabel.classList.remove('drag-over'));
            });

            fileLabel.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                if (dt && dt.files && dt.files.length) {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(dt.files[0]);
                    fileInput.files = dataTransfer.files;
                    fileInput.dispatchEvent(new Event('change'));
                }
            });

            // change handler
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const file = this.files && this.files[0];
                    if (!file) {
                        clearPreview();
                        return;
                    }

                    const maxBytes = 20 * 1024 * 1024; // 20MB
                    if (file.size > maxBytes) {
                        alert('Ukuran file terlalu besar! Maksimal 20MB.');
                        this.value = '';
                        return;
                    }

                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];
                    const validVideoTypes = ['video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/x-matroska'];

                    if (![...validImageTypes, ...validVideoTypes].includes(file.type)) {
                        alert('Format file tidak didukung! Gunakan JPG / PNG / MP4.');
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        if (validImageTypes.includes(file.type)) showPreviewImage(ev.target.result);
                        else showPreviewVideo(ev.target.result);
                    };
                    reader.readAsDataURL(file);
                });
            }

            // expose remove function (in case needed)
            window.removeMarketingPreview = function() {
                fileInput.value = '';
                clearPreview();
            };
        })();

        // submit handler: client-side simple validation and UI lock
        (function() {
            const form = document.getElementById('marketingEditForm');
            if (!form) return;
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                const title = form.querySelector('input[name="title"]');
                const caption = form.querySelector('textarea[name="caption"]');

                if (!title.value || !String(title.value).trim()) {
                    alert('Judul wajib diisi.');
                    title.focus();
                    e.preventDefault();
                    return;
                }
                if (!caption.value || !String(caption.value).trim()) {
                    alert('Caption wajib diisi.');
                    caption.focus();
                    e.preventDefault();
                    return;
                }

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="loader" style="margin-right:.5rem;"></span><span>Menyimpan...</span>';
                // allow normal submit (server will process)
            });
        })();
    </script>
</x-app-layout>