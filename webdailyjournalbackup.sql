-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2026 at 01:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdailyjournal`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Perpustakaan Kampus', 'Tempat untuk mencari sumber ilmu mandiri dengan membaca buku dalam suasana yang tenang dan nyaman.', 'perpustakaan.jpg', '2025-12-12 09:37:03', 'admin'),
(2, 'Ruang Kelas', 'Sarana utama dalam proses belajar mengajar dengan Dosen dalam pertemuan tatap muka di kampus.', 'kelas.jpg', '2025-12-12 09:37:03', 'admin'),
(3, 'Kelompok Belajar', 'Keantusiasan para mahasiswa dalam berkolaborasi sesama mahasiswa untuk membuat sebuah karya ilmiah.', 'kelompok belajar.jpg', '2025-12-12 09:59:29', 'admin'),
(4, 'Auditorium', 'Tempat untuk melakukan seminar pendidikan dalam lingkungan kampus.', 'auditorium.jpg', '2025-12-12 10:03:14', 'admin'),
(22, 'Taman', 'Jika suasanamu sedang buruk maka cobalah untuk belajar di ketenangan taman kecil kampus yang asri dan teduh.', 'taman.jpg', '2025-12-12 10:03:14', 'admin'),
(28, 'Ruang Lab', 'Sarana mahasiswa untuk melakukan praktek dalam proses belajar mengajar.', 'lab komputer.jpg', '2025-12-12 10:04:49', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `judul`, `gambar`, `tanggal`) VALUES
(1, 'Kegiatan Kampus', 'kelas.jpg', '2026-01-12 10:10:49'),
(2, 'Perpustakaan', 'perpustakaan.jpg', '2026-01-12 10:10:49'),
(3, 'Lab komputer', 'lab komputer.jpg', '2026-01-12 10:10:49'),
(4, 'Taman UDINUS', 'taman.jpg', '2026-01-12 10:10:49'),
(5, 'Auditorium', 'auditorium.jpg', '2026-01-12 10:10:49'),
(6, 'Gedung H', 'banner.jpg', '2026-01-12 10:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', ''),
(2, 'cahya', 'admin', 'profile.jpeg'),
(3, 'nabila', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
