-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 06:50 AM
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
(1, 2, 'Frontend Pemula: Dasar-Dasar HTML dan CSS', '', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat iusto nemo provident cupiditate nobis at suscipit quam sapiente voluptatibus molestias.', NULL, NULL, '', 0, 'hero.jpg'),
(2, 1, 'Backend Pemula: Dasar-Dasar PHP dan MySQL', '', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat iusto nemo provident cupiditate nobis at suscipit quam sapiente voluptatibus molestias.', NULL, NULL, '', 0, 'smartphoneio.jpg'),
(7, 20, 'Frontend Framework: Dasar-Dasar Boostrap', '', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat iusto nemo provident cupiditate nobis at suscipit quam sapiente voluptatibus molestias.', NULL, NULL, '', 0, 'social.jpg'),
(8, 20, 'Backend Lanjutan: Dasar-Dasar Laravel', 'belajar-bahasa-pmerograman-php', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat iusto nemo provident cupiditate nobis at suscipit quam sapiente voluptatibus molestias.', NULL, NULL, '', 0, 'mysql.jpg'),
(9, 20, 'Belajar Js Dasar', 'belajar-js-dasar', 'BElajar pemrograman java script', NULL, NULL, '', 0, 'contoh.jpg'),
(10, 8, 'aaa', 'aaa', 'aaa', NULL, NULL, '', 0, 'Aplikasi Pengelolaan TrainingBootcamp (1).png'),
(11, 8, 'asd', 'asd', 'asd', NULL, NULL, '', 0, 'Admin.png'),
(12, 8, 'baru', 'baru', 'baru', NULL, NULL, '', 0, 'about.jpg'),
(13, 20, 'nais', 'nais', 'sas', NULL, NULL, '', 0, 'images (17).jpg'),
(14, 20, 'sons', 'sons', 'new', NULL, NULL, '', 0, 'contoh.jpg'),
(15, 20, 'Logitexh', 'logitexh', 'asavs', NULL, NULL, '', 0, 'opie.jpg'),
(16, 20, 'Nasyith course 01', 'nasyith-course-01', 'desc nasyith', '2024-10-17', '2024-10-19', 'online', 0, 'home.png'),
(17, 20, 'dw', 'dw', 'fafaef', '2024-10-17', '2024-10-19', 'offline', 0, 'home.png'),
(20, 20, 'Python Django', 'python-django', 'Okee', '2024-10-17', '2024-10-20', 'online', 30, 'SAVE_20240410_154445.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `id_enroll` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `enroll_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`id_enroll`, `id_student`, `id_course`, `status`, `enroll_date`) VALUES
(1, 23, 1, '', '2024-09-24 00:00:00'),
(3, 23, 2, '', '2024-09-24 00:00:00'),
(4, 23, 7, '', '2024-09-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id_information` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `information` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id_information`, `id_course`, `id_section`, `information`) VALUES
(1, 7, 7, 'ketiga'),
(2, 7, 7, 'acaw'),
(5, 7, 8, 'daawaawd'),
(6, 8, 20, 'Okee'),
(7, 8, 20, 'wadwaaw'),
(8, 13, 21, 'dwawcwacwa');

-- --------------------------------------------------------

--
-- Table structure for table `materi_file`
--

CREATE TABLE `materi_file` (
  `id_materi_file` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi_file`
--

INSERT INTO `materi_file` (`id_materi_file`, `id_course`, `id_section`, `file`) VALUES
(1, 7, 7, 'Muhammad Nasyith Aditya Putera_4342411060_TRPL 1B Malam_NN.txt'),
(2, 7, 7, 'KBIHU BAITUL AROFAH-1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `materi_text`
--

CREATE TABLE `materi_text` (
  `id_materi_text` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi_text`
--

INSERT INTO `materi_text` (`id_materi_text`, `id_course`, `id_section`, `content`) VALUES
(1, 7, 7, 'Text material pertama section pertama'),
(2, 7, 7, 'kedua');

-- --------------------------------------------------------

--
-- Table structure for table `materi_video`
--

CREATE TABLE `materi_video` (
  `id_materi_video` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `url` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi_video`
--

INSERT INTO `materi_video` (`id_materi_video`, `id_course`, `id_section`, `url`) VALUES
(1, 7, 7, 'https://www.youtube.com/embed/QOHE62AhB3k?si=umYLU6XndkeLyijI'),
(2, 7, 8, 'https://www.youtube.com/embed/-NduC11VRzM?si=3bWD5Lvp1uDFXELa'),
(3, 7, 7, 'https://www.youtube.com/embed/QOHE62AhB3k?si=umYLU6XndkeLyijI');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id` int(11) NOT NULL,
  `nama_matkul` varchar(20) NOT NULL,
  `dosen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id`, `nama_matkul`, `dosen`) VALUES
(1, 'PBD', 'Nasyith'),
(3, 'WEB', 'Nasyith'),
(4, 'Kalkulus', 'Dinda');

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `id_mentor` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bio` varchar(999) NOT NULL,
  `expertise` varchar(999) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `profil_picture` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`id_mentor`, `name`, `bio`, `expertise`, `telp`, `profil_picture`) VALUES
(1, 'Adam', '123', '123', '', ''),
(2, 'Debby', 'Debby nih bos', 'Java scip', '', ''),
(19, 'Adi', '\r\ndawwda', 'JS', 'iojow', 'Zoom background.png'),
(20, 'Nasyith Aditya', 'Saya merupakan seorang backend developer profesional ', 'Database', '085265900093', 'nasyith.jpg'),
(26, 'mentor3', 'Saya lulusan dari smk7', 'py', '1233', 'Ummul Qura 1445H - 2024M.jpeg'),
(27, 'bunda', 'bunda bio', 'expertbunda', '1234', 'PesertaUser mendaftar secara offline (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `peserta_course`
--

CREATE TABLE `peserta_course` (
  `id_peserta_course` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `enroll_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta_course`
--

INSERT INTO `peserta_course` (`id_peserta_course`, `id_student`, `id_course`, `enroll_date`) VALUES
(1, 1, 1, '2024-09-06'),
(2, 1, 2, '2024-09-06'),
(3, 1, 1, '0000-00-00'),
(4, 1, 2, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id_section` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id_section`, `id_course`, `title`) VALUES
(1, 9, 'Pertama'),
(3, 9, 'Ketiga'),
(4, 9, 'Keempat'),
(5, 9, 'Kelima'),
(7, 7, 'Section pertama'),
(20, 8, 'Backend 1'),
(21, 13, 'Nais 1'),
(22, 7, 'Section Kedua'),
(23, 7, 'Section ketiga');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(999) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `pendidikan_terakhir` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_student`, `nama_lengkap`, `tgl_lahir`, `alamat`, `no_telp`, `pendidikan_terakhir`) VALUES
(23, 'dinda', NULL, NULL, NULL, NULL),
(24, 'siswa pertama', NULL, NULL, NULL, NULL),
(28, 'tes', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `id_student` int(11) NOT NULL,
  `id_course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(999) NOT NULL,
  `email` varchar(999) NOT NULL,
  `password` varchar(999) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`) VALUES
(7, 'admin', 'baru@gmail.com', '$2y$10$0g92lCrkCsvqJL.66r9IaerbzIqwybC0Z/AUuRc514uRM0RyKQ/Pm', 'admin'),
(8, 'asd', 'mnasyith2006@gmail.com', '$2y$10$nWNnTol2wpQMiQFTEJWbtuAgVw4bKzkEolRqF.RaZnxal5bbmh2bu', 'mentor'),
(19, 'adi', 'mnasyith2006@gmail.com', '$2y$10$0RU2Tpf/aIr94KF7uJ3Z5e2QrHZ8VWNQr4mQ4QqWzPu0AMUiob2vO', 'mentor'),
(20, 'nasyith', 'mnasyith2006@gmail.com', '$2y$10$yCe4lgjpxTNgGrBkY6Wcq.aDBwcu4nQxR4OD2SmsGdieomd2/Ipp.', 'mentor'),
(24, 'siswa1', 'siswa@gmail.com', '$2y$10$E0EW8.485QE0uEjSlWVmNOxgpWQdP1ed4rb4d5TLm5RJNDZmhLEBW', 'student'),
(25, 'mentor2', 'baru@gmail.com', '$2y$10$49TMah5szXkjrFW3Mo/GVuAyh8JlIhEpOF1O1xtzK3cAgs6X.7elO', 'mentor'),
(26, 'mentor3', 'maganginforsys@gmail.com', '$2y$10$8SJySXL.Sn3lY.qQwA4J5.SsMK14CdiVDxDMPp7t5btFBVYkhss2m', 'mentor'),
(27, 'bunda', 'bunda@gmail.com', '$2y$10$cMs6qSfD4e/cBYD/Upk8y.Eir/jXWH0oWMHRWjdVvUOJPsdPOZCX.', 'mentor'),
(28, 'tes', 'tes@gmail.com', '$2y$10$1EJ0pmpv178AXtXeEu8As.HTRsO5nlXhW39JjWm5stKppYmgYI9am', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id_course`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`id_enroll`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id_information`);

--
-- Indexes for table `materi_file`
--
ALTER TABLE `materi_file`
  ADD PRIMARY KEY (`id_materi_file`);

--
-- Indexes for table `materi_text`
--
ALTER TABLE `materi_text`
  ADD PRIMARY KEY (`id_materi_text`);

--
-- Indexes for table `materi_video`
--
ALTER TABLE `materi_video`
  ADD PRIMARY KEY (`id_materi_video`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id_mentor`);

--
-- Indexes for table `peserta_course`
--
ALTER TABLE `peserta_course`
  ADD PRIMARY KEY (`id_peserta_course`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id_section`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id_enroll` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id_information` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `materi_file`
--
ALTER TABLE `materi_file`
  MODIFY `id_materi_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materi_text`
--
ALTER TABLE `materi_text`
  MODIFY `id_materi_text` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materi_video`
--
ALTER TABLE `materi_video`
  MODIFY `id_materi_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id_mentor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `peserta_course`
--
ALTER TABLE `peserta_course`
  MODIFY `id_peserta_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
