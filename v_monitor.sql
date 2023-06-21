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


-- Dumping database structure for e_biodata
CREATE DATABASE IF NOT EXISTS `e_biodata` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `e_biodata`;

-- Dumping structure for view e_biodata.v_dasboard_monitor
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_dasboard_monitor` (
	`Kode` VARCHAR(15) NULL COLLATE 'utf8mb4_general_ci',
	`Nama` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`tot_pendaftar` BIGINT(21) NOT NULL,
	`tot_kuota` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for view e_biodata.v_dasboard_monitor
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_dasboard_monitor`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_dasboard_monitor` AS SELECT tb_kode_verifikasi.Kode, tb_kode_verifikasi.Nama , COUNT(tb_data_diri.Id) AS tot_pendaftar, tb_kode_verifikasi.Jumlah AS tot_kuota
FROM tb_kode_verifikasi
LEFT JOIN tb_data_diri ON tb_kode_verifikasi.Kode = tb_data_diri.KodeVerifikasi
WHERE tb_kode_verifikasi.`Status` = 'active'
GROUP BY tb_kode_verifikasi.Kode
ORDER BY tb_kode_verifikasi.Kode ASC ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
