<?php
include("../../conn.php");
include("../template/head.php");

$id = $_POST['id'];
$username = $_POST['username'];
$userLama = $_POST['userLama'];
$password = $_POST['password'];
$nama_lengkap = $_POST['nama_lengkap'];
$level = $_POST['level'];

$validasi = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username='$username' AND NOT username='$userLama' ");
$row = mysqli_num_rows($validasi);
if ($row > 0) {
    echo "<script>
                Swal.fire({
                    title: 'Opss, User sudah terdaftar!',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then(result => {
                    if (result.isConfirmed) {
                        history.go(-1);
                    }
                });
            </script>";
} else {

    if ($password == "") {
        $query = "UPDATE tbl_users SET username='$username', nama_lengkap='$nama_lengkap', level='$level' WHERE id='$id' ";
        $hasil = mysqli_query($conn, $query);
    
        if ($hasil) {
            echo "<script>
            Swal.fire({
                title: 'Ubah data berhasil!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then(result => {
                if (result.isConfirmed) {
                    window.location='view.php'
                }
            });
            </script>";
        } else {
            echo "Error updating record: " . mysqli_error($koneksi);
        }
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
        $query = "UPDATE tbl_users SET username='$username', password='$password_hash', nama_lengkap='$nama_lengkap', level='$level' WHERE id='$id' ";
        $hasil = mysqli_query($conn, $query);
    
        if ($hasil) {
            echo "<script>
            Swal.fire({
                        title: 'Ubah data berhasil!',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then(result => {
                        if (result.isConfirmed) {
                            window.location='view.php'
                        }
                    });
                    </script>";
        } else {
            echo "Error updating record: " . mysqli_error($koneksi);
        }
    }
}
include("../template/end.php");
