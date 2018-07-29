-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2018 at 10:05 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shrouq`
--
CREATE DATABASE IF NOT EXISTS `shrouq` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shrouq`;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`) VALUES
(4, 'images/news/6153256709811813315_27067403_1673048646067106_5237364819013539874_n.jpg'),
(5, 'images/news/5193551769411513415_12.jpg'),
(6, 'images/news/6193355739411413815_12645152_800727103390300_783724127642302295_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE `msgs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `msgs`
--

INSERT INTO `msgs` (`id`, `name`, `email`, `msg`) VALUES
(1, 'asd', 'asd@das', 'asdasd'),
(2, 'asd', 'asd@das', 'asdasd'),
(3, 'asd', 'asd@das', 'asdasd'),
(4, 'asd', 'asd@das', 'asdasd'),
(5, 'asd', 'asd@das', 'asdasd'),
(6, 'asd', 'asd@das', 'asdasd'),
(1, 'asd', 'asd@das', 'asdasd'),
(2, 'asd', 'asd@das', 'asdasd'),
(3, 'asd', 'asd@das', 'asdasd'),
(4, 'asd', 'asd@das', 'asdasd'),
(5, 'asd', 'asd@das', 'asdasd'),
(6, 'asd', 'asd@das', 'asdasd'),
(1, 'asd', 'asd@das', 'asdasd'),
(2, 'asd', 'asd@das', 'asdasd'),
(3, 'asd', 'asd@das', 'asdasd'),
(4, 'asd', 'asd@das', 'asdasd'),
(5, 'asd', 'asd@das', 'asdasd'),
(6, 'asd', 'asd@das', 'asdasd'),
(1, 'asd', 'asd@das', 'asdasd'),
(2, 'asd', 'asd@das', 'asdasd'),
(3, 'asd', 'asd@das', 'asdasd'),
(4, 'asd', 'asd@das', 'asdasd'),
(5, 'asd', 'asd@das', 'asdasd'),
(6, 'asd', 'asd@das', 'asdasd'),
(1, 'asd', 'asd@das', 'asdasd'),
(2, 'asd', 'asd@das', 'asdasd'),
(3, 'asd', 'asd@das', 'asdasd'),
(4, 'asd', 'asd@das', 'asdasd'),
(5, 'asd', 'asd@das', 'asdasd'),
(6, 'asd', 'asd@das', 'asdasd'),
(1, 'asd', 'asd@das', 'asdasd'),
(2, 'asd', 'asd@das', 'asdasd'),
(3, 'asd', 'asd@das', 'asdasd'),
(4, 'asd', 'asd@das', 'asdasd'),
(5, 'asd', 'asd@das', 'asdasd'),
(6, 'asd', 'asd@das', 'asdasd'),
(1, 'asd', 'asd@das', 'asdasd'),
(2, 'asd', 'asd@das', 'asdasd'),
(3, 'asd', 'asd@das', 'asdasd'),
(4, 'asd', 'asd@das', 'asdasd'),
(5, 'asd', 'asd@das', 'asdasd'),
(6, 'asd', 'asd@das', 'asdasd'),
(1, 'asd', 'asd@das', 'asdasd'),
(2, 'asd', 'asd@das', 'asdasd'),
(3, 'asd', 'asd@das', 'asdasd'),
(4, 'asd', 'asd@das', 'asdasd'),
(5, 'asd', 'asd@das', 'asdasd'),
(6, 'asd', 'asd@das', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(10230) NOT NULL,
  `image` varchar(511) NOT NULL,
  `cover` varchar(511) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`, `cover`, `date`, `location`) VALUES
(1, 'Welcoming', 'Thank you so much all Players, Officials, Coachers, Member and Roll Ball Lovers for showing your love towards Roll Ball on completing its 15 years successfully. Special thanks to Mr. Raju Dabhade for inventing such a thrilling and exciting game in 21st Century.\r\n\r\n', 'images/news/8143552799411313615_27067403_1673048646067106_5237364819013539874_n.jpg', 'http://picsum.photos/1920', '0000-00-00', ''),
(10, 'test event', 'test description', 'images/news/1103756749411213015_', 'images/news/8153255709211913415_', '0000-00-00', 'test location'),
(11, 'test event', 'description\r\n', 'images/news/5153950789411413915_', 'images/news/9133158739211913215_', '0000-00-00', 'location'),
(12, 'test event', 'description\r\n', 'images/news/9123650769911313615_', 'images/news/7113258789511713115_', '2018-03-07', 'location');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gendre` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `country` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `weight` float NOT NULL,
  `tall` float NOT NULL,
  `phone` int(12) NOT NULL,
  `image` varchar(511) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `email`, `gendre`, `birthdate`, `country`, `address`, `weight`, `tall`, `phone`, `image`) VALUES
(7, 'ss', 'ss@s', 'male', '0000-00-00', 'egypt', 'ss', 22, 22, 231313, 'images/players/5123153719611313015_cartoon-man-icon-person-design-vector-graphic-concept-represented-isolated-flat-illustration-73697341.jpg'),
(8, 'asdasdaa', 'asd@ss', 'male', '0000-00-00', 'rwanda', 'sadas', 23, 33, 2131, 'images/players/4143957739411213015_27067403_1673048646067106_5237364819013539874_n.jpg'),
(9, 'adas', '', 'male', '0000-00-00', 'Choose Your Country', '', 0, 0, 0, 'images/players/0143957739411213015_'),
(10, 'aa', 'sa@d', 'male', '0000-00-00', 'guinea', 'asdas', 0, 0, 312312, 'images/players/9123951749311013615_'),
(7, 'ss', 'ss@s', 'male', '0000-00-00', 'egypt', 'ss', 22, 22, 231313, 'images/players/5123153719611313015_cartoon-man-icon-person-design-vector-graphic-concept-represented-isolated-flat-illustration-73697341.jpg'),
(8, 'asdasdaa', 'asd@ss', 'male', '0000-00-00', 'rwanda', 'sadas', 23, 33, 2131, 'images/players/4143957739411213015_27067403_1673048646067106_5237364819013539874_n.jpg'),
(9, 'adas', '', 'male', '0000-00-00', 'Choose Your Country', '', 0, 0, 0, 'images/players/0143957739411213015_'),
(10, 'aa', 'sa@d', 'male', '0000-00-00', 'guinea', 'asdas', 0, 0, 312312, 'images/players/9123951749311013615_'),
(7, 'ss', 'ss@s', 'male', '0000-00-00', 'egypt', 'ss', 22, 22, 231313, 'images/players/5123153719611313015_cartoon-man-icon-person-design-vector-graphic-concept-represented-isolated-flat-illustration-73697341.jpg'),
(8, 'asdasdaa', 'asd@ss', 'male', '0000-00-00', 'rwanda', 'sadas', 23, 33, 2131, 'images/players/4143957739411213015_27067403_1673048646067106_5237364819013539874_n.jpg'),
(9, 'adas', '', 'male', '0000-00-00', 'Choose Your Country', '', 0, 0, 0, 'images/players/0143957739411213015_'),
(10, 'aa', 'sa@d', 'male', '0000-00-00', 'guinea', 'asdas', 0, 0, 312312, 'images/players/9123951749311013615_'),
(7, 'ss', 'ss@s', 'male', '0000-00-00', 'egypt', 'ss', 22, 22, 231313, 'images/players/5123153719611313015_cartoon-man-icon-person-design-vector-graphic-concept-represented-isolated-flat-illustration-73697341.jpg'),
(8, 'asdasdaa', 'asd@ss', 'male', '0000-00-00', 'rwanda', 'sadas', 23, 33, 2131, 'images/players/4143957739411213015_27067403_1673048646067106_5237364819013539874_n.jpg'),
(9, 'adas', '', 'male', '0000-00-00', 'Choose Your Country', '', 0, 0, 0, 'images/players/0143957739411213015_'),
(10, 'aa', 'sa@d', 'male', '0000-00-00', 'guinea', 'asdas', 0, 0, 312312, 'images/players/9123951749311013615_');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'admin@admin', 'dd94709528bb1c83d08f3088d4043f4742891f4f'),
(1, 'admin@admin', 'dd94709528bb1c83d08f3088d4043f4742891f4f'),
(1, 'admin@admin', 'dd94709528bb1c83d08f3088d4043f4742891f4f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
