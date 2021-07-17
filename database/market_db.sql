CREATE DATABASE IF NOT EXISTS market_db;
USE market_db;

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2021 at 08:38 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `market_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE IF NOT EXISTS `tblproduct` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `picture` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`id`, `name`, `price`, `category`, `description`, `username`, `date`, `time`, `picture`) VALUES
(1, 'Shoe Sample One', '12000', 'Shoe', 'Just a sample shoe', 'Afolabi', '2021/07/16', '07:06:06 pm', 'shoe3.jpg'),
(3, 'Sample Laptop', '135000', 'Laptop', 'Sample Laptop', 'Afolabi', '2021/07/16', '08:36:20 pm', 'laptop1.jpg'),
(4, 'Sample Laptop', '125000', 'Laptop', 'Sample Laptop', 'Afolabi', '2021/07/15', '02:32:37 pm', 'laptop3.jpg'),
(5, 'Sample Clipper', '18000', 'Clipper', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate.', 'Afolabi', '2021/07/15', '02:44:48 pm', 'clipper2.jpg'),
(6, 'Iphone XR', '230000', 'Phone', 'One of the best iphone product', 'Albert', '2021/07/16', '08:18:37 pm', 'phone2.jpg'),
(7, 'Timberland', '34000', 'Shoe', 'I love timberlands', 'Albert', '2021/07/15', '04:14:05 pm', 'shoe2.jpg'),
(8, 'Chaoba Clipper X', '6000', 'Clipper', 'Chaoba is good', 'Albert', '2021/07/15', '04:21:09 pm', 'clipper1.jpg'),
(9, 'Timberland Two', '45000', 'Shoe', 'One of the best', 'Albert', '2021/07/16', '08:37:21 pm', 'shoe2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`username`, `fullname`, `email`, `password`, `usertype`) VALUES
('Afolabi', 'Afolabi Temidayo Timothy', 'afolabi8120@gmail.com', '$2y$10$zRPAniwYcYC5daCSco0ZDu.6ryADnPoS2A1DLeeqVTnaqf0ma2R1e', 'User'),
('Albert', 'Albert Faith Segun', 'Albert@gmail.com', '$2y$10$kN2j7YvoLyadiFw.mf3aSOKyxawbxVRfrcznzlk0PArUvJGNn7.Ke', 'User');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
