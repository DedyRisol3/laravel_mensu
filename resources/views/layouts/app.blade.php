<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- (Meta tags, Title, Fonts - Biarkan seperti bawaan Breeze) --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Panggil Vite untuk Tailwind CSS --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- (Opsional) Jika Anda masih butuh ikon Material Symbols --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    </head>
    <body class="font-sans antialiased">
        {{-- Ganti struktur div utama --}}
        <div class="min-h-screen flex bg-gray-100">
            
            {{-- Sidebar akan di-include di sini --}}
            @include('layouts.sidebar')

            {{-- Konten Utama (Main Content Area) --}}
            <div class="flex-1 flex flex-col">
                
                {{-- Include Top Navigation Bar Bawaan Breeze --}}
                @include('layouts.navigation')

                {{-- Page Heading (jika ada) --}}
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                {{-- Page Content --}}
                <main class="flex-1 p-6"> {{-- Tambahkan padding --}}
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>