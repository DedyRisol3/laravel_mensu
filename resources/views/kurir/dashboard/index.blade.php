{{-- @extends('layouts.kurir') --}}
{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dasbor Kurir - MenSu</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style-kurir.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="kurir-container">
        {{-- (Sidebar Kurir - Anda bisa buat layouts/kurir.blade.php) --}}
        <main class="main-content">
            <header class="content-header">
                <h1 id="welcomeCourierName">Selamat Datang, {{ Auth::user()->fullname }}!</h1>
                {{-- (Tombol Logout dll) --}}
            </header>

            <div class="card">
                <h3>Daftar Pesanan Siap Antar</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="deliveryTableBody">
                        @forelse($tugas_deliveries as $delivery)
                        <tr>
                            <td>{{ $delivery->order->order_code }}</td>
                            <td>{{ $delivery->order->user->fullname }}</td>
                            <td>{{ $delivery->alamat_tujuan }}</td>
                            <td>{{ $delivery->order->user->no_hp }}</td>
                            <td class="action-buttons">
                                <form method="POST" action="{{ route('kurir.deliveries.complete', $delivery->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-update-delivery">Selesai Antar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align:center;">Tidak ada tugas pengantaran saat ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
{{-- @endsection --}}