<?php
class Shop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kuota_Model');
        $this->load->model('Produk_Model');
    }

    public function index()
    {
        if (empty($this->cart->contents())) {
            redirect('Home');
        }
        $data['title'] = 'Bagas Tani';
        $this->load->view('Header', $data);
        $data['tbl_member'] = $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('sidebar', $data);
        $this->load->view('member/Shop', $data);
        $this->load->view('Footer');
    }

    public function add()
    {
        $redirect_page = $this->input->post('redirect_page');
        $idProduk = $this->input->post('id');
        $jumlahDibeli = $this->input->post('qty');
        // Dapatkan jumlah stok produk
        $stokProduk = $this->Produk_Model->getStokById($idProduk); // Ganti dengan cara Anda untuk mendapatkan stok produk

        // Dapatkan jumlah yang sudah ada di keranjang belanja untuk produk ini
        $existingQty = 0;
        foreach ($this->cart->contents() as $items) {
            if ($items['id'] == $idProduk) {
                $existingQty += $items['qty'];
            }
        }

        if (($idProduk == 1 || $idProduk == 2) && $stokProduk >= $jumlahDibeli + $existingQty) {
            // Dapatkan jumlah kuota yang tersedia untuk produk ini
            $Nik = $this->session->userdata('Nik');
            $jumlahKuota = $this->Kuota_Model->getKuotaByNikAndProduk($Nik, $idProduk);

            // Periksa apakah kuota cukup untuk produk ini
            if ($jumlahKuota >= $jumlahDibeli + $existingQty) {
                // Jika kuota cukup, tambahkan produk ke keranjang belanja
                $data = array(
                    'id' => $idProduk,
                    'qty' => $jumlahDibeli,
                    'price' => $this->input->post('price'),
                    'name' => $this->input->post('name'),
                );

                $this->cart->insert($data);
            } else {
                // Jika kuota tidak cukup, tampilkan pesan kesalahan kepada pengguna
                echo '<script>alert("Kuota produk tidak mencukupi untuk pembelian ini.");</script>';
            }
        } elseif ($stokProduk >= $jumlahDibeli + $existingQty) {
            $data = array(
                'id' => $idProduk,
                'qty' => $jumlahDibeli,
                'price' => $this->input->post('price'),
                'name' => $this->input->post('name'),
            );

        $this->cart->insert($data);
        }else{
            echo '<script>alert("Stok produk tidak mencukupi untuk pembelian ini.");</script>';
        }
        redirect($redirect_page, 'refresh');
    }

    public function delete($rowid)
    {
        $this->cart->remove($rowid);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('Shop');
    }

    public function update()
    {
        $i = 1;
        foreach ($this->cart->contents() as $items) {
            $rowid = $items['rowid'];
            $idProduk = $items['id'];
            $newQty = $this->input->post($i . '[qty]');
    
            // Dapatkan jumlah stok produk
            $stokProduk = $this->Produk_Model->getStokById($idProduk); // Ganti dengan cara Anda untuk mendapatkan stok produk
    
            // Dapatkan jumlah yang sudah ada di keranjang belanja untuk produk ini
            $existingQty = 0;
            foreach ($this->cart->contents() as $cartItem) {
                if ($cartItem['id'] == $idProduk && $cartItem['rowid'] != $rowid) {
                    $existingQty += $cartItem['qty'];
                }
            }
    
            // Periksa apakah stok cukup untuk produk ini dan apakah jumlah yang akan diubah tidak melebihi 1 jika stok hanya tersisa 1
            if ($stokProduk == 1 && $newQty > 1) {
                $this->session->set_flashdata('success', 'Anda tidak dapat mengubah jumlah produk ini menjadi lebih dari 1 karena stok hanya tersisa 1.');
                echo '<script>alert("Anda tidak dapat mengubah jumlah produk ini menjadi lebih dari 1 karena stok hanya tersisa 1.");</script>';
            } elseif ($stokProduk > 1 && $newQty + $existingQty <= $stokProduk) {
                // Jika stok lebih dari 1, perbarui jumlah produk di keranjang belanja
                $data = array(
                    'rowid' => $rowid,
                    'qty' => $newQty,
                );
                $this->cart->update($data);
    
                // Update kuota jika produk memiliki idProduk 1 atau 2
                if ($idProduk == 1 || $idProduk == 2) {
                    $this->Kuota_Model->kurangiKuota($idProduk, $existingQty + 1 - $newQty); // Kurangi kuota sejumlah selisih antara jumlah sebelumnya dan yang baru
                }
            } else {
                $this->session->set_flashdata('success', 'Jumlah produk melebihi stok yang tersedia.');
                echo '<script>alert("Jumlah produk melebihi stok yang tersedia.");</script>';
            }
    
            $i++;
        }
        redirect('shop');
    }    
}