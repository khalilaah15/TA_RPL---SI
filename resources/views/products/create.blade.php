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
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Tambah Menu Baru') }}
                </h2>
            </div>
            <a href="{{ route('products.index') }}"
                class="flex items-center gap-2 text-white hover:text-white font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </x-slot>

    <style>
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
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%);
            color: white;
        }

        .form-header h3 {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .form-body {
            padding: 32px;
        }

        .form-group {
            margin-bottom: 28px;
        }

        .form-label {
            display: flex;
            font-size: 15px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 10px;
            align-items: center;
            gap: 8px;
        }

        .form-label .required {
            color: #ef4444;
            font-size: 18px;
        }

        .form-hint {
            font-size: 13px;
            color: #6b7280;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            color: #1f2937;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.5;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }

        .file-upload {
            position: relative;
        }

        .file-input {
            position: absolute;
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            z-index: -1;
        }

        .file-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
            background: #f8fafc;
            border: 3px dashed #d1d5db;
            border-radius: 16px;
            padding: 40px 24px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .file-label:hover {
            background: #f1f5f9;
            border-color: #9ca3af;
        }

        .file-label.drag-over {
            background: #e0e7ff;
            border-color: #4f46e5;
        }

        .upload-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4f46e5;
        }

        .image-preview {
            margin-top: 20px;
            text-align: center;
        }

        .preview-container {
            max-width: 300px;
            margin: 0 auto;
            position: relative;
        }

        .preview-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .remove-preview {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 32px;
            height: 32px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
            transition: all 0.2s ease;
        }

        .form-actions {
            padding: 32px;
            border-top: 1px solid #f3f4f6;
            display: flex;
            gap: 16px;
            justify-content: flex-end;
            background: #f9fafb;
        }

        .submit-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px 32px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            min-width: 180px;
            justify-content: center;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .cancel-btn {
            background: white;
            color: #374151;
            border: 2px solid #d1d5db;
            border-radius: 12px;
            padding: 16px 32px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }

        .input-error {
            border-color: #ef4444 !important;
            background-color: #fef2f2;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

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

        @media (max-width: 768px) {
            .form-actions {
                flex-direction: column;
            }

            .submit-btn,
            .cancel-btn {
                width: 100%;
                justify-content: center;
            }
        }
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
                    Informasi Menu Baru
                </h3>
            </div>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf

                <div class="form-body">
                    <div class="form-group">
                        <label class="form-label">
                            Nama Produk <span class="required">*</span>
                        </label>
                        <input type="text"
                            name="name"
                            class="form-input @error('name') input-error @enderror"
                            placeholder="Contoh: Keripik Singkong Pedas"
                            required
                            maxlength="100"
                            value="{{ old('name') }}"> @error('name')
                        <div class="error-message">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Deskripsi Produk <span class="required">*</span>
                        </label>
                        <textarea name="description"
                            class="form-input form-textarea @error('description') input-error @enderror"
                            placeholder="Deskripsikan menu Anda secara detail..."
                            required
                            rows="4">{{ old('description') }}</textarea> @error('description')
                        <div class="error-message">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                Harga Produk <span class="required">*</span>
                            </label>
                            <div class="price-input-container">
                                <input type="number"
                                    id="priceDisplay"
                                    class="form-input price-input @error('price') input-error @enderror"
                                    placeholder="0"
                                    required
                                    value="{{ old('price') }}">
                            </div>

                            @error('price')
                            <div class="error-message">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="form-hint">Harga dalam Rupiah (minimum Rp 100)</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Stok Awal <span class="required">*</span>
                            </label>
                            <input type="number"
                                name="stock"
                                class="form-input @error('stock') input-error @enderror"
                                placeholder="0"
                                required
                                min="0"
                                value="{{ old('stock') }}"> @error('stock')
                            <div class="error-message">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Gambar Produk <span class="required">*</span>
                        </label>
                        <div class="file-upload">
                            <input type="file"
                                name="image"
                                id="productImage"
                                class="file-input"
                                accept="image/*"
                                required>
                            <label for="productImage" class="file-label @error('image') input-error @enderror" id="fileLabel">
                                <div class="upload-icon">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="upload-text">Klik untuk upload gambar menu</div>
                                    <div class="upload-subtext">Format: JPG, PNG, WebP (Maks. 5MB)</div>
                                </div>
                            </label>
                        </div>

                        @error('image')
                        <div class="error-message">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="image-preview" id="imagePreview" style="display: none;">
                            <div class="preview-container">
                                <img id="previewImage" class="preview-image" alt="Preview Gambar">
                                <button type="button" class="remove-preview" onclick="removeImage()">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Gambar menu akan ditampilkan seperti ini</p>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('products.index') }}" class="cancel-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="submit-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // 1. Image Preview
        document.getElementById('productImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');
            const fileLabel = document.getElementById('fileLabel');

            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 5MB.');
                    this.value = '';
                    return;
                }
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak didukung!');
                    this.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    preview.style.display = 'block';
                    fileLabel.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });

        function removeImage() {
            document.getElementById('productImage').value = '';
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('fileLabel').style.display = 'flex';
        }

        // 2. Price Formatting
        const priceInput = document.getElementById('priceDisplay');

        // Format saat load (jika ada old value)
        if (priceInput.value) {
            let val = priceInput.value.replace(/\D/g, '');
            if (val) priceInput.value = parseInt(val).toLocaleString('id-ID');
        }

        priceInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value) {
                this.value = parseInt(value).toLocaleString('id-ID');
            } else {
                this.value = '';
            }
        });

        // 3. Form Submission Handling (KUNCI PERBAIKAN)
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Stop dulu

            const name = this.querySelector('input[name="name"]').value.trim();
            const priceField = document.getElementById('priceDisplay');

            // Ambil harga asli tanpa titik
            const rawPrice = priceField.value.replace(/\./g, '');

            // Validasi Simple di Client Side
            if (!name || rawPrice < 100) {
                alert('Mohon lengkapi data. Harga minimal Rp 100.');
                return;
            }

            // Show Loading
            const submitBtn = this.querySelector('.submit-btn');
            submitBtn.innerHTML = `<span>Menyimpan...</span>`;
            submitBtn.disabled = true;

            // Hapus titik sebelum kirim agar Controller menerima integer
            priceField.value = rawPrice;

            // Kirim Form
            this.submit();
        });

        // Drag & Drop
        const fileLabel = document.getElementById('fileLabel');
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileLabel.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
            });
        });
    </script>
</x-app-layout>