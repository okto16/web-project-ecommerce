<?php $keranjang = $this->cart->contents();
$jml_item = 0;
foreach ($keranjang as $row) {
    $jml_item = $jml_item + $row['qty'];
}
?>
<form class="d-flex">
    <a class="text-dark" href="<?= base_url('Shop'); ?>">
        <button class="btn btn-outline-dark" type="btn btn-link">
            <i class="bi-cart-fill text-dark"></i>
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
<?php if ($this->session->flashdata('success')): ?>
    <div id="autoCloseSuccessAlert" class="alert alert-success alert-dismissible fade show">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <script>
        // Menutup alert sukses otomatis setelah 5 detik (5000 milidetik)
        setTimeout(function() {
            document.getElementById('autoCloseSuccessAlert').style.display = 'none';
        }, 5000);
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('danger')): ?>
    <div id="autoCloseAlert" class="alert alert-danger alert-dismissible fade show">
        <?php echo $this->session->flashdata('danger'); ?>
    </div>
    <script>
        // Menutup alert otomatis setelah 5 detik (5000 milidetik)
        setTimeout(function() {
            document.getElementById('autoCloseAlert').style.display = 'none';
        }, 5000);
    </script>
<?php endif; ?>
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop Homepage</h1>
            <p class="lead fw-normal text-white-50 mb-0">Silahkan memilih produk</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            foreach ($queryAllBrg as $row) { ?>
                <div class="col mb-5">
                    <?php echo form_open('shop/add');
                    echo form_hidden('id', $row->idProduk);
                    echo form_hidden('qty', 1);
                    echo form_hidden('price', $row->harga);
                    echo form_hidden('name', $row->namProduk);
                    echo form_hidden('redirect_page', str_replace('member/Homepage.php/', '', current_url()));
                    ?>
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Stock
                            <?php echo $row->stok; ?>
                        </div>
                        <!-- Product image-->
                        <img class="card-img-top" src="<?= base_url('assets/img/brand/' . $row->foto); ?>" width="400px"
                            height="300px" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">
                                    <?php echo $row->namProduk ?>
                                </h5>
                                <!-- Product reviews-->
                                <div class="fw-bolder">
                                    <?php echo $row->deskripsiProduk ?>
                                </div>
                                <!-- Product price-->
                                <span class="Original">Rp.
                                    <?php echo $row->harga ?>
                                </span>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <?php if ($row->stok > 0) { ?>
                                <div class="text-center"><button onclick="showSweetAlert()"
                                        class="btn btn-outline-dark mt-auto">Add to cart</button></div>
                            <?php } else { ?>
                                <div class="text-center"><button class="btn btn-outline-dark mt-auto" disabled>Out of
                                        stock</button></div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function showSweetAlert() {
        // Menampilkan SweetAlert dengan pesan
        Swal.fire({
            title: 'Ini SweetAlert!',
            text: 'Akan menutup dalam beberapa detik...',
            timer: 4000, // Waktu dalam milidetik sebelum menutup otomatis
            showConfirmButton: false, // Menyembunyikan tombol OK
            icon: 'success'
        });
    }
</script>
<!-- Footer-->