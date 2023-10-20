-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 06:06 PM
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
-- Database: `loler`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `u_card` varchar(100) NOT NULL,
  `u_f_name` varchar(100) NOT NULL,
  `u_l_name` varchar(100) NOT NULL,
  `u_prodi` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `uploaded` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('student','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `u_card`, `u_f_name`, `u_l_name`, `u_prodi`, `image`, `uploaded`, `username`, `password`, `level`) VALUES
(28, 'lol', 'lol', 'lol', 'lol', '1076411747_IMG_20231011_215727.jpg', '2023-10-17 21:38:33', 'lol', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'student'),
(29, '11', '1', '1', '1', '818272941_Materi-IF331-M06-Pemrograman Deklaratif (1).pptx', '2023-10-17 21:41:30', 'lal', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'student'),
(30, 'dd', 'asdsas', 'sadas', 'dasda', '1135430802_Materi-IF331-M06-Pemrograman Deklaratif (1).pptx', '2023-10-17 21:48:30', '123131', '17ba0791499db908433b80f37c5fbc89b870084b', 'student'),
(31, 'admin', 'adminad', 'admin', 'adminadm', '1638746885_IMG_20231011_215727.jpg', '2023-10-17 22:04:56', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin'),
(32, '11', '11', '11', '11', '714592824_Materi-IF331-M06-Pemrograman Deklaratif (1).pptx', '2023-10-17 22:44:36', '1234', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
