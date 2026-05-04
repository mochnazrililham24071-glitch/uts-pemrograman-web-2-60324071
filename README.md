Sistem Manajemen Kategori Buku

Nama: Moch. Nazril Ilham
NIM: 60324071

Deskripsi Aplikasi
Aplikasi ini merupakan sistem manajemen kategori buku berbasis web yang dibuat menggunakan PHP Native dan MySQL.
Aplikasi ini digunakan untuk mengelola data kategori buku di perpustakaan dengan fitur CRUD (Create, Read, Update, Delete).

Fitur utama:
1. Menampilkan daftar kategori buku
2. Menambahkan kategori baru
3. Mengedit data kategori
4. Menghapus kategori
5. Validasi input data

Cara Instalasi & Menjalankan Aplikasi
1. Persiapan:
Install Laragon/XAMPP
Jalankan Apache & MySQL

2. Clone/Copy Project
Letakkan folder project ke: C:\laragon\www\
Contoh: C:\laragon\www\UTS_60324071

3. Import Database
Buka: http://localhost/phpmyadmin
Lalu:
1. Buat database: CREATE DATABASE uts_perpustakaan_60324071;
2. Import file: uts_perpustakaan_60324071.sql
   Atau jalankan manual:
    CREATE TABLE kategori (
        id_kategori INT AUTO_INCREMENT PRIMARY KEY,
        kode_kategori VARCHAR(10) UNIQUE NOT NULL,
        nama_kategori VARCHAR(50) NOT NULL,
        deskripsi TEXT,
        status ENUM('Aktif','Nonaktif') DEFAULT 'Aktif',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

4. Konfigurasi Database
Buka file: config/database.php
Pastikan sesuai: $conn = new mysqli("localhost","root","","uts_perpustakaan_60324071");

5. Jalankan Aplikasi
Buka browser: http://localhost/Perpustakaan/P4/UTS_60324071

Struktur Folder:
UTS_60324071/
├── config/
│   └── database.php
├── index.php      (Read/Menampilkan Data)
├── create.php     (Create/Menambah Data Baru)
├── edit.php       (Update/Mengedit Data)
└── delete.php     (Delete/Menghapus Data)

Teknologi yang Digunakan
PHP Native, MySQL, Bootstrap 5

Catatan: Aplikasi ini dibuat untuk memenuhi tugas Ujian Tengah Semester (UTS) mata kuliah Pemrograman Web 2.
