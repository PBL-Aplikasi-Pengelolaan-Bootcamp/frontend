<?php

include 'function.php';

// get data course
$course = get_course_by_id();

// get data section
$section = get_section_byCourseId();

// add section
if (isset($_POST['add_section'])) {
    create_section($_POST);
}

// create information
if (isset($_POST['create_information'])) {
    create_information($_POST);
}

// create video
if (isset($_POST['create_video'])) {
    create_video($_POST);
}

// create text
if (isset($_POST['create_text'])) {
    create_text($_POST);
}

// create file
if (isset($_POST['create_file'])) {
    create_file($_POST);
}







?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="../output.css" rel="stylesheet" />
    <link href="../img/logo.png" rel="shortcut icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="../../fontawesome-free-6.6.0-web/fontawesome/css/all.min.css">
    <title>Mentor | Tambah Materi</title>
    <style>
    /* Tambahkan gaya untuk transisi sidebar */
    .sidebar {
        transition: transform 0.3s ease;
    }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="sidebar fixed inset-y-0 z-20 left-0 w-64 bg-white shadow-md transform -translate-x-full md:translate-x-0 h-full">
            <div class="flex justify-between p-6">
                <div class="w-max">
                    <img src="../img/logo1.png" alt="" class="w-max">
                </div>


                <button id="close-sidebar" class="text-gray-700 focus:outline-none md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <nav>
                <ul>

                    <li class="hover:bg-gray-200"><a href="dashboard-mentor.php" class="block p-4 text-gray-700">
                            <ion-icon name="home" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Dashboard
                        </a>
                    </li>
                    <li class="hover:bg-gray-200"><a href="kursus.php" class="block p-4 text-gray-700">
                            <ion-icon name="list-box" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Kursus
                        </a>
                    </li>
                    <li class="hover:bg-gray-200"><a href="student.php" class="block p-4 text-gray-700">
                            <ion-icon name="person" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Student
                        </a>
                    </li>
                    <li class="hover:bg-gray-200"><a href="quiz.php" class="block p-4 text-gray-700">
                            <ion-icon name="list-box" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>Quiz
                        </a>
                    </li>
                    <li class="hover:bg-gray-200"><a href="#" class="block p-4 text-gray-700">
                            <ion-icon name="log-out" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>Log
                            Out
                        </a></li>
                </ul>
            </nav>
        </aside>

        <!-- Konten Utama -->
        <div class="flex-1 p-6 ml-0 md:ml-64 overflow-hidden">
            <!-- Tombol Hamburger -->
            <button id="hamburger" class="block justify-between md:hidden p-4 text-gray-700">
                <div class="">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7">
                        </path>
                    </svg>
            </button>

            <header class="flex justify-end">
                <button id="open-modal-btn">
                    <div class="flex gap-2 w-max">
                        <h1 class="font-semibold relative my-auto">Student1</h1>
                        <img src="../img/pp-profile.jpg" alt="" class="w-12 h-12 rounded-full">
                    </div>
                </button>

                <!-- MODAL WRAPPER -->
                <div id="modal-wrapper" class="fixed z-10 inset-0 hidden">
                    <div
                        class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                        <!-- MODAL BOX -->
                        <div
                            class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3">
                            <form action="" class="flex flex-col gap-5 my-2 w-full">
                                <div class="flex flex-col gap-2">
                                    <img src="../img/pp-profile.jpg" alt="" class="w-12 h-12">
                                    <label for="img">Upload Gambar</label>
                                    <input type="file" src="" alt="" name="img"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="nama-mentor">Nama</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="nama-mentor" type="text" placeholder="Enter your name">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="expertiser">Expertise</label>
                                    <input type="text" name="expertise" placeholder="Masukkan keahlian anda"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="deskripsi">Bio</label>
                                    <textarea name="deskripsi"
                                        class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"></textarea>
                                </div>

                                <div class="flex justify-between">
                                    <button type="submit"
                                        class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                    <button id="close-modal-btn" type="button"
                                        class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Konten -->

            <!-- LIST -->

            <div class="space-y-4 mt-10">

                <div class="flex gap-2">
                    <h1 class="my-auto text-2xl font-bold font-poppins"><?=$course['title']?></h1>
                    <i class="fa-solid fa-pen-to-square text-2xl my-auto"></i>
                </div>

                <div class="bg-white shadow-md h-40 rounded-lg sm:h-60 overflow-hidden">
                    <img src="../foto_cover_course/<?=$course['course_picture']?>" alt="">
                </div>

                <div class="flex gap-2 text-sm flex-wrap font-bold font-poppins text-slate-800">
                    <h1 class="bg-white px-3 py-1 rounded-lg"><?=$course['course_type']?></h1>
                    <h1 class="bg-white px-3 py-1 rounded-lg"><?=$course['start_date']?> - <?=$course['end_date']?>
                    </h1>
                    <h1 class="bg-white px-3 py-1 rounded-lg"><?=$course['quota']?> Quota</h1>
                </div>

                <p class="text-lg"><?=$course['description']?></p>

                <div class="flex justify-end items-center">
                    <button id="open-modal-btn-section"
                        class="bg-blue-500 text-white p-3 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none">
                        Add Section
                    </button>

                    <!-- Modal Section -->
                    <div id="modal-wrapper-section" class="fixed z-10 inset-0 hidden">
                        <div
                            class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                            <div
                                class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3">
                                <form method="post" class="flex flex-col gap-5 my-2 w-full">
                                    <div class="flex flex-col gap-2">
                                        <label for="section">Section Title :</label>
                                        <input type="text" name="title" placeholder="Enter title"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div class="flex justify-end gap-2">
                                        <button id="close-modal-btn-section" type="button"
                                            class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                        <button type="submit" name="add_section"
                                            class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <?php foreach ($section as $section) { ?>
                <div x-data="{ open: true }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span><?=$section['title']?></span>
                    </button>
                    <div x-show="open" class="px-4 py-2 border-t flex flex-col gap-4">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-4">
                                <div class="flex justify-end">
                                    <div class="relative inline-block justify-end text-left  dropdown-container">
                                        <div>
                                            <button id="dropdownButton"
                                                class="dropdown-button bg-blue-500 text-white rounded-full w-10 h-10 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div
                                            class="dropdown-menu hidden right-0 top-full mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-150">
                                            <div class="py-1" role="menu" aria-orientation="vertical"
                                                aria-labelledby="options-menu">
                                                <a href="#"
                                                    class="open-modal-btn block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    data-modal-type="information" role="menuitem">Information</a>
                                                <a href="#"
                                                    class="open-modal-btn block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    data-modal-type="video" role="menuitem">Video material</a>
                                                <a href="#"
                                                    class="open-modal-btn block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    data-modal-type="text" role="menuitem">Text material</a>
                                                <a href="#"
                                                    class="open-modal-btn block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    data-modal-type="file" role="menuitem">File</a>
                                            </div>
                                        </div>



                                        <!-- Information Input -->
                                        <div class="modal-wrapper fixed z-10 inset-0 hidden"
                                            data-modal-type="information">
                                            <div
                                                class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                                                <div
                                                    class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3">
                                                    <form method="post" class="flex flex-col gap-5 my-2 w-full">
                                                        <div class="flex flex-col gap-2">
                                                            <input type="text" value="<?=$section['title']?>" readonly
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline">
                                                            <hr>
                                                            <label for="information">Information :</label>
                                                            <input type="number" name="id_section"
                                                                value="<?=$section['id_section']?>" hidden>
                                                            <input type="text" name="information"
                                                                placeholder="Enter information"
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                        </div>

                                                        <div class="flex justify-end">
                                                            <button
                                                                class="close-modal-btn w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                                            <button type="submit" name="create_information"
                                                                class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Video Input -->
                                        <div class="modal-wrapper fixed z-10 inset-0 hidden" data-modal-type="video">
                                            <div
                                                class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                                                <div
                                                    class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3">
                                                    <form method="post" class="flex flex-col gap-5 my-2 w-full">
                                                        <div class="flex flex-col gap-2">
                                                            <input type="text" value="<?=$section['title']?>" readonly
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline">
                                                            <hr>
                                                            <label for="video">iframe url :</label>
                                                            <input type="number" name="id_section"
                                                                value="<?=$section['id_section']?>" hidden>
                                                            <input type="text" name="url" placeholder="Enter video"
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                        </div>

                                                        <div class="flex justify-end">
                                                            <button
                                                                class="close-modal-btn w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                                            <button type="submit" name="create_video"
                                                                class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Text Input -->
                                        <div class="modal-wrapper fixed z-10 inset-0 hidden" data-modal-type="text">
                                            <div
                                                class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                                                <div
                                                    class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3">
                                                    <form method="post" class="flex flex-col gap-5 my-2 w-full">
                                                        <div class="flex flex-col gap-2">
                                                            <input type="text" value="<?=$section['title']?>" readonly
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline">
                                                            <hr>
                                                            <label for="text">Content :</label>
                                                            <input type="number" name="id_section"
                                                                value="<?=$section['id_section']?>" hidden>
                                                            <input type="text" name="text" placeholder="Enter text"
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                        </div>

                                                        <div class="flex justify-end">
                                                            <button
                                                                class="close-modal-btn w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                                            <button type="submit" name="create_text"
                                                                class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- File Input -->
                                        <div class="modal-wrapper fixed z-10 inset-0 hidden" data-modal-type="file">
                                            <div
                                                class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                                                <div
                                                    class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3">
                                                    <form method="post" enctype="multipart/form-data"
                                                        class="flex flex-col gap-5 my-2 w-full">
                                                        <div class="flex flex-col gap-2">
                                                            <input type="text" value="<?=$section['title']?>" readonly
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline">
                                                            <hr>
                                                            <label for="file">File :</label>
                                                            <input type="number" name="id_section"
                                                                value="<?=$section['id_section']?>" hidden>
                                                            <input type="file" name="file" placeholder="Enter file"
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                        </div>

                                                        <div class="flex justify-end">
                                                            <button
                                                                class="close-modal-btn w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                                            <button type="submit" name="create_file"
                                                                class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>









                                    </div>
                                </div>

                                <!-- ------------------------------------------------------------KONTEN  -->

                                <!-- Tampil Information -->
                                <?php  $information = get_information_bySection($_GET['id'], $section['id_section']); ?>
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
                                <?php  $video = get_video_bySection($_GET['id'], $section['id_section']); ?>
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
                                <?php  $text = get_text_bySection($_GET['id'], $section['id_section']); ?>
                                <?php if (!empty($text)) { ?>
                                <?php foreach ($text as $text) { ?>
                                <div class="flex flex-col gap-2">
                                    <p><?=$text['content']?></p>
                                </div>
                                <?php }?>
                                <hr>
                                <?php }?>

                                <!-- Tampil File -->
                                <?php  $file = get_file_bySection($_GET['id'], $section['id_section']); ?>
                                <?php if (!empty($file)) { ?>
                                <?php foreach ($file as $file) { ?>
                                <div
                                    class="flex items-center justify-between p-2 border border-gray-300 rounded-md shadow-sm hover:shadow-md transition duration-200">
                                    <a href="../file_materi/<?= $file['file'] ?>" target="_blank"
                                        class="text-blue-600 hover:underline font-medium">
                                        <?= $file['file'] ?>
                                    </a>
                                    <span
                                        class="text-gray-500 text-sm"><?= round(filesize('../file_materi/' . $file['file']) / 1024, 2) . ' KB' ?></span>
                                </div>
                                <?php }?>
                                <hr>
                                <?php }?>



                                <!-- <div class="flex flex-col gap-2">
                                    <div class="flex gap-2">
                                        <h1 class="font-semibold text-2xl">Quiz: Dasar-dasar HTML</h1>
                                    </div>
                                    <a href="#"
                                        class="text-blue-700">https://youtu.be/Q2VqCG13ejA?si=F8Du2oHxMqFSmGlM</a>
                                </div>
                                <hr> -->

                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>















            </div>
        </div>
    </div>




    <script>
    // Fungsi untuk toggle sidebar
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('close-sidebar');

    hamburger.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full'); // Toggle kelas untuk menampilkan/menyembunyikan sidebar
    });

    closeSidebar.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full'); // Menyembunyikan sidebar saat tombol tutup ditekan
    });

    // Modal PopUp Edit Profil
    document.getElementById("open-modal-btn").addEventListener("click", (event) => {
        event.preventDefault();
        document.getElementById("modal-wrapper").classList.remove("hidden");
    });

    document.getElementById("close-modal-btn").addEventListener("click", () => {
        document.getElementById("modal-wrapper").classList.add("hidden");
    });




    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
    </script>



    <!-- Setup Section -->
    <script>
    const openModalBtn = document.getElementById('open-modal-btn-section');
    const closeModalBtn = document.getElementById('close-modal-btn-section');
    const modalWrapper = document.getElementById('modal-wrapper-section');

    // Fungsi untuk membuka modal
    openModalBtn.addEventListener('click', () => {
        modalWrapper.classList.remove('hidden');
    });

    // Fungsi untuk menutup modal
    closeModalBtn.addEventListener('click', () => {
        modalWrapper.classList.add('hidden');
    });

    // Menutup modal jika klik di luar konten modal
    window.addEventListener('click', (e) => {
        if (e.target === modalWrapper) {
            modalWrapper.classList.add('hidden');
        }
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Setup dropdowns
        document.querySelectorAll('.dropdown-container').forEach(container => {
            const button = container.querySelector('.dropdown-button');
            const menu = container.querySelector('.dropdown-menu');

            button.addEventListener('click', (event) => {
                event.stopPropagation();
                menu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (event) => {
                if (!container.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });

            // Close dropdown when a menu item is clicked
            menu.querySelectorAll('a').forEach(item => {
                item.addEventListener('click', () => {
                    menu.classList.add('hidden');
                });
            });
        });

        // Setup modals
        document.querySelectorAll('.open-modal-btn').forEach(btn => {
            btn.addEventListener('click', (event) => {
                event.preventDefault();
                const modalType = btn.getAttribute('data-modal-type');
                const modalWrapper = btn.closest('.dropdown-container').querySelector(
                    `.modal-wrapper[data-modal-type="${modalType}"]`);
                modalWrapper.classList.remove('hidden');
            });
        });

        document.querySelectorAll('.close-modal-btn').forEach(btn => {
            btn.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent form submission
                const modalWrapper = btn.closest('.modal-wrapper');
                modalWrapper.classList.add('hidden');
            });
        });


    });
    </script>

</body>

</html>