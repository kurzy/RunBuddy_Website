-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2018 at 06:30 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s5007230`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

DROP TABLE IF EXISTS `achievements`;
CREATE TABLE IF NOT EXISTS `achievements` (
  `achID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`achID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`achID`, `title`, `description`) VALUES
(1, 'The Novice', 'Take your first run with RunBuddy.'),
(2, 'The Skilled', 'Take 10 runs with RunBuddy.'),
(3, 'The Expert', 'Take 50 runs with RunBuddy.'),
(4, 'The Legendary', 'Take 100 runs with RunBuddy.'),
(5, 'Early Riser', 'Start a run before 5am.'),
(6, 'Night Owl', 'Start a run after 9pm.'),
(7, 'Dizzy', 'Run through 3 roundabouts on a route.'),
(8, 'Splasher', 'Run within 100m of a beach shoreline'),
(9, 'Sweat Dripper', 'Run on a day hotter than 30C.'),
(10, 'Hot Blooded', 'Run on a day colder than 5C'),
(11, 'Over The Water', 'Run across a bridge.'),
(12, 'Get High', 'Run at an elevation higher than 300m.'),
(13, 'Teaming Up', 'Run with another RunBuddy user.'),
(14, 'Gumboots', 'Run during a rainy day.'),
(15, 'Dog Whisperer', 'Run through a dog park.'),
(16, 'Slow and Steady', 'Run for more than 2 hours on a single route.'),
(17, 'The Flash', 'Run a 1km route in under 2 minutes 30 seconds.');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `URL` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`ID`, `userID`, `URL`) VALUES
(1, 19, 'img/runner2.jpg'),
(2, 19, 'img/hiker.jpg'),
(3, 19, 'img/smart_watch.jpg'),
(4, 19, 'img/PIXNIO-383429-200x133.jpg'),
(5, 25, 'img/steph_profile_picture.jpg'),
(6, 22, 'img/alex_profile_picture.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `coordID` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `routeID` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`coordID`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`coordID`, `latitude`, `longitude`, `routeID`, `time`) VALUES
(9, -27.980145, 153.429378, 1, '2018-11-18 11:46:06'),
(10, -27.979595, 153.429978, 1, '2018-11-18 11:47:44'),
(11, -27.97842, 153.429721, 1, '2018-11-18 11:48:25'),
(12, -27.977302, 153.429356, 1, '2018-11-18 11:49:13'),
(13, -27.975919, 153.429337, 1, '2018-11-18 11:49:30'),
(14, -27.97499, 153.429273, 1, '2018-11-18 11:50:44'),
(15, -27.974289, 153.429552, 1, '2018-11-18 11:51:49'),
(16, -27.971863, 153.420154, 2, '2018-11-18 12:14:12'),
(17, -27.970063, 153.419168, 2, '2018-11-18 12:15:12'),
(18, -27.96885, 153.41846, 2, '2018-11-18 12:17:22'),
(19, -27.968016, 153.418117, 2, '2018-11-18 12:19:09'),
(20, -27.967145, 153.417429, 2, '2018-11-18 12:21:01'),
(21, -27.966311, 153.416871, 2, '2018-11-18 12:25:38'),
(22, -27.948501832339243, 153.4023160909287, 4, '2018-11-22 13:29:06'),
(23, -27.949013617387987, 153.40543818222204, 4, '2018-11-22 13:33:06'),
(24, -27.94681503755228, 153.4059190750122, 4, '2018-11-22 13:35:28'),
(25, -27.944028566218215, 153.40648770332336, 4, '2018-11-22 13:37:20'),
(26, -27.94342197789658, 153.40317249298096, 4, '2018-11-22 13:38:49'),
(27, -27.944729929718576, 153.40290427207947, 4, '2018-11-22 13:40:15'),
(28, -27.948501832339243, 153.4023160909287, 4, '2018-11-22 13:41:13'),
(29, -27.949013617387987, 153.40543818222204, 4, '2018-11-22 13:43:40'),
(30, -27.94681503755228, 153.4059190750122, 4, '2018-11-22 13:44:14'),
(31, -27.944028566218215, 153.40648770332336, 4, '2018-11-22 13:46:05'),
(32, -27.94342197789658, 153.40317249298096, 4, '2018-11-22 13:50:10'),
(33, -27.944729929718576, 153.40290427207947, 4, '2018-11-22 13:52:15'),
(34, -27.962628, 153.40803173269524, 5, '2018-11-22 16:34:08'),
(35, -27.96122591668438, 153.4101131268908, 5, '2018-11-22 16:34:08'),
(36, -27.96039198969605, 153.41189411367668, 5, '2018-11-22 16:34:08'),
(37, -27.963020639447464, 153.4138798713684, 5, '2018-11-22 16:34:08'),
(38, -27.96415778332019, 153.41201305389404, 5, '2018-11-22 16:34:08'),
(39, -27.965901380653595, 153.41310739517212, 5, '2018-11-22 16:34:08'),
(40, -27.967493336223956, 153.41428756713867, 5, '2018-11-22 16:34:08'),
(41, -27.968478820759746, 153.4124207496643, 5, '2018-11-22 16:34:08'),
(42, -27.945074543799766, 153.3632369133927, 6, '2018-11-22 16:36:39'),
(43, -27.945453656099502, 153.3606405350663, 6, '2018-11-22 16:36:39'),
(44, -27.94541574492938, 153.35868788690345, 6, '2018-11-22 16:36:39'),
(45, -27.945529478399735, 153.35497570962684, 6, '2018-11-22 16:36:39'),
(46, -27.945908589102597, 153.3528084847428, 6, '2018-11-22 16:36:39'),
(47, -27.947175188464648, 153.3518886566162, 6, '2018-11-22 16:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `acc_type` varchar(20) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `bio` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `acc_type`, `creation_date`, `fname`, `lname`, `area`, `bio`) VALUES
(19, 'admin@runbuddy.com', 'adpexzg3FUZAk', 'admin', '2018-11-08 21:52:22', 'Bob', 'Clarkson', 'Southport', 'RunBuddy admin.'),
(22, 'alex@gmail.com', 'alP.4yzPRDMJc', NULL, '2018-11-12 14:11:08', 'Alex', 'Ham', 'Southport', 'Hello my name is Alex'),
(23, 'gregnorman321@gmail.com', 'grQi2v106uw6.', NULL, '2018-11-14 19:11:06', 'Greg', 'Norman', 'Broadbeach', 'Hi, I love to ride my bike around GC.'),
(24, 'alicestevenson@mail.com', 'alfu/zwrG7eZw', NULL, '2018-11-22 13:32:23', 'Alice', 'Stevenson', 'Arundel', 'Love to walk my dogs.'),
(25, 'steph111@gmail.com', 'st5a55GwuEeKM', NULL, '2018-11-22 13:33:27', 'Steph', 'Hart', 'Southport', 'I walk to and from work everyday in Southport.'),
(26, 'kara5050@hotmail.com', 'kaxjDJ0wPuDQ.', NULL, '2018-11-22 13:34:19', 'Kara', 'Thomas', 'Southport', 'Keeping fit is my goal.');

-- --------------------------------------------------------

--
-- Table structure for table `user_achievements`
--

DROP TABLE IF EXISTS `user_achievements`;
CREATE TABLE IF NOT EXISTS `user_achievements` (
  `userAchID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `achID` int(11) NOT NULL,
  PRIMARY KEY (`userAchID`),
  KEY `userAchID` (`userAchID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_achievements`
--

INSERT INTO `user_achievements` (`userAchID`, `userID`, `achID`) VALUES
(1, 19, 1),
(2, 19, 2),
(3, 19, 10),
(4, 19, 11),
(5, 19, 3),
(6, 19, 4),
(7, 19, 5),
(8, 19, 6),
(9, 19, 7),
(10, 19, 8),
(16, 25, 13),
(17, 25, 12),
(18, 25, 14),
(19, 25, 2),
(20, 25, 1),
(21, 22, 1),
(22, 22, 10),
(23, 22, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_photo`
--

DROP TABLE IF EXISTS `user_profile_photo`;
CREATE TABLE IF NOT EXISTS `user_profile_photo` (
  `userID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_profile_photo`
--

INSERT INTO `user_profile_photo` (`userID`, `imageID`) VALUES
(19, 4),
(22, 6),
(25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_routes`
--

DROP TABLE IF EXISTS `user_routes`;
CREATE TABLE IF NOT EXISTS `user_routes` (
  `routeID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `distance` float NOT NULL,
  `notes` varchar(300) NOT NULL,
  PRIMARY KEY (`routeID`),
  KEY `routeID` (`routeID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_routes`
--

INSERT INTO `user_routes` (`routeID`, `userID`, `distance`, `notes`) VALUES
(1, 19, 0.7, 'Main beach run. '),
(2, 19, 0.75, 'Broadwater parklands.'),
(4, 19, 1, 'Run around the block Labrador.'),
(5, 22, 3.1, 'Run around my neighbourhood'),
(6, 25, 1.3, 'Ran to the supermarket in Arundel');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
