<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">
                <?= $tbl_member['namaKonsumen']; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url('Home'); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('Cekkuota'); ?>">Cek Kuota</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('Pesananmember'); ?>">Pesanan Anda</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('Home/Logout'); ?>">Logout</a></li>

                </ul>