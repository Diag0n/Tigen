-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 08:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tigen`
--

-- --------------------------------------------------------

--
-- Table structure for table `kayttajat`
--

CREATE TABLE `kayttajat` (
  `kayttajaID` int(255) NOT NULL,
  `nimi` varchar(1000) NOT NULL,
  `sahkoposti` varchar(1000) NOT NULL,
  `salasana` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tilaus`
--

CREATE TABLE `tilaus` (
  `kayttajaID` int(255) NOT NULL,
  `tuoteID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tuotteita`
--

CREATE TABLE `tuotteita` (
  `nimi` varchar(1000) NOT NULL,
  `tietoa` varchar(1000) NOT NULL,
  `hinta` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `kuva` varchar(1000) NOT NULL,
  `tuoteID` int(255) NOT NULL,
  `maara` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuotteita`
--

INSERT INTO `tuotteita` (`nimi`, `tietoa`, `hinta`, `id`, `kuva`, `tuoteID`, `maara`) VALUES
('Niken Lenkkarit', 'Vain ja pelkästään 101% Asbestia!', 70, 1, '/Testi1/kuvat/tuotteet/1.jpeg', 1, 2),
('Kunnon Työkengät', 'Tehty vain laadukkaimmasta uraanista!', 60, 2, '/Testi1/kuvat/tuotteet/kengät1m.jpeg', 2, 3),
('Kunnon Korkkarit (Musta)', 'Ei sitä kunnon korkkareita parempaa korkata!', 90, 3, '/Testi1/kuvat/tuotteet/kengät2n.jpg', 3, 160);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
