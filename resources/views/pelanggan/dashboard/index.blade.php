<x-app-layout>
    {{-- Slot Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Pelanggan') }}
        </h2>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

             {{-- Pesan Sukses (misalnya setelah membuat pesanan) --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Kartu Ringkasan --}}
            {{-- REFAKTOR: Ganti kelas CSS lama dengan Tailwind --}}
            <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                {{-- Kartu Total Pesanan --}}
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Total Pesanan</h3>
                    {{-- Ganti data statis dengan variabel Blade --}}
                    <p class="text-3xl font-bold">{{ $totalPesanan ?? 0 }}</p>
                    {{-- <small>X Pesanan dalam proses.</small> --}} {{-- Anda bisa tambahkan logic ini jika perlu --}}
                </div>
                {{-- Kartu Status Akun --}}
                <div class="bg-white p-6 rounded-lg shadow">
                     <h3 class="text-lg font-medium text-gray-700 mb-2">Status Akun</h3>
                    <p class="text-3xl font-bold text-green-600">Aktif</p>
                    {{-- Tampilkan tanggal bergabung jika ada --}}
                    <small>Pelanggan sejak: {{ Auth::user()->created_at->format('d M Y') }}</small>
                </div>
                {{-- Kartu Bantuan --}}
                 <div class="bg-white p-6 rounded-lg shadow">
                     <h3 class="text-lg font-medium text-gray-700 mb-2">Butuh Bantuan?</h3>
                    <p class="text-gray-600 mb-3">Tim kami siap membantu Anda.</p>
                    {{-- Gunakan route helper dan styling Tailwind/Breeze --}}
                    <a href="{{ route('kontak') }}"
                       class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Hubungi Kami
                    </a>
                </div>
            </section>

            {{-- Daftar Pesanan Terbaru --}}
            {{-- REFAKTOR: Ganti kelas CSS lama dengan Tailwind --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Pesanan Terbaru</h3>
                     {{-- Ganti div.order-list dengan ul atau div flex --}}
                    <div class="space-y-4">
                        @forelse ($pesananTerbaru as $order)
                            {{-- Ganti div.order-item dengan flex container --}}
                            <div class="flex justify-between items-center p-4 border rounded-md hover:bg-gray-50">
                                <div>
                                    <strong class="font-medium">{{ $order->product->nama }}</strong><br>
                                    <small class="text-gray-500">ID Pesanan: {{ $order->order_code }}</small>
                                </div>
                                {{-- Styling status dinamis (contoh sederhana) --}}
                                <span class="px-3 py-1 text-xs font-medium rounded-full
                                    @if($order->status == 'Selesai' || $order->status == 'Diterima Pelanggan') bg-green-100 text-green-800
                                    @elseif($order->status == 'Menunggu Pembayaran' || $order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'Dibatalkan' || $order->status == 'failed') bg-red-100 text-red-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ $order->status }}
                                </span>
                            </div>
                        @empty
                             <p class="text-gray-500 text-center">Anda belum memiliki pesanan.</p>
                        @endforelse
                    </div>

                    {{-- Link ke halaman Pesanan Saya --}}
                    @if (isset($pesananTerbaru) && count($pesananTerbaru) > 0)
                        <div class="mt-4 text-right">
                             <a href="{{ route('pelanggan.orders.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                                 Lihat Semua Pesanan &rarr;
                             </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>