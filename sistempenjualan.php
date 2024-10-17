<?php

$array_data_penjualan = [];

if($_SERVER['REQUEST_METHOD'] = 'POST'){
    array_push(
        $array_data_penjualan,
        array("nama_produk" => $_POST['nama_produk'], "harga_produk" => $_POST['harga_produk'], "jumlah_terjual" => $_POST['jumlah_terjual'], "total" => $_POST['harga_produk'] * $_POST['jumlah_terjual'])
    );
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
</head>

<style>
    table, th, td{
        border: 1px solid black;
    }
</style>


<body>
    <h1>Sistem Pencatatan Penjualan</h1>

    <form action="" method="post">
        <label for="">Nama Produk</label>
        <input type="text" name="nama_produk">
        <br><br>
        <label for="">Harga Produk</label>
        <input type="number" name="harga_produk">
        <br><br>
        <label for="">Jumlah Terjual</label>
        <input type="number" name="jumlah_terjual">
        <br><br>
        <button type="submit">Simpan</button>
        <hr>
    </form>

    <table>
        <h3>Laporan Penjualan :</h3>
        <tr>
            <th>Nama</th>
            <th>Harga Per Produk</th>
            <th>Jumlah Terjual</th>
            <th>Total</th>
        </tr>

        <?php for ($i=0; $i < count($array_data_penjualan); $i++) { ?>
        <tr>
            <td><?php echo $array_data_penjualan[$i]["nama_produk"] ?></td>
            <td><?php echo $array_data_penjualan[$i]["harga_produk"] ?></td>
            <td><?php echo $array_data_penjualan[$i]["jumlah_terjual"] ?></td>
            <td><?php echo $array_data_penjualan[$i]["total"] ?></td>
        </tr>
        <?php } ?>
    </table>
    
</body>
</html>