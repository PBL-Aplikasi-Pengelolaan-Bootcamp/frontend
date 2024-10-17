<?php
session_start();
// session_start();
include dirname(__DIR__).'/koneksi.php';





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

    $slug = $_GET["slug"];  

    $get = mysqli_query($koneksi,"SELECT * FROM course WHERE slug = '$slug'");
    $take = mysqli_fetch_assoc($get);
    $id_course = $take["id_course"];


    $sql = mysqli_query($koneksi,"SELECT * FROM section WHERE id_course = '$id_course'");
    $section = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $section[] = $row;
    }
    return $section;
}


?>