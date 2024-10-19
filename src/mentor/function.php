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
    $allowed_extensions = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt']; // Daftar ekstensi yang diizinkan
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


?>