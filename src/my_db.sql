-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 05:46 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `name` varchar(32) DEFAULT NULL,
  `regno` varchar(9) DEFAULT NULL,
  `answer1` varchar(512) DEFAULT NULL,
  `answer2` varchar(512) DEFAULT NULL,
  `answer3` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `user_id` varchar(32) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `num_events` decimal(10,0) DEFAULT NULL,
  `regno` varchar(9) DEFAULT NULL,
  `linkforimage` varchar(512) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `applications_open` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`user_id`, `name`, `num_events`, `regno`, `linkforimage`, `description`, `applications_open`) VALUES
('ACM', 'ACM', '3', '3', 'https://cdn.freebiesupply.com/logos/large/2x/acm-1-logo-png-transparent.png', 'THIS IS ACM VIT', 1),
('Linux User\'s Group', 'Linux User\'s Group', '2', '2', 'https://vitlug.com/static/logo-367fee276c5de2c707121906566ee25a.png', 'VIT-LUG conducts events on the use of Open Source Software which are open to non-club members as well. We publish blogs on medium and actively undertake building projects related to Linux, notable mentions of which include Arcadia Linux, an Arch based Linux distro.', 1),
('LUG', 'Linux Users Group', '54', '234098', 'https://vitlug.com/static/logo-367fee276c5de2c707121906566ee25a.png', 'LUG', 0),
('VinnovateIT', 'VinnovateIT', '2', '1', 'https://ik.imagekit.io/xlbzk26wac/images/vinnovateit_EgCI8Dhlv.jpeg', 'We are Vinnovate, the OFFICIAL lab of SITE school.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clublisting`
--

CREATE TABLE `clublisting` (
  `name` varchar(32) DEFAULT NULL,
  `question1` varchar(512) DEFAULT NULL,
  `question2` varchar(512) DEFAULT NULL,
  `question3` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clublisting`
--

INSERT INTO `clublisting` (`name`, `question1`, `question2`, `question3`) VALUES
('Linux Users Group', '', '', ''),
('VinnovateIT', '', '', ''),
('Linux User\'s Group', '', '', ''),
('ACM', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `club_domain`
--

CREATE TABLE `club_domain` (
  `user_id` varchar(32) DEFAULT NULL,
  `domain_offering` varchar(32) DEFAULT NULL,
  `seats_remaining` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club_domain`
--

INSERT INTO `club_domain` (`user_id`, `domain_offering`, `seats_remaining`) VALUES
('LUG', 'management', '0'),
('LUG', 'technical', '0'),
('VinnovateIT', 'design', '0'),
('VinnovateIT', 'management', '0'),
('VinnovateIT', 'technical', '0'),
('Linux User\'s Group', 'design', '0'),
('Linux User\'s Group', 'management', '0'),
('Linux User\'s Group', 'technical', '0'),
('ACM', 'management', '0'),
('ACM', 'technical', '0');

-- --------------------------------------------------------

--
-- Table structure for table `registered_club`
--

CREATE TABLE `registered_club` (
  `user_id` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `regno` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `user_id` varchar(32) DEFAULT NULL,
  `fname` varchar(64) DEFAULT NULL,
  `lname` varchar(64) DEFAULT NULL,
  `regno` varchar(9) NOT NULL,
  `age` decimal(10,0) DEFAULT NULL,
  `year_of_study` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`user_id`, `fname`, `lname`, `regno`, `age`, `year_of_study`) VALUES
('kushagra', 'Kushagra', '-', '20BIT0112', '19', '2');

-- --------------------------------------------------------

--
-- Table structure for table `student_interest`
--

CREATE TABLE `student_interest` (
  `user_id` varchar(32) DEFAULT NULL,
  `domains_of_interest` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(32) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `type`) VALUES
('ACM', '02b55e4f52388520bfe11f959f836e68', 'club'),
('kushagra', '8bb33820028dc9ed18e76e9a0a62fabe', 'student'),
('Linux User\'s Group', '9c07fa66f605b5c0e56339d4c9ac2045', 'club'),
('LUG', '9c07fa66f605b5c0e56339d4c9ac2045', 'club'),
('VinnovateIT', '6821c25e33e0f98d9568e7cd9764a07c', 'club');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD KEY `answers_name` (`name`),
  ADD KEY `answers_regno` (`regno`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`name`),
  ADD KEY `club_uid` (`user_id`);

--
-- Indexes for table `clublisting`
--
ALTER TABLE `clublisting`
  ADD KEY `clublisxting_name` (`name`);

--
-- Indexes for table `club_domain`
--
ALTER TABLE `club_domain`
  ADD KEY `domain_uid` (`user_id`);

--
-- Indexes for table `registered_club`
--
ALTER TABLE `registered_club`
  ADD PRIMARY KEY (`user_id`,`name`),
  ADD KEY `registered_name` (`name`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`regno`),
  ADD KEY `student_uid` (`user_id`);

--
-- Indexes for table `student_interest`
--
ALTER TABLE `student_interest`
  ADD KEY `interest_uid` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_name` FOREIGN KEY (`name`) REFERENCES `club` (`name`),
  ADD CONSTRAINT `answers_regno` FOREIGN KEY (`regno`) REFERENCES `student` (`regno`);

--
-- Constraints for table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `clublisting`
--
ALTER TABLE `clublisting`
  ADD CONSTRAINT `clublisting_name` FOREIGN KEY (`name`) REFERENCES `club` (`name`);

--
-- Constraints for table `club_domain`
--
ALTER TABLE `club_domain`
  ADD CONSTRAINT `domain_uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `registered_club`
--
ALTER TABLE `registered_club`
  ADD CONSTRAINT `registered_name` FOREIGN KEY (`name`) REFERENCES `club` (`name`),
  ADD CONSTRAINT `registered_uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `student_interest`
--
ALTER TABLE `student_interest`
  ADD CONSTRAINT `interest_uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
