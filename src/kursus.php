<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simplify | Kursus</title>
    <link href="output.css" rel="stylesheet" />
    <link href="img/logo.png" rel="shortcut icon" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class=" m-auto bg-slate-50">
        <!-- NAVBAR -->

        <nav id="top"
            class="flex z-10 shadow-lg opacity-95 justify-between mx-10 bg-white rounded-full p-3 fixed left-0 top-3 right-0 font-poppins md:rounded-none md:top-0 md:mx-0 md:py-7">

            <div class="flex gap-4">
                <div class="flex gap-2 my-auto">
                    <div class="">
                        <img src="img/logo.png" class="w-10 h-10" alt="">
                    </div>

                    <h1 class="font-poppins font-semibold relative top-2 sm:top-1 md:hidden">Simplify
                    </h1>
                </div>


                <ul class="gap-4 hidden md:flex font-semibold relative top-2">
                    <li><a href="index.html" class="hover:text-blue-700">Beranda</a></li>
                    <li><a href="kursus.html" class="hover:text-blue-700">Kursus</a></li>
                    <li><a href="" class="hover:text-blue-700">Tentang</a></li>
                    <li><a href="#footer" class="hover:text-blue-700">Kontak</a></li>
                </ul>
            </div>

            <div class="flex gap-5 font-semibold">
                <a href="kursus-section.html"
                    class="border rounded-full  py-2 px-6 bg-blue-700 text-white md:bg-white md:border-blue-700 md:rounded-sm md:hover:bg-blue-700 md:py-2 md:px-5 md:text-black md:flex hover:bg-skytext-blue-700 hover:text-white">Sign
                    In</a>
                <a href="#"
                    class="hidden md:flex md:border md:border-blue-700 md:rounded-sm bg-blue-700 py-2 px-5 text-white hover">Sign
                    Up</a>
            </div>

            <!-- LOGIN SETUATION -->
            <!-- <button id="open-modal-btn">
                <div class="flex gap-2 w-max">
                    <h1 class="font-semibold relative my-auto">Student1</h1>
                    <img src="img/pp-profile.jpg" alt="" class="w-12 h-12 rounded-full">
                </div>
            </button> -->

            <!-- MODAL WRAPPER -->
            <!-- <div id="modal-wrapper" class="fixed z-10 inset-0 hidden">
                <div
                    class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                    
                    <div
                        class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3">
                        <form action="" class="flex flex-col gap-5 my-2 w-full">
                            <div class="flex flex-col gap-2">
                                <img src="img/pp-profile.jpg" alt="" class="w-12 h-12">
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
            </div> -->

        </nav>

        <div class="w-5/6 m-auto relative top-36 flex flex-col gap-6 py-5 bg-white p-10 rounded-sm">
            <div class="flex gap-5 flex-col">
                <h1 class="text-2xl font-poppins font-semibold">Program Kursus Tersedia</h1>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <input type="search" placeholder="Cari Kursus.."
                        class="max-w-72 py-1 px-2 border-slate-700 outline-none border rounded-md">
                    <select name="sort" id="sort" class="border border-black rounded-md py-1 px-2 hover:text-white">
                        <option value="semua">Semua Kursus</option>
                        <option value="yang-anda-ikuti">Kursus yang anda ikuti</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-wrap gap-10 m-auto text-center justify-between">
                <a href="kursus-section.html"
                    class="flex flex-col w-full md:w-80 h-max shadow-md rounded-lg md:courses overflow-hidden transition-all hover:scale-105 sm:m-auto">
                    <img src="img/social.jpg" alt="" class="object-center md:h-40">
                    <div class="px-3 py-3 flex flex-col gap-2">
                        <h1 class="font-poppins font-semibold text-sm md:text-base text-left">Frontend Pemula:
                            Dasar-Dasar HTML dan CSS</h1>

                        <h3 class="text-sm font-poppins text-left font-semibold text-slate-500">Avyz Yudistira </h3>
                        <p class="text-left md:flex">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Repellat iusto
                            nemo
                            provident
                            cupiditate nobis at
                            suscipit quam sapiente voluptatibus molestias.</p>
                    </div>
                </a>

                <a href="kursus-section.html"
                    class="flex flex-col w-full md:w-80 h-max shadow-md rounded-lg md:courses overflow-hidden transition-all hover:scale-105 sm:m-auto">
                    <img src="img/smartphoneio.jpg" alt="" class="object-center md:h-40">
                    <div class="px-3 py-3 flex flex-col gap-2">
                        <h1 class="font-poppins font-semibold text-sm md:text-base text-left">Backend Pemula:
                            Dasar-Dasar PHP dan MySQL</h1>

                        <h3 class="text-sm font-poppins text-left font-semibold text-slate-500">Avyz Yudistira</h3>
                        <p class="text-left md:flex">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Repellat iusto
                            nemo
                            provident
                            cupiditate nobis at
                            suscipit quam sapiente voluptatibus molestias.</p>
                    </div>
                </a>

                <a href="kursus-section.html"
                    class="flex flex-col w-full h-max md:w-80 shadow-md rounded-lg md:courses overflow-hidden transition-all hover:scale-105 sm:m-auto">
                    <img src="img/dashboard.jpg" alt="" class="object-center md:h-40">
                    <div class="px-3 py-3 flex flex-col gap-2">
                        <h1 class="font-poppins font-semibold text-sm md:text-base text-left">Frontend Framework:
                            Dasar-Dasar Boostrap</h1>
                        <h3 class="text-sm font-poppins text-left font-semibold text-slate-500">Avyz Yudistira</h3>
                        <p class="text-left md:flex">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Repellat iusto
                            nemo
                            provident
                            cupiditate nobis at
                            suscipit quam sapiente voluptatibus molestias.</p>
                    </div>
                </a>

                <a href="kursus-section.html"
                    class="flex flex-col w-full md:w-80 h-max shadow-md rounded-lg md:courses overflow-hidden transition-all hover:scale-105 sm:m-auto">
                    <img src="img/mysql.jpg" alt="" class="object-center md:h-40">
                    <div class="px-3 py-3 flex flex-col gap-2">
                        <h1 class="font-poppins font-semibold text-sm md:text-base text-left">Backend Framework:
                            Dasar-Dasar LaravelL</h1>
                        <h3 class="text-sm font-poppins text-left font-semibold text-slate-500">Avyz Yudistira</h3>
                        <p class="text-left md:flex">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Repellat iusto
                            nemo
                            provident
                            cupiditate nobis at
                            suscipit quam sapiente voluptatibus molestias.</p>
                    </div>
                </a>

                <a href="kursus-section.html"
                    class="flex flex-col w-full h-max md:w-80 shadow-md rounded-lg md:courses overflow-hidden transition-all hover:scale-105 sm:m-auto">
                    <img src="img/mysql.jpg" alt="" class="object-center md:h-40">
                    <div class="px-3 py-3 flex flex-col gap-2">
                        <h1 class="font-poppins font-semibold text-sm md:text-base text-left border-slate-600">Fullstack
                            Developer: Pembuatan Aplikasi Database</h1>

                        <h3 class="text-sm font-poppins text-left font-semibold text-slate-500">Avyz Yudistira</h3>
                        <p class="text-left md:flex">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Repellat iusto
                            nemo
                            provident
                            cupiditate nobis at
                            suscipit quam sapiente voluptatibus molestias.</p>
                    </div>
                </a>

                <a href="kursus-section.html"
                    class="flex flex-col w-full md:w-80 h-max shadow-md rounded-lg md:courses overflow-hidden transition-all hover:scale-105 sm:m-auto">
                    <img src="img/mysql.jpg" alt="" class="object-center md:h-40">
                    <div class="px-3 py-3 flex flex-col gap-2">
                        <h1 class="font-poppins font-semibold text-sm md:text-base text-left">Bangun Rancang UI/UX
                            Design Menggunakan Figma</h1>

                        <h3 class="text-sm font-poppins text-left font-semibold text-slate-500">Avyz Yudistira</h3>
                        <p class="text-left md:flex">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Repellat iusto
                            nemo
                            provident
                            cupiditate nobis at
                            suscipit quam sapiente voluptatibus molestias.</p>
                    </div>
                </a>

            </div>
        </div>

        <footer class="flex flex-col sm:flex-col mt-52 md:flex-row gap-10 bg-white" id="footer">
            <div class="flex flex-col gap-3 text-white bg-blue-700 px-5 py-10 md:px-7 md:py-4">
                <div class="flex gap-3 font-quicksand">
                    <img src="img/letter-s.png" alt="" width="50px">
                    <h1 class="relative top-3 font-poppins text-lg font-semibold">SIMPLIFY</h1>
                </div>
                <p class="font-semibold">Politeknik Negeri Batam</p>
                <p>Jalan Ahmad Yani, Batam Kota, Kota Batam, Kepulauan Riau.</p>
                <div class="flex gap-4">
                    <a href="#" class="w-max"><ion-icon name="logo-instagram" class="text-3xl"></ion-icon></a>
                    <a href="#" class="w-max"><ion-icon name="logo-youtube" class="text-3xl"></ion-icon></a>
                    <a href="#" class="w-max"><ion-icon name="logo-facebook" class="text-3xl"></ion-icon></a>
                    <a href="#" class="w-max"><ion-icon name="logo-github" class="text-3xl"></ion-icon></a>
                </div>
            </div>

            <div
                class=" text-slate-700 bg-white font-poppins p-3 flex flex-wrap gap-10 justify-between md:w-1/2 md:gap-20">
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

                <div class="flex flex-col gap-4">
                    <h1 class="text-black font-semibold">KOMUNITAS</h1>
                    <header
                        class="border border-b-slate-300 w-32 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
                    </header>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#">Lihat Sertifikat</a></li>
                        <li><a href="#">Grup Telegram</a></li>
                        <li><a href="#">Grup Whatsapp</a></li>
                    </ul>
                </div>
            </div>
        </footer>

    </div>

</body>

</html>