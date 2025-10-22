document.addEventListener('DOMContentLoaded', () => {
    const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
    const currentPage = window.location.pathname;

    // 1. Lindungi Halaman: Jika tidak ada yang login, tendang ke halaman login
    if (!loggedInUser) {
        alert('Anda harus masuk terlebih dahulu untuk mengakses halaman ini.');
        window.location.href = '../login.html'; 
        return; // Hentikan eksekusi skrip
    }

    // 2. Logika Logout (Berlaku di semua halaman dasbor)
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            localStorage.removeItem('loggedInUser');
            alert('Anda telah keluar.');
            window.location.href = '../index.html';
        });
    }

    // 3. Tampilkan Sapaan di Header (jika ada)
    const welcomeUserElement = document.getElementById('welcomeUserName');
    if (welcomeUserElement) {
        const firstName = loggedInUser.fullname.split(' ')[0];
        welcomeUserElement.textContent = `Selamat Datang, ${firstName}!`;
    }
    const userNameElement = document.getElementById('userName');
    if(userNameElement) {
        userNameElement.textContent = loggedInUser.fullname;
    }


    // --- ROUTING BERDASARKAN HALAMAN PELANGGAN ---

    // 4. Logika Khusus Halaman Profil
    if (currentPage.includes('profil.html')) {
        // Isi formulir profil dengan data dari localStorage
        const profileForm = document.getElementById('profileForm');
        if (profileForm) {
            document.getElementById('fullname').value = loggedInUser.fullname;
            document.getElementById('email').value = loggedInUser.email;
            document.getElementById('noHp').value = loggedInUser.noHp;
            document.getElementById('alamat').value = loggedInUser.alamat;
        }

        // Tangani penyimpanan data profil
        profileForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Ambil data baru dari form
            const updatedFullname = document.getElementById('fullname').value;
            const updatedNoHp = document.getElementById('noHp').value;
            const updatedAlamat = document.getElementById('alamat').value;

            // Update data di 'loggedInUser'
            loggedInUser.fullname = updatedFullname;
            loggedInUser.noHp = updatedNoHp;
            loggedInUser.alamat = updatedAlamat;
            
            // Simpan kembali ke localStorage
            localStorage.setItem('loggedInUser', JSON.stringify(loggedInUser));

            // Update juga data di database 'users' (simulasi)
            const users = JSON.parse(localStorage.getItem('users')) || [];
            const userIndex = users.findIndex(user => user.email === loggedInUser.email);
            if (userIndex !== -1) {
                users[userIndex].fullname = updatedFullname;
                users[userIndex].noHp = updatedNoHp;
                users[userIndex].alamat = updatedAlamat;
                localStorage.setItem('users', JSON.stringify(users));
            }

            alert('Profil berhasil diperbarui!');
            // Muat ulang nama di header
            document.getElementById('userName').textContent = updatedFullname;
        });

        // Tangani form ganti password (simulasi)
        const passwordForm = document.getElementById('passwordForm');
        passwordForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const passLama = document.getElementById('passwordLama').value;
            const passBaru = document.getElementById('passwordBaru').value;
            
            // (Simulasi) Cek password lama
            const usersDB = JSON.parse(localStorage.getItem('users')) || [];
            const currentUserInDB = usersDB.find(user => user.email === loggedInUser.email);

            if (currentUserInDB && currentUserInDB.password === passLama) {
                // Update password di DB (simulasi)
                currentUserInDB.password = passBaru;
                localStorage.setItem('users', JSON.stringify(usersDB));
                
                alert('Password berhasil diubah!');
                passwordForm.reset();
            } else {
                alert('Password lama Anda salah.');
            }
        });
    }
});