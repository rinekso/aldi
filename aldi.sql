-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2019 at 07:46 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aldi`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id_jenis_transaksi` int(10) UNSIGNED NOT NULL,
  `nama_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id_jenis_transaksi`, `nama_transaksi`, `created_at`, `updated_at`) VALUES
(1, 'SPP', NULL, NULL),
(2, 'UTS', NULL, NULL),
(3, 'UAS', NULL, NULL),
(4, 'Kalender', NULL, NULL),
(5, 'Buku', NULL, NULL),
(6, 'Kartu Pelajar', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenjang`
--

CREATE TABLE `jenjang` (
  `id_jenjang` int(10) UNSIGNED NOT NULL,
  `nama_jenjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenjang`
--

INSERT INTO `jenjang` (`id_jenjang`, `nama_jenjang`, `created_at`, `updated_at`) VALUES
(1, 'smp', NULL, NULL),
(2, 'sma', NULL, NULL),
(3, 'smk', NULL, NULL),
(4, 'mts', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(10) UNSIGNED NOT NULL,
  `tingkat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `tingkat`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logintemp`
--

CREATE TABLE `logintemp` (
  `id` int(11) NOT NULL,
  `rfid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintemp`
--

INSERT INTO `logintemp` (`id`, `rfid`, `password`, `code`) VALUES
(2, 'asd123', '123', '89071');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_06_05_162201_create_user_role_table', 1),
(3, '2019_06_05_162416_create_jenjang_table', 1),
(4, '2019_06_05_162529_create_kelas_table', 1),
(5, '2019_06_05_162656_create_transaksi_table', 1),
(6, '2019_06_05_163059_create_pembayaran_table', 1),
(7, '2019_06_05_163644_create_jenis_transaksi_table', 1),
(8, '2019_06_05_163943_create_periode_table', 1),
(9, '2019_06_07_134845_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(10) UNSIGNED NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jenis_transaksi` int(11) NOT NULL,
  `id_jenjang` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_kelas`, `id_jenis_transaksi`, `id_jenjang`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 2, 200000, NULL, '2019-07-01 13:02:31'),
(2, 3, 4, 2, 50000, NULL, NULL),
(3, 2, 4, 2, 50000, NULL, NULL),
(4, 3, 2, 2, 100000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(10) UNSIGNED NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `nama_periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id_periode`, `id_pembayaran`, `nama_periode`, `tahun`, `created_at`, `updated_at`) VALUES
(38, 1, 'January', 2019, NULL, NULL),
(39, 1, 'February', 2019, NULL, NULL),
(40, 1, 'March', 2019, NULL, NULL),
(41, 1, 'April', 2019, NULL, NULL),
(42, 1, 'May', 2019, NULL, NULL),
(43, 1, 'June', 2019, NULL, NULL),
(44, 1, 'July', 2019, NULL, NULL),
(45, 1, 'August', 2019, NULL, NULL),
(46, 1, 'September', 2019, NULL, NULL),
(47, 1, 'October', 2019, NULL, NULL),
(48, 1, 'November', 2019, NULL, NULL),
(49, 1, 'December', 2019, NULL, NULL),
(50, 1, 'January', 2020, NULL, NULL),
(51, 1, 'February', 2020, NULL, NULL),
(52, 1, 'March', 2020, NULL, NULL),
(53, 1, 'April', 2020, NULL, NULL),
(54, 1, 'May', 2020, NULL, NULL),
(55, 1, 'June', 2020, NULL, NULL),
(56, 1, 'July', 2020, NULL, NULL),
(57, 1, 'August', 2020, NULL, NULL),
(58, 1, 'September', 2020, NULL, NULL),
(59, 1, 'October', 2020, NULL, NULL),
(60, 1, 'November', 2020, NULL, NULL),
(61, 1, 'December', 2020, NULL, NULL),
(62, 2, 'kalender tahunan', 2019, NULL, NULL),
(63, 4, 'semester ganjil', 2019, NULL, NULL),
(64, 4, 'semester genap', 2019, '2019-07-06 08:39:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topup`
--

CREATE TABLE `topup` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode` varchar(15) NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topup`
--

INSERT INTO `topup` (`id`, `id_user`, `kode`, `nominal`, `created_at`, `updated_at`) VALUES
(3, 2, '3-2-30508', 300000, '2019-07-04 01:18:27', '2019-07-04 08:18:27'),
(4, 2, '3-2-25051', 500000, '2019-07-04 20:49:11', '2019-07-05 03:49:11'),
(5, 2, '3-2-16256', 1000000000, '2019-07-06 08:33:49', '2019-07-06 15:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode`, `id_pembayaran`, `id_periode`, `id_user`, `created_at`, `updated_at`) VALUES
(40, '3-2-60223', 1, 44, 2, '2019-01-08 01:38:06', NULL),
(41, '3-2-22137', 1, 49, 2, '2019-02-08 21:15:44', NULL),
(42, '3-2-91386', 1, 48, 2, '2019-03-08 21:15:50', NULL),
(43, '3-2-95058', 1, 47, 2, '2019-04-08 21:15:56', NULL),
(44, '3-2-21420', 1, 46, 2, '2019-05-08 21:16:03', NULL),
(45, '3-2-99030', 1, 43, 2, '2019-06-08 21:16:08', NULL),
(46, '3-2-18382', 1, 45, 2, '2019-07-08 21:16:14', NULL),
(47, '3-2-40731', 1, 42, 2, '2019-08-08 21:16:22', NULL),
(48, '3-2-90359', 1, 41, 2, '2019-09-08 21:16:28', NULL),
(49, '3-2-81529', 1, 40, 2, '2019-10-08 21:16:32', NULL),
(50, '3-2-96374', 1, 39, 2, '2019-11-08 21:16:38', NULL),
(51, '3-2-64978', 1, 38, 2, '2019-12-08 21:16:42', NULL),
(52, '3-2-83888', 4, 63, 2, '2019-07-08 21:51:37', NULL),
(54, '3-2-86300', 4, 64, 2, '2019-07-08 22:05:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jenjang` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_user_role` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_jenjang`, `id_kelas`, `id_user_role`, `nama`, `rfid`, `nik`, `tahun_ajaran`, `saldo`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'admin', 'asd', '123', '2010/2011', 0, '$2y$10$heiXrjfjSbC3Ae09FeQVJexGZAxYBbRwIUuBg4.D5WxyRvR8byb/K', '3JHZv0S6zAxBgq7AFRQiRdQcElmvhH9mp907m8PhIw0E5FgEdDgJTEeU4wSO', NULL, NULL),
(2, 2, 3, 3, 'aldi', 'asd123', '123123', '2019/2020', 1000000, '$2y$10$loF36PO9EFndOTZcOIn.DOu2Axd2q0ntg6h8uXFu7u6CK6.e/14N2', 'IMpca9HRl4WHchepQgRzdfO9zgXZqw7UZD9YqZs1lOEfs8NeaGFx7NPrqLGg', NULL, '2019-07-08 22:42:02'),
(4, 1, 1, 3, 'simson rinekso', '954BD7FC', '123', '2019/2020', 100000, '$2y$10$KswZgKVI9Us4hLpOiKZKnOc.LqkE88.PUECtvISt4AD9JWa6z.MaK', 'LbdbX40PaDUYJSAgXdY0dLlWoWgOoPcQHIytKzTNI2orl5h4NeXYGKirjgEQ', NULL, '2019-07-04 20:47:21'),
(8, 1, 1, 2, 'topup', 'asd123', '123', '2019/2020', 0, '$2y$10$heiXrjfjSbC3Ae09FeQVJexGZAxYBbRwIUuBg4.D5WxyRvR8byb/K', NULL, NULL, NULL),
(9, 1, 1, 3, 'asd', 'as123', '123123123123123123', '2019/2020', 200000, '$2y$10$pxg89k1YqCh7298adIPkt.ZP2j6UwvYs7dmodoozJb9H2XmoerH4W', NULL, '2019-07-06 04:45:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_user_role` int(10) UNSIGNED NOT NULL,
  `nama_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_user_role`, `nama_role`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'admin_topup', NULL, NULL),
(3, 'user', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id_jenis_transaksi`);

--
-- Indexes for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`id_jenjang`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `logintemp`
--
ALTER TABLE `logintemp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `topup`
--
ALTER TABLE `topup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_user_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id_jenis_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `id_jenjang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logintemp`
--
ALTER TABLE `logintemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `topup`
--
ALTER TABLE `topup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_user_role` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
