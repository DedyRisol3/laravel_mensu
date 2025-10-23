<x-app-layout>
    {{-- Slot Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran Pesanan') }} {{ $order->order_code }}
        </h2>
    </x-slot>

    {{-- Midtrans Snap JS (Penting: Letakkan di head agar bisa diakses script di body) --}}
    @push('scripts')
        <script type="text/javascript"
                src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endpush

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8"> {{-- max-w-2xl agar kontainer tidak terlalu lebar --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900">

                    <div class="text-center mb-6">
                        <h1 class="text-2xl font-semibold font-serif">Selesaikan Pembayaran</h1>
                    </div>

                    {{-- REFAKTOR: Ganti kelas CSS lama dengan Tailwind --}}
                    <div class="border border-gray-200 rounded-lg mb-6">
                        <div class="bg-gray-50 px-4 py-3 font-semibold border-b border-gray-200 rounded-t-lg">
                            Ringkasan Pesanan
                        </div>
                        <div class="p-4 space-y-3"> {{-- space-y-3 untuk jarak antar item --}}
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Produk:</span>
                                <span class="font-medium">{{ $order->product->nama }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Kode Pesanan:</span>
                                <span class="font-medium">{{ $order->order_code }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Pelanggan:</span>
                                <span class="font-medium">{{ $order->user->fullname }}</span>
                            </div>
                            {{-- Total --}}
                            <div class="flex justify-between text-lg font-bold border-t border-gray-200 pt-3 mt-3">
                                <span>Total:</span>
                                <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Bayar --}}
                    <div class="text-center">
                        {{-- REFAKTOR: Ganti kelas 'pay-btn' dengan komponen/kelas Breeze/Tailwind --}}
                        <x-primary-button id="pay-button" class="w-full justify-center py-3 text-base">
                            {{ __('Bayar Sekarang') }}
                        </x-primary-button>
                    </div>
                    @if(session('success'))
                        <div class="mt-4 px-4 py-2 bg-green-50 border border-green-200 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mt-4 px-4 py-2 bg-red-50 border border-red-200 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(isset($order->payment))
                        <div class="mt-4 px-4 py-3 bg-gray-50 border border-gray-200 rounded text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Metode Pembayaran:</span>
                                <span class="font-medium">{{ ucfirst($order->payment->method ?? 'Midtrans') }}</span>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span class="text-gray-600">Status Pembayaran:</span>
                                <span class="font-medium">{{ ucfirst($order->payment->status) }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="mt-4 text-sm text-gray-600">
                        Silakan klik tombol "Bayar Sekarang" untuk membuka popup pembayaran Midtrans. Jangan menutup popup sampai proses pembayaran selesai.
                    </div>

                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('pelanggan.orders.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 border border-gray-200 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200">
                            Kembali ke Daftar Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Pembayaran Midtrans (Tetap diperlukan) --}}
    @push('scripts')
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        if (payButton) {
            payButton.addEventListener('click', function () {
                // Panggil snap.pay() dengan Snap Token dari controller
                // Gunakan @json untuk meng-encode token agar aman di JavaScript
                window.snap.pay(@json($snapToken), {
                    onSuccess: function(result){
                        console.log(result);
                        // Pertimbangkan redirect ke halaman 'terima kasih' atau detail pesanan
                        window.location.href = '{{ route('pelanggan.orders.index') }}?payment_status=success'; // Tambahkan query string
                    },
                    onPending: function(result){
                        console.log(result);
                        window.location.href = '{{ route('pelanggan.orders.index') }}?payment_status=pending';
                    },
                    onError: function(result){
                        console.log(result);
                         // Beri tahu user errornya apa
                         alert('Pembayaran Gagal: ' + (result.status_message || 'Silakan coba lagi.'));
                    },
                    onClose: function(){
                        console.log('customer closed the popup without finishing the payment');
                        // Tidak perlu alert, biarkan user tetap di halaman pembayaran
                    }
                });
            });
        }
    </script>
    @endpush

</x-app-layout>