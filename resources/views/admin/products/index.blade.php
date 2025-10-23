<x-app-layout>
    {{-- Slot Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Produk & Layanan') }}
        </h2>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"> {{-- Tambahkan space-y-6 untuk jarak antar div --}}

            {{-- Pesan Sukses/Error (jika ada dari form submission) --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
             @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Terjadi beberapa kesalahan input:</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Tambah Layanan --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl"> {{-- Batasi lebar form agar lebih rapi --}}
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Layanan Baru</h3>
                    {{-- Ganti kelas CSS lama dan gunakan komponen Breeze --}}
                    <form id="formLayanan" method="POST" action="{{ route('admin.products.store') }}" class="space-y-4">
                        @csrf

                        {{-- Nama Layanan --}}
                        <div>
                            <x-input-label for="nama" :value="__('Nama Layanan')" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        {{-- Harga --}}
                        <div>
                            <x-input-label for="harga" :value="__('Harga')" />
                            <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full" :value="old('harga')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('harga')" />
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <x-input-label for="deskripsi" :value="__('Deskripsi Singkat')" />
                            {{-- Gunakan komponen textarea jika ada, atau styling manual --}}
                            <textarea id="deskripsi" name="deskripsi" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('deskripsi') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                        </div>

                        {{-- Fitur --}}
                        <div>
                            <x-input-label for="fitur" :value="__('Fitur Utama (pisahkan dengan | )')" />
                            <x-text-input id="fitur" name="fitur" type="text" class="mt-1 block w-full" :value="old('fitur')" placeholder="Fitur 1|Fitur 2|Fitur 3" required />
                             <x-input-error class="mt-2" :messages="$errors->get('fitur')" />
                        </div>

                        {{-- URL Gambar --}}
                        <div>
                            <x-input-label for="gambar_url" :value="__('URL Gambar')" />
                            <x-text-input id="gambar_url" name="gambar_url" type="text" class="mt-1 block w-full" :value="old('gambar_url')" placeholder="https://..." required />
                             <x-input-error class="mt-2" :messages="$errors->get('gambar_url')" />
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="flex items-center gap-4">
                            {{-- Gunakan komponen x-primary-button --}}
                            <x-primary-button>{{ __('Simpan Layanan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabel Daftar Layanan --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Layanan Saat Ini</h3>
                 <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-100 border-b">
                            <tr>
                                <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Nama Layanan</th>
                                <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Harga</th>
                                <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $product->nama }}</td>
                                    <td class="px-4 py-3">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 space-x-2"> {{-- Beri jarak antar tombol --}}
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                           class="inline-flex items-center px-3 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            Edit
                                        </a>

                                        {{-- Tombol Hapus (dalam form) --}}
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            {{-- Gunakan komponen x-danger-button --}}
                                            <x-danger-button type="submit">
                                                {{ __('Hapus') }}
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-gray-500">Belum ada data produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                 </div>
            </div>

        </div>
    </div>
</x-app-layout>