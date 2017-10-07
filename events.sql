-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2017 at 07:53 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` varchar(3) NOT NULL,
  `eventName` varchar(30) NOT NULL,
  `eventTagline` varchar(100) DEFAULT NULL,
  `eventDescription` varchar(50) DEFAULT NULL,
  `eventImage` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `eventName`, `eventTagline`, `eventDescription`, `eventImage`) VALUES
('Ad ', 'Ad Mad', 'Where Creativity meets Madness.', 'description/Ad Mad.html', 'images/Ad Mad.jpg'),
('Alg', 'Algowls', 'An Algortithm a day, keeps your Owl awake.', 'description/Algowls.html', 'images/Algowls.jpg'),
('App', 'App Combat', 'Its anDroid.', 'description/App Combat.html', 'images/App Combat.jpg'),
('Bat', 'Battle of Bytes', 'One bit ahead of byte.', 'description/Battle of Bytes.html', 'images/Battle of Bytes.jpg'),
('C-B', 'C-Benders', 'All the sleepless nights will pay-off.', 'description/C-Benders.html', 'images/C-Benders.jpg'),
('Con', 'Conundrum', 'Mystery wrapped in Enigma.', 'description/Conundrum.html', 'images/Conundrum.jpg'),
('Jun', 'Junkyard Wars', 'Beware of screw drivers', 'description/Junkyard Wars.html', 'images/Junkyard Wars.jpg'),
('Lan', 'Lan Gaming', 'Kill or Get Killed.', 'description/Lan Gaming.html', 'images/Lan Gaming.jpg'),
('Rol', 'Roll Camera Action', 'From real to reel', 'description/Roll Camera Action.html', 'images/Roll Camera Action.jpg'),
('Sna', 'Snake Jam', 'Let the odds get in your favour.', 'description/Snake Jam.html', 'images/Snake Jam.jpg'),
('Spe', 'Spec Wars', 'SpecXpert is TechXpert.', 'description/Spec Wars.html', 'images/Spec Wars.jpg'),
('SQL', 'SQLized', 'Torture the Data and it will confess to anything!', 'description/SQLized.html', 'images/SQLized.jpg'),
('Tre', 'Treasure Hunt', 'Unlock the Sherlock.', 'description/Treasure Hunt.html', 'images/Treasure Hunt.jpg'),
('Tur', 'Turncoat', 'Aapki har mistake hogi note, Jeetega vahi who can turn his coat', 'description/Turncoat.html', 'images/Turncoat.jpg'),
('TV ', 'TV Fandom', 'We Hire Couch Potatoes.', 'description/TV Fandom.html', 'images/TV Fandom.jpg'),
('Web', 'Webgators', 'The realm of DOT Com Commandos.', 'description/Webgators.html', 'images/Webgators.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
