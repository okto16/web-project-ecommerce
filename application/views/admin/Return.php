<!-- Header -->
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
    <?php if ($this->session->flashdata('success')) : ?>
          <div class="alert alert-success">
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php endif; ?>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->

        <!-- Light table -->
        <!-- Card footer -->
        <div class="card-footer py-0">
        </div>
        <a class="btn btn-link" href="<?= base_url('Pengembalian/halaman_tambah'); ?>" role="button">Tambah Pengembalian</a>
      </div>
    </div>
  </div>
  <!-- Dark table -->
  <div class="row">
    <div class="col">
      <div class="card bg-primary shadow">
        <div class="card-header bg-transparent border-0">
          <form action="<?= base_url('Produk/perform_search'); ?>" method="post">
            <input type="text" name="keyword" placeholder="Search...">
            <button type="submit">Search</button>
          </form>
          <h3 class="text-white mb-0">Daftar Pengembalian</h3>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center bg-primary table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">Id Pengembalian</th>
                <th scope="col" class="sort" data-sort="name">Id Invoice</th>
                <th scope="col" class="sort" data-sort="budget">Id Produk</th>
                <th scope="col" class="sort" data-sort="completion">Jumlah Pengembalian</th>
                <th scope="col" class="sort" data-sort="completion">Total Harga Kembali</th>
                <th scope="col" class="sort" data-sort="status">Alasan Pengembalian</th>
              </tr>
              <?php
              foreach ($queryAllReturn as $row) {
              ?>
                <tr>
                  <td class="text-white mb-0"><?php echo $row->idReturn ?></td>
                  <td class="text-white mb-0"><?php echo $row->idInvoice ?></td>
                  <td class="text-white mb-0"><?php echo $row->idProduk ?></td>
                  <td class="text-white mb-0"><?php echo $row->jumlahReturn ?></td>
                  <td class="text-white mb-0"><?php echo $row->totalHargaKembali ?></td>
                  <td class="text-white mb-0"><?php echo $row->alasanReturn ?></td>
                </tr>
              <?php } ?>
            </thead>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6">
        <div class="copyright text-center  text-lg-left  text-muted">
          &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
          </li>
          <li class="nav-item">
            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
          </li>
          <li class="nav-item">
            <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
</div>
</div>