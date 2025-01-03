<?php

include 'function.php';


$data_login = get_data_user_login();
$quiz = get_quiz_byId();




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simplify | Selamat datang di Quizfy</title>
    <link href="output.css" rel="stylesheet" />
    <link href="img/logo.png" rel="shortcut icon" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="m-auto flex flex-col gap-4 justify-center w-full md:w-5/12 relative top-44 p-3">
        <h1 class="text-6xl text-blue-600 font-poppins font-bold text-center">Quiz.fy</h1>
        <p class="text-center font-semibold">Topik: <?=$quiz['title']?></p>
        <div class="flex gap-4 flex-col">
            <p class="text-center">Harap jawab soal quiz dengan serius, seksama dan menaati peraturan yang telah di
                buat. Jika anda menekan tombol <span class="font-semibold">Mulai</span> maka anda sudah siap menaati
                peraturan
                yang ada. <button id="open-modal-btn" class="text-blue-600 font-semibold">Baca
                    rules.</button>
            </p>
            <div class="flex gap-2 m-auto">
                <a href="quiz.php?id=<?=$quiz['id_quiz']?>" class="border-blue-600 rounded-md px-7 py-2 border hover:bg-white
                    hover:text-black font-semibold bg-blue-600 text-white">Mulai</a>
            </div>
        </div>

        <!-- MODAL WRAPPER -->
        <div id="modal-wrapper" class="fixed z-10 inset-0 hidden">
            <div class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                <!-- MODAL BOX -->
                <div class="flex flex-col bg-white px-10 py-7 gap-5 rounded-xl w-max">
                    <h1 class="font-poppins text-center font-semibold">Diharapkan untuk mengikuti ketentuan yang ada.
                    </h1>
                    <ul class="list-decimal flex flex-col gap-1">
                        <li>Jawab quiz dengan jujur.</li>
                        <li>Lakukan tanpa bantuan orang lain</li>
                        <li>Dilarang membuka tab baru.</li>
                        <li>Dilarang belah layar.</li>
                        <li>Dilarang menggunakan bantuan AI.</li>
                        <li>Ingat baik baik isi soal dan jawaban quiz.</li>
                    </ul>
                    <P class="text-slate-400">*Jika anda ketahuan tidak mengikuti peraturan yang ada, maka anda akan
                        dinyatakan tidak lulus kelas.
                    </P>
                    <button id="close-modal-btn"
                        class="mt-3 w-max inline-flex m-auto rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                </div>
            </div>
        </div>
    </div>


</body>
<script>
// Modal PopUp
document.getElementById("open-modal-btn").addEventListener("click", () => {
    document.getElementById("modal-wrapper").classList.remove("hidden")
})

document.getElementById("close-modal-btn").addEventListener("click", () => {
    document.getElementById("modal-wrapper").classList.add("hidden")
})
</script>

</html>