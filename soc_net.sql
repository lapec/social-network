-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2018 at 12:16 PM
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
  `KomID` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `KID` int(11) NOT NULL,
  `Komentar` varchar(255) NOT NULL,
  `VremePostavljanja` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `KID` int(11) NOT NULL,
  `Ime` varchar(50) NOT NULL,
  `Prezime` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `KorisnickoIme` varchar(50) NOT NULL,
  `Lozinka` varchar(550) NOT NULL,
  `SlikaKorisnika` varchar(50) NOT NULL DEFAULT 'generic_profile_img.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`KID`, `Ime`, `Prezime`, `Email`, `KorisnickoIme`, `Lozinka`, `SlikaKorisnika`) VALUES
(1, 'Milan', 'Rakić', 'milan@gmail.com', 'milanR', '$2y$10$Q2hcDBYXKBceFKfj9Pzf4.nukr9zDQWUsKVgcMt.gp8h3LwNdRZyi', 'profile.gif'),
(2, 'Miloš', 'Crnjanski', 'mcrnjanski@gmail.com', 'MCrnjanski', '$2y$10$Q2hcDBYXKBceFKfj9Pzf4.nukr9zDQWUsKVgcMt.gp8h3LwNdRZyi', 'user.jpg'),
(3, 'Ruzica', 'Vukovic', 'ruzica@gmail.com', 'Ruza', '135790', 'female-profile-img.jpg'),
(4, 'Rajko', 'Vukovic', 'rajko@gmail.com', 'Rajkoo', '135232943', 'petprofilepic.png'),
(25, 'Boban', 'Lapcevic', 'bobanlapcevic@gmail.com', 'lab', '$2y$10$Q2hcDBYXKBceFKfj9Pzf4.nukr9zDQWUsKVgcMt.gp8h3LwNdRZyi', 'generic_profile_img.png'),
(26, 'Nikola', 'Tesla', 'ntesla@gmail.com', 'ntesla', '$2y$10$ID2VW.BCcmJSWG6r4gfM4eGVOH2/2cCdenyJPBOAfsbutY8bNRFWi', 'generic_profile_img.png'),
(36, 't', 't', 't', 't', '$2y$10$opmiSv5K6pwKbCnwxdy79.F5G8ZULaTVPSqqRqOOsKc.TWz2T1N5a', 'generic_profile_img.png'),
(37, 'Dare', 'Mačužić', 'duca.yu@gmail.com', 'dacha.yu', '$2y$10$avghmldw85.VsuN4eAvBVe4i84p.rXf4C/.Y7SquqO09.Ai0AB3ZG', 'userimg_00000037.jpg'),
(38, 'Lena', 'Macuzic', 'lenamm@gmail.com', 'lenamm', '$2y$10$Di0WbZz4LfabezwDc7y3HegHxvpKIS26Db4zaEeNp65YuGUNYmR5.', 'generic_profile_img.png'),
(39, 'Marija', 'Macuzic', 'marija634@hotmail.com', 'marija634', '$2y$10$T5J9FuVJygxTo7HqanhfneDRjciHd0u6jzIvp.mWJxEIFN.RA0lDK', 'generic_profile_img.png');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `SID` int(11) NOT NULL,
  `LinkIzvoraSlike` varchar(150) NOT NULL,
  `ImeSlike` varchar(50) NOT NULL,
  `KID` int(11) NOT NULL,
  `VremePostavljanja` varchar(50) NOT NULL,
  `JavnaPrivatna` varchar(50) NOT NULL,
  `SortID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`SID`, `LinkIzvoraSlike`, `ImeSlike`, `KID`, `VremePostavljanja`, `JavnaPrivatna`, `SortID`) VALUES
(22, 'uploads/robot-03.png', 'robot-03.png', 25, '1539439833', '1', ''),
(23, 'uploads/42196373_612610462474065_1780929891756146688_n.jpg', '42196373_612610462474065_1780929891756146688_n.jpg', 25, '1539439847', '1', ''),
(24, 'uploads/robot-02.png', 'robot-02.png', 25, '1539439981', '1', ''),
(25, 'uploads/WIN_20181013_16_40_57_Pro.jpg', 'WIN_20181013_16_40_57_Pro.jpg', 25, '1539441676', '1', ''),
(26, 'uploads/soc_net_mockup.PNG', 'soc_net_mockup.PNG', 25, '1539441725', '1', ''),
(27, 'uploads/44b2d54446630320fce43a52f9554d5c--all-video-team-.jpg', '44b2d54446630320fce43a52f9554d5c--all-video-team-.', 25, '1539442154', '1', ''),
(28, 'uploads/wall.png', 'wall.png', 25, '1539459303', '1', ''),
(29, 'uploads/wall - Copy.png', 'wall - Copy.png', 25, '1539459335', '0', ''),
(30, 'uploads/wall - Copy-c.png', 'wall - Copy-c.png', 25, '1539459496', '0', ''),
(31, 'img/', '', 1, '22.10.2018 12:15:50', '0', ''),
(32, 'img/', '', 25, '23.10.2018 10:15:12', '0', ''),
(33, 'img/skeleton.png', 'skeleton.png', 25, '23.10.2018 10:17:43', '0', ''),
(34, 'img/skeleton.png', 'skeleton.png', 25, '23.10.2018 10:31:52', '0', ''),
(35, 'img/', '', 25, '23.10.2018 10:32:07', '0', ''),
(36, 'img/skeleton.png', 'skeleton.png', 25, '1540542374', '0', ''),
(37, 'img/basketball.jpg', 'basketball.jpg', 25, '1540542516', '0', ''),
(38, 'img/basketball.jpg', 'basketball.jpg', 25, '1540542550', '0', ''),
(39, 'img/basketball.jpg', 'basketball.jpg', 25, '1540542585', '0', ''),
(40, 'img/basketball.jpg', 'basketball.jpg', 25, '1540542650', '0', ''),
(41, 'img/basketball.jpg', 'basketball.jpg', 25, '1540542699', '0', ''),
(42, 'img/basketball.jpg', 'basketball.jpg', 25, '1540542763', '0', ''),
(43, 'img/basketball.jpg', 'basketball.jpg', 25, '1540542780', '0', ''),
(44, 'img/basketball.jpg', 'basketball.jpg', 25, '1540542808', '0', ''),
(47, 'img/basketball.jpg', 'basketball.jpg', 25, '26/10/18 11:23:03', '0', ''),
(48, 'img/dfsdf.jpg', 'dfsdf.jpg', 37, '26/10/18 13:09:15', '0', '1540552155'),
(49, 'img/dfsdf.jpg', 'dfsdf.jpg', 37, '26/10/18 13:32:56', '0', '1540553576'),
(50, 'img/dfsdf.jpg', 'dfsdf.jpg', 37, '26/10/18 13:37:03', '0', '1540553823');

-- --------------------------------------------------------

--
-- Table structure for table `statusi`
--

CREATE TABLE `statusi` (
  `TID` int(11) NOT NULL,
  `KID` int(11) NOT NULL,
  `TekstStatusa` varchar(140) DEFAULT NULL,
  `VremePostavljanja` varchar(50) NOT NULL,
  `SortID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statusi`
--

INSERT INTO `statusi` (`TID`, `KID`, `TekstStatusa`, `VremePostavljanja`, `SortID`) VALUES
(59, 25, 'aaaaaaaaaaaaaaa', '1539439662', '0'),
(60, 25, '', '1539439717', '0'),
(61, 25, '', '1539439833', '0'),
(62, 25, 'fdgfdgdf', '1539439839', '0'),
(63, 25, '', '1539439847', '0'),
(64, 25, 'sandokan', '1539439975', '0'),
(65, 25, '', '1539439981', '0'),
(66, 25, 'novi neki status', '1539441633', '0'),
(67, 25, 'novi neki status sa slikom', '1539441676', '0'),
(68, 25, '', '1539441725', '0'),
(69, 25, '', '1539442154', '0'),
(70, 25, 'TRGTR', '1539442622', '0'),
(71, 25, 'Test', '1539459303', '0'),
(72, 25, '', '1539459335', '0'),
(73, 25, 'Test privatna 2', '1539459496', '0'),
(75, 26, 'asdasdasda', '22/10/2018 12:08', '0'),
(76, 1, 'cuihasidoas', '22.10.2018 12:15:50', '0'),
(77, 25, '', '23.10.2018 10:15:12', '0'),
(78, 25, '', '23.10.2018 10:17:43', '0'),
(79, 25, '', '23.10.2018 10:31:52', '0'),
(80, 25, 'status 123', '23.10.2018 10:32:07', '0'),
(81, 25, '', '1540466634', '0'),
(82, 25, '', '1540466641', '0'),
(83, 25, '', '1540466655', '0'),
(84, 25, '', '1540466701', '0'),
(85, 25, '', '1540466836', '0'),
(86, 25, '', '1540467029', '0'),
(87, 25, '', '1540467270', '0'),
(88, 25, '', '1540467294', '0'),
(89, 25, '', '1540467308', '0'),
(90, 25, '', '1540467441', '0'),
(91, 25, '', '1540467543', '0'),
(92, 25, '', '1540467624', '0'),
(93, 25, 'asdjgioasdf', '26.10.2018 10:22:14', '0'),
(94, 25, 'asd123dsasd123', '1540542266', '0'),
(95, 25, '', '1540542319', '0'),
(96, 25, '', '1540542374', '0'),
(97, 25, 'saldfdoijasdf', '1540542532', '0'),
(98, 25, 'df;adsfasodifwaer', '1540542550', '0'),
(99, 25, 'asddfasdf', '1540542585', '0'),
(100, 25, 'iopdjfasdf', '1540542699', '0'),
(101, 25, 'iasjdpjdfasdf', '26/10/18 11:18:23', '0'),
(102, 37, '', '26/10/18 13:09:15', '1540552155'),
(103, 37, 'aaaaaaaa', '26/10/18 13:09:20', '1540552160'),
(104, 37, '', '26/10/18 13:24:00', '1540553040'),
(105, 37, 'ssssss', '26/10/18 13:24:12', '1540553052'),
(106, 37, '', '26/10/18 13:32:56', '1540553576'),
(107, 37, '', '26/10/18 13:33:07', '1540553587'),
(108, 37, '', '26/10/18 13:33:19', '1540553599'),
(109, 37, 'aaaaaaaaaaaaaaa', '26/10/18 13:34:06', '1540553646'),
(110, 37, '', '26/10/18 13:36:38', '1540553798'),
(111, 37, 'aaaaaa', '26/10/18 13:36:52', '1540553812'),
(112, 37, 'cccccc', '26/10/18 13:36:57', '1540553817'),
(113, 37, '', '26/10/18 13:37:03', '1540553823'),
(114, 37, 'jedddddd', '26/10/18 13:44:41', '1540554281'),
(115, 37, '', '26/10/18 13:44:50', '1540554290'),
(116, 37, '', '26/10/18 13:44:59', '1540554299'),
(117, 37, '', '26/10/18 13:45:27', '1540554327'),
(118, 37, '', '26/10/18 13:47:34', '1540554454'),
(119, 37, '', '26/10/18 13:47:40', '1540554460');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentari_slike`
--
ALTER TABLE `komentari_slike`
  ADD PRIMARY KEY (`KomID`),
  ADD KEY `SID` (`SID`),
  ADD KEY `KID` (`KID`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`KID`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`SID`),
  ADD KEY `KID` (`KID`);

--
-- Indexes for table `statusi`
--
ALTER TABLE `statusi`
  ADD PRIMARY KEY (`TID`),
  ADD KEY `KID` (`KID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentari_slike`
--
ALTER TABLE `komentari_slike`
  MODIFY `KomID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `KID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `statusi`
--
ALTER TABLE `statusi`
  MODIFY `TID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

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
