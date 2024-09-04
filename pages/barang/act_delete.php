<?php
include '../../conn.php';
include '../template/head.php';

$id = $_GET['id'];
$query = "DELETE FROM tbl_barang WHERE id_barang='$id'";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>
    Swal.fire({
        title: 'Hapus data berhasil!',
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
    echo "Error updating record: " . mysqli_error($conn);
}

include '../template/end.php';
