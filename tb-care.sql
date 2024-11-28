-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 12:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tb-care`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `title_name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `announce_name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alert_name` enum('primary','info','danger','warning') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'primary',
  `author_name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `copyright_name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `website` text NOT NULL,
  `theme` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `theme_text` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_name` text NOT NULL,
  `maintenance` int(10) NOT NULL,
  `ads_id` text NOT NULL,
  `ads_body` text NOT NULL,
  `ads_amp` text NOT NULL,
  `ads_1` text NOT NULL,
  `ads_2` text NOT NULL,
  `ads_3` text NOT NULL,
  `ads_4` text NOT NULL,
  `ads_5` text NOT NULL,
  `ads_6` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `title_name`, `announce_name`, `alert_name`, `author_name`, `copyright_name`, `website`, `theme`, `theme_text`, `menu_name`, `maintenance`, `ads_id`, `ads_body`, `ads_amp`, `ads_1`, `ads_2`, `ads_3`, `ads_4`, `ads_5`, `ads_6`) VALUES
(1, 'TB-CARE', 'David Espinosa', 'info', 'Sikatpinoy Admin', 'Sikatpinoy DEV', 'TB-CARE', '#59c5b8', '#042b97', 'Sikatpinoy', 0, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `april`
--

CREATE TABLE `april` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `april`
--

INSERT INTO `april` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `august`
--

CREATE TABLE `august` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `august`
--

INSERT INTO `august` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `barangay_id` int(11) NOT NULL,
  `barangay_name` varchar(64) NOT NULL,
  `barangay_information` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`barangay_id`, `barangay_name`, `barangay_information`) VALUES
(1, 'san jose', 'san jose'),
(2, 'magsaysay', NULL),
(3, 'tagumpay', NULL),
(4, 'ibud', NULL),
(5, 'san roque', NULL),
(6, 'burgos', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `december`
--

CREATE TABLE `december` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `december`
--

INSERT INTO `december` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `february`
--

CREATE TABLE `february` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `february`
--

INSERT INTO `february` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `log_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `remain` int(11) NOT NULL DEFAULT 0,
  `picture` varchar(1000) DEFAULT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`log_id`, `name`, `total`, `remain`, `picture`, `date_added`, `last_updated`) VALUES
(6, 'Rifampin', 200, 39500, NULL, '2024-09-12 10:54:35', '2024-11-12 12:10:58'),
(7, 'Mefenamic', 9600, 9600, NULL, '2024-09-12 10:54:49', '2024-11-12 12:08:34'),
(8, 'Ethambutol', 600, 19970, NULL, '2024-09-12 10:55:07', '2024-11-12 12:11:15'),
(9, 'Pyrazinamide', 2686, 25600, NULL, '2024-09-12 11:35:01', '2024-11-12 12:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `january`
--

CREATE TABLE `january` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `january`
--

INSERT INTO `january` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `july`
--

CREATE TABLE `july` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `july`
--

INSERT INTO `july` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `june`
--

CREATE TABLE `june` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `june`
--

INSERT INTO `june` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `march`
--

CREATE TABLE `march` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `march`
--

INSERT INTO `march` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `may`
--

CREATE TABLE `may` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `may`
--

INSERT INTO `may` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `november`
--

CREATE TABLE `november` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `november`
--

INSERT INTO `november` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `october`
--

CREATE TABLE `october` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `october`
--

INSERT INTO `october` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `log_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `email` varchar(320) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `diagnosis` varchar(1000) DEFAULT NULL,
  `dateofbirth` datetime DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `appointmentdate` datetime DEFAULT NULL,
  `appointmenthours` time DEFAULT NULL,
  `appointmentstatus` varchar(1) NOT NULL DEFAULT '0',
  `appointmentnotes` varchar(200) NOT NULL,
  `files` varchar(1000) DEFAULT NULL,
  `picture` varchar(1000) NOT NULL,
  `lastvisit` date DEFAULT NULL,
  `documents` varchar(1000) NOT NULL,
  `complete` enum('1','0') NOT NULL DEFAULT '0',
  `progress` varchar(1000) NOT NULL DEFAULT '1',
  `program` varchar(1000) NOT NULL,
  `treatment` varchar(2) NOT NULL DEFAULT '0',
  `tb_type` varchar(100) NOT NULL,
  `doctors` varchar(1000) NOT NULL,
  `patientstatus` varchar(1) NOT NULL,
  `med` varchar(1000) NOT NULL,
  `med1` varchar(1000) NOT NULL,
  `med2` varchar(2) NOT NULL,
  `med3` varchar(200) NOT NULL,
  `medguide` varchar(200) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `intense` varchar(1000) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `medicine_name1` varchar(100) NOT NULL,
  `medicine_name2` varchar(100) NOT NULL,
  `medicine_name3` varchar(100) NOT NULL,
  `medin` varchar(200) NOT NULL DEFAULT '0',
  `appdate` date DEFAULT NULL,
  `d_facility` text NOT NULL,
  `f_code` text NOT NULL,
  `province` text NOT NULL,
  `region` text NOT NULL,
  `age` text NOT NULL,
  `sex` text NOT NULL,
  `status` text NOT NULL,
  `philno` longtext NOT NULL,
  `nationality` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`log_id`, `date`, `email`, `firstname`, `lastname`, `diagnosis`, `dateofbirth`, `address`, `contact`, `appointmentdate`, `appointmenthours`, `appointmentstatus`, `appointmentnotes`, `files`, `picture`, `lastvisit`, `documents`, `complete`, `progress`, `program`, `treatment`, `tb_type`, `doctors`, `patientstatus`, `med`, `med1`, `med2`, `med3`, `medguide`, `uname`, `intense`, `medicine_name`, `medicine_name1`, `medicine_name2`, `medicine_name3`, `medin`, `appdate`, `d_facility`, `f_code`, `province`, `region`, `age`, `sex`, `status`, `philno`, `nationality`) VALUES
(1, NULL, 'admin@gmail.com', 'aaa', 'aaa', NULL, '2000-01-01 00:00:00', 'san jose', '12345', NULL, NULL, '0', '', 'uploads/documents/20241128063836.pdf', 'img/picture/20241128063836.png', NULL, '', '0', '1', '', '0', 'eptb', '', '1', '', '', '', '', '', 'juan@gmail.com', '', '', '', '', '', '0', NULL, 'aaa', 'aaa', 'Occidental Mindoro', 'IV-B MIMAROPA', '24', '0', '0', 'aaa', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `security_checks`
--

CREATE TABLE `security_checks` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `security_check` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `security_checks`
--

INSERT INTO `security_checks` (`id`, `link`, `security_check`) VALUES
(1, 'https://sikatpinoy.net/david.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `september`
--

CREATE TABLE `september` (
  `log_id` int(11) NOT NULL,
  `i1` int(11) NOT NULL,
  `i2` int(11) NOT NULL,
  `i3` int(11) NOT NULL,
  `i4` int(11) NOT NULL,
  `i5` int(11) NOT NULL,
  `i6` int(11) NOT NULL,
  `i7` int(11) NOT NULL,
  `i8` int(11) NOT NULL,
  `i9` int(11) NOT NULL,
  `i10` int(11) NOT NULL,
  `i11` int(11) NOT NULL,
  `i12` int(11) NOT NULL,
  `i13` int(11) NOT NULL,
  `i14` int(11) NOT NULL,
  `i15` int(11) NOT NULL,
  `i16` int(11) NOT NULL,
  `i17` int(11) NOT NULL,
  `i18` int(11) NOT NULL,
  `i19` int(11) NOT NULL,
  `i20` int(11) NOT NULL,
  `i21` int(11) NOT NULL,
  `i22` int(11) NOT NULL,
  `i23` int(11) NOT NULL,
  `i24` int(11) NOT NULL,
  `i25` int(11) NOT NULL,
  `i26` int(11) NOT NULL,
  `i27` int(11) NOT NULL,
  `i28` int(11) NOT NULL,
  `i29` int(11) NOT NULL,
  `i30` int(11) NOT NULL,
  `i31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `september`
--

INSERT INTO `september` (`log_id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `log_id` int(11) NOT NULL,
  `hours` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`log_id`, `hours`) VALUES
(1, '16:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(64) NOT NULL,
  `contact` varchar(64) NOT NULL,
  `user_pass` varchar(64) NOT NULL,
  `form` varchar(1000) NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `user_encryptedPass` varchar(64) NOT NULL,
  `user_rank` enum('superadmin','administrator','researcher','normal','export') NOT NULL DEFAULT 'normal',
  `user_status` enum('submitted','notsubmitted') NOT NULL DEFAULT 'notsubmitted',
  `user_upline` int(10) NOT NULL DEFAULT 1,
  `user_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` varchar(1) NOT NULL DEFAULT '0',
  `is_submit` enum('1','0') NOT NULL DEFAULT '0',
  `status` enum('1','0','2') NOT NULL DEFAULT '0',
  `comment` mediumtext NOT NULL,
  `comment_count` mediumtext NOT NULL,
  `bray` varchar(200) NOT NULL,
  `otpin` varchar(200) NOT NULL,
  `files` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `user_name`, `email`, `address`, `contact`, `user_pass`, `form`, `picture`, `user_encryptedPass`, `user_rank`, `user_status`, `user_upline`, `user_created`, `is_active`, `is_submit`, `status`, `comment`, `comment_count`, `bray`, `otpin`, `files`) VALUES
(1, 'admin', 'admin@gmail.com', '', '', '', '123123', '', 'uploads/pictures/1722872717.png', '4297f44b13955235245b2497399d7a93', 'superadmin', 'submitted', 1, '2023-09-22 04:59:15', '2', '0', '0', '', '0', '', '', ''),
(731, 'juan delacruz', 'juan@gmail.com', '', '', '', '123123', '', 'uploads/pictures/1722872394.jpg', '4297f44b13955235245b2497399d7a93', 'normal', 'notsubmitted', 1, '2024-08-05 15:39:54', '1', '0', '0', '<br>[admin@gmail.com] [Aug 14, 2024 9:03 PM] hi sir<br>[admin@gmail.com] [Aug 14, 2024 9:05 PM] yung patient walang gamot di naka inom<br>[juan@gmail.com] [Aug 14, 2024 9:05 PM] ok po painumin ko<br>[juan@gmail.com] [Aug 14, 2024 9:07 PM] siur<br>[juan@gmail.com] [Sep 11, 2024 9:25 PM] Test<br>[juan@gmail.com] [Sep 20, 2024 10:58 PM] Test<br>[sikatpinoy6@gmail.com] [Sep 20, 2024 11:09 PM] asdad<br>[juan@gmail.com] [Sep 20, 2024 11:11 PM] Sir<br>[juan@gmail.com] [Sep 20, 2024 11:11 PM] Need help<br>[juan@gmail.com] [Sep 20, 2024 11:14 PM] Test<br>[juan@gmail.com] [Sep 20, 2024 11:18 PM] Try<br>[juan@gmail.com] [Sep 20, 2024 11:21 PM] Try<br>[juan@gmail.com] [Sep 20, 2024 11:21 PM] Est<br>[juan@gmail.com] [Sep 20, 2024 11:23 PM] Test<br>[sikatpinoy6@gmail.com] [Sep 20, 2024 11:24 PM] yu\r\n<br>[sikatpinoy6@gmail.com] [Sep 20, 2024 11:24 PM] test<br>[juan@gmail.com] [Sep 20, 2024 11:40 PM] Test<br>[juan@gmail.com] [Sep 20, 2024 11:41 PM] Test<br>[juan@gmail.com] [Sep 21, 2024 1:41 AM] Hi<br>[admin@gmail.com] [Sep 21, 2024 1:41 AM] test<br>[admin@gmail.com] [Sep 21, 2024 1:41 AM] oo<br>[admin@gmail.com] [Sep 21, 2024 1:41 AM] 8<br>[juan@gmail.com] [Nov 12, 2024 12:33 PM] Wendel daks', '0', 'san jose', '', ''),
(733, 'Super MAn', 'super@gmail.com', '', '', '', '123456', '', 'uploads/pictures/1722872717.png', 'e10adc3949ba59abbe56e057f20f883e', 'normal', 'notsubmitted', 1, '2024-08-05 15:45:17', '1', '0', '0', '', '', 'burgos', '', ''),
(734, 'marian revira', 'marian@gmail.com', '', '', '', '123123', '', 'uploads/pictures/1722874582.jpg', '4297f44b13955235245b2497399d7a93', 'normal', 'notsubmitted', 1, '2024-08-05 16:16:22', '1', '0', '0', '', '', 'bulalakaw', '', ''),
(740, 'siikat', 'sikatpinoygsm@gmail.com', '', '', '', 'David0923', '', 'uploads/pictures/1726763115.png', '494550e2ae2dbbc49678183c8e92a03e', 'normal', 'notsubmitted', 1, '2024-09-19 16:25:15', '2', '0', '0', '', '', 'sanjose', '', ''),
(741, 'a', 'a', 'a', '', '', '', '', '', '', 'normal', 'notsubmitted', 1, '2024-11-27 22:15:23', '1', '0', '0', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `april`
--
ALTER TABLE `april`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `august`
--
ALTER TABLE `august`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`barangay_id`);

--
-- Indexes for table `december`
--
ALTER TABLE `december`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `february`
--
ALTER TABLE `february`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `january`
--
ALTER TABLE `january`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `july`
--
ALTER TABLE `july`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `june`
--
ALTER TABLE `june`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `march`
--
ALTER TABLE `march`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `may`
--
ALTER TABLE `may`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `november`
--
ALTER TABLE `november`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `october`
--
ALTER TABLE `october`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `security_checks`
--
ALTER TABLE `security_checks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `september`
--
ALTER TABLE `september`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `april`
--
ALTER TABLE `april`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `august`
--
ALTER TABLE `august`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `barangay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `december`
--
ALTER TABLE `december`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `february`
--
ALTER TABLE `february`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `january`
--
ALTER TABLE `january`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `july`
--
ALTER TABLE `july`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `june`
--
ALTER TABLE `june`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `march`
--
ALTER TABLE `march`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `may`
--
ALTER TABLE `may`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `november`
--
ALTER TABLE `november`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `october`
--
ALTER TABLE `october`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `security_checks`
--
ALTER TABLE `security_checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `september`
--
ALTER TABLE `september`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=742;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
