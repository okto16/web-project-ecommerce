<!-- Header -->
<!-- Header -->
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="result">
        <div class="col">
            <div class="card">
                <!-- Card header -->

                <!-- Light table -->
                <!-- Card footer -->
                <div class="card-footer py-0">
                </div>
            </div>
        </div>
    </div>
    <!-- Dark table -->
    <div class="result">
        <div class="col">
            <div class="card bg-primary shadow">
                <div class="card-header bg-transparent border-0">
                    <form action="<?= base_url('Kuota/perform_search'); ?>" method="post">
                        <input type="text" name="keyword" placeholder="Search...">
                        <button type="submit">Search</button>
                    </form>
                    <h3 class="text-white mb-0">Daftar Kuota</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center bg-primary table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Id</th>
                                <th scope="col" class="sort" data-sort="budget">NIK</th>
                                <th scope="col" class="sort" data-sort="name">Username</th>
                                <th scope="col" class="sort" data-sort="budget">id Produk</th>
                                <th scope="col" class="sort" data-sort="budget">Nama Produk</th>
                                <th scope="col" class="sort" data-sort="completion">Jumlah Kuota</th>
                                <th scope="col" class="sort" data-sort="completion">Tahun</th>
                                <th scope="col">Action</th>
                            </tr>
                            <?php foreach ($results as $row): ?>
                                <tr>
                                    <td class="text-white mb-0">
                                        <?php echo $row->id ?>
                                    </td>
                                    <td class="text-white mb-0">
                                        <?php echo $row->Nik ?>
                                    </td>
                                    <td class="text-white mb-0">
                                        <?php echo $row->username ?>
                                    </td>
                                    <td class="text-white mb-0">
                                        <?php echo $row->idProduk ?>
                                    </td>
                                    <td class="text-white mb-0">
                                        <?php echo $row->namProduk ?>
                                    </td>
                                    <td class="text-white mb-0">
                                        <?php echo $row->jumlahKuota ?>
                                    </td>
                                    <td class="text-white mb-0">
                                        <?php echo $row->tahun ?>
                                    </td>
                                    <td class="text-white mb-0"><a class="text-white mb-0"
                                            href="<?= base_url('Kuota/halaman_edit'); ?>/<?php echo $row->username ?>">Edit</a>
                                        | <a class="text-white mb-0"
                                            href="<?= base_url('Kuota/fungsidelete'); ?>/<?php echo $row->username ?>">Delete</a>
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
    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="result align-items-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="copyright text-center  text-lg-left  text-muted">
                    &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1"
                        target="_blank">Creative Tim</a>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About
                            Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md"
                            class="nav-link" target="_blank">MIT License</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</div>
</div>