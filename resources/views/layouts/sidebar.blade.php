{{-- Lebar sidebar, warna background, dll. diatur dengan kelas Tailwind --}}
<aside class="w-64 bg-white shadow-md flex-shrink-0 flex flex-col p-4"> 
    
    {{-- Bagian Logo --}}
    <div class="sidebar-header mb-8 text-center">
        <a href="{{ route('home') }}" class="flex items-center justify-center text-xl font-bold text-gray-800">
            {{-- Ganti span icon jika perlu, atau gunakan teks/SVG --}}
            <span class="material-symbols-outlined text-yellow-600 mr-2">content_cut</span> 
            <span>MenSu</span> {{-- Nama Aplikasi --}}
        </a>
    </div>

    {{-- Navigasi Sidebar Dinamis --}}
    <nav class="flex-1">
        <ul>
            {{-- === MENU ADMIN === --}}
            @if(Auth::user()->role == 'admin')
                <li class="mb-2">
                    {{-- Gunakan komponen NavLink Breeze untuk styling aktif/tidak aktif --}}
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <span class="material-symbols-outlined mr-3">dashboard</span>Dasbor
                    </x-nav-link>
                </li>
                <li class="mb-2">
                    <x-nav-link :href="route('admin.customers.index')" :active="request()->routeIs('admin.customers.*')" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                         <span class="material-symbols-outlined mr-3">group</span>Data Pelanggan
                    </x-nav-link>
                </li>
                 <li class="mb-2">
                    <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                         <span class="material-symbols-outlined mr-3">receipt_long</span>Data Pesanan
                    </x-nav-link>
                </li>
                 <li class="mb-2">
                    <x-nav-link href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg"> {{-- Ganti route nanti --}}
                         <span class="material-symbols-outlined mr-3">paid</span>Manajemen Pembayaran
                    </x-nav-link>
                </li>
                 <li class="mb-2">
                    <x-nav-link href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg"> {{-- Ganti route nanti --}}
                         <span class="material-symbols-outlined mr-3">local_shipping</span>Manajemen Pengantaran
                    </x-nav-link>
                </li>
                 <li class="mb-2">
                    <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                         <span class="material-symbols-outlined mr-3">storefront</span>Manajemen Layanan
                    </x-nav-link>
                </li>
                 <li class="mb-2">
                    <x-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                         <span class="material-symbols-outlined mr-3">assessment</span>Laporan
                    </x-nav-link>
                </li>

            {{-- === MENU PELANGGAN === --}}
            @elseif(Auth::user()->role == 'pelanggan')
                <li class="mb-2">
                    <x-nav-link :href="route('pelanggan.dashboard')" :active="request()->routeIs('pelanggan.dashboard')" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <span class="material-symbols-outlined mr-3">dashboard</span>Dasbor
                    </x-nav-link>
                </li>
                 <li class="mb-2">
                    <x-nav-link :href="route('pelanggan.orders.index')" :active="request()->routeIs('pelanggan.orders.*')" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <span class="material-symbols-outlined mr-3">receipt_long</span>Pesanan Saya
                    </x-nav-link>
                </li>
                 <li class="mb-2">
                     {{-- Anda perlu membuat route dan controller untuk Riwayat Pembayaran --}}
                    <x-nav-link href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <span class="material-symbols-outlined mr-3">payment</span>Riwayat Pembayaran
                    </x-nav-link>
                </li>
                 <li class="mb-2">
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <span class="material-symbols-outlined mr-3">person</span>Profil Saya
                    </x-nav-link>
                </li>

            {{-- === MENU KURIR === --}}
            @elseif(Auth::user()->role == 'kurir')
                 <li class="mb-2">
                    <x-nav-link :href="route('kurir.dashboard')" :active="request()->routeIs('kurir.dashboard')" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <span class="material-symbols-outlined mr-3">local_shipping</span>Pengantaran Hari Ini
                    </x-nav-link>
                </li>
                <li class="mb-2">
                    <x-nav-link :href="route('kurir.deliveries.history')" :active="request()->routeIs('kurir.deliveries.history')" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <span class="material-symbols-outlined mr-3">history</span>Riwayat Pengantaran
                    </x-nav-link>
                </li>
            @endif

            {{-- Link Logout bisa diletakkan di sini atau hanya di Top Nav --}}
            {{-- <li class="mt-auto"> ... Form Logout ... </li> --}}
        </ul>
    </nav>

    {{-- Bagian Footer Sidebar (jika ada) --}}
    {{-- <div class="sidebar-footer mt-auto"> ... </div> --}}
</aside>