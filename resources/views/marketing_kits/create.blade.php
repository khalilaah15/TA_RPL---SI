<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Marketing Kit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('marketing-kits.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block mb-1 font-bold">Judul Promosi</label>
                            <input type="text" name="title" class="w-full border-gray-300 rounded shadow-sm" placeholder="Contoh: Diskon Kemerdekaan" required>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-bold">Caption (Untuk di-copy Reseller)</label>
                            <textarea name="caption" rows="5" class="w-full border-gray-300 rounded shadow-sm" placeholder="Tulis caption promosi yang menarik di sini..." required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-bold">File Promosi (Gambar / Video)</label>
                            <p class="text-xs text-gray-500 mb-2">Format: JPG, PNG, MP4. Maks: 20MB.</p>

                            <input type="file" name="image_path" class="w-full border p-2 rounded" accept="image/*,video/*" required>
                        </div>

                        <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded">Simpan Data</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>