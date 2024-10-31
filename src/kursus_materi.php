<?php

include 'function.php';

$section = get_section_by_slug();
$kursus = get_course_by_slug();

$data_login = get_data_user_login();

$id_user = $_SESSION['id_user'] ?? null;
$enrolledCourses = getEnrolledCourses($id_user);
$isEnrolled = !empty($enrolledCourses);


    //logout
    if (isset($_POST['logout'])) {
        logout();
    }

    if (isset($_POST['edit_profil'])) {
        edit_profil($_POST, $data_login['id_user']);
    }



  // Cek apakah data profil lengkap
  $id_course = get_course_id_from_slug($_GET['kursus']); 
  $id_user = $_SESSION['id_user'] ?? null;
  $isEnrolled = $id_user && isEnrolled($id_user, $id_course);

  if (isset($_POST['enroll_course'])) {
      enroll();  // Panggil fungsi enroll
  }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kursus | Materi</title>
    <link href="output.css" rel="stylesheet" />
    <link href="img/logo.png" rel="shortcut icon" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js"></script>

</head>

<body>
    <div class=" m-auto bg-slate-50">
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
                        <li><a href="index.php#about"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Tentang</a>
                        </li>
                        <li><a href="index.php#kontak"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kontak</a></li>
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
                    <li><a href="index.php#about" class="hover:text-blue-700">Tentang</a></li>
                    <li><a href="index.php#kontak" class="hover:text-blue-700">Kontak</a></li>
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
                    <a href="#"
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
                        <h1 class="font-semibold relative my-auto hidden sm:flex"><?=$data_login['username']?></h1>
                        <img src="foto_student/<?= isset($data_login['profil_picture']) ? $data_login['profil_picture'] : 'profil_default.png' ?>"
                            alt="" class="w-8 h-8 md:w-12 md:h-12 rounded-full">
                    </div>
                </button>
                <?php endif ?>

                <!-- MODAL WRAPPER -->
                <div id="modal-wrapper" class="fixed z-10 inset-0 hidden">
                    <div
                        class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                        <!-- MODAL BOX -->
                        <div
                            class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3 max-h-screen overflow-y-auto">
                            <form method="post" enctype="multipart/form-data" class="flex flex-col gap-5 my-2 w-full">

                                <div class="flex flex-col gap-2">
                                    <label for="username">Username</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="username" name="username" type="text" placeholder="Masukkan username"
                                        value="<?=$data_login['username']?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="name">Nama</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="name" name="name" type="text" placeholder="Masukkan nama"
                                        value="<?=$data_login['name']?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="email">Email</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="email" name="email" type="email" placeholder="Masukkan email"
                                        value="<?=$data_login['email']?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="birth">Birth</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="birth" name="birth" type="date" placeholder="Masukkan tanggal lahir"
                                        value="<?=$data_login['birth']?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="telp">Telp</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="telp" name="telp" type="text" placeholder="Masukkan nomor telp"
                                        value="<?=$data_login['telp']?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="img">Foto Profil</label>
                                    <input type="file" src="" alt="" name="profil_picture"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="<?=$data_login['profil_picture']?>">
                                    <img src="img/pp-profile.jpg" alt="" class="w-12 h-12">

                                </div>

                                <div class="flex justify-end gap-2">
                                    <button id="close-modal-btn"
                                        class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                    <button type="submit" name="edit_profil"
                                        class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </nav>

        <div class="w-4/5 m-auto relative top-36 flex flex-col gap-6 py-5">


            <div class="space-y-4">
                <div class="relative bg-white shadow-md h-40 rounded-lg sm:h-60 overflow-hidden">
                    <img src="foto_cover_course/<?= $kursus['course_picture'] ?>" alt=""
                        class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

                    <!-- Elemen yang ingin disembunyikan jika sudah terdaftar -->
                    <?php  
                        $id_course = get_course_id_from_slug($_GET['kursus']); 
                        $id_user = $_SESSION['id_user'] ?? null;
                        $isEnrolled = $id_user && isEnrolled($id_user, $id_course);
                    ?>

                    <div class="absolute inset-0 flex items-center justify-center <?= $isEnrolled ? 'hidden' : ''; ?>">
                        <?php if (isset($_SESSION['id_user'])): ?>
                        <form method="POST">
                            <input type="hidden" name="id_course" value="<?= $id_course ?>">
                            <button type="submit" id="openModal" class="text-white py-3 px-8 rounded-lg w-max font-poppins font-semibold tracking-wider text-lg 
                bg-blue-600 border border-blue-600 shadow-lg shadow-blue-500/50 
                transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-white 
                hover:text-blue-600 hover:border-blue-600 cursor-pointer">
                                Daftar Sekarang
                            </button>
                        </form>
                        <?php else: ?>
                        <a href="login.php" class="text-white py-3 px-8 rounded-lg w-max font-poppins font-semibold tracking-wider text-lg 
            bg-blue-600 border border-blue-600 shadow-lg shadow-blue-500/50 
            transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-white 
            hover:text-blue-600 hover:border-blue-600 cursor-pointer">
                            Login untuk Daftar
                        </a>
                        <?php endif; ?>
                    </div>



                    <div id="modal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50">
                        <div class="bg-white rounded-xl p-6 max-w-lg w-full shadow-xl transform transition-all scale-95 opacity-0"
                            id="modal-content" onclick="event.stopPropagation()">
                            <div class="text-center">
                                <h2 class="text-3xl font-bold text-blue-600 mb-4">Pendaftaran Course</h2>
                                <p class="text-gray-700 leading-relaxed mb-6">
                                    Selamat datang! Anda akan segera bergabung dalam kursus yang meningkatkan
                                    keterampilan Anda.
                                    Berikut panduan sebelum memulai course.
                                </p>
                            </div>



                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="bg-blue-100 text-blue-600 w-10 h-10 flex items-center justify-center rounded-full">
                                            1
                                        </div>
                                    </div>
                                    <p class="text-gray-600 flex-grow pt-2">Lengkapi data diri Anda sebelum melanjutkan
                                        ke kursus.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="bg-blue-100 text-blue-600 w-10 h-10 flex items-center justify-center rounded-full">
                                            2
                                        </div>
                                    </div>
                                    <p class="text-gray-600 flex-grow pt-2">Ikuti materi secara terstruktur dan kerjakan
                                        tugas tepat waktu.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="bg-blue-100 text-blue-600 w-10 h-10 flex items-center justify-center rounded-full">
                                            3
                                        </div>
                                    </div>
                                    <p class="text-gray-600 flex-grow pt-2">Raih sertifikat resmi setelah berhasil
                                        menyelesaikan semua sesi.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="bg-blue-100 text-blue-600 w-10 h-10 flex items-center justify-center rounded-full">
                                            4
                                        </div>
                                    </div>
                                    <p class="text-gray-600 flex-grow pt-2">Kursus dapat diakses setelah jadwal dimulai.
                                    </p>
                                </div>
                            </div>


                            <div class="mt-8 flex justify-end space-x-4">
                                <form method="post" id="enrollForm">
                                    <button type="button" id="closeModal" class="px-5 py-2 rounded-lg bg-gray-200 text-gray-600 
                                        transition-all duration-300 hover:bg-gray-300">
                                        Batal
                                    </button>

                                    <input type="hidden" value="<?=$kursus['id_course']?>" name="id_course">
                                    <button type="submit" name="enroll_course" class="px-5 py-2 rounded-lg bg-blue-600 text-white 
                                        transition-all duration-300 hover:bg-blue-700">
                                        Daftar Sekarang
                                    </button>
                                </form>
                            </div>


                        </div>
                    </div>

                </div>

                <h1 class="text-2xl font-poppins font-semibold"><?= $kursus['title']?></h1>
                <hr>

                <div class="flex items-center gap-4">
                    <!-- Foto Profil -->
                    <img src="foto_mentor/<?= $kursus['profil_picture'] ?>" class="w-10 h-10 rounded-full object-cover">
                    <!-- Teks -->
                    <h1 class="font-bold font-poppins text-slate-800">
                        <?= $kursus['name'] ?>
                    </h1>
                </div>

                <div class="flex gap-2 text-sm flex-wrap font-bold font-poppins text-slate-800">
                    <h1 class="bg-green-300 px-3 py-1 rounded-lg"><?=$kursus['course_type']?></h1>
                    <h1 class="bg-gray-300 px-3 py-1 rounded-lg"><?=$kursus['start_date']?> - <?=$kursus['end_date']?>
                    </h1>
                    <h1 class="bg-gray-300 px-3 py-1 rounded-lg"><?=$kursus['quota']?> Quota</h1>
                </div>



















                <!-- ----------------------------------------------------------SECTION -->
                <?php foreach ($section as $data) { ?>

                <div x-data="{ open: true }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span><?= $data['section_title'] ?></span>
                    </button>

                    <?php  
                    // Periksa apakah pengguna sudah login
                    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
                    $id_course = get_course_id_from_slug($_GET['kursus']); 

                    // Cek status enrollment
                    $statusEnrollment = $id_user !== null ? getEnrollmentStatus($id_user, $id_course) : null; // Mendapatkan status enrollment

                    // Tentukan apakah div harus disembunyikan
                    $shouldHide = $statusEnrollment === 'pending' || $statusEnrollment === null; // Sembunyikan jika pending atau tidak terdaftar
                    ?>

                    <div x-show="open"
                        class="px-4 py-2 border-t flex flex-col gap-4 <?= $shouldHide ? 'hidden' : '' ?>">

                        <!-- Tampil Information -->
                        <?php 
                        $id_course = get_course_id_from_slug($_GET['kursus']);
                        $information = get_information_by_course_and_section($id_course, $data['section_id_section']);
                        ?>
                        <?php if (!empty($information)) { ?>
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">Information</h1>
                            <?php foreach ($information as $info) { ?>
                            <p>* <?= htmlspecialchars($info['information']) ?></p>
                            <?php } ?>
                        </div>
                        <hr>
                        <?php } ?>


                        <!--Tampil Video -->
                        <?php 
                        $id_course = get_course_id_from_slug($_GET['kursus']);
                        $video = get_video_by_course_and_section($id_course, $data['section_id_section']);
                        ?>
                        <?php if (!empty($video)) { ?>
                        <?php foreach ($video as $video) { ?>
                        <div class="flex flex-col gap-4">
                            <iframe class="iframe-youtube" src="<?=$video['url']?>" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <?php } ?>
                        <hr>
                        <?php }?>


                        <!-- Tampil text -->
                        <?php 
                        $id_course = get_course_id_from_slug($_GET['kursus']);
                        $text = get_text_by_course_and_section($id_course, $data['section_id_section']);
                        ?>
                        <?php if (!empty($text)) { ?>
                        <?php foreach ($text as $text) { ?>
                        <div class="flex flex-col gap-2">
                            <p><?=$text['content']?></p>
                        </div>
                        <?php }?>
                        <hr>
                        <?php }?>


                        <!-- Tampil File -->
                        <?php 
                        $id_course = get_course_id_from_slug($_GET['kursus']);
                        $file = get_file_by_course_and_section($id_course, $data['section_id_section']);
                        ?>
                        <?php if (!empty($file)) { ?>
                        <?php foreach ($file as $file) { ?>
                        <div
                            class="flex items-center justify-between p-2 border border-gray-300 rounded-md shadow-sm hover:shadow-md transition duration-200">
                            <a href="file_materi/<?= $file['file'] ?>" target="_blank"
                                class="text-blue-600 hover:underline font-medium">
                                <?= $file['file'] ?>
                            </a>
                            <span
                                class="text-gray-500 text-sm"><?= round(filesize('file_materi/' . $file['file']) / 1024, 2) . ' KB' ?></span>
                        </div>
                        <?php }?>
                        <hr>
                        <?php }?>


                    </div>
                </div>

                <?php }?>





                <div x-data="{ open: false }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>SERTIFIKAT PENYELESAIAN</span>
                    </button>
                </div>
            </div>


        </div>


        <footer class="flex flex-col sm:flex-col mt-52 md:flex-row gap-10 bg-white">
            <div class="flex flex-col gap-3 text-white bg-blue-700 px-5 py-10 md:px-7 md:py-4">
                <div class="flex gap-1 font-quicksand">
                    <img src="img/letter-s.png" alt="" width="50px">
                    <h1 class="relative top-3 font-poppins text-lg font-semibold">SIMPLIFY</h1>
                </div>
                <p class="font-semibold">Politeknik Negeri Batam</p>
                <p>Ahmad Yani, Batam Kota District, Batam City, Riau Islands.</p>
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
                class=" text-slate-700 bg-white font-poppins p-3 flex flex-wrap gap-10 justify-between md:w-1/2 md:gap-20">
                <div class="flex flex-col gap-4">
                    <h1 class="text-black font-semibold">COMPANY</h1>
                    <header
                        class="border border-b-slate-300 w-32 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
                    </header>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Copyright</a></li>
                    </ul>
                </div>

                <div class="flex flex-col gap-4">
                    <h1 class="text-black font-semibold">LEARN</h1>
                    <header
                        class="border border-b-slate-300 w-32 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
                    </header>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#">Online Class</a></li>
                        <li><a href="#">Offline Class</a></li>
                        <li><a href="#">All Course</a></li>
                    </ul>
                </div>

                <div class="flex flex-col gap-4">
                    <h1 class="text-black font-semibold">COMUNITY</h1>
                    <header
                        class="border border-b-slate-300 w-32 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
                    </header>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#">Check Certificate</a></li>
                        <li><a href="#">Telegram Group</a></li>
                        <li><a href="#">Discord</a></li>
                    </ul>
                </div>
            </div>
        </footer>

    </div>

</body>
<script>
// Modal PopUp Edit Profile
document.getElementById("open-modal-btn").addEventListener("click", () => {
    document.getElementById("modal-wrapper").classList.remove("hidden")
})

document.getElementById("close-modal-btn").addEventListener("click", () => {
    document.getElementById("modal-wrapper").classList.add("hidden")
})


// Modal enroll
const openModal = document.getElementById('openModal');
const modal = document.getElementById('modal');
const closeModal = document.getElementById('closeModal');

// Buka modal dan cegah default form submit
openModal.addEventListener('click', (event) => {
    event.preventDefault(); // Mencegah halaman refresh
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('.transform').classList.remove('scale-95', 'opacity-0');
    }, 50);
});

// Tutup modal
closeModal.addEventListener('click', () => {
    modal.querySelector('.transform').classList.add('scale-95', 'opacity-0');
    setTimeout(() => modal.classList.add('hidden'), 300);
});

// Tutup modal saat klik di luar konten modal
modal.addEventListener('click', () => {
    closeModal.click();
});
</script>

</html>