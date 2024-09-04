<?php
include("../../conn.php");
include("../template/head.php");

$id = $_GET['id'];

$query = "DELETE FROM tbl_users WHERE id='$id' ";
$hasil = mysqli_query($conn, $query);

if ($hasil) {
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
    echo "Error updating record: " . mysqli_error($koneksi);
}
include("../template/end.php");
