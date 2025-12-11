<x-app-layout>
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
                        class="w-full flex items-center justify-center gap-2 px-6 py-3 border-2 border-indigo-600 text-indigo-600 font-bold rounded-xl hover:bg-indigo-600 hover:text-white transition-colors duration-300 focus:ring-4 focus:ring-indigo-200">
                        <span>Kirim Ulasan</span>
                        <span class="animate-bounce">🚀</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>