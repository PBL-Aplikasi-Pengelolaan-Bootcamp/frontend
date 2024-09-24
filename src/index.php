<?php 
  include 'function.php';

  $course = getAll_Course();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Simplify | Studying with fun</title>
  <link href="output.css" rel="stylesheet" />
  <link href="img/logo.png" rel="shortcut icon" />
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</head>

<body>
  <div class=" m-auto bg-white">
    <!-- NAVBAR -->

    <nav id="top"
      class="flex z-10 shadow-lg opacity-95 justify-between mx-10 bg-white rounded-full p-3 fixed left-0 top-3 right-0 font-poppins md:rounded-none md:top-0 md:mx-0 md:py-7">

      <div class="flex gap-4">
        <div class="flex gap-2">
          <div class="w-max">
            <img src="img/logo.png" width="35px" alt="">
          </div>

          <h1 class="font-poppins font-semibold relative top-2 sm:top-1 md:hidden">Simplify
          </h1>
        </div>


        <ul class="gap-4 hidden md:flex font-semibold relative top-2">
          <li><a href="" class="hover:text-blue-700">Beranda</a></li>
          <li><a href="kursus.html" class="hover:text-blue-700">Kursus</a></li>
          <li><a href="" class="hover:text-blue-700">Tentang</a></li>
          <li><a href="" class="hover:text-blue-700">Kontak</a></li>
        </ul>
      </div>

      <div class="flex gap-5 font-semibold">
        <a href="login.html"
          class="border rounded-full  py-2 px-6 bg-blue-700 text-white md:bg-white md:border-blue-700 md:rounded-sm md:hover:bg-blue-700 md:py-2 md:px-5 md:text-black md:flex hover:bg-skytext-blue-700 hover:text-white">Sign
          In</a>
        <a href="#"
          class="hidden md:flex md:border md:border-blue-700 md:rounded-sm bg-blue-700 py-2 px-5 text-white hover">Sign
          Up</a>
      </div>

    </nav>

    <!-- HEADER -->
    <header
      class="relative top-40 text-center px-4 flex flex-col gap-5 md:gap-6 md:width-header m-auto md:w-5/6 md:top-56 lg:w-2/3">
      <h1 class="font-bold font-poppins text-3xl md:text-5xl lg:text-6xl lg:tracking-normal">Solusi Untuk Anda yang
        bingung
        ingin
        <span class="text-blue-700">
          Memulai Pemrograman</span>
      </h1>
      <p class="font-poppins text-slate-500 text-lg lg:text-xl">Kami akan membantu anda untuk mencapai tujuan anda
        dengan terstruktur,
        tentunya dengan mudah dan simpel. Tunggu apalagi? Daftar Sekarang.</p>
      <a href="login.html"
        class=" text-white transition-all py-3 px-5 rounded-sm w-max m-auto font-poppins font-semibold 
        tracking-wide border bg-blue-700 border-slatetext-blue-700 hover:bg-white hover:border hover:text-blue-700 hover:border-blue-700">Daftar
        Sekarang</a>
    </header>


    <!-- PROSPEK KERJA -->
    <div
      class="flex relative bg-slate-50 mt-60 lg:mt-80 justify-between p-10 text-center flex-col-reverse gap-4  lg:flex-row">
      <div class="flex flex-col gap-5 lg:w-1/2 lg:gap-5 md:my-auto">
        <h1 class="font-poppins font-semibold text-3xl hidden lg:flex text-slate-700">Prospek Kerja Impian</h1>
        <p class="lg:text-left lg:w-4/5 font-quicksand text-slate-600">TPerkembangan teknologi dapat membuka peluang
          kerja bagi seseorang. Apalagi di era digital saat ini. Pemrograman merupakan salah satu profesi yang banyak
          diminati oleh kalangan anak muda saat ini. Selain itu, profesi ini dinilai memiliki prospek masa depan.
          Kata-kata "keren" dan "gaji besar" sering kali dilontarkan kepada para programmer. Hal ini tentunya sangat
          menarik terutama bagi Anda yang ingin merasakan manisnya menjadi seorang programmer yang terampil. Tidak hanya
          itu, programmer juga memiliki hubungan kerja seperti IT support, desainer grafis, analis data, pemasaran
          digital, guru dan lain-lain.</p>
        <a href="#"
          class="bg-blue-700 hidden text-white border border-skytext-blue-700 rounded-sm w-max hover:bg-white hover:text-blue-700 border-blue-700 py-2 px-3 m-auto font-poppins font-semibold lg:ml-0 lg:mt-0">Selengkapnya</a>
      </div>

      <div class="flex flex-wrap gap-5 m-auto justify-around md:justify-between lg:justify-normal lg:m-0 md:w-1/2">
        <div class="flex flex-col w-32 bg-white shadow-md p-3 rounded-2xl text-left gap-2 lg:w-52">
          <ion-icon name="git-branch" class="text-3xl bg-white text-slate-700 rounded-xl p-1"></ion-icon>
          <h1 class="font-poppins font-semibold tracking-wide">Software Engineer</h1>
          <p class="hidden lg:flex">Merancang dan memelihara perangkat lunak sistem dengan benar.</p>
        </div>

        <div class="flex flex-col w-32 bg-white shadow-md p-3 rounded-2xl text-left gap-2 lg:w-52">
          <ion-icon name="settings" class="text-3xl text-slate-700 rounded-xl p-1"></ion-icon>
          <h1 class="font-poppins font-semibold tracking-wide">IT <br class="md:hidden">Support</h1>
          <p class="hidden lg:flex">Membantu menyelesaikan berbagai permasalahan teknologi yang dimiliki perusahaan.</p>
        </div>
        <div class="flex flex-col w-32 bg-white shadow-md p-3 rounded-2xl text-left gap-2 lg:w-52">
          <ion-icon name="brush" class="text-3xl text-slate-700 rounded-xl p-1"></ion-icon>
          <h1 class="font-poppins font-semibold tracking-wide">Graphic Designer</h1>
          <p class="hidden lg:flex">Suatu bentuk komunikasi yang dilakukan secara visual.</p>
        </div>

        <div class="flex flex-col w-32 bg-white shadow-md p-3 rounded-2xl text-left gap-2 lg:w-52">
          <ion-icon name="stats" class="text-3xl text-slate-700 rounded-xl p-1"></ion-icon>
          <h1 class="font-poppins font-semibold tracking-wide">Analyst Data</h1>
          <p class="hidden lg:flex">Jelajahi dan kembangkan data besar untuk membantu membuat keputusan yang lebih baik.
          </p>
        </div>

        <div class="flex flex-col w-32 bg-white shadow-md p-3 rounded-2xl text-left gap-2 lg:w-52">
          <ion-icon name="trending-up" class="text-3xl text-slate-700 rounded-xl p-1"></ion-icon>
          <h1 class="font-poppins font-semibold tracking-wide">Digital Marketing</h1>
          <p class="hidden lg:flex">promosi suatu merek atau merek produk atau jasa dilakukan melalui media digital.</p>
        </div>

        <div class="flex flex-col w-32 bg-white shadow-md p-3 rounded-2xl text-left gap-2 lg:w-52">
          <ion-icon name="school" class="text-3xl text-slate-700 rounded-xl p-1"></ion-icon>
          <h1 class="font-poppins font-semibold tracking-wide">Tenaga Pengajar</h1>
          <p class="hidden lg:flex">Menjadi sekolah, kursus atau guru pribadi</p>
        </div>
      </div>

      <h1 class="font-poppins font-semibold text-3xl mb-5 lg:hidden">Prospek Kerja Impian</h1>
    </div>

    <!-- POPULAR COURSE -->
    <h1 class="mt-10 font-semibold font-poppins text-2xl text-center">Program Kursus Terpopuler</h1>

    <div class="flex flex-wrap gap-5 m-auto justify-between text-center mt-10 px-10">
      
    <?php
    foreach ($course as $get) { ?>

      <a href="login.html"
        class="flex flex-col w-36 h-max shadow-xl rounded-lg md:w-80 overflow-hidden transition-all hover:scale-105">
        <img src="foto_cover_course/<?= $get['course_picture']?>" alt="" class="object-center md:h-40">
        <div class="px-3 py-3 flex flex-col gap-2">
          <h1 class="font-poppins font-semibold text-sm md:text-base lg:text-left">
            <?= $get['title']?>
          </h1>
          <p class="hidden text-left md:flex"><?= $get['description']?></p>
        </div>
      </a>
      <?php } ?>

      <!-- <a href="login.html"
        class="flex flex-col w-36 h-max  shadow-xl rounded-lg md:w-80 overflow-hidden transition-all hover:scale-105">
        <img src="img/smartphoneio.jpg" alt="" class="object-center md:h-40">
        <div class="px-3 py-3 flex flex-col gap-2">
          <h1 class="font-poppins font-semibold text-sm md:text-base lg:text-left">Backend Pemula: Dasar-Dasar PHP dan
            MySQL</h1>
          <p class="hidden text-left md:flex">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat iusto
            nemo
            provident
            cupiditate nobis at
            suscipit quam sapiente voluptatibus molestias.</p>
        </div>
      </a>

      <a href="login.html"
        class="flex flex-col w-36 h-max  shadow-xl rounded-lg md:w-80 overflow-hidden transition-all hover:scale-105">
        <img src="img/dashboard.jpg" alt="" class="object-center md:h-40">
        <div class="px-3 py-3 flex flex-col gap-2">
          <h1 class="font-poppins font-semibold text-sm md:text-base lg:text-left">Frontend Framework: Dasar-Dasar
            Boostrap</h1>
          <p class="hidden text-left md:flex">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat iusto
            nemo
            provident
            cupiditate nobis at
            suscipit quam sapiente voluptatibus molestias.</p>
        </div>
      </a>

      <a href="login.html"
        class="flex flex-col w-36 h-max shadow-xl rounded-lg md:w-80 overflow-hidden transition-all hover:scale-105">
        <img src="img/mysql.jpg" alt="" class="object-center md:h-40">
        <div class="px-3 py-3 flex flex-col gap-2">
          <h1 class="font-poppins font-semibold text-sm md:text-base lg:text-left">Backend Lanjutan: Dasar-Dasar Laravel
          </h1>
          <p class="hidden text-left md:flex">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat iusto
            nemo
            provident
            cupiditate nobis at
            suscipit quam sapiente voluptatibus molestias.</p>
        </div>
      </a> -->

    </div>
    <div class="m-auto w-max mt-10">
      <a href="kursus.html" class="text-white transition-all py-3 px-5 rounded-sm w-max font-poppins font-semibold 
    tracking-tight border bg-blue-700 border-blue-700 hover:bg-white hover:border hover:text-blue-700 m-auto">Program
        Lainnya</a>
    </div>


    <!-- INFORMATION -->

    <div class="flex flex-col gap-16 bg-slate-50 m-auto mt-20 pt-16 pb-28">
      <h1 class=" text-2xl text-center font-semibold font-poppins mt-5">Informasi dan Pesan</h1>

      <div
        class=" text-white flex-col text-left flex justify-between font-poppins px-10 rounded-md overflow-hidden md:flex-row">
        <div class="flex md:w-2/5">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15956.231225080577!2d104.0484566!3d1.1187205!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856ddfab%3A0xf9d9fc65ca00c9d!2sPoliteknik%20Negeri%20Batam!5e0!3m2!1sen!2sid!4v1726510103054!5m2!1sen!2sid"
            width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" class="rounded-md"></iframe>
        </div>

        <div class="flex flex-col gap-5 md:w-1/2">
          <h1 class="text-black font-semibold">Kirim Pesan pada Kami</h1>
          <form action="" class="flex flex-col gap-5 text-black">
            <input type="text" placeholder="Email" class="w-full bg-white px-1 py-2 border border-slate-400 rounded-md">
            <input type="text" placeholder="Nama Pengirim"
              class="w-full bg-white px-1 py-2 border border-slate-400 rounded-md">
            <textarea name="" id="" placeholder="Pesan"
              class="w-full bg-white h-32 px-1 py-2 border border-slate-400 rounded-md"></textarea>
            <button
              class="px-4 py-3 bg-blue-700 m-auto w-28 rounded-sm md:m-0 hover:opacity-90 text-white">Kirim</button>
          </form>
        </div>
      </div>
    </div>


    <footer class="flex flex-col sm:flex-col md:flex-row gap-10 bg-white">
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

      <div class=" text-slate-700 font-poppins bg-white p-3 flex flex-wrap gap-10 justify-between md:w-1/2 md:gap-20">
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