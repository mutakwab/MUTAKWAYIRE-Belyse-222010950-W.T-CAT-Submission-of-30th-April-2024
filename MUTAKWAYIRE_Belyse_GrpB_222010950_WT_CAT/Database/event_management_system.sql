-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 12:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendee`
--

CREATE TABLE `attendee` (
  `attendee_id` int(11) NOT NULL,
  `organizer_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `registration_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendee`
--

INSERT INTO `attendee` (`attendee_id`, `organizer_id`, `name`, `email`, `registration_status`) VALUES
(1, 3, 'John Doe', 'johndo@gmail.com', 'registered'),
(2, 6, 'nelly habiri', 'habnelly@gmail.com', 'pending'),
(3, 1, 'yuhi mutesi', 'mutesyuhi@gmail.com', 'registered'),
(4, 2, 'byungura', 'byungur@gmail.com', 'pending'),
(5, 5, 'winner daxon', 'winnerd@gmail', 'waiting');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `title`, `description`, `date`, `location`) VALUES
(1, 'Conference', 'Annual conference for tech enthusiast', '2024-04-10', 'New York'),
(2, 'Workshop', 'Hands-on workshop on machine learning', '2024-04-01', 'San Francisco'),
(3, 'Seminar', 'Discussion on latest trends in cybersecurity', '2023-01-10', 'London'),
(4, 'Networking Event', 'Opportunity to network with industry professionals', '2024-01-18', 'Tokyo'),
(6, 'history of africa', 'conference about history', '2024-04-06', 'kenya');

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `organizer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `billing_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`organizer_id`, `name`, `contact_email`, `billing_info`) VALUES
(1, 'Event Solutions LLC', 'info@eventsolutions.com', '123 Main Street, Suite 100, Anytown, USA'),
(2, 'Big Event Planning Company', 'contact@bigeventplanning.com', '456 Park Avenue, Floor 20, Metropolis, USA'),
(3, 'Elite Conference Management', 'info@eliteconferences.com', '789 Business Boulevard, Suite 50, Megacity, USA'),
(4, 'Global Summit Organizers', 'contact@globalsummitorganizers.com', '321 Corporate Plaza, 5th Floor, Cityville, USA'),
(5, 'tity brown', 'titybrown@gmail.com', '134 zenit st petersbrg, Russia'),
(6, 'sdfghj', 'sdfg@gmail.com', 'uwdefyrdsghfdghb');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `title`, `start_time`, `end_time`, `event_id`) VALUES
(1, 'Keynote Address', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6),
(3, 'werty', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4),
(4, '\'Introduction to Machine Learnin', '2024-04-06 11:36:00', '2024-05-10 23:37:00', 3),
(5, 'Cybersecurity Best Practices', '2023-09-06 11:32:00', '2024-02-29 23:32:00', 1),
(6, 'Networking Session', '2024-04-05 11:33:00', '2024-05-04 23:36:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `speaker`
--

CREATE TABLE `speaker` (
  `speaker_id` int(11) NOT NULL,
  `attendee_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `speaker`
--

INSERT INTO `speaker` (`speaker_id`, `attendee_id`, `name`, `bio`, `contact_email`) VALUES
(1, 2, 'Gaju Lenatha', 'Gaju is best child and be patient person.', 'lenagaju@gmail.com'),
(2, 3, 'Jane Smith', 'Jane Smith is a renowned expert in business strategy.', 'jane.smith@example.com'),
(3, 4, 'Michael Johnson', 'Michael Johnson has a background in finance and entrepreneurship.', 'michael.johnson@example.com'),
(4, 1, 'Emily Brown', 'Emily Brown specializes in marketing and branding.', 'emily.brown@gmailexample.com'),
(5, 5, 'David Lee', 'David Lee is an accomplished speaker in leadership and management.', 'david.lee@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'mutakwayire', 'belyse', 'belyse5', 'belysemutakway@gmail.com', '07854443213', '$2y$10$2wQM9qRrU0sjmI2zb.JKSOE9PlsRjpXZd6cYP5V0J3SWx71WQvKsi', '2024-04-24 03:36:30', '3443', 0),
(2, 'domina', 'grace', 'domina', 'dodogr@gmail.com', '0734567890', '$2y$10$KeAmehESPXCgTavIptxKp.IDZriN1.WA3yzgg8wZadYDkEMHd9XWC', '2024-04-28 22:10:16', '888999', 0);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venue_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `name`, `address`, `capacity`) VALUES
(1, 'Kigali Alena House', 'Remera', 700),
(2, 'Grand Ballroom', '123 Main Street, Anytown, USA', 500),
(3, 'Kigali Convention Centre', 'KG 2 Roundabout, Kigali, Rwanda', 600),
(4, 'Accra International Conference Centre', 'Castle Road, Accra, Ghana', 7000),
(5, 'Pyramids Conference Center', 'Giza Plateau, Al Haram, Egypt', 500),
(6, 'Cape Town Convention Centre', '1 Lower Long Street, Cape Town, South Africa', 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendee`
--
ALTER TABLE `attendee`
  ADD PRIMARY KEY (`attendee_id`),
  ADD KEY `organizer_id` (`organizer_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`organizer_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `speaker`
--
ALTER TABLE `speaker`
  ADD PRIMARY KEY (`speaker_id`),
  ADD KEY `attendee_id` (`attendee_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendee`
--
ALTER TABLE `attendee`
  MODIFY `attendee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `organizer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `speaker`
--
ALTER TABLE `speaker`
  MODIFY `speaker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendee`
--
ALTER TABLE `attendee`
  ADD CONSTRAINT `attendee_ibfk_1` FOREIGN KEY (`organizer_id`) REFERENCES `organizer` (`organizer_id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`);

--
-- Constraints for table `speaker`
--
ALTER TABLE `speaker`
  ADD CONSTRAINT `speaker_ibfk_1` FOREIGN KEY (`attendee_id`) REFERENCES `attendee` (`attendee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
