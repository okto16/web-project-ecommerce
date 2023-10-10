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
</header>
<!-- Section-->


<div class="table-responsive">
  <table class="table align-items-center table-light table-flush">
    <thead class="thead-light">
      <tr>
        <th scope="col" class="sort" data-sort="name">Id</th>
        <th scope="col" class="sort" data-sort="name">nik</th>
        <th scope="col" class="sort" data-sort="name">Username</th>
        <th scope="col" class="sort" data-sort="name">Nama Produk</th>
        <th scope="col" class="sort" data-sort="name">jumlah Kuota</th>
        <th scope="col" class="sort" data-sort="name">Tahun</th>
      </tr>
      <?php
      foreach ($queryAllKuota as $row) {
        ?>
        <tr>
          <td>
            <?php echo $row->id ?>
          </td>
          <td>
            <?php echo $row->Nik ?>
          </td>
          <td>
            <?php echo $row->username ?>
          </td>
          <td>
            <?php echo $row->namProduk ?>
          </td>
          <td>
            <?php echo $row->jumlahKuota ?>
          </td>
          <td>
            <?php echo $row->tahun ?>
          </td>
        </tr>
      <?php } ?>
    </thead>
    </tbody>
  </table>