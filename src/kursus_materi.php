<?php

include 'function.php';

$section = get_section_by_slug();
$kursus = get_course_by_slug();

?>


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
                    <?php if (!isset($_SESSION['id_user'])) : ?>
                    <a href="login.php"
                        class="border rounded-full  py-2 px-6 bg-blue-700 text-white md:bg-white md:border-blue-700 md:rounded-sm md:hover:bg-blue-700 md:py-2 md:px-5 md:text-black md:flex hover:bg-skytext-blue-700 hover:text-white">Sign
                        In</a>
                    <a href="#"
                        class="hidden md:flex md:border md:border-blue-700 md:rounded-sm bg-blue-700 py-2 px-5 text-white hover">Sign
                        Up</a>
                    <?php endif ?>

                    <a href="all-access.html"
                        class="hidden md:flex md:border md:border-blue-700 md:rounded-sm bg-blue-700 py-2 px-5 text-white hover">
                        Access</a>



                    <?php if (isset($_SESSION['id_user'])): ?>

                    <form method="post">
                        <button type="submit" name="logout" href="#"
                            class="hidden md:flex md:border md:border-blue-700 md:rounded-sm bg-blue-700 py-2 px-5 text-white hover">Logout
                        </button>
                    </form>

                    <h1 class='relative top-2 font-semibold font-poppins'><?= $_SESSION['username'] ?></h1>
                    <img src='img/user.png' alt='' width='40px' height='40px'>
                    <?php endif; ?>

                </div>


            </nav>

        <div class="w-4/5 m-auto relative top-36 flex flex-col gap-6 py-5">
            <h1 class="text-2xl font-poppins font-semibold"><?= $kursus['title']?></h1>


            <div class="space-y-4">
                <div class="relative bg-white shadow-md h-40 rounded-lg sm:h-60 overflow-hidden">
                    <img src="foto_cover_course/<?= $kursus['course_picture'] ?>" alt=""
                        class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

                    <div class="absolute inset-0 flex items-center justify-center">
                        <a href="<?= isset($_SESSION['id_user']) ? 'daftar.php' : 'buat-akun.php'; ?>"  class="text-white transition-all py-3 px-5 rounded-sm w-max font-poppins font-semibold 
                            tracking-wide border bg-blue-700 border-slate-700 text-center 
                            hover:bg-white hover:border hover:text-blue-700 hover:border-blue-700">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>






                <?php foreach ($section as $data) { ?>
                <div x-data="{ open: false }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span><?= $data['title']?></span>
                    </button>
                </div>
                <?php }?>

                <div x-data="{ open: false }" class="bg-white shadow-md rounded-lg overflow-hidden">
                    <button @click="open = open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>SERTIFIKAT PENYELESAIAN</span>
                    </button>
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