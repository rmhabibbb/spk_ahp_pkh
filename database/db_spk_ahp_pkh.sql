-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 13, 2021 at 05:18 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_ahp_pkh`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
CREATE TABLE IF NOT EXISTS `akun` (
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `role` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`username`, `password`, `role`, `last_login`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2021-08-13 22:41:02'),
('keke', '4a5ea11b030ec1cfbc8b9947fdf2c872', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

DROP TABLE IF EXISTS `alternatif`;
CREATE TABLE IF NOT EXISTS `alternatif` (
  `id_alternatif` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(30) NOT NULL,
  PRIMARY KEY (`id_alternatif`),
  KEY `nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_penduduk`
--

DROP TABLE IF EXISTS `data_penduduk`;
CREATE TABLE IF NOT EXISTS `data_penduduk` (
  `nik` varchar(30) NOT NULL,
  `nama_kk` varchar(50) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `jumlah_keluarga` int(3) NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ir`
--

DROP TABLE IF EXISTS `ir`;
CREATE TABLE IF NOT EXISTS `ir` (
  `jumlah` int(11) NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`jumlah`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ir`
--

INSERT INTO `ir` (`jumlah`, `nilai`) VALUES
(1, 0),
(2, 0),
(3, 0.58),
(4, 0.9),
(5, 1.12),
(6, 1.24),
(7, 1.32),
(8, 1.41),
(9, 1.45),
(10, 1.49),
(11, 1.51),
(12, 1.48),
(13, 1.56),
(14, 1.57),
(15, 1.59);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(50) NOT NULL,
  `inisial` varchar(4) NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `inisial`) VALUES
(12, 'Pekerjaan', 'C1'),
(13, 'Penghasilan', 'C2'),
(14, 'Tempat Tinggal', 'C3'),
(15, 'Menanggung', 'C4');

-- --------------------------------------------------------

--
-- Table structure for table `mp_kriteria`
--

DROP TABLE IF EXISTS `mp_kriteria`;
CREATE TABLE IF NOT EXISTS `mp_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `id_kriteria_2` int(11) NOT NULL,
  `nilai` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_kriteria_2` (`id_kriteria_2`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mp_kriteria`
--

INSERT INTO `mp_kriteria` (`id`, `id_kriteria`, `id_kriteria_2`, `nilai`) VALUES
(52, 12, 12, '1.00'),
(53, 13, 12, '0.11'),
(54, 13, 13, '1.00'),
(55, 12, 13, '9.00'),
(56, 14, 12, '1.00'),
(57, 14, 13, '0.11'),
(58, 14, 14, '1.00'),
(59, 12, 14, '1.00'),
(60, 13, 14, '9.00'),
(61, 15, 12, '9.00'),
(62, 15, 13, '0.33'),
(63, 15, 14, '0.11'),
(64, 15, 15, '1.00'),
(65, 12, 15, '0.11'),
(66, 13, 15, '3.00'),
(67, 14, 15, '9.00');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE IF NOT EXISTS `penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_koperasi` (`id_alternatif`),
  KEY `id_kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=275 DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `fk_ibfk_aa` FOREIGN KEY (`nik`) REFERENCES `data_penduduk` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mp_kriteria`
--
ALTER TABLE `mp_kriteria`
  ADD CONSTRAINT `mp_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mp_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria_2`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
