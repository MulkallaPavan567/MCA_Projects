-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jan 28, 2024 at 06:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indenting`
--

-- --------------------------------------------------------

--
-- Table structure for table `suggested_books`
--

CREATE TABLE `suggested_books` (
  `book_name` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `edition` varchar(10) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `year` int(4) NOT NULL,
  `cost` int(10) NOT NULL,
  `field` varchar(200) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggested_books`
--

INSERT INTO `suggested_books` (`book_name`, `author`, `edition`, `isbn`, `publisher`, `year`, `cost`, `field`, `quantity`) VALUES
('Database System Concepts', 'Abraham Silberschatz, Henry F. Korth, S. Sudarshan', '7th', '978-0-07-802215-9', 'McGraw-Hill Education', 2019, 6000, 'Databases', 2),
('Computer Networks', 'Andrew S. Tanenbaum, David J. Wetherall', '5th', '978-0-13-212695-3', 'Pearson', 2010, 4000, 'Networking', 1),
('Clean Code: A Handbook of Agile Software Craftsman', 'Robert C. Martin', '1st', '978-0-13-235088-4', 'Prentice Hall', 2008, 2500, 'Software Development', 2),
('Introduction to Algorithms', 'Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein', '4th', '978-0-47-353305-9', 'Harvard, MIT', 2019, 699, 'Computers & Technology', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suggested_books`
--
ALTER TABLE `suggested_books`
  ADD PRIMARY KEY (`isbn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
