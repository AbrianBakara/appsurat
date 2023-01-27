-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2023 at 06:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasisurat`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(15) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(35) NOT NULL,
  `email` varchar(500) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2021-08-24 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`, `email`, `photo`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`, `user_role_id`) VALUES
(1, 'admin', '$2y$10$QVkGPnb1Ag.9Ds8Mhq31iuoRV9/TY8sqrrykLMK1gd4jUEc6hcvtm', 'Administrator', 'admin@gmail.com', 'http://localhost/appsuratmasukkeluar/uploads/files/1621929810.png', NULL, NULL, '2021-08-26 11:02:24', NULL, 1),
(2, 'user', '$2y$10$pC2c7jyWUK3HwQo4tCeFD..jB7EK4T5jRkMb7P1yMs2Dpnzd.XWbi', 'User', '12452@gamaial.com', 'http://localhost/appsuratmasukkeluar/uploads/files/1622020736.png', NULL, NULL, '2021-08-24 00:00:00', NULL, 2),
(4, 'debi', '$2y$10$/ovz0WKfbA.F6ea8MsDolutO1SaGQGumlI/.scPmgvCwI6TTZvYy.', 'debi', 'debi@d.co', 'http://localhost/appsuratmasukkeluar/uploads/files/1672285177.jpeg', NULL, NULL, '2021-08-24 00:00:00', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `perihalsurat`
--

CREATE TABLE `perihalsurat` (
  `id_perihal` int(15) NOT NULL,
  `perihal_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perihalsurat`
--

INSERT INTO `perihalsurat` (`id_perihal`, `perihal_name`) VALUES
(1, 'Surat Proyek'),
(2, 'Surat Magang');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `action_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`permission_id`, `role_id`, `page_name`, `action_name`) VALUES
(1, 1, 'pengguna', 'list'),
(2, 1, 'pengguna', 'view'),
(3, 1, 'pengguna', 'add'),
(4, 1, 'pengguna', 'edit'),
(5, 1, 'pengguna', 'editfield'),
(6, 1, 'pengguna', 'delete'),
(7, 1, 'pengguna', 'import_data'),
(8, 1, 'surat_keluar', 'list'),
(9, 1, 'surat_keluar', 'view'),
(10, 1, 'surat_keluar', 'add'),
(11, 1, 'surat_keluar', 'edit'),
(12, 1, 'surat_keluar', 'editfield'),
(13, 1, 'surat_keluar', 'delete'),
(14, 1, 'surat_keluar', 'import_data'),
(15, 1, 'perihalsurat', 'list'),
(16, 1, 'perihalsurat', 'view'),
(17, 1, 'perihalsurat', 'add'),
(18, 1, 'perihalsurat', 'edit'),
(19, 1, 'perihalsurat', 'editfield'),
(20, 1, 'perihalsurat', 'delete'),
(21, 1, 'perihalsurat', 'import_data'),
(22, 1, 'pengguna', 'accountedit'),
(23, 1, 'pengguna', 'accountview'),
(24, 1, 'role_permissions', 'list'),
(25, 1, 'role_permissions', 'view'),
(26, 1, 'role_permissions', 'add'),
(27, 1, 'role_permissions', 'edit'),
(28, 1, 'role_permissions', 'editfield'),
(29, 1, 'role_permissions', 'delete'),
(30, 1, 'roles', 'list'),
(31, 1, 'roles', 'view'),
(32, 1, 'roles', 'add'),
(33, 1, 'roles', 'edit'),
(34, 1, 'roles', 'editfield'),
(35, 1, 'roles', 'delete'),
(36, 2, 'surat_keluar', 'list'),
(37, 2, 'surat_keluar', 'view'),
(38, 2, 'surat_keluar', 'add'),
(39, 2, 'surat_keluar', 'edit'),
(40, 2, 'surat_keluar', 'editfield'),
(41, 2, 'perihalsurat', 'list'),
(42, 2, 'perihalsurat', 'view'),
(43, 2, 'perilahsurat', 'add'),
(44, 1, 'perihalsurat', 'edit'),
(45, 2, 'perihalsurat', 'editfield'),
(46, 2, 'pengguna', 'accountedit'),
(47, 2, 'pengguna', 'accountview');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `No_Agenda` int(15) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `Tujuan_surat` varchar(255) NOT NULL,
  `Nomor_surat` varchar(255) NOT NULL,
  `id_perihal` int(15) NOT NULL,
  `file_surat` varchar(500) NOT NULL,
  `tgl_entri` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`No_Agenda`, `tanggal_surat`, `Tujuan_surat`, `Nomor_surat`, `id_perihal`, `file_surat`, `tgl_entri`) VALUES
(5, '2023-01-05', 'Sekolah N2', '123/SP/12/2022', 2, 'http://localhost/appsuratmasukkeluar/uploads/files/4f6tjwlz93xn_ap.pdf', '2023-01-09 02:18:35'),
(6, '2023-01-05', 'Surat Keluar', '125/SP/12/2022', 2, 'http://localhost/appsuratmasukkeluar/uploads/files/mf9gdi_zrs71xko.pdf', '2023-01-12 03:58:25'),
(7, '2023-01-04', 'Sekolah N2', '123/SP/12/2022', 1, 'http://localhost/appsuratmasukkeluar/uploads/files/_phmurkag5bjy9f.pdf', '2023-01-09 02:23:42'),
(9, '2023-01-28', 'asd', 'asd', 1, 'http://localhost/appsuratmasukkeluar/uploads/files/m24zf0tkcqa96ub.xls', '2023-01-12 03:53:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perihalsurat`
--
ALTER TABLE `perihalsurat`
  ADD PRIMARY KEY (`id_perihal`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`No_Agenda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perihalsurat`
--
ALTER TABLE `perihalsurat`
  MODIFY `id_perihal` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `No_Agenda` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
