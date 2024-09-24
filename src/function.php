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

    // insert ke database

    // 1. Ke tabel user
    $ke_user = mysqli_query($koneksi, "INSERT INTO user (id_user, username, email, password, role) VALUES (NULL, '$username', '$email', '$password', 'student')");
    if ($ke_user) {
        echo "<script>alert('Berhasil update data ke user')</script>";
    }
    

    // 2. Ke tabel student
    $id_dari_user = mysqli_insert_id($koneksi);
        
    $sql = mysqli_query($koneksi, "INSERT INTO student (id_student, nama_lengkap) VALUES ('$id_dari_user', '$name')");
    if ($sql) {
        echo "<script>alert('Register Success!'); window.location.href='login.php';</script>";
        return mysqli_affected_rows($koneksi);
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
                        window.location.href= 'mentor/index.php'
                    </script>";
            exit;
            } else {
                echo"<script>
                        alert('Login success !');
                        window.location.href= 'admin/index.php'
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














// ------------------------------------------------------------HOME PAGE-------------------------------------------------------


//get all course
function getAll_Course(){
    global $koneksi;

    $sql = mysqli_query($koneksi, "SELECT * FROM course");

    $courses = [];
    while ($course = mysqli_fetch_assoc($sql)) {
        $courses[] = $course;
    }

    return $courses;

}
