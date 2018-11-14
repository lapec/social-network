-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 02:11 PM
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
-- Database: `soc_net`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentari_slike`
--

CREATE TABLE `komentari_slike` (
  `komid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `kid` int(11) NOT NULL,
  `komentar` varchar(255) NOT NULL,
  `vremepostavljanja` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `kid` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `korisnickoime` varchar(50) NOT NULL,
  `lozinka` varchar(550) NOT NULL,
  `slikakorisnika` varchar(50) NOT NULL DEFAULT 'generic_profile_img.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`kid`, `ime`, `prezime`, `email`, `korisnickoime`, `lozinka`, `slikakorisnika`) VALUES
(1, 'Milan', 'Rakić', 'milan@gmail.com', 'milanR', '$2y$10$Q2hcDBYXKBceFKfj9Pzf4.nukr9zDQWUsKVgcMt.gp8h3LwNdRZyi', 'profile.gif'),
(2, 'Miloš', 'Crnjanski', 'mcrnjanski@gmail.com', 'MCrnjanski', '$2y$10$Q2hcDBYXKBceFKfj9Pzf4.nukr9zDQWUsKVgcMt.gp8h3LwNdRZyi', 'user.jpg'),
(3, 'Ruzica', 'Vukovic', 'ruzica@gmail.com', 'Ruza', '135790', 'female-profile-img.jpg'),
(4, 'Rajko', 'Vukovic', 'rajko@gmail.com', 'Rajkoo', '135232943', 'petprofilepic.png'),
(25, 'Boban', 'Lapcevic', 'bobanlapcevic@gmail.com', 'lab', '$2y$10$Q2hcDBYXKBceFKfj9Pzf4.nukr9zDQWUsKVgcMt.gp8h3LwNdRZyi', 'generic_profile_img.png'),
(26, 'Nikola', 'Tesla', 'ntesla@gmail.com', 'ntesla', '$2y$10$ID2VW.BCcmJSWG6r4gfM4eGVOH2/2cCdenyJPBOAfsbutY8bNRFWi', 'generic_profile_img.png'),
(36, 't', 't', 't', 't', '$2y$10$opmiSv5K6pwKbCnwxdy79.F5G8ZULaTVPSqqRqOOsKc.TWz2T1N5a', 'generic_profile_img.png'),
(37, 'Dare', 'Mačužić', 'duca.yu@gmail.com', 'dacha.yu', '$2y$10$avghmldw85.VsuN4eAvBVe4i84p.rXf4C/.Y7SquqO09.Ai0AB3ZG', 'userimg_00000037.jpg'),
(38, 'Lena', 'Macuzic', 'lenamm@gmail.com', 'lenamm', '$2y$10$Di0WbZz4LfabezwDc7y3HegHxvpKIS26Db4zaEeNp65YuGUNYmR5.', 'generic_profile_img.png'),
(39, 'Marija', 'Macuzic', 'marija634@hotmail.com', 'marija634', '$2y$10$T5J9FuVJygxTo7HqanhfneDRjciHd0u6jzIvp.mWJxEIFN.RA0lDK', 'generic_profile_img.png'),
(40, 'Sasa', 'Zivkovic', 'zilesz@yahoo.com', 'zilesz', '$2y$10$/PdA1XtxPx6WB.k4F2bhAOnFtbZfVpJm0rAz8PJlgBKHSRFm/qyCi', 'userimg_00000040.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `sid` int(11) NOT NULL,
  `linkizvoraslike` varchar(150) NOT NULL,
  `imeslike` varchar(50) NOT NULL,
  `kid` int(11) NOT NULL,
  `vremepostavljanja` varchar(50) NOT NULL,
  `javnaprivatna` varchar(50) NOT NULL,
  `sortid` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `statusi`
--

CREATE TABLE `statusi` (
  `tid` int(11) NOT NULL,
  `kid` int(11) NOT NULL,
  `tekststatusa` varchar(140) DEFAULT NULL,
  `vremepostavljanja` varchar(50) NOT NULL,
  `sortid` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentari_slike`
--
ALTER TABLE `komentari_slike`
  ADD PRIMARY KEY (`komid`),
  ADD KEY `SID` (`sid`),
  ADD KEY `KID` (`kid`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`kid`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `KID` (`kid`);

--
-- Indexes for table `statusi`
--
ALTER TABLE `statusi`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `KID` (`kid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentari_slike`
--
ALTER TABLE `komentari_slike`
  MODIFY `komid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `kid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statusi`
--
ALTER TABLE `statusi`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari_slike`
--
ALTER TABLE `komentari_slike`
  ADD CONSTRAINT `komentar_korisnicki_ID` FOREIGN KEY (`KID`) REFERENCES `korisnici` (`KID`),
  ADD CONSTRAINT `komentari_slike_ibfk_1` FOREIGN KEY (`SID`) REFERENCES `slike` (`SID`);

--
-- Constraints for table `slike`
--
ALTER TABLE `slike`
  ADD CONSTRAINT `slike_ibfk_1` FOREIGN KEY (`KID`) REFERENCES `korisnici` (`KID`);

--
-- Constraints for table `statusi`
--
ALTER TABLE `statusi`
  ADD CONSTRAINT `statusi_ibfk_1` FOREIGN KEY (`KID`) REFERENCES `korisnici` (`KID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
