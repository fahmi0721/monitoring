-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_monitoring
DROP DATABASE IF EXISTS `db_monitoring`;
CREATE DATABASE IF NOT EXISTS `db_monitoring` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_monitoring`;

-- Dumping structure for table db_monitoring.m_sumber_arus_kas
DROP TABLE IF EXISTS `m_sumber_arus_kas`;
CREATE TABLE IF NOT EXISTS `m_sumber_arus_kas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_arus_kas` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_arus_kas` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `m_sumber_arus_kas_kode_arus_kas_unique` (`kode_arus_kas`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_monitoring.m_sumber_arus_kas: ~2 rows (approximately)
DELETE FROM `m_sumber_arus_kas`;
/*!40000 ALTER TABLE `m_sumber_arus_kas` DISABLE KEYS */;
INSERT INTO `m_sumber_arus_kas` (`id`, `kode_arus_kas`, `nama_arus_kas`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, 'ARK001', 'OPERASI', 'ARUS KAS DARI AKTIVITAS OPERASI', NULL, NULL);
INSERT INTO `m_sumber_arus_kas` (`id`, `kode_arus_kas`, `nama_arus_kas`, `keterangan`, `created_at`, `updated_at`) VALUES
	(2, 'ARK002', 'INVESTASI', 'ARUS KAS DARI AKTIVITAS INVESTASI', NULL, NULL);
INSERT INTO `m_sumber_arus_kas` (`id`, `kode_arus_kas`, `nama_arus_kas`, `keterangan`, `created_at`, `updated_at`) VALUES
	(3, 'ARK003', 'PENDANAAN', 'ARUS KAS DARI AKTIVITAS PENDANAAN', NULL, NULL);
/*!40000 ALTER TABLE `m_sumber_arus_kas` ENABLE KEYS */;

-- Dumping structure for table db_monitoring.t_periode_sumber_arus_kas
DROP TABLE IF EXISTS `t_periode_sumber_arus_kas`;
CREATE TABLE IF NOT EXISTS `t_periode_sumber_arus_kas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periode` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo_awal` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `t_periode_sumber_arus_kas_periode_unique` (`periode`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_monitoring.t_periode_sumber_arus_kas: ~4 rows (approximately)
DELETE FROM `t_periode_sumber_arus_kas`;
/*!40000 ALTER TABLE `t_periode_sumber_arus_kas` DISABLE KEYS */;
INSERT INTO `t_periode_sumber_arus_kas` (`id`, `periode`, `keterangan`, `saldo_awal`, `created_at`, `updated_at`) VALUES
	(1, '012023', 'Januari 2023', 28239, '2023-06-15 11:38:17', NULL);
INSERT INTO `t_periode_sumber_arus_kas` (`id`, `periode`, `keterangan`, `saldo_awal`, `created_at`, `updated_at`) VALUES
	(2, '022023', 'Februari 2023', 28239, '2023-06-15 11:38:17', NULL);
INSERT INTO `t_periode_sumber_arus_kas` (`id`, `periode`, `keterangan`, `saldo_awal`, `created_at`, `updated_at`) VALUES
	(3, '032023', 'Maret 2023', 28239, '2023-06-15 11:38:17', NULL);
INSERT INTO `t_periode_sumber_arus_kas` (`id`, `periode`, `keterangan`, `saldo_awal`, `created_at`, `updated_at`) VALUES
	(4, '042023', 'April 2023', 28239, '2023-06-15 11:38:17', NULL);
/*!40000 ALTER TABLE `t_periode_sumber_arus_kas` ENABLE KEYS */;

-- Dumping structure for table db_monitoring.t_sumber_arus_kas
DROP TABLE IF EXISTS `t_sumber_arus_kas`;
CREATE TABLE IF NOT EXISTS `t_sumber_arus_kas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periode_sumber_arus_kas_id` bigint(20) unsigned NOT NULL,
  `arus_kas_kode` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerimaan` double NOT NULL,
  `pengeluaran` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `t_sumber_arus_kas_arus_kas_kode_foreign` (`arus_kas_kode`),
  KEY `t_sumber_arus_kas_data_pbl_id_index` (`periode_sumber_arus_kas_id`) USING BTREE,
  CONSTRAINT `FK_t_sumber_arus_kas_t_periode_sumber_arus_kas` FOREIGN KEY (`periode_sumber_arus_kas_id`) REFERENCES `t_periode_sumber_arus_kas` (`id`),
  CONSTRAINT `t_sumber_arus_kas_arus_kas_kode_foreign` FOREIGN KEY (`arus_kas_kode`) REFERENCES `m_sumber_arus_kas` (`kode_arus_kas`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_monitoring.t_sumber_arus_kas: ~12 rows (approximately)
DELETE FROM `t_sumber_arus_kas`;
/*!40000 ALTER TABLE `t_sumber_arus_kas` DISABLE KEYS */;
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(1, 1, 'ARK001', 16847, 24246, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(2, 1, 'ARK002', 0, 0, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(3, 1, 'ARK003', 0, 0, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(4, 2, 'ARK001', 44099, 57297, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(5, 2, 'ARK002', 5000, 0, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(6, 2, 'ARK003', 0, 0, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(7, 3, 'ARK001', 87861, 98474, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(8, 3, 'ARK002', 5000, 0, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(9, 3, 'ARK003', 0, 0, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(10, 4, 'ARK001', 138825, 148308, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(11, 4, 'ARK002', 5000, 0, NULL, NULL);
INSERT INTO `t_sumber_arus_kas` (`id`, `periode_sumber_arus_kas_id`, `arus_kas_kode`, `penerimaan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
	(12, 4, 'ARK003', 0, 0, NULL, NULL);
/*!40000 ALTER TABLE `t_sumber_arus_kas` ENABLE KEYS */;

-- Dumping structure for view db_monitoring.v_arus_kas
DROP VIEW IF EXISTS `v_arus_kas`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_arus_kas` (
	`periode` CHAR(6) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`keterangan` VARCHAR(255) NULL COLLATE 'utf8mb4_unicode_ci',
	`saldo_awal` DOUBLE NULL,
	`penerimaan` DOUBLE NULL,
	`pengeluaran` DOUBLE NULL
) ENGINE=MyISAM;

-- Dumping structure for view db_monitoring.v_detail_arus_kas
DROP VIEW IF EXISTS `v_detail_arus_kas`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_detail_arus_kas` (
	`periode` CHAR(6) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`keterangan` VARCHAR(255) NULL COLLATE 'utf8mb4_unicode_ci',
	`penerimaan` DOUBLE NOT NULL,
	`pengeluaran` DOUBLE NOT NULL,
	`nama_arus_kas` VARCHAR(100) NULL COLLATE 'utf8mb4_unicode_ci',
	`arus_kas_kode` CHAR(6) NOT NULL COLLATE 'utf8mb4_unicode_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_monitoring.v_arus_kas
DROP VIEW IF EXISTS `v_arus_kas`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_arus_kas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_arus_kas` AS SELECT a.periode, a.keterangan, a.saldo_awal, SUM(b.penerimaan) AS penerimaan, SUM(b.pengeluaran) AS pengeluaran
FROM t_periode_sumber_arus_kas a
INNER JOIN t_sumber_arus_kas b ON a.id = b.periode_sumber_arus_kas_id
GROUP BY a.id
ORDER BY a.id ;

-- Dumping structure for view db_monitoring.v_detail_arus_kas
DROP VIEW IF EXISTS `v_detail_arus_kas`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_detail_arus_kas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_detail_arus_kas` AS SELECT a.periode, a.keterangan,  b.penerimaan, b.pengeluaran, c.nama_arus_kas,b.arus_kas_kode
FROM t_periode_sumber_arus_kas a
INNER JOIN t_sumber_arus_kas b ON a.id = b.periode_sumber_arus_kas_id
INNER JOIN m_sumber_arus_kas c ON b.arus_kas_kode = c.kode_arus_kas
ORDER BY a.periode ASC ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
