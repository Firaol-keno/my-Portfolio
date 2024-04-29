-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 03:54 PM
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) DEFAULT NULL,
  `description` text  DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

"INSERT INTO categories (title, description) VALUES ('Art', 'description')";
-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL  AUTO_INCREMENT,
  `title` varchar(120) DEFAULT NULL,
  `body` text  DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `date_time` timestamp NULL DEFAULT current_timestamp(),
  `category_id`  unsigned  int(11) NULL DEFAULT,
  `author_id`  unsigned  int(11) NULL DEFAULT,
   `is_featured` tinyint(1) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

"INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) 
           VALUES ('Art', 'body', 'thumbnail_name', category_id, author_id, is_featured)";
-- --------------------------------------------------------

--
-- Table structure for table `tblrestables`
--

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL  AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
   `lastname` varchar(50) DEFAULT NULL,
   `username` varchar(50) DEFAULT NULL,
   `email` varchar(100) DEFAULT NULL,
    `password` varchar(255) DEFAULT NULL,
   `avatar` varchar(255) DEFAULT NULL,
   `is_admin` tinyint(1) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Dumping data for table `users`
--
 "INSERT INTO users SET firstname='firstname', lastname='lastname', username='username',
     email='email', password='hashed_password', avatar='avatar_name', is_admin=is_admin";


--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

--
---
ALTER TABLE posts ADD CONSTRAINT FK_blog_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL;
ALTER TABLE posts ADD CONSTRAINT FK_blog_author FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
