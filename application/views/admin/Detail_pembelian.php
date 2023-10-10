<!-- detail_pembelian.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Detail Pembelian</title>
</head>
<body>
    <h1>Detail Pembelian</h1>
    <table border="1">
        <tr>
            <th>Nama Konsumen</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
        </tr>
        <?php foreach ($detail as $item) : ?>
            <tr>
                <td><?= $item->namKonsumen ?></td>
                <td><?= $item->namProduk ?></td>
                <td><?= $item->harga ?></td>
                <td><?= $item->jumlah ?></td>
                <td><?= $item->total_Harga ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
