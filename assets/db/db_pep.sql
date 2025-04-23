-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Apr 2025 pada 10.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pep`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`, `role`) VALUES
(1001, 'admin', 'admin@123', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_datastakeholder`
--

CREATE TABLE `tb_datastakeholder` (
  `id` int(11) NOT NULL,
  `nama_pengisi` varchar(100) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_datastakeholder`
--

INSERT INTO `tb_datastakeholder` (`id`, `nama_pengisi`, `perusahaan`, `jabatan`, `email`, `no_hp`) VALUES
(5, 'Muhammad Rahyan Noorfauzan', 'Universitas Negeri Makassar', 'Rektor', 'rahyannn@gmail.com', '082152911426'),
(6, 'Muhammad Rahyan Noorfauzan', 'Universitas Negeri Makassar', 'Rektor', 'rahyannn@gmail.com', '082152911426'),
(7, 'Andi Aidin Akbar', 'Universitas Negeri Makassar', 'Dosen', 'aidin@gmail.com', '081234567890'),
(8, 'Andi Aidin Akbar', 'Universitas Negeri Makassar', 'Dosen', 'aidin@gmail.com', '081234567890'),
(9, 'Andi Aidin Akbar', 'Universitas Negeri Makassar', 'Ketua Jurusan', 'aidin@gmail.com', '082152911427'),
(10, 'Muhammad Raihan', 'Universitas Negeri Makassar', 'Dosen', 'raihan@gmail.com', '082152911426'),
(11, 'Dr. Mustari S. Lamada, S.Pd. M.T.', 'Universitas Negeri Makassar', 'Wakil Dekan III FT UNM', 'mustari@unm.ac.id', '081234567890');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penilaianstakeholder`
--

CREATE TABLE `tb_penilaianstakeholder` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_stakeholder` varchar(100) NOT NULL,
  `nama_alumni` varchar(150) NOT NULL,
  `tahun_lulus` varchar(5) NOT NULL,
  `pertanyaan_1` enum('1','2','3','4') NOT NULL,
  `pertanyaan_2` enum('1','2','3','4') NOT NULL,
  `pertanyaan_3` enum('1','2','3','4') NOT NULL,
  `pertanyaan_4` enum('1','2','3','4') NOT NULL,
  `pertanyaan_5` enum('1','2','3','4') NOT NULL,
  `pertanyaan_6` enum('1','2','3','4') NOT NULL,
  `pertanyaan_7` enum('1','2','3','4') NOT NULL,
  `harapan` text NOT NULL,
  `saran_masukan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_penilaianstakeholder`
--

INSERT INTO `tb_penilaianstakeholder` (`id`, `tanggal`, `nama_stakeholder`, `nama_alumni`, `tahun_lulus`, `pertanyaan_1`, `pertanyaan_2`, `pertanyaan_3`, `pertanyaan_4`, `pertanyaan_5`, `pertanyaan_6`, `pertanyaan_7`, `harapan`, `saran_masukan`) VALUES
(4, '2025-04-23', 'Muhammad Rahyan Noorfauzan', 'Muh Rafi Adnur', '2027', '4', '4', '4', '4', '4', '4', '4', 'Tes', 'Tes'),
(5, '2025-04-23', 'Muhammad Rahyan Noorfauzan', 'Muhammad Akhsan Awaluddin', '2027', '4', '3', '4', '3', '3', '3', '3', 'Tes', 'Tes'),
(6, '2025-04-23', 'Andi Aidin Akbar', 'Muh Alfauzi Arif', '2027', '4', '3', '3', '3', '4', '4', '4', 'Tes', 'Tes'),
(7, '2025-04-23', 'Andi Aidin Akbar', 'Muh Ichwanul T.', '2027', '3', '3', '3', '3', '3', '3', '3', 'tess', 'test'),
(8, '2025-04-23', 'Andi Aidin Akbar', 'Muh Raihan', '2028', '4', '4', '4', '4', '4', '4', '4', 'Tes', 'Tes'),
(10, '2025-04-23', 'Dr. Mustari S. Lamada, S.Pd. M.T.', 'Muhammad Rahyan Noorfauzan', '2028', '4', '2', '2', '3', '3', '2', '4', 'Bagus, Tingkatkan Skill', 'Pertahankan Kurikulum');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `tb_datastakeholder`
--
ALTER TABLE `tb_datastakeholder`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_penilaianstakeholder`
--
ALTER TABLE `tb_penilaianstakeholder`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT untuk tabel `tb_datastakeholder`
--
ALTER TABLE `tb_datastakeholder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_penilaianstakeholder`
--
ALTER TABLE `tb_penilaianstakeholder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
