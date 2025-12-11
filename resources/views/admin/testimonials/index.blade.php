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
            {{ __('Daftar Testimoni Reseller') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($testimonials as $testi)
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100">

                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-600">
                                {{ substr($testi->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-sm">{{ $testi->user->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $testi->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-yellow-400 text-sm tracking-widest">
                            @for($i=0; $i < $testi->rating; $i++) ⭐ @endfor
                        </div>
                    </div>

                    <p class="text-gray-700 italic text-sm">
                        "{{ $testi->content }}"
                    </p>

                </div>
                @endforeach
            </div>

            @if($testimonials->isEmpty())
            <p class="text-center text-gray-500 mt-10">Belum ada testimoni masuk.</p>
            @endif

        </div>
    </div>
</x-app-layout>