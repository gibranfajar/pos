<?php
session_start();
include("../template/head.php");

if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    # code... Jika users belum login!
    echo "<script>
                Swal.fire({
                    title: 'Oppss, Login dahulu!',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then(result => {
                    if (result.isConfirmed) {
                        location.replace('../../index.php');
                    }
                });
              </script>";
    exit();
}
# Jika sudah benar maka terbentuklah session
else {
?>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="" class="logo d-flex align-items-center">
                <!-- <img src="../../assets/img/logoCN.png" alt="logo"> -->
                <span class="d-lg-block">POS SYSTEM</span>
            </a>
        </div> <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <i class="d-lg-none bi bi-list toggle-sidebar-btn me-2"></i>
            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <?php if ($_SESSION["level"] == "admin") { ?>
            <ul class="sidebar-nav" id="sidebar-nav">

                <div class="d-flex align-items-center mb-3">
                    <img src="../../assets/img/user.png" width="40" alt="Profile" class="rounded-circle">
                    <span class="ps-3 fw-bold"><?= $_SESSION['nama_lengkap']; ?></span>
                </div><!-- End Profile Iamge Icon -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="../../main.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="create.php" class="active">
                                <i class="bi bi-circle"></i><span>Tambah Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="view.php">
                                <i class="bi bi-circle"></i><span>Data Users</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav-barang" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-plus"></i><span>Barang</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav-barang" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="../barang/create.php">
                                <i class="bi bi-circle"></i><span>Tambah Barang</span>
                            </a>
                        </li>
                        <li>
                            <a href="../barang/view.php">
                                <i class="bi bi-circle"></i><span>Data Barang</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End items Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav-category" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-plus"></i><span>Kategori</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav-category" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="../kategori/create.php">
                                <i class="bi bi-circle"></i><span>Tambah Kategori</span>
                            </a>
                        </li>
                        <li>
                            <a href="../kategori/view.php">
                                <i class="bi bi-circle"></i><span>Data Kategori</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End items Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav-laporan" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-card-list"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav-laporan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="../transaksi/laporan_transaksi.php">
                                <i class="bi bi-circle"></i><span>Laporan Barang</span>
                            </a>
                        </li>
                        <li>
                            <a href="../transaksi/laporan_kasir.php">
                                <i class="bi bi-circle"></i><span>Laporan Kasir</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Dashboard Nav -->

                <li class="nav-heading">Pages</li>

                <li class="nav-item">
                    <a class="nav-link collapsed alert_notif" href="../../logout.php">
                        <span class="me-2">Logout </span>
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </li><!-- End Profile Page Nav -->

            </ul>
        <?php } else { ?>

        <?php } ?>



    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Users</a></li>
                    <li class="breadcrumb-item active">Tambah Users</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-12 col-md-12">
                            <div class="card info-card p-3 mb-5 animate__animated animate__fadeInLeft">
                                <span class="fw-bold fs-3">Tambah Users</span>
                                <hr>
                                <div class="col-md-8">
                                    <form action="act_create.php" method="POST">
                                        <div class="mb-3">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lengkap" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Level</label>
                                            <br>
                                            <input type="radio" class="form-check-input" name="level" value="admin"> Admin
                                            <input type="radio" class="form-check-input" name="level" value="kasir" checked> Kasir
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary w-25 d-block">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                </div>
            </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer fixed-bottom bg-light">
        <div class="copyright">
            &copy; Copyright <strong><span>POS SYSTEM</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?php include("../template/end.php"); ?>
<?php } ?>