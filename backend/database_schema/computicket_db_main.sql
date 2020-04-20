-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2019 at 03:49 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `computicket_db_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `bus_id` varchar(10) NOT NULL,
  `type` int(11) NOT NULL,
  `num_seats` int(11) NOT NULL,
  `description` varchar(254) NOT NULL,
  `bc_id` varchar(15) NOT NULL,
  `image` varchar(200) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bus_id`),
  KEY `bus_ibfk_1` (`bc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bus_boundary`
--

CREATE TABLE IF NOT EXISTS `bus_boundary` (
  `boundary_id` int(11) NOT NULL AUTO_INCREMENT,
  `boundary` varchar(20) NOT NULL,
  PRIMARY KEY (`boundary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bus_service`
--

CREATE TABLE IF NOT EXISTS `bus_service` (
  `bc_id` varchar(15) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `boundary` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `Address` varchar(230) NOT NULL,
  `authentication` varchar(40) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bc_id`),
  KEY `bus_service_ibfk_1` (`boundary`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Will store details of registered bus service companies';

-- --------------------------------------------------------

--
-- Table structure for table `customer_registry`
--

CREATE TABLE IF NOT EXISTS `customer_registry` (
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `onames` varchar(120) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `dob` datetime NOT NULL,
  `contact` varchar(100) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`contact`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `depot`
--

CREATE TABLE IF NOT EXISTS `depot` (
  `depot_id` int(11) NOT NULL AUTO_INCREMENT,
  `depot_name` varchar(30) NOT NULL,
  `district` int(11) NOT NULL,
  PRIMARY KEY (`depot_id`),
  KEY `depot_ibfk_1` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(30) NOT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mailing_list`
--

CREATE TABLE IF NOT EXISTS `mailing_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (`id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `reservation_id` varchar(10) NOT NULL,
  `customer_names` text NOT NULL,
  `status` varchar(40) NOT NULL,
  `payment` varchar(40) NOT NULL,
  `seats_reserved` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`reservation_id`),
  KEY `trip_reservation` (`trip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE IF NOT EXISTS `trip` (
  `trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(254) NOT NULL,
  `origin` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `departure` datetime NOT NULL,
  `arrival` datetime NOT NULL,
  `status` varchar(40) NOT NULL,
  `bus_id` varchar(10) DEFAULT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`trip_id`),
  KEY `destination` (`destination`),
  KEY `trip_ibfk_1` (`origin`),
  KEY `bus_trip` (`bus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`bc_id`) REFERENCES `bus_service` (`bc_id`);

--
-- Constraints for table `bus_service`
--
ALTER TABLE `bus_service`
  ADD CONSTRAINT `bus_service_ibfk_1` FOREIGN KEY (`boundary`) REFERENCES `bus_boundary` (`boundary_id`);

--
-- Constraints for table `depot`
--
ALTER TABLE `depot`
  ADD CONSTRAINT `depot_ibfk_1` FOREIGN KEY (`district`) REFERENCES `district` (`district_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `trip_reservation` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`);

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `bus_trip` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`),
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`origin`) REFERENCES `depot` (`depot_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
