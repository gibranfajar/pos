<?php
session_start();
include("../template/head.php");
date_default_timezone_set('Asia/Jakarta');

include '../../conn.php';
# BUTTON DARI FORM
if ($_POST) {
    # jika klik tombol pilih
    if (isset($_POST['btnTambah'])) {
        #variabel
        $id_barang = $_POST['id_barang'];
        $jumlah = $_POST['jumlah'];
        #query ke tabel barang
        $brgQuery = "SELECT * FROM tbl_barang WHERE id_barang='$id_barang'";
        $brgHasil = mysqli_query($conn, $brgQuery);
        $brgData = mysqli_fetch_array($brgHasil);
        $brgQty = mysqli_num_rows($brgHasil);

        if ($jumlah > $brgData['stok']) {
            echo "<script type='text/javascript'>
                    swal.fire('Opss, Stok barang kurang!', '', 'warning');
                  </script>";
        } else {
            if ($brgQty >= 1) {
                #hitung diskon dan harga setelah diskon
                $besarDiskon = intval($brgData['harga_jual']) * (intval($brgData['diskon']) / 100);
                $hargaDiskon = intval($brgData['harga_jual']) - $besarDiskon;

                $krgQuery = "INSERT INTO tbl_keranjang SET  id_barang = '$id_barang',
                                                        harga_jual = '$hargaDiskon',
                                                        qty = '$jumlah',
                                                        username = '$_SESSION[username]'";

                $result = mysqli_query($conn, $krgQuery);

                echo "<script type='text/javascript'>
                        Swal.fire({
                            position : 'top',
                            title: 'Input data berhasil!'
                        });
                    </script>";
            } else {
                echo "<script type='text/javascript'>
                    swal.fire('Silahkan ganti id/nama barang', '', 'warning');
                  </script>";
            }
        }
    }

    if (isset($_POST['btnPayment'])) {
        $no_penjualan = rand(10000, 99999); //nomor acak

        $cekKrg = "SELECT COUNT(*) AS qty FROM tbl_keranjang WHERE username='$_SESSION[username]'";
        $result = mysqli_query($conn, $cekKrg);
        $krgRow = mysqli_fetch_array($result);
        if ($krgRow['qty'] <= 0) {
            echo "<script type='text/javascript'>
                    swal.fire('Belum ada item barang, Minimal 1!', '', 'warning');
                  </script>";
        } else {
            $queryPenjualan = mysqli_query($conn, "INSERT INTO tbl_penjualan SET no_penjualan='$no_penjualan',
                                                                                 tgl_transaksi=now(), 
                                                                                 status_trx ='1', 
                                                                                 username='$_SESSION[username]'");
            if ($queryPenjualan) {
                # ambil data dari keranjang belanja
                $cekKrg = "SELECT * FROM tbl_keranjang WHERE username='$_SESSION[username]'";
                $result = mysqli_query($conn, $cekKrg);
                while ($krgRow = mysqli_fetch_array($result)) {
                    # insert data ke tabel penjualan_item
                    $queryItem = "INSERT INTO tbl_penjualan_item SET no_penjualan='$no_penjualan',
                                                                     id_barang = '$krgRow[id_barang]',
                                                                     harga_jual = '$krgRow[harga_jual]',
                                                                     jumlah = '$krgRow[qty]'";
                    mysqli_query($conn, $queryItem);
                    # update stok di tabel barang
                    $queryBarang = "UPDATE tbl_barang SET stok=stok - $krgRow[qty] WHERE id_barang = '$krgRow[id_barang]'";
                    mysqli_query($conn, $queryBarang);
                }
                //kosongkan di tabel keranjang jika data sudah di move
                mysqli_query($conn, "DELETE FROM tbl_keranjang WHERE username ='$_SESSION[username]'");
            }
            echo "<meta http-equiv='refresh' content='0;url=../../vendor/midtrans/midtrans-php/examples/snap/checkout-process-simple-version.php?no_penjualan=$no_penjualan'>";
        }
    }

    # jika klik tombol Bayar
    if (isset($_POST['btnCash'])) {
        $no_penjualan = rand(10000, 99999); //nomor acak
        $total = $_POST['total'];
        $bayar = $_POST['bayar'];
        $cekKrg = "SELECT COUNT(*) AS qty FROM tbl_keranjang WHERE username='$_SESSION[username]'";
        $result = mysqli_query($conn, $cekKrg);
        $krgRow = mysqli_fetch_assoc($result);
        if ($krgRow['qty'] <= 0) {
            echo "<script type='text/javascript'>
                    swal.fire('Belum ada item barang, Minimal 1!', '', 'warning');
                  </script>";
        } else {
            if ($bayar < $total) {
                echo "<script type='text/javascript'>
                    swal.fire('Maaf, Uang anda kurang!', '', 'warning');
                  </script>";
            } else {
                $queryPenjualan = mysqli_query($conn, "INSERT INTO tbl_penjualan SET no_penjualan='$no_penjualan',
                                                                                 tgl_transaksi=now(),
                                                                                 username='$_SESSION[username]'");
                if ($queryPenjualan) {

                    # ambil data dari keranjang belanja
                    $cekKrg = "SELECT * FROM tbl_keranjang WHERE username='$_SESSION[username]'";
                    $result = mysqli_query($conn, $cekKrg);
                    while ($krgRow = mysqli_fetch_assoc($result)) {
                        # insert data ke tabel penjualan_item
                        $queryItem = "INSERT INTO tbl_penjualan_item SET no_penjualan='$no_penjualan',
                                                                 id_barang = '$krgRow[id_barang]',
                                                                 harga_jual = '$krgRow[harga_jual]',
                                                                 jumlah = '$krgRow[qty]'";
                        mysqli_query($conn, $queryItem);
                        # update stok di tabel barang
                        $queryBarang = "UPDATE tbl_barang SET stok=stok - $krgRow[qty] WHERE id_barang = '$krgRow[id_barang]'";
                        mysqli_query($conn, $queryBarang);
                    }
                    //kosongkan di tabel keranjang jika data sudah di move
                    mysqli_query($conn, "DELETE FROM tbl_keranjang WHERE username ='$_SESSION[username]'");
                    // echo "<meta http-equiv='refresh' content='0;url=transaksi.php'>";
                }
                echo "<script type='text/javascript'>
                swal.fire('Transaksi Berhasil!', '', 'success');
              </script>";
            }
        }
    }
}

?>

<?php
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

        <?php } else { ?>
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
                    <a class="nav-link collapsed" href="../barang/view.php">
                        <i class="bi bi-layout-text-window"></i>
                        <span>Data Barang</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link" href="transaksi.php">
                        <i class="bi bi-cart-check"></i>
                        <span>Transaksi</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-heading">Pages</li>

                <li class="nav-item">
                    <a class="nav-link collapsed alert_notif" href="../../logout.php">
                        <span class="me-2">Logout </span>
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </li><!-- End Profile Page Nav -->

            </ul>
        <?php } ?>



    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Transaksi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Transaksi</a></li>
                    <li class="breadcrumb-item active">Transaksi</li>
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
                            <div class="card info-card p-3 animate__animated animate__fadeInLeft">
                                <span class="fw-bold fs-3">
                                    POS SYSTEM
                                </span>
                                <hr>
                                <form id="formD" name="formD" action="" method="post" class="col-md-6">

                                    <div class="mb-3">
                                        <label>Nama Barang</label>
                                        <select name="id_barang" class="form-select">
                                            <option>Pilih Barang</option>
                                            <?php
                                            $query = "SELECT * FROM tbl_barang order by nama_barang asc";
                                            $result = mysqli_query($conn, $query);
                                            while ($data = mysqli_fetch_array($result)) {
                                            ?>
                                                <option value="<?= $data['id_barang'] ?>"><?= $data['nama_barang']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>QTY</label>
                                        <input type="numeric" class="form-control" name="jumlah">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-25" name="btnTambah">Pilih</button>
                                    </div>
                            </div>

                            <div class="card info-card p-3 animate__animated animate__fadeInUp">
                                <span class="fw-bold fs-3">ITEM BARANG</span>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-responsive table-bordered border-dark table-striped text-center mt-2">
                                        <thead>
                                            <tr class="bg-secondary text-white">
                                                <td>No</td>
                                                <td>Nama Barang</td>
                                                <td>Harga</td>
                                                <td>Disc</td>
                                                <td>Harga Disc</td>
                                                <td>Qty</td>
                                                <td>Subtotal</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <?php
                                        include '../../conn.php';
                                        $krgQuery = "SELECT tbl_barang.*, tbl_keranjang.id, tbl_keranjang.harga_jual AS harga_jDiskon, tbl_keranjang.qty
                                                     FROM tbl_keranjang JOIN tbl_barang ON tbl_keranjang.id_barang = tbl_barang.id_barang
                                                     ORDER BY tbl_barang.id_barang DESC";
                                        $krgHasil = mysqli_query($conn, $krgQuery);
                                        $total = 0;
                                        $qtyBrg = 0;
                                        $no = 0;
                                        while ($krgData = mysqli_fetch_array($krgHasil)) {
                                            $id = $krgData['id'];
                                            $subTotal = $krgData['qty'] * $krgData['harga_jDiskon'];
                                            $total = $total + ($krgData['qty'] * $krgData['harga_jDiskon']);
                                            $qtyBrg = $qtyBrg + $krgData['qty'];

                                            $no++;
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $krgData['nama_barang']; ?></td>
                                                    <td><?= $krgData['harga_jual']; ?></td>
                                                    <td><?= $krgData['diskon']; ?>%</td>
                                                    <td><?= $krgData['harga_jDiskon']; ?></td>
                                                    <td><?= $krgData['qty']; ?></td>
                                                    <td><?= $subTotal; ?></td>
                                                    <td>
                                                        <span class="badge bg-danger p-2 px-3"><a href="delete_keranjang.php?id=<?= $krgData['id']; ?>" class="text-white">Delete</a></span>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                            <tr>
                                                <td colspan='6' align="right">
                                                    Grand Total
                                                </td>
                                                <td><?= $qtyBrg; ?></td>
                                                <td colspan="2"><input type="numeric" class="form-control" name="total" value="<?= $total; ?>" readonly></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right">Bayar</td>
                                                <td colspan="2">
                                                    <input type="numeric" class="form-control" name="bayar" placeholder="Rp." onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right">Kembali</td>
                                                <td colspan="2">
                                                    <input class="form-control disable" name="txtDisplay" placeholder="Rp." readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right">Metode Pembayaran</td>
                                                <td colspan="2">
                                                    <button type="submit" class="btn btn-success m-1" name="btnCash">Cash</button>
                                                    <button type="submit" class="btn btn-warning m-1" name="btnPayment">Payment</button>
                                                </td>
                                            </tr>
                                            </tbody>
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


    <script type="text/javascript" language="Javascript">
        // totalx = document.formD.total.value;
        // document.formD.txtDisplay.value = totalx;
        // bayarx = document.formD.bayar.value;
        // document.formD.txtDisplay.value = bayarx;

        function OnChange() {
            totalx = document.formD.total.value;
            bayarx = document.formD.bayar.value;
            kembali = bayarx - totalx;
            document.formD.txtDisplay.value = kembali;
        }
    </script>

    <?php include("../template/end.php"); ?>
<?php } ?>