<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
</head>
<body>
    <h1>Laporan Penjualan</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID Laporan</th>
                <th>Nama Konsumen</th>
                <th>Alamat</th>
                <th>Total Harga</th>
                <th>Tanggal Pesan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoice as $row) : ?>
                <tr>
                    <td><?php echo $row->idInvoice; ?></td>
                    <td><?php echo $row->namKonsumen; ?></td>
                    <td><?php echo $row->alamat; ?></td>
                    <td><?php echo $row->total_harga; ?></td>
                    <td><?php echo $row->tgl_pesan; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script type="text/javascript">
        window.print();
    </script>
    
    <!-- Tambahkan tautan cetak laporan -->
</body>
</html>
