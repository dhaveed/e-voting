-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2017 at 03:59 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caesar`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
  `_id` int(5) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `isContesting` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `_id` int(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `nomineescount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peanuts`
--

CREATE TABLE IF NOT EXISTS `peanuts` (
  `_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `secret_key` varchar(255) NOT NULL,
  `clearText` varchar(50) NOT NULL,
  `matnum` varchar(50) NOT NULL,
  `activationLink` varchar(255) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peanuts`
--

INSERT INTO `peanuts` (`_id`, `fullname`, `email`, `secret_key`, `clearText`, `matnum`, `activationLink`, `activated`) VALUES
(1, 'adegoke david', 'adegoke.david@lmu.edu.ng', '$2a$10$b1278f3d1e1078418d3f4ukBosXnlaJkEv.02jomTFESShibpZJzq', 'adegoke', '15cd004165', 'http://graybot.dev/voting/activate.php?email=adegoke.david@lmu.edu.ng&ref=518eb9719db1c6a0f13f71', 0),
(2, 'adegoke david', 'adegoke.david@lmu.edu.ngh', '$2a$10$5320dcb794dfabfd3bfe4eFiHXRQs8kOwQXqd4aUur43J6X68NOcK', 'adegoke', '15cd0041655', 'http://graybot.dev/voting/activate.php?email=adegoke.david@lmu.edu.ngh&ref=5bf9fb7a2c3ecc859a25e8', 0),
(3, 'adegoke david', 'adegoke.david@lmu.edu.eu', '$2a$10$42640c9d550e60d208bacu7tDvwUnmw2f.mMjktvMW30u6MOJvGHy', 'adegoke', '15cd0041656', 'http://graybot.dev/voting/activate.php?email=adegoke.david@lmu.edu.eu&ref=f591068be1de4c79e51aa6', 0),
(4, 'adegoke david', 'adegoke.david@lmu.edu.ej', '$2a$10$babf28d45541ece006916uLfAtAGuTVA3Glg7L9w5LO9bUTz0ziGi', 'adegoke', '15cd0041657', 'http://graybot.dev/voting/activate.php?email=adegoke.david@lmu.edu.ej&ref=d3458e284b542bf4a4330c', 0),
(5, 'adegoke.faith', 'adegoke.faith@gmail.com', '$2a$10$906ec89e522df6d3d7ed5Oq5/cj5mPwY36KXV6yZ.G8Yss74JFeam', 'adegoke', '15cd004144', 'http://graybot.dev/voting/activate.php?email=adegoke.faith@gmail.com&ref=55dd15f1ce9c98ad6b7a43', 0),
(6, 'adegoke.faith', 'adegoke.faith@gmail.com.ng', '$2a$10$ecd5c02c8c950a737feb6OpB5Y4/Fz5JnEAi2oNBn3UKsjJXcnqCS', 'adegoke', '15cd0041445', 'http://graybot.dev/voting/activate.php?email=adegoke.faith@gmail.com.ng&ref=b9ff186267dc4b84120903', 0),
(7, 'adegoke.faith', 'adegoke.faith@gmail.com.eu', '$2a$10$287ad56542af667a84d81u8pnDcEsuhgaUIijLw2G4vflTnyWw93u', 'adegoke', '15cd00414455', 'http://graybot.dev/voting/activate.php?email=adegoke.faith@gmail.com.eu&ref=2786d0185359f072da7d44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `_id` int(50) NOT NULL,
  `vid` int(50) NOT NULL,
  `candid` int(50) NOT NULL,
  `catid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `_id` (`_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `_id` (`_id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `peanuts`
--
ALTER TABLE `peanuts`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `_id` (`_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `matnum` (`matnum`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `peanuts`
--
ALTER TABLE `peanuts`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `_id` int(50) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
