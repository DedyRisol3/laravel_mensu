// Menunggu hingga seluruh konten halaman dimuat sebelum menjalankan skrip
document.addEventListener('DOMContentLoaded', () => {

    // Cek apakah kita berada di halaman registrasi
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            e.preventDefault(); // Mencegah form dari reload halaman

            // Ambil nilai dari input
            const fullname = document.getElementById('fullname').value;
            const email = document.getElementById('email').value;
            const noHp = document.getElementById('noHp').value; // DATA BARU
            const alamat = document.getElementById('alamat').value; // DATA BARU
            const password = document.getElementById('password').value;

            // Ambil data pengguna yang sudah ada dari localStorage, atau buat array kosong jika belum ada
            const users = JSON.parse(localStorage.getItem('users')) || [];

            // Cek apakah email sudah terdaftar
            const userExists = users.some(user => user.email === email);
            if (userExists) {
                alert('Email sudah terdaftar. Silakan gunakan email lain.');
                return; // Hentikan proses
            }

            // Tambahkan pengguna baru ke array (termasuk data baru)
            users.push({ fullname, email, noHp, alamat, password });

            // Simpan kembali array pengguna ke localStorage
            localStorage.setItem('users', JSON.stringify(users));

            // Beri notifikasi sukses dan arahkan ke halaman login
            alert('Registrasi berhasil! Silakan masuk.');
            window.location.href = 'login.html';
        });
    }

    // Cek apakah kita berada di halaman login
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault(); // Mencegah form dari reload halaman

            // Ambil nilai dari input
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Ambil data pengguna dari localStorage
            const users = JSON.parse(localStorage.getItem('users')) || [];

            // Cari pengguna yang cocok berdasarkan email dan password
            const user = users.find(u => u.email === email && u.password === password);

            if (user) {
                // Jika pengguna ditemukan, simpan informasi login ke localStorage
                // Kita simpan semua data user kecuali password untuk digunakan nanti
                localStorage.setItem('loggedInUser', JSON.stringify({ 
                    fullname: user.fullname, 
                    email: user.email,
                    noHp: user.noHp,
                    alamat: user.alamat
                }));
                
                alert('Login berhasil! Anda akan diarahkan ke dasbor.');
                // Arahkan ke dasbor pelanggan
                window.location.href = 'pelanggan/dashboard.html'; 
            } else {
                // Jika tidak ditemukan, beri notifikasi error
                alert('Email atau password salah. Silakan coba lagi.');
            }
        });
    }
});