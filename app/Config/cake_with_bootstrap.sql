-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 13, 2013 at 06:21 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.2-1ubuntu4.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cake_with_bootstrap`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','guest') DEFAULT 'guest',
  `status` enum('active','inactive') DEFAULT 'active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `username`, `password`, `role`, `status`, `created`, `modified`) VALUES
(1, 'pankaj jha', 'pankajkumarjha@xyz.net', '1234567899', 'test@1234', '88f51870b5af71ad27839addb83765c1d880de93', 'admin', 'active', '2013-08-13 18:09:08', '2013-08-13 18:09:08'),
(2, 'Aju Ashok', 'aju@xyz.net', '2345678871', 'aju1234', 'a90d31c59f451c53892834691da0002337224b29', 'guest', 'active', '2013-08-13 18:20:32', '2013-08-13 18:20:32');
