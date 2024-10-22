-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 22 Okt 2024 pada 12.33
-- Versi server: 8.0.31
-- Versi PHP: 8.0.26

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
-- Struktur dari tabel `detail_pembelian`
--

DROP TABLE IF EXISTS `detail_pembelian`;
CREATE TABLE IF NOT EXISTS `detail_pembelian` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `kode_pembelian` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `sub_total` int NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_pembelian`
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
(21, 2407228, 5, 10, 35000),
(22, 2409231, 7, 10, 25000),
(23, 2409231, 5, 10, 35000),
(24, 2409242, 24, 6, 15000),
(25, 2409242, 10, 10, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `kode_penjualan` int NOT NULL,
  `jumlah` int NOT NULL,
  `id_produk` int NOT NULL,
  `harga_jual` int NOT NULL,
  `harga_beli` int NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `kode_penjualan`, `jumlah`, `id_produk`, `harga_jual`, `harga_beli`) VALUES
(80, 2410201, 2, 5, 3500, 2000),
(79, 2410201, 1, 24, 2500, 2000),
(81, 2410222, 2, 9, 3500, 3000),
(82, 2410222, 2, 10, 2000, 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_utang_pembelian`
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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_utang_pembelian`
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
(16, 2407228, 'DP', 0, '2024-07-22', 'Tunai'),
(17, 2409231, 'DP', 90000, '2024-09-23', 'Tunai'),
(18, 2407216, '1', 50000, '2024-09-24', 'Tunai'),
(19, 2407216, '2', 50000, '2024-09-24', 'Tunai'),
(20, 2407216, '3', 50000, '2024-09-24', 'Tunai'),
(21, 2407165, '1', 5000, '2024-09-24', 'Tunai'),
(22, 2407165, '2', 5000, '2024-09-24', 'Tunai'),
(23, 2407041, '2', 500, '2024-09-24', 'Tunai'),
(24, 2407041, '3', 1000, '2024-09-24', 'Tunai'),
(25, 2409242, 'DP', 0, '2024-09-24', 'Tunai'),
(26, 2409242, '1', 10000, '2024-09-24', 'Tunai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_utang_penjualan`
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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_utang_penjualan`
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
(35, 24072311, 'DP', 0, '2024-07-23', 'Tunai'),
(36, 2409221, 'DP', 30000, '2024-09-22', 'Tunai'),
(37, 2409232, 'DP', 50000, '2024-09-23', 'Tunai'),
(38, 2409233, 'DP', 21000, '2024-09-23', 'Tunai'),
(39, 2407065, '3', 5000, '2024-09-24', 'Tunai'),
(40, 2410201, 'DP', 15000, '2024-10-20', 'Tunai'),
(41, 2410201, 'DP', 10000, '2024-10-20', 'Tunai'),
(42, 2410222, 'DP', 2500, '2024-10-22', 'Tunai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori`
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
-- Struktur dari tabel `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_produk` int NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `id_produk`, `keterangan`, `tanggal`) VALUES
(2, 5, 'Stok diubah menjadi 20', '2024-10-20 19:43:26'),
(3, 5, 'Stok diubah menjadi 30', '2024-10-21 15:04:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
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
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telp`, `wa`) VALUES
(1, 'Pelanggan Setia', 'PT Cinta Sejati, mojobanana, newkarang', '082134096836', 'https://wa.me/+6281259304531'),
(3, 'mamadz', 'mojobanana', '082134096836', 'https://wa.me/+6281259304531'),
(4, 'ubay', 'jakarta pusat', '082134096836', 'https://wa.me/+6281259304531'),
(9, 'cth', 'kwpo', '082134096836', 'https://wa.me/+6282124925044');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `kode_pembelian`, `id_supplier`, `total_harga`, `tanggal`, `bayar`, `pembayaran`, `keterangan`, `status`) VALUES
(2, 2407041, 2, 18500, '2024-07-04', 18500, 'Tunai', 'LUNAS', 'SELESAI'),
(3, 2407052, 3, 15000, '2024-07-05', 12000, 'Tunai', 'UTANG', 'SELESAI'),
(4, 2407063, 2, 70000, '2024-07-06', 70000, 'Tunai', 'LUNAS', 'SELESAI'),
(5, 2407064, 3, 280000, '2024-07-06', 280000, 'Tunai', 'LUNAS', 'SELESAI'),
(11, 2407165, 2, 35000, '2024-07-16', 35000, 'Tunai', 'LUNAS', 'SELESAI'),
(12, 2407216, 7, 130000, '2024-07-21', 150000, 'Tunai', 'LUNAS', 'SELESAI'),
(13, 2407217, 3, 45000, '2024-07-21', 0, 'Tunai', 'UTANG', 'DICANCEL'),
(14, 2407228, 7, 55000, '2024-07-22', 0, 'Tunai', 'UTANG', 'DICANCEL'),
(15, 2409231, 7, 60000, '2024-09-23', 90000, 'Tunai', 'LUNAS', 'SELESAI'),
(16, 2409242, 3, 35000, '2024-09-24', 10000, 'Tunai', 'UTANG', 'SELESAI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `kode_penjualan`, `tanggal`, `total_harga`, `id_pelanggan`, `bayar`, `pembayaran`, `keterangan`, `status`) VALUES
(44, '2410222', '2024-10-22', '11000', 4, 2500, 'Tunai', 'UTANG', 'SELESAI'),
(43, '2410201', '2024-10-20', '9500', 1, 10000, 'Tunai', 'LUNAS', 'SELESAI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(25) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `id_kategori` int NOT NULL,
  `stok` int NOT NULL,
  `harga_jual` decimal(10,0) NOT NULL,
  `harga_beli` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama`, `id_kategori`, `stok`, `harga_jual`, `harga_beli`) VALUES
(5, '240116122954', 'buku pintar', 3, 30, '3000', '2000'),
(6, '240121085512', 'snack', 3, 12, '5000', '4000'),
(7, '240201111200', 'pensil', 3, 20, '2500', '2000'),
(9, '240212095411', 'penggaris', 3, 45, '3500', '3000'),
(10, '240212095449', 'eraser', 3, 13, '2000', '1000'),
(24, 'kardus-ok', 'kardus', 3, 11, '2500', '2000'),
(25, '2403023', 'mie', 3, 15, '3500', '3000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
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
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id_profile`, `nama`, `alamat`, `email`, `telp`, `no_rekening`) VALUES
(1, 'PT Baja Mulya Abadi', 'Jl. Yos Sudarso, Jengglong, Bejen, Kec. Karanganyar, Kabupaten Karanganyar, \r\nJawa Tengah 57716\r\n\r\n', 'nmhuda7@gmail.com', '082134096836', '1234567890');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
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
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `telp_supplier`) VALUES
(2, 'supplier', 'mojobanana', '082134096836'),
(3, 'messi', 'miami', '082134096836'),
(7, 'Agus', 'miami', '0892');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp`
--

DROP TABLE IF EXISTS `temp`;
CREATE TABLE IF NOT EXISTS `temp` (
  `id_temp` int NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int NOT NULL,
  `id_user` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_temp`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `temp`
--

INSERT INTO `temp` (`id_temp`, `id_pelanggan`, `id_user`, `id_produk`, `jumlah`) VALUES
(70, 3, 7, 5, 2),
(75, 1, 7, 10, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary`
--

DROP TABLE IF EXISTS `temporary`;
CREATE TABLE IF NOT EXISTS `temporary` (
  `id_temporary` int NOT NULL AUTO_INCREMENT,
  `id_supplier` int NOT NULL,
  `id_produk` int NOT NULL,
  `id_user` int NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_temporary`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `temporary`
--

INSERT INTO `temporary` (`id_temporary`, `id_supplier`, `id_produk`, `id_user`, `jumlah`) VALUES
(16, 2, 10, 7, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(10) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(6, 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Admin Ganteng', 'Admin'),
(7, 'koko', '37f525e2b6fc3cb4abd882f708ab80eb', 'turtle', 'Admin'),
(5, 'Kasir', 'ad641a7c2f9b4d9cca6f3e7a8452320c', 'Kasir :0', 'Kasir'),
(14, 'contoh', 'db6a2b4708dbc8823f96cb89f07acae4', 'contoh', 'Kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `utang_pembelian`
--

DROP TABLE IF EXISTS `utang_pembelian`;
CREATE TABLE IF NOT EXISTS `utang_pembelian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_pembelian` int NOT NULL,
  `total_harga` int NOT NULL,
  `sisa` int NOT NULL,
  `id_supplier` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `utang_pembelian`
--

INSERT INTO `utang_pembelian` (`id`, `kode_pembelian`, `total_harga`, `sisa`, `id_supplier`) VALUES
(3, 2407052, 15000, 3000, 3),
(2, 2407041, 18500, 0, 2),
(4, 2407063, 70000, 0, 2),
(5, 2407064, 280000, 0, 3),
(10, 2407125, 12000, 0, 2),
(11, 2407165, 35000, 0, 2),
(12, 2407216, 130000, 0, 7),
(13, 2407217, 45000, 45000, 3),
(14, 2407228, 55000, 55000, 7),
(15, 2409231, 60000, 0, 7),
(16, 2409242, 35000, 25000, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `utang_penjualan`
--

DROP TABLE IF EXISTS `utang_penjualan`;
CREATE TABLE IF NOT EXISTS `utang_penjualan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_penjualan` int NOT NULL,
  `total_harga` int NOT NULL,
  `sisa` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `utang_penjualan`
--

INSERT INTO `utang_penjualan` (`id`, `kode_penjualan`, `total_harga`, `sisa`, `id_pelanggan`) VALUES
(5, 2407031, 8500, 0, 3),
(6, 2407032, 70000, 0, 4),
(7, 2407033, 102000, 0, 1),
(8, 2407054, 15000, 0, 1),
(9, 2407065, 25000, 5000, 4),
(10, 2407076, 72000, 0, 3),
(11, 2407107, 70000, 10000, 1),
(17, 2407128, 12000, 0, 1),
(18, 2407158, 35000, 0, 1),
(24, 24072210, 36500, 36500, 3),
(23, 2407219, 75000, 75000, 1),
(25, 24072311, 2500, 2500, 1),
(26, 2409221, 27500, 0, 1),
(27, 2409232, 60000, 10000, 1),
(28, 2409233, 20500, 0, 3),
(31, 2410222, 11000, 8500, 4),
(30, 2410201, 9500, 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
