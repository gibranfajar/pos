<?php
include('../../conn.php');
include('../template/head.php');

$nama_kategori = $_POST['nama_kategori'];

$validasi = mysqli_query($conn, "SELECT * FROM tbl_kategori WHERE nama_kategori='$nama_kategori' ");
$row = mysqli_num_rows($validasi);
if ($row > 0) {
    echo "<script>
                Swal.fire({
                    title: 'Opss, Kategori sudah terdaftar!',
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

    $query = "INSERT INTO tbl_kategori SET nama_kategori='$nama_kategori'";
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
include('../template/end.php');
