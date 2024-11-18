<?php

include 'function.php';
//get data session login
$login = get_data_user_login();

//logout
if (isset($_POST['logout'])) {
    logout();
}

//edit profil
if (isset($_POST['edit_profil'])) {
    edit_profil($_POST, $_SESSION['id_user']);
}

//get data mentor
$mentor = get_mentor_byId(); 

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
                    <li class="hover:bg-gray-200"><a href="#pengguna" class="block p-4 text-gray-700">
                            <ion-icon name="person" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Dashoboar
                        </a>
                    </li>

                    <li class="hover:bg-gray-200"><a href="tambah_mentor.php" class="block p-4 text-gray-700">
                            <ion-icon name="school" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Mentor
                        </a>
                    </li>
                    <li class="hover:bg-gray-200"><a href="tambah_mentor.php" class="block p-4 text-gray-700">
                            <ion-icon name="school" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
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

            <header class="flex justify-end items-center">

                <button id="open-modal-btn">
                    <div class="flex gap-2 w-max">
                        <h1 class="font-semibold relative my-auto"><?=$login['username']?></h1>
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
                            <form method="post" class="flex flex-col gap-5 my-2 w-full">
                                <div class="flex flex-col gap-2">
                                    <label for="nama-mentor">Username</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="nama-mentor" type="text" placeholder="Enter your name" name="username"
                                        value="<?=$login['username']?>">
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

                                <div class="flex justify-between">
                                    <button id="close-modal-btn"
                                        class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                    <button type="submit" name="edit_profil"
                                        class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                </div>
                            </form>

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


                        </div>
                    </div>
                </div>
            </header>

            <!-- Konten -->
            <!-- ANALISTIK -->



            <!-- LIST -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-5 mt-10 w-full">
                <div class="w-64 md:w-80 aspect-square overflow-hidden rounded-lg">
                    <img src="../foto_mentor/nasyith.jpg" alt="Foto Nasyith" class="w-full h-full object-cover">
                </div>

                <div class="flex flex-col w-full text-center md:text-left space-y-3">
                    <h1 class="font-semibold text-xl md:text-2xl font-poppins">Nasyith</h1>
                    <p class="text-sm md:text-base font-semibold text-gray-400 font-poppins">Backend</p>
                    <p class="text-sm md:text-base font-poppins">
                        Berpengalaman dalam pengembangan perangkat lunak selama lebih dari dua tahun,
                        fokus utama pada backend development menggunakan berbagai teknologi termasuk
                        PHP (Laravel, CodeIgniter), Python (Django), dan Node.js. Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Nemo officia harum repellendus nam magnam? Voluptatem, corporis ipsum.
                        Laudantium excepturi harum ducimus eius deleniti porro dolor sed obcaecati quas, nisi
                        repellendus.
                    </p>

                    <div class="flex flex-col sm:flex-row md:flex-col sm:gap-5 gap-2">
                        <div class="flex gap-2 items-center">
                            <ion-icon name="call" class="text-lg"></ion-icon>
                            <p class="font-semibold text-sm">0812-3456-7891</p>
                        </div>
                        <div class="flex gap-2 items-center">
                            <ion-icon name="mail" class="text-lg"></ion-icon>
                            <p class="font-semibold text-sm">polibatam@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex flex-col md:flex-row items-center md:items-start gap-5 mt-10 w-full">
                <h1 class="font-semibold text-xl md:text-2xl font-poppins">Course</h1>

            </div>


            <div class="flex flex-col md:flex-row items-center md:items-start gap-5 mt-5 w-full">
                <div class="flex flex-wrap gap-5">
                    <a href="kursus_materi.php"
                        class="flex flex-col w-36 h-max shadow-xl rounded-lg md:w-80 overflow-hidden transition-all hover:scale-105">
                        <img src="../foto_cover_course/fullstack.jpg" alt="" class="object-cover w-full md:h-40">
                        <div class="px-3 py-3 flex flex-col gap-2">
                            <h1 class="font-poppins font-semibold text-sm md:text-base lg:text-left">Okee</h1>
                        </div>
                    </a>
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