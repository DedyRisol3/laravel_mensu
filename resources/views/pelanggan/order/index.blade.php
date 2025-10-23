<x-app-layout>
    {{-- Slot Header --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pesanan Saya') }}
            </h2>
            {{-- Tombol Buat Pesanan Baru --}}
            <a href="{{ route('layanan.index') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                Buat Pesanan Baru
            </a>
        </div>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">Daftar Semua Pesanan</h3>

                    {{-- Tabel Pesanan --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">ID Pesanan</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Produk</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Tanggal Pesan</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase text-right">Total Harga</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($semuaPesanan as $order)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $order->order_code }}</td>
                                        <td class="px-4 py-3">{{ $order->product->nama }}</td>
                                        <td class="px-4 py-3">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="px-4 py-3 text-right">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">
                                            {{-- Styling status dinamis --}}
                                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                                @if($order->status == 'Selesai' || $order->status == 'Diterima Pelanggan') bg-green-100 text-green-800
                                                @elseif($order->status == 'Menunggu Pembayaran' || $order->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status == 'Dibatalkan' || $order->status == 'failed') bg-red-100 text-red-800
                                                @else bg-blue-100 text-blue-800 @endif">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-gray-500">Anda belum memiliki pesanan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     {{-- Paginasi jika perlu --}}
                     {{-- <div class="mt-4">
                        {{ $semuaPesanan->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>