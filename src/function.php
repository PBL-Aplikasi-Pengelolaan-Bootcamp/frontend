<?php

session_start();
//koneksi ke mysql
include 'koneksi.php';


// register function
function register($data)
{   
    global $koneksi;

    $name = $data['nama'];
    $username = strtolower(stripslashes($data['username']));
    $email = strtolower(stripslashes($data['email']));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    //cek apakah ada username yang sama
    $cek_username = mysqli_query($koneksi, "SELECT * from user WHERE username = '$username';");
    if (mysqli_fetch_assoc($cek_username)) {
        echo "<script>alert('Username Tidak Tersedia');</script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>alert('Mohon konfirmasikan password dengna benar')</script>";
        return false;
    }

    // enkripsi password 
    $password = password_hash($password, PASSWORD_DEFAULT);

    // 1. Ke tabel user
    $ke_user = mysqli_query($koneksi, "INSERT INTO user (id_user, username, email, password, role) VALUES (NULL, '$username', '$email', '$password', 'student')");
    if ($ke_user) {
        echo "<script>alert('Berhasil update data ke user')</script>";
    }
    

    // 2. Ke tabel student
    $id_dari_user = mysqli_insert_id($koneksi);
        
    $sql = mysqli_query($koneksi, "INSERT INTO student (id_student, name) VALUES ('$id_dari_user', '$name')");
    if ($sql) {
        echo "<script>alert('Register Success!'); window.location.href='login.php';</script>";
        return mysqli_affected_rows($koneksi);
    }
}




// function edit profil
function edit_profil($data, $id_user) {
    global $koneksi;

    $username = strtolower(stripslashes($data['username']));
    $email = strtolower(stripslashes($data['email']));
    $name = mysqli_real_escape_string($koneksi, $data['name']);
    $birth = mysqli_real_escape_string($koneksi, $data['birth']);
    $telp = mysqli_real_escape_string($koneksi, $data['telp']);

    // Penanganan upload foto profil
    $img = $_FILES['profil_picture']['name'];
    $tmp = $_FILES['profil_picture']['tmp_name'];
    $imgFolder = "foto_student/";  // Hanya path folder
    $imgPath = $imgFolder . $img;  // Path lengkap dengan nama file

    if ($img) {
        if (move_uploaded_file($tmp, $imgPath)) {
            // Update hanya dengan nama file
            $updateStudent = mysqli_query($koneksi, 
                "UPDATE student 
                 SET name = '$name', birth = '$birth', telp = '$telp', profil_picture = '$img' 
                 WHERE id_student = '$id_user'");
        } else {
            echo "<script>alert('Gagal upload foto.');</script>";
            return false;
        }
    } else {
        // Update tanpa mengubah kolom foto
        $updateStudent = mysqli_query($koneksi, 
            "UPDATE student 
             SET name = '$name', birth = '$birth', telp = '$telp' 
             WHERE id_student = '$id_user'");
    }

    // Update data di tabel user
    $updateUser = mysqli_query($koneksi, 
        "UPDATE user 
         SET username = '$username', email = '$email' 
         WHERE id_user = '$id_user'");

    // Cek apakah update berhasil di kedua tabel
    if ($updateUser && $updateStudent) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Account updated successfully!'); window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('Failed to update account.');</script>";
    }
}











// login function
function login($data)
{
    global $koneksi;

    $username =  $data['username'];
    $password =  $data['password'];

    //check the username
    $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");


    //if username exist in database
    if (mysqli_num_rows($cek_username) === 1) {

        //get data from username
        $data_from_username = mysqli_fetch_assoc($cek_username);

        if (password_verify($password, $data_from_username['password'])) {

            $_SESSION['username'] = $data_from_username['username'];
            $_SESSION['role'] = $data_from_username['role'];
            $_SESSION['id_user'] = $data_from_username['id_user'];

            if ($data_from_username['role'] == 'student') {
                echo"<script>
                        alert('Login success !');
                        window.location.href= 'index.php'
                    </script>"; 
            exit;

            } else if ($data_from_username['role'] == 'mentor'){
                echo"<script>
                        alert('Login success !');
                        window.location.href= 'mentor/dashboard-mentor.php'
                    </script>";
            exit;
            } else {
                echo"<script>
                        alert('Login success !');
                        window.location.href= 'admin/dashboard-admin.php'
                    </script>";
                exit;
            }
                
        } else {
            echo "<script>alert('Wrong Password')</script>";
        }
    } else {
        echo "<script>alert('Username doesn't exist')</script>";
    }
}





// logout function
function logout(){
    session_unset();
    session_destroy();
    echo "<script>alert('Logout'); window.location.href='login.php'</script>";
}








// ------------------------------------------------------------HOME PAGE-------------------------------------------------------



// Get user data from sesion

function get_data_user_login() {
    global $koneksi;

    // Cek apakah session 'id_user' ada
    if (!isset($_SESSION['id_user'])) {
        return null; // Kembalikan null jika session tidak ada
    }

    // Ambil id_user dari session
    $id_user = $_SESSION['id_user'];

    // Query untuk mendapatkan data dari user dan student
    $sql = mysqli_query($koneksi, 
        "SELECT user.*, student.* 
         FROM user 
         JOIN student ON user.id_user = student.id_student 
         WHERE user.id_user = '$id_user'"
    );

    // Periksa jika ada hasil yang ditemukan
    if (mysqli_num_rows($sql) > 0) {
        return mysqli_fetch_assoc($sql); // Ambil data sebagai array asosiatif
    } else {
        return null; // Kembalikan null jika tidak ada data
    }
}












//get all course
function getAll_Course($id_user = null) {
    global $koneksi;

    if ($id_user === null) {
        // Jika user belum login, tampilkan semua kursus
        $sql = "SELECT * FROM course";
    } else {
        // Jika user sudah login, tampilkan kursus yang belum didaftar
        $sql = "SELECT c.* 
                FROM course c
                LEFT JOIN enroll e ON c.id_course = e.id_course AND e.id_student = '$id_user'
                WHERE e.id_course IS NULL";
    }

    $result = mysqli_query($koneksi, $sql);

    $courses = [];
    while ($course = mysqli_fetch_assoc($result)) {
        $courses[] = $course;
    }

    return $courses;
}


// get course yang di enroll
function getEnrolledCourses($id_user) {
    global $koneksi;

    $sql = "SELECT c.*, e.enroll_date, e.status 
            FROM course c
            INNER JOIN enroll e ON c.id_course = e.id_course
            WHERE e.id_student = '$id_user'";

    $result = mysqli_query($koneksi, $sql);

    if (!$result) {
        return false;
    }

    $enrolledCourses = [];
    while ($course = mysqli_fetch_assoc($result)) {
        $enrolledCourses[] = $course;
    }

    return $enrolledCourses;
}











// -----------------------------------------------------HALAMAN KURSUS MATERI--------------------------------------------------



// ------------------------------enroll course
function enroll() {
    global $koneksi;

    if (!isset($_POST['id_course']) || !isset($_SESSION['id_user'])) {
        echo "<script>alert('Data tidak lengkap');</script>";
        return;
    }

    $id_course = $_POST['id_course'];
    $id_user = $_SESSION['id_user'];

    // Query JOIN untuk mendapatkan data dari tabel `user` dan `student`
    $query_user = mysqli_query($koneksi, "
        SELECT u.username, u.email, s.name, s.telp, s.birth 
        FROM user u 
        JOIN student s ON u.id_user = s.id_student 
        WHERE u.id_user = '$id_user'
    ");

    $data_login = mysqli_fetch_assoc($query_user);

    // Validasi data profil
    if (
        empty($data_login['username']) || empty($data_login['email']) || 
        empty($data_login['name']) || empty($data_login['telp']) || 
        empty($data_login['birth'])
    ) {
        echo "<script>alert('Lengkapi profil Anda terlebih dahulu');</script>";
        return;
    }

    // Cek tanggal mulai kursus
    $query_course = mysqli_query($koneksi, "SELECT start_date FROM course WHERE id_course = '$id_course'");
    $course_data = mysqli_fetch_assoc($query_course);

    if ($course_data) {
        $start_date = $course_data['start_date'];
        $current_date = date('Y-m-d');

        // Tentukan status enrollment
        $status = ($current_date >= $start_date) ? 'On going' : 'pending';

        // Insert ke tabel enroll
        $sql = mysqli_query($koneksi, 
            "INSERT INTO enroll (id_student, id_course, status, enroll_date) 
             VALUES ('$id_user', '$id_course', '$status', NOW())"
        );

        if ($sql) {
            echo "<script>alert('Enrollment berhasil'); window.location.href=window.location.href;</script>";
        } else {
            echo "Gagal melakukan enrollment: " . mysqli_error($koneksi);
        }
    } else {
        echo "Data kursus tidak ditemukan.";
    }
}



// ---------------------------------------GET DATA ENROLL-------------------------------------------------
function get_data_enroll_login() {
    global $koneksi;
    $slug= $_GET['kursus'];
    $id_student = $_SESSION['id_user'];

    // 1. Cari id_course berdasarkan slug
    $query = "SELECT id_course FROM course WHERE slug = '$slug' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $id_course = $row['id_course'];

        // 2. Cari id_enroll berdasarkan id_course dan id_student
        $query_enroll = "SELECT id_enroll FROM enroll WHERE id_student = '$id_student' AND id_course = '$id_course' LIMIT 1";
        $result_enroll = mysqli_query($koneksi, $query_enroll);

        // Jika id_enroll ditemukan
        if ($row_enroll = mysqli_fetch_assoc($result_enroll)) {
            $_SESSION['id_enroll'] = $row_enroll['id_enroll']; // Simpan id_enroll dalam session
            return $_SESSION['id_enroll']; // Kembalikan id_enroll jika ditemukan
        } else {
            // Jika enrollment tidak ditemukan
            echo "Enrollment not found for this course.";
            return null;
        }
    } else {
        // Jika id_course tidak ditemukan
        echo "Course not found.";
        return null;
    }
}



// ----------------------------------Get data course by slug
function get_course_by_slug() {
    global $koneksi;
    $slug = mysqli_real_escape_string($koneksi, $_GET['kursus']);
    
    // Query dengan INNER JOIN untuk mengambil data course dan mentor
    $sql = mysqli_query($koneksi, 
        "SELECT course.*, mentor.* 
         FROM course
         INNER JOIN mentor ON course.id_mentor = mentor.id_mentor
         WHERE course.slug = '$slug'"
    );

    $course = mysqli_fetch_assoc($sql);
    return $course; 
}




// ------------------------------------Get data section by slug
function get_section_by_slug() {
    global $koneksi;
    $slug = $_GET['kursus'];
    $sql = mysqli_query($koneksi, 
    "SELECT section.title AS section_title, course.title AS course_title, section.id_section AS section_id_section
     FROM section
     INNER JOIN course ON section.id_course = course.id_course
    WHERE course.slug = '$slug'");

    $section = [];
    while ($course = mysqli_fetch_assoc($sql)) {
        $section[] = $course;
    }   

    return $section;
}








// -------------------------------------------------MATERI
//get id course dari slug
function get_course_id_from_slug($course_slug) {
    global $koneksi;
    
    $course_query = "SELECT id_course FROM course WHERE slug = '$course_slug' LIMIT 1";
    $course_result = mysqli_query($koneksi, $course_query);
    
    if ($course_result && mysqli_num_rows($course_result) > 0) {
        $course_data = mysqli_fetch_assoc($course_result);
        return $course_data['id_course'];
    } else {
        return null; // atau false, tergantung preferensi Anda
    }
}

// get information section
function get_information_by_course_and_section($id_course, $id_section) {
    global $koneksi;
    
    $info_query = "SELECT * FROM information WHERE id_course = '$id_course' AND id_section = '$id_section'";
    $info_result = mysqli_query($koneksi, $info_query);
    
    $information = [];
    while ($info = mysqli_fetch_assoc($info_result)) {
        $information[] = $info;
    }
    
    return $information;
}

// get video section
function get_video_by_course_and_section($id_course, $id_section) {
    global $koneksi;
    
    $vid_query = "SELECT * FROM materi_video WHERE id_course = '$id_course' AND id_section = '$id_section'";
    $vid_result = mysqli_query($koneksi, $vid_query);
    
    $video = [];
    while ($vid = mysqli_fetch_assoc($vid_result)) {
        $video[] = $vid;
    }
    
    return $video;
}

// get text section
function get_text_by_course_and_section($id_course, $id_section) {
    global $koneksi;
    
    $tex_query = "SELECT * FROM materi_text WHERE id_course = '$id_course' AND id_section = '$id_section'";
    $tex_result = mysqli_query($koneksi, $tex_query);
    
    $text = [];
    while ($tex = mysqli_fetch_assoc($tex_result)) {
        $text[] = $tex;
    }
    
    return $text;
}

// get file section
function get_file_by_course_and_section($id_course, $id_section) {
    global $koneksi;
    
    $files_query = "SELECT * FROM materi_file WHERE id_course = '$id_course' AND id_section = '$id_section'";
    $files_result = mysqli_query($koneksi, $files_query);
    
    $file = [];
    while ($files = mysqli_fetch_assoc($files_result)) {
        $file[] = $files;
    }
    
    return $file;
}



//get quiz
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

function get_quiz_byId() {
    global $koneksi;
    $id_quiz = $_GET['id'];
    $sql = "SELECT * FROM quiz WHERE id_quiz = '$id_quiz'";
    $result = mysqli_query($koneksi, $sql);

    $quiz = [];
    while ($file = mysqli_fetch_assoc($result)) {
        $quiz[] = $file;
    }
    return $quiz[0];
}

function total_question_byQuiz($id_quiz) {
    global $koneksi;

    $sql = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM question WHERE id_quiz = '$id_quiz'");
    $result = mysqli_fetch_assoc($sql);
    
    return $result['total'];
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


function get_option_byQuestion($id_question){
    global $koneksi;

    $sql =  mysqli_query($koneksi, "SELECT * FROM quiz_option WHERE id_question = '$id_question'");
    $option = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $option[] = $row;
    }
    return $option;
}


function quiz_answer($answer_data) {
    global $koneksi;
    $id_enroll = $_SESSION["id_enroll"];
    
    // Debug: Print data yang diterima
    echo "<pre>";
    print_r($answer_data);  // Debug untuk melihat data yang diterima
    echo "</pre>";
    
    foreach ($answer_data as $id_question => $answer) {
        $id_quiz_option = $answer['id_quiz_option'];
        $is_right = $answer['is_right'];  // Nilai is_right yang diterima dari form
        
        // Debug: Print nilai sebelum insert
        echo "Question: $id_question, Option: $id_quiz_option, Is Right: $is_right<br>";
        
        $sql = mysqli_query($koneksi, 
            "INSERT INTO quiz_answer (id_enroll, id_quiz_option, is_right) 
             VALUES ('$id_enroll', '$id_quiz_option', '$is_right')"
        );
        
        if (!$sql) {
            echo "<script>alert('Gagal menyimpan jawaban: " . mysqli_error($koneksi) . "');</script>";
            return;
        }
    }
    
    echo "<script>
        alert('Berhasil mengirim jawaban!');
        window.location.href = location.href;
    </script>";
}




//cek apakah enroll course ini?
function isEnrolled($id_student, $id_course) {
    global $koneksi; // Gunakan koneksi global
    $query = "SELECT * FROM enroll WHERE id_student = $id_student AND id_course = $id_course";
    $result = mysqli_query($koneksi, $query);

    // Return true jika data ditemukan, false jika tidak
    return mysqli_num_rows($result) > 0;
}


// cek enroll status
function getEnrollmentStatus($id_student, $id_course) {
    global $koneksi; // Gunakan koneksi global
    $query = "SELECT status FROM enroll WHERE id_student = $id_student AND id_course = $id_course";
    $result = mysqli_query($koneksi, $query);

    // Jika ada data yang ditemukan, kembalikan status
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['status'];
    }
    
    return null; // Tidak terdaftar
}