<?php
class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bank_Model');
        $this->load->model('Order_Model');
        $this->load->model('Produk_Model');
        $this->load->model('Kuota_Model');
        $this->load->model('Member_Model');
        $this->load->library('session');
    }
    public function index()

    {
        $data['title'] = 'Bagas Tani';
        $queryAllBank = $this->Bank_Model->getDataBank();
        $data = array('queryAllBank' => $queryAllBank);
        $data['tbl_member'] = $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('member/Pembayaran', $data);
    }
    
    public function process_order()
    {
        $idKonsumen = $this->session->userdata('idKonsumen');
        $Nik = $this->session->userdata('Nik'); // Ambil nik pelanggan dari sesi
        $namKonsumen = $this->input->post('namKonsumen');
        $alamat = $this->input->post('alamat');
    
        // Hitung total harga dan siapkan idInvoice
        $grandtotal = 0;
        $idInvoice = 0; // Inisialisasi idInvoice
        if ($keranjang = $this->cart->contents()) {
            foreach ($keranjang as $items) {
                $grandtotal = $grandtotal + $items['subtotal'];
            }
    
            // Simpan data pesanan ke tabel invoice
            $invoiceData = array(
                'idKonsumen' => $idKonsumen,
                'namKonsumen' => $namKonsumen,
                'alamat' => $alamat,
                'total_harga' => $grandtotal,
                'tgl_pesan' => date('Y-m-d H:i:s') // Tanggal saat ini
            );
            $this->load->model('Order_Model');
            $idInvoice = $this->Order_Model->insertInvoice($invoiceData); // Menyimpan dan mendapatkan idInvoice baru
        }
    
        // Simpan detail pesanan ke tabel detail_order menggunakan idInvoice
        if ($idInvoice) {
            foreach ($keranjang as $items) {
                $orderData = array(
                    'idInvoice' => $idInvoice,
                    'idProduk' => $items['id'],
                    'namProduk' => $items['name'],
                    'harga' => $items['price'],
                    'jumlah' => $items['qty'],
                    'total_Harga' => $items['subtotal'],
                );
    
                $this->Order_Model->insert_order($orderData);
                $namProduk = $items['name'];
    
                // Mengurangi kuota pupuk jika produk adalah Urea atau Phonska
                if ($items['id'] == '2' || $items['id'] == '1') {
                    // Lakukan pengecekan kuota di sini
                    $idProduk = $items['id'];
                    $jumlahDipesan = $items['qty'];
    
                    if (!$this->Kuota_Model->getKuotaByNikAndProduk($Nik, $idProduk, $jumlahDipesan)) {
                        // Kuota habis, beri tahu konsumen dan hentikan proses
                        $this->session->set_flashdata('error', "Maaf, kuota pupuk ($namProduk) habis.");
                        redirect('pembayaran');
                    }
                }
    
                // Mengurangi stok produk hanya jika kuota tersedia
                $idProduk = $items['id'];
                $jumlahDipesan = $items['qty'];
                $this->Produk_Model->kurangiStok($idProduk, $jumlahDipesan);
            }
    
                // Lanjutkan dengan proses lain atau redirect
                redirect('proses_pesanan');
            } else {
                // Gagal membuat invoice
                echo "Gagal membuat invoice.";
            }
        } 
    }
    
