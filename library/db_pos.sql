-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.5.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_pos.tbl_barang
CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_pos.tbl_barang: 5 rows
/*!40000 ALTER TABLE `tbl_barang` DISABLE KEYS */;
INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `id_kategori`, `harga_beli`, `harga_jual`, `diskon`, `stok`) VALUES
	(28, 'Buku Tulis', 26, 1500, 3000, 2, 130),
	(27, 'Chuba', 2, 2000, 6000, 0, 92),
	(25, 'Nescafe', 11, 4000, 7000, 5, 184),
	(26, 'Taro', 2, 3000, 6000, 5, 141),
	(29, 'Bakso', 2, 5000, 10000, 10, 25);
/*!40000 ALTER TABLE `tbl_barang` ENABLE KEYS */;

-- Dumping structure for table db_pos.tbl_kategori
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_pos.tbl_kategori: 3 rows
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
	(2, 'Makanan'),
	(26, 'Alat Tulis'),
	(11, 'Minuman');
/*!40000 ALTER TABLE `tbl_kategori` ENABLE KEYS */;

-- Dumping structure for table db_pos.tbl_keranjang
CREATE TABLE IF NOT EXISTS `tbl_keranjang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=339 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_pos.tbl_keranjang: 0 rows
/*!40000 ALTER TABLE `tbl_keranjang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_keranjang` ENABLE KEYS */;

-- Dumping structure for table db_pos.tbl_penjualan
CREATE TABLE IF NOT EXISTS `tbl_penjualan` (
  `no_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `status_trx` int(11) NOT NULL,
  PRIMARY KEY (`no_penjualan`)
) ENGINE=MyISAM AUTO_INCREMENT=2147483648 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_pos.tbl_penjualan: 3 rows
/*!40000 ALTER TABLE `tbl_penjualan` DISABLE KEYS */;
INSERT INTO `tbl_penjualan` (`no_penjualan`, `tgl_transaksi`, `username`, `status_trx`) VALUES
	(32988, '2023-03-28', 'kasir', 4),
	(28025, '2023-03-28', 'kasir', 4),
	(62905, '2023-03-28', 'kasir', 0);
/*!40000 ALTER TABLE `tbl_penjualan` ENABLE KEYS */;

-- Dumping structure for table db_pos.tbl_penjualan_item
CREATE TABLE IF NOT EXISTS `tbl_penjualan_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_pos.tbl_penjualan_item: 4 rows
/*!40000 ALTER TABLE `tbl_penjualan_item` DISABLE KEYS */;
INSERT INTO `tbl_penjualan_item` (`id`, `no_penjualan`, `id_barang`, `harga_jual`, `jumlah`) VALUES
	(209, 32988, 28, 2940, 5),
	(208, 28025, 25, 6650, 2),
	(207, 28025, 29, 9000, 5),
	(206, 62905, 29, 9000, 20);
/*!40000 ALTER TABLE `tbl_penjualan_item` ENABLE KEYS */;

-- Dumping structure for table db_pos.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=333 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_pos.tbl_users: 2 rows
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`id`, `username`, `password`, `nama_lengkap`, `level`) VALUES
	(3, 'admin', '$2y$10$oyiGFwt4Zi6EJUPup8z8iuFGXhpbhIya4CMmI1hUmdJ5dZlyGQTQW', 'Gibran Fajar Satritama ', 'admin'),
	(4, 'kasir', '$2y$10$OjI3O113HTY1PJOA3O0youjP72G/K.dom9M2vCsOICL6qkbk/VneK', 'Azkiya Zahra', 'kasir');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
