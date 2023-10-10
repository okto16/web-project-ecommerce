<!-- Header -->
<!-- Header -->
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Tambah Data</h3>
        </div>
        <?php if ($this->session->flashdata('error')): ?>
          <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <form class="user" method="post" action="<?php echo base_url('Kuota/fungsitambah') ?>">
                <div class="form-grup">
                  <div class="row g-3">
                    <div class="col">
                      <form class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">NIK</label>
                          <input type="text" class="form-control" name="Nik" id="Nik">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Username</label>
                          <input type="text" class="form-control" name="username" id="username">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">idProduk</label>
                          <select class="form-control" name="idProduk" id="idProduk">
                                <?php foreach ($queryAllProduk as $produk) : ?>
                                    <option value="<?php echo $produk->idProduk; ?>">
                                        <?php echo $produk->idProduk; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select><br>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Nama Produk</label>
                          <select class="form-control" name="namProduk" id="namProduk">
                                <?php foreach ($queryAllProduk as $produk) : ?>
                                    <option value="<?php echo $produk->namProduk; ?>">
                                        <?php echo $produk->namProduk; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select><br>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Jumlah Kuota</label>
                          <input type="text" class="form-control" name="jumlahKuota" id="jumlahKuota">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Tahun</label>
                          <input type="text" class="form-control" name="tahun" id="tahun">
                        </div>
                        <button type="submit" class="btn btn-success mt-4">Simpan</button>
                        <button type="reset" class="btn btn-danger mt-4">Kosongkan</button>
                      </form>
              </form>
            </thead>
            <tbody class="list">
              <tr>
                <td>
                </td>
                <td>
                <td class="text-right">
                  <div class="dropdown">
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Card footer -->
      </div>
    </div>
  </div>
  <!-- Dark table -->
  <!-- Footer -->
  <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6">
        <div class="copyright text-center  text-lg-left  text-muted">
          &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative
            Tim</a>
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
            <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link"
              target="_blank">MIT License</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
</div>
</div>