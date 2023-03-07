-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2023 at 08:08 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduanSarpras`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `namaKategori` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `namaKategori`, `createdAt`, `updatedAt`) VALUES
(1, 'Sarana dan Prasarana', '2023-03-02 07:46:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idKategori` int(11) NOT NULL,
  `judulAduan` text NOT NULL,
  `kendala` text NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `idUser`, `idKategori`, `judulAduan`, `kendala`, `tanggal`, `gambar`, `status`, `createdAt`, `updatedAt`) VALUES
(4, 3, 1, 'Wifi error', 'ga bisa konek', '2023-03-07', '1b5510567a1a31781b4ddbb69c833d94.png', 1, '2023-03-07 06:37:08', '2023-03-07 06:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `plotPengaduan`
--

CREATE TABLE `plotPengaduan` (
  `id` int(11) NOT NULL,
  `idPengaduan` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `urgensi` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plotPengaduan`
--

INSERT INTO `plotPengaduan` (`id`, `idPengaduan`, `idUser`, `urgensi`, `status`, `createdAt`, `updatedAt`) VALUES
(3, 4, 2, 'Middle', 1, '2023-03-07 06:39:44', '2023-03-07 06:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPlot` int(11) NOT NULL,
  `idPengaduan` int(11) NOT NULL,
  `solusi` varchar(255) NOT NULL,
  `rincian` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `jam_selesai` time NOT NULL,
  `gambar` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `idUser`, `idPlot`, `idPengaduan`, `solusi`, `rincian`, `tanggal_mulai`, `jam_mulai`, `tanggal_selesai`, `jam_selesai`, `gambar`, `createdAt`, `updatedAt`) VALUES
(3, 2, 3, 4, 'Restart perangkat', 'Restart smartphone atau pc, kemudian koneksikan kembali', '2023-03-07', '13:40:00', '2023-03-07', '13:50:00', '75f57a6e2890affaaf147b03e5b46349.png', '2023-03-07 06:43:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `foto` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`, `foto`, `createdAt`, `updatedAt`) VALUES
(1, 'Super Admin', 'admin', '$2y$10$ZdZIpysS8TWn8cTr5Awao.nEY4RXnkUYijO1YWhqSUQGgfrRLzFyi', 1, 'default.png', '2023-03-02 01:55:57', '2023-03-02 01:56:28'),
(2, 'Ilham', 'ilham.1', '$2y$10$kuG7iz/Is8/NsySSdUxZEeXUJCxaq5Vj7O81JAs4pro05BgsqAwL.', 2, '', '2023-03-02 07:05:19', '2023-03-02 07:14:37'),
(3, 'Ilham Mahasiswa', 'ilham.2', '$2y$10$1B689UVWBGCG5GAa9b.a6.vX7JfAhzzf7S5O9ar/v6sAC2dvCMLce', 4, '', '2023-03-02 07:05:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plotPengaduan`
--
ALTER TABLE `plotPengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
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
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plotPengaduan`
--
ALTER TABLE `plotPengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
