-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2021 at 08:05 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `district` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `title`, `first_name`, `middle_name`, `last_name`, `contact_no`, `district`) VALUES
(1, 'Mr', 'saman', 'shantha', 'kumara', '0724468955', '5'),
(2, 'Mr', 'Ruwan', 'nishantha', 'bandara', '0786598526', '7'),
(3, 'Mrs', 'Nishani', 'dhammika', 'bandara', '0753256589', '6'),
(4, 'Miss', 'Samanthi', 'kumari', 'kulathunga', '0762354576', '22');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `district` varchar(50) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district`, `active`, `id`) VALUES
('Ampara', 'yes', 1),
('Anuradhapura', 'yes', 2),
('Badulla', 'yes', 3),
('Batticaloa', 'yes', 4),
('Colombo', 'yes', 5),
('Galle', 'yes', 6),
('Gampaha', 'yes', 7),
('Hambantota', 'yes', 8),
('Jaffna', 'yes', 9),
('Kalutara', 'yes', 10),
('Kalutara', 'yes', 11),
('Kandy', 'yes', 12),
('Kegalle', 'yes', 13),
('Kilinochchi', 'yes', 14),
('Kurunegala', 'yes', 15),
('Mannar', 'yes', 16),
('Matale', 'yes', 17),
('Matara', 'yes', 18),
('Moneragala', 'yes', 19),
('Mullaitivu', 'yes', 20),
('Nuwara Eliya', 'yes', 21),
('Polonnaruwa', 'yes', 22),
('Puttalam', 'yes', 23),
('Rathnapura', 'yes', 24),
('Vavuniya', 'yes', 25);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `customer` varchar(10) NOT NULL,
  `item_count` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `date`, `time`, `invoice_no`, `customer`, `item_count`, `amount`) VALUES
(1, '2021-04-01', '07:00:14', '1001', '1', '2', '7500'),
(2, '2021-04-01', '14:23:12', '1002', '2', '1', '75000'),
(3, '2021-04-02', '10:12:55', '1003', '3', '1', '117000'),
(4, '2021-04-04', '15:44:22', '1004', '1', '2', '21000'),
(5, '2021-04-06', '13:15:52', '1005', '3', '4', '15000'),
(6, '2021-04-07', '14:22:36', '1006', '4', '10', '117500'),
(7, '2021-04-07', '16:11:48', '1006', '2', '32', '24016'),
(8, '2021-04-09', '12:11:55', '1007', '2', '2', '150000');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_master`
--

CREATE TABLE IF NOT EXISTS `invoice_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(50) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `invoice_master`
--

INSERT INTO `invoice_master` (`id`, `invoice_no`, `item_id`, `quantity`, `unit_price`, `amount`) VALUES
(1, '1001', '1', '1', '5000', '5000'),
(2, '1001', '4', '1', '2500', '2500'),
(3, '1002', '2', '1', '75000', '75000'),
(4, '1003', '5', '2', '58500', '117000'),
(5, '1004', '3', '1', '18500', '18500'),
(6, '1004', '4', '1', '2500', '2500'),
(7, '1004', '1', '2', '5000', '10000'),
(8, '1004', '4', '2', '2500', '5000'),
(9, '1005', '3', '5', '18500', '92500'),
(10, '1005', '1', '5', '5000', '25000'),
(11, '1006', '6', '32', '750.50', '24016'),
(12, '1007', '2', '2', '75000', '150000');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(20) NOT NULL,
  `item_category` varchar(20) NOT NULL,
  `item_subcategory` varchar(20) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `unit_price` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_code`, `item_category`, `item_subcategory`, `item_name`, `quantity`, `unit_price`) VALUES
(1, 'JK007', '1', '1', 'HP Laser printer', '10', '5000'),
(2, 'CS6656', '2', '3', 'Lenovo Ideapad 300', '5', '75000'),
(3, 'KL9956', '3', '5', 'Samsung touch displa', '6', '18500'),
(4, 'HH7565', '4', '1', 'Colour ink', '5', '2500'),
(5, 'SM3534', '2', '2', 'Dell latitude', '5', '58500'),
(6, 'KM6526', '3', '5', 'Samsung headset', '50', '750.50');

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE IF NOT EXISTS `item_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `category`) VALUES
(1, 'Printers'),
(2, 'Laptops'),
(3, 'Gadgets'),
(4, 'Ink bottels'),
(5, 'Cartridges');

-- --------------------------------------------------------

--
-- Table structure for table `item_subcategory`
--

CREATE TABLE IF NOT EXISTS `item_subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `item_subcategory`
--

INSERT INTO `item_subcategory` (`id`, `sub_category`) VALUES
(1, 'HP'),
(2, 'Dell'),
(3, 'Lenovo'),
(4, 'Acer'),
(5, 'Samsung');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
