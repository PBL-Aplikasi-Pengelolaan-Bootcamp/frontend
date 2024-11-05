<?php

include 'function.php';

// get data mentor logged in
$mentor = get_data_user_login();

//edit profil
if (isset($_POST['edit_profil'])) {
    edit_profil($_POST, $mentor['id_user']);
}

//logout
if (isset($_POST['logout'])) {
    logout();
}

// create course
if (isset($_POST['create_course'])) {
    create_course($_POST);
}



// delete course
if (isset($_GET['delete_id'])) {
    delete_course($_GET['delete_id']);
}


// get course
$course = get_course_by_mentor();




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
    <title>Mentor | Tambah Kursus</title>
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
            class="sidebar fixed inset-y-0 left-0 w-64 bg-white shadow-md transform -translate-x-full md:translate-x-0 h-full z-20">
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

            <header class="flex justify-end items-center">

                <button id="open-modal-btn">
                    <div class="flex gap-2 w-max">
                        <h1 class="font-semibold relative my-auto"><?= $_SESSION['username']?></h1>
                        <img src="../foto_mentor/<?= isset($mentor['profil_picture']) ? $mentor['profil_picture'] : 'profil_default.png' ?>"
                            alt="" class="w-12 h-12 rounded-full object-cover">
                    </div>
                </button>

                <!-- MODAL WRAPPER -->
                <div id="modal-wrapper" class="fixed z-10 inset-0 hidden">
                    <div
                        class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                        <!-- MODAL BOX -->
                        <div
                            class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3 max-h-[90vh] overflow-y-auto">
                            <form method="post" enctype="multipart/form-data" class="flex flex-col gap-5 my-2 w-full">

                                <div class="flex flex-col gap-2">
                                    <label for="username">Username</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="username" name="username" type="text" placeholder="Enter your username"
                                        value="<?= $mentor['username']?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="name">Nama</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="name" name="name" type="text" placeholder="Enter your name"
                                        value="<?= $mentor['name']?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="bio">Bio</label>
                                    <textarea name="bio" id="bio"
                                        class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"><?= $mentor['bio']?></textarea>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="expertise">Expertise</label>
                                    <input type="text" name="expertise" placeholder="Masukkan keahlian anda"
                                        value="<?= $mentor['expertise']?>"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="telp">Telp</label>
                                    <input type="text" name="telp" id="telp" placeholder="Masukkan keahlian anda"
                                        value="<?= $mentor['telp']?>"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Masukkan keahlian anda"
                                        value="<?= $mentor['email']?>"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div>
                                    <!-- Preview area for cropping -->
                                    <img id="preview-image" style="max-width: 100%; display: none;" />
                                </div>

                                <!-- Button untuk crop gambar -->
                                <button type="button" id="crop-button" style="display: none;"
                                    class="px-4 py-2 h-max my-auto text-white bg-green-500 font-semibold w-max text-center rounded-md">Crop
                                    & Upload</button>

                                <div class="flex justify-end gap-2">
                                    <button type="submit" name="edit_profil" id="submit-form" style="display: none;"
                                        class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
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
            </header>

            <!-- Konten -->
            <!-- KURSUS -->
            <div class="m-auto mt-20 mb-10">
                <div x-data="{ open: false }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>Tambah Kursus</span>
                    </button>
                    <div x-show="open" class="px-4 py-2 border-t">
                        <form method="post" enctype="multipart/form-data" class="flex flex-col gap-5 my-2">
                            <div class="flex flex-col gap-2">
                                <label for="title"><strong>Title</strong></label>
                                <input type="text" name="title" class="border-slate-700 border rounded-sm py-1 px-1">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="description"><strong>Description</strong></label>
                                <input type="text" name="description"
                                    class="border-slate-700 border rounded-sm py-1 px-1">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="schedule"><strong>Schedule</strong></label>
                                <div class="flex gap-2">
                                    <input type="date" id="start_date" name="start_date"
                                        class="border-slate-700 border rounded-sm py-1 px-2 w-full">
                                    <span class="self-center">to</span>
                                    <input type="date" id="end_date" name="end_date"
                                        class="border-slate-700 border rounded-sm py-1 px-2 w-full">
                                </div>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="course_type"><strong>Course Type</strong></label>
                                <select id="course_type" name="course_type"
                                    class="border-slate-700 border rounded-sm py-1 px-1">
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="quota"><strong>Quota</strong></label>
                                <input type="number" name="quota" class="border-slate-700 border rounded-sm py-1 px-1">
                            </div>

                            <div class="flex flex-col gap-2 w-56">
                                <label for="course_picture"><strong>Image Cover</strong></label>
                                <input type="file" src="" alt="" name="course_picture">
                            </div>

                            <button type="submit" name="create_course"
                                class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="m-auto relative flex flex-col gap-6 bg-white p-10 rounded-lg">
                <div class="flex gap-5 flex-col">
                    <h1 class="text-2xl font-poppins font-semibold">Kursus Anda</h1>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input type="search" placeholder="Cari Kursus.."
                            class="max-w-72 py-1 px-2 border-slate-700 outline-none border rounded-md">
                    </div>

                </div>



                <div class="flex flex-wrap gap-10 m-auto text-center sm:justify-between">

                    <?php foreach ($course as $data) { ?>
                    <div
                        class="flex flex-col m-auto h-max shadow-md rounded-lg w-full lg:w-72 overflow-hidden transition-all xl:m-0">
                        <div class="flex p-3 absolute gap-1">
                            <a href="tambah-materi.html">
                                <ion-icon name="brush"
                                    class="bg-yellow-300 p-2 text-xl rounded-md hover:scale-105 transition-all">
                                </ion-icon>
                            </a>

                            <a href="?delete_id=<?= $data['id_course'] ?>"
                                onclick="return confirm('Are you sure you want to delete this course?');">
                                <ion-icon name="trash"
                                    class="bg-red-600 text-white p-2 text-xl rounded-md hover:scale-105 transition-all">
                                </ion-icon>
                            </a>


                            <a href="detail-kursus.html#1">
                                <ion-icon name="information-circle"
                                    class="bg-blue-700 text-white p-2 text-xl rounded-md hover:scale-105 transition-all">
                                </ion-icon>
                            </a>
                        </div>
                        <img src="../foto_cover_course/<?= $data['course_picture']?>" alt=""
                            class="object-center md:h-40">
                        <div class="px-3 py-3 flex flex-col gap-2">
                            <a href="kursus-detail.php?id=<?= $data['id_course']?>">
                                <h1 class="font-poppins font-semibold text-sm md:text-base text-left">
                                    <?= $data['title']?></h1>
                            </a>
                        </div>
                    </div>
                    <?php }?>
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

    // Modal PopUp Edit Profile
    document.getElementById("open-modal-btn").addEventListener("click", () => {
        document.getElementById("modal-wrapper").classList.remove("hidden")
    })

    document.getElementById("close-modal-btn").addEventListener("click", () => {
        document.getElementById("modal-wrapper").classList.add("hidden")
    })
    </script>
</body>

</html>