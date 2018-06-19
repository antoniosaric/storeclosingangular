-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 19, 2018 at 02:55 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storeclosing`
--

-- --------------------------------------------------------

--
-- Table structure for table `storepost`
--

CREATE TABLE `storepost` (
  `id` mediumint(9) NOT NULL,
  `storename` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postalCode` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `storeclosedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `currentpercentofflow` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `currentpercentoffhigh` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `timeStampField` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storepost`
--

INSERT INTO `storepost` (`id`, `storename`, `address`, `city`, `state`, `postalCode`, `storeclosedate`, `currentpercentofflow`, `currentpercentoffhigh`, `timeStampField`) VALUES
(1, 'bob burgers', '', '', '', '94030', '2016-04-04 00:19:04', '10', '20', '2018-05-29 23:51:45'),
(2, 'costco', '', '', '', '94077', '2016-04-04 00:19:04', '75', '90', '2018-05-29 23:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `storeposttype`
--

CREATE TABLE `storeposttype` (
  `id` mediumint(9) NOT NULL,
  `storetype` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storeposttype`
--

INSERT INTO `storeposttype` (`id`, `storetype`) VALUES
(1, 'adultclothes'),
(2, 'appliances'),
(3, 'arts/crafts'),
(4, 'autoparts'),
(5, 'baby/kids'),
(6, 'beauty'),
(7, 'books'),
(8, 'office'),
(9, 'cars/accessories'),
(10, 'childrensclothes'),
(11, 'phones'),
(12, 'collectibles'),
(13, 'electronics'),
(14, 'computers/parts'),
(15, 'farm/garden'),
(16, 'furniture'),
(17, 'home'),
(18, 'jewelry'),
(19, 'motorcycle/parts'),
(20, 'music/instruments'),
(21, 'sports'),
(22, 'tools'),
(23, 'toys/games'),
(24, 'videogames'),
(25, 'other');

-- --------------------------------------------------------

--
-- Table structure for table `storepost_type_mm`
--

CREATE TABLE `storepost_type_mm` (
  `id` mediumint(9) NOT NULL,
  `storepostId` mediumint(9) NOT NULL,
  `storeposttypeId` mediumint(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storepost_type_mm`
--

INSERT INTO `storepost_type_mm` (`id`, `storepostId`, `storeposttypeId`) VALUES
(1, 1, 2),
(2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(9) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `secure_key` varchar(15) DEFAULT NULL,
  `timeStampField` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `secure_key`, `timeStampField`) VALUES
(12, 'saric.tony@gmail.com', '$2y$11$Gmn3SLdgLsl.01TOSJvHWuV7kjhYbFHdP3kz1H4ikHw27BkwYk66m', NULL, '2018-06-09 16:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_storepost_om`
--

CREATE TABLE `user_storepost_om` (
  `id` mediumint(9) NOT NULL,
  `storepostId` mediumint(9) NOT NULL,
  `userId` mediumint(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_storepost_om`
--

INSERT INTO `user_storepost_om` (`id`, `storepostId`, `userId`) VALUES
(1, 1, 1),
(2, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `storepost`
--
ALTER TABLE `storepost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storeposttype`
--
ALTER TABLE `storeposttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storepost_type_mm`
--
ALTER TABLE `storepost_type_mm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_storepost_om`
--
ALTER TABLE `user_storepost_om`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `storepost`
--
ALTER TABLE `storepost`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `storeposttype`
--
ALTER TABLE `storeposttype`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `storepost_type_mm`
--
ALTER TABLE `storepost_type_mm`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_storepost_om`
--
ALTER TABLE `user_storepost_om`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
