<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">Edit Produk: {{ $product->name }}</h2>
        <p class="text-sm text-gray-600 mt-1">Perbarui informasi produk di form di bawah</p>
      </div>

      <a href="{{ route('products.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali ke Daftar</span>
      </a>
    </div>
  </x-slot>

  <style>
    /* Styling sama seperti form tambah — konsisten dan rapi */
    :root {
      --page-max-w: 880px;
      --page-pad: 1.25rem;
      --page-pad-lg: 2rem;
      --card-radius: 16px;
      --card-pad: 1.75rem;
      --card-pad-lg: 2.25rem;
      --muted: #6b7280;
      --border: #e6e7eb;
      --accent: #4f46e5;
      --success: #10b981;
    }

    body { background: linear-gradient(180deg,#f7fbff 0,#ffffff 100%); }

    .form-container { max-width: var(--page-max-w); margin: 2.25rem auto; padding: var(--page-pad); }
    @media (min-width: 1024px) { .form-container { padding-left: var(--page-pad-lg); padding-right: var(--page-pad-lg); } }

    .form-card { background: #fff; border-radius: var(--card-radius); overflow: hidden; border: 1px solid var(--border); box-shadow: 0 8px 28px rgba(15, 23, 42, 0.06); }
    .form-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f3f4f6; display:flex; gap:.75rem; align-items:center; background: linear-gradient(135deg,#667eea 0,#764ba2 100%); color:white; }
    .form-header h3 { font-size:1.125rem; font-weight:700; display:flex; gap:.6rem; align-items:center; }

    .form-body { padding: var(--card-pad); }
    @media (min-width: 1024px) { .form-body { padding: var(--card-pad-lg); } }

    .form-group { margin-bottom: 1.75rem; }
    .form-label { display:block; margin-bottom: .5rem; font-weight:700; color:#374151; font-size:.975rem; }
    .required { color:#ef4444; margin-left:.35rem; font-weight:700; }

    .form-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; }

    .form-input { width:100%; padding:12px 14px; border-radius:12px; border:1.75px solid var(--border); font-size:.98rem; background:#fff; transition:box-shadow .18s, border-color .18s; }
    .form-input:focus { outline:none; border-color:var(--accent); box-shadow:0 8px 20px rgba(79,70,229,0.08); }
    .form-textarea { min-height:120px; resize:vertical; line-height:1.6; padding-top:12px; padding-bottom:12px; }

    .input-error { border-color:#ef4444 !important; background-color:#fff5f5; }

    /* File upload */
    .file-upload { position:relative; }
    .file-input { position:absolute; width:0.1px; height:0.1px; opacity:0; z-index:-1; }
    .file-label { display:flex; flex-direction:column; align-items:center; justify-content:center; gap:12px; padding:34px 20px; border-radius:14px; border:2.5px dashed #d1d5db; background:#fbfdff; cursor:pointer; text-align:center; transition:background .18s, border-color .18s, transform .12s; }
    .file-label:hover { background:#f4f6ff; transform:translateY(-3px); border-color:#9ca3af; }
    .file-label.drag-over { background:#eef2ff; border-color:var(--accent); }

    .upload-icon { width:64px; height:64px; display:flex; align-items:center; justify-content:center; border-radius:999px; background: linear-gradient(135deg,#e6eeff,#d6d8ff); color:var(--accent); }

    .image-preview { margin-top:1rem; text-align:center; }
    .preview-container { max-width:320px; margin:0 auto; position:relative; }
    .preview-image { width:100%; height:220px; object-fit:cover; border-radius:12px; border:1px solid var(--border); box-shadow:0 8px 20px rgba(2,6,23,0.04); }
    .remove-preview { position:absolute; top:-10px; right:-10px; width:36px; height:36px; border-radius:999px; border:none; background:#ef4444; color:white; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow:0 4px 12px rgba(239,68,68,0.18); }

    .form-actions { display:flex; gap:.75rem; justify-content:flex-end; padding:1.15rem 1.5rem; border-top:1px solid #f3f4f6; background:#fbfbfc; }
    @media(max-width:768px) { .form-actions { flex-direction:column; } .form-actions > * { width:100%; } }

    .submit-btn { background: linear-gradient(135deg,var(--success) 0,#059669 100%); color:white; border-radius:12px; padding:12px 20px; font-weight:700; border:none; display:inline-flex; gap:.6rem; align-items:center; justify-content:center; }
    .cancel-btn { background:#fff; border:1px solid var(--border); padding:12px 20px; border-radius:12px; font-weight:600; color:#374151; display:inline-flex; gap:.6rem; align-items:center; }

    .form-hint { font-size:.9rem; color:var(--muted); margin-top:.4rem; display:flex; gap:.5rem; align-items:center; }
    .text-muted { color:var(--muted); font-size:.95rem; }
    .error-message { color:#ef4444; font-weight:600; font-size:.93rem; margin-top:.5rem; display:flex; gap:.5rem; align-items:center; }

    .loader { width:16px; height:16px; border-radius:50%; border:3px solid rgba(255,255,255,0.35); border-top-color:rgba(255,255,255,0.95); animation:spin 1s linear infinite; display:inline-block; }
    @keyframes spin { to { transform: rotate(360deg); } }
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
        <h3>Perbarui Informasi Produk</h3>
      </div>

      <form id="productForm" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div class="form-body">
          {{-- Nama --}}
          <div class="form-group">
            <label class="form-label">Nama Produk <span class="required">*</span></label>
            <input type="text" name="name" class="form-input @error('name') input-error @enderror" placeholder="Contoh: Keripik Singkong Pedas" maxlength="100" required value="{{ old('name', $product->name) }}">
            @error('name')
              <div class="error-message">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
              </div>
            @enderror
          </div>

          {{-- Deskripsi --}}
          <div class="form-group">
            <label class="form-label">Deskripsi Produk <span class="required">*</span></label>
            <textarea name="description" class="form-input form-textarea @error('description') input-error @enderror" placeholder="Deskripsikan produk Anda secara detail..." required>{{ old('description', $product->description) }}</textarea>
            @error('description')
              <div class="error-message">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
              </div>
            @enderror
          </div>

          {{-- Grid harga & stok --}}
          <div class="form-grid">
            <div class="form-group">
              <label class="form-label">Harga Produk <span class="required">*</span></label>
              {{-- visible formatted field (named price_display) --}}
              <input type="text" name="price_display" id="priceDisplay" class="form-input @error('price') input-error @enderror" placeholder="0" required value="{{ old('price') ? number_format(old('price'),0,',','.') : number_format($product->price,0,',','.') }}">
              <div class="form-hint">Harga dalam Rupiah — minimal Rp 100</div>
              @error('price')
                <div class="error-message">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-label">Stok Awal <span class="required">*</span></label>
              <input type="number" name="stock" class="form-input @error('stock') input-error @enderror" placeholder="0" required min="0" value="{{ old('stock', $product->stock) }}">
              @error('stock')
                <div class="error-message">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          {{-- Gambar (opsional) --}}
          <div class="form-group">
            <label class="form-label">Ganti Gambar Produk (Opsional)</label>

            <div class="file-upload">
              <input type="file" id="productImage" name="image" class="file-input @error('image') input-error @enderror" accept="image/*">
              <label for="productImage" id="fileLabel" class="file-label">
                <div class="upload-icon" aria-hidden="true">
                  <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div>
                  <div style="font-weight:600; color:#111827;">Klik untuk pilih file baru (biarkan kosong untuk mempertahankan gambar lama)</div>
                  <div class="text-muted" style="margin-top:.25rem;">Format: JPG, PNG, WebP — Maks 5MB</div>
                </div>
              </label>
            </div>

            @error('image')
              <div class="error-message" style="margin-top:.75rem;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
              </div>
            @enderror

            {{-- Existing image preview (shown initially if product has image) --}}
            <div id="imagePreview" class="image-preview" style="display: none;">
              <div class="preview-container">
                <img id="previewImage" class="preview-image" alt="Preview Gambar Produk">
                <button type="button" class="remove-preview" onclick="removeImage()" aria-label="Hapus gambar preview">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
              </div>
              <p class="text-muted" style="margin-top:.6rem;">Gambar produk akan ditampilkan seperti ini</p>
            </div>

            {{-- store existing image url in data attribute for JS --}}
            <div id="existingImage" data-url="{{ $product->image ? asset('storage/' . $product->image) : '' }}" style="display:none;"></div>
          </div>
        </div>

        <div class="form-actions">
          <a href="{{ route('products.index') }}" class="cancel-btn" aria-label="Batal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            Batal
          </a>

          <button type="submit" class="submit-btn" id="submitBtn" aria-label="Simpan Perubahan">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            <span>Simpan Perubahan</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // --- Image preview & drag/drop / show existing image ---
    (function () {
      const fileInput = document.getElementById('productImage');
      const fileLabel = document.getElementById('fileLabel');
      const imagePreview = document.getElementById('imagePreview');
      const previewImage = document.getElementById('previewImage');
      const existingImageEl = document.getElementById('existingImage');
      const existingUrl = existingImageEl ? existingImageEl.dataset.url : '';

      function resetFilePreview() {
        if (fileInput) fileInput.value = '';
        previewImage.src = '';
        imagePreview.style.display = 'none';
        fileLabel.style.display = 'flex';
        fileLabel.classList.remove('drag-over');
      }

      function showPreviewFromFile(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewImage.src = e.target.result;
          imagePreview.style.display = 'block';
          fileLabel.style.display = 'none';
        };
        reader.readAsDataURL(file);
      }

      // show existing product image initially (if exists)
      if (existingUrl) {
        previewImage.src = existingUrl;
        imagePreview.style.display = 'block';
        // keep fileLabel visible too so user can click to replace; but we'll hide label to match add UI:
        fileLabel.style.display = 'none';
      }

      if (fileInput) {
        fileInput.addEventListener('change', function (e) {
          const file = this.files && this.files[0];
          if (!file) { resetFilePreview(); return; }

          const maxSize = 5 * 1024 * 1024;
          const valid = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
          if (file.size > maxSize) { alert('Ukuran file terlalu besar. Maksimal 5MB.'); resetFilePreview(); return; }
          if (!valid.includes(file.type)) { alert('Format file tidak didukung.'); resetFilePreview(); return; }

          showPreviewFromFile(file);
        });

        // drag & drop UX
        ['dragenter','dragover'].forEach(ev => {
          fileLabel.addEventListener(ev, (e) => { e.preventDefault(); e.stopPropagation(); fileLabel.classList.add('drag-over'); });
        });
        ['dragleave','drop'].forEach(ev => {
          fileLabel.addEventListener(ev, (e) => { e.preventDefault(); e.stopPropagation(); fileLabel.classList.remove('drag-over'); });
        });
        fileLabel.addEventListener('drop', (e) => {
          const dt = e.dataTransfer; const file = dt.files && dt.files[0];
          if (!file) return;
          const dataTransfer = new DataTransfer(); dataTransfer.items.add(file); fileInput.files = dataTransfer.files;
          fileInput.dispatchEvent(new Event('change'));
        });
      }

      // expose removeImage for button
      window.removeImage = function () {
        // if there is an existing image (from server), keeping it means leave file input empty.
        // removeImage clears user-chosen file and hides preview; user can choose new file afterwards.
        resetFilePreview();
      };
    })();

    // --- Price formatting (visible field price_display) ---
    (function () {
      const priceInput = document.getElementById('priceDisplay');
      if (!priceInput) return;

      // helper format
      const formatID = (n) => {
        try { return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 0 }).format(n); }
        catch (e) { return String(n).replace(/\B(?=(\d{3})+(?!\d))/g, '.'); }
      };

      // initialize (value provided via server)
      if (priceInput.value) {
        const digits = priceInput.value.replace(/\D/g, '');
        if (digits) priceInput.value = formatID(parseInt(digits,10));
      }

      priceInput.addEventListener('input', function () {
        const digits = this.value.replace(/\D/g, '');
        if (!digits) { this.value = ''; return; }
        const num = parseInt(digits, 10);
        this.value = formatID(num);
      });
    })();

    // --- Form submit: convert formatted price_display to raw 'price' value, do simple validation ---
    (function () {
      const form = document.getElementById('productForm');
      if (!form) return;
      const submitBtn = document.getElementById('submitBtn');

      form.addEventListener('submit', function (e) {
        // client validation
        const name = form.querySelector('input[name="name"]');
        const priceField = document.getElementById('priceDisplay');
        const imageField = document.getElementById('productImage');

        if (!name.value || !String(name.value).trim()) { alert('Nama produk wajib diisi.'); name.focus(); e.preventDefault(); return; }

        const rawPrice = parseInt(priceField.value.replace(/\D/g, '') || '0', 10);
        if (isNaN(rawPrice) || rawPrice < 100) { alert('Harga minimal Rp 100.'); priceField.focus(); e.preventDefault(); return; }

        // prepare submit: add hidden 'price' with raw numeric value
        let hidden = form.querySelector('input[name="price-hidden"]');
        if (!hidden) {
          hidden = document.createElement('input');
          hidden.type = 'hidden';
          hidden.name = 'price';
          hidden.setAttribute('data-generated', '1');
          form.appendChild(hidden);
        }
        hidden.value = rawPrice;

        // disable visible price input name so backend only gets the numeric price
        priceField.name = 'price_display';

        // show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loader" style="margin-right:.5rem;"></span><span>Menyimpan...</span>';
        // allow form to submit normally
      });
    })();
  </script>
</x-app-layout>
