  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="<?= base_url('assets/'); ?>img/brand/logo.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('adminpage'); ?>">
                <i class="ni ni-tv-2 text-red"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Produk'); ?>">
                <i class="ni ni-single-copy-04 text-primary"></i>
                <span class="nav-link-text">Kelola Produk</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Kategori'); ?>">
                <i class="ni ni-book-bookmark text-primary"></i>
                <span class="nav-link-text">Kelola Kategori</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Kuota'); ?>">
                <i class="ni ni-books text-primary"></i>
                <span class="nav-link-text">Kelola Kuota Pupuk</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Pesanan'); ?>">
                <i class="ni ni-delivery-fast text-primary"></i>
                <span class="nav-link-text">Kelola Pesanan</span>
              </a>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Laporan'); ?>">
                <i class="ni ni-shop text-primary"></i>
                <span class="nav-link-text">Laporan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Pengembalian'); ?>">
                <i class="ni ni-box-2 text-primary"></i>
                <span class="nav-link-text">Pengembalian</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Member'); ?>">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Kelola Data Member</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('admin'); ?>">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Kelola Admin</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->

          <!-- Heading -->
          <!-- Navigation -->
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->

          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-bell-55 badge badge-primary navbar-badge">
                  <?= $total_pesanan ?>
                </i>
              </a>
              <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                  <h6 class="text-sm text-muted m-0">You have <strong class="text-primary"><?= $total_pesanan ?></strong> notifications.</h6>
                </div>
                <!-- List group -->
                <div class="list-group list-group-flush">
                <?php
                foreach ($invoice as $row) {
                ?>
                    <a href="<?= base_url('Pesanan'); ?>" class="list-group-item list-group-item-action">
                      <div class="row align-items-center">
                        <div class="col-auto">
                          <!-- Avatar -->
                          <img alt="Image placeholder" src="<?= base_url('assets/'); ?>img/theme/team-1.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <h4 class="mb-0 text-sm"><?php echo $row->namKonsumen ?></h4>
                            </div>
                            <div class="text-right text-muted">
                              <small><?php echo $row->tgl_pesan ?></small>
                            </div>
                          </div>
                          <p class="text-sm mb-0"><?php echo $row->status ?></p>
                        </div>
                      </div>
                    </a>
                  <?php } ?>
                  </div>
                  <!-- View all -->
              </div>
            </li>
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                      <img alt="Image placeholder" src="<?= base_url('assets/'); ?>img/theme/team-4.jpg">
                    </span>
                    <div class="media-body  ml-2  d-none d-lg-block">
                      <span class="mb-0 text-sm  font-weight-bold"><?= $tbl_admin['username']; ?></span>
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right ">
                  <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome!</h6>
                  </div>
                  <div class="dropdown-divider"></div>
                  <a href="<?= base_url('Home/Logout'); ?>" class="dropdown-item">
                    <i class="ni ni-user-run"></i>
                    <span>Logout</span>
                  </a>
                </div>
              </li>
            </ul>
        </div>
      </div>
    </nav>