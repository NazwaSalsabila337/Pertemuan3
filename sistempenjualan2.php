<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pencatatan Data Penjualan</title>
</head>
<body>
    <h2>Sistem Pencatatan Data Penjualan</h2>
    <form method="POST">
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" id="nama_produk" name="nama_produk" required><br><br>

        <label for="harga_produk">Harga per Produk:</label>
        <input type="number" id="harga_produk" name="harga_produk" required><br><br>

        <label for="jumlah_terjual">Jumlah Terjual:</label>
        <input type="number" id="jumlah_terjual" name="jumlah_terjual" required><br><br>

        <input type="submit" value="Simpan">
    </form>
</body>
</html>

<?php
// Memulai sesi untuk menyimpan transaksi antar refresh halaman
session_start();

// Jika belum ada transaksi sebelumnya, buat array kosong
if (!isset($_SESSION['transaksi'])) {
    $_SESSION['transaksi'] = [];
}

// Fungsi untuk menambahkan transaksi baru ke dalam array
function tambah_transaksi($nama, $harga, $jumlah) {
    $total = $harga * $jumlah;
    return [
        'nama_produk' => $nama,
        'harga_produk' => $harga,
        'jumlah_terjual' => $jumlah,
        'total_penjualan' => $total
    ];
}

// Fungsi untuk menghitung total penjualan
function hitung_total_penjualan($transaksi) {
    $total_penjualan = 0;
    $total_jumlah = 0;

    foreach ($transaksi as $item) {
        $total_penjualan += $item['total_penjualan'];
        $total_jumlah += $item['jumlah_terjual'];
    }

    return [$total_penjualan, $total_jumlah];
}

// Mengambil data dari form dan menambahkannya ke dalam sesi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = (float)$_POST['harga_produk'];
    $jumlah_terjual = (int)$_POST['jumlah_terjual'];

    // Tambahkan transaksi baru ke dalam sesi
    $_SESSION['transaksi'][] = tambah_transaksi($nama_produk, $harga_produk, $jumlah_terjual);
}

// Mengambil semua transaksi
$transaksi = $_SESSION['transaksi'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <h3>Laporan Penjualan :</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga Per Produk</th>
                <th>Jumlah Terjual</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transaksi)): ?>
                <?php foreach ($transaksi as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nama_produk']); ?></td>
                        <td><?php echo number_format($item['harga_produk'], 2); ?></td>
                        <td><?php echo htmlspecialchars($item['jumlah_terjual']); ?></td>
                        <td><?php echo number_format($item['total_penjualan'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Belum ada data penjualan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <?php 
                $totals = hitung_total_penjualan($transaksi);
            ?>
            <tr>
                <th colspan="2">Total Penjualan</th>
                <td><?php echo htmlspecialchars($totals[1]); ?></td>
                <td><?php echo number_format($totals[0], 2); ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>





