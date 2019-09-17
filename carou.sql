-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2019 at 02:44 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carou`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(3) NOT NULL,
  `first name` text NOT NULL,
  `last name` text NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `first name`, `last name`, `email`) VALUES
(1, 'Kaushik', 'Bhat', 'kaushikbhat.98@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL,
  `parent_id` int(10) NOT NULL DEFAULT '9',
  `cat_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `parent_id`, `cat_title`) VALUES
(1, 0, 'Quick Bites'),
(3, 0, 'Salads'),
(4, 0, 'Starters'),
(5, 0, 'Pizzas'),
(6, 0, 'Pastas'),
(7, 0, 'Main Course'),
(8, 0, 'Desserts'),
(9, 0, 'Beverages'),
(11, 1, 'Eggs '),
(12, 1, 'Munchies'),
(13, 1, 'Fries'),
(14, 1, 'Burgers'),
(15, 1, 'Sandwiches'),
(19, 3, 'Veg'),
(20, 3, 'Non Veg'),
(21, 4, 'Veg'),
(22, 4, 'Non Veg'),
(23, 5, 'Veg'),
(24, 5, 'Non Veg'),
(25, 6, 'Veg'),
(26, 6, 'Egg'),
(27, 6, 'Non Veg'),
(28, 7, 'Fried Rice'),
(29, 7, 'Noodles'),
(30, 8, 'Waffles'),
(31, 8, 'Brownie'),
(32, 8, 'Sundaes'),
(33, 8, 'Ice Creams'),
(34, 9, 'Smoothies'),
(35, 9, 'Juices'),
(36, 9, 'Protein Shakes'),
(38, 9, 'Milkshakes'),
(39, 9, 'Thick Shakes'),
(40, 9, 'Lassi'),
(52, 0, 'Worms'),
(53, 52, 'Caterpillar'),
(54, 52, 'Butterfly'),
(55, 52, 'Bees');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `email` varchar(50) NOT NULL,
  `address_1` varchar(50) NOT NULL,
  `address_2` varchar(50) NOT NULL,
  `pin` bigint(7) NOT NULL,
  `contact_number` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`email`, `address_1`, `address_2`, `pin`, `contact_number`) VALUES
('kaushik.bantval98@gmail.com', 'no.411 vishwas tribhuvan', 'iruvail road, moodbidri', 555555, 9999999999);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerid` int(10) NOT NULL,
  `first name` text NOT NULL,
  `last name` text NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerid`, `first name`, `last name`, `email`) VALUES
(32, 'Kaushik', 'Bantval', 'kaushik.bantval98@gmail.com'),
(35, 'nibba', 'lit', 'nibbalit69@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employeeid` int(3) NOT NULL,
  `first name` text NOT NULL,
  `last name` text NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeid`, `first name`, `last name`, `email`) VALUES
(1, 'Carry', 'Minati', 'carryminati13@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `priority` int(3) NOT NULL COMMENT '1=admin;2=employee;3=customer;0=blocked'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`email`, `password`, `priority`) VALUES
('carryminati13@gmail.com', '123', 2),
('kaushik.bantval98@gmail.com', '123', 3),
('kaushikbhat.98@gmail.com', '123', 1),
('nibbalit69@gmail.com', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `product_id` int(50) NOT NULL,
  `order_amount` varchar(20) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_date` datetime NOT NULL,
  `transaction_type` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `address_1` varchar(50) NOT NULL,
  `address_2` varchar(50) NOT NULL,
  `pin` int(6) NOT NULL,
  `contact_number` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `order_amount`, `order_status`, `order_date`, `transaction_type`, `email`, `address_1`, `address_2`, `pin`, `contact_number`) VALUES
(1, 13, '220', 'pending', '2019-02-01 00:00:00', 'cod', 'kaushikbhat.98@gmail.com', 'zzz', 'zzz', 555555, 9999999999);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_title` varchar(50) NOT NULL,
  `cat_id` int(10) NOT NULL DEFAULT '40',
  `parent_id` int(10) NOT NULL DEFAULT '9',
  `product_desc` text,
  `product_image` varchar(50) DEFAULT 'images/.png',
  `product_price` int(10) NOT NULL,
  `product_quantity` bigint(5) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `cat_id`, `parent_id`, `product_desc`, `product_image`, `product_price`, `product_quantity`) VALUES
(1, 'Bread Omlette', 11, 1, '', 'images/Bread Omlette.png', 80, 10),
(2, 'Chicken Cheese Ball', 12, 1, '', 'images/Chicken Cheese Balls.png', 120, 10),
(7, 'Chicken Nuggets', 12, 1, NULL, 'images/Chicken Nuggets.png', 150, 10),
(8, 'Chicken Strips', 12, 1, NULL, 'images/Chicken Strips.png', 170, 10),
(9, 'Original French Fries', 13, 1, NULL, 'images/Original French Fries.png', 90, 10),
(11, 'Masala French Fries', 13, 1, NULL, 'images/Masala French Fries.png', 120, 10),
(13, 'Veg Double Decker Burger', 14, 1, NULL, 'images/Veg Double Decker Burger.png', 80, 10),
(14, 'Paneer Burger', 14, 1, NULL, 'images/Paneer Burger.png', 100, 10),
(15, 'Chicken Tikka Burger', 14, 1, NULL, 'images/Chicken Tikka Burger.png', 130, 10),
(16, 'Chicken Tandoori Burger', 14, 1, NULL, 'images/Chicken Tandoori Burger.png', 130, 10),
(17, 'Chicken American Burger', 14, 1, NULL, 'images/Chicken American Burger.png', 130, 10),
(18, 'Chilli Cheese Sandwich', 15, 1, NULL, 'images/Chilli Cheese Sandwich.png', 80, 10),
(19, 'Mushroom Cheese Sandwich', 15, 1, NULL, 'images/Mushroom Cheese Sandwich.png', 90, 10),
(20, 'Roasted Chicken Sandwich', 15, 1, NULL, 'images/Roasted Chicken Sandwich.png', 120, 10),
(21, 'Chilli Chicken Sandwich', 15, 1, NULL, 'images/Chilli Chicken Sandwich.png', 120, 10),
(22, 'Corn Cheese Sandwich', 15, 1, NULL, 'images/Corn Cheese Sandwich.png', 100, 10),
(23, 'Jalapeno Cheese Sandwich', 15, 1, NULL, 'images/Jalapeno Cheese Sandwich.png', 100, 10),
(24, 'Veg Hawaiian Salad', 19, 3, NULL, 'images/Veg Hawaiian Salad.png', 170, 10),
(25, 'Chicken Hawaiian Salad', 20, 3, NULL, 'images/Chicken Hawaiian Salad.png', 190, 10),
(26, 'Grilled Chicken Salad', 20, 3, NULL, 'images/Grilled Chicken Salad.png', 180, 10),
(27, 'Chicken Honey Salad', 20, 3, NULL, 'images/Chicken Honey Salad.png', 190, 10),
(28, 'Chilli Mushroom', 21, 4, NULL, 'images/Chilli Mushroom.png', 170, 10),
(29, 'Gobi Manchurian', 21, 4, NULL, 'images/Gobi Manchurian.png', 170, 10),
(30, 'Chilli Paneer', 21, 4, NULL, 'images/Chilli Paneer.png', 170, 10),
(31, 'Veg Quesadilla', 21, 4, NULL, 'images/Veg Quesadilla.png', 190, 10),
(32, 'Mixed Veg Momos', 21, 4, NULL, 'images/Mixed Veg Momos.png', 120, 10),
(34, 'Chicken Momos', 22, 4, NULL, 'images/Chicken Momos.png', 140, 10),
(35, 'Chicken Onion Momos', 22, 4, NULL, 'images/Chicken Onion Momos.png', 150, 10),
(36, 'Chicken Quesadilla', 22, 4, NULL, 'images/Chicken Quesadilla.png', 200, 10),
(37, 'Chicken Manchurian', 22, 4, NULL, 'images/Chicken Manchurian.png', 180, 10),
(38, 'Dragon Chicken', 22, 4, NULL, 'images/Dragon Chicken.png', 180, 10),
(40, '8\'\' Corn Pizza', 23, 5, NULL, 'images/8\'\' Corn Pizza.png', 180, 10),
(42, '8\'\' Paneer Pizza', 23, 5, NULL, 'images/8\'\' Paneer Pizza.png', 180, 10),
(43, '8\'\' Crinkle Pizza', 23, 5, NULL, 'images/8\'\' Crinkle Pizza.png', 200, 10),
(44, '8\'\' Chicken Pizza', 24, 5, NULL, 'images/8\'\' Chicken Pizza.png', 220, 10),
(45, '8\'\' Barbeque Chicken Pizza', 24, 5, NULL, 'images/8\'\' Barbeque Chicken Pizza.png', 230, 10),
(46, '8\'\' Chicken Chilli Pizza', 24, 5, NULL, 'images/8\'\' Chicken Chilli Pizza.png', 230, 10),
(47, '8\'\' Chicken Manchurian Pizza', 24, 5, NULL, 'images/8\'\' Chicken Manchurian Pizza.png', 230, 10),
(48, 'Veg Penne Pasta', 25, 6, NULL, 'images/Veg Penne Pasta.png', 160, 10),
(49, 'Veg Alfredo Penne Pasta', 25, 6, NULL, 'images/Veg Alfredo Penne Pasta.png', 200, 10),
(50, 'Veg Spaghetti Alfredo Pasta', 25, 6, NULL, 'images/Veg Spaghetti Alfredo Pasta.png', 200, 10),
(51, 'Veg Masala Mafia Penne Pasta', 25, 6, NULL, 'images/Veg Masala Mafia Penne Pasta.png', 200, 10),
(52, 'Veg Bake Macaroni Pasta', 25, 6, NULL, 'images/Veg Bake Macaroni Pasta.png', 200, 10),
(53, 'Paneer Penne Pasta', 25, 6, NULL, 'images/Paneer Penne Pasta.png', 170, 10),
(54, 'Egg Penne Pasta', 26, 6, NULL, 'images/Egg Penne Pasta.png', 180, 10),
(55, 'Chicken Penne Pasta', 27, 6, NULL, 'images/Chicken Penne Pasta.png', 200, 10),
(56, 'Chicken Alfredo Penne Pasta', 27, 6, NULL, 'images/Chicken Alfredo Penne Pasta.png', 220, 10),
(57, 'Chicken Spaghetti Alfredo Past', 27, 6, NULL, 'images/Chicken Spaghetti Alfredo Pasta.png', 220, 10),
(58, 'Chicken Bake Macaroni Pasta', 27, 6, NULL, 'images/Chicken Bake Macaroni Pasta.png', 220, 10),
(59, 'Veg Fried Rice', 28, 7, NULL, 'images/Veg Fried Rice.png', 150, 10),
(60, 'Capsicum Fried Rice', 28, 7, NULL, 'images/Capsicum Fried Rice.png', 150, 10),
(61, 'Egg Fried Rice', 28, 7, NULL, 'images/Egg Fried Rice.png', 160, 10),
(62, 'Chicken Fried Rice', 28, 7, NULL, 'images/Chicken Fried Rice.png', 170, 10),
(63, 'Chicken Schezwan Fried Rice', 28, 7, NULL, 'images/Chicken Schezwan Fried Rice.png', 180, 10),
(64, 'Veg Noodles', 29, 7, NULL, 'images/Veg Noodles.png', 150, 10),
(65, 'Veg Brown Garlic Noodles', 29, 7, NULL, 'images/Veg Brown Garlic Noodles.png', 170, 10),
(66, 'Veg Schezwan Noodles', 29, 7, NULL, 'images/Veg Schezwan Noodles.png', 160, 10),
(67, 'Egg Noodles', 29, 7, NULL, 'images/Egg Noodles.png', 160, 10),
(68, 'Egg Schezwan Noodles', 29, 7, NULL, 'images/Egg Schezwan Noodles.png', 170, 10),
(69, 'Chicken Noodles', 29, 7, NULL, 'images/Chicken Noodles.png', 180, 10),
(70, 'Chicken Schezwan Noodles', 29, 7, NULL, 'images/Chicken Schezwan Noodles.png', 180, 10),
(71, 'Chicken Brown Garlic Noodles', 29, 7, NULL, 'images/Chicken Brown Garlic Noodles.png', 180, 10),
(72, 'Peanut Waffles', 30, 8, NULL, 'images/Peanut Waffles.png', 170, 10),
(73, 'Nutella Waffles', 30, 8, NULL, 'images/Nutella Waffles.png', 180, 10),
(74, 'Peanut Butter Brownie', 31, 8, NULL, 'images/Peanut Butter Brownie.png', 140, 10),
(75, 'Fruit E Vanilla Sundae', 32, 8, NULL, 'images/Fruit E Vanilla Sundae.png', 120, 10),
(76, 'Mango Russia Sundae', 32, 8, NULL, 'images/Mango Russia Sundae.png', 120, 10),
(77, 'Fruit & Cream Sundae', 32, 8, NULL, 'images/Fruit & Cream Sundae.png', 130, 10),
(78, 'Choco Rain Sundae', 32, 8, NULL, 'images/Choco Rain Sundae.png', 140, 10),
(79, 'Gadbad Sundae', 32, 8, NULL, 'images/Gadbad Sundae.png', 140, 10),
(80, 'Banana Split Sundae', 32, 8, NULL, 'images/Banana Split Sundae.png', 140, 10),
(81, 'Duet Sundae', 32, 8, NULL, 'images/Duet Sundae.png', 140, 10),
(82, 'Chocolate Dad Sundae', 32, 8, NULL, 'images/Chocolate Dad Sundae.png', 150, 10),
(83, 'Chocolate Fudge Sundae', 32, 8, NULL, 'images/Chocolate Fudge Sundae.png', 150, 10),
(84, 'Choco Nut Sundae ', 32, 8, NULL, 'images/Choco Nut Sundae .png', 150, 10),
(85, 'Dry Fruit Sundae', 32, 8, NULL, 'images/Dry Fruit Sundae.png', 150, 10),
(86, 'Fruit Overloaded Sundae', 32, 8, NULL, 'images/Fruit Overloaded Sundae.png', 150, 10),
(87, 'Lychee With Ice Cream', 32, 8, NULL, 'images/Lychee With Ice Cream.png', 150, 10),
(88, 'Triple Sundae', 32, 8, NULL, 'images/Triple Sundae.png', 150, 10),
(89, 'Mango Ice cream', 33, 8, NULL, 'images/Mango Ice cream.png', 140, 10),
(90, 'Banana Ice cream', 33, 8, NULL, 'images/Banana Ice cream.png', 140, 10),
(91, 'Chikoo Ice cream', 33, 8, NULL, 'images/Chikoo Ice cream.png', 140, 10),
(92, 'Apple Banana Ice cream', 33, 8, NULL, 'images/Apple Banana Ice cream.png', 150, 10),
(93, 'Custard Apple Ice cream', 33, 8, NULL, 'images/Custard Apple Ice cream.png', 150, 10),
(94, 'Strawberry Ice cream', 33, 8, NULL, 'images/Strawberry Ice cream.png', 160, 10),
(95, 'Loaded Banana Smoothie', 34, 9, NULL, 'images/Loaded Banana Smoothie.png', 110, 10),
(96, 'Heavy Mango Smoothie', 34, 9, NULL, 'images/Heavy Mango Smoothie.png', 110, 10),
(97, 'Kill Strawberry Smoothie', 34, 9, NULL, 'images/Kill Strawberry Smoothie.png', 120, 10),
(98, 'Galaxy Smoothie', 34, 9, NULL, 'images/Galaxy Smoothie.png', 130, 10),
(99, 'Blueberry Banana Smoothie', 34, 9, NULL, 'images/Blueberry Banana Smoothie.png', 140, 10),
(100, 'Sweet Sunrise Smoothie', 34, 9, NULL, 'images/Sweet Sunrise Smoothie.png', 150, 10),
(101, 'Damn Lychee Smoothie', 34, 9, NULL, 'images/Damn Lychee Smoothie.png', 160, 10),
(102, 'Lime Cooler', 35, 9, NULL, 'images/Lime Cooler.png', 70, 10),
(103, 'Moroccan Mint Lime Juice', 35, 9, NULL, 'images/Moroccan Mint Lime Juice.png', 90, 10),
(104, 'Watermelon Juice', 35, 9, NULL, 'images/Watermelon Juice.png', 60, 10),
(105, 'Orange Juice', 35, 9, NULL, 'images/Orange Juice.png', 60, 10),
(106, 'Mosambi Juice', 35, 9, NULL, 'images/Mosambi Juice.png', 60, 10),
(107, 'Pineapple Juice', 35, 9, NULL, 'images/Pineapple Juice.png', 60, 10),
(108, 'Pomegranate Juice', 35, 9, NULL, 'images/Pomegranate Juice.png', 60, 10),
(109, 'Strawberry Cashew Protein Shake', 36, 9, NULL, 'images/Strawberry Cashew Protein Shake.png', 140, 10),
(110, 'Walnut Banana Protein Shake', 36, 9, NULL, 'images/Walnut Banana Protein Shake.png', 130, 10),
(111, 'Chikoo Milkshake', 38, 9, NULL, 'images/Chikoo Milkshake.png', 90, 10),
(112, 'Pina Colada', 38, 9, NULL, 'images/Pina Colada.png', 140, 10),
(113, 'Kesar Badam Special', 38, 9, NULL, 'images/Kesar Badam Special.png', 140, 10),
(114, 'Chocolate Peanut Butter ', 38, 9, NULL, 'images/Chocolate Peanut Butter.png', 150, 10),
(115, 'Orange Cream Cycle', 38, 9, NULL, 'images/Orange Cream Cycle.png', 150, 10),
(116, 'Pomegranate Milkshake', 38, 9, NULL, 'images/Pomegranate Milkshake.png', 150, 10),
(117, 'Papaya Milkshake', 38, 9, NULL, 'images/Papaya Milkshake.png', 80, 10),
(118, 'Monte Carlo Vanilla Milkshake', 38, 9, NULL, 'images/Monte Carlo Vanilla Milkshake.png', 120, 10),
(119, 'Gems Vanilla Milkshake', 38, 9, NULL, 'images/Gems Vanilla Milkshake.png', 140, 10),
(120, 'Pista Vanilla Milkshake', 38, 9, NULL, 'images/Pista Vanilla Milkshake.png', 140, 10),
(121, 'Chocolate Revolution Milkshake', 38, 9, NULL, 'images/Chocolate Revolution Milkshake.png', 140, 10),
(122, 'Red Velvet Milkshake', 38, 9, NULL, 'images/Red Velvet Milkshake.png', 140, 10),
(123, 'Nut Get Together Milkshake', 38, 9, NULL, 'images/Nut Get Together Milkshake.png', 140, 10),
(124, 'Colour Full Milkshake', 38, 9, NULL, 'images/Colour Full Milkshake.png', 140, 10),
(125, 'Don Pablo Milkshake', 38, 9, NULL, 'images/Don Pablo Milkshake.png', 140, 10),
(126, 'Oreo Cheese Milkshake', 38, 9, NULL, 'images/Oreo Cheese Milkshake.png', 140, 10),
(127, 'Blackcurrant Milkshake', 38, 9, NULL, 'images/Blackcurrant Milkshake.png', 140, 10),
(128, 'Love Milkshake', 38, 9, NULL, 'images/Love Milkshake.png', 140, 10),
(129, 'Poppy Cooler Thick Shake', 39, 9, NULL, 'images/Poppy Cooler Thick Shake.png', 140, 10),
(130, 'Bubble Gum Thick Shake', 39, 9, NULL, 'images/Bubble Gum Thick Shake.png', 140, 10),
(131, 'I Love Oreo Thick Shake', 39, 9, NULL, 'images/I Love Oreo Thick Shake.png', 140, 10),
(132, 'Munch It Up Thick Shake', 39, 9, NULL, 'images/Munch It Up Thick Shake.png', 140, 10),
(133, 'Speed Ferrero Thick Shake', 39, 9, NULL, 'images/Speed Ferrero Thick Shake.png', 140, 10),
(134, 'Chocolate Thick Shake', 39, 9, NULL, 'images/Chocolate Thick Shake.png', 140, 10),
(135, 'Dairy Milk Thick Shake', 39, 9, NULL, 'images/Dairy Milk Thick Shake.png', 140, 10),
(136, 'Kit Kat Thick Shake', 39, 9, NULL, 'images/Kit Kat Thick Shake.png', 140, 10),
(137, 'Viva La Thick Shake', 39, 9, NULL, 'images/Viva La Thick Shake.png', 140, 10),
(138, 'The Original Lassi', 40, 9, NULL, 'images/The Original Lassi.png', 80, 10),
(139, 'Mango Indulge Lassi', 40, 9, NULL, 'images/Mango Indulge Lassi.png', 70, 10),
(140, 'Arabesque Lassi', 40, 9, NULL, 'images/Arabesque Lassi.png', 80, 10),
(141, 'Fruity Yugo Lassi', 40, 9, NULL, 'images/Fruity Yugo Lassi.png', 80, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerid`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeid`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employeeid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`email`) REFERENCES `login` (`email`);

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`email`) REFERENCES `login` (`email`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`email`) REFERENCES `login` (`email`),
  ADD CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`email`) REFERENCES `login` (`email`),
  ADD CONSTRAINT `customers_ibfk_3` FOREIGN KEY (`email`) REFERENCES `login` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_ibfk_4` FOREIGN KEY (`email`) REFERENCES `login` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`email`) REFERENCES `login` (`email`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`email`) REFERENCES `login` (`email`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
