-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 01:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `volunteer`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `booking_report` (IN `_fullname` VARCHAR(100))   BEGIN

IF(_fullname=' ')THEN

SELECT v.volunteers_id,v.fullname, v.sex, v.education, v.age, v.phone, b.branch_name Branch, v.method,date(v.date) as date, if(v.status = 1, 'active', 'pending')as status FROM `volunteers` V JOIN branch b ON V.branch_id = b.branch_id where v.status = 1;
ELSE

SELECT * FROM volunteers V WHERE V.fullname=_fullname;

END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `charging` (IN `_customer_id` INT, IN `_amount` INT, IN `_description` TEXT, IN `_user_id` VARCHAR(30))   BEGIN

INSERT INTO `charging`(`customer_id`, `amount`,`description`,`user_id`)
        VALUES (_customer_id, _amount, _description, _user_id);


-- SELECT _customer_id,_amount,_description,_user_id,
-- CURRENT_DATE from booking;
 -- CURRENT_DATE from booking b JOIN jop_title j on e.title_id=j.title_id;

if(row_count()> 0)THEN
SELECT "registered" as msg;

ELSE

SELECT "Not" as msg;
END IF;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `forget` (IN `_username` VARCHAR(50), IN `_password` INT)   BEGIN

if EXISTS(SELECT * FROM users WHERE users.username = _username)THEN	

UPDATE `users` SET password = MD5(_password) WHERE username = _username;
 
 SELECT 'success' Msg;

ELSE

SELECT 'deny' Msg;

end if;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_charging` (IN `_month_id` VARCHAR(50), IN `_year` VARCHAR(50), IN `_description` TEXT, IN `_account_id` INT, IN `_user_id` VARCHAR(100))   BEGIN

if(read_salary() > read_balance(_account_id))THEN

SELECT "Deny" as msg;
ELSE
INSERT IGNORE INTO `charge`(`emp_id`, `title_id`, `Amount`, `month_id`, `year`, `description`, `account_id`,`user_id`, `date`)
SELECT e.emp_id,j.title_id,j.salary,_month_id,_year,_description,_account_id,_user_id,
CURRENT_DATE from employee e JOIN jop_title j on e.title_id=j.title_id;

if(row_count()> 0)THEN
SELECT "Registered" as msg;

ELSE

SELECT "Not" as msg;
END IF;
END IF;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_sp` (IN `_username` VARCHAR(100), IN `_password` VARCHAR(100))   BEGIN

if EXISTS(SELECT * FROM users WHERE users.username = _username and users.password = MD5(_password))THEN	


if EXISTS(SELECT * FROM users WHERE users.username = _username and 	users.status = 'Active')THEN
 
SELECT * FROM users where users.username = _username;

ELSE

SELECT 'Locked' Msg;

end if;
ELSE


SELECT 'Deny' Msg;

END if;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `programprod` (IN `_name` VARCHAR(200), IN `_ptype` VARCHAR(200), IN `_desc` TEXT, IN `_durations` VARCHAR(200), IN `_from_date` DATE, IN `_to_date` DATE)   BEGIN


INSERT INTO programs(name, ptype, description, durations,from_date,to_date)
        VALUES (_name, _ptype, _desc, _durations,_from_date,_to_date);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_booking_price` (IN `_customer_id` INT)   BEGIN
SELECT `balance` as Total_amount from customer where customer_id=_customer_id;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_employee_total` (IN `_employee_id` INT)   BEGIN
SELECT `Amount` as Total_amount from charge where emp_id=_employee_id;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `signin_sp` (IN `_email` VARCHAR(100), IN `_password` VARCHAR(100))   BEGIN

if EXISTS(SELECT * FROM volunteers WHERE volunteers.email = _email and volunteers.password = MD5(_password))THEN	


if EXISTS(SELECT * FROM volunteers WHERE volunteers.email = _email and 	volunteers.status = 1)THEN
 
SELECT * FROM volunteers where volunteers.email = _email;

ELSE

SELECT 'Locked' Msg;

end if;
ELSE


SELECT 'Deny' Msg;

END if;


END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `read_balance` (`_account_id` INT) RETURNS INT(11)  BEGIN
set @balance=0.00;
SELECT sum(balance)into @balance from account
WHERE account_id=_account_id;
RETURN @balance;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `read_salary` () RETURNS DECIMAL(11,2)  BEGIN
set @salary=0.00;

SELECT sum(salary)into @salary from jop_title;

RETURN @salary;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `applay`
--

CREATE TABLE `applay` (
  `applay_id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `volunteers_id` varchar(250) DEFAULT NULL,
  `applay_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applay`
--

INSERT INTO `applay` (`applay_id`, `program_id`, `volunteers_id`, `applay_date`) VALUES
(6, 1, 'VOL003', '2023-09-30 10:00:31'),
(8, 1, 'VOL012', '2023-10-03 18:51:28'),
(9, 2, 'VOL013', '2023-10-10 17:42:23'),
(10, 2, 'VOL006', '2023-10-11 11:17:09'),
(11, 2, 'VOL008', '2023-10-11 19:47:35'),
(12, 2, 'VOL008', '2023-10-11 19:47:47'),
(13, 2, 'VOL008', '2023-10-11 19:48:03'),
(14, 2, 'VOL008', '2023-10-11 19:48:17'),
(15, 2, 'VOL008', '2023-10-11 19:49:23'),
(16, 2, 'VOL008', '2023-10-12 03:48:22'),
(17, 2, 'VOL008', '2023-10-12 05:09:56'),
(18, 2, 'VOL008', '2023-10-12 05:21:23'),
(19, 2, 'VOL008', '2023-10-12 05:21:32'),
(20, 1, 'VOL008', '2023-10-12 05:31:51'),
(21, 1, 'VOL008', '2023-10-12 05:32:26'),
(22, 1, 'VOL008', '2023-10-12 05:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `address`, `date`) VALUES
(1, 'Km4', 'Yaqshid', '2023-06-24 06:57:58'),
(2, 'gaalkacyo', 'wxara cade', '2023-09-17 05:54:05'),
(6, 'guriel', 'mudug', '2023-09-30 09:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
  `Coordinators_id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `tell` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `joined_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`Coordinators_id`, `fullname`, `sex`, `tell`, `email`, `joined_date`) VALUES
(1, 'Hawa', 'female', '12122', 'abdikadiryare122122@gmail.com', '2023-09-30 09:27:07'),
(2, 'ilhan', 'female', '222', 'abdikadiryare122122@gmail.com', '2023-09-30 09:27:27'),
(3, 'xasan caabi shire', 'male', '22222222', 'munniomer@gmail.com', '2023-10-11 11:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `volunteers_id` varchar(250) DEFAULT NULL,
  `Coordinators_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `volunteers_id`, `Coordinators_id`, `program_id`, `comments`, `date`) VALUES
(7, 'VOL005', 1, 2, 'you are good', '2023-10-02 07:16:32'),
(10, 'VOL007', 1, 3, 'ggg', '2023-10-10 17:49:21'),
(11, 'VOL007', 3, 2, 'dddddd', '2023-10-11 11:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `jop_title`
--

CREATE TABLE `jop_title` (
  `title_id` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `salary` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jop_title`
--

INSERT INTO `jop_title` (`title_id`, `position`, `salary`, `date`) VALUES
(2, 'codinatar', 100, '2023-09-14 05:54:52'),
(3, 'adminstrator', 8009, '2023-09-18 06:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ptype` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `durations` varchar(200) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `name`, `ptype`, `description`, `durations`, `from_date`, `to_date`, `date`, `image`) VALUES
(1, 'fast Eid', 'Enternurship', 'best program', '3 months', '2023-09-30', '2023-09-30', '2023-10-12 06:59:03', 'aploads/1.png'),
(2, 'vacceine', 'volunteer', 'our program', '3 Weeks', '2023-09-30', '2023-09-30', '2023-10-12 07:03:27', 'aploads/USR007.PNG'),
(3, 'Examine', 'volunteer', 'faaah faahin', '3 weeks', '2023-10-16', '2023-10-19', '2023-10-12 07:20:29', 'aploads/VOL030.PNG'),
(4, 'fast Eid', 'bbbb', 'gggggggggggggggg', '2m', '2023-10-13', '2023-10-20', '2023-10-12 07:24:29', 'aploads/USR008.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `reward_id` int(11) NOT NULL,
  `reward_type` varchar(50) DEFAULT NULL,
  `volunteers_id` varchar(250) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`reward_id`, `reward_type`, `volunteers_id`, `program_id`, `donation_date`) VALUES
(3, 'certificate', 'VOL004', 3, '2023-10-03 18:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `roll`
--

CREATE TABLE `roll` (
  `roll_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roll`
--

INSERT INTO `roll` (`roll_id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(100) NOT NULL,
  `usertype` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'active',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `username`, `password`, `image`, `status`, `date`) VALUES
('USR005', 'volunteer', 'hani sharaf', '827ccb0eea8a706c4c34a16891f84e7b', 'USR005.png', 'active', '2023-09-30 09:22:03'),
('USR006', 'coordinator', 'Hawa', '202cb962ac59075b964b07152d234b70', 'USR006.png', 'active', '2023-09-30 10:34:20'),
('USR008', 'coordinator', 'mahad', '202cb962ac59075b964b07152d234b70', 'USR008.png', 'active', '2023-10-12 07:23:59'),
('USR007', 'coordinator', 'Zaki', '202cb962ac59075b964b07152d234b70', 'USR007.png', 'active', '2023-10-12 07:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `volunteers_id` varchar(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `education` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `method` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`volunteers_id`, `fullname`, `email`, `password`, `sex`, `phone`, `age`, `education`, `branch_id`, `image`, `method`, `date`, `status`) VALUES
('VOL003', 'Zaki dahir  warsame', 'munniomer@gmail.com', '8d60b3ad7b422ebb0a9eaf89a3d06d42', 'female', '54555', '222', 'university', 2, 'VOL003.png', 'by_user', '2023-10-11 15:21:14', 1),
('VOL004', 'xasan caabi shire', 'abdikadiryare122122@gmail.com', 'b21f53dcabfb51786edb5fa7e861be75', 'male', '222', '22', 'primery', 6, 'VOL004.png', 'by_user', '2023-10-11 10:49:26', 1),
('VOL005', 'Ali yare cali', 'abdikadiryare122122@gmail.com', 'd9b1d7db4cd6e70935368a1efb10e377', 'male', '333', '222', 'primery', 6, 'VOL005.png', 'by_user', '2023-10-11 10:16:49', 1),
('VOL006', 'Ridwa chama', 'munniomer@gmail.com', 'd9b1d7db4cd6e70935368a1efb10e377', 'female', '333', '54', 'university', 1, 'VOL006.png', 'by_user', '2023-10-11 11:07:30', 1),
('VOL007', 'mahad Maxamed Shire', 'abdikadiryare122122@gmail.com', '202cb962ac59075b964b07152d234b70', 'male', '123', '24', 'secondery', 2, 'VOL007.png', 'by_self', '2023-10-11 11:08:54', 1),
('VOL008', 'rahmo moha', 'rahmo@gmail.com', '202cb962ac59075b964b07152d234b70', 'female', '22', '333', 'primery', 2, 'VOL008.png', 'by_self', '2023-10-11 11:42:58', 1),
('VOL009', 'Ridwa chama', 'munniomer@gmail.com', 'bcbe3365e6ac95ea2c0343a2395834dd', 'female', '444', '20', 'primery', 2, 'VOL009.png', 'by_self', '2023-10-11 13:01:10', 1),
('VOL010', 'ilhan abir', 'ilhan@gmail.com', '202cb962ac59075b964b07152d234b70', 'female', '4444', '22', 'primery', 6, 'VOL010.png', 'by_self', '2023-10-11 13:02:38', 0),
('VOL011', 'mahad mohamed', 'mahad@gmailo.com', '8ef4a4a225362d699a9e9b2029868db0', 'female', '1233', '44', 'university', 1, 'VOL011.png', 'by_self', '2023-10-12 04:09:38', 0),
('VOL012', 'Zaki dahir  warsame', 'aabaha201@gmail.com', '202cb962ac59075b964b07152d234b70', 'male', '3333', '64', 'primery', 6, 'VOL012.png', 'by_user', '2023-10-12 05:39:20', 0),
('VOL013', 'cali  daahir', 'alidahir@gmail.com', 'd9b1d7db4cd6e70935368a1efb10e377', 'male', '333333333', '44', 'primery', 2, 'VOL013.png', 'by_user', '2023-10-24 10:41:17', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applay`
--
ALTER TABLE `applay`
  ADD PRIMARY KEY (`applay_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD PRIMARY KEY (`Coordinators_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `jop_title`
--
ALTER TABLE `jop_title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`reward_id`);

--
-- Indexes for table `roll`
--
ALTER TABLE `roll`
  ADD PRIMARY KEY (`roll_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `student_id` (`usertype`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`volunteers_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applay`
--
ALTER TABLE `applay`
  MODIFY `applay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `Coordinators_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jop_title`
--
ALTER TABLE `jop_title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roll`
--
ALTER TABLE `roll`
  MODIFY `roll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
