-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2023 at 12:06 AM
-- Server version: 10.3.37-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siskeu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaranspbj`
--

CREATE TABLE `tb_pembayaranspbj` (
  `kode` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `penerima` varchar(64) NOT NULL,
  `no_spbj` varchar(256) NOT NULL,
  `area` varchar(256) NOT NULL,
  `nilai_spbj` int(50) NOT NULL,
  `pemasukkan` int(50) NOT NULL,
  `pengiriman` int(50) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `bukti_transaksi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengeluaranbos`
--

CREATE TABLE `tb_pengeluaranbos` (
  `kode` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `uraian` varchar(256) NOT NULL,
  `penerima` varchar(64) NOT NULL,
  `kebutuhan` varchar(256) NOT NULL,
  `satuan` int(50) NOT NULL,
  `volume` int(50) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `bukti_transaksi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_token`
--

CREATE TABLE `tb_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `kode` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jenis` varchar(64) NOT NULL,
  `uraian` varchar(256) NOT NULL,
  `penerima` varchar(64) NOT NULL,
  `kebutuhan` varchar(256) NOT NULL,
  `satuan` int(50) NOT NULL,
  `volume` int(50) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `bukti_transaksi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(17, 'M Donny Irwansyah', 'pimpinan@gmail.com', 'default.png', '$2y$10$So6N8mwoEwyAzvbHadSSruiK9WX7QKOTLdFBrs0x0zPkQ6DWlCvKy', 1, 1, 1600924469);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_pembayaranspbj`
--
ALTER TABLE `tb_pembayaranspbj`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `tb_pengeluaranbos`
--
ALTER TABLE `tb_pengeluaranbos`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pembayaranspbj`
--
ALTER TABLE `tb_pembayaranspbj`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengeluaranbos`
--
ALTER TABLE `tb_pengeluaranbos`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_token`
--
ALTER TABLE `tb_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
