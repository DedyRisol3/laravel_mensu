<x-app-layout>
    {{-- Slot Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Masukkan Ukuran Jas Anda') }}
        </h2>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8"> {{-- max-w-4xl agar form tidak terlalu lebar --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900">

                    {{-- Informasi Produk --}}
                    <div class="mb-6 border-b pb-4">
                        <h1 class="text-lg font-semibold">Anda Memesan:</h1>
                        <p><strong>{{ $product->nama }}</strong> (Rp {{ number_format($product->harga) }})</p>
                        <p class="text-sm text-gray-600">Silakan isi semua kolom di bawah ini dalam satuan sentimeter (Cm).</p>
                    </div>

                    {{-- Pesan Error Validasi --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Harap periksa kembali input Anda.</span>
                        </div>
                    @endif

                    {{-- Form Ukuran --}}
                    <form id="ukuranForm" method="POST" action="{{ route('pelanggan.order.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        {{-- REFAKTOR: Ganti kelas CSS lama dengan grid Tailwind & komponen Breeze --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Lingkar Badan --}}
                            <div>
                                <x-input-label for="lingkar_badan" :value="__('Lingkar Badan (Cm)')" />
                                <x-text-input id="lingkar_badan" name="lingkar_badan" type="number" class="mt-1 block w-full" :value="old('lingkar_badan')" required placeholder="Ukur keliling dada"/>
                                <x-input-error class="mt-2" :messages="$errors->get('lingkar_badan')" />
                            </div>

                            {{-- Lingkar Pinggang --}}
                            <div>
                                <x-input-label for="lingkar_pinggang" :value="__('Lingkar Pinggang (Cm)')" />
                                <x-text-input id="lingkar_pinggang" name="lingkar_pinggang" type="number" class="mt-1 block w-full" :value="old('lingkar_pinggang')" required placeholder="Ukur bagian terkecil"/>
                                <x-input-error class="mt-2" :messages="$errors->get('lingkar_pinggang')" />
                            </div>

                            {{-- Lingkar Pinggul --}}
                             <div>
                                <x-input-label for="lingkar_pinggul" :value="__('Lingkar Pinggul (Cm)')" />
                                <x-text-input id="lingkar_pinggul" name="lingkar_pinggul" type="number" class="mt-1 block w-full" :value="old('lingkar_pinggul')" required placeholder="Ukur bagian terbesar"/>
                                <x-input-error class="mt-2" :messages="$errors->get('lingkar_pinggul')" />
                            </div>

                            {{-- Lebar Bahu --}}
                            <div>
                                <x-input-label for="lebar_bahu" :value="__('Lebar Bahu (Cm)')" />
                                <x-text-input id="lebar_bahu" name="lebar_bahu" type="number" class="mt-1 block w-full" :value="old('lebar_bahu')" required placeholder="Ukur dari ujung ke ujung"/>
                                <x-input-error class="mt-2" :messages="$errors->get('lebar_bahu')" />
                            </div>

                            {{-- Panjang Baju --}}
                             <div>
                                <x-input-label for="panjang_baju" :value="__('Panjang Baju (Cm)')" />
                                <x-text-input id="panjang_baju" name="panjang_baju" type="number" class="mt-1 block w-full" :value="old('panjang_baju')" required placeholder="Dari bahu ke bawah"/>
                                <x-input-error class="mt-2" :messages="$errors->get('panjang_baju')" />
                            </div>

                             {{-- Panjang Lengan --}}
                            <div>
                                <x-input-label for="panjang_lengan" :value="__('Panjang Lengan (Cm)')" />
                                <x-text-input id="panjang_lengan" name="panjang_lengan" type="number" class="mt-1 block w-full" :value="old('panjang_lengan')" required placeholder="Dari bahu ke pergelangan"/>
                                <x-input-error class="mt-2" :messages="$errors->get('panjang_lengan')" />
                            </div>

                            {{-- Tinggi Punggung --}}
                            <div>
                                <x-input-label for="tinggi_punggung" :value="__('Tinggi Punggung (Cm)')" />
                                <x-text-input id="tinggi_punggung" name="tinggi_punggung" type="number" class="mt-1 block w-full" :value="old('tinggi_punggung')" required placeholder="Dari tengkuk ke pinggang"/>
                                <x-input-error class="mt-2" :messages="$errors->get('tinggi_punggung')" />
                            </div>

                            {{-- Lingkar Leher --}}
                             <div>
                                <x-input-label for="lingkar_leher" :value="__('Lingkar Leher (Cm)')" />
                                <x-text-input id="lingkar_leher" name="lingkar_leher" type="number" class="mt-1 block w-full" :value="old('lingkar_leher')" required placeholder="Ukur keliling pangkal leher"/>
                                <x-input-error class="mt-2" :messages="$errors->get('lingkar_leher')" />
                            </div>

                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-6 flex items-center justify-end gap-4">
                            {{-- Ganti styling tombol lama dengan komponen Breeze/Tailwind --}}
                            <a href="{{ route('layanan.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                {{ __('Batal') }}
                            </a>

                            <x-primary-button>
                                {{ __('Simpan Ukuran & Lanjut') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>