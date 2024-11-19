

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `acgv`

CREATE DATABASE acgv;

-- --------------------------------------------------------


-- Table structure for table `admin`

DROP TABLE IF EXISTS `admin`;

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) NULL,
  `password` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- Inserting data into admin table
 INSERT INTO `admin` (`id`, `Name`, `phone`, `email`, `password`) VALUES (1, 'admin', +25192222222, 'admin@gmail.com', 1234);


-- --------------------------------------------------------


-- Table structure for table `admission`

DROP TABLE IF EXISTS `admission`;

CREATE TABLE IF NOT EXISTS `admission` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NULL,
  `email` varchar(255) NULL,
  `phone` varchar(14) NULL,
  `message` text NULL,  
  PRIMARY KEY (`id`)
);



-- Table structure for table `students`

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL, 
  `email` varchar(50) DEFAULT NULL,
  `isCertIssued` tinyint(1) NULL DEFAULT 0, 
  `course_name` varchar(50) NOT NULL,
  `marks` float(10) NOT NULL,
  `college_name` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP, 
  `updated_by` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_of_joining` date DEFAULT NULL,
  PRIMARY KEY (`id`),
);

-- --------------------------------------------------------

-- Table structure for table `certificates`
DROP TABLE IF EXISTS `certificates`;
CREATE TABLE IF NOT EXISTS `certificates`(
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `certificate_id` varchar(50) NOT NULL,
  `marks` float(10) NOT NULL,
  `college_name` varchar(50) NOT NULL,
  `date_of_joining` date DEFAULT NULL,
  `course_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);


-- --------------------------------------------------------
