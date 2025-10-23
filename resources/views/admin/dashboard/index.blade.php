<x-app-layout>
    {{-- Slot Header (Opsional, untuk judul halaman di top nav) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dasbor') }}
        </h2>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- MULAI Konten Dasbor Anda DI SINI --}}

                    <header class="content-header mb-6"> {{-- Tambah margin bawah (Tailwind: mb-6) --}}
                        <h1 class="text-2xl font-bold">Admin Dasbor</h1>
                        <p>Selamat datang! Berikut adalah ringkasan aktivitas bisnis Anda.</p>
                    </header>

                    {{-- Kartu Statistik --}}
                    {{-- REFAKTOR: Ganti kelas CSS lama dengan Tailwind --}}
                    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        {{-- Kartu Total Pesanan --}}
                        <div class="bg-blue-100 p-6 rounded-lg shadow flex items-center">
                            <div class="bg-blue-500 p-3 rounded-full mr-4">
                                <span class="material-symbols-outlined text-white">receipt_long</span>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold">{{ $totalPesanan }}</h4>
                                <p class="text-gray-600">Total Pesanan</p>
                            </div>
                        </div>
                        {{-- Kartu Total Pelanggan --}}
                        <div class="bg-green-100 p-6 rounded-lg shadow flex items-center">
                             <div class="bg-green-500 p-3 rounded-full mr-4">
                                <span class="material-symbols-outlined text-white">group</span>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold">{{ $totalPelanggan }}</h4>
                                <p class="text-gray-600">Total Pelanggan</p>
                            </div>
                        </div>
                        {{-- Kartu Total Pendapatan --}}
                         <div class="bg-yellow-100 p-6 rounded-lg shadow flex items-center">
                             <div class="bg-yellow-500 p-3 rounded-full mr-4">
                                <span class="material-symbols-outlined text-white">payments</span>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                                <p class="text-gray-600">Total Pendapatan</p>
                            </div>
                        </div>
                    </section>

                    {{-- Tabel Pesanan Terbaru --}}
                    {{-- REFAKTOR: Ganti kelas CSS lama dengan Tailwind --}}
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-4">Pesanan Terbaru</h3>
                        <div class="overflow-x-auto"> {{-- Agar tabel bisa scroll di layar kecil --}}
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 border-b">
                                    <tr>
                                        <th class="px-4 py-2">ID Pesanan</th>
                                        <th class="px-4 py-2">Pelanggan</th>
                                        <th class="px-4 py-2">Tanggal</th>
                                        <th class="px-4 py-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pesananTerbaru as $order)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-2">{{ $order->order_code }}</td>
                                            <td class="px-4 py-2">{{ $order->user->fullname }}</td>
                                            <td class="px-4 py-2">{{ $order->created_at->format('d M Y') }}</td>
                                            <td class="px-4 py-2">{{ $order->status }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">Belum ada pesanan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- AKHIR Konten Dasbor Anda DI SINI --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
