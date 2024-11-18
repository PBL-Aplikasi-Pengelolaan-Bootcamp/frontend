<?php

session_start();
include dirname(__DIR__).'/koneksi.php';


//get data login session
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
        "SELECT * FROM user"
    );

    // Periksa jika ada hasil yang ditemukan
    if (mysqli_num_rows($sql) > 0) {
        return mysqli_fetch_assoc($sql); // Ambil data sebagai array asosiatif
    } else {
        return null; // Kembalikan null jika tidak ada data
    }
}

//edit profil admin
function edit_profil($data, $id_user) {
    global $koneksi;

    // Ambil data dari form
    $username = strtolower(stripslashes($data['username']));
    $old_password = mysqli_real_escape_string($koneksi, $data['old_password'] ?? '');
    $new_password = mysqli_real_escape_string($koneksi, $data['new_password'] ?? '');
    $isPasswordChanged = !empty($old_password) && !empty($new_password);

    // Ambil password lama dari database
    $result = mysqli_query($koneksi, "SELECT password FROM user WHERE id_user = '$id_user'");
    $user = mysqli_fetch_assoc($result);

    if ($isPasswordChanged) {
        // Validasi jika password lama tidak cocok
        if (!$user || !password_verify($old_password, $user['password'])) {
            echo "<script>alert('Password lama tidak sesuai!');</script>";
            return false;
        }

        // Enkripsi password baru
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    }

    // Query untuk update username (selalu dilakukan)
    $query = "UPDATE user SET username = '$username'";
    
    // Jika password baru diinput, tambahkan ke query
    if ($isPasswordChanged) {
        $query .= ", password = '$new_password_hashed'";
    }
    
    $query .= " WHERE id_user = '$id_user'";

    // Eksekusi query update
    $updateUser = mysqli_query($koneksi, $query);

    // Cek apakah update berhasil
    if ($updateUser) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Profil berhasil diperbarui!'); window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('Gagal memperbarui profil.');</script>";
    }
}






// register mentor
function create_mentor($data)
{
    global $koneksi;

    $username = strtolower(stripslashes($data['username']));
    $email = $data['email'];
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $role = "mentor";

    $name = $data['name'];
    $bio = $data['bio'];
    $expertise = $data['expertise'];
    $telp = $data['telp'];
    // $profil_picture = $data['profil_picture'];

    $profil_picture = $_FILES['profil_picture']['name'];
    $tmpname = $_FILES['profil_picture']['tmp_name'];
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/pbl/frontend/src/foto_mentor/' . $profil_picture;

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



    // insert ke database
    // 1. Ke tabel user
    $ke_user = mysqli_query($koneksi, "INSERT INTO user (id_user, username, email, password, role) VALUES (NULL, '$username', '$email', '$password', '$role')");
    if ($ke_user) {
        echo "<script>alert('Berhasil update data ke user')</script>";
    }
    

    // 2. Ke tabel mentor
    $id_dari_user = mysqli_insert_id($koneksi);

    if  (move_uploaded_file($tmpname, $folder)) {
        $sql = mysqli_query($koneksi, "INSERT INTO mentor (id_mentor, name, bio, expertise, telp, profil_picture) VALUES ('$id_dari_user', '$name', '$bio', '$expertise', '$telp', '$profil_picture')");
        if ($sql) {
            echo "<script>alert('Register Success!'); window.location.href='dashboard-admin.php';</script>";
            // return mysqli_affected_rows($koneksi);
        } else {
            echo "<script>alert('gagal')</script>";
        }

    } else {
        // Jika gagal mengupload file
        echo "<script>alert('Gagal mengupload file');</script>";
    }
    
}



// get all course
function getAll_Course() {
    global $koneksi;
        $sql = "SELECT * FROM course";

    $result = mysqli_query($koneksi, $sql);
    $courses = [];
    while ($course = mysqli_fetch_assoc($result)) {
        $courses[] = $course;
    }
    return $courses;
}



// get all mentor
function getAll_mentor(){
    global $koneksi;
    $sql = mysqli_query($koneksi, "SELECT * FROM mentor");
    $mentors = [];
    while ($mentor = mysqli_fetch_assoc($sql)) {
        $mentors[] = $mentor;
    }
    return $mentors;
}

//get mentor detail
function get_mentor_byId(){
    global $koneksi;
    $id_mentor = $_GET['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM mentor WHERE id_mentor = '$id_mentor'");
    $mentors = [];
    while ($mentor = mysqli_fetch_assoc($sql)) {
        $mentors[] = $mentor;
    }
    return $mentors;
}

// get all student
function getAll_student(){
    global $koneksi;
    $sql = mysqli_query($koneksi, "SELECT * FROM student");
    $students = [];
    while ($student = mysqli_fetch_assoc($sql)) {
        $students[] = $student;
    }
    return $students;
}


//logout
function logout(){
    session_unset();
    session_destroy();
    echo "<script>alert('Logout'); window.location.href='../login.php'</script>";
}







?>