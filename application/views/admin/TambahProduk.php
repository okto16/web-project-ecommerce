<!-- Header -->
<!-- Header -->
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->

        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Tambah Data</h3>
        </div>

        <!-- Light table -->
        <?php if ($this->session->flashdata('error')) : ?>
          <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <form class="user" method="post" action="<?php echo base_url('Produk/fungsitambah') ?>">
                <div class="form-grup">
                  <div class="row g-3">
                    <div class="col">
                      <form class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Kategori</label>
                          <select class="form-control" name="idKat" id="idKat">
                            <?php foreach ($queryAllKategori as $kategori) : ?>
                              <option value="<?php echo $kategori->idKat; ?>">
                                <?php echo $kategori->namaKat; ?>
                              </option>
                            <?php endforeach; ?>
                          </select><br>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Nama Produk</label>
                          <input type="text" class="form-control" name="namProduk" id="namProduk">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Foto</label>
                          <input type="file" class="form-control" name="foto" id="foto">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Harga</label>
                          <input type="text" class="form-control" name="harga" id="harga">
                        </div>
                        <div class="col-10">
                          <label class="form-label">Stok</label>
                          <input type="text" class="form-control" name="stok" id="stok">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Berat</label>
                          <input type="text" class="form-control" name="berat" id="berat">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Deskripsi Produk</label>
                          <input type="text" class="form-control" name="deskripsiProduk" id="deskripsiProduk">
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