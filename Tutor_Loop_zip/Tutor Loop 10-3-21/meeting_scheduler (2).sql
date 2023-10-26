-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2021 at 09:11 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meeting_scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `meeting_master`
--

CREATE TABLE `meeting_master` (
  `meeting_id` int(9) NOT NULL,
  `subject_fid` varchar(255) DEFAULT NULL,
  `teacher_fid` varchar(255) DEFAULT NULL,
  `meeting_date` date DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `reminder_time` varchar(255) DEFAULT NULL,
  `total_student` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 - Inactive , 1 - Active',
  `status_updated_by` int(11) DEFAULT NULL,
  `status_updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 - No , 1 - Yes',
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_master`
--

INSERT INTO `meeting_master` (`meeting_id`, `subject_fid`, `teacher_fid`, `meeting_date`, `start_time`, `end_time`, `reminder_time`, `total_student`, `status`, `status_updated_by`, `status_updated_on`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_deleted`, `deleted_by`) VALUES
(1, '1', '2', '2021-07-07', '12:45 PM', '1:45 PM', '10', '1', 1, NULL, NULL, 3, '2021-05-22 15:34:30', NULL, NULL, 0, NULL),
(2, '6', '2', '2021-07-30', '7:00 PM', '7:45 PM', '10', '1', 1, NULL, NULL, 2, '2021-07-17 19:00:41', NULL, NULL, 0, NULL),
(3, '2', '2', '2021-07-22', '7:15 PM', '7:45 PM', '10', '4', 1, NULL, NULL, 2, '2021-07-17 19:01:24', NULL, NULL, 0, NULL),
(4, '7', '16', '2021-07-28', '6:15 PM', '7:15 PM', '10', '1', 1, NULL, NULL, 2, '2021-07-17 19:01:54', NULL, NULL, 0, NULL),
(5, '5', '15', '2021-07-20', '7:15 PM', '8:00 PM', '10', '3', 1, NULL, NULL, NULL, '2021-07-17 19:04:56', NULL, NULL, 0, NULL),
(6, '5', '15', '2021-07-20', '8:15 PM', '9:00 PM', '10', '3', 1, NULL, NULL, NULL, '2021-07-17 19:05:20', NULL, NULL, 0, NULL),
(7, '5', '15', '2021-07-22', '7:15 PM', '9:15 PM', '10', '3', 1, NULL, NULL, 2, '2021-07-17 19:06:15', NULL, NULL, 0, NULL),
(8, '7', '16', '2021-07-21', '7:15 PM', '8:00 PM', '10', '1', 1, NULL, NULL, 2, '2021-07-17 19:06:50', NULL, NULL, 0, NULL),
(9, '7', '18', '2021-07-20', '5:15 PM', '6:15 PM', '10', '3', 1, NULL, NULL, 2, '2021-07-17 19:07:42', NULL, NULL, 0, NULL),
(10, '9', '2', '2021-07-20', '7:15 PM', '9:15 PM', '10', '3', 1, NULL, NULL, 2, '2021-07-17 19:11:34', NULL, NULL, 0, NULL),
(11, '2', '2', '2021-07-22', '3:15 PM', '4:15 PM', '10', '4', 1, NULL, NULL, 2, '2021-07-17 19:13:22', NULL, NULL, 0, NULL),
(12, '3', '2', '2021-07-29', '4:00 PM', '5:15 PM', '10', '3', 1, NULL, NULL, 2, '2021-07-17 19:14:01', NULL, NULL, 0, NULL),
(13, '6', '2', '2021-07-17', '6:15 PM', '7:15 PM', '10', '1', 1, NULL, NULL, 2, '2021-07-17 19:14:57', NULL, NULL, 0, NULL),
(14, '3', '2', '2021-07-24', '7:45 PM', '8:30 PM', '10', '3', 1, NULL, NULL, 2, '2021-07-21 19:38:18', NULL, NULL, 0, NULL),
(15, '8', '18', '2021-07-29', '7:15 PM', '7:45 PM', '12', '3', 1, NULL, NULL, 2, '2021-07-21 19:40:22', NULL, NULL, 0, NULL),
(16, '3', '2', '2021-08-12', '10:45 AM', '12:45 PM', '13', '1', 1, NULL, NULL, 2, '2021-07-26 11:41:37', 2, '2021-07-26 18:50:29', 0, NULL),
(17, '7', '16', '2021-07-29', '6:15 PM', '6:45 PM', '12', '1', 1, NULL, NULL, 2, '2021-07-26 18:37:43', NULL, NULL, 0, NULL),
(18, '5', '15', '2021-08-27', '6:15 PM', '7:00 PM', '12', '3', 1, NULL, NULL, 2, '2021-07-26 18:54:14', NULL, NULL, 0, NULL),
(19, '5', '15', '2021-08-04', '5:45 PM', '7:00 PM', '12', '2', 1, NULL, NULL, 2, '2021-07-26 18:56:38', NULL, NULL, 0, NULL),
(20, '2', '2', '2021-08-15', '9:30 PM', '10:30 PM', '0', '1', 0, 2, '2021-08-14 20:27:36', 2, '2021-08-14 20:23:55', NULL, NULL, 1, 2),
(21, '6', '2', '2021-08-25', '8:00 PM', '10:00 PM', '10', '1', 1, NULL, NULL, 2, '2021-08-19 21:49:41', NULL, NULL, 0, NULL),
(22, '2', '2', '2021-08-21', '9:00 PM', '10:00 PM', '10', '4', 1, NULL, NULL, 2, '2021-08-19 21:50:42', NULL, NULL, 0, NULL),
(23, '5', '15', '2021-08-26', '9:00 PM', '10:00 PM', '15', '6', 1, NULL, NULL, 15, '2021-08-19 21:59:06', NULL, NULL, 0, NULL),
(24, '2', '15', '2021-08-20', '10:00 PM', '11:00 PM', '10', '2', 1, NULL, NULL, 15, '2021-08-19 21:59:49', NULL, NULL, 0, NULL),
(25, '8', '15', '2021-08-23', '8:00 PM', '9:00 PM', '10', '1', 1, NULL, NULL, 15, '2021-08-19 22:00:13', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_student_master`
--

CREATE TABLE `meeting_student_master` (
  `meeting_student_id` int(9) NOT NULL,
  `meeting_fid` int(11) NOT NULL DEFAULT 0,
  `student_fid` int(11) NOT NULL DEFAULT 0,
  `ms_subject_fid` int(11) NOT NULL DEFAULT 0,
  `ms_teacher_fid` int(11) NOT NULL DEFAULT 0,
  `ms_meeting_date` date DEFAULT NULL,
  `ms_start_time` varchar(255) DEFAULT NULL,
  `ms_end_time` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 - Inactive , 1 - Active',
  `status_updated_by` int(11) DEFAULT NULL,
  `status_updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 - No , 1 - Yes',
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_student_master`
--

INSERT INTO `meeting_student_master` (`meeting_student_id`, `meeting_fid`, `student_fid`, `ms_subject_fid`, `ms_teacher_fid`, `ms_meeting_date`, `ms_start_time`, `ms_end_time`, `status`, `status_updated_by`, `status_updated_on`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_deleted`, `deleted_by`) VALUES
(1, 1, 1, 1, 2, '2021-07-07', '12:45 PM', '1:45 PM', 1, NULL, NULL, 3, '2021-05-22 15:34:30', NULL, NULL, 0, NULL),
(2, 2, 14, 6, 2, '2021-07-30', '7:00 PM', '7:45 PM', 1, NULL, NULL, 2, '2021-07-17 19:00:41', NULL, NULL, 0, NULL),
(3, 3, 7, 2, 2, '2021-07-22', '7:15 PM', '7:45 PM', 1, NULL, NULL, 2, '2021-07-17 19:01:24', NULL, NULL, 0, NULL),
(4, 3, 10, 2, 2, '2021-07-22', '7:15 PM', '7:45 PM', 1, NULL, NULL, 2, '2021-07-17 19:01:24', NULL, NULL, 0, NULL),
(5, 3, 6, 2, 2, '2021-07-22', '7:15 PM', '7:45 PM', 1, NULL, NULL, 2, '2021-07-17 19:01:24', NULL, NULL, 0, NULL),
(6, 3, 1, 2, 2, '2021-07-22', '7:15 PM', '7:45 PM', 1, NULL, NULL, 2, '2021-07-17 19:01:24', NULL, NULL, 0, NULL),
(7, 4, 6, 7, 16, '2021-07-28', '6:15 PM', '7:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:01:54', NULL, NULL, 0, NULL),
(8, 5, 5, 5, 15, '2021-07-20', '7:15 PM', '8:00 PM', 1, NULL, NULL, NULL, '2021-07-17 19:04:56', NULL, NULL, 0, NULL),
(9, 5, 10, 5, 15, '2021-07-20', '7:15 PM', '8:00 PM', 1, NULL, NULL, NULL, '2021-07-17 19:04:56', NULL, NULL, 0, NULL),
(10, 5, 8, 5, 15, '2021-07-20', '7:15 PM', '8:00 PM', 1, NULL, NULL, NULL, '2021-07-17 19:04:56', NULL, NULL, 0, NULL),
(11, 6, 5, 5, 15, '2021-07-20', '8:15 PM', '9:00 PM', 1, NULL, NULL, NULL, '2021-07-17 19:05:20', NULL, NULL, 0, NULL),
(12, 6, 10, 5, 15, '2021-07-20', '8:15 PM', '9:00 PM', 1, NULL, NULL, NULL, '2021-07-17 19:05:20', NULL, NULL, 0, NULL),
(13, 6, 8, 5, 15, '2021-07-20', '8:15 PM', '9:00 PM', 1, NULL, NULL, NULL, '2021-07-17 19:05:20', NULL, NULL, 0, NULL),
(14, 7, 5, 5, 15, '2021-07-22', '7:15 PM', '9:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:06:15', NULL, NULL, 0, NULL),
(15, 7, 8, 5, 15, '2021-07-22', '7:15 PM', '9:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:06:15', NULL, NULL, 0, NULL),
(16, 7, 14, 5, 15, '2021-07-22', '7:15 PM', '9:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:06:15', NULL, NULL, 0, NULL),
(17, 8, 6, 7, 16, '2021-07-21', '7:15 PM', '8:00 PM', 1, NULL, NULL, 2, '2021-07-17 19:06:50', NULL, NULL, 0, NULL),
(18, 9, 4, 7, 18, '2021-07-20', '5:15 PM', '6:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:07:42', NULL, NULL, 0, NULL),
(19, 9, 8, 7, 18, '2021-07-20', '5:15 PM', '6:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:07:42', NULL, NULL, 0, NULL),
(20, 9, 11, 7, 18, '2021-07-20', '5:15 PM', '6:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:07:42', NULL, NULL, 0, NULL),
(21, 10, 7, 9, 2, '2021-07-20', '7:15 PM', '9:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:11:34', NULL, NULL, 0, NULL),
(22, 10, 6, 9, 2, '2021-07-20', '7:15 PM', '9:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:11:34', NULL, NULL, 0, NULL),
(23, 10, 1, 9, 2, '2021-07-20', '7:15 PM', '9:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:11:34', NULL, NULL, 0, NULL),
(24, 11, 7, 2, 2, '2021-07-22', '3:15 PM', '4:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:13:22', NULL, NULL, 0, NULL),
(25, 11, 10, 2, 2, '2021-07-22', '3:15 PM', '4:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:13:22', NULL, NULL, 0, NULL),
(26, 11, 6, 2, 2, '2021-07-22', '3:15 PM', '4:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:13:22', NULL, NULL, 0, NULL),
(27, 11, 1, 2, 2, '2021-07-22', '3:15 PM', '4:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:13:22', NULL, NULL, 0, NULL),
(28, 12, 5, 3, 2, '2021-07-29', '4:00 PM', '5:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:14:01', NULL, NULL, 0, NULL),
(29, 12, 4, 3, 2, '2021-07-29', '4:00 PM', '5:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:14:01', NULL, NULL, 0, NULL),
(30, 12, 11, 3, 2, '2021-07-29', '4:00 PM', '5:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:14:02', NULL, NULL, 0, NULL),
(31, 13, 14, 6, 2, '2021-07-17', '6:15 PM', '7:15 PM', 1, NULL, NULL, 2, '2021-07-17 19:14:57', NULL, NULL, 0, NULL),
(32, 14, 5, 3, 2, '2021-07-24', '7:45 PM', '8:30 PM', 1, NULL, NULL, 2, '2021-07-21 19:38:18', NULL, NULL, 0, NULL),
(33, 14, 4, 3, 2, '2021-07-24', '7:45 PM', '8:30 PM', 1, NULL, NULL, 2, '2021-07-21 19:38:18', NULL, NULL, 0, NULL),
(34, 14, 11, 3, 2, '2021-07-24', '7:45 PM', '8:30 PM', 1, NULL, NULL, 2, '2021-07-21 19:38:18', NULL, NULL, 0, NULL),
(35, 15, 7, 8, 18, '2021-07-29', '7:15 PM', '7:45 PM', 1, NULL, NULL, 2, '2021-07-21 19:40:23', NULL, NULL, 0, NULL),
(36, 15, 13, 8, 18, '2021-07-29', '7:15 PM', '7:45 PM', 1, NULL, NULL, 2, '2021-07-21 19:40:23', NULL, NULL, 0, NULL),
(37, 15, 12, 8, 18, '2021-07-29', '7:15 PM', '7:45 PM', 1, NULL, NULL, 2, '2021-07-21 19:40:23', NULL, NULL, 0, NULL),
(38, 16, 5, 3, 2, '2021-08-12', '10:45 AM', '12:45 PM', 0, NULL, NULL, 2, '2021-07-26 11:41:37', NULL, NULL, 1, NULL),
(39, 16, 4, 3, 2, '2021-08-12', '10:45 AM', '12:45 PM', 0, NULL, NULL, 2, '2021-07-26 11:41:37', NULL, NULL, 1, NULL),
(40, 16, 11, 3, 2, '2021-08-12', '10:45 AM', '12:45 PM', 0, NULL, NULL, 2, '2021-07-26 11:41:37', NULL, NULL, 1, NULL),
(41, 17, 6, 7, 16, '2021-07-29', '6:15 PM', '6:45 PM', 1, NULL, NULL, 2, '2021-07-26 18:37:43', NULL, NULL, 0, NULL),
(42, 16, 5, 3, 2, '2021-08-12', '10:45 AM', '12:45 PM', 1, NULL, NULL, 2, '2021-07-26 18:50:29', NULL, NULL, 0, NULL),
(43, 18, 5, 5, 15, '2021-08-27', '6:15 PM', '7:00 PM', 1, NULL, NULL, 2, '2021-07-26 18:54:14', NULL, NULL, 0, NULL),
(44, 18, 10, 5, 15, '2021-08-27', '6:15 PM', '7:00 PM', 1, NULL, NULL, 2, '2021-07-26 18:54:14', NULL, NULL, 0, NULL),
(45, 18, 8, 5, 15, '2021-08-27', '6:15 PM', '7:00 PM', 1, NULL, NULL, 2, '2021-07-26 18:54:15', NULL, NULL, 0, NULL),
(46, 19, 5, 5, 15, '2021-08-04', '5:45 PM', '7:00 PM', 1, NULL, NULL, 2, '2021-07-26 18:56:38', NULL, NULL, 0, NULL),
(47, 19, 8, 5, 15, '2021-08-04', '5:45 PM', '7:00 PM', 1, NULL, NULL, 2, '2021-07-26 18:56:38', NULL, NULL, 0, NULL),
(48, 20, 1, 2, 2, '2021-08-15', '9:30 PM', '10:30 PM', 1, NULL, NULL, 2, '2021-08-14 20:23:55', NULL, NULL, 0, NULL),
(49, 21, 20, 6, 2, '2021-08-25', '8:00 PM', '10:00 PM', 1, NULL, NULL, 2, '2021-08-19 21:49:41', NULL, NULL, 0, NULL),
(50, 22, 7, 2, 2, '2021-08-21', '9:00 PM', '10:00 PM', 1, NULL, NULL, 2, '2021-08-19 21:50:42', NULL, NULL, 0, NULL),
(51, 22, 10, 2, 2, '2021-08-21', '9:00 PM', '10:00 PM', 1, NULL, NULL, 2, '2021-08-19 21:50:42', NULL, NULL, 0, NULL),
(52, 22, 6, 2, 2, '2021-08-21', '9:00 PM', '10:00 PM', 1, NULL, NULL, 2, '2021-08-19 21:50:42', NULL, NULL, 0, NULL),
(53, 22, 1, 2, 2, '2021-08-21', '9:00 PM', '10:00 PM', 1, NULL, NULL, 2, '2021-08-19 21:50:42', NULL, NULL, 0, NULL),
(54, 23, 5, 5, 15, '2021-08-26', '9:00 PM', '10:00 PM', 1, NULL, NULL, 15, '2021-08-19 21:59:06', NULL, NULL, 0, NULL),
(55, 23, 10, 5, 15, '2021-08-26', '9:00 PM', '10:00 PM', 1, NULL, NULL, 15, '2021-08-19 21:59:06', NULL, NULL, 0, NULL),
(56, 23, 21, 5, 15, '2021-08-26', '9:00 PM', '10:00 PM', 1, NULL, NULL, 15, '2021-08-19 21:59:07', NULL, NULL, 0, NULL),
(57, 23, 1, 5, 15, '2021-08-26', '9:00 PM', '10:00 PM', 1, NULL, NULL, 15, '2021-08-19 21:59:07', NULL, NULL, 0, NULL),
(58, 23, 8, 5, 15, '2021-08-26', '9:00 PM', '10:00 PM', 1, NULL, NULL, 15, '2021-08-19 21:59:07', NULL, NULL, 0, NULL),
(59, 23, 14, 5, 15, '2021-08-26', '9:00 PM', '10:00 PM', 1, NULL, NULL, 15, '2021-08-19 21:59:07', NULL, NULL, 0, NULL),
(60, 24, 21, 2, 15, '2021-08-20', '10:00 PM', '11:00 PM', 1, NULL, NULL, 15, '2021-08-19 21:59:49', NULL, NULL, 0, NULL),
(61, 24, 1, 2, 15, '2021-08-20', '10:00 PM', '11:00 PM', 1, NULL, NULL, 15, '2021-08-19 21:59:49', NULL, NULL, 0, NULL),
(62, 25, 21, 8, 15, '2021-08-23', '8:00 PM', '9:00 PM', 1, NULL, NULL, 15, '2021-08-19 22:00:13', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `role_id` int(9) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `role_order` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 - Inactive , 1 - Active',
  `status_updated_by` int(11) DEFAULT NULL,
  `status_updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 - No , 1 - Yes',
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`role_id`, `role_name`, `role_order`, `status`, `status_updated_by`, `status_updated_on`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_deleted`, `deleted_by`) VALUES
(3, 'Tutor', 3, 1, 1, '2020-12-15 16:54:52', 1, '2020-12-15 16:54:52', 1, '2020-12-19 21:18:15', 0, NULL),
(4, 'Student', 4, 1, NULL, NULL, 1, '2020-12-15 16:56:16', 1, '2020-12-19 12:37:42', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_meeting_request_master`
--

CREATE TABLE `student_meeting_request_master` (
  `student_meeting_request_id` int(9) NOT NULL,
  `student_fid` int(11) NOT NULL DEFAULT 0,
  `subject_fid` int(11) NOT NULL DEFAULT 0,
  `teacher_fid` int(11) NOT NULL DEFAULT 0,
  `meeting_date` date DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 - Requested , 1 - Processing, 2 - On Hold , 3 - Approved, 4 - Rejected, 5 - Cancelled',
  `status_updated_by` int(11) DEFAULT NULL,
  `status_updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 - No , 1 - Yes',
  `deleted_by` int(11) DEFAULT NULL,
  `meeting_fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_meeting_request_master`
--

INSERT INTO `student_meeting_request_master` (`student_meeting_request_id`, `student_fid`, `subject_fid`, `teacher_fid`, `meeting_date`, `start_time`, `end_time`, `status`, `status_updated_by`, `status_updated_on`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_deleted`, `deleted_by`, `meeting_fid`) VALUES
(1, 1, 1, 2, '2021-07-29', NULL, '', 3, 2, '2021-07-15 17:03:37', 1, '2021-07-15 17:01:49', NULL, NULL, 0, NULL, 0),
(2, 11, 3, 2, '2021-07-29', NULL, '', 0, 2, '2021-08-08 19:43:23', 11, '2021-07-17 19:09:42', NULL, NULL, 0, NULL, 0),
(3, 1, 2, 2, '2021-08-19', NULL, '', 3, 2, '2021-08-14 20:13:49', 1, '2021-08-14 20:13:00', NULL, NULL, 0, NULL, 0),
(4, 1, 2, 2, '2021-08-17', NULL, '', 3, 2, '2021-08-14 20:17:24', 1, '2021-08-14 20:16:57', NULL, NULL, 0, NULL, 0),
(5, 1, 2, 2, '2021-08-15', NULL, '', 3, 2, '2021-08-14 20:18:44', 1, '2021-08-14 20:18:09', NULL, NULL, 0, NULL, 0),
(6, 1, 2, 2, '2021-08-15', '', '', 4, 2, '2021-08-14 20:27:36', 1, '2021-08-14 20:23:31', NULL, NULL, 0, NULL, 0),
(7, 1, 9, 15, '2021-08-24', '5:00 PM', '5:45 PM', 0, NULL, NULL, 1, '2021-08-19 22:01:17', NULL, NULL, 0, NULL, 0),
(8, 10, 5, 15, '2021-08-24', '10:15 PM', '11:15 PM', 0, NULL, NULL, 10, '2021-08-19 22:04:08', NULL, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_teacher_subject_master`
--

CREATE TABLE `student_teacher_subject_master` (
  `student_teacher_subject_id` int(9) NOT NULL,
  `student_fid` int(11) NOT NULL DEFAULT 0,
  `subject_fid` int(11) NOT NULL DEFAULT 0,
  `teacher_fid` int(11) NOT NULL DEFAULT 0 COMMENT 'used user_master as user_id of teacher',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 - Inactive , 1 - Active',
  `status_updated_by` int(11) DEFAULT NULL,
  `status_updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 - No , 1 - Yes',
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_teacher_subject_master`
--

INSERT INTO `student_teacher_subject_master` (`student_teacher_subject_id`, `student_fid`, `subject_fid`, `teacher_fid`, `status`, `status_updated_by`, `status_updated_on`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_deleted`, `deleted_by`) VALUES
(1, 1, 1, 2, 1, NULL, NULL, 3, '2021-05-22 15:32:48', NULL, NULL, 0, NULL),
(2, 14, 5, 15, 1, NULL, NULL, 2, '2021-07-17 18:49:44', NULL, NULL, 0, NULL),
(3, 14, 6, 2, 1, NULL, NULL, 2, '2021-07-17 18:50:00', NULL, NULL, 0, NULL),
(4, 13, 10, 17, 1, NULL, NULL, 2, '2021-07-17 18:50:19', NULL, NULL, 0, NULL),
(5, 13, 8, 18, 1, NULL, NULL, 2, '2021-07-17 18:50:28', NULL, NULL, 0, NULL),
(6, 12, 8, 18, 1, NULL, NULL, 2, '2021-07-17 18:50:57', NULL, NULL, 0, NULL),
(7, 12, 4, 17, 1, NULL, NULL, 2, '2021-07-17 18:51:09', NULL, NULL, 0, NULL),
(8, 12, 6, 17, 1, NULL, NULL, 2, '2021-07-17 18:51:27', NULL, NULL, 0, NULL),
(9, 11, 7, 18, 1, NULL, NULL, 2, '2021-07-17 18:52:01', NULL, NULL, 0, NULL),
(10, 11, 9, 17, 1, NULL, NULL, 2, '2021-07-17 18:52:08', NULL, NULL, 0, NULL),
(11, 11, 10, 17, 1, NULL, NULL, 2, '2021-07-17 18:52:17', NULL, NULL, 0, NULL),
(12, 11, 3, 2, 1, NULL, NULL, 2, '2021-07-17 18:53:08', NULL, NULL, 0, NULL),
(13, 10, 1, 2, 1, NULL, NULL, 2, '2021-07-17 18:53:37', NULL, NULL, 0, NULL),
(14, 10, 2, 2, 1, NULL, NULL, 2, '2021-07-17 18:53:45', NULL, NULL, 0, NULL),
(15, 10, 5, 15, 1, NULL, NULL, 2, '2021-07-17 18:53:53', NULL, NULL, 0, NULL),
(16, 9, 8, 18, 1, NULL, NULL, 2, '2021-07-17 18:54:18', NULL, NULL, 0, NULL),
(17, 9, 9, 16, 1, NULL, NULL, 2, '2021-07-17 18:54:27', NULL, NULL, 0, NULL),
(18, 9, 10, 17, 1, NULL, NULL, 2, '2021-07-17 18:54:36', NULL, NULL, 0, NULL),
(19, 8, 7, 18, 1, NULL, NULL, 2, '2021-07-17 18:55:02', NULL, NULL, 0, NULL),
(20, 8, 5, 15, 1, NULL, NULL, 2, '2021-07-17 18:55:09', NULL, NULL, 0, NULL),
(21, 7, 9, 2, 1, NULL, NULL, 2, '2021-07-17 18:55:26', NULL, NULL, 0, NULL),
(22, 7, 2, 2, 1, NULL, NULL, 2, '2021-07-17 18:55:45', NULL, NULL, 0, NULL),
(23, 7, 8, 18, 1, NULL, NULL, 2, '2021-07-17 18:55:53', NULL, NULL, 0, NULL),
(24, 6, 7, 16, 1, NULL, NULL, 2, '2021-07-17 18:56:12', NULL, NULL, 0, NULL),
(25, 6, 2, 2, 1, NULL, NULL, 2, '2021-07-17 18:56:19', NULL, NULL, 0, NULL),
(26, 6, 9, 2, 1, NULL, NULL, 2, '2021-07-17 18:56:31', NULL, NULL, 0, NULL),
(27, 5, 3, 2, 1, NULL, NULL, 2, '2021-07-17 18:56:47', NULL, NULL, 0, NULL),
(28, 5, 5, 15, 1, NULL, NULL, 2, '2021-07-17 18:56:56', NULL, NULL, 0, NULL),
(29, 4, 3, 2, 1, NULL, NULL, 2, '2021-07-17 18:57:14', NULL, NULL, 0, NULL),
(30, 4, 9, 16, 1, NULL, NULL, 2, '2021-07-17 18:57:22', NULL, NULL, 0, NULL),
(31, 4, 7, 18, 1, NULL, NULL, 2, '2021-07-17 18:57:30', NULL, NULL, 0, NULL),
(32, 1, 2, 2, 1, NULL, NULL, 2, '2021-07-17 18:58:07', NULL, NULL, 0, NULL),
(33, 1, 9, 2, 1, NULL, NULL, 2, '2021-07-17 18:58:17', NULL, NULL, 0, NULL),
(34, 20, 3, 2, 1, NULL, NULL, 2, '2021-07-26 11:46:10', NULL, NULL, 0, NULL),
(35, 20, 6, 17, 1, NULL, NULL, 2, '2021-07-26 11:46:24', NULL, NULL, 0, NULL),
(36, 20, 6, 2, 1, NULL, NULL, 2, '2021-07-26 18:39:37', NULL, NULL, 0, NULL),
(37, 21, 5, 15, 1, NULL, NULL, 2, '2021-07-26 18:58:50', NULL, NULL, 0, NULL),
(38, 21, 6, 17, 1, NULL, NULL, 2, '2021-07-26 18:59:02', NULL, NULL, 0, NULL),
(39, 1, 2, 15, 1, NULL, NULL, 15, '2021-08-19 21:55:41', NULL, NULL, 0, NULL),
(40, 1, 9, 15, 1, NULL, NULL, 15, '2021-08-19 21:56:08', NULL, NULL, 0, NULL),
(41, 1, 5, 15, 1, NULL, NULL, 15, '2021-08-19 21:56:17', NULL, NULL, 0, NULL),
(42, 21, 2, 15, 1, NULL, NULL, 15, '2021-08-19 21:56:42', NULL, NULL, 0, NULL),
(43, 21, 8, 15, 1, NULL, NULL, 15, '2021-08-19 21:57:36', NULL, NULL, 0, NULL),
(44, 21, 9, 15, 1, NULL, NULL, 15, '2021-08-19 21:57:49', NULL, NULL, 0, NULL),
(45, 20, 9, 15, 1, NULL, NULL, 15, '2021-08-19 21:58:02', NULL, NULL, 0, NULL),
(46, 10, 9, 15, 1, NULL, NULL, 15, '2021-08-19 21:58:28', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_master`
--

CREATE TABLE `subject_master` (
  `subject_id` int(9) NOT NULL,
  `subject_name` varchar(50) DEFAULT NULL,
  `subject_order` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 - Inactive , 1 - Active',
  `status_updated_by` int(11) DEFAULT NULL,
  `status_updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 - No , 1 - Yes',
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_master`
--

INSERT INTO `subject_master` (`subject_id`, `subject_name`, `subject_order`, `status`, `status_updated_by`, `status_updated_on`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_deleted`, `deleted_by`) VALUES
(1, 'Physics', NULL, 1, NULL, NULL, 2, '2021-05-22 15:27:46', NULL, NULL, 0, NULL),
(2, 'Math', NULL, 1, NULL, NULL, 2, '2021-07-17 18:35:45', NULL, NULL, 0, NULL),
(3, 'Chemistry', NULL, 1, NULL, NULL, 2, '2021-07-17 18:35:57', NULL, NULL, 0, NULL),
(4, 'Spanish', NULL, 1, NULL, NULL, 2, '2021-07-17 18:36:07', NULL, NULL, 0, NULL),
(5, 'French', NULL, 1, NULL, NULL, 2, '2021-07-17 18:36:15', NULL, NULL, 0, NULL),
(6, 'English', NULL, 1, NULL, NULL, 2, '2021-07-17 18:36:23', NULL, NULL, 0, NULL),
(7, 'Hindi', NULL, 1, NULL, NULL, 2, '2021-07-17 18:36:32', NULL, NULL, 0, NULL),
(8, 'Geology', NULL, 1, NULL, NULL, 2, '2021-07-17 18:36:49', NULL, NULL, 0, NULL),
(9, 'History', NULL, 1, NULL, NULL, 2, '2021-07-17 18:36:59', NULL, NULL, 0, NULL),
(10, 'Social Studies', NULL, 1, 2, '2021-07-26 18:40:09', 15, '2021-07-17 18:43:23', 2, '2021-07-25 12:59:57', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_leave_days`
--

CREATE TABLE `teacher_leave_days` (
  `teacher_leave_id` int(9) NOT NULL,
  `leave_days` varchar(50) DEFAULT NULL COMMENT '0 - Sunday, 1 - Mon.....',
  `teacher_fid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 - Inactive , 1 - Active',
  `status_updated_by` int(11) DEFAULT NULL,
  `status_updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 - No , 1 - Yes',
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_leave_days`
--

INSERT INTO `teacher_leave_days` (`teacher_leave_id`, `leave_days`, `teacher_fid`, `status`, `status_updated_by`, `status_updated_on`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_deleted`, `deleted_by`) VALUES
(1, '0', 2, 1, NULL, NULL, 2, '2021-07-17 18:37:53', 2, '2021-07-26 11:43:19', 0, NULL),
(2, '0,2', 15, 1, NULL, NULL, 15, '2021-07-17 18:43:53', 15, '2021-08-19 21:52:32', 0, NULL),
(3, '3', 18, 1, NULL, NULL, 18, '2021-07-17 18:47:41', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject_master`
--

CREATE TABLE `teacher_subject_master` (
  `teacher_subject_id` int(9) NOT NULL,
  `subject_fid` int(11) NOT NULL DEFAULT 0,
  `user_fid` int(11) NOT NULL DEFAULT 0 COMMENT 'used user_master',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 - Inactive , 1 - Active',
  `status_updated_by` int(11) DEFAULT NULL,
  `status_updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 - No , 1 - Yes',
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_subject_master`
--

INSERT INTO `teacher_subject_master` (`teacher_subject_id`, `subject_fid`, `user_fid`, `status`, `status_updated_by`, `status_updated_on`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_deleted`, `deleted_by`) VALUES
(1, 1, 2, 1, NULL, NULL, 2, '2021-05-22 15:28:29', NULL, NULL, 0, NULL),
(2, 6, 2, 1, NULL, NULL, 2, '2021-07-17 18:38:04', NULL, NULL, 0, NULL),
(3, 9, 2, 1, NULL, NULL, 2, '2021-07-17 18:38:13', NULL, NULL, 0, NULL),
(4, 2, 2, 1, 2, '2021-08-08 19:36:53', 2, '2021-07-17 18:38:21', NULL, NULL, 0, NULL),
(5, 8, 15, 1, NULL, NULL, 15, '2021-07-17 18:42:38', NULL, NULL, 0, NULL),
(6, 5, 15, 1, NULL, NULL, 15, '2021-07-17 18:42:45', NULL, NULL, 0, NULL),
(7, 9, 15, 1, NULL, NULL, 15, '2021-07-17 18:42:54', NULL, NULL, 0, NULL),
(8, 7, 16, 1, NULL, NULL, 16, '2021-07-17 18:44:28', NULL, NULL, 0, NULL),
(9, 9, 16, 1, NULL, NULL, 16, '2021-07-17 18:44:34', NULL, NULL, 0, NULL),
(10, 1, 16, 1, NULL, NULL, 16, '2021-07-17 18:44:47', NULL, NULL, 0, NULL),
(11, 10, 16, 1, NULL, NULL, 16, '2021-07-17 18:44:47', NULL, NULL, 0, NULL),
(12, 6, 17, 1, NULL, NULL, 17, '2021-07-17 18:45:43', NULL, NULL, 0, NULL),
(13, 9, 17, 1, NULL, NULL, 17, '2021-07-17 18:45:43', NULL, NULL, 0, NULL),
(14, 10, 17, 1, NULL, NULL, 17, '2021-07-17 18:45:43', NULL, NULL, 0, NULL),
(15, 4, 17, 1, NULL, NULL, 17, '2021-07-17 18:45:44', NULL, NULL, 0, NULL),
(16, 8, 18, 1, NULL, NULL, 18, '2021-07-17 18:47:55', NULL, NULL, 0, NULL),
(17, 7, 18, 1, NULL, NULL, 18, '2021-07-17 18:47:55', NULL, NULL, 0, NULL),
(18, 4, 18, 1, NULL, NULL, 18, '2021-07-17 18:47:55', NULL, NULL, 0, NULL),
(19, 3, 2, 0, 2, '2021-08-19 21:51:12', 2, '2021-07-17 18:52:56', NULL, NULL, 0, NULL),
(20, 3, 2, 1, 2, '2021-07-26 18:55:41', 2, '2021-07-26 18:55:21', NULL, NULL, 0, NULL),
(21, 7, 2, 1, NULL, NULL, 2, '2021-07-26 18:57:18', NULL, NULL, 0, NULL),
(22, 2, 2, 1, NULL, NULL, 2, '2021-08-08 19:36:40', NULL, NULL, 0, NULL),
(23, 2, 15, 1, NULL, NULL, 15, '2021-08-19 21:53:30', NULL, NULL, 0, NULL),
(24, 1, 15, 1, NULL, NULL, 15, '2021-08-19 21:53:30', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(9) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT 'dummy.png',
  `role_fid` int(11) NOT NULL DEFAULT 0 COMMENT 'used role_master',
  `login_right` int(1) NOT NULL DEFAULT 0 COMMENT '0=No, 1=Yes',
  `student_id` varchar(10) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 - Inactive , 1 - Active',
  `status_updated_by` int(11) DEFAULT NULL,
  `status_updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 - No , 1 - Yes',
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `mobile`, `date_of_birth`, `profile_img`, `role_fid`, `login_right`, `student_id`, `status`, `status_updated_by`, `status_updated_on`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_deleted`, `deleted_by`) VALUES
(1, 'sid10july@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Sid', NULL, 'S', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:58:21', 0, NULL),
(2, 'bob@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Bob', NULL, 'B', NULL, '1980-03-12', '35a3193a3d8daa6bcaab61ad4f5323a9.JPG', 3, 1, NULL, 1, NULL, NULL, NULL, '2021-05-22 15:26:47', 2, '2021-08-08 19:47:11', 0, NULL),
(4, 'siddharth.sharma19170@dpsiedge.edu.in', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Rob', 'M.', 'Jake', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:57:33', 0, NULL),
(5, 'karl@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Karl', 'J.', 'Adam', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:56:59', 0, NULL),
(6, 'robinjuly@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Michael', NULL, 'Wang', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:56:36', 0, NULL),
(7, 'eric@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Eric', NULL, 'Luhman', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:55:56', 0, NULL),
(8, 'Troy@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Troy', NULL, 'Luhman', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:55:12', 0, NULL),
(9, 'Alyssa@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Alyssa', NULL, 'Smith', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:54:39', 0, NULL),
(10, 'Matt@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Matt', NULL, 'Benebau', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:54:03', 0, NULL),
(11, 'user1@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'user', NULL, '1', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 3, '2021-05-22 15:32:54', 0, NULL),
(12, 'user2@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'User', NULL, '2', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:51:34', 0, NULL),
(13, 'user3@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'User', NULL, '3', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:50:42', 0, NULL),
(14, 'user4@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'User', NULL, '4', NULL, '2004-07-10', 'dummy.png', 4, 1, '24685', 1, NULL, NULL, NULL, '2021-05-22 15:25:31', 2, '2021-07-17 18:50:05', 0, NULL),
(15, 'tutor1@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Tutor', NULL, '1', NULL, '1980-03-12', 'dummy.png', 3, 1, NULL, 1, NULL, NULL, NULL, '2021-05-22 15:26:47', NULL, NULL, 0, NULL),
(16, 'tutor2@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Tutor', NULL, '2', NULL, '1980-03-12', 'dummy.png', 3, 1, NULL, 1, NULL, NULL, NULL, '2021-05-22 15:26:47', NULL, NULL, 0, NULL),
(17, 'tutor3@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'tutor', NULL, '3', NULL, '1980-03-12', 'dummy.png', 3, 1, NULL, 1, NULL, NULL, NULL, '2021-05-22 15:26:47', NULL, NULL, 0, NULL),
(18, 'tutor4@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Tutor', NULL, '4', NULL, '1980-03-12', 'dummy.png', 3, 1, NULL, 1, NULL, NULL, NULL, '2021-05-22 15:26:47', NULL, NULL, 0, NULL),
(19, 'hi@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 's', NULL, 'a', NULL, '2021-07-05', 'dummy.png', 4, 1, '25834', 1, NULL, NULL, NULL, '2021-07-20 19:02:59', 2, '2021-07-21 19:39:34', 1, 2),
(20, 'Keven@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Keven', NULL, 'Adam', NULL, '2010-07-07', 'dummy.png', 4, 1, '28701', 1, NULL, NULL, NULL, '2021-07-26 11:38:27', NULL, NULL, 0, NULL),
(21, 'Sam@gmail.com', '$2y$10$X0tleSYxMjMkQCEjQGF1d..EgtRMqWRE5bwa003b935djTaNtXBsS', 'Sam', NULL, 'S', NULL, '2021-06-09', 'dummy.png', 4, 1, '57289', 1, NULL, NULL, NULL, '2021-07-26 18:48:49', NULL, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meeting_master`
--
ALTER TABLE `meeting_master`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `meeting_student_master`
--
ALTER TABLE `meeting_student_master`
  ADD PRIMARY KEY (`meeting_student_id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `student_meeting_request_master`
--
ALTER TABLE `student_meeting_request_master`
  ADD PRIMARY KEY (`student_meeting_request_id`);

--
-- Indexes for table `student_teacher_subject_master`
--
ALTER TABLE `student_teacher_subject_master`
  ADD PRIMARY KEY (`student_teacher_subject_id`);

--
-- Indexes for table `subject_master`
--
ALTER TABLE `subject_master`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher_leave_days`
--
ALTER TABLE `teacher_leave_days`
  ADD PRIMARY KEY (`teacher_leave_id`);

--
-- Indexes for table `teacher_subject_master`
--
ALTER TABLE `teacher_subject_master`
  ADD PRIMARY KEY (`teacher_subject_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meeting_master`
--
ALTER TABLE `meeting_master`
  MODIFY `meeting_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `meeting_student_master`
--
ALTER TABLE `meeting_student_master`
  MODIFY `meeting_student_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `role_master`
--
ALTER TABLE `role_master`
  MODIFY `role_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student_meeting_request_master`
--
ALTER TABLE `student_meeting_request_master`
  MODIFY `student_meeting_request_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_teacher_subject_master`
--
ALTER TABLE `student_teacher_subject_master`
  MODIFY `student_teacher_subject_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `subject_master`
--
ALTER TABLE `subject_master`
  MODIFY `subject_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher_leave_days`
--
ALTER TABLE `teacher_leave_days`
  MODIFY `teacher_leave_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_subject_master`
--
ALTER TABLE `teacher_subject_master`
  MODIFY `teacher_subject_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
