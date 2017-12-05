-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2017 at 06:14 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `group_c`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `comment` varchar(255),
  `vote` int(11),
  `created` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ingredients` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

-- INSERT INTO `recipes` (`recipe_id`, `title`, `ingredients`, `description`, `created`, `user_id`, `image`) VALUES
-- (2, 'Deli Sandwich', 'cheese,bread,deli', 'lorem ipsum lorem ipsum lorem ipsum', 1512018570, 1, ''),
-- (3, 'Cheese Burger', 'cheese,bread,meat', 'lorem ipsum lorem ipsum lorem ipsum', 1512018590, 1, ''),
-- (4, 'asdasdasd', 'knsajkd,aksmdl', 'asdasdsdasdipsum', 1512018571, 1, ''),
-- (5, 'Sasadaslmon', 'casdadsfashfeese,breadfad,meat', 'lorem ipsum asdfloadsfreadsfm ipsum lorem ipsum', 1512018572, 1, ''),
-- (6, 'Sasdfalmon', 'casdheese,bread,meat', 'lorem ipsum lorem ipsum lorem ipsum', 1512018573, 1, ''),
-- (7, 'asdfasfSalmon', 'casdheese,bread,meat', 'lorem ipsum lorem ipsum lorem ipsum', 1512018574, 1, ''),
-- (8, 'gfhdSalmon', 'casdheese,bread,meat', 'lorem ipsum lorem ipsum lorem ipsum', 1512018575, 1, ''),
-- (9, 'dfjhdhSalmon', 'casdheese,bread,meat', 'lorem ipsum lorem ipsum lorem ipsum', 1512018576, 1, ''),
-- (10, 'wretSwertalmon', 'casdheese,bread,meat', 'lorem ipsum lorem ipsum lorem ipsum', 1512018577, 1, ''),
-- (11, 'uyiySalmon', 'casdheese,bread,meat', 'lorem ipsum lorem ipsum lorem ipsum', 1512018578, 1, ''),
-- (12, 'gjhkgjhkSalmon', 'casdheese,bread,meat', 'lorem ipsum lorem ipsum lorem ipsum', 1512018579, 1, ''),
-- (13, 'qweqweSalmon', 'casdheese,bread,meat', 'lorem ipsum lorem ipsum lorem ipsum', 1512018580, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `token`, `password`, `username`, `created`, `admin`) VALUES
(1, '7affa637132888dcbacfc408f82ac9684cbe9dfd', '6fbb08e6af231691cc6f2470e8d0c0b97e993e9b', 'admin', 1512018570, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `recipeRM` (`recipe_id`),
  ADD KEY `UserRecipeRM` (`user_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `userRM` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `UserRecipeRM` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)  ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recipeRM` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `userRM` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

  
