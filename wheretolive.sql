-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2015 at 06:01 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1-log
-- PHP Version: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wheretolive`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `rent` int(11) NOT NULL,
  `walkscore` int(11) NOT NULL,
  `transitscore` int(11) NOT NULL,
  `bikescore` int(11) NOT NULL,
  `population` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `city_name` (`name`,`state`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state`, `rent`, `walkscore`, `transitscore`, `bikescore`, `population`) VALUES
(1, 'Berkeley', 'CA', 1253, 79, 56, 89, 117000),
(2, 'Kansas City', 'MO', 723, 32, 34, 40, 467000),
(3, 'Austin', 'TX', 950, 35, 33, 52, 885000),
(4, 'Denver', 'CO', 863, 56, 47, 71, 650000),
(5, 'Boulder', 'CO', 1132, 56, 49, 86, 103000),
(7, 'Seattle', 'WA', 1051, 71, 57, 63, 652000),
(8, 'Portland', 'OR', 885, 63, 50, 72, 609000),
(9, 'Nashville', 'TN', 816, 26, 0, 33, 658000),
(10, 'Asheville', 'NC', 811, 35, 0, 0, 87000);

-- --------------------------------------------------------

--
-- Table structure for table `inprogress`
--

CREATE TABLE IF NOT EXISTS `inprogress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `inprogress`
--

INSERT INTO `inprogress` (`id`, `user`, `salary`, `status`, `notes`, `company`, `position`) VALUES
(1, 1, 24680, '', 'will this reappear?', 'Add City Test', 'Tester'),
(2, 1, 29478, '', 'see if this reappears', 'Hi', 'Yeah'),
(3, 1, 29478, '', 'see if this reappears', 'Hi', 'Yeah'),
(4, 1, 90358, '', 'see if this reappears', 'blah', 'aldkjfa'),
(5, 1, 979897988, 'interested', 'Enter notes here yay', 'Hi', 'yo'),
(6, 1, 902580, 'applied', 'Woo gonn Enter some notes here', 'lajgdklfa', 'akdslfja'),
(7, 1, 24870, 'interested', '', 'lajf', 'alkdjflksd'),
(8, 1, 98765, 'offer', 'Notes me bro', 'alkfjskla', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user`, `city`, `salary`, `status`, `notes`, `company`, `position`) VALUES
(1, 1, 1, 123456, 'applied', 'testing testing TEST 10840239840293 yo notes are cool my hands are typing words aljdf;lkajds;lakjf;lskaj;fa AKHFJAWIEJAKDJFLK;DSFJA;', 'Testing', 'Tester'),
(2, 1, 1, 54321, '', 'YEAHHHHHHHHHHHHH', 'More hi', 'more what?'),
(3, 1, 4, 39871, 'interested', 'see if this reappears', 'blah', 'aldkjfa'),
(4, 1, 7, 0, 'applied', 'Woo gonn Enter some notes here', 'lajgdklfa', 'akdslfja'),
(5, 1, 9, 98765, 'offer', 'Notes me bro', 'alkfjskla', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `usercities`
--

CREATE TABLE IF NOT EXISTS `usercities` (
  `user` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user`,`city`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usercities`
--

INSERT INTO `usercities` (`user`, `city`, `rank`, `notes`) VALUES
(1, 1, 1, ''),
(1, 2, 3, ''),
(1, 3, 7, ''),
(1, 4, 6, ''),
(1, 5, 4, ''),
(1, 7, 5, ''),
(1, 8, 2, ''),
(1, 9, 8, ''),
(1, 10, 9, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hash` text COLLATE utf8_unicode_ci NOT NULL,
  `numcities` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hash`, `numcities`) VALUES
(1, 'anna', '$1$ILn.wIqw$G9AdhR3NCg1uPli.079Ji/', 9);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
