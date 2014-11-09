-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2014 at 12:22 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `niswarth`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `mentorID` int(11) NOT NULL,
  `studentID` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `batch` int(4) NOT NULL,
  `DOB` date NOT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `address` text NOT NULL,
  `school` varchar(50) NOT NULL,
  `study` text NOT NULL,
  `created_date` date NOT NULL,
  `modified_date` date NOT NULL,
  `year` varchar(10) NOT NULL,
  PRIMARY KEY (`studentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`mentorID`, `studentID`, `name`, `batch`, `DOB`, `mobile`, `address`, `school`, `study`, `created_date`, `modified_date`, `year`) VALUES
(1, 1, 'ABC DEF', 2010, '1990-11-08', 9999999999, 'address1', 'GPS', 'PUC I', '0000-00-00', '2014-11-08', ''),
(1, 2, 'DEF GHJ', 2011, '1999-01-01', 9553918344, 'address2', 'Schhol1', 'PUC II', '0000-00-00', '2014-11-08', ''),
(2, 3, 'STu1', 2010, '1990-11-08', 9865432107, 'addsredd', 'GPS', 'BE 2', '0000-00-00', '2014-11-08', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
