-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2018 at 10:26 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `ip_add` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `pro_id`, `qty`, `ip_add`) VALUES
(20, 20, 1599, '127.0.0.1'),
(21, 19, 1300, '127.0.0.1'),
(22, 18, 1, '127.0.0.1'),
(23, 32, 1, '127.0.0.1'),
(24, 24, 1, '127.0.0.1'),
(25, 27, 1, '127.0.0.1'),
(26, 30, 1, '127.0.0.1'),
(27, 25, 4, '::1'),
(28, 20, 500, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `main_cat`
--

CREATE TABLE `main_cat` (
  `cat_id` int(10) NOT NULL,
  `cat_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_cat`
--

INSERT INTO `main_cat` (`cat_id`, `cat_name`) VALUES
(20, 'MTN'),
(21, 'Glo'),
(22, 'Airtel'),
(24, 'Etisalat');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(10) NOT NULL,
  `pro_name` text NOT NULL,
  `cat_id` int(10) NOT NULL,
  `sub_cat_id` int(10) NOT NULL,
  `pro_img1` text NOT NULL,
  `pro_img2` text NOT NULL,
  `pro_img3` text NOT NULL,
  `pro_img4` text NOT NULL,
  `pro_feature1` text NOT NULL,
  `pro_feature2` text NOT NULL,
  `pro_feature3` text NOT NULL,
  `pro_feature4` text NOT NULL,
  `pro_price` text NOT NULL,
  `pro_model` text NOT NULL,
  `pro_warranty` text NOT NULL,
  `pro_keyword` text NOT NULL,
  `pro_added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `for_whom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `cat_id`, `sub_cat_id`, `pro_img1`, `pro_img2`, `pro_img3`, `pro_img4`, `pro_feature1`, `pro_feature2`, `pro_feature3`, `pro_feature4`, `pro_price`, `pro_model`, `pro_warranty`, `pro_keyword`, `pro_added_date`, `for_whom`) VALUES
(18, 'MTN 1500 CARD', 20, 24, 'MTN RED.jpg', 'MTN YELLOW.jpg', 'MTN BLUE.jpg', 'MTN BLACK.jpg', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', '1500', '1500', '5years', 'MTN, 1500, CARD', '2018-03-14 07:20:21', 'high'),
(19, 'MTN 400 CARD', 20, 25, 'MTN BLUE.jpg', 'MTN RED.jpg', 'MTN YELLOW.jpg', 'MTN BLACK.jpg', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', '400 ', '1500', '5years', 'MTN, 400 , CARD', '2018-03-13 00:04:55', 'medium'),
(20, 'MTN 200 CARD', 20, 26, 'MTN BLACK.jpg', 'MTN RED.jpg', 'MTN BLUE.jpg', 'MTN YELLOW.jpg', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', '200 ', '200 ', '5years', 'MTN, 200, CARD', '2018-03-13 00:04:55', 'low'),
(21, 'MTN 100 CARD', 20, 27, 'MTN YELLOW.jpg', 'MTN RED.jpg', 'MTN BLUE.jpg', 'MTN BLACK.jpg', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', '100 ', '100 ', '5years', 'MTN, 100 , CARD', '2018-03-13 00:04:55', 'low'),
(22, 'GLO 1000 CARD', 21, 28, 'GLO BLACK.jpg', 'GLO BLUE.jpg', 'GLO RED.jpg', 'GLO YELLOW.jpg', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', '1000', '1000', '5years', 'GLO, 1000, CARD', '2018-03-13 00:04:55', 'high'),
(23, 'GLO 500 CARD', 21, 29, 'GLO BLUE.jpg', 'GLO BLACK.jpg', 'GLO RED.jpg', 'GLO YELLOW.jpg', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', '500 ', '500 ', '5years', 'GLO, 500, CARD', '2018-03-13 00:04:55', 'medium'),
(24, 'GLO 200 CARD', 21, 30, 'GLO RED.jpg', 'GLO BLUE.jpg', 'GLO BLACK.jpg', 'GLO YELLOW.jpg', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', '200 ', '200 ', '5years', 'GLO, 200, CARD', '2018-03-13 00:04:55', 'low'),
(25, 'GLO 100 CARD', 21, 31, 'GLO YELLOW.jpg', 'GLO BLUE.jpg', 'GLO RED.jpg', 'GLO BLACK.jpg', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', 'GLO RECHRAGE CARD', '100 ', '100 ', '5years', 'GLO, 100, CARD', '2018-03-13 00:04:55', 'low'),
(26, 'AIRTEL 1000 CARD', 22, 32, 'AIRTEL BLUE.jpg', 'AIRTEL BLACK.jpg', 'AIRTEL YELLOW.jpg', 'AIRTEL RED.jpg', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', '1000', '1000', '5years', 'AITEL, 1000, CARD', '2018-03-13 00:04:55', 'high'),
(27, 'AIRTEL 500 CARD', 22, 33, 'AIRTEL BLACK.jpg', 'AIRTEL BLUE.jpg', 'AIRTEL YELLOW.jpg', 'AIRTEL RED.jpg', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', '500', '500', '5years', 'AITEL, 500, CARD', '2018-03-13 00:04:55', 'medium'),
(28, 'AIRTEL 200 CARD', 22, 34, 'AIRTEL YELLOW.jpg', 'AIRTEL BLACK.jpg', 'AIRTEL BLUE.jpg', 'AIRTEL RED.jpg', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', '200', '200', '5years', 'AITEL, 200, CARD', '2018-03-13 00:04:55', 'low'),
(29, 'AIRTEL 100 CARD', 22, 35, 'AIRTEL RED.jpg', 'AIRTEL BLACK.jpg', 'AIRTEL YELLOW.jpg', 'AIRTEL BLUE.jpg', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', 'AIRTEL RECHRAGE CARD', '100', '100', '5years', 'AITEL, 100, CARD', '2018-03-13 00:04:55', 'low'),
(30, 'Etisalat 1000 CARD', 24, 36, 'ETISALATE RED.jpg', 'ETISALATE YELLOW.jpg', 'ETISALATE BLUE.jpg', 'ETISALATE BLACK.jpg', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', '1000', '1000', '5years', 'Etisalat, 1000, CARD', '2018-03-13 00:04:55', 'high'),
(31, 'Etisalat 500 CARD', 24, 37, 'ETISALATE BLUE.jpg', 'ETISALATE RED.jpg', 'ETISALATE YELLOW.jpg', 'ETISALATE BLACK.jpg', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', '500', '500', '5years', 'Etisalat, 500, CARD', '2018-03-13 00:04:55', 'medium'),
(32, 'Etisalat 200 CARD', 24, 38, 'ETISALATE YELLOW.jpg', 'ETISALATE RED.jpg', 'ETISALATE BLUE.jpg', 'ETISALATE BLACK.jpg', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', '200', '200', '5years', 'Etisalat, 200, CARD', '2018-03-13 00:04:55', 'low'),
(33, 'Etisalat 100 CARD', 24, 39, 'ETISALATE BLACK.jpg', 'ETISALATE RED.jpg', 'ETISALATE BLUE.jpg', 'ETISALATE YELLOW.jpg', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', 'Etisalat RECHRAGE CARD', '100', '100', '5years', 'Etisalat, 100, CARD', '2018-03-13 00:04:55', 'low'),
(34, 'MTN 750CARDS', 20, 24, 'MTN BLUE.jpg', 'MTN RED.jpg', 'MTN YELLOW.jpg', 'MTN BLACK.jpg', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', 'MTN RECHRAGE CARD', '1500', '1500', '5years', 'MTN, 750, CARD', '2018-04-12 08:23:03', 'high');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cat`
--

CREATE TABLE `sub_cat` (
  `sub_cat_id` int(10) NOT NULL,
  `sub_cat_name` text NOT NULL,
  `cat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_cat`
--

INSERT INTO `sub_cat` (`sub_cat_id`, `sub_cat_name`, `cat_id`) VALUES
(23, 'MTN 1500', 20),
(24, 'MTN 750', 20),
(25, 'MTN 400', 20),
(26, 'MTN 200', 20),
(27, 'MTN 100', 20),
(28, 'Glo 1000', 21),
(29, 'Glo 500', 21),
(30, 'Glo 200', 21),
(31, 'Glo 100', 21),
(32, 'Airtel 1000', 22),
(33, 'Airtel 500', 22),
(34, 'Airtel 200', 22),
(35, 'Airtel 100', 22),
(36, 'Etisalat 1000', 24),
(37, 'Etisalat 500', 24),
(38, 'Etisalat 200', 24),
(39, 'Etisalat 100', 24);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(10) NOT NULL,
  `u_name` text NOT NULL,
  `u_email` text NOT NULL,
  `u_pass` text NOT NULL,
  `u_add` text NOT NULL,
  `u_pin` text NOT NULL,
  `u_dob` text NOT NULL,
  `u_phone` text NOT NULL,
  `u_img` text NOT NULL,
  `u_country` text NOT NULL,
  `u_state` text NOT NULL,
  `u_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_email`, `u_pass`, `u_add`, `u_pin`, `u_dob`, `u_phone`, `u_img`, `u_country`, `u_state`, `u_reg_date`) VALUES
(5, 'Ajala Oluwafemi', 'ajalaf4jesus@gmail.com', '117743255', 'Military Zone', '123456', '2008-08-13', '08162614369', 'IMG_20180115_125758.jpg', 'Nigeria', 'Anambra', '2008-08-05 09:59:41'),
(8, 'Ajala Oluwafemi', 'ajalaf4jesus@gmail.com', '994055432', 'millitary zone, Uli,', '123456', '2008-08-20', '08162614369', 'IMG_20180115_125758.jpg', 'Nigeria', 'Anambra', '2008-08-05 10:09:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `main_cat`
--
ALTER TABLE `main_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`);
ALTER TABLE `products` ADD FULLTEXT KEY `pro_name` (`pro_name`);
ALTER TABLE `products` ADD FULLTEXT KEY `pro_name_2` (`pro_name`);

--
-- Indexes for table `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `main_cat`
--
ALTER TABLE `main_cat`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `sub_cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
