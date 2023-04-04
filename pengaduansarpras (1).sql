-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 03:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduansarpras`
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
(1, 'Sarana', '2023-03-02 07:46:35', '2023-03-17 12:59:51'),
(3, 'prasarana', '2023-03-17 12:59:59', NULL);

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
  `ditanggapi` date DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `idUser`, `idKategori`, `judulAduan`, `kendala`, `tanggal`, `gambar`, `status`, `ditanggapi`, `createdAt`, `updatedAt`) VALUES
(12, 6, 1, 'komputer mati', 'mati', '2023-03-20', '5d37e8152aa6a1eb6a15360c92ce8021.jpeg', 1, '2023-03-20', '2023-03-20 14:26:32', '2023-03-20 14:27:22'),
(13, 7, 3, 'keluhan user2', 'user2', '2023-03-20', '02256e20572abe17e4a6d478c8aaf442.jpeg', 1, '2023-03-20', '2023-03-20 14:28:25', '2023-03-20 14:30:42'),
(14, 8, 3, 'keluhan user3', 'user3', '2023-03-20', '086123adcba5ffa2d3d0747bb78e5af9.jpeg', 2, '2023-03-20', '2023-03-20 14:29:10', '2023-03-20 14:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `plotpengaduan`
--

CREATE TABLE `plotpengaduan` (
  `id` int(11) NOT NULL,
  `idPengaduan` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `urgensi` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plotpengaduan`
--

INSERT INTO `plotpengaduan` (`id`, `idPengaduan`, `idUser`, `urgensi`, `status`, `createdAt`, `updatedAt`) VALUES
(10, 12, 10, 'Low', 0, '2023-03-20 14:27:31', NULL),
(11, 13, 11, 'Low', 0, '2023-03-20 14:30:52', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `tentang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `tentang`) VALUES
(1, '<p align=\"justify\">loremipakskandknaskdnjkasnnnddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</p><p align=\"justify\">loremipakskandknaskdnjkasnnnddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</p><div align=\"justify\"><ol><li>loremipakskandknaskdnjkasnnnddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</li></ol></div>');

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
(2, 'Ilham Teknisi', 'ilham.1', '$2y$10$kuG7iz/Is8/NsySSdUxZEeXUJCxaq5Vj7O81JAs4pro05BgsqAwL.', 2, '', '2023-03-02 07:05:19', '2023-03-11 05:48:20'),
(3, 'Ilham Mahasiswa', 'ilham.2', '$2y$10$1B689UVWBGCG5GAa9b.a6.vX7JfAhzzf7S5O9ar/v6sAC2dvCMLce', 4, '', '2023-03-02 07:05:43', NULL),
(4, 'Ilham Dosen', 'ilham.3', '$2y$10$1B689UVWBGCG5GAa9b.a6.vX7JfAhzzf7S5O9ar/v6sAC2dvCMLce', 3, '', '2023-03-02 07:05:43', NULL),
(5, 'Ilham Teknisi 2', 'ilham.4', '$2y$10$kuG7iz/Is8/NsySSdUxZEeXUJCxaq5Vj7O81JAs4pro05BgsqAwL.', 2, '', '2023-03-02 07:05:19', '2023-03-11 05:48:20'),
(6, 'user1', 'user1', '$2y$10$Meo.qnyvyNwkUbnNZ9nQfO.XoQwiGej3YihnTFp8wR5sAwswnzEJS', 4, '', '2023-03-17 13:02:05', NULL),
(7, 'user2', 'user2', '$2y$10$MpGXq8AfdhgrLJJVarYRUOiLTk1rYh8QLIH0XvbUg1hlvrFFQSpIK', 4, '', '2023-03-17 13:02:21', NULL),
(8, 'user3', 'user3', '$2y$10$r1wkG7wRCGKCO020RcCkc.oX1K1.nlqkCjMIFmkS0AEC3Ds6Tsa1i', 4, '', '2023-03-17 13:02:38', NULL),
(9, 'user4', 'user4', '$2y$10$PEF6ANFMM4fuhhCF9fZYR.SZcCCk78PQoLH5CmlkZyUNp./qZuM2W', 4, '', '2023-03-17 13:02:58', NULL),
(10, 'teknisi1', 'teknisi1', '$2y$10$xiV3zKG.9VESLe4NKmvzQuEAe/xWnbK4R2y3l2HkkAzMddHafcwAC', 2, '', '2023-03-17 13:03:46', NULL),
(11, 'teknisi2', 'teknisi2', '$2y$10$VlXLuPjrV2q/iTIfS5/6oe0tgaQ4lKMrBAgg5Ld6mI8RtgMSsR8ja', 2, '', '2023-03-17 13:04:03', NULL),
(12, 'teknisi3', 'teknisi3', '$2y$10$Fl.HWUwXCs47kqE2O8H05eQTechHIjjIFB/ijq4JaaNa..GWBPG2W', 2, '', '2023-03-17 13:04:25', NULL),
(13, 'A', '123', '$2y$10$sy3IDyY/u5/xnIXlk91Nn.S0x9al9AAAKm2UWdmLp7gqbxlbkkDtu', 4, '', '2023-03-17 13:58:07', NULL),
(14, 'B', '098', '$2y$10$NgCwFksABUiGkW0kkPO1X.uZJYtba/9cd91/wpfBvMBb2Pmj.6T0S', 2, '', '2023-03-17 13:58:36', NULL),
(15, 'teknisi6', 'teknisi6', '$2y$10$hdnqGNCuNtTBB.ejPRJKd.B4zx4wrxcn.Wf8zmP7ldqLNl4vGmPT6', 2, '', '2023-03-20 14:21:33', NULL),
(16, 'dosen', 'dosen', '$2y$10$YBzoYR3qZl9LFrjlqDEqC.kd4r557LpO01VfZV1vm6anPHjeeS4Uy', 3, '', '2023-03-20 14:21:51', NULL),
(17, 'mahasiswa7', 'user7', '$2y$10$nkeoy6gU6X5tsEL84SOos.T92ioL8WsXudqXQil0Po.1nFJihLGt2', 4, '', '2023-03-20 14:22:34', NULL),
(18, 'admin2', 'admin2', '$2y$10$w977aEnb.cI5B0.J07FZCeUI0EXd5ILDSywmqK6kwypfhtsYe4Adm', 1, '', '2023-03-20 14:23:01', NULL);

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
-- Indexes for table `plotpengaduan`
--
ALTER TABLE `plotpengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `plotpengaduan`
--
ALTER TABLE `plotpengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
