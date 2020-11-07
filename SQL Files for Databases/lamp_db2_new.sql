-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2020 at 01:27 PM
-- Server version: 5.7.31-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lamp_db2_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `seller` varchar(128) NOT NULL,
  `price` int(20) NOT NULL,
  `type` varchar(128) NOT NULL,
  `man_year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`item_id`, `item_name`, `seller`, `price`, `type`, `man_year`) VALUES
(1, 'FryPan', 'PanCompany', 80, 'Utensil', 2015),
(2, 'Avenger T-shirt', 'ShirtCompany', 10, 'Clothes', 2015),
(3, 'Mechanical Keyboard', 'Ion', 200, 'Computer Accessories', 2016),
(4, 'Computer Mouse', 'Ion', 50, 'Computer Accessories', 2018),
(5, 'Bell70 15inch laptop', 'Bell', 2000, 'Computer', 2017),
(6, 'Sauce Pan', 'PanCompany', 10, 'Utensil', 2019),
(7, 'Ghost T-shirt', 'ShirtCompany', 9, 'Clothes', 2015),
(8, 'jphone', 'jline', 4000, 'Smartphone', 2019);

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
(1, 2, 'In Stock'),
(2, 2, 'In Stock'),
(3, 2, 'In Stock'),
(4, 2, 'In Stock'),
(5, 2, 'In Stock'),
(6, 2, 'In Stock'),
(7, 2, 'In Stock'),
(8, 2, 'In Stock');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `age` int(10) NOT NULL,
  `address` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `username`, `age`, `address`, `password`, `email`) VALUES
('Edwardo Lindsey', 'edwardo', 34, '77 dreamy street', 'edwardopass', 'edwardo@shoppingmail.com'),
('Glen Mulberry', 'glenmulberry', 40, '6 Utrcht st. Hashville', 'glenpass', 'glen@shoppingmail.com'),
('Glenn Mcguil', 'glennmcguil', 56, '7 posh st. liverpool', 'glennpass', 'glennmcguil@shoppingmail.com'),
('Venom Rose', 'venomrose', 28, '8 Terresterial st. Montana', 'venompass', 'venom@shoppingmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `stock_table`
--
ALTER TABLE `stock_table`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_table`
--
ALTER TABLE `product_table`
  ADD CONSTRAINT `product_table_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `stock_table` (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
