<?php
include('../../conn.php');
include('../template/head.php');

$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM tbl_kategori WHERE id_kategori='$id' ");
if ($query) {
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
}

include('../template/end.php');
