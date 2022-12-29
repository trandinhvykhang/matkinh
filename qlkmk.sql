-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 26, 2022 at 08:01 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlkmk`
--

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `macv` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tencv` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `mahd` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mamk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soluong` double NOT NULL,
  `tenkh` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdtkh` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matkinh`
--

CREATE TABLE `matkinh` (
  `mamk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenmk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thuonghieu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mau` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nsx` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` double NOT NULL,
  `soluong` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manv` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tennv` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `macv` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namsinh` date NOT NULL,
  `sdt` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`macv`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahd`),
  ADD KEY `FK_MaMK` (`mamk`);

--
-- Indexes for table `matkinh`
--
ALTER TABLE `matkinh`
  ADD PRIMARY KEY (`mamk`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manv`),
  ADD KEY `chucvu` (`macv`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `FK_MaMK` FOREIGN KEY (`mamk`) REFERENCES `matkinh` (`mamk`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `FK_MACV` FOREIGN KEY (`macv`) REFERENCES `chucvu` (`macv`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
