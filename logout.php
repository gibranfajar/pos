<?php
include("pages/template/head.php");
session_start();
session_destroy();
// echo "<script>alert('Anda telah keluar dari halaman dashboard'); window.location = 'index.php'</script>";
echo "<script>
                Swal.fire({
                    title: 'Anda telah keluar dari halaman dashboard',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then(result => {
                    if (result.isConfirmed) {
                        window.location='index.php'
                    }
                });
</script>";
include("pages/template/end.php");
