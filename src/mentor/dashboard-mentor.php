<?php 
include 'function.php';

if (isset($_POST['logout'])) {
    logout();
}
$total_course_mentor = get_total_course_mentor();

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js"></script>
    <link rel="stylesheet" href="../../fontawesome-free-6.6.0-web/fontawesome/css/all.min.css">
    <title>Mentor | Dashboard</title>
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


                    <li class="hover:bg-gray-200">
                        <form method="post" action="">
                            <button type="submit" name="logout" class="block p-4 text-gray-700 w-full text-left">
                                <ion-icon name="log-out" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                                Log Out
                            </button>
                        </form>
                    </li>

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

            <header class="flex justify-between items-center">
                <h2 class="text-2xl md:text-3xl my-auto font-semibold">Dashboard</h2>

                <button id="open-modal-btn">
                    <div class="flex gap-2 w-max">
                        <h1 class="font-semibold relative my-auto"><?= $_SESSION['username']?></h1>
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
            <!-- ANALISTIK -->
            <div class=" flex mt-10 font-poppins flex-wrap gap-5">
                <div
                    class="flex gap-3 p-3 flex-row-reverse bg-white 2xl:m-0 justify-between w-full lg:w-80 2xl:w-96 py-8 px-6 rounded-lg shadow-md">
                    <ion-icon name="school" class="rounded-full bg-blue-400 p-3 text-4xl my-auto"></ion-icon>
                    <div class="flex flex-col">
                        <h1 class="font-semibold font-poppins text-gray-300 tracking-wide text-base">STUDENT</h1>
                        <h1 class="font-bold text-lg">Student Total</h1>
                        <p class="text-xl">10</p>
                    </div>
                </div>
                <div
                    class="flex gap-3 p-3 flex-row-reverse bg-white 2xl:m-0 justify-between w-full lg:w-80 2xl:w-96 py-8 px-6 rounded-lg shadow-md">
                    <ion-icon name="bookmarks" class="rounded-full bg-yellow-400 p-3 text-4xl my-auto"></ion-icon>
                    <div class="flex flex-col">
                        <h1 class="font-semibold font-poppins text-gray-300 tracking-wide text-base">SISWA</h1>
                        <h1 class="font-bold text-lg">Course Total</h1>
                        <p class="text-xl"><?= $total_course_mentor?></p>
                    </div>
                </div>
            </div>




            <!-- LIST -->
            <div class="flex flex-wrap gap-5 mt-10 w-full">
                <div class="m-auto md:m-0 w-80 h-80 text-center overflow-hidden items-center">
                    <img src="../foto_mentor/<?=$mentor['profil_picture']?>" alt=""
                        class=" object-cover content-center rounded-lg">
                </div>


                <div class="flex flex-col w-auto md:m-0 m-auto min-h-80 text-center md:text-left space-y-2">
                    <h1 class="font-semibold text-2xl font-poppins"><?= $mentor['name'] ?></h1>
                    <p class="text-base font-semibold tracking-normal text-gray-400 font-poppins">
                        <?= $mentor['expertise'] ?>
                    </p>
                    <p class="font-poppins md:max-w-96"><?= $mentor['bio'] ?></p>

                    <div
                        class="flex flex-col sm:flex-row md:flex-col sm:gap-5 md:gap-1 m-auto md:m-0 text-center lg:text-left space-y-2 md:space-y-1">
                        <div class="flex gap-2">
                            <ion-icon name="call" class="my-auto"></ion-icon>
                            <p class="font-semibold">0812-3456-7891</p>
                        </div>
                        <div class="flex gap-2">
                            <ion-icon name="mail" class="my-auto"></ion-icon>
                            <p class="font-semibold">polibatam@gmail.com</p>
                        </div>
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