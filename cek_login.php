<?php
include("pages/template/head.php");
include "conn.php";
//error_reporting(0);
date_default_timezone_set('ASIA/JAKARTA');
if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query    = "SELECT * FROM tbl_users WHERE username = '$username' ";
    $result = mysqli_query($conn, $query);
    $dataLogin   = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) > 0) {
        if (password_verify($password, $dataLogin['password'])) {
            session_start();
            # session variabel users
            $_SESSION['id'] = $dataLogin['id'];
            $_SESSION['username'] = $dataLogin['username'];
            $_SESSION['password'] = $dataLogin['password'];
            $_SESSION['nama_lengkap'] = $dataLogin['nama_lengkap'];
            $_SESSION['level'] = $dataLogin['level'];

            echo "<script>
                Swal.fire({
                    title: 'Login Behasil',
                    text: 'Welcome $dataLogin[nama_lengkap]',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then(result => {
                    if (result.isConfirmed) {
                        window.location='main.php'
                    }
                });
              </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Username atau Password Salah!',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then(result => {
                    if (result.isConfirmed) {
                        history.go(-1)
                    }
                });
              </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Username yang anda masukan tidak terdaftar!',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then(result => {
                    if (result.isConfirmed) {
                        history.go(-1)
                    }
                });
              </script>";
    }
} else {
    echo "<script>
                Swal.fire({
                    title: 'Pencet dulu tombolnya!',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then(result => {
                    if (result.isConfirmed) {
                        history.go(-1)
                    }
                });
              </script>";
}

include("pages/template/end.php");
