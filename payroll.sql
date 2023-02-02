-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2017 at 10:15 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(12) NOT NULL,
  `branch_name` varchar(60) NOT NULL,
  `phone_contact` varchar(10) NOT NULL,
  `savedBy` int(12) NOT NULL,
  `last_updated_by` int(12) NOT NULL,
  `last_updated` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`, `phone_contact`, `savedBy`, `last_updated_by`, `last_updated`) VALUES
(1, 'Butare', '0786501421', 59, 59, 1466265819),
(2, 'Kigali', '014266452', 14, 14, 1465168322),
(5, 'Kibuye', '0718458799', 59, 59, 1466329532);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(12) NOT NULL,
  `dept_name` varchar(30) NOT NULL,
  `savedBy` int(12) NOT NULL,
  `last_updated` int(200) NOT NULL,
  `last_updated_by` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `savedBy`, `last_updated`, `last_updated_by`) VALUES
(6, 'Computer Science', 57, 1466266053, 57),
(8, 'Electronics', 57, 1466266061, 57);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(12) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dateOfBirth` varchar(12) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `joinDate` varchar(12) NOT NULL,
  `salary` int(12) NOT NULL,
  `assurance` varchar(12) NOT NULL,
  `deductions` int(12) NOT NULL,
  `BankAccountNo` varchar(24) NOT NULL,
  `type` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `firstname`, `lastname`, `gender`, `dateOfBirth`, `phone`, `address`, `picture`, `branch`, `designation`, `department`, `joinDate`, `salary`, `assurance`, `deductions`, `BankAccountNo`, `type`, `username`, `password`) VALUES
(57, 'RAFIKi', 'Gentil', 'Male', '2016-06-23', '0786501438', 'Kabuga', 'NTIVUGURUZWALIONCEAUX1466029602.jpeg', '1', 'Manager', '8', '1466200800', 250000, '2000', 3000, '0621400500', 'Admin', 'rafiki60@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(66, 'ABAYO', 'Jean de la croix', 'Male', '2016-02-02', '0786501448', 'KG 5 Ave', 'ABAYOJean de la croix1500146985.jpeg', '1', 'Developer', '6', '824770800', 200000, '2000', 2000, '0215852434213245', 'Normal-employee', 'muhozie@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(12) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(15000) NOT NULL,
  `sender` int(12) NOT NULL,
  `receiver` int(12) NOT NULL,
  `datetime` int(30) NOT NULL,
  `read_` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `account` varchar(80) NOT NULL,
  `payment_date` int(50) NOT NULL,
  `payment_period` int(50) NOT NULL,
  `last_payment_by` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`account`, `payment_date`, `payment_period`, `last_payment_by`) VALUES
('1000000', 1466892000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `penalty_id` int(12) NOT NULL,
  `penalty_description` varchar(3000) NOT NULL,
  `fines` int(12) NOT NULL,
  `penalty_by` int(12) NOT NULL,
  `penalty_to` int(12) NOT NULL,
  `punish_date` varchar(60) NOT NULL,
  `read_` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`),
  ADD UNIQUE KEY `branch_name` (`branch_name`),
  ADD UNIQUE KEY `phone_contact` (`phone_contact`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `BankAccountNo` (`BankAccountNo`),
  ADD UNIQUE KEY `BankAccountNo_2` (`BankAccountNo`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `penalties`
--
ALTER TABLE `penalties`
  ADD PRIMARY KEY (`penalty_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `penalty_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
