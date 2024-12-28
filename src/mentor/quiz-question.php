<?php 


include 'function.php';


if (!isset($_SESSION['id_user'])) {
    echo "<script>window.location.href = '../login.php'</script>";
}


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


// get quiz
$quiz = get_quiz_byId();

//edit_quiz
if (isset($_POST['edit_quiz'])) {
    edit_quiz($_POST);
}

//delete quiz
if (isset($_POST['delete_quiz'])) {
    delete_quiz($_POST);
}

//get question
$question = get_question_byQuiz();

//add question
if (isset($_POST['add_question'])) {
    add_question($_POST );
}

if (isset($_POST['edit_question'])) {
    edit_question($_POST);
}

if (isset($_POST['delete_question'])) {
    delete_question($_POST);
}
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
    <link rel="stylesheet" href="../../fontawesome-free-6.6.0-web/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <title>Mentor | Dashboard</title>
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
            class="sidebar fixed inset-y-0 left-0 w-64 bg-white shadow-md transform -translate-x-full md:translate-x-0 h-full">
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
                        <h1 class="font-semibold relative my-auto">
                            <?= $_SESSION['username']?>
                        </h1>
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



                                <div class="flex flex-col gap-2">
                                    <label for="profil_picture">Foto Profil</label>
                                    <input type="file" accept="image/*" name="profil_picture" id="profil_picture"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                    <!-- Hidden input untuk menyimpan base64 gambar yang sudah di-crop -->
                                    <input type="hidden" name="cropped_image" id="cropped_image">

                                    <div class="relative w-12 h-12">
                                        <img src="../foto_mentor/<?=$mentor['profil_picture']?>" alt=""
                                            id="preview-image" class="w-12 h-12 object-cover rounded-full">
                                    </div>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <div class="flex justify-between items-center">
                                        <button type="button" id="change-password-btn"
                                            class="ml-2 text-blue-500 hover:underline">Ganti Password</button>
                                    </div>
                                </div>

                                <!-- Div untuk input password lama dan baru, default disembunyikan -->
                                <div id="password-change-fields" class="hidden flex flex-col gap-2">
                                    <label for="old-password">Password Lama</label>
                                    <input type="password" id="old-password" name="old_password"
                                        placeholder="Masukkan password lama"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                    <label for="new-password">Password Baru</label>
                                    <input type="password" id="new-password" name="new_password"
                                        placeholder="Masukkan password baru"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>


                                <div class="flex justify-end gap-2">
                                    <button id="close-modal-btn"
                                        class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                    <button type="submit" name="edit_profil"
                                        class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                </div>

                            </form>


                            <div id="cropperModal"
                                class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
                                <div class="bg-white rounded-lg max-w-2xl w-full">
                                    <div class="flex justify-between items-center p-4 border-b">
                                        <h3 class="text-lg font-semibold">Crop Image</h3>
                                        <button type="button" onclick="closeCropperModal()"
                                            class="text-gray-500 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <div class="max-h-[60vh] overflow-hidden">
                                            <img id="cropperImage" class="max-w-full">
                                        </div>
                                        <div class="mt-4 flex justify-end gap-2">
                                            <button type="button" onclick="applyCrop()"
                                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                Apply Crop
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>

            <!-- Konten -->
            <!-- ANALISTIK -->
            <div class="flex flex-col">
                <div class="flex gap-5">
                    <h2 class="text-2xl md:text-3xl my-auto font-semibold">Quiz : <?=$quiz['title']?></h2>
                    <button id="open-modal-edit-quiz"
                        class="open-modal-btn-edit-quiz px-2 py-1 text-xs text-gray-700 hover:bg-gray-100 flex items-center">
                        <i class="fa-solid fa-pen-to-square text-lg"></i>
                    </button>

                    <!-- Modal -->
                    <div id="modal-edit-quiz" class="modal-wrapper fixed z-10 inset-0 hidden">
                        <div
                            class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center">
                            <div class="bg-white rounded-xl w-full md:w-2/3 p-6 relative">
                                <form method="post" enctype="multipart/form-data" class="space-y-4">

                                    <input type="number" name="id_quiz" value="<?= $quiz['id_quiz'] ?>" hidden>
                                    <div class="space-y-2">
                                        <label for="quiz">Quiz Title :</label>
                                        <input type="text" name="title" value="<?=$quiz['title']?>"
                                            class="w-full p-2 border rounded focus:outline-none focus:ring-2">
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <button type="submit" name="delete_quiz"
                                            class="px-4 py-2 h-max my-auto text-red-500 bg-none font-semibold w-max text-center rounded-md hover:text-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            DELETE QUIZ
                                        </button>
                                    </div>

                                    <div class="flex justify-end space-x-2">
                                        <button type="button" id="close-modal-edit-quiz"
                                            class="close-modal-btn-edit-quiz px-4 py-2 text-red-500 border rounded hover:bg-gray-50">
                                            Close
                                        </button>
                                        <button type="submit" name="edit_quiz"
                                            class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex mt-10 justify-between gap-5 flex-wrap">
                    <!-- Button untuk membuka modal -->
                    <button id="open-add-question"
                        class="bg-blue-700 font-poppins font-semibold text-white px-2 py-3 text-sm rounded-md">
                        Add Question
                    </button>

                    <!-- Modal -->
                    <div id="modal-add-question" class="fixed z-10 inset-0 hidden">
                        <div
                            class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                            <div
                                class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3 max-h-[90vh] overflow-y-auto">
                                <!-- Isi modal (form) -->
                                <form method="post" enctype="multipart/form-data"
                                    class="flex flex-col gap-5 my-2 w-full">
                                    <div class="flex flex-col gap-2">
                                        <label for="question" class="font-poppins font-semibold">Tambah Soal</label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="question" name="question" type="text" placeholder="Soal" required>
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label for="bio" class="font-poppins font-semibold">Option</label>
                                        <div class="flex flex-col gap-6">
                                            <!-- Option 1 -->
                                            <div class="flex flex-col gap-2">
                                                <textarea name="option1" placeholder="Option 1"
                                                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                                                    required></textarea>
                                                <div class="flex gap-2 text-gray-400">
                                                    <input type="radio" name="correct_option" value="1" id="jawaban1">
                                                    <label for="jawaban1">Jawaban Benar</label>
                                                </div>
                                            </div>

                                            <!-- Option 2 -->
                                            <div class="flex flex-col gap-2">
                                                <textarea name="option2" placeholder="Option 2"
                                                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                                                    required></textarea>
                                                <div class="flex gap-2 text-gray-400">
                                                    <input type="radio" name="correct_option" value="2" id="jawaban2">
                                                    <label for="jawaban2">Jawaban Benar</label>
                                                </div>
                                            </div>

                                            <!-- Option 3 -->
                                            <div class="flex flex-col gap-2">
                                                <textarea name="option3" placeholder="Option 3"
                                                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                                                    required></textarea>
                                                <div class="flex gap-2 text-gray-400">
                                                    <input type="radio" name="correct_option" value="3" id="jawaban3">
                                                    <label for="jawaban3">Jawaban Benar</label>
                                                </div>
                                            </div>

                                            <!-- Option 4 -->
                                            <div class="flex flex-col gap-2">
                                                <textarea name="option4" placeholder="Option 4"
                                                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                                                    required></textarea>
                                                <div class="flex gap-2 text-gray-400">
                                                    <input type="radio" name="correct_option" value="4" id="jawaban4">
                                                    <label for="jawaban4">Jawaban Benar</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit button -->
                                        <div class="flex justify-end gap-2">
                                            <button type="reset" id="close-modal"
                                                class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                                Batal
                                            </button>
                                            <button type="submit" name="add_question"
                                                class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                    // Dapatkan elemen modal dan tombol
                    const openButton = document.getElementById('open-add-question');
                    const modal = document.getElementById('modal-add-question');
                    const closeModalButton = document.getElementById('close-modal');

                    // Fungsi untuk membuka modal
                    openButton.addEventListener('click', function() {
                        modal.classList.remove('hidden');
                    });

                    // Fungsi untuk menutup modal
                    closeModalButton.addEventListener('click', function() {
                        modal.classList.add('hidden');
                    });

                    // Menutup modal saat mengklik di luar modal
                    window.addEventListener('click', function(event) {
                        if (event.target === modal) {
                            modal.classList.add('hidden');
                        }
                    });
                    </script>




                    <?php foreach ($question as $data) {                                                     
                        $option = get_option_byQuestion($data['id_question']);
                    ?>
                    <div class="flex rounded-md gap-2 bg-white w-full overflow-hidden p-4">
                        <div class="flex w-full justify-between">
                            <div class="font-poppins my-auto">
                                <h1 class="my-auto font-semibold text-md"><?=$data['question']?></h1>
                            </div>
                            <div class="flex gap-2 my-auto p-2">
                                <button data-modal-target="modal-edit-question-<?= $data['id_question'] ?>"
                                    class="open-modal-btn-edit-question">
                                    <i class="fa-regular fa-pen-to-square bg-yellow-300 p-2 rounded-md"></i>
                                </button>

                                <form method="post">
                                    <input type="number" value="<?=$data['id_question']?>" name="id_question" hidden>
                                    <button type="submit" name="delete_question">
                                        <i class="fa-solid fa-trash-can bg-red-500 p-2 rounded-md"></i>
                                    </button>
                                </form>

                                <!-- MODAL WRAPPER -->
                                <div id="modal-edit-question-<?= $data['id_question'] ?>"
                                    class="modal-wrapper fixed z-10 inset-0 hidden">
                                    <div
                                        class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75">
                                        <!-- MODAL BOX -->
                                        <div
                                            class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3 max-h-[90vh] overflow-y-auto">
                                            <form method="post" class="flex flex-col gap-5 my-2 w-full">
                                                <!-- Input untuk mengedit soal -->
                                                <div class="flex flex-col gap-2">
                                                    <label for="username" class="font-poppins font-semibold">Edit
                                                        Soal</label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        id="username" name="username" type="text" placeholder="Soal"
                                                        value="<?= htmlspecialchars($data['question']) ?>">
                                                    <input type="number" name="id_question"
                                                        value="<?=$data['id_question']?>" hidden>
                                                </div>

                                                <!-- Input untuk mengedit opsi -->
                                                <div class="flex flex-col gap-2">
                                                    <label for="bio" class="font-poppins font-semibold">Edit
                                                        Option</label>
                                                    <div class="flex flex-col gap-6">
                                                        <?php foreach ($option as $opt) { ?>
                                                        <div class="flex flex-col gap-2">
                                                            <!-- Textarea untuk setiap opsi -->
                                                            <textarea name="option[]" placeholder="Option"
                                                                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                                                                required><?= htmlspecialchars($opt['option']) ?></textarea>

                                                            <!-- Hidden input untuk ID opsi -->
                                                            <input type="hidden" name="option_ids[]"
                                                                value="<?= $opt['id_quiz_option'] ?>">

                                                            <!-- Radio button untuk jawaban benar -->
                                                            <!-- Radio button untuk jawaban benar -->
                                                            <div class="flex gap-2 text-gray-400">
                                                                <input type="radio" name="is_right"
                                                                    value="<?= htmlspecialchars($opt['id_quiz_option']) ?>"
                                                                    <?= $opt['is_right'] ? 'checked' : '' ?>>
                                                                <label>Jawaban Benar</label>
                                                            </div>

                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <!-- Tombol untuk menyimpan atau membatalkan -->
                                                <div class="flex justify-end gap-2">
                                                    <button type="button"
                                                        class="close-modal-btn-edit-information w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none">Close</button>
                                                    <button type="submit" name="edit_question"
                                                        class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>


                </div>
            </div>
        </div>


        <script>
        let cropper = null;
        const profileForm = document.getElementById('profileForm');
        const fileInput = document.getElementById('profil_picture');
        const previewImage = document.getElementById('preview-image');
        const cropperModal = document.getElementById('cropperModal');
        const cropperImage = document.getElementById('cropperImage');
        const croppedImageInput = document.getElementById('cropped_image');

        // File input change handler
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Initialize cropper
                    cropperImage.src = e.target.result;
                    cropperModal.classList.remove('hidden');

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(cropperImage, {
                        aspectRatio: 1,
                        viewMode: 2,
                        dragMode: 'move',
                        autoCropArea: 1,
                        restore: false,
                        guides: true,
                        center: true,
                        highlight: false,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: false,
                        initialAspectRatio: 1,
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        // Apply crop function
        function applyCrop() {
            if (!cropper) return;

            // Get cropped canvas
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            // Convert to blob
            canvas.toBlob(function(blob) {
                // Create file from blob
                const fileName = fileInput.files[0].name;
                const croppedFile = new File([blob], fileName, {
                    type: 'image/jpeg'
                });

                // Create FileList object
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                fileInput.files = dataTransfer.files;

                // Update preview
                previewImage.src = canvas.toDataURL('image/jpeg');

                // Store base64 in hidden input
                croppedImageInput.value = canvas.toDataURL('image/jpeg');

                // Close modal
                closeCropperModal();
            }, 'image/jpeg', 0.9);
        }

        function closeCropperModal() {
            cropperModal.classList.add('hidden');
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }

        // Handle form submission
        profileForm.addEventListener('submit', function(e) {
            if (fileInput.files.length > 0 && !croppedImageInput.value) {
                e.preventDefault();
                alert('Please crop the image before submitting');
                return;
            }
        });

        // Close modal when clicking outside
        cropperModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeCropperModal();
            }
        });

        // Close button handler
        document.getElementById('close-modal-btn').addEventListener('click', function() {
            window.history.back();
        });
        </script>


        <!-- Edit pw -->
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const changePasswordBtn = document.getElementById("change-password-btn");
            const passwordChangeFields = document.getElementById("password-change-fields");

            changePasswordBtn.addEventListener("click", function() {
                // Toggle visibility
                if (passwordChangeFields.classList.contains("hidden")) {
                    passwordChangeFields.classList.remove("hidden");
                    changePasswordBtn.innerText = "Batal Ganti Password";
                } else {
                    passwordChangeFields.classList.add("hidden");
                    changePasswordBtn.innerText = "Ganti Password";
                }
            });
        });
        </script>



        <script>
        // Fungsi untuk toggle sidebar
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('close-sidebar');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle(
                '-translate-x-full'); // Toggle kelas untuk menampilkan/menyembunyikan sidebar
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

        // Modal PopUp
        document.getElementById("open-edit-1").addEventListener("click", () => {
            document.getElementById("modal-edit-1").classList.remove("hidden")
        })

        document.getElementById("close-edit-1").addEventListener("click", () => {
            document.getElementById("modal-edit-1").classList.add("hidden")
        })

        // Modal PopUp
        document.getElementById("open-add-question").addEventListener("click", () => {
            document.getElementById("modal-add-question").classList.remove("hidden")
        })

        document.getElementById("close-add-question").addEventListener("click", () => {
            document.getElementById("modal-add-question").classList.add("hidden")
        })
        </script>


        <script>
        document.addEventListener("DOMContentLoaded", () => {


            // Select elements
            const openModalBtn = document.getElementById('open-modal-edit-quiz');
            const closeModalBtn = document.getElementById('close-modal-edit-quiz');
            const modal = document.getElementById('modal-edit-quiz');

            // Function to open modal
            openModalBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });

            // Function to close modal
            closeModalBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // Close modal if clicked outside content
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });













            // Buka modal
            document.querySelectorAll('.open-modal-btn-edit-question').forEach(btn => {
                btn.addEventListener('click', (event) => {
                    event.preventDefault();
                    const modalId = btn.getAttribute('data-modal-target');
                    const modalWrapper = document.getElementById(modalId);
                    if (modalWrapper) {
                        modalWrapper.classList.remove('hidden');
                    } else {
                        console.error(`Modal dengan ID '${modalId}' tidak ditemukan.`);
                    }
                });
            });

            // Tutup modal
            document.querySelectorAll('.close-modal-btn-edit-information').forEach(btn => {
                btn.addEventListener('click', (event) => {
                    event.preventDefault();
                    const modalWrapper = btn.closest('.modal-wrapper');
                    if (modalWrapper) {
                        modalWrapper.classList.add('hidden');
                    }
                });
            });
        });
        </script>

</body>

</html>