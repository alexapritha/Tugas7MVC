# Sistem Peminjaman Buku Perpustakaan

Sebuah sistem berbasis web untuk mengelola peminjaman buku di perpustakaan.

## Langkah Instalasi

1. **Menyiapkan Basis Data**
   - Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`
   - Pilih tab "sql"
   - salin isi `database_setup.txt` lalu paste pada tab "sql"  
   - Klik "Go" untuk mengeksekusi perintah SQL
    
2. **Menjalankan Aplikasi**
   - Buka browser dan kunjungi: `http://localhost/245150401111006_Alexandra_Tugas_6/index.php`
   - atau gunakan Start_Application.bat


## Sistem Login

Sistem menggunakan metode login otomatis dengan ketentuan:
- Email: Gunakan alamat email valid (contoh: nama@domain.com)
- Password: Menggunakan nama domain dari email yang digunakan

Contoh Login:
- Email: someone@gmail.com
- Password: gmail

- Email: user@yahoo.com
- Password: yahoo

## Catatan Penting

- Pastikan XAMPP (Apache dan MySQL) berjalan sebelum memulai aplikasi
- Proyek harus ditempatkan di: `c:\xampp\htdocs\245150401111006_Alexandra_Tugas_6`
- Jika mengalami kendala:
  1. Periksa apakah layanan XAMPP berjalan
  2. Pastikan basis data sudah terinstal dengan benar
  3. Periksa apakah semua file berada di direktori yang sesuai

## Fitur

- Autentikasi pengguna otomatis
- Manajemen peminjaman buku
- Pelacakan informasi peminjam
- Pemantauan status pinjaman
- Pengelolaan tanggal jatuh tempo

## Struktur Database

Database terdiri dari dua tabel utama:
1. **users**
   - Menyimpan data pengguna
   - Email dan password untuk autentikasi

2. **peminjaman**
   - ID peminjaman unik
   - Data peminjam (nama, nomor telepon)
   - Informasi buku
   - Tanggal pinjam dan kembali
   - Status peminjaman
