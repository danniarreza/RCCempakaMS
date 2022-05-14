-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2019 at 02:59 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rccempakadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID_CUSTOMER` int(11) NOT NULL,
  `NAME_CUSTOMER` varchar(150) NOT NULL,
  `GENDER_CUSTOMER` char(1) NOT NULL DEFAULT 'F',
  `BIRTHDATE_CUSTOMER` date DEFAULT NULL,
  `ADDRESS_CUSTOMER` varchar(200) DEFAULT NULL,
  `NOTELP_CUSTOMER` varchar(20) DEFAULT NULL,
  `DATE_ADDED_CUSTOMER` date NOT NULL DEFAULT '1970-01-01',
  `STATUS_CUSTOMER` varchar(20) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID_CUSTOMER`, `NAME_CUSTOMER`, `GENDER_CUSTOMER`, `BIRTHDATE_CUSTOMER`, `ADDRESS_CUSTOMER`, `NOTELP_CUSTOMER`, `DATE_ADDED_CUSTOMER`, `STATUS_CUSTOMER`) VALUES
(1, 'Budiwati', 'F', '2019-05-28', 'Blimbing Indah Megah', '+6281333217921', '2019-06-01', 'ACTIVE'),
(2, 'Winarti Cantik', 'F', '2019-05-28', 'Blimbing Indah Megah 12b', '+6281333217921', '2019-06-01', 'ACTIVE'),
(3, 'Bambang Ganteng Lho', 'M', '1990-06-19', 'Blimbing Indah Megah 12b J7-4', '(0341) 4372855', '2019-06-01', 'ACTIVE'),
(4, 'Dewi', 'F', '2019-05-20', 'Blimbing Indah Megah 12b', '+6281333217921', '2019-06-01', 'ACTIVE'),
(5, 'Dewi Kencana', 'F', '2019-05-28', 'Karangploso', '+6281333217921', '2019-06-01', 'ACTIVE'),
(6, 'Budi sante aja dong', 'M', '2019-05-12', 'Blimbing Indah Megah 12b', '+6281333217921', '2019-06-01', 'ACTIVE'),
(7, 'Dimas Sante aja', 'M', '2019-05-12', 'Blimbing Indah Megah 12b J7', '(0341) 4372855', '2019-06-01', 'ACTIVE'),
(8, 'Dilan Milea', 'M', '2019-05-27', 'Karangploso Permai', '(0341) 4372855', '2019-06-01', 'ACTIVE'),
(9, 'Dodi', 'F', '1990-01-01', 'Sawojajar', '+6281333217921', '2019-06-01', 'ACTIVE'),
(10, 'Hartanto', 'M', '2019-06-05', 'Jalan Kertosono', '08567657', '2019-06-01', 'ACTIVE'),
(11, 'Hartadi', 'M', '2000-05-28', 'Jalan Bakso', '08928429', '2019-06-01', 'ACTIVE'),
(12, 'Sulistiawati', 'F', '2002-06-18', 'Jalan Rujak', '089932492', '2019-06-01', 'ACTIVE'),
(13, 'Sulastri', 'F', '1990-07-10', 'Jalan Sukasuka', '089372492', '2019-06-01', 'ACTIVE'),
(14, 'Sumantri', 'M', '2000-12-10', 'Jalan Sumantri', '087726782', '2019-06-01', 'ACTIVE'),
(15, 'Eko', 'M', '1998-03-10', 'Jalan Karangeko', '08676732786', '2019-06-01', 'ACTIVE'),
(16, 'Joko', 'M', '2000-12-15', 'Jalan Karangkates', '08668282', '2019-06-01', 'ACTIVE'),
(17, 'Sumiati', 'F', '1980-11-20', 'Jalan Sumiati', '0865465465', '2019-06-01', 'ACTIVE'),
(18, 'Didik', 'M', '1990-01-01', 'Blimbing Indah Megah 12b', '+6281333217921', '2019-06-01', 'ACTIVE'),
(19, 'Jumiati', 'F', '1990-08-15', 'Jalan Sawojajar', '0823332223', '2019-06-22', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `TYPE_PRODUCT` varchar(3) NOT NULL,
  `ID_PRODUCT` varchar(10) NOT NULL,
  `NAME_PRODUCT` varchar(100) NOT NULL,
  `CAPITAL_PRICE_PRODUCT` int(11) NOT NULL,
  `SELL_PRICE_PRODUCT` int(11) NOT NULL,
  `DESCRIPTION_PRODUCT` varchar(255) NOT NULL,
  `DATE_ADDED_PRODUCT` date NOT NULL DEFAULT '1970-01-01',
  `USER_ADDED_PRODUCT` int(11) NOT NULL DEFAULT '1',
  `DATE_UPDATED_PRODUCT` date NOT NULL DEFAULT '1970-01-01',
  `USER_UPDATED_PRODUCT` int(11) NOT NULL DEFAULT '1',
  `STATUS_PRODUCT` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `IS_UPDATED_PRODUCT` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`TYPE_PRODUCT`, `ID_PRODUCT`, `NAME_PRODUCT`, `CAPITAL_PRICE_PRODUCT`, `SELL_PRICE_PRODUCT`, `DESCRIPTION_PRODUCT`, `DATE_ADDED_PRODUCT`, `USER_ADDED_PRODUCT`, `DATE_UPDATED_PRODUCT`, `USER_UPDATED_PRODUCT`, `STATUS_PRODUCT`, `IS_UPDATED_PRODUCT`) VALUES
('B', '001', 'PEMBERSIH U update', 35000, 55000, 'PEMBERSIH U', '1970-01-01', 5, '2019-06-27', 5, 'ACTIVE', 1),
('B', '002', 'PEMBERSIH T', 35000, 55000, 'PEMBERSIH T', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('B', '003', 'CREAM MALAM HYCO', 50000, 75000, 'CREAM MALAM HYCO', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('B', '004', 'CREAM MALAM M4', 75000, 50000, 'CREAM MALAM M4', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('B', '005', 'CREAM MALAM M5', 100000, 150000, 'CREAM MALAM M5', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('B', '006', 'CREAM MALAM JERAWAT P', 75000, 75000, 'CREAM MALAM JERAWAT P', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('B', '007', 'Jajalan', 50000, 100000, 'Jajalan', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('B', '008', 'Njajal Bos ee', 100000, 150000, 'Njajal Produk ini', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('B', '009', 'Njajal Bos', 100000, 150000, 'Njajal Produk ini', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('B', '010', 'Belakang 10', 0, 50000, '', '2019-06-26', 8, '1970-01-01', 1, 'ACTIVE', 0),
('B', '099', 'Njajal Bos 99', 100000, 150000, 'Njajal Produk ini', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('B', '100', 'Njajal Bos 100', 100000, 150000, 'Njajal Produk ini', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('B', '101', 'Seratus 1', 65000, 100000, 'Wew', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('D', '001', 'MESONE / MOFACORT', 80000, 100000, 'MESONE / MOFACORT', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('D', '002', 'THERADERM BB WHITE 50 BLEMISH', 500000, 535000, 'THERADERM BB WHITE 50 BLEMISH', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('D', '003', 'ACANTHE SPF 40', 100000, 110000, '', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('D', '004', 'PEMBERSIH U', 35000, 55000, 'PEMBERSIH U', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('D', '005', 'VITALIZING C 15 SERUM', 80000, 100000, 'Produk kosmetik yang ditaruh depan', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('D', '006', 'PROBIO C SPRAY', 0, 95000, '', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('D', '007', 'HYAMOIST', 0, 95000, 'Ini hyamoist', '1970-01-01', 5, '1970-01-01', 1, 'ACTIVE', 0),
('D', '008', 'Depan 8', 100000, 100000, '', '2019-06-26', 5, '1970-01-01', 1, 'ACTIVE', 0),
('D', '009', 'Depan 9 Update lagi', 0, 50000, '', '2019-06-26', 8, '2019-06-26', 5, 'ACTIVE', 1),
('F', '001', 'Facial 1', 0, 65000, '', '2019-06-27', 5, '2019-06-27', 8, 'ACTIVE', 1),
('M', '001', 'MASKER GOLD', 50000, 75000, '', '2019-06-22', 5, '1970-01-01', 1, 'ACTIVE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `ID_PRODUCT_TYPE` varchar(3) NOT NULL,
  `NAME_PRODUCT_TYPE` varchar(50) NOT NULL,
  `DESCRIPTION_PRODUCT_TYPE` varchar(200) NOT NULL,
  `STATUS_PRODUCT_TYPE` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`ID_PRODUCT_TYPE`, `NAME_PRODUCT_TYPE`, `DESCRIPTION_PRODUCT_TYPE`, `STATUS_PRODUCT_TYPE`) VALUES
('B', 'Belakang', 'Produk kosmetik yang ditaruh belakang', 'ACTIVE'),
('D', 'Depan', 'Produk kosmetik yang ditaruh depan', 'ACTIVE'),
('F', 'Facial', '', 'ACTIVE'),
('H', 'Hair', '', 'ACTIVE'),
('M', 'Masker', '', 'ACTIVE'),
('P', 'Pawon', 'Pawon digunakan untuk ini itu ini ini', 'ACTIVE'),
('S', 'Serum', '', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `TYPE_PRODUCT` varchar(3) NOT NULL,
  `ID_PRODUCT` varchar(10) NOT NULL,
  `ID_VENDOR` int(11) NOT NULL,
  `STOCK_PRODUCT` float NOT NULL,
  `STATUS_STOCK` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`TYPE_PRODUCT`, `ID_PRODUCT`, `ID_VENDOR`, `STOCK_PRODUCT`, `STATUS_STOCK`) VALUES
('B', '001', 1, 4, 'ACTIVE'),
('B', '001', 2, 0, 'ACTIVE'),
('B', '001', 3, 19, 'ACTIVE'),
('B', '002', 1, 7, 'ACTIVE'),
('B', '002', 2, 9, 'ACTIVE'),
('B', '002', 3, 0, 'ACTIVE'),
('B', '003', 1, 0, 'ACTIVE'),
('B', '003', 2, 0, 'ACTIVE'),
('B', '003', 3, 0, 'ACTIVE'),
('B', '004', 1, 0, 'ACTIVE'),
('B', '004', 2, 0, 'ACTIVE'),
('B', '004', 3, 0, 'ACTIVE'),
('B', '005', 1, 0, 'ACTIVE'),
('B', '005', 2, 0, 'ACTIVE'),
('B', '005', 3, 0, 'ACTIVE'),
('B', '006', 1, 0, 'ACTIVE'),
('B', '006', 2, 0, 'ACTIVE'),
('B', '006', 3, 0, 'ACTIVE'),
('B', '007', 1, 0, 'ACTIVE'),
('B', '007', 2, 0, 'ACTIVE'),
('B', '007', 3, 0, 'ACTIVE'),
('B', '008', 1, 0, 'ACTIVE'),
('B', '008', 2, 0, 'ACTIVE'),
('B', '008', 3, 0, 'ACTIVE'),
('B', '009', 1, 0, 'ACTIVE'),
('B', '009', 2, 0, 'ACTIVE'),
('B', '009', 3, 0, 'ACTIVE'),
('B', '010', 1, 0, 'ACTIVE'),
('B', '010', 2, 0, 'ACTIVE'),
('B', '010', 3, 0, 'ACTIVE'),
('B', '099', 1, 0, 'ACTIVE'),
('B', '099', 2, 0, 'ACTIVE'),
('B', '099', 3, 0, 'ACTIVE'),
('B', '100', 1, 0, 'ACTIVE'),
('B', '100', 2, 0, 'ACTIVE'),
('B', '100', 3, 0, 'ACTIVE'),
('B', '101', 1, 0, 'ACTIVE'),
('B', '101', 2, 0, 'ACTIVE'),
('B', '101', 3, 0, 'ACTIVE'),
('D', '001', 1, 0, 'ACTIVE'),
('D', '001', 2, 4, 'ACTIVE'),
('D', '001', 3, 0, 'ACTIVE'),
('D', '002', 1, 0, 'ACTIVE'),
('D', '002', 2, 0, 'ACTIVE'),
('D', '002', 3, 0, 'ACTIVE'),
('D', '003', 1, 0, 'ACTIVE'),
('D', '003', 2, 0, 'ACTIVE'),
('D', '003', 3, 0, 'ACTIVE'),
('D', '004', 1, 0, 'ACTIVE'),
('D', '004', 2, 0, 'ACTIVE'),
('D', '004', 3, 0, 'ACTIVE'),
('D', '005', 1, 0, 'ACTIVE'),
('D', '005', 2, 0, 'ACTIVE'),
('D', '005', 3, 0, 'ACTIVE'),
('D', '006', 1, 0, 'ACTIVE'),
('D', '006', 2, 0, 'ACTIVE'),
('D', '006', 3, 0, 'ACTIVE'),
('D', '007', 1, 0, 'ACTIVE'),
('D', '007', 2, 0, 'ACTIVE'),
('D', '007', 3, 0, 'ACTIVE'),
('D', '008', 1, 0, 'ACTIVE'),
('D', '008', 2, 0, 'ACTIVE'),
('D', '008', 3, 0, 'ACTIVE'),
('D', '009', 1, 0, 'ACTIVE'),
('D', '009', 2, 0, 'ACTIVE'),
('D', '009', 3, 0, 'ACTIVE'),
('F', '001', 1, 0, 'ACTIVE'),
('F', '001', 2, 0, 'ACTIVE'),
('F', '001', 3, 0, 'ACTIVE'),
('M', '001', 1, 0, 'ACTIVE'),
('M', '001', 2, 0, 'ACTIVE'),
('M', '001', 3, 0, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `stock_history`
--

CREATE TABLE `stock_history` (
  `ID_STOCK_HISTORY` int(11) NOT NULL,
  `TYPE_PRODUCT` varchar(3) NOT NULL,
  `ID_PRODUCT` varchar(10) NOT NULL,
  `ID_STOCK_TYPE` int(11) NOT NULL,
  `AMOUNT_STOCK` float NOT NULL,
  `ID_VENDOR_SENDER` int(11) NOT NULL,
  `ID_USER_SENDER` int(11) NOT NULL,
  `ID_VENDOR_RECEIVER` int(11) NOT NULL,
  `ID_USER_RECEIVER` int(11) NOT NULL,
  `DATE_STOCK_HISTORY` date NOT NULL,
  `DESCRIPTION_STOCK_HISTORY` varchar(125) NOT NULL,
  `ID_STOCK_STATUS` int(11) NOT NULL DEFAULT '1',
  `LATEST_STOCK_AMOUNT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_history`
--

INSERT INTO `stock_history` (`ID_STOCK_HISTORY`, `TYPE_PRODUCT`, `ID_PRODUCT`, `ID_STOCK_TYPE`, `AMOUNT_STOCK`, `ID_VENDOR_SENDER`, `ID_USER_SENDER`, `ID_VENDOR_RECEIVER`, `ID_USER_RECEIVER`, `DATE_STOCK_HISTORY`, `DESCRIPTION_STOCK_HISTORY`, `ID_STOCK_STATUS`, `LATEST_STOCK_AMOUNT`) VALUES
(100, 'B', '001', 1, 50, 6, 10, 1, 10, '2019-06-04', '', 1, 50),
(101, 'B', '001', 2, 20, 1, 10, 2, 6, '2019-06-04', '', 1, 30),
(102, 'B', '001', 2, 20, 1, 10, 3, 3, '2019-06-04', '', 1, 10),
(103, 'B', '001', 1, 20, 1, 10, 2, 6, '2019-06-04', '', 3, 20),
(104, 'B', '001', 1, 20, 1, 10, 3, 8, '2019-06-04', '', 1, 20),
(105, 'B', '001', 3, 1, 1, 10, 1, 10, '2019-06-04', '', 1, 9),
(106, 'B', '002', 4, 3, 1, 10, 1, 10, '2019-06-04', '', 1, 3),
(107, 'B', '001', 5, 2, 1, 10, 1, 10, '2019-06-04', '', 1, 7),
(108, 'B', '001', 6, 1, 1, 10, 1, 10, '2019-06-04', '', 1, 8),
(109, 'B', '001', 7, 1, 1, 10, 1, 10, '2019-06-04', '', 1, 7),
(110, 'B', '001', 9, 2, 1, 10, 1, 10, '2019-06-04', '', 1, 5),
(111, 'B', '001', 9, 1, 1, 10, 1, 10, '2019-06-04', '', 1, 4),
(112, 'B', '001', 9, 2, 1, 10, 1, 10, '2019-06-04', '', 1, 2),
(115, 'B', '001', 1, 13, 2, 3, 1, 5, '2019-06-08', '', 1, 15),
(116, 'B', '001', 1, 2, 2, 6, 1, 5, '2019-06-08', '', 1, 17),
(117, 'B', '001', 1, 10, 6, 1, 1, 5, '2019-06-09', 'Pulang lamaran ini', 1, 27),
(118, 'B', '001', 2, 2, 1, 5, 2, 3, '2019-06-09', 'Ini habis lamaran terus transfer', 1, 25),
(119, 'B', '001', 2, 2, 1, 5, 3, 8, '2019-06-09', 'Keluar lagi buat test', 1, 23),
(133, 'B', '001', 3, 1, 1, 5, 1, 5, '2019-06-10', 'Repack tanggal 10 malem', 1, 22),
(134, 'B', '002', 4, 2, 1, 5, 1, 5, '2019-06-10', '', 1, 5),
(136, 'B', '001', 3, 1, 1, 5, 1, 5, '2019-06-10', '', 1, 21),
(137, 'B', '002', 4, 2, 1, 5, 1, 5, '2019-06-10', '', 1, 7),
(138, 'B', '001', 3, 1, 1, 5, 1, 5, '2019-06-10', 'Coba lagi buat description', 1, 20),
(139, 'B', '002', 4, 2, 1, 5, 1, 5, '2019-06-10', 'Coba lagi buat description', 1, 9),
(144, 'B', '001', 5, 1, 1, 5, 1, 5, '2019-06-11', 'Recycle testt', 1, 19),
(145, 'B', '001', 6, 2, 1, 5, 1, 5, '2019-06-11', '', 1, 21),
(146, 'B', '001', 5, 2, 1, 5, 1, 5, '2019-06-11', 'Recycle testt again', 1, 19),
(147, 'B', '001', 6, 1, 1, 5, 1, 5, '2019-06-11', 'Recycle testt again', 1, 20),
(148, 'B', '001', 9, 1, 1, 5, 1, 5, '2019-06-11', '', 1, 19),
(149, 'B', '001', 9, 4, 1, 5, 1, 5, '2019-06-11', '', 1, 15),
(150, 'B', '001', 7, 1, 1, 5, 1, 5, '2019-06-11', '', 1, 14),
(151, 'B', '001', 8, 1, 1, 5, 1, 5, '2019-06-11', 'Habis expired coba yang rusak', 1, 13),
(152, 'B', '001', 9, 1, 1, 5, 1, 5, '2019-06-12', '', 1, 12),
(153, 'B', '001', 9, 1, 1, 5, 1, 5, '2019-06-12', '', 1, 11),
(154, 'B', '001', 9, 1, 1, 5, 1, 5, '2019-06-12', '', 1, 10),
(155, 'B', '001', 9, 1, 1, 5, 1, 5, '2019-06-12', '', 1, 9),
(156, 'B', '001', 9, 1, 1, 5, 1, 5, '2019-06-12', '', 1, 8),
(157, 'B', '001', 9, 1, 1, 5, 1, 5, '2019-06-12', '', 1, 7),
(158, 'B', '001', 9, 1, 1, 5, 1, 5, '2019-06-12', '', 2, 6),
(159, 'B', '001', 9, 1, 1, 5, 1, 5, '2019-06-12', '', 3, 5),
(160, 'B', '001', 9, 1, 3, 5, 3, 5, '2019-06-15', '', 1, 19),
(161, 'B', '001', 9, 1, 1, 5, 1, 5, '2019-06-15', '', 3, 4),
(162, 'B', '001', 9, 3, 2, 5, 2, 5, '2019-06-15', '', 3, 17),
(163, 'B', '001', 5, 2, 2, 6, 2, 6, '2019-06-17', 'Kelebihan masukin, perbaikan dari entry 103', 3, 15),
(164, 'B', '001', 6, 0, 2, 6, 2, 6, '2019-06-17', 'Kelebihan masukin, perbaikan dari entry 103', 3, 15),
(165, 'B', '002', 1, 10, 1, 3, 2, 5, '2019-06-21', '', 1, 10),
(166, 'B', '002', 9, 1, 2, 5, 2, 5, '2019-06-21', '', 1, 9),
(167, 'B', '002', 9, 2, 1, 5, 1, 5, '2019-06-21', '', 1, 7),
(168, 'B', '001', 9, 3, 2, 6, 2, 6, '2019-06-22', '', 1, 12),
(169, 'D', '001', 1, 5, 1, 3, 2, 5, '2019-06-22', '', 1, 5),
(170, 'D', '001', 9, 1, 2, 6, 2, 6, '2019-06-22', '', 1, 4),
(171, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 11),
(172, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 10),
(173, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 9),
(174, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 8),
(175, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 7),
(176, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 6),
(177, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 5),
(178, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 4),
(179, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 3),
(180, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 2),
(181, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 1),
(182, 'B', '001', 9, 1, 2, 6, 2, 6, '2019-06-25', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_status`
--

CREATE TABLE `stock_status` (
  `ID_STOCK_STATUS` int(11) NOT NULL,
  `NAME_STOCK_STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_status`
--

INSERT INTO `stock_status` (`ID_STOCK_STATUS`, `NAME_STOCK_STATUS`) VALUES
(1, 'Pending'),
(2, 'Verified - Therapist'),
(3, 'Verified - Admin'),
(4, 'Rejected'),
(5, 'Archive');

-- --------------------------------------------------------

--
-- Table structure for table `stock_type`
--

CREATE TABLE `stock_type` (
  `ID_STOCK_TYPE` int(11) NOT NULL,
  `NAME_STOCK_TYPE` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_type`
--

INSERT INTO `stock_type` (`ID_STOCK_TYPE`, `NAME_STOCK_TYPE`) VALUES
(1, 'Stok Masuk'),
(2, 'Stok Transfer'),
(3, 'Stok Keluar Repack'),
(4, 'Stok Masuk Repack'),
(5, 'Stok Keluar Menyusut'),
(6, 'Stok Masuk Menyusut'),
(7, 'Stok Expired'),
(8, 'Stok Rusak'),
(9, 'Transaksi Produk'),
(10, 'Transaksi Perawatan'),
(11, 'Transaksi Produk Return');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `ID_TRANSACTION` int(11) NOT NULL,
  `DATE_TRANSACTION` date NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_CUSTOMER` int(11) NOT NULL,
  `ID_VENDOR` int(11) NOT NULL,
  `STATUS_TRANSACTION` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`ID_TRANSACTION`, `DATE_TRANSACTION`, `ID_USER`, `ID_CUSTOMER`, `ID_VENDOR`, `STATUS_TRANSACTION`) VALUES
(5, '2019-06-04', 10, 1, 1, 'ACTIVE'),
(6, '2019-07-05', 10, 2, 1, 'ACTIVE'),
(7, '2019-07-06', 10, 3, 1, 'ACTIVE'),
(8, '2019-06-11', 5, 2, 1, 'ACTIVE'),
(10, '2019-06-12', 5, 1, 1, 'ACTIVE'),
(11, '2019-06-12', 5, 1, 1, 'ACTIVE'),
(12, '2019-06-12', 5, 2, 1, 'ACTIVE'),
(13, '2019-06-12', 5, 6, 1, 'ACTIVE'),
(14, '2019-06-12', 5, 1, 1, 'ACTIVE'),
(15, '2019-06-12', 5, 1, 1, 'ACTIVE'),
(16, '2019-06-12', 5, 1, 1, 'ACTIVE'),
(17, '2019-06-12', 5, 1, 1, 'ACTIVE'),
(18, '2019-06-12', 5, 1, 1, 'ACTIVE'),
(19, '2019-06-15', 5, 16, 3, 'ACTIVE'),
(20, '2019-06-15', 5, 17, 1, 'ACTIVE'),
(21, '2019-06-15', 5, 17, 2, 'ACTIVE'),
(22, '2019-06-15', 5, 18, 1, 'ACTIVE'),
(23, '2019-06-21', 5, 2, 2, 'ACTIVE'),
(24, '2019-06-21', 5, 6, 1, 'ACTIVE'),
(25, '2019-06-22', 6, 10, 2, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_product`
--

CREATE TABLE `transaction_product` (
  `ID_TRANSACTION_PRODUCT` int(11) NOT NULL,
  `ID_TRANSACTION` int(11) NOT NULL,
  `TYPE_PRODUCT` varchar(3) NOT NULL,
  `ID_PRODUCT` varchar(10) NOT NULL,
  `ID_STOCK_HISTORY` int(11) NOT NULL,
  `AMOUNT_PRODUCT` int(11) NOT NULL,
  `DISCOUNT_PRODUCT` int(11) NOT NULL,
  `TOTAL_PRICE` int(11) NOT NULL,
  `DATE_TRANSACTION_PRODUCT` date NOT NULL,
  `DESCRIPTION_TRANSACTION_PRODUCT` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_product`
--

INSERT INTO `transaction_product` (`ID_TRANSACTION_PRODUCT`, `ID_TRANSACTION`, `TYPE_PRODUCT`, `ID_PRODUCT`, `ID_STOCK_HISTORY`, `AMOUNT_PRODUCT`, `DISCOUNT_PRODUCT`, `TOTAL_PRICE`, `DATE_TRANSACTION_PRODUCT`, `DESCRIPTION_TRANSACTION_PRODUCT`) VALUES
(5, 5, 'B', '001', 110, 2, 5, 110000, '2019-06-04', ''),
(6, 6, 'B', '001', 111, 1, 0, 55000, '2019-06-04', ''),
(7, 7, 'B', '001', 112, 2, 0, 110000, '2019-06-04', ''),
(8, 8, 'B', '001', 148, 1, 0, 55000, '2019-06-11', ''),
(9, 8, 'B', '001', 149, 4, 25, 220000, '2019-06-11', ''),
(10, 11, 'B', '001', 152, 1, 0, 55000, '2019-06-12', ''),
(11, 12, 'B', '001', 153, 1, 10, 55000, '2019-06-12', ''),
(12, 13, 'B', '001', 154, 1, 0, 55000, '2019-06-12', ''),
(13, 14, 'B', '001', 155, 1, 0, 55000, '2019-06-12', ''),
(14, 15, 'B', '001', 156, 1, 0, 55000, '2019-06-12', ''),
(15, 16, 'B', '001', 157, 1, 0, 55000, '2019-06-12', ''),
(16, 17, 'B', '001', 158, 1, 0, 55000, '2019-06-12', ''),
(17, 18, 'B', '001', 159, 1, 0, 55000, '2019-06-12', ''),
(18, 19, 'B', '001', 160, 1, 0, 55000, '2019-06-15', ''),
(19, 20, 'B', '001', 161, 1, 0, 55000, '2019-06-15', ''),
(20, 21, 'B', '001', 162, 3, 0, 165000, '2019-06-15', ''),
(21, 23, 'B', '002', 166, 1, 0, 55000, '2019-06-21', ''),
(22, 24, 'B', '002', 167, 2, 0, 110000, '2019-06-21', ''),
(23, 25, 'B', '001', 168, 3, 15, 165000, '2019-06-22', ''),
(24, 25, 'D', '001', 170, 1, 0, 100000, '2019-06-22', ''),
(25, 25, 'B', '001', 171, 1, 0, 55000, '2019-06-25', ''),
(26, 25, 'B', '001', 172, 1, 0, 55000, '2019-06-25', ''),
(27, 25, 'B', '001', 173, 1, 0, 55000, '2019-06-25', ''),
(28, 25, 'B', '001', 174, 1, 0, 55000, '2019-06-25', ''),
(29, 25, 'B', '001', 175, 1, 0, 55000, '2019-06-25', ''),
(30, 25, 'B', '001', 176, 1, 0, 55000, '2019-06-25', ''),
(31, 25, 'B', '001', 177, 1, 0, 55000, '2019-06-25', ''),
(32, 25, 'B', '001', 178, 1, 0, 55000, '2019-06-25', ''),
(33, 25, 'B', '001', 179, 1, 0, 55000, '2019-06-25', ''),
(34, 25, 'B', '001', 180, 1, 0, 55000, '2019-06-25', ''),
(35, 25, 'B', '001', 181, 1, 0, 55000, '2019-06-25', ''),
(36, 25, 'B', '001', 182, 1, 0, 55000, '2019-06-25', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_treatment`
--

CREATE TABLE `transaction_treatment` (
  `ID_TRANSACTION_TREATMENT` int(11) NOT NULL,
  `ID_TRANSACTION` int(11) NOT NULL,
  `ID_TREATMENT` varchar(10) NOT NULL,
  `AMOUNT_TREATMENT` int(11) NOT NULL,
  `TOTAL_PRICE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `ID_TREATMENT` varchar(10) NOT NULL,
  `NAME_TREATMENT` varchar(100) NOT NULL,
  `PRICE_TREATMENT` int(11) NOT NULL,
  `TYPE_TREATMENT` varchar(20) NOT NULL,
  `DESCRIPTION_TREATMENT` varchar(200) NOT NULL,
  `STATUS_TREATMENT` varchar(20) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`ID_TREATMENT`, `NAME_TREATMENT`, `PRICE_TREATMENT`, `TYPE_TREATMENT`, `DESCRIPTION_TREATMENT`, `STATUS_TREATMENT`) VALUES
('1', 'Facial Basic', 100000, 'Facial', 'Ini adalah facial basic', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `NAME_USER` varchar(100) NOT NULL,
  `PASSWORD_USER` varchar(20) NOT NULL DEFAULT 'rccempaka',
  `BIRTHDATE_USER` date NOT NULL,
  `NOTELP_USER` varchar(20) NOT NULL,
  `WORKING_SINCE` date NOT NULL,
  `SALARY_USER` int(11) NOT NULL,
  `ADDRESS_USER` varchar(100) NOT NULL,
  `ID_USER_TYPE` int(11) NOT NULL DEFAULT '3',
  `STATUS_USER` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `NAME_USER`, `PASSWORD_USER`, `BIRTHDATE_USER`, `NOTELP_USER`, `WORKING_SINCE`, `SALARY_USER`, `ADDRESS_USER`, `ID_USER_TYPE`, `STATUS_USER`) VALUES
(1, 'Super Admin', 'rccempaka', '1900-10-10', '081333222111', '2014-01-01', 0, 'Jalan Blimbing Indah Megah 12B Blok J7-4', 1, 'ACTIVE'),
(2, 'Lain-Lain', 'rccempaka', '1900-10-10', '', '1970-01-01', 0, '', 99, 'ACTIVE'),
(3, 'Fuad Achmadi', 'rccempaka', '1961-11-13', '081333222111', '2014-01-01', 0, 'Jalan Blimbing Indah Megah 12B Blok J7-4', 2, 'ACTIVE'),
(4, 'Dr. Wahyuni', 'rccempaka', '1964-03-28', '+6281333217921', '2014-01-01', 0, 'Jalan Blimbing Indah Megah 12B Blok J7-4', 3, 'ACTIVE'),
(5, 'Danniar Reza', 'rahasia', '1996-02-26', '+6281333217921', '2014-01-01', 0, 'Jalan Blimbing Indah Megah 12B Blok J7-4', 2, 'ACTIVE'),
(6, 'Anjar', 'rccempaka', '1990-01-01', '081333222111', '2017-01-01', 0, 'Jalan Bandulan', 3, 'ACTIVE'),
(7, 'Novi', 'rccempaka', '1990-01-01', '081333222222', '2019-01-01', 0, 'Jalan Blimbing', 3, 'ACTIVE'),
(8, 'Aini', 'rccempaka', '1985-01-01', '+6281333217921', '2015-01-01', 0, 'Jalan Karangploso', 3, 'ACTIVE'),
(9, 'Dinda', 'rccempaka', '1990-01-01', '081333222111', '2018-06-01', 0, 'Jalan Karangploso', 3, 'ACTIVE'),
(10, 'Nur', 'rccempaka', '1990-01-01', '081222333444', '2014-01-01', 0, 'Jalan Sengon', 3, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `ID_USER_TYPE` int(11) NOT NULL,
  `NAME_USER_TYPE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`ID_USER_TYPE`, `NAME_USER_TYPE`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Therapist'),
(99, 'Lain-Lain');

-- --------------------------------------------------------

--
-- Table structure for table `user_visibility`
--

CREATE TABLE `user_visibility` (
  `ID_USER` int(11) NOT NULL,
  `ID_VENDOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_visibility`
--

INSERT INTO `user_visibility` (`ID_USER`, `ID_VENDOR`) VALUES
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(6, 2),
(7, 2),
(8, 3),
(9, 3),
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `ID_VENDOR` int(11) NOT NULL,
  `NAME_VENDOR` varchar(50) NOT NULL,
  `TYPE_VENDOR` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`ID_VENDOR`, `NAME_VENDOR`, `TYPE_VENDOR`) VALUES
(1, 'Sengon', 'STORE'),
(2, 'Araya', 'STORE'),
(3, 'Karangploso', 'STORE'),
(4, 'CDE', 'SUPPLIER'),
(5, 'Kalbe', 'SUPPLIER'),
(6, 'Lain Lain', 'SUPPLIER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID_CUSTOMER`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`TYPE_PRODUCT`,`ID_PRODUCT`),
  ADD KEY `FK_USER_ADDED_PRODUCT` (`USER_ADDED_PRODUCT`),
  ADD KEY `FK_USER_UPDATED_PRODUCT` (`USER_UPDATED_PRODUCT`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`ID_PRODUCT_TYPE`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`TYPE_PRODUCT`,`ID_PRODUCT`,`ID_VENDOR`),
  ADD KEY `FK_STOCK_VENDOR` (`ID_VENDOR`);

--
-- Indexes for table `stock_history`
--
ALTER TABLE `stock_history`
  ADD PRIMARY KEY (`ID_STOCK_HISTORY`,`TYPE_PRODUCT`,`ID_PRODUCT`),
  ADD KEY `FK_STOCK_HISTORY_PRODUCT` (`TYPE_PRODUCT`,`ID_PRODUCT`),
  ADD KEY `FK_STOCK_HISTORY_STOCK_TYPE` (`ID_STOCK_TYPE`),
  ADD KEY `FK_STOCK_HISTORY_VENDOR_SENDER` (`ID_VENDOR_SENDER`),
  ADD KEY `FK_STOCK_HISTORY_VENDOR_RECEIVER` (`ID_VENDOR_RECEIVER`),
  ADD KEY `FK_STOCK_HISTORY_USER_SENDER` (`ID_USER_SENDER`),
  ADD KEY `FK_STOCK_HISTORY_USER_RECEIVER` (`ID_USER_RECEIVER`),
  ADD KEY `FK_REFERENCE_STOCK_HISTORY` (`LATEST_STOCK_AMOUNT`),
  ADD KEY `FK_STOCK_HISTORY_STATUS` (`ID_STOCK_STATUS`);

--
-- Indexes for table `stock_status`
--
ALTER TABLE `stock_status`
  ADD PRIMARY KEY (`ID_STOCK_STATUS`);

--
-- Indexes for table `stock_type`
--
ALTER TABLE `stock_type`
  ADD PRIMARY KEY (`ID_STOCK_TYPE`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID_TRANSACTION`),
  ADD KEY `FK_TRANSACTION_CUSTOMER` (`ID_CUSTOMER`),
  ADD KEY `FK_TRANSACTION_USER` (`ID_USER`),
  ADD KEY `FK_TRANSACTION_VENDOR` (`ID_VENDOR`);

--
-- Indexes for table `transaction_product`
--
ALTER TABLE `transaction_product`
  ADD PRIMARY KEY (`ID_TRANSACTION_PRODUCT`),
  ADD KEY `FK_TRANSACTION_PRODUCT_TRANSACTION` (`ID_TRANSACTION`),
  ADD KEY `FK_TRANSACTION_PRODUCT_PRODUCT` (`TYPE_PRODUCT`,`ID_PRODUCT`),
  ADD KEY `FK_TRANSACTION_PRODUCT_STOCK_HISTORY` (`ID_STOCK_HISTORY`);

--
-- Indexes for table `transaction_treatment`
--
ALTER TABLE `transaction_treatment`
  ADD PRIMARY KEY (`ID_TRANSACTION_TREATMENT`),
  ADD KEY `FK_TRANSACTION_TREATMENT_TREATMENT` (`ID_TREATMENT`),
  ADD KEY `FK_TRANSACTION_TREATMENT_TRANSACTION` (`ID_TRANSACTION`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`ID_TREATMENT`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `FK_USER_USER_TYPE` (`ID_USER_TYPE`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`ID_USER_TYPE`);

--
-- Indexes for table `user_visibility`
--
ALTER TABLE `user_visibility`
  ADD PRIMARY KEY (`ID_USER`,`ID_VENDOR`),
  ADD KEY `FK_USER_VISIBILITY_VENDOR` (`ID_VENDOR`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`ID_VENDOR`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID_CUSTOMER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `stock_history`
--
ALTER TABLE `stock_history`
  MODIFY `ID_STOCK_HISTORY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;
--
-- AUTO_INCREMENT for table `stock_status`
--
ALTER TABLE `stock_status`
  MODIFY `ID_STOCK_STATUS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `stock_type`
--
ALTER TABLE `stock_type`
  MODIFY `ID_STOCK_TYPE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID_TRANSACTION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `transaction_product`
--
ALTER TABLE `transaction_product`
  MODIFY `ID_TRANSACTION_PRODUCT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `transaction_treatment`
--
ALTER TABLE `transaction_treatment`
  MODIFY `ID_TRANSACTION_TREATMENT` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `ID_USER_TYPE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `ID_VENDOR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_PRODUCT_TYPE_PRODUCT` FOREIGN KEY (`TYPE_PRODUCT`) REFERENCES `product_type` (`ID_PRODUCT_TYPE`),
  ADD CONSTRAINT `FK_USER_ADDED_PRODUCT` FOREIGN KEY (`USER_ADDED_PRODUCT`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_USER_UPDATED_PRODUCT` FOREIGN KEY (`USER_UPDATED_PRODUCT`) REFERENCES `user` (`ID_USER`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_STOCK_PRODUCT` FOREIGN KEY (`TYPE_PRODUCT`,`ID_PRODUCT`) REFERENCES `product` (`TYPE_PRODUCT`, `ID_PRODUCT`),
  ADD CONSTRAINT `FK_STOCK_VENDOR` FOREIGN KEY (`ID_VENDOR`) REFERENCES `vendor` (`ID_VENDOR`);

--
-- Constraints for table `stock_history`
--
ALTER TABLE `stock_history`
  ADD CONSTRAINT `FK_STOCK_HISTORY_PRODUCT` FOREIGN KEY (`TYPE_PRODUCT`,`ID_PRODUCT`) REFERENCES `product` (`TYPE_PRODUCT`, `ID_PRODUCT`),
  ADD CONSTRAINT `FK_STOCK_HISTORY_STATUS` FOREIGN KEY (`ID_STOCK_STATUS`) REFERENCES `stock_status` (`ID_STOCK_STATUS`),
  ADD CONSTRAINT `FK_STOCK_HISTORY_STOCK_TYPE` FOREIGN KEY (`ID_STOCK_TYPE`) REFERENCES `stock_type` (`ID_STOCK_TYPE`),
  ADD CONSTRAINT `FK_STOCK_HISTORY_USER_RECEIVER` FOREIGN KEY (`ID_USER_RECEIVER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_STOCK_HISTORY_USER_SENDER` FOREIGN KEY (`ID_USER_SENDER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_STOCK_HISTORY_VENDOR_RECEIVER` FOREIGN KEY (`ID_VENDOR_RECEIVER`) REFERENCES `vendor` (`ID_VENDOR`),
  ADD CONSTRAINT `FK_STOCK_HISTORY_VENDOR_SENDER` FOREIGN KEY (`ID_VENDOR_SENDER`) REFERENCES `vendor` (`ID_VENDOR`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_TRANSACTION_CUSTOMER` FOREIGN KEY (`ID_CUSTOMER`) REFERENCES `customer` (`ID_CUSTOMER`),
  ADD CONSTRAINT `FK_TRANSACTION_USER` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_TRANSACTION_VENDOR` FOREIGN KEY (`ID_VENDOR`) REFERENCES `vendor` (`ID_VENDOR`);

--
-- Constraints for table `transaction_product`
--
ALTER TABLE `transaction_product`
  ADD CONSTRAINT `FK_TRANSACTION_PRODUCT_PRODUCT` FOREIGN KEY (`TYPE_PRODUCT`,`ID_PRODUCT`) REFERENCES `product` (`TYPE_PRODUCT`, `ID_PRODUCT`),
  ADD CONSTRAINT `FK_TRANSACTION_PRODUCT_STOCK_HISTORY` FOREIGN KEY (`ID_STOCK_HISTORY`) REFERENCES `stock_history` (`ID_STOCK_HISTORY`),
  ADD CONSTRAINT `FK_TRANSACTION_PRODUCT_TRANSACTION` FOREIGN KEY (`ID_TRANSACTION`) REFERENCES `transaction` (`ID_TRANSACTION`);

--
-- Constraints for table `transaction_treatment`
--
ALTER TABLE `transaction_treatment`
  ADD CONSTRAINT `FK_TRANSACTION_TREATMENT_TRANSACTION` FOREIGN KEY (`ID_TRANSACTION`) REFERENCES `transaction` (`ID_TRANSACTION`),
  ADD CONSTRAINT `FK_TRANSACTION_TREATMENT_TREATMENT` FOREIGN KEY (`ID_TREATMENT`) REFERENCES `treatment` (`ID_TREATMENT`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_USER_TYPE` FOREIGN KEY (`ID_USER_TYPE`) REFERENCES `user_type` (`ID_USER_TYPE`);

--
-- Constraints for table `user_visibility`
--
ALTER TABLE `user_visibility`
  ADD CONSTRAINT `FK_USER_VISIBILITY_USER` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_USER_VISIBILITY_VENDOR` FOREIGN KEY (`ID_VENDOR`) REFERENCES `vendor` (`ID_VENDOR`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
