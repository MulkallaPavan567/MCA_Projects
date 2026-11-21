-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 08:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `add_new_books`
--

CREATE TABLE `add_new_books` (
  `book_name` varchar(200) DEFAULT NULL,
  `author` varchar(200) DEFAULT NULL,
  `edition` varchar(10) DEFAULT NULL,
  `isbn` varchar(20) NOT NULL,
  `publisher` varchar(200) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `cost` int(10) DEFAULT NULL,
  `field` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_new_books`
--

INSERT INTO `add_new_books` (`book_name`, `author`, `edition`, `isbn`, `publisher`, `year`, `cost`, `field`) VALUES
('Database System Concepts', 'Abraham Silberschatz, Henry F. Korth, S. Sudarshan', '7th', '978-0-07-802215-9', 'McGraw-Hill Education', 2019, 6000, 'Databases'),
('Computer Networks', 'Andrew S. Tanenbaum, David J. Wetherall', '5th', '978-0-13-212695-3', 'Pearson', 2010, 4000, 'Networking'),
('Clean Code: A Handbook of Agile Software Craftsman', 'Robert C. Martin', '1st', '978-0-13-235088-4', 'Prentice Hall', 2008, 2500, 'Software Development'),
('Artificial Intelligence: A Modern Approach', 'Stuart Russell, Peter Norvig', '4th', '978-0-13-461099-5', 'Pearson', 2020, 5000, 'Artificial Intelligence'),
('The Pragmatic Programmer: Your Journey to Mastery', 'Andrew Hunt, David Thomas', '20th ', '978-0-13-595705-9', 'Addison-Wesley', 2019, 3000, 'Software Development'),
('Linear Algebra and Learning from Data', 'Gilbert Strang', '2nd', '978-0-16-921963-0', 'Cambridge University Press', 2019, 599, 'Machine Learning'),
('Transfer Learning', 'Qiang Yang , Yu Zhang , Wenyuan Dai , Sinno Jialin Pan', '2nd', '978-1-10-701690-3', 'Cambridge University Press', 2020, 499, 'Pattern recognition'),
('Adversarial Machine Learning', 'Anthony D. Joseph , Blaine Nelson , Benjamin I. P. Rubinstein , J. D. Tygar', '2nd', '978-1-10-704346-6', 'Cambridge University Press', 2019, 599, 'Information theory'),
('Variational Bayesian Learning Theory', 'Shinichi Nakajima , Kazuho Watanabe , Masashi Sugiyama', '2nd', '978-1-10-707615-0', 'Cambridge University Press', 2019, 110, 'Machine learning');

-- --------------------------------------------------------

--
-- Table structure for table `approved_books`
--

CREATE TABLE `approved_books` (
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
-- Dumping data for table `approved_books`
--

INSERT INTO `approved_books` (`book_name`, `author`, `edition`, `isbn`, `publisher`, `year`, `cost`, `field`, `quantity`) VALUES
('Computer Networks', 'Andrew S. Tanenbaum, David J. Wetherall', '5th', '978-0-13-212695-3', 'Pearson', 2010, 4000, 'Networking', 2),
('Introduction to Algorithms', 'Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein', '4th', '978-0-47-353305-9', 'Harvard, MIT', 2019, 699, 'Computers & Technology', 3);

-- --------------------------------------------------------

--
-- Table structure for table `approved_journals`
--

CREATE TABLE `approved_journals` (
  `journalName` varchar(200) NOT NULL,
  `journalNumber` varchar(30) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `year` int(4) NOT NULL,
  `cost` int(10) NOT NULL,
  `field` varchar(200) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved_journals`
--

INSERT INTO `approved_journals` (`journalName`, `journalNumber`, `publisher`, `year`, `cost`, `field`, `quantity`) VALUES
('Material Science Research India', '0973-3469', 'Science Publications', 2023, 99, ' Material science', 1),
('International Journal of Computer Networks And Applications', '2395-0455', 'MIT Press', 2021, 149, 'Computer science, computer networks', 2),
('Cognitive Science', '4973-7374', 'Oxford', 2000, 99, 'Computer Science', 1);

-- --------------------------------------------------------

--
-- Table structure for table `create_new_user`
--

CREATE TABLE `create_new_user` (
  `fname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `create_new_user`
--

INSERT INTO `create_new_user` (`fname`, `username`, `password`) VALUES
('Bob Williams', 'bob@gmail.com', 'StrongPass1'),
('Faculty', 'faculty@gmail.com', 'Faculty@123'),
('Jane Smith', 'jane@gmail.com', 'Secure123'),
('John Doe', 'john@gmail.com', 'Pa$$w0rd'),
('Praveen Kumar', 'praveen@gmail.com', 'Praveen_567'),
('Sunny Paul', 'sunny@gmail.com', 'Sunny_567');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `journalName` varchar(200) NOT NULL,
  `journalNumber` varchar(30) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `year` int(4) NOT NULL,
  `cost` int(10) NOT NULL,
  `field` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`journalName`, `journalNumber`, `publisher`, `year`, `cost`, `field`) VALUES
('Educational Research', '2141-5161', 'Science World', 2023, 99, 'Science'),
('International Research Journal of Arts and Social Sciences', '2276-6502', 'Academic Press', 2020, 199, 'Social Sciences'),
('Cognitive Science', '4973-7374', 'Oxford', 2000, 99, 'Computer Science'),
('Journal of Medicine and Medical Sciences', '5214-9477', 'Science World', 2021, 199, 'Medicine');

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
  `quantity` int(10) NOT NULL,
  `num_of_faculty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggested_books`
--

INSERT INTO `suggested_books` (`book_name`, `author`, `edition`, `isbn`, `publisher`, `year`, `cost`, `field`, `quantity`, `num_of_faculty`) VALUES
('Database System Concepts', 'Abraham Silberschatz, Henry F. Korth, S. Sudarshan', '7th', '978-0-07-802215-9', 'McGraw-Hill Education', 2019, 6000, 'Databases', 2, 1),
('Computer Networks', 'Andrew S. Tanenbaum, David J. Wetherall', '5th', '978-0-13-212695-3', 'Pearson', 2010, 4000, 'Networking', 1, 1),
('Clean Code: A Handbook of Agile Software Craftsman', 'Robert C. Martin', '1st', '978-0-13-235088-4', 'Prentice Hall', 2008, 2500, 'Software Development', 1, 1),
('Linear Algebra and Learning from Data', 'Gilbert Strang', '2nd', '978-0-16-921963-0', 'Cambridge University Press', 2019, 599, 'Machine Learning', 1, 1),
('Introduction to Algorithms', 'Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein', '4th', '978-0-47-353305-9', 'Harvard, MIT', 2019, 699, 'Computers & Technology', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `suggested_journals`
--

CREATE TABLE `suggested_journals` (
  `journalName` varchar(200) NOT NULL,
  `journalNumber` varchar(20) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `year` int(4) NOT NULL,
  `cost` int(10) NOT NULL,
  `field` varchar(200) NOT NULL,
  `quantity` int(10) NOT NULL,
  `num_of_faculty` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggested_journals`
--

INSERT INTO `suggested_journals` (`journalName`, `journalNumber`, `publisher`, `year`, `cost`, `field`, `quantity`, `num_of_faculty`) VALUES
('Journal of Education Research and Development', '1768-6653', ' Learning Solutions Press', 2021, 299, ' Education', 2, 1),
('Cognitive Science', '4973-7374', 'Oxford', 2000, 99, 'Computer Science', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
('1', 'admin1@gmail.com', 'Password@123'),
('2', 'admin2@gmail.com', 'Password_123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_new_books`
--
ALTER TABLE `add_new_books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `approved_books`
--
ALTER TABLE `approved_books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `approved_journals`
--
ALTER TABLE `approved_journals`
  ADD PRIMARY KEY (`journalNumber`);

--
-- Indexes for table `create_new_user`
--
ALTER TABLE `create_new_user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`journalNumber`);

--
-- Indexes for table `suggested_books`
--
ALTER TABLE `suggested_books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `suggested_journals`
--
ALTER TABLE `suggested_journals`
  ADD PRIMARY KEY (`journalNumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
