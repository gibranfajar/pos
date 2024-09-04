<?php
session_start();
include('../../conn.php');
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
					<a class="nav-link" data-bs-target="#components-nav-barang" data-bs-toggle="collapse" href="#">
						<i class="bi bi-plus"></i><span>Barang</span><i class="bi bi-chevron-down ms-auto"></i>
					</a>
					<ul id="components-nav-barang" class="nav-content" data-bs-parent="#sidebar-nav">
						<li>
							<a href="create.php">
								<i class="bi bi-circle"></i><span>Tambah Barang</span>
							</a>
						</li>
						<li>
							<a href="view.php" class="active">
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
					<a class="nav-link" href="view.php">
						<i class="bi bi-layout-text-window"></i>
						<span>Data Barang</span>
					</a>
				</li><!-- End Dashboard Nav -->

				<li class="nav-item">
					<a class="nav-link collapsed" href="../transaksi/transaksi.php">
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
			<h1>Barang</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="">Barang</a></li>
					<li class="breadcrumb-item active">Data Barang</li>
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
								<span class="fw-bold fs-3">Data Barang</span>
								<?php if ($_SESSION['level'] == "admin") { ?>
									<div class="dropdown d-flex">
										<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
											Dropdown Filter
										</button>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="view.php">Semua Barang</a></li>
											<li><a class="dropdown-item" href="view.php?stok=10">Kurang dari 10</a></li>
											<li><a class="dropdown-item" href="view.php?stok=50">Kurang dari 50</a></li>
											<li><a class="dropdown-item" href="view.php?stok=100">Kurang dari 100</a></li>
										</ul>
									</div>
								<?php } ?>
								<hr>
								<div class="table-responsive">
									<table class="table table-responsive table-bordered border-dark table-striped text-center mt-2">
										<thead>
											<tr class="bg-success text-white">
												<td>No</td>
												<td>Nama Barang</td>
												<td>Kategori</td>
												<?php if ($_SESSION['level'] == "admin") { ?>
													<td>Harga Beli</td>
												<?php } ?>
												<td>Harga Jual</td>
												<td>Diskon</td>
												<td>Stok</td>
												<?php if ($_SESSION['level'] == "admin") { ?>
													<td>Action</td>
												<?php } ?>
											</tr>
										</thead>
										<?php
										if (isset($_GET['stok'])) {
											$filter10 = $_GET['stok'];
											$no = 1;
											$query = "SELECT tbl_barang.id_barang, tbl_barang.nama_barang, tbl_kategori.nama_kategori, tbl_barang.harga_beli, tbl_barang.harga_jual, tbl_barang.diskon, tbl_barang.stok
														FROM tbl_barang
														INNER JOIN tbl_kategori ON tbl_barang.id_kategori = tbl_kategori.id_kategori WHERE tbl_barang.stok<='$filter10' ORDER BY tbl_barang.nama_barang ASC";
											$result = mysqli_query($conn, $query);
											while ($data = mysqli_fetch_array($result)) {
										?>
												<tbody>
													<tr>
														<td><?= $no++; ?></td>
														<td><?= $data['nama_barang']; ?></td>
														<td><?= $data['nama_kategori']; ?></td>
														<?php if ($_SESSION['level'] == "admin") { ?>
															<td><?= $data['harga_beli']; ?></td>
														<?php } ?>
														<td><?= $data['harga_jual']; ?></td>
														<td><?= $data['diskon']; ?>%</td>
														<td><?= $data['stok']; ?></td>
														<?php if ($_SESSION['level'] == "admin") { ?>
															<td>
																<span class="badge bg-warning p-2 px-3"><a href=" update.php?id=<?= $data['id_barang']; ?>" class="text-dark">Edit</a></span>
																<span class="badge bg-danger p-2 px-3"><a href="act_delete.php?id=<?= $data['id_barang']; ?>" class="text-white alert_delete">Hapus</a></span>
															</td>
														<?php } ?>
													</tr>
												</tbody>
											<?php  }
										} else {
											$no = 1;
											$query = "SELECT tbl_barang.id_barang, tbl_barang.nama_barang, tbl_kategori.nama_kategori, tbl_barang.harga_beli, tbl_barang.harga_jual, tbl_barang.diskon, tbl_barang.stok
													  FROM tbl_barang
													  INNER JOIN tbl_kategori ON tbl_barang.id_kategori = tbl_kategori.id_kategori ORDER BY tbl_barang.nama_barang ASC";
											$result = mysqli_query($conn, $query);
											while ($data = mysqli_fetch_array($result)) {
											?>
												<tbody>
													<tr>
														<td><?= $no++; ?></td>
														<td><?= $data['nama_barang']; ?></td>
														<td><?= $data['nama_kategori']; ?></td>
														<?php if ($_SESSION['level'] == "admin") { ?>
															<td><?= $data['harga_beli']; ?></td>
														<?php } ?>
														<td><?= $data['harga_jual']; ?></td>
														<td><?= $data['diskon']; ?>%</td>
														<td><?= $data['stok']; ?></td>
														<?php if ($_SESSION['level'] == "admin") { ?>
															<td>
																<span class="badge bg-warning p-2 px-3"><a href=" update.php?id=<?= $data['id_barang']; ?>" class="text-dark">Edit</a></span>
																<span class="badge bg-danger p-2 px-3"><a href="act_delete.php?id=<?= $data['id_barang']; ?>" class="text-white alert_delete">Hapus</a></span>
															</td>
														<?php } ?>
													</tr>
												</tbody>
										<?php  }
										} ?>
									</table>
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