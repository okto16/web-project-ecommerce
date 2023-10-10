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
                                <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $jml_item ?></span>
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
                    <p class="lead fw-normal text-white-50 mb-0">Shop homepage</p>
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
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                <!-- Product image-->
                                <img class="card-img-top" src="<?= base_url('assets/img/brand/' . $row->foto); ?>" width="400px" height="300px" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $row->namProduk ?></h5>
                                        <!-- Product reviews-->
                                        <div class="fw-bolder"><?php echo $row->deskripsiProduk ?>></div>
                                        <!-- Product price-->
                                        <tr>Rp.</tr><?php echo $row->harga ?>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><button class="btn btn-outline-dark mt-auto swalDefaultSuccess" >Add to cart</button></div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <script src="<?= base_url('assets/');?>plugins/sweetalert2/sweetalert2.min.js"></script>
        <script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Berhasil.'
      })
    });
});
    </script>
        </section>
        <!-- Footer-->