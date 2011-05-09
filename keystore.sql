-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2011 at 12:03 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-7+squeeze1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `keystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `HISP_AUTH`
--

DROP TABLE IF EXISTS `HISP_AUTH`;
CREATE TABLE IF NOT EXISTS `HISP_AUTH` (
  `HISP_ID` int(8) NOT NULL AUTO_INCREMENT,
  `uname` varchar(25) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `decryptkey` varchar(30) NOT NULL,
  `pid_auth` varchar(30) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `active` int(1) NOT NULL,
  `dstore_uname` varchar(40) NOT NULL,
  `dstorepwd` varchar(50) NOT NULL,
  `iv` varchar(50) NOT NULL,
  `acct_type` int(1) NOT NULL,
  UNIQUE KEY `HISP_ID` (`HISP_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `HISP_AUTH`
--

INSERT INTO `HISP_AUTH` (`HISP_ID`, `uname`, `passwd`, `decryptkey`, `pid_auth`, `fname`, `lname`, `active`, `dstore_uname`, `dstorepwd`, `iv`, `acct_type`) VALUES
(1, 'jsmith', '5f4dcc3b5aa765d61d8327deb882cf99', 'cs463cs463', '1,3,5', 'John', 'Smith', 1, 'datastore_user', 'abcd1234**', '416564f31f99fb8079b6b017339a2f48', 0),
(2, 'jjohnson', '5f4dcc3b5aa765d61d8327deb882cf99', 'cs463cs463', '2,4', 'Joe', 'Johnson', 1, 'datastore_user', 'abcd1234**', '416564f31f99fb8079b6b017339a2f48', 0),
(3, 'research', '5f4dcc3b5aa765d61d8327deb882cf99', 'cs463cs463', '', 'Research', 'Research', 1, 'datastore_user', 'abcd1234**', '416564f31f99fb8079b6b017339a2f48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `PHR_AUTH`
--

DROP TABLE IF EXISTS `PHR_AUTH`;
CREATE TABLE IF NOT EXISTS `PHR_AUTH` (
  `PHR_ID` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(25) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `decryptkey` varchar(30) NOT NULL,
  `pid_auth` varchar(30) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `active` int(1) NOT NULL,
  `dstore_uname` varchar(40) NOT NULL,
  `dstorepwd` varchar(50) NOT NULL,
  `iv` varchar(50) NOT NULL,
  `acct_type` int(1) NOT NULL,
  UNIQUE KEY `PHR_ID` (`PHR_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `PHR_AUTH`
--

INSERT INTO `PHR_AUTH` (`PHR_ID`, `uname`, `passwd`, `decryptkey`, `pid_auth`, `fname`, `lname`, `active`, `dstore_uname`, `dstorepwd`, `iv`, `acct_type`) VALUES
(1, 'jdoe', '5f4dcc3b5aa765d61d8327deb882cf99', 'cs463cs463', '1', 'John', 'Doe', 1, 'datastore_user', 'abcd1234**', '416564f31f99fb8079b6b017339a2f48', 0),
(2, 'research', '5f4dcc3b5aa765d61d8327deb882cf99', 'cs463cs463', '', 'Research', 'Research', 1, 'datastore_user', 'abcd1234**', '416564f31f99fb8079b6b017339a2f48', 1),
(3, 'auditor', '5f4dcc3b5aa765d61d8327deb882cf99', 'cs463cs463', '', 'Auditor', 'Auditor', 1, 'datastore_user', 'abcd1234**', '416564f31f99fb8079b6b017339a2f48', 3),
(4, 'research0', '5f4dcc3b5aa765d61d8327deb882cf99', 'cs463cs463', '', 'Research0', 'Research0', 1, 'datastore_user', 'abcd1234**', '416564f31f99fb8079b6b017339a2f48', 4),
(5, 'research1', '5f4dcc3b5aa765d61d8327deb882cf99', 'cs463cs463', '', 'research2', 'research2', 1, 'datastore_user', 'abcd1234**', '416564f31f99fb8079b6b017339a2f48', 2);
