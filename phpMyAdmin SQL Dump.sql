-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2013 at 07:58 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `curDB`
--

CREATE TABLE `curDB` (
  `id` bigint(20) NOT NULL,
  `database_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curDB`
--

INSERT INTO `curDB` (`id`, `database_name`) VALUES
(0, 'agrup_penela');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(70) NOT NULL,
  `email` varchar(200) NOT NULL,
  `database_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `database_name`) VALUES
(1, 'Miro Luis', '123', 'teste@teste', 'agrup_penela');
