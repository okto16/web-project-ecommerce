</table>
<div class="row">
    <div class="col">
        <div class="card bg-primary shadow">
            <div class="card-header bg-transparent border-0">

                <h3 class="text-white mb-0">Detail Pesanan</h3>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center bg-primary table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Nama Produk</th>
                            <th scope="col" class="sort" data-sort="name">Harga</th>
                            <th scope="col" class="sort" data-sort="budget">Jumlah</th>
                            <th scope="col" class="sort" data-sort="completion">Total Harga</th>
                        </tr>
                        <?php foreach ($orderDetail as $detail) : ?>
                            <tr>
                                <td class="text-white mb-0"><?= $detail->namProduk; ?></td>
                                <td class="text-white mb-0"><?= $detail->harga; ?></td>
                                <td class="text-white mb-0"><?= $detail->jumlah; ?></td>
                                <td class="text-white mb-0"><?= $detail->total_Harga; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </thead>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>