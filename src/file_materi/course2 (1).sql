-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Des 2024 pada 13.55
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `course`
--

CREATE TABLE `course` (
  `id_course` int(11) NOT NULL,
  `id_mentor` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `course_type` varchar(10) NOT NULL,
  `quota` int(11) NOT NULL,
  `course_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `course`
--

INSERT INTO `course` (`id_course`, `id_mentor`, `title`, `slug`, `description`, `start_date`, `end_date`, `course_type`, `quota`, `course_picture`) VALUES
(29, 39, 'Mastering Web Development: HTML, CSS, and JavaScript', 'mastering-web-development-html-css-and-javascript', 'Kursus ini dirancang untuk pemula yang ingin memulai karier sebagai pengembang web. Anda akan mempelajari dasar-dasar pengembangan web, mulai dari struktur HTML, desain menggunakan CSS, hingga logika pemrograman dengan JavaScript. Dengan menyelesaikan kur', '2025-01-01', '2025-01-30', 'online', 2, 'zerotohero.jpg'),
(31, 51, 'Fundamentals of Cyber Security', 'fundamentals-of-cyber-security', 'Kursus ini dirancang untuk memberikan pemahaman dasar mengenai keamanan siber, meliputi ancaman dunia maya, metode perlindungan data, dan praktik terbaik dalam menjaga sistem informasi. Peserta akan mempelajari konsep dasar, memahami teknik serangan umum, dan bagaimana membangun sistem yang aman dari potensi ancaman.\r\n\r\n', '2024-12-04', '2025-01-04', 'online', 25, 'cyber.jpg'),
(32, 39, 'Dasar-Dasar Pemrograman: Langkah Awal Menjadi Programmer', 'dasar-dasar-pemrograman-langkah-awal-menjadi-programmer', 'Kursus ini dirancang untuk pemula yang ingin memulai perjalanan dalam dunia pemrograman. Anda akan belajar dasar-dasar pemrograman, konsep logika, dan implementasi sederhana menggunakan bahasa Python. Dengan pendekatan interaktif, kursus ini memastikan Anda memahami setiap langkah untuk membangun fondasi pemrograman yang kokoh.\r\n\r\n', '2024-12-04', '2024-12-25', 'online', 20, 'tes.jpg'),
(34, 56, 'Test penang', 'test-penang', 'Penang deskripsi', '2024-12-10', '2024-12-12', 'online', 12, 'lingga.jpg'),
(35, 57, 'Cyber Security', 'cyber-security', 'Course Cyber Security Junior', '2024-12-18', '2024-12-25', 'online', 25, '1000_F_647199954_RApLOkQ6JC4r69zUQVk1vC6UHIUYTryO.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `enroll`
--

CREATE TABLE `enroll` (
  `id_enroll` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `enroll_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `enroll`
--

INSERT INTO `enroll` (`id_enroll`, `id_student`, `id_course`, `status`, `enroll_date`) VALUES
(32, 55, 29, 'complete', '2024-12-04 21:00:46'),
(33, 49, 29, 'complete', '2024-12-05 18:29:38'),
(35, 49, 34, 'complete', '2024-12-10 16:18:40'),
(36, 49, 35, 'complete', '2024-12-18 19:09:34'),
(37, 49, 32, 'On going', '2024-12-24 20:26:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `information`
--

CREATE TABLE `information` (
  `id_information` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `information` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `information`
--

INSERT INTO `information` (`id_information`, `id_section`, `information`) VALUES
(20, 48, 'Link zoom : https://zoom.us/course/view.php?id=407ss'),
(26, 63, 'Link zoom : https://zoom.us/1dcr40Iw'),
(28, 64, 'Link zoom : https://zoom.us/course/view.php?id=407'),
(29, 65, 'Link zoom : https://zoom.us/course/view.php?id=407'),
(30, 65, 'Link zoom : https://zoom.us/course/view.php?id=407 alternatif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi_file`
--

CREATE TABLE `materi_file` (
  `id_materi_file` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materi_file`
--

INSERT INTO `materi_file` (`id_materi_file`, `id_section`, `file`) VALUES
(22, 51, 'BAHAN-PRESNTASI-PROJECT-SIPELITA-TEAM-PBL-TRPL111-1CMALAM-fix (1).pptx'),
(24, 65, 'pandu.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi_text`
--

CREATE TABLE `materi_text` (
  `id_materi_text` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materi_text`
--

INSERT INTO `materi_text` (`id_materi_text`, `id_section`, `content`) VALUES
(14, 48, 'Pengembangan web adalah proses membuat dan mengelola situs web menggunakan berbagai teknologi seperti HTML, CSS, dan JavaScript. Website dibagi menjadi dua jenis utama, yaitu statis dan dinamis. Pengembang web biasanya dibagi menjadi front-end, back-end, atau full-stack developer.'),
(15, 51, 'Dasar-Dasar HTML HTML (HyperText Markup Language) adalah bahasa markup untuk membuat struktur halaman web. Anda akan belajar tentang elemen-elemen seperti heading, paragraf, link, dan gambar. Form dan Input HTML Membuat form adalah bagian penting dalam web. Anda akan belajar cara menggunakan elemen form seperti input untuk teks, password, checkbox, radio button, dan button untuk submit data. Semantik HTML Elemen semantik seperti header, footer, section, dan article membantu meningkatkan aksesibilitas dan SEO situs web Anda.'),
(16, 64, 'Pemrograman adalah cara kita \"berkomunikasi\" dengan komputer. Dengan menulis kode dalam bahasa pemrograman, kita memberi tahu komputer apa yang harus dilakukan. Bayangkan komputer seperti koki, dan kode adalah resep masakannya. Jika kita memberikan instruksi yang benar, komputer akan menghasilkan hasil yang sesuai.\r\n\r\n'),
(18, 52, 'CSS (Cascading Style Sheets) adalah bahasa yang digunakan untuk mendesain tampilan dan tata letak halaman web. Dengan CSS, Anda dapat mengatur warna, jenis huruf, jarak antar elemen, tata letak, dan aspek visual lainnya dari situs web, sehingga lebih menarik dan profesional.'),
(19, 64, 'test'),
(20, 65, 'Di mana lokasi yang benar untuk menyisipkan file CSS eksternal dalam HTML?\r\n'),
(24, 64, 'tess'),
(25, 64, ''),
(26, 64, 'faefesfeeafawfawfaf'),
(27, 64, 'www');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi_video`
--

CREATE TABLE `materi_video` (
  `id_materi_video` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materi_video`
--

INSERT INTO `materi_video` (`id_materi_video`, `id_section`, `url`) VALUES
(18, 48, 'https://www.youtube.com/embed/t8Nxs7F4qEM?si=3VYPi4CrPdRqRE3X'),
(21, 51, 'https://www.youtube.com/embed/o6rj72vwGPA?si=Z-5Dvi9eBouZsess'),
(22, 52, 'https://www.youtube.com/embed/PKaA3xKiYF0?si=KFRGTa3UxknKaGR3'),
(25, 63, 'https://www.youtube.com/embed/z5nc9MDbvkw?si=w0ORGzUE1knLXZMA'),
(26, 64, 'https://www.youtube.com/embed/jGyYuQf-GeE?si=kd7YV9dF_hDzNMAp'),
(27, 65, 'https://www.youtube.com/embed/g27EoAqEfYs?si=fHp1DBngjD7G_KV-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mentor`
--

CREATE TABLE `mentor` (
  `id_mentor` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bio` longtext NOT NULL,
  `expertise` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `profil_picture` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mentor`
--

INSERT INTO `mentor` (`id_mentor`, `name`, `bio`, `expertise`, `telp`, `profil_picture`, `signature`) VALUES
(39, 'Nasyith Aditya', 'Saya ahli di bidang backend', 'Database', '+62 852 6590 0093', '20240811_141207.jpg', 'ttd_nasy.png'),
(51, 'Dinda Safitri', 'Saya merupakan seorang mentor dengan keahlian di bidang Cybersecurity dan Data Science. Dalam Cybersecurity, saya berpengalaman dalam ethical hacking, analisis kerentanan, dan pengembangan sistem keamanan berbasis AI. Sementara itu, dalam Data Science, saya menguasai machine learning, pengolahan data besar, serta visualisasi data menggunakan Python, R, dan Tableau. Dengan kombinasi unik ini, saya siap membimbing peserta memahami keamanan data sekaligus memanfaatkan data untuk pengambilan keputusan yang lebih baik.', 'Cyber Security, Data Science', '+62 813 7439 0181', 'PSFix_2024-08-11-13-13-18-transformed.png', 'sig-removebg-preview.png'),
(56, 'Pinang', 'pinang sebatang', 'sebatang', '0999', 'karimun.jpg', 'ttd_nasyith.png'),
(57, 'Numa', 'Saya seorang ahli di bidang database', 'Database', '+62 888 8888 8888', 'WhatsApp Image 2024-12-12 at 12.52.28.jpeg', 'ttd_numa.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `question`
--

INSERT INTO `question` (`id_question`, `id_quiz`, `question`) VALUES
(53, 23, 'Apa itu pemrograman?'),
(54, 23, 'Mengapa Python sering digunakan oleh pemula?'),
(55, 23, 'Apa fungsi dari print() dalam Python?'),
(60, 27, 'Apa kepanjangan dari CSS?'),
(61, 27, 'Manakah cara yang benar untuk mengubah warna latar belakang elemen menggunakan CSS?'),
(62, 27, 'Di mana lokasi yang benar untuk menyisipkan file CSS eksternal dalam HTML?'),
(63, 28, 'Soal 1'),
(64, 28, 'Soal 2'),
(65, 29, 'Soal Nomor 1'),
(67, 31, 'Soal Nomor 1'),
(68, 33, 'Soal 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `quiz`
--

INSERT INTO `quiz` (`id_quiz`, `id_section`, `title`) VALUES
(22, 63, 'Quiz Awalan Update'),
(23, 64, 'Dasar Pemrograman'),
(27, 52, 'CSS'),
(28, 65, 'Quiz Minggu 2'),
(29, 52, 'Quiz css'),
(31, 70, 'M1'),
(32, 48, 'Pengenalan Web'),
(33, 71, 'Quiz M1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz_answer`
--

CREATE TABLE `quiz_answer` (
  `id_quiz_answer` int(11) NOT NULL,
  `id_enroll` int(11) NOT NULL,
  `id_quiz_option` int(11) NOT NULL,
  `is_right` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `quiz_answer`
--

INSERT INTO `quiz_answer` (`id_quiz_answer`, `id_enroll`, `id_quiz_option`, `is_right`) VALUES
(140, 32, 233, 1),
(141, 32, 240, 1),
(142, 32, 241, 1),
(143, 33, 233, 1),
(144, 33, 240, 1),
(145, 33, 241, 1),
(150, 33, 253, 1),
(152, 35, 261, 1),
(153, 36, 265, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz_option`
--

CREATE TABLE `quiz_option` (
  `id_quiz_option` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `option` varchar(255) NOT NULL,
  `is_right` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `quiz_option`
--

INSERT INTO `quiz_option` (`id_quiz_option`, `id_question`, `option`, `is_right`) VALUES
(205, 53, 'Proses menulis kode yang dapat dimengerti oleh komputer untuk menyelesaikan tugas.\r\n', 1),
(206, 53, 'Proses mendesain perangkat keras komputer.\r\n', 0),
(207, 53, 'Cara membuat jaringan komputer.\r\n', 0),
(208, 53, 'Proses menggambar desain aplikasi.\r\n', 0),
(209, 54, 'Karena Python adalah satu-satunya bahasa pemrograman.\r\n', 0),
(210, 54, 'Karena sintaksnya sederhana dan mudah dipahami.\r\n', 1),
(211, 54, 'Karena Python hanya digunakan untuk membuat game.\r\n', 0),
(212, 54, 'Karena Python tidak memerlukan komputer untuk dijalankan.\r\n', 0),
(213, 55, 'Menyimpan data ke dalam file.\r\n', 0),
(214, 55, 'Menampilkan output ke layar.', 1),
(215, 55, 'Menghentikan program.\r\n', 0),
(216, 55, 'Membuat loop dalam program.\r\n', 0),
(233, 60, 'Cascading Style Sheets\r\n', 1),
(234, 60, 'Computer Style System\r\n', 0),
(235, 60, 'Creative Styling Syntax\r\n', 0),
(236, 60, 'Central Style Sheets\r\n', 0),
(237, 61, 'background: red;\r\n', 0),
(238, 61, 'color: red;\r\n', 0),
(239, 61, 'bg-color: red;\r\n', 0),
(240, 61, 'background-color: red;\r\n', 1),
(241, 62, 'Di dalam tag head\r\n', 1),
(242, 62, 'Di dalam tag body', 0),
(243, 62, 'Di dalam tag footer\r\n', 0),
(244, 62, 'Di dalam atribut meta\r\n', 0),
(245, 63, 'a ', 0),
(246, 63, 'b benar', 1),
(247, 63, 'c', 0),
(248, 63, 'd', 0),
(249, 64, 'a', 0),
(250, 64, 'b benar', 1),
(251, 64, 'c', 0),
(252, 64, 'd', 0),
(253, 65, 'a benar', 1),
(254, 65, 'b', 0),
(255, 65, 'c', 0),
(256, 65, 'd', 0),
(261, 67, 'a benar', 1),
(262, 67, 'b', 0),
(263, 67, 'c', 0),
(264, 67, 'd', 0),
(265, 68, 'a benar', 1),
(266, 68, 'b', 0),
(267, 68, 'c', 0),
(268, 68, 'd', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz_submission`
--

CREATE TABLE `quiz_submission` (
  `id_quiz_submission` int(11) NOT NULL,
  `id_enroll` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `score` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `quiz_submission`
--

INSERT INTO `quiz_submission` (`id_quiz_submission`, `id_enroll`, `id_quiz`, `score`) VALUES
(24, 32, 27, 100.00),
(25, 33, 27, 100.00),
(27, 33, 29, 100.00),
(29, 35, 31, 100.00),
(30, 36, 33, 100.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `section`
--

CREATE TABLE `section` (
  `id_section` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `section`
--

INSERT INTO `section` (`id_section`, `id_course`, `title`) VALUES
(48, 29, 'Pengenalan Pengembangan Web'),
(51, 29, 'HTML: Membangun Struktur Website'),
(52, 29, 'CSS: Mendesain Tampilan Website'),
(63, 31, 'Introduction to Cyber Security'),
(64, 32, 'Pendahuluan ke Pemrograman 1'),
(65, 32, 'Minggu kedua'),
(66, 29, 'Javascript: Membuat Website Interaktif'),
(70, 34, 'M1'),
(71, 35, 'M1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birth` date DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `profil_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`id_student`, `name`, `birth`, `telp`, `profil_picture`) VALUES
(49, 'Reno Pratama', '2001-12-12', '+62 5265 900 123', 'reno.jpeg'),
(54, 'Jimi Multhazam', '2001-03-06', '+62 852 6590 0111', 'jimi.jpg'),
(55, 'Pandu Fuzztoni', '2004-06-15', '+62 852 6590 00535', 'pandu(1).jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`) VALUES
(37, 'tyson', 'miketyson@gmail.com', '$2y$10$PjpWmauou4rZczWZZDZ33u9mNs.exdperjgPSsuhqcchc3X9uygS2', 'student'),
(38, 'admin', 'admin@gmail.com', '$2y$10$mUAeUyT3PC9LTjmlnaJgrur8kDhM.qfkMWF/xDnjng5X3ZZdgbtIi', 'admin'),
(39, 'nasyith', 'mnasyith2006@gmail.com', '$2y$10$6TjosjBgqFf3GspWkVoXGeIDfpECp2wM3P/5LR.Lcc0ReddjtZOLG', 'mentor'),
(40, 'nabil', 'nara@gmail.com', '$2y$10$kYPe/kb0LK9tHTChIdgdYu40K9L7sa85.gv86Ht.Oc6EyDsUFZqvi', 'student'),
(49, 'reno', 'reno@gmail.com', '$2y$10$VIFhiqe2hBArzVKkKvcebecVNv/s6jDdMlK1DREbLOTNTi/tJ10MK', 'student'),
(51, 'dinda', 'dinda@gmail.com', '$2y$10$JtKzmV0TTPSB/DyKkYsyre538liXOp/18kidAgERAwthwRI6vhemq', 'mentor'),
(54, 'jimi', 'jimi@gmail.com', '$2y$10$TOqgklBGZSDINolvhP5yb.iID9O1R9gpeMEw1C..Qjafvp6ryPRey', 'student'),
(55, 'pandu', 'pandu@gmail.com', '$2y$10$pRYl6zGTcEzLCttTnuUjq.0ngTd5LcewrKVbQ9/VqGyl2E5Ztispq', 'student'),
(56, 'pinang', 'mnabilfwfaw2005@gmail.com', '$2y$10$vZm8Wowwah6ThEiSfm3VUOIj2WobBUBQ6iN6IprEuSZIQUYDAi3Ji', 'mentor'),
(57, 'numa', 'numa@gmail.com', '$2y$10$2FdopkPhNAR/H4kCa44iSecowmc9mZJzlsvPMjd0US/eho4.1WDxi', 'mentor');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id_course`),
  ADD KEY `course_ibfk_1` (`id_mentor`);

--
-- Indeks untuk tabel `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`id_enroll`),
  ADD KEY `enroll_ibfk_1` (`id_student`),
  ADD KEY `enroll_ibfk_2` (`id_course`);

--
-- Indeks untuk tabel `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id_information`),
  ADD KEY `information_ibfk_1` (`id_section`);

--
-- Indeks untuk tabel `materi_file`
--
ALTER TABLE `materi_file`
  ADD PRIMARY KEY (`id_materi_file`),
  ADD KEY `materi_file_ibfk_1` (`id_section`);

--
-- Indeks untuk tabel `materi_text`
--
ALTER TABLE `materi_text`
  ADD PRIMARY KEY (`id_materi_text`),
  ADD KEY `materi_text_ibfk_1` (`id_section`);

--
-- Indeks untuk tabel `materi_video`
--
ALTER TABLE `materi_video`
  ADD PRIMARY KEY (`id_materi_video`),
  ADD KEY `materi_video_ibfk_1` (`id_section`);

--
-- Indeks untuk tabel `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id_mentor`);

--
-- Indeks untuk tabel `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `question_ibfk_1` (`id_quiz`);

--
-- Indeks untuk tabel `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_quiz`),
  ADD KEY `quiz_ibfk_1` (`id_section`);

--
-- Indeks untuk tabel `quiz_answer`
--
ALTER TABLE `quiz_answer`
  ADD PRIMARY KEY (`id_quiz_answer`),
  ADD KEY `quiz_answer_ibfk_1` (`id_enroll`),
  ADD KEY `quiz_answer_ibfk_2` (`id_quiz_option`);

--
-- Indeks untuk tabel `quiz_option`
--
ALTER TABLE `quiz_option`
  ADD PRIMARY KEY (`id_quiz_option`),
  ADD KEY `quiz_option_ibfk_1` (`id_question`);

--
-- Indeks untuk tabel `quiz_submission`
--
ALTER TABLE `quiz_submission`
  ADD PRIMARY KEY (`id_quiz_submission`),
  ADD KEY `quiz_submission_ibfk_1` (`id_enroll`),
  ADD KEY `quiz_submission_ibfk_2` (`id_quiz`);

--
-- Indeks untuk tabel `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id_section`),
  ADD KEY `section_ibfk_1` (`id_course`);

--
-- Indeks untuk tabel `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `course`
--
ALTER TABLE `course`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id_enroll` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `information`
--
ALTER TABLE `information`
  MODIFY `id_information` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `materi_file`
--
ALTER TABLE `materi_file`
  MODIFY `id_materi_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `materi_text`
--
ALTER TABLE `materi_text`
  MODIFY `id_materi_text` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `materi_video`
--
ALTER TABLE `materi_video`
  MODIFY `id_materi_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `quiz_answer`
--
ALTER TABLE `quiz_answer`
  MODIFY `id_quiz_answer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT untuk tabel `quiz_option`
--
ALTER TABLE `quiz_option`
  MODIFY `id_quiz_option` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT untuk tabel `quiz_submission`
--
ALTER TABLE `quiz_submission`
  MODIFY `id_quiz_submission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `section`
--
ALTER TABLE `section`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`id_mentor`) REFERENCES `mentor` (`id_mentor`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`) ON DELETE CASCADE,
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `information_ibfk_1` FOREIGN KEY (`id_section`) REFERENCES `section` (`id_section`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `materi_file`
--
ALTER TABLE `materi_file`
  ADD CONSTRAINT `materi_file_ibfk_1` FOREIGN KEY (`id_section`) REFERENCES `section` (`id_section`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `materi_text`
--
ALTER TABLE `materi_text`
  ADD CONSTRAINT `materi_text_ibfk_1` FOREIGN KEY (`id_section`) REFERENCES `section` (`id_section`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `materi_video`
--
ALTER TABLE `materi_video`
  ADD CONSTRAINT `materi_video_ibfk_1` FOREIGN KEY (`id_section`) REFERENCES `section` (`id_section`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mentor`
--
ALTER TABLE `mentor`
  ADD CONSTRAINT `mentor_ibfk_1` FOREIGN KEY (`id_mentor`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id_quiz`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`id_section`) REFERENCES `section` (`id_section`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz_answer`
--
ALTER TABLE `quiz_answer`
  ADD CONSTRAINT `quiz_answer_ibfk_1` FOREIGN KEY (`id_enroll`) REFERENCES `enroll` (`id_enroll`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_answer_ibfk_2` FOREIGN KEY (`id_quiz_option`) REFERENCES `quiz_option` (`id_quiz_option`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz_option`
--
ALTER TABLE `quiz_option`
  ADD CONSTRAINT `quiz_option_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz_submission`
--
ALTER TABLE `quiz_submission`
  ADD CONSTRAINT `quiz_submission_ibfk_1` FOREIGN KEY (`id_enroll`) REFERENCES `enroll` (`id_enroll`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_submission_ibfk_2` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id_quiz`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
