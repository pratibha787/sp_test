-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 19, 2023 at 12:08 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spovum`
--

-- --------------------------------------------------------

--
-- Table structure for table `test_spovum`
--

DROP TABLE IF EXISTS `test_spovum`;
CREATE TABLE IF NOT EXISTS `test_spovum` (
  `slno` int NOT NULL AUTO_INCREMENT,
  `folderName` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `fileName` varchar(20) NOT NULL,
  `colA` int NOT NULL,
  `colB` int NOT NULL,
  PRIMARY KEY (`slno`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `test_spovum`
--

INSERT INTO `test_spovum` (`slno`, `folderName`, `date`, `fileName`, `colA`, `colB`) VALUES
(1, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 8, 2),
(2, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 7, 2),
(3, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 6, 2),
(4, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 5, 2),
(5, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 4, 2),
(6, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 3, 2),
(7, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 2, 2),
(8, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 1, 2),
(9, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 8, 2),
(10, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 7, 2),
(11, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 5, 2),
(12, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 4, 2),
(13, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 3, 2),
(14, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 2, 2),
(15, '20301112_8_20301112_', '2030-11-10', 'DM_values.txt', 1, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
