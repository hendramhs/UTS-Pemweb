-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
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


-- Dumping database structure for project_praktikum
CREATE DATABASE IF NOT EXISTS `project_praktikum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `project_praktikum`;

-- Dumping structure for table project_praktikum.asisten
CREATE TABLE IF NOT EXISTS `asisten` (
  `id_asisten` varchar(20) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `nama_asisten` varchar(100) NOT NULL,
  `Jurusan` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_asisten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_praktikum.asisten: ~0 rows (approximately)

-- Dumping structure for table project_praktikum.dosen
CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dosen` varchar(20) NOT NULL DEFAULT '',
  `nama_dosen` varchar(50) NOT NULL,
  `email_dosen` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_praktikum.dosen: ~0 rows (approximately)

-- Dumping structure for table project_praktikum.jadwal
CREATE TABLE IF NOT EXISTS `jadwal` (
  `id_jadwal` varchar(10) NOT NULL,
  `Id_praktikum` varchar(10) NOT NULL,
  `id_ruang` varchar(10) NOT NULL,
  `id_asisten` varchar(20) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL DEFAULT 'Senin',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `Id_praktikum` (`Id_praktikum`),
  KEY `id_ruang` (`id_ruang`),
  KEY `id_asisten` (`id_asisten`),
  CONSTRAINT `FKAsisten2` FOREIGN KEY (`id_asisten`) REFERENCES `asisten` (`id_asisten`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FKPrak` FOREIGN KEY (`Id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FKRuang` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_praktikum.jadwal: ~0 rows (approximately)

-- Dumping structure for table project_praktikum.mata kuliah
CREATE TABLE IF NOT EXISTS `mata kuliah` (
  `kode_mk` varchar(10) NOT NULL DEFAULT '',
  `nama_mkl` varchar(50) NOT NULL DEFAULT '',
  `sks` int(11) NOT NULL,
  PRIMARY KEY (`kode_mk`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_praktikum.mata kuliah: ~0 rows (approximately)

-- Dumping structure for table project_praktikum.nilai
CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) NOT NULL,
  `id_praktikum` varchar(10) NOT NULL,
  `nilai_tugas` decimal(20,6) DEFAULT NULL,
  `nilai_uts` decimal(20,6) DEFAULT NULL,
  `nilai_uas` decimal(20,6) DEFAULT NULL,
  `nilai_akhir` decimal(20,6) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `id_praktikum` (`id_praktikum`),
  KEY `id_peserta` (`nim`) USING BTREE,
  CONSTRAINT `FKPrak2` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_nilai_peserta` FOREIGN KEY (`nim`) REFERENCES `peserta` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_praktikum.nilai: ~0 rows (approximately)

-- Dumping structure for table project_praktikum.peserta
CREATE TABLE IF NOT EXISTS `peserta` (
  `nim` varchar(20) NOT NULL,
  `nama_mhs` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_praktikum.peserta: ~0 rows (approximately)

-- Dumping structure for table project_praktikum.praktikum
CREATE TABLE IF NOT EXISTS `praktikum` (
  `id_praktikum` varchar(10) NOT NULL,
  `id_asisten` varchar(20) DEFAULT NULL,
  `kode_mk` varchar(10) DEFAULT NULL,
  `nama_praktikum` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_praktikum`),
  KEY `id_asisten` (`id_asisten`),
  KEY `kode_mk` (`kode_mk`),
  CONSTRAINT `FKAsisten` FOREIGN KEY (`id_asisten`) REFERENCES `asisten` (`id_asisten`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FKMK` FOREIGN KEY (`kode_mk`) REFERENCES `mata kuliah` (`kode_mk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_praktikum.praktikum: ~0 rows (approximately)

-- Dumping structure for table project_praktikum.ruang
CREATE TABLE IF NOT EXISTS `ruang` (
  `id_ruang` varchar(10) NOT NULL,
  `nama_ruang` varchar(50) NOT NULL DEFAULT '',
  `kapasitas` int(11) NOT NULL,
  PRIMARY KEY (`id_ruang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_praktikum.ruang: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
