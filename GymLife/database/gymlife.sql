-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2017 at 10:22 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymlife`
--

-- --------------------------------------------------------

--
-- Table structure for table `groupsessions`
--

CREATE TABLE IF NOT EXISTS `groupsessions` (
  `groupSessionID` int(11) NOT NULL,
  `trainerID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `numberOfParticipants` int(11) NOT NULL,
  `startSession` datetime NOT NULL,
  `roomID` int(11) NOT NULL,
  `maxCapacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gyms`
--

CREATE TABLE IF NOT EXISTS `gyms` (
  `locationID` int(11) NOT NULL,
  `locationName` varchar(255) NOT NULL,
  `locationCapacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `roleID` int(11) NOT NULL,
  `roleName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`) VALUES
(1, 'Admin'),
(2, 'Trainer'),
(3, 'Trainee');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `roomID` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `roomName` varchar(255) NOT NULL,
  `roomCapacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `statusID` int(11) NOT NULL,
  `statusName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusID`, `statusName`) VALUES
(1, 'Unverified'),
(2, 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `traineegroupsession`
--

CREATE TABLE IF NOT EXISTS `traineegroupsession` (
  `groupSessionID` int(11) NOT NULL,
  `traineeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trainersessions`
--

CREATE TABLE IF NOT EXISTS `trainersessions` (
  `sessionID` int(11) NOT NULL,
  `trainerID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `startSession` datetime NOT NULL,
  `endSession` datetime NOT NULL,
  `traineeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `userName` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactNumber` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `roleID`, `name`, `userName`, `email`, `contactNumber`, `password`, `status`) VALUES
(1, 1, 'Dylan', 'Dylan', 'deeeeeeeeeeelan@hotmail.com', 99999999, '123123123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupsessions`
--
ALTER TABLE `groupsessions`
  ADD PRIMARY KEY (`groupSessionID`),
  ADD KEY `trainerID` (`trainerID`),
  ADD KEY `roomID` (`roomID`);

--
-- Indexes for table `gyms`
--
ALTER TABLE `gyms`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomID`),
  ADD KEY `locationID` (`locationID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `traineegroupsession`
--
ALTER TABLE `traineegroupsession`
  ADD PRIMARY KEY (`groupSessionID`,`traineeID`),
  ADD KEY `groupSessionID` (`groupSessionID`),
  ADD KEY `groupSessionID_2` (`groupSessionID`),
  ADD KEY `traineeForeignKey` (`traineeID`);

--
-- Indexes for table `trainersessions`
--
ALTER TABLE `trainersessions`
  ADD PRIMARY KEY (`sessionID`),
  ADD KEY `trainerID` (`trainerID`),
  ADD KEY `traineeID` (`traineeID`),
  ADD KEY `trainerID_2` (`trainerID`),
  ADD KEY `trainerID_3` (`trainerID`),
  ADD KEY `trainerID_4` (`trainerID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `status` (`status`),
  ADD KEY `roleID` (`roleID`),
  ADD KEY `status_2` (`status`),
  ADD KEY `roleID_2` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupsessions`
--
ALTER TABLE `groupsessions`
  MODIFY `groupSessionID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gyms`
--
ALTER TABLE `gyms`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `trainersessions`
--
ALTER TABLE `trainersessions`
  MODIFY `sessionID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `groupsessions`
--
ALTER TABLE `groupsessions`
  ADD CONSTRAINT `roomIDFK` FOREIGN KEY (`roomID`) REFERENCES `rooms` (`roomID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `trainerIDForeignKey` FOREIGN KEY (`trainerID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `Foreign Key` FOREIGN KEY (`locationID`) REFERENCES `gyms` (`locationID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `traineegroupsession`
--
ALTER TABLE `traineegroupsession`
  ADD CONSTRAINT `groupsessionFK` FOREIGN KEY (`groupSessionID`) REFERENCES `groupsessions` (`groupSessionID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `traineeForeignKey` FOREIGN KEY (`traineeID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `trainersessions`
--
ALTER TABLE `trainersessions`
  ADD CONSTRAINT `traineeIDFK` FOREIGN KEY (`traineeID`) REFERENCES `user` (`userID`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `trainerIDFK` FOREIGN KEY (`trainerID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `roleIDForeignKey` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `statusIDForeignKey` FOREIGN KEY (`status`) REFERENCES `status` (`statusID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
