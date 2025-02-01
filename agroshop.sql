-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2023 at 04:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agroshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE `admin_master` (
  `a_id` int(5) NOT NULL,
  `a_name` varchar(20) NOT NULL,
  `a_password` varchar(8) NOT NULL,
  `a_email` varchar(50) NOT NULL,
  `mobile` int(13) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`a_id`, `a_name`, `a_password`, `a_email`, `mobile`, `is_active`) VALUES
(1, 'ayush', '123456', 'ayushv1316@gmail.com', 98765432, 1);

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `b_id` int(5) NOT NULL,
  `b_name` varchar(20) NOT NULL,
  `b_password` varchar(8) NOT NULL,
  `b_email` varchar(50) NOT NULL,
  `b_mobile` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `address` varchar(150) NOT NULL,
  `Nationality` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zipcode` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`b_id`, `b_name`, `b_password`, `b_email`, `b_mobile`, `is_active`, `address`, `Nationality`, `state`, `zipcode`) VALUES
(1, 'smeet', '123456', 'smeetmvsatasiya@gmail.com', 989865652, 1, '23/4 ramanujan soc near SBI bankmaninagar', 'Indian', 'Select state', 380008),
(2, 'smit', '123456', 'smeesatasiya@gmail.com', 214743642, 1, 'rs zaveri road near RK petrol pump\r\nvastral', 'indian', 'gujarat', 380007),
(3, 'sumit', '123456', 'Satasiya.smeet1ljpce2020@gmail.com', 959866541, 1, 'karnavti banglows rk farm road\r\nbapunagar approch\r\nahmedabad', 'indian', 'gujarat', 380005);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'seeds'),
(2, 'tools'),
(3, 'pesticides'),
(4, 'others');

-- --------------------------------------------------------

--
-- Table structure for table `contact_master`
--

CREATE TABLE `contact_master` (
  `contact_id` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` int(13) NOT NULL,
  `descripition` text NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `my_cart`
--

CREATE TABLE `my_cart` (
  `cart_id` int(3) NOT NULL,
  `b_id` int(3) NOT NULL,
  `p_id` int(3) NOT NULL,
  `quantity` int(2) NOT NULL,
  `total_price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `my_cart`
--

INSERT INTO `my_cart` (`cart_id`, `b_id`, `p_id`, `quantity`, `total_price`) VALUES
(9, 1, 2, 1, 550);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `ord_id` int(3) NOT NULL,
  `b_id` int(3) NOT NULL,
  `p_id` int(3) NOT NULL,
  `price` int(3) NOT NULL,
  `invoice` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`ord_id`, `b_id`, `p_id`, `price`, `invoice`) VALUES
(1, 1, 2, 550, 3844422);

-- --------------------------------------------------------

--
-- Table structure for table `payment_master`
--

CREATE TABLE `payment_master` (
  `pay_id` int(3) NOT NULL,
  `b_id` int(3) NOT NULL,
  `total_price` int(6) NOT NULL,
  `invoice` int(8) NOT NULL,
  `placed_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_master`
--

INSERT INTO `payment_master` (`pay_id`, `b_id`, `total_price`, `invoice`, `placed_on`) VALUES
(1, 1, 550, 3844422, '2023-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `p_id` int(5) NOT NULL,
  `s_id` int(3) NOT NULL,
  `cat_id` int(1) NOT NULL,
  `p_name` varchar(20) NOT NULL,
  `p_info` text NOT NULL,
  `price` int(6) NOT NULL,
  `image` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`p_id`, `s_id`, `cat_id`, `p_name`, `p_info`, `price`, `image`, `status`) VALUES
(2, 1, 1, 'COTTON SEEDS', 'Cotton grown for the extraction of cottonseed oil is one of major crops grown around the world for the production of oil, after soy, corn, and canola.', 550, 'pro7.jpeg', 1),
(5, 1, 1, 'POTATO SEEDS', 'Potatoes are generally grown from seed potatoes, tubers specifically grown to be free from disease and to provide consistent and healthy plants.', 50, 'pro15.jpeg', 1),
(9, 4, 3, 'Hifield-AG 250g', 'Hifield-AG 250g Pyramid Acetamiprid 20% SP Insecticide is a premium quality product from Hifield-AG.', 499, 'pro27.jpeg', 1),
(11, 4, 3, 'Katyayani 750g Ashwa', 'Katyayani 750g Ashwamedh Diafenthiuron 50% WP Insecticide for Plants & Garden is a premium quality product from Katyayani.', 999, 'pro28.jpeg', 1),
(14, 4, 3, 'Katyayani 5000ml Pyr', 'Katyayani 5000ml Pyrethrum Insecticide is an effective insecticide for mosquitoes, flies, cockroaches and bed bugs.', 999, 'pro30.jpeg', 1),
(15, 5, 3, 'Katyayani K-Acepro 2', ' Katyayani K-Acepro 250g Acetamiprid 20% SP Insecticide are manufactured by using quality assured material and advanced techniques, which make them up to the standard in this highly challenging field.', 399, 'pro21.jpeg', 1),
(16, 5, 2, 'Battery Operated Gar', 'Farming Sprayer 16 Liter Backpack Sprayer', 999, 'pro26.jpeg', 1),
(19, 5, 2, 'Kinger Garden Iron H', 'Kinger Garden Iron Handle Square Head Shovel for Outdoor Camping, Agriculture, Farming, Construction and Garden Use', 999, 'pro18.jpeg', 1),
(20, 5, 2, 'SF Traders Gardening', 'The Handle is Very Strong & Spade were Made with Sharper Tips of Metal', 300, 'pro29.jpeg', 1),
(21, 5, 2, 'NHM Iron Hand Sickle', 'This curved saw is Designed technically to remove weed , grass and unwanted plants from the crops', 150, 'pro25.jpeg', 1),
(22, 1, 1, 'GROUNDNUT SEED', 'The peanut also known as the groundnut, is a legume crop grown  mainly for its edible seeds', 500, 'pro20.jpeg', 1),
(23, 5, 2, 'Kraft Seeds Hand Cul', 'High-quality stainless steel Hand Cultivator, which is bend-proof. Metal parts are black powder coated for corrosion and rust protection.', 200, 'pro12.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `s_id` int(5) NOT NULL,
  `s_name` varchar(20) NOT NULL,
  `s_password` varchar(8) NOT NULL,
  `s_email` varchar(50) NOT NULL,
  `s_mobile` varchar(13) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`s_id`, `s_name`, `s_password`, `s_email`, `s_mobile`, `is_active`) VALUES
(1, 'ayush', '123456', 'verma.ayush.ce20@gmail.com', '9512303056', 1),
(3, 'Rushan', '123456', 'belimrushan7@gmail.com', '987654854', 1),
(4, 'Sameed', '123456', 'sameedrk@gmail.com', '9476665421', 1),
(5, 'Aadil', '123456', 'aadilansari@gmail.com', '9676568421', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_master`
--
ALTER TABLE `admin_master`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contact_master`
--
ALTER TABLE `contact_master`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `my_cart`
--
ALTER TABLE `my_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`ord_id`);

--
-- Indexes for table `payment_master`
--
ALTER TABLE `payment_master`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_master`
--
ALTER TABLE `admin_master`
  MODIFY `a_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
  MODIFY `b_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_master`
--
ALTER TABLE `contact_master`
  MODIFY `contact_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `my_cart`
--
ALTER TABLE `my_cart`
  MODIFY `cart_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `ord_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_master`
--
ALTER TABLE `payment_master`
  MODIFY `pay_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `s_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
