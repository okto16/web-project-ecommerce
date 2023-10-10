<body>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
      <a class="navbar-brand" href="<?= base_url('homepage'); ?>">Bagas Tani</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
          class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
          <li class="nav-item"><a class="nav-link active" aria-current="page"
              href="CekKuota">Cek Kuota</a></li>
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url('Login'); ?>">Login</a>
          </li>
          <li class="nav-item dropdown">
        </ul>
        </li>
        </ul>
        <form class="d-flex">
          <button class="btn btn-outline-dark" type="submit">
            <i class="bi-cart-fill me-1"></i>
            Cart
            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
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
      <form action="<?= base_url('Cekkuota/perform_search'); ?>" method="post">
        <input type="text" name="keyword" placeholder="Search...">
        <button type="submit">Search</button>
      </form>
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