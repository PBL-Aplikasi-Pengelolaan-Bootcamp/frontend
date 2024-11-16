<?php

include 'function.php';

if (isset($_POST['logout'])) {
    logout();
}
$total_mentor = count(getAll_mentor());
$total_course = count(getAll_course());
$total_student = count(getAll_student());
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
    <link rel="stylesheet" href="../../fontawesome-free-6.6.0-web/fontawesome/css/all.min.css">

    <title>Admin | Dashboard</title>
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
                    <li class="hover:bg-gray-200"><a href="dashboard-admin.php" class="block p-4 text-gray-700">
                            <ion-icon name="home" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Dashoboard
                        </a>
                    </li>
                    <li class="hover:bg-gray-200"><a href="kursus.php" class="block p-4 text-gray-700">
                            <ion-icon name="list-box" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Kursus
                        </a>
                    </li>   
                    <li class="hover:bg-gray-200"><a href="mentor.php" class="block p-4 text-gray-700">
                            <ion-icon name="school" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Mentor
                        </a>
                    </li>
                    <li class="hover:bg-gray-200"><a href="student.php" class="block p-4 text-gray-700">
                            <ion-icon name="person" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Student
                        </a>
                    </li>

                    <form method="post">
                        <li class="hover:bg-gray-200">
                            <button type="submit" name="logout" class="block p-4 text-gray-700">
                                <ion-icon name="log-out" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                                Log
                                Out
                            </button>
                        </li>
                    </form>



                </ul>
            </nav>
        </aside>

        <!-- Konten Utama -->
        <div class="flex-1 p-6 ml-0 md:ml-64">
            <!-- Tombol Hamburger -->
            <button id="hamburger" class="block justify-between md:hidden p-4 text-gray-700">
                <div class=""></div>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>

            <header class="flex justify-between items-center">
                <h2 class="text-3xl font-semibold">Dashboard</h2>

                <button id="open-modal-btn">
                    <div class="flex gap-2 w-max">
                        <h1 class="font-semibold relative my-auto">ADMIN</h1>
                        <img src="../img/logo.png" alt="" class="w-12 h-12 rounded-full">
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
                                    <label for="nama-mentor">Username</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="nama-mentor" type="text" placeholder="Enter your name">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="expertiser">Password</label>
                                    <input type="text" name="expertise" placeholder="Masukkan keahlian anda"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
            <!-- ANALISTIK -->
            <div class="flex mt-10 font-poppins justify-start flex-wrap gap-5" id="pengguna">
                <div
                    class="flex gap-3 p-3 flex-row-reverse bg-white justify-between w-full lg:w-80 2xl:w-96 py-8 px-6 rounded-lg shadow-md">
                    <ion-icon name="school" class="rounded-full bg-blue-400 p-3 text-4xl my-auto"></ion-icon>
                    <div class="flex flex-col">
                        <h1 class="font-semibold font-poppins text-gray-300 tracking-wide text-base">MENTOR</h1>
                        <h1 class="font-bold text-lg">Total mentor</h1>
                        <p class="text-xl"><?=$total_mentor?></p>
                    </div>
                </div>
                <div
                    class="flex gap-3 p-3 flex-row-reverse bg-white justify-between w-full lg:w-80 2xl:w-96 py-8 px-6 rounded-lg shadow-md">
                    <ion-icon name="bookmarks" class="rounded-full bg-yellow-400 p-3 text-4xl my-auto"></ion-icon>
                    <div class="flex flex-col">
                        <h1 class="font-semibold font-poppins text-gray-300 tracking-wide text-base">STUDENT</h1>
                        <h1 class="font-bold text-lg">Total student</h1>
                        <p class="text-xl"><?=$total_student?></p>
                    </div>
                </div>
                <div
                    class="flex gap-3 p-3 flex-row-reverse bg-white justify-between w-full lg:w-80 2xl:w-96 py-8 px-6 rounded-lg shadow-md">
                    <ion-icon name="bookmarks" class="rounded-full bg-yellow-400 p-3 text-4xl my-auto"></ion-icon>
                    <div class="flex flex-col">
                        <h1 class="font-semibold font-poppins text-gray-300 tracking-wide text-base">COURSE</h1>
                        <h1 class="font-bold text-lg">Total course</h1>
                        <p class="text-xl"><?=$total_course?></p>
                    </div>
                </div>
            </div>


            <!-- LIST -->
            <div class="flex flex-wrap gap-5 justify-between mt-10">
                <!-- Selamat Datang -->
                <div class="bg-white p-5 rounded-lg shadow-md w-full">
                    <h2 class="font-bold text-2xl mb-3">Selamat Datang di Dashboard Admin</h2>
                    <p class="text-gray-600">
                        Anda memiliki akses untuk menambah mentor baru dan mengedit data pengguna. Pastikan semua
                        informasi pengguna
                        selalu akurat agar sistem berjalan dengan baik.
                    </p>
                </div>

                <!-- Petunjuk Pengelolaan Mentor -->
                <div class="bg-white p-5 rounded-lg shadow-md w-full">
                    <h2 class="font-bold text-xl mb-3">Pengelolaan Mentor</h2>
                    <ul class="list-disc pl-5 text-gray-600">
                        <li>Tambahkan mentor baru melalui menu "Mentor"</li>
                        <li>Pastikan data mentor lengkap dan benar saat ditambahkan.</li>
                        <li>Edit informasi mentor jika terjadi perubahan, seperti email atau nomor telepon.</li>
                    </ul>
                </div>

                <!-- Petunjuk Pengeditan Pengguna -->
                <div class="bg-white p-5 rounded-lg shadow-md w-full">
                    <h2 class="font-bold text-xl mb-3">Pengeditan Data Pengguna</h2>
                    <ul class="list-disc pl-5 text-gray-600">
                        <li>Edit data pengguna termasuk mentor, siswa, dan admin jika diperlukan.</li>
                        <li>Perbarui peran atau status pengguna sesuai kebutuhan.</li>
                        <li>Berhati-hati saat melakukan perubahan data untuk menghindari kesalahan.</li>
                    </ul>
                </div>

                <!-- Pesan Penting -->
                <div class="bg-white p-5 rounded-lg shadow-md w-full">
                    <h2 class="font-bold text-xl mb-3">Pesan Penting</h2>
                    <p class="text-gray-600">
                        ⚠️ *Pastikan data pengguna selalu diperiksa sebelum disimpan untuk menghindari kesalahan.*
                        Jika mengalami kendala, segera hubungi tim IT untuk mendapatkan bantuan.
                    </p>
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
    </script>
</body>

</html>