<?php

session_start();
include dirname(__DIR__).'/koneksi.php';






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
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/_pbl/frontend/src/foto_mentor/' . $profil_picture;


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



function getAll_mentor(){
    global $koneksi;

    $sql = mysqli_query($koneksi, "SELECT * FROM mentor");

    $mentors = [];
    while ($mentor = mysqli_fetch_assoc($sql)) {
        $mentors[] = $mentor;
    }

    return $mentors;

}









?>