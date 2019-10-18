-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 09, 2019 at 10:57 PM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rxdb1`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `address1` text,
  `address2` text,
  `address3` text,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipcode` varchar(11) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `return_warehouse` int(11) DEFAULT NULL COMMENT '0=no, 1=yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `phone`, `email`, `type`, `address1`, `address2`, `address3`, `city`, `state`, `zipcode`, `country`, `stock`, `return_warehouse`) VALUES
(2, 'Delhi11231', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, 0),
(18, 'Yogesh @ Warehouse', NULL, NULL, 2, 'Greater Noida', '', '', 'Greater Noida', 'Uttar Pradesh', '201310', 'India', NULL, 1),
(19, 'Vimal@Warehouse', NULL, NULL, 2, 'Greater Noida', '', '', 'Greater Noida', 'Uttar Pradesh', '201310', 'India', NULL, 0),
(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(21, 'Delhi', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, 0),
(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(24, 'Delhi', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(25, 'Delhi1', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(26, 'Delhi1', NULL, NULL, 1, 'tests', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(27, 'tester', NULL, NULL, 3, 'test', 'test', 'test', 'test', 'test', '141103', 'test', NULL, NULL),
(28, 'Delhi1', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(29, 'Delhi1', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(30, 'Delhi11', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(31, 'Delhi111', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(32, 'Delhi111wewqe', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(33, 'Delhi111wewqeq', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(34, 'testeer', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(35, 'Delhi1123dfsd', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(36, 'Delhi1123q', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(37, 'Delhi1123sdas', NULL, NULL, 1, 'test', 'test', 'test', 'test', 'test', '123456', 'India', NULL, NULL),
(38, 'test', NULL, NULL, 2, 'test', 'test', 'test', 'test', 'test', '123', 'test', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
