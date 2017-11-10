-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2017 at 03:58 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techmarathon`
--
CREATE DATABASE IF NOT EXISTS `techmarathon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `techmarathon`;

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE IF NOT EXISTS `counter` (
  `ViewCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`ViewCount`) VALUES
(88);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventName` varchar(30) NOT NULL,
  `eventTagline` varchar(100) DEFAULT NULL,
  `eventDescription` varchar(50) DEFAULT NULL,
  `eventImage` varchar(50) DEFAULT NULL,
  `eventType` varchar(15) NOT NULL,
  PRIMARY KEY (`eventName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventName`, `eventTagline`, `eventDescription`, `eventImage`, `eventType`) VALUES
('Ad Mad', 'Where Creativity meets Madness.', 'description/Ad Mad.html', 'images/Ad Mad.jpg', 'Non-Technical'),
('Algowls', 'An Algortithm a day, keeps your Owl awake.', 'description/Algowls.html', 'images/Algowls.jpg', 'Technical'),
('App Combat', 'Its anDroid.', 'description/App Combat.html', 'images/App Combat.jpg', 'Technical'),
('Battle of Bytes', 'One bit ahead of byte.', 'description/Battle of Bytes.html', 'images/Battle of Bytes.jpg', 'Technical'),
('C-Benders', 'All the sleepless nights will pay-off.', 'description/C-Benders.html', 'images/C-Benders.jpg', 'Technical'),
('Conundrum', 'Mystery wrapped in Enigma.', 'description/Conundrum.html', 'images/Conundrum.jpg', 'Technical'),
('Junkyard Wars', 'Beware of screw drivers', 'description/Junkyard Wars.html', 'images/Junkyard Wars.jpg', 'Technical'),
('Lan Gaming', 'Kill or Get Killed.', 'description/Lan Gaming.html', 'images/Lan Gaming.jpg', 'Non-Technical'),
('Roll Camera Action', 'From real to reel', 'description/Roll Camera Action.html', 'images/Roll Camera Action.jpg', 'Non-Technical'),
('Snake Jam', 'Let the odds get in your favour.', 'description/Snake Jam.html', 'images/Snake Jam.jpg', 'Non-Technical'),
('Spec Wars', 'SpecXpert is TechXpert.', 'description/Spec Wars.html', 'images/Spec Wars.jpg', 'Technical'),
('SQLized', 'Torture the Data and it will confess to anything!', 'description/SQLized.html', 'images/SQLized.jpg', 'Technical'),
('Treasure Hunt', 'Unlock the Sherlock.', 'description/Treasure Hunt.html', 'images/Treasure Hunt.jpg', 'Non-Technical'),
('Turncoat', 'Aapki har mistake hogi note, Jeetega vahi who can turn his coat', 'description/Turncoat.html', 'images/Turncoat.jpg', 'Non-Technical'),
('TV Fandom', 'We Hire Couch Potatoes.', 'description/TV Fandom.html', 'images/TV Fandom.jpg', 'Non-Technical');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `Name` varchar(20) NOT NULL,
  `Email_id` varchar(25) DEFAULT NULL,
  `Contact_No` bigint(10) NOT NULL,
  `Event` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`Name`, `Email_id`, `Contact_No`, `Event`, `Date`) VALUES
('Aryan', 'aryanhans1337@gmail.com', 9582058679, 'Algowls', '2017-09-27'),
('Jassa ', 'NoEmailok', 1212121212, 'Algowls', '2017-09-26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
