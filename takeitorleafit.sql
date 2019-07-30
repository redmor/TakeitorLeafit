-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2019 at 10:19 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `takeitorleafit`
--

-- --------------------------------------------------------

--
-- Table structure for table `acct_pay`
--

CREATE TABLE `acct_pay` (
  `id` int(9) UNSIGNED NOT NULL,
  `invoice_num` int(25) UNSIGNED NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `amt_owed` decimal(10,2) UNSIGNED NOT NULL,
  `amt_paid` decimal(10,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acct_rec`
--

CREATE TABLE `acct_rec` (
  `invoice_num` int(9) UNSIGNED NOT NULL,
  `order_num` int(15) UNSIGNED NOT NULL,
  `amt_owed` decimal(10,2) UNSIGNED NOT NULL,
  `amt_paid` decimal(10,2) UNSIGNED NOT NULL,
  `acct_num` int(15) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ad_banner`
--

CREATE TABLE `ad_banner` (
  `ad_id` int(10) NOT NULL,
  `ad_img` varchar(50) NOT NULL,
  `ad_link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_banner`
--

INSERT INTO `ad_banner` (`ad_id`, `ad_img`, `ad_link`) VALUES
(5, 'assets\\img\\Banner\\adOne.jpg', 'categories.php?cat=marriage'),
(6, 'assets\\img\\Banner\\adTwo.jpg', 'categories.php?cat=aniversary'),
(7, 'assets\\img\\Banner\\adThree.jpg', 'categories.php?cat=teddy');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(11) NOT NULL,
  `p_name` text NOT NULL,
  `p_price` double(100,0) NOT NULL,
  `p_qty` int(10) NOT NULL,
  `p_total` double(100,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `p_name`, `p_price`, `p_qty`, `p_total`) VALUES
(28, 'The Bright Blue Skies Bouquet', 40, 7, 0),
(29, 'Rose & Lily Celebration', 51, 5, 0),
(30, 'Cuddle Up & Celebrate!', 31, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `acct_num` int(15) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(9) UNSIGNED NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`acct_num`, `first_name`, `last_name`, `email`, `street`, `city`, `state`, `zip`, `password`, `date_reg`) VALUES
(10, 'Oussama', 'Errabili', 'cryptoboy2018@gmail.com', 'Portland St', 'Pittsburgh', 'PA', 45884, '$2y$10$0dqqA30aSyYsLglynqz0P.cTfpr6kVjrMRBDoLKASenSDzbZN5KBW', '2019-07-11 20:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_num` int(15) UNSIGNED NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(9) UNSIGNED NOT NULL,
  `password` varchar(32) NOT NULL,
  `type` enum('Employee','Manager') NOT NULL DEFAULT 'Employee',
  `hired` date DEFAULT NULL,
  `terminated` date DEFAULT NULL,
  `location` enum('1000-Col','1001-Col','2000-Pitt','2001-Pitt','3000-Det','3001-Det','4000-Indy','4001-Indy') NOT NULL DEFAULT '1000-Col'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(9) UNSIGNED NOT NULL,
  `item` varchar(25) NOT NULL,
  `item_name` text NOT NULL,
  `qty` int(9) UNSIGNED NOT NULL,
  `purc_cost` decimal(10,2) UNSIGNED NOT NULL,
  `sell_cost` decimal(10,2) UNSIGNED NOT NULL,
  `location` enum('1000-Col','1001-Col','2000-Pitt','2001-Pitt','3000-Det','3001-Det','4000-Indy','4001-Indy') NOT NULL DEFAULT '1000-Col',
  `img` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `category` enum('aniversary','marriage','graduation','teddy-bears','chocolate') NOT NULL,
  `featured` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item`, `item_name`, `qty`, `purc_cost`, `sell_cost`, `location`, `img`, `desc`, `category`, `featured`) VALUES
(1, 'flowers', 'Rose & Lily Celebration', 12, '0.00', '50.99', '1000-Col', 'assets\\img\\Flowers\\flowers_1.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', 'graduation', 1),
(3, 'flowers', 'The Bright Blue Skies Bouquet', 20, '0.00', '40.00', '2000-Pitt', 'assets\\img\\Flowers\\flowers_2.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', 'marriage', 1),
(4, 'gifts', 'GIANT Teddy Bear - 36 inch', 12, '0.00', '50.00', '3000-Det', 'assets\\img\\Gifts\\teddy_1.png', 'What\'s cuddly, brown, and HUGE? This Giant Teddy Bear is! This magnificent 36\" teddy bear is the ultimate sign of affection that they will not soon forget. He\'s cuddly, and cute, and the perfect way to say I Love You this Valentine\'s Day. Make this a Valentine\'s Day they will cherish forever with this one of a kind GIANT Teddy Bear.', 'teddy-bears', 1),
(5, 'flowers', 'Pretty Please', 12, '0.00', '40.99', '1001-Col', 'assets\\img\\Flowers\\flowers_3.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', 'aniversary', 1),
(10, 'flowers', 'Ruby Rose Bouquet', 12, '0.00', '39.99', '1000-Col', 'assets\\img\\Flowers\\flowers_4.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', 'aniversary', 1),
(11, 'gifts', 'Clear Blue Skies Bouquet', 12, '0.00', '40.99', '1001-Col', 'assets\\img\\Flowers\\flowers_5.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', '', 1),
(19, 'gifts', 'Cuddle Up & Celebrate!', 12, '20.00', '30.99', '2001-Pitt', 'assets\\img\\Gifts\\teddy_3.png', 'Decorated with a smile, a singular sunflower is complimented with a red satin ribbon and green trachelium. The Cuddle Up & Celebrate! Bouquet also includes a plush teddy bear and happy birthday balloon, making this bouquet bundle complete. Available for delivery in the USA, this makes for an adorable birthday gift for children. Measures 14\"H by 5\"L.', 'teddy-bears', 1),
(20, 'flowers', 'The Bright Blue Skies Bouquet', 20, '0.00', '40.00', '2000-Pitt', 'assets\\img\\Flowers\\flowers_6.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', 'marriage', 1),
(21, 'flowers', 'You are in my Heart', 12, '0.00', '50.00', '1001-Col', 'assets\\img\\Flowers\\flowers_7.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', 'marriage', 1),
(22, 'flowers', 'Pretty Please', 12, '0.00', '40.99', '1001-Col', 'assets\\img\\Flowers\\flowers_8.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', 'aniversary', 1),
(23, 'flowers', ' How Sweet It Is', 12, '0.00', '40.99', '1001-Col', 'assets\\img\\Flowers\\flowers_9.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', '', 1),
(26, 'gifts', 'Smile! Chocolate Covered Cookies - 12 Pieces', 12, '8.00', '12.99', '2001-Pitt', 'assets\\img\\Gifts\\chocolate_2.png', 'There is no better way to make their day than with our assortment of Belgian chocolate-dipped Cookies gift. Hand-dipped in milk, dark and white chocolate, this delicious gourmet masterpiece of Cookies are artfully decorated with an assortment of smile candies and drizzles of yellow and dark chocolate swirls. Order today and put a smile on their face!', 'chocolate', 1),
(27, 'gifts', 'Sampler Basket', 12, '0.00', '40.99', '1001-Col', 'assets\\img\\Gifts\\chocolate_1.png', 'Simple, Elegant..... sample the delicious tastes of Sampler Basket chocolates including an assortment of milk chocolate truffle Gems, a rich chocolate bar and chocolate dipped cashews all wrapped up in a gift basket and topped with a gold bow.', 'chocolate', 1),
(28, 'gifts', 'Cuddle Up & Celebrate!', 12, '20.00', '30.99', '2001-Pitt', 'assets\\img\\Gifts\\teddy_2.png', 'Decorated with a smile, a singular sunflower is complimented with a red satin ribbon and green trachelium. The Cuddle Up & Celebrate! Bouquet also includes a plush teddy bear and happy birthday balloon, making this bouquet bundle complete. Available for delivery in the USA, this makes for an adorable birthday gift for children. Measures 14\"H by 5\"L.', 'teddy-bears', 1),
(29, 'flowers', 'Pretty Please', 12, '0.00', '40.99', '1001-Col', 'assets\\img\\Flowers\\flowers_10.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', 'aniversary', 1),
(30, 'flowers', 'Ruby Rose Bouquet', 12, '0.00', '39.99', '1000-Col', 'assets\\img\\Flowers\\flowers_11.png', 'Offer the peace and tranquility that comes from classic blue and white flowers. Our elegant floor basket arrangement, handcrafted by our caring florists with pristine white and blue blooms, is a tasteful gesture perfectly suited for the funeral home or memorial services.', 'graduation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `order_num` int(32) UNSIGNED NOT NULL COMMENT 'order number, not to be confused with Invoice number (for accounts rec) but can be used as such for non business accounts',
  `acct_num` int(15) UNSIGNED NOT NULL COMMENT 'fkey, references to customer whose order this is',
  `del_addy` text NOT NULL COMMENT 'the address in plain text',
  `total` decimal(10,2) UNSIGNED NOT NULL COMMENT 'generated website side or app side as needed',
  `pay_rec` enum('Paid','Not Paid') NOT NULL DEFAULT 'Paid' COMMENT ' NOT FOR WEBSITE: should only be Not Paid for Invoiced orders, otherwise not to be used at this time',
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date the order was placed',
  `del_date` timestamp NULL DEFAULT NULL COMMENT 'date the order is to be delivered',
  `pay_type` enum('Credit Card','Cash','CoD','Check','Invoice') NOT NULL DEFAULT 'Credit Card' COMMENT 'Website ONLY uses Credit Card - all other are future proofing/acct_rec',
  `order_status` enum('Ordered','Received','Processed','Out For Delivery','Delivered','Canceled') NOT NULL DEFAULT 'Ordered' COMMENT 'Defaults to Ordered, WEBSITE DOES NOT USE ANY OTHER OPTION',
  `location` enum('1000-Col','1001-Col','2000-Pitt','2001-Pitt','3000-Det','3001-Det','4000-Indy','4001-Indy') NOT NULL DEFAULT '1000-Col'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`order_num`, `acct_num`, `del_addy`, `total`, `pay_rec`, `trans_date`, `del_date`, `pay_type`, `order_status`, `location`) VALUES
(2, 10, 'Portland st', '25.00', 'Paid', '2019-07-17 15:29:26', '2019-07-17 04:00:00', 'Credit Card', 'Ordered', '1000-Col');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acct_pay`
--
ALTER TABLE `acct_pay`
  ADD KEY `id` (`id`);

--
-- Indexes for table `acct_rec`
--
ALTER TABLE `acct_rec`
  ADD KEY `invoice_num` (`invoice_num`);

--
-- Indexes for table `ad_banner`
--
ALTER TABLE `ad_banner`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`acct_num`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `acct_num` (`acct_num`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD KEY `emp_num` (`emp_num`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`order_num`),
  ADD UNIQUE KEY `order_num` (`order_num`),
  ADD KEY `acct_num_idfk_1` (`acct_num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acct_pay`
--
ALTER TABLE `acct_pay`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acct_rec`
--
ALTER TABLE `acct_rec`
  MODIFY `invoice_num` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ad_banner`
--
ALTER TABLE `ad_banner`
  MODIFY `ad_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `acct_num` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_num` int(15) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `order_num` int(32) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'order number, not to be confused with Invoice number (for accounts rec) but can be used as such for non business accounts', AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_history`
--
ALTER TABLE `order_history`
  ADD CONSTRAINT `acct_num_idfk_1` FOREIGN KEY (`acct_num`) REFERENCES `customer` (`acct_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
