-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2023 at 03:37 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--
CREATE DATABASE IF NOT EXISTS `bank` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bank`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_number` int(6) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `open_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_number`, `customer_id`, `balance`, `open_date`) VALUES
(100001, 100001, '100000.00', '2023-02-23'),
(100002, 100002, '500.00', '0000-00-00'),
(100003, 100003, '500.00', '0000-00-00'),
(100004, 100004, '500.00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `address`, `phone_number`, `email`, `password`) VALUES
(100001, 'John', 'law', '425', '090-000-0000', 'dev@gmail.com', '1234'),
(100002, 'John', 'law', '425', '090-000-0000', 'john@gmail.com', '1234'),
(100003, 'John', 'law', '4562', '090-000-0000', 'dev00@gmail.com', 'ๅ/-ภ'),
(100004, 'John', 'law', '425', '090-000-0000', 'john@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `account_number` int(6) UNSIGNED NOT NULL,
  `transaction_date` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`account_number`, `transaction_date`, `amount`, `description`, `id`) VALUES
(100003, '2023-02-23 15:28:33', '500.00', 'Initial deposit', 100001),
(100001, '2023-02-23 15:30:07', '500.00', 'Withdraw', 100002),
(100001, '2023-02-23 15:30:12', '500.00', 'Deposit', 100003),
(100001, '2023-02-23 15:30:18', '500.00', 'Withdraw', 100004),
(100001, '2023-02-23 15:30:24', '500.00', 'Withdraw', 100005),
(100001, '2023-02-23 15:30:29', '7.00', 'Withdraw', 100006),
(100001, '2023-02-23 15:30:36', '7.00', 'Deposit', 100007),
(100001, '2023-02-23 15:31:32', '500.00', 'Withdraw', 100008),
(100001, '2023-02-23 15:31:39', '100000.00', 'Deposit', 100009),
(100004, '2023-02-23 15:32:13', '500.00', 'Initial deposit', 100010),
(100001, '2023-02-23 15:32:26', '500.00', 'Deposit', 100011),
(100001, '2023-02-23 15:33:05', '500.00', 'Deposit', 100012),
(100001, '2023-02-23 15:33:08', '500.00', 'Withdraw', 100013);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_number`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_number` (`account_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_number` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100005;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100005;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100014;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `accounts` (`account_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

