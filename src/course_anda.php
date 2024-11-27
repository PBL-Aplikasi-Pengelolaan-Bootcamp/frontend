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
                        <li><a href="index.php#visi" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Tentang</a>
                        </li>
                        <li><a href="index.php#kontak"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kontak</a></li>
                        <li><a href="course_anda.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Course
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
                <div id="modal-wrapper" class="fixed z-10 inset-0 hidden overflow-y-auto ">
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
                                    <label for="profil_picture">Foto Profil</label>
                                    <input type="file" accept="image/*" name="profil_picture" id="profil_picture"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                    <!-- Hidden input untuk menyimpan base64 gambar yang sudah di-crop -->
                                    <input type="hidden" name="cropped_image" id="cropped_image">

                                    <div class="relative w-12 h-12">
                                        <img src="foto_student/<?=$data_login['profil_picture']?>" alt=""
                                            id="preview-image" class="w-12 h-12 object-cover rounded-full">
                                    </div>
                                </div>


                                <div class="flex flex-col gap-2">
                                    <div class="flex justify-between items-center">
                                        <button type="button" id="change-password-btn"
                                            class="ml-2 text-blue-500 hover:underline">Ganti Password</button>
                                    </div>
                                </div>

                                <!-- Div untuk input password lama dan baru, default disembunyikan -->
                                <div id="password-change-fields" class="hidden flex flex-col gap-2">
                                    <label for="old-password">Password Lama</label>
                                    <input type="password" id="old-password" name="old_password"
                                        placeholder="Masukkan password lama"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                    <label for="new-password">Password Baru</label>
                                    <input type="password" id="new-password" name="new_password"
                                        placeholder="Masukkan password baru"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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





        <div class="flex flex-col gap-8 bg-slate-50 m-auto mt-20 px-10 pt-16 pb-28">



            <!-- H1 di Paling Atas -->
            <h1 class="text-2xl font-poppins text-center font-semibold">Kursus Yang Anda Ikuti</h1>

            <!-- Wrapper untuk Card -->
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Card 1 -->
                <?php foreach ($enrolledCourses as $data) { ?>

                <div class="w-full md:w-1/3 bg-white rounded-lg shadow-md p-5">
                    <h2 class="font-semibold text-lg mb-2"><?=$data['title']?></h2>
                    <p class="text-sm text-gray-600">
                        <?= strlen($data['description']) > 108 ? substr($data['description'], 0, 108) . '...' : $data['description'] ?>
                    </p>
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-sm text-gray-500">Status: <strong><?=$data['status']?></strong></span>
                        <a href="<?= 'kursus_materi.php?kursus=' . $data['slug']; ?>"><button
                                class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg">
                                Masuk
                            </button></a>
                    </div>
                </div>
                <?php } ?>


                <!-- Card 2 -->
                <!-- <div class="w-full md:w-1/3 bg-white rounded-lg shadow-md p-5">
                    <h2 class="font-semibold text-lg mb-2">Frontend Development</h2>
                    <p class="text-sm text-gray-600">
                        Kuasai HTML, CSS, dan JavaScript untuk membuat website interaktif dan responsif.
                    </p>
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-sm text-gray-500">Status: <strong>Berjalan</strong></span>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg">
                            Lanjutkan Course
                        </button>
                    </div>
                </div> -->

                <!-- Card 3 -->
                <!-- <div class="w-full md:w-1/3 bg-white rounded-lg shadow-md p-5">
                    <h2 class="font-semibold text-lg mb-2">Data Science</h2>
                    <p class="text-sm text-gray-600">
                        Belajar mengolah data dan membuat model prediksi menggunakan Python dan SQL.
                    </p>
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-sm text-gray-500">Status: <strong>Belum Mulai</strong></span>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg">
                            Mulai Sekarang
                        </button>
                    </div>
                </div> -->
            </div>
        </div>





        <!-- INFORMATION -->




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


<!-- Cropper foto -->
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

<!-- ganti pw -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const changePasswordBtn = document.getElementById("change-password-btn");
        const passwordChangeFields = document.getElementById("password-change-fields");

        changePasswordBtn.addEventListener("click", function() {
            // Toggle visibility
            if (passwordChangeFields.classList.contains("hidden")) {
                passwordChangeFields.classList.remove("hidden");
                changePasswordBtn.innerText = "Batal Ganti Password";
            } else {
                passwordChangeFields.classList.add("hidden");
                changePasswordBtn.innerText = "Ganti Password";
            }
        });
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