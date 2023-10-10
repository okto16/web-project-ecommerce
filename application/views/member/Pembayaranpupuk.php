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
<html>
<title>Checkout</title>

<head>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-Kz1UdLweU17AdISO"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder"></h1>
                <h3 class="mb-0 alert alter-success">Pembayaran</h3>
            </div>
        </div>
    </header>
</head>

<body>
    <!-- Section-->
     <?php if ($this->session->flashdata('error')) : ?>
          <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="col md-4">
                    <form id="payment-form" method="post" action="<?= site_url() ?>/snap/finish">
                        <input type="hidden" name="result_type" id="result-type" value="">
                        <input type="hidden" name="result_data" id="result-data" value="">
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="btn btn-sm btn-success">
                    <?php
                    $grandtotal = 0;
                    if ($keranjang = $this->cart->contents()) {
                        foreach ($keranjang as $items) {
                            $grandtotal = $grandtotal + $items['subtotal'];
                        }
                        echo "<h4>Total Belanja Anda: Rp." . number_format($grandtotal) . "</h4>";
                    } ?>
                </div>
            </div>
            <div class="row">
                <div class="col md-4">
                    <div class="form-group">
                        <label for="namKonsumen">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="namKonsumen"
                            id="namKonsumen" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col md-4">
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <input type="text" class="form-control" placeholder="Alamat Lengkap" name="alamat" id="alamat"
                            required>
                    </div>
                </div>
            </div>
            <button id="pay-button">Pembayaran!</button>
        </div>
        </form>
    </section>

    <script type="text/javascript">
        $('#pay-button').click(function (event) {
            event.preventDefault();
            $(this).attr("disabled", "disabled");
            var namKonsumen = $("#namKonsumen").val();
            var alamat = $("#alamat").val();
            var $grandtotal = $("#grandtotal").val();
            $.ajax({
                type: 'POST',
                url: '<?= site_url() ?>/snap/token',
                data: {
                    namKonsumen: namKonsumen,
                    alamat: alamat,
                    grandtotal: <?= $grandtotal ?> 
                },
                cache: false,

                success: function (data) {
                    console.log('token = ' + data);

                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type, data) {
                        $("#result-type").val(type);
                        $("#result-data").val(JSON.stringify(data));
                    }

                    snap.pay(data, {
                        onSuccess: function (result) {
                            changeResult('success', result);
                            console.log(result.status_message);
                            console.log(result);
                            $("#payment-form").submit();
                        },
                        onPending: function (result) {
                            changeResult('pending', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        },
                        onError: function (result) {
                            changeResult('error', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        }
                    });
                }
            });
        });

    </script>
</body>

</html>