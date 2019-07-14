-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2017 at 02:15 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testnoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_point`
--

CREATE TABLE `access_point` (
  `id` int(20) NOT NULL,
  `cell_id1` int(20) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_point`
--

INSERT INTO `access_point` (`id`, `cell_id1`, `name`) VALUES
(1, 11, 'DULUTI OMNI'),
(2, 11, 'DULUTI EAST'),
(3, 11, 'DULUTI WEST'),
(4, 18, 'AICC MIKROTIC'),
(5, 18, 'AICC NORTH');

-- --------------------------------------------------------

--
-- Table structure for table `backbone`
--

CREATE TABLE `backbone` (
  `id` int(20) NOT NULL,
  `link_name` varchar(50) NOT NULL,
  `cell_location` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `ssid` varchar(50) NOT NULL,
  `radio_type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backbone`
--

INSERT INTO `backbone` (`id`, `link_name`, `cell_location`, `ip`, `ssid`, `radio_type`) VALUES
(15, 'iliboru', '15', '192.168.14.1', 'mianzini', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cells`
--

CREATE TABLE `cells` (
  `id` int(20) NOT NULL,
  `cell` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cells`
--

INSERT INTO `cells` (`id`, `cell`, `created_at`) VALUES
(11, 'DULUTI', '2017-08-11 07:36:26'),
(64, 'THEMI', '2017-08-17 09:34:40'),
(15, 'KIRANYI', '2017-08-14 11:44:04'),
(16, 'USA-RIVER', '2017-08-11 07:36:26'),
(17, 'ESAMI', '2017-08-11 07:36:26'),
(18, 'AICC', '2017-08-11 07:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(255) NOT NULL,
  `location` varchar(30) NOT NULL,
  `client` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `cell` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `radio` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `location`, `client`, `latitude`, `longitude`, `cell`, `ip`, `radio`, `created_at`) VALUES
(1, 'njiro', 'lawi', '7545454', '1233456', '64', '97797', '4', '2017-08-18 14:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_radio`
--

CREATE TABLE `type_of_radio` (
  `id` int(20) NOT NULL,
  `radio` varchar(50) NOT NULL,
  `cell_id` int(11) NOT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_of_radio`
--

INSERT INTO `type_of_radio` (`id`, `radio`, `cell_id`, `CreatedOn`) VALUES
(1, 'mkt', 64, '2017-08-17 13:21:11'),
(2, ' vcbv', 12, '2017-08-18 07:25:07'),
(3, 'popo', 11, '2017-08-18 11:49:27'),
(4, 'huawei', 15, '2017-08-18 13:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `mem_id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`mem_id`, `username`, `password`, `role`) VALUES
(1, 'nochabari', 'nochabari', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_point`
--
ALTER TABLE `access_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backbone`
--
ALTER TABLE `backbone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cells`
--
ALTER TABLE `cells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_radio`
--
ALTER TABLE `type_of_radio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`mem_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_point`
--
ALTER TABLE `access_point`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `backbone`
--
ALTER TABLE `backbone`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `cells`
--
ALTER TABLE `cells`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `type_of_radio`
--
ALTER TABLE `type_of_radio`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `mem_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
