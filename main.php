<?php
include('pages/template/head.php');
session_start();
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
                        location.replace('index.php');
                    }
                });
              </script>";
    exit();
}
# Jika sudah benar maka terbentuklah session
else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>POS SYSTEM</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <!-- <link href="assets/img/logoCN.png" rel="icon"> -->

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

        <!-- Animate CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    </head>

    <body>

        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
                <a href="" class="logo d-flex align-items-center">
                    <!-- <img src="assets/img/logoCN.png" alt=""> -->
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
                        <img src="assets/img/user.png" width="40" alt="Profile" class="rounded-circle">
                        <span class="ps-3 fw-bold"><?= $_SESSION['nama_lengkap']; ?></span>
                    </div><!-- End Profile Iamge Icon -->

                    <li class="nav-item">
                        <a class="nav-link " href="main.php">
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
                                <a href="pages/users/create.php">
                                    <i class="bi bi-circle"></i><span>Tambah Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="pages/users/view.php">
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
                                <a href="pages/barang/create.php">
                                    <i class="bi bi-circle"></i><span>Tambah Barang</span>
                                </a>
                            </li>
                            <li>
                                <a href="pages/barang/view.php">
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
                                <a href="pages/kategori/create.php">
                                    <i class="bi bi-circle"></i><span>Tambah Kategori</span>
                                </a>
                            </li>
                            <li>
                                <a href="pages/kategori/view.php">
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
                                <a href="pages/transaksi/laporan_transaksi.php">
                                    <i class="bi bi-circle"></i><span>Laporan Barang</span>
                                </a>
                            </li>
                            <li>
                                <a href="pages/transaksi/laporan_kasir.php">
                                    <i class="bi bi-circle"></i><span>Laporan Kasir</span>
                                </a>
                            </li>
                        </ul>
                    </li><!-- End Dashboard Nav -->

                    <li class="nav-heading">Pages</li>

                    <li class="nav-item">
                        <a class="nav-link collapsed alert_notif" href="logout.php">
                            <span class="me-2">Logout </span>
                            <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </li><!-- End Profile Page Nav -->

                </ul>
            <?php } else { ?>
                <ul class="sidebar-nav" id="sidebar-nav">

                    <div class="d-flex align-items-center mb-3">
                        <img src="assets/img/user.png" width="40" alt="Profile" class="rounded-circle">
                        <span class="ps-3 fw-bold"><?= $_SESSION['nama_lengkap']; ?></span>
                    </div><!-- End Profile Iamge Icon -->

                    <li class="nav-item">
                        <a class="nav-link " href="main.php">
                            <i class="bi bi-grid"></i>
                            <span>Dashboard</span>
                        </a>
                    </li><!-- End Dashboard Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="pages/barang/view.php">
                            <i class="bi bi-layout-text-window"></i>
                            <span>Data Barang</span>
                        </a>
                    </li><!-- End Dashboard Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="pages/transaksi/transaksi.php">
                            <i class="bi bi-cart-check"></i>
                            <span>Transaksi</span>
                        </a>
                    </li><!-- End Dashboard Nav -->



                    <li class="nav-heading">Pages</li>

                    <li class="nav-item">
                        <a class="nav-link collapsed alert_notif" href="logout.php">
                            <span class="me-2">Logout </span>
                            <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </li><!-- End Profile Page Nav -->

                </ul>
            <?php } ?>



        </aside><!-- End Sidebar-->

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-12">
                        <div class="row">

                            <!-- Sales Card -->
                            <div class="col-xxl-12 col-md-12 animate__animated animate__fadeInLeft">
                                <div class="card info-card sales-card">

                                    <div class="card-body">
                                        <h5 class="card-title"><span></span></h5>

                                        <div class="d-flex align-items-center">
                                        </div>
                                        <div class="ps-3">
                                            <h1 class="fw-bold">Welcome <?= $_SESSION["nama_lengkap"]; ?></h1>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($_SESSION['level'] == "kasir") { ?>
                                    <div class="card info-card sales-card animate__animated animate__fadeInUp">

                                        <div class="card-body">
                                            <h2 class="card-title">Laporan Transaksi Customer</h2>

                                            <div class="table-responsive">
                                                <table class="table table-bordered border-dark table-striped text-center mt-2">
                                                    <thead>
                                                        <tr class="bg-secondary text-white">
                                                            <td>No</td>
                                                            <td>Order ID</td>
                                                            <td>Nama Barang</td>
                                                            <td>Harga Jual</td>
                                                            <td>Jumlah</td>
                                                            <td>Tgl Transaksi</td>
                                                            <td>Status Transaksi</td>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    include("conn.php");
                                                    include("library/function_tgl.php");

                                                    $no = 1;
                                                    $tgl = date("Y-m-d");

                                                    $query = mysqli_query($conn, "SELECT tbl_penjualan.*, tbl_penjualan_item.*, tbl_barang.*
                                                                                     FROM tbl_penjualan JOIN tbl_penjualan_item ON tbl_penjualan.no_penjualan = tbl_penjualan_item.no_penjualan
                                                                                                        JOIN tbl_barang ON tbl_penjualan_item.id_barang = tbl_barang.id_barang
                                                                                                        WHERE tbl_penjualan.username='$_SESSION[username]' AND tbl_penjualan.tgl_transaksi='$tgl'
                                                                                                        ORDER BY tbl_penjualan_item.id_barang DESC");
                                                    while ($data = mysqli_fetch_array($query)) { ?>
                                                        <tbody>
                                                            <tr>
                                                                <td><?= $no; ?></td>
                                                                <td><?= $data['no_penjualan']; ?></td>
                                                                <td><?= $data['nama_barang']; ?></td>
                                                                <td><?= $data['harga_jual']; ?></td>
                                                                <td><?= $data['jumlah']; ?></td>
                                                                <td> <?= Tanggalindo($data['tgl_transaksi']); ?></td>
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
                                                    } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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

        <!-- Vendor JS Files -->
        <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/chart.js/chart.umd.js"></script>
        <script src="assets/vendor/echarts/echarts.min.js"></script>
        <script src="assets/vendor/quill/quill.min.js"></script>
        <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script>
            $('.alert_notif').on('click', function() {
                var getLink = $(this).attr('href');
                Swal.fire({
                    title: 'Apakah kamu yakin ingin keluar?',
                    text: "Anda harus login ulang untuk bisa masuk ke halaman ini lagi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Keluar!'
                }).then(result => {
                    if (result.isConfirmed) {
                        window.location.href = getLink
                    }
                })
                return false;
            });
        </script>

    </body>

    </html>


<?php } ?>