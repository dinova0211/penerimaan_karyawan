-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 03:47 AM
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
(6624, 7, 'C1', 7.7586589203093),
(6625, 7, 'C2', 4.5073184244545),
(6626, 7, 'C3', 2.3877846200115),
(6627, 7, 'C4', 0.36387971453976),
(6628, 8, 'C1', 8.1446519880102),
(6629, 8, 'C2', 4.5317245787838),
(6630, 8, 'C3', 2.5438741015166),
(6631, 8, 'C4', 0.36648356753023),
(6632, 5, 'C1', 8.1446519880102),
(6633, 5, 'C2', 4.6487907163812),
(6634, 5, 'C3', 2.4055713368439),
(6635, 5, 'C4', 0.36387971453976),
(6636, 2, 'C1', 8.0511721325871),
(6637, 2, 'C2', 4.2980276164852),
(6638, 2, 'C3', 2.422785140936),
(6639, 2, 'C4', 0.35901010263108),
(6640, 3, 'C1', 8.4143997569689),
(6641, 3, 'C2', 4.2980276164852),
(6642, 3, 'C3', 2.3877846200115),
(6643, 3, 'C4', 0.35453519619423),
(6644, 4, 'C1', 7.656739376701),
(6645, 4, 'C2', 4.6029144005713),
(6646, 4, 'C3', 2.4866427224675),
(6647, 4, 'C4', 0.35453519619423),
(6648, 1, 'C1', 8.4143997569689),
(6649, 1, 'C2', 4.6029144005713),
(6650, 1, 'C3', 2.5102435417046),
(6651, 1, 'C4', 0.35453519619423);

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
('C1', 'WAWANCARA', 4, 0, 'benefit'),
('C2', 'SYARAT ADMINISTRASI', 3, 0, 'benefit'),
('C3', 'PSIKOTES', 2, 0, 'benefit'),
('C4', 'KESEHATAN', 2, 0, 'cost');

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
(1, 'Shaden Al Mahabbah Havi', '  Sumberharjo, Pacitan', '085774628053', 'shaden'),
(2, 'Cantik Maharani', 'Punung, Pacitan', '08677711181', 'cantik'),
(3, 'Galuh Anindita', 'Kebonagung, Pacitan', '085774628053', 'galuh'),
(4, 'M. Yusuf', 'Pucangsewu, Pacitan', '087654321', 'yusuf'),
(5, 'Arindha Sauma', 'Donorojo, Pacitan', '085774628053', 'rinda'),
(7, 'Alifiana Dyani', 'Kebonagung, Pacitan', '089898991111', 'alfi'),
(8, 'Ardiyoni', ' Tuban, sidoarjo, Pacitan                        ', '081803327991', 'yoyok');

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
('OutnfoCyV5', '1', '1', 'C3', '12', 88),
('SJeptxzoXO', '1', '1', 'C4', '15', 100),
('GHkyZu0Omh', '1', '1', 'C4', '16', 100),
('KH0oLSFnhW', '1', '1', 'C4', '56', 100),
('LRSCpOYUho', '1', '1', 'C3', '13', 70),
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
('qUrhKA6G7j', '1', '8', 'C3', '13', 90);

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
(1, 'SIKAP SAAT WAWANCARA', 'C1', 3, 0, 'required', 'C1'),
(2, 'MOTIVASI KERJA', 'C1', 4, 0, 'required', 'C1'),
(3, 'KETRAMPILAN', 'C1', 2, 0, '', 'C13'),
(4, 'KERAPIAN', 'C1', 2, 0, 'required', 'C1'),
(9, 'USIA', 'C2', 2, 0, '', NULL),
(10, 'PENDIDIKAN', 'C2', 3, 0, '', NULL),
(11, 'PENGALAMAN KERJA', 'C2', 2, 0, '', NULL),
(12, 'TES IQ', 'C3', 4, 0, '', NULL),
(13, 'TES GAMBAR', 'C3', 3, 0, '', NULL),
(15, 'Tidak memiliki riwayat penyakit serius', 'C4', 4, 0, '', NULL),
(16, 'Tidak memiliki kelainan fisik', 'C4', 4, 0, '', NULL),
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
(56, 'Tidak Buta Warna', 'C4', 4, 0, 'required', 'C1'),
(60, 'baru', 'C1', 3, 0, 'required', 'C1');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6652;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `idPengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idPetugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `idSubKriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
