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
                    <p class="lead fw-normal text-white-50 mb-0">Jika anda ingin melanjutkan untuk memesan tekan pesan</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
             <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger">
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" >
                <div class="btn btn-sm btn-success">
                <?php
                $grandtotal = 0;
                if ($keranjang = $this->cart->contents())
                {
                    foreach ($keranjang as $items) {
                        $grandtotal = $grandtotal + $items['subtotal'];
                    }
                    echo "<h4 class>Total Belanja Anda: Rp.".number_format($grandtotal);
                } ?>
                       
                            </div>
                            </div>
            <?= form_open_multipart('pembayaran/process_order'); ?>
            <div class="row">
                <div class="col md-4">
                    <div class="form-group">
                        <label for="namKonsumen">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="namKonsumen" required></input>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col md-4">
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <input type="text" class="form-control" placeholder="Alamat Lengkap" name="alamat" required></input>
                    </div>
                </div>
            </div>    
                                   
            </div>
            <div>
                
            </div>
        <button type="submit" class="btn btn-sm btn-primary">Pesan</button>
        
        <?= form_close(); ?>
        </section>
        <!-- Footer-->