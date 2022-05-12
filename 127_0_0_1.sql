-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 01, 2022 at 12:47 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abstrakt`
--
CREATE DATABASE IF NOT EXISTS `abstrakt` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `abstrakt`;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(320) NOT NULL,
  `admin_pass` varchar(30) NOT NULL,
  `admin_priv` int(10) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_priv`) VALUES
(1, 'adminfaizal', 'faizalhere@abstrakt.com', 'sayafaizal1234', 1),
(2, 'adminzafar', 'zafarhere@abstrakt.com', 'asdf1234', 1),
(3, 'admindaniel', 'danielhere@abstrakt.com', 'sayadaniel1234', 1),
(4, 'adminhazli', 'hazlihere@abstrakt.com', 'sayahazli1234', 2),
(5, 'adminrajesh', 'rajeshhere@abstrakt.com', 'sayarajesh1234', 2),
(6, 'adminsurizal', 'surizalhere@abstrakt.com', 'sayasurizal1234', 2),
(7, 'adminfenin', 'feninhere@abstrakt.com', 'sayafenin1234', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `age` int(4) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `pass`, `email`, `phone`, `age`) VALUES
(1, 'JamalOnn', 'jamallock11', 'jamalullahaha@gmail.com', '0127457322', 20),
(2, 'SamsonLiao', 'samsung1234', 'sammsung@gmail.com', '0193847583', 20),
(3, 'SalimBach', 'KingBach99', 'aaaaaronsalim@gmail.com', '0126642332', 22),
(4, 'RyanFernandes', 'tonyFernandes68', 'ryan2022@gmail.com', '0192237576', 24),
(5, 'TommyShell', 'shellby420', 'ts.tomshell@gmail.com', '0154236626', 23),
(6, 'MaddyLim', 'limad7711', 'mad.maddy@gmail.com', '0169394638', 19),
(7, 'JimFahad', 'JiHad123', 'jimmy.f@yahoo.com', '0109925241', 29),
(8, 'JamilManap', 'janap88', 'manapboss@gmail.com', '0106452518', 18),
(9, 'mollyloop', 'oheyitslooly', 'moreloop@gmail.com', '0173712102', 21),
(10, 'harrison98', 'harri-son', 'hurryson@gmail.com', '0144398695', 21),
(11, 'notDaniel', 'actuallydaniel', 'daniel707n@gmail.com', '0186945949', 25),
(12, 'RobertFlee', 'fleamarket99', 'r0bhere@gmail.com', '0173874382', 18),
(13, 'CarlJohnson', 'sanandreas1999', 'cj@fib.com', '0195536372', 30),
(14, 'AfiqAdzri', 'anakadzri87', 'afiqinparis@gmail.com', '0126448282', 20),
(15, 'starlord', 'prattgotg91', 'kambing88@yahoo.com', '0132649736', 23),
(16, 'asdfghjkl', 'jimmychew', 'asdfghjl@hotmail.com', '0105594563', 26),
(17, 'neilArmstrong', 'strongarmneil', 'neilatnasa11@gmail.com', '0108544334', 27),
(18, 'ironman', 'riprdj<3', 'qwerty@mail.com', '0175494754', 27),
(19, 'rajuwashere', 'currypuff', 'rajuraj2001@gmail.com', '0135331890', 24),
(20, 'aaron aziz', 'aaron123', 'aaron@gmail.com', '0132664383', 25),
(21, 'daniel.hmdn', 'danielhamdan12345', 'danielhamdan@coldmail.com', '0112565027', 26),
(22, 'yusriyunus', 'yuyu12345554321', 'yunusdaus@gmail.com', '0182342231', 22),
(23, 'najib', '1mdbjholow', 'jibbyjibb@gmail.com', '0185462831', 21),
(24, 'penyuganu', 'ikansinngang55', 'penyunggang99@mail.com', '0118442723', 27),
(25, 'OmicronJames', '67streetmy', 'lebron@mail.com', '0160645378', 21),
(26, 'ahmadali', 'ahmali76', 'ali.ahmad@hmail.com', '0176348882', 19),
(27, 'JohnWick', 'wickedwick77', 'john@boogeyman.com', '0105664339', 29),
(28, 'yvesLaurent', 'YSL912566', 'laurent@ysl.com', '0117432889', 22),
(29, 'johnsmith', 'jsmith55', 'jsmith@mymail.com', '0118665228', 21),
(30, 'clarkkent', 'iamsuperman', 'supar@man.com', '0197748391', 22),
(31, 'theRock', 'rocky123', 'rockybalboa@mail.com', '0199946212', 30),
(32, 'bobbyyy', 'bobby66123', 'bob@mail.com', '0186645228', 18);

-- --------------------------------------------------------

--
-- Table structure for table `webcategory`
--

DROP TABLE IF EXISTS `webcategory`;
CREATE TABLE IF NOT EXISTS `webcategory` (
  `categoryid` int(4) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(30) NOT NULL,
  `categorylimit` int(4) NOT NULL,
  `categorystart` date DEFAULT NULL,
  `categoryend` date DEFAULT NULL,
  `categorydetails` varchar(100) NOT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webcategory`
--

INSERT INTO `webcategory` (`categoryid`, `categoryname`, `categorylimit`, `categorystart`, `categoryend`, `categorydetails`) VALUES
(1, 'Branding', 30, '2022-07-09', '2022-07-12', 'Brand penetration has been hard,\r\ncan you increase the brands outreach?'),
(2, 'Services', 30, '2022-07-16', '2022-07-19', 'Convince your client in buying your service, stand out from competitors.');

-- --------------------------------------------------------

--
-- Table structure for table `webparticipant`
--

DROP TABLE IF EXISTS `webparticipant`;
CREATE TABLE IF NOT EXISTS `webparticipant` (
  `webparticipantid` int(3) NOT NULL AUTO_INCREMENT,
  `userid` int(4) NOT NULL,
  `categoryid` int(4) NOT NULL,
  PRIMARY KEY (`webparticipantid`),
  KEY `categoryid` (`categoryid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webparticipant`
--

INSERT INTO `webparticipant` (`webparticipantid`, `userid`, `categoryid`) VALUES
(1, 2, 1),
(2, 6, 2),
(4, 10, 1),
(5, 13, 2),
(6, 14, 1),
(7, 10, 2),
(8, 6, 1),
(9, 9, 2),
(10, 9, 1),
(11, 21, 1),
(12, 23, 1),
(13, 23, 2),
(14, 26, 1),
(15, 4, 1),
(16, 20, 1),
(17, 30, 1),
(18, 12, 1),
(19, 27, 1),
(20, 18, 1),
(21, 1, 1),
(22, 8, 1),
(23, 29, 1),
(24, 15, 1),
(25, 25, 1),
(26, 22, 1),
(27, 11, 1),
(28, 28, 1),
(29, 17, 1),
(30, 19, 1),
(31, 5, 1),
(32, 13, 1),
(33, 24, 1),
(34, 7, 1),
(35, 16, 1),
(36, 5, 2),
(37, 27, 2),
(38, 16, 2),
(39, 20, 2),
(40, 24, 2),
(41, 8, 2),
(42, 29, 2),
(43, 17, 2),
(44, 11, 2),
(45, 3, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `webparticipant`
--
ALTER TABLE `webparticipant`
  ADD CONSTRAINT `categoryid` FOREIGN KEY (`categoryid`) REFERENCES `webcategory` (`categoryid`),
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);
--
-- Database: `labexercise`
--
CREATE DATABASE IF NOT EXISTS `labexercise` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `labexercise`;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('smith', 'smith123'),
('admin', 'admin432'),
('pejal', 'hehe'),
('daniel', 'asdf'),
('daniel', 'f');
--
-- Database: `lab_test_02a`
--
CREATE DATABASE IF NOT EXISTS `lab_test_02a` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lab_test_02a`;

-- --------------------------------------------------------

--
-- Table structure for table `new_student`
--

DROP TABLE IF EXISTS `new_student`;
CREATE TABLE IF NOT EXISTS `new_student` (
  `username` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `address` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_student`
--

INSERT INTO `new_student` (`username`, `age`, `address`) VALUES
('zafar', 21, 'UNITEN, Kajang'),
('zafar', 21, '73 Street'),
('zafar', 21, 'UNITEN, Kajang'),
('zafar', 21, 'UNITEN, Kajang                '),
('zafar', 21, 'UPM, Serdang'),
('zafar', 21, 'UPM, Serdang                '),
('zafaraqif', 21, 'UNITEN, Bangi'),
('zafaraqif', 21, 'UNITEN, Bangi                '),
('smith', 54, 'USA'),
('smith', 54, 'USA                ');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `address` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`address`) VALUES
(''),
(''),
(''),
(''),
('');
--
-- Database: `lab_test_2a`
--
CREATE DATABASE IF NOT EXISTS `lab_test_2a` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lab_test_2a`;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `username` varchar(30) NOT NULL,
  `age` int(10) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`username`, `age`, `address`) VALUES
('pejal', 21, ' '),
('pejal', 21, ' '),
('pejal', 23, ''),
('pejal', 28, 'test '),
('daniel', 22, 'terengganu '),
('faizal', 21, ' Uniten');
--
-- Database: `lab_wp`
--
CREATE DATABASE IF NOT EXISTS `lab_wp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lab_wp`;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `name` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `hobby1` varchar(10) DEFAULT NULL,
  `hobby2` varchar(10) DEFAULT NULL,
  `hobby3` varchar(10) DEFAULT NULL,
  `university` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`name`, `address`, `gender`, `hobby1`, `hobby2`, `hobby3`, `university`) VALUES
('Abu', 'UPM, Serdang', 'Male', '', 'Reading', 'Swimming', 'UPM'),
('Ali', 'UKM, Bangi', 'Male', 'Running', '', '', 'UKM');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
