SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `NavBar` (
  `ID` int(5) NOT NULL,
  `Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Privacy` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `NavBar` (`ID`, `Name`, `URL`) VALUES
(1, 'Home', 'index.php'),
(2, 'Deus History', 'aboutUs.php'),
(3, 'FAQ', 'FAQ.php'),
(4, 'Inquiries', 'sales.php');

CREATE TABLE IF NOT EXISTS `Sales` (
  `ID` int(5) NOT NULL,
  `Q1` text COLLATE latin1_general_ci NOT NULL,
  `Q2` text COLLATE latin1_general_ci NOT NULL,
  `Q3` text COLLATE latin1_general_ci NOT NULL,
  `Q4` text COLLATE latin1_general_ci NOT NULL,
  `Q5` text COLLATE latin1_general_ci NOT NULL,
  `Q6` text COLLATE latin1_general_ci NOT NULL,
  `Q7` text COLLATE latin1_general_ci NOT NULL,
  `Q8` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

ALTER TABLE `NavBar`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Sales`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `NavBar`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `Sales`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;
