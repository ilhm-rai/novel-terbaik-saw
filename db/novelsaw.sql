-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Des 2021 pada 13.04
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novelsaw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id`, `kriteria_id`, `bobot`) VALUES
(37, 1, 5),
(38, 2, 15),
(39, 3, 15),
(40, 4, 10),
(41, 5, 5),
(42, 6, 20),
(43, 7, 10),
(44, 8, 5),
(45, 9, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `sampul` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `pengarang`, `sampul`) VALUES
(1, 'Laskar Pelangi', 'Andrea Hirata', '6125aa41e5a6f.jpg'),
(2, 'Ayat-Ayat Cinta 2', 'Habiburrahman El Shiraz', '6125ab02b77a8.jpg'),
(3, 'Dilan: Dia Adalah Dilanku Tahun 1990', 'Pidi Baiq', '6125ab6b08d03.jpg'),
(4, 'Dikta dan Hukum', 'Dhia\'an Farah', '6125af10e9dbe.jpg'),
(5, 'Filosofi Teras', 'Henry Manampiring', '6125af9c1fa95.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `hasil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id`, `buku_id`, `hasil`) VALUES
(1, 1, 93.335),
(2, 2, 83.75),
(3, 3, 79.58),
(4, 4, 82.915),
(5, 5, 96.25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `atribut` enum('Benefit','Cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`, `atribut`) VALUES
(1, 'Pengarang', 'Benefit'),
(2, 'Ulasan', 'Benefit'),
(3, 'Harga', 'Cost'),
(4, 'Bahasa', 'Benefit'),
(5, 'Orisinalitas', 'Benefit'),
(6, 'Judul', 'Benefit'),
(7, 'Penjualan', 'Benefit'),
(8, 'Jenis Kertas Sampul Buku', 'Benefit'),
(9, 'Desain Sampul', 'Benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_buku`
--

CREATE TABLE `nilai_buku` (
  `id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `nilai_kriteria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_buku`
--

INSERT INTO `nilai_buku` (`id`, `buku_id`, `kriteria_id`, `nilai_kriteria_id`) VALUES
(1, 5, 1, 2),
(2, 5, 2, 4),
(3, 5, 3, 11),
(4, 5, 4, 12),
(5, 5, 5, 14),
(6, 5, 6, 16),
(7, 5, 7, 19),
(8, 5, 8, 23),
(9, 5, 9, 26),
(10, 2, 1, 2),
(11, 2, 2, 4),
(12, 2, 3, 11),
(13, 2, 4, 12),
(14, 2, 5, 14),
(15, 2, 6, 17),
(16, 2, 7, 22),
(17, 2, 8, 23),
(18, 2, 9, 26),
(19, 3, 1, 3),
(20, 3, 2, 4),
(21, 3, 3, 9),
(22, 3, 4, 13),
(23, 3, 5, 14),
(24, 3, 6, 16),
(25, 3, 7, 19),
(26, 3, 8, 23),
(27, 3, 9, 26),
(28, 4, 1, 29),
(29, 4, 2, 4),
(30, 4, 3, 11),
(31, 4, 4, 12),
(32, 4, 5, 14),
(33, 4, 6, 17),
(34, 4, 7, 21),
(35, 4, 8, 23),
(36, 4, 9, 26),
(37, 1, 1, 3),
(38, 1, 2, 4),
(39, 1, 3, 11),
(40, 1, 4, 12),
(41, 1, 5, 14),
(42, 1, 6, 16),
(43, 1, 7, 21),
(44, 1, 8, 23),
(45, 1, 9, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nilai` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id`, `kriteria_id`, `keterangan`, `nilai`) VALUES
(1, 1, 'Sangat Terkenal', 1),
(2, 1, 'Terkenal', 0.75),
(3, 1, 'Cukup Terkenal', 0.5),
(4, 2, '4.1  - 5 ✨', 1),
(5, 2, '3.1 - 4 ✨', 0.75),
(6, 2, '2.1 - 3 ✨', 0.5),
(7, 2, '0 - 2 ✨', 0.25),
(8, 3, '>Rp250.000', 1),
(9, 3, 'Rp.150.000 - Rp.250.000', 0.75),
(10, 3, 'Rp.100.000 - Rp149.000', 0.5),
(11, 3, 'Rp.30.000 - Rp.99.000', 0.25),
(12, 4, 'Baku', 1),
(13, 4, 'Tidak Baku', 0.5),
(14, 5, 'Orisinal', 1),
(15, 5, 'Tidak Orisinal', 0),
(16, 6, 'Sangat Menarik', 1),
(17, 6, 'Menarik', 0.75),
(18, 6, 'Cukup Menarik', 0.5),
(19, 7, '>190pcs', 1),
(20, 7, '151pcs - 190pcs', 0.75),
(21, 7, '71pcs - 150pcs', 0.5),
(22, 7, '5pcs - 70pcs', 0.25),
(23, 8, 'Softcover', 1),
(24, 8, 'Hardcover', 0.75),
(25, 9, 'Sangat Menarik', 1),
(26, 9, 'Menarik', 0.75),
(27, 9, 'Cukup Menarik', 0.5),
(29, 1, 'Kurang Terkenal', 0.25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Fikri Ardi Faadhilah', 'admin', '$2y$10$78ZrCoBpixbSYfOW3IsP3e009EHcaS9PAbFtQfRt2wPXK2WqVWUnO');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_id` (`kriteria_id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_buku`
--
ALTER TABLE `nilai_buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_id` (`buku_id`),
  ADD KEY `kriteria_id` (`kriteria_id`),
  ADD KEY `nilai_kriteria_id` (`nilai_kriteria_id`);

--
-- Indeks untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_id` (`kriteria_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `nilai_buku`
--
ALTER TABLE `nilai_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_buku`
--
ALTER TABLE `nilai_buku`
  ADD CONSTRAINT `nilai_buku_ibfk_4` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_buku_ibfk_5` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_buku_ibfk_6` FOREIGN KEY (`nilai_kriteria_id`) REFERENCES `nilai_kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD CONSTRAINT `nilai_kriteria_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
