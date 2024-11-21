<?php

include 'function.php';
//get data session login
$login = get_data_user_login();

//logout
if (isset($_POST['logout'])) {
    logout();
}

//edit profil
if (isset($_POST['edit_profil'])) {
    edit_profil($_POST, $_SESSION['id_user']);
}

//edit mentor
if (isset($_POST['edit_mentor'])) {
    edit_mentor($_POST);
}

//get data student
$student = get_student_byId(); 
$course_mentor = get_mentor_course();

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
    <link rel="stylesheet" href="../../fontawesome-free-6.6.0-web/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <title>Admin | Dashboard</title>
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
                    <li class="hover:bg-gray-200"><a href="dashboard-admin.php" class="block p-4 text-gray-700">
                            <ion-icon name="home" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Dashoboard
                        </a>
                    </li>
                    <li class="hover:bg-gray-200"><a href="kursus.php" class="block p-4 text-gray-700">
                            <ion-icon name="list-box" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Kursus
                        </a>
                    </li>
                    <li class="hover:bg-gray-200"><a href="mentor.php" class="block p-4 text-gray-700">
                            <ion-icon name="school" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Mentor
                        </a>
                    </li>
                    <li class="hover:bg-gray-200"><a href="student.php" class="block p-4 text-gray-700">
                            <ion-icon name="person" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                            Student
                        </a>
                    </li>

                    <form method="post">
                        <li class="hover:bg-gray-200">
                            <button type="submit" name="logout" class="block p-4 text-gray-700">
                                <ion-icon name="log-out" class="pr-2 relative top-1 text-xl text-slate-500"></ion-icon>
                                Log
                                Out
                            </button>
                        </li>
                    </form>



                </ul>
            </nav>
        </aside>

        <!-- Konten Utama -->
        <div class="flex-1 p-6 ml-0 md:ml-64">
            <!-- Tombol Hamburger -->
            <button id="hamburger" class="block justify-between md:hidden p-4 text-gray-700">
                <div class=""></div>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>

            <header class="flex justify-end items-center">

                <button id="open-modal-btn">
                    <div class="flex gap-2 w-max">
                        <h1 class="font-semibold relative my-auto"><?=$login['username']?></h1>
                        <img src="../img/logo.png" alt="" class="w-12 h-12 rounded-full">
                    </div>
                </button>

                <!-- MODAL WRAPPER -->
                <div id="modal-wrapper" class="fixed z-10 inset-0 hidden">
                    <div
                        class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                        <!-- MODAL BOX -->
                        <div
                            class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3">
                            <form method="post" class="flex flex-col gap-5 my-2 w-full">
                                <div class="flex flex-col gap-2">
                                    <label for="nama-mentor">Username</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="nama-mentor" type="text" placeholder="Enter your name" name="username"
                                        value="<?=$login['username']?>">
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

                                <div class="flex justify-between">
                                    <button id="close-modal-btn"
                                        class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Close</button>
                                    <button type="submit" name="edit_profil"
                                        class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                </div>
                            </form>

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

                                const changePasswordBtnMentor = document.getElementById(
                                    "change-password-btn-mentor");
                                const passwordChangeFieldsMentor = document.getElementById(
                                    "password-change-fields-mentor");

                                changePasswordBtnMentor.addEventListener("click", function() {
                                    // Toggle visibility
                                    if (passwordChangeFieldsMentor.classList.contains("hidden")) {
                                        passwordChangeFieldsMentor.classList.remove("hidden");
                                        changePasswordBtnMentor.innerText = "Batal Ganti Password";
                                    } else {
                                        passwordChangeFieldsMentor.classList.add("hidden");
                                        changePasswordBtnMentor.innerText = "Ganti Password";
                                    }
                                });
                            });
                            </script>


                        </div>
                    </div>
                </div>
            </header>

            <!-- Konten -->
            <!-- ANALISTIK -->



            <!-- LIST -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-5 mt-10 w-full">
                <div class="w-64 md:w-80 aspect-square overflow-hidden rounded-lg">
                    <img src="../foto_mentor/<?=$student['profil_picture']?>" class="w-full h-full object-cover">
                </div>

                <div class="flex flex-col w-full text-center md:text-left space-y-3">
                    <div class="container flex gap-2">
                        <h1 class="my-auto text-2xl font-bold font-poppins"><?=$student['name']?></h1>

                        <!-- Button untuk membuka modal -->
                        <button id="open-modal-btn-edit"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fa-solid fa-pen-to-square text-2xl my-auto"></i>
                        </button>


                        <!-- Modal edit -->
                        <div id="modal-wrapper-edit" class="fixed z-10 inset-0 hidden">
                            <div
                                class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                                <div
                                    class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3 max-h-[80vh] overflow-y-auto">
                                    <form method="post" method="post" enctype="multipart/form-data"
                                        class="flex flex-col gap-5 my-2 w-full">
                                        <h1 class="my-auto text-2xl font-bold font-poppins">Profil</h1>

                                        <div class="flex flex-col gap-2">
                                            <label for="profil_picture">Foto Profil</label>
                                            <input type="file" accept="image/*" name="profil_picture"
                                                id="profil_picture" value="<?=$student['profil_picture']?>"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <!-- Hidden input untuk menyimpan base64 gambar yang sudah di-crop -->
                                            <input type="hidden" name="cropped_image" id="cropped_image">
                                            <div class="relative w-12 h-12">
                                                <img src="../foto_mentor/<?=$student['profil_picture']?>" alt=""
                                                    id="preview-image" class="w-12 h-12 object-cover rounded-full">
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <div class="flex flex-col gap-2 w-full">
                                                <label for="start-date">Name</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="start-date" name="name" type="text"
                                                    value="<?=$student['name']?>">
                                            </div>
                                            <div class="flex flex-col gap-2 w-full">
                                                <label for="end-date">Expertise</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="" name="expertise" type="text"
                                                    value="<?=$student['expertise']?>">
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label for="title">Bio</label>
                                            <textarea
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                name="bio" id=""><?=$student['bio']?></textarea>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="flex flex-col gap-2 w-full">
                                                <label for="start-date">Phone</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="start-date" name="phone" type="text"
                                                    value="<?=$student['telp']?>">
                                            </div>
                                            <div class="flex flex-col gap-2 w-full">
                                                <label for="end-date">Email</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="end-date" name="email" type="email"
                                                    value="<?=$student['email']?>">
                                            </div>
                                        </div>

                                        <h1 class="my-auto text-2xl font-bold font-poppins mt-12">Akun</h1>
                                        <div class="flex flex-col gap-2">
                                            <label for="nama-mentor">Username</label>
                                            <input
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="nama-mentor" type="text" placeholder="Enter your name"
                                                name="username" value="<?=$student['username']?>">
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <div class="flex justify-between items-center">
                                                <button type="button" id="change-password-btn-mentor"
                                                    class="ml-2 text-blue-500 hover:underline">Ganti Password</button>
                                            </div>
                                        </div>

                                        <!-- Div untuk input password lama dan baru, default disembunyikan -->
                                        <div id="password-change-fields-mentor" class="hidden flex flex-col gap-2">
                                            <label for="old-password">Password Lama</label>
                                            <input type="password" id="old-password" name="old_password"
                                                placeholder="Masukkan password lama"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                            <label for="new-password">Password Baru</label>
                                            <input type="password" id="new-password" name="new_password"
                                                placeholder="Masukkan password baru"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        </div>

                                        <div class="flex flex-col gap-2">
                                            <button type="submit" name="delete_course"
                                                class="px-4 py-2 h-max my-auto text-red-500 bg-white border border-red-500 font-semibold w-max text-center rounded-md hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-300">
                                                DELETE MENTOR
                                            </button>
                                        </div>

                                        <div class="flex justify-end items-center gap-2">
                                            <button id="close-modal-btn-edit" type="button"
                                                class="px-4 py-2 text-sm font-medium text-red-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Close
                                            </button>
                                            <button type="submit" name="edit_mentor"
                                                class="px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Simpan
                                            </button>
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
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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


                    </div>

                    <p class="text-sm md:text-base font-semibold text-gray-400 font-poppins">Birth : <?=$student['birth']?>
                    </p>
                    
                    <div class="flex flex-col sm:flex-row md:flex-col sm:gap-5 gap-2">
                        <div class="flex gap-2 items-center">
                            <ion-icon name="call" class="text-lg"></ion-icon>
                            <p class="font-semibold text-sm"><?=$student['telp']?></p>
                        </div>
                        <div class="flex gap-2 items-center">
                            <ion-icon name="mail" class="text-lg"></ion-icon>
                            <p class="font-semibold text-sm"><?=$student['email']?></p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex flex-col md:flex-row items-center md:items-start gap-5 mt-10 w-full">
                <h1 class="font-semibold text-xl md:text-2xl font-poppins">Course</h1>

            </div>

            <div class="flex flex-wrap gap-5 mt-5 w-full justify-start">
            <?php foreach ($course_mentor as $course) { ?>

                <div
                    class="flex flex-col w-36 h-max shadow-xl rounded-lg md:w-80 overflow-hidden transition-all hover:scale-105">
                    <img src="../foto_cover_course/<?=$course['course_picture']?>" alt=""
                        class="object-cover w-full md:h-40">
                    <div class="px-3 py-3 flex flex-col gap-2">
                        <h1 class="font-poppins font-semibold text-sm md:text-base lg:text-left"><?=$course['title']?>
                        </h1>
                    </div>
                </div>
                <?php } ?>

            </div>







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


    //edit mentor
    // Modal Edit Course
    document.getElementById("open-modal-btn-edit").addEventListener("click", (event) => {
        event.preventDefault();
        document.getElementById("modal-wrapper-edit").classList.remove("hidden");
    });

    document.getElementById("close-modal-btn-edit").addEventListener("click", () => {
        document.getElementById("modal-wrapper-edit").classList.add("hidden");
    });
    </script>
</body>

</html>