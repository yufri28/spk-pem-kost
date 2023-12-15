-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Des 2023 pada 07.56
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_pem_kost`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(5) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `jenis_kost` enum('Campuran','Laki-Laki','Perempuan') NOT NULL DEFAULT 'Campuran',
  `kecamatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `alamat`, `latitude`, `longitude`, `jenis_kost`, `kecamatan`) VALUES
(1, 'Kost Citra Berlian', '-', '-10.159801235570002', '123.66839311070447', 'Campuran', 'Kupang Tengah'),
(2, 'Kost Dhijori', '-', '-10.145142320862123', '123.66165838941485', 'Perempuan', 'Kota Raja'),
(5, 'Kost Vale Yellow', '-', '-10.16015807018046', '123.67088124562777', 'Campuran', 'Kupang Tengah'),
(6, 'Kost Hijau', '-', '-10.164529173838215', ' 123.63938195501278', 'Laki-Laki', 'Oebobo'),
(7, 'Kost Putri Linud', '-', '-10.161697241544436', '123.67063339366906', 'Campuran', 'Kupang Tengah'),
(8, 'Kost Kanaan 2', '-', '-10.156947871297211', '123.64573008685961', 'Campuran', 'Kelapa Lima'),
(9, 'Kost Biru Mess Gia', '-', '-10.170727424929614', '123.6549079800156', 'Laki-Laki', 'Maulafa'),
(68, 'Kost Theo', 'Tuak Daun Merah, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim. 85228', '-10.159259660282185', '123.63460081066292', 'Campuran', 'Oebobo'),
(69, 'Kost Nelly', 'RJRM+7PR, Gg. Gn. Econ, Tuak Daun Merah, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim. 85228', '-10.159209220565875', '123.63427862429924', 'Perempuan', 'Oebobo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id_bobot` int(11) NOT NULL,
  `C1` float NOT NULL,
  `C2` float NOT NULL,
  `C3` float NOT NULL,
  `C4` float NOT NULL,
  `C5` float NOT NULL,
  `f_id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot`, `C1`, `C2`, `C3`, `C4`, `C5`, `f_id_user`) VALUES
(14, 0.1, 0.2, 0.2, 0.2, 0.3, 5),
(15, 1, 0, 0, 0, 0, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecocokan_alt_kriteria`
--

CREATE TABLE `kecocokan_alt_kriteria` (
  `id_alt_kriteria` int(11) NOT NULL,
  `f_id_alternatif` int(5) NOT NULL,
  `f_id_kriteria` char(2) NOT NULL,
  `f_id_sub_kriteria` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kecocokan_alt_kriteria`
--

INSERT INTO `kecocokan_alt_kriteria` (`id_alt_kriteria`, `f_id_alternatif`, `f_id_kriteria`, `f_id_sub_kriteria`) VALUES
(1, 1, 'C1', 3),
(2, 1, 'C2', 8),
(3, 1, 'C3', 14),
(4, 1, 'C4', 18),
(5, 1, 'C5', 22),
(6, 2, 'C1', 3),
(7, 2, 'C2', 8),
(8, 2, 'C3', 12),
(9, 2, 'C4', 20),
(10, 2, 'C5', 23),
(21, 5, 'C1', 3),
(22, 5, 'C2', 7),
(23, 5, 'C3', 14),
(24, 5, 'C4', 18),
(25, 5, 'C5', 23),
(26, 6, 'C1', 4),
(27, 6, 'C2', 7),
(28, 6, 'C3', 12),
(29, 6, 'C4', 19),
(30, 6, 'C5', 23),
(31, 7, 'C1', 1),
(32, 7, 'C2', 7),
(33, 7, 'C3', 15),
(34, 7, 'C4', 19),
(35, 7, 'C5', 22),
(36, 8, 'C1', 1),
(37, 8, 'C2', 7),
(38, 8, 'C3', 15),
(39, 8, 'C4', 18),
(40, 8, 'C5', 22),
(41, 9, 'C1', 2),
(42, 9, 'C2', 7),
(43, 9, 'C3', 14),
(44, 9, 'C4', 19),
(45, 9, 'C5', 22),
(102, 68, 'C1', 3),
(103, 68, 'C2', 7),
(104, 68, 'C3', 18),
(105, 68, 'C4', 14),
(106, 68, 'C5', 23),
(107, 69, 'C1', 3),
(108, 69, 'C2', 8),
(109, 69, 'C3', 19),
(110, 69, 'C4', 13),
(111, 69, 'C5', 23);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` char(2) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL,
  `jenis_kriteria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `jenis_kriteria`) VALUES
('C1', 'Fasilitas', 'Benefit'),
('C2', 'Jarak', 'Cost'),
('C3', 'Biaya', 'Cost'),
('C4', 'Luas Kamar', 'Benefit'),
('C5', 'Keamanan', 'Benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(5) NOT NULL,
  `nama_sub_kriteria` varchar(150) NOT NULL,
  `bobot_sub_kriteria` int(11) NOT NULL,
  `f_id_kriteria` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `nama_sub_kriteria`, `bobot_sub_kriteria`, `f_id_kriteria`) VALUES
(1, 'Tidak memiliki atau hanya memiliki satu fasilitas', 1, 'C1'),
(2, 'Memiliki dua fasilitas', 2, 'C1'),
(3, 'Memiliki tiga fasilitas', 3, 'C1'),
(4, 'Memiliki empat fasilitas', 4, 'C1'),
(5, 'Memiliki lebih dari lima fasilitas', 5, 'C1'),
(6, '>2 km', 1, 'C2'),
(7, '>2 km', 2, 'C2'),
(8, '500 m ?1 km', 3, 'C2'),
(9, '250 m ? 1 km', 4, 'C2'),
(10, '>250 m', 5, 'C2'),
(11, '2 x 2 m2', 1, 'C4'),
(12, '2 x 3 m2', 2, 'C4'),
(13, '3 x 3 m2', 3, 'C4'),
(14, '3 x 4 m2', 4, 'C4'),
(15, '4 x 4 m2', 5, 'C4'),
(16, 'Harga 1', 1, 'C3'),
(17, 'Harga 2', 2, 'C3'),
(18, 'Harga 3', 3, 'C3'),
(19, 'Harga 4', 4, 'C3'),
(20, 'Harga 5', 5, 'C3'),
(21, 'Tidak Aman', 1, 'C5'),
(22, 'Cukup Aman', 3, 'C5'),
(23, 'Sangat Aman', 5, 'C5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_tampung`
--

CREATE TABLE `tabel_tampung` (
  `id` int(11) NOT NULL,
  `prio1` varchar(50) NOT NULL,
  `prio2` varchar(50) NOT NULL,
  `prio3` varchar(50) NOT NULL,
  `prio4` varchar(50) NOT NULL,
  `prio5` varchar(50) NOT NULL,
  `f_id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(5, 'yupi', '$2y$10$l5/1sEvffJfq58XYecARruHjepF3LE.2jfOVQ015j9oAtv1nYrxbm', 1),
(6, 'admin', '$2y$10$vKlD7o2zW7D0NyeRZ9gIOuq/H5cD/hjZgmjZ20.8.yRE9FHaJKqkq', 0),
(10, 'yupi', '$2y$10$vvyy19qet8e/qr08WmtliuceWtRELCjlb8tCvTMrnfdjLccBFNNgK', 1),
(11, 'yupi', '$2y$10$wgxBRnHjRKqaYmsnD70zW.Y753mRWyfYlRpLvArvdLSOi4EBfJqG6', 1),
(12, 'yupiw', '$2y$10$Azdj9.7xiIl8db2R6HDjNePvv9gc9w1qpF4Ezl2POJHw/FWqICo/W', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id_bobot`),
  ADD KEY `f_id_user` (`f_id_user`);

--
-- Indeks untuk tabel `kecocokan_alt_kriteria`
--
ALTER TABLE `kecocokan_alt_kriteria`
  ADD PRIMARY KEY (`id_alt_kriteria`),
  ADD KEY `f_id_alternatif` (`f_id_alternatif`,`f_id_kriteria`,`f_id_sub_kriteria`),
  ADD KEY `f_id_kriteria` (`f_id_kriteria`),
  ADD KEY `kecocokan_alt_kriteria_ibfk_2` (`f_id_sub_kriteria`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `f_id_kriteria` (`f_id_kriteria`);

--
-- Indeks untuk tabel `tabel_tampung`
--
ALTER TABLE `tabel_tampung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_id_user` (`f_id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `kecocokan_alt_kriteria`
--
ALTER TABLE `kecocokan_alt_kriteria`
  MODIFY `id_alt_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`f_id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kecocokan_alt_kriteria`
--
ALTER TABLE `kecocokan_alt_kriteria`
  ADD CONSTRAINT `kecocokan_alt_kriteria_ibfk_1` FOREIGN KEY (`f_id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kecocokan_alt_kriteria_ibfk_2` FOREIGN KEY (`f_id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kecocokan_alt_kriteria_ibfk_4` FOREIGN KEY (`f_id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`f_id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tabel_tampung`
--
ALTER TABLE `tabel_tampung`
  ADD CONSTRAINT `tabel_tampung_ibfk_1` FOREIGN KEY (`f_id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
