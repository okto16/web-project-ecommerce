<?php
class Pengembalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Return_Model');
        $this->load->model('Order_Model');
        $this->load->model('Produk_Model');
        $this->load->model('Detail_Model');
        $this->load->model('Jumlah_Model');
    }
    public function index()
    {
        $data['title'] = 'Kelola Return';
        $queryAllProduk = $this->Produk_Model->getDataProduk();
        $produk = array('queryAllProduk' => $queryAllProduk);
        $queryAllInvoice = $this->Order_Model->getapproveInvoice();
        $row = array('queryAllInvoice' => $queryAllInvoice);
        $queryAllReturn = $this->Return_Model->getDataReturn();
        $return = array('queryAllReturn' => $queryAllReturn);
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/Return', array_merge($data, $return, $row, $produk));
        $this->load->view('Layout Admin 2');
    }
    public function halaman_tambah()
    {
        $data['title'] = 'Kelola Return';
        $queryAllProduk = $this->Produk_Model->getDataProduk();
        $produk = array('queryAllProduk' => $queryAllProduk);
        $queryAllInvoice = $this->Order_Model->getapproveInvoice();
        $row = array('queryAllInvoice' => $queryAllInvoice);
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/TambahReturn', array_merge($data, $row, $produk));
        $this->load->view('Layout Admin 2');
    }
    public function addReturn()
    {
        $idInvoice = $this->input->post('idInvoice');
        $idProduk = $this->input->post('idProduk');
        $jumlahReturn = $this->input->post('jumlahReturn');

        // Ambil harga produk dari database
        $produk = $this->Produk_Model->getDataProdukDetail($idProduk);
        $harga = $produk->harga;

        // Update total harga faktur
        $faktur = $this->Order_Model->getInvoiceDetail($idInvoice);
        $totalHargaFaktur = $faktur->total_harga;

        // Hitung total harga produk yang dikembalikan
        $totalHargaKembali = $harga * $jumlahReturn;
        $newTotalHarga = $totalHargaFaktur - $totalHargaKembali;

        // Update total harga faktur dengan nilai baru
        $this->Order_Model->updateTotalHarga($idInvoice, $newTotalHarga);
        $this->Order_Model->updateTotalHargaDetail($idInvoice, $newTotalHarga);

        $dataReturn = array(
            'idInvoice' => $idInvoice,
            'idProduk' => $idProduk,
            'jumlahReturn' => $jumlahReturn,
            'totalHargaKembali' => $totalHargaKembali,
            'alasanReturn' => $this->input->post('alasanReturn')
        );

        $return_id = $this->Return_Model->addReturn($dataReturn);

        if ($return_id) {
            // Update stok produk yang dikembalikan
            $this->updateStokProduk($idProduk, $jumlahReturn);

            // Kurangi jumlah produk dalam tbl_detail_order
            $this->updateProdukInOrder($idInvoice, $idProduk, $jumlahReturn);

            $this->session->set_flashdata('success', 'Return berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan return.');
        }

        redirect('Pengembalian'); 
    }

    private function updateProdukInOrder($idInvoice, $idProduk, $jumlahReturn)
    {
        
        $detailOrder = $this->Order_Model->getDetailOrder($idInvoice, $idProduk);

        if ($detailOrder) {
            $newJumlahProduk = $detailOrder->jumlah - $jumlahReturn;
            $this->Order_Model->updateDetailOrder($idInvoice, $idProduk, $newJumlahProduk);
        }
    }

    private function updateStokProduk($idProduk, $jumlahReturn)
    {
        $produk = $this->Produk_Model->getDataProdukDetail($idProduk);

        if ($produk) {
            $newStok = $produk->stok + $jumlahReturn;
            $this->Produk_Model->updateDataProduk($idProduk, array('stok' => $newStok));
        }
    }
}