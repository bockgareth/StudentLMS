-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2018 at 08:40 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `assess_no` int(11) NOT NULL,
  `subj_num` int(11) DEFAULT NULL,
  `assess_num` int(11) DEFAULT NULL,
  `date_no` int(11) DEFAULT NULL,
  `assess_tot_marks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assessment_type`
--

CREATE TABLE `assessment_type` (
  `assess_num` int(11) NOT NULL,
  `assess_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assessment_venue`
--

CREATE TABLE `assessment_venue` (
  `assess_no` int(11) NOT NULL,
  `ven_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `student_no` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `date_no` int(11) NOT NULL,
  `full_date` date NOT NULL,
  `time_date` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `emp_id` int(11) NOT NULL,
  `lect_office_no` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_subject`
--

CREATE TABLE `lecturer_subject` (
  `emp_id` int(11) NOT NULL,
  `subj_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `security`
--

CREATE TABLE `security` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `security_officer`
--

CREATE TABLE `security_officer` (
  `emp_id` int(11) NOT NULL,
  `sec_photo` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(15) NOT NULL,
  `emp_password` text NOT NULL,
  `emp_type` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_no` int(11) NOT NULL,
  `stud_name` varchar(25) NOT NULL,
  `stud_email` varchar(50) DEFAULT NULL,
  `stud_password` text NOT NULL,
  `stud_photo` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `student_no` int(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `present` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_register`
--

CREATE TABLE `student_register` (
  `stud_no` int(11) NOT NULL,
  `assess_no` int(11) NOT NULL,
  `placement` varchar(5) DEFAULT NULL,
  `present` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subj_num` int(11) NOT NULL,
  `subj_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_code`
--

CREATE TABLE `subject_code` (
  `subj_id` int(11) NOT NULL,
  `subj_num` int(11) NOT NULL,
  `subj_code` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `ven_no` int(11) NOT NULL,
  `ven_room_num` varchar(5) NOT NULL,
  `ven_capacity` int(11) DEFAULT NULL,
  `ven_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `venue_type`
--

CREATE TABLE `venue_type` (
  `ven_type_id` int(11) NOT NULL,
  `ven_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`assess_no`),
  ADD KEY `subj_num` (`subj_num`),
  ADD KEY `assess_num` (`assess_num`),
  ADD KEY `date_no` (`date_no`);

--
-- Indexes for table `assessment_type`
--
ALTER TABLE `assessment_type`
  ADD PRIMARY KEY (`assess_num`);

--
-- Indexes for table `assessment_venue`
--
ALTER TABLE `assessment_venue`
  ADD PRIMARY KEY (`assess_no`,`ven_no`),
  ADD KEY `ven_no` (`ven_no`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`date_no`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `lecturer_subject`
--
ALTER TABLE `lecturer_subject`
  ADD PRIMARY KEY (`emp_id`,`subj_num`),
  ADD KEY `subj_num` (`subj_num`);

--
-- Indexes for table `security`
--
ALTER TABLE `security`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_officer`
--
ALTER TABLE `security_officer`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_no`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_register`
--
ALTER TABLE `student_register`
  ADD PRIMARY KEY (`stud_no`,`assess_no`),
  ADD KEY `assess_no` (`assess_no`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subj_num`);

--
-- Indexes for table `subject_code`
--
ALTER TABLE `subject_code`
  ADD PRIMARY KEY (`subj_id`),
  ADD KEY `subj_num` (`subj_num`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`ven_no`),
  ADD KEY `ven_type_id` (`ven_type_id`);

--
-- Indexes for table `venue_type`
--
ALTER TABLE `venue_type`
  ADD PRIMARY KEY (`ven_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `assess_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessment_type`
--
ALTER TABLE `assessment_type`
  MODIFY `assess_num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
  MODIFY `date_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `security`
--
ALTER TABLE `security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subj_num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_code`
--
ALTER TABLE `subject_code`
  MODIFY `subj_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `ven_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venue_type`
--
ALTER TABLE `venue_type`
  MODIFY `ven_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `staff` (`emp_id`);

--
-- Constraints for table `assessment`
--
ALTER TABLE `assessment`
  ADD CONSTRAINT `assessment_ibfk_1` FOREIGN KEY (`subj_num`) REFERENCES `subject` (`subj_num`),
  ADD CONSTRAINT `assessment_ibfk_2` FOREIGN KEY (`assess_num`) REFERENCES `assessment_type` (`assess_num`),
  ADD CONSTRAINT `assessment_ibfk_3` FOREIGN KEY (`date_no`) REFERENCES `dates` (`date_no`);

--
-- Constraints for table `assessment_venue`
--
ALTER TABLE `assessment_venue`
  ADD CONSTRAINT `assess_no` FOREIGN KEY (`assess_no`) REFERENCES `assessment` (`assess_no`),
  ADD CONSTRAINT `ven_no` FOREIGN KEY (`ven_no`) REFERENCES `venue` (`ven_no`);

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `lecturer_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `staff` (`emp_id`);

--
-- Constraints for table `lecturer_subject`
--
ALTER TABLE `lecturer_subject`
  ADD CONSTRAINT `lecturer_subject_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `lecturer` (`emp_id`),
  ADD CONSTRAINT `lecturer_subject_ibfk_2` FOREIGN KEY (`subj_num`) REFERENCES `subject` (`subj_num`);

--
-- Constraints for table `security_officer`
--
ALTER TABLE `security_officer`
  ADD CONSTRAINT `security_officer_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `staff` (`emp_id`);

--
-- Constraints for table `student_register`
--
ALTER TABLE `student_register`
  ADD CONSTRAINT `student_register_ibfk_1` FOREIGN KEY (`stud_no`) REFERENCES `student` (`stud_no`),
  ADD CONSTRAINT `student_register_ibfk_2` FOREIGN KEY (`assess_no`) REFERENCES `assessment` (`assess_no`);

--
-- Constraints for table `subject_code`
--
ALTER TABLE `subject_code`
  ADD CONSTRAINT `subj_num` FOREIGN KEY (`subj_num`) REFERENCES `subject` (`subj_num`);

--
-- Constraints for table `venue`
--
ALTER TABLE `venue`
  ADD CONSTRAINT `ven_type_id` FOREIGN KEY (`ven_type_id`) REFERENCES `venue_type` (`ven_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
