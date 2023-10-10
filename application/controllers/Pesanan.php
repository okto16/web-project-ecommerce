<?php
class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_Model');
        $this->load->model('Jumlah_Model');
        $this->load->model('Detail_Model');
        $this->load->model('Produk_Model');
    }

    public function index()
    {
        $data['title'] = 'Bagas Tani';
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/Pesanan', $data);
        $this->load->view('Layout Admin 2');
    }

    public function approve($idInvoice)
    {
        $this->Order_Model->approveInvoice($idInvoice);
        $data['title'] = 'Bagas Tani';
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('Layout Admin 2');
        $this->load->view('sidebaradmin', $data);
        $this->session->set_flashdata('success', 'Pesanan berhasil konfirmasi.');

        redirect('Pesanan', $data);
    }
    public function ditolak($idInvoice)
    {
        $invoice = $this->Order_Model->getInvoiceById($idInvoice);
        foreach ($invoice->items as $item) {
            $produkId = $item->idProduk;
            $jumlah = $item->jumlah; 
            $produk = $this->Produk_Model->getProductById($produkId);
            $stokBaru = $produk->stok + $jumlah;
            $this->Produk_Model->updateStokProduk($produkId, $stokBaru);
        }

        // Lanjutkan dengan operasi lain yang Anda lakukan dalam metode ditolak
        $this->Order_Model->ditolakInvoice($idInvoice);
        $data['title'] = 'Bagas Tani';
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('Layout Admin 2');
        $this->load->view('sidebaradmin', $data);
        $this->session->set_flashdata('success', 'Pesanan berhasil tolak.');

        redirect('Pesanan', $data);
    }

    public function detail($idInvoice)
    {
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['orderDetail'] = $this->Detail_Model->getOrderDetail($idInvoice);
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/DetailPesanan', $data);
        $this->load->view('Layout Admin 2');
    }
    public function perform_search()
    {
        $keyword = $this->input->post('keyword');
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['results'] = $this->Order_Model->search($keyword);
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/CariPesanan', $data);
        $this->load->view('Layout Admin 2');
    }
}