<nav x-data="{ open: false }" style="background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('logo.png') }}" alt="Logo" width="60" height="60" class="h-10 w-10">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-gray-200">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                    <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')" class="text-white hover:text-gray-200">
                        {{ __('Pesanan Masuk') }}
                    </x-nav-link>

                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="text-white hover:text-gray-200">
                        {{ __('Kelola Menu') }}
                    </x-nav-link>

                    <x-nav-link :href="route('marketing-kits.index')" :active="request()->routeIs('marketing-kits.*')" class="text-white hover:text-gray-200">
                        {{ __('Marketing Kit') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.resellers.index')" :active="request()->routeIs('admin.resellers.*')" class="text-white hover:text-gray-200">
                        {{ __('Data Reseller') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.report')" :active="request()->routeIs('admin.report')" class="text-white hover:text-gray-200">
                        {{ __('Laporan') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.testimonials.index')" :active="request()->routeIs('admin.testimonials.*')" class="text-white hover:text-gray-200">
                        {{ __('Ulasan') }}
                    </x-nav-link>
                    @endif

                    @if(Auth::user()->role === 'reseller')
                    <x-nav-link :href="route('order.index')" :active="request()->routeIs('order.index')" class="text-white hover:text-gray-200">
                        {{ __('Belanja Stok') }}
                    </x-nav-link>

                    <x-nav-link :href="route('carts.index')" :active="request()->routeIs('carts.*')" class="text-white hover:text-gray-200">
                        {{ __('Keranjang') }}
                    </x-nav-link>

                    <x-nav-link :href="route('order.history')" :active="request()->routeIs('order.history')" class="text-white hover:text-gray-200">
                        {{ __('Riwayat & Invoice') }}
                    </x-nav-link>

                    <x-nav-link :href="route('marketing-kits.index')" :active="request()->routeIs('marketing-kits.*')" class="text-white hover:text-gray-200">
                        {{ __('Marketing kit') }}
                    </x-nav-link>

                    <x-nav-link :href="route('testimonials.create')" :active="request()->routeIs('testimonials.*')" class="text-white hover:text-gray-200">
                        {{ __('Ulasan') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-white hover:bg-gray-100 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div class="font-bold">{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-red-800 focus:outline-none focus:bg-red-800 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-red-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:bg-red-900 border-l-4 border-transparent hover:border-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
            <x-responsive-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')" class="text-white hover:bg-red-900">
                {{ __('Pesanan Masuk') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="text-white hover:bg-red-900">
                {{ __('Kelola Menu') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('marketing-kits.index')" :active="request()->routeIs('marketing-kits.*')" class="text-white hover:bg-red-900">
                {{ __('Marketing Kit') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.resellers.index')" :active="request()->routeIs('admin.resellers.*')" class="text-white hover:bg-red-900">
                {{ __('Data Reseller') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.report')" :active="request()->routeIs('admin.report')" class="text-white hover:bg-red-900">
                {{ __('Laporan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.testimonials.index')" :active="request()->routeIs('admin.testimonials.*')" class="text-white hover:bg-red-900">
                {{ __('Ulasan') }}
            </x-responsive-nav-link>
            @endif

            @if(Auth::user()->role === 'reseller')
            <x-responsive-nav-link :href="route('order.index')" :active="request()->routeIs('order.index')" class="text-white hover:bg-red-900">
                {{ __('Belanja Stok') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('carts.index')" :active="request()->routeIs('carts.*')" class="text-white hover:bg-red-900">
                {{ __('Keranjang') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('order.history')" :active="request()->routeIs('order.history')" class="text-white hover:bg-red-900">
                {{ __('Riwayat & Invoice') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('marketing-kits.index')" :active="request()->routeIs('marketing-kits.*')" class="text-white hover:bg-red-900">
                {{ __('Marketing Kit') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('testimonials.create')" :active="request()->routeIs('testimonials.*')" class="text-white hover:bg-red-900">
                {{ __('Ulasan') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-red-700 bg-red-900">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-200 hover:text-white hover:bg-red-800">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" class="text-gray-200 hover:text-white hover:bg-red-800"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Paksa warna text putih untuk link navigasi di desktop */
    nav a.inline-flex {
        color: white !important;
        border-color: transparent !important;
    }

    /* Warna saat hover */
    nav a.inline-flex:hover {
        color: #e5e7eb !important;
        /* abu-abu muda */
        border-color: #e5e7eb !important;
    }

    /* Warna saat aktif */
    nav a.inline-flex[aria-current="page"] {
        color: white !important;
        border-bottom: 2px solid white !important;
        font-weight: bold;
    }
</style>