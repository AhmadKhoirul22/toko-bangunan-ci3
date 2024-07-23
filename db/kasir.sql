-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 23, 2024 at 01:02 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

DROP TABLE IF EXISTS `detail_pembelian`;
CREATE TABLE IF NOT EXISTS `detail_pembelian` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `kode_pembelian` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `sub_total` int NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_detail`, `kode_pembelian`, `id_produk`, `jumlah`, `sub_total`) VALUES
(4, 2407041, 10, 3, 6000),
(3, 2407041, 24, 5, 12500),
(5, 2407052, 6, 2, 10000),
(6, 2407052, 7, 2, 5000),
(7, 2407063, 5, 10, 35000),
(8, 2407063, 25, 10, 35000),
(9, 2407064, 5, 80, 280000),
(15, 2407165, 25, 10, 35000),
(16, 2407216, 6, 12, 60000),
(17, 2407216, 5, 20, 70000),
(18, 2407217, 7, 10, 25000),
(19, 2407217, 10, 10, 20000),
(20, 2407228, 10, 10, 20000),
(21, 2407228, 5, 10, 35000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `kode_penjualan` int NOT NULL,
  `sub_total` decimal(10,0) NOT NULL,
  `jumlah` int NOT NULL,
  `id_produk` int NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `kode_penjualan`, `sub_total`, `jumlah`, `id_produk`) VALUES
(51, 2407076, '42000', 12, 25),
(50, 2407076, '30000', 6, 6),
(49, 2407065, '7500', 3, 24),
(47, 2407054, '5000', 2, 7),
(48, 2407065, '17500', 5, 5),
(45, 2407033, '42000', 12, 9),
(46, 2407054, '10000', 2, 6),
(44, 2407033, '60000', 12, 6),
(43, 2407032, '70000', 20, 5),
(52, 2407107, '70000', 20, 5),
(68, 24072210, '5000', 2, 24),
(59, 2407158, '35000', 10, 5),
(42, 2407031, '5000', 2, 7),
(41, 2407031, '3500', 1, 5),
(67, 2407219, '50000', 10, 6),
(66, 2407219, '25000', 10, 7),
(69, 24072210, '31500', 9, 9),
(70, 24072311, '2500', 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `detail_utang_pembelian`
--

DROP TABLE IF EXISTS `detail_utang_pembelian`;
CREATE TABLE IF NOT EXISTS `detail_utang_pembelian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_pembelian` int NOT NULL,
  `cicilan_ke` varchar(20) NOT NULL,
  `nominal` int NOT NULL,
  `tanggal` date NOT NULL,
  `pembayaran` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_utang_pembelian`
--

INSERT INTO `detail_utang_pembelian` (`id`, `kode_pembelian`, `cicilan_ke`, `nominal`, `tanggal`, `pembayaran`) VALUES
(2, 2407041, 'DP', 15000, '2024-07-04', 'Tunai'),
(3, 2407041, '1', 2000, '2024-07-04', 'Tunai'),
(4, 2407052, 'DP', 12000, '2024-07-05', 'Tunai'),
(5, 2407063, 'DP', 70000, '2024-07-06', 'Tunai'),
(6, 2407064, 'DP', 280000, '2024-07-06', 'Tunai'),
(13, 2407165, 'DP', 25000, '2024-07-16', 'Tunai'),
(12, 2407125, 'DP', 12000, '2024-07-12', 'Tunai'),
(14, 2407216, 'DP', 0, '2024-07-21', 'Tunai'),
(15, 2407217, 'DP', 0, '2024-07-21', 'Tunai'),
(16, 2407228, 'DP', 0, '2024-07-22', 'Tunai');

-- --------------------------------------------------------

--
-- Table structure for table `detail_utang_penjualan`
--

DROP TABLE IF EXISTS `detail_utang_penjualan`;
CREATE TABLE IF NOT EXISTS `detail_utang_penjualan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_penjualan` int NOT NULL,
  `cicilan_ke` varchar(20) NOT NULL,
  `nominal` int NOT NULL,
  `tanggal` date NOT NULL,
  `pembayaran` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_utang_penjualan`
--

INSERT INTO `detail_utang_penjualan` (`id`, `kode_penjualan`, `cicilan_ke`, `nominal`, `tanggal`, `pembayaran`) VALUES
(6, 2407031, '1', 3000, '2024-07-03', 'Tunai'),
(5, 2407031, 'DP', 4000, '2024-07-03', 'Tunai'),
(7, 2407032, 'DP', 50000, '2024-07-03', 'Tunai'),
(8, 2407032, '1', 1000, '2024-07-03', 'Tunai'),
(9, 2407032, '2', 19000, '2024-07-03', 'Tunai'),
(10, 2407033, 'DP', 50000, '2024-07-03', 'Tunai'),
(11, 2407033, '1', 27000, '2024-07-03', 'Tunai'),
(12, 2407033, '2', 25000, '2024-07-03', 'Tunai'),
(13, 2407054, 'DP', 0, '2024-07-05', 'Tunai'),
(14, 2407065, 'DP', 5000, '2024-07-06', 'Tunai'),
(15, 2407076, 'DP', 72000, '2024-07-07', 'Tunai'),
(16, 2407054, '1', 5000, '2024-07-09', 'Tunai'),
(17, 2407054, '2', 20000, '2024-07-10', 'Tunai'),
(18, 2407107, 'DP', 60000, '2024-07-10', 'Tunai'),
(19, 2407065, '1', 5000, '2024-07-12', 'Tunai'),
(20, 2407065, '2', 5000, '2024-07-12', 'Tunai'),
(26, 2407128, 'DP', 12000, '2024-07-12', 'Tunai'),
(27, 2407158, 'DP', 20000, '2024-07-15', 'Tunai'),
(28, 2407158, '1', 15000, '2024-07-15', 'Tunai'),
(34, 24072210, 'DP', 0, '2024-07-22', 'Tunai'),
(33, 2407219, 'DP', 0, '2024-07-21', 'Tunai'),
(35, 24072311, 'DP', 0, '2024-07-23', 'Tunai');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(3, 'Pertanian'),
(4, 'Peternakan'),
(5, 'Pembangunan'),
(7, 'contoh'),
(8, 'alas'),
(9, 'terserah');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wa` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telp`, `wa`) VALUES
(1, 'Pelanggan Setia', 'PT Cinta Sejati, mojobanana, newkarang', '082134096836', 'https://wa.me/+6281259304531'),
(3, 'mamadz', 'mojobanana', '082134096836', 'https://wa.me/+6281259304531'),
(4, 'ubay', 'jakarta pusat', '082134096836', 'https://wa.me/+6281259304531'),
(9, 'cth', 'kwpo', '082134096836', 'https://wa.me/+6282124925044');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE IF NOT EXISTS `pembelian` (
  `id_pembelian` int NOT NULL AUTO_INCREMENT,
  `kode_pembelian` int NOT NULL,
  `id_supplier` int NOT NULL,
  `total_harga` int NOT NULL,
  `tanggal` date NOT NULL,
  `bayar` int NOT NULL,
  `pembayaran` varchar(10) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pembelian`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `kode_pembelian`, `id_supplier`, `total_harga`, `tanggal`, `bayar`, `pembayaran`, `keterangan`, `status`) VALUES
(2, 2407041, 2, 18500, '2024-07-04', 17000, 'Tunai', 'UTANG', 'SELESAI'),
(3, 2407052, 3, 15000, '2024-07-05', 12000, 'Tunai', 'UTANG', 'SELESAI'),
(4, 2407063, 2, 70000, '2024-07-06', 70000, 'Tunai', 'LUNAS', 'SELESAI'),
(5, 2407064, 3, 280000, '2024-07-06', 280000, 'Tunai', 'LUNAS', 'SELESAI'),
(11, 2407165, 2, 35000, '2024-07-16', 25000, 'Tunai', 'UTANG', 'SELESAI'),
(12, 2407216, 7, 130000, '2024-07-21', 0, 'Tunai', 'UTANG', 'SELESAI'),
(13, 2407217, 3, 45000, '2024-07-21', 0, 'Tunai', 'UTANG', 'DICANCEL'),
(14, 2407228, 7, 55000, '2024-07-22', 0, 'Tunai', 'UTANG', 'DICANCEL');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` int NOT NULL AUTO_INCREMENT,
  `kode_penjualan` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `id_pelanggan` int NOT NULL,
  `bayar` int NOT NULL,
  `pembayaran` varchar(10) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `kode_penjualan`, `tanggal`, `total_harga`, `id_pelanggan`, `bayar`, `pembayaran`, `keterangan`, `status`) VALUES
(22, '2407065', '2024-07-06', '25000', 4, 15000, 'Tunai', 'UTANG', 'SELESAI'),
(21, '2407054', '2024-07-05', '15000', 1, 25000, 'Tunai', 'LUNAS', 'SELESAI'),
(19, '2407032', '2024-07-03', '70000', 4, 50000, 'Tunai', 'LUNAS', 'SELESAI'),
(20, '2407033', '2024-07-03', '102000', 1, 102000, 'Tunai', 'LUNAS', 'SELESAI'),
(18, '2407031', '2024-07-03', '8500', 3, 4000, 'Tunai', 'LUNAS', 'SELESAI'),
(23, '2407076', '2024-07-07', '72000', 3, 72000, 'Tunai', 'LUNAS', 'SELESAI'),
(24, '2407107', '2024-07-10', '70000', 1, 60000, 'Tunai', 'UTANG', 'SELESAI'),
(31, '2407158', '2024-07-15', '35000', 1, 35000, 'Tunai', 'LUNAS', 'DICANCEL'),
(36, '2407219', '2024-07-21', '75000', 1, 0, 'Tunai', 'UTANG', 'DICANCEL'),
(37, '24072210', '2024-07-22', '36500', 3, 0, 'Tunai', 'UTANG', 'DICANCEL'),
(38, '24072311', '2024-07-23', '2500', 1, 0, 'Tunai', 'UTANG', 'DICANCEL');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(25) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `id_kategori` int NOT NULL,
  `stok` int NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama`, `id_kategori`, `stok`, `harga`) VALUES
(5, '240116122954', 'buku pintar', 4, 10, '3500'),
(6, '240121085512', 'snack', 4, 14, '5000'),
(7, '240201111200', 'pensil', 5, 10, '2500'),
(9, '240212095411', 'penggaris', 5, 57, '3500'),
(10, '240212095449', 'eraser', 5, 10, '2000'),
(24, 'kardus-ok', 'kardus', 3, 16, '2500'),
(25, '2403023', 'mie', 5, 20, '3500');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id_profile` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telp` varchar(20) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id_profile`, `nama`, `alamat`, `email`, `telp`, `no_rekening`) VALUES
(1, 'PT Sukses Bersama', 'Jl. Yos Sudarso, Jengglong, Bejen', 'nmhuda7@gmail.com', '082134096836', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` int NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat_supplier` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telp_supplier` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `telp_supplier`) VALUES
(2, 'supplier', 'mojobanana', '082134096836'),
(3, 'messi', 'miami', '082134096836'),
(7, 'Agus', 'miami', '0892');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
CREATE TABLE IF NOT EXISTS `temp` (
  `id_temp` int NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int NOT NULL,
  `id_user` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_temp`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temporary`
--

DROP TABLE IF EXISTS `temporary`;
CREATE TABLE IF NOT EXISTS `temporary` (
  `id_temporary` int NOT NULL AUTO_INCREMENT,
  `id_supplier` int NOT NULL,
  `id_produk` int NOT NULL,
  `id_user` int NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_temporary`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `temporary`
--

INSERT INTO `temporary` (`id_temporary`, `id_supplier`, `id_produk`, `id_user`, `jumlah`) VALUES
(16, 2, 10, 7, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(10) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(6, 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Admin Ganteng', 'Admin'),
(7, 'koko', '37f525e2b6fc3cb4abd882f708ab80eb', 'turtle', 'Admin'),
(5, 'Kasir', '5a048a5dfdc9d2c58452dbdbfb320b9e', 'Kasir :0', 'Kasir'),
(13, 'contoh', 'af0127c9ca458cfcff2c1046944b6b56', 'contoh', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `utang_pembelian`
--

DROP TABLE IF EXISTS `utang_pembelian`;
CREATE TABLE IF NOT EXISTS `utang_pembelian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_pembelian` int NOT NULL,
  `total_harga` int NOT NULL,
  `sisa` int NOT NULL,
  `id_supplier` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utang_pembelian`
--

INSERT INTO `utang_pembelian` (`id`, `kode_pembelian`, `total_harga`, `sisa`, `id_supplier`) VALUES
(3, 2407052, 15000, 3000, 3),
(2, 2407041, 18500, 1500, 2),
(4, 2407063, 70000, 0, 2),
(5, 2407064, 280000, 0, 3),
(10, 2407125, 12000, 0, 2),
(11, 2407165, 35000, 10000, 2),
(12, 2407216, 130000, 130000, 7),
(13, 2407217, 45000, 45000, 3),
(14, 2407228, 55000, 55000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `utang_penjualan`
--

DROP TABLE IF EXISTS `utang_penjualan`;
CREATE TABLE IF NOT EXISTS `utang_penjualan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_penjualan` int NOT NULL,
  `total_harga` int NOT NULL,
  `sisa` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utang_penjualan`
--

INSERT INTO `utang_penjualan` (`id`, `kode_penjualan`, `total_harga`, `sisa`, `id_pelanggan`) VALUES
(5, 2407031, 8500, 0, 3),
(6, 2407032, 70000, 0, 4),
(7, 2407033, 102000, 0, 1),
(8, 2407054, 15000, 0, 1),
(9, 2407065, 25000, 10000, 4),
(10, 2407076, 72000, 0, 3),
(11, 2407107, 70000, 10000, 1),
(17, 2407128, 12000, 0, 1),
(18, 2407158, 35000, 0, 1),
(24, 24072210, 36500, 36500, 3),
(23, 2407219, 75000, 75000, 1),
(25, 24072311, 2500, 2500, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
