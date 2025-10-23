<x-app-layout>
    {{-- Slot Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Kurir') }}
        </h2>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Pesan Sukses (misalnya setelah menyelesaikan pengantaran) --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header Konten (Optional, bisa ditaruh di slot header atas) --}}
                    {{-- <header class="mb-6">
                        <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->fullname }}!</h1>
                    </header> --}}

                    {{-- Tabel Tugas Pengantaran --}}
                    <h3 class="text-lg font-semibold mb-4">Daftar Pesanan Siap Antar</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">ID Pesanan</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Pelanggan</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Alamat</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">No. HP</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tugas_deliveries as $delivery)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $delivery->order->order_code }}</td>
                                        <td class="px-4 py-3">{{ $delivery->order->user->fullname }}</td>
                                        <td class="px-4 py-3">{{ $delivery->alamat_tujuan }}</td>
                                        <td class="px-4 py-3">{{ $delivery->order->user->no_hp }}</td>
                                        <td class="px-4 py-3">
                                            {{-- Form Selesai Antar --}}
                                            <form method="POST" action="{{ route('kurir.deliveries.complete', $delivery->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                {{-- Ganti styling tombol lama dengan komponen Breeze --}}
                                                <x-primary-button type="submit" class="bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:ring-green-500 text-xs px-2 py-1"> {{-- Styling agar lebih kecil --}}
                                                    {{ __('Selesai Antar') }}
                                                </x-primary-button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        {{-- Ganti inline style dengan kelas Tailwind --}}
                                        <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada tugas pengantaran saat ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     {{-- Paginasi jika perlu --}}
                     {{-- <div class="mt-4">
                        {{ $tugas_deliveries->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>