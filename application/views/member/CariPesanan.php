<!-- Footer -->
<?php $keranjang = $this->cart->contents();
$jml_item = 0;
foreach ($keranjang as $row) {
    $jml_item = $jml_item + $row['qty'];
}
?>
<form class="d-flex">
    <a class="text-dark" href="<?= base_url('Shop'); ?>">
        <button class="btn btn-outline-dark" type="btn btn-link">
            <i class="bi-cart-fill me-1"></i>
            Cart
            <span class="badge bg-dark text-white ms-1 rounded-pill">
                <?= $jml_item ?>
            </span>
    </a>
    </button>
</form>
</div>
</div>
</nav>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder"></h1>
            <p class="lead fw-normal text-white-50 mb-0">Cek Kuota Pupuk</p>
        </div>
    </div>
    <form method="post" action="<?php echo base_url('pesananmember/pembelian_harian'); ?>">
        <label class="text-white">Tanggal Awal:</label>
        <input type="date" name="tanggal_awal" value="<?php echo date('Y-m-d'); ?>"><br>

        <label class="text-white">Tanggal Akhir:</label>
        <input type="date" name="tanggal_akhir" value="<?php echo date('Y-m-d'); ?>"><br>

        <button type="submit">Generate Pesanan</button>
    </form>
</header>
<!-- Section-->
<table cellpadding="4" cellspacing="1" style="width:80%" class="container text-center" border="0">

    <tr>

        <th scope="col" class="sort" data-sort="name">Nama Pemesan</th>
        <th scope="col" class="sort" data-sort="name">Alamat</th>
        <th scope="col" class="sort" data-sort="name">Total harga</th>
        <th scope="col" class="sort" data-sort="name">Bank</th>
        <th scope="col" class="sort" data-sort="name">VA Number </th>
        <th scope="col" class="sort" data-sort="name">Tanggal Pesan</th>
        <th scope="col" class="sort" data-sort="name">Status Pesanan</th>
        <th scope="col">Action</th>
    </tr>

    <?php
    foreach ($riwayatTransaksi as $row) {
        ?>
        <tr>
            <td>
                <?php echo $row->namKonsumen ?>
            </td>
            <td>
                <?php echo $row->alamat ?>
            </td>
            <td>
                <?php echo $row->total_harga ?>
            </td>
            <td>
                <?php echo $row->bank ?>
            </td>
            <td>
                <?php echo $row->virtual_account ?>
            </td>
            <td>
                <?php echo $row->tgl_pesan ?>
            </td>
            <td>
                <?php
                $statusClass = '';

                if ($row->status === 'pending') {
                    $statusClass = 'btn-warning';
                } elseif ($row->status === 'success') {
                    $statusClass = 'btn-success';
                } elseif ($row->status === 'gagal') {
                    $statusClass = 'btn-danger';
                }
                ?>

                <div class="btn btn-sm <?php echo $statusClass; ?>">
                    <?php echo $row->status; ?>
                </div>
            </td>

            <td>
                <div class="btn btn-sm btn-info ">
                    <a class="text-dark" href="<?= site_url('Pesananmember/detail/' . $row->idInvoice) ?>">Detail</a>
                </div>
            </td>
        </tr>
    <?php } ?>