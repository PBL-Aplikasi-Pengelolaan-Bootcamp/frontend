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

// get data dari course
$course = get_course_by_id();

$quiz = get_quiz_byCourse();

//get data section by course
$section = get_section_byCourseId();

//buat quiz
if (isset($_POST['add_quiz'])) {
    add_quiz2($_POST);
}

//delete quiz
if (isset($_POST['delete_quiz'])) {
    delete_quiz($_POST);
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
            <h2 class="text-2xl md:text-3xl my-auto font-semibold">Course : <?=$course['title']?></h2>

            <div class="flex flex-col mt-5">
                <div x-data="{ open: true }" class="bg-white shadow-md w-full rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span>Tambah Quiz</span>
                    </button>
                    <div x-show="open" class="px-4 py-2 border-t flex flex-col gap-4">
                        <form method="post" enctype="multipart/form-data" class="flex flex-col gap-5 my-2 w-full">

                            <div class="flex flex-col gap-2">
                                <label for="section">Section</label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="section" name="section">
                                    <option value="" disabled selected>Pilih Section</option>
                                    <?php foreach ($section as $data) { ?>
                                    <option value="<?=$data['id_section']?>"><?=$data['title']?></option>
                                    <?php }?>

                                </select>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="name">Title</label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="name" name="title" type="text" placeholder="Quiz Title">
                            </div>



                            <div class="flex justify-end gap-2">
                                <button id="close-modal-btn"
                                    class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                <button type="submit" name="add_quiz"
                                    class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="flex mt-10 justify-between gap-5 flex-wrap">
                    <?php foreach ($quiz as $data) { ?>
                    <a href="quiz-question.php?id=<?=$data['id_quiz']?>" class="group block">
                        <div class="flex rounded-md gap-2 bg-white w-full lg:w-64 h-20 m-auto sm:m-0 overflow-hidden">
                            <div class="bg-blue-300 text-blue-300 w-3">.</div>
                            <div class="flex w-full justify-between">
                                <div class="font-poppins my-auto">
                                    <h1 class="my-auto font-semibold text-md"><?=$data['title']?></h1>
                                </div>
                                <!-- <div class="flex gap-2 my-auto p-2">
                                    <i
                                        class="fa-regular fa-pen-to-square bg-yellow-300 p-2 rounded-md group-hover:bg-yellow-400 cursor-pointer"></i>
                                    <form method="post">
                                        <input type="number" value="<?=$data['id_quiz']?>" name="id_quiz" hidden>
                                        <button type="submit" name="delete_quiz">
                                            <i
                                                class="fa-solid fa-trash-can bg-red-500 p-2 rounded-md group-hover:bg-red-600 cursor-pointer"></i>
                                        </button>
                                    </form>
                                </div> -->
                            </div>
                        </div>
                    </a>
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
        </script>
</body>

</html>