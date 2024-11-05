<?php
session_start();
// session_start();
include dirname(__DIR__).'/koneksi.php';

//logout
function logout(){
    session_unset();
    session_destroy();
    echo "<script>alert('Logout'); window.location.href='../login.php'</script>";
}

//edit profil
function edit_profil($data, $id_user) {
    global $koneksi;

    $username = strtolower(stripslashes($data['username']));
    $email = strtolower(stripslashes($data['email']));
    $name = mysqli_real_escape_string($koneksi, $data['name']);
    $bio = mysqli_real_escape_string($koneksi, $data['bio']);
    $expertise = mysqli_real_escape_string($koneksi, $data['expertise']);
    $telp = mysqli_real_escape_string($koneksi, $data['telp']);

    // Penanganan upload foto profil
    $img = $_FILES['profil_picture']['name'];
    $tmp = $_FILES['profil_picture']['tmp_name'];
    $imgFolder = "../foto_mentor/";  // Hanya path folder
    $imgPath = $imgFolder . $img;  // Path lengkap dengan nama file

    if ($img) {
        if (move_uploaded_file($tmp, $imgPath)) {
            // Update hanya dengan nama file
            $updateMentor = mysqli_query($koneksi, 
                "UPDATE mentor 
                 SET name = '$name', bio = '$bio', expertise = '$expertise', telp = '$telp', profil_picture = '$img' 
                 WHERE id_mentor = '$id_user'");
        } else {
            echo "<script>alert('Gagal upload foto.');</script>";
            return false;
        }
    } else {
        // Update tanpa mengubah kolom foto
        $updateMentor = mysqli_query($koneksi, 
            "UPDATE mentor 
             SET name = '$name', bio = '$bio', expertise = '$expertise', telp = '$telp'
             WHERE id_mentor = '$id_user'");
    }

    // Update data di tabel user
    $updateUser = mysqli_query($koneksi, 
        "UPDATE user 
         SET username = '$username', email = '$email' 
         WHERE id_user = '$id_user'");

    // Cek apakah update berhasil di kedua tabel
    if ($updateUser && $updateMentor) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Account updated successfully!'); window.location.href = window.location.href;</script>";
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
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/_pbl/frontend/src/foto_cover_course/' . $course_picture;


    if  (move_uploaded_file($tmpname, $folder)) {
        $sql = mysqli_query($koneksi, "INSERT INTO course (id_course, id_mentor, title, slug, description, start_date, end_date, course_type, quota, course_picture) VALUES ('', '$id_mentor', '$title', '$slug', '$description', '$start_date', '$end_date', '$course_type', '$quota', '$course_picture')");
        if ($sql) {
            echo "<script>alert('Course Created!'); window.location.href='kursus.php';</script>";
        } else {
            echo "<script>alert('gagal')</script>";
        }

    } else {
        // Jika gagal mengupload file
        echo "<script>alert('Gagal mengupload file');</script>";
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
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/_pbl/frontend/src/foto_cover_course/' . $course_picture;

        // Get old picture name
        $query = mysqli_query($koneksi, "SELECT course_picture FROM course WHERE id_course = '$id_course'");
        $old_data = mysqli_fetch_assoc($query);
        $old_picture = $old_data['course_picture'];

        // Delete old picture if exists
        if (!empty($old_picture)) {
            $old_picture_path = $_SERVER['DOCUMENT_ROOT'] . '/_pbl/frontend/src/foto_cover_course/' . $old_picture;
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
            echo "<script>alert('Gagal mengupload file baru');</script>";
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
        echo "<script>alert('Course Updated!'); window.location.href='kursus.php';</script>";
        return true;
    } else {
        echo "<script>alert('Gagal mengupdate course');</script>";
        return false;
    }
}

// delete course
function delete_course() {
    global $koneksi;

    $id_course= $_GET['id'];
    // Hapus section yang terkait dengan course ini
    $sql_section = mysqli_query($koneksi, "DELETE FROM section WHERE id_course = '$id_course'");

    // Hapus information yang terkait dengan course ini
    $sql_information = mysqli_query($koneksi, "DELETE FROM information WHERE id_course = '$id_course'");

    // Hapus materi video yang terkait dengan course ini
    $sql_video = mysqli_query($koneksi, "DELETE FROM materi_video WHERE id_course = '$id_course'");

    // Hapus materi text yang terkait dengan course ini
    $sql_text = mysqli_query($koneksi, "DELETE FROM materi_text WHERE id_course = '$id_course'");
    
    
    // Hapus materi file yang terkait dengan course ini
    $sql_file = mysqli_query($koneksi, "DELETE FROM materi_file WHERE id_course = '$id_course'");
    
    // Hapus course itu sendiri
    $sql_course = mysqli_query($koneksi, "DELETE FROM course WHERE id_course = '$id_course'");

    if ($sql_section && $sql_information && $sql_video && $sql_text && $sql_file && $sql_course) {
        echo "<script>alert('Course and related data deleted successfully!');</script>";
    } else {
        echo "<script>alert('Failed to delete course and related data!');</script>";
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



// create section
function create_section($data){
    global $koneksi;

    $course = $_GET['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM course WHERE id_course = '$course'");
    $take = mysqli_fetch_assoc($sql);

    $id_course = $take["id_course"];
    $section = $data['title']; //section title
    
    //insert ke db section
    $sql = mysqli_query($koneksi, "INSERT INTO section (id_course, title) VALUES ('$id_course', '$section')");
    if ($sql) {
        echo "<script>alert('Section Created!'); window.location.href = window.location.href; // Mengarahkan kembali ke halaman yang sama
            </script>";
        
    }
    return mysqli_affected_rows($koneksi);

}

// ---------------------------------------------create Information
function create_information($data) {
    global $koneksi;
    $id_course = $_GET['id'];
    $id_section = $data['id_section'];
    $information = $data['information'];
    
    $sql = mysqli_query($koneksi, "INSERT INTO information (id_course, id_section, information) VALUES ('$id_course','$id_section', '$information')");
    if ($sql) {
        echo "<script>alert('Information Created!');</script>";
    }
    return mysqli_affected_rows($koneksi);
}

function get_information_bySection($id_course, $id_section) {
    global $koneksi;
    $sql = "SELECT * FROM information WHERE id_course = '$id_course' AND id_section = '$id_section'";
    $result = mysqli_query($koneksi, $sql); // Jalankan query

    $information = [];
    while ($info = mysqli_fetch_assoc($result)) { // Ambil data hasil query
        $information[] = $info;
    }
    return $information;
}





// ---------------------------------------------create video
function create_video($data) {
    global $koneksi;
    $id_course = $_GET['id'];
    $id_section = $data['id_section'];
    $url = $data['url'];
    
    $sql = mysqli_query($koneksi, "INSERT INTO materi_video (id_course, id_section, url) VALUES ('$id_course','$id_section', '$url')");
    if ($sql) {
        echo "<script>alert('Video Created!');</script>";
    }
    return mysqli_affected_rows($koneksi);
}
function get_video_bySection($id_course, $id_section) {
    global $koneksi;
    $sql = "SELECT * FROM materi_video WHERE id_course = '$id_course' AND id_section = '$id_section'";
    $result = mysqli_query($koneksi, $sql); // Jalankan query

    $video = [];
    while ($vid = mysqli_fetch_assoc($result)) { // Ambil data hasil query
        $video[] = $vid;
    }
    return $video;
}

// ---------------------------------------------create text
function create_text($data) {
    global $koneksi;
    $id_course = $_GET['id'];
    $id_section = $data['id_section'];
    $content = $data['text'];
    
    $sql = mysqli_query($koneksi, "INSERT INTO materi_text (id_course, id_section, content) VALUES ('$id_course','$id_section', '$content')");
    if ($sql) {
        echo "<script>alert('text Created!');</script>";
    }
    return mysqli_affected_rows($koneksi);
}
function get_text_bySection($id_course, $id_section) {
    global $koneksi;
    $sql = "SELECT * FROM materi_text WHERE id_course = '$id_course' AND id_section = '$id_section'";
    $result = mysqli_query($koneksi, $sql); // Jalankan query

    $text = [];
    while ($tex = mysqli_fetch_assoc($result)) { // Ambil data hasil query
        $text[] = $tex;
    }
    return $text;
}


//--------------------------------------------------create file
function create_file($data) {
    global $koneksi;

    $id_course = $_GET['id']; // Ambil ID course dari URL
    $id_section = $data['id_section'];
    
    $file_name = $_FILES['file']['name']; // Nama file yang diupload
    $tmpname = $_FILES['file']['tmp_name']; // Temporary file path
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/_pbl/frontend/src/file_materi/' . basename($file_name); // Path untuk menyimpan file

    // Validasi file (ekstensi dan ukuran bisa ditambahkan sesuai kebutuhan)
    $allowed_extensions = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt', 'sql', 'jpg', 'jpeg', 'png']; // Daftar ekstensi yang diizinkan
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "<script>alert('Format file tidak diizinkan!');</script>";
        return;
    }

    // Proses upload file
    if (move_uploaded_file($tmpname, $folder)) {
        // Simpan informasi file ke database
        $sql = mysqli_query($koneksi, "INSERT INTO materi_file (id_course, id_section, file) VALUES ('$id_course', '$id_section', '$file_name')");
        
        if ($sql) {
            echo "<script>alert('File uploaded successfully!');</script>";
        } else {
            echo "<script>alert('Database insertion failed!');</script>";
        }
    } else {
        // Jika gagal mengupload file
        echo "<script>alert('Gagal mengupload file');</script>";
    }
}

function get_file_bySection($id_course, $id_section) {
    global $koneksi;
    $sql = "SELECT * FROM materi_file WHERE id_course = '$id_course' AND id_section = '$id_section'";
    $result = mysqli_query($koneksi, $sql);

    $files = [];
    while ($file = mysqli_fetch_assoc($result)) {
        $files[] = $file;
    }
    return $files;
}


















// create material
function create_material($data){
    global $koneksi;

    $course = $_GET['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM course WHERE id = '$course'");
    $take = mysqli_fetch_assoc($sql);

    $id_course = $take["id_course"];

    $section = $data['section']; //section title
    $video = $data['materi_video']; //materi video
    $text = $data['materi_text']; //materi text


    //insert ke db section
    $sql = mysqli_query($koneksi, "INSERT INTO section (id_course, title) VALUES ('$id_course', '$title')");
    mysqli_affected_rows($koneksi);


    //insert ke db materi video
    $sql = mysqli_query($koneksi, "INSERT INTO materi_video (id_section, link_youtube) VALUES ('$id_section', '$video')");
    mysqli_affected_rows($koneksi);


}


//create materi video
function create_materi_video($data){
    global $koneksi;

    $link_youtube = $data["link_youtube"];
    $deskripsi = $data["deskripsi"];
    $id_section = 

    mysqli_query($koneksi,"INSERT INTO materi_video (link_youtube, deskripsi) VALUES ('$link_youtube', '$deskripsi')");

    return mysqli_affected_rows($koneksi);
} 



// get section by courseId 
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


?>