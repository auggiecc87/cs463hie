-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2011 at 02:44 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.4-2ubuntu5.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Health Records`
--

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

DROP TABLE IF EXISTS `Patient`;
CREATE TABLE IF NOT EXISTS `Patient` (
  `Patient_ID` int(11) NOT NULL,
  `Primary_Physician_ID` int(11) NOT NULL,
  `Authorized_Physician_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `DOB` varchar(50) NOT NULL,
  `SSN` varchar(50) NOT NULL,
  `Sex` varchar(50) NOT NULL,
  `Diagnosis` varchar(100) NOT NULL,
  `Treatment` varchar(100) NOT NULL,
  PRIMARY KEY  (`Patient_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`Patient_ID`, `Primary_Physician_ID`, `Authorized_Physician_ID`, `Name`, `DOB`, `SSN`, `Sex`, `Diagnosis`, `Treatment`) VALUES
(1, 1, 1, '562e0f7363fe3702609a68c17ac45528', '6725cbf8a6117116eb5d7f656dce0a8b', 'ba83d564ccef2a6cf8db43d744bd7d6f', 'b736219b90602fed1bf07f165eb4f8e3', '9f4858a9c7c6fb5081298aa1a01d5243', 'b97b046db71c4c9b93509060677402da'),
(2, 3243, 65432, '94b1e39cd9b586e368ee2f901775a049', '3385584f289c2753a50d42e0b5c868f7', '015ce807beaddf4ea13b94324859a3a0', 'b736219b90602fed1bf07f165eb4f8e3', '714f6bed1ff8822d9e74813c80a2f1ee', '726ffb0c079910476abdb3155c9fc1d8'),
(3, 85675, 234, '8dc980971b9e8bbbe09bbcf41ee1a831', 'dde2027f852edab22f247f750185ee52', 'd23f3d7bf0a3a006ad18c1dd5083a37c', 'b736219b90602fed1bf07f165eb4f8e3', '0350fe611f145aa8ec928af09f4eca8e', '4f67bf022ddd3fc08a1590cb14085684'),
(4, 3232, 3298, '361a85eb98679213d9083e9707a7d2fe', '1b2a6c715882cd5735e4a52af142b352', '5a9d2abded70f74077b848c1fd89d883', 'f053cae90424828565f3e61d3ee102e9', 'df3c83abf71ebdfa8e532cff6a9da2af85d8efa220303451b41c6562894d5e20', '726ffb0c079910476abdb3155c9fc1d8'),
(5, 3546, 3546, '34c6783ab4dee83a824b407a98ebc734', 'fab02936b1fb2f158f2f13e398a053ce', '5a9d2abded70f74077b848c1fd89d883', 'f053cae90424828565f3e61d3ee102e9', '2b99d6a83d58f146f043fc8f3ec6912b', 'fea9a0e4865b545b12944bea58e7f030');
