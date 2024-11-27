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
//koneksi ke mysql
include 'koneksi.php';

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
   
    

    // 2. Ke tabel student
    $id_dari_user = mysqli_insert_id($koneksi);
        
    $sql = mysqli_query($koneksi, "INSERT INTO student (id_student, name) VALUES ('$id_dari_user', '$name')");
    if ($sql) {
        iziToastAlert('success', 'Register Berhasil !', 'login.php');
        return mysqli_affected_rows($koneksi);
    }
}




// function edit profil
function edit_profil($data, $id_user) {
    global $koneksi;

    // Ambil data form
    $username = strtolower(stripslashes($data['username']));
    $email = strtolower(stripslashes($data['email']));
    $name = mysqli_real_escape_string($koneksi, $data['name']);
    $birth = mysqli_real_escape_string($koneksi, $data['birth']);
    $telp = mysqli_real_escape_string($koneksi, $data['telp']);
    $old_password = mysqli_real_escape_string($koneksi, $data['old_password'] ?? '');
    $new_password = mysqli_real_escape_string($koneksi, $data['new_password'] ?? '');
    $isPasswordChanged = !empty($old_password) && !empty($new_password);

    // Penanganan upload foto profil
    $img = $_FILES['profil_picture']['name'];
    $tmp = $_FILES['profil_picture']['tmp_name'];
    $imgFolder = "foto_student/";
    $imgPath = $imgFolder . $img;

    // Validasi perubahan password
    if ($isPasswordChanged) {
        // Ambil password lama dari database
        $result = mysqli_query($koneksi, "SELECT password FROM user WHERE id_user = '$id_user'");
        $user = mysqli_fetch_assoc($result);

        // Validasi password lama
        if (!$user || !password_verify($old_password, $user['password'])) {
            echo "<script>alert('Password lama tidak sesuai!');</script>";
            return false;
        }

        // Enkripsi password baru
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    }

    // Update tabel student
    if ($img) {
        if (move_uploaded_file($tmp, $imgPath)) {
            $updateStudent = mysqli_query($koneksi,
                "UPDATE student 
                 SET name = '$name', birth = '$birth', telp = '$telp', profil_picture = '$img' 
                 WHERE id_student = '$id_user'");
        } else {
            echo "<script>alert('Gagal upload foto.');</script>";
            return false;
        }
    } else {
        $updateStudent = mysqli_query($koneksi,
            "UPDATE student 
             SET name = '$name', birth = '$birth', telp = '$telp' 
             WHERE id_student = '$id_user'");
    }

    // Update tabel user
    $query = "UPDATE user SET username = '$username', email = '$email'";
    if ($isPasswordChanged) {
        $query .= ", password = '$new_password_hashed'";
    }
    $query .= " WHERE id_user = '$id_user'";

    $updateUser = mysqli_query($koneksi, $query);

    // Cek apakah update berhasil
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
                iziToastAlert('success', 'Login Berhasil!', 'index.php');

            exit;

            } else if ($data_from_username['role'] == 'mentor'){
                iziToastAlert('success', 'Login Berhasil!', 'mentor/dashboard-mentor.php');

            exit;
            } else {
                iziToastAlert('success', 'Login Berhasil!', 'admin/dashboard-admin.php');

                exit;
            }
                
        } else {
            iziToastAlert('error', 'Password Salah !');
        }
    } else {
        iziToastAlert('error', 'Username Salah !');
    }
}





// logout function
function logout(){
    session_unset();
    session_destroy();
    iziToastAlert('success', 'Logout !', 'login.php');
    // echo"<script>window.location.reload()</script>";
    exit;
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
    if (!isset($_SESSION['id_user']) || !$_SESSION['id_user']) {
        return false; // Jika tidak ada session id_user, fungsi tidak dijalankan
    }
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

function get_score($id_quiz){
    global $koneksi;
    
    $id_enroll = $_SESSION['id_enroll'];
    $sql = mysqli_query($koneksi, "SELECT * FROM quiz_submission WHERE id_enroll = '$id_enroll' AND id_quiz = $id_quiz");
    $result = mysqli_fetch_assoc($sql);
    return $result;
}

function get_score2($id_quiz) {
    global $koneksi;
    
    $id_enroll = $_SESSION['id_enroll'];
    $sql = "SELECT * FROM quiz_submission WHERE id_enroll = '$id_enroll' AND id_quiz = $id_quiz ORDER BY id_quiz_submission DESC";
    $result = mysqli_query($koneksi, $sql);

    return mysqli_fetch_assoc($result); // Mengembalikan satu baris
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
    
    // Mendapatkan id_course dan slug kursus
    $query_enroll = mysqli_query($koneksi, "SELECT id_course FROM enroll WHERE id_enroll = '$id_enroll'");
    $result_enroll = mysqli_fetch_assoc($query_enroll);
    $id_course = $result_enroll['id_course'];
    
    $query_course = mysqli_query($koneksi, "SELECT slug FROM course WHERE id_course = '$id_course'");
    $result_course = mysqli_fetch_assoc($query_course);
    $slug = $result_course['slug'];

    $total_questions = count($answer_data);
    $correct_answers = 0;

    // Mendapatkan id_question pertama dari array answer_data
    $first_question_id = array_key_first($answer_data);

    // Mendapatkan id_quiz berdasarkan id_question pertama
    $query_quiz = mysqli_query($koneksi, "SELECT id_quiz FROM question WHERE id_question = '$first_question_id'");
    $result_quiz = mysqli_fetch_assoc($query_quiz);
    $id_quiz = $result_quiz['id_quiz'];

    // Memproses jawaban
    foreach ($answer_data as $id_question => $answer) {
        $id_quiz_option = $answer['id_quiz_option'];
        $is_right = $answer['is_right'];

        if ($is_right) {
            $correct_answers++;
        }

        $sql = mysqli_query($koneksi, 
            "INSERT INTO quiz_answer (id_enroll, id_quiz_option, is_right) 
             VALUES ('$id_enroll', '$id_quiz_option', '$is_right')"
        );

        if (!$sql) {
            echo "<script>alert('Gagal menyimpan jawaban: " . mysqli_error($koneksi) . "');</script>";
            return;
        }
    }

    // Menghitung skor dan menyimpan submission
    $score = ($correct_answers / $total_questions) * 100;

    $insert_submission = mysqli_query($koneksi, 
        "INSERT INTO quiz_submission (id_enroll, id_quiz, score) 
         VALUES ('$id_enroll', '$id_quiz', '$score')"
    );

    if (!$insert_submission) {
        echo "<script>alert('Gagal menyimpan submission: " . mysqli_error($koneksi) . "');</script>";
        return;
    }

    // Redirect setelah berhasil
    echo "<script>
        alert('Berhasil mengirim jawaban!');
        window.location.href = 'kursus_materi.php?kursus=$slug';
    </script>";
}




function count_quiz_by_course() {
    global $koneksi;
    $slug= $_GET['kursus'];

    $query = "SELECT id_course FROM course WHERE slug = '$slug' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $id_course = $row['id_course'];}
        
    $query = mysqli_query($koneksi, 
            "SELECT COUNT(q.id_quiz) AS total_quiz
            FROM quiz q
            JOIN section cs ON q.id_section = cs.id_section
            WHERE cs.id_course = '$id_course'"
    );
    $result = mysqli_fetch_assoc($query);
    return $result['total_quiz'];
}

function count_submission_by_course_and_enroll() {
    global $koneksi;
    $slug = $_GET['kursus'];
    $id_enroll = $_SESSION['id_enroll'];
    $query = "SELECT id_course FROM course WHERE slug = '$slug' LIMIT 1";
    $result = mysqli_query($koneksi, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $id_course = $row['id_course'];
    }
    $query = mysqli_query($koneksi, 
        "SELECT COUNT(DISTINCT qs.id_quiz) AS total_submission
         FROM quiz_submission qs
         JOIN quiz q ON qs.id_quiz = q.id_quiz
         JOIN section cs ON q.id_section = cs.id_section
         WHERE cs.id_course = '$id_course' AND qs.id_enroll = '$id_enroll'"
    );
    $result = mysqli_fetch_assoc($query);
    return $result['total_submission'];
}

function is_all_quiz_submitted_by_enroll() {
    global $koneksi;
    $slug = $_GET['kursus'];
    $id_enroll = $_SESSION['id_enroll'];

    // Ambil id_course berdasarkan slug
    $query = "SELECT id_course FROM course WHERE slug = '$slug' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $id_course = $row['id_course'];
    } else {
        return false; // jika id_course tidak ditemukan
    }

    // Hitung total quiz di course
    $query = mysqli_query($koneksi, 
        "SELECT COUNT(q.id_quiz) AS total_quiz
         FROM quiz q
         JOIN section cs ON q.id_section = cs.id_section
         WHERE cs.id_course = '$id_course'"
    );
    $result = mysqli_fetch_assoc($query);
    $total_quiz = $result['total_quiz'];

    // Hitung total submission berdasarkan course dan id_enroll
    $query = mysqli_query($koneksi, 
        "SELECT COUNT(DISTINCT qs.id_quiz) AS total_submission
         FROM quiz_submission qs
         JOIN quiz q ON qs.id_quiz = q.id_quiz
         JOIN section cs ON q.id_section = cs.id_section
         WHERE cs.id_course = '$id_course' AND qs.id_enroll = '$id_enroll'"
    );
    $result = mysqli_fetch_assoc($query);
    $total_submission = $result['total_submission'];

    // Jika semua quiz sudah dikumpulkan, update status menjadi 'complete'
    if ($total_submission === $total_quiz) {
        $update_query = "UPDATE enroll SET status = 'complete' WHERE id_enroll = '$id_enroll' AND id_course = '$id_course'";
        mysqli_query($koneksi, $update_query);
        return true;
    }

    return false;
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

?>



</body>

</html>