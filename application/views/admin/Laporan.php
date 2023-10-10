  <!-- Header -->
  <!-- Header -->
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->

          <!-- Light table -->
          <!-- Card footer -->
          <!-- Dark table -->
          <div class="row">
            <div class="col">
              <div class="card bg-primary shadow">
                <div class="card-header bg-transparent border-0">
                  <form action="<?= base_url('Laporan/perform_search'); ?>" method="post">
                    <input type="text" name="keyword" placeholder="Search...">
                    <button type="submit">Search</button>
                  </form>
                  <form method="post" action="<?php echo base_url('laporan/laporan_harian'); ?>">
                    <label class="text-white">Tanggal Awal:</label>
                    <input type="date" name="tanggal_awal" value="<?php echo date('Y-m-d'); ?>"><br>

                    <label class="text-white">Tanggal Akhir:</label>
                    <input type="date" name="tanggal_akhir" value="<?php echo date('Y-m-d'); ?>"><br>

                    <button type="submit">Generate Laporan</button>
                  </form>

                  <h3 class="text-white mb-0">Laporan</h3>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center bg-primary table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col" class="sort" data-sort="name">Id Invoice</th>
                        <th scope="col" class="sort" data-sort="name">Nama Konsumen</th>
                        <th scope="col" class="sort" data-sort="name">Alamat</th>
                        <th scope="col" class="sort" data-sort="name">Total harga</th>
                        <th scope="col" class="sort" data-sort="name">Tanggal Pesan</th>
                        <th scope="col">Action</th>
                      </tr>
                      <?php
                      foreach ($invoice as $row) {
                      ?>
                        <tr>
                          <td class="text-white mb-0"><?php echo $row->idInvoice ?></td>
                          <td class="text-white mb-0"><?php echo $row->namKonsumen ?></td>
                          <td class="text-white mb-0"><?php echo $row->alamat ?></td>
                          <td class="text-white mb-0"><?php echo $row->total_harga ?></td>
                          <td class="text-white mb-0"><?php echo $row->tgl_pesan ?></td>
                          <td class="text-white mb-0"><a class="text-white mb-0" href="<?php echo site_url('Laporan/cetak'); ?>" target="_blank">Cetak Laporan</a> | <a class="text-white mb-0" href="<?php echo site_url('Pesanan/detail/' . $row->idInvoice); ?>" target="_blank">Detail</a></td>
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
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var opsiSelect = document.querySelector('select[name="opsi"]');
          var tglDiv = document.getElementById('tglDiv');
          var bulanDiv = document.getElementById('bulanDiv');
          var tahunDiv = document.getElementById('tahunDiv');

          opsiSelect.addEventListener('change', function() {
            var selectedOption = opsiSelect.options[opsiSelect.selectedIndex].value;
            if (selectedOption === 'tanggal') {
              tglDiv.style.display = 'block';
              bulanDiv.style.display = 'none';
              tahunDiv.style.display = 'none';
            } else if (selectedOption === 'bulan') {
              tglDiv.style.display = 'none';
              bulanDiv.style.display = 'block';
              tahunDiv.style.display = 'none';
            } else if (selectedOption === 'tahun') {
              tglDiv.style.display = 'none';
              bulanDiv.style.display = 'none';
              tahunDiv.style.display = 'block';
            }
          });
        });
      </script>