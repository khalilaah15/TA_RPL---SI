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
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Beri Ulasan & Testimoni') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('testimonials.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2 font-bold text-gray-700">Berikan Rating</label>
                        <div class="flex gap-4">
                            @foreach(range(1, 5) as $rating)
                            <label class="cursor-pointer flex flex-col items-center">
                                <input type="radio" name="rating" value="{{ $rating }}" class="mb-1" required>
                                <span class="text-2xl">⭐</span>
                                <span class="text-xs font-bold">{{ $rating }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-bold">Tulis Pengalaman Anda</label>
                        <textarea name="content" rows="4" class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500" placeholder="Contoh: Pelayanan cepat, rasa keripiknya mantap!" required></textarea>
                    </div>
                    <button type="submit"
                        class="button admin-primary-btn">
                        <span>Kirim Ulasan</span>
                        <span class="animate-bounce">🚀</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>