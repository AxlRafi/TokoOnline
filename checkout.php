<?php
session_start();
include "koneksi.php";
$cart = @$_SESSION['cart'];
if (count($cart) > 0) {

    $tgl_pembelian = date('Y-m-d');

    mysqli_query($conn, "insert into transaksi (id_pelanggan,tgl_transaksi)
    value('" . $_SESSION['id_pelanggan'] . "','" . $tgl_pembelian . "')");

    $id = mysqli_insert_id($conn);
    foreach ($cart as $key_produk => $val_produk) {
        mysqli_query($conn, "insert into detail_transaksi(id_transaksi,id_produk,qty)
        value('" . $id . "','" . $val_produk['id_produk'] . "','" . $val_produk['qty'] . "')");
    }
    unset($_SESSION['cart']);
    echo '<script>alert("Anda berhasil membeli");location.href="histori_pembelian.php"</script>';
}
