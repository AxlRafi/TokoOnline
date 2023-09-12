<?php
include "header.php";
?>
<h2>Histori Pembelian</h2>
<table class="table table-hover table-striped">
    <thead>
        <th>NO</th>
        <th>Nama Produk</th>
        <th>Tanggal Beli</th>
        <th>Jumlah</th>
    </thead>
    <tbody>
        <?php
        include "koneksi.php";
        $qry_histori = mysqli_query($conn, "select * from transaksi order by id_transaksi desc");
        $no = 0;
        while ($dt_histori = mysqli_fetch_array($qry_histori)) {
            $no++;

            $produk_dibeli = "<ol>";
            $qry_produk = mysqli_query($conn, "select * from detail_transaksi join produk on produk.id_produk=detail_transaksi.id_produk where id_transaksi ='" . $dt_histori['id_transaksi'] . "'");
            while ($dt_produk = mysqli_fetch_array($qry_produk)) {
                $produk_dibeli .= "<li>" . $dt_produk['nama_produk'] . "</li>";
                $jumlah_dibeli .= "<li>" . $dt_produk['qty'] . "</li>";
            }
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $produk_dibeli ?></td>
                <td><?= $dt_histori['tgl_transaksi'] ?></td>
                <td><?= $jumlah_dibeli ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
include "footer.php";
?>