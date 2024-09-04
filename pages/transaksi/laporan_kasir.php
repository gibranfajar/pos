<?php
session_start();
include('../../conn.php');
include('../../library/function_tgl.php');
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
                    <a class="nav-link collapsed" data-bs-target="#components-nav-users" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav-users" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="../users/create.php">
                                <i class="bi bi-circle"></i><span>Tambah Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="../users/view.php">
                                <i class="bi bi-circle"></i><span>Data Users</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End users Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav-barang" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-plus"></i><span>Barang</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav-barang" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
                    <ul id="components-nav-category" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
                    <a class="nav-link" data-bs-target="#components-nav-laporan" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-card-list"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav-laporan" class="nav-content " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="laporan_transaksi.php">
                                <i class="bi bi-circle"></i><span>Laporan Barang</span>
                            </a>
                        </li>
                        <li>
                            <a href="laporan_kasir.php" class="active">
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
            <h1>Transaksi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Laporan</a></li>
                    <li class="breadcrumb-item active">Laporan Transaksi</li>
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
                                <span class="fw-bold fs-3">Laporan Transaksi</span>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-responsive table-bordered border-dark table-striped text-center mt-2">
                                        <thead>
                                            <tr class="bg-success text-white">
                                                <td>No</td>
                                                <td>Order ID</td>
                                                <td>Nama Barang</td>
                                                <td>Tgl Transaksi</td>
                                                <td>Kasir</td>
                                                <td>Status Transaksi</td>
                                            </tr>
                                        </thead>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($conn, "SELECT tbl_penjualan.*, tbl_penjualan_item.*, tbl_barang.*, tbl_users.*
                                                                      FROM tbl_penjualan JOIN tbl_penjualan_item ON tbl_penjualan_item.no_penjualan=tbl_penjualan.no_penjualan
                                                                                         JOIN tbl_barang ON tbl_penjualan_item.id_barang=tbl_barang.id_barang
                                                                                         JOIN tbl_users ON tbl_penjualan.username=tbl_users.username
                                                                                         GROUP BY tbl_penjualan_item.no_penjualan");
                                        while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['no_penjualan']; ?></td>
                                                    <td><?= $data['nama_barang']; ?></td>
                                                    <td><?= Tanggalindo($data['tgl_transaksi']); ?></td>
                                                    <td><?= $data['nama_lengkap']; ?></td>
                                                    <?php if ($data['status_trx'] == 0) { ?>
                                                        <td><span class="badge bg-success p-2 px-3">Cash</span></td>
                                                    <?php } elseif ($data['status_trx'] == 1) { ?>
                                                        <td><span class="badge bg-primary p-2 px-3">Payment Success</span></td>
                                                    <?php } elseif ($data['status_trx'] == 2) { ?>
                                                        <td><span class="badge bg-warning p-2 px-3">Pending</span></td>
                                                    <?php } elseif ($data['status_trx'] == 3) { ?>
                                                        <td><span class="badge bg-danger p-2 px-3">Denied</span></td>
                                                    <?php } elseif ($data['status_trx'] == 4) { ?>
                                                        <td><span class="badge bg-danger p-2 px-3">Expire</span></td>
                                                    <?php } else { ?>
                                                        <td><span class="badge bg-danger p-2 px-3">Cancle</span></td>
                                                    <?php } ?>
                                                </tr>
                                            </tbody>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </table>
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