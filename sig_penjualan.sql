/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : sig_penjualan

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2020-07-24 00:38:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_pelanggan`
-- ----------------------------
DROP TABLE IF EXISTS `tb_pelanggan`;
CREATE TABLE `tb_pelanggan` (
  `kd_pelanggan` varchar(8) NOT NULL,
  `nama_pelanggan` varchar(64) DEFAULT NULL,
  `alamat` varchar(64) DEFAULT NULL,
  `no_telepon` varchar(16) DEFAULT NULL,
  `geolocation` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`kd_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_pelanggan
-- ----------------------------
INSERT INTO `tb_pelanggan` VALUES ('SMS0014', 'SANYO MOTOR', 'JL. GUNUNG LATIMOJONG #1 MAKASSAR', '3623768', '119.420123, -5.1312879');
INSERT INTO `tb_pelanggan` VALUES ('SMS0030', 'TERMINAL AUTO MOBIL (INDAH MOTOR - S,SADDANG)', 'JL. SUNGAI SADDANG BARU NO. 92B', '5058838', '119.4274859, -5.147549');
INSERT INTO `tb_pelanggan` VALUES ('SMS0076', 'YAMAHA MAKASSAR - MAHA RAYA MOTOR', '', '3632605', '119.41731, -5.1198237');
INSERT INTO `tb_pelanggan` VALUES ('SMS0083', 'WIN KING MOTOR', null, '854 801', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0122', 'MASA JAYA', 'JL. LANDAK BARU', '870 231', '119.426859, -5.165273');
INSERT INTO `tb_pelanggan` VALUES ('SMS0127', 'MELATI JAYA MOTOR - TOMONI', '', '1', '120.812431, -2.515195');
INSERT INTO `tb_pelanggan` VALUES ('SMS0139', 'USAHA MOTOR - DAYA', 'RUMAH SAKIT UMUM DAYA', '512 782', '119.5115337, -5.1132092');
INSERT INTO `tb_pelanggan` VALUES ('SMS0174', 'SEJATI JAYA MOTOR - BANDANG 41', '', '310 808', '119.420114, -5.1292539');
INSERT INTO `tb_pelanggan` VALUES ('SMS0225', 'YAMAHA MAKASSAR - SINAR ALAM MOTOR', 'JALAN URIP SUMOHARJO', '324 717', '119.4294124, -5.135084');
INSERT INTO `tb_pelanggan` VALUES ('SMS0250', 'GEMBIRA MOTOR', 'JL. VETERAN UTARA', '1', '119.423465, -5.138786');
INSERT INTO `tb_pelanggan` VALUES ('SMS0267', 'ANUGRAH  PT', null, '586776', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0298', 'YAMAHA  BONE - MERPATI MOTOR BONE', null, '21727', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0300', 'IVAN MOTOR', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0301', 'HOSANA MOTOR', null, '854978', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0305', 'RUDI MOTOR', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0317', 'SUZUKI MATANGO - MELATI JAYA MOTOR  MATANGO', null, '0481 - 2910319', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0320', 'BANDUNG MOTOR - MAMUJU', null, '085245978385', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0326', 'ISTANA MOTOR - JENEPONTO', null, '22156', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0349', 'ANUGRAH MOTOR - PERINTIS', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0356', 'REJEKI MOTOR - PINRANG', null, '0421 - 923371', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0362', 'SURYA JAYA MOTOR - PINRANG', null, '0421 - 923075', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0407', 'CAKRA MOTOR', null, '310230', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0458', 'MITRA JAYA - PERINTIS', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0459', 'TUNGGAL MOTOR', null, '861766', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0519', 'SYAM MOTOR - PERINTIS', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0570', 'PERMAISURI BAN', null, '361 9215', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0573', 'KARUNIA MOTOR -  BULUKUMBA', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0591', 'HANA MOTOR / BASILINDO', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0596', 'FANANI MOTOR', null, '5050743', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0607', 'HONDA  MAKASSAR - PT. SANGGAR LAUT SELATAN', null, '310 463', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0626', 'CAHAYA DHARMA', null, '5290588 - 466736', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0642', 'GLOBAL MOTOR', null, '6072846', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0662', 'DJAYA OTO', null, '811 0632', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0663', 'LIEM MOTOR', null, '5706734', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0677', 'JAKARTA MOTOR - BONE', null, '2009750', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0712', 'DUNIA MOTOR', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0719', 'SINAR MAS VARIASI', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0787', 'NUSANTARA MOTOR - PEKABATA', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0802', 'MM VARIASI', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0852', 'AMAL JAYA - PERINTIS', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0855', 'DAIHATSU MAKASSAR - PT. MAKASSAR RAYA MOTOR', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0859', 'HONDA MAKASSAR - PT. HONDA REMAJA JAYA MOBILINDO', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0865', 'SUZUKI MAKASSAR -  PRIMA JAYA MOTOR - ADYAKSA', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0905', 'HONDA MAKASSAR -OMEGA OLI  HERTASNING', null, '0411', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0924', 'NISSAN MAKASSAR - PT. WAHANA NISSAN PETTARANI', null, '425777', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0939', 'TOYOTA  KOLAKA - PT. HADJI KALLA', null, '2321846', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0940', 'SUZUKI  MAKASSAR - PT SUZUKI GUNUNG MERAPI.', null, '316126', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0957', 'MITRA MOTOR PERINTIS', null, '085299199101', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0967', 'PONGTIKU SATU MOTOR', null, '430 533', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0978', 'PUTRA JAYA - BANDANG', null, '335 867', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS0983', 'SUZUKI BANTAENG - SUZUKI BUDI JAYA', null, '23300', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1004', 'SARINAH MOTOR', null, '0411', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1009', 'INDO MOTOR BANDANG', null, '5775100', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1022', 'MALUKU MOTOR', null, '081', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1048', 'USAHA MOTOR - BTP', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1054', 'ANUGRAH MOTOR SPORT', null, '6155724', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1073', 'MITRA MOTOR - SURACO', null, '321145', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1078', 'SUZUKI PANGKEP', null, '5098988', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1084', 'YAMAHA PAHLAWAN JAYA MOTOR', null, '21444', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1109', 'CHEVROLET - PT.PANAIKANG INTIM SEJAHTERA', null, '.', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1110', 'TOYOTA BAU-BAU - PT.HADJI KALLA', null, '2822888', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1114', 'MEDINAH OLI', null, '085255451894', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1128', 'TOYOTA KENDARI - PT. HADJI KALLA', null, '3196333', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1129', 'PANAIKANG INTIM SEJAHTERA, PT', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1131', 'FORD INDONESIA', null, '081524000678', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1147', 'MESRAN JAYA SARAPPO', null, '0411', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1152', 'GARUDA MOTOR PINRANG', null, '321047', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1154', 'ANDIKA AYU SRI LESTARI ( BENGKEL ABADI )', null, '081242833111', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1164', 'MEGAHPUTRA SEJAHTERA, PT', null, '0411 - 3617327', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1175', 'MAZDA MAKASSAR - PT. KUMALA CELEBES MOTOR', null, '0411888910', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1197', 'DANESA MALILI', null, '.', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1200', 'JDW MOTOR PARE PARE', null, '0413', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1216', 'GOWA MAKASSAR TAXI, PT', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1229', 'ADI SARANA ARMADA Tbk, PT  (ASSA RENT)', null, '0411-880010', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1231', 'AGUNG TAXI, PT', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1266', 'SOLOWESI MOTORRAD, PT (BMW MAKASSAR)', null, '081242277737', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1295', 'LISPEN MOTOR', null, '085342704555', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1297', 'LISPEN MOTOR', null, '085342704555', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1324', 'SUZUKI AHMAD YANI BONE', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1337', 'BINTANG MOBILINDO', null, '085395113140', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1351', 'RACO MOTOR', null, '439026', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1378', 'MAKASSAR MOTOR - INCE NURDIN', null, '0411', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1386', 'MUTIARA VARIASI MOTOR', null, '0411', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1392', 'SERAM MOTOR', null, '0411', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1405', 'BUDI MOTOR BANTAENG', null, '1', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1425', 'ALYYA MOTOR', null, '082190015757', null);
INSERT INTO `tb_pelanggan` VALUES ('SMS1467', 'ISTANA MOTOR - BARRU', null, '', null);

-- ----------------------------
-- Table structure for `tb_pelanggan_temp`
-- ----------------------------
DROP TABLE IF EXISTS `tb_pelanggan_temp`;
CREATE TABLE `tb_pelanggan_temp` (
  `kd_pelanggan` varchar(8) DEFAULT NULL,
  `nama_pelanggan` varchar(64) DEFAULT NULL,
  `alamat` varchar(64) DEFAULT NULL,
  `no_telepon` varchar(16) DEFAULT NULL,
  `geolocation` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_pelanggan_temp
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nama` varchar(32) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'Jason', 'admin', '21232f297a57a5a743894a0e4a801fc3');
