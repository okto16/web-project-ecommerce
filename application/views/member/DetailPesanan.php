<?php $keranjang = $this->cart->contents();
$jml_item = 0;
foreach ($keranjang as $row) {
    $jml_item = $jml_item + $row['qty'];
}
?>
<form class="d-flex">
    <a class="text-dark" href="<?= base_url('Shop'); ?>">
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
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder"></h1>
            <h3 class="mb-0 alert alter-success">Riwayat Pesanan Anda</h3>
        </div>
    </div>
</header>
</table>
<div class="row">
    <div class="col">
        <div class="card bg-white shadow">
            <div class="card-header bg-transparent border-0">
                <h3 class="text-dark mb-0">Detail Pesanan</h3>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-light table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Nama Produk</th>
                            <th scope="col" class="sort" data-sort="name">Harga</th>
                            <th scope="col" class="sort" data-sort="budget">Jumlah</th>
                            <th scope="col" class="sort" data-sort="completion">Total Harga</th>
                        </tr>
                        <?php foreach ($orderDetail as $detail): ?>
                            <tr>
                                <td>
                                    <?= $detail->namProduk; ?>
                                </td>
                                <td>
                                    <?= $detail->harga; ?>
                                </td>
                                <td>
                                    <?= $detail->jumlah; ?>
                                </td>
                                <td>
                                    <?= $detail->total_Harga; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </thead>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>