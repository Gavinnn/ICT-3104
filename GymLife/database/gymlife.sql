-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2017 at 07:42 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
  `trainingID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `numberOfParticipants` int(11) NOT NULL,
  `startSession` datetime NOT NULL,
  `endSession` datetime NOT NULL,
  `roomID` int(11) NOT NULL,
  `maxCapacity` int(11) NOT NULL,
  `sessionStatus` int(11) NOT NULL,
  `locationID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupsessions`
--

INSERT INTO `groupsessions` (`groupSessionID`, `trainerID`, `trainingID`, `title`, `numberOfParticipants`, `startSession`, `endSession`, `roomID`, `maxCapacity`, `sessionStatus`, `locationID`) VALUES
(1, 2, 1, 'Cardio X2', 2, '2017-11-13 17:00:00', '2017-11-13 18:00:00', 1, 2, 2, 1),
(2, 2, 1, 'Cardio X ', 0, '2017-11-12 17:00:00', '2017-11-12 18:00:00', 1, 50, 2, 1),
(3, 2, 1, 'Cardio EXTREME X', 0, '2017-11-15 18:00:00', '2017-11-15 19:00:00', 3, 12, 2, 1),
(11, 2, 1, 'Yoga', 0, '2017-11-21 09:00:00', '2017-11-21 10:00:00', 2, 50, 2, 4),
(12, 2, 1, 'Yoga', 0, '2017-11-22 09:00:00', '2017-11-22 10:00:00', 2, 50, 1, 4),
(13, 2, 1, 'Yoga', 0, '2017-11-23 09:00:00', '2017-11-23 10:00:00', 2, 50, 1, 4),
(15, 2, 1, 'Yoga', 0, '2017-11-25 09:00:00', '2017-11-25 10:00:00', 2, 50, 1, 4),
(16, 2, 1, 'Yoga', 0, '2017-11-26 09:00:00', '2017-11-26 10:00:00', 2, 50, 1, 4),
(17, 2, 1, 'Yoga', 0, '2017-11-27 09:00:00', '2017-11-27 10:00:00', 2, 50, 1, 4),
(18, 2, 1, 'Yoga', 0, '2017-11-28 09:00:00', '2017-11-28 10:00:00', 2, 50, 1, 4),
(19, 2, 1, 'Yoga', 0, '2017-11-29 09:00:00', '2017-11-29 10:00:00', 2, 50, 1, 4),
(20, 2, 1, 'Yoga', 0, '2017-11-30 09:00:00', '2017-11-30 10:00:00', 2, 50, 1, 4),
(21, 2, 2, 'Jog', 0, '2017-12-01 12:00:00', '2017-12-01 13:00:00', 3, 20, 1, 2),
(22, 2, 2, 'Jog', 0, '2017-12-03 12:00:00', '2017-12-03 13:00:00', 3, 20, 1, 2),
(23, 2, 2, 'Jog', 0, '2017-12-02 12:00:00', '2017-12-02 13:00:00', 3, 20, 1, 2),
(24, 2, 2, 'Jog', 0, '2017-12-04 12:00:00', '2017-12-04 13:00:00', 3, 20, 1, 2),
(25, 2, 2, 'Jog', 0, '2017-12-05 12:00:00', '2017-12-05 13:00:00', 3, 20, 1, 2),
(26, 2, 2, 'Jog', 0, '2017-12-06 12:00:00', '2017-12-06 13:00:00', 3, 20, 1, 2),
(27, 2, 2, 'Jog', 0, '2017-12-07 12:00:00', '2017-12-07 13:00:00', 3, 20, 1, 2),
(28, 2, 2, 'Jog', 0, '2017-12-08 12:00:00', '2017-12-08 13:00:00', 3, 20, 1, 2),
(29, 2, 2, 'Jog', 0, '2017-12-09 12:00:00', '2017-12-09 13:00:00', 3, 20, 1, 2),
(30, 2, 2, 'Jog', 0, '2017-12-10 12:00:00', '2017-12-10 13:00:00', 3, 20, 1, 2),
(31, 2, 2, 'Jog', 0, '2017-12-11 12:00:00', '2017-12-11 13:00:00', 3, 20, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `groupsessionstatus`
--

CREATE TABLE IF NOT EXISTS `groupsessionstatus` (
`statusID` int(11) NOT NULL,
  `statusName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupsessionstatus`
--

INSERT INTO `groupsessionstatus` (`statusID`, `statusName`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `gyms`
--

CREATE TABLE IF NOT EXISTS `gyms` (
`locationID` int(11) NOT NULL,
  `locationName` varchar(255) NOT NULL,
  `locationCapacity` int(11) NOT NULL,
  `locationAddress` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gyms`
--

INSERT INTO `gyms` (`locationID`, `locationName`, `locationCapacity`, `locationAddress`) VALUES
(1, 'Jurong East', 100, 'Jurong East Street 1'),
(2, 'AMK', 100, 'Ang Mo Kio Ave 1'),
(3, 'Choa Chu Kang', 100, 'Choa Chu Kang Ave 3'),
(4, 'Clementi', 100, 'Clementi');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `infoID` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`infoID`, `description`) VALUES
(1, 'Founded in 2017, September 8th, Gymlife is a self start up project by 4 ambitious minds. Muhammad, the CEO and founder of Gymlife, Dylan, the co founder of Gymlife , Gavin, the mastermind in organizing trainings and structure, Xiaoting and Troy, HR and PR of Gymlife. The goal of Gymlife is to give the best quality of physical trainings out there in the market.');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomID`, `locationID`, `roomName`, `roomCapacity`) VALUES
(1, 1, 'Dance Studio', 50),
(2, 2, 'Dance Studio', 50),
(3, 1, 'MPR1', 40),
(5, 2, 'MPR1', 50),
(6, 2, 'MPR2', 50);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`statusID` int(11) NOT NULL,
  `statusName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusID`, `statusName`) VALUES
(1, 'Unverified'),
(2, 'Verified'),
(3, 'Rejected'),
(4, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `traineegroupsession`
--

CREATE TABLE IF NOT EXISTS `traineegroupsession` (
  `groupSessionID` int(11) NOT NULL,
  `traineeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traineegroupsession`
--

INSERT INTO `traineegroupsession` (`groupSessionID`, `traineeID`) VALUES
(1, 3),
(1, 6);

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
  `traineeID` int(11) DEFAULT NULL,
  `locationID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `trainingID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainersessions`
--

INSERT INTO `trainersessions` (`sessionID`, `trainerID`, `title`, `startSession`, `endSession`, `traineeID`, `locationID`, `roomID`, `description`, `trainingID`) VALUES
(6, 2, 'Cardio I', '2017-10-27 20:00:00', '2017-10-27 21:00:00', 3, 1, 3, 'Training includes:\r\n1) High intensity interval sprints\r\n2) Static exercises', 1),
(7, 5, 'Crossfit I', '2017-10-27 21:00:00', '2017-10-27 22:00:00', 3, 2, 6, 'Do come 10 minutes early for warmups', 2),
(8, 2, 'Cardio II', '2017-10-28 16:30:00', '2017-10-28 17:30:00', NULL, 1, 1, 'Don''t forget to drink up', 1),
(9, 2, 'Cardio I', '2017-11-16 20:00:00', '2017-11-16 21:00:00', NULL, 1, 1, 'Training!', 1),
(11, 2, 'Cardio II', '2017-11-17 20:00:00', '2017-11-17 21:00:00', 3, 1, 1, 'Training!', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE IF NOT EXISTS `trainings` (
`trainingID` int(11) NOT NULL,
  `trainingType` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cost` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`trainingID`, `trainingType`, `description`, `cost`) VALUES
(1, 'Cardio', 'Intense workout', 20),
(2, 'Crossfit', 'Workout abs', 50),
(3, 'Leg day', 'Running', 10),
(4, 'Dance', 'Pilates', 10),
(5, 'Cardio', 'Running', 10),
(6, 'Exercise', 'Running', 10),
(7, 'Exercise', 'Dance and hop', 10),
(8, 'Dance', 'Hot workout', 10);

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
  `status` int(11) NOT NULL,
  `passwordChange` bit(1) NOT NULL,
  `personalTrainerID` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `roleID`, `name`, `userName`, `email`, `contactNumber`, `password`, `status`, `passwordChange`, `personalTrainerID`) VALUES
(1, 1, 'Dylan', 'admin', 'muhammadbna@gmail.com', 99999999, '61775b8dba79b3c9ed889786b97508bd', 2, b'1', 0),
(2, 2, 'Bob', 'trainer', 'md62_md62@hotmail.com.com', 11111111, '61775b8dba79b3c9ed889786b97508bd', 2, b'1', 0),
(3, 3, 'Muhammad', 'trainee', 'test1@hotmail.com', 22222222, '61775b8dba79b3c9ed889786b97508bd', 2, b'1', 0),
(5, 2, 'Jamie', 'trainer1', 'test4@hotmail.com', 44444444, '61775b8dba79b3c9ed889786b97508bd', 2, b'1', 0),
(6, 3, 'Max', 'trainee1', 'test2@gmail.com', 22222222, '61775b8dba79b3c9ed889786b97508bd', 2, b'1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupsessions`
--
ALTER TABLE `groupsessions`
 ADD PRIMARY KEY (`groupSessionID`), ADD KEY `trainerID` (`trainerID`), ADD KEY `roomID` (`roomID`), ADD KEY `trainingID` (`trainingID`), ADD KEY `FK` (`sessionStatus`), ADD KEY `sessionStatus` (`sessionStatus`), ADD KEY `locationIDFK` (`locationID`);

--
-- Indexes for table `groupsessionstatus`
--
ALTER TABLE `groupsessionstatus`
 ADD PRIMARY KEY (`statusID`);

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
 ADD PRIMARY KEY (`roomID`), ADD KEY `locationID` (`locationID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `traineegroupsession`
--
ALTER TABLE `traineegroupsession`
 ADD PRIMARY KEY (`groupSessionID`,`traineeID`), ADD KEY `groupSessionID` (`groupSessionID`), ADD KEY `groupSessionID_2` (`groupSessionID`), ADD KEY `traineeForeignKey` (`traineeID`);

--
-- Indexes for table `trainersessions`
--
ALTER TABLE `trainersessions`
 ADD PRIMARY KEY (`sessionID`), ADD KEY `trainerID` (`trainerID`), ADD KEY `traineeID` (`traineeID`), ADD KEY `trainerID_2` (`trainerID`), ADD KEY `trainerID_3` (`trainerID`), ADD KEY `trainerID_4` (`trainerID`), ADD KEY `locationID` (`locationID`), ADD KEY `roomID` (`roomID`), ADD KEY `trainingConstraint` (`trainingID`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
 ADD PRIMARY KEY (`trainingID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userID`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `userName` (`userName`), ADD UNIQUE KEY `email_2` (`email`), ADD KEY `status` (`status`), ADD KEY `roleID` (`roleID`), ADD KEY `status_2` (`status`), ADD KEY `roleID_2` (`roleID`), ADD KEY `personalTrainerID` (`personalTrainerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupsessions`
--
ALTER TABLE `groupsessions`
MODIFY `groupSessionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `groupsessionstatus`
--
ALTER TABLE `groupsessionstatus`
MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gyms`
--
ALTER TABLE `gyms`
MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trainersessions`
--
ALTER TABLE `trainersessions`
MODIFY `sessionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
MODIFY `trainingID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `groupsessions`
--
ALTER TABLE `groupsessions`
ADD CONSTRAINT `locationIDFK` FOREIGN KEY (`locationID`) REFERENCES `gyms` (`locationID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `roomIDFK` FOREIGN KEY (`roomID`) REFERENCES `rooms` (`roomID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `statusFK` FOREIGN KEY (`sessionStatus`) REFERENCES `groupsessionstatus` (`statusID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `trainerIDForeignKey` FOREIGN KEY (`trainerID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `trainingID` FOREIGN KEY (`trainingID`) REFERENCES `trainings` (`trainingID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
ADD CONSTRAINT `locationConstraint` FOREIGN KEY (`locationID`) REFERENCES `gyms` (`locationID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `roomConstraint` FOREIGN KEY (`roomID`) REFERENCES `rooms` (`roomID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `traineeIDFK` FOREIGN KEY (`traineeID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `trainerIDFK` FOREIGN KEY (`trainerID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `trainingConstraint` FOREIGN KEY (`trainingID`) REFERENCES `trainings` (`trainingID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `roleIDForeignKey` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `statusIDForeignKey` FOREIGN KEY (`status`) REFERENCES `status` (`statusID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
