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
    <title>Mentor | Tambah Quiz</title>
    <style>
        .sidebar {
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="sidebar fixed inset-y-0 left-0 z-10 w-64 bg-white shadow-md transform -translate-x-full md:translate-x-0 h-full">
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

            <header class="flex justify-between items-center">
                <h2 class="text-2xl md:text-3xl my-auto font-semibold">Tambah Quiz</h2>

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
            <div class="space-y-4 mt-10">
                <!-- SECTION -->
                <div x-data="{ open: true }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-orange-400 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>INPUT: SOAL QUIZ</span>
                    </button>
                    <div x-show="open"
                        class="px-4 py-2 border-t mx-auto bg-white p-4 rounded-lg shadow flex flex-col gap-7">
                        <div class="flex flex-col gap-3">
                            <h1 class="font-semibold text-xl">Pertanyaan:</h1>
                            <textarea id="editor1"
                                class="w-full h-full p-20 border border-gray-300 rounded mt-10 mb-5"></textarea>
                        </div>
                        <div class="flex flex-col gap-3">
                            <h1 class="font-semibold text-xl">Options:</h1>
                            <textarea id="editor2"
                                class="w-full h-full p-20 border border-gray-300 rounded mt-10 mb-5"></textarea>
                        </div>
                        <div class="flex flex-col gap-3">
                            <div class="flex gap-1">
                                <input type="checkbox" class="w-4 h-4 my-auto">
                                <h1 class="font-semibold text-xl my-auto">Answer:</h1>
                            </div>
                            <textarea id="editor3"
                                class="w-full h-full p-20 border border-gray-300 rounded mt-10 mb-5"></textarea>
                        </div>
                        <div class="flex flex-col gap-3">
                            <div class="flex gap-1">
                                <input type="checkbox" class="w-4 h-4 my-auto">
                                <h1 class="font-semibold text-xl my-auto">Answer:</h1>
                            </div>
                            <textarea id="editor4"
                                class="w-full h-full p-20 border border-gray-300 rounded mt-10 mb-5"></textarea>
                        </div>
                        <div class="flex flex-col gap-3">
                            <div class="flex gap-1">
                                <input type="checkbox" class="w-4 h-4 my-auto">
                                <h1 class="font-semibold text-xl my-auto">Answer:</h1>
                            </div>
                            <textarea id="editor5"
                                class="w-full h-full p-20 border border-gray-300 rounded mt-10 mb-5"></textarea>
                        </div>
                        <div class="flex flex-col gap-3">
                            <div class="flex gap-1">
                                <input type="checkbox" class="w-4 h-4 my-auto">
                                <h1 class="font-semibold text-xl my-auto">Answer:</h1>
                            </div>
                            <textarea id="editor6"
                                class="w-full h-full p-20 border border-gray-300 rounded mt-10 mb-5"></textarea>
                        </div>
                        <button type="submit"
                            class="bg-green-500 text-white w-max px-3 py-2 rounded-lg font-semibold font-poppins">Simpan</button>
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

        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor3'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor4'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor5'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor6'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>