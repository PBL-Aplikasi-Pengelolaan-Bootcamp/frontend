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
        "SELECT * FROM user WHERE id_user = '$id_user'"
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


//edit mentor
function edit_mentor($data)
{
    global $koneksi;

    $id_mentor = $_GET['id'];
    $username = strtolower(stripslashes($data['username']));
    $email = $data['email'];
    $name = $data['name'];
    $bio = $data['bio'];
    $expertise = $data['expertise'];
    $telp = $data['phone'];
    
    // Ambil password lama dan baru
    $old_password = $data['old_password'];
    $new_password = $data['new_password'];
    
    // Cek apakah password lama diisi dan password baru diisi
    if (!empty($old_password) && !empty($new_password)) {
        // Cek apakah password lama cocok dengan yang ada di database
        $check_password = mysqli_query($koneksi, "SELECT password FROM user WHERE id_user = '$id_mentor'");
        $data_password = mysqli_fetch_assoc($check_password);
        
        if (password_verify($old_password, $data_password['password'])) {
            // Jika password lama cocok, enkripsi password baru
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password di tabel user
            $update_password = mysqli_query($koneksi, "UPDATE user SET password = '$new_password_hash' WHERE id_user = '$id_mentor'");
            if (!$update_password) {
                echo "<script>alert('Gagal memperbarui password');</script>";
                return false;
            }
        } else {
            echo "<script>alert('Password lama tidak cocok');</script>";
            return false;
        }
    }

    // Cek apakah ada file gambar profil baru
    $profil_picture = $_FILES['profil_picture']['name'];
    $tmpname = $_FILES['profil_picture']['tmp_name'];
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/pbl/frontend/src/foto_mentor/' . $profil_picture;

    // Update data pada tabel user
    $update_user = mysqli_query($koneksi, "UPDATE user SET username = '$username', email = '$email' WHERE id_user = '$id_mentor'");
    if (!$update_user) {
        echo "<script>alert('Gagal memperbarui data user');</script>";
        return false;
    }

    // Update data pada tabel mentor
    if (!empty($profil_picture)) {
        // Jika ada file profil baru, pindahkan file dan perbarui kolom profil_picture
        if (move_uploaded_file($tmpname, $folder)) {
            $update_mentor = mysqli_query($koneksi, "UPDATE mentor SET name = '$name', bio = '$bio', expertise = '$expertise', telp = '$telp', profil_picture = '$profil_picture' WHERE id_mentor = '$id_mentor'");
            if (!$update_mentor) {
                echo "<script>alert('Gagal memperbarui data mentor');</script>";
                return false;
            }
        } else {
            echo "<script>alert('Gagal mengupload file profil baru');</script>";
            return false;
        }
    } else {
        // Jika tidak ada file profil baru, hanya perbarui data lainnya
        $update_mentor = mysqli_query($koneksi, "UPDATE mentor SET name = '$name', bio = '$bio', expertise = '$expertise', telp = '$telp' WHERE id_mentor = '$id_mentor'");
        if (!$update_mentor) {
            echo "<script>alert('Gagal memperbarui data mentor');</script>";
            return false;
        }
    }

    echo "<script>alert('Data mentor berhasil diperbarui!'); window.location.href='dashboard-admin.php';</script>";
    return true;
}

function delete_mentor() {
    global $koneksi;
    $id_mentor = $_GET['id'];
    
    // Mulai transaksi
    mysqli_begin_transaction($koneksi);
    
    try {
        // Hapus data terkait di tabel lain
        mysqli_query($koneksi, "DELETE FROM course WHERE id_mentor = '$id_mentor'");
        
        // Hapus data mentor
        $sql = mysqli_query($koneksi, "DELETE FROM mentor WHERE id_mentor = '$id_mentor'");
        
        // Commit transaksi jika semua berhasil
        mysqli_commit($koneksi);


        return mysqli_affected_rows($koneksi);
        echo "<script>alert('Mentor di hapus'); window.location.href='mentor.php'</script>";    
    } catch (Exception $e) {
        // Rollback transaksi jika ada kesalahan
        mysqli_rollback($koneksi);

        // Kembalikan error atau log pesan
        return false;
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

// get course mentor
function get_mentor_course() {
    global $koneksi;
    $id_mentor = $_GET['id'];
        $sql = "SELECT * FROM course WHERE id_mentor = '$id_mentor'";
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
function get_mentor_byId() {
    global $koneksi;
    $id_mentor = $_GET['id'];

    // Query untuk join tabel mentor dan user berdasarkan id_mentor dan id_user
    $sql = mysqli_query($koneksi, "
        SELECT * 
        FROM mentor m
        JOIN user u ON m.id_mentor = u.id_user
        WHERE m.id_mentor = '$id_mentor'
    ");
    
    $mentor = mysqli_fetch_assoc($sql);
    return $mentor;
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

//get student detail
function get_student_byId() {
    global $koneksi;
    $id_student = $_GET['id'];

    // Query untuk join tabel student dan user berdasarkan id_student dan id_user
    $sql = mysqli_query($koneksi, "
        SELECT * 
        FROM student s
        JOIN user u ON s.id_student = u.id_user
        WHERE s.id_student = '$id_student'
    ");
    
    $student = mysqli_fetch_assoc($sql);
    return $student;
}


//logout
function logout(){
    session_unset();
    session_destroy();
    echo "<script>alert('Logout'); window.location.href='../login.php'</script>";
}







?>