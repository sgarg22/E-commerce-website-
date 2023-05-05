-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 12:53 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sneakerhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `user_session_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `price`, `quantity`, `user_session_id`, `p_id`) VALUES
(21, 'AF1 suede', 40, 1, 665, 13),
(25, 'Delta', 65, 1, 814, 4),
(29, 'AirforceOne', 40, 1, 814, 1),
(30, 'Sebagi loafer', 52, 1, 814, 11);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `categories` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `name`, `description`, `price`, `quantity`, `categories`) VALUES
(1, 'AirforceOne', 'White Nike airforce one with a thick sole', 40, 60, 'lowcuts'),
(2, 'Chain reaction', 'Extra stylish and comfy purple sneakers for that boss look', 80, 0, 'miscelanous'),
(3, 'Vans', 'Black strong boots for that casual and stylish look', 50, 30, 'uppercuts'),
(4, 'Delta', 'Finish that US Marine with this tough industrial grade boots', 65, 35, 'lowcuts'),
(5, 'timberlands', 'Brown leather shoes for the tough weather type of day', 45, 27, 'uppercuts'),
(6, 'timberlands', 'Brown leather shoes for the tough weather type of day', 45, 27, 'uppercuts'),
(7, 'yeezy', 'Kanye West inspired type of boots to finish the drip', 55, 42, 'lowcuts'),
(8, 'puma tennis sneakers', 'White Nike Airforce 1 sneakers with an extra thick sole', 70, 40, 'lowcuts'),
(9, 'Airmax', 'Black airmax shoes with a thick sole and grip to finish off that stylish look', 42, 28, 'lowcuts'),
(10, 'Js raging bull', 'Red newly released J5 with the basketballer type of look', 63, 35, 'uppercuts'),
(11, 'Sebagi loafer', 'Sebago loafers to complement the official look in a sneaker like fashion', 52, 42, 'miscelaneaous'),
(12, 'Louis vutton paris', 'Trendy black and brown shoes for that mexican druglord look', 120, 0, 'uppercuts'),
(13, 'AF1 suede', 'The newest white and brown AF1s with an extra thick sole and cusioned for extra comfort', 40, 45, 'lowcuts'),
(14, 'Puma Roma Sneakers', 'Blue sneakers for a stylish and elegant look', 40, 0, 'lowcuts'),
(15, 'Yeezy Upper Cut', 'Blue sneakers for a stylish and elegant look', 70, 60, 'lowcuts');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
