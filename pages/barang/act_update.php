<?php
include '../../conn.php';
include '../template/head.php';

$id = $_POST['id'];
$nama_barang = $_POST['nam_bar'];
$barangLama = $_POST['barang_lama'];
$kategori = $_POST['kategori'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$diskon = $_POST['diskon'];
$stok = $_POST['stok'];

$validasi = mysqli_query($conn, "SELECT * FROM tbl_barang WHERE nama_barang='$nama_barang' AND NOT nama_barang='$barangLama' ");
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
    $query = "UPDATE tbl_barang SET nama_barang='$nama_barang', id_kategori='$kategori', harga_beli='$harga_beli', harga_jual='$harga_jual', diskon='$diskon', stok='$stok' WHERE id_barang='$id' ";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
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

include '../template/end.php';
