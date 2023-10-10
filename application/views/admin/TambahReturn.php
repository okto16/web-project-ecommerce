        <form method="post" action="<?= base_url('Pengembalian/addReturn'); ?>">
            <div class="form-group">
                <label for="idInvoice">ID Invoice:</label>
                <select class="form-control" name="idInvoice" id="idInvoice">
                    <?php foreach ($queryAllInvoice as $row) : ?>
                        <option value="<?php echo $row->idInvoice; ?>">
                            <?php echo $row->idInvoice; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="idProduk">Produk:</label>
                <select class="form-control" name="idProduk" id="idProduk">
                    <?php foreach ($queryAllProduk as $produk) : ?>
                        <option value="<?php echo $produk->idProduk; ?>">
                            <?php echo $produk->namProduk; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="jumlahReturn">Jumlah Return:</label>
                <input class="form-control" type="number" name="jumlahReturn" id="jumlahReturn">
            </div>

            <div class="form-group">
                <label for="alasanReturn">Alasan Return:</label>
                <textarea class="form-control" name="alasanReturn" id="alasanReturn"></textarea>
            </div>

            <button type="submit" class="btn btn-success mt-4">Tambah Return</button>
        </form>
    </div>
</body>
</html>
