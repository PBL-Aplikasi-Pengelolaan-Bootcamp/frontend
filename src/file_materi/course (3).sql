-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 04:06 PM
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
-- Database: `course`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id_course` int(11) NOT NULL,
  `id_mentor` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` varchar(999) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `course_type` varchar(10) NOT NULL,
  `quota` int(11) NOT NULL,
  `course_picture` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id_course`, `id_mentor`, `title`, `slug`, `description`, `start_date`, `end_date`, `course_type`, `quota`, `course_picture`) VALUES
(21, 20, 'Membangun Aplikasi Berbasis Database dengan MySQL', 'membangun-aplikasi-berbasis-database-dengan-mysql', 'Kursus ini menawarkan panduan langkah demi langkah untuk membangun aplikasi berbasis database menggunakan MySQL. Anda akan belajar tentang perancangan database, pengembangan backend menggunakan MySQL, dan cara menyajikan data ke pengguna melalui antarmuka frontend. Dengan berbagai studi kasus dan proyek akhir, Anda akan mengembangkan aplikasi yang dapat menyimpan, mengelola, dan menampilkan data secara efisien. Kursus ini ideal bagi mereka yang ingin menggabungkan keterampilan pemrograman dengan pengetahuan database.', '2024-10-19', '2024-10-26', 'online', 10, 'mysql.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id_course`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
