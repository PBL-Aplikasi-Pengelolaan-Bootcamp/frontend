<?php

include 'function.php';

if (isset($_POST['create_course'])) {
    create_course($_POST);
}

$course = get_course_by_mentor();




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mentor | Kursus</title>
    <link href="../output.css" rel="stylesheet" />
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
                    <div class="">
                        <img src="../img/logo.png" width="35px" alt="">
                    </div>

                    <h1 class="font-poppins font-semibold relative top-1 sm:top-1 md:hidden">Simplify
                    </h1>
                </div>


                <ul class="gap-4 hidden md:flex font-semibold relative top-2">
                    <li><a href="../index.html" class="hover:text-blue-700">Beranda</a></li>
                    <li><a href="../kursus.html" class="hover:text-blue-700">Kursus</a></li>
                    <li><a href="" class="hover:text-blue-700">Tentang</a></li>
                    <li><a href="" class="hover:text-blue-700">Kontak</a></li>
                </ul>
            </div>

            <div class="flex gap-3 font-normal">
                <a href="#"
                    class="hidden md:flex md:border md:border-blue-700 md:rounded-sm bg-blue-700 py-2 px-5 text-white hover">Logout
                </a>
                <h1 class="relative top-2 font-semibold font-poppins">Admin1</h1>
                <img src="../img/user.png" alt="" width="40px" height="40px">
            </div>

        </nav>

        <div class="w-5/6 m-auto mt-40 mb-10">
            <div x-data="{ open: false }" class="bg-white shadow-md rounded-lg overflow-hidden">
                <button @click="open = !open"
                    class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                    <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                    <span>Tambah Kursus</span>
                </button>
                <div x-show="open" class="px-4 py-2 border-t">
                    <form method="post" enctype="multipart/form-data" class="flex flex-col gap-5 my-2">
                        <div class="flex flex-col gap-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="border-slate-700 border rounded-sm py-1 px-1">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="border-slate-700 border rounded-sm py-1 px-1">
                        </div>
                        <div class="flex flex-col gap-2 w-56">
                            <label for="course_picture">Image Cover</label>
                            <input type="file" src="" alt="" name="course_picture">
                        </div>

                        <button type="submit" name="create_course"
                            class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Tambah</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="w-5/6 m-auto relative flex flex-col gap-6 py-5 bg-white p-10 rounded-sm">
            <div class="flex gap-5 flex-col">
                <h1 class="text-2xl font-poppins font-semibold">Program Kursus Tersedia</h1>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="search" placeholder="Cari Kursus.."
                        class="max-w-72 py-1 px-2 border-slate-700 outline-none border rounded-md">
                    <!-- <select name="sort" id="sort" class="border  border-black rounded-md py-1 px-2">
                        <option value="semua">Semua Kursus</option>
                        <option value="yang-anda-ikuti">Kursus yang anda ikuti</option>
                    </select> -->
                </div>

            </div>



            <div class="flex flex-wrap gap-10 m-auto text-center justify-between">

                <?php foreach ($course as $data) { ?>
                <div
                    class="flex flex-col w-full h-max shadow-md rounded-lg md:courses overflow-hidden transition-all sm:m-auto">
                    <div class="flex p-3 absolute gap-1">
                        <a href="tambah-materi.php?id=<?=$data['id_course']?>">
                            <ion-icon name="brush"
                                class="bg-yellow-300 p-2 text-xl rounded-md hover:scale-105 transition-all"></ion-icon>
                        </a>
                        <a href="#">
                            <ion-icon name="trash"
                                class="bg-red-600 text-white p-2 text-xl rounded-md hover:scale-105 transition-all">
                            </ion-icon>
                        </a>
                    </div>
                    <img src="../foto_cover_course/<?=$data['course_picture']?>" alt="" class="object-center md:h-40">
                    <div class="px-3 py-3 flex flex-col gap-2">
                        <h1 class="font-poppins font-semibold text-sm md:text-base text-left"><?=$data['title']?></h1>

                        <h3 class="text-sm font-poppins text-left font-semibold text-slate-500">Avyz Yudistira </h3>
                        <p class="text-left md:flex">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Repellat iusto
                            nemo
                            provident
                            cupiditate nobis at
                            suscipit quam sapiente voluptatibus molestias.</p>
                    </div>
                </div>
                <?php }?>

            </div>
        </div>

        <footer class="flex flex-col sm:flex-col mt-40 md:flex-row gap-10 bg-white">
            <div class="flex flex-col gap-3 text-white bg-blue-700 px-5 py-10 md:px-7 md:py-4">
                <div class="flex gap-3 font-quicksand">
                    <img src="../img/letter-s.png" alt="" width="50px">
                    <h1 class="relative top-3 font-poppins text-lg font-semibold">SIMPLIFY</h1>
                </div>
                <p class="font-semibold">Politeknik Negeri Batam</p>
                <p>Jalan Ahmad Yani, Batam Kota, Kota Batam, Kepulauan Riau.</p>
                <div class="flex gap-4">
                    <a href="#" class="w-max">
                        <ion-icon name="logo-instagram" class="text-3xl"></ion-icon>
                    </a>
                    <a href="#" class="w-max">
                        <ion-icon name="logo-youtube" class="text-3xl"></ion-icon>
                    </a>
                    <a href="#" class="w-max">
                        <ion-icon name="logo-facebook" class="text-3xl"></ion-icon>
                    </a>
                    <a href="#" class="w-max">
                        <ion-icon name="logo-github" class="text-3xl"></ion-icon>
                    </a>
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