-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 06:26 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `optima`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID_BARANG` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NAMA_BARANG` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `JUMLAH_BARANG` int(11) NOT NULL,
  `NAMA_SUPPLIER` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `NAMA_BARANG`, `JUMLAH_BARANG`, `NAMA_SUPPLIER`, `DATE`) VALUES
('PRD002', 'dadu', 5, 'GREEBEL', '2022-12-25 05:01:39'),
('PRD010', 'penggaris siku', 0, 'Pt. Joyko ', '2022-12-25 05:26:28'),
('PRD004', 'pensil', 15, 'GREEBEL', '2022-12-24 18:19:23'),
('PRD005', 'penghapus ', 15, 'GREEBEL', '2022-12-25 04:13:19'),
('PRD006', 'penggaris', 10, 'GREEBEL', '2022-12-25 04:13:39'),
('PRD007', 'router wifii', 12, 'GREEBEL', '2022-12-25 04:14:44'),
('PRD008', 'bolpoin gel hitam', 50, 'GREEBEL', '2022-12-25 04:16:08'),
('PRD009', 'stapler', 20, 'GREEBEL', '2022-12-25 04:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `ID_SUPPLIER` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NAMA_SUPPLIER` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NOMOR_TELP` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ALAMAT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID_SUPPLIER`, `NAMA_SUPPLIER`, `NOMOR_TELP`, `ALAMAT`) VALUES
('SUP001', 'GREEBEL', '03155543222', 'Jl Ahmad Yani'),
('SUP002', 'Pt. Joyko ', '08239271237', 'Jl. Mayjen Sungkono no.70 Surabaya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
