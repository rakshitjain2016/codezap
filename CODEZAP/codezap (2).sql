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
-- Database: `iste`
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

--
-- Dumping data for table `questionbank`
--

INSERT INTO `questionbank` (`qid`, `qtitle`, `qsuccess`, `qattempts`, `difficulty`, `tid`) VALUES
('007e0808', 'Refreshments', 0, 21, 'Hard', '4e18638d'),
('31d8e76c', 'LOVE CIRCLES', 0, 18, 'Medium', '998264d9'),
('381fd1eb', 'NUMBER NAMES', 1, 16, 'Easy', '998264d9'),
('55b700d3', 'LASER TRACER', 0, 1, 'Hard', '998264d9'),
('5c3d5e36', 'Search For An Amount', 0, 1, 'Medium', '1cc4ef01'),
('5d185607', 'Shape Fix', 0, 7, 'Hard', '4e18638d'),
('813d4e79', 'SHORTEST PATH', 0, 1, 'Medium', 'd83c335e'),
('8ce3934e', 'BETTY WANTS TO SLEEP', 0, 1, 'Hard', '998264d9'),
('8f56f828', 'Find the Element', 0, 40, 'Easy', '1cc4ef01'),
('b09ca857', 'BASTION SIEGE', 0, 9, 'Medium', 'd83c335e'),
('b4ec4659', 'FLOOR TILING', 5, 42, 'Medium', '4e18638d'),
('bf160db8', 'Sum of Squares', 0, 60, 'Hard', '4e18638d'),
('cbccdae0', 'MAKE IT 1!!', 0, 11, 'Medium', '998264d9'),
('de1daeae', 'Kingdom of Dreams', 0, 70, 'Easy', '1cc4ef01');

-- --------------------------------------------------------

--
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
-- Dumping data for table `registered`
--

INSERT INTO `registered` (`regid`, `emailid`, `status`) VALUES
('RIZO032655', '007bhagya@gmail.com', 1),
('RIZO033134', 'aakashr93@gmail.com', 1),
('RIZO035062', 'abhinavk6970@gmail.com', 1),
('RIZO035040', 'akancha.agarwal2017@vitstudent.ac.in', 1),
('RIZO032724', 'aniketgupta6387@gmail.com', 1),
('RIZO035035', 'anthony.nikhilreddy2017@vitstudent.ac.in', 1),
('HORI000353', 'arpit.khurana2015@gmail.com', 1),
('RIZO034789', 'as.tanwar3198@gmail.com', 1),
('HORI000499', 'asmita.chotani@gmail.com', 0),
('HORI000276', 'asutosh.samal98@gmail.com', 0),
('RIZO035052', 'bvishnu.charan2017@vitstudent.ac.in', 1),
('RIZO033961', 'chahatsharma9995@gmail.com', 0),
('RIZO035058', 'chethana.chowdary@vitstudent.ac.in', 0),
('RIZO032806', 'chi.bharathsai@gmail.com', 1),
('HORI000026', 'chirag.garg2016@vitstudent.ac.in', 1),
('RIZO035053', 'clintjohn.maliakal2017@vitstudent.ac.in', 0),
('RIZO032712', 'debprotim.chakrabarti07@gmail.com', 1),
('RIZO033112', 'dhawal55555@gmail.com', 0),
('RIZO034054', 'divyanshkhatana95@gmail.com', 1),
('HORI000029', 'guranshdua@icloud.com', 1),
('RIZO035064', 'hariharan.poru@gmail.com', 1),
('RIZO035122', 'hariharan9876@gmail.com', 1),
('RIZO035093', 'harshal.tikare@gmail.com', 0),
('RIZO032745', 'hemmu8871@gmail.com', 0),
('RIZO035063', 'hunynms@yahoo.com', 0),
('HORI002195', 'ipshitamjoshi@gmail.com', 1),
('RIZO035060', 'jagrit.2017@vitstudent.ac.in', 1),
('RIZO034604', 'jasdeep.singh2016@vitstudent.ac.in', 0),
('RIZO035055', 'k.ushasree2017@vitstudent.ac.in', 0),
('RIZO033124', 'karthikkgkgkg@gmail.com', 0),
('RIZO033504', 'kevinvarghese999@gmail.com', 0),
('RIZO033936', 'krupalkathrotia99@gmail.com', 1),
('RIZO035039', 'kumaran.karthikeyan2017@vitstudent.ac.in', 1),
('RIZO034690', 'kunalkeshri047@gmail.com', 0),
('HORI000165', 'nirbhayg09@gmail.com', 0),
('HORI001276', 'oinksharma@gmail.com', 1),
('HORI000046', 'onecenationunderme@gmail.com', 1),
('RIZO032805', 'piyush.kumardav@gmail.com', 1),
('RIZO035059', 'poorna.sindhu2017@vitstudent.ac.in', 0),
('RIZO035043', 'rahul.nema2017@vitstudent.ac.in', 0),
('RIZO035048', 'raja.kameswari2016@vitstudent.ac.in', 0),
('RIZO033565', 'rajatg98@gmail.com', 1),
('RIZO035054', 'ramya.priya2017@vitstudent.ac.in', 0),
('HORI000943', 'rishavagarwal2717@gmail.com', 1),
('HORI000645', 'rjrakshit24@gmail.com', 0),
('RIZO033547', 'sandhyaananthan@yahoo.in', 0),
('RIZO035038', 'sarvadsudhakar.2017@vitstudent.ac.in', 0),
('HORI000098', 'saviksha.rajkumar@gmail.com', 1),
('RIZO032719', 'shaswatsunny1998@gmail.com', 1),
('RIZO034806', 'shreya.jalan2017@vitstudent.ac.in', 1),
('HORI111111', 'shriyachhabra98@gmail.com', 1),
('RIZO033077', 'shubham.singh377@gmail.com', 0),
('RIZO032832', 'shubhhhham@gmail.com', 0),
('HORI002199', 'smrocks99@yahoo.com', 0),
('RIZO035051', 'snehil.sarkar2017@vitstudent.ac.in', 0),
('RIZO035070', 'srbktamilselvan143@gmail.com', 0),
('RIZO035041', 'surjasish.chatterjee2017@vitstudent.ac.in', 0),
('RIZO034765', 'titastutan721@gmail.com', 0),
('RIZO035061', 'vaibhav.malik2017@vitstudent.ac.in', 0),
('RIZO035050', 'venkateshwaran.g2017@vitstudent.ac.in', 0),
('RIZO034048', 'yvardhan42@gmail.com', 0);

-- --------------------------------------------------------

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
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`regid`, `qid`, `submissiontime`, `bid`, `status`) VALUES
('18HOR9772', '007e0808', '2018-03-19 14:35:47', 2, 0),
('18HOR9772', '007e0808', '2018-03-19 14:35:49', 2, 0),
('18HOR1046', 'b4ec4659', '2018-03-19 15:01:34', 200, 0),
('18HOR1046', 'b4ec4659', '2018-03-19 15:01:46', 200, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:16:41', 10, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:16:44', 10, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:21:01', 1, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:21:06', 1, 0),
('18HOR3684', 'de1daeae', '2018-03-19 15:21:24', 10, 0),
('18HOR9772', '5d185607', '2018-03-19 15:33:53', 2, 0),
('18HOR9772', '5d185607', '2018-03-19 15:33:57', 2, 0),
('18HOR9772', '5d185607', '2018-03-19 15:33:58', 12, 0),
('18HOR9772', '5d185607', '2018-03-19 15:34:01', 12, 0),
('18HOR9772', '5d185607', '2018-03-19 15:34:04', 12, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:34:33', 1, 0),
('18HOR9772', '5d185607', '2018-03-19 15:35:02', 12, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:35:08', 1, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:35:21', 1, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:41:36', 1, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:41:36', 1, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:41:49', 1, 0),
('18HOR2894', '31d8e76c', '2018-03-19 15:42:11', 1, 0),
('18HOR3791', 'de1daeae', '2018-03-19 15:43:20', 25, 0),
('18HOR3791', 'de1daeae', '2018-03-19 15:43:21', 25, 0),
('18HOR3791', 'de1daeae', '2018-03-19 15:43:23', 25, 0),
('18HOR3791', 'de1daeae', '2018-03-19 15:43:24', 25, 0),
('18HOR3791', 'de1daeae', '2018-03-19 15:43:26', 25, 0),
('18HOR1674', 'de1daeae', '2018-03-19 15:47:32', 10, 0),
('18HOR1674', 'de1daeae', '2018-03-19 15:47:41', 10, 0),
('18HOR1674', 'de1daeae', '2018-03-19 15:49:09', 1, 0),
('18HOR1674', 'de1daeae', '2018-03-19 15:49:12', 1, 0),
('18HOR8456', '8f56f828', '2018-03-19 15:52:18', 100, 0),
('18HOR3791', '8f56f828', '2018-03-19 15:56:30', 25, 0),
('18HOR3791', '8f56f828', '2018-03-19 15:56:35', 25, 0),
('18HOR3791', '8f56f828', '2018-03-19 15:56:35', 25, 0),
('18HOR3791', '8f56f828', '2018-03-19 15:56:35', 25, 0),
('18HOR3791', '8f56f828', '2018-03-19 15:56:35', 10, 0),
('18HOR1674', 'de1daeae', '2018-03-19 15:57:38', 10, 0),
('18HOR1674', 'de1daeae', '2018-03-19 15:57:45', 10, 0),
('18HOR1674', 'de1daeae', '2018-03-19 15:57:47', 10, 0),
('18HOR1674', 'de1daeae', '2018-03-19 15:58:37', 1, 0),
('18HOR1674', 'de1daeae', '2018-03-19 15:58:38', 1, 0),
('18HOR1674', 'de1daeae', '2018-03-19 15:58:38', 1, 0),
('18HOR5314', 'de1daeae', '2018-03-19 15:59:28', 420, 0),
('18HOR5314', 'de1daeae', '2018-03-19 15:59:31', 420, 0),
('18HOR8888', 'de1daeae', '2018-03-19 16:00:13', 20, 0),
('18HOR8888', 'de1daeae', '2018-03-19 16:00:20', 20, 0),
('18HOR8888', 'b4ec4659', '2018-03-19 16:09:17', 20, 0),
('18HOR8888', 'b4ec4659', '2018-03-19 16:09:39', 20, 0),
('18HOR8456', '8f56f828', '2018-03-19 16:15:43', 100, 0),
('18HOR5716', '8f56f828', '2018-03-19 16:41:23', 10, 0),
('18HOR5716', '8f56f828', '2018-03-19 16:41:31', 10, 0),
('18HOR4938', 'de1daeae', '2018-03-19 16:41:58', 100, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:00:02', 5, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:00:09', 5, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:00:10', 5, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:00:49', 5, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:00:56', 5, 0),
('18HOR6243', 'de1daeae', '2018-03-19 17:26:58', 200, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:28:06', 10, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:28:09', 10, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:28:11', 10, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:29:54', 10, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:29:59', 10, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:29:59', 10, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:30:00', 10, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:30:36', 10, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:30:39', 10, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:31:08', 10, 0),
('18HOR3791', '8f56f828', '2018-03-19 17:33:35', 10, 0),
('18HOR5716', '8f56f828', '2018-03-19 17:39:09', 100, 0),
('18HOR1255', 'bf160db8', '2018-03-19 17:45:04', 1, 0),
('18HOR6243', 'de1daeae', '2018-03-19 17:45:33', 200, 0),
('18HOR8967', 'bf160db8', '2018-03-19 17:46:45', 50, 0),
('18HOR1255', 'bf160db8', '2018-03-19 17:47:49', 2, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:48:29', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:48:34', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:48:34', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:48:35', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:48:35', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:48:35', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:48:39', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:48:44', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:48:44', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:48:45', 1, 0),
('18HOR8967', 'bf160db8', '2018-03-19 17:49:03', 200, 0),
('18HOR1255', 'bf160db8', '2018-03-19 17:49:25', 1, 0),
('18HOR8967', 'bf160db8', '2018-03-19 17:50:58', 1, 0),
('18HOR8967', 'bf160db8', '2018-03-19 17:51:08', 1, 0),
('18HOR5698', 'b4ec4659', '2018-03-19 17:51:57', 50, 0),
('18HOR8967', 'bf160db8', '2018-03-19 17:52:13', 1, 0),
('18HOR5698', 'b4ec4659', '2018-03-19 17:53:18', 50, 0),
('18HOR5698', 'b4ec4659', '2018-03-19 17:53:40', 50, 0),
('18HOR1255', 'bf160db8', '2018-03-19 17:53:47', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:54:41', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:54:52', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:54:52', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:54:53', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:54:53', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:54:53', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:54:54', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:55:01', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 17:55:02', 1, 0),
('18HOR6808', 'de1daeae', '2018-03-19 17:59:08', 400, 0),
('18HOR6808', 'de1daeae', '2018-03-19 17:59:16', 400, 0),
('18HOR6808', 'de1daeae', '2018-03-19 17:59:38', 400, 0),
('18HOR6808', 'de1daeae', '2018-03-19 17:59:51', 400, 0),
('18HOR6808', 'de1daeae', '2018-03-19 17:59:53', 400, 0),
('18HOR6808', 'de1daeae', '2018-03-19 17:59:56', 400, 0),
('18HOR6808', 'de1daeae', '2018-03-19 18:00:03', 400, 0),
('18HOR1046', '8f56f828', '2018-03-19 18:01:52', 1, 0),
('18HOR1046', '8f56f828', '2018-03-19 18:02:01', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 18:06:53', 1, 0),
('18HOR1021', '381fd1eb', '2018-03-19 18:12:08', 5, 0),
('18HOR1021', '381fd1eb', '2018-03-19 18:12:13', 5, 0),
('18HOR7854', '007e0808', '2018-03-19 18:19:20', 500, 0),
('18HOR7854', '007e0808', '2018-03-19 18:19:29', 500, 0),
('18HOR7685', 'de1daeae', '2018-03-19 18:22:45', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 18:27:22', 1, 0),
('18HOR1021', '381fd1eb', '2018-03-19 18:28:09', 5, 0),
('18HOR1021', '381fd1eb', '2018-03-19 18:29:02', 5, 0),
('18HOR7685', 'de1daeae', '2018-03-19 18:30:25', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 18:30:51', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 18:31:00', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 18:31:00', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-19 18:31:12', 1, 0),
('18HOR3684', 'de1daeae', '2018-03-19 18:34:40', 30, 0),
('18HOR3684', 'de1daeae', '2018-03-19 18:35:01', 30, 0),
('18HOR3684', 'de1daeae', '2018-03-19 18:35:22', 30, 0),
('18HOR3684', 'de1daeae', '2018-03-19 18:35:44', 30, 0),
('18HOR3684', 'de1daeae', '2018-03-19 18:35:57', 30, 0),
('18HOR3684', 'de1daeae', '2018-03-19 18:38:34', 30, 0),
('18HOR8456', '381fd1eb', '2018-03-19 18:42:29', 70, 0),
('18HOR1021', '381fd1eb', '2018-03-19 18:53:41', 10, 0),
('18HOR1021', '381fd1eb', '2018-03-19 19:21:33', 11, 0),
('18HOR1021', '381fd1eb', '2018-03-19 19:22:31', 11, 0),
('18HOR1046', '8f56f828', '2018-03-19 19:36:27', 1, 0),
('18HOR1046', '8f56f828', '2018-03-19 19:36:28', 1, 0),
('18HOR1046', '8f56f828', '2018-03-19 19:36:29', 1, 0),
('18HOR1046', '8f56f828', '2018-03-19 19:36:29', 1, 0),
('18HOR8967', 'bf160db8', '2018-03-19 19:51:59', 60, 0),
('18HOR8967', '31d8e76c', '2018-03-19 20:03:57', 1, 0),
('18HOR8967', '31d8e76c', '2018-03-19 20:06:22', 1, 0),
('18HOR8967', '31d8e76c', '2018-03-19 20:06:51', 1, 0),
('18HOR6109', 'b4ec4659', '2018-03-19 20:08:18', 250, 1),
('18HOR8967', 'bf160db8', '2018-03-19 20:08:34', 1, 0),
('18HOR1553', '8f56f828', '2018-03-19 20:19:34', 20, 0),
('18HOR1553', '8f56f828', '2018-03-19 20:19:40', 20, 0),
('18HOR1553', '8f56f828', '2018-03-19 20:19:42', 20, 0),
('18HOR1553', '8f56f828', '2018-03-19 20:19:43', 20, 0),
('18HOR8967', 'bf160db8', '2018-03-19 20:38:09', 1, 0),
('18HOR8456', 'b4ec4659', '2018-03-19 20:39:28', 100, 0),
('18HOR7176', '007e0808', '2018-03-19 20:46:39', 400, 0),
('18HOR8456', 'b4ec4659', '2018-03-19 20:51:15', 1, 0),
('18HOR1046', 'b4ec4659', '2018-03-19 20:51:34', 1, 0),
('18HOR1046', 'b4ec4659', '2018-03-19 20:51:37', 1, 0),
('18HOR1046', 'b4ec4659', '2018-03-19 20:51:37', 1, 0),
('18HOR1046', 'b4ec4659', '2018-03-19 20:51:37', 1, 0),
('18HOR1046', 'b4ec4659', '2018-03-19 20:51:37', 1, 0),
('18HOR8456', 'b4ec4659', '2018-03-19 20:55:33', 1, 0),
('18HOR1046', 'b4ec4659', '2018-03-19 21:20:10', 1, 0),
('18HOR1046', 'b4ec4659', '2018-03-19 21:22:56', 1, 0),
('18HOR8456', 'cbccdae0', '2018-03-19 21:23:04', 20, 0),
('18HOR1046', 'b4ec4659', '2018-03-19 21:30:17', 1, 0),
('18HOR8456', 'b4ec4659', '2018-03-19 21:31:07', 1, 0),
('18HOR8456', '381fd1eb', '2018-03-19 21:39:02', 1, 0),
('18HOR6808', 'bf160db8', '2018-03-19 21:41:27', 100, 0),
('18HOR6808', 'bf160db8', '2018-03-19 21:42:23', 100, 0),
('18HOR1046', 'bf160db8', '2018-03-19 21:44:46', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 21:46:33', 1, 0),
('18HOR1553', 'b4ec4659', '2018-03-19 21:51:18', 50, 0),
('18HOR1046', 'bf160db8', '2018-03-19 21:58:25', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 21:58:48', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 21:58:48', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 21:58:49', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 21:58:49', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:07:20', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:07:20', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:07:20', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:07:21', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:07:21', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:07:22', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:14:39', 1, 0),
('18HOR8456', '381fd1eb', '2018-03-19 22:17:07', 1, 0),
('18HOR5716', 'b4ec4659', '2018-03-19 22:17:28', 390, 1),
('18HOR1046', 'b4ec4659', '2018-03-19 22:20:26', 1, 0),
('18HOR1046', '8f56f828', '2018-03-19 22:25:16', 1, 0),
('18HOR1046', '8f56f828', '2018-03-19 22:25:36', 1, 0),
('18HOR8456', '381fd1eb', '2018-03-19 22:26:17', 1, 0),
('18HOR8456', '381fd1eb', '2018-03-19 22:33:16', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:33:17', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:43:05', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:54:06', 1, 0),
('18HOR8967', 'cbccdae0', '2018-03-19 22:54:10', 6, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:54:28', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:55:10', 1, 0),
('18HOR1046', 'bf160db8', '2018-03-19 22:55:45', 1, 0),
('18HOR8967', 'cbccdae0', '2018-03-19 22:56:30', 1, 0),
('18HOR8967', 'cbccdae0', '2018-03-19 22:56:46', 1, 0),
('18HOR8967', 'cbccdae0', '2018-03-19 22:56:58', 1, 0),
('18HOR8967', 'cbccdae0', '2018-03-19 22:59:57', 5, 0),
('18HOR8967', 'cbccdae0', '2018-03-19 23:01:44', 6, 0),
('18HOR8967', 'cbccdae0', '2018-03-19 23:22:07', 20, 0),
('18HOR8967', 'cbccdae0', '2018-03-19 23:33:52', 10, 0),
('18HOR8967', 'cbccdae0', '2018-03-19 23:44:29', 10, 0),
('18HOR8967', '8f56f828', '2018-03-20 00:58:54', 40, 0),
('18HOR8967', '8f56f828', '2018-03-20 00:59:26', 40, 0),
('18HOR7685', 'b4ec4659', '2018-03-20 01:19:01', 470, 0),
('18HOR7685', 'b09ca857', '2018-03-20 01:29:37', 1, 0),
('18HOR7685', 'b09ca857', '2018-03-20 01:41:20', 1, 0),
('18HOR7685', 'b09ca857', '2018-03-20 01:47:15', 1, 0),
('18HOR7685', 'b09ca857', '2018-03-20 01:50:06', 1, 0),
('18HOR7685', 'b09ca857', '2018-03-20 01:54:29', 1, 0),
('18HOR7685', 'b09ca857', '2018-03-20 02:08:51', 1, 0),
('18HOR7685', 'de1daeae', '2018-03-20 02:11:47', 1, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:24:36', 250, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:24:39', 250, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:24:41', 250, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:24:42', 250, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:24:43', 250, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:24:44', 250, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:24:45', 250, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:24:50', 250, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:15', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:18', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:21', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:21', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:22', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:22', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:25', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:29', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:30', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:31', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:31', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:33', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:34', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:39', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:40', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:40', 240, 0),
('18HOR6109', 'bf160db8', '2018-03-20 02:29:41', 240, 0),
('18HOR8456', '8f56f828', '2018-03-20 02:29:55', 1, 0),
('18HOR8456', 'b4ec4659', '2018-03-20 02:32:43', 1, 0),
('18HOR8456', '8f56f828', '2018-03-20 02:36:28', 1, 0),
('18HOR8456', '8f56f828', '2018-03-20 02:38:53', 1, 0),
('18HOR8456', 'b4ec4659', '2018-03-20 02:41:27', 1, 0),
('18HOR8456', 'b4ec4659', '2018-03-20 02:46:53', 1, 0),
('18HOR8456', 'b4ec4659', '2018-03-20 02:49:05', 1, 0),
('18HOR8456', 'b4ec4659', '2018-03-20 02:52:42', 1, 0),
('18HOR8456', 'b4ec4659', '2018-03-20 02:54:01', 1, 0),
('18HOR8456', '381fd1eb', '2018-03-20 02:58:26', 1, 0),
('18HOR5698', 'b4ec4659', '2018-03-20 04:13:45', 50, 0),
('18HOR9772', 'b4ec4659', '2018-03-20 05:14:50', 10, 1),
('18HOR9772', 'b4ec4659', '2018-03-20 05:14:50', 10, 1),
('18HOR9772', 'b4ec4659', '2018-03-20 05:14:54', 10, 1),
('18HOR9772', '007e0808', '2018-03-20 05:23:01', 10, 0),
('18HOR9772', '007e0808', '2018-03-20 05:27:10', 10, 0),
('18HOR9772', '007e0808', '2018-03-20 05:28:45', 10, 0),
('18HOR9772', '007e0808', '2018-03-20 05:28:51', 10, 0),
('18HOR9772', '007e0808', '2018-03-20 05:28:52', 10, 0),
('18HOR1021', 'b4ec4659', '2018-03-20 05:50:36', 100, 0),
('18HOR1021', 'b4ec4659', '2018-03-20 05:54:08', 92, 0),
('18HOR1021', 'b4ec4659', '2018-03-20 05:56:57', 92, 0),
('18HOR1021', 'b4ec4659', '2018-03-20 06:00:08', 92, 0),
('18HOR1021', 'b4ec4659', '2018-03-20 06:13:09', 115, 0),
('18HOR1021', 'b4ec4659', '2018-03-20 06:14:00', 115, 0),
('18HOR1095', '381fd1eb', '2018-03-20 06:37:26', 10, 0),
('18HOR1095', '381fd1eb', '2018-03-20 06:37:40', 10, 1),
('18HOR9772', '31d8e76c', '2018-03-20 08:04:06', 199, 0),
('18HOR9772', '007e0808', '2018-03-20 08:04:40', 200, 0),
('18HOR9772', '007e0808', '2018-03-20 08:04:42', 200, 0),
('18HOR9772', '007e0808', '2018-03-20 08:04:46', 200, 0),
('18HOR9772', '007e0808', '2018-03-20 08:04:54', 200, 0),
('18HOR9772', '007e0808', '2018-03-20 08:05:06', 97, 0),
('18HOR9772', '007e0808', '2018-03-20 08:05:09', 97, 0),
('18HOR9772', '31d8e76c', '2018-03-20 08:05:58', 200, 0),
('18HOR9772', '31d8e76c', '2018-03-20 08:05:59', 200, 0),
('18HOR2119', 'b4ec4659', '2018-03-20 08:16:08', 1, 0),
('18HOR1095', 'b09ca857', '2018-03-20 10:15:17', 520, 0),
('18HOR1095', 'b09ca857', '2018-03-20 10:15:28', 520, 0),
('18HOR7685', '007e0808', '2018-03-20 10:25:19', 8, 0),
('18HOR8430', '007e0808', '2018-03-20 10:33:38', 500, 0),
('18HOR6914', '007e0808', '2018-03-20 11:36:13', 500, 0),
('18HOR6914', '007e0808', '2018-03-20 11:36:15', 500, 0);

-- --------------------------------------------------------

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
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`tid`, `tname`, `temail`, `password`, `sessionid`) VALUES
('1cc4ef01', 'jayesh bhakat', 'onecenationunderme@gmail.com', '1a0bf4cebb3ab0530939834323a999905e6f478fd8a1ebb9e67e21842b9d1e9b', 'ee64d3e6c74315d7'),
('4e18638d', 'Ipshita Joshi', 'ipshitamjoshi@gmail.com', '39c21ac27c3882780c0305fac9bd29393a748ecab647b7a618e7273266134ed8', '204febd5849eac21'),
('998264d9', 'Saviksha Rajkumar', 'saviksha.rajkumar@gmail.com', 'e62e21e082aa12ffc1091ed8606869acb2d8a6ad7828599961e78647bc07ee1d', 'ed96417b17bb5542'),
('d83c335e', 'Onkar Sharma', 'oinksharma@gmail.com', 'a2b7847520e672f1e3519090c61e438ee56426f9dc41156f3b5b30beb18c71fa', '5910eb4d1ea44f1e');

-- --------------------------------------------------------

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

--
-- Dumping data for table `userdb`
--

INSERT INTO `userdb` (`regid`, `name`, `emailid`, `password`, `sessionid`, `points`, `times`, `success`, `attempts`) VALUES
('18HOR1021', 'AKANCHA AGARWAL', 'akancha.agarwal2017@vitstudent.ac.in', '10a8b4664902af171237a76ab61de21800dfb876d39ae7e134b163adaf802281', '4e0a8bcaee2ee903', 159, '2018-03-20 06:27:31', 0, 14),
('18HOR1046', 'SHREYA JALAN', 'shreya.jalan2017@vitstudent.ac.in', '49fbd905ab1014ef87143f962b2b1eaadf08e2efee4f32837bc7248642d6a45e', 'ffbd527bccdce8dc', 289, '2018-03-19 22:55:45', 0, 40),
('18HOR1095', 'Saviksha Rajkmar', 'saviksha.rajkumar@gmail.com', 'e62e21e082aa12ffc1091ed8606869acb2d8a6ad7828599961e78647bc07ee1d', 'ea78973987e6a446', 0, '2018-03-20 10:15:28', 1, 5),
('18HOR1255', 'B VISHNU CHARAN', 'bvishnu.charan2017@vitstudent.ac.in', '783272166d70f83c5faa22ea365b484d1874b5833134fa71ec1bd2286423814e', 'a599c51f4742353b', 498, '2018-03-19 18:18:20', 0, 5),
('18HOR1553', 'Hariharan', 'hariharan9876@gmail.com', 'b5f8abc0dba2d7ce03716ce59434fe84a68b5e5ad3084753c5d9b050b501944c', 'd2c4a64ab40d6f9a', 430, '2018-03-20 11:06:04', 0, 6),
('18HOR1674', 'hariharan', 'hariharan.poru@gmail.com', '5912d5590ceedd61724ee20d37b515427916c915081bccad29e0c684476014c4', 'e1cce5d5193c86c7', 499, '2018-03-19 15:58:38', 0, 11),
('18HOR2119', 'Abhinav Kumar', 'abhinavk6970@gmail.com', 'dcdd24928007ddf2b37df97c79490d559fca2633607234699403ecf6d8ce41a7', '69bf76e06dfb9c91', 499, '2018-03-20 08:16:08', 0, 2),
('18HOR2486', 'Kumaran Karthikeyan', 'kumaran.karthikeyan2017@vitstudent.ac.in', '2af8431d8a6c2c683e7e3fe88be95d5d03004bad2bf5bf01f44eb6e145acf2b9', '954e1aaae79fa238', 500, '2018-03-19 15:17:59', 0, 1),
('18HOR2894', 'SHASWAT SRIVASTAVA', 'shaswatsunny1998@gmail.com', '2d13e17e387d8d9e7ba5e493277c8243255447686d5a15af5e967e9c7c5da9d1', '20a7626c1fc7bde8', 488, '2018-03-19 15:42:11', 0, 12),
('18HOR3684', 'Chirag Garg', 'chirag.garg2016@vitstudent.ac.in', '8e34ed4ff727952dd3c7015133373d5d44fd2cda56287c3ea073cf35168e10d5', '020bdf540705b9e7', 430, '2018-03-26 16:38:59', 0, 8),
('18HOR3791', 'Aakash Raman', 'aakashr93@gmail.com', '93166c0cef31af30e03523775e09bc1243da689413dcccb9d2822117499a5539', '75ad8d3b79175494', 455, '2018-03-19 17:33:35', 0, 23),
('18HOR4938', 'Jagrit', 'jagrit.2017@vitstudent.ac.in', '557dbfc9adcdf25f5a155118ed286c7b2e707d989dd04f5c8ddc1d634b5f0204', '9bfa3fed31892893', 400, '2018-03-19 16:41:58', 0, 2),
('18HOR5314', 'c bharath sai reddy', 'chi.bharathsai@gmail.com', 'be0123218775da92427fe2f97f557691ed57be5207b5e6d26e2cbbcdb54236d0', 'd84c0c78937c0ae4', 80, '2018-03-20 02:24:26', 0, 3),
('18HOR5698', 'DEBPROTIM CHAKRABARTI', 'debprotim.chakrabarti07@gmail.com', 'c97227090623c0f8d22ac89adba7a85a003c5c6b34d0e544423c0f7acb9a8a3c', '17571aad4fe95e44', 400, '2018-03-20 04:13:45', 0, 5),
('18HOR5716', 'Bhagya Aggarwal', '007bhagya@gmail.com', '3a2fb6ccf90c7e7ce4d12994b97a495010f0848cc8498474b836bf7b73f4088e', '69e71e9d3eecb4e9', 1170, '2018-03-20 15:18:42', 1, 5),
('18HOR6005', 'Arpit Khurana', 'arpit.khurana2015@gmail.com', 'ec2b459d095d53d5dd7c8376bef2c9052d385159249febbae5efda74c84c53d4', '0fc860e38d482673', 500, '2018-03-19 17:22:20', 0, 1),
('18HOR6109', 'Piyush', 'piyush.kumardav@gmail.com', 'f7cebb576130c7709d17763121a6fff31b0fa2ff01908d444b50d8ed77f9a683', '28b79a96d623c922', 510, '2018-03-20 17:36:22', 1, 27),
('18HOR6243', 'DIVYANSH KHATANA', 'divyanshkhatana95@gmail.com', '029377dc5e66fc85e19c3a1e9033a963002fddf135a59071583fe8cc1721af5d', '077b58cb57fe6262', 100, '2018-03-19 17:45:33', 0, 3),
('18HOR6808', 'Rajat Gupta', 'rajatg98@gmail.com', '54b6c7a86c04b0f5d6feea8f59999b04ba8a988a7bebe8af498919a99434c75f', '98d3816e82702a96', 0, '2018-03-20 09:11:12', 0, 10),
('18HOR6914', 'rishav agarwal', 'rishavagarwal2717@gmail.com', '4ba70c03825aabc16c9cc5a6275b8eb03b290e195d104d1cba2c277a4182de47', 'a6caf3a9e37698f5', 0, '2018-03-20 11:36:15', 0, 3),
('18HOR7685', 'Onkar', 'oinksharma@gmail.com', 'a2b7847520e672f1e3519090c61e438ee56426f9dc41156f3b5b30beb18c71fa', '37b0e07223c7ca8f', 0, '2018-03-20 11:34:52', 0, 42),
('18HOR7846', 'Ashwani Singh Tanwar', 'as.tanwar3198@gmail.com', '386c19b0b576513bf18870c31776956458865d11dea308cb104dca325bb08652', '231570ec1770aba0', 500, '2018-03-20 15:08:37', 0, 1),
('18HOR7854', 'Guransh Dua', 'guranshdua@icloud.com', 'b1c3dd1067f036128d801722c46d6f8f1455ecb1666f1fc437fa742b95feaba1', 'cdc1f66347420158', 0, '2018-03-19 18:19:29', 0, 3),
('18HOR7973', 'Shriya Chhabra', 'shriyachhabra98@gmail.com', '5f73bf6b5c8828c506ebf0207003226b63f95edd14a4b3115e034cc1e8f547b6', 'fc705bdc89d29542', 500, '2018-03-19 18:40:31', 0, 1),
('18HOR8430', 'Jayesh Bhakat', 'onecenationunderme@gmail.com', '65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5', 'bf1da2ea670953e6', 0, '2018-03-20 10:33:38', 0, 2),
('18HOR8456', 'KRUPAL', 'krupalkathrotia99@gmail.com', 'c52382069f057121ce95d0ad27ccdde1163af0768ceebeacfcee0012837feb0f', '7e1328d3fb805df1', 197, '2018-03-20 06:18:49', 0, 23),
('18HOR8888', 'LINGALA ANTHONY NIKHIL REDDY', 'anthony.nikhilreddy2017@vitstudent.ac.in', '5c80565db6f29da0b01aa12522c37b32f121cbe47a861ef7f006cb22922dffa1', '8d29b56b30df56fb', 460, '2018-03-20 01:36:56', 0, 5),
('18HOR8967', 'ANIKET GUPTA', 'aniketgupta6387@gmail.com', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', '369fcd0e0311f58f', 300, '2018-03-20 14:59:22', 0, 23),
('18HOR9772', 'Ipshita Joshi', 'ipshitamjoshi@gmail.com', 'ce9c0fe45c8dc886857044b7e7524468503c8c25eaaf1d1a6309989cf93c2009', 'd40dac686bfbabeb', 0, '2018-03-20 18:35:26', 3, 26);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
