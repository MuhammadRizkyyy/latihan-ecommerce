-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 08:46 AM
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
  `idpembelian` int(11) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id`, `idpembelian`, `bukti`, `status`) VALUES
(3, 1, '63d9dd9d40b90.jpg', 2),
(4, 4, '63da14ad8c505.jpg', 2),
(5, 5, '63da17856cce4.jpg', 2),
(6, 6, '63da185b424d3.jpeg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `idpembelian` int(11) NOT NULL,
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

INSERT INTO `tb_pembelian` (`idpembelian`, `id_produk`, `nama`, `no_ktp`, `kode_pos`, `alamat`, `jasa_pengiriman`, `kode_pembayaran`, `status`) VALUES
(1, 19, 'rizky', '352624', '10260', 'Jl petamburan 4', 'Sicepat', 'K661', 2),
(2, 13, 'rizky', '35264', '10260', 'Jl petamburan 4', 'J&T', 'K662', 2),
(3, 20, 'iwan', '3523656', '10260', 'Jl petamburan 43', 'Sicepat', 'K663', 2),
(4, 14, 'rizky', '3235235', '10260', 'Jl petamburan 4', 'JNE', 'K664', 2),
(5, 14, 'rehan', '2', '10260', 'Jl petamburan 43', 'J&T', 'K665', 2),
(6, 13, 'zann', '1411034', '875636', 're68h76ji8knjuy trewdcrftgyhuimol,kmjhbgdas', 'JNE', 'K666', 2);

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
(13, 'Printer Canon 2000', 1000000, 10, 'Printer canon adalah printer yang paling bagus di petamburan, silakan dibeli karena dijamin gak baka', 'nopoto.png'),
(14, 'Printer Canon 1999', 2000000, 10, 'Printer canon adalah printer yang paling bagus di petamburan, silakan dibeli karena dijamin gak baka', 'nopoto.png'),
(18, 'Printer Acer 234', 2000000, 200, 'Smartphone paling bagus ini mah', 'nopoto.png'),
(19, 'Printer Asus', 2000000, 10, 'tahan banting', '63d8a20e84d76.jpg'),
(20, 'Printer Acer 234', 1000000, 10, 'Smartphone paling bagus ini mah', '63d9e1b9f219e.jpg'),
(21, 'TES', 123, 1, 'SSS', '63d9e2417f7c8.jpg');

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
  ADD PRIMARY KEY (`idpembelian`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `idpembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
