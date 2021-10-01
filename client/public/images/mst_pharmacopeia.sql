-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2021 at 02:43 PM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_pharmacopeia`
--

CREATE TABLE `mst_pharmacopeia` (
  `id` int(11) NOT NULL,
  `mst_companies_id` int(11) DEFAULT NULL,
  `pharmacopeia_name` varchar(255) DEFAULT NULL,
  `vol_no` int(11) DEFAULT NULL,
  `pharmacopeia_year` int(4) DEFAULT NULL,
  `pharmacopeia_edition` varchar(255) DEFAULT NULL,
  `selected_year` varchar(50) DEFAULT NULL,
  `copied_from_year` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table is used to store pharmacopeia details';

--
-- Dumping data for table `mst_pharmacopeia`
--

INSERT INTO `mst_pharmacopeia` (`id`, `mst_companies_id`, `pharmacopeia_name`, `vol_no`, `pharmacopeia_year`, `pharmacopeia_edition`, `selected_year`, `copied_from_year`, `is_active`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'New 1', 1, 2021, '2020', '2019-20', NULL, 1, 1, NULL, NULL, '2021-05-20 09:09:31', '2021-05-20 09:09:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_pharmacopeia`
--
ALTER TABLE `mst_pharmacopeia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_pharmacopeia`
--
ALTER TABLE `mst_pharmacopeia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
