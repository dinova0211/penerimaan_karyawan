-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 06:28 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `bobot` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`bobot`, `keterangan`) VALUES
(1, 'Sangat Rendah/SR'),
(2, 'Rendah/R'),
(3, 'Cukup Tinggi/CT'),
(4, 'Tinggi/T'),
(5, 'Sangat Tingi/ST');

-- --------------------------------------------------------

--
-- Table structure for table `hitung_wp`
--

CREATE TABLE `hitung_wp` (
  `id` int(11) NOT NULL,
  `idpengguna` int(11) NOT NULL,
  `idkriteria` char(3) NOT NULL,
  `nwp` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hitung_wp`
--

INSERT INTO `hitung_wp` (`id`, `idpengguna`, `idkriteria`, `nwp`) VALUES
(6813, 14, 'C1', 8.3704927189982),
(6814, 14, 'C2', 4.4059866902132),
(6815, 14, 'C3', 2.5159905921182),
(6816, 14, 'C4', 0.36516655569433),
(6817, 10, 'C1', 8.5010307923784),
(6818, 10, 'C2', 4.4825546308841),
(6819, 10, 'C3', 2.5438741015166),
(6820, 10, 'C4', 0.36921352038474),
(6821, 13, 'C1', 8.2814482404681),
(6822, 13, 'C2', 4.4574204951352),
(6823, 13, 'C3', 2.4866427224675),
(6824, 13, 'C4', 0.36262179229736),
(6825, 12, 'C1', 8.4579094085638),
(6826, 12, 'C2', 4.5317245787838),
(6827, 12, 'C3', 2.5015103419973),
(6828, 12, 'C4', 0.36516655569433),
(6829, 11, 'C1', 8.4579094085638),
(6830, 11, 'C2', 4.5795114564832),
(6831, 11, 'C3', 2.5301052107593),
(6832, 11, 'C4', 0.37208133045034),
(6833, 9, 'C1', 8.3704927189982),
(6834, 9, 'C2', 4.5557851222067),
(6835, 9, 'C3', 2.5438741015166),
(6836, 9, 'C4', 0.36516655569433),
(6837, 15, 'C1', 8.2814482404681),
(6838, 15, 'C2', 4.4319025868723),
(6839, 15, 'C3', 2.5015103419973),
(6840, 15, 'C4', 0.36262179229736);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `idKriteria` varchar(11) NOT NULL,
  `namaKriteria` varchar(255) DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL,
  `is_delete` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`idKriteria`, `namaKriteria`, `bobot`, `is_delete`, `type`) VALUES
('C4', 'Kesehatan', 2, 0, 'cost'),
('C3', 'Psikotes', 2, 0, 'benefit'),
('C2', 'Administrasi', 3, 0, 'benefit'),
('C1', 'Wawancara', 4, 0, 'benefit');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `idPengguna` int(11) NOT NULL,
  `namaPengguna` varchar(50) DEFAULT '0',
  `alamatPengguna` varchar(50) DEFAULT '0',
  `noHP` varchar(50) DEFAULT '0',
  `username` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`idPengguna`, `namaPengguna`, `alamatPengguna`, `noHP`, `username`) VALUES
(12, 'Arindha Sauma', 'Donorojo, Pacitan                                ', '081916622510', 'rinda'),
(11, 'Cantik Maharani', 'Punung, Pacitan                                ', '0881026549877', 'cantik'),
(10, 'Alifiana Dyani', 'Kebonagung, Pacitan           ', '081325773232', 'alfi'),
(9, 'Shaden Al Mahabbah Havi', 'Pacitan                   ', '1234567890', 'shaden'),
(13, 'Ardiyoni', 'Ponorogo                        ', '087882114796', 'yoyok'),
(14, 'Agung Santoso', 'Tanjungsar, Pacitan              ', '085733886063', 'agung'),
(15, 'Widodo', 'Semanten, Pacitan        ', '087860616156', 'widodo');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `idpenilaian` varchar(10) NOT NULL,
  `idpetugas` varchar(10) NOT NULL,
  `idpengguna` varchar(50) NOT NULL,
  `idkriteria` varchar(10) NOT NULL,
  `idsubkriteria` varchar(10) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`idpenilaian`, `idpetugas`, `idpengguna`, `idkriteria`, `idsubkriteria`, `nilai`) VALUES
('wxpK0cngmE', '1', '9', 'C4', '71', 90),
('WXejUEZiNK', '1', '9', 'C4', '70', 75),
('Iycof0J94G', '1', '9', 'C2', '65', 80),
('7DcLn3atMm', '1', '9', 'C2', '66', 90),
('inAYd7Nu08', '1', '9', 'C2', '67', 90),
('T2wX8AuRcd', '1', '1', 'C2', '9', 90),
('MLpb97AuZd', '1', '1', 'C2', '10', 100),
('TxDin7PJl3', '1', '1', 'C2', '11', 80),
('ol2viF1Qnc', '1', '1', 'C1', '1', 90),
('9HYUZ3Po5L', '1', '1', 'C1', '2', 90),
('QSCBwhTjPu', '1', '1', 'C1', '3', 80),
('6dBrP3ViyA', '1', '1', 'C1', '4', 90),
('0fLvCWBYVZ', '1', '2', 'C4', '15', 80),
('rzSZwVa5PK', '1', '2', 'C4', '16', 100),
('UckdYLKo8F', '1', '2', 'C4', '56', 100),
('ZBCjv45I1f', '1', '2', 'C3', '12', 50),
('xaKB1yrH7M', '1', '2', 'C3', '13', 80),
('uWM7FlEBGC', '1', '2', 'C2', '9', 100),
('U57Hyg1KYE', '1', '2', 'C2', '10', 100),
('kAUVozsKp3', '1', '2', 'C2', '11', 10),
('bKFrCMlphU', '1', '2', 'C1', '1', 90),
('0xjNJMZ9Sa', '1', '2', 'C1', '2', 70),
('QZwOSzDFhM', '1', '2', 'C1', '3', 100),
('sbNUWZQDrq', '1', '2', 'C1', '4', 50),
('lsGdexMzZC', '1', '3', 'C4', '15', 100),
('xUkleCADSj', '1', '3', 'C4', '16', 100),
('GDx3bX1uLN', '1', '3', 'C4', '17', 100),
('rhw8KWp4Ha', '1', '3', 'C3', '12', 60),
('HogrN5iPeS', '1', '3', 'C3', '13', 60),
('qE58ALTW1n', '1', '3', 'C2', '9', 100),
('PkaeXUVzZh', '1', '3', 'C2', '10', 100),
('tchIYGHwdQ', '1', '3', 'C2', '11', 10),
('NW2mxH9K5Y', '1', '3', 'C1', '1', 90),
('UzpHLv7o3e', '1', '3', 'C1', '2', 90),
('oWbxeHcvmK', '1', '3', 'C1', '3', 90),
('nTew5Vxpq4', '1', '3', 'C1', '4', 80),
('DUJQmb4Lko', '1', '4', 'C4', '15', 100),
('d50TmkNexn', '1', '4', 'C4', '16', 100),
('4JgYwvkQTS', '1', '4', 'C4', '17', 100),
('fONBQsd608', '1', '4', 'C3', '12', 60),
('nIEG5yg9TO', '1', '4', 'C3', '13', 90),
('IHlMLJo2UB', '1', '4', 'C2', '9', 100),
('yIdDCOqE2Q', '1', '4', 'C2', '10', 100),
('tn5mLYygjq', '1', '4', 'C2', '11', 70),
('RpU1rny2ct', '1', '4', 'C1', '1', 50),
('3YBjJpXxov', '1', '4', 'C1', '2', 80),
('GYgxkMusZt', '1', '4', 'C1', '3', 70),
('i3DHBxAQJ8', '1', '4', 'C1', '4', 70),
('MjtaCg0cme', '1', '5', 'C4', '15', 60),
('TlAcPYmZza', '1', '5', 'C4', '16', 100),
('UjpLlzsSaN', '1', '5', 'C4', '17', 100),
('1oUz9cQgyl', '1', '5', 'C3', '12', 75),
('lD2ZUY1S8T', '1', '5', 'C3', '13', 50),
('ozamvU3Gs4', '1', '5', 'C2', '9', 100),
('xJDwQINL7A', '1', '5', 'C2', '10', 100),
('BavNZAPcTF', '1', '5', 'C2', '11', 80),
('15MpsYx3f0', '1', '5', 'C1', '1', 80),
('XlGLYatKmD', '1', '5', 'C1', '2', 80),
('w6zsyF32j7', '1', '5', 'C1', '3', 80),
('axULhZftJY', '1', '5', 'C1', '4', 80),
('0XSqpfRMYa', '1', '7', 'C4', '15', 80),
('759HBymV4Z', '1', '7', 'C4', '16', 80),
('7niIhbdU32', '1', '7', 'C4', '17', 100),
('ZraGBY47EJ', '1', '7', 'C3', '12', 60),
('aAOX3dR5uw', '1', '7', 'C3', '13', 60),
('547acYxKDp', '1', '7', 'C2', '9', 80),
('Q5Cn0f2ZLU', '1', '7', 'C2', '10', 70),
('GqnB2RDfHv', '1', '7', 'C2', '11', 100),
('2bMGqdm03I', '1', '7', 'C1', '1', 80),
('mBaRdMKO0q', '1', '7', 'C1', '2', 60),
('mYq8X9Flre', '1', '7', 'C1', '3', 70),
('hfACv2coil', '1', '7', 'C1', '4', 70),
('uDzP3VafQe', '1', '8', 'C3', '12', 80),
('UG9unz73bp', '1', '8', 'C4', '15', 80),
('rCXbu21xgn', '1', '8', 'C2', '10', 90),
('RfNsC9zXgU', '1', '8', 'C1', '1', 80),
('2DVkvmfXR7', '1', '8', 'C1', '2', 75),
('7om85nxd4t', '1', '8', 'C1', '3', 90),
('97KLEQFU82', '1', '8', 'C1', '4', 75),
('W5ayKVDE49', '1', '8', 'C2', '9', 85),
('MRvZiQhLSN', '1', '8', 'C2', '11', 80),
('4oPZz35ubx', '1', '8', 'C4', '16', 80),
('MRpTk9Zgoy', '1', '8', 'C4', '17', 90),
('qUrhKA6G7j', '1', '8', 'C3', '13', 90),
('OYmXRNDWor', '1', '9', 'C4', '72', 90),
('UNwBICE3Hu', '1', '9', 'C3', '69', 80),
('KJBmaRUwHP', '1', '9', 'C3', '68', 90),
('4EnobJWKeI', '1', '9', 'C1', '64', 90),
('54Je7mHOlk', '1', '9', 'C1', '63', 80),
('VwzXrKUM6v', '1', '9', 'C1', '61', 85),
('n8OVz9rBWv', '1', '9', 'C1', '62', 90),
('Mj5a2YFNRn', '1', '12', 'C2', '67', 75),
('ZQRMaTPFhw', '1', '12', 'C2', '66', 90),
('xRBcIZvugE', '1', '12', 'C2', '65', 90),
('qLI1ApeQ7n', '1', '12', 'C4', '70', 85),
('FtrzbmG0li', '1', '12', 'C4', '71', 90),
('yXDUu2QjIR', '1', '12', 'C4', '72', 80),
('T8UlivAfHd', '1', '12', 'C3', '69', 75),
('V34SkYswmu', '1', '12', 'C3', '68', 80),
('JT7eqlQuyI', '1', '12', 'C1', '64', 90),
('tALhGn6OB8', '1', '12', 'C1', '63', 80),
('7JfdCzBIet', '1', '12', 'C1', '61', 95),
('pw2cG6aR9o', '1', '12', 'C1', '62', 90),
('41c536rlKd', '1', '11', 'C2', '67', 90),
('y5CeVsRY2T', '1', '11', 'C2', '66', 90),
('fcyZkUCJRq', '1', '11', 'C2', '65', 85),
('rTVWxQNZty', '1', '11', 'C4', '70', 75),
('yC6LFO49bB', '1', '11', 'C4', '71', 85),
('a6J4APEUOW', '1', '11', 'C4', '72', 70),
('C9Q3yTjtXH', '1', '11', 'C3', '69', 70),
('aiu5nhjymO', '1', '11', 'C3', '68', 95),
('poMhFKdsDe', '1', '11', 'C1', '64', 90),
('xavWBJNOQ4', '1', '11', 'C1', '63', 80),
('KvaxyBAh3u', '1', '11', 'C1', '61', 95),
('OkJUhQZnSi', '1', '11', 'C1', '62', 90),
('2gt0lhuK1Y', '1', '10', 'C2', '67', 70),
('X9dEv7YBgw', '1', '10', 'C2', '66', 80),
('tAjVdu1EXn', '1', '10', 'C2', '65', 95),
('m3GOrqVPyB', '1', '10', 'C4', '70', 90),
('LmUGg5VPba', '1', '10', 'C4', '71', 80),
('8XyUjxDBSu', '1', '10', 'C4', '72', 70),
('uzond7MtIJ', '1', '10', 'C3', '69', 80),
('nJfHQCL1Wi', '1', '10', 'C3', '68', 90),
('L0ECfcb6eT', '1', '10', 'C1', '64', 90),
('xW5tTyXZp1', '1', '10', 'C1', '63', 85),
('Sg1sat4VTl', '1', '10', 'C1', '61', 95),
('XiOGFaQUJk', '1', '10', 'C1', '62', 90),
('GMqDYw2iCj', '1', '13', 'C2', '67', 80),
('Q6LtjAHmwZ', '1', '13', 'C2', '66', 85),
('CJEBAfT5Oi', '1', '13', 'C2', '65', 75),
('mYQDOXUTiV', '1', '13', 'C4', '70', 90),
('mL0ZEsBJGz', '1', '13', 'C4', '71', 90),
('W0oBNh7k3j', '1', '13', 'C4', '72', 85),
('CRnYKeWZud', '1', '13', 'C3', '69', 75),
('sbIdtUOAJF', '1', '13', 'C3', '68', 75),
('AGWmP6heJp', '1', '13', 'C1', '64', 80),
('orJXhAlPn9', '1', '13', 'C1', '63', 80),
('Zse1AIWQrx', '1', '13', 'C1', '61', 85),
('snTNDwrKfv', '1', '13', 'C1', '62', 90),
('L57bo68YmH', '1', '14', 'C2', '67', 80),
('fxk0o6cYWs', '1', '14', 'C2', '66', 70),
('6fS0DtPQiJ', '1', '14', 'C2', '65', 80),
('xJb7CeD8yO', '1', '14', 'C4', '70', 90),
('pwAK10nM83', '1', '14', 'C4', '71', 80),
('tdP7zXwjfQ', '1', '14', 'C4', '72', 85),
('EFbQZnLrXq', '1', '14', 'C3', '69', 80),
('4noRxp6ecz', '1', '14', 'C3', '68', 80),
('f4w7KVp9Lb', '1', '14', 'C1', '64', 90),
('Fh7XKvPZtI', '1', '14', 'C1', '63', 85),
('X1WMhASxoE', '1', '14', 'C1', '61', 90),
('HAiamnCVdp', '1', '14', 'C1', '62', 80),
('kYBcwe4pWm', '1', '15', 'C2', '67', 90),
('8Gi7wHx1hz', '1', '15', 'C2', '66', 75),
('KjgYSRqb1l', '1', '15', 'C2', '65', 70),
('i4X6eM1TVh', '1', '15', 'C4', '70', 90),
('705FHEirTQ', '1', '15', 'C4', '71', 90),
('LDEzu6ngpx', '1', '15', 'C4', '72', 85),
('REucQN3HYl', '1', '15', 'C3', '69', 75),
('c2PJMbZWn5', '1', '15', 'C3', '68', 80),
('Yo8TzbJNGl', '1', '15', 'C1', '64', 80),
('SrqA0KFkv8', '1', '15', 'C1', '63', 80),
('L0iIugZ54G', '1', '15', 'C1', '61', 85),
('qXvGnFHPw5', '1', '15', 'C1', '62', 90);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `idPetugas` int(11) NOT NULL,
  `namaPetugas` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`idPetugas`, `namaPetugas`, `username`, `password`, `email`, `level`, `foto`) VALUES
(8, 'administrator', '', 'e10adc3949ba59abbe56e057f20f883e', 'administrator@mail.co.id', '6', '8.png'),
(10, 'adit', '', 'e10adc3949ba59abbe56e057f20f883e', 'adit@gmail.com', '7', NULL),
(14, 'yoga', '', 'f1ec37a0101d15614de71c2df01385a5', 'yoga@yoga.com', '7', NULL),
(12, 'dinova', '', 'f1ec37a0101d15614de71c2df01385a5', 'dinova@dinova.com', '6', NULL),
(13, 'fajar', '', 'f1ec37a0101d15614de71c2df01385a5', 'fajar@fajar.com', '7', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `idSubKriteria` int(11) NOT NULL,
  `namaSubKriteria` varchar(255) DEFAULT NULL,
  `idKriteria` varchar(11) DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL,
  `is_delete` int(11) NOT NULL,
  `required` varchar(255) DEFAULT NULL,
  `id` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`idSubKriteria`, `namaSubKriteria`, `idKriteria`, `bobot`, `is_delete`, `required`, `id`) VALUES
(69, 'Tes Gambar', 'C3', 3, 0, 'required', 'C1'),
(68, 'Tes IQ', 'C3', 4, 0, 'required', 'C1'),
(67, 'Pengalaman Kerja', 'C2', 2, 0, 'required', 'C1'),
(66, 'Pendidikan', 'C2', 3, 0, 'required', 'C1'),
(65, 'Usia', 'C2', 2, 0, 'required', 'C1'),
(64, 'Kerapian', 'C1', 2, 0, 'required', 'C1'),
(63, 'Ketrampilan', 'C1', 2, 0, 'required', 'C1'),
(54, 'Tidak Buta Warna', '', 3, 0, 'required', 'C1'),
(21, '0 - 3 KM', 'C5', 5, 0, '', NULL),
(22, '4-8 KM', 'C5', 4, 0, '', NULL),
(23, '>9 KM', 'C5', 3, 0, '', NULL),
(25, 'Luas', 'C6', 5, 0, '', NULL),
(26, 'Sedikit', 'C6', 5, 0, '', NULL),
(34, 'Spot Foto', 'C7', 5, 0, '', NULL),
(35, 'Interior Menarik', 'C7', 4, 0, '', NULL),
(51, '< 20000', '', 3, 0, 'required', 'C1'),
(52, 'belajar', '', 4, 0, 'required', 'C1'),
(53, 'interview', '', 3, 0, 'required', 'C1'),
(61, 'Sikap Saat Wawancara', 'C1', 3, 0, 'required', 'C1'),
(62, 'Motivasi Kerja', 'C1', 4, 0, 'required', 'C1'),
(70, 'Tidak Ada Riwayat Penyakit Serius', 'C4', 4, 0, 'required', 'C1'),
(71, 'Tidak Memiliki Kelainan Fisik', 'C4', 4, 0, 'required', 'C1'),
(72, 'Tidak Buta Warna', 'C4', 4, 0, 'required', 'C1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`bobot`);

--
-- Indexes for table `hitung_wp`
--
ALTER TABLE `hitung_wp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`idKriteria`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`idPengguna`),
  ADD KEY `Index 1` (`idPengguna`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`idpenilaian`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`idPetugas`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`idSubKriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hitung_wp`
--
ALTER TABLE `hitung_wp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6841;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `idPengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idPetugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `idSubKriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
