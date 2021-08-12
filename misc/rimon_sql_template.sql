-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2021 at 07:35 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rimon`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitysummary`
--

CREATE TABLE `activitysummary` (
  `Id` int(11) NOT NULL,
  `Team` varchar(30) NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `Type` tinyint(2) NOT NULL,
  `Location` varchar(200) DEFAULT NULL,
  `Date` date NOT NULL,
  `Presents` mediumtext NOT NULL COMMENT 'FK to Users table',
  `Content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL COMMENT 'FK to User table',
  `PostalCode` int(11) DEFAULT NULL,
  `CityName` varchar(60) DEFAULT NULL,
  `Street` varchar(60) DEFAULT NULL,
  `HouseNumber` varchar(20) DEFAULT NULL,
  `ApartmentNumber` smallint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL COMMENT 'FK to Users table',
  `Name` varchar(100) NOT NULL,
  `Address` smallint(6) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `About` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `Id` int(11) NOT NULL,
  `Datetime` datetime NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `Users` varchar(2000) NOT NULL,
  `UserLastView` varchar(500) NOT NULL,
  `OpenBy` varchar(15) NOT NULL,
  `Show` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Hash` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `Id` int(11) NOT NULL,
  `UserId` varchar(11) NOT NULL COMMENT 'FK to Users table',
  `Type` tinyint(4) NOT NULL,
  `Years` float DEFAULT NULL,
  `Name` varchar(40) NOT NULL,
  `Institute` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Id` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `SubTitle` text NOT NULL,
  `Content` text DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  `StartEvent` datetime NOT NULL,
  `EndEvent` datetime NOT NULL,
  `OpenBy` varchar(50) NOT NULL,
  `OpenDate` datetime NOT NULL,
  `ShowLevel` tinyint(2) DEFAULT NULL,
  `ComingUsers` text DEFAULT NULL,
  `NotComingUsers` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `Id` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Content` mediumtext NOT NULL,
  `JobScope` varchar(50) NOT NULL,
  `OpenDate` datetime NOT NULL,
  `OpenBy` text NOT NULL COMMENT 'FK to Users table',
  `Type` tinyint(4) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Wage` varchar(100) DEFAULT NULL,
  `Status` tinyint(4) NOT NULL,
  `ContactName` varchar(100) NOT NULL,
  `ContactPhoneNumber` varchar(20) NOT NULL,
  `ContactEmail` varchar(60) NOT NULL,
  `ContactSite` varchar(100) NOT NULL,
  `ContactOther` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messageboard`
--

CREATE TABLE `messageboard` (
  `Id` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Content` text NOT NULL,
  `Image` varchar(500) NOT NULL,
  `OpenBy` varchar(9) NOT NULL,
  `OpenDate` datetime NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privatemessage`
--

CREATE TABLE `privatemessage` (
  `Id` int(11) NOT NULL,
  `ConversationId` int(11) NOT NULL COMMENT 'FK to Conversation table',
  `SentBy` varchar(100) NOT NULL,
  `Datetime` datetime NOT NULL,
  `Message` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `Id` int(11) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Task` mediumtext NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `CreateBy` varchar(20) NOT NULL COMMENT 'FK to Users table',
  `Team` tinyint(4) NOT NULL,
  `OpenDate` datetime NOT NULL,
  `FinishDate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `Id` int(11) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Users` mediumtext NOT NULL COMMENT 'FK to Users table',
  `Leader` varchar(10) NOT NULL,
  `About` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` varchar(9) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(64) DEFAULT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `PersonalNumber` int(10) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Address` smallint(6) NOT NULL COMMENT 'FK to Address table',
  `MilitaryType` tinyint(4) NOT NULL,
  `Recruitment` date DEFAULT NULL,
  `Profession` varchar(50) DEFAULT NULL,
  `Education` smallint(6) DEFAULT NULL COMMENT 'FK to Education table',
  `Businesses` smallint(6) DEFAULT NULL COMMENT 'FK to Businesses table',
  `Facebook` varchar(100) DEFAULT NULL,
  `About` mediumtext DEFAULT NULL,
  `RegisterDate` datetime NOT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `Role` tinyint(4) NOT NULL,
  `RecoverPassword` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitysummary`
--
ALTER TABLE `activitysummary`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `messageboard`
--
ALTER TABLE `messageboard`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `privatemessage`
--
ALTER TABLE `privatemessage`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activitysummary`
--
ALTER TABLE `activitysummary`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messageboard`
--
ALTER TABLE `messageboard`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privatemessage`
--
ALTER TABLE `privatemessage`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
