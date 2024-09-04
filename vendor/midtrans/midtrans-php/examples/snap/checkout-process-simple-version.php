<?php

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
//Set Your server key
Config::$serverKey = "SB-Mid-server-RFV7YHMOIk810U3rExr_MamU";
// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;
$conn = mysqli_connect('localhost', 'root', '', 'db_pos');

$no_penjualan = $_GET['no_penjualan'];
$query = "SELECT tbl_barang.id_barang, tbl_barang.nama_barang, tbl_penjualan.no_penjualan, tbl_penjualan.username, tbl_penjualan_item.*
          FROM tbl_penjualan_item 
          JOIN tbl_penjualan ON tbl_penjualan_item.no_penjualan = tbl_penjualan.no_penjualan
          JOIN tbl_barang ON tbl_penjualan_item.id_barang = tbl_barang.id_barang
          WHERE tbl_penjualan_item.no_penjualan=$no_penjualan";
$hasil = mysqli_query($conn, $query);
$total = 0;
$qtyBrg = 0;

while ($data = mysqli_fetch_array($hasil)) {
    $id = $data['id'];
    $subTotal = $data['jumlah'] * $data['harga_jual'];
    $total = $total + ($data['jumlah'] * $data['harga_jual']);
    $qtyBrg = $qtyBrg + $data['jumlah'];
    $result_list[] = $data;
}

// Required
$transaction_details = array(
    'order_id' => $no_penjualan,
    'gross_amount' => $total, // no decimal allowed for creditcard
);

// Optional
foreach ($result_list as $data)
    $item_details[] = array(
        'id' => $data['id_barang'],
        'price' => $data['harga_jual'],
        'quantity' => $data['jumlah'],
        'name' => $data['nama_barang']
    );

// Optional
// $item_details = array($item1_details);
// Optional
// $customer_details = array(
//     'first_name'    => "Andri",
//     'last_name'     => "Litani",
//     'email'         => "andri@litani.com",
//     'phone'         => "081122334455"
//     // 'billing_address'  => $billing_address,
//     // 'shipping_address' => $shipping_address
// );

// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'item_details' => $item_details,
);
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-light">

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="d-flex align-items-center w-auto">
                                    <img src="assets/img/logoCN.png" width="100" alt="">
                                </a>
                            </div><!-- End Logo -->
                            <div class="card mb-3 animate__animated animate__fadeInDown">
                                <div class="card-body animate__animated animate__fadeInLeft">
                                    <div class="pt-4 pb-2">
                                        <p class="text-center fw-bold">Click a pay to continue transaction</p>
                                        <?php
                                        $snapToken = Snap::getSnapToken($transaction);
                                        // echo "Token = " . $snapToken;
                                        ?>
                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100 shadow rounded" id="pay-button">Pay!</button>
                                        </div>

                                        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-qQkICH_LLxIiB-cD"></script>
                                        <script type="text/javascript">
                                            document.getElementById('pay-button').onclick = function() {
                                                // SnapToken acquired from previous step
                                                snap.pay('<?php echo $snapToken ?>');
                                            };
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>