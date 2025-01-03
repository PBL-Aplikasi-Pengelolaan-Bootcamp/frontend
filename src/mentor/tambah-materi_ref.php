<?php

include 'function.php';

$course = get_course_by_id();


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simplify | Kursus Detail</title>
    <link href="../output.css" rel="stylesheet" />
    <link href="img/logo.png" rel="shortcut icon" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
</head>

<body>
    <div class=" m-auto bg-slate-50">
        <!-- NAVBAR -->

        <nav id="top"
            class="flex z-10 shadow-lg justify-between mx-10 bg-white rounded-full p-3 fixed left-0 top-3 right-0 font-poppins md:rounded-none md:top-0 md:mx-0 md:py-7">
            <div class="flex gap-4">
                <div class="flex gap-2 my-auto">
                    <div class="">
                        <img src="../img/logo.png" width="35px" alt="">
                    </div>

                    <h1 class="font-poppins font-semibold relative top-1 sm:top-1 md:hidden">Simplify
                    </h1>
                </div>


                <ul class="gap-4 hidden md:flex font-semibold relative top-2">
                    <li><a href="../index.html" class="hover:text-blue-700">Beranda</a></li>
                    <li><a href="../courses.html" class="hover:text-blue-700">Kursus</a></li>
                    <li><a href="" class="hover:text-blue-700">Tentang</a></li>
                    <li><a href="" class="hover:text-blue-700">Kontak</a></li>
                </ul>
            </div>


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
            </div>
        </nav>

        <div class="w-4/5 m-auto relative top-36 flex flex-col gap-6 py-5">

            
            <h1 class="text-2xl font-poppins font-semibold"><?=$course['title']?></h1>



            <div class="space-y-4 mt-5">
                <!-- SECTION -->
                
                <div class="bg-white shadow-md h-40 rounded-lg sm:h-60 overflow-hidden mb-10">
                    <img src="../img/smartphoneio.jpg" alt="">
                </div>
                <div x-data="{ open: false }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-orange-400 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>INPUT: COVER GAMBAR </span>
                    </button>
                    <div x-show="open"
                        class="px-4 py-2 border-t mx-auto bg-white p-4 rounded-lg shadow flex flex-col gap-5">
                        <div class="flex gap-5">
                            <h1 class="font-semibold text-xl">Cover Gambar:</h1>
                            <input type="file" class="border-slate-700 border rounded-sm py-1 px-1 w-full">
                        </div>
                        <button type="submit"
                            class="bg-green-500 text-white w-max px-3 py-2 rounded-lg font-semibold font-poppins">Simpan</button>
                    </div>
                </div>

                <!-- SECTION 1 -->
                <div x-data="{ open: false }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-orange-400 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>INPUT MATERIAL</span>
                    </button>

                    <form method="post">
                    <div x-show="open"
                        class="px-4 py-2 border-t mx-auto bg-white p-4 rounded-lg shadow flex flex-col gap-5">
                        <div class="flex gap-5">
                            <h1 class="font-semibold text-xl">Judul Section:</h1>
                            <input type="text" name="section" placeholder="PERTEMUAN 1 - PERKENALAN HTML"
                                class="border-slate-700 border rounded-sm py-1 px-1 w-full">
                        </div>
                        <div class="flex gap-5">
                            <h1 class="font-semibold text-xl">Link  Youtube:</h1>
                            <input type="text" name="materi_video" placeholder="Link youtube"
                                class="border-slate-700 border rounded-sm py-1 px-1 w-full">
                        </div>

                        <h1 class="font-semibold text-xl">Materi Text:</h1>

                        <textarea id="editor1" name="materi_text"
                            class="w-full h-full p-20 border border-gray-300 rounded mt-10 mb-5"></textarea>
                        <button type="submit" name="create_material"
                            class="bg-green-500 text-white w-max px-3 py-2 rounded-lg font-semibold font-poppins">Simpan</button>
                    </div>
                    </form>

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
                            <h1 class="text-2xl font-semibold">Pengenalan HTML</h1>
                            <iframe class="iframe-youtube"
                                src="https://www.youtube.com/embed/Q2VqCG13ejA?si=UEQsKOXVmAhX0mli"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <hr>
                        <!-- INNER SECTION 2 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">Struktur Dasar HTML</h1>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <hr>
                        <!-- INNER SECTION 3 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">Elemen HTML Penting</h1>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan lainnya.
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

            

                <div x-data="{ open: true }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>PERTEMUAN 2 - PERKENALAN CSS</span>
                    </button>
                    <div x-show="open" class="px-4 py-2 border-t flex flex-col gap-4">
                        <!-- INNER SECTION 1 -->
                        <div class="flex flex-col gap-4">
                            <h1 class="text-2xl font-semibold">Pengenalan CSS</h1>
                            <iframe class="iframe-youtube"
                                src="https://www.youtube.com/embed/CleFk3BZB3g?si=BzYBzTRZ-EZdgDXq"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <p>CSS adalah bahasa gaya yang digunakan untuk mendesain dan mengatur tampilan halaman web.
                                CSS memungkinkan pemisahan konten (HTML) dari presentasi (desain).</p>
                        </div>
                        <hr>
                        <!-- INNER SECTION 2 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">2. Selektor CSS</h1>
                            <p>Selektor digunakan untuk memilih elemen HTML yang ingin diberi gaya. Jenis-jenis
                                selektor:
                            </p>
                            <ul class="list-decimal relative left-4">
                                <li>selector Elemen: Memilih semua elemen tertentu.</li>
                                <li>Selector Kelas: Memilih elemen berdasarkan kelas.</li>
                                <li>Selector ID: Memilih elemen berdasarkan ID.</li>
                                <li>Selector Atribut: Memilih elemen berdasarkan atribut tertentu.</li>
                            </ul>

                        </div>
                        <hr>
                        <!-- INNER SECTION 3 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">3. Properti CSS</h1>
                            <p>CSS memiliki berbagai properti untuk mengatur gaya elemen, termasuk:</p>
                            <ul class="list-decimal relative left-4">
                                <li>Warna dan Latar Belakang: color, background-color, background-image.</li>
                                <li>Teks: font-family, font-size, font-weight, text-align.</li>
                                <li>Margin dan Padding: margin, padding.</li>
                                <li>Batas: border, border-radius</li>
                            </ul>
                        </div>
                        <hr>
                        <!-- INNER SECTION 4 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">Struktur Dasar CSS</h1>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <hr>
                        <!-- QUIZ SECTION -->
                        <div class="flex flex-col gap-2">
                            <div class="flex gap-2">
                                <!-- <ion-icon name="alarm" class="text-2xl relative top-1"></ion-icon> -->
                                <h1 class="font-semibold text-2xl">Quiz: Dasar-dasar CSS</h1>
                            </div>

                            <a href="#" class="text-blue-700">https://youtu.be/Q2VqCG13ejA?si=F8Du2oHxMqFSmGlM</a>

                        </div>
                        <hr>
                    </div>
                </div>

              

                <div x-data="{ open: true }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>PERTEMUAN 3 - HTML STYLES - CSS</span>
                    </button>
                    <div x-show="open" class="px-4 py-2 border-t flex flex-col gap-4">
                        <!-- SECTION 1 -->
                        <div class="flex flex-col gap-4">
                            <h1 class="text-2xl font-semibold">Cara Penggunaan CSS pada HTML</h1>
                            <iframe class="iframe-youtube"
                                src="https://www.youtube.com/embed/6xgLY8kSXO8?si=aS--D2EGCB3bxSTq"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <hr>
                        <!-- SECTION 2 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">Struktur Dasar HTML</h1>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <hr>
                        <!-- SECTION 3 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">Elemen HTML Penting</h1>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <hr>
                        <!-- SECTION 4 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">Struktur Dasar CSS</h1>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <hr>
                        <!-- QUIZ SECTION -->
                        <div class="flex flex-col gap-2">
                            <div class="flex gap-2">
                                <!-- <ion-icon name="alarm" class="text-2xl relative top-1"></ion-icon> -->
                                <h1 class="font-semibold text-2xl">Quiz: Styling Tag HTML menggunakan CSS</h1>
                            </div>

                            <a href="#" class="text-blue-700">https://youtu.be/Q2VqCG13ejA?si=F8Du2oHxMqFSmGlM</a>

                        </div>
                        <hr>
                    </div>
                </div>

            </div>


        </div>


        <footer class="flex flex-col sm:flex-col mt-52 md:flex-row gap-10 bg-white">
            <div class="flex flex-col gap-3 text-white bg-blue-700 px-5 py-10 md:px-7 md:py-4">
                <div class="flex gap-1 font-quicksand">
                    <img src="../img/letter-s.png" alt="" width="50px">
                    <h1 class="relative top-3 font-poppins text-lg font-semibold">SIMPLIFY</h1>
                </div>
                <p class="font-semibold">Politeknik Negeri Batam</p>
                <p>Ahmad Yani, Batam Kota District, Batam City, Riau Islands.</p>
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
                    <h1 class="text-black font-semibold">COMPANY</h1>
                    <header
                        class="border border-b-slate-300 w-32 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
                    </header>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Copyright</a></li>
                    </ul>
                </div>

                <div class="flex flex-col gap-4">
                    <h1 class="text-black font-semibold">LEARN</h1>
                    <header
                        class="border border-b-slate-300 w-32 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
                    </header>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#">Online Class</a></li>
                        <li><a href="#">Offline Class</a></li>
                        <li><a href="#">All Course</a></li>
                    </ul>
                </div>

                <div class="flex flex-col gap-4">
                    <h1 class="text-black font-semibold">COMUNITY</h1>
                    <header
                        class="border border-b-slate-300 w-32 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
                    </header>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#">Check Certificate</a></li>
                        <li><a href="#">Telegram Group</a></li>
                        <li><a href="#">Discord</a></li>
                    </ul>
                </div>
            </div>
        </footer>

    </div>

</body>
<script>
    // Modal PopUp Edit Profile
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
</script>

</html>