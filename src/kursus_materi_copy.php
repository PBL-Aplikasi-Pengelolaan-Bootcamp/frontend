<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kursus | Materi</title>
    <link href="output.css" rel="stylesheet" />
    <link href="img/logo.png" rel="shortcut icon" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js"></script>
</head>

<body>
    <div class=" m-auto bg-slate-50">
        <!-- NAVBAR -->

        <nav id="top"
            class="flex z-10 shadow-lg justify-between mx-10 bg-white rounded-full p-3 fixed left-0 top-3 right-0 font-poppins md:rounded-none md:top-0 md:mx-0 md:py-7">

            <div class="flex gap-4">
                <div class="flex gap-2 my-auto">
                    <div class="relative bottom-1">
                        <img src="img/logo.png" class="w-10 h-10" alt="">
                    </div>

                    <h1 class="font-poppins font-semibold relative top-2 sm:top-1 md:hidden">Simplify
                    </h1>
                </div>


                <ul class="gap-4 hidden md:flex font-semibold relative top-2">
                    <li><a href="index.html" class="hover:text-blue-700">Beranda</a></li>
                    <li><a href="courses.html" class="hover:text-blue-700">Kursus</a></li>
                    <li><a href="about.html" class="hover:text-blue-700">Tentang</a></li>
                    <li><a href="index.html#kontak" class="hover:text-blue-700">Kontak</a></li>
                </ul>
            </div>

            <button id="open-modal-btn">
                <div class="flex gap-2 w-max">
                    <h1 class="font-semibold relative my-auto">Student1</h1>
                    <img src="img/pp-profile.jpg" alt="" class="w-12 h-12 rounded-full">
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
                                    class="px-7 py-1 text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                <button id="close-modal-btn"
                                    class="mt-3 w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </nav>

        <div class="w-4/5 m-auto relative top-36 flex flex-col gap-6 py-5">
            <h1 class="text-2xl font-poppins font-semibold">Frontend Pemula: Dasar-Dasar HTML & CSS</h1>


            <div class="space-y-4">
                <!-- SECTION 1 -->
                <div class="bg-white shadow-md h-40 rounded-lg sm:h-60 overflow-hidden">
                    <img src="img/smartphoneio.jpg" alt="">
                </div>

                <!-- SECTION 1 -->
                <!-- <div x-data="{ open: true }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>PENDAHULUAN</span>
                    </button>
                    <div x-show="open" class="px-4 py-2 border-t">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat eum provident sint quaerat
                            consequuntur veniam soluta totam dolorem at. Beatae amet neque provident, nam inventore
                            itaque, ratione quam sequi quidem eum dolorem quis. Nam explicabo illo sapiente totam
                            nostrum magni sed commodi suscipit veritatis minima. Distinctio corrupti sed praesentium
                            obcaecati.</p>
                    </div>
                </div> -->

                <!-- SECTION 2 -->
                <div x-data="{ open: true }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>PERTEMUAN 1 - PERKENALAN HTML</span>
                    </button>
                    <div x-show="open" class="px-4 py-2 border-t flex flex-col gap-4">
                        <!-- INNER SECTION 1 -->
                        <div class="flex flex-col gap-4">
                            <!-- <h1 class="text-2xl font-semibold"></h1> -->
                            <iframe class="iframe-youtube"
                                src="https://www.youtube.com/embed/Q2VqCG13ejA?si=UEQsKOXVmAhX0mli"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <!-- <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p> -->
                        </div>
                        <hr>
                        <!-- INNER SECTION 2 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">Materi Text</h1>
                            <p>HTML, atau HyperText Markup Language, adalah bahasa markup yang digunakan untuk membuat
                                dan
                                menyusun struktur halaman web. HTML menggunakan elemen-elemen atau tag untuk menentukan
                                berbagai bagian dari sebuah halaman web, seperti paragraf, gambar, tautan, dan lainnya.
                                Setiap elemen HTML biasanya terdiri dari tag pembuka, isi, dan tag penutup.</p>
                        </div>
                        <!-- <hr> -->
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

                            <a href="quizfy-cover.html" class="text-blue-700">Quiz.fy : Dasar-dasar HTML</a>

                        </div>
                        <hr>
                    </div>
                </div>

                <!-- SECTION 3 -->
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

                <!-- SECTION 4 -->
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




                <!-- CERTIFICATION -->
                <div x-data="{ open: true }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>SERTIFIKAT PENYELESAIAN</span>
                    </button>
                    <div x-show="open" class="px-4 py-2 border-t flex flex-col gap-4">
                        <!-- INNER SECTION 1 -->
                        
                      
                        <!-- INNER SECTION 2 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold">SELAMAT !</h1>
                            <p>Anda telah menyelesaikan kursus ini dengan baik. Sebagai penghargaan atas usaha dan dedikasi Anda dalam mempelajari materi, kami dengan bangga memberikan Sertifikat Penyelesaian.

                                Sertifikat ini merupakan bukti bahwa Anda telah berhasil menyelesaikan semua modul dan tugas yang ditetapkan. Dengan sertifikat ini, Anda dapat menunjukkan kemampuan dan pengetahuan yang telah Anda peroleh kepada pihak lain, termasuk dalam pencarian kerja atau pengembangan karier Anda. <br>
                                </p>
                        </div>
                        <hr>
                        <!-- INNER SECTION 3 -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl font-semibold"></h1>
                            <p>Klik link/tombol di bawah ini untuk mengunduh sertifikat Anda.</p>
                            <a href="download-certificate.php?course=<?= urlencode($id_course) ?>" 
   class="mt-4 mb-4 inline-block px-6 py-3 bg-white border border-blue-600 text-blue-600 font-bold rounded-lg hover:bg-blue-100 transition duration-200">
   Unduh Sertifikat
</a>
                        </div>
                       
                    </div>
                </div>

            </div>


        </div>


        <footer class="flex flex-col sm:flex-col mt-52 md:flex-row gap-10 bg-white">
            <div class="flex flex-col gap-3 text-white bg-blue-700 px-5 py-10 md:px-7 md:py-4">
                <div class="flex gap-1 font-quicksand">
                    <img src="img/letter-s.png" alt="" width="50px">
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
</script>

</html>