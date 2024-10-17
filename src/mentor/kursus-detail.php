<?php

include 'function.php';

$course = get_course_by_id();


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
    <title>Mentor | Kursus Detail</title>
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
            class="sidebar fixed inset-y-0 left-0 w-64 bg-white shadow-md transform -translate-x-full md:translate-x-0 h-full">
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
        <div class="flex-1 p-6 ml-0 md:ml-64">
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

            <header class="flex justify-end items-center">

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
                                    <button id="close-modal-btn"
                                        class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Konten -->

            <!-- LIST -->
            <h1 class="text-2xl font-poppins font-semibold"><?=$course['title']?> <span><ion-icon name="create"></ion-icon></span></h1>

            <div class="space-y-4 mt-10">



                <div class="bg-white shadow-md h-40 rounded-lg sm:h-60 overflow-hidden mb-10">
                    <img src="../img/smartphoneio.jpg" alt="">
                </div>


                <!-- SECTION 1 -->
                <div x-data="{ open: false }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-orange-400 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>TAMBAH SECTION</span>
                    </button>

                    <form method="post">
                        <div x-show="open"
                            class="px-4 py-2 border-t mx-auto w-full bg-white p-4 rounded-lg shadow flex flex-col gap-5">
                            <form action="" class="flex flex-col gap-2 w-full">
                                <div class="flex gap-5">
                                    <h1 class="font-semibold text-xl">Link Youtube:</h1>
                                    <input type="text" placeholder="PERTEMUAN 1 - PERKENALAN HTML"
                                        class="border-slate-700 border rounded-sm py-1 px-1 w-full">
                                </div>
                                <div class="w-full">
                                    <textarea name="content" id="editor1"
                                        class="w-3/4 h-64 p-2 border border-gray-300 rounded-md">
                        </textarea>
                                </div>

                                <button type="submit"
                                    class="bg-green-500 text-white w-max px-3 py-2 rounded-lg font-semibold font-poppins">Simpan</button>
                            </form>
                        </div>
                </div>

                <div x-data="{ open: true }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>PERTEMUAN 1 - PERKENALAN HTML</span>
                    </button>
                    <div x-show="open" class="px-4 py-2 border-t flex flex-col gap-4">
                        <!-- INNER SECTION 1 -->
                        <div class="flex flex-col gap-4">
                            <iframe class="iframe-youtube"
                                src="https://www.youtube.com/embed/Q2VqCG13ejA?si=UEQsKOXVmAhX0mli"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk
                                membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk
                                menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan
                                lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <hr>
                        <!-- INNER SECTION 2 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">Struktur Dasar HTML</h1>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk
                                membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk
                                menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan
                                lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <hr>
                        <!-- INNER SECTION 3 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">Elemen HTML Penting</h1>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk
                                membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk
                                menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan
                                lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <hr>
                        <!-- QUIZ SECTION -->
                        <div class="flex flex-col gap-2">
                            <div class="flex gap-2">
                                <!-- <ion-icon name="alarm" class="text-2xl relative top-1"></ion-icon> -->
                                <h1 class="font-semibold text-2xl">Quiz: Dasar-dasar HTML</h1>
                            </div>

                            <a href="#" class="text-blue-700">https://youtu.be/Q2VqCG13ejA?si=F8Du2oHxMqFSmGlM</a>

                        </div>
                        <hr>
                    </div>
                </div>


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

    // Modal PopUp
    document.getElementById("open-modal-btn").addEventListener("click", () => {
        document.getElementById("modal-wrapper").classList.remove("hidden")
    })

    document.getElementById("close-modal-btn").addEventListener("click", () => {
        document.getElementById("modal-wrapper").classList.add("hidden")
    })

    ClassicEditor
        .create(document.querySelector('#editor1'))
        .catch(error => {
            console.error(error);
        });
    </script>
</body>

</html>