<?php
include('../../conn.php');
include('../template/head.php');

$nama_barang = $_POST['nam_bar'];
$kategori = $_POST['kategori'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$diskon = $_POST['diskon'];
$stok = $_POST['stok'];

$validasi = mysqli_query($conn, "SELECT * FROM tbl_barang WHERE nama_barang='$nama_barang' ");
$row = mysqli_num_rows($validasi);
if ($row > 0) {
    echo "<script>
                Swal.fire({
                    title: 'Opss, Barang sudah terdaftar!',
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

    $query = "INSERT INTO tbl_barang VALUES('','$nama_barang','$kategori','$harga_beli','$harga_jual','$diskon','$stok')";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
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
