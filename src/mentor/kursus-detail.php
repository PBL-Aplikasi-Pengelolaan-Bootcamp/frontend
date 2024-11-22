<?php

include 'function.php';

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

// get data course
$course = get_course_by_id();

// edit data course
if (isset($_POST['edit_course'])) {
    edit_course($_POST);
}

// delete course
if (isset($_POST['delete_course'])) {
    delete_course();
}



// get data section
$section = get_section_byCourseId();

// add section
if (isset($_POST['add_section'])) {
    create_section($_POST);
}

// create information
if (isset($_POST['create_information'])) {
    create_information($_POST);
}


//---------------------------------video
// create video
if (isset($_POST['create_video'])) {
    create_video($_POST);
}
// edit video
if (isset($_POST['edit_video'])) {
    edit_video($_POST);
}
//delete video
if (isset($_POST['delete_video'])) {
    delete_video($_POST);
}


//---------------------------------text
// create text
if (isset($_POST['create_text'])) {
    create_text($_POST);
}







//------------------------------------file
// create file
if (isset($_POST['create_file'])) {
    create_file($_POST);
}
//edit file
if (isset($_POST['edit_file'])) {
    edit_file($_POST);
}
//delete file
if (isset($_POST['delete_file'])) {
    delete_file($_POST);
}





//-------------------------------------quiz
//create quiz
if (isset($_POST['add_quiz'])) {
    add_quiz($_POST);
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
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="../../fontawesome-free-6.6.0-web/fontawesome/css/all.min.css">
    <script src="https://cdn.tiny.cloud/1/pmgg58idwi9ldov0ee6wpppin1sya5nrtpqm7pcjir11vckj/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <title>Mentor | Tambah Materi</title>
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
            class="sidebar fixed inset-y-0 z-20 left-0 w-64 bg-white shadow-md transform -translate-x-full md:translate-x-0 h-full">
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
                        <h1 class="font-semibold relative my-auto"><?= $_SESSION['username'] ?></h1>
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
                                        value="<?= $mentor['username'] ?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="name">Nama</label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="name" name="name" type="text" placeholder="Enter your name"
                                        value="<?= $mentor['name'] ?>">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="bio">Bio</label>
                                    <textarea name="bio" id="bio"
                                        class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"><?= $mentor['bio'] ?></textarea>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="expertise">Expertise</label>
                                    <input type="text" name="expertise" placeholder="Masukkan keahlian anda"
                                        value="<?= $mentor['expertise'] ?>"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="telp">Telp</label>
                                    <input type="text" name="telp" id="telp" placeholder="Masukkan keahlian anda"
                                        value="<?= $mentor['telp'] ?>"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Masukkan keahlian anda"
                                        value="<?= $mentor['email'] ?>"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>



                                <div class="flex flex-col gap-2">
                                    <label for="profil_picture">Foto Profil</label>
                                    <input type="file" accept="image/*" name="profil_picture" id="profil_picture"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                    <!-- Hidden input untuk menyimpan base64 gambar yang sudah di-crop -->
                                    <input type="hidden" name="cropped_image" id="cropped_image">

                                    <div class="relative w-12 h-12">
                                        <img src="../foto_mentor/<?= $mentor['profil_picture'] ?>" alt=""
                                            id="preview-image" class="w-12 h-12 object-cover rounded-full">
                                    </div>
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

            <!-- LIST -->

            <div class="space-y-4 mt-10">

                <div class="container flex gap-2">
                    <h1 class="my-auto text-2xl font-bold font-poppins"><?= $course['title'] ?></h1>

                    <!-- Button untuk membuka modal -->
                    <button id="open-modal-btn-course" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fa-solid fa-pen-to-square text-2xl my-auto"></i>
                    </button>


                    <!-- Modal edit -->
                    <div id="modal-wrapper-course" class="fixed z-10 inset-0 hidden">
                        <div
                            class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                            <div
                                class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3 max-h-[80vh] overflow-y-auto">

                                <form method="post" enctype="multipart/form-data"
                                    class="flex flex-col gap-5 my-2 w-full">
                                    <div class="flex flex-col gap-2">
                                        <label for="title">Title</label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="title" name="title" type="text" placeholder="Course Mysql"
                                            value="<?= $course['title'] ?>">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="title">Description</label>
                                        <textarea
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            name="description" id=""><?= $course['description'] ?></textarea>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="flex flex-col gap-2 w-full">
                                            <label for="start-date">Start</label>
                                            <input
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="start-date" name="start_date" type="date"
                                                value="<?= $course['start_date'] ?>" placeholder="Course Mysql">
                                        </div>
                                        <div class="flex flex-col gap-2 w-full">
                                            <label for="end-date">End</label>
                                            <input
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="end-date" name="end_date" type="date"
                                                value="<?= $course['end_date'] ?>" placeholder="Course Mysql">
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="type">Type</label>
                                        <select id="type" name="course_type"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option value="" disabled hidden>Pilih tipe kursus</option>
                                            <option value="online"
                                                <?= $course['course_type'] === 'online' ? 'selected' : '' ?>>Online
                                            </option>
                                            <option value="offline"
                                                <?= $course['course_type'] === 'offline' ? 'selected' : '' ?>>Offline
                                            </option>
                                        </select>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="title">Quota</label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="title" name="quota" type="number" value='<?= $course['quota'] ?>'
                                            placeholder="Course Mysql">
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label for="img">Image Cover</label>
                                        <input type="file" src="" alt="" name="course_picture"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <button type="submit" name="delete_course"
                                            class="px-4 py-2 h-max my-auto text-red-500 bg-none font-semibold w-max text-center rounded-md hover:text-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            DELETE COURSE
                                        </button>
                                    </div>

                                    <div class="flex justify-end items-center gap-2">
                                        <button id="close-modal-btn-course" type="button"
                                            class="px-4 py-2 text-sm font-medium text-red-500 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Close
                                        </button>
                                        <button type="submit" name="edit_course"
                                            class="px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>




                <div class="bg-white shadow-md h-40 rounded-lg sm:h-60 overflow-hidden">
                    <img src="../foto_cover_course/<?= $course['course_picture'] ?>" alt="Cover Course"
                        class="w-full h-full object-cover object-center">
                </div>


                <div class="flex gap-2 text-sm flex-wrap font-bold font-poppins text-slate-800">
                    <h1 class="bg-white px-3 py-1 rounded-lg"><?= $course['course_type'] ?></h1>
                    <h1 class="bg-white px-3 py-1 rounded-lg"><?= $course['start_date'] ?> - <?= $course['end_date'] ?>
                    </h1>
                    <h1 class="bg-white px-3 py-1 rounded-lg"><?= $course['quota'] ?> Quota</h1>
                </div>

                <p class="text-lg"><?= $course['description'] ?></p>

                <div class="flex justify-end items-center">
                    <button id="open-modal-btn-section"
                        class="bg-blue-500 text-white p-3 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none"
                        data-modal-type="fund" role="menuitem">
                        Add Section
                    </button>

                    <!-- Modal Section -->
                    <div id="modal-wrapper-section" class="fixed z-10 inset-0 hidden" data-modal-type="information">
                        <div
                            class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75 transition-all inset-1">
                            <div
                                class="flex flex-col items-center justify-between bg-white p-3 md:p-10 gap-5 rounded-xl w-full md:w-2/3">
                                <form method="post" class="flex flex-col gap-5 my-2 w-full">
                                    <div class="flex flex-col gap-2">
                                        <label for="section">Section :</label>
                                        <input type="text" name="section" placeholder="Enter Section Title"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="button" id="close-modal-btn-section"
                                            class="w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                            Close
                                        </button>
                                        <button type="submit" name="add_section"
                                            class="px-4 py-2 h-max my-auto text-white bg-blue-700 font-semibold w-max text-center rounded-md">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


                <?php foreach ($section as $section) { ?>
                <div x-data="{ 
                        open: true,
                        dropdownOpen: false,
                        activeModal: null,
                        
                        toggleDropdown() {
                            this.dropdownOpen = !this.dropdownOpen;
                        },
                        
                        openModal(type) {
                            this.activeModal = type;
                            this.dropdownOpen = false;
                        },
                        
                        closeModal() {
                            this.activeModal = null;
                        }
                    }" class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                    <!-- Collapsible Header -->
                    <button @click="open = !open"
                        class="w-full flex items-center px-4 py-4 bg-blue-700 text-white font-bold focus:outline-none">
                        <ion-icon :name="open ? 'ios-arrow-up' : 'ios-arrow-down'" class="text-xl mr-2"></ion-icon>
                        <span><?= $section['title'] ?></span>
                    </button>

                    <!-- Section Content -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0" class="px-4 py-2 border-t">

                        <!-- Add Content Button -->
                        <div class="flex justify-end relative">
                            <button @click="toggleDropdown"
                                class="bg-blue-500 text-white rounded-full w-10 h-10 flex items-center justify-center focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                                x-transition:enter="transition ease-out duration-100"
                                class=" right-0 ml-2 top-full w-48 h-full bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5  overflow-visible">
                                <div class="py-1">
                                    <a href="#" @click.prevent="openModal('information')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Information</a>
                                    <a href="#" @click.prevent="openModal('video')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Video
                                        material</a>
                                    <a href="#" @click.prevent="openModal('text')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Text
                                        material</a>
                                    <a href="#" @click.prevent="openModal('file')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">File</a>
                                    <a href="#" @click.prevent="openModal('quiz')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Quiz</a>
                                </div>
                            </div>

                            <!-- Modal Templates -->
                            <!-- Information Modal -->
                            <template x-if="activeModal === 'information'">
                                <div class="fixed inset-0 z-50 overflow-y-auto" @click.self="closeModal"
                                    x-transition:enter="transition ease-out duration-300">
                                    <div class="flex items-center justify-center min-h-screen px-4">
                                        <div class="bg-white rounded-xl w-full md:w-2/3 p-6">
                                            <form method="post" class="space-y-4">
                                                <input type="text" value="<?= $section['title'] ?>" readonly
                                                    class="w-full p-2 bg-gray-200 rounded border">
                                                <input type="number" name="id_section"
                                                    value="<?= $section['id_section'] ?>" hidden>
                                                <div class="space-y-2">
                                                    <label for="information">Information:</label>
                                                    <input type="text" name="information"
                                                        placeholder="Enter information"
                                                        class="w-full p-2 border rounded focus:outline-none focus:ring-2">
                                                </div>
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" @click="closeModal"
                                                        class="px-4 py-2 text-red-500 border rounded hover:bg-gray-50">Close</button>
                                                    <button type="submit" name="create_information"
                                                        class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <!-- Video Modal -->
                            <template x-if="activeModal === 'video'">
                                <div class="fixed inset-0 z-50 overflow-y-auto" @click.self="closeModal"
                                    x-transition:enter="transition ease-out duration-300">
                                    <div class="flex items-center justify-center min-h-screen px-4">
                                        <div class="bg-white rounded-xl w-full md:w-2/3 p-6">
                                            <form method="post" class="space-y-4">
                                                <input type="text" value="<?= $section['title'] ?>" readonly
                                                    class="w-full p-2 bg-gray-200 rounded border">
                                                <input type="number" name="id_section"
                                                    value="<?= $section['id_section'] ?>" hidden>
                                                <div class="space-y-2">
                                                    <label for="video">Video URL:</label>
                                                    <input type="text" name="url" placeholder="Enter video URL"
                                                        class="w-full p-2 border rounded focus:outline-none focus:ring-2">
                                                </div>
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" @click="closeModal"
                                                        class="px-4 py-2 text-red-500 border rounded hover:bg-gray-50">Close</button>
                                                    <button type="submit" name="create_video"
                                                        class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <!-- Text Modal -->
                            <template x-if="activeModal === 'text'">
                                <div class="fixed inset-0 z-50 overflow-y-auto" @click.self="closeModal"
                                    x-transition:enter="transition ease-out duration-300">
                                    <div class="flex items-center justify-center min-h-screen px-4">
                                        <div class="bg-white rounded-xl w-full md:w-2/3 p-6">
                                            <form method="post" class="space-y-4">
                                                <input type="text" value="<?= $section['title'] ?>" readonly
                                                    class="w-full p-2 bg-gray-200 rounded border">
                                                <input type="number" name="id_section"
                                                    value="<?= $section['id_section'] ?>" hidden>
                                                <div class="space-y-2">
                                                    <label for="text">Content:</label>
                                                    <textarea name="text" placeholder="Enter text"
                                                        class="w-full p-2 border rounded focus:outline-none focus:ring-2 h-32"></textarea>
                                                </div>
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" @click="closeModal"
                                                        class="px-4 py-2 text-red-500 border rounded hover:bg-gray-50">Close</button>
                                                    <button type="submit" name="create_text"
                                                        class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <!-- File Modal -->
                            <template x-if="activeModal === 'file'">
                                <div class="fixed inset-0 z-50 overflow-y-auto" @click.self="closeModal"
                                    x-transition:enter="transition ease-out duration-300">
                                    <div class="flex items-center justify-center min-h-screen px-4">
                                        <div class="bg-white rounded-xl w-full md:w-2/3 p-6">
                                            <form method="post" enctype="multipart/form-data" class="space-y-4">
                                                <input type="text" value="<?= $section['title'] ?>" readonly
                                                    class="w-full p-2 bg-gray-200 rounded border">
                                                <input type="number" name="id_section"
                                                    value="<?= $section['id_section'] ?>" hidden>
                                                <div class="space-y-2">
                                                    <label for="file">File:</label>
                                                    <input type="file" name="file"
                                                        class="w-full p-2 border rounded focus:outline-none focus:ring-2">
                                                </div>
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" @click="closeModal"
                                                        class="px-4 py-2 text-red-500 border rounded hover:bg-gray-50">Close</button>
                                                    <button type="submit" name="create_file"
                                                        class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <!-- Quiz Modal -->
                            <template x-if="activeModal === 'quiz'">
                                <div class="fixed inset-0 z-50 overflow-y-auto" @click.self="closeModal"
                                    x-transition:enter="transition ease-out duration-300">
                                    <div class="flex items-center justify-center min-h-screen px-4">
                                        <div class="bg-white rounded-xl w-full md:w-2/3 p-6">
                                            <form method="post" class="space-y-4">
                                                <input type="text" value="<?= $section['title'] ?>" readonly
                                                    class="w-full p-2 bg-gray-200 rounded border">
                                                <input type="number" name="section"
                                                    value="<?= $section['id_section'] ?>" hidden>
                                                <div class="space-y-2">
                                                    <label for="quiz">Quiz Title: </label>
                                                    <input type="text" name="title" placeholder="Enter quiz"
                                                        class="w-full p-2 border rounded focus:outline-none focus:ring-2">
                                                </div>
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" @click="closeModal"
                                                        class="px-4 py-2 text-red-500 border rounded hover:bg-gray-50">Close</button>
                                                    <button type="submit" name="add_quiz"
                                                        class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </template>

                        </div>

                        <!-- Content Display Section -->
                        <div class="mt-4 space-y-6">
                            <!-- Information Display -->
                            <?php $information = get_information_bySection($_GET['id'], $section['id_section']); ?>
                            <?php if (!empty($information)) { ?>
                            <div class="space-y-2">
                                <h2 class="text-2xl font-semibold">Information</h2>
                                <?php foreach ($information as $info) { ?>
                                <p class="text-gray-700">• <?= htmlspecialchars($info['information']) ?></p>
                                <?php } ?>
                            </div>
                            <hr>
                            <?php } ?>

                            <!-- Video Display -->
                            <?php $video = get_video_bySection($_GET['id'], $section['id_section']); ?>
                            <?php if (!empty($video)) { ?>
                            <?php foreach ($video as $vid) { ?>
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe src="<?= $vid['url'] ?>" class="w-full h-64 md:h-96 rounded-lg" allowfullscreen
                                    frameborder="0"></iframe>
                            </div>

                            <!-- Tombol untuk membuka modal -->
                            <button data-modal-target="modal-edit-video-<?= $vid['id_materi_video'] ?>"
                                class="open-modal-btn-edit-video block px-2 py-1 text-xs text-gray-700 hover:bg-gray-100 flex items-center">
                                <i class="fa-solid fa-pen-to-square text-lg"></i>
                            </button>

                            <!-- Modal -->
                            <div id="modal-edit-video-<?= $vid['id_materi_video'] ?>"
                                class="modal-wrapper fixed z-10 inset-0 hidden">
                                <div class="fixed inset-0 z-50 overflow-y-auto" @click.self="closeModal"
                                    x-transition:enter="transition ease-out duration-300">
                                    <div class="flex items-center justify-center min-h-screen px-4">
                                        <div class="bg-white rounded-xl w-full md:w-2/3 p-6">
                                            <form method="post" class="space-y-4">
                                                <input type="text" value="<?= $section['title'] ?>" readonly
                                                    class="w-full p-2 bg-gray-200 rounded border">
                                                <input type="number" name="id_materi_video"
                                                    value="<?= $vid['id_materi_video'] ?>" hidden>
                                                <div class="space-y-2">
                                                    <label for="video">Video URL:</label>
                                                    <input type="text" name="url" placeholder="Enter video URL"
                                                        value="<?= $vid['url'] ?>"
                                                        class="w-full p-2 border rounded focus:outline-none focus:ring-2">
                                                </div>
                                                <div class="flex flex-col gap-2">
                                                    <button type="submit" name="delete_video"
                                                        class="px-4 py-2 h-max my-auto text-red-500 bg-none font-semibold w-max text-center rounded-md hover:text-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                        DELETE VIDEO
                                                    </button>
                                                </div>
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button"
                                                        class="close-modal-btn-edit-video px-4 py-2 text-red-500 border rounded hover:bg-gray-50">
                                                        Close
                                                    </button>
                                                    <button type="submit" name="edit_video"
                                                        class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <hr>
                            <?php } ?>

                            <!-- Text Display -->
                            <?php $text = get_text_bySection($_GET['id'], $section['id_section']); ?>
                            <?php if (!empty($text)) { ?>
                            <?php foreach ($text as $txt) { ?>
                            <div class="prose max-w-none">
                                <p><?= $txt['content'] ?></p>
                            </div>
                            <?php } ?>
                            <hr>
                            <?php } ?>

                            <!-- File Display -->
                            <?php $file = get_file_bySection($_GET['id'], $section['id_section']); ?>
                            <?php if (!empty($file)) { ?>
                            <?php foreach ($file as $f) { ?>
                            <div
                                class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <!-- Informasi File -->
                                <div class="flex items-center space-x-4">
                                    <a href="../file_materi/<?= $f['file'] ?>" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 font-medium">
                                        <?= $f['file'] ?>
                                    </a>
                                    <span class="text-sm text-gray-500">
                                        <?= round(filesize('../file_materi/' . $f['file']) / 1024, 2) ?> KB
                                    </span>
                                </div>

                                <!-- Tombol Edit File-->
                                <div class="flex items-center space-x-2">
                                    <button data-modal-target="modal-edit-file-<?= $f['id_materi_file'] ?>"
                                        class="open-modal-btn-edit-file px-2 py-1 text-xs text-gray-700 hover:bg-gray-100 flex items-center">
                                        <i class="fa-solid fa-pen-to-square text-lg"></i>
                                    </button>

                                    <div id="modal-edit-file-<?= $f['id_materi_file'] ?>"
                                        class="modal-wrapper fixed z-10 inset-0 hidden">
                                        <div class="fixed inset-0 z-50 overflow-y-auto" @click.self="closeModal"
                                            x-transition:enter="transition ease-out duration-300">
                                            <div class="flex items-center justify-center min-h-screen px-4">
                                                <div class="bg-white rounded-xl w-full md:w-2/3 p-6">
                                                    <form method="post" enctype="multipart/form-data" class="space-y-4">
                                                        <input type="text" value="<?= $section['title'] ?>" readonly
                                                            class="w-full p-2 bg-gray-200 rounded border">
                                                        <input type="number" name="id_materi_file"
                                                            value="<?= $f['id_materi_file'] ?>" hidden>

                                                        <!-- Menampilkan nama file yang ada -->
                                                        <div class="space-y-2">
                                                            <label for="file">Current File: </label>
                                                            <span class="text-sm text-gray-500"><?= $f['file'] ?></span>
                                                        </div>

                                                        <!-- Input file untuk meng-upload file baru -->
                                                        <div class="space-y-2">
                                                            <label for="file">Upload New File:</label>
                                                            <input type="file" name="file"
                                                                class="w-full p-2 border rounded focus:outline-none focus:ring-2">
                                                        </div>

                                                        <!-- Tombol untuk menghapus file -->
                                                        <div class="flex flex-col gap-2">
                                                            <button type="submit" name="delete_file"
                                                                class="px-4 py-2 h-max my-auto text-red-500 bg-none font-semibold w-max text-center rounded-md hover:text-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                                DELETE FILE
                                                            </button>
                                                        </div>

                                                        <!-- Tombol untuk menyimpan perubahan -->
                                                        <div class="flex justify-end space-x-2">
                                                            <button type="button"
                                                                class="close-modal-btn-edit-file px-4 py-2 text-red-500 border rounded hover:bg-gray-50">
                                                                Close
                                                            </button>
                                                            <button type="submit" name="edit_file"
                                                                class="px-4 py-2 text-white bg-blue-700 rounded hover:bg-blue-800">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <hr>
                            <?php } ?>



                            <?php $quiz = get_quiz_bySection($section['id_section']);?>
                            <?php if (!empty($quiz)) { ?>
                            <?php foreach ($quiz as $quizz) { ?>
                            <?php $total_question = total_question_byQuiz($quizz['id_quiz']); ?>
                            <a href="quiz-question.php?id=<?=$quizz['id_quiz']?>" class="block">
                                <div class="flex items-center w-80 bg-gray-100 p-4 rounded-lg">
                                    <!-- Icon Quiz -->
                                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                                        <!-- Icon Quiz (Contoh: Icon question mark atau similar) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                        </svg>
                                    </div>

                                    <!-- Konten Kanan (Judul dan Keterangan) -->
                                    <div class="ml-4">
                                        <h3 class="text-blue-600 font-medium"><?=$quizz['title']?></h3>
                                        <div class="text-gray-500 text-sm space-y-1">
                                            <p>Soal: <?=$total_question?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?php } ?>
                            <hr>
                            <?php } ?>






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

    // Modal PopUp Edit Profil
    document.getElementById("open-modal-btn").addEventListener("click", (event) => {
        event.preventDefault();
        document.getElementById("modal-wrapper").classList.remove("hidden");
    });

    document.getElementById("close-modal-btn").addEventListener("click", () => {
        document.getElementById("modal-wrapper").classList.add("hidden");
    });


    // Modal Edit Course
    document.getElementById("open-modal-btn-course").addEventListener("click", (event) => {
        event.preventDefault();
        document.getElementById("modal-wrapper-course").classList.remove("hidden");
    });

    document.getElementById("close-modal-btn-course").addEventListener("click", () => {
        document.getElementById("modal-wrapper-course").classList.add("hidden");
    });


    // Modal Edit Video Material
    // Menangani tombol buka modal
    document.querySelectorAll('.open-modal-btn').forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const modalId = button.getAttribute(
                'data-modal-target'); // Ambil target modal dari data attribute
            document.getElementById(modalId).classList.remove('hidden'); // Tampilkan modal
        });
    });

    // Menangani tombol tutup modal
    document.querySelectorAll('.close-modal-btn').forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal-wrapper'); // Cari modal terdekat
            modal.classList.add('hidden'); // Sembunyikan modal
        });
    });






    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
    </script>



    <!-- Setup Section -->
    <script>
    const openModalBtn = document.getElementById('open-modal-btn-section');
    const closeModalBtn = document.getElementById('close-modal-btn-section');
    const modalWrapper = document.getElementById('modal-wrapper-section');

    // Fungsi untuk membuka modal
    openModalBtn.addEventListener('click', () => {
        modalWrapper.classList.remove('hidden');
    });

    // Fungsi untuk menutup modal
    closeModalBtn.addEventListener('click', () => {
        modalWrapper.classList.add('hidden');
    });

    // Menutup modal jika klik di luar konten modal
    window.addEventListener('click', (e) => {
        if (e.target === modalWrapper) {
            modalWrapper.classList.add('hidden');
        }
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Setup dropdowns
        document.querySelectorAll('.dropdown-container').forEach(container => {
            const button = container.querySelector('.dropdown-button');
            const menu = container.querySelector('.dropdown-menu');

            button.addEventListener('click', (event) => {
                event.stopPropagation();
                menu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (event) => {
                if (!container.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });

            // Close dropdown when a menu item is clicked
            menu.querySelectorAll('a').forEach(item => {
                item.addEventListener('click', () => {
                    menu.classList.add('hidden');
                });
            });
        });



        //edit video    
        document.querySelectorAll('.open-modal-btn-edit-video').forEach(btn => {
            btn.addEventListener('click', (event) => {
                event.preventDefault();
                const modalId = btn.getAttribute(
                    'data-modal-target'); // Ambil ID modal dari data attribute
                const modalWrapper = document.getElementById(
                    modalId); // Cari modal berdasarkan ID
                if (modalWrapper) {
                    modalWrapper.classList.remove('hidden'); // Tampilkan modal
                }
            });
        });
        document.querySelectorAll('.close-modal-btn-edit-video').forEach(btn => {
            btn.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent action default (opsional)
                const modalWrapper = btn.closest('.modal-wrapper'); // Cari modal terdekat
                if (modalWrapper) {
                    modalWrapper.classList.add('hidden'); // Sembunyikan modal
                }
            });
        });


        //edit file    
        document.querySelectorAll('.open-modal-btn-edit-file').forEach(btn => {
            btn.addEventListener('click', (event) => {
                event.preventDefault();
                const modalId = btn.getAttribute(
                    'data-modal-target'); // Ambil ID modal dari data attribute
                const modalWrapper = document.getElementById(
                    modalId); // Cari modal berdasarkan ID
                if (modalWrapper) {
                    modalWrapper.classList.remove('hidden'); // Tampilkan modal
                }
            });
        });
        document.querySelectorAll('.close-modal-btn-edit-file').forEach(btn => {
            btn.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent action default (opsional)
                const modalWrapper = btn.closest('.modal-wrapper'); // Cari modal terdekat
                if (modalWrapper) {
                    modalWrapper.classList.add('hidden'); // Sembunyikan modal
                }
            });
        });


    });
    </script>




</body>

</html>