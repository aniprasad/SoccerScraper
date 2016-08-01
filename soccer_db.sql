-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2016 at 01:44 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soccer_db`
--
CREATE DATABASE IF NOT EXISTS `soccer_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `soccer_db`;

-- --------------------------------------------------------

--
-- Table structure for table `player_stats`
--

DROP TABLE IF EXISTS `player_stats`;
CREATE TABLE IF NOT EXISTS `player_stats` (
  `Id` int(4) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `complete_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `player_percentage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avg_ppg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `minutes_played` int(4) NOT NULL,
  `goals` int(4) NOT NULL,
  `assists` int(4) NOT NULL,
  `clean_sheets` int(4) NOT NULL,
  `goals_conceded` int(4) NOT NULL,
  `own_goals` int(4) NOT NULL,
  `penalties_saved` int(4) NOT NULL,
  `penalties_missed` int(4) NOT NULL,
  `yellow_cards` int(4) NOT NULL,
  `red_cards` int(4) NOT NULL,
  `saves` int(4) NOT NULL,
  `influence` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creativity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `threat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `team_id` int(4) NOT NULL,
  `team` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stadium` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `player_stats`
--
ALTER TABLE `player_stats`
  ADD PRIMARY KEY (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
