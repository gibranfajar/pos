<?php
include("../../conn.php");
include("../template/head.php");

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$nama_lengkap = $_POST['nama_lengkap'];
$level = $_POST['level'];

$validasi = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username='$username' ");
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

    $query = "INSERT INTO tbl_users VALUES('','$username','$password','$nama_lengkap','$level')";
    $hasil = mysqli_query($conn, $query);

    if ($hasil) {
        echo "<script>
                    Swal.fire({
                        title: 'Simpan data berhasil!',
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
include("../template/end.php");
