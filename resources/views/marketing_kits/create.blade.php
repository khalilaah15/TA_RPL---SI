<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Upload Marketing Kit') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Unggah gambar atau video promosi; caption disiapkan agar mudah disalin reseller.</p>
            </div>
            <a href="{{ route('marketing-kits.index') }}"
                class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </x-slot>

    <style>
        /* --- pakai style yang serupa dengan form produk --- */
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 24px;
        }
        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .form-header {
            padding: 28px 32px;
            border-bottom: 1px solid #f3f4f6;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .form-header h3 { font-size: 20px; font-weight: 700; display:flex; gap:12px; align-items:center; }
        .form-body { padding: 32px; }
        .form-group { margin-bottom: 24px; }
        .form-label { display:flex; gap:8px; font-size:15px; font-weight:600; color:#374151; margin-bottom:10px; align-items:center; }
        .required { color:#ef4444; font-size:18px; }
        .form-hint { font-size:13px; color:#6b7280; margin-top:6px; display:flex; gap:6px; align-items:center; }
        .form-input { width:100%; padding:14px 16px; border:2px solid #e5e7eb; border-radius:12px; font-size:15px; transition:all .3s; background:white; }
        .form-input:focus { outline:none; border-color:#4f46e5; box-shadow:0 0 0 4px rgba(79,70,229,0.1); }
        .form-textarea { min-height:120px; resize:vertical; line-height:1.5; }
        .file-upload { position:relative; }
        .file-input { position:absolute; width:0.1px; height:0.1px; opacity:0; overflow:hidden; z-index:-1; }
        .file-label {
            display:flex; flex-direction:column; align-items:center; justify-content:center; gap:16px;
            background:#f8fafc; border:3px dashed #d1d5db; border-radius:16px; padding:32px 20px; cursor:pointer; transition:all .3s; text-align:center;
        }
        .file-label:hover { background:#f1f5f9; border-color:#9ca3af; }
        .file-label.drag-over { background:#e0e7ff; border-color:#4f46e5; }
        .upload-icon { width:64px; height:64px; background:linear-gradient(135deg,#e0e7ff 0%,#c7d2fe 100%); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#4f46e5; }
        .preview-area { margin-top:18px; text-align:center; }
        .preview-media { max-width:100%; max-height:360px; border-radius:12px; border:2px solid #e5e7eb; box-shadow:0 4px 12px rgba(0,0,0,0.08); background:#000; display:inline-block; }
        .remove-preview { margin-top:8px; background:#ef4444; color:white; border:none; padding:8px 12px; border-radius:8px; cursor:pointer; }
        .form-actions { padding:24px; border-top:1px solid #f3f4f6; display:flex; gap:16px; justify-content:flex-end; background:#f9fafb; }
        .submit-btn { background:linear-gradient(135deg,#10b981 0%,#059669 100%); color:white; border:none; border-radius:12px; padding:12px 22px; font-weight:700; cursor:pointer; display:flex; gap:10px; align-items:center; min-width:160px; justify-content:center; }
        .cancel-btn { background:white; color:#374151; border:2px solid #d1d5db; border-radius:12px; padding:12px 22px; font-weight:600; cursor:pointer; text-decoration:none; display:flex; gap:10px; align-items:center; }
        .error-message { color:#ef4444; font-size:14px; margin-top:6px; display:flex; gap:6px; align-items:center; font-weight:600; }
    </style>

    <div class="form-container">

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 fade-in" role="alert">
            <strong class="font-bold">Oops! Ada kesalahan.</strong>
            <span class="block sm:inline">Mohon periksa kembali inputan Anda.</span>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-card fade-in">
            <div class="form-header">
                <h3>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Informasi Marketing Kit
                </h3>
            </div>

            <form action="{{ route('marketing-kits.store') }}" method="POST" enctype="multipart/form-data" id="marketingKitForm">
                @csrf

                <div class="form-body">
                    <div class="form-group">
                        <label class="form-label">
                            Judul Promosi <span class="required">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               class="form-input @error('title') input-error @enderror"
                               placeholder="Contoh: Diskon Kemerdekaan"
                               required
                               maxlength="150"
                               value="{{ old('title') }}">
                        @error('title')
                        <div class="error-message">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Caption (Untuk di-copy Reseller) <span class="required">*</span>
                        </label>
                        <textarea name="caption"
                                  class="form-input form-textarea @error('caption') input-error @enderror"
                                  placeholder="Tulis caption promosi yang menarik di sini..."
                                  required
                                  rows="5">{{ old('caption') }}</textarea>
                        @error('caption')
                        <div class="error-message">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            File Promosi (Gambar / Video) <span class="required">*</span>
                        </label>
                        <div class="form-hint">Format: JPG, PNG, MP4. Maks: 20MB.</div>

                        <div class="file-upload" style="margin-top:12px;">
                            <input type="file"
                                   name="image_path"
                                   id="marketingFile"
                                   class="file-input"
                                   accept="image/*,video/*"
                                   required>

                            <label for="marketingFile" class="file-label" id="marketingFileLabel">
                                <div class="upload-icon">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="upload-text font-semibold">Klik untuk upload atau drag & drop file</div>
                                    <div class="upload-subtext text-sm text-gray-500">JPG, PNG, MP4 (Maks. 20MB)</div>
                                </div>
                            </label>
                        </div>

                        @error('image_path')
                        <div class="error-message">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="preview-area" id="marketingPreview" style="display:none;">
                            <div id="previewWrapper">
                                <!-- img or video injected here -->
                            </div>
                            <div style="margin-top:10px;">
                                <button type="button" class="remove-preview" onclick="removeMarketingFile()">Hapus File</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('marketing-kits.index') }}" class="cancel-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="submit-btn" id="submitBtn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview & validation (maks 20MB)
        const marketingFile = document.getElementById('marketingFile');
        const marketingPreview = document.getElementById('marketingPreview');
        const previewWrapper = document.getElementById('previewWrapper');
        const marketingFileLabel = document.getElementById('marketingFileLabel');
        const submitBtn = document.getElementById('submitBtn');

        // Drag & Drop visual
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
            marketingFileLabel.addEventListener(evt, (e) => {
                e.preventDefault(); e.stopPropagation();
            });
        });

        ['dragenter', 'dragover'].forEach(evt => {
            marketingFileLabel.addEventListener(evt, () => marketingFileLabel.classList.add('drag-over'));
        });

        ['dragleave', 'drop'].forEach(evt => {
            marketingFileLabel.addEventListener(evt, () => marketingFileLabel.classList.remove('drag-over'));
        });

        marketingFileLabel.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            if (dt && dt.files && dt.files.length) {
                marketingFile.files = dt.files;
                handleMarketingFileChange({ target: marketingFile });
            }
        });

        marketingFile.addEventListener('change', handleMarketingFileChange);

        function handleMarketingFileChange(e) {
            const file = e.target.files[0];
            previewWrapper.innerHTML = '';

            if (!file) {
                marketingPreview.style.display = 'none';
                marketingFileLabel.style.display = 'flex';
                return;
            }

            // Validasi ukuran & tipe
            const maxBytes = 20 * 1024 * 1024; // 20MB
            if (file.size > maxBytes) {
                alert('Ukuran file terlalu besar! Maksimal 20MB.');
                marketingFile.value = '';
                return;
            }

            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];
            const validVideoTypes = ['video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/x-matroska'];

            if (![...validImageTypes, ...validVideoTypes].includes(file.type)) {
                alert('Format file tidak didukung! Gunakan JPG / PNG / MP4.');
                marketingFile.value = '';
                return;
            }

            // Tampilkan preview image atau video
            const reader = new FileReader();
            reader.onload = function(ev) {
                if (validImageTypes.includes(file.type)) {
                    const img = document.createElement('img');
                    img.src = ev.target.result;
                    img.className = 'preview-media';
                    img.alt = file.name;
                    previewWrapper.appendChild(img);
                } else {
                    const video = document.createElement('video');
                    video.src = ev.target.result;
                    video.controls = true;
                    video.className = 'preview-media';
                    previewWrapper.appendChild(video);
                }
                marketingPreview.style.display = 'block';
                marketingFileLabel.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        function removeMarketingFile() {
            marketingFile.value = '';
            previewWrapper.innerHTML = '';
            marketingPreview.style.display = 'none';
            marketingFileLabel.style.display = 'flex';
        }

        // Submit: lakukan pengecekan client-side singkat lalu kirim
        document.getElementById('marketingKitForm').addEventListener('submit', function(e) {
            // simple client-side validation before submit
            const title = this.querySelector('input[name="title"]').value.trim();
            const caption = this.querySelector('textarea[name="caption"]').value.trim();
            const file = marketingFile.files[0];

            if (!title || !caption || !file) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi.');
                return;
            }

            // disable button & ubah teks
            submitBtn.disabled = true;
            submitBtn.innerText = 'Menyimpan...';
            // biarkan form submit normal (backend akan memproses)
        });
    </script>
</x-app-layout>
