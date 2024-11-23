<?php
include 'function.php';

//data user login
$data_login = get_data_user_login();


$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

//get all course
$courses = getAll_Course($id_user);

//get course yg di  enroll
$enrolledCourses = getEnrolledCourses($id_user);




//logout
if (isset($_POST['logout'])) {
    logout();
}

if (isset($_POST['edit_profil'])) {
    edit_profil($_POST, $data_login['id_user']);
}


if (isset($_SESSION['role']) && $_SESSION['role'] == 'mentor') {
    // Redirect ke halaman mentor/dashboard-mentor.php
    header("Location: mentor/dashboard-mentor.php");
    exit; // Menghentikan eksekusi kode setelah redirect
}

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    // Redirect ke halaman mentor/dashboard-mentor.php
    header("Location: admin/dashboard-admin.php");
    exit; // Menghentikan eksekusi kode setelah redirect
}





?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simplify | Kejar impianmu di Simplify</title>
    <link href="output.css" rel="stylesheet" />
    <link href="img/logo.png" rel="shortcut icon" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</head>

<body>
    <div class=" m-auto bg-white">
        <!-- NAVBAR -->

        <nav id="top"
            class="flex z-10 shadow-lg border border-slate-200 bg-opacity-95 justify-between mx-5 bg-white rounded-full px-3 py-4 fixed left-0 top-3 right-0 font-poppins md:rounded-none md:top-0 md:mx-0 md:py-5">

            <div class="flex gap-3">
                <div class="relative md:hidden">
                    <button id="dropdownButton"
                        class="flex items-center text-gray-700 hover:text-blue-700 focus:outline-none">
                        <span class="mr-2"></span>
                        <svg class="w-8 my-auto relative h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7">
                            </path>
                        </svg>
                    </button>

                    <ul id="dropdownMenu"
                        class="absolute left-0 z-10 hidden bg-white shadow-lg rounded-md mt-6 my-auto">
                        <li><a href="index.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Beranda</a>
                        </li>
                        <li><a href="kursus.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kursus</a>
                        </li>
                        <li><a href="about.php#visi" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Tentang</a>
                        </li>
                        <li><a href="#kontak" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kontak</a></li>
                        <li><a href="coourse_anda.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Course
                                Anda</a></li>
                        <li></li>
                    </ul>
                </div>


                <div class="flex gap-1 my-auto">
                    <div class="">
                        <img src="img/logo.png" class="w-7 h-7 md:w-10 md:h-10" alt="">
                    </div>
                    <h1 class="font-poppins text-xl font-bold relative md:hidden">Simplify
                    </h1>
                </div>


                <ul class="gap-4 hidden md:flex font-semibold relative my-auto">
                    <li><a href="index.php" class="hover:text-blue-700">Beranda</a></li>
                    <li><a href="kursus.php" class="hover:text-blue-700">Kursus</a></li>
                    <li><a href="#about" class="hover:text-blue-700">Tentang</a></li>
                    <li><a href="#kontak" class="hover:text-blue-700">Kontak</a></li>
                    <?php if (isset($_SESSION['id_user'])) : ?>
                        <li><a href="course_anda.php" class="hover:text-blue-700">Kursus Anda</a></li>
                    <?php endif ?>
                </ul>
            </div>





            <div class="flex gap-5 w-max">
                <?php if (!isset($_SESSION['id_user'])) : ?>
                    <div class=" gap-5 font-semibold flex my-auto">
                        <a href="login.php"
                            class="border rounded-full py-1 px-6 font-medium md:font-semibold bg-blue-700 text-white md:bg-white md:border-blue-700 md:rounded-sm md:hover:bg-blue-700 md:py-2 md:px-5 md:text-black md:flex hover:bg-skytext-blue-700 hover:text-white">Masuk</a>
                        <a href="buat-akun.php"
                            class="md:border hidden md:flex md:border-blue-700 md:rounded-sm bg-blue-700 py-2 px-5 text-white hover">Daftar</a>
                    </div>
                <?php endif ?>


                <?php if (isset($_SESSION['id_user'])) : ?>
                    <div class="gap-5 font-semibold flex my-auto">
                        <form method="POST" action="">
                            <button type="submit" name="logout"
                                class="border rounded-full py-1 px-6 font-medium md:font-semibold bg-blue-700 text-white md:bg-white md:border-blue-700 md:rounded-sm md:hover:bg-blue-700 md:py-2 md:px-5 md:text-black md:flex hover:bg-skytext-blue-700 hover:text-white">
                                Logout
                            </button>
                        </form>
                    </div>
                <?php endif ?>


                <?php if (isset($_SESSION['id_user'])) : ?>
                    <button id="open-modal-btn">
                        <div class=" gap-2 w-max flex">
                            <h1 class="font-semibold relative my-auto hidden sm:flex"><?= $data_login['username'] ?></h1>
                            <img src="foto_student/<?= isset($data_login['profil_picture']) ? $data_login['profil_picture'] : 'profil_default.png' ?>"
                                alt="" class="w-8 h-8 md:w-12 md:h-12 rounded-full">
                        </div>
                    </button>
                <?php endif ?>

                <!-- MODAL WRAPPER -->
                <div id="modal-wrapper" class="fixed z-10 inset-0 hidden overflow-y-auto">
                    <div
                        class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                        <!-- MODAL BOX -->
                        <div
                            class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3">
                            <form method="post" enctype="multipart/form-data" class="flex flex-col gap-5 my-2 w-full">

                                <div class="flex flex-col gap-2">
                                    <label for="username">Username</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="username" name="username" type="text" placeholder="Masukkan username" required
                                        value="<?= $data_login['username'] ?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="name">Nama</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="name" name="name" type="text" placeholder="Masukkan nama" required
                                        value="<?= $data_login['name'] ?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="email">Email</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="email" name="email" type="email" placeholder="Masukkan email" required
                                        value="<?= $data_login['email'] ?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="birth">Birth</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="birth" name="birth" type="date" placeholder="Masukkan tanggal lahir" required
                                        value="<?= $data_login['birth'] ?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="telp">Telp</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="telp" name="telp" type="text" placeholder="Masukkan nomor telp" required
                                        value="<?= $data_login['telp'] ?>">
                                </div>



                                <div class="flex flex-col gap-2">
                                    <label for="profil_picture">Foto Profil</label>
                                    <input type="file" accept="image/*" name="profil_picture" id="profil_picture"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                    <!-- Hidden input untuk menyimpan base64 gambar yang sudah di-crop -->
                                    <input type="hidden" name="cropped_image" id="cropped_image">

                                    <div class="relative w-12 h-12">
                                        <img src="foto_student/<?= $data_login['profil_picture'] ?>" alt=""
                                            id="preview-image" class="w-12 h-12 object-cover rounded-full">
                                    </div>
                                </div>


                                <div class="flex justify-end gap-2">
                                    <button id="close-modal-btn"
                                        class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                    <button type="submit" name="edit_profil"
                                        class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                </div>

                            </form>

                            <div id="cropperModal"
                                class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
                                <div class="bg-white rounded-lg max-w-2xl w-full">
                                    <div class="flex justify-between items-center p-4 border-b">
                                        <h3 class="text-lg font-semibold">Crop Image</h3>
                                        <button type="button" onclick="closeCropperModal()"
                                            class="text-gray-500 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <div class="max-h-[60vh] overflow-hidden">
                                            <img id="cropperImage" class="max-w-full">
                                        </div>
                                        <div class="mt-4 flex justify-end gap-2">
                                            <button type="button" onclick="applyCrop()"
                                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                Apply Crop
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>


            </div>

        </nav>

        <!-- HEADER -->
        <header
            class="relative top-40 text-center px-4 flex flex-col gap-5 md:gap-6 md:width-header m-auto md:w-5/6 md:top-56 lg:w-2/3">
            <h1 class="font-bold font-poppins text-3xl md:text-5xl lg:text-6xl lg:tracking-normal">Solusi Untuk Anda
                yang
                bingung
                ingin
                <span class="text-blue-700">
                    Memulai Pemrograman</span>
            </h1>
            <p class="font-poppins text-slate-500 text-lg lg:text-xl">Kami akan membantu anda untuk mencapai tujuan anda
                dengan terstruktur,
                tentunya dengan mudah dan simpel. Tunggu apalagi? Daftar Sekarang.</p>

            <?php if (!isset($_SESSION['id_user'])) { ?>
                <a href="buat-akun.php"
                    class=" text-white transition-all py-3 px-5 rounded-sm w-max m-auto font-poppins font-semibold 
                tracking-wide border bg-blue-700 border-slatetext-blue-700 hover:bg-white hover:border hover:text-blue-700 hover:border-blue-700">Daftar
                    Sekarang</a>
            <?php } ?>
        </header>


        <!-- PROSPEK KERJA -->
        <div id="about"
            class="flex relative bg-slate-50 mt-60 lg:mt-80 justify-between sm:justify-center text-center flex-col-reverse gap-4 p-10 lg:flex-row">
            <div class="flex flex-col m-auto gap-5 md:w-1/2 lg:gap-5 md:my-auto">
                <h1 class="font-poppins font-semibold text-3xl hidden lg:flex text-slate-700">Prospek Kerja Impian</h1>
                <p class="lg:text-left lg:w-4/5 font-quicksand text-slate-600">Perkembangan teknologi dapat membuka
                    peluang
                    kerja bagi seseorang. Apalagi di era digital saat ini. Pemrograman merupakan salah satu profesi yang
                    banyak
                    diminati oleh kalangan anak muda saat ini. Selain itu, profesi ini dinilai memiliki prospek masa
                    depan.
                    Kata-kata "keren" dan "gaji besar" sering kali dilontarkan kepada para programmer. Hal ini tentunya
                    sangat
                    menarik terutama bagi Anda yang ingin merasakan manisnya menjadi seorang programmer yang terampil.
                    Tidak hanya
                    itu, programmer juga memiliki hubungan kerja seperti IT support, desainer grafis, analis data,
                    pemasaran
                    digital, guru dan lain-lain.</p>
                <a href="#"
                    class="bg-blue-700 hidden text-white border border-skytext-blue-700 rounded-sm w-max hover:bg-white hover:text-blue-700 border-blue-700 py-2 px-3 m-auto font-poppins font-semibold lg:ml-0 lg:mt-0">Selengkapnya</a>
            </div>

            <div class="flex flex-wrap gap-5 m-auto justify-around md:justify-between lg:justify-normal md:w-1/2">
                <div
                    class="flex flex-col w-28 bg-white shadow-md p-3 rounded-2xl text-left gap-2 md:w-44 lg:h-52 m-auto">
                    <ion-icon name="git-branch" class="text-3xl bg-white text-slate-700 rounded-xl p-1"></ion-icon>
                    <h1 class="font-poppins font-semibold tracking-wide">Software Engineer</h1>
                    <p class="hidden lg:flex text-sm">Merancang dan memelihara perangkat lunak sistem dengan benar.</p>
                </div>

                <div
                    class="flex flex-col w-28 bg-white shadow-md p-3 rounded-2xl text-left gap-2 md:w-44 lg:h-52 m-auto">
                    <ion-icon name="settings" class="text-3xl text-slate-700 rounded-xl p-1"></ion-icon>
                    <h1 class="font-poppins font-semibold tracking-wide">IT <br class="md:hidden">Support</h1>
                    <p class="hidden lg:flex text-sm">Membantu menyelesaikan berbagai permasalahan teknologi yang
                        dimiliki
                        perusahaan.</p>
                </div>

                <div
                    class="flex flex-col w-28 bg-white shadow-md p-3 rounded-2xl text-left gap-2 md:w-44 lg:h-52 m-auto">
                    <ion-icon name="brush" class="text-3xl text-slate-700 rounded-xl p-1"></ion-icon>
                    <h1 class="font-poppins font-semibold tracking-wide">Graphic Designer</h1>
                    <p class="hidden lg:flex text-sm">Suatu bentuk komunikasi yang dilakukan secara visual.</p>
                </div>

                <div
                    class="flex flex-col w-28 bg-white shadow-md p-3 rounded-2xl text-left gap-2 md:w-44 lg:h-52 m-auto">
                    <ion-icon name="stats" class="text-3xl text-slate-700 rounded-xl p-1"></ion-icon>
                    <h1 class="font-poppins font-semibold tracking-wide">Analyst Data</h1>
                    <p class="hidden lg:flex text-sm">Jelajahi dan kembangkan data besar untuk membantu membuat
                        keputusan yang
                        lebih baik.
                    </p>
                </div>

                <div
                    class="flex flex-col w-28 bg-white shadow-md p-3 rounded-2xl text-left gap-2 md:w-44 lg:h-52 m-auto">
                    <ion-icon name="trending-up" class="text-3xl text-slate-700 rounded-xl p-1"></ion-icon>
                    <h1 class="font-poppins font-semibold tracking-wide">Digital Marketing</h1>
                    <p class="hidden lg:flex text-sm">promosi suatu merek atau merek produk atau jasa dilakukan melalui
                        media
                        digital.</p>
                </div>

                <div
                    class="flex flex-col w-28 bg-white shadow-md p-3 rounded-2xl text-left gap-2 md:w-44 lg:h-52 m-auto">
                    <ion-icon name="school" class="text-3xl text-slate-700 rounded-xl p-1"></ion-icon>
                    <h1 class="font-poppins font-semibold tracking-wide">Tenaga Pengajar</h1>
                    <p class="hidden lg:flex text-sm">Menjadi sekolah, kursus atau guru pribadi</p>
                </div>
            </div>

            <h1 class="font-poppins font-semibold text-3xl mb-5 lg:hidden">Prospek Kerja Impian</h1>
        </div>

        <!-- Enroll Course -->




        <!-- POPULAR COURSE -->
        <h1 class="mt-10 font-semibold font-poppins text-2xl text-center">Program Kursus Terbaru</h1>

        <div class="flex flex-wrap gap-5 m-auto justify-between text-start mt-10 px-10">

            <?php foreach ($courses as $data) { ?>
                <a href="<?= 'kursus_materi.php?kursus=' . $data['slug']; ?>"
                    class="flex flex-col m-auto w-36 h-max shadow-xl rounded-lg md:w-80 overflow-hidden transition-all hover:scale-105">
                    <img src="foto_cover_course/<?= $data['course_picture'] ?>" alt="" class="object-center md:h-40">
                    <div class="px-3 py-3 flex flex-col gap-2">
                        <h1 class="font-poppins font-semibold text-sm md:text-base lg:text-left"><?= $data['title'] ?>
                        </h1>

                        <div class="flex flex-wrap gap-2 text-xs font-bold font-poppins text-slate-800">
                            <h1 class="bg-green-300 px-2 py-0.5 rounded-lg"><?= $data['course_type'] ?></h1>
                            <h1 class="bg-gray-300 px-2 py-0.5 rounded-lg hidden md:block"><?= $data['quota'] ?> Quota</h1>
                            <?php
                            $formattedStartDate = date('j F Y', strtotime($data['start_date']));
                            $formattedEndDate = date('j F Y', strtotime($data['end_date']));
                            ?>
                            <h1 class="bg-gray-300 px-2 py-0.5 rounded-lg hidden md:block"><?= $formattedStartDate ?> -
                                <?= $formattedEndDate ?></h1>
                        </div>

                        <p class="hidden md:flex text-left">
                            <?= strlen($data['description']) > 200 ? substr($data['description'], 0, 200) . '...' : $data['description'] ?>
                        </p>
                    </div>
                </a>
            <?php } ?>

        </div>
        <div class="m-auto w-max mt-10">
            <a href="kursus.php" class="text-white transition-all py-3 px-5 rounded-sm w-max font-poppins font-semibold 
    tracking-tight border bg-blue-700 border-blue-700 hover:bg-white hover:border hover:text-blue-700 m-auto">Program
                Lainnya</a>
        </div>


        <!-- INFORMATION -->

        <div class="flex flex-col gap-16 bg-slate-50 m-auto mt-20 pt-16 pb-28" id="kontak">
            <h1 class=" text-2xl text-center font-semibold font-poppins mt-5">Informasi dan Pesan</h1>

            <div
                class=" text-white flex-col gap-5 sm:gap-0 text-left flex justify-between font-poppins px-10 rounded-md overflow-hidden md:flex-row">
                <div class="flex md:w-2/5">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15956.231225080577!2d104.0484566!3d1.1187205!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856ddfab%3A0xf9d9fc65ca00c9d!2sPoliteknik%20Negeri%20Batam!5e0!3m2!1sen!2sid!4v1726510103054!5m2!1sen!2sid"
                        width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="rounded-md"></iframe>
                </div>

                <div class="flex flex-col gap-5 md:w-1/2">
                    <h1 class="text-black font-semibold">Kirim Kami Sebuah Pesan</h1>
                    <form action="https://api.web3forms.com/submit" method="POST" id="form"
                        class="flex flex-col gap-5 text-black">
                        <input type="hidden" name="access_key" value="05b50342-3b02-4a75-8f99-8d263e295bed" />
                        <input type="hidden" name="subject" value="New Submission from your Website" />
                        <input type="text" name="email" placeholder="Email" required
                            class="w-full bg-white px-1 py-2 border border-slate-400 rounded-md">
                        <input type="text" name="nama" placeholder="Nama Pengirim" required
                            class="w-full bg-white px-1 py-2 border border-slate-400 rounded-md">
                        <textarea name="pesan" id="" placeholder="Pesan" required
                            class="w-full bg-white h-32 px-1 py-2 border border-slate-400 rounded-md"></textarea>
                        <button
                            class="px-4 py-3 bg-blue-700 font-semibold m-auto w-28 rounded-sm md:m-0 hover:opacity-90 text-white"
                            type="submit">Kirim</button>
                    </form>
                </div>
            </div>
        </div>


        <footer class="flex flex-col sm:flex-col md:flex-row gap-10 bg-white">
            <div class="flex flex-col gap-3 text-white bg-blue-700 px-5 py-10 md:px-7 md:py-4">
                <div class="flex gap-3 font-quicksand">
                    <img src="img/letter-s.png" alt="" width="50px">
                    <h1 class="relative top-3 font-poppins text-lg font-semibold">SIMPLIFY</h1>
                </div>
                <p class="font-semibold">Politeknik Negeri Batam</p>
                <p>Jalan Ahmad Yani, Batam Kota, Kota Batam, Kepulauan Riau.</p>
                <div class="flex gap-4">
                    <a href="#" class="w-max">
                        <ion-icon name="logo-instagram" class="text-3xl"></ion-icon>
                    </a>
                    <a href="#" class="w-max">
                        <ion-icon name="logo-youtube" class="text-3xl"></ion-icon>
                    </a>
                    <a href="#" class="w-max">
                        <ion-icon name="logo-facebook" class="text-3xl"></ion-icon>
                    </a>
                    <a href="#" class="w-max">
                        <ion-icon name="logo-github" class="text-3xl"></ion-icon>
                    </a>
                </div>
            </div>

            <div
                class=" text-slate-700 font-poppins bg-white p-3 flex flex-wrap gap-10 justify-between md:w-1/2 md:gap-20">
                <div class="flex flex-col gap-4">
                    <h1 class="text-black font-semibold">PERUSAHAAN</h1>
                    <header
                        class="border border-b-slate-300 w-32 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
                    </header>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kirim Pesan</a></li>
                        <li><a href="#">Copyright</a></li>
                    </ul>
                </div>

                <div class="flex flex-col gap-4">
                    <h1 class="text-black font-semibold">BELAJAR</h1>
                    <header
                        class="border border-b-slate-300 w-32 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
                    </header>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#">Kelas Online</a></li>
                        <li><a href="#">Kelas Offline</a></li>
                        <li><a href="#">Semua Program Kursus</a></li>
                    </ul>
                </div>

                <!-- <div class="flex flex-col gap-4">
                    <h1 class="text-black font-semibold">KOMUNITAS</h1>
                    <header
                        class="border border-b-slate-300 w-32 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
                    </header>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#">Lihat Sertifikat</a></li>
                        <li><a href="#">Grup Telegram</a></li>
                        <li><a href="#">Grup Whatsapp</a></li>
                    </ul>
                </div> -->
            </div>
        </footer>
    </div>






</body>

<!-- cropper foto -->
<script>
    let cropper = null;
    const profileForm = document.getElementById('profileForm');
    const fileInput = document.getElementById('profil_picture');
    const previewImage = document.getElementById('preview-image');
    const cropperModal = document.getElementById('cropperModal');
    const cropperImage = document.getElementById('cropperImage');
    const croppedImageInput = document.getElementById('cropped_image');

    // File input change handler
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                // Initialize cropper
                cropperImage.src = e.target.result;
                cropperModal.classList.remove('hidden');

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(cropperImage, {
                    aspectRatio: 1,
                    viewMode: 2,
                    dragMode: 'move',
                    autoCropArea: 1,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                    initialAspectRatio: 1,
                });
            };
            reader.readAsDataURL(file);
        }
    });

    // Apply crop function
    function applyCrop() {
        if (!cropper) return;

        // Get cropped canvas
        const canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });

        // Convert to blob
        canvas.toBlob(function(blob) {
            // Create file from blob
            const fileName = fileInput.files[0].name;
            const croppedFile = new File([blob], fileName, {
                type: 'image/jpeg'
            });

            // Create FileList object
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(croppedFile);
            fileInput.files = dataTransfer.files;

            // Update preview
            previewImage.src = canvas.toDataURL('image/jpeg');

            // Store base64 in hidden input
            croppedImageInput.value = canvas.toDataURL('image/jpeg');

            // Close modal
            closeCropperModal();
        }, 'image/jpeg', 0.9);
    }

    function closeCropperModal() {
        cropperModal.classList.add('hidden');
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }

    // Handle form submission
    profileForm.addEventListener('submit', function(e) {
        if (fileInput.files.length > 0 && !croppedImageInput.value) {
            e.preventDefault();
            alert('Please crop the image before submitting');
            return;
        }
    });

    // Close modal when clicking outside
    cropperModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeCropperModal();
        }
    });

    // Close button handler
    document.getElementById('close-modal-btn').addEventListener('click', function() {
        window.history.back();
    });
</script>


<script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside of it
    window.addEventListener('click', (event) => {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });

    // Modal PopUp Edit Profile
    document.getElementById("open-modal-btn").addEventListener("click", () => {
        document.getElementById("modal-wrapper").classList.remove("hidden")
    })

    document.getElementById("close-modal-btn").addEventListener("click", () => {
        document.getElementById("modal-wrapper").classList.add("hidden")
    })
</script>

</html>