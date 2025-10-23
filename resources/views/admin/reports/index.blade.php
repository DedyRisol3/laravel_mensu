<x-app-layout>
    {{-- Slot Header --}}
    <x-slot name="header">
        <div class="flex justify-between items-center"> {{-- Flex container --}}
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan & Analitik') }}
            </h2>
            {{-- Tombol Download PDF --}}
            <a href="{{ route('admin.reports.downloadPDF') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Download PDF
            </a>
        </div>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Ringkasan Laporan --}}
            <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Kartu Total Pendapatan --}}
                <div class="bg-yellow-100 p-6 rounded-lg shadow flex items-center">
                    <div class="bg-yellow-500 p-3 rounded-full mr-4">
                        <span class="material-symbols-outlined text-white">payments</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 uppercase">Total Pendapatan (Selesai)</p>
                        <h3 class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalPendapatan) }}</h3>
                    </div>
                </div>
                {{-- Kartu Total Pesanan Selesai --}}
                <div class="bg-green-100 p-6 rounded-lg shadow flex items-center">
                    <div class="bg-green-500 p-3 rounded-full mr-4">
                        <span class="material-symbols-outlined text-white">task_alt</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 uppercase">Total Pesanan Selesai</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $pesananSelesai }}</h3>
                    </div>
                </div>
            </section>

            {{-- Tabel Detail Transaksi --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Detail Transaksi Pembayaran Sukses</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">ID Pesanan</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Pelanggan</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Produk</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase">Tanggal Bayar</th>
                                    <th class="px-4 py-3 text-sm font-medium text-gray-700 uppercase text-right">Jumlah</th> {{-- text-right --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $payment)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $payment->order->order_code }}</td>
                                        <td class="px-4 py-3">{{ $payment->order->user->fullname }}</td>
                                        <td class="px-4 py-3">{{ $payment->order->product->nama }}</td>
                                        <td class="px-4 py-3">{{ $payment->updated_at->format('d M Y') }}</td>
                                        <td class="px-4 py-3 text-right">Rp {{ number_format($payment->jumlah) }}</td> {{-- text-right --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data pembayaran yang sukses.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                             {{-- Footer Tabel (Total) --}}
                            <tfoot class="bg-gray-100 border-t font-semibold">
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-right">Total Pendapatan:</td>
                                    <td class="px-4 py-3 text-right">Rp {{ number_format($totalPendapatan) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    {{-- Paginasi jika perlu --}}
                     {{-- <div class="mt-4">
                        {{ $payments->links() }}
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>