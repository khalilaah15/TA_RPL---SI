<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Marketing Kit</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('marketing-kits.update', $marketingKit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1 font-bold">Judul Promosi</label>
                        <input type="text" name="title" value="{{ $marketingKit->title }}" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-bold">Caption</label>
                        <textarea name="caption" rows="5" class="w-full border-gray-300 rounded" required>{{ $marketingKit->caption }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-bold">Ganti File (Gambar/Video)</label>
                        <input type="file" name="image_path" class="w-full border p-2 rounded" accept="image/*,video/*">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti file.</p>
                    </div>

                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update Data</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>