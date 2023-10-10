<?php $keranjang = $this->cart->contents();
$jml_item = 0;
foreach ($keranjang as $row) {
    $jml_item = $jml_item + $row['qty'];
}
?>
<form class="d-flex">
    <a href="<?= base_url('Shop'); ?>">
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
            <h3 class="mb-0 alert alter-success">Selamat Pesanan Anda Berhasil di Proses!!</h3>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col md-4">
                <form class="user" method="post"
                    action="<?php echo base_url('Pesananmember/fungsibayar/' . $queryInvoiceDetail->idInvoice) ?>"
                    enctype="multipart/form-data">
                    <label>Pilih Metode Pembayaran</label>
                    <div class="row">
                        <div class="col md-4">
                            <div class="form-group">
                                <select name="form-control">
                                    <?php
                                    foreach ($queryAllBank as $row) {
                                        ?>
                                        <option value="">
                                            <?php echo $row->nama_bank ?>-
                                            <?php echo $row->nomor_rekening ?>
                                        </option>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    </select>
                    <div class="form-group">
                        <label for="bukti_transfer">Masukan Bukti Transfer</label>
                        <input type="file" class="form-control" placeholder="Masukan Bukti Transfer"
                            name="bukti_transfer" value="<?php echo $queryInvoiceDetail->bukti_transfer ?>"></input>
                        <button type="submit" class="btn btn-success mt-4">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- Product actions-->

        </div>
    </div>

    </div>

    </div>
    </div>
</section>
<!-- Footer-->
<!-- Page content -->