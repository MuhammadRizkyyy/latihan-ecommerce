-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2023 at 11:27 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id` int(11) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id`, `bukti`, `status`) VALUES
(1, '63d7bba597b45.', 0),
(2, '63d7bc0c77c20.', 0),
(3, '63d7c26febfd6.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jasa_pengiriman` varchar(20) NOT NULL,
  `kode_pembayaran` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id`, `id_produk`, `nama`, `no_ktp`, `kode_pos`, `alamat`, `jasa_pengiriman`, `kode_pembayaran`, `status`) VALUES
(1, 16, 'Muhammad Rizky', '354254632', '10260', 'Jl petamburan 4', 'Sicepat', 'K661', 0),
(2, 16, 'rehan', '35463463', '10242', 'Jl petamburan 43', 'J&T', 'K662', 0),
(3, 13, 'iwan', '34523', '10260', 'Jl petamburan 43', 'JNE', 'K663', 0),
(4, 16, 'test', '3523523', '10260', 'Jl petamburan 4', 'J&T', 'K664', 0),
(5, 16, 'asd', '875875', '10260', 'Jl petamburan 4', 'Sicepat', 'K665', 0),
(6, 16, 'rizky', '35235', '35232', 'Jl petamburan 4', 'JNE', 'K666', 0),
(7, 16, 'rizky', '353523', '35253', 'Jl petamburan 4', 'J&T', 'K667', 0),
(8, 16, 'rizky', '2434', '10260', 'Jl petamburan 4', 'J&T', 'K668', 0),
(9, 13, 'rehan', '323523', '10260', 'Jl petamburan 4', 'Sicepat', 'K669', 0),
(10, 14, 'rizky', '2434325', '10260', 'Jl petamburan 4', 'J&T', 'K6610', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `judul_produk` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `judul_produk`, `harga`, `stok`, `deskripsi`, `gambar`) VALUES
(13, 'Printer Canon', 1000000, 10, 'Printer canon adalah printer yang paling bagus di petamburan, silakan dibeli karena dijamin gak baka', 'nopoto.png'),
(14, 'Printer Canon 666', 2000000, 10, 'Printer canon adalah printer yang paling bagus di petamburan, silakan dibeli karena dijamin gak baka', 'nopoto.png'),
(16, 'Printer Asus', 3000000, 0, 'Smartphone paling bagus ini mah', 'nopoto.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
