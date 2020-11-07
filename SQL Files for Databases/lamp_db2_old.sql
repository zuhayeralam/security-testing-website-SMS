-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2020 at 01:28 PM
-- Server version: 5.7.31-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lamp_db2_old`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_table_old`
--

CREATE TABLE `product_table_old` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `seller` varchar(128) NOT NULL,
  `price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_table_old`
--

INSERT INTO `product_table_old` (`item_id`, `item_name`, `seller`, `price`) VALUES
(11, 'Guitar', 'The Guitar Company', 2000),
(12, 'Piano', 'Pianists Co', 1200),
(13, 'English Plate', 'DishCompany', 5),
(14, 'Fish Bowl', 'DishCompany', 6),
(15, 'Photocopy Machine', 'PaperforLife', 3000),
(16, 'Type Writer', 'PaperforLife', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `stock_table`
--

CREATE TABLE `stock_table` (
  `product_id` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `availability` enum('In Stock','Out of Stock') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_table`
--

INSERT INTO `stock_table` (`product_id`, `stock`, `availability`) VALUES
(11, 2, 'In Stock'),
(12, 2, 'In Stock'),
(13, 2, 'In Stock'),
(14, 2, 'In Stock'),
(15, 2, 'In Stock'),
(16, 2, 'In Stock');

-- --------------------------------------------------------

--
-- Table structure for table `user_old`
--

CREATE TABLE `user_old` (
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `age` int(10) NOT NULL,
  `address` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_old`
--

INSERT INTO `user_old` (`name`, `username`, `age`, `address`, `password`, `email`) VALUES
('Blade Nash', 'blade', 54, '4 Palm St. Indiland', 'bladepass', 'blade@shoppingmail.com'),
('David Norman', 'davnorman', 23, '1st street', 'davpass', 'davidnorman@shoppingmail.com'),
('Perry Wither', 'perry', 45, '44 Town road, Florence', 'perrypass', 'perry@shoppingmail.com'),
('Rasiel Buckley', 'rasiel', 52, '26 Rich Avenue Melville street', 'rasielpass', 'rasiel@shoppingmail.com'),
('Raven Liew', 'raven', 60, '66 Rainstreet. lava', 'ravenpass', 'raven@shoppingmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_table_old`
--
ALTER TABLE `product_table_old`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `stock_table`
--
ALTER TABLE `stock_table`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_old`
--
ALTER TABLE `user_old`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_table_old`
--
ALTER TABLE `product_table_old`
  ADD CONSTRAINT `product_table_old_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `stock_table` (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
