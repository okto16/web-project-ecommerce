<?php $keranjang = $this->cart->contents();
$jml_item = 0;
foreach ($keranjang as $row) {
    $jml_item = $jml_item + $row['qty'];
}
?>
<form class="d-flex">
    <button class="btn btn-outline-dark" type="submit">
        <i class="bi-cart-fill me-1"></i>
        Cart
        <span class="badge bg-dark text-white ms-1 rounded-pill">
            <?= $jml_item ?>
        </span>
    </button>
</form>
</div>
</div>
</nav>
<!-- Header-->
<?php if ($this->session->flashdata('success')): ?>
    <div id="autoCloseAlert" class="alert alert-success alert-dismissible fade show">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <script>
        // Menutup alert otomatis setelah 5 detik (5000 milidetik)
        setTimeout(function() {
            document.getElementById('autoCloseAlert').style.display = 'none';
        }, 5000);
    </script>
<?php endif; ?>

<?php echo form_open('Shop/update/'); ?>

<table cellpadding="4" cellspacing="1" style="width:80%" class="container text-center" border="0">

    <tr>
        <th>QTY</th>
        <th>Item Description</th>
        <th style="text-align:right">Item Price</th>
        <th style="text-align:right">Sub-Total</th>
        <th>Action</th>
    </tr>

    <?php $i = 1; ?>

    <?php foreach ($this->cart->contents() as $items): ?>

        <tr>
            <td>
                <?php
                echo form_input(
                    array(
                        'name' => $i . '[qty]',
                        'value' => $items['qty'],
                        'maxlength' => '3',
                        'min' => '0',
                        'size' => '5',
                        'type' => 'number',
                        'class' => 'form-control'
                    )
                );
                ?>
            </td>
            <td>
                <?php echo $items['name']; ?>

                <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                    <p>
                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                            <strong>
                                <?php echo $option_name; ?>:
                            </strong>
                            <?php echo $option_value; ?><br />

                        <?php endforeach; ?>
                    </p>

                <?php endif; ?>

            </td>
            <td style="text-align:right">Rp.
                <?php echo $this->cart->format_number($items['price']); ?>
            </td>
            <td style="text-align:right">Rp.
                <?php echo $this->cart->format_number($items['subtotal']); ?>
            </td>
            <td class="textcenter"><a href="<?= base_url('shop/delete/' . $items['rowid']) ?>"
                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
        </tr>

        <?php $i++; ?>

    <?php endforeach; ?>

    <tr>
        <td colspan="2"> </td>
        <td class="right"><strong>Total</strong></td>
        <td class="right"><strong>Rp.
                <?php echo $this->cart->format_number($this->cart->total()); ?>
            </strong></td>
    </tr>

</table>
<div class="text-center">
    <button type="submit" class="btn btn-primary btn-flat">Update</button>
    <a href="snap/pupuk" class="btn btn-success btn-flat">Checkout</a>
</div>
<!-- Section-->
<?php echo form_close(); ?>
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
<!-- Footer-->