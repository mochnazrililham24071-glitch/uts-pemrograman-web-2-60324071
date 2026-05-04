-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Bulan Mei 2026 pada 13.23
-- Versi server: 8.0.30
-- Versi PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `uts_perpustakaan_60324071`
--
CREATE DATABASE IF NOT EXISTS `uts_perpustakaan_60324071` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `uts_perpustakaan_60324071`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kode_kategori` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Aktif','Nonaktif') COLLATE utf8mb4_unicode_ci DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`, `deskripsi`, `status`, `created_at`) VALUES
(1, 'KAT-001', 'Pemrograman', 'Buku pemrograman', 'Aktif', '2026-04-30 03:01:37'),
(2, 'KAT-002', 'Database', 'Buku database', 'Aktif', '2026-04-30 03:01:37'),
(3, 'KAT-003', 'Jaringan Komputer', 'Buku jaringan', 'Aktif', '2026-04-30 03:01:37'),
(5, 'KAT-004', 'Matematika Diskrit', 'Buku Pengetahuan', 'Aktif', '2026-05-04 11:23:22'),
(6, 'KAT-006', 'Desain Grafis', 'Buku Desain', 'Aktif', '2026-05-04 11:23:51'),
(8, 'KAT-009', 'Kalkulus', 'Buku Pengetahuan', 'Aktif', '2026-05-04 13:13:59'),
(9, 'KAT-0010', 'Moch. Nazril Ilham', 'Mahasiswa UIN K.H. Abdurrahman Wahid Pekalongan', 'Aktif', '2026-05-04 13:21:30');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `kode_kategori` (`kode_kategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
