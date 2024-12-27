<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <title>Document</title>

</head>

<body>
    <?php
session_start();
// session_start();
include dirname(__DIR__).'/koneksi.php';



function iziToastAlert($type, $message, $redirect = null) {
    echo "<script>
            iziToast.$type({
                title: '',
                message: '$message',
                position: 'topRight',
                timeout: 1500,
                onClosing: function() {";
    if ($redirect) {
        echo "window.location.href = '$redirect';";
    }
    echo "}
            });
          </script>";
}
function iziToastAlertReload($type, $message) {
    echo "<script>
        if (!sessionStorage.getItem('hasReloaded')) {
            iziToast.$type({
                title: '',
                message: '" . addslashes($message) . "',
                position: 'topRight',
                timeout: 1500,
                onClosing: function() {
                    sessionStorage.setItem('hasReloaded', 'true');
                    window.location.reload();
                }
            });
        } else {
            sessionStorage.removeItem('hasReloaded'); // Reset flag setelah reload
        }
    </script>";
}




//logout
function logout(){
    session_unset();
    session_destroy();
    echo "<script>window.location.href='../login.php'</script>";
    // echo "<script>alert('Logout'); window.location.href='../login.php'</script>";
    // iziToastAlert('success', 'Logout !', '../login.php');

}

//edit profil
function edit_profil($data, $id_user) {
    global $koneksi;

    // Ambil data dari form
    $username = strtolower(stripslashes($data['username']));
    $email = strtolower(stripslashes($data['email']));
    $name = mysqli_real_escape_string($koneksi, $data['name']);
    $bio = mysqli_real_escape_string($koneksi, $data['bio']);
    $expertise = mysqli_real_escape_string($koneksi, $data['expertise']);
    $telp = mysqli_real_escape_string($koneksi, $data['telp']);
    $old_password = mysqli_real_escape_string($koneksi, $data['old_password'] ?? '');
    $new_password = mysqli_real_escape_string($koneksi, $data['new_password'] ?? '');
    $isPasswordChanged = !empty($old_password) && !empty($new_password);

    // Penanganan upload foto profil
    $img = $_FILES['profil_picture']['name'];
    $tmp = $_FILES['profil_picture']['tmp_name'];
    $imgFolder = "../foto_mentor/";
    $imgPath = $imgFolder . $img;

    if ($isPasswordChanged) {
        // Ambil password lama dari database
        $result = mysqli_query($koneksi, "SELECT password FROM user WHERE id_user = '$id_user'");
        $user = mysqli_fetch_assoc($result);

        // Validasi password lama
        if (!$user || !password_verify($old_password, $user['password'])) {
            iziToastAlert('error', 'Password lama tidak sesuai!');

            return false;
        }

        // Enkripsi password baru
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    }

    // Update tabel mentor
    if ($img) {
        if (move_uploaded_file($tmp, $imgPath)) {
            $updateMentor = mysqli_query($koneksi,
                "UPDATE mentor 
                 SET name = '$name', bio = '$bio', expertise = '$expertise', telp = '$telp', profil_picture = '$img' 
                 WHERE id_mentor = '$id_user'");
        } else {
            iziToastAlert('error', 'Gagal upload foto!');

            return false;
        }
    } else {
        $updateMentor = mysqli_query($koneksi,
            "UPDATE mentor 
             SET name = '$name', bio = '$bio', expertise = '$expertise', telp = '$telp'
             WHERE id_mentor = '$id_user'");
    }

    // Update tabel user
    $query = "UPDATE user SET username = '$username', email = '$email'";
    if ($isPasswordChanged) {
        $query .= ", password = '$new_password_hashed'";
    }
    $query .= " WHERE id_user = '$id_user'";

    $updateUser = mysqli_query($koneksi, $query);

    // Cek apakah update berhasil
    if ($updateUser && $updateMentor) {
        $_SESSION['username'] = $username;
        // echo "<script>alert('Account updated successfully!'); window.location.href = window.location.href;</script>";
        iziToastAlertReload('success', 'Account updated successfully!');

    } else {
        echo "<script>alert('Failed to update account.');</script>";
    }
}


//get mentor course
function getall_course(){
    global $koneksi;
    $id_mentor =  $_SESSION['id_user'];
    $sql = mysqli_query($koneksi, "SELECT * FROM course WHERE id_mentor = $id_mentor");
    $courses = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $courses[] = $row;
    }
    return $courses;
}


//get mentor by id
function get_mentor_byId(){
    global $koneksi;
    $id_mentor = $_SESSION["id_user"];
    $sql = mysqli_query($koneksi, "SELECT * FROM mentor WHERE id_mentor = $id_mentor");
    return  mysqli_fetch_assoc( $sql);
    
}

function get_data_user_login() {
    global $koneksi;

    // Cek apakah session 'id_user' ada
    if (!isset($_SESSION['id_user'])) {
        return null; // Kembalikan null jika session tidak ada
    }

    // Ambil id_user dari session
    $id_user = $_SESSION['id_user'];

    // Query untuk mendapatkan data dari user dan mentor
    $sql = mysqli_query($koneksi, 
        "SELECT user.*, mentor.* 
         FROM user 
         JOIN mentor ON user.id_user = mentor.id_mentor 
         WHERE user.id_user = '$id_user'"
    );

    // Periksa jika ada hasil yang ditemukan
    if (mysqli_num_rows($sql) > 0) {
        return mysqli_fetch_assoc($sql); // Ambil data sebagai array asosiatif
    } else {
        return null; // Kembalikan null jika tidak ada data
    }
}


// create course
function create_course($data){
    global $koneksi;

    $id_mentor = $_SESSION['id_user'];
    $title = $data['title'];

    $slug = strtolower($title);
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
    $slug = trim($slug, '-');

    $description = $data['description'];
    $start_date = $data['start_date'];
    $end_date = $data['end_date'];
    $course_type = $data['course_type'];
    $quota = $data['quota'];
    
    $course_picture = $_FILES['course_picture']['name'];
    $tmpname = $_FILES['course_picture']['tmp_name'];
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/pbl/frontend/src/foto_cover_course/' . $course_picture;


    if  (move_uploaded_file($tmpname, $folder)) {
        $sql = mysqli_query($koneksi, "INSERT INTO course (id_course, id_mentor, title, slug, description, start_date, end_date, course_type, quota, course_picture) VALUES ('', '$id_mentor', '$title', '$slug', '$description', '$start_date', '$end_date', '$course_type', '$quota', '$course_picture')");
        if ($sql) {
            // echo "<script>alert('Kursus Berhasil Dibuat!'); window.location.href='kursus.php';</script>";
            iziToastAlert('success', 'Kursus Berhasil Dibuat!', 'kursus.php');

        } else {
            iziToastAlert('error', 'Kursus Gagal Dibuat!');

        }

    } else {
        // Jika gagal mengupload file
        // echo "<script>alert('Gagal mengupload file');</script>";
        iziToastAlert('error', 'Gagal mengupload file!');

    }
}



function edit_course($data) {
    global $koneksi;

    $id_course = $_GET['id'];
    $title = $data['title'];

    // Generate slug from title
    $slug = strtolower($title);
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
    $slug = trim($slug, '-');

    $description = $data['description'];
    $start_date = $data['start_date'];
    $end_date = $data['end_date'];
    $course_type = $data['course_type'];
    $quota = $data['quota'];

    // Check if there's a new image upload
    if (!empty($_FILES['course_picture']['name'])) {
        $course_picture = $_FILES['course_picture']['name'];
        $tmpname = $_FILES['course_picture']['tmp_name'];
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/pbl/frontend/src/foto_cover_course/' . $course_picture;

        // Get old picture name
        $query = mysqli_query($koneksi, "SELECT course_picture FROM course WHERE id_course = '$id_course'");
        $old_data = mysqli_fetch_assoc($query);
        $old_picture = $old_data['course_picture'];

        // Delete old picture if exists
        if (!empty($old_picture)) {
            $old_picture_path = $_SERVER['DOCUMENT_ROOT'] . '/pbl/frontend/src/foto_cover_course/' . $old_picture;
            if (file_exists($old_picture_path)) {
                unlink($old_picture_path);
            }
        }

        // Upload new picture
        if (move_uploaded_file($tmpname, $folder)) {
            // Update with new picture
            $sql = mysqli_query($koneksi, "UPDATE course SET 
                title = '$title',
                slug = '$slug',
                description = '$description',
                start_date = '$start_date',
                end_date = '$end_date',
                course_type = '$course_type',
                quota = '$quota',
                course_picture = '$course_picture'
                WHERE id_course = '$id_course'");
        } else {
            // echo "<script>alert('Gagal mengupload file baru');</script>";
            iziToastAlert('error', 'Gagal mengupload file baru!');

            return false;
        }
    } else {
        // Update without changing picture
        $sql = mysqli_query($koneksi, "UPDATE course SET 
            title = '$title',
            slug = '$slug',
            description = '$description',
            start_date = '$start_date',
            end_date = '$end_date',
            course_type = '$course_type',
            quota = '$quota'
            WHERE id_course = '$id_course'");
    }

    if ($sql) {
        // echo "<script>alert('Kursus Berhasil Diubah!'); window.location.href=location.href;</script>";
        iziToastAlertReload('success', 'Kursus Berhasil Diubah!');

        return true;
    } else {
        // echo "<script>alert('Gagal mengupdate course');</script>";
        iziToastAlert('error', 'Gagal mengubah course!');

        return false;
    }
}

// delete course
function delete_course() {
    global $koneksi;

    $id_course= $_GET['id'];
    // Hapus course itu sendiri
    $sql_course = mysqli_query($koneksi, "DELETE FROM course WHERE id_course = '$id_course'");

    if ($sql_course) {
        // echo "<script>alert('Course and related data deleted successfully!'); window.location.href='kursus.php';</script>";
        iziToastAlert('success', 'Course and related data deleted successfully!', 'kursus.php');

    } else {
        // echo "<script>alert('Failed to delete course and related data!');</script>";
        iziToastAlert('error', 'Failed to delete course and related data!');

    }

    return mysqli_affected_rows($koneksi);
}






// getcourse by mentor
function get_course_by_mentor(){
    global $koneksi;
    $mentor = $_SESSION['id_user'];
    $sql = mysqli_query($koneksi, "SELECT * FROM course WHERE id_mentor = '$mentor'");

    $courses = [];
    while ($course = mysqli_fetch_assoc($sql)) {
        $courses[] = $course;
    }

    return $courses;
}



// get course by id     
function get_course_by_id(){
    global $koneksi;
    $id_course = $_GET['id'];
    $get = mysqli_query($koneksi, "SELECT * FROM course WHERE id_course = '$id_course'");

    $take = mysqli_fetch_assoc($get);
    return $take;
}



// get jumlah course by mentor
function get_total_course_mentor(){
    global $koneksi;
    $id_mentor = $_SESSION['id_user'];

    // Menjalankan query dengan COUNT(*)
    $sql = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM course WHERE id_mentor = '$id_mentor'");

    // Mengambil hasil query
    $data = mysqli_fetch_assoc($sql);

    // Mengembalikan jumlah total course
    return $data['total'];
}

function get_total_student_mentor(){
    global $koneksi;
    $id_mentor = $_SESSION['id_user'];

    // Menjalankan query dengan COUNT(DISTINCT) untuk menghitung mahasiswa unik
    $sql = mysqli_query($koneksi, "
        SELECT COUNT(DISTINCT e.id_student) AS total 
        FROM enroll e
        JOIN course c ON e.id_course = c.id_course
        WHERE c.id_mentor = '$id_mentor'
    ");

    // Mengambil hasil query
    $data = mysqli_fetch_assoc($sql);

    // Mengembalikan jumlah total mahasiswa yang unik
    return $data['total'];
}



// ---------------------------------------------------------------SECTION
function create_section($data){
    global $koneksi;

    $course = $_GET['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM course WHERE id_course = '$course'");
    $take = mysqli_fetch_assoc($sql);

    $id_course = $take["id_course"];
    $section = $data['section']; //section title
    
    //insert ke db section
    $sql = mysqli_query($koneksi, "INSERT INTO section (id_course, title) VALUES ('$id_course', '$section')");
    if ($sql) {
        // echo "<script>alert('Berhasil Menambah Section!'); window.location.href = window.location.href; // Mengarahkan kembali ke halaman yang sama
        //     </script>";
        iziToastAlert('success', 'Berhasil Menambah Section!');

        
    }
    return mysqli_affected_rows($koneksi);
}

function edit_section($data) {
    global $koneksi;
    $id_section = $data['id_section'];
    $section = $data['section'];

    $sql = mysqli_query($koneksi, "UPDATE section SET title = '$section' WHERE id_section = '$id_section'");
    if ($sql) {
        // echo "<script>alert('Berhasil Merubah Section!'); window.location.href=location.href</script>";
        iziToastAlertReload('success', 'Berhasil Merubah Section!');

    }
    return mysqli_affected_rows($koneksi);
}

function delete_section($data) {
    global $koneksi;
    $id_section = $data['id_section'];
    $sql = mysqli_query($koneksi, "DELETE FROM section WHERE id_section = '$id_section'");
    if ($sql) {
        // echo "<script>alert('Section Berhasil Dihapus!'); window.location.href=location.href;</script>";
        iziToastAlertReload('success', 'Section Berhasil Dihapus!');
    }
    return mysqli_affected_rows($koneksi);
}

function get_section_byCourseId(){
    global $koneksi;

    $course = $_GET["id"];  
    $sql = mysqli_query($koneksi,"SELECT * FROM section WHERE id_course = '$course'");
    $section = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $section[] = $row;
    }
    return $section;
}





// ------------------------------------------------------------------INFORMATION
function create_information($data) {
    global $koneksi;
    $id_section = $data['id_section'];
    $information = $data['information'];
    
    $sql = mysqli_query($koneksi, "INSERT INTO information (id_section, information) VALUES ('$id_section', '$information')");
    if ($sql) {
        // echo "<script>alert('Information Created!');</script>";
        iziToastAlert('success', 'Information Created!');

    }
    return mysqli_affected_rows($koneksi);
}

function get_information_bySection($id_section) {
    global $koneksi;
    $sql = "SELECT * FROM information WHERE id_section = '$id_section'";
    $result = mysqli_query($koneksi, $sql); // Jalankan query

    $information = [];
    while ($info = mysqli_fetch_assoc($result)) { // Ambil data hasil query
        $information[] = $info;
    }
    return $information;
}

function edit_information($data) {
    global $koneksi;
    $id_information = $data['id_information'];
    $information = $data['information'];

    $sql = mysqli_query($koneksi, "UPDATE information SET information = '$information' WHERE id_information = '$id_information'");
    if ($sql) {
        // echo "<script>alert('Information Updated!');</script>";
        iziToastAlertReload('success', 'Information Updated!');

    }
    return mysqli_affected_rows($koneksi);
}

function delete_information($data) {
    global $koneksi;
    $id_information = $data['id_information'];
    $sql = mysqli_query($koneksi, "DELETE FROM information WHERE id_information = '$id_information'");
    if ($sql) {
        // echo "<script>alert('Information Deleted!');</script>";
        iziToastAlertReload('success', 'Information Deleted!');
    }
    return mysqli_affected_rows($koneksi);
}







// -----------------------------------------------------------------------VIDEO MATERIAL 
function create_video($data) {
    global $koneksi;
    $id_section = $data['id_section'];
    $url = $data['url'];
    
    $sql = mysqli_query($koneksi, "INSERT INTO materi_video (id_section, url) VALUES ('$id_section', '$url')");
    if ($sql) {
        // echo "<script>alert('Video Created!');</script>";
        iziToastAlert('success', 'Video Created!');

    }
    return mysqli_affected_rows($koneksi);
}

function get_video_bySection($id_section) {
    global $koneksi;
    $sql = "SELECT * FROM materi_video WHERE id_section = '$id_section'";
    $result = mysqli_query($koneksi, $sql); // Jalankan query

    $video = [];
    while ($vid = mysqli_fetch_assoc($result)) { // Ambil data hasil query
        $video[] = $vid;
    }
    return $video;
}

function edit_video($data) {
    global $koneksi;
    $id_materi_video = $data['id_materi_video'];
    $url = $data['url'];

    $sql = mysqli_query($koneksi, "UPDATE materi_video SET url = '$url' WHERE id_materi_video = '$id_materi_video'");
    if ($sql) {
        // echo "<script>alert('Video Updated!');</script>";
        iziToastAlertReload('success', 'Video Updated!');

    }
    return mysqli_affected_rows($koneksi);
}

function delete_video($data) {
    global $koneksi;
    $id_materi_video = $data['id_materi_video'];
    $sql = mysqli_query($koneksi, "DELETE FROM materi_video WHERE id_materi_video = '$id_materi_video'");
    if ($sql) {
        // echo "<script>alert('Video Deleted!');</script>";
        iziToastAlertReload('success', 'Video Deleted!');

    }
    return mysqli_affected_rows($koneksi);
}






// -----------------------------------------------------------------------TEXT MATERIAL 

function create_text($data) {
    global $koneksi;
    $id_section = $data['id_section'];
    $content = $data['text'];
    
    $sql = mysqli_query($koneksi, "INSERT INTO materi_text (id_section, content) VALUES ('$id_section', '$content')");
    if ($sql) {
        // echo "<script>alert('text Created!');</script>";
        iziToastAlert('success', 'Text Created!');

    }
    return mysqli_affected_rows($koneksi);
}

function get_text_bySection($id_section) {
    global $koneksi;
    $sql = "SELECT * FROM materi_text WHERE id_section = '$id_section'";
    $result = mysqli_query($koneksi, $sql); // Jalankan query

    $text = [];
    while ($tex = mysqli_fetch_assoc($result)) { // Ambil data hasil query
        $text[] = $tex;
    }
    return $text;
}


function edit_text($data) {
    global $koneksi;
    $id_materi_text = $data['id_materi_text'];
    $content = $data['text'];

    $sql = mysqli_query($koneksi, "UPDATE materi_text SET content = '$content' WHERE id_materi_text = '$id_materi_text'");
    if ($sql) {
        // echo "<script>alert('Information Updated!');</script>";
        iziToastAlertReload('success', 'Text Updated!');

    }
    return mysqli_affected_rows($koneksi);
}

function delete_text($data) {
    global $koneksi;
    $id_materi_text = $data['id_materi_text'];
    $sql = mysqli_query($koneksi, "DELETE FROM materi_text WHERE id_materi_text = '$id_materi_text'");
    if ($sql) {
        // echo "<script>alert('Information Deleted!');</script>";
        iziToastAlertReload('success', 'Text Deleted!');
    }
    return mysqli_affected_rows($koneksi);
}






//--------------------------------------------------FILE MATERIAL
function create_file($data) {
    global $koneksi;

    $id_section = $data['id_section'];
    
    $file_name = $_FILES['file']['name']; // Nama file yang diupload
    $tmpname = $_FILES['file']['tmp_name']; // Temporary file path
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/pbl/frontend/src/file_materi/' . basename($file_name); // Path untuk menyimpan file

    // Validasi file (ekstensi dan ukuran bisa ditambahkan sesuai kebutuhan)
    $allowed_extensions = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt', 'sql', 'jpg', 'jpeg', 'png']; // Daftar ekstensi yang diizinkan
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    
    if (!in_array($file_extension, $allowed_extensions)) {
        // echo "<script>alert('Format file tidak diizinkan!');</script>";
        iziToastAlert('error', 'Format file tidak diizinkan!');

        return;
    }

    // Proses upload file
    if (move_uploaded_file($tmpname, $folder)) {
        // Simpan informasi file ke database
        $sql = mysqli_query($koneksi, "INSERT INTO materi_file (id_section, file) VALUES ('$id_section', '$file_name')");
        if ($sql) {
            // echo "<script>alert('File uploaded successfully!');</script>";
            iziToastAlert('success', 'File uploaded successfully!');

        } else {
            // echo "<script>alert('Database insertion failed!');</script>";
            iziToastAlert('error', 'Database insertion failed!');

        }
    } else {
        // echo "<script>alert('Gagal mengupload file');</script>";
        iziToastAlert('error', 'Gagal mengupload file!');

    }
}

function get_file_bySection($id_section) {
    global $koneksi;
    $sql = "SELECT * FROM materi_file WHERE id_section = '$id_section'";
    $result = mysqli_query($koneksi, $sql);

    $files = [];
    while ($file = mysqli_fetch_assoc($result)) {
        $files[] = $file;
    }
    return $files;
}

function edit_file($data) {
    global $koneksi;
    $id_materi_file = $data['id_materi_file']; // ID file yang akan diedit
    if (!empty($_FILES['file']['name'])) {
        $file_name = $_FILES['file']['name'];
        $tmpname = $_FILES['file']['tmp_name']; 
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/pbl/frontend/src/file_materi/' . basename($file_name); // Path untuk menyimpan file

        $allowed_extensions = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt', 'sql', 'jpg', 'jpeg', 'png']; // Daftar ekstensi yang diizinkan
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

        if (!in_array($file_extension, $allowed_extensions)) {
            // echo "<script>alert('Format file tidak diizinkan!');</script>";
            iziToastAlert('error', 'Format file tidak diizinkan!');

            return;
        }

        // Ambil nama file lama yang ada di database
        $result = mysqli_query($koneksi, "SELECT file FROM materi_file WHERE id_materi_file = '$id_materi_file'");
        $existing_file = mysqli_fetch_assoc($result)['file'];

        // Hapus file lama jika ada
        if ($existing_file) {
            $old_file_path = $_SERVER['DOCUMENT_ROOT'] . '/pbl/frontend/src/file_materi/' . $existing_file;
            if (file_exists($old_file_path) && !is_dir($old_file_path)) {
                unlink($old_file_path); 
            }
        }

        if (move_uploaded_file($tmpname, $folder)) {
            $sql = mysqli_query($koneksi, "UPDATE materi_file SET file = '$file_name' WHERE id_materi_file = '$id_materi_file'");
            if ($sql) {
                // echo "<script>alert('File updated successfully!');</script>";
                iziToastAlert('success', 'File updated successfully!');

            } else {
                // echo "<script>alert('Failed to update file in database!');</script>";
                iziToastAlert('error', 'Failed to update file in database!');

            }
        } else {
            // echo "<script>alert('Failed to upload new file!');</script>";
            iziToastAlert('error', 'Failed to upload new file!');

        }
    } else {
        // echo "<script>alert('No new file uploaded.');</script>";
        iziToastAlert('info', 'No new file uploaded!');

    }
    return mysqli_affected_rows($koneksi);
}

function delete_file($data) {
    global $koneksi;
    $id_materi_file = $data['id_materi_file'];
    $sql = mysqli_query($koneksi, "DELETE FROM materi_file WHERE id_materi_file = '$id_materi_file'");
    if ($sql) {
        // echo "<script>alert('File Deleted!');</script>";
        iziToastAlert('success', 'File Deleted!');

    }
    return mysqli_affected_rows($koneksi);
}






// ---------------------------------------------- QUIZ
function get_quiz_bySection($id_section) {
    global $koneksi;
    $sql = "SELECT * FROM quiz WHERE id_section = '$id_section'";
    $result = mysqli_query($koneksi, $sql);

    $quiz = [];
    while ($file = mysqli_fetch_assoc($result)) {
        $quiz[] = $file;
    }
    return $quiz;
}












// -------------------------------------------------------PESERTA COURSE----------------------------------
// Ambil data student berdasarkan course
function get_students_by_course($id_course) {
    global $koneksi;

    $query = "
        SELECT 
            user.username, enroll.status, enroll.enroll_date 
        FROM enroll 
        JOIN student ON enroll.id_student = student.id_student
        JOIN user ON student.id_student = user.id_user
        WHERE enroll.id_course = '$id_course'
    ";

    $result = mysqli_query($koneksi, $query);

    // Simpan data dalam array
    $students = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }

    return $students;
}






// -----------------------------------------------------QUIZ----------------------------------------------

// Dari kursus detail
function add_quiz($data){
    global $koneksi;

    $id_section = $data["section"];
    $title = $data["title"];

    $sql = mysqli_query($koneksi,"INSERT INTO quiz (id_section, title) VALUES ('$id_section', '$title')");

    if ($sql) {
        // echo "
        // <script>
        //     alert('Berhasil');
        //     window.location.href = location.href;        
        // </script>
        // ";

        iziToastAlert('success', 'Quiz Created!');

    } else {
        echo "<script>alert('Gagal')</script>";
        iziToastAlert('error', 'Gagal!');

    }
} 

// Dari halaman quiz
function add_quiz2($data){
    global $koneksi;
    $id_course = $_GET['id'];
    $id_section = $data["section"];
    $title = $data["title"];

    $sql = mysqli_query($koneksi,"INSERT INTO quiz (id_section, title) VALUES ('$id_section', '$title')");

    if ($sql) {
        // echo "
        // <script>
        //     alert('Berhasil');
        //     window.location.href = location.href;        
        // </script>
        // ";

        iziToastAlert('success', 'Quiz Created!', "add-quiz.php?id=$id_course");

    } else {
        echo "<script>alert('Gagal')</script>";
        iziToastAlert('error', 'Gagal!');

    }
} 



function get_quiz_byCourse(){
    global $koneksi;

    $course = $_GET["id"];  
    $sql =  mysqli_query($koneksi, "
    SELECT quiz.id_quiz, quiz.id_section, quiz.title
    FROM quiz 
    INNER JOIN section ON quiz.id_section = section.id_section 
    WHERE section.id_course = '$course'");
    $quiz = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $quiz[] = $row;
    }

    return $quiz;
}


function get_quiz_byId(){
    global $koneksi;

    $id_quiz = $_GET["id"];  
    $sql =  mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_quiz = '$id_quiz'");
    $get = mysqli_fetch_assoc($sql);
    return $get;
}


function get_question_byQuiz(){
    global $koneksi;

    $quiz = $_GET["id"];  
    $sql =  mysqli_query($koneksi, "SELECT * FROM question WHERE id_quiz = '$quiz'");
    $question = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $question[] = $row;
    }
    return $question;
}

function total_question_byQuiz($id_quiz) {
    global $koneksi;

    $sql = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM question WHERE id_quiz = '$id_quiz'");
    $result = mysqli_fetch_assoc($sql);
    
    return $result['total'];
}





function add_question($data){
    global $koneksi;

    $id_quiz = $_GET['id'];
    $question = $data["question"];

    // Insert pertanyaan ke database
    $sql_question = mysqli_query($koneksi, "INSERT INTO question (id_quiz, question) VALUES ('$id_quiz', '$question')");

    if ($sql_question) {
        $id_question = mysqli_insert_id($koneksi);
        $options = [
            $data['option1'],
            $data['option2'],
            $data['option3'],
            $data['option4']
        ];

        // Mendapatkan nilai jawaban benar dari form
        $correct_option = $data['correct_option'];

        foreach ($options as $index => $option) {
            // Sesuaikan nilai is_right berdasarkan pilihan correct_option
            $is_right = ($index + 1) == $correct_option ? 1 : 0;
            $sql_option = mysqli_query($koneksi, "INSERT INTO quiz_option (id_question, option, is_right) VALUES ('$id_question', '$option', '$is_right')");
        }

        if ($sql_option) {
            // echo "<script>
            //     alert('Berhasil');
            //     window.location.href = location.href;
            // </script>";

            iziToastAlert('success', 'Question Added!', "quiz-question.php?id=$id_quiz");




        } else {
            echo "<script>alert('Gagal Menambahkan Options')</script>";
            iziToastAlert('error', 'Gagal Menambahkan Options!');

        }
    } else {
        iziToastAlert('error', 'Gagal Menambahkan Question!');

    }
}

function edit_quiz($data) {
    global $koneksi;
    $id_quiz = $data['id_quiz'];
    $title = $data['title'];

    $sql = mysqli_query($koneksi, "UPDATE quiz SET title = '$title' WHERE id_quiz = '$id_quiz'");
    if ($sql) {
        // echo "<script>alert('Quiz Updated!'); window.location.href=location.href</script>";
        iziToastAlert('success', 'Question Updated!', "quiz-question.php?id=$id_quiz");
    }
    return mysqli_affected_rows($koneksi);
}


function get_option_byQuestion($id_question){
    global $koneksi;

    $sql =  mysqli_query($koneksi, "SELECT * FROM quiz_option WHERE id_question = '$id_question'");
    $option = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $option[] = $row;
    }
    return $option;
}




function edit_question($data) {
    global $koneksi;
    $id_quiz = $_GET['id'];
    // Filter input data
    $id_question = $data['id_question'];
    $question = mysqli_real_escape_string($koneksi, htmlspecialchars($data['username'], ENT_QUOTES)); // Soal yang diupdate
    $options = $data['option']; // Array dari opsi yang diupdate
    $is_right = $data['is_right']; // Jawaban benar (ID opsi)

    // Update soal di tabel `question`
    $sql_question = "UPDATE question SET question = '$question' WHERE id_question = '$id_question'";
    $query_question = mysqli_query($koneksi, $sql_question);

    if ($query_question) {
        // Perbarui opsi pada tabel `quiz_option`
        foreach ($options as $index => $option) {
            $option_id = $data['option_ids'][$index]; // Pastikan ID opsi dikirim dari form
            $is_correct = ($option_id == $is_right) ? 1 : 0; // Set is_right berdasarkan ID yang dipilih

            // Escape input option
            $escaped_option = mysqli_real_escape_string($koneksi, htmlspecialchars($option, ENT_QUOTES));

            // Update database
            $sql_option = "UPDATE quiz_option 
                           SET option = '$escaped_option', is_right = '$is_correct' 
                           WHERE id_quiz_option = '$option_id'";
            $query_option = mysqli_query($koneksi, $sql_option);

            // Debug jika query gagal
            if (!$query_option) {
                echo "<script>alert('Gagal memperbarui opsi dengan ID $option_id: " . mysqli_error($koneksi) . "');</script>";
                return false;
            }
        }

        // echo "<script>
        //     alert('Berhasil memperbarui soal dan opsi');
        //     window.location.href = location.href; 
        // </script>";

        iziToastAlert('success', 'Berhasil memperbarui soal dan opsi!', "quiz-question.php?id=$id_quiz");

        return true;
    } else {
        echo "<script>alert('Gagal memperbarui soal: " . mysqli_error($koneksi) . "');</script>";
        iziToastAlert('error', 'Gagal memperbarui soal!');

        return false;
    }
}

function delete_question($data) {
    global $koneksi;
    $id_question = $data['id_question'];

    $sql = mysqli_query($koneksi, "DELETE FROM question WHERE id_question = '$id_question'");

    if ($sql) {
        // echo "<script>alert('Course and related data deleted successfully!'); window.location.href='kursus.php';</script>";
        iziToastAlertReload('success', 'Question and option data deleted successfully!');

    } else {
        // echo "<script>alert('Failed to delete course and related data!');</script>";
        iziToastAlert('error', 'Failed to delete question and option data!');

    }

    return mysqli_affected_rows($koneksi);

}



function delete_quiz($data) {
    global $koneksi;
    $id_quiz = $data['id_quiz'];

    $sql = mysqli_query($koneksi, "DELETE FROM quiz WHERE id_quiz = '$id_quiz'");

    if ($sql) {
        // echo "<script>alert('Course and related data deleted successfully!'); window.location.href='kursus.php';</script>";
        iziToastAlert('success', 'Quiz and related data deleted successfully!', 'quiz.php');

    } else {
        // echo "<script>alert('Failed to delete course and related data!');</script>";
        iziToastAlert('error', 'Failed to delete quiz and related data!');

    }

    return mysqli_affected_rows($koneksi);

}


?>
</body>

</html>