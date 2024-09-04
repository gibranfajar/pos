<?php

namespace Midtrans;

require_once dirname(__FILE__) . '/../Midtrans.php';
Config::$isProduction = false;
Config::$serverKey = 'SB-Mid-server-RFV7YHMOIk810U3rExr_MamU';
$notif = new Notification();
$conn = mysqli_connect('localhost', 'root', '', 'db_pos');


$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

if ($transaction == 'capture') {
    // For credit card transaction, we need to check whether transaction is challenge by FDS or not
    if ($type == 'credit_card') {
        if ($fraud == 'challenge') {
            // TODO set payment status in merchant's database to 'Challenge by FDS'
            // TODO merchant should decide whether this transaction is authorized or not in MAP
            echo "Transaction order_id: " . $order_id . " is challenged by FDS";
        } else {
            // TODO set payment status in merchant's database to 'Success'
            echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
        }
    }
} else if ($transaction == 'settlement') {
    // TODO set payment status in merchant's database to 'Settlement'
    // echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
    mysqli_query($conn, "UPDATE tbl_penjualan SET status_trx='1' WHERE no_penjualan='$order_id'");
} else if ($transaction == 'pending') {
    #query update
    // TODO set payment status in merchant's database to 'Pending'
    mysqli_query($conn, "UPDATE tbl_penjualan SET status_trx='2' WHERE no_penjualan='$order_id'");
} else if ($transaction == 'deny') {
    // TODO set payment status in merchant's database to 'Denied'
    mysqli_query($conn, "UPDATE tbl_penjualan SET status_trx='3' WHERE no_penjualan='$order_id'");
} else if ($transaction == 'expire') {
    // TODO set payment status in merchant's database to 'expire'
    mysqli_query($conn, "UPDATE tbl_penjualan SET status_trx='4' WHERE no_penjualan='$order_id'");
} else if ($transaction == 'cancel') {
    // TODO set payment status in merchant's database to 'Denied'
    mysqli_query($conn, "UPDATE tbl_penjualan SET status_trx='5' WHERE no_penjualan='$order_id'");
}
