-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2015 at 12:24 PM
-- Server version: 5.5.45-37.4
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostpidivn_nghie`
--

-- --------------------------------------------------------

--
-- Table structure for table `nta_admin`
--

CREATE TABLE IF NOT EXISTS `nta_admin` (
  `name` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

--
-- Dumping data for table `nta_admin`
--

INSERT INTO `nta_admin` (`name`, `pass`) VALUES
('admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

-- --------------------------------------------------------

--
-- Table structure for table `nta_article`
--

CREATE TABLE IF NOT EXISTS `nta_article` (
  `id` int(11) NOT NULL,
  `id_grid` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `information` text NOT NULL,
  `online` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin2;

-- --------------------------------------------------------

--
-- Table structure for table `nta_grid`
--

CREATE TABLE IF NOT EXISTS `nta_grid` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `effect` varchar(20) NOT NULL,
  `delay` varchar(10) NOT NULL,
  `width` varchar(10) NOT NULL,
  `title_position` varchar(10) NOT NULL,
  `article_effect` varchar(20) NOT NULL,
  `online` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin2;

-- --------------------------------------------------------

--
-- Table structure for table `nta_grid_photo`
--

CREATE TABLE IF NOT EXISTS `nta_grid_photo` (
  `id` int(11) NOT NULL,
  `id_grid` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin2;

-- --------------------------------------------------------

--
-- Table structure for table `nta_message`
--

CREATE TABLE IF NOT EXISTS `nta_message` (
  `id` int(11) NOT NULL,
  `bgc` varchar(10) NOT NULL,
  `tc` varchar(10) NOT NULL,
  `message` varchar(600) NOT NULL,
  `title` varchar(255) NOT NULL,
  `information` text NOT NULL,
  `online` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin2;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nta_admin`
--
ALTER TABLE `nta_admin`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `nta_article`
--
ALTER TABLE `nta_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nta_grid`
--
ALTER TABLE `nta_grid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nta_grid_photo`
--
ALTER TABLE `nta_grid_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nta_message`
--
ALTER TABLE `nta_message`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nta_article`
--
ALTER TABLE `nta_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `nta_grid`
--
ALTER TABLE `nta_grid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `nta_grid_photo`
--
ALTER TABLE `nta_grid_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `nta_message`
--
ALTER TABLE `nta_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
