-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2018 at 08:09 AM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codezap`
--

-- --------------------------------------------------------

--
-- Table structure for table `questionbank`
--

CREATE TABLE IF NOT EXISTS `questionbank` (
  `qid` varchar(8) COLLATE utf8_bin NOT NULL COMMENT 'question id',
  `qtitle` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'question title',
  `qsuccess` int(4) NOT NULL DEFAULT '0' COMMENT 'no. of successful attempts',
  `qattempts` int(4) NOT NULL DEFAULT '1' COMMENT 'no of attempts',
  `difficulty` varchar(10) COLLATE utf8_bin NOT NULL,
  `tid` varchar(8) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Table structure for table `registered`
--

CREATE TABLE IF NOT EXISTS `registered` (
  `regid` varchar(11) COLLATE utf8_bin NOT NULL,
  `emailid` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`emailid`),
  UNIQUE KEY `regid` (`regid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Registered Participants Data';

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `regid` varchar(9) COLLATE utf8_bin NOT NULL,
  `qid` varchar(8) COLLATE utf8_bin NOT NULL,
  `submissiontime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bid` int(6) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0 NOt Done and 1 Done'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `trainer`
--

CREATE TABLE IF NOT EXISTS `trainer` (
  `tid` varchar(8) COLLATE utf8_bin NOT NULL,
  `tname` varchar(255) COLLATE utf8_bin NOT NULL,
  `temail` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `sessionid` varchar(16) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`tid`),
  UNIQUE KEY `tusername` (`temail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Trainer Details';

--
-- Table structure for table `userdb`
--

CREATE TABLE IF NOT EXISTS `userdb` (
  `regid` varchar(9) COLLATE utf8_bin NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `emailid` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `sessionid` varchar(16) COLLATE utf8_bin NOT NULL,
  `points` int(6) NOT NULL DEFAULT '500',
  `times` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `success` int(4) NOT NULL DEFAULT '0' COMMENT 'Stores the no. of successful compilation',
  `attempts` int(4) NOT NULL DEFAULT '1' COMMENT 'no.of compilation attempts',
  PRIMARY KEY (`regid`,`sessionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Participants from Registered Table';


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
