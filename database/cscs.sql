-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 01, 2022 at 11:51 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cscs`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

DROP TABLE IF EXISTS `category_list`;
CREATE TABLE IF NOT EXISTS `category_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Chicken', 'Chicken', 1, 0, '2022-04-22 09:59:46', '2022-10-28 18:40:21'),
(2, 'Egg', 'Egg', 1, 0, '2022-04-22 10:01:06', '2022-10-07 22:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

DROP TABLE IF EXISTS `product_list`;
CREATE TABLE IF NOT EXISTS `product_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `category_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` float(15,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `quantity` int(255) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `category_id`, `name`, `description`, `price`, `status`, `quantity`, `delete_flag`, `date_created`, `date_updated`, `qty`) VALUES
(1, 1, 'Arabica', 'Arabica is the most popular type of bean used for coffee. Arabica beans are considered higher quality than Robusta, and they\'re also more expensive.', 150.00, 1, 45, 1, '2022-04-22 10:16:50', '2022-10-31 13:50:26', 45),
(2, 1, 'Robusta', 'Robusta beans are typically cheaper to produce because the Robusta plant is easier to grow.', 145.00, 1, 65, 1, '2022-04-22 10:17:20', '2022-10-31 13:50:26', 65),
(3, 1, 'Whole Chicken', '', 160.00, 1, 75, 0, '2022-04-22 10:17:54', '2022-11-01 12:40:56', 74),
(4, 1, 'Breast Fillet', '', 220.00, 1, 45, 0, '2022-04-22 10:18:15', '2022-11-01 13:56:23', 39),
(5, 1, 'Drumstick', '', 180.00, 1, 78, 0, '2022-04-22 10:19:18', '2022-10-31 13:50:26', 78),
(6, 1, 'Thighs', '', 190.00, 1, 97, 0, '2022-04-22 10:19:47', '2022-10-31 13:50:26', 97),
(7, 1, 'Breast', '', 180.00, 1, 46, 0, '2022-04-22 10:20:06', '2022-11-01 12:45:45', 36),
(8, 1, 'Wings', '', 185.00, 1, 35, 0, '2022-04-22 10:20:26', '2022-10-31 15:27:28', 34),
(9, 2, 'Large Egg', '', 8.00, 1, 24, 0, '2022-04-22 10:20:53', '2022-10-31 13:50:53', 25),
(10, 2, 'Medium Egg', '', 7.00, 1, 56, 0, '2022-04-22 10:21:17', '2022-10-31 13:50:26', 56),
(11, 2, 'Small Egg', '', 6.00, 1, 86, 0, '2022-04-22 10:21:42', '2022-11-01 14:18:48', 5),
(13, 1, 'Whole Chicken 1', '', 190.00, 1, 34, 1, '2022-10-28 19:35:16', '2022-10-31 13:50:26', 34);

-- --------------------------------------------------------

--
-- Table structure for table `sale_list`
--

DROP TABLE IF EXISTS `sale_list`;
CREATE TABLE IF NOT EXISTS `sale_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `client_name` text NOT NULL,
  `quantity` int(255) NOT NULL DEFAULT '0',
  `amount` float(15,2) NOT NULL DEFAULT '0.00',
  `tendered` float(15,2) NOT NULL DEFAULT '0.00',
  `payment_type` tinyint(1) NOT NULL COMMENT '1 = Cash,\r\n2 = Debit Card,\r\n3 = Credit Card',
  `payment_code` text,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_list`
--

INSERT INTO `sale_list` (`id`, `user_id`, `code`, `client_name`, `quantity`, `amount`, `tendered`, `payment_type`, `payment_code`, `date_created`, `date_updated`) VALUES
(3, 1, '202210070001', 'Jet Lee Bautista', 0, 144.00, 500.00, 1, '', '2022-10-07 09:37:36', '2022-10-07 22:51:48'),
(4, 5, '202210070002', 'Monica Malicdem', 0, 360.00, 500.00, 1, '', '2022-10-07 12:59:17', '2022-10-07 23:02:03'),
(5, 1, '202210070003', 'Matthew Parayno', 0, 1800.00, 1500.00, 1, '', '2022-10-07 22:56:07', '2022-11-01 09:58:21'),
(6, 4, '202210070004', 'Guest', 0, 3900.00, 4000.00, 1, '', '2022-10-07 23:06:11', '2022-10-07 23:06:11'),
(7, 4, '202210130001', 'Jasmine Kurdi', 0, 2942.00, 3000.00, 1, '', '2022-10-13 17:29:33', '2022-10-13 17:29:33'),
(8, 1, '202210180001', 'Monica Malicdem', 0, 2017.00, 2000.00, 1, '', '2022-10-18 17:01:21', '2022-11-01 09:58:18'),
(14, 1, '202210290001', 'Guest', 0, 950.00, 1000.00, 1, '', '2022-10-29 09:19:45', '2022-10-29 09:19:45'),
(15, 1, '202210290002', 'Guest', 0, 950.00, 1000.00, 1, '', '2022-10-29 09:20:43', '2022-10-29 09:20:43'),
(16, 4, '202210310001', 'Guest', 0, 620.00, 1000.00, 1, '', '2022-10-31 14:06:27', '2022-10-31 14:06:27'),
(17, 4, '202210310002', 'Guest', 0, 360.00, 500.00, 1, '', '2022-10-31 14:06:48', '2022-10-31 14:06:48'),
(18, 4, '202210310003', 'Guest', 0, 180.00, 0.00, 1, '', '2022-10-31 14:07:47', '2022-10-31 14:07:47'),
(19, 4, '202210310004', 'Guest', 0, 180.00, 200.00, 1, '', '2022-10-31 14:10:39', '2022-10-31 14:10:39'),
(20, 4, '202210310005', 'Guest', 0, 540.00, 600.00, 1, '', '2022-10-31 14:11:21', '2022-10-31 14:11:21'),
(21, 4, '202210310006', 'Guest', 0, 360.00, 500.00, 1, '', '2022-10-31 14:11:49', '2022-10-31 14:11:49'),
(22, 4, '202210310007', 'Guest', 0, 180.00, 200.00, 1, '', '2022-10-31 14:20:51', '2022-10-31 14:20:51'),
(24, 4, '202210310008', 'Guest', 0, 765.00, 1000.00, 1, '', '2022-10-31 15:13:34', '2022-10-31 15:13:34'),
(25, 4, '202210310009', 'Guest', 0, 360.00, 600.00, 1, '', '2022-10-31 15:28:11', '2022-10-31 15:28:33'),
(26, 4, '202210310010', 'Guest', 0, 180.00, 100.00, 1, '', '2022-10-31 17:27:05', '2022-10-31 17:27:05'),
(27, 4, '202211010001', 'Guest', 0, 180.00, 200.00, 1, '', '2022-11-01 12:40:44', '2022-11-01 12:40:44'),
(28, 4, '202211010002', 'Guest', 0, 160.00, 0.00, 1, '', '2022-11-01 12:40:56', '2022-11-01 12:40:56'),
(29, 4, '202211010003', 'Guest22', 0, 180.00, 200.00, 1, '', '2022-11-01 12:45:45', '2022-11-01 12:45:45'),
(30, 4, '202211010004', 'Guestxx', 0, 1320.00, 1500.00, 1, '', '2022-11-01 13:23:06', '2022-11-01 13:23:06'),
(31, 4, '202211010005', 'Guest2', 0, 980.00, 1000.00, 1, '', '2022-11-01 13:56:23', '2022-11-01 13:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `sale_products`
--

DROP TABLE IF EXISTS `sale_products`;
CREATE TABLE IF NOT EXISTS `sale_products` (
  `sale_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(10) NOT NULL,
  `price` float(15,2) NOT NULL DEFAULT '0.00',
  KEY `sale_id` (`sale_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_products`
--

INSERT INTO `sale_products` (`sale_id`, `product_id`, `qty`, `price`) VALUES
(3, 11, 24, 6.00),
(5, 7, 10, 180.00),
(4, 3, 2, 150.00),
(4, 11, 10, 6.00),
(6, 3, 8, 150.00),
(6, 5, 10, 180.00),
(6, 7, 5, 180.00),
(7, 7, 5, 180.00),
(7, 8, 10, 185.00),
(7, 9, 24, 8.00),
(8, 7, 5, 180.00),
(8, 8, 5, 185.00),
(8, 9, 24, 8.00),
(14, 13, 5, 190.00),
(15, 13, 5, 190.00),
(16, 4, 2, 220.00),
(16, 7, 1, 180.00),
(17, 7, 2, 180.00),
(18, 7, 1, 180.00),
(19, 7, 1, 180.00),
(20, 7, 3, 180.00),
(21, 7, 2, 180.00),
(22, 7, 1, 180.00),
(24, 7, 2, 180.00),
(24, 4, 1, 220.00),
(24, 8, 1, 185.00),
(25, 7, 2, 180.00),
(26, 7, 1, 180.00),
(27, 7, 1, 180.00),
(28, 3, 1, 160.00),
(29, 7, 1, 180.00),
(30, 4, 6, 220.00),
(31, 7, 3, 180.00),
(31, 4, 2, 220.00);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

DROP TABLE IF EXISTS `system_info`;
CREATE TABLE IF NOT EXISTS `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'E-Poultry Management System'),
(6, 'short_name', 'EPMS - PHP'),
(11, 'logo', 'uploads/logo.png?v=1666098047'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1665110986');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-04-13 15:24:24'),
(2, 'Mark', 'Cooper', 'mcooper', '0c4635c5af0f173c26b0d85b6c9b398b', 'uploads/avatars/2.png?v=1650520142', NULL, 3, '2022-04-21 13:49:02', '2022-04-21 13:49:54'),
(4, 'Johnny', 'Smith', 'jsmith', '39ce7e2a8573b41ce73b5ba41617f8f7', 'uploads/avatars/4.png?v=1650531008', NULL, 3, '2022-04-21 16:50:08', '2022-10-07 09:40:02'),
(5, 'Jhon Loyd', 'Fernandez', 'aa', '39ce7e2a8573b41ce73b5ba41617f8f7', 'uploads/avatars/5.png?v=1665118716', NULL, 2, '2022-10-07 12:58:36', '2022-11-01 14:52:43');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_list`
--
ALTER TABLE `product_list`
  ADD CONSTRAINT `category_id_fk_pl` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sale_list`
--
ALTER TABLE `sale_list`
  ADD CONSTRAINT `user_id_fk_sl` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `sale_products`
--
ALTER TABLE `sale_products`
  ADD CONSTRAINT `product_id_fk_sp` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sale_id_fk_sp` FOREIGN KEY (`sale_id`) REFERENCES `sale_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
