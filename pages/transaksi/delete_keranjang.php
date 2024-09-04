<?php
include("../template/head.php");
include '../../conn.php';

$id = $_GET['id'];

$query = "DELETE FROM tbl_keranjang WHERE id='$id' ";
$hasil = mysqli_query($conn, $query);

if ($hasil) {
    echo "<script type='text/javascript'>
            Swal.fire({
                position : 'top',
                title: 'Hapus data berhasil!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then(result => {
                if (result.isConfirmed) {
                    window.location='transaksi.php'
                }
            });
          </script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

include("../template/end.php");
