-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2017 at 10:25 AM
-- Server version: 5.6.32-78.1
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `d5g9x9d8_LIMUN`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cabinets`
--

CREATE TABLE IF NOT EXISTS `Cabinets` (
  `ID` int(3) NOT NULL,
  `CabinetName` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `Cabinets`
--

INSERT INTO `Cabinets` (`ID`, `CabinetName`) VALUES
(1, 'Cabinet 1'),
(2, 'Cabinet 2'),
(3, 'Cabinet 3');

-- --------------------------------------------------------

--
-- Table structure for table `Directives`
--

CREATE TABLE IF NOT EXISTS `Directives` (
  `DirectiveNumber` int(6) NOT NULL,
  `DirectiveSender` text COLLATE latin1_general_ci NOT NULL,
  `DirectiveSenderName` text COLLATE latin1_general_ci NOT NULL,
  `DirectiveCommittee` text COLLATE latin1_general_ci NOT NULL,
  `DirectiveFrom` text COLLATE latin1_general_ci NOT NULL,
  `DirectiveType` text COLLATE latin1_general_ci NOT NULL,
  `DirectiveText` text COLLATE latin1_general_ci NOT NULL,
  `Status` text COLLATE latin1_general_ci,
  `StatusName` text COLLATE latin1_general_ci NOT NULL,
  `DirectiveColour` text COLLATE latin1_general_ci NOT NULL,
  `Timestamp` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `Directives`
--


-- --------------------------------------------------------

--
-- Table structure for table `Feedback`
--

CREATE TABLE IF NOT EXISTS `Feedback` (
  `ID` int(11) NOT NULL,
  `Username` text COLLATE utf8_unicode_ci NOT NULL,
  `Q1` text COLLATE utf8_unicode_ci NOT NULL,
  `Q2` text COLLATE utf8_unicode_ci NOT NULL,
  `Q3` text COLLATE utf8_unicode_ci NOT NULL,
  `Q4` text COLLATE utf8_unicode_ci NOT NULL,
  `Q5` text COLLATE utf8_unicode_ci NOT NULL,
  `Q6` text COLLATE utf8_unicode_ci NOT NULL,
  `Q7` text COLLATE utf8_unicode_ci NOT NULL,
  `Q8` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `GlobalVariables`
--

CREATE TABLE IF NOT EXISTS `GlobalVariables` (
  `ID` int(11) NOT NULL,
  `VariableName` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `VariableValue` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `GlobalVariables`
--

INSERT INTO `GlobalVariables` (`ID`, `VariableName`, `VariableValue`) VALUES
(1, 'backgroundImage', 'http://i.imgur.com/aICE3LU.png'),
(2, 'DirectiveTimer', '5'),
(3, 'backgroundImageBackup', 'http://i.imgur.com/aICE3LU.png'),
(4, 'CrisisHasStarted', 'Y'),
(5, 'GoogleDoc', 'https://docs.google.com/spreadsheets/d/1ALTRgqpsiR5Roun8dBKmuapoCr1eMsZWK1YuOqa8mEI/edit?usp=sharing'),
(6, 'CrisisName', 'LVMUN'),
(7, 'DirectiveFreeze', 'F'),
(8, 'favicon', 'http://i.imgur.com/2KMxy29.png'),
(9, 'GoogleDocBackup', ''),
(10, 'faviconBackup', 'http://i.imgur.com/2KMxy29.png');

-- --------------------------------------------------------

--
-- Table structure for table `NavBar`
--

CREATE TABLE IF NOT EXISTS `NavBar` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Privacy` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `NavBar`
--

INSERT INTO `NavBar` (`ID`, `Name`, `URL`, `Privacy`) VALUES
(1, 'Home', 'index.php', 1),
(2, 'Your Profile', 'profile.php', 2),
(14, 'Settings', 'userSettings.php', 1),
(4, 'Sent Directives', 'delegateDirectives.php', 2),
(3, 'Directives', 'telegram.php', 2),
(5, 'Chair Approval', 'directiveConfirmation.php', 3),
(8, 'Backroom Overview', 'backroomResponse.php', 4),
(9, 'Reserved Directive', 'backroomReserve.php', 4),
(10, 'Delegate Summary', 'backroomSheet.php', 4),
(11, 'Delegate Changes', 'createUser.php', 4),
(12, '[Sent Messages]', 'sent.php', 4),
(13, 'Admin Panel', 'settings.php', 5),
(15, 'Feedback', 'feedback.php', 6),
(18, 'Help', 'help.php', 0),
(17, 'Home', 'index.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `News`
--

CREATE TABLE IF NOT EXISTS `News` (
  `NewsNumber` int(5) NOT NULL,
  `NewsTitle` text COLLATE latin1_general_ci NOT NULL,
  `NewsDescription` text COLLATE latin1_general_ci NOT NULL,
  `NewsImage` text COLLATE latin1_general_ci
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `News`
--

INSERT INTO `News` (`NewsNumber`, `NewsTitle`, `NewsDescription`, `NewsImage`) VALUES
(1, 'Welcome to LVMUN Crisis.', 'We welcome you with praise. Questions? Comments?<br>
Email us: inquiries@muncrisis.com <br>
You can find us on Facebook at: https://www.facebook.com/CrisisDeus/', 'http://i.imgur.com/IdYlKRi.png');

-- --------------------------------------------------------

--
-- Table structure for table `Responses`
--

CREATE TABLE IF NOT EXISTS `Responses` (
  `Recipient` text COLLATE latin1_general_ci NOT NULL,
  `RecipientName` text COLLATE latin1_general_ci NOT NULL,
  `Directive` text COLLATE latin1_general_ci NOT NULL,
  `Response` text COLLATE latin1_general_ci NOT NULL,
  `responseDescription` text COLLATE latin1_general_ci NOT NULL,
  `responseID` int(11) NOT NULL,
  `readByDelegate` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `ResponseAllowed` char(1) COLLATE latin1_general_ci NOT NULL,
  `MassMessage` varchar(1) COLLATE latin1_general_ci NOT NULL,
  `DirectiveNumber` int(5) NOT NULL,
  `Timestamp` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `Responses`
--


-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `UserNameID` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `CharacterName` text COLLATE latin1_general_ci NOT NULL,
  `Committee` text COLLATE latin1_general_ci NOT NULL,
  `pass` varchar(513) COLLATE latin1_general_ci DEFAULT NULL,
  `isBackroom` char(2) COLLATE latin1_general_ci DEFAULT NULL,
  `isChair` varchar(2) COLLATE latin1_general_ci NOT NULL,
  `backroomColour` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `reservedDirective` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `id` int(11) NOT NULL,
  `LastDirective` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserNameID`, `CharacterName`, `Committee`, `pass`, `isBackroom`, `isChair`, `backroomColour`, `reservedDirective`, `id`, `LastDirective`) VALUES
('Andrew.Weeks@me.com', 'Andrew - Admin', '2', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'a', 't', '#FCA326', NULL, 1, '2017-02-14 18:47:17'),
('Miro.Pluckebaum@gmail.com', 'Miro - Admin', '1', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'a', '', '#FCA326', NULL, 2, '2016-12-20 14:20:52'),
('joshua.supton@gmail.com', 'Josh - Admin', '2', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'a', 't', '#FCA326', NULL, 3, '2017-02-14 18:47:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cabinets`
--
ALTER TABLE `Cabinets`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Directives`
--
ALTER TABLE `Directives`
  ADD PRIMARY KEY (`DirectiveNumber`);

--
-- Indexes for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `GlobalVariables`
--
ALTER TABLE `GlobalVariables`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `NavBar`
--
ALTER TABLE `NavBar`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `News`
--
ALTER TABLE `News`
  ADD PRIMARY KEY (`NewsNumber`);

--
-- Indexes for table `Responses`
--
ALTER TABLE `Responses`
  ADD PRIMARY KEY (`responseID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`), ADD FULLTEXT KEY `UserID` (`UserNameID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cabinets`
--
ALTER TABLE `Cabinets`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `Directives`
--
ALTER TABLE `Directives`
  MODIFY `DirectiveNumber` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `Feedback`
--
ALTER TABLE `Feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `GlobalVariables`
--
ALTER TABLE `GlobalVariables`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `NavBar`
--
ALTER TABLE `NavBar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `News`
--
ALTER TABLE `News`
  MODIFY `NewsNumber` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `Responses`
--
ALTER TABLE `Responses`
  MODIFY `responseID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
