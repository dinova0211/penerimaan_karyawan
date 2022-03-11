/*
Navicat MySQL Data Transfer

Source Server         : kpptech_bosque
Source Server Version : 50635
Source Host           : newoperation.kpptechnology.co.id:3306
Source Database       : kpptech_aci

Target Server Type    : MYSQL
Target Server Version : 50635
File Encoding         : 65001

Date: 2017-04-12 15:53:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `ArticleID` int(11) NOT NULL AUTO_INCREMENT,
  `ArticleSubject` varchar(255) NOT NULL,
  `ArticleContent` text NOT NULL,
  `ArticleCatID` int(11) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`ArticleID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('13', 'tes', '<p>tes aci</p>\r\n', '3', '1', '2017-04-12 00:00:00');

-- ----------------------------
-- Table structure for article_category
-- ----------------------------
DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category` (
  `ArticleCatID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(255) NOT NULL,
  `IsActive` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`ArticleCatID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of article_category
-- ----------------------------
INSERT INTO `article_category` VALUES ('1', 'News', '1', '2015-06-19 00:00:00');
INSERT INTO `article_category` VALUES ('2', 'Fashion', '1', '2015-06-19 00:00:00');
INSERT INTO `article_category` VALUES ('3', 'aci1', '1', '2017-04-12 00:00:00');

-- ----------------------------
-- Table structure for bobot
-- ----------------------------
DROP TABLE IF EXISTS `bobot`;
CREATE TABLE `bobot` (
  `bobot` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bobot`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bobot
-- ----------------------------
INSERT INTO `bobot` VALUES ('1', 'Sangat Rendah/SR');
INSERT INTO `bobot` VALUES ('2', 'Rendah/R');
INSERT INTO `bobot` VALUES ('3', 'Cukup Tinggi/CT');
INSERT INTO `bobot` VALUES ('4', 'Tinggi/T');
INSERT INTO `bobot` VALUES ('5', 'Sangat Tingi/ST');

-- ----------------------------
-- Table structure for detilkandidat
-- ----------------------------
DROP TABLE IF EXISTS `detilkandidat`;
CREATE TABLE `detilkandidat` (
  `idDetilKandidat` int(11) NOT NULL AUTO_INCREMENT,
  `idKandidat` int(11) DEFAULT NULL,
  `idSubKriteria` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idDetilKandidat`)
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detilkandidat
-- ----------------------------
INSERT INTO `detilkandidat` VALUES ('41', '3', '3', '2Surat persetujuan mutasi dari pimpinan Fakultas .png');
INSERT INTO `detilkandidat` VALUES ('40', '3', '2', '1Surat persetujuan mutasi dari pimpinan program studi.png');
INSERT INTO `detilkandidat` VALUES ('39', '3', '1', '0Surat pengantar permohonan mutasi dari pimpinan (Rektor).png');
INSERT INTO `detilkandidat` VALUES ('37', '3', '38', 'D3');
INSERT INTO `detilkandidat` VALUES ('38', '3', '44', 'D3');
INSERT INTO `detilkandidat` VALUES ('35', '3', '25', 'D3');
INSERT INTO `detilkandidat` VALUES ('36', '3', '34', 'D3');
INSERT INTO `detilkandidat` VALUES ('34', '3', '21', 'D3');
INSERT INTO `detilkandidat` VALUES ('33', '3', '17', 'D3');
INSERT INTO `detilkandidat` VALUES ('32', '3', '13', 'D3');
INSERT INTO `detilkandidat` VALUES ('16', '2', '10', 'D3');
INSERT INTO `detilkandidat` VALUES ('17', '2', '15', 'D3');
INSERT INTO `detilkandidat` VALUES ('18', '2', '17', 'D3');
INSERT INTO `detilkandidat` VALUES ('19', '2', '22', 'D3');
INSERT INTO `detilkandidat` VALUES ('20', '2', '33', 'D3');
INSERT INTO `detilkandidat` VALUES ('21', '2', '34', 'D3');
INSERT INTO `detilkandidat` VALUES ('22', '2', '38', 'D3');
INSERT INTO `detilkandidat` VALUES ('23', '2', '1', '0Surat pengantar permohonan mutasi dari pimpinan (Rektor).png');
INSERT INTO `detilkandidat` VALUES ('24', '2', '2', '1Surat persetujuan mutasi dari pimpinan program studi.png');
INSERT INTO `detilkandidat` VALUES ('25', '2', '4', '3Surat Keputusan (SK) pemberhentian dari pimpinan program studi asal.png');
INSERT INTO `detilkandidat` VALUES ('26', '2', '5', '4Surat Keputusan (SK) pengangkatan dari pimpinan program studi tujuan.png');
INSERT INTO `detilkandidat` VALUES ('27', '2', '6', '5Surat pernyataan sebagai dosen tetap.png');
INSERT INTO `detilkandidat` VALUES ('28', '2', '7', '6Fotocopy Ijazah Legalisir.png');
INSERT INTO `detilkandidat` VALUES ('29', '2', '8', '7Print Out data dosen.png');
INSERT INTO `detilkandidat` VALUES ('31', '3', '9', 'D3');
INSERT INTO `detilkandidat` VALUES ('42', '3', '4', '3Surat Keputusan (SK) pemberhentian dari pimpinan program studi asal.png');
INSERT INTO `detilkandidat` VALUES ('43', '3', '5', '4Surat Keputusan (SK) pengangkatan dari pimpinan program studi tujuan.png');
INSERT INTO `detilkandidat` VALUES ('44', '3', '6', '5Surat pernyataan sebagai dosen tetap.png');
INSERT INTO `detilkandidat` VALUES ('45', '3', '7', '6Fotocopy Ijazah Legalisir.png');
INSERT INTO `detilkandidat` VALUES ('46', '3', '8', '7Print Out data dosen.png');
INSERT INTO `detilkandidat` VALUES ('47', '3', '46', '8Dokumen tambahan.png');
INSERT INTO `detilkandidat` VALUES ('48', '4', '9', 'S1');
INSERT INTO `detilkandidat` VALUES ('49', '4', '13', 'S1');
INSERT INTO `detilkandidat` VALUES ('50', '4', '17', 'S1');
INSERT INTO `detilkandidat` VALUES ('51', '4', '21', 'S1');
INSERT INTO `detilkandidat` VALUES ('52', '4', '25', 'D3');
INSERT INTO `detilkandidat` VALUES ('53', '4', '36', 'D3');
INSERT INTO `detilkandidat` VALUES ('54', '4', '41', 'D3');
INSERT INTO `detilkandidat` VALUES ('55', '4', '1', '0Surat pengantar permohonan mutasi dari pimpinan (Rektor).jpg');
INSERT INTO `detilkandidat` VALUES ('56', '4', '2', '1Surat persetujuan mutasi dari pimpinan program studi.jpg');
INSERT INTO `detilkandidat` VALUES ('57', '4', '3', '2Surat persetujuan mutasi dari pimpinan Fakultas .jpg');
INSERT INTO `detilkandidat` VALUES ('58', '4', '4', '3Surat Keputusan (SK) pemberhentian dari pimpinan program studi asal.jpg');
INSERT INTO `detilkandidat` VALUES ('59', '4', '5', '4Surat Keputusan (SK) pengangkatan dari pimpinan program studi tujuan.jpg');
INSERT INTO `detilkandidat` VALUES ('60', '4', '6', '5Surat pernyataan sebagai dosen tetap.jpg');
INSERT INTO `detilkandidat` VALUES ('61', '4', '7', '6Fotocopy Ijazah Legalisir.jpg');
INSERT INTO `detilkandidat` VALUES ('62', '4', '8', '7Print Out data dosen.jpg');
INSERT INTO `detilkandidat` VALUES ('63', '4', '46', '8Dokumen tambahan.jpg');
INSERT INTO `detilkandidat` VALUES ('64', '2', '48', 'D3');
INSERT INTO `detilkandidat` VALUES ('65', '5', '9', 'D3');
INSERT INTO `detilkandidat` VALUES ('66', '5', '13', 'D3');
INSERT INTO `detilkandidat` VALUES ('67', '5', '17', 'D3');
INSERT INTO `detilkandidat` VALUES ('68', '5', '21', 'D3');
INSERT INTO `detilkandidat` VALUES ('69', '5', '25', 'D3');
INSERT INTO `detilkandidat` VALUES ('70', '5', '34', 'D3');
INSERT INTO `detilkandidat` VALUES ('71', '5', '38', 'D3');
INSERT INTO `detilkandidat` VALUES ('72', '5', '48', 'D3');
INSERT INTO `detilkandidat` VALUES ('73', '5', '1', '0Surat pengantar permohonan mutasi dari pimpinan (Rektor).png');
INSERT INTO `detilkandidat` VALUES ('74', '5', '2', '1Surat persetujuan mutasi dari pimpinan program studi.png');
INSERT INTO `detilkandidat` VALUES ('75', '5', '3', '2Surat persetujuan mutasi dari pimpinan Fakultas .png');
INSERT INTO `detilkandidat` VALUES ('76', '5', '4', '3Surat Keputusan (SK) pemberhentian dari pimpinan program studi asal.png');
INSERT INTO `detilkandidat` VALUES ('77', '5', '5', '4Surat Keputusan (SK) pengangkatan dari pimpinan program studi tujuan.png');
INSERT INTO `detilkandidat` VALUES ('78', '5', '6', '5Surat pernyataan sebagai dosen tetap.png');
INSERT INTO `detilkandidat` VALUES ('79', '5', '7', '6Fotocopy Ijazah Legalisir.png');
INSERT INTO `detilkandidat` VALUES ('80', '5', '8', '7Print Out data dosen.png');
INSERT INTO `detilkandidat` VALUES ('81', '5', '47', '8Fotocopy NPWP.png');
INSERT INTO `detilkandidat` VALUES ('82', '5', '46', '9Dokumen tambahan.png');
INSERT INTO `detilkandidat` VALUES ('83', '6', '11', 'S3');
INSERT INTO `detilkandidat` VALUES ('84', '6', '15', 'S3');
INSERT INTO `detilkandidat` VALUES ('85', '6', '19', 'S3');
INSERT INTO `detilkandidat` VALUES ('86', '6', '23', 'S3');
INSERT INTO `detilkandidat` VALUES ('87', '6', '33', 'D3');
INSERT INTO `detilkandidat` VALUES ('88', '6', '37', 'D3');
INSERT INTO `detilkandidat` VALUES ('89', '6', '41', 'D3');
INSERT INTO `detilkandidat` VALUES ('90', '6', '48', 'D3');
INSERT INTO `detilkandidat` VALUES ('91', '6', '1', '0Surat pengantar permohonan mutasi dari pimpinan (Rektor).png');
INSERT INTO `detilkandidat` VALUES ('92', '6', '2', '1Surat persetujuan mutasi dari pimpinan program studi.png');
INSERT INTO `detilkandidat` VALUES ('93', '6', '3', '2Surat persetujuan mutasi dari pimpinan Fakultas .png');
INSERT INTO `detilkandidat` VALUES ('94', '6', '4', '3Surat Keputusan (SK) pemberhentian dari pimpinan program studi asal.png');
INSERT INTO `detilkandidat` VALUES ('95', '6', '5', '4Surat Keputusan (SK) pengangkatan dari pimpinan program studi tujuan.png');
INSERT INTO `detilkandidat` VALUES ('96', '6', '6', '5Surat pernyataan sebagai dosen tetap.png');
INSERT INTO `detilkandidat` VALUES ('97', '6', '7', '6Fotocopy Ijazah Legalisir.png');
INSERT INTO `detilkandidat` VALUES ('98', '6', '8', '7Print Out data dosen.png');
INSERT INTO `detilkandidat` VALUES ('99', '6', '47', '8Fotocopy NPWP.png');
INSERT INTO `detilkandidat` VALUES ('100', '6', '46', '9Dokumen tambahan.png');
INSERT INTO `detilkandidat` VALUES ('101', '7', '11', 'S1');
INSERT INTO `detilkandidat` VALUES ('102', '7', '16', 'S1');
INSERT INTO `detilkandidat` VALUES ('103', '7', '20', 'S2');
INSERT INTO `detilkandidat` VALUES ('104', '7', '24', 'S3');
INSERT INTO `detilkandidat` VALUES ('105', '7', '31', 'D3');
INSERT INTO `detilkandidat` VALUES ('106', '7', '36', 'D3');
INSERT INTO `detilkandidat` VALUES ('107', '7', '40', 'D3');
INSERT INTO `detilkandidat` VALUES ('108', '7', '48', 'D3');
INSERT INTO `detilkandidat` VALUES ('109', '7', '1', '0Surat pengantar permohonan mutasi dari pimpinan (Rektor).png');
INSERT INTO `detilkandidat` VALUES ('110', '7', '2', '1Surat persetujuan mutasi dari pimpinan program studi.png');
INSERT INTO `detilkandidat` VALUES ('111', '7', '3', '2Surat persetujuan mutasi dari pimpinan Fakultas .png');
INSERT INTO `detilkandidat` VALUES ('112', '7', '4', '3Surat Keputusan (SK) pemberhentian dari pimpinan program studi asal.png');
INSERT INTO `detilkandidat` VALUES ('113', '7', '5', '4Surat Keputusan (SK) pengangkatan dari pimpinan program studi tujuan.png');
INSERT INTO `detilkandidat` VALUES ('114', '7', '6', '5Surat pernyataan sebagai dosen tetap.png');
INSERT INTO `detilkandidat` VALUES ('115', '7', '7', '6Fotocopy Ijazah Legalisir.png');
INSERT INTO `detilkandidat` VALUES ('116', '7', '8', '7Print Out data dosen.png');
INSERT INTO `detilkandidat` VALUES ('117', '7', '47', '8Fotocopy NPWP.png');
INSERT INTO `detilkandidat` VALUES ('118', '7', '46', '9Dokumen tambahan.png');
INSERT INTO `detilkandidat` VALUES ('119', '8', '10', 'D3');
INSERT INTO `detilkandidat` VALUES ('120', '8', '15', 'D3');
INSERT INTO `detilkandidat` VALUES ('121', '8', '18', 'D3');
INSERT INTO `detilkandidat` VALUES ('122', '8', '24', 'D3');
INSERT INTO `detilkandidat` VALUES ('123', '8', '29', 'D3');
INSERT INTO `detilkandidat` VALUES ('124', '8', '35', 'D3');
INSERT INTO `detilkandidat` VALUES ('125', '8', '39', 'D3');
INSERT INTO `detilkandidat` VALUES ('126', '8', '48', 'D3');
INSERT INTO `detilkandidat` VALUES ('127', '8', '1', '0Surat pengantar permohonan mutasi dari pimpinan (Rektor).png');
INSERT INTO `detilkandidat` VALUES ('128', '8', '2', '1Surat persetujuan mutasi dari pimpinan program studi.png');
INSERT INTO `detilkandidat` VALUES ('129', '8', '3', '2Surat persetujuan mutasi dari pimpinan Fakultas .png');
INSERT INTO `detilkandidat` VALUES ('130', '8', '4', '3Surat Keputusan (SK) pemberhentian dari pimpinan program studi asal.png');
INSERT INTO `detilkandidat` VALUES ('131', '8', '5', '4Surat Keputusan (SK) pengangkatan dari pimpinan program studi tujuan.png');
INSERT INTO `detilkandidat` VALUES ('132', '8', '6', '5Surat pernyataan sebagai dosen tetap.png');
INSERT INTO `detilkandidat` VALUES ('133', '8', '7', '6Fotocopy Ijazah Legalisir.png');
INSERT INTO `detilkandidat` VALUES ('134', '8', '8', '7Print Out data dosen.png');
INSERT INTO `detilkandidat` VALUES ('135', '8', '47', '8Fotocopy NPWP.png');
INSERT INTO `detilkandidat` VALUES ('136', '8', '46', '9Dokumen tambahan.png');
INSERT INTO `detilkandidat` VALUES ('137', '9', '10', 'D3');
INSERT INTO `detilkandidat` VALUES ('138', '9', '14', 'D3');
INSERT INTO `detilkandidat` VALUES ('139', '9', '19', 'D3');
INSERT INTO `detilkandidat` VALUES ('140', '9', '23', 'D3');
INSERT INTO `detilkandidat` VALUES ('141', '9', '27', 'D3');
INSERT INTO `detilkandidat` VALUES ('142', '9', '35', 'D3');
INSERT INTO `detilkandidat` VALUES ('143', '9', '39', 'D3');
INSERT INTO `detilkandidat` VALUES ('144', '9', '48', 'D3');
INSERT INTO `detilkandidat` VALUES ('145', '9', '1', '0Surat pengantar permohonan mutasi dari pimpinan (Rektor).png');
INSERT INTO `detilkandidat` VALUES ('146', '9', '2', '1Surat persetujuan mutasi dari pimpinan program studi.png');
INSERT INTO `detilkandidat` VALUES ('147', '9', '3', '2Surat persetujuan mutasi dari pimpinan Fakultas .png');
INSERT INTO `detilkandidat` VALUES ('148', '9', '4', '3Surat Keputusan (SK) pemberhentian dari pimpinan program studi asal.png');
INSERT INTO `detilkandidat` VALUES ('149', '9', '5', '4Surat Keputusan (SK) pengangkatan dari pimpinan program studi tujuan.png');
INSERT INTO `detilkandidat` VALUES ('150', '9', '6', '5Surat pernyataan sebagai dosen tetap.png');
INSERT INTO `detilkandidat` VALUES ('151', '9', '7', '6Fotocopy Ijazah Legalisir.png');
INSERT INTO `detilkandidat` VALUES ('152', '9', '8', '7Print Out data dosen.png');
INSERT INTO `detilkandidat` VALUES ('153', '9', '47', '8Fotocopy NPWP.png');
INSERT INTO `detilkandidat` VALUES ('154', '9', '46', '9Dokumen tambahan.png');
INSERT INTO `detilkandidat` VALUES ('155', '10', '9', 'D3');
INSERT INTO `detilkandidat` VALUES ('156', '10', '13', 'D3');
INSERT INTO `detilkandidat` VALUES ('157', '10', '17', 'D3');
INSERT INTO `detilkandidat` VALUES ('158', '10', '21', 'D3');
INSERT INTO `detilkandidat` VALUES ('159', '10', '25', 'D3');
INSERT INTO `detilkandidat` VALUES ('160', '10', '34', 'D3');
INSERT INTO `detilkandidat` VALUES ('161', '10', '38', 'D3');
INSERT INTO `detilkandidat` VALUES ('162', '10', '1', '0Surat pengantar permohonan mutasi dari pimpinan (Rektor).png');
INSERT INTO `detilkandidat` VALUES ('163', '10', '2', '1Surat persetujuan mutasi dari pimpinan program studi.pdf');
INSERT INTO `detilkandidat` VALUES ('164', '10', '3', '2Surat persetujuan mutasi dari pimpinan Fakultas .png');
INSERT INTO `detilkandidat` VALUES ('165', '10', '4', '3Surat Keputusan (SK) pemberhentian dari pimpinan program studi asal.png');
INSERT INTO `detilkandidat` VALUES ('166', '10', '5', '4Surat Keputusan (SK) pengangkatan dari pimpinan program studi tujuan.png');
INSERT INTO `detilkandidat` VALUES ('167', '10', '6', '5Surat pernyataan sebagai dosen tetap.png');
INSERT INTO `detilkandidat` VALUES ('168', '10', '7', '6Fotocopy Ijazah Legalisir.png');
INSERT INTO `detilkandidat` VALUES ('169', '10', '8', '7Print Out data dosen.png');
INSERT INTO `detilkandidat` VALUES ('170', '10', '49', '8sub kriteria aci.png');

-- ----------------------------
-- Table structure for dosen
-- ----------------------------
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nip` int(50) unsigned NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alamat` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nohp` int(11) NOT NULL,
  `jeniskelamin` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `foto` text COLLATE utf8_unicode_ci,
  `is_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of dosen
-- ----------------------------
INSERT INTO `dosen` VALUES ('28', '123123123', 'Rahmat Fathi', '  afdsaf', 'fathi.rahmat@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '123123', 'laki', '', '1');
INSERT INTO `dosen` VALUES ('33', '431241234', 'Sora', 'Jalan Baru', 'sorasiro67@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '243242', 'laki', '', '1');
INSERT INTO `dosen` VALUES ('34', '2121212121', 'Dosen A', 'Jalan Kedari no 21', 'dosena@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '999999', 'laki', '', '1');
INSERT INTO `dosen` VALUES ('35', '9984726', 'Dosen B', ' Alamat Palsu                                ', 'dosenb@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '887878787', 'perempuan', '', '1');
INSERT INTO `dosen` VALUES ('37', '11100011', 'Yulia', '                       asfd', 'fitrianiyulia1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1212121212', 'perempuan', '11100011.jpg', '1');
INSERT INTO `dosen` VALUES ('39', '1234567', 'Ayu', ' Bogor timur - Tajur                        ', 'ayuhartinah21@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '87673821', 'perempuan', '', '1');
INSERT INTO `dosen` VALUES ('40', '99111', 'Yulia 2', 'jgdshjfd ', 'yulia@kpptechnology.co.id', 'e10adc3949ba59abbe56e057f20f883e', '323492389', 'perempuan', null, '1');
INSERT INTO `dosen` VALUES ('41', '11111111', 'rizky', ' ', 'rizkymuhammad7839@gmail.com', '74b87337454200d4d33f80c4663dc5e5', '2147483647', 'laki', null, '1');
INSERT INTO `dosen` VALUES ('42', '4324234', 'd1', ' rrwerwerw', 'd1@d1.com', 'e10adc3949ba59abbe56e057f20f883e', '323242', 'laki', null, '1');
INSERT INTO `dosen` VALUES ('44', '2432432', 'd3', ' egdfsdf', 'd3@d3.com', 'e10adc3949ba59abbe56e057f20f883e', '243242', 'perempuan', null, '1');
INSERT INTO `dosen` VALUES ('45', '324324', 'd4', ' erwrwerwer', 'd4@d4.com', 'e10adc3949ba59abbe56e057f20f883e', '324324234', 'laki', null, '1');
INSERT INTO `dosen` VALUES ('46', '423424', 'd5', ' egdfgdfgdfg', 'd5@d5.com', 'e10adc3949ba59abbe56e057f20f883e', '244242', 'laki', null, '1');
INSERT INTO `dosen` VALUES ('47', '44324324', 'd2 join ulang', ' reterte', 'd2@d2.com', 'e10adc3949ba59abbe56e057f20f883e', '2147483647', 'laki', null, '1');
INSERT INTO `dosen` VALUES ('48', '111111111', 'aci_dosen', 'aci', 'nabila.oct08@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '111111', 'perempuan', '111111111.png', '1');

-- ----------------------------
-- Table structure for fakultas
-- ----------------------------
DROP TABLE IF EXISTS `fakultas`;
CREATE TABLE `fakultas` (
  `fa_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fa_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fa_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`fa_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fakultas
-- ----------------------------
INSERT INTO `fakultas` VALUES ('1', 'Fakultas Hukums', '1');
INSERT INTO `fakultas` VALUES ('2', 'Fakultas Ekonomi', '1');
INSERT INTO `fakultas` VALUES ('3', 'Fakultas Kedokteran', '1');

-- ----------------------------
-- Table structure for hasilanalisa
-- ----------------------------
DROP TABLE IF EXISTS `hasilanalisa`;
CREATE TABLE `hasilanalisa` (
  `idHasilAnalisa` int(11) NOT NULL AUTO_INCREMENT,
  `idKandidat` int(11) DEFAULT NULL,
  `nilaiWPM` float(18,3) DEFAULT NULL,
  `nilaiSAW` float(18,3) DEFAULT NULL,
  `isApprove` int(1) NOT NULL,
  `approveBy` int(11) NOT NULL,
  `tanggalApprove` datetime DEFAULT NULL,
  `ket` text NOT NULL,
  `suratMutasi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idHasilAnalisa`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of hasilanalisa
-- ----------------------------
INSERT INTO `hasilanalisa` VALUES ('5', '5', '0.181', '0.468', '1', '4', '2017-04-12 03:59:51', 'mandat rektor\r\nmandat wakil rektor\r\nmandat kaprodi\r\nstaf menerima mandat', 'UMI PNG 2.png');
INSERT INTO `hasilanalisa` VALUES ('2', '2', '0.118', '0.294', '0', '5', '2017-04-05 10:27:09', '', null);
INSERT INTO `hasilanalisa` VALUES ('4', '4', '0.135', '0.329', '0', '0', null, '', null);
INSERT INTO `hasilanalisa` VALUES ('3', '3', '0.161', '0.378', '0', '0', null, '', null);
INSERT INTO `hasilanalisa` VALUES ('6', '6', '0.080', '0.291', '2', '8', '2017-04-12 04:05:37', 'rejet', null);
INSERT INTO `hasilanalisa` VALUES ('7', '7', '0.066', '0.211', '0', '0', null, '', null);
INSERT INTO `hasilanalisa` VALUES ('8', '8', '0.110', '0.284', '0', '0', null, '', null);
INSERT INTO `hasilanalisa` VALUES ('9', '9', '0.105', '0.272', '0', '0', null, '', null);
INSERT INTO `hasilanalisa` VALUES ('10', '10', '0.304', '0.534', '0', '0', null, '', null);

-- ----------------------------
-- Table structure for kandidat
-- ----------------------------
DROP TABLE IF EXISTS `kandidat`;
CREATE TABLE `kandidat` (
  `idKandidat` int(11) NOT NULL AUTO_INCREMENT,
  `idDosen` int(11) DEFAULT NULL,
  `fa_asal` int(11) NOT NULL,
  `fa_tujuan` int(11) NOT NULL,
  `psd_asal` int(11) NOT NULL,
  `psd_tujuan` int(11) NOT NULL,
  `tglPegajuan` datetime DEFAULT NULL,
  `statusKandidat` int(11) NOT NULL,
  PRIMARY KEY (`idKandidat`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kandidat
-- ----------------------------
INSERT INTO `kandidat` VALUES ('3', '37', '1', '1', '1', '1', '2017-04-10 04:02:50', '0');
INSERT INTO `kandidat` VALUES ('2', '33', '1', '1', '1', '1', '2017-04-12 04:09:23', '0');
INSERT INTO `kandidat` VALUES ('4', '39', '3', '3', '4', '4', '2017-04-10 14:39:58', '0');
INSERT INTO `kandidat` VALUES ('5', '42', '1', '1', '1', '1', '2017-04-12 03:46:37', '0');
INSERT INTO `kandidat` VALUES ('6', '43', '1', '1', '1', '1', '2017-04-12 03:48:17', '0');
INSERT INTO `kandidat` VALUES ('7', '44', '1', '1', '1', '1', '2017-04-12 03:49:57', '0');
INSERT INTO `kandidat` VALUES ('8', '45', '1', '1', '1', '1', '2017-04-12 03:52:03', '0');
INSERT INTO `kandidat` VALUES ('9', '46', '1', '1', '1', '1', '2017-04-12 03:53:22', '0');
INSERT INTO `kandidat` VALUES ('10', '43', '1', '1', '1', '1', '2017-04-12 04:06:33', '0');

-- ----------------------------
-- Table structure for kelengkapandokumen
-- ----------------------------
DROP TABLE IF EXISTS `kelengkapandokumen`;
CREATE TABLE `kelengkapandokumen` (
  `kelengkapanID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_pengajuan` int(10) unsigned NOT NULL DEFAULT '0',
  `SPPMDP` text NOT NULL COMMENT 'Surat Pengantar Permohonan Mutasi Dari Pimpinan(Rektor)',
  `SPMDPPS` text NOT NULL COMMENT 'Surat Persetujuan Mutasi Dari Pimpinan Program Studi',
  `SPMDPF` text NOT NULL COMMENT 'Surat Persetujuan Mutasi Dari Pimpinan Fakultas',
  `SKPDPPSA` text NOT NULL COMMENT 'Surat Keputusan (SK) Pemberhentian Dari Pimpinan Program Studi Asal',
  `SKPDPPST` text NOT NULL COMMENT 'Surat Keputusan (SK) Pengangkatan Dari Pimpinan Program Studi Tujuan',
  `SPSDT` text NOT NULL COMMENT 'Surat Pernyataan Sebagai Dosen Tetap',
  `FIL` text NOT NULL COMMENT 'Fotocopy Ijazah Legalisir',
  `PODD` text NOT NULL COMMENT 'Print Out Data Dosen',
  PRIMARY KEY (`kelengkapanID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kelengkapandokumen
-- ----------------------------

-- ----------------------------
-- Table structure for kriteria
-- ----------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `idKriteria` varchar(11) NOT NULL,
  `namaKriteria` varchar(255) DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL,
  `is_upload` varchar(1) DEFAULT NULL,
  `is_jenjang` varchar(1) NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`idKriteria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kriteria
-- ----------------------------
INSERT INTO `kriteria` VALUES ('C1', 'Kelengkapan Dokumen', '5', 'Y', 'N', '0');
INSERT INTO `kriteria` VALUES ('C2', 'Status Akreditasi Program Studi Asal', '4', 'N', 'Y', '0');
INSERT INTO `kriteria` VALUES ('C3', 'Status Akreditasi Program Studi Tujuan', '4', 'N', 'Y', '0');
INSERT INTO `kriteria` VALUES ('C4', 'Nisbah Dosen dan Mahasiswa Program Studi Asal', '4', 'N', 'Y', '0');
INSERT INTO `kriteria` VALUES ('C5', 'Nisbah Dosen dan Mahasiswa Program Studi Tujuan', '4', 'N', 'Y', '0');
INSERT INTO `kriteria` VALUES ('C6', 'Status Kepegawaian Dosen', '3', 'N', 'N', '0');
INSERT INTO `kriteria` VALUES ('C7', 'Jenjang Pendidikan Dosen', '3', 'N', 'N', '0');
INSERT INTO `kriteria` VALUES ('C8', 'Jabatan Fungsional', '3', 'N', 'N', '0');
INSERT INTO `kriteria` VALUES ('C9', 'Kriteria Baru', '5', 'N', 'N', '1');

-- ----------------------------
-- Table structure for pengajuan_mutasi
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan_mutasi`;
CREATE TABLE `pengajuan_mutasi` (
  `ID_pengajuan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NIP` int(10) unsigned NOT NULL DEFAULT '0',
  `fakultasAsal` varchar(255) NOT NULL DEFAULT '0',
  `akreditasiProdiAsal` varchar(255) NOT NULL DEFAULT '0',
  `fakultasTujuan` varchar(255) NOT NULL DEFAULT '0',
  `akreditasiProdiTujuan` varchar(255) NOT NULL DEFAULT '0',
  `nisbahProdiAsal` varchar(255) NOT NULL DEFAULT '0',
  `nisbahProdiTujuan` varchar(255) NOT NULL DEFAULT '0',
  `statusKepegawaian` varchar(255) NOT NULL DEFAULT '0',
  `jenjangPendidikan` varchar(255) NOT NULL DEFAULT '0',
  `jabatanFungsional` varchar(255) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`ID_pengajuan`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pengajuan_mutasi
-- ----------------------------
INSERT INTO `pengajuan_mutasi` VALUES ('1', '123123123', '1', '9', '1', '13', '17', '21', '25', '34', '38', '0');
INSERT INTO `pengajuan_mutasi` VALUES ('2', '123123123', '1', '9', '1', '13', '17', '21', '25', '34', '38', '0');

-- ----------------------------
-- Table structure for petugas
-- ----------------------------
DROP TABLE IF EXISTS `petugas`;
CREATE TABLE `petugas` (
  `idPetugas` int(11) NOT NULL AUTO_INCREMENT,
  `namaPetugas` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `foto` text,
  PRIMARY KEY (`idPetugas`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of petugas
-- ----------------------------
INSERT INTO `petugas` VALUES ('1', 'SoraPetugas', 'sora67', 'e10adc3949ba59abbe56e057f20f883e', 'sorasiro16@gmail.com', '1', null);
INSERT INTO `petugas` VALUES ('4', 'staff', '', 'e10adc3949ba59abbe56e057f20f883e', 'staff@gmail.com', '2', '4.png');
INSERT INTO `petugas` VALUES ('5', 'Rektor', '', 'e10adc3949ba59abbe56e057f20f883e', 'rektor@gmail.com', '3', null);
INSERT INTO `petugas` VALUES ('6', 'Wakil Rektor', '', 'e10adc3949ba59abbe56e057f20f883e', 'wakilrektor@gmail.com', '4', null);
INSERT INTO `petugas` VALUES ('7', 'kaprodi', '', 'e10adc3949ba59abbe56e057f20f883e', 'kaprodi@gmail.com', '5', null);
INSERT INTO `petugas` VALUES ('8', 'administrator', '', 'e10adc3949ba59abbe56e057f20f883e', 'administrator@mail.co.id', '6', '8.png');

-- ----------------------------
-- Table structure for program_study
-- ----------------------------
DROP TABLE IF EXISTS `program_study`;
CREATE TABLE `program_study` (
  `psd_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fa_ID` int(11) unsigned NOT NULL DEFAULT '0',
  `psd_name` varchar(255) NOT NULL DEFAULT '0',
  `psd_status` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`psd_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of program_study
-- ----------------------------
INSERT INTO `program_study` VALUES ('1', '1', 'Program hukum 1', '1');
INSERT INTO `program_study` VALUES ('2', '2', 'Program Ekonomi 1', '1');
INSERT INTO `program_study` VALUES ('4', '3', 'Program Kedoketeran 1', '1');

-- ----------------------------
-- Table structure for subkriteria
-- ----------------------------
DROP TABLE IF EXISTS `subkriteria`;
CREATE TABLE `subkriteria` (
  `idSubKriteria` int(11) NOT NULL AUTO_INCREMENT,
  `namaSubKriteria` varchar(255) DEFAULT NULL,
  `idKriteria` varchar(11) DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL,
  `is_delete` int(11) NOT NULL,
  `required` varchar(255) DEFAULT NULL,
  `id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idSubKriteria`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of subkriteria
-- ----------------------------
INSERT INTO `subkriteria` VALUES ('1', 'Surat pengantar permohonan mutasi dari pimpinan (Rektor)', 'C1', '5', '0', 'required', 'C1');
INSERT INTO `subkriteria` VALUES ('2', 'Surat persetujuan mutasi dari pimpinan program studi', 'C1', '5', '0', 'required', 'C1');
INSERT INTO `subkriteria` VALUES ('3', 'Surat persetujuan mutasi dari pimpinan Fakultas ', 'C1', '5', '0', '', 'C13');
INSERT INTO `subkriteria` VALUES ('4', 'Surat Keputusan (SK) pemberhentian dari pimpinan program studi asal', 'C1', '4', '0', 'required', 'C1');
INSERT INTO `subkriteria` VALUES ('5', 'Surat Keputusan (SK) pengangkatan dari pimpinan program studi tujuan', 'C1', '4', '0', 'required', 'C1');
INSERT INTO `subkriteria` VALUES ('6', 'Surat pernyataan sebagai dosen tetap', 'C1', '3', '0', 'required', 'C1');
INSERT INTO `subkriteria` VALUES ('7', 'Fotocopy Ijazah Legalisir', 'C1', '2', '0', 'required', 'C1');
INSERT INTO `subkriteria` VALUES ('8', 'Print Out data dosen', 'C1', '1', '0', 'required', 'C1');
INSERT INTO `subkriteria` VALUES ('9', 'Akreditasi A', 'C2', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('10', 'Akreditasi B', 'C2', '4', '0', '', null);
INSERT INTO `subkriteria` VALUES ('11', 'Akreditasi C', 'C2', '3', '0', '', null);
INSERT INTO `subkriteria` VALUES ('12', 'Tidak Terakreditasi', 'C2', '2', '0', '', null);
INSERT INTO `subkriteria` VALUES ('13', 'Akreditasi A', 'C3', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('14', 'Akreditasi B', 'C3', '4', '0', '', null);
INSERT INTO `subkriteria` VALUES ('15', 'Akreditasi C', 'C3', '3', '0', '', null);
INSERT INTO `subkriteria` VALUES ('16', 'Tidak Terakreditasi', 'C3', '2', '0', '', null);
INSERT INTO `subkriteria` VALUES ('17', 'IPA= 1:30', 'C4', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('18', 'IPS = 1:45', 'C4', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('19', 'IPA> 1:30 ', 'C4', '3', '0', '', null);
INSERT INTO `subkriteria` VALUES ('20', 'IPS > 1:45', 'C4', '3', '0', '', null);
INSERT INTO `subkriteria` VALUES ('21', 'IPA= 1:30', 'C5', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('22', 'IPS = 1:45', 'C5', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('23', 'IPA> 1:30 ', 'C5', '3', '0', '', null);
INSERT INTO `subkriteria` VALUES ('24', 'IPS > 1:45', 'C5', '3', '0', '', null);
INSERT INTO `subkriteria` VALUES ('25', 'Dosen Tetap', 'C6', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('26', 'Dosen PNS DPK', 'C6', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('27', 'Dosen Pendidik Klinis', 'C6', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('28', 'Dosen Tetap BH', 'C6', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('29', 'P3K ASN', 'C6', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('30', 'Dosen dengan Perjanjian Kerja', 'C6', '4', '0', '', null);
INSERT INTO `subkriteria` VALUES ('31', 'Dosen Tidak Tetap', 'C6', '3', '0', '', null);
INSERT INTO `subkriteria` VALUES ('32', 'Instruktur', 'C6', '2', '0', '', null);
INSERT INTO `subkriteria` VALUES ('33', 'Tutor', 'C6', '1', '0', '', null);
INSERT INTO `subkriteria` VALUES ('34', 'S3', 'C7', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('35', 'S2', 'C7', '4', '0', '', null);
INSERT INTO `subkriteria` VALUES ('36', 'S1', 'C7', '3', '0', '', null);
INSERT INTO `subkriteria` VALUES ('37', 'D3', 'C7', '2', '0', '', null);
INSERT INTO `subkriteria` VALUES ('38', 'Guru Besar', 'C8', '5', '0', '', null);
INSERT INTO `subkriteria` VALUES ('39', 'Lektor Kepala', 'C8', '4', '0', '', null);
INSERT INTO `subkriteria` VALUES ('40', 'Lektor', 'C8', '3', '0', '', null);
INSERT INTO `subkriteria` VALUES ('41', 'Asisten Ahli', 'C8', '2', '0', '', null);
INSERT INTO `subkriteria` VALUES ('48', 'abc 1', 'C10', '3', '0', null, null);
