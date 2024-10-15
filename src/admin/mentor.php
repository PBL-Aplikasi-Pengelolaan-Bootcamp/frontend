<?php

include 'function.php';

if (isset($_POST['create_mentor'])) {
    create_mentor($_POST);
}

$mentor = getAll_mentor();

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
    <title>Admin | Tambah Mentor</title>
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
            class="sidebar z-10 fixed inset-y-0 left-0 w-64 bg-white shadow-md transform -translate-x-full md:translate-x-0 h-full">
            <div class="flex justify-between p-6">
                <div class="flex gap-2">
                    <img src="../img/logo1.png" alt="" class="w-10 h-10">
                    <h1 class="text-2xl font-bold text-gray-700">Simplify</h1>
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
                    <li class="hover:bg-gray-200"><a href="dashboard-admin.html" class="block p-4 text-gray-700">
                            <ion-icon name="person" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Pengguna
                        </a></li>
                    <li class="hover:bg-gray-200"><a href="dashboard-admin.html" class="block p-4 text-gray-700">
                            <ion-icon name="grid" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>List
                        </a></li>
                    <li class="hover:bg-gray-200"><a href="#tambah-mentor" class="block p-4 text-gray-700">
                            <ion-icon name="school" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>Tambah
                            Mentor
                        </a></li>
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
                <div class=""></div>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>

            <header class="flex justify-between items-center">
                <h2 class="text-3xl font-semibold">Daftar Mentor</h2>

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
                            <form method="post" class="flex flex-col gap-5 my-2 w-full">
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
            <!-- List Mentor -->
            <div class=" flex flex-col gap-3 mt-5" id="tambah-mentor">
                <!-- Search & Tambah Mentor -->
                <div class="flex gap-2">
                    <input type="search" class="w-36 md:w-56 shadow-sm px-2 py-1 rounded-md" placeholder="Cari mentor">
                    <button type="" id="tambahMentor" class="bg-blue-700 p-2 rounded-md font-semibold text-white">Tambah
                        Mentor</button>
                    <!-- Modal Tambah Mentor -->
                    <div id="modalTambah"
                        class="fixed inset-0 z-20 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div
                            class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="px-4 py-5 sm:p-6 flex flex-col gap-3">
                                <form method="post" enctype="multipart/form-data" name="create_mentor" class="grid grid-cols-2 gap-5 my-2 w-full">
                                    <div class="flex flex-col gap-2 col-span-2">
                                        <img src="../img/pp-profile.jpg" alt="" class="w-12 h-12">
                                        <label for="img">Upload Profil Picture</label>
                                        <input type="file" name="profil_picture"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="nama-mentor">Name</label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            name="name" id="nama-mentor" type="text" placeholder="Enter your name">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="expertise">Expertise</label>
                                        <input type="text" name="expertise" placeholder="Masukkan keahlian anda"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="flex flex-col gap-2 col-span-2">
                                        <label for="bio">Bio</label>
                                        <textarea name="bio"
                                            class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"></textarea>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="telp">Phone</label>
                                        <input type="text" name="telp" placeholder="Phone number"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" placeholder="Email address"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" placeholder="Masukkan username"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" placeholder="Masukkan password"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="password2">Confirmation Password</label>
                                        <input type="password" name="password2" placeholder="Masukkan password"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="flex justify-between col-span-2">
                                        <button type="submit" name="create_mentor"
                                            class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                        <button id="closeTambahMentor"
                                            class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3">

                    <?php foreach ($mentor as $data) { ?>
                        
                    
                    <div class="flex gap-2 justify-between p-3 rounded-md bg-white shadow-md">
                        <div class="flex flex-col gap-2">
                            <h1 class="font-semibold text-xl font-poppins"><?= $data['name']?></h1>
                            <h1><?=$data['expertise']?></h1>
                        </div>

                        <div class="flex gap-2 my-auto">
                            <button>
                                <ion-icon name="trash" class="bg-red-500 text-white p-3 rounded-md text-xl"></ion-icon>
                            </button>

                            <button id="openModalIF1">
                                <ion-icon name="information-circle-outline"
                                    class="bg-sky-700 p-3 text-white rounded-md text-xl"></ion-icon>
                            </button>
                        </div>

                        <!-- Modal Information -->
                        <div id="modalInformation1"
                            class="fixed inset-0 z-20 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div
                                class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                <div class="px-4 py-5 sm:p-6 flex flex-col gap-3">
                                    <img src="../img/pp-profile.jpg" alt=""
                                        class="rounded-md w-20 h-20 border border-slate-700">
                                    <div class="flex gap-3">
                                        <div class="flex gap-3 flex-col">
                                            <div class="flex gap-3">
                                                <div class="flex flex-col gap-2">
                                                    <div class="flex flex-col gap-1">
                                                        <h1 class="font-semibold text-lg">Nama</h1>
                                                        <h1 class="text-slate-500">Rafael
                                                            Setya
                                                        </h1>
                                                    </div>
                                                    <div class="flex flex-col gap-1">
                                                        <h1 class="font-semibold text-lg">Expertise</h1>
                                                        <h1 class="text-slate-500">Profesional Front End Developer</h1>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-2">
                                                    <div class="flex flex-col gap-1">
                                                        <h1 class="font-semibold text-lg">Email</h1>
                                                        <h1 class="text-slate-500">
                                                            rafaelsetya1@gmail.com
                                                        </h1>
                                                    </div>
                                                    <div class="flex flex-col gap-1">
                                                        <h1 class="font-semibold text-lg">Pengampu</h1>
                                                        <h1 class="text-slate-500">Front End Pemula, Front End
                                                            Framework.
                                                        </h1>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="flex flex-col gap-1">
                                                <h1 class="font-semibold text-lg">Bio</h1>
                                                <p class="text-slate-500">Lorem ipsum dolor sit amet consectetur
                                                    adipisicing elit. Nobis alias
                                                    quo
                                                    magnam
                                                    nam ipsam id explicabo hic, quis, nisi quam qui nesciunt tempore,
                                                    sapiente
                                                    exercitationem velit! Error deleniti facere ducimus.</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button id="closeModalIF1"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                </div>
                            </div>
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

    // Modal PopUp Edit Profile
    document.getElementById("open-modal-btn").addEventListener("click", () => {
        document.getElementById("modal-wrapper").classList.remove("hidden")
    })

    document.getElementById("close-modal-btn").addEventListener("click", () => {
        document.getElementById("modal-wrapper").classList.add("hidden")
    })

    // Modal PopUp More Information
    
    document.getElementById('openModalIF1').addEventListener('click', function() {
        document.getElementById('modalInformation1').classList.remove('hidden');
    });

    document.getElementById('closeModalIF1').addEventListener('click', function() {
        document.getElementById('modalInformation1').classList.add('hidden');
    });

    document.getElementById('openModalIF2').addEventListener('click', function() {
        document.getElementById('modalInformation2').classList.remove('hidden');
    });

    document.getElementById('closeModalIF2').addEventListener('click', function() {
        document.getElementById('modalInformation2').classList.add('hidden');
    });

    // Modal PopUp Tambah Mentor
    document.getElementById('tambahMentor').addEventListener('click', function() {
        document.getElementById('modalTambah').classList.remove('hidden');
    });

    document.getElementById('closeTambahMentor').addEventListener('click', function() {
        document.getElementById('modalTambah').classList.add('hidden');
    });
    </script>
</body>

</html>