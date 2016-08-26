-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2016 at 08:21 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contentmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(72) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `hashed_password`) VALUES
(11, 'alfred', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `position` int(11) NOT NULL,
  `visible` int(5) NOT NULL,
  `content` varchar(900) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `field_id`, `menu_name`, `position`, `visible`, `content`) VALUES
(2, 7, 'INSURANCE', 1, 1, 'df'),
(3, 1, 'Banking', 1, 1, 'requirements\nimproved previous systems by providing enhanced \nsecurity and encryption features,\nimproved previous systems by providing enhanced \nsecurity and encryption features,\nimproved previous systems by providing enhanced \nsecurity and encryption features,\nsalary 0-30k\n'),
(4, 1, 'Procument', 2, 1, 'd'),
(5, 1, 'finance and supplies', 3, 1, 'f'),
(6, 3, 'MECHANICAL ENG', 1, 1, 'd'),
(7, 3, 'ELECTRICAL ENG', 2, 1, 'd'),
(8, 3, 'CIVIL ENG', 3, 1, 'ds');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) NOT NULL,
  `position` int(11) NOT NULL,
  `visible` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `menu_name`, `position`, `visible`) VALUES
(1, 'ACCOUNTING', 1, 1),
(2, 'PROGRAMMING', 2, 1),
(3, 'ENGINEERING', 3, 1),
(5, 'TEACHING', 5, 1),
(6, 'NGO', 6, 1),
(7, 'SALES', 6, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
