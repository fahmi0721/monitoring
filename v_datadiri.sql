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

-- Dumping structure for view e_biodata.v_data_diri
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_data_diri` (
	`Satker` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`Id` INT(11) NOT NULL,
	`NoKtp` CHAR(16) NULL COLLATE 'utf8mb4_general_ci',
	`Nama` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`JenisKelamin` ENUM('L','P') NULL COLLATE 'utf8mb4_general_ci',
	`TptLahir` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`TglLahir` DATE NULL,
	`Agama` ENUM('Islam','Protestan','Katolik','Hindu','Buddha','Khonghucu','Lainnya') NULL COLLATE 'utf8mb4_general_ci',
	`Status` ENUM('Kawin','Janda/Duda','Belum Kawin') NULL COLLATE 'utf8mb4_general_ci',
	`NoHp` VARCHAR(15) NULL COLLATE 'utf8mb4_general_ci',
	`Email` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`Npwp` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`FileNpwp` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`KodeVerifikasi` VARCHAR(15) NULL COLLATE 'utf8mb4_general_ci',
	`Alamat` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`Foto` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`TglCreate` DATETIME NULL,
	`kes` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`tk` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`file_kes` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`file_tk` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e_biodata.v_data_diri
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_data_diri`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_data_diri` AS SELECT b.Nama AS Satker, a.*, c.NoBpjsKes AS kes, c.NoBpjsTk AS tk, c.FileBpjsTk AS file_kes, c.FileBpjsKes AS file_tk
FROM tb_data_diri a 
INNER JOIN tb_kode_verifikasi b ON a.KodeVerifikasi = b.Kode
INNER JOIN tb_bpjs c ON a.NoKtp = c.NoKtp ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
