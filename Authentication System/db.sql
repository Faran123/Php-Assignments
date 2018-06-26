-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2018 at 11:52 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `authentication_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `activation_code` varchar(60) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `user_type` enum('admin','normal_user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `activation_code`, `status`, `user_type`) VALUES
('a@gmail.com', 'asf', 'safasdfsfsfsafsf12312321', '0', 'normal_user'),
('aaa@gmail.com', 'asd', '6883966fd8f918a4aa29be29d2c386fb', '0', 'normal_user'),
('abc@gmail.com', 'abc', '2421fcb1263b9530df88f7f002e78ea5', '0', 'normal_user'),
('admin@gmail.com', 'admin1234', '', '1', 'admin'),
('admin@yahoo.com', 'abc', '', '1', 'admin'),
('asdfas12@g.com', '12', 'f457c545a9ded88f18ecee47145a72c0', '0', 'normal_user'),
('asdfas@g.com', 'as', '96ea64f3a1aa2fd00c72faacf0cb8ac9', '1', 'normal_user'),
('bg@gmail.com', 'spa', '48aedb8880cab8c45637abc7493ecddd', '0', 'normal_user'),
('f@gmail.com', 'abc', '66f041e16a60928b05a7e228a89c3799', '0', 'normal_user'),
('fara12@gmail.com', 'aa', '1f50893f80d6830d62765ffad7721742', '1', 'normal_user'),
('faran.feroz@coeus-solutions.de', 'abc', 'fa3a3c407f82377f55c19c5d403335c7', '1', 'normal_user'),
('faran1@gmail.com', '1', '49ae49a23f67c759bf4fc791ba842aa2', '1', 'normal_user'),
('faran@gmail.com', 'as', '9b698eb3105bd82528f23d0c92dedfc0', '0', 'normal_user'),
('fari@gmail.com', 'as', 'dc82d632c9fcecb0778afbc7924494a6', '0', 'normal_user'),
('r@g.com', 'abc1234', '10a7cdd970fe135cf4f7bb55c0e3b59f', '0', 'normal_user'),
('s@g.com', 'a', '07a96b1f61097ccb54be14d6a47439b0', '0', 'normal_user'),
('sa@gmail.com', '1234', 'cdc0d6e63aa8e41c89689f54970bb35f', '0', 'normal_user'),
('w@gmail.com', 'ss', 'd9d4f495e875a2e075a1a4a6e1b9770f', '0', 'normal_user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
