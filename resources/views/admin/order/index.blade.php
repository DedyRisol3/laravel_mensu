<x-app-layout>
    {{-- Slot Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Data Pesanan') }}
        </h2>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Pesan Sukses (jika ada setelah update status) --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header Konten --}}
                    <header class="mb-6">
                        <h1 class="text-2xl font-bold">Manajemen Data Pesanan</h1>
                        <p class="text-gray-600">Total Pesanan Tercatat: <strong>{{ $orders->count() }}</strong></p>
                    </header>

                    {{-- Tabel Pesanan --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">ID Pesanan</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Pelanggan</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Produk</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Status</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $order->order_code }}</td>
                                    <td class="px-4 py-3">{{ $order->user->fullname }}</td>
                                    <td class="px-4 py-3">{{ $order->product->nama }}</td>
                                    <td class="px-4 py-3">
                                        {{-- Form Update Status --}}
                                        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                                            @csrf
                                            @method('PUT')
                                            {{-- Ganti class 'status-select' dengan kelas Tailwind --}}
                                            <select name="status"
                                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm py-1 px-2"
                                                    onchange="this.form.submit()">
                                                <option value="Menunggu Pembayaran" {{ $order->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                                <option value="Proses Jahit" {{ $order->status == 'Proses Jahit' ? 'selected' : '' }}>Proses Jahit</option>
                                                <option value="Fitting" {{ $order->status == 'Fitting' ? 'selected' : '' }}>Fitting</option>
                                                <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai (Siap Kirim)</option>
                                                <option value="Dalam Pengantaran" {{ $order->status == 'Dalam Pengantaran' ? 'selected' : '' }}>Dalam Pengantaran</option>
                                                <option value="Diterima Pelanggan" {{ $order->status == 'Diterima Pelanggan' ? 'selected' : '' }}>Diterima Pelanggan</option>
                                                {{-- Tambahkan status Dibatalkan jika perlu --}}
                                                <option value="Dibatalkan" {{ $order->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{-- Ganti class 'btn-edit' dengan komponen button Breeze atau kelas Tailwind --}}
                                        <a href="{{ route('admin.orders.show', $order->id) }}" {{-- Arahkan ke route detail --}}
                                           class="inline-flex items-center px-3 py-1 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            Detail
                                        </a>
                                        {{-- Anda bisa tambahkan tombol lain (misal: Hapus) di sini --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data pesanan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- (Opsional) Tambahkan Paginasi jika data banyak --}}
                    {{-- <div class="mt-4">
                        {{ $orders->links() }}
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>